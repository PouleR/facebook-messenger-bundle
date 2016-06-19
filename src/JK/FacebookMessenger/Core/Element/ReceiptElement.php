<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/15
 * Time: 11:21 AM
 */

namespace JK\FacebookMessenger\Core\Element;

use JK\FacebookMessenger\Core\Element;

/**
 * Class ReceiptElement
 * @package JK\FacebookMessenger\Element
 */
class ReceiptElement extends Element
{
    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var string
     */
    protected $currency;

    /**
     * ReceiptElement constructor.
     * @param string $title
     * @param string $subtitle
     * @param string $imageUrl
     * @param int $quantity
     * @param int $price
     */
    public function __construct($title = '', $subtitle = '', $imageUrl = '', $quantity = 0, $price = 0)
    {
        // Invoke parent constructor
        parent::__construct($title, $subtitle, $imageUrl);

        // Set ReceiptElement specific property values
        $this->quantity = $quantity;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

}