<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
         date_default_timezone_set('Asia/Kolkata');
    }

    public function register_user($data){
        $data["created"] = date("Y-m-d H:i:s");
        $this->db->insert("users", $data);
      	return $this->db->insert_id();
    }

    public function update_user($token, $data){
        $this->db->update("users", $data, ["token"=>$token]);
    }

    public function login_user_email($data){
        $logindata = $this->db->get_where("users", ["email"=>$data["email"], "password"=>$data["password"]])->row();
        if($logindata)
            return $logindata->token;
        else
            return false;
    }

    public function login_user_phone($data){
        $logindata = $this->db->get_where("users", ["mobile"=>$data["mobile"], "password"=>$data["password"]])->row();
        if($logindata)
            return $logindata->token;
        else
            return false;
    }

    public function getuser($token){
        $data = $this->db->select("first_name, last_name, email, country_code, mobile, profile_pic, login_type, social_id, token, email_verified")->get_where("users", ["token"=>$token])->row();
        return $data;
    }

    public function userlogin_post(){
$pass=$this->post('password');
$phone=$this->post('mobile');
if(!empty($pass)&&!empty($phone))
if($userdata=$this->user->checklogin($phone, $pass)){
$this->response([
					'status' => "TRUE",
					'message' => 'Login successfully.',
					'data' =>$userdata
				], REST_Controller::HTTP_OK);
}
else
$this->response([
					'status' => FALSE,
					'message' => 'Login Unsuccessful.',
				], REST_Controller::HTTP_OK);
else
$this->response([
					'status' => FALSE,
					'message' => 'Please complete all requirements.',
				], REST_Controller::HTTP_NOT_FOUND);
}


public function getLinkedInProfile($code="", $redirect_url=""){
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);
    $ch = curl_init('https://www.linkedin.com/oauth/v2/accessToken');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

    $redirectUri = urlencode($redirect_url);
    $gt = urlencode('authorization_code');
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=$gt&code=$code&redirect_uri=$redirect_url&client_id=78ofvholrg325a&client_secret=KF0GD7kGpwFkR85D");
    // execute!
    $response = curl_exec($ch);
    // close the connection, release resources used
    curl_close($ch);
    // $response contains
    $json = json_decode($response);

    $accessToken = $json->access_token;

    $url = 'https://api.linkedin.com/v2/me?projection=(id,localizedLastName,localizedFirstName,profilePicture(displayImage~:playableStreams))';
    $crl = curl_init();

    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$accessToken));

    $userDataJson = curl_exec($crl);

    $userData = json_decode($userDataJson,true);
    $userName = $userData['localizedFirstName'].' '.$userData['localizedLastName'];
    $userProfilePic = $userData['profilePicture']['displayImage~']['elements'][0]['identifiers'][0]['identifier'];

    curl_close($crl);

    //  4. GET request for user email
    $email = 'https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))';
    $emailcrl = curl_init();

    curl_setopt($emailcrl, CURLOPT_URL, $email);
    curl_setopt($emailcrl, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($emailcrl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($emailcrl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$accessToken));

    $email_response = curl_exec($emailcrl);

    $userEmail = json_decode($email_response,true);

    $userEmail = $userEmail['elements'][0]['handle~']['emailAddress'];

    curl_close($emailcrl);

    $response = array();
    $response["email"] = $userEmail;
    $response["userdata"] = $userData;
    $response["profile_pic"] = $userProfilePic;
    return $response;
  }

   function getlastreport($symbolticker=""){
    $symbolticker = urldecode($symbolticker);
    if($symbolticker!=""){
      $datas = $this->db->query("SELECT DISTINCT d2.document_period,d2.document_year, c2.Company_Name, c2.SymbolTicker FROM `documents` AS d2, `companies` AS c2 WHERE document_year=(SELECT MAX(d1.document_year) FROM `documents` AS d1, `companies` AS c1 WHERE c1.id = d1.document_company_id AND c1.SymbolTicker = '$symbolticker' ORDER By d1.document_year DESC) AND c2.SymbolTicker ='$symbolticker' AND c2.id = d2.document_company_id")->result();
      $annual_c = array();
      $q1_c = array();
      $q2_c = array();
      $q3_c = array();
      $q4_c = array();
      
      if (count($datas)> 0){
            foreach($datas as $data){
              if($data->document_period=='Annual'){
                 $annual_c[] = $data;
              }
              if($data->document_period=='Q1'){
                 $q1_c[] = $data;
              }
              if($data->document_period=='Q2'){
                 $q2_c[] = $data;
              }
              if($data->document_period=='Q3'){
                 $q3_c[] = $data;
              }
              if($data->document_period=='Q4'){
                 $q4_c[] = $data;
              }
            }

            if(COUNT($annual_c)>0){
                return "Annual - ".$datas[0]->document_year;
            }
        	if(COUNT($q4_c)>0){
                return "Q4 - ".$datas[0]->document_year;
            }
            if(COUNT($q3_c)>0){
                return "Q3 - ".$datas[0]->document_year;
            }
            if(COUNT($q2_c)>0){
                return "Q2 - ".$datas[0]->document_year;
            }
            if(COUNT($q1_c)>0){
                return "Q1 - ".$datas[0]->document_year;
            }

            return "";
      }else{
        return "";
      }

    }else{
		return "";
    }
  }

}
?>
