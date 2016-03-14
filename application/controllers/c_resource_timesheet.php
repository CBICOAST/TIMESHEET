<?php 
/************************************************************************************************
 * Program History :
*
* Project Name     : OAS
* Client Name      : CBI - Pak Riza
* Program Id       : RESOURCE_TIMESHEET
* Program Name     : List Timesheet
* Description      : Daftar Timesheet yang belum terisi oleh resource
* Environment      : PHP 5.4.4
* Author           : Abi Sa'ad Dimyati
* Version          : 01.00.00
* Creation Date    : 07-03-2016 11:10:00
*
* Update history     Re-fix date       Person in charge      Description
* 
*
* Copyright(C) [..]. All Rights Reserved
*************************************************************************************************/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_RESOURCE_TIMESHEET extends MY_Controller {

	
	function __construct()
	{
		parent::__construct();
		
		
		$index	= $this->config->item('index_page');
		$host	= $this->config->item('base_url');

		$this->url = empty($index) ? $host : $host . $index . '/';

		$this->load->model('m_resource_timesheet','timesheet');
		
	}

	function index()
	{
            
	}

	function load_view()
	{
                $param['periode']=$this->timesheet->list_unfill_timesheet($this->user['id']);
                $param['employee_name']=$this->user['name'];
		$this->load->view('v_resource_timesheet',$param);
	}
        function load_view_periode($periode){
         
            $data['periode']=$periode;
         $this->load->view('v_rsc_timesheet',$data);
         
     }
     function load_data(){
         $hitung=count($this->timesheet->get_timesheet_data($this->user['id'],$this->input->post('periode')));
         if($hitung==0){
             $data_timesheet=0;
         }
         else{
             $data_timesheet=$this->timesheet->get_timesheet_data($this->user['id'],$this->input->post('periode'));
         }
         
        echo json_encode($data_timesheet);
     }
     function form_timesheet($periode){
         foreach ($this->timesheet->get_holiday_date($periode) as $key => $value){
             $data[]=$value['holiday_date'];
        }
         $data_array=array(
             'employee_id'=>$this->user['id'],
             'max_date'=>$this->timesheet->get_max_min($periode)[0]['max_date'],
             'min_date'=>$this->timesheet->get_max_min($periode)[0]['min_date'],
             'holiday_date'=>  json_encode($data),
             'employee_names'=>$this->timesheet->get_employee_list(),
             'charge_code'=>$this->timesheet->get_chargecode_list(),
             'act_code'=>$this->timesheet->get_activity_code(),
             'jml_data'=>$this->timesheet->count_sheet_perperiode($this->user['id'],$periode),
             'periode'=>$periode
        );
         $this->load->view('v_form_timesheet',$data_array);
     }
     function form_edit_timesheet($periode,$date_tes,$charge_code,$employee_id){
         foreach ($this->timesheet->get_holiday_date($periode) as $key => $value){
             $data[]=$value['holiday_date'];
        }
         $data_array=array(
             'employee_id'=>$this->user['id'],
             'max_date'=>$this->timesheet->get_max_min($periode)[0]['max_date'],
             'min_date'=>$this->timesheet->get_max_min($periode)[0]['min_date'],
             'holiday_date'=>  json_encode($data),
             'employee_names'=>$this->timesheet->get_employee_list(),
             'charge_code'=>$this->timesheet->get_chargecode_list(),
             'act_code'=>$this->timesheet->get_activity_code(),
             'edit_data_timesheet'=>$this->timesheet->get_timesheet_edit_data($employee_id,$periode,$date_tes,$charge_code)
        );
         $this->load->view('v_form_edit_timesheet',$data_array);
     }
     function upload_timesheet(){
    
         $dat_arr[]=array(
             'employee_id'=>$this->input->post('employee_id'),
             'periode_date'=>$this->input->post('periode'),
             'date_ts'=>$this->input->post('date_ts'),
             'work_desc' => $this->input->post('work'),
             'hours' => $this->input->post('hours'),
             'charge_code' => $this->input->post('charge_code'),
             'act_code' => $this->input->post('activity'),
             'approved_by' => $this->input->post('approved'),
             'status'=>0
         );
     echo json_encode($this->timesheet->upload_timesheet($dat_arr));
     
     }
    function holiday_status(){
        echo json_encode($this->timesheet->set_holiday_date($this->input->post('periode'),$this->input->post('date')));
    }
}

/* End of file c_oas021.php */
/* Location: ./application/controllers/c_oas021.php */