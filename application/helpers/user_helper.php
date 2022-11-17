<?php
function get_user_login_type($email){
     $CI =& get_instance();
     $result = $CI->db->get_where("users", ["email"=>$email])->row()->login_type;
     return $result;
}

function is_user_exists($email){
     $CI =& get_instance();
     $result = $CI->db->get_where("users", ["email"=>$email])->row();
     return $result?true:false;
}

function get_user_by_email($email){
  	$CI =& get_instance();
     $result = $CI->db->get_where("users", ["email"=>$email])->row();
     return $result;
}

function get_userid_bytoken($token){
     $CI =& get_instance();
     $result = $CI->db->get_where("users", ["token"=>$token])->row()->id;
     return $result;
}

function get_user_bytoken($token){
     $CI =& get_instance();
     $result = $CI->db->get_where("users", ["token"=>$token])->row();
     return $result;
}

function get_userid_byemail($email){
     $CI =& get_instance();
     $result = $CI->db->get_where("users", ["email"=>$email])->row()->id;
     return $result;
}

function get_email_by_token($token){
    $CI =& get_instance();
     $result = $CI->db->get_where("users", ["token"=>$token])->row()->email;
     return $result;
}

function istokenexists($token){
    $CI =& get_instance();
     $result = $CI->db->get_where("users", ["token"=>$token])->row();
     return $result?true:false;
}

function validate_email_pass($email, $pass){
    $CI =& get_instance();
    $pass = base64_encode($pass);
     $result = $CI->db->get_where("users", ["email"=>$email, "password"=>$pass])->row();
     return $result?true:false;
}

function is_it_poll($forum_id=0){
    $CI =& get_instance();
    $data = $CI->db->get_where("forums", ["id"=>$forum_id])->row();
    if($data)
    if(($data->forum_type=="poll"))
     return TRUE;
    else
     return FALSE;
    else
     return FALSE;
}

function is_user_subscribed($user_id=0){
  $CI =& get_instance();
	if($CI->db->get_where("subscription", ["user_id"=>$user_id, "expire_on>="=>date("Y-m-d")])->row()){
      return true;
    }
  	else{
      return false;
    }
}

function is_get_subscription_type($user_id=0){
  $CI =& get_instance();
  $subscription = $CI->db->get_where("subscription", ["user_id"=>$user_id, "expire_on>="=>date("Y-m-d")])->row();
	if($subscription){
      return $subscription->subscription_type;
    }
  	else{
      return "";
    }
}


function get_subscription($user_id=0){
  $CI =& get_instance();
  $subscription = $CI->db->get_where("subscription", ["user_id"=>$user_id, "expire_on>="=>date("Y-m-d")])->row();
	if($subscription){
      return $subscription;
    }
  	else{
      return false;
    }
}

function get_company($document_company_id=0){
  $CI =& get_instance();
  $result = $CI->db->get_where("companies", ["id"=>$document_company_id])->row();
	if($result){
      return $result;
    }
  	else{
      return false;
    }
}

function get_years($document_company_id=0){
  $CI =& get_instance();
  $result = $CI->db->get_where("years", ["company_id"=>$document_company_id])->row();
	if($result){
      return $result;
    }
  	else{
      return false;
    }
}

function get_financial_documents($company_id=0){
  $CI =& get_instance();
  $result = $CI->db->get_where("years", ["company_id"=>$document_company_id])->row();
	if($result){
      return $result;
    }
  	else{
      return false;
    }
}


function is_this_email_verified($email=""){
   $CI =& get_instance();
  $result = $CI->db->get_where("users", ["email"=>$email])->row();

  if($result->email_verified==0)
  return false;
  else
  return true;

}

function show_flash($flash_value=""){
    $ci =& get_instance();
    $vs = $ci->session->flashdata($flash_value);
    unset($_SESSION[$flash_value]);
    return $vs;
}

function isNotificationActive(){
  $ci =& get_instance();
  $is_notify = $ci->db->get_where("document_notification")->row()->notification;
	return $is_notify;
}

function updateMissingReport($company_id, $year, $period, $document_type){
	$ci =& get_instance();
   	$exist_rec = $ci->db->get_where('missing_docs', ['company_id'=>$company_id, 'year'=>$year, 'period'=>$period])->row();
    if($exist_rec){
    $ci->db->where(['company_id'=>$company_id, 'year'=>$year, 'period'=>$period, 'id!='=>$exist_rec->id])->delete('missing_docs');
  	if($exist_rec){
        //$document_type = $exist_rec->document_type;
		 if($document_type==4)
          	$exist_rec->CF = 1;
         else if($document_type==1)
            $exist_rec->IStmt = 1;
         else if($document_type==2)
             $exist_rec->BS =1;
         else if($document_type==3)
             $exist_rec->OCI = 1;
         else if($document_type==5)
             $exist_rec->CIE = 1;
         else if($document_type==6)
             $exist_rec->Notes = 1;
         else if($document_type==8)
             $exist_rec->financial_report = 1;
		echo $document_type;
      $ci->db->update('missing_docs', $exist_rec, ['company_id'=>$company_id, 'year'=>$year, 'period'=>$period]);
      
       	if(($exist_rec->CF==1)&&($exist_rec->IStmt==1)&&($exist_rec->BS==1)&&($exist_rec->OCI==1)&&($exist_rec->CIE==1)&&($exist_rec->Notes==1)&&($exist_rec->financial_report==1)){
        	//$ci->db->delete('missing_docs', ['company_id'=>$company_id, 'year'=>$year, 'period'=>$period])->row();
        }
      }
    }
}


function updateStatus(){
    $ci =& get_instance();
  	$ci->db->update('update_status', ['updated_at'=>date('Y-m-d H:i:s')], ['id'=>1]);
  }

