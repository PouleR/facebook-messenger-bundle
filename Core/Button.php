<?php

namespace PouleR\FacebookMessengerBundle\Core;

/**
 * Class Button.
 */
abstract class Button implements ButtonInterface
{
    const TYPE_WEB_URL = 'web_url';
    const TYPE_POSTBACK = 'postback';
    const TYPE_ACCOUNT_LINK = 'account_link';
    const TYPE_ACCOUNT_UNLINK = 'account_unlink';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $title;

    /**
     * Button constructor.
     *
     * @param string $type
     * @param string $title
     */
    public function __construct($type, $title = '')
    {
        $this->type = $type;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    protected function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
