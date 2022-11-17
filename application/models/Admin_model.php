<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {


public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Kolkata");
     $this->load->library(array('email'));

  }

public function isvalidate($email,$password)
  {

      $q = $this->db->get_where('admin',array('email'=>$email,'password'=>$password))->row();

           if($q)
           {
           return $q->id;
           }
           else
           {
            return false;
           }

  }


public function get_admin_data($id)
  {

       $q=$this->db->select('*')
          ->from('admin')
          ->where(['id'=>$id])
          ->get();
         return $q->row();
  }



public function update_password($id,$pwd)
  {

        return $this->db->where('id',$id)
                 ->update('admin',array('password'=>$pwd));

  }



public function update_admin($admin_id, $admin_data)
  {

   return $this->db->where('id',$admin_id)
                   ->update('admin',$admin_data);

  }




public function all_users()
  {
        $this->db->select("*");
      $this->db->from("users");
      $this->db->order_by('created',"DESC");
      $query = $this->db->get();
      $result=$query->result();
      return $result;
  }

public function all_access_users()
  {
        $this->db->select("*");
      $this->db->from("admin");
      $this->db->where("user_type!='admin'");
      $this->db->order_by('created',"DESC");
      $query = $this->db->get();
      $result=$query->result();
      return $result;
  }

 public function all_companies(){
     $this->db->select("*");
      $this->db->from("companies");
    //   $this->db->order_by('created',"DESC");
      $query = $this->db->get();
      $result=$query->result();
      return $result;
 }

 public function all_countries(){
     $this->db->select("DISTINCT(Country)");
      $this->db->from("companies");
    //   $this->db->order_by('created',"DESC");
      $query = $this->db->get();
      $result=$query->result();
      return $result;
 }

 public function update_access_user($data, $id){
 $this->db->update("admin", $data, "id=$id");
 return true;

}
   public function missing_financial_reports(){
      $this->db->query("SELECT companies.Company_Name,companies.SymbolTicker,companies.Country, years.*, periods.*, document_types.* from companies INNER join years on years.company_id=companies.id inner join periods INNER join document_types left join documents on (documents.document_company_id=companies.id and documents.document_year=years.year and documents.document_period=periods.period and documents.document_type_id=document_types.id) where companies.id='1' and documents.document_id is null order by companies.id, years.year, periods.period
")->result();
     $query = $this->db->get();
      $result=$query->result();
      return $result;
}


public function add_access_user($data){
 $this->db->insert("admin", $data);
return true;
}

}
