Facebook Messenger Bundle
=====================
[![Build Status](https://travis-ci.org/PouleR/facebook-messenger-bundle.svg?branch=master)](https://travis-ci.org/PouleR/facebook-messenger-bundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d73f014e-f193-4c88-a6e0-77f9323d3440/mini.png)](https://insight.sensiolabs.com/projects/d73f014e-f193-4c88-a6e0-77f9323d3440)

[![Latest Stable Version](https://poser.pugx.org/pouler/facebook-messenger-bundle/v/stable)](https://packagist.org/packages/pouler/facebook-messenger-bundle)
[![Total Downloads](https://poser.pugx.org/pouler/facebook-messenger-bundle/downloads)](https://packagist.org/packages/pouler/facebook-messenger-bundle)
[![Latest Unstable Version](https://poser.pugx.org/pouler/facebook-messenger-bundle/v/unstable)](https://packagist.org/packages/pouler/facebook-messenger-bundle)

A PHP Facebook Messenger API for the Symfony framework.

## Installation

### Step 1: Download Bundle

```bash
$ composer require pouler/facebook-messenger-bundle
```

### Step 2: Enable the bundle (Symfony 2/3)

Next, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new PouleR\FacebookMessengerBundle\FacebookMessengerBundle(),
    );
}
```

## Configuration

Edit your `config.yml` with the following configuration:
    
    pouler_facebook_messenger:
		app_id: 'YourFBMessengerAppId'
		app_secret: 'YourFBMessengerAppSecret'
		
## Examples

### Set your default greeting text
``` php
$service = new FacebookMessengerService('...', '...', new NullLogger());
$service->setAccessToken('PAGE_ACCESS_TOKEN');

$config = new GreetingTextConfiguration();
$config->setText('Hello and welcome!');

$service->setGreetingText($config);
```

### Send a text message to a user (by PSID)
``` php
$service = new FacebookMessengerService('...', '...', new NullLogger());
$service->setAccessToken('PAGE_ACCESS_TOKEN');

$recipient = new Recipient('PSID');
$message = new Message('Hi there, this is a test');

$service->postMessage($recipient, $message);
```

### Use batch requests to send a text message to different users (by PSID)
``` php
$service = new FacebookMessengerService('...', '...', new NullLogger());
$service->setAccessToken('PAGE_ACCESS_TOKEN');

$message = new Message('Hi there, this is a batch message');
$service->addMessageToBatch(new Recipient('PSID1'), $message);
$service->addMessageToBatch(new Recipient('PSID2'), $message);
$service->addMessageToBatch(new Recipient('PSID3'), $message);

$response = $service->sendBatchRequests();

// The response contains an array with failed requests
var_dump($response);

// For e.g.:
["batch_PSID_#1"]=>
  array(2) {
    ["code"]=>
    int(400)
    ["body"]=>
    string(139) "{"error":{"message":"(#100) No matching user found","type":"OAuthException","code":100,"error_subcode":123456,"fbtrace_id":"XXXXX"}}"
  }
  
//The keys are configured as: 'batch_{PSID}_#{POSITION_IN_BATCH}'
```

### Create a generic template message
``` php
$message = new Message();
$templateAttachment = new TemplateAttachment();
$genericTemplatePayload = new GenericTemplatePayload();

$pbButton = new PostbackButton();
$pbButton->setTitle('Button Title Goes Here');
$pbButton->setPayload('payload_data');

$wuButton = new WebUrlButton();
$wuButton->setTitle('Button Title Goes Here');
$wuButton->setUrl('https://www.google.com');

$buttons = [$pbButton, $wuButton];

// Create some elements
$genericElementOne = new GenericElement();
$genericElementOne->setTitle('Element Title Goes Here');
$genericElementOne->setImageUrl('https://placekitten.com/200/300');
$genericElementOne->setSubtitle('Subtitle Goes Here');
$genericElementOne->setButtons($buttons);

$genericElementTwo = new GenericElement();
$genericElementTwo->setTitle('Element Title Goes Here');
$genericElementTwo->setImageUrl('https://placekitten.com/200/300');
$genericElementTwo->setSubtitle('Subtitle Goes Here');
$genericElementTwo->setButtons($buttons);

// Add them to the payload
$genericTemplatePayload->setElements([$genericElementOne, $genericElementTwo]);

// Set the payload on the attachment
$templateAttachment->setPayload($genericTemplatePayload);

// Set the Attachment on the message
$message->setAttachment($templateAttachment);
```

Original project by John Kosmetos (https://github.com/jkosmetos/facebook-messenger-api)
