<?php
require APPPATH.'libraries/iosnotification/vendor/autoload.php';

use Pushok\AuthProvider;
use Pushok\Client;
use Pushok\Notification;
use Pushok\Payload;
use Pushok\Payload\Alert;

$options = [
  	'key_id' => 'AAAABBBBCC', // The Key ID obtained from Apple developer account
    'team_id' => 'DDDDEEEEFF', // The Team ID obtained from Apple developer account
    'app_bundle_id' => 'com.app.Test', // The bundle ID for app obtained from Apple developer account
  	'private_key_path' => './assets/p12files/privatekey.pem', // Path to private key
    'private_key_secret' => '123' ,// Private key secret
    'certificate_path' => './assets/p12files/ApnsDev.pem', // Path to private key
    'certificate_secret' => null // Private key secret
];

// Be aware of thing that Token will stale after one hour, so you should generate it again.
// Can be useful when trying to send pushes during long-running tasks
$authProvider = AuthProvider\Token::create($options);

$alert = Alert::create()->setTitle('Hello!');
$alert = $alert->setBody('First push notification');

$payload = Payload::create()->setAlert($alert);

//set notification sound to default
$payload->setSound('default');

//add custom value to your notification, needs to be customized
$payload->setCustomValue('key', 'value');

$deviceTokens = ['<device_token_1>', '<device_token_2>', '<device_token_3>'];

$notifications = [];
foreach ($deviceTokens as $deviceToken) {
    $notifications[] = new Notification($payload,$deviceToken);
}

// If you have issues with ssl-verification, you can temporarily disable it. Please see attached note.
// Disable ssl verification
// $client = new Client($authProvider, $production = false, [CURLOPT_SSL_VERIFYPEER=>false] );
$client = new Client($authProvider, $production = false);
$client->addNotifications($notifications);

class iosnotification{
public function sentNotification(){
$responses = $client->push(); 
}
} 

