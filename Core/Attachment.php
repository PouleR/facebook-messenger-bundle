<?php

namespace PouleR\FacebookMessengerBundle\Core;

/**
 * Class Attachment.
 */
abstract class Attachment implements AttachmentInterface
{
    const TYPE_IMAGE = 'image';
    const TYPE_TEMPLATE = 'template';
    const TYPE_AUDIO = 'audio';
    const TYPE_VIDEO = 'video';
    const TYPE_FILE = 'file';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $payload;

    /**
     * Attachment constructor.
     *
     * @param $type
     * @param $payload
     */
    public function __construct($type, $payload)
    {
        $this->type = $type;
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }
}
