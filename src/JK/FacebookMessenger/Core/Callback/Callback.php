<?php

namespace JK\FacebookMessenger\Core\Callback;

/**
 * Class Callback
 * @package JK\FacebookMessenger\Core\Callback
 */
class Callback
{
    /**
     * @var Sender
     */
    protected $sender;

    /**
     * @var Recipient
     */
    protected $recipient;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @return Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param Sender $sender
     */
    public function setSender(Sender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param Recipient $recipient
     */
    public function setRecipient(Recipient $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
}
