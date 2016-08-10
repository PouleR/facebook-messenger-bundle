<?php

namespace JK\FacebookMessenger\Core;

/**
 * Interface ButtonInterface
 * @package JK\FacebookMessenger\Core
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