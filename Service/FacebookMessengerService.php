<?php

namespace PouleR\FacebookMessengerBundle\Service;

use PouleR\FacebookMessengerBundle\Core\Configuration\ConfigurationInterface;
use PouleR\FacebookMessengerBundle\Core\Entity\Recipient;
use PouleR\FacebookMessengerBundle\Core\Message;
use PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class MessengerApi.
 */
class FacebookMessengerService
{
    const FB_API_URL = 'https://graph.facebook.com/v2.6';

    /**
     * @var string
     */
    protected $accessToken;

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
     * @var CurlInterface
     */
    protected $curlService;

    /**
     * FacebookMessengerService constructor.
     *
     * @param CurlInterface $curlService
     */
    public function __construct(CurlInterface $curlService)
    {
        $this->encoders = [new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
        $this->curlService = $curlService;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param Recipient $recipient
     * @param Message   $message
     *
     * @throws FacebookMessengerException
     *
     * @return mixed
     */
    public function postMessage(Recipient $recipient, Message $message)
    {
        $this->checkAccessToken();

        // Build the URL
        $url = self::FB_API_URL.'/me/messages';

        // Serialize the content
        $content = $this->serializer->serialize([
                'recipient' => $recipient,
                'message' => $message,
                'access_token' => $this->accessToken,
            ], 'json');

        // Do the call and return the JSON response
        return json_decode($this->curlService->post($url, $content), true);
    }

    /**
     * @param ConfigurationInterface $configuration
     *
     * @throws FacebookMessengerException
     *
     * @return mixed
     */
    public function postConfiguration(ConfigurationInterface $configuration)
    {
        $this->checkAccessToken();

        $params = [
            'access_token' => $this->accessToken,
        ];

        // Build the URL
        $url = self::FB_API_URL.'/me/thread_settings?'.http_build_query($params);

        // Serialize the content
        $content = $this->serializer->serialize($configuration, 'json');

        // Do the call and return the JSON response
        return json_decode($this->curlService->post($url, $content), true);
    }

    /**
     * @param $id
     * @param array $fields
     *
     * @throws FacebookMessengerException
     *
     * @return mixed
     */
    public function getUser($id, array $fields = ['first_name', 'last_name'])
    {
        $this->checkAccessToken();

        // Build the URL
        $url = self::FB_API_URL.'/'.$id;

        // Add some params
        $params = [
            'fields' => implode($fields, ','),
            'access_token' => $this->accessToken,
        ];

        // Do the call and return the JSON response
        return json_decode($this->curlService->get($url, $params), true);
    }

    /**
     * @throws FacebookMessengerException
     */
    private function checkAccessToken()
    {
        if (empty($this->accessToken)) {
            throw new FacebookMessengerException('The access token must be set.');
        }
    }
}
