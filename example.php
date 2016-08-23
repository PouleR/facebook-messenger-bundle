<?php

namespace PouleR\FacebookMessengerBundle;

use PouleR\FacebookMessengerBundle\Core\Attachment\TemplateAttachment;
use PouleR\FacebookMessengerBundle\Core\Attachment\ImageAttachment;
use PouleR\FacebookMessengerBundle\Core\Button\PostbackButton;
use PouleR\FacebookMessengerBundle\Core\Button\WebUrlButton;
use PouleR\FacebookMessengerBundle\Core\Configuration\GetStartedConfiguration;
use PouleR\FacebookMessengerBundle\Core\Configuration\GreetingTextConfiguration;
use PouleR\FacebookMessengerBundle\Core\Element\GenericElement;
use PouleR\FacebookMessengerBundle\Core\Element\ReceiptElement;
use PouleR\FacebookMessengerBundle\Core\Entity\Address;
use PouleR\FacebookMessengerBundle\Core\Entity\Adjustment;
use PouleR\FacebookMessengerBundle\Core\Entity\Summary;
use PouleR\FacebookMessengerBundle\Core\Payload\MediaPayload;
use PouleR\FacebookMessengerBundle\Core\QuickReply;
use PouleR\FacebookMessengerBundle\Core\QuickReply\QuickReplies;
use PouleR\FacebookMessengerBundle\Core\Template\ButtonTemplatePayload;
use PouleR\FacebookMessengerBundle\Core\Template\GenericTemplatePayload;
use PouleR\FacebookMessengerBundle\Core\Template\ReceiptTemplatePayload;
use PouleR\FacebookMessengerBundle\Core\Message;

/**
 * Class Example.
 */
class example
{
    /**
     * @var array
     */
    protected $buttons = [];

    /**
     * Example constructor.
     */
    public function __construct()
    {
        // Set up a few buttons to be reused
        $pbButton = new PostbackButton();
        $pbButton->setTitle('Button Title Goes Here');
        $pbButton->setPayload('stuff');

        $wuButton = new WebUrlButton();
        $wuButton->setTitle('Button Title Goes Here');
        $wuButton->setUrl('https://www.google.com');

        $this->buttons = [$pbButton, $wuButton];
    }

    /**
     * @return GreetingTextConfiguration
     */
    public function generateGreetingTextConfiguration()
    {
        $configuration = new GreetingTextConfiguration();
        $configuration->setGreetingText('Welcome!');

        return $configuration;
    }

    /**
     * @return GetStartedConfiguration
     */
    public function generateGetStartedConfiguration()
    {
        $configuration = new GetStartedConfiguration();
        $configuration->setPayload('USER_DEFINED_PAYLOAD');

        return $configuration;
    }

    /**
     * @return Message
     *                 Generate a plain text message
     */
    public function generateTextMessage()
    {

        // Instantiate a new Message
        $message = new Message();

        // Set it's text
        $message->setText('This is a reply');

        return $message;
    }

    /**
     * @return Message
     *                 Generate a image message
     */
    public function generateImageMessage()
    {
        // Instantiate all the things
        $message = new Message();
        $imageAttachment = new ImageAttachment();
        $mediaPayload = new MediaPayload();

        // Set MediaPayload specific parameters
        $mediaPayload->setUrl('https://placekitten.com/200/300');

        // Set the Payload on the Attachment
        $imageAttachment->setPayload($mediaPayload);

        // Set the Attachment on the Payload
        $message->setAttachment($imageAttachment);

        return $message;
    }

    /**
     * @return Message
     *                 Generate a button message
     */
    public function generateButtonMessage()
    {
        // Instantiate all the things
        $message = new Message();
        $templateAttachment = new TemplateAttachment();
        $buttonTemplatePayload = new ButtonTemplatePayload();

        // Set the ButtonTemplate specific Payload parameters
        $buttonTemplatePayload->setText('Hey, check out these awesome buttons!');
        $buttonTemplatePayload->setButtons($this->buttons);

        // Set the Payload on the Attachment
        $templateAttachment->setPayload($buttonTemplatePayload);

        // Set the Attachment on the Message
        $message->setAttachment($templateAttachment);

        return $message;
    }

