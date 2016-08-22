<?php

namespace PouleR\FacebookMessengerBundle\Core\Callback;

/**
 * Class RecipientCallback
 * @package PouleR\FacebookMessengerBundle\Core\Callback
 */
class RecipientCallback
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
