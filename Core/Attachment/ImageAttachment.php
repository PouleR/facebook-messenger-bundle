<?php

namespace PouleR\FacebookMessengerBundle\Core\Attachment;

use PouleR\FacebookMessengerBundle\Core\Attachment;

/**
 * Class ImageAttachment.
 */
class ImageAttachment extends Attachment
{
    /**
     * ImageAttachment constructor.
     *
     * @param $payload
     */
    public function __construct($payload = null)
    {
        // Invoke parent constructor and force type value
        parent::__construct(Attachment::TYPE_IMAGE, $payload);
    }
}
