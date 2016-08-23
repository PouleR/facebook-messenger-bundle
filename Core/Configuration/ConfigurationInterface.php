<?php

namespace PouleR\FacebookMessengerBundle\Core\Configuration;

/**
 * Interface ConfigurationInterface.
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
