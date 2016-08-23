<?php

namespace PouleR\FacebookMessengerBundle\Core\Configuration;

/**
 * Class GreetingTextConfiguration.
 */
class GreetingTextConfiguration extends AbstractConfiguration
{
    /**
     * @var array
     */
    protected $greeting = array();

    /**
     * GreetingTextConfiguration constructor.
     */
    public function __construct()
    {
        $this->setSettingType('greeting');
    }

    /**
     * @param string $greetingText
     */
    public function setGreetingText($greetingText)
    {
        $this->greeting = array('text' => $greetingText);
    }

    /**
     * @return string|null
     */
    public function getGreeting()
    {
        return $this->greeting;
    }
}
