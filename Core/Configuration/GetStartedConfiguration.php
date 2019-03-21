<?php

namespace PouleR\FacebookMessengerBundle\Core\Configuration;

/**
 * Class GetStartedConfiguration.
 */
class GetStartedConfiguration extends AbstractConfiguration
{
    /**
     * @var string
     */
    protected $payload = '';

    /**
     * GetStartedConfiguration constructor.
     */
    public function __construct()
    {
        $this->setSettingType('get_started');
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }
}
