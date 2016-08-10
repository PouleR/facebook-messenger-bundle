<?php

namespace JK\FacebookMessenger\Core\Callback;

/**
 * Class PayloadReceive
 * @package JK\FacebookMessenger\Core\Callback
 */
class PayloadReceive
{
    /**
     * @var string
     */
    protected $payload;

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }
}