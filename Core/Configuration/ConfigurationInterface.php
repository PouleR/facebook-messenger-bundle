<?php

namespace PouleR\FacebookMessengerBundle\Core\Configuration;

/**
 * Interface ConfigurationInterface
 * @package PouleR\FacebookMessengerBundle\Core\Configuration
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
