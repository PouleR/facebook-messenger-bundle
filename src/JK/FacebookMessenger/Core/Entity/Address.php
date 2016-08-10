<?php

namespace JK\FacebookMessenger\Core\Entity;

/**
 * Class Address
 * @package JK\FacebookMessenger\Core\Entity
 */
class Address
{
    /**
     * @var string
     */
    protected $street1;

    /**
     * @var string
     */
    protected $street2;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $country;

    /**
     * Address constructor.
     * @param $street1
     * @param $street2
     * @param $city
     * @param $postalCode
     * @param $state
     * @param $country
     */
    public function __construct($street1 = '', $street2 = '', $city = '', $postalCode = '', $state = '', $country = '')
    {
        $this->street1 = $street1;
        $this->street2 = $street2;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->state = $state;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getStreet1()
    {
        return $this->street1;
    }

    /**
     * @param string $street1
     */
    public function setStreet1($street1)
    {
        $this->street1 = $street1;
    }

    /**
     * @return string
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * @param string $street2
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

}