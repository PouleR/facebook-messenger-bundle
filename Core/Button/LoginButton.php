<?php

namespace PouleR\FacebookMessengerBundle\Core\Button;

use PouleR\FacebookMessengerBundle\Core\Button;
use PouleR\FacebookMessengerBundle\Core\ButtonInterface;

/**
 * Class LoginButton.
 */
class LoginButton implements ButtonInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string|null
     */
    protected $url;

    /**
     * LoginButton constructor.
     *
     * @param string|null $loginUrl
     */
    public function __construct($loginUrl = null)
    {
        $this->type = Button::TYPE_ACCOUNT_LINK;
        $this->setUrl($loginUrl);
    }

    /**
     * @param null $url
     *
     * @return $this
     */
    public function setUrl($url = null)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
