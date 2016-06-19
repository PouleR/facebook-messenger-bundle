<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/14
 * Time: 9:14 AM
 */

namespace JK\FacebookMessenger\Core;

/**
 * Interface AttachmentInterface
 * @package jkosmetos\Interfaces
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