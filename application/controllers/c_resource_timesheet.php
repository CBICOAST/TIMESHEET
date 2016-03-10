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

		$this->load->model('m_resource_timesheet','unfill_timesheet');
		
	}

	function index()
	{
            
	}

	function load_view()
	{
                $param['periode']=$this->unfill_timesheet->list_unfill_timesheet($this->user['id']);
                $param['employee_name']=$this->user['name'];
		$this->load->view('v_resource_timesheet',$param);
	}
}

/* End of file c_oas021.php */
/* Location: ./application/controllers/c_oas021.php */