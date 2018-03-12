<?php

namespace PouleR\FacebookMessengerBundle\Service;

use Facebook\Facebook;
use Facebook\FacebookBatchRequest;
use Facebook\FacebookResponse;
use GuzzleHttp\Client;
use PouleR\FacebookMessengerBundle\Client\Guzzle6HttpClient;
use PouleR\FacebookMessengerBundle\Core\Configuration\GetStartedConfiguration;
use PouleR\FacebookMessengerBundle\Core\Configuration\GreetingTextConfiguration;
use PouleR\FacebookMessengerBundle\Core\Entity\Recipient;
use PouleR\FacebookMessengerBundle\Core\Message;
use PouleR\FacebookMessengerBundle\Exception\FacebookMessengerException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class FacebookMessengerService
 */
class FacebookMessengerService
{
    const VERIFY_KEY_HUB_MODE = 'hub_mode';
    const VERIFY_KEY_TOKEN = 'hub_verify_token';
    const VERIFY_KEY_HUB_CHALLENGE = 'hub_challenge';
    const VERIFY_VAL_SUBSCRIBE = 'subscribe';

    const MSG_TYPE_RESPONSE = 'RESPONSE';
    const MSG_TYPE_UPDATE = 'UPDATE';
    const MSG_TYPE_MESSAGE_TAG = 'MESSAGE_TAG';

    const MAX_BATCH_REQUESTS = 50;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Facebook
     */
    protected $facebookSDK;

    /**
     * @var FacebookBatchRequest
     */
    protected $batchRequest;

    /**
     * @var int
     */
    protected $batchRequestCount = 0;

    /**
     * FacebookMessengerService constructor.
     *
     * @param string|int      $appId
     * @param string|int      $appSecret
     * @param LoggerInterface $logger
     * @param Client|null     $client
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function __construct($appId = '', $appSecret = '', LoggerInterface $logger, Client $client = null)
    {
        if (!$client) {
            $client = new Client();
        }

        $this->logger = $logger;
        $this->facebookSDK = new Facebook([
            'http_client_handler' => new Guzzle6HttpClient($client),
            'app_id' => $appId,
            'app_secret' => $appSecret,
        ]);
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
     * @param string    $type
     *
     * @return array
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function postMessage(Recipient $recipient, Message $message, $type = self::MSG_TYPE_RESPONSE)
    {
        $request = $this->createMessageRequest($recipient, $message, $type);
        $response = $this->facebookSDK->getClient()->sendRequest($request);

        return $response->getDecodedBody();
    }

    /**
     * https://developers.facebook.com/docs/graph-api/making-multiple-requests
     *
     * @param Recipient $recipient
     * @param Message   $message
     * @param string    $type
     *
     * @return boolean
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function addMessageToBatch(Recipient $recipient, Message $message, $type = self::MSG_TYPE_RESPONSE)
    {
        if (!$this->batchRequest) {
            $this->batchRequest = new FacebookBatchRequest(
                $this->facebookSDK->getApp(),
                [],
                $this->accessToken
            );

            $this->logger->debug('Create new batch request');
        }

        if ($this->batchRequestCount >= (self::MAX_BATCH_REQUESTS - 1)) {
            return false;
        }

        ++$this->batchRequestCount;
        $request = $this->createMessageRequest($recipient, $message, $type);
        $requestName = sprintf(
            'message_%s_%d',
            $recipient->getId(),
            $this->batchRequestCount
        );

        $this->batchRequest->add($request, [
            'name' => $requestName,
        ]);

        $this->logger->debug('Added request to batch', ['name' => $requestName]);

        return true;
    }

    /**
     * @throws FacebookMessengerException
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function sendBatchRequests()
    {
        if (!$this->batchRequest instanceof FacebookBatchRequest) {
            throw new FacebookMessengerException('Invalid batch request');
        }

        $failedRequests = [];
        $responses = $this->facebookSDK->getClient()->sendBatchRequest($this->batchRequest);

        /**
         * @var string           $key
         * @var FacebookResponse $response
         */
        foreach ($responses as $key => $response) {
            if ($response->isError()) {
                $failedRequests[$key] = $response->getHttpStatusCode();
            }
        }

