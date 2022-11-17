<?php

defined('BASEPATH') or exit('No direct script access allowed');
ini_set('memory_limit', '8192M');
ini_set('max_execution_time', 0);
class Admin extends CI_Controller
{


  function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('user');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->library('email');
    $this->load->helper('file');
    $this->load->model('admin_model');
    //$this->load->model('FcmNotification');
    $this->load->model('user');
    $this->load->helper('socialposts');
    $this->user_type = $this->session->userdata('user_type');
  }


  public function index()
  {
    $this->load->view('login');
  }


  public function login()
  {

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('pass', 'Password', 'required');
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

    if ($this->form_validation->run()) {

      $email = $this->input->post('email');
      $pass  = $this->input->post('pass');

      $this->load->model('Admin_model');
      $login_id = $this->Admin_model->isvalidate($email, $pass);


      if ($login_id) {
        $this->user_type = $this->db->get_where("admin", ["id" => $login_id])->row()->user_type;
        $this->session->set_userdata('admin_id', $login_id);
        $this->session->set_userdata('user_type', $this->user_type);
        if ($this->user_type == "admin")
          return redirect('/admin/dashboard');
        else
          return redirect('/admin/documents');
      } else {
        $this->session->set_flashdata('Login_failed', 'Invalid Username/Password');
        $this->session->set_flashdata('msg_class', 'alert-danger');
        return redirect('/admin');
      }
    } else {
      $this->load->view('/login');
    }
  }


  public function dashboard()
  {

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view('dashboard', ['admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }


  public function profile_detail()
  {

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view('profile', ['admin_detail' => $admin_detail]);
      }
    } else {
      return redirect('/admin');
    }
  }

  public function accessusers()

  {

    $session_id = $this->session->userdata('admin_id');

    if ($session_id) {

      if ($this->user_type == "admin") {

        $admin_detail = $this->admin_model->get_admin_data($session_id);

        $users = $this->admin_model->all_access_users();   // for foreach loop

        $this->load->view('access_user_list', ['admin_detail' => $admin_detail, 'users' => $users]);
      }
    } else {

      return redirect('admin');
    }
  }

  public function edituser($id)
  {
    $session_id = $this->session->userdata('admin_id');

    if ($session_id) {
      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $user = $this->db->get_where("admin", ["id" => $id])->row_array();
        $this->load->view(
          'edituser',
          ['admin_detail' => $admin_detail, 'user' => $user]
        );
      }
    } else
      $this->load->view('login');
  }

  public function adduseraccess()
  {
    $session_id = $this->session->userdata('admin_id');

    if ($session_id) {
      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view('addacessuser', ['admin_detail' => $admin_detail]);
      }
    } else
      $this->load->view('login');
  }


  public function change_password()
  {

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view('changepassword', ['admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }

  public function new_password()
  {


    $this->form_validation->set_rules('password', 'New Password', 'required');
    $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');


    if ($this->form_validation->run()) {

      $pass = $this->input->post('password');
      $session_id = $this->session->userdata('admin_id');
      $admin_detail = $this->admin_model->update_password($session_id, $pass);


      $this->session->set_flashdata('password_changed', 'Password changed successfully!');
      $this->session->set_flashdata('msg_class', 'alert-success');
      return redirect('/admin');
    } else {


      $session_id = $this->session->userdata('admin_id');
      $admin_detail = $this->admin_model->get_admin_data($session_id);
      $this->load->view('changepassword', ['admin_detail' => $admin_detail]);
    }
  }

  public function edit_admin($id)
  {

    $admin_detail = $this->admin_model->get_admin_data($id);
    $this->load->view('edit_admin', ['admin_detail' => $admin_detail]);
  }

  public function deleteaccess($id = 0)
  {
    $this->db->delete("admin", ["id" => $id]);
    echo "Success";
  }
  public function deleteuser($id = 0)
  {
    $this->db->delete("forums_likes", ["user_id" => $id]);
    $this->db->delete("forum_comments", ["user_id" => $id]);
    $this->db->delete("forum_dislikes", ["user_id" => $id]);
    $this->db->delete("forums", ["user_id" => $id]);
    $this->db->delete("polling_select", ["user_id" => $id]);
    $this->db->delete("portfolio", ["user_id" => $id]);
    $this->db->delete("searches", ["user_id" => $id]);
    $this->db->delete("searches", ["user_id" => $id]);
    $this->db->delete("visited_companies", ["user_id" => $id]);
    $this->db->delete("subscription", ["user_id" => $id]);
    $this->db->delete("user_events", ["user_id" => $id]);
    $this->db->delete("users", ["id" => $id]);
    echo "Success";
  }
  public function updateadmin($admin_id)
  {


    $this->form_validation->set_rules('first_name', 'First Name', 'required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required');

    $this->form_validation->set_rules('mobile', 'Phone', 'required|min_length[10]|max_length[12]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');




    if ($this->form_validation->run()) {
      $post = $this->input->post();

      if ($this->admin_model->update_admin($admin_id, $post)) {
        $this->session->set_flashdata('msg', 'Admin Update successfully');
        $this->session->set_flashdata('msg_class', 'alert-success');
      } else {
        $this->session->set_flashdata('msg', 'Admin not update Please try again!!');
        $this->session->set_flashdata('msg_class', 'alert-danger');
      }
      return redirect('admin/profile_detail');
    } else {
      $this->edit_admin($admin_id);
    }
  }



  public function logout()
  {
    $this->session->unset_userdata('admin_id');
    $this->session->set_flashdata('logut_success', 'You are succesfully loged out');
    return redirect('/admin');
  }


  public function Users()
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {

      $admin_detail = $this->admin_model->get_admin_data($session_id);
      $users = $this->admin_model->all_users();   // for foreach loop
      $this->load->view('user_list', ['admin_detail' => $admin_detail, 'users' => $users]);
    } else {
      return redirect('/admin');
    }
  }

  public function updateuser($id)

  {

    $this->form_validation->set_rules('first_name', 'First Name', 'required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run()) {
      $data["first_name"] = $this->input->post('first_name');
      $data["last_name"] = $this->input->post('last_name');
      $data["email"] = $this->input->post('email');
      $data["password"] = $this->input->post('password');
      $data["auth_countries"] = implode(",", $this->input->post('countries_id'));
      $id = $this->input->post('user_id');
      $post = $this->input->post();
      if ($this->admin_model->update_access_user($data, $id)) {
        $this->session->set_flashdata('msgsuccess', 'User Update successfully');

        $this->session->set_flashdata('msg_class', 'alert-success');
        $this->accessusers();
      } else {

        $this->session->set_flashdata('msg', 'User not update Please try again!!');

        $this->session->set_flashdata('msg_class', 'alert-danger');
      }

      $this->edituser($id);
    } else {

      $this->edituser($id);
    }
  }

  public function addaccessusers()

  {

    $this->form_validation->set_rules('first_name', 'First Name', 'required');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run()) {
      $data["first_name"] = $this->input->post('first_name');
      $data["last_name"] = $this->input->post('last_name');
      $data["email"] = $this->input->post('email');
      $data["password"] = $this->input->post('password');

      $post = $this->input->post();
      if ($this->admin_model->add_access_user($data)) {
        $this->session->set_flashdata('msgsuccess', 'User Add successfully');

        $this->session->set_flashdata('msg_class', 'alert-success');
        $this->accessusers();
      } else {

        $this->session->set_flashdata('msg', 'User not update Please try again!!');

        $this->session->set_flashdata('msg_class', 'alert-danger');
      }

      $this->adduseraccess();
    } else {

      $this->adduseraccess();
    }
  }
  public function Companies()
  {

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {

      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $contries = $this->admin_model->all_companies();   // for foreach loop
        $this->load->view('company_list', ['admin_detail' => $admin_detail, 'companies' => $contries]);
      }
    } else {
      return redirect('/admin');
    }
  }

  public function Documents($country = "", $company_id = 0, $year = 0, $period = "", $flag = 0)
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {

      $admin_detail = $this->admin_model->get_admin_data($session_id);

      if (isset($_POST['upload'])) {


        $uploadstatus = false;
        $total_years_arr = array();
        $doc_data = array();
        $country = $country;
        $quarter = "";
        $company_name = $this->db->get_where("companies", ["id" => $company_id])->row()->Company_Name;
        $company_id = $company_id;
        $year = 0;
        foreach ($_FILES['files']['name'] as $i => $name) {
          if (strlen($_FILES['files']['name'][$i]) > 1) {

            $filename =  str_replace(" ", "", $_FILES['files']['name'][$i]);
            $filename_arr = explode("-", str_replace(" ", "", $_FILES['files']['name'][$i]));
            //print_r($filename_arr);
            if (in_array("Q1", $filename_arr)) {
              $quarter = "Q1";
              $quartertxt = "Q1";
            } else if (in_array("Q1(Arabic)", $filename_arr)) {
              $quarter = "Q1";
              $quartertxt = "Q1(Arabic)";
            } else if (in_array("Q1(ARABIC)", $filename_arr)) {
              $quarter = "Q1";
              $quartertxt = "Q1(ARABIC)";
            } else if (in_array("Q2", $filename_arr)) {
              $quarter = "Q2";
              $quartertxt = "Q2";
            } else if (in_array("Q2(Arabic)", $filename_arr)) {
              $quarter = "Q2";
              $quartertxt = "Q2(Arabic)";
            } else if (in_array("Q2(ARABIC)", $filename_arr)) {
              $quarter = "Q2";
              $quartertxt = "Q2(ARABIC)";
            } else if (in_array("Q3", $filename_arr)) {
              $quarter = "Q3";
              $quartertxt = "Q3";
            } else if (in_array("Q3(Arabic)", $filename_arr)) {
              $quarter = "Q3";
              $quartertxt = "Q3(Arabic)";
            } else if (in_array("Q3(ARABIC)", $filename_arr)) {
              $quarter = "Q3";
              $quartertxt = "Q3(ARABIC)";
            } else if (in_array("Q4", $filename_arr)) {
              $quarter = "Q4";
              $quartertxt = "Q4";
            } else if (in_array("Q4(Arabic)", $filename_arr)) {
              $quarter = "Q4";
              $quartertxt = "Q4(Arabic)";
            } else if (in_array("Q4(ARABIC)", $filename_arr)) {
              $quarter = "Q4";
              $quartertxt = "Q4(ARABIC)";
            } else {
              $quarter = "Annual";
              $quartertxt = "Annual";
            }

            if (in_array("BS", $filename_arr)) { //Balance Sheet
              $doc_type = "BS";
              $doc_type_id = 2;
            } else if (in_array("CF", $filename_arr)) { //Cash Flow Statement
              $doc_type = "CF";
              $doc_type_id = 4;
            } else if (in_array("IS", $filename_arr)) { //Income Statement
              $doc_type = "IS";
              $doc_type_id = 1;
            } else if (in_array("CIE", $filename_arr)) { //Equity
              $doc_type = "CIE";
              $doc_type_id = 3;
            } else if (in_array("Notes", $filename_arr)) { //Notes
              $doc_type = "Notes";
              $doc_type_id = 6;
            } else if (in_array("NOTES", $filename_arr)) { //NOTES
              $doc_type = "NOTES";
              $doc_type_id = 6;
            } else if (in_array("OCI", $filename_arr)) { //Comperansive
              $doc_type = "OCI";
              $doc_type_id = 5;
            } else {
              $doc_type = "Financial Report";
              $doc_type_id = 8;
            }


            $filter_str = str_replace(" ", "", str_replace("-", "", str_replace("$doc_type", "", str_replace("$quartertxt", "", "$filename"))));

            $year = substr($filter_str, 0, 4);
            if (!in_array((object) array($year), $total_years_arr))
              $total_years_arr[] = $year;
              $period = $quarter;
              $document_link = base_url()."uploads/documents/$country/$company_name/$year/$period/" . $_FILES['files']['name'][$i];
              $doc_data[] = array("document_company_id" => $company_id, "document_year" => $year, "document_period" => $period, "document_type_id" => $doc_type_id, "document_link" => $document_link);
            //echo $_FILES['files']['name'][$i]."  - (Period => $quarter, | Document Type => $doc_type, | Year=>$year, | Filter str => $filter_str | type_id =>$doc_type_id ) <br>";


            if (!file_exists("./uploads/documents/$country/$company_name/$year/$period/")) {
              mkdir("./uploads/documents/$country/$company_name/$year/$period/", 0777, true);
            }
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], "./uploads/documents/$country/$company_name/$year/$period/" . $_FILES['files']['name'][$i])) {
              $uploadstatus = true;
            } else {
              $uploadstatus = false;
            }
          }
        }

        //print_r($doc_data);
        if ($uploadstatus) {

          for ($counta = 0; $counta < count($total_years_arr); $counta++)
            if (!$this->db->get_where("years", ["year" => $total_years_arr[$counta], "company_id" => $company_id])->row())
              $this->db->insert("years", ["year" => $total_years_arr[$counta], "company_id" => $company_id]);


          for ($counta = 0; $counta < count($doc_data); $counta++)
            if (!$this->db->get_where("documents", $doc_data[$counta])->row()) {
              updateMissingReport($doc_data[$counta]['document_company_id'], $doc_data[$counta]['document_year'], $doc_data[$counta]['document_period'], $doc_data[$counta]['document_type_id']);

              $this->db->insert("documents", $doc_data[$counta]);
            }

          $devices = array();
          $company_data = $this->db->select("*, CONCAT('https://www.ashom.app', image) as image")->get_where("companies", ["id" => $company_id])->row_array();
          $displytext = "";
          if ($quarter != 'Annual')
            $displytext = $quarter . '-';
          $message = "$company_name has released its " . ($quarter == 'Annual' ? 'annual financial' : 'financial') . " report of $displytext" . "$year.";
          $NotificationData = array();
          $c_dat[0]["Company_payload"] =  $company_data;
          $c_dat[0]["year"] =  $year;
          $c_dat[0]["period"] =  $quarter;
          $n_type = "Financial Report";
          $metadata = array("type" => "Financial Report", "data" => $c_dat);
          $user_ids = array();
          $isNotificationActive = isNotificationActive();
		  linkedin_news_post($message, 'https://ashom.app', 'https://ashom.app/assets/images/financialsocial.png');
          twitter_post($message, 'https://ashom.app', 'https://ashom.app/assets/images/financialsocial.png');
          if ($isNotificationActive) {
            $notify_data = array();
            $notify_data['notification_type'] = $n_type;
            $notify_data['message'] = $message;
            $notify_data['metadata'] = json_encode($c_dat);
            $this->db->insert('notifications_queue', $notify_data);
          // $tokens_list = $this->db->get_where("device_tokens", "device_token!=''")->result();
          // foreach ($tokens_list as $key => $token) {
          //   $devices = array();
          //   $devices[] = $token->device_token;
          //   $user_id = $token->user_id;
          // $unread_notifications = $this->db->select("COUNT(*) as total")->get_where("notifications", ["user_id" => $user_id, "read_status" => 0])->row()->total;
          // $fcm_result = $this->FcmNotification->push_notification($devices, $message, $n_type, $c_dat, ($unread_notifications + 1));
          // if (!in_array(($token->user_id), $user_ids)) {
          //   $user_ids[] = $token->user_id;
          //   $NotificationData[$key]["user_id"] = $token->user_id;
          //   $NotificationData[$key]["message"] = $message;
          //   $NotificationData[$key]["metadata"] = json_encode($metadata);
          // }
          // }
          // if (isNotificationActive()) {
          //   $this->db->insert_batch('notifications', $NotificationData);
          // }
          echo "Folder is successfully uploaded";
        }
        } else {
          //echo "Not uploaded because of error #" . ($_FILES["file"]["error"]?$_FILES["file"]["error"]:"");
        }
        $year = 0;
      }

      if ($country == '') {
        $contries = $this->admin_model->all_countries();
        $this->load->view('doc_countries', ['admin_detail' => $admin_detail]);
      } else {
        if ($company_id == 0)
          $this->load->view('doc_companies', ['admin_detail' => $admin_detail]);
        else {
          if ($year == 0)
            $this->load->view('doc_years', ['admin_detail' => $admin_detail]);
          else {
            if ($period == '') {
              $this->load->view('doc_periods', ['admin_detail' => $admin_detail]);
            } else {

              $this->load->view('doc_document', ['admin_detail' => $admin_detail, "cacheflag" => $flag]);
            }
          }
        }
      }

      // $this->load->view('documnts_view',['admin_detail'=>$admin_detail,'countries'=>$contries]);

    } else {
      return redirect('/admin');
    }
  }

  public function addcountry()
  {
    $country = $this->input->post("country");
    if ($this->db->insert("countries", ["country" => $country])) {
      return redirect('/admin/documents');
    } else {
      echo "Error";
    }
  }


  public function deletecountry($id = 0)
  {
    if ($this->db->delete("countries", "id=$id")) {
      return redirect('/admin/documents');
    } else {
      echo "Error";
    }
  }

  public function addcompanye($country_id = "")
  {
    $data = $this->input->post();
    if (!empty($_FILES['imagefile']['name'])) {
      $config['upload_path'] = "./uploads/company_logo/";
      // $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf';
      $config['allowed_types'] = '*';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('imagefile')) {
        $image_data = $this->upload->data();
        $filename = $image_data['file_name'];
        #                    $exists_?rec = $this->db->get_where("documents", $data)->row();
        print_r($data);
        $data['image'] = "/uploads/company_logo/$filename";
        #                    unset($data['imagefile']);
      } else {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
      }
    }
    if ($this->db->insert("companies", $data)) {
      updateStatus();
      return redirect('/admin/documents/' . $country_id);
    } else {
      echo "Error";
    }
  }

  public function deletecompany($country = "", $id = 0)
  {
    $documents = $this->db->get_where("documents", ["document_company_id"=>$id])->result();
    foreach ($documents as $key => $document) {
        unlink(str_replace("https://ashom.app", ".", str_replace("https://ashom.app", ".", $document->document_link)));
    }
    $this->db->delete("documents", ["document_company_id"=>$id]);
    $this->db->delete("incompletedoc", ["company_id"=>$id]);
    $this->db->delete("missing_docs", ["company_id"=>$id]);
    $this->db->delete("missing_reports", ["company_id"=>$id]);
    $this->db->delete("visited_companies", ["company_id"=>$id]);
    $this->db->query("DELETE FROM `searches` where searchstr like '%✂$id'");
    if ($this->db->delete("companies", "id=$id")) {
      updateStatus();
      return redirect('/admin/documents/' . $country);
    } else {
      echo "Error";
    }
  }

  public function addyear($country_id = "", $company_id = 0)
  {
    $data = $this->input->post();
    if (!$this->db->get_where("years", $data)->row())
      if ($this->db->insert("years", $data)) {
        $company = $this->db->get_where("companies", "id=$company_id")->row();
        $batch_data[] = ['company_id'=>$company_id, 'company_name'=>$company->Company_Name, 'symbol'=>$company->SymbolTicker, 'country'=>$company->Country, 'year'=>$data['year'], 'period'=>'Q1', 'report'=>0 ,'CF'=>0,'BS'=>0,'IStmt'=>0,'OCI'=>0,'CIE'=>0,'Notes'=>0,'financial_report'=>0];
        $batch_data[] = ['company_id'=>$company_id, 'company_name'=>$company->Company_Name, 'symbol'=>$company->SymbolTicker, 'country'=>$company->Country, 'year'=>$data['year'], 'period'=>'Q2', 'report'=>0 ,'CF'=>0,'BS'=>0,'IStmt'=>0,'OCI'=>0,'CIE'=>0,'Notes'=>0,'financial_report'=>0];
        $batch_data[] = ['company_id'=>$company_id, 'company_name'=>$company->Company_Name, 'symbol'=>$company->SymbolTicker, 'country'=>$company->Country, 'year'=>$data['year'], 'period'=>'Q3', 'report'=>0 ,'CF'=>0,'BS'=>0,'IStmt'=>0,'OCI'=>0,'CIE'=>0,'Notes'=>0,'financial_report'=>0];
        $batch_data[] = ['company_id'=>$company_id, 'company_name'=>$company->Company_Name, 'symbol'=>$company->SymbolTicker, 'country'=>$company->Country, 'year'=>$data['year'], 'period'=>'Q4', 'report'=>0 ,'CF'=>0,'BS'=>0,'IStmt'=>0,'OCI'=>0,'CIE'=>0,'Notes'=>0,'financial_report'=>0];
        $batch_data[] = ['company_id'=>$company_id, 'company_name'=>$company->Company_Name, 'symbol'=>$company->SymbolTicker, 'country'=>$company->Country, 'year'=>$data['year'], 'period'=>'Annual', 'report'=>0 ,'CF'=>0,'BS'=>0,'IStmt'=>0,'OCI'=>0,'CIE'=>0,'Notes'=>0,'financial_report'=>0];
        $this->db->insert_batch("missing_docs", $batch_data);
        return redirect('/admin/documents/' . $country_id . '/' . $company_id);
      } else {
        echo "Error";
      }
    else {
      $year = $data["year"];
      $this->session->set_flashdata('err', "$year is already exists.");
      return redirect('/admin/documents/' . $country_id . '/' . $company_id);
    }
  }

  public function deleteyear($country_id = "", $company_id = 0, $id = 0)
  {
    //$documents = $this->db->join("years", "years.id=")->where(["document_company_id"=>$company_id, ""=>])->get("documents");
    $year = $this->db->get_where("years", "id=$id")->row()->year;
    if ($this->db->delete("years", "id=$id")) {
      $this->db->delete("documents", ["document_company_id" => $company_id, "document_year" => $year]);
      $this->db->delete("missing_docs", ['company_id'=>$company_id, 'year'=>$year]);
      return redirect('/admin/documents/' . $country_id . '/' . $company_id);
    } else {
      echo "Error";
    }
  }

  public function testpath()
  {
    if (!file_exists('./uploads/documents/2021')) {
      mkdir('./uploads/documents/2021', 0777, true);
    }
  }
  public function adddocument()
  {
    $data = $this->input->post();

    if (!empty($data)) {
      unset($data["country"]);
      unset($data["document"]);
      $doc_type_id = $this->input->post("document_type_id");
      $doc_type_name = $this->db->get_where("document_types", ["id" => $doc_type_id])->row()->name;
      $country = $this->input->post("country");
      $period = $this->input->post("document_period");
      $year = $this->input->post("document_year");
      $company_id = $this->input->post("document_company_id");
      $company_name = $this->db->get_where("companies", ["id" => $company_id])->row()->Company_Name;
      $ac_company_name =   $company_name;
      $company_name = str_replace(" ", "_", $company_name);
      $country = str_replace(" ", "_", $country);
      $country = $this->input->post("country");

      if (!empty($_FILES['document']['name'])) {
        if (!file_exists("./uploads/documents/$country/$company_name/$year/$period/")) {
          mkdir("./uploads/documents/$country/$company_name/$year/$period/", 0777, true);
        }
        $config['upload_path'] = "./uploads/documents/$country/$company_name/$year/$period/";
        // $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('document')) {
          $image_data = $this->upload->data();
          $filename = $image_data['file_name'];
          $exists_rec = $this->db->get_where("documents", $data)->row();
          $data['document_link'] = base_url() . "uploads/documents/$country/$company_name/$year/$period/$filename";

          updateMissingReport($company_id, $year, $period, $doc_type_id);
          if ($exists_rec) {
            $filepath = $exists_rec->document_link;
            $doc_id = $exists_rec->document_id;

            if ($filepath)
              if (unlink(str_replace("https://ashom.app", ".", str_replace("https://ashom.app", ".", $filepath)))) {
                if ($this->db->delete("documents", ["document_id" => $doc_id])) {
                }
              }
          }

          $devices = array();
          $tokens_list = $this->db->get_where("device_tokens", "device_token!=''")->result();
          $message = "$ac_company_name has released its $period $doc_type_name of Year $year.";
		  linkedin_news_post($message, 'https://ashom.app', 'https://ashom.app/assets/images/financialsocial.png');
          twitter_post($message, 'https://ashom.app', 'https://ashom.app/assets/images/financialsocial.png');
          $NotificationData = array();
          $company_data = $this->db->select("*, CONCAT('https://www.ashom.app', image) as image")->get_where("companies", ["id" => $company_id])->row_array();
          $c_dat[0]["Company_payload"] =  $company_data;
          $c_dat[0]["year"] =  $year;
          $c_dat[0]["period"] =  $period;
          $metadata = array("type" => "Financial Report", "data" => $c_dat);
          $user_ids = array();
          foreach ($tokens_list as $key => $token) {
            $devices[] = $token->device_token;
            $devices = array();
            $devices[] = $token->device_token;
            $user_id = $token->user_id;
            $n_type = "Financial Report";
            $unread_notifications = $this->db->select("COUNT(*) as total")->get_where("notifications", ["user_id" => $user_id, "read_status" => 0])->row()->total;

            if (isNotificationActive()) {
              $fcm_result = $this->FcmNotification->push_notification($devices, $message, $n_type, $c_dat, ($unread_notifications + 1));
              if (json_decode($fcm_result)->failure) {
                $this->db->delete("device_tokens", ["device_token" => ($token->device_token)]);
              }

              if (!in_array(($token->user_id), $user_ids)) {
                $user_ids[] = $token->user_id;
                $NotificationData[$key]["user_id"] = $token->user_id;
                $NotificationData[$key]["message"] = $message;
                $NotificationData[$key]["metadata"] = json_encode($metadata);
              }
            }
          }

          if (isNotificationActive()) {
            $this->db->insert_batch('notifications', $NotificationData);
          }

          $this->db->insert("documents", $data);
          $this->output->delete_cache("/admin/Documents/$country/$company_id/$year/$period");

          return redirect("/admin/Documents/$country/$company_id/$year/$period/1");
        } else {
          $error = array('error' => $this->upload->display_errors());
          print_r($error);
        }
      }
    } else {

      $POST_MAX_SIZE = ini_get('post_max_size');
      echo "Max Size : " . $POST_MAX_SIZE . "   cotent size : " . $_SERVER['CONTENT_LENGTH'];
      $mul = substr($POST_MAX_SIZE, -1);
      $mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
      if ($_SERVER['CONTENT_LENGTH'] > $mul * (int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
        $error = true;
      }
    }
  }

  public function phpinnfo()
  {
    phpinfo();
  }
  public function deletedocs($country = "", $company_id = 0, $year = 0, $period_id = 0, $id = 0)
  {
    $filepath = $this->db->get_where("documents", ["document_id" => $id])->row();
    if ($filepath) {
      $filepath = $filepath->document_link;
      if ($filepath)
        if (unlink(str_replace("https://ashom.app", ".", str_replace("https://ashom.app", ".", $filepath)))) {
          if ($this->db->delete("documents", ["document_id" => $id]))
            return redirect("/admin/documents/$country/$company_id/$year/$period_id");
        }
    } else {
      echo "File not found or deleted.";
    }
  }

  public function contactus()
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view("contact_us", ['admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }


  public function industries()
  {
    if (isset($_POST["submt"])) {

      $data = $this->input->post();
      $name = $this->input->post("industry");
      $id = $this->input->post("indus_id");
      $this->db->update("industries", ["industry" => $name], ["id" => $id]);
    }
    if (isset($_POST["updateindustries"])) {
      $name = $this->input->post("industry");
      $this->db->insert("industries", ["industry" => $name]);
    }

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {



        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view("industries", ['admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }
  public function deleteindustry($id = 0)
  {
    $this->db->delete("industries", ["id" => $id]);
  }

  public function addcompany($id = 0)
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {
        if (isset($_POST["submit"])) {
          $data = $this->input->post();
          if (!empty($_FILES['imagefile']['name'])) {
            $config['upload_path'] = "./uploads/company_logo/";
            // $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf';
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('imagefile')) {
              $image_data = $this->upload->data();
              $filename = $image_data['file_name'];
              #                    $exists_?rec = $this->db->get_where("documents", $data)->row();

              $data['image'] = "/uploads/company_logo/$filename";
              #                    unset($data['imagefile']);
            } else {
              $error = array('error' => $this->upload->display_errors());
              print_r($error);
            }
          }
          unset($data["submit"]);
          updateStatus();
          $this->db->insert("companies", $data);
          $this->session->set_flashdata('success', 'Company Added Successfully');
        }

        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $id = $this->db->insert_id();
        $company = $this->db->get_where("companies", ["id" => $id])->row();
        $this->load->view("addcompany", ["company" => $company, 'admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }


  public function editcompany($id = 0)
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {
        if (isset($_POST["submit"])) {
          $data = $this->input->post();
          if (!empty($_FILES['imagefile']['name'])) {
            $config['upload_path'] = "./uploads/company_logo/";
            // $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf';
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('imagefile')) {
              $image_data = $this->upload->data();
              $filename = $image_data['file_name'];
              #                  	 	$exists_?rec = $this->db->get_where("documents", $data)->row();
              $data['image'] = "/uploads/company_logo/$filename";
              #                   	 unset($data['imagefile']);
            } else {
              $error = array('error' => $this->upload->display_errors());
              print_r($error);
            }
          }
          $id = $data["cid"];
          unset($data["cid"]);
          unset($data["submit"]);
          $this->db->update("companies", $data, ["id" => $id]);
          updateStatus();
          $this->session->set_flashdata('success', 'Company Updated Successfully');
        }

        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $company = $this->db->get_where("companies", ["id" => $id])->row();
        $this->load->view("editcompany", ["company" => $company, 'admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }

  public function folderuploads()
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if (isset($_POST['upload'])) {


        $uploadstatus = false;
        $total_years_arr = array();
        $doc_data = array();
        $country = "Bahrain";
        $company_name = "ExampleBackend";
        $company_id = 710;
        foreach ($_FILES['files']['name'] as $i => $name) {
          if (strlen($_FILES['files']['name'][$i]) > 1) {

            $filename =  $_FILES['files']['name'][$i];
            $filename_arr = explode("-", str_replace(" ", "", $_FILES['files']['name'][$i]));

            if (in_array("Q1", $filename_arr)) {
              $quarter = "Q1";
              $quartertxt = "Q1";
            } else if (in_array("Q1(Arabic)", $filename_arr)) {
              $quarter = "Q1";
              $quartertxt = "Q1(Arabic)";
            } else if (in_array("Q1 (Arabic)", $filename_arr)) {
              $quarter = "Q1";
              $quartertxt = "Q1 (Arabic)";
            } else if (in_array("Q1(ARABIC)", $filename_arr)) {
              $quarter = "Q1";
              $quartertxt = "Q1(ARABIC)";
            } else if (in_array("Q1 (ARABIC)", $filename_arr)) {
              $quarter = "Q1";
              $quartertxt = "Q1 (ARABIC)";
            } else if (in_array("Q2", $filename_arr)) {
              $quarter = "Q2";
              $quartertxt = "Q2";
            } else if (in_array("Q2(Arabic)", $filename_arr)) {
              $quarter = "Q2";
              $quartertxt = "Q2(Arabic)";
            } else if (in_array("Q3", $filename_arr)) {
              $quarter = "Q3";
              $quartertxt = "Q3";
            } else if (in_array("Q3(Arabic)", $filename_arr)) {
              $quarter = "Q3";
              $quartertxt = "Q3(Arabic)";
            } else if (in_array("Q4", $filename_arr)) {
              $quarter = "Q4";
              $quartertxt = "Q4";
            } else if (in_array("Q4(Arabic)", $filename_arr)) {
              $quarter = "Q4";
              $quartertxt = "Q4(Arabic)";
            } else {
              $quarter = "Annual";
              $quartertxt = "Annual";
            }

            if (in_array("BS", $filename_arr)) { //Balance Sheet
              $doc_type = "BS";
              $doc_type_id = 2;
            } else if (in_array("CF", $filename_arr)) { //Cash Flow Statement
              $doc_type = "CF";
              $doc_type_id = 4;
            } else if (in_array("IS", $filename_arr)) { //Income Statement
              $doc_type = "IS";
              $doc_type_id = 1;
            } else if (in_array("CIE", $filename_arr)) { //Equity
              $doc_type = "CIE";
              $doc_type_id = 3;
            } else if ((in_array("Notes", $filename_arr)) || (in_array("NOTES", $filename_arr))) { //Notes
              $doc_type = "Notes";
              $doc_type_id = 6;
            } else if (in_array("OCI", $filename_arr)) { //Comperansive
              $doc_type = "OCI";
              $doc_type_id = 5;
            } else {
              $doc_type = "Financial Report";
              $doc_type_id = 8;
            }


            $filter_str = str_replace(" ", "", str_replace("-", "", str_replace("$doc_type", "", str_replace("$quartertxt", "", "$filename"))));

            $year = substr($filter_str, 0, 4);
            if (!in_array((object) array($year), $total_years_arr))
              $total_years_arr[] = $year;
            $period = $quarter;
            $document_link = "https://ashom.app/uploads/documents/$country/$company_name/$year/$period/" . $_FILES['files']['name'][$i];
            $doc_data[] = array("document_company_id" => $company_id, "document_year" => $year, "document_period" => $period, "document_type_id" => $doc_type_id, "document_link" => $document_link);
            //echo $_FILES['files']['name'][$i]."  - (Period => $quarter, | Document Type => $doc_type, | Year=>$year, | Filter str => $filter_str | type_id =>$doc_type_id ) <br>";
            if (!file_exists("./uploads/documents/$country/$company_name/$year/$period/")) {
              mkdir("./uploads/documents/$country/$company_name/$year/$period/", 0777, true);
            }
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], "./uploads/documents/$country/$company_name/$year/$period/" . $_FILES['files']['name'][$i])) {
              $uploadstatus = true;
            } else {
              $uploadstatus = false;
            }
          }
        }

        //print_r($doc_data);
        if ($uploadstatus) {
          for ($counta = 0; $counta < count($total_years_arr); $counta++)
            if (!$this->db->get_where("years", ["year" => $total_years_arr[$counta], "company_id" => $company_id])->row())
              $this->db->insert("years", ["year" => $total_years_arr[$counta], "company_id" => $company_id]);

          for ($counta = 0; $counta < count($doc_data); $counta++) {
            $exist_docs = $this->db->get_where("documents", $doc_data[$counta])->row();
            if ($exist_docs) {
              $this->db->delete("documents", $doc_data[$counta]);
            }
            updateMissingReport($doc_data[$counta]['document_company_id'], $doc_data[$counta]['document_year'], $doc_data[$counta]['document_period'], $doc_data[$counta]['document_type_id']);
            $this->db->insert("documents", $doc_data[$counta]);
          }

          $devices = array();
          $tokens_list = $this->db->get_where("device_tokens", "device_token!=''")->result();
          $message = "$ac_company_name has released its $period financial report of Year $year";
          $NotificationData = array();
          $company_data = $this->db->select("*, CONCAT('https://www.ashom.app', image) as image")->get_where("companies", ["id" => $company_id])->row_array();
          $c_dat[0]["Company_payload"] =  $company_data;
          $c_dat[0]["year"] =  $year;
          $c_dat[0]["period"] =  $period;
          $metadata = array("type" => "Financial Report", "data" => $c_dat);
          foreach ($tokens_list as $key => $token) {
            $devices[] = $token->device_token;
            if (!in_array(($token->user_id), $user_ids)) {
              $user_ids[] = $token->user_id;
              $NotificationData[$key]["user_id"] = $token->user_id;
              $NotificationData[$key]["message"] = $message;
              $NotificationData[$key]["metadata"] = json_encode($metadata);
            }
          }
          if (isNotificationActive()) {
            $this->db->insert_batch('notifications', $NotificationData);
            $n_type = "Financial Report";
            $fcm_result = $this->FcmNotification->push_notification($devices, $message, $n_type, $c_dat);
          }

          echo "Folder is successfully uploaded";
        } else {
          echo "Not uploaded because of error #" . $_FILES["file"]["error"];
        }
      }

      if (!$this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view("folderuploads", ['admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }

  public function forums()
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      $forums = $this->db->select("forums.*, users.first_name, users.last_name, users.profile_pic, isEdited")->order_by("forums.created", "desc")->join("users", "forums.user_id=users.id")->get("forums")->result();
      foreach ($forums as $index => $value) {
        if ($value->forum_type == "poll") {
          $value->options = json_decode($value->options);
          $inst = $value->options;
          $total_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id" => ($value->id)])->row()->total;
          $option1_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id" => ($value->id), "selected_option" => 1])->row()->total;
          $option2_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id" => ($value->id), "selected_option" => 2])->row()->total;;
          $option3_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id" => ($value->id), "selected_option" => 3])->row()->total;;
          $inst->total_option1_voters = (int)$option1_voters;
          $inst->total_option2_voters = (int)$option2_voters;
          $inst->total_option3_voters = (int)$option3_voters;
          $inst->percentage_option1_voters = round((($total_voters > 0) ? ($option1_voters * 100 / $total_voters) : 0), 2);
          $inst->percentange_option2_voters = round((($total_voters > 0) ? ($option2_voters * 100 / $total_voters) : 0), 2);
          $inst->percentage_option3_voters = round((($total_voters > 0) ? ($option3_voters * 100 / $total_voters) : 0), 2);
        } else {
          $value->options = new stdClass();
        }
        $userdata = $this->db->get_where("users", ["id" => $value->user_id])->row();

        $value->posted_by_name = ($userdata->first_name . " " . $userdata->last_name);
        $value->posted_by_profile = ($userdata->profile_pic);
        $value->total_liked = $this->db->select("count(*) as total")->get_where("forums_likes", ["forum_id" => ($value->id)])->row()->total;
        $value->total_disliked = $this->db->select("count(*) as total")->get_where("forum_dislikes", ["forum_id" => ($value->id)])->row()->total;
        $value->total_comments = $this->db->select("count(*) as total")->get_where("forum_comments", ["forum_id" => ($value->id)])->row()->total;
        $value->comments = $this->db->select("CONCAT(first_name, ' ', last_name) as name, profile_pic, comment, forum_comments.created")->join("users", "forum_comments.user_id = users.id")->get_where("forum_comments", ["forum_id" => ($value->id)])->result();
        unset($value->user_id);
      }
      $admin_detail = $this->admin_model->get_admin_data($session_id);
      $this->load->view('forum_list', ['admin_detail' => $admin_detail, 'forums' => $forums]);
    } else {

      return redirect('/admin');
    }
  }

  public function editforum($forum_id = 0)
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      $value = $this->db->select("forums.*, users.first_name, users.last_name, users.profile_pic, isEdited")->order_by("forums.created", "desc")->join("users", "forums.user_id=users.id")->get_where("forums", ["forums.id" => $forum_id])->row();
      $index = 0;
      if ($value->forum_type == "poll") {
        $value->options = json_decode($value->options);
        $inst = $value->options;
        $total_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id" => ($value->id)])->row()->total;
        $option1_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id" => ($value->id), "selected_option" => 1])->row()->total;
        $option2_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id" => ($value->id), "selected_option" => 2])->row()->total;;
        $option3_voters = $this->db->select("COUNT(*) as total")->get_where("polling_select", ["forum_id" => ($value->id), "selected_option" => 3])->row()->total;;
        $inst->total_option1_voters = (int)$option1_voters;
        $inst->total_option2_voters = (int)$option2_voters;
        $inst->total_option3_voters = (int)$option3_voters;
        $inst->percentage_option1_voters = round((($total_voters > 0) ? ($option1_voters * 100 / $total_voters) : 0), 2);
        $inst->percentange_option2_voters = round((($total_voters > 0) ? ($option2_voters * 100 / $total_voters) : 0), 2);
        $inst->percentage_option3_voters = round((($total_voters > 0) ? ($option3_voters * 100 / $total_voters) : 0), 2);
      } else {
        $value->options = new stdClass();
      }
      $userdata = $this->db->get_where("users", ["id" => $value->user_id])->row();

      $value->posted_by_name = ($userdata->first_name . " " . $userdata->last_name);
      $value->posted_by_profile = ($userdata->profile_pic);
      $value->total_liked = $this->db->select("count(*) as total")->get_where("forums_likes", ["forum_id" => ($value->id)])->row()->total;
      $value->total_disliked = $this->db->select("count(*) as total")->get_where("forum_dislikes", ["forum_id" => ($value->id)])->row()->total;
      $value->total_comments = $this->db->select("count(*) as total")->get_where("forum_comments", ["forum_id" => ($value->id)])->row()->total;
      $value->comments = $this->db->select("CONCAT(first_name, ' ', last_name) as name, profile_pic, comment, forum_comments.created")->join("users", "forum_comments.user_id = users.id")->get_where("forum_comments", ["forum_id" => ($value->id)])->result();
      unset($value->user_id);


      $admin_detail = $this->admin_model->get_admin_data($session_id);
      $users = $this->admin_model->all_users();   // for foreach loop
      $this->load->view('editforum', ['admin_detail' => $admin_detail, "forum" => $value]);
    } else {
      return redirect('/admin');
    }
  }

  public function saveforum()
  {

    $inpdata = $this->input->post();
    $form_id = $this->input->post("forum_id");
    $form_type = $this->input->post("forum_type");
    $content = $this->input->post("content");
    $validity = $this->input->post("validity");
    $options = $this->input->post("options");
    $option1 = $this->input->post("option1");
    $option2 = $this->input->post("option2");
    $option3 = $this->input->post("option3");
    if ($form_type == "forum") {

      $data["content"] = $content;
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

        if ($this->upload->do_upload('file')) {
          $fileData = $this->upload->data();
          $data['content_image'] = "https://www.ashom.app/uploads/forum_images/" . $fileData['file_name'];
        }
      }
      print_r($data);


      $this->db->update("forums", $data, ["id" => $form_id]);

      redirect("/admin/forums");
    } else {

      $options = json_decode($options);
      $options->option1 = $option1;
      $options->option2 = $option2;
      $options->option3 = $option3;
      $pollpostdata = JSON_encode($options);

      $this->db->update("forums", ["content" => $content, "options" => $pollpostdata, "validity" => $validity], ["id" => $form_id]);
      redirect("/admin/forums");
    }
    print_r($inpdata);
  }


  public function exchanges()
  {
    if (isset($_POST["submit"])) {

      $data = $this->input->post();
      $name = $this->input->post("exchange");
      $id = $this->input->post("exchange_id");
      $this->db->update("exchanges", ["exchange" => $name], ["id" => $id]);
    }
    if (isset($_POST["updateexchanges"])) {
      $name = $this->input->post("exchange");
      $this->db->insert("exchanges", ["exchange" => $name]);
    }

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {



        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view("exchanges", ['admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }
  public function deleteexchange($id = 0)
  {
    $this->db->delete("exchanges", ["id" => $id]);
  }
  public function companies_status()
  {
    if (isset($_POST["submit"])) {

      $data = $this->input->post();
      $company_status = $this->input->post("company_status");
      $id = $this->input->post("companystatus_id");
      $this->db->update("companystatus", ["company_status" => $company_status], ["id" => $id]);
    }
    if (isset($_POST["updatecompanystatus"])) {
      $name = $this->input->post("company_status");
      $this->db->insert("companystatus", ["company_status" => $name]);
    }

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {



        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $this->load->view("companies_status", ['admin_detail' => $admin_detail]);
      }
    } else {

      return redirect('/admin');
    }
  }
  public function deletecompanystatus($id = 0)
  {
    $this->db->delete("companystatus", ["id" => $id]);
  }

  public function financial_news()
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {

      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $financial_news = $this->db->query("SELECT * FROM `api_data`")->result();
        $this->load->view('financial_news', ['admin_detail' => $admin_detail, 'financial_news' => $financial_news]);
      } else {
        return redirect('/admin');
      }
    }
  }


  public function missing_financial_reports()
  {

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {

      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $documents = $this->db->get('missing_docs')->result();
        $this->load->view('missing_financial_reports', ['admin_detail' => $admin_detail, 'documents' => $documents]);
      }
    } else {
      return redirect('/admin');
    }
  }

  public function missing_reports($company_id = 1)
  {

    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {

      if ($this->user_type == "admin") {
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $documents = $this->db->query("SELECT companies.Company_Name,companies.SymbolTicker,companies.Country, years.*, periods.*, document_types.* from companies INNER join years on years.company_id=companies.id inner join periods INNER join document_types left join documents on (documents.document_company_id=companies.id and documents.document_year=years.year and documents.document_period=periods.period and documents.document_type_id=document_types.id) where companies.id='$company_id' and documents.document_id is null order by companies.id, years.year, periods.period")->result();
        $this->load->view('missing_financial_reports', ['admin_detail' => $admin_detail, 'documents' => $documents]);
      }
    } else {
      return redirect('/admin');
    }
  }




  public function deletenews($news_id = 0)
  {
    $this->db->delete("api_data", ["id" => $news_id]);
    $this->db->delete("api_data_companies", ["data_id" => $news_id]);
    $this->db->delete("api_data_countries", ["data_id" => $news_id]);
    echo "News deleted successfully";
  }

  public function clearallnews()
  {
    $this->db->query("TRUNCATE api_data");
    $this->db->query("TRUNCATE api_data_companies");
    $this->db->query("TRUNCATE api_data_countries");
    echo "News deleted successfully";
  }

  public function loads($filename = "")
  {
    $row = 0;
    $bigdata = array();
    $dataarray = json_decode(file_get_contents("./newsdata/$filename"));
    foreach ($dataarray as $data) {
      $dataji = array();
      $companies = array();
      $countries = array();
      $dataji["title"] = $data->title;
      $dataji["date"] = $data->published_date;
      $dataji["image_url"] = $data->image;
      $dataji["source"] = $data->source;
      $dataji["link"] = $data->link;
      $dataji["m_companies"] = $data->company;
      $dataji["m_countries"] = $data->country;
      $dataji["link"] = $data->link;
      $dataji["created"] = date("Y-m-d");
      if ($this->db->insert("api_data", $dataji)) {
        $insert_id = $this->db->insert_id();
        //$companies = explode(",", $data->company);
        //for($count=0; $count<COUNT($companies); $count++)
        //$this->db->insert("api_data_companies", ["company"=>$companies[$count], "data_id"=>$insert_id]);

        //$countries = explode(",", $data->country);
        //for($count=0; $count<COUNT($countries); $count++)
        //$this->db->insert("api_data_countries", ["country"=>$countries[$count], "data_id"=>$insert_id]);
      } else {
        echo "Unsucces";;
      }
    }
    return true;
  }

  public function uploadnewsdata()
  {
    $config['upload_path']          = './newsdata/';
    $config['file_name']          = date("YmdHis");
    $config['allowed_types']        = '*';
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('newsdata')) {
      $filedata = $this->upload->data();
      $filename = $filedata["file_name"];
      if ($this->loads($filename)) {
        $this->session->set_flashdata('success', 'News Data File Uploaded');
      } else {
        $this->session->set_flashdata('error', 'News Data File not Uploaded, or File Improper Format');
      }
      return redirect('/admin/financial_news');
    } else {
      print_r($this->upload->display_errors());
    }
  }

  public function notification_line()
  {
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      if ($this->user_type == "admin") {
        if ($_POST) {
          $forum_text = $this->input->post("forum_text");
          $news_text = $this->input->post("news_text");
          $selectedNew = $this->input->post("selectedNews");
          $this->db->update("notification_text", ["textline" => $forum_text], ["id" => 1]);
          $this->db->update("notification_text", ["textline" => $news_text], ["id" => 2]);
          $this->db->update("notification_text", ["textline" => $selectedNew], ["id" => 3]);
          $this->session->set_flashdata('success', 'Notification Lines Updated');
        }
        $admin_detail = $this->admin_model->get_admin_data($session_id);
        $lines = $this->db->get_where("notification_text")->result();
        $notifications = $this->db->get_where('api_data',['created'=>date('Y-m-d')])->result();
        if(!$notifications)
        $notifications = $this->db->get_where('api_data',['created'=>date('Y-m-d', strtotime(date('Y-m-d').' -1 day'))])->result();
        $this->load->view("notifications_line", ['admin_detail' => $admin_detail, "lines" => $lines, 'notifications'=>$notifications]);
      }
    }
  }

  public function toogleNotification()
  {
    $is_notify = $this->db->get_where("document_notification")->row()->notification;
    if ($is_notify) {
      $this->db->update("document_notification", ["notification" => 0]);
    } else {
      $this->db->update("document_notification", ["notification" => 1]);
    }
    echo "Sucess";
  }


  public function user_events(){
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      $admin_detail = $this->admin_model->get_admin_data($session_id);
      $data = $this->db->query('SELECT DISTINCT event, COUNT(event) as total_events, COUNT(DISTINCT user_id) as total_users FROM `user_events` GROUP BY event')->result();
      $this->load->view("user_events", ['admin_detail' => $admin_detail, 'events' => $data]);
    }
  }

  public function user_analytics(){
    $session_id = $this->session->userdata('admin_id');
    if ($session_id) {
      $admin_detail = $this->admin_model->get_admin_data($session_id);
      $this->load->view("user_analytics", ['admin_detail' => $admin_detail]);
    }
  }
}
