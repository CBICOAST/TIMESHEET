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

if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_RESOURCE_TIMESHEET extends CI_Model {

	

	function __construct() {

		parent::__construct();

		$this->user	= unserialize(base64_decode($this->session->userdata('user')));

	}
        
        function list_unfill_timesheet($employee_id){
            
            $sql = "select distinct 
DATE_FORMAT(periode_date,'%b %Y ') char_period,
periode_date as date_period 
from tb_m_ts 
where periode_date not in (select distinct periode_date from tb_r_timesheet where employee_id='$employee_id')";	

		return fetchArray($sql, 'all');
        }
}
?>