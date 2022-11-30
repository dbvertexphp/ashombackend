<?php

$datas = array(
            'stockname'      => $RIC,
            'symbolticker' => $SymbolTicker,
            'industry'    => $industry
      );
      
      $data_string = json_encode($datas);
     
      $curl = curl_init('https://13.127.45.140/add/industy/symbolticker');

     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
      
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'User-Agent: PostmanRuntime/7.29.2',
      'Accept: */*',
      'Accept-Encoding:gzip, deflate, br',
      'Connection:keep-alive',
     'Content-Length: ' . strlen($data_string))
      );
      
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
       curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data
      
      // Send the request
      $result = curl_exec($curl);
      echo $result;die();
      // Free up the resources $curl is using
      curl_close($curl);