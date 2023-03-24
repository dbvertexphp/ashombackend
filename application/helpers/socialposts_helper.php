<?php
function linkedin_news_post($title="", $link="", $image=""){
	$curl = curl_init();
	$ci =& get_instance();
	$linkedInToken = $ci->db->get_where('basic_settings')->row()->linkedin_token;
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.linkedin.com/v2/shares',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "content": {
            "contentEntities": [
                {
                    "entityLocation": "'.$link.'",
                    "thumbnails": [
                        {
                            "resolvedUrl": "'.$image.'"
                        }
                    ]
                }
            ],
            "title": "'.$title.'"
        },
        "distribution": {
            "linkedInDistributionTarget": {}
        },
        "owner": "urn:li:organization:81343317",
        "subject": "'.$title.'",
        "text": {
            "text": "'.$title.'"
        }
    }',
      CURLOPT_HTTPHEADER => array(
        ': ',
        'Authorization: Bearer '.$linkedInToken,
        'Content-Type: application/json',
        'Cookie: lidc="b=VB45:s=V:r=V:a=V:p=V:g=3483:u=692:x=1:i=1653041579:t=1653108497:v=2:sig=AQG0hoS5sHsq9e8_BJZa3Ad2inHLa4Hl"; bcookie="v=2&1b32ba7e-b322-432d-8b35-02f8a9812e31"; lang=v=2&lang=en-us; lidc="b=VB32:s=V:r=V:a=V:p=V:g=3762:u=1:x=1:i=1653022828:t=1653109228:v=2:sig=AQHzrnaBta5yOwjQbeGB7g5vPt-NKG7D"'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
}

function twitter_post($title="", $link="", $image=""){
   require_once(APPPATH.'libraries/twitter.php');
   $twitter = new Twitter();
   $twitter->sendTweet($image, $title);
}

function facebook_post($title="", $link="", $image=""){
    require_once ('vendor/autoload.php');
     $fb = new Facebook\Facebook([
 
     'app_id' => '1047970739468401',
     'app_secret' => 'f699cd7eeea72feaabdb8c1410032535',
     'default_graph_version' => 'v2.3',
     ]);
 
 
     $pageAccessToken = 'EAAO5H7OpOHEBAMDrxRG89KbUSWZCzbTKjJPExdwx9JaRS9PRhZCIyS3xvRsjS9DhLV6QpxGNHZC1sGAtgJTbXtrnhfFo0vzRHeSjpZCP7n5YWSohSPDVbCbLT8bPqEZARwIDelZByYrer50eFFewETMfGcKUZA1ALYdouwGzIN8SQlHJvxi9MZCLCtmKZBkRj9TORZBEi2riXiPILuZB0fA8GPq';
 
     $imagesdata = [
         'source' => $fb->fileToUpload("https://ashom.app/assets/images/financialsocial.png"),
         'message' => "$title",
         //'url' => 'https://ashom.app',
     ];
     try
 
     {
     $response = $fb->post('/me/photos',$imagesdata, $pageAccessToken);
     }
     catch(Facebook\Exceptions\FacebookResponseException $e)
     {
 
     echo 'Graph returned an error: '.$e->getMessage();
 
     exit;
 
     }
 
     catch(Facebook\Exceptions\FacebookSDKException $e)
     {
 
     echo 'Facebook SDK returned an Error: '.$e->getMessage();
     exit;
 
     }
     $graphNode = $response->getGraphNode();
 
 
     echo 'ID:'.$graphNode['id'];
 }

 function instagram_post($url, $post, $post_data) {
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://i.instagram.com/api/v1/'.$url);
    curl_setopt($ch, CURLOPT_USERAGENT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    if($post) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    }

   

    $response = curl_exec($ch);
    $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

   return array($http, $response);
}

function GenerateGuid() {
     return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', 
            mt_rand(0, 65535), 
            mt_rand(0, 65535), 
            mt_rand(0, 65535), 
            mt_rand(16384, 20479), 
            mt_rand(32768, 49151), 
            mt_rand(0, 65535), 
            mt_rand(0, 65535), 
            mt_rand(0, 65535));
}

