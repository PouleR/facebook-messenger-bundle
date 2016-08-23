<?php

namespace PouleR\FacebookMessengerBundle\Core\Configuration;

/**
 * Class AbstractConfiguration.
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $settingType;

    /**
     * {@inheritdoc}
     */
    public function getSettingType()
    {
        return $this->settingType;
    }

    /**
     * {@inheritdoc}
     */
    public function setSettingType($settingType)
    {
        $this->settingType = $settingType;
    }
}
