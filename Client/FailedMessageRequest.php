<?php

namespace PouleR\FacebookMessengerBundle\Client;

/**
 * Class FailedMessageRequest
 */
class FailedMessageRequest
{
    /**
     * @var string|int|null
     */
    protected $psid;

    /**
     * @var int
     */
    protected $responseCode;

    /**
     * @var mixed
     */
    protected $responseBody;

    /**
     * FailedRequest constructor.
     * @param int   $code
     * @param mixed $body
     */
    public function __construct($code, $body)
    {
        $this->setResponseCode($code);
        $this->setResponseBody($body);
    }

    /**
     * @return int|null|string
     */
    public function getPsid()
    {
        return $this->psid;
    }

    /**
     * @param int|null|string $psid
     */
    public function setPsid($psid)
    {
        $this->psid = $psid;
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @param int $responseCode
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }

    /**
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @param mixed $responseBody
     */
    public function setResponseBody($responseBody)
    {
        $this->responseBody = $responseBody;
    }
}
