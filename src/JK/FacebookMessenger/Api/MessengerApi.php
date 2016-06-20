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
use JK\FacebookMessenger\Curl\Curl;
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

    public function sendMessage(Recipient $recipient, Message $message)
    {

        // Init curl
        $curl = new Curl();

        // Build the URL
        $url = self::FB_API_URL . '/me/messages';

        // Serialize the content
        $content = $this->serializer->serialize([
                'recipient' => $recipient,
                'message' => $message,
                'access_token' => $this->token
            ], 'json');

        // Do the call and return the JSON response
        return $curl->post($url, $content);
    }

    public function getUser($id, array $fields = ['first_name', 'last_name'])
    {
        $curl = new Curl();

        $url = self::FB_API_URL . '/' . $id;

        $params = [
            'fields' => implode($fields, ','),
            'access_token' => $this->token
        ];

        return $curl->get($url, $params);
    }

}