<?php

namespace JK\FacebookMessenger\Core\Callback;

use JK\FacebookMessenger\Core\Payload;

/**
 * Class PayloadReceive
 * @package JK\FacebookMessenger\Core\Callback
 */
class PayloadReceive
{
    /**
     * @var Payload
     */
    protected $payload;

    /**
     * @return Payload
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param Payload $payload
     */
    public function setPayload(Payload $payload)
    {
        $this->payload = $payload;
    }
}