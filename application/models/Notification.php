<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
         date_default_timezone_set('Asia/Kolkata');
        
    }

  	public function sendIosNotification($devices_tokens="", $message="", $payload=array()){
    	$deviceToken = $devices_tokens; //  iPad 5s Gold prod
        $passphrase = "123";
        $message = $message;
        $ctx = stream_context_create();
      	//stream_context_set_option($ctx, 'ssl', 'local_pk', './assets/p12files/privatekey.pem');
        stream_context_set_option($ctx, 'ssl', 'local_cert', './assets/p12files/apns-production-key-noenc.pem'); // Pem file to generated // openssl pkcs12 -in pushcert.p12 -out pushcert.pem -nodes -clcerts // .p12 private key generated from Apple Developer Account
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // production
         //$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // developement

          echo "<p>Connection Open</p>";
            if(!$fp){
                return "<p>Failed to connect!<br />Error Number: " . $err . " <br />Code: " . $errstr . "</p>";
                return;
            } else {
                echo "<p>Sending notification!</p>";
            }


        $body['aps'] = array('alert' => $message,'sound' => 'default','extra1'=>'10','extra2'=>'value', 'payload'=>$payload);
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        //var_dump($msg)
        $result = fwrite($fp, $msg, strlen($msg));
          if (!$result)
                    echo '<p>Message not delivered ' . PHP_EOL . '!</p>';
                else
                    echo '<p>Message successfully delivered ' . PHP_EOL . '!</p>';
        fclose($fp);
    }
}
