
<?php
//echo"<pre>";
//foreach ($employee_names as $key => $value) {
    //echo $value['EMPLOYEE_NAME']."<br/>"; 
//}
//echo"</pre>";



//echo"<pre>";
//foreach ($act_code as $key => $value) {
    //echo $value['act_code']."|".$value['activity']."<br/>"; 
//}
//echo"</pre>";
?>

 <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
        <link rel="stylesheet" href="http://localhost/COAST2/assets/css/select2/select2.css">
        <link rel="stylesheet" href="http://localhost/COAST2/assets/js/plugins/datepicker/datepicker3.css">
        <div class="box-content no-padding">
    <div class="search-fields bs-callout list-title">
		<h2><b>Form Timesheet</b></h2>
		<div style="height:100%;
					
					padding-top: 10px;
					padding-left: 15px;
                                        padding-bottom: 0px;">
                    
                </div>
    </div>
    
</div>
        <form action="c_rsc_fill_timesheet/upload_timesheet" method="post" >
<table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                    <colgroup>
			<col width="2%">
			<col width="10%">
			<col width="15%">
			<col width="7%">
			<col width="70%">
			<col width="8%">
			<col width="4%">
		</colgroup>
                <thead>
			<tr>
				<th height="5px" class="text-center">No</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Work Description</th>
                                <th class="text-center">Hours</th>
                                <th class="text-center">Charge Description</th>
                                <th class="text-center">Activity</th>
                                <th width="50" class="text-center">.:::.</th>
			</tr>
		</thead>
                
                <tbody>
                    <tr class="rows rows1" style="height: 100%">
                        <td style="text-align: center;vertical-align: middle;">1</td>
                        <td>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input readonly="" name="date_ts[]" style="height: 100%" type="text" class="form-control active date_ts"/>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input name="desc_work[]" style="height: 100%;" type="text" class="form-control" >
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-addon" st>
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input name="hours[]" style="height: 100%;" type="text" class="form-control" >
                            </div>
                        </td>
                        <td>
                            
                            <select name="charge_code[]" class="select_charge select_charge1 pull-right" style="width: 100%">
                                <option value=""  selected="selected">Unselected</option>
                    </select>
                            <input type="hidden" value="" name="approvedby[]" class="approved_by1"/>      
                        </td>
                        <td>
                            <select name="activity[]" class="select_act pull-right" >
                                <option value=""  selected="selected">Unselected</option>
                    </select>
                        </td>
                        <td style="text-align: center;vertical-align: middle;" valign="bottom"><a onclick="add_row();"><i class="fa fa-plus-circle fa-lg"></i></a></td>
                    </tr>
                    
                
                </table>
        
<button type="button" class="pull-left btn btn-warning" id="back-btn" onclick="change_page(this, 'c_resource_timesheet/load_view');">Back...</button>
<input type="submit" value="submit" class="pull-right btn btn-primary" name="submit"/>
</form>
<script type="text/javascript">
    
        $(document).ready(function(){
            var mindate='<?php echo $min_date; ?>';
            var maxdate='<?php echo $max_date; ?>';
            var active_dates = ["2016-1-2","2016-1-3","2016-1-9","2016-1-10","2016-1-16","2016-1-17","2016-1-23","2016-1-24","2016-1-30","2016-1-31"];
        $('.date_ts').datepicker({
                format: "yyyy-mm-dd",
                startDate: mindate,
                endDate: maxdate, 
                autoclose: true,
                beforeShowDay: function(date){
         var d = date;
         var curr_date = d.getDate();
         var curr_month = d.getMonth() + 1; //Months are zero based
         var curr_year = d.getFullYear();
         var formattedDate = curr_year + "-" + curr_month + "-" + curr_date

           if ($.inArray(formattedDate, active_dates) != -1){
               return {
                  classes: 'activeClassdt'
               };
           }
          return;
      }
            });
            var charcode = <?php echo $charge_code; ?>;
            var actcode = <?php echo $act_code; ?>;
            
            $(".select_charge").select2({
                data:charcode
            });
            $(".select_act").select2({
                data:actcode
            });
            $(".select_charge1").change(function() {
               var approvedby=$(".select_charge1").val();
            $(".approved_by1").val(approvedby);
            });
        });
        function add_row(){
            var rows_length=$('.rows').length;
            var add_rows=rows_length + 1;
            
            var charcode = <?php echo $charge_code; ?>;
            var actcode = <?php echo $act_code ?>;
            var get_rows='<td style="text-align: center;vertical-align: middle;">'+add_rows+'</td>'
                        +'<td>'
                            +'<div class="input-group date">'
                                +'<div class="input-group-addon">'
                                    +'<i class="fa fa-calendar"></i>'
                                +'</div>'
                                +'<input readonly="" name="date_ts[]" style="height: 100%" type="text" class="form-control active date_ts"/>'
                            +'</div>'
                        +'</td>'
                        +'<td>'
                            +'<div class="input-group">'
                                +'<div class="input-group-addon">'
                                    +'<i class="fa fa-laptop"></i>'
                                +'</div>'
                                +'<input name="desc_work[]" style="height: 100%;" type="text" class="form-control" >'
                            +'</div>'
                        +'</td>'
                        +'<td>'
                            +'<div class="input-group">'
                                +'<div class="input-group-addon" st>'
                                    +'<i class="fa fa-clock-o"></i>'
                                +'</div>'
                                +'<input name="hours[]" style="height: 100%;" type="text" class="form-control" >'
                            +'</div>'
                        +'</td>'
                        +'<td>'
                            +'<select name="charge_code[]" class="select_charge select_charge'+add_rows+' pull-right" style="width: 100%">'
                                +'<option value=""  selected="selected">Unselected</option>'
                    +'</select>'
                    +'<input type="hidden" name="approvedby[]" value="" class="approved_by'+add_rows+'"/>'
                        +'</td>'
                        +'<td>'
                            +'<select name="activity[]" class="select_act '+add_rows+' pull-right" >'
                                +'<option value=""  selected="selected">Unselected</option>'
                    +'</select>'
                        +'</td>'
                        +'<td style="text-align: center;vertical-align: middle;" valign="bottom"><a onclick="add_row(\'\');"><i class="fa fa-plus-circle fa-lg"></i></a></td>';
            var tr_open='<tr class="rows rows'+add_rows+'" style="height: 100%">';
            var tr_close='</tr>';
            var mindate='<?php echo $min_date; ?>';
            var maxdate='<?php echo $max_date; ?>';
            var active_dates = ["2016-1-2","2016-1-3","2016-1-9","2016-1-10","2016-1-16","2016-1-17","2016-1-23","2016-1-24","2016-1-30","2016-1-31"];
            $(tr_open+get_rows+tr_close).insertAfter(".rows"+rows_length);
             $('.date_ts').datepicker({
               format: "yyyy-mm-dd",
                startDate: mindate,
                endDate: maxdate, 
                autoclose: true,
                beforeShowDay: function(date){
         var d = date;
         var curr_date = d.getDate();
         var curr_month = d.getMonth() + 1; //Months are zero based
         var curr_year = d.getFullYear();
         var formattedDate = curr_year + "-" + curr_month + "-" + curr_date

           if ($.inArray(formattedDate, active_dates) != -1){
               return {
                  classes: 'activeClassdt'
               };
           }
          return;
      }
            });
            $(".select_charge").select2({
                data:charcode
            });
            $(".select_act").select2({
                data:actcode
            });
            $(".select_charge"+add_rows).change(function() {
                var approvedby=$(".select_charge"+add_rows).val();
            $(".approved_by"+add_rows).val(approvedby);
            });
        }
        </script>
        
