<?php
/**
 * Send an SMS message by using Infobip API PHP Client.
 * 
 * For your convenience, environment variables are already pre-populated with your account data 
 * like authentication, base URL and phone number.
 * 
 * Please find detailed information in the readme file.
 */ 
require '../../vendor/autoload.php';
use GuzzleHttp\Client;
use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
 
$BASE_URL = "https://2k3q5l.api.infobip.com";
$API_KEY = "9c95c6d77e4bed3a07a0201522cd2799-1373c43a-e820-48b0-b63c-a12765c22789";

$SENDER = "InfoSMS";
$RECIPIENT = "224611885050";
$MESSAGE_TEXT = "This is a sample message";
 
$configuration = (new Configuration())
    ->setHost($BASE_URL)
    ->setApiKeyPrefix('Authorization', 'App')
    ->setApiKey('Authorization', $API_KEY);
 
$client = new Client();
 
$sendSmsApi = new SendSMSApi($client, $configuration);
$destination = (new SmsDestination())->setTo($RECIPIENT);
$message = (new SmsTextualMessage())
    ->setFrom($SENDER)
    ->setText($MESSAGE_TEXT)
    ->setDestinations([$destination]);
 
$request = (new SmsAdvancedTextualRequest())->setMessages([$message]);
 
try {
    $smsResponse = $sendSmsApi->sendSmsMessage($request);
    echo ("Response body: " . $smsResponse);
} catch (Throwable $apiException) {
    echo("HTTP Code: " . $apiException->getCode() . "\n");
}