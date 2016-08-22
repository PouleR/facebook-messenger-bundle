<?php

namespace PouleR\FacebookMessengerBundle\Core\Entity;

/**
 * Class Recipient
 * @package PouleR\FacebookMessengerBundle\Core\Entity
 */
class Recipient
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var mixed
     */
    protected $phoneNumber;

    /**
     * Recipient constructor.
     * @param $id
     * @param null $phoneNumber
     */
    public function __construct($id, $phoneNumber = null)
    {
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}