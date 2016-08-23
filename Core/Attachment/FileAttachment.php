<?php

namespace PouleR\FacebookMessengerBundle\Core\Attachment;

use PouleR\FacebookMessengerBundle\Core\Attachment;

/**
 * Class FileAttachment.
 */
class FileAttachment extends Attachment
{
    /**
     * FileAttachment constructor.
     *
     * @param $payload
     */
    public function __construct($payload = null)
    {
        // Invoke parent constructor and force type value
        parent::__construct(Attachment::TYPE_FILE, $payload);
    }
}
