<?php

namespace PouleR\FacebookMessengerBundle\Core\Template;

use PouleR\FacebookMessengerBundle\Core\Payload\TemplatePayload;

/**
 * Class ButtonTemplatePayload.
 */
class ButtonTemplatePayload extends TemplatePayload
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var array
     */
    protected $buttons = [];

    /**
     * ButtonTemplatePayload constructor.
     *
     * @param string $text
     * @param array  $buttons
     */
    public function __construct($text = '', $buttons = [])
    {
        // Invoke parent constructor and force type value
        parent::__construct(TemplatePayload::TYPE_BUTTON);

        // Set ButtonTemplatePayload specific properties
        $this->text = $text;
        $this->buttons = $buttons;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * @param array $buttons
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;
    }
}
