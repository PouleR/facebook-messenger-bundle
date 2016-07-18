<?php

/**
 * Class QuickReplyReceive
 */
class QuickReplyReceive
{
    /**
     * @var \JK\FacebookMessenger\Core\Payload
     */
    protected $payload;

    /**
     * @return \JK\FacebookMessenger\Core\Payload
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param \JK\FacebookMessenger\Core\Payload $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }
}