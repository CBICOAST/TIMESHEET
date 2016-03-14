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
where periode_date not in (select distinct periode_date from tb_r_timesheet where employee_id='$employee_id' and status<>0)";	

		return fetchArray($sql, 'all');
        }
        function get_employee_list()
	{
		$sql = "SELECT
				EMPLOYEE_ID,
                                EMPLOYEE_NAME			
				FROM
				tb_m_employee
				ORDER BY EMPLOYEE_NAME ASC";
		return fetchArray($sql, 'all');
	}
        function get_employee($employee_id)
	{
		$sql = "SELECT
				EMPLOYEE_ID,
                                EMPLOYEE_NAME			
				FROM
				tb_m_employee
				where EMPLOYEE_ID='$employee_id'";
		return fetchArray($sql, 'all');
	}
        
        function get_chargecode_list(){
            
            $sql="SELECT 
                CHARGE_CODE as id,
                PROJECT_DESCRIPTION as text
                FROM 
                tb_m_charge_code
                ORDER BY CHARGE_CODE ASC";
            return fetchArray($sql, 'all');
        }
        
        function get_activity_code(){
            $sql="SELECT 
                act_code as id,
                activity as text
                FROM 
                tb_m_activity
                ORDER BY act_code ASC";
            return fetchArray($sql, 'all');
        }
       function get_max_min($tanggal){
           $sql="SELECT max(tgl.Fulldate) max_date,min(tgl.Fulldate) min_date FROM (SELECT '$tanggal' + INTERVAL a + b DAY Fulldate, Dayname('$tanggal' + INTERVAL a + b DAY) Dayname,
CASE
WHEN (Dayname('$tanggal' + INTERVAL a + b DAY) IN ('Sunday','Saturday')) 
OR 
(SELECT KETERANGAN FROM tb_m_tanggal_libur libur WHERE libur.TANGGAL = '$tanggal' + INTERVAL a + b DAY) is not null THEN 1
ELSE 0
END as Status 
FROM
 (SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
    UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
    UNION SELECT 8 UNION SELECT 9 ) d,
 (SELECT 0 b UNION SELECT 10 UNION SELECT 20 
    UNION SELECT 30 UNION SELECT 40) m
WHERE '$tanggal' + INTERVAL a + b DAY  <  Date_add('$tanggal',INTERVAL 1 MONTH)
ORDER BY a + b) as tgl";
          return fetchArray($sql, 'all');
       }
       function get_holiday_date($date){
           $sql="SELECT date_format(tgl.Fulldate,'%Y-%c-%e') holiday_date FROM (SELECT '$date' + INTERVAL a + b DAY Fulldate, Dayname('$date' + INTERVAL a + b DAY) Dayname,
CASE
WHEN (Dayname('$date' + INTERVAL a + b DAY) IN ('Sunday','Saturday')) 
OR 
(SELECT KETERANGAN FROM tb_m_tanggal_libur libur WHERE libur.TANGGAL = '$date' + INTERVAL a + b DAY) is not null THEN 1
ELSE 0
END as Status 
FROM
 (SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
    UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
    UNION SELECT 8 UNION SELECT 9 ) d,
 (SELECT 0 b UNION SELECT 10 UNION SELECT 20 
    UNION SELECT 30 UNION SELECT 40) m
WHERE '$date' + INTERVAL a + b DAY  <  Date_add('$date',INTERVAL 1 MONTH)
ORDER BY a + b) as tgl where tgl.Status=1";
           return fetchArray($sql, 'all');
       }
       function set_holiday_date($periode,$date){
           $sql="SELECT tgl.Status as Holiday_Status FROM (SELECT '$periode' + INTERVAL a + b DAY Fulldate, Dayname('$periode' + INTERVAL a + b DAY) Dayname,
CASE
WHEN (Dayname('$periode' + INTERVAL a + b DAY) IN ('Sunday','Saturday')) 
OR 
(SELECT KETERANGAN FROM tb_m_tanggal_libur libur WHERE libur.TANGGAL = '$periode' + INTERVAL a + b DAY) is not null THEN 'Yes'
ELSE 'No'
END as Status 
FROM
 (SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
    UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
    UNION SELECT 8 UNION SELECT 9 ) d,
 (SELECT 0 b UNION SELECT 10 UNION SELECT 20 
    UNION SELECT 30 UNION SELECT 40) m
WHERE '$periode' + INTERVAL a + b DAY  <  Date_add('$periode',INTERVAL 1 MONTH)
ORDER BY a + b) as tgl where tgl.Fulldate='$date'";
           return fetchArray($sql, 'all');
       }
       function upload_timesheet($data){
           $this->db->trans_start();    
             $this->db->insert_batch('tb_r_timesheet',$data);
             $this->db->trans_commit();
             if($this->db->trans_status()==FALSE){
                 return 'gagal';
             }
             else{
                 $sql="SELECT * FROM tb_r_timesheet";
                 return fetchArray($sql, 'all');
             }
       }
       function count_sheet_perperiode($id_employee,$periode){
           $sql="SELECT COUNT(*) jml_data_sheet FROM tb_r_timesheet where employee_id='$id_employee' and periode_date='$periode'";
           return fetchArray($sql, 'all');
       }
       function get_timesheet_data($id_employee,$periode){
           $sql="SELECT 
        employee_id,
	periode_date,
	approved_by,
	date_ts,
	work_desc,
	holiday,
	hours,
	charge_code,
	act_code,
	status FROM tb_r_timesheet where employee_id='$id_employee' and periode_date='$periode'";
           return fetchArray($sql, 'all');
       }
       function get_timesheet_edit_data($id_employee,$periode,$date,$chargecode){
           $sql="SELECT * FROM tb_r_timesheet where employee_id='$id_employee' and periode_date='$periode' and date_ts='$date' and charge_code='$chargecode'";
           return fetchArray($sql, 'all');
       }
}
?>