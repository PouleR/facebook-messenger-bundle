<?php

namespace JK\FacebookMessenger\Core\Callback;

use JK\FacebookMessenger\Core\Attachment;
use JK\FacebookMessenger\Core\AttachmentInterface;

/**
 * Class MessageReceive
 * @package JK\FacebookMessenger\Core\Callback
 */
class MessageReceive
{
    /**
     * @var string
     */
    protected $mid;

    /**
     * @var int
     */
    protected $seq;

    /**
     * @var string|null
     */
    protected $text = null;

    /**
     * @var Attachment[]
     */
    protected $attachments = array();

    /**
     * @var \QuickReplyReceive
     */
    protected $quickReply = null;

    /**
     * @return string
     */
    public function getMid()
    {
        return $this->mid;
    }

    /**
     * @param string $mid
     */
    public function setMid($mid)
    {
        $this->mid = $mid;
    }

    /**
     * @return int
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * @param int $seq
     */
    public function setSeq($seq)
    {
        $this->seq = $seq;
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
     * @return \JK\FacebookMessenger\Core\Attachment[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param AttachmentInterface $attachment
     */
    public function addAttachment(AttachmentInterface $attachment)
    {
        $this->attachments[] = $attachment;
    }

    /**
     * @return \QuickReplyReceive
     */
    public function getQuickReply()
    {
        return $this->quickReply;
    }

    /**
     * @param \QuickReplyReceive $quickReply
     */
    public function setQuickReply($quickReply)
    {
        $this->quickReply = $quickReply;
    }
}
