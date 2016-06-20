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

/**
 * Class MessengerApi
 * @package JK\FacebookMessenger\Api
 */
class MessengerApi
{
    const FB_API_URL = 'https://graph.facebook.com/v2.6';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var array
     */
    protected $encoders;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var array
     */
    protected $normalizers;

    /**
     * MessengerApi constructor.
     * @param string $token
     */
    public function __construct($token = '')
    {
        $this->encoders = [new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);

        $this->token = $token;
    }

    /**
     * @param Recipient $recipient
     * @param Message $message
     * @return mixed
     */
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
        return json_decode($curl->post($url, $content), true);
    }

    /**
     * @param $id
     * @param array $fields
     * @return mixed
     */
    public function getUser($id, array $fields = ['first_name', 'last_name'])
    {
        // Init curl
        $curl = new Curl();

        // Build the URL
        $url = self::FB_API_URL . '/' . $id;

        // Add some params
        $params = [
            'fields' => implode($fields, ','),
            'access_token' => $this->token
        ];

        // Do the call and return the JSON response
        return json_decode($curl->get($url, $params), true);
    }

}