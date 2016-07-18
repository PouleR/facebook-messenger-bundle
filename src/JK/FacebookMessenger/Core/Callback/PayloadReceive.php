<?php

namespace JK\FacebookMessenger\Core\Callback;

/**
 * Class PayloadReceive
 * @package JK\FacebookMessenger\Core\Callback
 */
class PayloadReceive
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