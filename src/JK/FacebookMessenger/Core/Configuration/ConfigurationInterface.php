<?php

namespace JK\FacebookMessenger\Core\Configuration;

/**
 * Interface ConfigurationInterface
 * @package JK\FacebookMessenger\Core\Configuration
 */
interface ConfigurationInterface
{
    /**
     * @return string
     */
    public function getSettingType();

    /**
     * @param string $settingType
     */
    public function setSettingType($settingType);
}
