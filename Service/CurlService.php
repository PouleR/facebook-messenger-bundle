<?php

namespace PouleR\FacebookMessengerBundle\Service;

/**
 * Class CurlService.
 */
class CurlService implements CurlInterface
{
    /**
     * @var resource
     */
    protected $ch;

    /**
     * @var array
     */
    protected $headers = array('Content-Type: application/json');

    /**
     * CurlService constructor.
     */
    public function __construct()
    {
        $this->ch = curl_init();

        // Set default ops
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
    }

    /**
     * {@inheritdoc}
     */
    public function post($url, $content)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $content);

        return curl_exec($this->ch);
    }

    /**
     * {@inheritdoc}
     */
    public function get($url, array $params)
    {
        $url .= '?'.http_build_query($params);

        curl_setopt($this->ch, CURLOPT_URL, $url);

        return curl_exec($this->ch);
    }

    /**
     * Close CURL.
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }
}
