<?php

namespace PouleR\FacebookMessengerBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use PouleR\FacebookMessengerBundle\Core\Configuration\GetStartedConfiguration;
use PouleR\FacebookMessengerBundle\Core\Configuration\GreetingTextConfiguration;
use PouleR\FacebookMessengerBundle\Core\Entity\Recipient;
use PouleR\FacebookMessengerBundle\Core\Message;
use PouleR\FacebookMessengerBundle\Service\CurlService;
use PouleR\FacebookMessengerBundle\Service\FacebookMessengerService;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FacebookMessengerServiceTest.
 */
class FacebookMessengerServiceTest extends TestCase
{
    /**
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testPostMessageWithoutAccessToken()
    {
        $recipient = new Recipient(1);
        $message = new Message('Test');
        $service = new FacebookMessengerService(new CurlService());
        $service->postMessage($recipient, $message);
    }

    /**
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testPostConfigurationWithoutAccessToken()
    {
        $configuration = new GreetingTextConfiguration();
        $service = new FacebookMessengerService(new CurlService());
        $service->postConfiguration($configuration);
    }

    /**
     * Test the postConfiguration function for a welcome text
     */
    public function testPostGreetingTextConfiguration()
    {
        $curlService = $this->getMockBuilder(CurlService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $curlService->expects($this->once())
            ->method('post')
            ->with(
                'https://graph.facebook.com/v2.6/me/thread_settings?access_token=accessToken',
                '{"greeting":{"text":"Hello there!"},"setting_type":"greeting"}'
            )
            ->willReturn('{"result": "Successfully changed thread settings"}');

        $service = new FacebookMessengerService($curlService);
        $service->setAccessToken('accessToken');

        $configuration = new GreetingTextConfiguration();
        $configuration->setGreetingText('Hello there!');
        $result = $service->postConfiguration($configuration);

        self::assertEquals('Successfully changed thread settings', $result['result']);
    }

    /**
     * Test the postConfiguration function for a get started button
     */
    public function testPostGetStartedConfiguration()
    {
        $curlService = $this->getMockBuilder(CurlService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $curlService->expects($this->once())
            ->method('post')
            ->with(
                'https://graph.facebook.com/v2.6/me/thread_settings?access_token=accessToken',
                // @codingStandardsIgnoreLine
                '{"thread_state":"new_thread","call_to_actions":[{"payload":"Payload"}],"setting_type":"call_to_actions"}'
            )
            ->willReturn('{"result": "Successfully added new_thread\'s CTAs"}');

        $service = new FacebookMessengerService($curlService);
        $service->setAccessToken('accessToken');

        $configuration = new GetStartedConfiguration();
        $configuration->setPayload('Payload');
        $result = $service->postConfiguration($configuration);

        self::assertEquals('Successfully added new_thread\'s CTAs', $result['result']);
    }

    /**
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testGetUserWithoutAccessToken()
    {
        $service = new FacebookMessengerService(new CurlService());
        $service->getUser(1);
    }

    /**
     * Test the getUser function and stub the response from Facebook
     */
    public function testGetUser()
    {
        $curlService = $this->getMockBuilder(CurlService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $curlService->expects($this->once())
            ->method('get')
            ->with(
                'https://graph.facebook.com/v2.6/456789',
                array('fields' => 'first_name,last_name', 'access_token' => 'token')
            )
            ->willReturn('{"first_name": "Unit","last_name": "Test"}');

        $service = new FacebookMessengerService($curlService);
        $service->setAccessToken('token');
        $result = $service->getUser(456789);

        self::assertEquals('Unit', $result['first_name']);
        self::assertEquals('Test', $result['last_name']);
    }

    /**
     * Test if null is returned when there is no hub_mode set in the request
     */
    public function testEmptyVerificationToken()
    {
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request->expects($this->exactly(1))
            ->method('get')
            ->withConsecutive(['hub_mode'])
            ->willReturnOnConsecutiveCalls(null);

        $service = new FacebookMessengerService(new CurlService());
        $challenge = $service->handleVerificationToken($request, '12345');
        self::assertNull($challenge);
    }

    /**
     * Test if an exception is thrown when the verification token is incorrect
     *
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testInvalidVerificationToken()
    {
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

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

        $service = new FacebookMessengerService(new CurlService());
        $service->handleVerificationToken($request, '98765');
    }

    /**
     * Test a valid verification token
     */
    public function testValidVerificationToken()
    {
        $request = $this->getMockBuilder(Request::class)
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

        $service = new FacebookMessengerService(new CurlService());
        $challenge = $service->handleVerificationToken($request, '12345');
        self::assertEquals('challenge_code', $challenge);
    }
}
