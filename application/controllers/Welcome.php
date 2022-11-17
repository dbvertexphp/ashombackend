
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ini_set('memory_limit', '8192M');
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 ini_set('max_execution_time', 0);
class Welcome extends CI_Controller {

  function __construct()
    {
    parent::__construct();
	$this->load->model('FcmNotification');
    $this->load->helper('socialposts');
  }

    public function index()
    {
        $this->load->view('welcome_message');
      	$this->load->model('notification');
    }

  public function admin(){
      $this->load->view("admin");
  }


  public function setfile(){
      $path    = './uploads/company_logo';
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));
for($i=2; $i<count($files); $i++){
    $x = pathinfo($files[$i], PATHINFO_FILENAME);
    if($this->db->get_where("companies", ["Company_Name"=>$x])->row()){
        $this->db->update("companies", ["image"=>("/uploads/company_logo/".$files[$i])], ["Company_Name"=>$x]);
    }
    echo $x;

}
  }

//Not to remove this is addedd cron jobs
   public function refinitivapicron(){
       $this->load->model('Api_model');
       //$pds = json_decode($this->Api_model->getrefinitivedata());
        //print_r($pds->ExtractionRequest);
      $data = new stdClass();
      $data->Credentials=new stdClass();
      $data->Credentials->Username="9029829";
      $data->Credentials->Password="vif@2017";

  $post_data = json_encode($data);

  $crl = curl_init('https://selectapi.datascope.refinitiv.com/RestApi/v1/Authentication/RequestToken');
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

  // Set HTTP Header for POST request
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata'
  ));

  $result = curl_exec($crl);
  if ($result === false) {
      $result_noti = 0; die();
  } else {

      $result_noti = 1;

      $auth_key = json_decode($result)->value;

      $pds = json_decode($this->Api_model->getrefinitivedata($auth_key));

      print_r($this->db->last_query());
      die();
  }
  // Close cURL session handle
  curl_close($crl);



   }

  public function cronjobs(){
      //Delete All expired Polls Forums
      $this->db->query('DELETE FROM forums where (DATE_FORMAT(DATE_ADD(forums.created, INTERVAL forums.validity DAY), "%Y-%m-%d %H:%i") <= DATE_FORMAT(CURRENT_TIMESTAMP(), "%Y-%m-%d %H:%i")) and forum_type="poll"');
  }

  public function cron_news_notification(){
     $devices = array();
     $news_message = $this->db->get_where("notification_text", ["id"=>1])->row()->textline;
     $type = "News";
     $selectedNews = $this->db->get_where("notification_text", ["id"=>3])->row();
     $news = $this->db->get_where("api_data", ["id"=>$selectedNews->textline])->row();
    
     $metadata = array();
     $NotificationData = array();
     //$N_metadata = array("type"=>"News", "data"=>array());
     $c_dat["image"] = $news->image_url;
     $N_metadata = array("type"=>"News", "data"=>array($news));
     $users = $this->db->get('users')->result();

     foreach($users as $user){
       $user_id = $user->id;
       $tokens_list = $this->db->get_where("device_tokens", ["device_token!="=>"", "user_id"=>$user_id])->result();
       $unread_notifications = $this->db->select("COUNT(*) as total")->get_where("notifications", ["user_id"=>$user_id, "read_status"=>0])->row()->total;
       $NotificationObj["user_id"] = $user_id;
       $NotificationObj["message"] = $news->title;
       $NotificationObj["metadata"] = json_encode($N_metadata);
       $NotificationData[] = $NotificationObj;
       foreach($tokens_list as $key => $token){
         $devices = array();
         $devices[] = $token->device_token;
         $fcm_result = $this->FcmNotification->push_notification_news($devices, $unread_notifications, $news);
         $j_fcm_result = json_decode($fcm_result);
         if($j_fcm_result->failure){
           if($j_fcm_result->results[0]->error=="NotRegistered")
           $this->db->delete("device_tokens", ["device_token"=>($token->device_token)]);
         }
         echo $fcm_result;
       }
     }
      if(COUNT($NotificationData)>0);
      $this->db->insert_batch('notifications', $NotificationData);
      echo linkedin_news_post($news->title, $news->link, $news->image_url);
      echo twitter_post($news->title, $news->link, $news->image_url);

  }


  public function cron_forum_notification(){
     $devices = array();
     $tokens_list = $this->db->get_where("device_tokens", "device_token!=''")->result();
     $forum_message = $this->db->get_where("notification_text", ["id"=>2])->row()->textline;
     $type = "Forum";
     $metadata = array();
     $NotificationData = array();
     $N_metadata = array("type"=>"Forum", "data"=>array());
     $user_ids = array();

     foreach($tokens_list as $key => $token){
       $devices = array();
       $devices[] = $token->device_token;
       $user_id = $token->user_id;
       $unread_notifications = $this->db->select("COUNT(*) as total")->get_where("notifications", ["user_id"=>$user_id, "read_status"=>0])->row()->total;
       //$fcm_result = $this->FcmNotification->push_notification($devices, $forum_message, $type, $metadata, ($unread_notifications+1));
       if(json_decode($fcm_result)->failure){
         $this->db->delete("device_tokens", ["device_token"=>($token->device_token)]);
       }
       echo $fcm_result;
       if(!in_array($user_id, $user_ids)){
       $user_ids[] = $token->user_id;
       $NotificationData[$key]["user_id"] = $user_id;
       $NotificationData[$key]["message"] = $forum_message;
       $NotificationData[$key]["metadata"] = json_encode($N_metadata);
      }
     }
    //$this->db->insert_batch('notifications', $NotificationData);
    }


  public function financeapijobs(){
      ini_set('memory_limit', '8192M');
	$datas = array();
    $response = file_get_contents('https://writecaliber.com/feeds/apifeeds.php');
     
    $result = json_decode($response);
    foreach($result as $value){
        $is_exists = $this->db->get_where('api_data', ['title'=>$value->title])->row();
        if(!$is_exists){
          $data["title"] = $value->title;
          $data["date"] = $value->date;
          if($value->image_url!='https://english.mubasher.info/assets/ui/images/news/news-social.jpg'&&$value->image_url!='https://static.mubasher.info/File.Story_Image/13480d24e5f39bfacba39298dd4dd947/640.jpg'){
            $data["image_url"] = $value->image_url;
            
          }
          else{
            $data["image_url"] = 'https://ashom.app/assets/icons/placeholder.png';
           
          }
          
          $data["source"] = $value->source;
          $data["link"] = $value->link;
          $data["created"] = date("Y-m-d");
          $data["m_countries"] = implode(",", $value->country);
          $data["m_companies"] = implode(",", $value->company);
          $datas[] = $data;
        }
    }
    
    if(COUNT($datas)>0)
    $this->db->insert_batch('api_data', $datas);
    $news = $this->db->query('select * from api_data order by STR_TO_DATE(api_data.date, "%d/%m/%y %H:%i") DESC limit 1')->row();
    $this->db->update("notification_text", ["textline" => $news->id], ["id" => 3]);
	echo 'loaded';
  }

 public function testrefiniv(){
    $this->load->model('Api_model');

           $this->load->model('Api_model');
       //$pds = json_decode($this->Api_model->getrefinitivedata());
        //print_r($pds->ExtractionRequest);
      $data = new stdClass();
      $data->Credentials=new stdClass();
      $data->Credentials->Username="9029829";
      $data->Credentials->Password="vif@2017";

  $post_data = json_encode($data);

  $crl = curl_init('https://selectapi.datascope.refinitiv.com/RestApi/v1/Authentication/RequestToken');
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

  // Set HTTP Header for POST request
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata'
  ));

  // Submit the POST request
  $result = curl_exec($crl);

  // handle curl error
  if ($result === false) {
      // throw new Exception('Curl error: ' . curl_error($crl));
      //print_r('Curl error: ' . curl_error($crl));
      $result_noti = 0; die();
  } else {

      $result_noti = 1;

      $auth_key = json_decode($result)->value;
      $this->Api_model->getrefinitive5yeardata($auth_key);
      die();
  }
  // Close cURL session handle
  curl_close($crl);

 }


 public function testsdsd(){
      try{
     $this->load->model('Api_model');
     $this->load->model('Api_model');
     $data = new stdClass();
     $data->Credentials=new stdClass();
     $data->Credentials->Username="9029829";
     $data->Credentials->Password="vif@2017";

  $post_data = json_encode($data);

  $crl = curl_init('https://selectapi.datascope.refinitiv.com/RestApi/v1/Authentication/RequestToken');
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

  // Set HTTP Header for POST request
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata'
  ));

  // Submit the POST request
  $result = curl_exec($crl);

  // handle curl error
  if ($result === false) {
       throw new Exception('Curl error: ' . curl_error($crl));
      print_r('Curl error: ' . curl_error($crl));

  } else {



      $auth_key = json_decode($result)->value;
      echo "Auth Key : ".$auth_key."<br>";
      $post_data = '{
    "ExtractionRequest": {
        "@odata.type": "#DataScope.Select.Api.Extractions.ExtractionRequests.TickHistoryTimeAndSalesExtractionRequest",
        "ContentFieldNames": [
            "Trade - Price",
            "Trade - Exchange Time"
        ],
        "IdentifierList": {
            "@odata.type": "#DataScope.Select.Api.Extractions.ExtractionRequests.InstrumentIdentifierList",
            "InstrumentIdentifiers": [
                {
                    "Identifier": "1020.SE",
                    "IdentifierType": "Ric"
                }
            ]
        },
        "Condition": {
            "MessageTimeStampIn": "GmtUtc",
            "ApplyCorrectionsAndCancellations": false,
            "ReportDateRangeType": "Range",
            "QueryStartDate": "2016-11-10",
            "QueryEndDate": "2021-11-10",
            "DisplaySourceRIC": true
        }
    }
}';
    $main_url = 'https://selectapi.datascope.refinitiv.com/RestApi/v1/Extractions/ExtractRaw';
    $http_sign = false;
    $headers=[];
  $crl = curl_init($main_url);
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
  curl_setopt($crl, CURLOPT_FAILONERROR, true);
  curl_setopt($crl, CURLOPT_HEADERFUNCTION,
    function ($crl, $header) use (&$headers) {
        $len = strlen($header);
        $header = explode(':', $header, 2);
        if (count($header) < 2) // ignore invalid headers
            return $len;

        $headers[strtolower(trim($header[0]))][] = trim($header[1]);

        return $len;
    }
);
  // Set HTTP Header for POST request
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key
  ));


  $result = curl_exec($crl);
  $headerSent = curl_getinfo($crl, CURLINFO_HEADER_OUT );
  $httpcode = curl_getinfo($crl, CURLINFO_HTTP_CODE);

  if ($result === false) {
      throw new Exception('Curl error: ' . curl_error($crl));
      print_r('Curl error: ' . curl_error($crl));
      $result_noti = 0; die();
  } else {
        curl_close($crl);
    print($httpcode);
    if($httpcode==202){

        $location_url = $headers["location"][0];
        echo "<br>".$location_url."</br>";

        $httpcode1=0;

        $crle = curl_init($location_url);
        curl_setopt($crle, CURLOPT_URL, $location_url);
        curl_setopt($crle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crle, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key
        ));
        $fdsf = explode("'", $location_url);
        $extraction_id = $fdsf[1];
        $new_uri= str_replace("JOBID", "$extraction_id", "https://selectapi.datascope.refinitiv.com/RestApi/v1/Extractions/RawExtractionResults('JOBID')/%24value");
        $ccoiu=0;
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $flag=0;
        echo "new URI".$new_uri;
        $curls = curl_init($new_uri);
        curl_setopt($curls, CURLOPT_URL, $new_uri);
        curl_setopt($curls, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curls, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key
        ));
        $result = curl_exec($curls);
        print_r($curls);
         curl_close($crle);
                }
            else{
             }
            }
          }
        }
        catch(\Error $e){
         echo "Error : ".$e;
        }
 }

 public function getallincompletes($start=0, $end=0){
    ini_set('max_execution_time', '0');
    ini_set('memory_limit', '1000000M');
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    $companies = $this->db->query("select * from companies where id>=$start and id<=$end")->result();
     foreach($companies as $value){
     $mydata = $this->db->query("SELECT companies.Company_Name, years.*, periods.*, document_types.* from companies INNER join years on years.company_id=companies.id inner join periods INNER join document_types left join documents on (documents.document_company_id=companies.id and documents.document_year=years.year and documents.document_period=periods.period and documents.document_type_id=document_types.id) where companies.id=".($value->id)." and years.year=2020 and documents.document_id is null order by companies.id, years.year, periods.period")->result();
        foreach($mydata as $davalue){
        print_r($davalue);
         unset($davalue->id);
         $davalue->document_type = $davalue->name;
         unset($davalue->name);
         $this->db->insert("incompletedoc", $davalue);
        }
     }
     //print_r(json_encode($this->db->query("SELECT companies.Company_Name, years.*, periods.*, document_types.* from companies INNER join years on years.company_id=companies.id inner join periods INNER join document_types left join documents on (documents.document_company_id=companies.id and documents.document_year=years.year and documents.document_period=periods.period and documents.document_type_id=document_types.id) where companies.id=".($value->id)." and years.year=2020 and documents.document_id is null order by companies.id, years.year, periods.period")->result()));
     //print_r(json_encode($this->db->query("SELECT companies.Company_Name, years.*, periods.*, document_types.* from companies INNER join years on years.company_id=companies.id inner join periods INNER join document_types left join documents on (documents.document_company_id=companies.id and documents.document_year=years.year and documents.document_period=periods.period and documents.document_type_id=document_types.id)where documents.document_id is null limit 10")->result()));
 }

 public function getallincomplete($start=0, $end=0){
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '40000M');
    print " ";
    set_time_limit(0);
    $data = array();
    $companies = $this->db->select("id, Company_Name")->get_where("companies", ["id>="=>$start, "id<="=>$end])->result();
    $periods = $this->db->get("periods")->result();
    $document_types = $this->db->get("document_types")->result();
    foreach($companies as $company){
     $years = $this->db->get_where("years", ["company_id"=>($company->id)])->result();
     foreach($years as $yearsa){
         foreach($periods as $period){
             foreach($document_types as $document_type){
                $qrs = $this->db->query('SELECT * FROM `documents` WHERE document_company_id='.($company->id).' and document_year='.($yearsa->year).' and document_period="'.($period->period).'" and document_type_id="'.($document_type->id).'"')->row();
                if(!$qrs){
                $dta=new stdClass();
                $dta->id=$company->id;
                $dta->Company_Name=$company->Company_Name;
                $dta->year=$yearsa->year;
                $dta->period = $period->period;
                $dta->document_type=$document_type->name;
                array_push($data, $dta);
                echo json_encode($dta);
                break;
                 }
             }
         }
     }

    }
    //echo json_encode($data);

 }


 public function add5yearsofdata(){
         try{
    $this->load->model('Api_model');

           $this->load->model('Api_model');
       //$pds = json_decode($this->Api_model->getrefinitivedata());
        //print_r($pds->ExtractionRequest);
      $data = new stdClass();
      $data->Credentials=new stdClass();
      $data->Credentials->Username="9029829";
      $data->Credentials->Password="vif@2017";

  $post_data = json_encode($data);

  $crl = curl_init('https://selectapi.datascope.refinitiv.com/RestApi/v1/Authentication/RequestToken');
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

  // Set HTTP Header for POST request
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata'
  ));

  // Submit the POST request
  $result = curl_exec($crl);

  // handle curl error
  if ($result === false) {
       throw new Exception('Curl error: ' . curl_error($crl));
      print_r('Curl error: ' . curl_error($crl));

  } else {



      $auth_key = json_decode($result)->value;
      echo "Auth Key : ".$auth_key."<br>";
      $post_data = $this->Api_model->getricrequest();
    $main_url = 'https://selectapi.datascope.refinitiv.com/RestApi/v1/Extractions/ExtractRaw';
    $http_sign = false;
    $headers=[];
  $crl = curl_init($main_url);
  curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($crl, CURLINFO_HEADER_OUT, true);
  curl_setopt($crl, CURLOPT_POST, true);
  curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
  curl_setopt($crl, CURLOPT_FAILONERROR, true);
  curl_setopt($crl, CURLOPT_HEADERFUNCTION,
    function ($crl, $header) use (&$headers) {
        $len = strlen($header);
        $header = explode(':', $header, 2);
        if (count($header) < 2) // ignore invalid headers
            return $len;

        $headers[strtolower(trim($header[0]))][] = trim($header[1]);

        return $len;
    }
);
  // Set HTTP Header for POST request
  curl_setopt($crl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key
  ));


  $result = curl_exec($crl);
  $headerSent = curl_getinfo($crl, CURLINFO_HEADER_OUT );
  $httpcode = curl_getinfo($crl, CURLINFO_HTTP_CODE);

  if ($result === false) {
      throw new Exception('Curl error: ' . curl_error($crl));
      print_r('Curl error: ' . curl_error($crl));
      $result_noti = 0; die();
  } else {
        curl_close($crl);
    print($httpcode);
    if($httpcode==202){

        $location_url = $headers["location"][0];
        echo "\n".$location_url."</br>";

        $httpcode1=0;

        $crle = curl_init($location_url);
        curl_setopt($crle, CURLOPT_URL, $location_url);
        curl_setopt($crle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crle, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key
        ));
        $fdsf = explode("'", $location_url);
        $extraction_id = $fdsf[1];
        $new_uri= str_replace("JOBID", "$extraction_id", "https://selectapi.datascope.refinitiv.com/RestApi/v1/Extractions/RawExtractionResults('JOBID')/%24value");
        $ccoiu=0;

        error_reporting(E_ALL);
        $flag=0;
        echo "new URI".$new_uri;
        $curls = curl_init($new_uri);
        curl_setopt($curls, CURLOPT_URL, $new_uri);
        curl_setopt($curls, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curls, CURLOPT_ENCODING , "gzip");
        curl_setopt($curls, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
       'odata:minimalmetadata',
       'Prefer:respond-async',
        'Content-Type:application/json',
        'Authorization:Token '.$auth_key
        ));

        while(true){
        $resulte = curl_exec($crle);
        echo "\nHTTP COde  1 : ".curl_getinfo($crle, CURLINFO_HTTP_CODE);
        if(curl_getinfo($crle, CURLINFO_HTTP_CODE)==200){
         while(true){
        $resultxe = curl_exec($curls);
        echo "\nHTTP COde  2 : ".curl_getinfo($curls, CURLINFO_HTTP_CODE);
        if(curl_getinfo($curls, CURLINFO_HTTP_CODE)==200){
        $myfile = fopen("./apiresponse.csv", "w") or die("Unable to open file!");
        fwrite($myfile, $resultxe);
        fclose($myfile);
        print_r("\n Result : ".$resultxe);
        echo "\nRequest Info : \n";
        print_r(curl_getinfo($curls));

        $row = 1;
        $bigdata = array();
        if (($handle = fopen("./apiresponse.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo $num." ";
        $row++;
        $sdata["RIC"]=$data[0];
        $sdata["Alias"]=$data[1];
        $sdata["Domain"]=$data[2];
        $sdata["datentime"]=$data[3];
        $sdata["GMT_Offset"]=$data[4];
        $sdata["Type"]=$data[5];
        $sdata["Open"]=$data[6];
        $sdata["High"]=$data[7];
        $sdata["Low"]=$data[8];
        $sdata["Last"]=$data[9];
        $sdata["OpenBid"]=$data[10];
        $sdata["HighBid"]=$data[11];
        $sdata["LowBid"]=$data[12];
        $sdata["CloseBid"]=$data[13];
        $sdata["OpenAsk"]=$data[14];
        $sdata["HighAsk"]=$data[15];
        $sdata["LowAsk"]=$data[16];
        $sdata["CloseAsk"]=$data[17];
        print_r($sdata);
        $bigdata[] = $sdata;
        }
        $bigssur = array_chunk($bigdata, 8);
        foreach($bigssur as $subarr){
            $this->db->insert_batch('refinitiv5year', $subarr);
        }

    fclose($handle);
   }

        break;
        }
         }
        break;
        }
        }
         curl_close($crle);
                }
            else{
             }
            }
          }
        }
        catch(\Error $e){
         echo "Error : ".$e;
        }
 }

 public function loads(){
  
     $row = 0;
     $bigdata = array();
   	  $dataarray =json_decode(file_get_contents('./UpdatedNews01Oct20_28Nov21.json'));

      foreach($dataarray as $data){
      $dataji=array();
      $companies=array();
      $countries=array();
      $row++;
        if($row==1)
          continue;
        $num = count($data);
        $dataji["title"]= $data->title;
      	$dataji["date"]= $data->published_date;
      	$dataji["image_url"]= $data->image;
      	$dataji["source"]= $data->source;
      	$dataji["link"]= $data->link;
        $dataji["created"] = date("Y-m-d");
      	if($this->db->insert("api_data", $dataji)){
        $insert_id = $this->db->insert_id();
        $companies = explode(",", $data->company);
          //$companies = $data->company;
        for($count=0; $count<COUNT($companies); $count++)
         $this->db->insert("api_data_companies", ["company"=>$companies[$count], "data_id"=>$insert_id]);
      	$dataji["companies"]=$companies;
       	$countries = explode(",", $data->country);
          //$countries = $data->country;
        for($count=0; $count<COUNT($countries); $count++)
         $this->db->insert("api_data_countries", ["country"=>$countries[$count], "data_id"=>$insert_id]);
      	$dataji["Countries"]= $countries;
      	$bigdata[]=$dataji;
        }
      	else{
          echo "Error";
          break;
        }
       	print_r(json_encode($companies));
       }
 }

 public function loadd(){
 $filedata = json_decode(file_get_contents("./data.json", "r"));
 $totallines =  COUNT($filedata);
 $bigdata = array();
 for($i=0; $i<$totallines; $i++){
        $value = $filedata[$i];
        $data["RIC"]=$value->{'#RIC'};
        $data["Alias"]=$value->{'Alias Underlying RIC'};
        $data["Domain"]=$value->Domain;
        $data["datentime"]=$value->{'Date-Time'};
        $data["GMT_Offset"]=$value->{'GMT Offset'};
        $data["Type"]=$value->Type;
        $data["Open"]=$value->Open;
        $data["High"]=$value->High;
        $data["Low"]=$value->Low;
        $data["Last"]=$value->Last;
        $data["OpenBid"]=$value->{'Open Bid'};
        $data["HighBid"]=$value->{'High Bid'};
        $data["LowBid"]=$value->{'Low Bid'};
        $data["CloseBid"]=$value->{'Close Bid'};
        $data["OpenAsk"]=$value->{'Open Ask'};
        $data["HighAsk"]=$value->{'High Ask'};
        $data["LowAsk"]=$value->{'Low Ask'};
        $data["CloseAsk"]=$value->{'Close Ask'};
        print_r($data);
        //if($this->db->insert("refinitiv5year", $data))
        //echo "Inserted\n";
        //echo $this->db->last_query()."\n";
        //$bigdata[]=$data;
        }
        //print_r($bigdata);
        //$this->db->insert_batch('refinitiv5year', $bigdata);

 }


  public function changedate(){
    $data = $this->db->get("api_data")->result();
    foreach($data as $value)
      $this->db->update("api_data", ["date"=>date("d-m-y H:i", strtotime($value->date))], ["id"=>$value->id]);
  }



  public function verify_email($v_code=""){
    $ver_code = $this->db->get_where("email_verfication_tokens", ["verification_code"=>$v_code])->row();
    if($ver_code){
      $email = $ver_code->email;
      $this->db->update("users", ["email_verified"=>1], ["email"=>$email]);
      $this->load->view("emailverify", ["email"=>$email]);
    }
    else{
      echo '<h1>Unauthorized</h1>';
    }
  }


  public function testotp(){
    require_once(APPPATH.'libraries/twilloOtp.php');
    $twillo = new twilloOtp();
	$twillo->sendOtp('+910000000000', 'This is testing message');
  }

  public function sendIosNotification(){
     require_once(APPPATH.'libraries/iosnotification.php');
     $obj = new iosnotification();
     $obj->sentNotification();
  }

  public function phpinf(){
  	print_r(phpinfo());
  }

  public function termsncondition(){
    	$data = $this->db->get("termsncondition")->row()->description;
    	echo $data;
        //$this->load->view("documentview", ["outputs"=>$data]);
      	//$html = $this->output->get_output();
        //$this->load->library('pdf');
 		//$this->pdf->load_html($data);
 		//$this->pdf->set_paper('A4', 'portrait');
 		//$this->pdf->render();
 		// Output the generated PDF (1 = download and 0 = preview)
 		//$this->pdf->stream("termsncondition.pdf", array("Attachment"=> 0));
  }

  public function privacynpolicy(){
      $data = $this->db->get("privacy_policy")->row()->description;
      echo $data;
  }


  public function loadmissing($from_companies, $to_companies){
    ini_set('memory_limit', '1500M');
    ini_set('max_execution_time', 0);
    $companies = $this->db->get_where('companies', ["id>="=>$from_companies, "id<="=>$to_companies])->result();
    $periods = ["Q1", "Q2", "Q3", "Q4", "Annual"];
    $document_types = [1, 2, 3, 4, 5, 6, 7, 8];
    $missings = array();
    foreach($companies as $company){
      	$years = $this->db->get_where("years", ["company_id"=>$company->id])->result();
      	foreach($years as $year){
        	foreach($periods as $period){
                $m_data['companyname'] = $company->Company_Name;
                $m_data['symbol'] = $company->SymbolTicker;
                $m_data['country'] = $company->Country;
              	$m_data['year'] = $year->year;
              	$m_data['periods'] = $period;
                $m_data['reports'] = "";
               	$m_data['CF'] = 0;
              	$m_data['BS'] = 0;
              	$m_data['IS'] = 0;
              	$m_data['OCI'] = 0;
              	$m_data['CIE'] = 0;
              	$m_data['Notes'] = 0;
              	$m_data['Financial'] = 0;
            	foreach($document_types as $key => $document_type){
                	if($this->db->get_where('documents', ['document_company_id'=>$company->id, 'document_year'=>$year->year, 'document_period'=>$period, 'document_type_id'=>$document_type])->row()){
  					 	if($document_type==4)
                        $m_data['CF'] = 1;
                      else if($document_type==1)
                        $m_data['IS'] = 1;
                      else if($document_type==2)
                        $m_data['BS'] = 1;
                      else if($document_type==3)
                        $m_data['OCI'] = 1;
                      else if($document_type==5)
                        $m_data['CIE'] = 1;
                      else if($document_type==6)
                        $m_data['Notes'] = 1;
                      else if($document_type==8)
                        $m_data['Financial'] = 1;
                    }
                }
                $missings[] = $m_data;
            }
        }
    }
    $json_data = json_encode($missings);
    $myfile = fopen("./testfile.json", "w");
    fwrite($myfile, $json_data);
    echo $json_data;
  }

  public function loadcurrencies_cron(){
  	$url = "https://api.currencyapi.com/v3/latest";
	echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    $resdata = (array) json_decode($resp)->data;
    $all_key = array_keys($resdata);
    foreach($all_key as $key){
        $currency = $resdata[$key];
    	if($this->db->get_where('currencies_rate', ['currency'=>$key])->row()){
          $this->db->update('currencies_rate', ['rate'=>$currency->value], ['currency'=>$key]);
        }
        else{
          $this->db->insert('currencies_rate', ['rate'=>$currency->value, 'currency'=>$key]);
        }
    }
    //print_r(json_encode(json_decode($resp)->data));
    print_r('Currencies Loaded');
    curl_close($curl);

  }

  public function privacypolicy(){
  	$content = $this->db->get('privacy_policy')->row()->description;
    $this->load->view('basic_pages', ['title'=>'Privacy and Policies', 'content'=>$content]);
  }

  public function aboutus(){
  	$content = $this->db->get('about_us')->row()->description;
    $this->load->view('basic_pages', ['title'=>'About Us', 'content'=>$content]);
  }

  public function termsconditions(){
  	$content = $this->db->get('termsncondition')->row()->description;
    $this->load->view('basic_pages', ['title'=>'Terms and Conditions', 'content'=>$content]);
  }
}
