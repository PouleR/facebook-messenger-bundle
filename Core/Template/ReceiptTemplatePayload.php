<?php

namespace PouleR\FacebookMessengerBundle\Core\Template;

use PouleR\FacebookMessengerBundle\Core\Payload\TemplatePayload;
use PouleR\FacebookMessengerBundle\Core\Entity\Address;
use PouleR\FacebookMessengerBundle\Core\Entity\Summary;

/**
 * Class ReceiptTemplatePayload
 * @package PouleR\FacebookMessengerBundle\Core\Template
 */
class ReceiptTemplatePayload extends TemplatePayload
{
    /**
     * @var string
     */
    protected $recipientName;

    /**
     * @var int
     */
    protected $orderNumber;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var string
     */
    protected $orderUrl;

    /**
     * @var string
     */
    protected $timestamp;

    /**
     * @var array
     */
    protected $elements = [];

    /**
     * @var Address
     */
    protected $address;

    /**
     * @var Summary
     */
    protected $summary;

    /**
     * @var array
     */
    protected $adjustments = [];

    /**
     * ReceiptTemplatePayload constructor.
     * @param string $recipientName
     * @param string $orderNumber
     * @param string $currency
     * @param string $orderUrl
     * @param string $timestamp
     * @param array $elements
     * @param Address|null $address
     * @param Summary|null $summary
     * @param array $adjustments
     */
    public function __construct($recipientName = '', $orderNumber = '', $currency = '', $orderUrl = '', $timestamp = '', $elements = [], Address $address = null, Summary $summary = null, $adjustments = [])
    {
        // Invoke parent constructor and force type value
        parent::__construct(TemplatePayload::TYPE_RECEIPT);

        // Set ReceiptTemplatePayload specific properties
        $this->recipientName = $recipientName;
        $this->orderNumber = $orderNumber;
        $this->currency = $currency;
        $this->orderUrl = $orderUrl;
        $this->timestamp = $timestamp;
        $this->elements = $elements;
        $this->address = $address;
        $this->summary = $summary;
        $this->adjustments = $adjustments;
    }

    /**
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * @param string $recipientName
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
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

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return string
     */
    public function getOrderUrl()
    {
        return $this->orderUrl;
    }

    /**
     * @param string $orderUrl
     */
    public function setOrderUrl($orderUrl)
    {
        $this->orderUrl = $orderUrl;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param array $elements
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @return Summary
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param Summary $summary
     */
    public function setSummary(Summary $summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return array
     */
    public function getAdjustments()
    {
        return $this->adjustments;
    }

    /**
     * @param array $adjustments
     */
    public function setAdjustments($adjustments)
    {
        $this->adjustments = $adjustments;
    }

}