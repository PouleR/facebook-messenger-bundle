<?php

namespace PouleR\FacebookMessengerBundle\Core;

/**
 * Interface ButtonInterface.
 */
interface ButtonInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     */
    public function setTitle($title);
}
