<?php

namespace JK\FacebookMessenger\Core\Configuration;

use JK\FacebookMessenger\Core\Message;

/**
 * Class CallToAction
 * @package JK\FacebookMessenger\Core
 */
class CallToAction
{
    /**
     * @var Message
     */
    protected $message;

    /**
     * CallToAction constructor.
     * @param Message $message
     */
    public function __construct(Message $message = null)
    {
        $this->message = $message;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}