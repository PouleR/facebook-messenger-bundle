<?php

namespace JK\FacebookMessenger\Core;

use JK\FacebookMessenger\Core\QuickReply\QuickReplies;

/**
 * Class QuickReply
 * @package JK\FacebookMessenger\Core
 */
class QuickReply extends Message
{
    /** @var QuickReplies[] */
    protected $quickReplies = array();

    /**
     * @return mixed
     */
    public function getQuickReplies()
    {
        return $this->quickReplies;
    }

    /**
     * @param mixed $quickReplies
     */
    public function addQuickReplies($quickReplies)
    {
        $this->quickReplies[] = $quickReplies;
    }
}