        $this->batchRequestCount = 0;

        return $failedRequests;
    }

    /**
     * https://developers.facebook.com/docs/messenger-platform/identity/user-profile#request
     *
     * @param int|string $id
     * @param array      $fields
     *
     * @return array
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getUser($id, array $fields = ['first_name', 'last_name'])
    {
        $endPoint = sprintf('/%s?fields=%s', $id, implode($fields, ','));
        $response = $this->facebookSDK->get($endPoint, $this->accessToken);

        return $response->getDecodedBody();
    }

    /**
     * https://developers.facebook.com/docs/messenger-platform/identity/account-linking
     *
     * @param string $linkingToken
     *
     * @return array
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function getPsid($linkingToken)
    {
        $params = [
            'fields' => 'recipient',
            'account_linking_token' => $linkingToken,
        ];

        $endPoint = sprintf('/me?%s', http_build_query($params));
        $response = $this->facebookSDK->get($endPoint, $this->accessToken);

        return $response->getDecodedBody();
    }

    /**
     * https://developers.facebook.com/docs/messenger-platform/identity/account-linking#unlink
     *
     * @param int|string $psid
     *
     * @return array
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function unlinkAccount($psid)
    {
        $params = [
            'psid' => $psid,
        ];

        $response = $this->facebookSDK->post('/me/unlink_accounts', $params, $this->accessToken);

        return $response->getDecodedBody();
    }

    /**
     * https://developers.facebook.com/docs/messenger-platform/reference/messenger-profile-api
     *
     * @param GreetingTextConfiguration $configuration
     *
     * @return array
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function setGreetingText(GreetingTextConfiguration $configuration)
    {
        $serializer = $this->getSerializer(['settingType']);

        $params = [
            $configuration->getSettingType() => [$serializer->serialize($configuration, 'json')],
            ];

        $response = $this->facebookSDK->post('/me/messenger_profile', $params, $this->accessToken);

        return $response->getDecodedBody();
    }

    /**
     * https://developers.facebook.com/docs/messenger-platform/reference/messenger-profile-api
     *
     * @param GetStartedConfiguration $configuration
     *
     * @return array
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function setGetStarted(GetStartedConfiguration $configuration)
    {
        $serializer = $this->getSerializer(['settingType']);

        $params = [
            $configuration->getSettingType() => $serializer->serialize($configuration, 'json'),
        ];

        $response = $this->facebookSDK->post('/me/messenger_profile', $params, $this->accessToken);

        return $response->getDecodedBody();
    }

    /**
     * Handle a verification token request, check against the given verificationToken.
     * Throw an exception when the token is invalid, or return null when the request isn't a verification request.
     *
     * @param Request $request
     * @param string  $verificationToken
     *
     * @return string|null
     *
     * @throws FacebookMessengerException
     */
    public function handleVerificationToken(Request $request, $verificationToken)
    {
        if (!empty($request->get(self::VERIFY_KEY_HUB_MODE))) {
            if ($request->get(self::VERIFY_KEY_HUB_MODE) === self::VERIFY_VAL_SUBSCRIBE &&
                $request->get(self::VERIFY_KEY_TOKEN) === $verificationToken) {
                return $request->get(self::VERIFY_KEY_HUB_CHALLENGE);
            }

            throw new FacebookMessengerException('Invalid verification token');
        }

        return null;
    }

    /**
     * @param Recipient $recipient
     * @param Message   $message
     * @param string    $type
     *
     * @return \Facebook\FacebookRequest
     *
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    private function createMessageRequest(Recipient $recipient, Message $message, $type = self::MSG_TYPE_RESPONSE)
    {
        $serializer = $this->getSerializer();

        $params = [
            'recipient' => $serializer->serialize($recipient, 'json'),
            'message' => $serializer->serialize($message, 'json'),
            'type' => $type,
        ];

        return $this->facebookSDK->request('POST', '/me/messages', $params, $this->accessToken);
    }

    /**
     * @param array $ignoredAttributes
     *
     * @return Serializer
     */
    private function getSerializer($ignoredAttributes = [])
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        $normalizer->setIgnoredAttributes($ignoredAttributes);
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        return $serializer;
    }
}
