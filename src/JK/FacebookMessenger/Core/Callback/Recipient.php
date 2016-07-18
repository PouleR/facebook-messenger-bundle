<?php

namespace JK\FacebookMessenger\Core\Callback;

/**
 * Class Recipient
 * @package JK\FacebookMessenger\Core\Callback
 */
class Recipient
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
