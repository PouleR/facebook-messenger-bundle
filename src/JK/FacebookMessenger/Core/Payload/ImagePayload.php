<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/14
 * Time: 8:56 AM
 */

namespace JK\FacebookMessenger\Core\Payload;

use JK\FacebookMessenger\Core\Payload;

/**
 * Class ImagePayload
 * @package JK\FacebookMessenger\Core\Payload
 */
class ImagePayload extends Payload
{
    /**
     * @var string
     */
    protected $url;

    /**
     * ImagePayload constructor.
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