<?php

namespace JK\FacebookMessenger\Curl;

/**
 * Class Curl
 * @package JK\FacebookMessenger\Curl
 */
class Curl
{
    /**
     * @var resource
     */
    protected $ch;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $headers;

    /**
     * Curl constructor.
     * @param null|string $url
     * @param array       $headers
     */
    public function __construct($url = null, $headers = ['Content-Type: application/json'])
    {
        // Initialize some stuff
        $this->ch = curl_init($url);
        $this->headers = $headers;

        // Set default ops
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
    }

    /**
     * @param string $url
     * @param string $content
     * @return mixed
     */
    public function post($url, $content)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $content);

        return curl_exec($this->ch);
    }

    /**
     * @param string $url
     * @param array  $params
     * @return mixed
     */
    public function get($url, array $params)
    {
        $url .= '?' . http_build_query($params);
        
        curl_setopt($this->ch, CURLOPT_URL, $url);

        return curl_exec($this->ch);
    }

    /**
     * Curl destructor
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }

}