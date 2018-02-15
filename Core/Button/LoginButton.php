<?php

namespace PouleR\FacebookMessengerBundle\Core\Button;

use PouleR\FacebookMessengerBundle\Core\Button;

/**
 * Class LoginButton.
 */
class LoginButton extends Button
{
    /**
     * @var string|null
     */
    protected $loginUrl;

    /**
     * LoginButton constructor.
     *
     * @param string      $title
     * @param string|null $loginUrl
     */
    public function __construct(string $title = '', $loginUrl = null)
    {
        parent::__construct(Button::TYPE_POSTBACK, $title);

        $this->setLoginUrl($loginUrl);
    }

    /**
     * @return null|string
     */
    public function getLoginUrl()
    {
        return $this->loginUrl;
    }

    /**
     * @param string|null $loginUrl
     *
     * @return $this
     */
    public function setLoginUrl($loginUrl = null)
    {
        $this->loginUrl = $loginUrl;

        return $this;
    }
}
