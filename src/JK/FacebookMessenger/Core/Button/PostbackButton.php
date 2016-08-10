<?php

namespace JK\FacebookMessenger\Core\Button;

use JK\FacebookMessenger\Core\Button;

/**
 * Class PostbackButton
 * @package JK\FacebookMessenger\Core\Button
 */
class PostbackButton extends Button
{

    /**
     * @var mixed
     */
    protected $payload;

    /**
     * PostbackButton constructor.
     * @param string $title
     * @param string $payload
     */
    public function __construct($title = '', $payload = '')
    {
        // Invoke parent constructor and force type value
        parent::__construct(Button::TYPE_POSTBACK, $title);

        // Set PostbackButton specific property values
        $this->payload = $payload;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

}