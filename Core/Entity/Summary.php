<?php

namespace PouleR\FacebookMessengerBundle\Core\Entity;

/**
 * Class Summary
 * @package PouleR\FacebookMessengerBundle\Core\Entity
 */
class Summary
{
    /**
     * @var int
     */
    protected $subtotal;

    /**
     * @var int
     */
    protected $shippingCost;

    /**
     * @var int
     */
    protected $totalTax;

    /**
     * @var int
     */
    protected $totalCost;

    /**
     * Summary constructor.
     * @param int $subtotal
     * @param int $shippingCost
     * @param int $totalTax
     * @param int $totalCost
     */
    public function __construct($subtotal = 0, $shippingCost = 0, $totalTax = 0, $totalCost = 0)
    {
        $this->subtotal = $subtotal;
        $this->shippingCost = $shippingCost;
        $this->totalTax = $totalTax;
        $this->totalCost = $totalCost;
    }

    /**
     * @return int
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @param int $subtotal
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    /**
     * @return int
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * @param int $shippingCost
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;
    }

    /**
     * @return int
     */
    public function getTotalTax()
    {
        return $this->totalTax;
    }

    /**
     * @param int $totalTax
     */
    public function setTotalTax($totalTax)
    {
        $this->totalTax = $totalTax;
    }

    /**
     * @return int
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @param int $totalCost
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;
    }

}