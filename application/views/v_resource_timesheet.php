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
?>
<div class="box-content no-padding">
    <div class="search-fields bs-callout list-title">
		<h2><b>Timeshet List</b></h2>
		<div style="height:100%;
					
					padding-top: 10px;
					padding-left: 15px;
                                        padding-bottom: 0px;">
                    
                </div>
               
    </div>
     <div>
        <button class="btn btn-primary"  onclick=""><i class="fa fa-plus-square-o fa-lg"></i> Add Timesheet</button>
        </div>
     <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                    <colgroup>
			<col width="2%">
			<col width="30%">
			<col width="20%">
			<col width="10%">
			<col width="10%">
			<col width="10%">
			<col width="10%">
			<col width="5%">
		</colgroup>
                <thead>
			<tr>
				<th height="5px">No</th>
                                <th>Employee Name</th>
				<th>Timesheet Periode</th>
                                <th width="50" class="text-center">.:::.</th>
			</tr>
		</thead>
                <tbody>
                    <?php
                    $idx=0;
                    foreach ($periode as $key => $value) {
                        $idx++;
                        echo "<tr class='Approved'>";
                        echo "<td>".$idx."</td>";
                        echo "<td>".$employee_name."</td>";
                        echo "<td><a href=\"#\" title=\"Detail\" onclick=\"change_page(this, 'c_resource_timesheet/load_timesheet_periode/".$value['date_period']."')\">Timesheet Periode ".$value['char_period']."</a></td>";
                        echo "<td class=\"text-center\"><a href=\"#\" class=\"opt edit\" title=\"Detail\" onclick=\"change_page(this, 'c_rsc_fill_timesheet/load_form/".$value['date_period']."')\"></a></td>";
                        echo "</tr>";
     }
                    
                    ?>
                </tbody>
                </table>
    
</div>