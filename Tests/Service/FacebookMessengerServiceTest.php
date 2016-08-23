<?php

namespace PouleR\FacebookMessengerBundle\Tests;

use PouleR\FacebookMessengerBundle\Core\Configuration\GreetingTextConfiguration;
use PouleR\FacebookMessengerBundle\Core\Entity\Recipient;
use PouleR\FacebookMessengerBundle\Core\Message;
use PouleR\FacebookMessengerBundle\Service\CurlService;
use PouleR\FacebookMessengerBundle\Service\FacebookMessengerService;

/**
 * Class FacebookMessengerServiceTest.
 */
class FacebookMessengerServiceTest extends \PHPUnit_Framework_TestCase
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
            ->with('https://graph.facebook.com/v2.6/456789', array('fields' => 'first_name,last_name', 'access_token' => 'token'))
            ->willReturn('{"first_name": "Unit","last_name": "Test"}');

        $service = new FacebookMessengerService($curlService);
        $service->setAccessToken('token');
        $result = $service->getUser(456789);

        self::assertEquals('Unit', $result['first_name']);
        self::assertEquals('Test', $result['last_name']);
    }
}
