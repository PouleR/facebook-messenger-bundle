<?php

namespace JK\FacebookMessenger\Core\Attachment;

use JK\FacebookMessenger\Core\Attachment;

/**
 * Class AudioAttachment
 * @package JK\FacebookMessenger\Core\Attachment
 */
class AudioAttachment extends Attachment
{
    /**
     * AudioAttachment constructor.
     * @param $payload
     */
    public function __construct($payload = null)
    {
        // Invoke parent constructor and force type value
        parent::__construct(Attachment::TYPE_AUDIO, $payload);
    }
}