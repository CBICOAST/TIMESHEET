<?php 
/************************************************************************************************
 * Program History :
*
* Project Name     : OAS
* Client Name      : CBI - Muhammad
* Program Id       : OAS048
* Program Name     : Daftar Setting Permission Cash Advance
* Description      :
* Environment      : PHP 5.4.4
* Author           : Metta Kharisma
* Version          : 01.00.00
* Creation Date    : 19-11-2014 21:45:00 ICT 2014
*
* Update history     Re-fix date       Person in charge      Description
* 1.0				 05 Nov 2014 		Metta Kharisma 		 Merubah ID search pada view
* 
*
* Copyright(C) [..]. All Rights Reserved
*************************************************************************************************/
$search = false;
if(isset($search_param)){
	$search = true;
}
?>


<div class="box-content no-padding">
	<div class="search-fields bs-callout list-title">
		<h2><b>
			<?php if (isset($readonly)) {
						echo "List Employee Previlege";
					}else{
						echo "Privilege Purchase Request Management";
					}  ?>
		</b></h2>
		<div style="height:100%;
					
					padding-top: 10px;
					padding-left: 15px;
					padding-bottom: 0px;">
			<table border="0" cellpadding="1" cellspacing="1">
				<colgroup>
					<col width="148px">
					<col width="150px">
					<col width="50px">
					<col width="148px">
					<col width="148px">
				</colgroup>
				<tr>
					<td>
						Employee Name :
					</td>
					<td>
						<select id="employee-list-search-poprivilege">
							<option value=''>-- ALL --</option>
							<?php foreach ($employee_list_po as $key => $employee) {?>
								<option value='<?= $employee['EMPLOYEE_ID'] ?>'
									<?php if($search && $search_param['employeeid']==$employee['EMPLOYEE_ID'])echo 'selected' ?>><?= $employee['EMPLOYEE_NAME'] ?></option>
							<?php } ?>
						</select>
					</td>
				
					
					<td colspan="2">
						<button type="submit" class="pull-right btn btn-danger btn-flat btn-slim" id="clear-btn-po" onclick="change_page(this, 'c_oas073/<?php if (isset($readonly))echo'load_view_read_only'; else echo'load_view'?>');">Clear</button>
						<button type="button" class="pull-right btn btn-success btn-flat btn-slim" id="search-btn-po" onclick="doSearchEmployeeListManagePO(this);">Search</button>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						&nbsp;
					</td>
					<td>
						&nbsp;
					</td>
					<?php if (!isset($readonly)) { ?>
					<td colspan="2">
						
					</td>
					<?php } ?>
				</tr>
			</table>
		</div>
	</div>
	<table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
		<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="10%">
					<col width="9%">
					<col width="6%">
					
				</colgroup>
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th >Employee ID</th>
				<th >Employee Name</th>
				<th >Group/Division</th>
				<th >Level</th>
				<th >Position Depth</th>
				<th class="text-center">Privilage PO</th>
				<th class="text-center">.::.</th>
				
			</tr>
		</thead>
		
		<tbody style="height: 10px; overflow: scroll;">
				<?php $idx = 0; 
				if(isset($user_list)){
				foreach ($user_list as $key => $user) { 
					$idx++;?>
				<tr class="active">
					
					<td class="text-center"><?= $idx ?></td>
					<td ><?= $user['EMPLOYEE_ID'] ?></td>
					<td ><?= $user['EMPLOYEE_NAME'] ?></td>
					
					<td ><?php echo $user['GROUP_ID'].' / '.$user['divisi_name'] ; ?></td>
					<td ><?php echo $user['LEVEL_NAME']; ?></td>
					<td ><?php echo $user['POSITION_DEPTH_TITLE']; ?></td>
					<td align="center" value="<?= $user['PRIVILEGE_PR'] ?>"><?php if ($user['PRIVILEGE_PR']=='1' ){echo 'yes';}else{echo 'no';} ?></td>
					<td align="center">
						<?php if ($user['PRIVILEGE_PR']!='1') { ?>
						<button type="button" class="pull-right btn btn-default btn-slim"  onclick="change_page(this, 'c_oas073/deladd_priv_po/<?= $user['EMPLOYEE_ID'] ?>/1')">
							<i class="fa fa-plus"></i>
							Add
						</button>
						<?php }else{ ?>
						<button type="button" class="pull-right btn btn-default btn-slim" onclick="change_page(this, 'c_oas073/deladd_priv_po/<?= $user['EMPLOYEE_ID']?>/0')">
							<i class="fa fa-minus"></i>
							Del
						</button>
						<?php } ?>
					</td>
					
				</tr>
				<?php }
				}else{ ?>
					<tr>
						<td class="text-center" colspan="6">Not Found!</td>
					</tr>
				<?php } ?>
			
		</tbody>
		</div>
	</table>
</div>
<div><br>
<div class="box-footer clearfix">
                <button type="button" class="pull-left btn btn-default" id="back-btn-po" onclick="change_page(this, 'c_oas098/load_view')">Back...</button>
            </div></div>
<script type="text/javascript">
	function doSearchEmployeeListManagePO(elm)
	{
		
		var employeeid  = $('#employee-list-search-poprivilege').val();
		

		var url="c_oas073/search?";
		<?php if (isset($readonly)){ ?>
			url="c_oas073/search_readonly?";
		<?php } ?>

		if(employeeid != ''){
			url += "employeeid="+employeeid+"&";
		}
		search_redirect(elm, encodeURI(host+url));
	}
</script>