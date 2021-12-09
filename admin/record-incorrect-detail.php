<?php

require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;

/*$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}*/
if(isset($_REQUEST['cd'])){
    $valueURl = $_REQUEST['cd'];
    $query = $conDB->query("SELECT * FROM tk_classes_record WHERE cr_id=$valueURl");
    $res = $query->num_rows;
    if($res > 0){
        if($row = $query->fetch_assoc()){ 
            $iD  = $row['cr_id'];
            $iD2 = $row['cr_cl_id'];
            $date  = $row['cr_date'];
            $newDate = date("d/m/Y", strtotime($date));
            $start  = $row['cr_start_time'];
            $newStart = trim(chunk_split($start, 5,' '));
            $end  = $row['cr_end_time'];
            $duration  = $row['cr_duration'];
            $tutorReport  = $row['cr_tutor_report'];
            $parentVer  = $row['cr_parent_verification'];
            $parentRemark  = $row['cr_parent_remark'];
        }
    }
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Details | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.js"></script>
</head>

<body>
  <div id="wrapper">
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include_once('includes/header.php'); ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>
<div id="dtBox"></div>
      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5><b>Details</b></h5>

         </div>
         <div class="ibox-content">
   
	   
	   

<!--
 <p>Date : </p>
 <input type="text" data-field="date" readonly>
	
 <p>Time : </p>
 <input type="text" data-field="time" readonly>
	
 <p>DateTime : </p>
 <input type="text" data-field="datetime" readonly>
-->
	
	


        <form class="form-horizontal">
        <input type="hidden" class="form-control" name="cr_id" id="cr_id" value="<?php echo $iD; ?>" required>
        <input type="hidden" class="form-control" name="cr_cl_id" id="cr_cl_id" value="<?php echo $iD2; ?>" required>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Date:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <!--<input type="text" class="form-control" name="date" id="date" value="<?php ?>" required>   -->
                                 <input data-field="date" data-format="dd/MM/yyyy" type="text" class="form-control" name="date" id="date" value="<?php echo $newDate; ?>">
                              </div>
                           </div>
                        </div>
                        <!--<?PHP echo $iD.'<br/>'; ?>
                        <?PHP echo $iD2.'<br/>'; ?>
                        <?PHP echo $date.'<br/>'; ?>
                        <?PHP echo $start.'<br/>'; ?>
                        <?PHP echo $end.'<br/>'; ?>
                        <?PHP echo $duration.'<br/>'; ?>
                        <?PHP echo $tutorReport.'<br/>'; ?>
                        <?PHP echo $parentVer.'<br/>'; ?>
                        <?PHP echo $parentRemark.'<br/>'; ?>
 <div id="out"></div>-->
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Time Start:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input data-field="time" data-format="hh:mm AA" type="text" class="form-control" name="start" id="start" value="<?php echo $newStart; ?>">   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Time End:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input data-field="time" data-format="hh:mm AA" type="text" class="form-control" name="end" id="end" value="<?php echo $end; ?>">   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Duration:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
                                <input type="text"  class="form-control" name="duration" id="duration" value="<?php echo $duration;  ?>" disabled>
                              </div>
						   </div>
                        </div>
    
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Tutor's Remarks:</label>
                           <div class="col-lg-5">
                                <textarea class="form-control" rows="5" name="tutor_remark" id="tutor_remark"><?php echo $tutorReport;  ?></textarea>
						   </div>
                        </div>

                        <div class="form-group">
                           <label class="col-lg-3 control-label">Parent Verification:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="parent_ver" id="optionsRadios1" value="done" <?PHP if($parentVer == 'done'){echo'checked';} ?> >
                                    Yes, record is correct </label>
                                 </div>
                                 <div class="radio">
                                    <label>
                                    <input type="radio" name="parent_ver" id="optionsRadios2" value="notdone" <?PHP if($parentVer == 'notdone'){echo'checked';} ?> >
                                    No, record is incorrect </label>
                                 </div>                                
                                
                              </div>
						   </div>
                        </div>

                        <div class="form-group">
                           <label class="col-lg-3 control-label">Parent Remarks:</label>
                           <div class="col-lg-5">
                                <textarea class="form-control" rows="5" name="parent_remark" id="parent_remark"><?php echo $parentRemark;  ?></textarea>
						   </div>
                        </div>
                        <!--<div class="form-group">
                           <label class="col-lg-3 control-label">Hours Balance:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
                                <input type="text"  class="form-control" name="" id="" disabled>
                              </div>
						   </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Cycle:</label>
                           <div class="col-lg-7">
                              <div class="form-inline">
                                <input type="text"  class="form-control" name="" id="" value="<?php  ?>" required> <span> <font size="2">&nbsp;&nbsp;&nbsp;hours</font></span>
                              </div>
						   </div>
                        </div>

                        <div class="form-group">
                           <label class="col-lg-3 control-label">Status:</label>
                           <div class="col-lg-7" style="width:240px;">
                              <select class="form-control" name="" required>
                                 <option value="">Select Status</option>
                                 <option value="ongoing">On Going</option>
                                 <option value="onhold">On Hold</option>
                                 <option value="ended">Ended</option>
                              </select>
                           </div>
                        </div>-->
                        <div class="form-group">
                           <div class="col-lg-offset-3 col-lg-9">
                              <button class="btn btn-sm btn-secondary sign-btn-box mrg-right-15" type="button" onClick="backToClasses()"><i class="glyphicon glyphicon-hand-left"></i> Back</button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" onClick="saveClasses()"><i class="glyphicon glyphicon-check"></i> Save</button>
                           </div>
                        </div>
        </form>



	   
	   
	   
	   
	   
	   
     </div>
   </div>
 </div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>
<script type="text/javascript">
//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms, 5 second for example

//on keyup, start the countdown
$('#start').keyup(function(){
    clearTimeout(typingTimer);
    if ($('#start').val) {
        typingTimer = setTimeout(function(){
            //do stuff here e.g ajax call etc....
             var v = $("#start").val();
             $("#out").html(v);
        }, doneTypingInterval);
    }
});


$(document).ready(function(){
    $("#dtBox").DateTimePicker({
        minuteInterval: 5,
        setButtonContent:"Done",
        dateSeparator:"/"
    });
});

function TwentyFourHourConverter(time){

var hours = Number(time.match(/^(\d+)/)[1]);
var minutes = Number(time.match(/:(\d+)/)[1]);
// var AMPM = time.match(/\s(.*)$/)[1];
var AMPM = time.slice(-2);

if(AMPM == "PM" && hours<12) hours = hours+12;
if(AMPM == "AM" && hours==12) hours = hours-12;
var sHours = hours.toString();
var sMinutes = minutes.toString();
if(hours<10) sHours = "0" + sHours;
if(minutes<10) sMinutes = "0" + sMinutes;

var date = new Date();
date.setHours(sHours);
date.setMinutes(sMinutes);

return date;
}

function calculateTime(s, e){
      var response;
      var timeStart = (s != '') ? TwentyFourHourConverter(s) : '';
      var timeEnd = (e != '') ? TwentyFourHourConverter(e) : '';

      if(timeStart != '' && timeEnd != '') {
         if (timeEnd.getTime() < timeStart.getTime()) {
            alert('End Time must be greater than Start Time');
         } else {            
            var diff = timeEnd.getTime() - timeStart.getTime();
            var sec_num = parseInt(diff, 10);
            var hours = Math.floor(sec_num / (1000 * 60 * 60));            
            var mins = Math.floor((sec_num - (hours * 1000 * 3600)) / (1000 * 60));
            if (mins < 10) {mins = "0"+mins;}    
            
            total_min = (parseInt(hours) * 60) + parseInt(mins);
            total_hrs = total_min / 60;
             response = hours + " hours & " + mins + " minutes";
            // response = hours + " hours";

            //response = total_hrs.toFixed(2) + " hours";
         }
      }

      return response;
   }

$(document).ready(function(){
      //Calcbalance();
      $('#start').on('blur', function(){
         var start_time = $('#start').val();
         var end_time   = $('#end').val();

         var duration = calculateTime(start_time, end_time);
		 
         var res = duration.replace("&", "& <br/>");
		 
         //$('#duration').value(res);
         $('#duration').val(duration);
      });
	  

      $('#end').on('blur', function(){
         var start_time = $('#start').val();
         var end_time   = $('#end').val();

         var duration = calculateTime(start_time, end_time);
		 
         var res = duration.replace("&", "& <br/>");
		 
         //$('#duration').value(res);
         $('#duration').val(duration);
      });
});

function saveClasses() {
    var cr_id = $('#cr_id').val();
    var cr_cl_id = $('#cr_cl_id').val();
    var date = $('#date').val();
    var startTime = $('#start').val();
    var endTime = $('#end').val();
    var duration = $('#duration').val();
    var tutorRemark = $('#tutor_remark').val();
    var parentVer = $("input[name='parent_ver']:checked").val();
    var parentRemark = $('#parent_remark').val();
        //alert(date + '-' + start + '-' + end + '-' + duration + '-' + tutorRemark + '-' + parentVer + '-' + parentRemark );
    $.ajax({
		type:'POST',
		url:'classes-details-save.php',
		data: {
			data: {cr_id: cr_id, cr_cl_id: cr_cl_id, date: date, startTime: startTime, endTime: endTime, duration: duration, tutorRemark: tutorRemark, parentVer: parentVer, parentRemark: parentRemark},
		},
		beforeSend: function() {
			//$('#demo').html("Loding ... ");
		},
		success:function(result){
			alert(result);
			/*if(result == "Update Is Successful"){
				//window.location = "classes-details?cd=14"
                window.location ='classes-details?cd='+cr_id;
			}*/
		}
	});

}

function backToClasses() {
   var cr_cl_id = $('#cr_cl_id').val();
   window.location ='record-incorrect';
}
</script> 
</div> 

</div>

</body>
</html>
 

