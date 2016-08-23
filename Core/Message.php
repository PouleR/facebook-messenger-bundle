<?php

namespace PouleR\FacebookMessengerBundle\Core;

/**
 * Class Message.
 */
class Message
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var Attachment
     */
    protected $attachment;

    /**
     * Message constructor.
     *
     * @param string                   $text
     * @param AttachmentInterface|null $attachment
     */
    public function __construct($text = '', AttachmentInterface $attachment = null)
    {
        $this->text = $text;
        $this->attachment = $attachment;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return AttachmentInterface
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param AttachmentInterface $attachment
     */
    public function setAttachment(AttachmentInterface $attachment)
    {
        $this->attachment = $attachment;
    }
}
