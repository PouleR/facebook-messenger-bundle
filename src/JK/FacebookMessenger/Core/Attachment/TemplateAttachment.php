<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/14
 * Time: 10:01 AM
 */

namespace JK\FacebookMessenger\Core\Attachment;

use JK\FacebookMessenger\Core\Attachment;

/**
 * Class TemplateAttachment
 * @package JK\FacebookMessenger\Core\Attachment
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