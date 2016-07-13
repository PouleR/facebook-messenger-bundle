<?php

namespace JK\FacebookMessenger\Core\Attachment;

use JK\FacebookMessenger\Core\Attachment;

/**
 * Class FileAttachment
 * @package JK\FacebookMessenger\Core\Attachment
 */
class FileAttachment extends Attachment
{
    /**
     * FileAttachment constructor.
     * @param $payload
     */
    public function __construct($payload = null)
    {
        // Invoke parent constructor and force type value
        parent::__construct(Attachment::TYPE_FILE, $payload);
    }
}