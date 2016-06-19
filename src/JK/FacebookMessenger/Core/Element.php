<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/14
 * Time: 12:05 PM
 */

namespace JK\FacebookMessenger\Core;

/**
 * Class Element
 * @package JK\FacebookMessenger\Core
 */
abstract class Element implements ElementInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $subtitle;

    /**
     * @var string
     */
    protected $imageUrl;

    /**
     * Element constructor.
     * @param $title
     * @param $subtitle
     * @param $imageUrl
     */
    public function __construct($title, $subtitle, $imageUrl)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }
}