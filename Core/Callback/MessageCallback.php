<?php

namespace PouleR\FacebookMessengerBundle\Core\Callback;

/**
 * Class MessageCallback.
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
