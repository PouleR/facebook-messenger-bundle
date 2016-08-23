<?php

namespace PouleR\FacebookMessengerBundle\Service;

/**
 * Interface CurlInterface.
 */
interface CurlInterface
{
    /**
     * @param string $url
     * @param string $content
     *
     * @return mixed
     */
    public function post($url, $content);

    /**
     * @param string $url
     * @param array  $params
     *
     * @return mixed
     */
    public function get($url, array $params);
}
