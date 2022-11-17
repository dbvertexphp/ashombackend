<?php
	// include config and twitter api wrappe
	require_once( 'twitter/config.php' );
	require_once( 'twitter/TwitterAPIExchange.php' );

	class Twitter {
	public function sendTweet($image, $title){

        // settings for twitter api connection
    	$settings = array(
    		'oauth_access_token' => TWITTER_ACCESS_TOKEN,
    		'oauth_access_token_secret' => TWITTER_ACCESS_TOKEN_SECRET,
    		'consumer_key' => TWITTER_CONSUMER_KEY,
    		'consumer_secret' => TWITTER_CONSUMER_SECRET
    	);
    	// create new twitter for api communication
    	$twitter = new TwitterAPIExchange( $settings );
    	// twitter api endpoint
    	$url = 'https://upload.twitter.com/1.1/media/upload.json';

    	$base64image = base64_encode(file_get_contents($image));
     	$requestMethod = 'POST';

        // twitter api endpoint data
        $apiData = array(
            'media_category' => 'tweet_image',
            'media_data' => $base64image
        );

        // make our api call to twiiter
        $twitter->buildOauth( $url, $requestMethod );
        $twitter->setPostfields( $apiData );
        $response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );

        //echo $response;
        $media_meta = json_decode($response);
        if(!isset($media_meta->media_id))
          return false;
        $media_id = $media_meta->media_id;

 		// twitter api endpoint
    	$url = 'https://api.twitter.com/1.1/statuses/update.json';

    	// twitter api endpoint request type
    	$requestMethod = 'POST';

    	// twitter api endpoint data
    	$apiData = array(
    	    'status' => $title,
    		'media_ids' => $media_id,
    	);

    	// make our api call to twiiter
    	$twitter->buildOauth( $url, $requestMethod );
    	$twitter->setPostfields( $apiData );
    	$response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );

    	// display response from twitter
        //echo '<pre>';
        //print_r( json_decode( $response, true ) );
	}
  }
?>
