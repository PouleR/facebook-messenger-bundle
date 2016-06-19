<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/14
 * Time: 8:56 AM
 */

namespace JK\FacebookMessenger\Core\Payload;

use JK\FacebookMessenger\Core\Payload;

/**
 * Class TemplatePayload
 * @package JK\FacebookMessenger\Core\Payload
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