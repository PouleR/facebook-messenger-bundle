<?php

namespace PouleR\FacebookMessengerBundle\Core\Configuration;

/**
 * Class GetStartedConfiguration
 * @package PouleR\FacebookMessengerBundle\Core\Configuration
 */
class GetStartedConfiguration extends AbstractConfiguration
{
    /**
     * @var string
     */
    protected $threadState = 'new_thread';

    /**
     * @var array
     */
    protected $callToActions = array();

    /**
     * GetStartedConfiguration constructor.
     */
    public function __construct()
    {
        $this->setSettingType('call_to_actions');
    }

    /**
     * @return string
     */
    public function getThreadState()
    {
        return $this->threadState;
    }

    /**
     * @return array
     */
    public function getCallToActions()
    {
        return $this->callToActions;
    }

    /**
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->callToActions[] = array('payload' => $payload);
    }
}