<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016/06/13
 * Time: 2:10 PM
 */

namespace JK\FacebookMessenger\Core;

use JK\FacebookMessenger\Core\Attachment;
use JK\FacebookMessenger\Core\Entity\Recipient;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

/**
 * Class Message
 * @package JK\FacebookMessenger\Core
 */
class Message implements \JsonSerializable
{
    
    /**
     * @var array
     */
    private $encoders;

    /**
     * @var array
     */
    private $normalizers;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var Attachment
     */
    protected $attachment;

    /**
     * Message constructor.
     * @param string $text
     * @param AttachmentInterface|null $attachment
     */
    public function __construct($text = '', AttachmentInterface $attachment = null)
    {
        $this->encoders = array(new JsonEncoder());
        $this->normalizers = array(new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter()));
        $this->serializer = new Serializer($this->normalizers, $this->encoders);

        $this->text = $text;
        $this->attachment = $attachment;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return AttachmentInterface
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param AttachmentInterface $attachment
     */
    public function setAttachment(AttachmentInterface $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        $recipient = new Recipient(1103144033090957);

        return $this->serializer->serialize(['message' => $this, 'recipient' => $recipient], 'json');
    }
}