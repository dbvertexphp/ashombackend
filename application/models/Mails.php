<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mails extends CI_Model {


public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Kolkata");
     $this->load->library(array('email'));

  }

  
public function sendmail($to_email="", $to_name="",  $subject="", $body=""){
	 	include_once APPPATH . "libraries/vendor/autoload.php";
		$mail =new PHPMailer\PHPMailer\PHPMailer();
		$mail->isSMTP();
		$mail->Host = "email-smtp.ap-south-1.amazonaws.com";
		$mail->SMTPAuth = true;
		$mail->Username = "AKIA4RG4RBFEW57WSUKD";
		$mail->Password = "BMy69naFc/xtpDprCtS4RkfDwzISByLOWmSgunIvUINs";
	
		$mail->SMTPSecure = "tls";
		
		$mail->Port = 587;

		$mail->From = "info@ashom.app";
		$mail->FromName = "Ashom.App";

		$mail->addAddress($to_email, $to_name);

		$mail->isHTML(true);

		$mail->Subject = "$subject";
  		
		$mail->Body = $body;
  		$mail->AltBody = "$subject";

		try {
    		$mail->send();
     		return true;
		} catch (Exception $e) {
   			return false;
		}
	}  
  
}
