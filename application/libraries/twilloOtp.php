<?php
require __DIR__ . '/twillo/vendor/autoload.php';
use Twilio\Rest\Client;


class twilloOtp extends Client{
public function __construct(){
     $account_sid = 'ACe0c2c7f1d41c524912fbcef00a03fa05';
     $auth_token = '837aaa21a520b2d86d461da69e065920';
     parent::__construct($account_sid, $auth_token);
}

public function sendOtp($phone, $message){
    $twilio_number = "+17273535354";
    $this->messages->create($phone,
        array(
            'from' => $twilio_number,
            'body' => $message
        )
    );
    

    }
}
