<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/16
 * Time: 3:37 PM
 */

namespace JK\FacebookMessenger\Api;

use JK\FacebookMessenger\Core\Entity\Recipient;
use JK\FacebookMessenger\Core\Message;

class MessengerApi
{

    protected $token;

    public function __construct($token = '')
    {
        $this->token = $token;
    }

    public function send(Recipient $recipient, Message $message)
    {



    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    private function serialize()
    {

    }

}