function GenerateUserAgent() {  
     $resolutions = array('720x1280', '320x480', '480x800', '1024x768', '1280x720', '768x1024', '480x320');
     $versions = array('GT-N7000', 'SM-N9000', 'GT-I9220', 'GT-I9100');
     $dpis = array('120', '160', '320', '240');

     $ver = $versions[array_rand($versions)];
     $dpi = $dpis[array_rand($dpis)];
     $res = $resolutions[array_rand($resolutions)];

     return 'Instagram 4.'.mt_rand(1,2).'.'.mt_rand(0,2).' Android ('.mt_rand(10,11).'/'.mt_rand(1,3).'.'.mt_rand(3,5).'.'.mt_rand(0,5).'; '.$dpi.'; '.$res.'; samsung; '.$ver.'; '.$ver.'; smdkc210; en_US)';
 }

function GenerateSignature($data) {
     return hash_hmac('sha256', $data, 'b4a23f5e39b5929e0666ac5de94c89d1618a2916');
}

function GetPostData($filename) {
    if(!$filename) {
        echo "The image doesn't exist ".$filename;
    } else {
        $post_data = array('device_timestamp' => time(), 
                        'photo' => '@'.$filename);
        return $post_data;
    }
}


// Set the username and password of the account that you wish to post a photo to
$username = 'ig_username';
$password = 'ig_password';

// Set the path to the file that you wish to post.
// This must be jpeg format and it must be a perfect square
$filename = 'pictures/test.jpg';

// Set the caption for the photo
$caption = "Test caption";

// Define the user agent
//$agent = GenerateUserAgent();

// Define the GuID
$guid = GenerateGuid();

// Set the devide ID
$device_id = "android-".$guid;

/* LOG IN */
// You must be logged in to the account that you wish to post a photo too
// Set all of the parameters in the string, and then sign it with their API key using SHA-256
$data ='{"device_id":"'.$device_id.'","guid":"'.$guid.'","username":"'.$username.'","password":"'.$password.'","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}';
$sig = GenerateSignature($data);
$data = 'signed_body='.$sig.'.'.urlencode($data).'&ig_sig_key_version=4';
$login = instagram_post('accounts/login/', true, $data,false);

if(strpos($login[1], "Sorry, an error occurred while processing this request.")) {
    echo "Request failed, there's a chance that this proxy/ip is blocked";
} else {   
             
    if(empty($login[1])) {
        echo "Empty response received from the server while trying to login";
    } else {            
        // Decode the array that is returned
        $obj = @json_decode($login[1], true);

        if(empty($obj)) {
            echo "Could not decode the response: ".$body;
        } else {
            // Post the picture
            $data = GetPostData($filename);
            $post = instagram_post('media/upload/', true, $data,true);    

            if(empty($post[1])) {
                 echo "Empty response received from the server while trying to post the image";
            } else {
                // Decode the response 
                $obj = @json_decode($post[1], true);

                if(empty($obj)) {
                    echo "Could not decode the response";
                } else {
                    $status = $obj['status'];

                    if($status == 'ok') {
                        // Remove and line breaks from the caption
                        $caption = preg_replace("/\r|\n/", "", $caption);

                        $media_id = $obj['media_id'];
                        $device_id = "android-".$guid;
                        $data = '{"device_id":"'.$device_id.'","guid":"'.$guid.'","media_id":"'.$media_id.'","caption":"'.trim($caption).'","device_timestamp":"'.time().'","source_type":"5","filter_type":"0","extra":"{}","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}';   
                        $sig = GenerateSignature($data);
                        $new_data = 'signed_body='.$sig.'.'.urlencode($data).'&ig_sig_key_version=4';

                       // Now, configure the photo
                       $conf = instagram_post('media/configure/', true, $new_data,true);

                       if(empty($conf[1])) {
                           echo "Empty response received from the server while trying to configure the image";
                       } else {
                           if(strpos($conf[1], "login_required")) {
                                echo "You are not logged in. There's a chance that the account is banned";
                            } else {
                                $obj = @json_decode($conf[1], true);
                                $status = $obj['status'];

                                if($status != 'fail') {
                                    echo "Success";
                                } else {
                                    echo 'Fail';
                                }
                            }
                        }
                    } else {
                        echo "Status isn't okay";
                    }
                }
            }
        }
    }
}