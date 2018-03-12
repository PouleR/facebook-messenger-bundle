<?php

namespace PouleR\FacebookMessengerBundle\Core\Configuration;

/**
 * Class GreetingTextConfiguration.
 */
class GreetingTextConfiguration extends AbstractConfiguration
{
    /**
     * @var string
     */
    protected $text = '';

    /**
     * @var string
     */
    protected $locale = 'default';

    /**
     * GreetingTextConfiguration constructor.
     */
    public function __construct()
    {
        $this->setSettingType('greeting');
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