    /**
     * @return Message
     *                 Generate a generic message
     */
    public function generateGenericMessage()
    {
        // Instantiate all the things
        $message = new Message();
        $templateAttachment = new TemplateAttachment();
        $genericTemplatePayload = new GenericTemplatePayload();

        // Create up a few elements
        $genericElementOne = new GenericElement();
        $genericElementOne->setTitle('Element Title Goes Here');
        $genericElementOne->setImageUrl('https://placekitten.com/200/300');
        $genericElementOne->setSubtitle('Subtitle Goes Here');
        $genericElementOne->setButtons($this->buttons);

        $genericElementTwo = new GenericElement();
        $genericElementTwo->setTitle('Element Title Goes Here');
        $genericElementTwo->setImageUrl('https://placekitten.com/200/300');
        $genericElementTwo->setSubtitle('Subtitle Goes Here');
        $genericElementTwo->setButtons($this->buttons);

        // Add them to the payload
        $genericTemplatePayload->setElements([$genericElementOne, $genericElementTwo]);

        // Set the payload on the Attachment
        $templateAttachment->setPayload($genericTemplatePayload);

        // Set the Attachment on the Message
        $message->setAttachment($templateAttachment);

        return $message;
    }

    /**
     * @return Message
     *                 Generate a receipt message
     */
    public function generateReceiptMessage()
    {
        // Instantiate all the things
        $message = new Message();
        $templateAttachment = new TemplateAttachment();
        $receiptTemplatePayload = new ReceiptTemplatePayload();

        // We need a date, make it today
        $today = new \DateTime();

        // Create a summary
        $summary = new Summary();
        $summary->setShippingCost(4.95);
        $summary->setSubtotal(75.00);
        $summary->setTotalTax(6.19);
        $summary->setTotalCost(56.14);

        // Create an address
        $address = new Address();
        $address->setStreet1('1 Hacker Way');
        $address->setStreet2('');
        $address->setCountry('US');
        $address->setState('CA');
        $address->setCity('Menlo Park');
        $address->setPostalCode('94025');

        // Create a few receipt elements
        $receiptElementOne = new ReceiptElement();
        $receiptElementOne->setTitle('Element Title Goes Here');
        $receiptElementOne->setImageUrl('https://placekitten.com/200/300');
        $receiptElementOne->setSubtitle('Subtitle Goes Here');
        $receiptElementOne->setCurrency('USD');
        $receiptElementOne->setQuantity(5);
        $receiptElementOne->setPrice(100.00);

        $receiptElementTwo = new ReceiptElement();
        $receiptElementTwo->setTitle('Element Title Goes Here');
        $receiptElementTwo->setImageUrl('https://placekitten.com/200/300');
        $receiptElementTwo->setSubtitle('Subtitle Goes Here');
        $receiptElementTwo->setCurrency('USD');
        $receiptElementTwo->setQuantity(5);
        $receiptElementTwo->setPrice(100.00);

        // Create a few payment adjustments
        $adjustmentOne = new Adjustment();
        $adjustmentOne->setName('Discount One');
        $adjustmentOne->setAmount(50);

        $adjustmentTwo = new Adjustment();
        $adjustmentTwo->setName('Discount Two');
        $adjustmentTwo->setAmount(100);

        // Set all the info
        $receiptTemplatePayload->setCurrency('ZAR');
        $receiptTemplatePayload->setOrderNumber(100001); // Unique order number
        $receiptTemplatePayload->setOrderUrl('http://petersapparel.parseapp.com/order?order_id=123456'); // Unique order URL
        $receiptTemplatePayload->setPaymentMethod('Visa Ending in 1234');
        $receiptTemplatePayload->setRecipientName('John Doe');
        $receiptTemplatePayload->setTimestamp($today->getTimestamp());
        $receiptTemplatePayload->setAddress($address);
        $receiptTemplatePayload->setSummary($summary);
        $receiptTemplatePayload->setElements([$receiptElementOne, $receiptElementTwo]);
        $receiptTemplatePayload->setAdjustments([$adjustmentOne, $adjustmentTwo]);

        // Set the Payload on the Attachment
        $templateAttachment->setPayload($receiptTemplatePayload);

        // Set the Attachment on the Message
        $message->setAttachment($templateAttachment);

        return $message;
    }

    /**
     * @return QuickReply
     *                    Generate a QuickReply message
     */
    public function generateQuickReply()
    {
        // See example https://developers.facebook.com/docs/messenger-platform/send-api-reference/quick-replies
        $message = new QuickReply('Pick a color:');

        $reply = new QuickReplies();
        $reply->setTitle('Red');
        $reply->setPayload('DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_RED');

        $message->addQuickReplies($reply);

        $reply = new QuickReplies();
        $reply->setTitle('Green');
        $reply->setPayload('DEVELOPER_DEFINED_PAYLOAD_FOR_PICKING_GREEN');

        $message->addQuickReplies($reply);

        return $message;
    }
}
