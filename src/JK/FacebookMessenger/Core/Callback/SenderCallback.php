<?php

namespace JK\FacebookMessenger\Core\Callback;

/**
 * Class SenderCallback
 * @package JK\FacebookMessenger\Core\Callback
 */
class SenderCallback
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
