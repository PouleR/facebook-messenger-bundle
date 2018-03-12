<?php

namespace PouleR\FacebookMessengerBundle\Client;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Http\GraphRawResponse;
use Facebook\HttpClients\FacebookHttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

/**
 * Class Guzzle6HttpClient
 *
 * Implementation from https://www.sammyk.me/how-to-inject-your-own-http-client-in-the-facebook-php-sdk-v5#writing-a-guzzle-6-http-client-implementation-from-scratch
 */
class Guzzle6HttpClient implements FacebookHttpClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Guzzle6HttpClient constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     * @param string $method
     * @param string $body
     * @param array  $headers
     * @param int    $timeOut
     *
     * @return GraphRawResponse
     *
     * @throws FacebookSDKException
     */
    public function send($url, $method, $body, array $headers, $timeOut)
    {
        $request = new Request($method, $url, $headers, $body);

        try {
            $response = $this->client->send($request, [
                'timeout' => $timeOut,
                'http_errors' => false,
                ]);
        } catch (RequestException $e) {
            throw new FacebookSDKException($e->getMessage(), $e->getCode());
        }

        $httpStatusCode = $response->getStatusCode();
        $responseHeaders = $response->getHeaders();

        foreach ($responseHeaders as $key => $values) {
            $responseHeaders[$key] = implode(', ', $values);
        }

        $responseBody = $response->getBody()->getContents();

        return new GraphRawResponse(
            $responseHeaders,
            $responseBody,
            $httpStatusCode);
    }
}
