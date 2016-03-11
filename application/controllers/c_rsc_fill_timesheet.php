<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_RSC_FILL_TIMESHEET extends MY_Controller {
    
    function __construct()
	{
		parent::__construct();
		
		
		$index	= $this->config->item('index_page');
		$host	= $this->config->item('base_url');

		$this->url = empty($index) ? $host : $host . $index . '/';

		$this->load->model('m_rsc_fill_timesheet','fill_timesheet');
		
	}
        
     function load_form($tes){
         foreach ($this->fill_timesheet->get_holiday_date($tes) as $key => $value){
             $data[]=$value['holiday_date'];
         }
         
         $tesarr=array(
             'max_date'=>$this->fill_timesheet->get_max_min($tes)[0]['max_date'],
             'min_date'=>$this->fill_timesheet->get_max_min($tes)[0]['min_date'],
             'holiday_date'=>  json_encode($data),
             'employee_names'=>$this->fill_timesheet->get_employee_list(),
             'charge_code'=>$this->fill_timesheet->get_chargecode_list(),
             'act_code'=>$this->fill_timesheet->get_activity_code()
         );
         $this->load->view('v_rsc_fill_timesheet',$tesarr);
         //echo $tes;
         //echo "<div class=\"box-footer clearfix\">";

               // echo"<button type=\"button\" class=\"pull-left btn btn-primary\" id=\"back-btn\" onclick=\"change_page(this, 'c_resource_timesheet/load_view')\">Back...</button>";

           // echo"</div>";
     }
     function upload_timesheet(){
     for($i=0;$i<count($this->input->post('date_ts'));$i++){
         $dat_arr[]=array(
             'date_ts'=>$this->input->post('date_ts')[$i],
             'work_desc' => $this->input->post('desc_work')[$i],
             'hours' => $this->input->post('hours')[$i],
             'charge_code' => $this->input->post('charge_code')[$i],
             'act_code' => $this->input->post('activity')[$i],
             'approved_by' => $this->input->post('approvedby')[$i]
         );
     }
     //$data_arr2=array(
         //'upload_data'=>$dat_arr
    // );
        // echo json_encode($data_arr2);
     $data['time_sheet']=$this->fill_timesheet->upload_timesheet($dat_arr);
     $this->load->view('v_test',$data);
     //echo"<pr>";
     //print_r($dat_arr);
     //echo"</pr>";
     }
     
}

?>