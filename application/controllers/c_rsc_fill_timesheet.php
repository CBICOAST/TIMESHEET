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
         $tesarr=array(
             'max_date'=>$this->fill_timesheet->get_max_min($tes)[0]['max_date'],
             'min_date'=>$this->fill_timesheet->get_max_min($tes)[0]['min_date'],
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
             'date'=>$this->input->post('date_ts')[$i],
             'desc_work' => $this->input->post('desc_work')[$i],
             'hours' => $this->input->post('hours')[$i],
             'charge_code' => $this->input->post('charge_code')[$i],
             'activity' => $this->input->post('activity')[$i],
             'approvedby' => $this->input->post('approvedby')[$i]
         );
     }
         $data['data']=$dat_arr;
         $this->load->view('v_test',$data);
     }
}

?>