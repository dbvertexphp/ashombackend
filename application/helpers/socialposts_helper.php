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
