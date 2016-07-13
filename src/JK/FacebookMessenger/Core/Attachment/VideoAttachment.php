<?php

namespace JK\FacebookMessenger\Core\Attachment;

use JK\FacebookMessenger\Core\Attachment;

/**
 * Class VideoAttachment
 * @package JK\FacebookMessenger\Core\Attachment
 */
class VideoAttachment extends Attachment
{
    /**
     * VideoAttachment constructor.
     * @param $payload
     */
    public function __construct($payload = null)
    {
        // Invoke parent constructor and force type value
        parent::__construct(Attachment::TYPE_VIDEO, $payload);
    }
}