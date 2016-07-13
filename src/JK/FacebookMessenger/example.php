<?php

namespace JK\FacebookMessenger;

use JK\FacebookMessenger\Core\Attachment\TemplateAttachment;
use JK\FacebookMessenger\Core\Attachment\ImageAttachment;
use JK\FacebookMessenger\Core\Button\PostbackButton;
use JK\FacebookMessenger\Core\Button\WebUrlButton;
use JK\FacebookMessenger\Core\Configuration\Configuration;
use JK\FacebookMessenger\Core\Configuration\CallToAction;
use JK\FacebookMessenger\Core\Element\GenericElement;
use JK\FacebookMessenger\Core\Element\ReceiptElement;
use JK\FacebookMessenger\Core\Entity\Address;
use JK\FacebookMessenger\Core\Entity\Adjustment;
use JK\FacebookMessenger\Core\Entity\Summary;
use JK\FacebookMessenger\Core\Payload\MediaPlayload;
use JK\FacebookMessenger\Core\QuickReply;
use JK\FacebookMessenger\Core\QuickReply\QuickReplies;
use JK\FacebookMessenger\Core\Template\ButtonTemplatePayload;
use JK\FacebookMessenger\Core\Template\GenericTemplatePayload;
use JK\FacebookMessenger\Core\Template\ReceiptTemplatePayload;
use JK\FacebookMessenger\Core\Message;

class Example {

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
     * @return Configuration
     * Generate a plain text welcome message configuration
     */
    public function generateConfiguration()
    {

        // Instantiate a new Message
        $configuration = new Configuration();
        $message = self::generateTextMessage();

        $message->setText('Welcome! Want to learn how to read good? Type something in and get going! ^_^');
        $callToAction = new CallToAction($message);

        // Set the welcome message
        $configuration->setCallToActions([$callToAction]); // Set this to a blank array to remove all configurations

        return $configuration;
    }

    /**
     * @return Message
     * Generate a plain text message
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
     * Generate a image message
     */
    public function generateImageMessage()
    {
        // Instantiate all the things
        $message = new Message();
        $imageAttachment = new ImageAttachment();
        $mediaPayload = new MediaPlayload();

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
     * Generate a button message
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
     * Generate a generic message
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
     * Generate a receipt message
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
        $address->setStreet1("1 Hacker Way");
        $address->setStreet2("");
        $address->setCountry("US");
        $address->setState("CA");
        $address->setCity("Menlo Park");
        $address->setPostalCode("94025");

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
        $adjustmentOne =  new Adjustment();
        $adjustmentOne->setName('Discount One');
        $adjustmentOne->setAmount(50);

        $adjustmentTwo =  new Adjustment();
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
     * Generate a QuickReply message
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

