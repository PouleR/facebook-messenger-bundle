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
     * @var FacebookMessengerService
     */
    protected $fbService;

    /**
     * Initialize the service.
     */
    public function setUp()
    {
        $this->fbService = new FacebookMessengerService(new CurlService());
    }

    /**
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testPostMessageWithoutAccessToken()
    {
        $recipient = new Recipient(1);
        $message = new Message('Test');
        $this->fbService->postMessage($recipient, $message);
    }

    /**
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testPostConfigurationWithoutAccessToken()
    {
        $configuration = new GreetingTextConfiguration();
        $this->fbService->postConfiguration($configuration);
    }

    /**
     * @expectedException \PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException
     */
    public function testGetUserWithoutAccessToken()
    {
        $this->fbService->getUser(1);
    }
}
