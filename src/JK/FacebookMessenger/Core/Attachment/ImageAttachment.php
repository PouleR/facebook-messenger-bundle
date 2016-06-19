<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/14
 * Time: 9:46 AM
 */

namespace JK\FacebookMessenger\Core\Attachment;

use JK\FacebookMessenger\Core\Attachment;

/**
 * Class ImageAttachment
 * @package JK\FacebookMessenger\Core\Attachment
 */
class ImageAttachment extends Attachment
{
    /**
     * ImageAttachment constructor.
     * @param $payload
     */
    public function __construct($payload = null)
    {
        // Invoke parent constructor and force type value
        parent::__construct(Attachment::TYPE_IMAGE, $payload);
    }
}