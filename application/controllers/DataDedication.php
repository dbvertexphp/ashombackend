<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 ini_set('memory_limit', '8192M');
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 ini_set('max_execution_time', 0);
class DataDedication extends CI_Controller {

  function __construct()
  {
    parent::__construct();

  }

  public function index(){
  	echo "dddd";
  }

  public function loadmissing($from_companies, $to_companies){
    ini_set('memory_limit', '1500M');
    ini_set('max_execution_time', 0);
    $companies = $this->db->get_where('companies', ["id>="=>$from_companies, "id<="=>$to_companies])->result();
    $periods = ["Q1", "Q2", "Q3", "Q4", "Annual"];
    $document_types = [1, 2, 3, 4, 5, 6, 7, 8];
    $missings = array();
    foreach($companies as $company){
        echo "company $company->id started ";
        $dataToInsert = array();
      	$years = $this->db->get_where("years", ["company_id"=>$company->id])->result();
      	foreach($years as $year){
        	foreach($periods as $period){
            	foreach($document_types as $key => $document_type){
                	if(!$this->db->get_where('documents', ['document_company_id'=>$company->id, 'document_year'=>$year->year, 'document_period'=>$period, 'document_type_id'=>$document_type])->row()){
  					 	$dataToInsert[] = ['company_id'=>$company->id, 'company_name'=>$company->Company_Name, 'symbol'=>$company->SymbolTicker, 'country'=>$company->Country, 'years'=>$year->year, 'periods'=>$period, 'document_type'=>$document_type];
                    }
                }
            }
        }
    
      if(COUNT($dataToInsert)>0)
      $this->db->insert_batch('missing_reports', $dataToInsert);
      echo "company $company->id done ";
    }
    echo '\nTotal Rows : '.COUNT($dataToInsert);
    echo "\nfrom company id $from_companies to $to_companies loaded\n";
  }


  public function makesummis(){
  	$reports = $this->db->get('missing_reports')->result();
    $company_id = 0;
    $periods = ["Q1", "Q2", "Q3", "Q4", "Annual"];
    $document_types = [1, 2, 3, 4, 5, 6, 7, 8];
    $data_collection = array();
    $setedperiod = '';
    $setedyear = 0;
    $m_data = array();
    foreach($reports as $key => $report){

      if(($company_id!=$report->company_id)){
            if(COUNT($data_collection)>0)
            $this->db->insert_batch('missing_docs', $data_collection);
            $data_collection = array();
            $setedperiod = $report->periods;
      	    $company_id = $report->company_id;

        	$m_data['company_id'] = $report->company_id;
            $m_data['company_name'] = $report->company_name;
            $m_data['symbol'] = $report->symbol;
            $m_data['country'] = $report->country;
         	$m_data['period'] = $report->periods;
        	$m_data['year'] = $report->years;
         	$m_data['report'] = 0;
            $m_data['CF'] = 1;
            $m_data['BS'] = 1;
            $m_data['IStmt'] = 1;
            $m_data['OCI'] = 1;
            $m_data['CIE'] = 1;
            $m_data['Notes'] = 1;
            $m_data['financial_report'] = 1;
      }

      if(($setedperiod=='')||($setedperiod!=$report->periods)){
            $setedperiod = $report->periods;
            print_r($m_data);
            $data_collection[] = $m_data;
            $m_data['company_id'] = $report->company_id;
            $m_data['company_name'] = $report->company_name;
            $m_data['symbol'] = $report->symbol;
            $m_data['country'] = $report->country;
         	$m_data['period'] = $report->periods;
        	$m_data['year'] = $report->years;
         	$m_data['report'] = 0;
            $m_data['CF'] = 1;
            $m_data['BS'] = 1;
            $m_data['IStmt'] = 1;
            $m_data['OCI'] = 1;
            $m_data['CIE'] = 1;
            $m_data['Notes'] = 1;
            $m_data['financial_report'] = 1;
		}

        $document_type = $report->document_type;

        if($document_type==4)
          	$m_data['CF'] = 0;
        else if($document_type==1)
            $m_data['IStmt'] = 0;
         else if($document_type==2)
             $m_data['BS'] = 0;
         else if($document_type==3)
             $m_data['OCI'] = 0;
         else if($document_type==5)
             $m_data['CIE'] = 0;
         else if($document_type==6)
             $m_data['Notes'] = 0;
         else if($document_type==8)
             $m_data['financial_report'] = 0;

      if(($setedyear==0)||($setedyear!=$report->years)){
      	$setedyear = $report->years;
      }
    }
  }

}
