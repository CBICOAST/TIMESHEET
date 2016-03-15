<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        
<!-- Latest compiled and minified JavaScript -->
       <!-- <link rel="stylesheet" href="http://localhost/COAST2/assets/css/select2/select2.css"> -->
       <link rel="stylesheet" href="<?php echo js_url(); ?>plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo css_url(); ?>chosen/chosen.css">
<div class="box box-success">
    <!-- <div class="box-header">
        <h3 class="box-title">GANTI PASSWORD</h3>
    </div> -->
    <div class="box-body">


        <h3 style="display: inline-block">Form Timesheet</h3>
        <div class="requester-input form-section-container input-section new-employee-form">
            <form method="post" id="form-edit-timesheet">
                <div class="form-group">
                <label for="date_ts" class="col-sm-4">Date</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input readonly=""  style="text-align: left; width: 175px;height: 100%;background:none;border: none;" value="<?php echo $edit_data_timesheet[0]['date_ts']; ?>" class="form-control holo date_ts" id="date_ts" name="date_ts">
                </div>
				<span id="spanId"style="color:red;"></span>
            </div>
                <div class="form-group">
                <label for="date_ts" class="col-sm-4">Date Periode</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input disabled style="text-align: left; width: 175px;height: 100%;background:none;border: none;" value="<?php echo date_format(date_create($edit_data_timesheet[0]['periode_date']), 'F Y'); ?>" class="form-control holo">
                    <input type="hidden" value="<?php echo $edit_data_timesheet[0]['periode_date']; ?>"/>
                </div>
				<span id="spanId"style="color:red;"></span>
            </div>
                <div class="form-group">
                <label for="employee-id" class="col-sm-4 control-label">Employee ID</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </div>
                    <input disabled style="text-align: left; width: 175px;height: 100%;background:none;border: none;" value="<?php echo $employee_id; ?>" class="form-control holo" id="employee-id">
                    <input type="hidden" value="<?php echo $edit_data_timesheet[0]['employee_id']; ?>" name="employee_id"/>
                </div>
				<span id="spanId"style="color:red;"></span>
            </div>
                <div class="form-group">
                <label for="work" class="col-sm-4 control-label">Work Description</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <input style="text-align: left; width: 175px;height: 100%;background:none;border: none;" value="<?php echo $edit_data_timesheet[0]['work_desc']; ?>" class="form-control holo" id="work" name="work">
                    
                </div>
				<span id="spanId"style="color:red;"></span>
            </div>
                <div class="form-group">
                <label for="approved" class="col-sm-4 control-label">Approved By</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-check"></i>
                    </div>
                    <input readonly="" style="text-align: left; width: 175px;height: 100%;background:none;border: none;" value="<?php echo $edit_data_timesheet[0]['approved_by']; ?>" class="form-control holo" id="approved" name="approved">
                    
                </div>
				<span id="spanId"style="color:red;"></span>
            </div>
                <div class="form-group">
                <label for="hours" class="col-sm-4 control-label">Hours</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <input value="<?php echo $edit_data_timesheet[0]['hours']; ?>" style="text-align: left; width: 175px;height: 100%;background:none;border: none;" value="" class="form-control holo" id="hours" name="hours">
                    
                </div>
				<span id="spanId"style="color:red;"></span>
            </div>
                <div class="form-group">
                <label for="charge" class="col-sm-4 control-label">Charge Code</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-asterisk"></i>
                    </div>
                    <select name="charge_code" style="width: 800px" data-placeholder="Choose your Charge Code" id="charge" class="select_charge select_charge1 pull-right" style="width: 100%">
                                <option value="" ></option>
                                <?php foreach ($charge_code as $key =>$value){
                                    if($value['id']=$edit_data_timesheet[0]['charge_code']){
                                        echo "<option value=\"$value[id]\" selected>".$value['text']."</option>";
                                    }
                                    else{
                                        echo "<option value=\"$value[id]\">".$value['text']."</option>";
                                    }
                                    
                                } ?>
                    </select>
                </div>
				<span id="spanId"style="color:red;"></span>
            </div>
                <div class="form-group">
                <label for="activity" class="col-sm-4 control-label">Activity Code</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-asterisk"></i>
                    </div>
                    <select name="activity" style="width: 300px" data-placeholder="Choose your Activity" class="select_act pull-right" >
                                <option value="" ></option>
                                <?php foreach ($act_code as $key =>$value){
                                    if($value['id']=$edit_data_timesheet[0]['act_code']){
                                        echo "<option value=\"$value[id]\" selected>".$value['text']."</option>";
                                    }
                                    else{
                                        echo "<option value=\"$value[id]\">".$value['text']."</option>";
                                    }
                                } ?>
                    </select>
                </div>
				<span id="spanId"style="color:red;"></span>
            </div>
                <input class="pull-right btn btn-success btn-lg" type="submit" value="Save"/>
                <div style="height:50px">
                    
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
            var mindate='<?php echo $min_date; ?>';
            var maxdate='<?php echo $max_date; ?>';
            var active_dates = <?php echo $holiday_date; ?>;
            $("#hours").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
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
         var formattedDate = curr_year + "-" + curr_month + "-" + curr_date;

           if ($.inArray(formattedDate, active_dates) !== -1){
               return {
                  classes: 'activeClassdt'
               };
           }
          return;
      }
            });
            //var charcode = <?php echo $charge_code; ?>;
            //var actcode = <?php echo $act_code; ?>;
            
            var config = {
      '.select_charge'  : {allow_single_deselect:true},
      '.select_act'  : {allow_single_deselect:true}
    };
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
            });
</script>