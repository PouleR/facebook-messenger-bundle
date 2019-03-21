<?php

namespace PouleR\FacebookMessengerBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use PouleR\FacebookMessengerBundle\Client\FailedMessageRequest;

/**
 * Class FailedMessageRequestTest
 */
class FailedMessageRequestTest extends TestCase
{
    /**
     *
     */
    public function testFailedMessageRequest()
    {
        $failed = new FailedMessageRequest(500, 'body');
        self::assertEquals('body', $failed->getResponseBody());
        self::assertEquals(500, $failed->getResponseCode());

        $failed->setPsid(12345);
        self::assertEquals(12345, $failed->getPsid());
    }
}
