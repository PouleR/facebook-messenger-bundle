<?php

namespace PouleR\FacebookMessengerBundle\Core\Callback;

/**
 * Class Callback
 * @package PouleR\FacebookMessengerBundle\Core\Callback
 */
class Callback
{
    /**
     * @var SenderCallback
     */
    protected $sender;

    /**
     * @var RecipientCallback
     */
    protected $recipient;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @return SenderCallback
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param SenderCallback $sender
     */
    public function setSender(SenderCallback $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return RecipientCallback
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param RecipientCallback $recipient
     */
    public function setRecipient(RecipientCallback $recipient)
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
