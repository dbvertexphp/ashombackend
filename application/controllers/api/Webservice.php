<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit', '8192M');
ini_set('max_execution_time', 0);
//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';


// Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
       	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 906400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);
    }


class Webservice extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('email');
        $this->load->model('user');
      	$this->load->model('mails');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->helper('user');
        date_default_timezone_set('UTC');
    }

  function tokenplace($url) {
   $url = base64_encode($url);
   $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
   $url = trim($url, "-");
   $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
   $url = strtolower($url);
   $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
   return $url;
}


  public function user_post(){
    $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
    $this->form_validation->set_rules('device_id', 'Device ID', 'required|xss_clean');
    $this->form_validation->set_rules('country_code', 'Country Code', 'xss_clean');
    $this->form_validation->set_rules('email', 'Email ID', 'required|valid_email|xss_clean');

    $login_type = $this->input->post("login_type");

    $device_token = $this->input->post("device_token");


    if(isset($login_type)&&!empty($login_type)&&($login_type=="normal")){
       $data["email_verified"]=0;
    $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
    $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric|is_unique[users.mobile]|xss_clean', ["is_unique"=>"This Mobile is already present in our database"]);
    }
    else if(isset($login_type)&&!empty($login_type)&&(($login_type=="linkedin")||($login_type=="google")||($login_type=="apple"))){
       $data["email_verified"]=1;
    $this->form_validation->set_rules('social_id', 'social_id', 'required|is_unique[users.social_id]|xss_clean', ["is_unique"=>"This Social Id is already present in our database"]);
    }
    else{
        $str["status"] =false;
        $str["message"] =  "Login type must normal, linkedin, facebook and apple";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
    $this->form_validation->set_rules('login_type', 'Login Type', 'required|xss_clean');

    $this->form_validation->set_error_delimiters('', '');
    if ($this->form_validation->run()){
          $email = $this->input->post("email");
          $isemailexists = $this->db->get_where("users", ["email"=>$email])->row();
          if(!$isemailexists){
          $data["first_name"] = $this->input->post("first_name");
          $data["last_name"] = $this->input->post("last_name");
          $data["email"] = $this->input->post("email");
          $data["mobile"] = $this->input->post("mobile");
          $data["login_type"] = $this->input->post("login_type");
          $data["social_id"] = $this->input->post("social_id");
          $data["password"] = base64_encode($this->input->post("password"));
          $data["device_id"] = $this->input->post("device_id");
          $data["country_code"] = $this->input->post("country_code");
          //$data["device_version"] = $this->input->post("device_version");
          $social_id = $this->input->post("social_id");
          if(isset($social_id)&&!empty($social_id)){
          $data["token"] = $social_id;
        }
        else{
        $data["token"] = md5(date("YmdHis").$data["email"]);

        }
        $profilepic_as_text = $this->input->post("profile_pic");
        if (!empty($_FILES['profile_pic']['name'])) {
                    $config['upload_path'] = './uploads/profile/';
                    // $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf';
                    $config['allowed_types'] = '*';
                    $config['remove_spaces'] = TRUE;
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('profile_pic')) {
                    $image_data = $this->upload->data();
                    $filename = $image_data['file_name'];
                    $data['profile_pic'] = base_url("uploads/profile/".$filename);
          }
        }
        else if(isset($profilepic_as_text)&&!empty($profilepic_as_text)){
            $data['profile_pic'] = $profilepic_as_text;
        }
          $app_version = $this->input->post("app_version");
		 if(isset($app_version)&&!empty($app_version)){
           $data["app_version"] = $app_version;
         }

         $user_isd =  $this->user->register_user($data);
        unset($data["password"]);

          $data["subscribed"] = is_user_subscribed($user_isd);
          $subscription = get_subscription($user_isd);
          $data["subscription_expiry_date"] = $subscription?$subscription->expire_on:"";
          $data["subscription_type"] = $subscription?$subscription->subscription_type:"";

        // unset($data["token"]);
        $verfication_code = md5(date("YmdHis").$data["email"]);
        $this->db->insert("email_verfication_tokens", ["email"=>$data["email"],"verification_code"=>$verfication_code]);
		$insf_usr =new stdClass();
       if($login_type=="normal"){
          $app_version = $this->input->post("app_version");
		if(isset($app_version)&&!empty($app_version)){
           		$otp = rand(100000, 999999);
           		$this->db->update("users", ["otp"=>$otp], ["id"=>$user_isd]);
				require_once(APPPATH.'libraries/twilloOtp.php');
    			$twillo = new twilloOtp();
           		$sendMobile = "+".$data["country_code"].$data["mobile"];

           		$this->mails->sendmail($data["email"], $data["first_name"]." ".$data["last_name"], "Verify your OTP - Ashom.App", "Hello ".$data["first_name"].", This is your OTP $otp. <br> Do not share this OTP with anyone.");
        		try{
           		$twillo->sendOtp($sendMobile, "Hello ".($data["first_name"]).", \nYour verificaton OTP for ashom.app is $otp \n Please do not share this OTP with anyone.");
                }
           		catch(Exception $e){
                  $message = "$e";
                }


                $message = 'Registration Successful. OTP has been sent to email and your phone number. Please Verfiy OTP first before login';
           //$message = 'Registration Successful. OTP has been sent to your phone number. Please Verfiy OTP first before login';
         }else{
        	$this->mails->sendmail($data["email"], $data["first_name"]." ".$data["last_name"], "Verify your Email - Ashom.App", "Hello ".$data["first_name"].", This is your email verification link. Please <a href='".base_url()."/verify_email/$verfication_code'>click here</a>");
        	$message = 'Registration Successful. Email verification link is sent on registered email. Please Verfiy first before login';
        	}

          }
          else{
          $message = 'User Registered Successfully.';
          $insf_usr = $this->db->get_where("users", ["id"=>$user_isd])->row();
            unset($insf_usr->id);
            unset($insf_usr->password);
          }
          $this->makesubscription($data["token"], date("Y-m-d", strtotime(date("Y-m-d")." +1 month")), "Free", 0);
            if(isset($device_token)&&!empty($device_token))
            $this->db->insert("device_tokens", ["user_id"=>$user_isd, "device_token"=>$device_token]);
         $this->response([
        'status' => TRUE,
        'message' => $message,
        'userdata' => ($insf_usr)?$insf_usr: (new stdClass())

        ], REST_Controller::HTTP_OK);
        }
        else{
        $str = array();
        $str["first_name_error"] = "";
        $str["last_name_error"] = "";
        $str["email_error"] = "This Email is already registered with login type [".($isemailexists->login_type)."].";
        $str["password_error"] = "";
        $str["mobile_error"] = "";
        $str["login_type_error"] = "";
        $str["social_id_error"] = "";
        $str["device_id_error"] = "";
        $str["country_code_error"] = "";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    else{
        $str = array();
        $str["first_name_error"] = form_error('first_name');
        $str["last_name_error"] = form_error('last_name');
        $str["email_error"] = form_error('email');
        $str["password_error"] = form_error('password');
        $str["mobile_error"] = form_error('mobile');
        $str["login_type_error"] = form_error('login_type');
        $str["social_id_error"] = form_error('social_id');
        $str["device_id_error"] = form_error('device_id');
        $str["country_code_error"] = form_error('country_code');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function resendotp_get($mobile=0){
    if($mobile!=0){
        $userdata = $this->db->get_where("users", ["mobile"=>$mobile])->row();
       	if($userdata){
        $otp = rand(100000, 999999);
        $this->db->update("users", ["otp"=>$otp], ["id"=>$userdata->id]);
      	require_once(APPPATH.'libraries/twilloOtp.php');
    	$twillo = new twilloOtp();
        $sendMobile = "+".($userdata->country_code).($userdata->mobile);
          try{
           $twillo->sendOtp($sendMobile, "Hello ".($userdata->first_name).", \nYour verificaton OTP for ashom.app is $otp \n Please do not share this OTP with anyone.");
          }
          catch(Exception $e){
            $str["status"] = false;
            $str["message"] = "OTP doesn't sent. Reason may be your invalid Mobile Number.";
            $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
          }
          $this->mails->sendmail($userdata->email, $userdata->first_name." ".$userdata->last_name, "Verify your OTP - Ashom.App", "Hello ".$userdata->first_name.", This is your OTP $otp. <br> Do not share this OTP with anyone.");
          $str["status"] = true;
      	  $str["message"] = "OTP sucessfully sent.";
          $this->response($str, REST_Controller::HTTP_OK);
        }
        else{
          $str["status"] = false;
      	  $str["message"] = "User not found in our database.";
          $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
        }
     }
    	else{
          $str["status"] = false;
      	  $str["message"] = "Complete Paramter.";
          $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
        }
  }

  public function verifyotp_get($phone=0, $otp=0){
    if(isset($phone)&&!empty($phone)&&isset($otp)&&!empty($otp)){
    $result = $this->db->get_where("users", ["mobile"=>$phone, "otp"=>$otp])->row();
    if($result){
      	$this->db->update("users", ["email_verified"=>1, "otp_verified"=>1], ["mobile"=>$phone]);
      	$str["status"] = true;
      	$str["message"] = "OTP Verified";
      	$str["token"] = $result->token;
      	$this->response($str, REST_Controller::HTTP_OK);
    }
    else{
      	$str["status"] = false;
      	$str["message"] = "OTP does not matched with our request.";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    else{
    	$str["status"] = false;
      	$str["message"] = "Enter all parameters";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function updateuser_post(){
    $this->form_validation->set_rules('token', 'Token', 'required|xss_clean');
    $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
    $this->form_validation->set_rules('email', 'Email ID', 'required|valid_email|xss_clean', ["is_unique"=>"This Email is already present in our database"]);
    $mobile = $this->input->post("mobile");
    $country_code = $this->input->post("country_code");
    if(isset($mobile)&&!empty($mobile))
    $this->form_validation->set_rules('mobile', 'Mobile Number', 'numeric|xss_clean', ["is_unique"=>"This Mobile is already present in our database"]);
    $this->form_validation->set_error_delimiters('', '');
    if ($this->form_validation->run()){
        $token = $this->input->post("token");
        $data["first_name"] = $this->input->post("first_name");
        $data["last_name"] = $this->input->post("last_name");
        $data["email"] = $this->input->post("email");
        if(isset($mobile)&&!empty($mobile))
        $data["mobile"] = $this->input->post("mobile");
        if(isset($country_code)&&!empty($country_code))
        $data["country_code"] = $this->input->post("country_code");
        $profilepic_as_text = $this->input->post("profile_pic");
        if (!empty($_FILES['profile_pic']['name'])) {
                    $config['upload_path'] = './uploads/profile/';
                    // $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf';
                    $config['allowed_types'] = '*';
                    $config['remove_spaces'] = TRUE;
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('profile_pic')) {
                    $image_data = $this->upload->data();
                    $filename = $image_data['file_name'];
                    $data['profile_pic'] = base_url("uploads/profile/".$filename);
          }
        }
        else if(isset($profilepic_as_text)&&!empty($profilepic_as_text)){
            $data['profile_pic'] = $profilepic_as_text;
        }
        $this->user->update_user($token, $data);
        $userdata = $this->db->select("first_name, last_name, email, mobile, profile_pic, login_type, social_id, device_id, country_code, token, email_verified")->get_where("users", ["token"=>$token])->row();
      	$userdata->subscribed = is_user_subscribed(get_userid_bytoken($token));
      	$subscription = get_subscription(get_userid_bytoken($token));
        $userdata->subscription_type = $subscription?$subscription->subscription_type:"";
        $userdata->subscription_expiry_date = $subscription?$subscription->expire_on:"";
        $this->response([
        'status' => TRUE,
        'message' => 'Profile Updated Successfully.',
        'userdata' =>  $userdata
        ], REST_Controller::HTTP_OK);
    }
    else{
        $str = array();
        $str["token_error"] = form_error('token');
        $str["first_name_error"] = form_error('first_name');
        $str["last_name_error"] = form_error('last_name');
        $str["email_error"] = form_error('email');
        $str["mobile_error"] = form_error('mobile');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function login_post(){
    $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
    $this->form_validation->set_rules('email', 'Email ID', 'required|valid_email|xss_clean');
    $this->form_validation->set_error_delimiters('', '');
    $device_token = $this->input->post("device_token");
     if(!isset($device_token)||empty($device_token))
       $device_token="";
    	$otp =0;
    if ($this->form_validation->run()){
        $email = $this->input->post("email");
        if(is_user_exists($email)){
        $login_type = get_user_login_type($email);
        if($login_type=="normal"){
        $data["email"] = $this->input->post("email");
        $data["password"] = base64_encode($this->input->post("password"));
          $udata = $this->db->get_where("users", ["email"=>$email])->row();
          $otp = $udata->otp;
		if(!is_this_email_verified($data["email"])){
          if($otp==0)
          	$this->response([
        	'status' => FALSE,
        	'message' => 'Please! Verify Email Before Login',
        	], REST_Controller::HTTP_UNAUTHORIZED);
          else
             $this->response([
        	'status' => FALSE,
        	'message' => 'Please! Verify OTP Before Login',
        	'mobile' => $udata->mobile,
            'otp_verfied'=>($udata->otp_verified==1)?true:false,
        	'country_code' => $udata->country_code,
            'user_email' => $udata->email
        	], REST_Controller::HTTP_UNAUTHORIZED);
        }
        $result = $this->user->login_user_email($data);
        if($result){
          //$this->db->insert("device_tokens", ["user_id"=>($udata->id), "device_token"=>$device_token]);
          $this->response([
          'status' => TRUE,
          'message' => 'Login Successfull.',
          'otp_verfied'=>($udata->otp_verified==1)?true:false,
          'token' => $result
          ], REST_Controller::HTTP_OK);
        }
        else
        $this->response([
        'status' => FALSE,
        'message' => 'Email or Password Wrong.'
        ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else{
        $str = array();
        $str["email_error"] = form_error('email');
        $str["password_error"] = form_error('password');
        $str["login_error"] = "User registered with $login_type. So, login with $login_type";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
        }
        }
        else{
        $str = array();
        $str["email_error"] = form_error('email');
        $str["password_error"] = form_error('password');
        $str["login_error"] = "User Not Found in our Database";
        $this->response($str, REST_Controller::HTTP_NOT_FOUND);
        }
    }
    else{
        $str = array();
        $str["email_error"] = form_error('email');
        $str["password_error"] = form_error('password');
        $str["login_error"] = "";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
  }

    public function signout_get($token="", $fcm_token=""){
        if($token!=""){
            $this->db->update("users", ["device_id"=>""], "token='$token'");
            $this->db->delete("device_tokens", ["device_token"=>$fcm_token]);
            $this->response([
                'status' => TRUE,
                'message' => 'Signout Successfull.',
                ], REST_Controller::HTTP_OK);
        }
        else{
            $this->response([
        'status' => FALSE,
        'message' => 'Please Provide Token to Signout.',
        ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function userdata_post(){
        $this->form_validation->set_rules('token', 'Token', 'required');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run()){
        $token = $this->input->post("token");
        $data = $this->user->getuser($token);

        if($data){
          $data->profile_pic = str_replace("https://ashom.app", base_url(), ($data->profile_pic));
          if($data->email_verified==0){
             $this->response([
        'status' => FALSE,
        'message' => 'Please! Verify Email First to get userdata',
        ], REST_Controller::HTTP_UNAUTHORIZED);
          }

          $data->subscribed = is_user_subscribed(get_userid_bytoken($token));
          $subscription = get_subscription(get_userid_bytoken($token));
          $data->subscription_type = $subscription?$subscription->subscription_type:"";
          $data->subscription_expiry_date = $subscription?$subscription->expire_on:"";
            $this->response([
        'status' => TRUE,
        'message' => 'User information get successfully.',
        'login_token' => ''.$data->token,
        'userdata' =>  $data
        ], REST_Controller::HTTP_OK);
        }
        else{
            $this->response([
           'status' => FALSE,
          'message' => 'User not found.'
          ], REST_Controller::HTTP_NOT_FOUND);
         }
        }
    else{
        $str = array();
        $str["token_error"] = form_error('token');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
     }
    }

public function forgetpassword_post(){
    $email=$this->post("email");
    if(!empty($email)&&isset($email)){
    $user = get_user_by_email($email);
    if($user){
    $login_type = get_user_login_type($email);
    if($login_type=="normal"){
    $full_name=$user->first_name." ".$user->last_name;
    $Subject = "Forgot Password - Ashom.App";
      $new_password =  substr(base64_encode(date("siHsY")), 0, 6);
    $new_password_enc =  base64_encode($new_password);
      $this->db->update("users", ["password"=>$new_password_enc], ["email"=>$email]);
    $Body = '<!doctype html><html lang="en-US"><head> <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> <title>Reset Password - Ashom.app</title> <meta name="description" content="Reset Password Email Template."> <style type="text/css"> a:hover {text-decoration: underline !important;} </style></head><body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0"> <!--100% body table--> <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); "> <tr> <td> <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0"> <tr> <td style="height:80px;">&nbsp;</td> </tr> <tr> <td style="text-align:center;"> <a href="https://ashom.app" title="logo" target="_blank"><!-- <img width="60" src="https://ashom.app/assets/ashomlogo.png"  title="logo" alt="logo">--> </a> </td> </tr> <tr> <td style="height:20px;">&nbsp;</td> </tr> <tr> <td> <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);"> <tr> <td style="height:40px;">&nbsp;</td> </tr> <tr> <td style="padding:0 35px;"> <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:Rubik ,sans-serif;">You have requested to reset your password</h1> <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span> <p style="color:#455056; font-size:15px;line-height:24px; margin:0;"> You have requested forget password. These is your auto generated new password, you can change according to you this after login. </p> <span style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">New Password : '.$new_password.'</span> </td> </tr> <tr> <td style="height:40px;">&nbsp;</td> </tr> </table> </td> <tr> <td style="height:20px;">&nbsp;</td> </tr> <tr> <td style="text-align:center;"> <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.ashom.app</strong></p> </td> </tr> <tr> <td style="height:80px;">&nbsp;</td> </tr> </table> </td> </tr> </table> <!--/100% body table--></body></html>';

    try {
        $this->mails->sendmail($email, $full_name, $Subject, $Body);
         $this->response([
                            'status' => TRUE,
                            'message' => 'Password has been sent on registered email'
                        ], REST_Controller::HTTP_OK);
    } catch (Exception $e) {
       $this->response([
                            'status' => FALSE,
                            'message' =>  $mail->ErrorInfo
                        ], REST_Controller::HTTP_BAD_REQUEST);

    }
}
        else{
        $str = array();
        $str["email_error"] = "User registered with $login_type. Can't Forget Password";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
      }
    }
    else{
        $str = array();
        $str["email_error"] = "Email Not Found in our Database";
        $this->response($str, REST_Controller::HTTP_NOT_FOUND);
        }
}
else{
    $str = array();
    $str["email_error"] = "Email required in Forget Password";
    $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
}
}


/////////////////////Forums//////////////////////////////////////////////////

public function forum_post(){
 	$token = $this->input->post("token");
 	$content = $this->input->post("content");
  	$height = $this->input->post("image_height");
  	$width = $this->input->post("image_width");
 $content_image = !empty(!empty($_FILES['content_image']['name']));
 if(isset($token)&&!empty($token)&&((isset($content)&&!empty($content))||$content_image)){
     $user_data = $this->db->get_where("users", ["token"=>$token])->row();
     if($user_data){
         $user_id = $user_data->id;
     $data["content"] = $content;
     $data["image_width"] = (isset($width)&&!empty($width))?$width:"";
     $data["image_height"] = (isset($height)&&!empty($height))?$height:"";
     $data["user_id"] = $user_id;
     $data['created'] = date("Y-m-d H:i:s");

       $content_image_as_text = $this->input->post("content_image");
     if (!empty(!empty($_FILES['content_image']['name']))) {
          $_FILES['file']['name']     = $_FILES['content_image']['name'];
          $_FILES['file']['type']     = $_FILES['content_image']['type'];
          $_FILES['file']['tmp_name'] = $_FILES['content_image']['tmp_name'];
          $_FILES['file']['error']     = $_FILES['content_image']['error'];
          $_FILES['file']['size']     = $_FILES['content_image']['size'];
          $config['upload_path'] = './uploads/forum_images/';
          $config['allowed_types'] = '*';
      	 $new_name = time().$_FILES['file']['name'] ;
      	 $config['file_name'] = $new_name;
          $this->load->library('upload', $config);
          $this->upload->initialize($config);

               if($this->upload->do_upload('file')){
              $fileData = $this->upload->data();
              $data['content_image'] = base_url()."/uploads/forum_images/".$fileData['file_name'];
             	                         }
         }
       else if(isset($content_image_as_text)&&!empty($content_image_as_text)){
            $data['content_image'] = $content_image_as_text;
        }
         if($this->db->insert("forums", $data))
          $this->response(['status' => TRUE,
                'message' =>'Forum added successfuly.'], REST_Controller::HTTP_OK);
     }
     else{
          $this->response(['status' => FALSE,
                'message' =>'User not found.'], REST_Controller::HTTP_NOT_FOUND);
     }
 }
 else{
     $this->response(['status' => FALSE,
                'message' =>'Please complete all parameters'], REST_Controller::HTTP_BAD_REQUEST);
 }
}



public function updateforum_post(){
 $content = $this->input->post("content");
 $forum_id = $this->input->post("forum_id");
 $content_image = !empty(!empty($_FILES['content_image']['name']));

 if(isset($forum_id)&&!empty($forum_id)&&((isset($content)&&!empty($content))||$content_image)){

	 $data["isEdited"] = 1;
     $data["content"] = $content;
     $data['created'] = date("Y-m-d H:i:s");
     if (!empty(!empty($_FILES['content_image']['name']))) {
          $_FILES['file']['name']     = $_FILES['content_image']['name'];
          $_FILES['file']['type']     = $_FILES['content_image']['type'];
          $_FILES['file']['tmp_name'] = $_FILES['content_image']['tmp_name'];
          $_FILES['file']['error']     = $_FILES['content_image']['error'];
          $_FILES['file']['size']     = $_FILES['content_image']['size'];
          $config['upload_path'] = './uploads/forum_images/';
          $config['allowed_types'] = '*';
          $this->load->library('upload', $config);
          $this->upload->initialize($config);

               if($this->upload->do_upload('file')){
             	 $fileData = $this->upload->data();
              		$data['content_image'] = base_url()."/uploads/forum_images/".$fileData['file_name'];

                        }
                    }
         if($this->db->update("forums", $data, ["id"=>$forum_id]))
          $this->response(['status' => TRUE,
                'message' =>'Forum Updated successfuly.'], REST_Controller::HTTP_OK);

 }
 else{
     $this->response(['status' => FALSE,
                'message' =>'Please complete all parameters'], REST_Controller::HTTP_BAD_REQUEST);
 }
}

public function deleteforum_get($forum_id=0){
  if($forum_id==0)
    $this->response(['status' => FALSE,
                'message' =>'Please complete all parameters'], REST_Controller::HTTP_BAD_REQUEST);
  $this->db->delete("forums_likes", ["forum_id"=>$forum_id]);
  $this->db->delete("forum_comments", ["forum_id"=>$forum_id]);
  $this->db->delete("forum_dislikes", ["forum_id"=>$forum_id]);
  $this->db->delete("polling_select", ["forum_id"=>$forum_id]);
	$this->db->delete("forums", ["id"=>$forum_id]);
  $this->response(['status' => TRUE,
                'message' =>'Forum Deleted successfuly.'], REST_Controller::HTTP_OK);
}


public function deleteforumImage_get($forum_id=0){
  $forum = $this->db->get_where("forums", ["id"=>$forum_id])->row();
   $image = str_replace(base_url(), ".", $forum->content_image);
   if(unlink($image)){
	$this->db->update("forums", ["content_image"=>""], ["id"=>$forum_id]);
  $this->response(['status' => TRUE,
                'message' =>'Forum Deleted successfuly.'], REST_Controller::HTTP_OK);
   }
  else{
    $this->response(['status' => TRUE,
                'message' =>'Image Not Found : $image'.$image], REST_Controller::HTTP_BAD_REQUEST);
  }
}

  public function deleteallforums_post(){
    $forum_ids = $this->input->post("ForumIds");
    $forms_id_arr = explode(",", $forum_ids);
    foreach($forms_id_arr as $value){
       	$this->db->delete("forums_likes", ["forum_id"=>$value]);
  		$this->db->delete("forum_comments", ["forum_id"=>$value]);
  		$this->db->delete("forum_dislikes", ["forum_id"=>$value]);
  		$this->db->delete("polling_select", ["forum_id"=>$value]);
    	$this->db->delete("forums", ["id"=>$value]);
    	}
    $this->response(['status' => TRUE,
                'message' =>'Forum Deleted successfuly.'], REST_Controller::HTTP_OK);
	}

public function forum_get($token=""){
    if($token!=""){
    $user_data = $this->db->get_where("users", ["token"=>$token])->row();
    if($user_data){
    $forums = $this->db->select("forums.*, users.first_name, users.last_name, users.profile_pic, isEdited, image_width, image_height")->order_by("forums.created", "desc")->join("users", "forums.user_id=users.id")->get("forums")->result();
    foreach($forums as $index => $value){
        if($value->forum_type=="poll"){
            $value->options = json_decode($value->options);
            $inst = $value->options;
            $total_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id"=>($value->id)])->row()->total;
            $option1_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id"=>($value->id), "selected_option"=>1])->row()->total;
            $option2_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id"=>($value->id), "selected_option"=>2])->row()->total;;
            $option3_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id"=>($value->id), "selected_option"=>3])->row()->total;;
            $inst->total_option1_voters = (int)$option1_voters;
            $inst->total_option2_voters = (int)$option2_voters;
            $inst->total_option3_voters = (int)$option3_voters;
            $inst->percentage_option1_voters = round((($total_voters>0)?($option1_voters*100/$total_voters):0), 2);
            $inst->percentange_option2_voters = round((($total_voters>0)?($option2_voters*100/$total_voters):0), 2);
            $inst->percentage_option3_voters = round((($total_voters>0)?($option3_voters*100/$total_voters):0), 2);
        }
        else{
            $value->options = new stdClass();
        }
        $userdata = $this->db->get_where("users", ["id"=>$value->user_id])->row();

        $value->voted = ($this->db->get_where("polling_select", ["forum_id"=>($value->id), "user_id"=>($user_data->id)])->row())?true:false;
        $value->posted_by_name = ($userdata->first_name." ".$userdata->last_name);
        $value->posted_by_profile = str_replace("https://ashom.app", base_url(), $userdata->profile_pic);
        $value->liked = $this->db->get_where("forums_likes", ["forum_id"=>$value->id, "user_id"=>($user_data->id)])->row()?true:false;
        $value->total_liked = $this->db->select("count(*) as total")->get_where("forums_likes", ["forum_id"=>($value->id)])->row()->total;
        $value->disliked = $this->db->get_where("forum_dislikes", ["forum_id"=>$value->id, "user_id"=>($user_data->id)])->row()?true:false;
        $value->total_disliked = $this->db->select("count(*) as total")->get_where("forum_dislikes", ["forum_id"=>($value->id)])->row()->total;
        $value->total_comments = $this->db->select("count(*) as total")->get_where("forum_comments", ["forum_id"=>($value->id)])->row()->total;
        $value->comments = $this->db->select("CONCAT(first_name, ' ', last_name) as name, profile_pic, comment, forum_comments.created")->join("users", "forum_comments.user_id = users.id")->get_where("forum_comments", ["forum_id"=>($value->id), "replied_to"=>0])->result();
        $value->isMine = ($user_data->id==$value->user_id)?true:false;
      	$value->isEdited = ($value->isEdited==1)?true:false;
      	unset($value->user_id);

    }
     $this->response($forums, REST_Controller::HTTP_OK);
    }
        else{
            $this->response(['status' => FALSE,
                'message' =>'User not found.'], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    else{
     $this->response(['status' => FALSE,
                'message' =>'Please complete all parameters'], REST_Controller::HTTP_BAD_REQUEST);
 }
}

public function likeorunlike_post(){
    $this->form_validation->set_rules('token', 'token', 'required|xss_clean');
    $this->form_validation->set_rules('forum_id', 'forum_id', 'required|numeric|xss_clean');
    $this->form_validation->set_error_delimiters('', '');
    if ($this->form_validation->run()){
        $token = $this->input->post("token");
        $forum_id = $this->input->post("forum_id");
        $user_data = $this->db->get_where("users", ["token"=>$token])->row();
        if($user_data){
            $this->db->delete("forum_dislikes", ["forum_id"=>$forum_id, "user_id"=>($user_data->id)]);
        if($this->db->get_where("forums_likes", ["forum_id"=>$forum_id, "user_id"=>($user_data->id)])->row()){
          $this->db->delete("forums_likes", ["forum_id"=>$forum_id, "user_id"=>($user_data->id)]);
          $this->response(['status' => TRUE,
                'message' =>'Forum Unliked Successfully.'], REST_Controller::HTTP_OK);
        }
        else{
          $this->db->insert("forums_likes", ["forum_id"=>$forum_id, "user_id"=>($user_data->id)]);
          $this->response(['status' => TRUE,
                'message' =>'Forum Liked Successfully.'], REST_Controller::HTTP_OK);
        }
        }
        else{
            $this->response(['status' => FALSE,
                'message' =>'User not found.'], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    else{
        $str = array();
        $str["token_error"] = form_error('token');
        $str["forum_id_error"] = form_error('forum_id');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function dislikeorundislike_post(){
    $this->form_validation->set_rules('token', 'token', 'required|xss_clean');
    $this->form_validation->set_rules('forum_id', 'forum_id', 'required|numeric|xss_clean');
    $this->form_validation->set_error_delimiters('', '');
    if ($this->form_validation->run()){
        $token = $this->input->post("token");
        $forum_id = $this->input->post("forum_id");
        $user_data = $this->db->get_where("users", ["token"=>$token])->row();
        if($user_data){
        $this->db->delete("forums_likes", ["forum_id"=>$forum_id, "user_id"=>($user_data->id)]);
        if($this->db->get_where("forum_dislikes", ["forum_id"=>$forum_id, "user_id"=>($user_data->id)])->row()){
          $this->db->delete("forum_dislikes", ["forum_id"=>$forum_id, "user_id"=>($user_data->id)]);
          $this->response(['status' => TRUE,
                'message' =>'Forum UnDisliked Successfully.'], REST_Controller::HTTP_OK);
        }
        else{
          $this->db->insert("forum_dislikes", ["forum_id"=>$forum_id, "user_id"=>($user_data->id)]);
          $this->response(['status' => TRUE,
                'message' =>'Forum Disliked Successfully.'], REST_Controller::HTTP_OK);
        }
        }
        else{
            $this->response(['status' => FALSE,
                'message' =>'User not found.'], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    else{
        $str = array();
        $str["token_error"] = form_error('token');
        $str["forum_id_error"] = form_error('forum_id');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
}


public function commensts_get($forum_id=0){
	function getComments($commment_id){
        $ci =& get_instance();
    	return $ci->db->get_where("forum_comments", ["replied_to"=>$commment_id])->result();
    }
  	$comments =  $this->db->select("forum_comments.id, CONCAT(first_name, ' ', last_name) as name, profile_pic, comment, replied_to, forum_comments.created")->join("users", "forum_comments.user_id = users.id")->get_where("forum_comments", ["forum_id"=>$forum_id, "replied_to"=>0])->result();
  function showComments($commentss){
     foreach($commentss as $comment){
       		$thisid= getComments($comment->id);
          $comment->replies = $thisid;
           showComments($thisid);
      }
    }
   	showComments($comments);

    $this->response($comments, REST_Controller::HTTP_OK);
}


  public function comments_get($forum_id=0, $token=""){
  if($forum_id!=0 && !empty($token)){
      function getComments($commment_id, $token){
        $ci =& get_instance();
       $ress =  $ci->db->select("forum_comments.id, CONCAT(first_name, ' ', last_name) as name, profile_pic, comment, replied_to, forum_comments.created, IF((users.token='$token'), 1, 0) as isMine")->join("users", "forum_comments.user_id = users.id")->get_where("forum_comments", ["replied_to"=>$commment_id, "replied_to!="=>0])->result();
    	foreach($ress as $resss){

          if($ci->db->get_where("forum_comments", ["replied_to"=>$resss->id])->row()){
                      $resss->in_reply = true;
             }
               else{
                        $resss->in_reply = false;
                 }
          $resss->replies = array();
        }
      	return $ress;
    }

  	$all_comments =  $this->db->select("forum_comments.id, CONCAT(first_name, ' ', last_name) as name, profile_pic, comment, replied_to, forum_comments.created, IF((users.token='$token'), 1, 0) as isMine")->join("users", "forum_comments.user_id = users.id")->get_where("forum_comments", ["forum_id"=>$forum_id, "replied_to"=>0])->result();
          	foreach($all_comments as $comment){
              		if($this->db->get_where("forum_comments", ["replied_to"=>$comment->id])->row()){
                      $comment->in_reply = true;
                    }
                      else{
                        $comment->in_reply = false;
                      }

                  $comment->replies = getComments($comment->id, $token);
            }


    $this->response($all_comments, REST_Controller::HTTP_OK);
  }
  else{
       $this->response(['status' => FALSE,
                'message' =>'Complete Parameters.'], REST_Controller::HTTP_BAD_REQUEST);
  }
  }

  public function commentreplies_get($comment_id=0, $token=""){
  if($comment_id!=0  && $token!=""){
    function getComments($commment_id, $token){
        $ci =& get_instance();
       $ress =  $ci->db->select("forum_comments.id, CONCAT(first_name, ' ', last_name) as name, profile_pic, comment, replied_to, forum_comments.created, IF((users.token='$token'), 1, 0) as isMine")->join("users", "forum_comments.user_id = users.id")->get_where("forum_comments", ["replied_to"=>$commment_id, "replied_to!="=>0])->result();
    	foreach($ress as $resss){

          if($ci->db->get_where("forum_comments", ["replied_to"=>$resss->id])->row()){
                      $resss->in_reply = true;
             }
               else{
                        $resss->in_reply = false;
                 }
          $resss->replies = array();
        }
      	return $ress;
    }
  	$all_comments =  $this->db->select("forum_comments.id, CONCAT(first_name, ' ', last_name) as name, profile_pic, comment, replied_to, forum_comments.created, IF((users.token='$token'), 1, 0) as isMine")->join("users", "forum_comments.user_id = users.id")->get_where("forum_comments", ["replied_to"=>$comment_id])->result();
        	foreach($all_comments as $comment){
              		if($this->db->get_where("forum_comments", ["replied_to"=>$comment->id])->row()){
                      $comment->in_reply = true;
                    }
                      else{
                        $comment->in_reply = false;
                      }
                  $comment->replies = getComments($comment->id, $token);
            }


    $this->response($all_comments, REST_Controller::HTTP_OK);
  }
  else{
       $this->response(['status' => FALSE,
                'message' =>'Complete Parameters.'], REST_Controller::HTTP_BAD_REQUEST);
  }
  }


public function reply_post(){
    $this->form_validation->set_rules('token', 'token', 'required|xss_clean');
    $this->form_validation->set_rules('comment_id', 'forum_id', 'required|numeric|xss_clean');
    $this->form_validation->set_rules('comment', 'comment', 'required|xss_clean');


    $this->form_validation->set_error_delimiters('', '');
    if ($this->form_validation->run()){
        $token = $this->input->post("token");
        $comment_id = $this->input->post("comment_id");
      	$reply_id = $this->input->post("reply_id");
      	$forum_id = 0;
        $comment = $this->input->post("comment");

        $user_data = $this->db->get_where("users", ["token"=>$token])->row();
        if($user_data){
        $user_id  = $user_data->id;
        $data["user_id"] = $user_id;
        $data["forum_id"] = 0;
        $data["replied_to"] = $comment_id;
        $data["comment"] = $comment;

        if(isset($reply_id)&&!empty($reply_id)){
          $msg="Updated";
          $result = $this->db->update("forum_comments", $data, ["id"=>$reply_id]);
        }
        else{
          $data['created'] = date("Y-m-d H:i:s");
          $msg="Posted";
          $result = $this->db->insert("forum_comments", $data);
        }
        if($result)
        $this->response(['status' => TRUE,
                'message' =>'Reply '.$msg.' Successfully.'], REST_Controller::HTTP_OK);
        }
        else{
            $this->response(['status' => FALSE,
                'message' =>'User not found.'], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    else{
        $str = array();
        $str["token_error"] = form_error('token');
        $str["comment_id_error"] = form_error('comment_id');
         $str["comment_error"] = form_error('comment');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function comment_post(){
    $this->form_validation->set_rules('token', 'token', 'required|xss_clean');
    $this->form_validation->set_rules('forum_id', 'forum_id', 'required|numeric|xss_clean');
    $this->form_validation->set_rules('comment', 'comment', 'required|xss_clean');


    $this->form_validation->set_error_delimiters('', '');
    if ($this->form_validation->run()){
        $token = $this->input->post("token");
        $forum_id = $this->input->post("forum_id");
        $comment = $this->input->post("comment");
      	$comment_id = $this->input->post("comment_id");

        $user_data = $this->db->get_where("users", ["token"=>$token])->row();
        if($user_data){
        $user_id  = $user_data->id;
        $data["user_id"] = $user_id;
        $data["forum_id"] = $forum_id;
        $data["comment"] = $comment;

        if(isset($comment_id)&&!empty($comment_id)){
          $msg="Updated";
          $result = $this->db->update("forum_comments", $data, ["id"=>$comment_id]);
        }
        else{
          $data['created'] = date("Y-m-d H:i:s");
          $msg="Posted";
          $result = $this->db->insert("forum_comments", $data);
        }
        if($result)
        $this->response(['status' => TRUE,
                'message' =>'Comment '.$msg.' Successfully.'], REST_Controller::HTTP_OK);
        }
        else{
            $this->response(['status' => FALSE,
                'message' =>'User not found.'], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    else{
        $str = array();
        $str["token_error"] = form_error('token');
        $str["forum_id_error"] = form_error('forum_id');
         $str["comment_error"] = form_error('comment');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function deletecomment_get($comment_id=0){
 if($comment_id!=0){
   $this->db->delete("forum_comments", ["id"=>$comment_id]);
   $res["status"]=true;
   $res["message"] = "Comment Deleted Successfully";
   $this->response($res, REST_Controller::HTTP_OK);
 }
 else{
   $res["status"]=false;
   $res["message"] = "Comment id Required";
   $this->response($res, REST_Controller::HTTP_BAD_REQUEST);
 }
}

public function issocialidexists_post(){
    $this->form_validation->set_rules('social_id', 'Social ID', 'required|xss_clean');

    $this->form_validation->set_error_delimiters('', '');
    if ($this->form_validation->run()){
        $social_id = $this->input->post("social_id");
        if($this->db->get_where("users", ["social_id"=>$social_id])->row()){
            $this->response(['status' => TRUE,
                'message' =>'Users Exists'], REST_Controller::HTTP_OK);
        }
        else{
            $this->response(['status' => TRUE,
                'message' =>'Users doesn\'t Exists'], REST_Controller::HTTP_OK);
        }

    }
    else{
        $str = array();
        $str["social_id_error"] = form_error('social_id');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }
}


public function countries_get(){
    $countries = $this->db->select("country")->get_where("countries")->result();
    $this->response($countries, REST_Controller::HTTP_OK);
}

public function companies_get($country="", $search="", $page=0){
    // $result = $this->db->select("*, CONCAT('https://www.ashom.app', image) as image")->get("companies")->result();
    $limit = 50;
    $offset = ($page-1) * $limit;
	$search = urldecode($search);
    $search = ucfirst($search);
    if($country=="DFM"||$country=="ADX")
        $country_param="exchanges";
        else
        $country_param = "Country";

    if($country==''||$country=='0'){
        if($page>0){
          if($search!=""&&$search!="0"){
           $this->db->select("*, CONCAT('https://www.ashom.app', image) as image");//seach, country
           $this->db->group_start();
           $this->db->like("Company_Name", $search);
           $this->db->or_like("$country_param", $search);
		   $this->db->or_like("SymbolTicker", $search);
           $this->db->or_like("$country_param", $search);
           $this->db->or_like("Reference_No", $search);
           $this->db->or_like("exchanges", $search);
           $this->db->group_end();
           $this->db->limit($limit, $offset);
           $this->db->order_by("Company_Name", "asc");
            $result = $this->db->get("companies")->result();
          }
          else  //--seach, --country
          $result = $this->db->select("*, CONCAT('https://www.ashom.app', image) as image")->limit($limit, $offset)->get("companies")->result();
        }
        else if($search!=""&&$search!="0"){
            $this->db->select("*, CONCAT('https://www.ashom.app', image) as image");
            $this->db->like("Company_Name", $search);
            $this->db->or_like("Country", $search);
            $this->db->or_like("exchanges", $search);
            $this->db->or_like("SymbolTicker", $search);
            $this->db->or_like("Reference_No", $search);
            $this->db->order_by("Company_Name", "asc");
            $result = $this->db->get("companies")->result();
        }
        else
        $result = $this->db->select("*, CONCAT('https://www.ashom.app', image) as image")->order_by("Company_Name", "asc")->get("companies")->result();
    }
    else{

        if($page>0){
          if($search!=""&&$search!="0"){
           $this->db->select("*, CONCAT('https://www.ashom.app', image) as image");//seach, country
           $this->db->group_start();
           $this->db->like("Company_Name", $search, 'after');
           $this->db->or_like("$country_param", $search, 'after');
           $this->db->like("Company_Name", $search, 'after');
		   $this->db->or_like("SymbolTicker", $search, 'after');
           $this->db->or_like("$country_param", $search, 'after');
           $this->db->or_like("Reference_No", $search, 'after');
           $this->db->or_like("exchanges", $search, 'after');
           $this->db->group_end();
           $this->db->limit($limit, $offset);
           $this->db->order_by("Company_Name", "asc");
           $result = $this->db->get_where("companies", ["$country_param"=>$country])->result();
          }else{
            $this->db->select("*, CONCAT('https://www.ashom.app', image) as image"); //--seach, country
            $this->db->limit($limit, $offset);
            $this->db->order_by("Company_Name", "asc");
            $result = $this->db->get_where("companies", ["$country_param"=>$country])->result();
          }
        }
        else if($search!=""&&$search!="0")
        $result = $this->db->select("*, CONCAT('https://www.ashom.app', image) as image")->like("Company_Name", $search, 'after')->or_like("$country_param", $search, 'after')->or_like("Reference_No", $search, 'after')->or_like("exchanges", $search, 'after')->order_by("Company_Name", "asc")->get_where("companies", ["Country"=>$country])->result();
        else
        $result = $this->db->select("*, CONCAT('https://www.ashom.app', image) as image")->order_by("Company_Name", "asc")->get_where("companies", ["$country_param"=>$country])->result();
        }

        if($page>0){
            $result_data = $result;
            $result = array();
            // echo $country;
            if(!$country||empty($country)){
                if($search!==""&&$search!=="0"){ //--seach, --country
                    $this->db->select("COUNT(*) as total");
                    $this->db->group_start();
                    $this->db->like("Company_Name", $search);
                    $this->db->or_like("$country_param", $search);
                    $this->db->or_like("SymbolTicker", $search);
                    $this->db->or_like("$country_param", $search);
                    $this->db->or_like("Reference_No", $search);
                    $this->db->or_like("exchanges", $search);
                    $this->db->group_end();
                   $total_rows =  $this->db->get("companies")->row()->total;
                }
              else
                $total_rows = $this->db->select("COUNT(*) as total")->get("companies")->row()->total;

             }
            else{
               if($search!=""&&$search!="0"){ //--seach, --country
                    $this->db->select("COUNT(*) as total");//seach, country
                    $this->db->group_start();
                    $this->db->like("Company_Name", $search, 'after');
                    $this->db->or_like("$country_param", $search, 'after');
                    $this->db->like("Company_Name", $search, 'after');
                    $this->db->or_like("SymbolTicker", $search, 'after');
                    $this->db->or_like("$country_param", $search, 'after');
                    $this->db->or_like("Reference_No", $search, 'after');
                    $this->db->or_like("exchanges", $search, 'after');
                    $this->db->group_end();
                    $total_rows = $this->db->get_where("companies", ["$country_param"=>$country])->row()->total;
                }
               else //--seach, --country
                $total_rows = $this->db->select("COUNT(*) as total")->get_where("companies", ["$country_param"=>$country])->row()->total;

            }
            $result["metadata"] = array();
            $result["metadata"]["total_page"] = (Integer) (($total_rows!=0)?(round(($total_rows)/$limit)+1):0);
            $result["metadata"]["total_companies"] = (Integer) $total_rows;
            $result["metadata"]["current_page"] = (Integer) $page;
            $result["data"] = $result_data;
        }


    $this->response($result, REST_Controller::HTTP_OK);
}

public function getyears_get($company_id=0){
    if($company_id!=0){
    $years = $this->db->select("year")->order_by("year", "desc")->get_where("years", ["company_id"=>$company_id, 'year>='=>2016])->result();
    $this->response($years, REST_Controller::HTTP_OK);
    }
    else{
        $this->response(['status' => FALSE,
                'message' =>'Complete Parameters.'], REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function documents_get($company_id=0, $year=0, $period=""){
    if($company_id!=0&&$year!=0&&$period!=''){
     $result = $this->db->select("document_types.name as document_name, document_link")->join("document_types", "document_types.id = documents.document_type_id")->get_where("documents", ["document_company_id"=>$company_id, "document_year"=>$year, "document_period"=>$period])->result();
     $this->response($result, REST_Controller::HTTP_OK);
    }
    else{
        $this->response(['status' => FALSE,
                'message' =>'Complete Parameters.'], REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function changepassword_post(){
    $this->form_validation->set_rules('token', 'token', 'required|xss_clean');
    $this->form_validation->set_rules('old_password', 'Old Password', 'required|xss_clean');
    $this->form_validation->set_rules('new_password', 'New Password', 'required|xss_clean');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|xss_clean');
    $this->form_validation->set_error_delimiters('', '');
    if ($this->form_validation->run()){
    $token = $this->input->post("token");
    if(istokenexists($token)){
    $email = get_email_by_token($token);
    $old_password = $this->input->post("old_password");
    $new_password = $this->input->post("new_password");
    $confirm_password = $this->input->post("confirm_password");
     if($new_password==$confirm_password){
      if(validate_email_pass($email, $old_password)){
          $new_password = base64_encode($new_password);
          $this->db->update("users", ["password"=>$new_password], ["email"=>$email]);
          $this->response(['status' => TRUE,
                'message' =>'Password Changed Successfully'], REST_Controller::HTTP_OK);
      }
      else{
        $str = array();
        $str["token_error"] = "User not Authenticated";
        $str["old_password_error"] = "";
        $str["new_password_id_error"] = "";
        $str["confirm_password_error"] = "";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
      }
     }
     else{
         $str = array();
        $str["token_error"] = "";
        $str["old_password_error"] = "";
        $str["new_password_id_error"] = "";
         $str["confirm_password_error"] = "Confirm Password must match with New Password";
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
     }
    }
    else{
        $str = array();
        $str["token_error"] = "User not found in Our Database";
        $str["old_password_error"] = form_error('old_password');
        $str["new_password_id_error"] = form_error('new_password');
         $str["confirm_password_error"] = form_error('confirm_password');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }

    }
    else{
        $str = array();
        $str["token_error"] = form_error('token');
        $str["old_password_error"] = form_error('old_password');
        $str["new_password_id_error"] = form_error('new_password');
         $str["confirm_password_error"] = form_error('confirm_password');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
    }

}

public function shareproject_get($forum_id=0){
    if($forum_id!=0){
        $this->db->query("update `forums` set share_count=share_count+1 WHERE id=$forum_id");
        $this->response(['status' => TRUE,
                'message' =>'Share Count increased by +1'], REST_Controller::HTTP_OK);
    }
    else{
         $this->response(['status' => FALSE,
                'message' =>'Forum ID Required.'], REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function postpoll_post(){
    $title=$this->input->post("title");
    $token=$this->input->post("token");
    $option1=$this->input->post("option1");
    $option2=$this->input->post("option2");
    $option3=$this->input->post("option3");
    $validity=$this->input->post("validity");
    $this->form_validation->set_rules('title', 'title', 'required');
    $this->form_validation->set_rules('token', 'token', 'required|xss_clean');
    $this->form_validation->set_rules('option1', 'option1', 'required|xss_clean');
    $this->form_validation->set_rules('option2', 'option2', 'required|xss_clean');
    //$this->form_validation->set_rules('option3', 'option3', 'required|xss_clean');
    $this->form_validation->set_rules('validity', 'validity', 'required|numeric|xss_clean');
    if ($this->form_validation->run()){
    if(istokenexists($token)){
    if(!isset($option3)||empty($option3))
      $option3 = "";
    $user_id = get_userid_bytoken($token);
    $pollpost["option1"]=$option1;
    $pollpost["option2"]=$option2;
    $pollpost["option3"]=$option3;
    $pollpostdata = JSON_encode($pollpost);

    $data = array("user_id"=>$user_id, "content"=>$title, "options"=>$pollpostdata, "forum_type"=>"poll", "validity"=>$validity, "created"=>date("Y-m-d H:i:s"));
    if($this->db->insert("forums", $data)){
        $this->response(['status' => TRUE,
                'message' =>'Poll Added Successfully.'], REST_Controller::HTTP_OK);
    }
    else{
        $this->response(['status' => FALSE,
                'message' =>'Something Error.'], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    else{
         $this->response(['status' => FALSE,
                'message' =>'User Not Exists.'], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    else{
         $this->response(['status' => FALSE,
                'message' =>'Required All Fields and validity must be number only (in days).'], REST_Controller::HTTP_BAD_REQUEST);
    }


}

public function sendvote_post(){
    $token = $this->input->post("token");
    $poll_id = $this->input->post("poll_id");
    $selected_option  = $this->input->post("selected_option");
    if(isset($token)&&!empty($token)&&isset($selected_option)&&!empty($selected_option)&&isset($poll_id)&&!empty($poll_id)){
    if(istokenexists($token)){
    if($selected_option==1||$selected_option==2||$selected_option==3){
        if(is_it_poll($poll_id)){
        $user_id = get_userid_bytoken($token);
        if(!$this->db->get_where("polling_select", ["user_id"=>$user_id, "forum_id"=>$poll_id])->row()){
        $data = array("user_id"=>$user_id, "forum_id"=>$poll_id, "selected_option"=>$selected_option);
        $this->db->insert("polling_select", $data);
        $this->response(['status' => TRUE,
                'message' =>'Poll Voted Successfully.'], REST_Controller::HTTP_OK);
        }
        else{
            $this->response(['status' => FALSE,
                'message' =>'This poll is already voted by you.'], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    else{
        $this->response(['status' => FALSE,
                'message' =>'YOur given poll id is not Poll.'], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    else{
        $this->response(['status' => FALSE,
                'message' =>'Select option must only 1, 2 or 3.'], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    else{
         $this->response(['status' => FALSE,
                'message' =>'User Not Exists.'], REST_Controller::HTTP_BAD_REQUEST);
    }
    }
    else{
         $this->response(['status' => FALSE,
                'message' =>'Required All Fields.'], REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function document_issue_get($symbolticker=""){
  $symbolticker = urldecode($symbolticker);
  if($symbolticker!=""){
    $data = $this->db->query("SELECT DISTINCT d2.document_period,d2.document_year, c2.Company_Name, c2.SymbolTicker FROM `documents` AS d2, `companies` AS c2 WHERE document_year=(SELECT MAX(d1.document_year) FROM `documents` AS d1, `companies` AS c1 WHERE c1.id = d1.document_company_id AND c1.SymbolTicker = '$symbolticker' ORDER By d1.document_year DESC) AND c2.SymbolTicker ='$symbolticker' AND c2.id = d2.document_company_id")->result();
    $result["data"]=$data;
    if (count($result["data"])> 0){
      $this->response($result, REST_Controller::HTTP_OK);
    }else{
      $this->response(['status' => FALSE,
                'message' =>'No Data Available For Selected Company!!'], REST_Controller::HTTP_BAD_REQUEST);
    }

  }else{
    $this->response(['status' => FALSE,
                'message' =>'Required All Fields.'], REST_Controller::HTTP_BAD_REQUEST);
  }
}

public function financialapi_get($page=0, $countryname="", $companyname=""){
    ini_set('memory_limit', '-1');
    ini_set('display_errors', 0);
     $limit= 50;
     $start = $limit*$page;

  $companyname = urldecode($companyname);

     if($companyname!="")
     $data = $this->db->query("SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries) and FIND_IN_SET('$companyname', api_data.m_companies) ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->result();
     else if($countryname!="")
     $data = $this->db->query("SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries) ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->result();
     else
     $data = $this->db->query("SELECT * FROM `api_data` ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->result();

     foreach($data as $value){
         $value->country = explode(",", $value->m_countries);
         $value->company = explode(",", $value->m_companies);
         $date=date_create_from_format("d/m/y H:i",$value->date);
         $value->created_date = date_format($date,"Y-m-d H:i:s");

       		unset($value->m_countries);
       		unset($value->m_companies);
         	unset($value->id);
     }
     if($companyname!="")
     $total_pages = $this->db->query("select CEIL(count(*)/$limit)-1 as total from (SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries) and FIND_IN_SET('$companyname', api_data.m_companies) ) as ls")->row()->total;
     else if($countryname!="")
     $total_pages = $this->db->query("select CEIL(count(*)/$limit)-1 as total from (SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries)) as ls")->row()->total;
     else
     $total_pages = $this->db->query("select CEIL(count(*)/$limit)-1 as total from (SELECT * FROM `api_data`) as ls")->row()->total;

     $metadata["total_pages"]  = $total_pages;
     $metadata["current_page"] = $page;
     $result["metadata"]=$metadata;
     $result["data"]=$data;
     $this->response($result, REST_Controller::HTTP_OK);

}

public function financialapi_post(){
    ini_set('memory_limit', '-1');
    ini_set('display_errors', 1);

    $page = $this->input->post("page");
    $countryname = $this->input->post("countryname");
    $companyname = $this->input->post("companyname");
    $search = $this->input->post("search", "");

     $limit= 50;
     $start = $limit*$page;

    $companyname = urldecode($companyname);
    //$data = $this->db->query("select * from api_data where 1 and ".(($companyname!="")?" and FIND_IN_SET('$companyname', api_data.m_companies)":"").(($countryname!="")?" and FIND_IN_SET('$countryname', api_data.m_countries)":"")." and (title like '%$search%' or source like '%$search%') ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->result();;
    $data = $this->db->query("SELECT * FROM `api_data` where 1 ".(($companyname!="")?" and FIND_IN_SET('$companyname', api_data.m_companies)":"").(($countryname!="")?" and FIND_IN_SET('$countryname', api_data.m_countries)":"")." and ((title like '%$search%') or (source like '%$search%')) ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->result();


     foreach($data as $value){
         $value->country = explode(",", $value->m_countries);
         $value->company = explode(",", $value->m_companies);
         $date=date_create_from_format("d/m/y H:i",$value->date);
         $value->created_date = date_format($date,"Y-m-d H:i:s");
       		unset($value->m_countries);
       		unset($value->m_companies);
         	unset($value->id);
     }
     $total_pages = $this->db->query("SELECT CEIL(count(*)/$limit) as total FROM `api_data` where 1 ".(($companyname!="")?" and FIND_IN_SET('$companyname', api_data.m_companies)":"").(($countryname!="")?" and FIND_IN_SET('$countryname', api_data.m_countries)":"")." and ((title like '%$search%') or (source like '%$search%'))")->row()->total;
     //$total_pages = $this->db->query("select CEIL(count(*)/$limit)-1 as total from (SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries) and FIND_IN_SET('$companyname', api_data.m_companies) and ((title like '%$search%') or (source like '%$search%')) ) as ls")->row()->total;

    // $total_pages = $this->db->select($data = $this->db->query("SELECT CEIL(count(*)/$limit)-1 as total FROM `api_data` where 1 ".(($companyname!="")?"and  FIND_IN_SET('$countryname', api_data.m_countries)":"").(($countryname!="")?" and FIND_IN_SET('$companyname', api_data.m_companies)":"")." and ((title like '%$search%') or (source like '%$search%')) ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->row()->total;


     $metadata["total_pages"]  = $total_pages;
     $metadata["current_page"] = $page;
     $result["metadata"]=$metadata;
     $result["data"]=$data;
     $this->response($result, REST_Controller::HTTP_OK);

}

public function financialapi2_get($page=0, $sizeperpage=0, $countryname=""){
    ini_set('memory_limit', '-1');
    ini_set('display_errors', 0);
     $limit= $sizeperpage;
     $start = $limit*$page;

  $companyname = urldecode($companyname);

     if($companyname!="")
     $data = $this->db->query("SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries) and FIND_IN_SET('$companyname', api_data.m_companies) ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->result();
     else if($countryname!="")
     $data = $this->db->query("SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries) ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->result();
     else
     $data = $this->db->query("SELECT * FROM `api_data` ORDER by STR_TO_DATE(api_data.date, '%d/%m/%y %H:%i') DESC limit $start, $limit")->result();

     foreach($data as $value){
         $value->country = explode(",", $value->m_countries);
         $value->company = explode(",", $value->m_companies);
       		unset($value->m_countries);
       		unset($value->m_companies);
         	unset($value->id);
     }
     if($companyname!="")
     $total_pages = $this->db->query("select CEIL(count(*)/$limit)-1 as total from (SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries) and FIND_IN_SET('$companyname', api_data.m_companies) ) as ls")->row()->total;
     else if($countryname!="")
     $total_pages = $this->db->query("select CEIL(count(*)/$limit)-1 as total from (SELECT * FROM `api_data` where FIND_IN_SET('$countryname', api_data.m_countries)) as ls")->row()->total;
     else
     $total_pages = $this->db->query("select CEIL(count(*)/$limit)-1 as total from (SELECT * FROM `api_data`) as ls")->row()->total;

     $metadata["total_pages"]  = $total_pages;
     $metadata["current_page"] = $page;
     $result["metadata"]=$metadata;
     $result["data"]=$data;
     $this->response($result, REST_Controller::HTTP_OK);

}

public function contactus_post(){
  $this->form_validation->set_rules('name', 'name', 'required|xss_clean');
  $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');
  $this->form_validation->set_rules('subject', 'subject', 'required|xss_clean');
  $this->form_validation->set_rules('message', 'message', 'required|xss_clean');
  $mobile = $this->input->post('mobile');
  if(isset($mobile))
  $this->form_validation->set_rules('mobile', 'mobile', 'required|xss_clean');
 if ($this->form_validation->run()){
  $data["name"] = $this->input->post("name");
  $data["email"] = $this->input->post("email");
  $data["subject"] = $this->input->post("subject");
  $data["message"] = $this->input->post("message");
  if(isset($mobile)&&!empty($mobile))
  $data["mobile"] = $this->input->post("mobile");
  $data["created"] = date("Y-m-d H:i:s");
  if($this->db->insert("contact_us", $data)){
      $this->response(['status' => TRUE,
                'message' =>'Thank you for contacting ASHOM.APP. We\'ll get back to you shortly'], REST_Controller::HTTP_OK);
  }
  else{
      $this->response(['status' => FALSE,
                'message' =>'Some Error Occured.'], REST_Controller::HTTP_BAD_REQUEST);
  }
    }
   else{
        $str = array();
        $str["name"] = form_error('name');
        $str["email"] = form_error('email');
        $str["subject"] = form_error('subject');
         $str["message"] = form_error('message');
        $this->response($str, REST_Controller::HTTP_BAD_REQUEST);
   }
}


public function refinitivapi_get(){
    error_reporting(0);
    ini_set('display_errors', 0);
    $refinitiv_data = new stdClass;
    $refinitiv_data->Contents = (object)array();
    $refinitiv_data = $this->db->select("odatacontext as '@odata.context', Notes, 'NULL' as Contents")->get("refinitiv")->row();
    $result = $this->db->select("IdentifierType, Identifier, High, RIC, UniversalClosePrice as 'Universal Close Price', Low, TradeDate as 'Trade Date', Volume, Open, Last")->get("refinitiv_contents")->result();
    $refinitiv_data->Contents = $result;
    $refinitiv_data->Notes= json_decode($refinitiv_data->Notes);
    $this->response($refinitiv_data, REST_Controller::HTTP_OK);
}

public function refinitivallapi_get($IdentifierType="", $Identifier=""){
    $refinitiv_data = $this->db->select("odatacontext as '@odata.context', Notes, 'NULL' as Contents, 'NULL' as Notes")->get("refinitiv")->row();
    $refinitiv_data->Contents = $this->db->select("IdentifierType, Identifier, High, RIC, UniversalClosePrice as 'Universal Close Price', Low, TradeDate as 'Trade Date', Volume, Open, Last")->get_where("refinitiv_5year_content", ["IdentifierType"=>$IdentifierType, "Identifier"=>$Identifier])->result();
    $refinitiv_data->Notes= json_decode($refinitiv_data->Notes);
    $this->response($refinitiv_data, REST_Controller::HTTP_OK);
}


public function dashboard_post(){
    $token = $this->input->post("token");

    $data["countries"] = $this->input->post("countries");
    $data["stocks"] = $this->input->post("stocks");
    $data["cryptocurrencies"] = $this->input->post("cryptocurrencies");
    $data["commodities"] = $this->input->post("commodities");
    $data["watchlist"] = $this->input->post("watchlist");

    if(isset($token)&&!empty($token)){
        if(istokenexists($token)){
            $user_id = $this->db->get_where("users", ["token"=>$token])->row()->id;
            if($this->db->get_where("dashboard", ["user_id"=>$user_id])->row()){
                $this->db->update("dashboard", $data, ["user_id"=>$user_id]);
                $this->response(['status' => TRUE,
                'message' =>'Data  Updated Success.'], REST_Controller::HTTP_OK);

            }
            else{
                $data["user_id"] = $user_id;
                $this->db->insert("dashboard", $data);
                $this->response(['status' => TRUE,
                'message' =>'Data Insert Success.'], REST_Controller::HTTP_OK);

            }

        }
        else{
            $this->response("Token not present in database", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    else{
        $this->response("Token is required", REST_Controller::HTTP_BAD_REQUEST);

    }
}


public function dashboard_get($token=""){
    if(istokenexists($token)){
        $user_id = $this->db->get_where("users", ["token"=>$token])->row()->id;
        $data = $this->db->get_where("dashboard", ["user_id"=>$user_id])->row();
        if($data){
        $data->stocks = ($data->stocks!="")?explode(",", $data->stocks):array();
        $data->cryptocurrencies =($data->cryptocurrencies!="")? explode(",", $data->cryptocurrencies):array();
        $data->commodities =($data->commodities!="")? explode(",", $data->commodities):array();
        $data->countries =($data->countries!="")? explode(",", $data->countries):array();
        $data->watchlist =($data->watchlist!="")? explode(",", $data->watchlist):array();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }
    else{
        $this->response("Unauthorized", REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function portfolio_post(){
    $companyName = $this->input->post("companyName");
    $SharesQty = $this->input->post("SharesQty");
    $SharePrice = $this->input->post("SharePrice");
    $CurrentPrice = $this->input->post("CurrentPrice");
  	$country = $this->input->post("country");
  	$exchange = $this->input->post("exchange");
  	$purchaesDate = $this->input->post("purchaesDate");
  	$tradedate = $this->input->post("tradedate");
  	$token = $this->input->post("token");
    if(isset($companyName)&&!empty($companyName)&&isset($SharesQty)&&!empty($SharesQty)&&isset($SharePrice)&&!empty($SharePrice)&&isset($CurrentPrice)&&!empty($CurrentPrice)&&isset($country)&&!empty($country)&&isset($exchange)&&!empty($exchange)&&isset($purchaesDate)&&!empty($purchaesDate)&&isset($tradedate)&&!empty($tradedate)){
    if(istokenexists($token)){
    $user_id = $this->db->get_where("users", ["token"=>$token])->row()->id;
    $data["companyName"] = $companyName;
    $data["SharesQty"] = $SharesQty;
    $data["SharePrice"] = $SharePrice;
    $data["CurrentPrice"] = $CurrentPrice;
    $data["country"] = $country;
    $data["exchange"] = $exchange;
    $data["purchaesDate"] = $purchaesDate;
    $data["tradedate"] = $tradedate;
    $data["user_id"] = $user_id;
    if($this->db->insert("portfolio", $data)){
        $this->response(["status"=>true, "message"=>"record Added Successfully"], REST_Controller::HTTP_OK);
    }
    }
    else
      $this->response(["status"=>false, "message"=>"Token doesn't Exists"], REST_Controller::HTTP_BAD_REQUEST);
    }
    else{
        $this->response("Incompleted Parameters", REST_Controller::HTTP_BAD_REQUEST);
    }
}

public function portfolio_get($token=""){
  if(istokenexists($token)){
    $user_id = $this->db->get_where("users", ["token"=>$token])->row()->id;
    $data = $this->db->order_by("companyName", "DESC")->get_where("portfolio", ["user_id"=>$user_id])->result();
    $str="";
    $result= array();
    $step=-1;
    foreach($data as $value){
        $companyName = $value->companyName;
        if($companyName==$str){
            $stcl =new stdClass();
            $stcl->SharesQty = $value->SharesQty;
            $stcl->SharePrice = $value->SharePrice;
            $stcl->CurrentPrice = $value->CurrentPrice;
          	$stcl->country = $value->country;
          	$stcl->exchange = $value->exchange;
          	$stcl->purchaesDate = $value->purchaesDate;
          	$stcl->tradedate = $value->tradedate;
            $result[$step]["name"][]=$stcl;
        }
        else{
            $step++;
            $result[$step]["companyName"] =$companyName;
            $result[$step]["name"] = array();
            $stcl =new stdClass();
            $stcl->SharesQty = $value->SharesQty;
            $stcl->SharePrice = $value->SharePrice;
            $stcl->CurrentPrice = $value->CurrentPrice;
          	$stcl->country = $value->country;
          	$stcl->exchange = $value->exchange;
          	$stcl->purchaesDate = $value->purchaesDate;
          	$stcl->tradedate = $value->tradedate;
            $result[$step]["name"][]=$stcl;
            $str=$companyName;
        }
    }

    $this->response($result, REST_Controller::HTTP_OK);
  }
  else
      $this->response(["status"=>false, "message"=>"Token doesn't Exists or Invalid"], REST_Controller::HTTP_BAD_REQUEST);
}

public function deleteportfolio_get(){
  $companyName = $this->input->get("companyName");
  $token = $this->input->get("token");
    if(!isset($companyName)||empty($companyName)||!isset($token)||empty($token)){
      	$data["status"]=false;
    	$data["message"]="Please Complete Parameters";
    	$this->response($data, REST_Controller::HTTP_BAD_REQUEST);
    }
  	if(!istokenexists($token)){
    	$data["status"]=false;
    	$data["message"]="Token doesn't exists";
    	$this->response($data, REST_Controller::HTTP_BAD_REQUEST);
  	}
    $user_id = $this->db->get_where("users", ["token"=>$token])->row()->id;
    if(!$this->db->delete("portfolio", ["companyName"=>$companyName, "user_id"=>$user_id])){
      	$data["status"]=false;
    	$data["message"]="Something Error Occured";
    	$this->response($data, REST_Controller::HTTP_BAD_REQUEST);
    }
    $data["status"]=true;
    $data["message"]="Portfolio Deleted Successfully";
    $this->response($data, REST_Controller::HTTP_OK);
  }

public function getdatabyric_get($ric_name="", $time_stamps=5){
    if($time_stamps==1){//3 months
       $timebefore = date("Y-m-d", strtotime(date("Y-m-d")." -3 months"));
       $this->response(($this->db->query("SELECT DISTINCT datentime, refinitiv5year.* FROM `refinitiv5year` WHERE RIC='$ric_name' and STR_TO_DATE(datentime, '%Y-%m-%d')>'$timebefore' order by id desc")->result()), REST_Controller::HTTP_OK);
    }
    else if($time_stamps==2){//6 months
        $timebefore = date("Y-m-d", strtotime(date("Y-m-d")." -6 months"));
       $this->response(($this->db->query("SELECT DISTINCT datentime, refinitiv5year.* FROM `refinitiv5year` WHERE RIC='$ric_name' and STR_TO_DATE(datentime, '%Y-%m-%d')>'$timebefore' order by id desc")->result()), REST_Controller::HTTP_OK);
    }
    else if($time_stamps==3){//12months
       $timebefore = date("Y-m-d", strtotime(date("Y-m-d")." -1 year"));
       $this->response(($this->db->query("SELECT DISTINCT datentime, refinitiv5year.* FROM `refinitiv5year` WHERE RIC='$ric_name' and STR_TO_DATE(datentime, '%Y-%m-%d')>'$timebefore' order by id desc")->result()), REST_Controller::HTTP_OK);
    }
    else if($time_stamps==4){  //3 years
       $timebefore = date("Y-m-d", strtotime(date("Y-m-d")." -3 year"));
       $runtime = date("Y-m-d");
       $data=array();
        while($timebefore<$runtime){
         $daet=date("d-m-Y", strtotime($runtime));
         $month =  date("m", strtotime($runtime));
         $year = date("Y", strtotime($runtime));
         $res = $this->db->query("SELECT DISTINCT datentime, refinitiv5year.* FROM `refinitiv5year` where RIC='$ric_name' and YEAR(STR_TO_DATE(datentime, '%Y-%m-%d'))=$year and MONTH(STR_TO_DATE(datentime, '%Y-%m-%d'))=$month limit 6")->result();
         foreach($res as $value)
         $data[]=$value;
         $runtime = date("Y-m-d", strtotime($runtime." -1 months"));
        }
       $this->response($data, REST_Controller::HTTP_OK);
    }
    else if($time_stamps==5){  //5years
       $timebefore = date("Y-m-d", strtotime(date("Y-m-d")." -5 year"));
       $runtime = date("Y-m-d");
       $data=array();
        while($timebefore<$runtime){
         $daet=date("d-m-Y", strtotime($runtime));
         $month =  date("m", strtotime($runtime));
         $year = date("Y", strtotime($runtime));
         $res = $this->db->query("SELECT DISTINCT datentime, refinitiv5year.* FROM `refinitiv5year` where RIC='$ric_name' and YEAR(STR_TO_DATE(datentime, '%Y-%m-%d'))=$year and MONTH(STR_TO_DATE(datentime, '%Y-%m-%d'))=$month limit 6")->result();
         foreach($res as $value)
         $data[]=$value;
         $runtime = date("Y-m-d", strtotime($runtime." -1 months"));
        }
       $this->response($data, REST_Controller::HTTP_OK);
    }


}

  public function subscription_post(){
    $token = $this->input->post("token");
    $expire_on = $this->input->post("expire_date");
	$subscription_type = $this->input->post("subscription_type");
    $amount = $this->input->post("amount");

    if(isset($token)&&!empty($token)&&isset($expire_on)&&!empty($expire_on)&&isset($subscription_type)&&!empty($subscription_type)&&isset($amount)){
      	if(!istokenexists($token)){
          $data["status"]=false;
      	  $data["message"]="Token doesn't Exists";
      	  $this->response($data, REST_Controller::HTTP_OK);
        }
        if($subscription_type!="Free"&&$subscription_type!="Monthly"&&$subscription_type!="Yearly"){
          $data["status"]=false;
      	  $data["message"]="Subscription type must be 'Free' or 'Monthly' or 'Yearly'";
      	  $this->response($data, REST_Controller::HTTP_BAD_REQUEST);
        }
      	$user_id = get_userid_bytoken($token);
      	$idata["user_id"]= $user_id;
      	$idata["subscription_type"]=$subscription_type;
      	$idata["amount"]= $amount;
        $idata["expire_on"] = date("Y-m-d", strtotime($expire_on));
      	$idata["created"] = date("Y-m-d");

    	if($this->db->get_where("subscription", ["user_id"=>$user_id])->row()){
          $result = $this->db->update("subscription", $idata, ["user_id"=>$user_id]);
          $data["message"]="Subscription Updated Successfully";
        }
      	else{
          $result = $this->db->insert("subscription", $idata);
          $data["message"]="Subscription Added Successfully";
        }
      	if($result){
            $this->db->update("visited_companies", ["status"=>0], ["user_id"=>$user_id]);
          	$data["status"]=true;
      		$this->response($data, REST_Controller::HTTP_OK);
        }
      	else{
          $data["status"]=false;
      	  $data["message"]="Something Error";
      	  $this->response($data, 400);
        }
    }
    else{
      $data["status"]=false;
      $data["message"]="Please Complete All Parameters";
      $this->response($data, 400);
    }
  }

  public function makesubscription($token, $expire_on, $subscription_type, $amount){
   if(isset($token)&&!empty($token)&&isset($expire_on)&&!empty($expire_on)&&isset($subscription_type)&&!empty($subscription_type)&&isset($amount)){


      	$user_id = get_userid_bytoken($token);
      	$idata["user_id"]= $user_id;
      	$idata["subscription_type"]=$subscription_type;
      	$idata["amount"]= $amount;
        $idata["expire_on"] = date("Y-m-d", strtotime($expire_on));
      	$idata["created"] = date("Y-m-d");

    	if($this->db->get_where("subscription", ["user_id"=>$user_id])->row()){
          $result = $this->db->update("subscription", $idata, ["user_id"=>$user_id]);
          $data["message"]="Subscription Updated Successfully";
        }
      	else{
          $result = $this->db->insert("subscription", $idata);
          $data["message"]="Subscription Added Successfully";
        }
      	if($result){
            $this->db->update("visited_companies", ["status"=>0], ["user_id"=>$user_id]);
          	$data["status"]=true;

        }
      	else{
          $data["status"]=false;
      	  $data["message"]="Something Error";

        }
    }
    else{
      $data["status"]=false;
      $data["message"]="Please Complete All Parameters";

    }
  }


	public function searchinsert_post(){
    	$token = $this->input->post("token");
      	$searchstr = $this->input->post("searchstr");
		if(isset($token)&&!empty($token)&&isset($searchstr)&&!empty($searchstr)){
          if(!istokenexists($token)){
          	$data["status"]=false;
      	  	$data["message"]="Token doesn't Exists";
      	  	$this->response($data, 200);
        	}
          	$user_id = get_userid_bytoken($token);
            if($searchstr!="CompanyName✂")
            if(!$this->db->get_where("searches", ["user_id"=>$user_id, "searchstr"=>$searchstr])->row())
        	$this->db->insert("searches", ["user_id"=>$user_id, "searchstr"=>$searchstr, "created"=>date("Y-m-d H:i:s")]);
                $data["status"]=true;
                $data["message"] = "Search Added";
      			$this->response($data, REST_Controller::HTTP_OK);
        }
      	 else{
      	$data["status"]=false;
      	$data["message"]="Please Complete All Parameters";
      	$this->response($data, 400);
    	}
  	}

    public function searches_get(){
      	$token = $this->input->get("token");
      	if(isset($token)&&!empty($token)){
          if(!istokenexists($token)){
          $data["status"]=false;
      	  $data["message"]="Token is not valid";
      	  $this->response($data, 200);
        }
          $user_id = get_userid_bytoken($token);
          $searches = $this->db->query("SELECT searchstr from `searches` where user_id=$user_id and searchstr like 'CompanyName%' order by created desc LIMIT 6")->result();
          foreach($searches as $search)
          $search->data = $this->db->get_where('companies', ['id'=>explode('✂', $search->searchstr)[5]])->row();
        }
      	else{
      		$searches =$this->db->query("SELECT searchstr from `searches` where searchstr like 'CompanyName%' GROUP by searchstr order by count(searchstr) desc LIMIT 6")->result();
            foreach($searches as $search)
            $search->data = $this->db->get_where('companies', ['id'=>explode('✂', $search->searchstr)[5]])->row();
    	}
       $this->response($searches, REST_Controller::HTTP_OK);
    }

  public function unsubscribe_post(){
    $email = $this->input->post("email");
    if(isset($email)&&!empty($email)){
      if(!is_user_exists($email)){
          $data["status"]=false;
      	  $data["message"]="email is not valid";
      	  $this->response($data, 200);
        }
         $user_id = get_userid_byemail($email);
      $this->db->update("visited_companies", ["status"=>0], ["user_id"=>$user_id]);
      $this->db->delete("subscription", ["user_id"=>$user_id]);
      $data["status"]=true;
      $data["message"]="Unsubscribed";
       $this->response($data, REST_Controller::HTTP_OK);
    }
    else{
    	echo "Email Required";
    }
  }

  public function opencompany_post(){
  	$token = $this->input->post("token");
    $comapany_id = $this->input->post("company_id");
    $is_view = $this->input->post("is_view");
    if(isset($token)&&!empty($token)&&isset($comapany_id)&&!empty($comapany_id)&&isset($is_view)){

      if(!istokenexists($token)){
          $data["status"]=false;
      	  $data["message"]="Token is not valid";
      	  $this->response($data, 200);
        }
        $user_id = get_userid_bytoken($token);
      	$insert_data["user_id"] = $user_id;
      	$insert_data["company_id"] = $comapany_id;
       	$is_subscribed = is_user_subscribed(get_userid_bytoken($token));
       	$subscription_type = is_get_subscription_type(get_userid_bytoken($token));


      	if($is_subscribed){

             $max_companies = $this->db->get_where("plans_capacity", ["plan_type"=>$subscription_type])->row()->companies_capacity;

            if(!$this->db->get_where("visited_companies", $insert_data)->row()){
            if($max_companies!=0)
          if(($this->db->select("COUNT(*) as total")->get_where("visited_companies", ["user_id"=>$user_id, "status"=>1])->row()->total)>=$max_companies){
          	$data["status"]=false;
      	  	$data["message"]="Company limit over for $subscription_type plan";
      	  	$this->response($data, REST_Controller::HTTP_FORBIDDEN );
          }
           if($is_view==false||$is_view==0){
             	$data["status"]=true;
      			$data["message"]="User can visit companies";
      			$this->response($data, REST_Controller::HTTP_OK );
           }

      		$this->db->insert("visited_companies", $insert_data);
            }
          if($is_view==false||$is_view==0){
             	$data["status"]=true;
      			$data["message"]="User can visit companies";
      			$this->response($data, REST_Controller::HTTP_OK );
           }
        	$data["status"]=true;
      		$data["message"]="Company Visited Recorded";
      		$this->response($data, REST_Controller::HTTP_OK );
        }
        else{
          	$data["status"]=false;
      		$data["message"]="User not subscribed";
      		$this->response($data, REST_Controller::HTTP_FORBIDDEN );
        }
    }
    else{
      $data["status"]=false;
      $data["message"]="Please ! Compalete Paramertes";
      $this->response($data, REST_Controller::HTTP_OK);
    }
  }


	public function remainvisits_get(){
      $token = $this->input->get("token");
      $company_id = $this->input->get("company_id");
      if(!isset($token)||empty($token)){
          $data["status"]=false;
      	  $data["message"]="Token Required";
      	  $this->response($data, 200);
        }

      if(!istokenexists($token)){
          $data["status"]=false;
      	  $data["message"]="Token is not valid";
      	  $this->response($data, 200);
        }
      	$user_id = get_userid_bytoken($token);
      	$is_subscribed = is_user_subscribed($user_id);
       	$subscription_type = is_get_subscription_type($user_id);

        if(isset($company_id)&&!empty($company_id)){
            $lastreport_date = $this->user->getlastreport($company_id);
        }
        else{
            $lastreport_date="";
        }

      	if($is_subscribed){
             $visit_data["max_companies"] = $this->db->get_where("plans_capacity", ["plan_type"=>$subscription_type])->row()->companies_capacity;

          	  if($subscription_type=="Yearly"){
                $visit_data["visited_companies"]="0";
                $visit_data["remaining_visits"]="0";
              }
          	  else{
                $visit_data["visited_companies"] = $this->db->select("COUNT(*) as total")->get_where("visited_companies", ["user_id"=>$user_id, "status"=>1])->row()->total;
          	 	$visit_data["remaining_visits"] = "".$visit_data["max_companies"] - $visit_data["visited_companies"];
              }
          	 $data["status"]=true;
          	 $data["message"]="If max_companies is equals to '0' then it will assumed as 'Infinity', means yearly plan";
      		 $data["visit_data"]=$visit_data;
           	 $data["visited_companies"] = explode(",", $this->db->query("SELECT GROUP_CONCAT(company_id) as companies FROM `visited_companies` where user_id=$user_id")->row()->companies);
      		 $data["last_report"] = $lastreport_date;
             $this->response($data, REST_Controller::HTTP_OK );
        }
      	else{
          	$data["status"]=false;
      		$data["message"]="User not subscribed";
      		$this->response($data, REST_Controller::HTTP_FORBIDDEN );
        }

    }

 public function selectedcompanies_get($token=""){
    if(!istokenexists($token)){
        $data["status"]=false;
          $data["message"]="Token is not valid";
          $this->response($data, 200);
      }
        $user_id = get_userid_bytoken($token);
        $result = array();
        $mysubsription = get_subscription($user_id);
        if($mysubsription->subscription_type!='Yearly')
        $result =  $this->db->query("SELECT companies.*, CONCAT('https://www.ashom.app', companies.image) as image FROM `visited_companies` inner join companies on companies.id=visited_companies.company_id where user_id=$user_id")->result();
        $this->response($result, REST_Controller::HTTP_OK );
}

  public function testmail_get(){
  	if($this->mails->sendmail("dbvertexbackend@gmail.com", "DBVertex Indore", "This is my subject", "This is my body")){
      echo "Success";
    }
    else{
      echo "Failure";
    }
  }

  public function deleteallnews_post(){
    $NewsIDss = $this->input->post("NewsIDs");
    $NewsIDs = explode(",", $NewsIDss);
    foreach($NewsIDs as $NewsID){
      $this->db->delete("api_data", ["id"=>$NewsID]);
      $this->db->delete("api_data_companies", ["data_id"=>$NewsID]);
      $this->db->delete("api_data_countries", ["data_id"=>$NewsID]);
    }
    echo "Success";
  }

  public function resetallbtn(){
    $this->db->query("TRUNCATE api_data");
    $this->db->query("TRUNCATE api_data_companies");
    $this->db->query("TRUNCATE api_data_countries");
    return "Success";
  }

  public function findancialload_post(){
   		 $draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
    	$total_record = $this->db->select("COUNT(*) as total")->get_where("api_data")->row()->total;
    	$data = $this->db->order_by("id", "desc")->limit($rowperpage, $row)->get_where("api_data")->result();
    	$row++;
    	foreach($data as $value){
            $value->checkbox = '<input type="checkbox" class="deleteallcheck" value="'.($value->id).'">';
          	$value->sr_no = $row++;
          	$value->image_url = '<img style="max-width:100px; max-height:100px;" src="'.($value->image_url).'">';
            $value->laste = '<button data-newsid="'.($value->id).'" class="iconbtn deletenewsbtn"><i class="fa fa-trash" aria-hidden="true"></i></button>';
        	$value->companies = $value->m_companies;
          	$value->countries = $value->m_countries;
        }
  		$response =	array (
  			'draw' => intval($draw),
  			'recordsTotal' => $total_record,
  			'recordsFiltered' => $total_record,
 			 'data' =>$data
		);

    $this->response($response, REST_Controller::HTTP_OK );
  }


  public function usernotifications_get($token=''){
    if($token!=''){
        $user_id =  get_userid_bytoken($token);
  		$notifications = $this->db->select("message, metadata, created_at")->order_by("created_at", "desc")->get_where("notifications", ["user_id"=>$user_id])->result();
        foreach($notifications as $notification)
        $notification->metadata = json_decode($notification->metadata);
        $this->db->update("notifications", ["read_status"=>1], ["user_id"=>$user_id]);
      	$this->response($notifications, REST_Controller::HTTP_OK );
    }
  }


  public function updateDeviceToken_post(){
  	$token = $this->input->post("token");
    $device_token = $this->input->post("device_token");
    if(isset($token)&&!empty($token)&&isset($device_token)&&!empty($device_token)){
    $userdata = get_user_bytoken($token);
    if($userdata){
      $user_id = $userdata->id;
      $isAvailable = $this->db->get_where("device_tokens", ["device_token"=>$device_token])->row();
      if(!$isAvailable)
      $this->db->insert("device_tokens", ["user_id"=>$user_id, "device_token"=>$device_token]);
      $result["status"] = true;
      $result["message"] = "Token updated successfully";
      $this->response($result, REST_Controller::HTTP_OK );
    }
    else{
      $result["status"] = false;
      $result["message"] = "User not found";
      $this->response($result, REST_Controller::HTTP_BAD_REQUEST );
    }
    }
    else{
      $result["status"] = false;
      $result["message"] = "Please complete paramters.";
      $this->response($result, REST_Controller::HTTP_FORBIDDEN );
    }
  }


  public function pushtry_post(){
    $device_id = $this->input->post("token", "");
    $message = $this->input->post("message", "");
	$this->load->model("FcmNotification");
	$metadata =array();
    $fcm_result = $this->FcmNotification->push_notification(array($device_id), $type="",  $message, $metadata);
    $this->response(json_decode($fcm_result), REST_Controller::HTTP_OK );
  }

  public function deletedevietoken_get($devicetoken=""){
  	$this->db->delete("device_tokens", ["device_token"=>$devicetoken]);
    $result["status"] = true;
    $result["message"] = "Token removed successfully.";
    $this->response($result, REST_Controller::HTTP_FORBIDDEN );
  }


  public function singlecompany_get($company_id=0){
  	$data = $this->db->get_where("companies", ["id"=>$company_id])->row();
      if($data){
        $data->image = "https://www.ashom.app/".($data->image);
      }
    $this->response($data, REST_Controller::HTTP_OK);
  }

  public function privacy_policy_get(){
    $data = $this->db->get("privacy_policy")->row();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  public function termsnconditions_get(){
    $data = $this->db->get("termsncondition")->row();
    $this->response($data, REST_Controller::HTTP_OK);
  }

  public function aboutus_get(){
      $data = $this->db->get("about_us")->row()->description;
      $this->response($data, REST_Controller::HTTP_OK);
  }

  public function linkedInProfile_post(){
     $code = $this->input->post("code", "");
     $redirect_url = $this->input->post("redirect", "");
     $data = $this->user->getLinkedInProfile($code, $redirect_url);
     $this->response($data, REST_Controller::HTTP_OK);
  }

  public function currencyprice_get($from_currency='USD'){
  	$price = $this->db->get_where('currencies_rate', ['currency'=>$from_currency])->row();
    if($price)
      $this->response(['price'=>$price->rate], REST_Controller::HTTP_OK);
    else
      $this->response(['price'=>$price->rate], REST_Controller::HTTP_OK);
  }

  public function unreadnotification_get($token=''){
    $userdata = get_user_bytoken($token);
    if($userdata){
        $user_id = $userdata->id;
        $unread_notifications = $this->db->select("COUNT(*) as total")->get_where("notifications", ["user_id"=>$user_id, "read_status"=>0])->row()->total;
        $this->response((int)$unread_notifications, REST_Controller::HTTP_OK );
      }
      else{
        $result["status"] = false;
        $result["message"] = "User not found";
        $this->response($result, REST_Controller::HTTP_BAD_REQUEST );
      }
  }

  public function recordevent_post(){
    $token = $this->input->post("token");
    $event = $this->input->post("event");
  	if(!isset($token)||empty($token)||!isset($event)||empty($event))
      $this->response(['status'=>false, 'message'=>'Invalid Parameters.'], REST_Controller::HTTP_BAD_REQUEST );
    $userdata = get_user_bytoken($token);
    if(!$userdata)
      $this->response(['status'=>false, 'message'=>'User not found.'], REST_Controller::HTTP_BAD_REQUEST );

    //$event_in_list = $this->db->get_where('user_event_list', ['event'=>$event])->row();
    //if(!$event_in_list)
     // $this->response(['status'=>false, 'message'=>'Invalid Event.'], REST_Controller::HTTP_OK );

    $res = $this->db->insert('user_events', ['event'=>$event, 'user_id'=>$userdata->id]);
    if($res)
      $this->response(['status'=>true, 'message'=>'Event recorded.'], REST_Controller::HTTP_OK );
  }

  public function lastcompanyid_get(){
  	$updated_at = $this->db->get('update_status')->row()->updated_at;
     $this->response($updated_at);
  }

  public function recordanalytics_post(){
    $token = $this->input->post("token");
    $event_type = $this->input->post("event_type");
    $event = $this->input->post("event");
    if(!isset($token)||empty($token)||!isset($event_type)||empty($event_type)||!isset($event)||empty($event))
    	 $this->response(['status'=>false, 'message'=>'Invalid Parameters.'], REST_Controller::HTTP_BAD_REQUEST );
    $userdata = get_user_bytoken($token);
    if(($event_type!='countries')&&($event_type!="news")&&($event_type!="companies")&&($event_type!="report"))
      	$this->response(['status'=>false, 'message'=>'Event type can only be (countries, news, companies, report).'], REST_Controller::HTTP_BAD_REQUEST );
    if(!$userdata)
      $this->response(['status'=>false, 'message'=>'User not found.'], REST_Controller::HTTP_BAD_REQUEST );
    $res = $this->db->insert('user_analytics', ['user_id'=>$userdata->id, 'event'=>$event, 'event_type'=>$event_type]);
    if($res)
      $this->response(['status'=>true, 'message'=>'Event recorded.'], REST_Controller::HTTP_OK );
  }

  public function usereventsdtbl_post(){
    $start_date = $this->input->post("start_date");
    $end_date = $this->input->post("end_date");
    $data = $this->db->query("SELECT DISTINCT event, COUNT(event) as total_events, COUNT(DISTINCT user_id) as total_users FROM `user_events` where date(created_at)>='$start_date' and date(created_at)<='$end_date' GROUP BY event")->result();
    $this->response(['status'=>true, 'data'=>$data], REST_Controller::HTTP_OK );
  }
}
?>
