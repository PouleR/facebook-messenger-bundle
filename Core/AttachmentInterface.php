<?php

namespace PouleR\FacebookMessengerBundle\Core;

/**
 * Interface AttachmentInterface
 * @package PouleR\FacebookMessengerBundle\Core
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