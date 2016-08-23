<?php

namespace PouleR\FacebookMessengerBundle\Core\Callback;

/**
 * Class PostbackCallback.
 */
class PostbackCallback extends Callback
{
    /**
     * @var PostbackPayloadReceive
     */
    protected $postback;

    /**
     * @return PostbackPayloadReceive
     */
    public function getPostback()
    {
        return $this->postback;
    }

    /**
     * @param PostbackPayloadReceive $postback
     */
    public function setPostback($postback)
    {
        $this->postback = $postback;
    }
}
