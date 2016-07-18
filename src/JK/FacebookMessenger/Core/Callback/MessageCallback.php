<?php

namespace JK\FacebookMessenger\Core\Callback;

/**
 * Class MessageCallback
 * @package JK\FacebookMessenger\Core\Callback
 */
class MessageCallback extends Callback
{
    /**
     * @var MessageReceive
     */
    protected $message;

    /**
     * @return MessageReceive
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param MessageReceive $message
     */
    public function setMessage(MessageReceive $message)
    {
        $this->message = $message;
    }
}