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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MessengerApi
{
    const FB_API_URL = 'https://graph.facebook.com/v2.6';

    protected $token;

    protected $encoders;

    protected $serializer;

    protected $normalizers;

    public function __construct($token = '')
    {
        $this->encoders = [new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);

        $this->token = $token;
    }

    public function send(Recipient $recipient, Message $message, $path = '/me/messages')
    {

        // Build the URL
        $url = self::FB_API_URL . $path;

        // Serialize the content
        $content = $this->serializer->serialize(
            [
                'recipient' => $recipient,
                'message' => $message,
                'access_token' => $this->token
            ],
            'json');

        // Initialize Curl and set options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        // Make the call
        $response  = curl_exec($ch);

        // Close the resource
        curl_close($ch);

        // Decode and return the JSON response
        return json_decode($response, true);
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

}