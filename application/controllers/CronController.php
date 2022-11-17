<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ini_set('memory_limit', '8192M');
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 ini_set('max_execution_time', 0);
class CronController extends CI_Controller {

  	function __construct()
    {
      parent::__construct();
      $this->load->model('FcmNotification');
  	}

  	public function notificationHandler(){
    	$notifications = $this->db->get('notifications_queue')->result();
      	$this->db->truncate('notifications_queue');
      	$tokens_list = $this->db->get_where("device_tokens", ["device_token!="=>""])->result();
      	$user_ids = array();
      	foreach ($tokens_list as $key => $token) {
        	$devices = array();
          	$devices[] = $token->device_token;
          	$user_id = $token->user_id;
          	$unread_notifications = $this->db->select("COUNT(*) as total")->get_where("notifications", ["user_id" => $user_id, "read_status" => 0])->row()->total;
          	$NotificationData = array();
          	foreach($notifications as $n_key => $notification){
              	$message    =  $notification->message;
              	$n_type     =  $notification->notification_type;
              	$metadata   =  json_decode($notification->metadata);
              	$metadatad  =  array("type" => "Financial Report", "data" => $metadata);
          		$fcm_result =  $this->FcmNotification->push_notification($devices, $message, $n_type, $metadata, ($unread_notifications + $n_key + 1));
              	if (!in_array($user_id, $user_ids)) {
                  	$NotificationData[] = array('user_id'=>$token->user_id, 'message'=>$message, 'metadata'=>json_encode($metadatad));
                }
            }
          	$user_ids[] = $user_id;
          	if(COUNT($NotificationData)>0)
          	$this->db->insert_batch('notifications', $NotificationData);
        }
    }
}
