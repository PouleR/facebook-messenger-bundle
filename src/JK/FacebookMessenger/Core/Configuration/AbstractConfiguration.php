<?php

namespace JK\FacebookMessenger\Core\Configuration;

/**
 * Class AbstractConfiguration
 * @package JK\FacebookMessenger\Core\Configuration
 */
class AbstractConfiguration implements ConfigurationInterface
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
