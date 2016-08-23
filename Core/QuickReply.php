<?php

namespace PouleR\FacebookMessengerBundle\Core;

use PouleR\FacebookMessengerBundle\Core\QuickReply\QuickReplies;

/**
 * Class QuickReply.
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
