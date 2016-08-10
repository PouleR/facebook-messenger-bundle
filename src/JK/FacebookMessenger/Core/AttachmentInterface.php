<?php

namespace JK\FacebookMessenger\Core;

/**
 * Interface AttachmentInterface
 * @package JK\FacebookMessenger\Core
 */
interface AttachmentInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     */
    public function setType($type);

    /**
     * @return mixed
     */
    public function getPayload();

    /**
     * @param mixed $payload
     */
    public function setPayload($payload);

}