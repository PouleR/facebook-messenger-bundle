<?php

namespace JK\FacebookMessenger\Core;

/**
 * Interface ElementInterface
 * @package JK\FacebookMessenger\Core
 */
interface ElementInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param $title
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getSubtitle();

    /**
     * @param $subtitle
     */
    public function setSubtitle($subtitle);

    /**
     * @return string
     */
    public function getImageUrl();

    /**
     * @param $imageUrl
     */
    public function setImageUrl($imageUrl);
}