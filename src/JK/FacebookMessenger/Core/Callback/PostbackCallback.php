<?php

namespace JK\FacebookMessenger\Core\Callback;

/**
 * Class PostbackCallback
 * @package JK\FacebookMessenger\Core\Callback
 */
class PostbackCallback extends Callback
{
    /**
     * @var PostbackReceive
     */
    protected $postback;

    /**
     * @return PostbackReceive
     */
    public function getPostback()
    {
        return $this->postback;
    }

    /**
     * @param PostbackReceive $postback
     */
    public function setPostback($postback)
    {
        $this->postback = $postback;
    }
}
