<?php

namespace PouleR\FacebookMessengerBundle\Core\Payload;

use PouleR\FacebookMessengerBundle\Core\Payload;

/**
 * Class MediaPayload
 * @package PouleR\FacebookMessengerBundle\Core\Payload
 */
class MediaPayload extends Payload
{
    /**
     * @var string
     */
    protected $url;

    /**
     * MediaPayload constructor.
     * @param string $url
     */
    public function __construct($url = '')
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

}