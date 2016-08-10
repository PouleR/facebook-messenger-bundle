<?php

namespace JK\FacebookMessenger\Core\Payload;

use JK\FacebookMessenger\Core\Payload;

/**
 * Class MediaPayload
 * @package JK\FacebookMessenger\Core\Payload
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