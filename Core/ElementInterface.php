<?php

namespace PouleR\FacebookMessengerBundle\Core;

/**
 * Interface ElementInterface.
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
