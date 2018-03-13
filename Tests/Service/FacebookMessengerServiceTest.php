<?php

namespace PouleR\FacebookMessengerBundle\Tests\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use PouleR\FacebookMessengerBundle\Core\Configuration\GetStartedConfiguration;
use PouleR\FacebookMessengerBundle\Core\Configuration\GreetingTextConfiguration;
use PouleR\FacebookMessengerBundle\Core\Entity\Recipient;
use PouleR\FacebookMessengerBundle\Core\Message;
use PouleR\FacebookMessengerBundle\Service\FacebookMessengerService;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class FacebookMessengerServiceTest.
 */
class FacebookMessengerServiceTest extends TestCase
{
    /**
     * @var LoggerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $logger;

    /**
     * @var array
     */
    protected $requestContainer = [];

    /**
     * @var MockHandler
     */
    protected $clientHandler;

    /**
     * @var FacebookMessengerService
     */
    protected $messengerService;

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function setUp()
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->clientHandler = new MockHandler();
        $this->requestContainer = [];

        $history = Middleware::history($this->requestContainer);
        $stack = HandlerStack::create($this->clientHandler);
        $stack->push($history);

        $this->messengerService = new FacebookMessengerService(
            'app.id',
            'app.secret',
            new NullLogger(),
            new Client(['handler' => $stack])
        );
        $this->messengerService->setAccessToken('access.token');
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function testPostMessage()
    {
        $this->clientHandler->append(new Response());
        $this->messengerService->postMessage(
            new Recipient(1),
            new Message('Test'),
            FacebookMessengerService::MSG_TYPE_RESPONSE
        );

        /** @var Request $request */
        $request = $this->requestContainer[0]['request'];
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('/v2.10/me/messages', $request->getUri()->getPath());

        parse_str($request->getBody(), $requestBody);
        self::assertEquals('{"id":1,"phone_number":null}', $requestBody['recipient']);
        self::assertEquals('{"text":"Test","attachment":null}', $requestBody['message']);
        self::assertEquals('RESPONSE', $requestBody['type']);
        self::assertEquals('access.token', $requestBody['access_token']);
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function testGetUser()
    {
        $this->clientHandler->append(new Response(
            200,
            [],
            json_encode(['first_name' => 'Unit', 'last_name' => 'Test'])
        ));
        $result = $this->messengerService->getUser(4001);

        /** @var Request $request */
        $request = $this->requestContainer[0]['request'];
        self::assertEquals('GET', $request->getMethod());
        self::assertEquals('/v2.10/4001', $request->getUri()->getPath());

        self::assertEquals('Unit', $result['first_name']);
        self::assertEquals('Test', $result['last_name']);
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function testGetPsid()
    {
        $this->clientHandler->append(new Response(
            200,
            [],
            json_encode(['id' => 'PAGE_ID', 'recipient' => 'PSID'])
        ));
        $result = $this->messengerService->getPsid('linking_token');

        /** @var Request $request */
        $request = $this->requestContainer[0]['request'];
        self::assertEquals('GET', $request->getMethod());
        self::assertEquals('/v2.10/me', $request->getUri()->getPath());

        parse_str($request->getUri()->getQuery(), $requestParams);
        self::assertEquals('linking_token', $requestParams['account_linking_token']);
        self::assertEquals('recipient', $requestParams['fields']);

        self::assertEquals('PAGE_ID', $result['id']);
        self::assertEquals('PSID', $result['recipient']);
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function testUnlinkAccount()
    {
        $this->clientHandler->append(new Response(
            200,
            [],
            json_encode(['result' => 'unlink account success'])
        ));
        $result = $this->messengerService->unlinkAccount(123456);

        /** @var Request $request */
        $request = $this->requestContainer[0]['request'];
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('/v2.10/me/unlink_accounts', $request->getUri()->getPath());

        parse_str($request->getBody(), $requestParams);
        self::assertEquals(123456, $requestParams['psid']);
        self::assertEquals('unlink account success', $result['result']);
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function testGetStarted()
    {
        $this->clientHandler->append(new Response());

        $getStarted = new GetStartedConfiguration();
        $getStarted->setPayload('payload');
        $this->messengerService->setGetStarted($getStarted);

        /** @var Request $request */
        $request = $this->requestContainer[0]['request'];
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('/v2.10/me/messenger_profile', $request->getUri()->getPath());

        parse_str($request->getBody(), $requestParams);
        self::assertEquals('{"payload":"payload"}', $requestParams['get_started']);
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function testGreetingText()
    {
        $this->clientHandler->append(new Response());

        $greeting = new GreetingTextConfiguration();
        $greeting->setText('Hello');
        $greeting->setLocale('en_US');
        $this->messengerService->setGreetingText($greeting);

        /** @var Request $request */
        $request = $this->requestContainer[0]['request'];
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('/v2.10/me/messenger_profile', $request->getUri()->getPath());

        parse_str($request->getBody(), $requestParams);
        self::assertEquals(['{"text":"Hello","locale":"en_US"}'], $requestParams['greeting']);
    }

    /**
     * Test if null is returned when there is no hub_mode set in the request
     *
     * @throws \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testEmptyVerificationToken()
    {
        $request = $this->createMock(\Symfony\Component\HttpFoundation\Request::class);

        $request->expects($this->exactly(1))
            ->method('get')
            ->withConsecutive(['hub_mode'])
            ->willReturnOnConsecutiveCalls(null);

        $challenge = $this->messengerService->handleVerificationToken($request, '12345');
        self::assertNull($challenge);
    }

    /**
     * Test if an exception is thrown when the verification token is incorrect
     *
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testInvalidVerificationToken()
    {
        $request = $this->createMock(\Symfony\Component\HttpFoundation\Request::class);

        $request->expects($this->exactly(3))
            ->method('get')
            ->withConsecutive(
                ['hub_mode'],
                ['hub_mode'],
                ['hub_verify_token']
            )
            ->willReturnOnConsecutiveCalls(
                'subscribe',
                'subscribe',
                '12345'
            );

        $this->messengerService->handleVerificationToken($request, '98765');
    }

    /**
     * Test a valid verification token
     *
     * @throws \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testValidVerificationToken()
    {
        $request = $this->getMockBuilder(\Symfony\Component\HttpFoundation\Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request->expects($this->exactly(4))
            ->method('get')
            ->withConsecutive(
                ['hub_mode'],
                ['hub_mode'],
                ['hub_verify_token'],
                ['hub_challenge']
            )
            ->willReturnOnConsecutiveCalls(
                'subscribe',
                'subscribe',
                '12345',
                'challenge_code'
            );

        $challenge = $this->messengerService->handleVerificationToken($request, '12345');
        self::assertEquals('challenge_code', $challenge);
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function testAddMessageToBatchLimit()
    {
        for ($i = 1; $i < 60; $i++) {
            $result = $this->messengerService->addMessageToBatch(new Recipient(1), new Message('test'));
            self::assertEquals($i <= 50 ? true : false, $result);
        }
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     * @throws \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     *
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testSendBatchRequestsException()
    {
        // No batch requests added
        $this->messengerService->sendBatchRequests();
    }

    /**
     * @throws \Facebook\Exceptions\FacebookSDKException
     * @throws \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testSendBatchRequests()
    {
        $this->messengerService->addMessageToBatch(new Recipient(2), new Message('test1'));
        $this->messengerService->addMessageToBatch(new Recipient(4), new Message('test2'));
        $this->messengerService->addMessageToBatch(new Recipient(6), new Message('test3'));
        $this->messengerService->addMessageToBatch(new Recipient(8), new Message('test4'));

        $this->clientHandler->append(new Response(
            200,
            [],
            json_encode([
                [
                    'code' => 200,
                ],
                [
                    'code' => 500,
                    'body' => 'error'
                ],
                [
                    'code' => 200
                ],
                [
                    'code' => 501,
                    'body' => '{"error":{"message":"(#100) No matching user found"}}'
                ]
            ])
        ));

        $result = $this->messengerService->sendBatchRequests();

        /** @var Request $request */
        $request = $this->requestContainer[0]['request'];
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('/v2.10', $request->getUri()->getPath());

        parse_str($request->getBody(), $requestParams);
        self::assertCount(4, json_decode($requestParams['batch']));

        self::assertCount(2, $result);
        self::assertEquals(500, $result['batch_4_#2']['code']);
        self::assertEquals('error', $result['batch_4_#2']['body']);
        self::assertEquals(501, $result['batch_8_#4']['code']);
        self::assertEquals('{"error":{"message":"(#100) No matching user found"}}', $result['batch_8_#4']['body']);
    }
}
