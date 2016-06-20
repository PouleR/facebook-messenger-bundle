<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/20
 * Time: 1:18 PM
 */

namespace JK\FacebookMessenger\Core\Configuration;

/**
 * Class Configuration
 * @package JK\FacebookMessenger\Core
 */
class Configuration
{
    /**
     * @var string
     */
    protected $settingType;

    /**
     * @var string
     */
    protected $threadState;

    /**
     * @var array
     */
    protected $callToActions;

    /**
     * Configuration constructor.
     * @param string $settingType
     * @param string $threadState
     * @param array $callToActions
     */
    public function __construct($settingType = 'call_to_actions', $threadState = 'new_thread', array $callToActions = [])
    {
        $this->settingType = $settingType;
        $this->threadState = $threadState;
        $this->callToActions = $callToActions;
    }

    /**
     * @return string
     */
    public function getSettingType()
    {
        return $this->settingType;
    }

    /**
     * @param string $settingType
     */
    public function setSettingType($settingType)
    {
        $this->settingType = $settingType;
    }

    /**
     * @return string
     */
    public function getThreadState()
    {
        return $this->threadState;
    }

    /**
     * @param string $threadState
     */
    public function setThreadState($threadState)
    {
        $this->threadState = $threadState;
    }

    /**
     * @return array
     */
    public function getCallToActions()
    {
        return $this->callToActions;
    }

    /**
     * @param array $callToActions
     */
    public function setCallToActions($callToActions)
    {
        $this->callToActions = $callToActions;
    }
}