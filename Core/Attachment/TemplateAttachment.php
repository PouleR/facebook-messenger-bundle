<?php

namespace PouleR\FacebookMessengerBundle\Core\Attachment;

use PouleR\FacebookMessengerBundle\Core\Attachment;

/**
 * Class TemplateAttachment
 * @package PouleR\FacebookMessengerBundle\Core\Attachment
 */
class TemplateAttachment extends Attachment
{
    /**
     * TemplateAttachment constructor.
     * @param null $payload
     */
    public function __construct($payload = null)
    {
        // Invoke parent constructor and force type value
        parent::__construct(Attachment::TYPE_TEMPLATE, $payload);
    }
}