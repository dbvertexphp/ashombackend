<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class FcmNotification extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

  function push_notification_firbase($device_ids=array(), $message=""){

    $url = 'https://fcm.googleapis.com/fcm/send';
    $api_key = 'AAAA0h6n1sc:APA91bHPDauM6C7Al9MLozVoKcf0ZYuMBtpdMYNl0LuMH_ZEM22k_u9vha5K-Cs9jdIWoEUnTcL2V5AjWcxoU9AsHEu7U_eybmFqb8HPaoeBwYRu2sRzl_98nXE5J2HsoC-V_TJckFxN';
     $fields = array(
                'registration_ids'=>$device_ids,
                'data'=> array("message" => $message)
            );

    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
	}

  function push_notification($devices, $message, $type, $metadata, $unread_notification=0){

    $url = 'https://fcm.googleapis.com/fcm/send';

   $api_key = 'AAAA0h6n1sc:APA91bHPDauM6C7Al9MLozVoKcf0ZYuMBtpdMYNl0LuMH_ZEM22k_u9vha5K-Cs9jdIWoEUnTcL2V5AjWcxoU9AsHEu7U_eybmFqb8HPaoeBwYRu2sRzl_98nXE5J2HsoC-V_TJckFxN';

    $msg = array
	(
    'message'   => 'here is a message. message',
    'title'     => $message,
    //'subtitle'  => '',
    //'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
    'vibrate'   => 1,
    'metadata'			=>$metadata,
    'type'  		=>  $type,
    'category' => 'CONTENT_ADDED_NOTIFICATION',
    'badge' => $unread_notification,
    'largeIcon' => 'https://ashom.app/assets/images/slogo.png',
    'smallIcon' => 'https://ashom.app/assets/images/slogo.png'
	);

    $n = array(
        "body"  => "$message",
        "title" => "Ashom.app",
        "text"  => "$message",
        "mutable_content" => true,
      	"category" => "CONTENT_ADDED_NOTIFICATION",
      	"badge"  =>  $unread_notification,
        "sound"  => "warning",
        "icon"   => "https://testnet.ashom.app/reactassets/logo.png"
    );

      $fields = array(
         'registration_ids' => $devices,
         'priority'     => "high",
         'notification' => $n,
         'data'         => $msg,
         'content_available'=> true,
         'mutable_content' => true,
         'category' => 'CONTENT_ADDED_NOTIFICATION',
         'title' 		=> $message,
		 "type" 		=> "$type"
    );




    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
 //echo json_encode($result);
 //echo json_encode($fields);
   //die();

    return $result;
}


  function push_notification_news($devices=array(), $unread_notification=0, $news=""){
    $url = 'https://fcm.googleapis.com/fcm/send';

   	$api_key = 'AAAA0h6n1sc:APA91bHPDauM6C7Al9MLozVoKcf0ZYuMBtpdMYNl0LuMH_ZEM22k_u9vha5K-Cs9jdIWoEUnTcL2V5AjWcxoU9AsHEu7U_eybmFqb8HPaoeBwYRu2sRzl_98nXE5J2HsoC-V_TJckFxN';

	if(!$news)
      return 0;
    $c_dat["image"] = $news->image_url;
    $metadata = array("type"=>"News", "data"=>$news);
    $msg = array
	(
    'message'   => $news->title,
    'title'     => "Ashom.app",
    'image'		=> $news->image_url,
    'icon'		=> 'https://ashom.app/assets/images/slogo.png',
    //'subtitle'  => '',
    //'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
    'vibrate'   => 1,
    'metadata'			=> $metadata,
    'type'  		=>  'News',
    'category' => 'CONTENT_ADDED_NOTIFICATION',
    'badge' => $unread_notification,
    'largeIcon' => 'https://ashom.app/assets/images/slogo.png',
    'smallIcon' => 'https://ashom.app/assets/images/slogo.png'
	);

    $n = array(
        "body"  => $news->title,
        "title" => "Ashom.app",
        "text"  => "New News Update",
        "mutable_content" => true,
      	"category" => "CONTENT_ADDED_NOTIFICATION",
      	"badge"  =>  $unread_notification,
      	"image"		=> $news->image_url,
        "sound"  => "warning",
        "icon"   => "https://testnet.ashom.app/reactassets/logo.png"
    );

      $fields = array(
         'registration_ids' => $devices,
         'priority'     => "high",
         'notification' => $n,
         'data'         => $msg,
         'content_available'=> true,
         'mutable_content' => true,
         'category' => 'CONTENT_ADDED_NOTIFICATION',
         'title' 		=> "Ashom.App",
          'image'		=> $news->image_url,
		 "type" 		=> "News"
    );




    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
 //echo json_encode($result);
 //echo json_encode($fields);
   //die();
    return $result;
}

}
?>
