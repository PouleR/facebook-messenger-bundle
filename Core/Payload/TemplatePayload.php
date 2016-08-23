<?php

namespace PouleR\FacebookMessengerBundle\Core\Payload;

use PouleR\FacebookMessengerBundle\Core\Payload;

/**
 * Class TemplatePayload.
 */
abstract class TemplatePayload extends Payload
{
    const TYPE_GENERIC = 'generic';
    const TYPE_BUTTON = 'button';
    const TYPE_RECEIPT = 'receipt';

    /**
     * @var string
     */
    protected $templateType;

    /**
     * TemplatePayload constructor.
     *
     * @param $templateType
     */
    public function __construct($templateType)
    {
        $this->templateType = $templateType;
    }

    /**
     * @return string
     */
    public function getTemplateType()
    {
        return $this->templateType;
    }

    /**
     * @param string $templateType
     */
    public function setTemplateType($templateType)
    {
        $this->templateType = $templateType;
    }
}
