<?php

namespace JK\FacebookMessenger\Core\Entity;

/**
 * Class Adjustment
 * @package JK\FacebookMessenger\Core\Entity
 */
class Adjustment
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @param $name
     * @param $amount
     */
    public function _construct($name, $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

}