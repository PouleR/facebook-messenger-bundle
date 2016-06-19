<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/14
 * Time: 11:11 AM
 */

namespace JK\FacebookMessenger\Core\Button;

use JK\FacebookMessenger\Core\Button;

/**
 * Class WebUrlButton
 * @package JK\FacebookMessenger\Core\Button
 */
class WebUrlButton extends Button
{

    /**
     * @var string
     */
    protected $url;

    /**
     * WebUrlButton constructor.
     * @param $title
     * @param $url
     */
    public function __construct($title = '', $url = '')
    {
        // Invoke parent constructor and force type value
        parent::__construct(Button::TYPE_WEB_URL, $title);

        // Set WebUrlButton specific property values
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