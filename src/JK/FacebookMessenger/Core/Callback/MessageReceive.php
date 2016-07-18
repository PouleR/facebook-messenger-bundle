<?php

namespace JK\FacebookMessenger\Core\Callback;

use JK\FacebookMessenger\Core\Message;

/**
 * Class MessageReceive
 * @package JK\FacebookMessenger\Core\Callback
 */
class MessageReceive extends Message
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
}
