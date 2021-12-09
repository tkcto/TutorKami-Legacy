<link rel="stylesheet" type="text/css" href="fadhli/DateTimePicker/DateTimePicker.css" />
<script>
/*
if(navigator.userAgent.toLowerCase().indexOf('firefox') > -1){

    <script type="text/javascript" src="fadhli/DateTimePicker/jquery-1.11.0.min.js">

}
*/
if(!!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime)){
    document.write('<scr'+'ipt type="text/javascript" src="fadhli/DateTimePicker/jquery-1.11.0.min.js" ></scr'+'ipt>');


}

</script>
<style>
#myModalShowText .modal-dialog {
    -webkit-transform: translate(0,-50%);
    -o-transform: translate(0,-50%);
    transform: translate(0,-50%);
    top: 45%;
    margin: 0 auto;
}
</style>
<style>
.bordercolor {
    -moz-box-shadow: 0 0 2px black;
    -webkit-box-shadow: 0 0 2px black;
    box-shadow: 0 0 2px black;
}

#overlay {
    /*
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;*/
  position:fixed;
  top:0;
  left:0;
  bottom:0;
  right:0;
  height: 100%;
  width: 100%;
  margin: 0;
  padding: 0;
  background: #000000;
  opacity: .3;
  filter: alpha(opacity=30);
  -moz-opacity: .3;
   z-index: 101;
}

.blackColor{
    color: black;
    font-weight: bold;
}

::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  font-weight: 300;
}
::-moz-placeholder { /* Firefox 19+ */
  font-weight: 300;
}
:-ms-input-placeholder { /* IE 10+ */
  font-weight: 300;
}
:-moz-placeholder { /* Firefox 18- */
  font-weight: 300;
}

.not-active { 
    cursor: not-allowed; 
} 
</style>
<!--<script type="text/javascript" src="fadhli/DateTimePicker/jquery-3.1.0.min.js"></script>-->
<script type="text/javascript" src="fadhli/DateTimePicker/DateTimePicker.js"></script>
<!--<script type="text/javascript" src="fadhli/DateTimePicker/zepto-1.1.6-Custom.min.js"></script>
<script type="text/javascript" src="fadhli/DateTimePicker/DateTimePicker-Zepto.js"></script>-->
<?php 
if(isset($_GET['action']) && $_GET['action'] == 'add_record') {
   $pop_stat = system::FireCurl(GET_CLASS_GUIDE_URL ."?user_id=". $_SESSION['auth']['user_id']);
   if($pop_stat->flag == 'success' && ($pop_stat->data == '' || $pop_stat->data == '1')) {
?>    
<div id="overlay"></div>
<?php 
   }
}


$queryStatusClass = " SELECT * FROM tk_classes_record WHERE cr_cl_id ='".$row->cl_id."' ORDER BY cr_date DESC   "; 
$resultStatusClass = $conn->query($queryStatusClass); 
if($resultStatusClass->num_rows > 0){ 
    $rowStatusClass = $resultStatusClass->fetch_assoc();
    $getStatusClass = $rowStatusClass['cr_status'];  //cr_status
    //echo $getStatusClass;
}
?>


      <div class="container">
         <div class="col-md-12">
            <h3 class="text-left text-uppercase org-txt"><strong><?php echo JOB_ID; ?> : <?php echo $row->cl_display_id;?></strong></h3>
            <input type="hidden" id="cl_id" name="cl_id" value="<?php echo $row->cl_id;?>">
            <hr>
            <div class="clearfix"></div>
            <div class="row">
               <!-- <div class="col-md-4"><strong><?php echo STUDENT_NAME; ?> :</strong> <?php echo $row->cl_student; //$row->ud_first_name;?> <?php echo $row->ud_last_name;?></div> -->
               <div class="col-md-4"><strong><?php echo 'Student';//echo STUDENT_NAME; ?> :</strong> <?php echo $row->cl_student;?></div>
               <div class="col-md-4"><strong><?php echo 'Rate'; ?> :</strong> <?php echo $row->cl_rate;?></div>
               <div class="col-md-4"><strong><?php echo STATUS; ?> : <?php echo $status[$row->cl_status];?></strong></div>
               <div class="col-md-4"><strong><?php echo SUBJECT; ?> :</strong> <?php echo $row->cl_subject;?></div>

               <div class="col-md-4"><strong><?php echo 'Current cycle'; ?> : </strong><span>
                                        <?PHP
                                        $i = 0;
                                        $len = count($record_arr);
                                        if( $len == 0){
                                            echo '#1';
                                        }else{
                                            foreach ($record_arr as $key => $record_row) {
                                                if ($i == 0) {
                    						        if( $record_row->cr_status == 'Required Parent To Pay' ){
                    						            //echo '#'.($record_row->row_no+1);
                    						            echo '#'.$record_row->row_no;
                    						        }else{
                    						           echo '#'.$record_row->row_no;
                    						        }
                                                } else if ($i == $len - 1) {
                                                    // last
                                                }
                                                // …
                                                $i++;
                                            }                                            
                                        }
                                        ?>
               </span></div>

               <div class="col-md-4"><strong><?php echo ONE_CYCLE; ?> :</strong> <?php echo intval($row->cl_cycle);?> hours</div>
               <div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong>
                    <?PHP
                    if( $getStatusClass == 'FM to pay tutor' ){
                        echo 'Tutor to be paid';
                        $disableAdd = '';
                        $disableAdd2 = '';
                    }else if( $getStatusClass == 'Tutor Paid' ){
                        
                                    if( $row->last == 'This is the last session' ){
                                        echo 'Client has stopped the class';
                                    }else if( $row->last == 'Next class as usual' ){
                                        echo 'New cycle to start. Please update record once new session has started';
                                    }else if( $row->last == 'Not sure if got next class' ){
                                        echo 'Waiting confirmation from Client. Please update record if new session has started';
                                    }else{
                                        
                                    }
                        
                        //echo 'New cycle to start';
                        $disableAdd = '';
                        $disableAdd2 = '';
                    }else if( $getStatusClass == 'Required Parent To Pay' ){
                        //echo 'Wait for Admin';
                        echo 'Admin to update';
                        $disableAdd = 'not-active';
                        $disableAdd2 = 'disabled';
                    }else{
                        $disableAdd = '';
                        $disableAdd2 = '';
                    ?>  
                        <span id="hours_balance_new"></span>
                    <?PHP
                    }
                    ?>
               </div>
               <!-- <input type="text" name="hours_balance_new" id="hours_balance_new"> -->
               <!-- <div class="col-md-4"><strong><?php echo TUTOR_NAME; ?> :</strong> <?php echo $_SESSION['auth']['display_name'];?></div> -->
            </div>
         </div>
         <div class="col-md-12">
            <div class="row" style="margin-bottom:6px;">
               <div class="col-md-2 col-sm-3 col-xs-12 posRelative">
				  <a href="my-classes.php" class="btn btn-default"><span class="glyphicon glyphicon-hand-left"></span> &nbsp;&nbsp;<?php echo "Back"; ?></a>
                  <div class="step_box step_1 hidden">
                     <div class="step_head">
                        <?php echo TOOLTIP_STEP1_TITLE; ?>
                        <!--<div class="close">x</div>-->
                     </div>
                     <div class="step_text bordercolor">
                        <p><?php echo TOOLTIP_STEP1_DESCRIPTION; ?></p>
                        <p class="text-center"><a href="#" class="gobtn"><?php if(isset($_GET['action']) && $_GET['action'] == 'add_record') {echo TOOLTIP_STEP1_BUTTON; echo'>';}else{echo TOOLTIP_VIEW;} ?> </a></p>
                        <div class="checkbox">
                           <label>
                           <input type="checkbox"> <?php echo TOOLTIP_STEP1_CHECKBOX_LABEL; ?>
                           </label>
                        </div>
                     </div>
                  </div>
                  <!--<a href="<?php echo basename($_SERVER['PHP_SELF']).'?action=add_record&c_id='.$row->cl_id; ?>" class="tute_green"> + <?php echo ADD_RECORD; ?></a>-->
				  <a href="<?php echo basename($_SERVER['PHP_SELF']).'?action=add_record&c_id='.$row->cl_id; ?>" class="btn btn-success btn-sm <?PHP echo $disableAdd; ?>" <?PHP echo $disableAdd2; ?> role="button"><span class="glyphicon glyphicon-plus"></span> <?php echo ADD_RECORD; ?></a>
				  <?php /*if(!isset($_GET['action']) || $_GET['action'] != 'add_record') { 
				  ?>
					<a href="<?php echo basename($_SERVER['PHP_SELF']).'?action=add_record&c_id='.$row->cl_id; ?>" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-plus"></span> <?php echo ADD_RECORD; ?></a>
				  <?php
				  }*/?>
				  
               </div>
            </div>

        <script> 
            function validate() { 
                var date  = document.forms["ClassForm"]["record_date"]; 
                var start = document.forms["ClassForm"]["record_start_time"]; 
                var end   = document.forms["ClassForm"]["record_end_time"]; 

                if (date.value == "") {
                    getStickyNote('error','Please Enter Class Date')
                } 
                if (start.value == "") {
                    getStickyNote('error','Please Enter Start Time')
                } 
                if (end.value == "") {
                    getStickyNote('error','Please Enter End Time')
                } 
                
                if( date.value == "" || start.value == "" || end.value == "" ){
                    return false; 
                }
                
                
                return confirm('After you confirm, you cannot change or edit anymore.');
            } 
        </script> 
            <div class="row">
               <div class="col-md-12 job-table">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center" style="background:#fff;" id="dataTables_cl">
                     <thead>
                        <tr class="blue-bg">
                           <!--<td width="20%"><?php //echo " "; ?></td>-->
                           <td width="20%"><?php echo "Class Date"; ?></td>
                           <td width="10%"><?php echo "Start Time";//TIME_START; ?></td>
                           <td width="10%"><?php echo "End Time";//TIME_END; ?></td>
                           <td width="10%"><?php echo DURATION; ?></td>
                           <td width="15%"><?php echo TUTOR_REPORT; ?></td>
                           <td width="15%"><?php echo 'Client’s verification'; //echo PARENT_VERIFICATION; ?></td>
                           <td width="20%"><?php echo 'Client’s remarks'; //echo PARENT_REMARKS; ?></td>
                        </tr>
                     </thead>
                     <tbody>   
                        <?php if(isset($_GET['action']) && $_GET['action'] == 'add_record') { ?>
                        <tr>
                           <form name="ClassForm" action="" onsubmit="return validate()" method="post"> 
<?PHP
/*
//$mystring = 'home/cat1/subcat2/';
$mystring = '1 hours 30 minutes';
$first = strtok($mystring, 'hours');
//echo $first; // home
echo "<br>";
  function getBetween($content,$undostart,$undoend){
    $r = explode($undostart, $content);
    if (isset($r[1])){
        $r = explode($undoend, $r[1]);
        return $r[0];
    }
    return '';
  }
  $undostart = "hours ";
  $undoend = " minutes";
  $second = getBetween($mystring,$undostart,$undoend);
  echo $second;
echo "<br>";
*/
/*$numberformat = (strval($first.'.'.$second));
echo $numberformat;
echo "<br>";
//echo $test = double("8") - double($numberformat);
//$var_name = 32.360; 
  
//echo (strval("8")) - (strval($numberformat)); 
echo "<br>";
$foo = "105";
echo number_format((float)$foo, 2, '.', ''); //number_format((float)8, 2, '.', '');
$test = number_format((float)8, 2, '.', '');
$test2 = strval($numberformat); 
$test3 = strval((float)8, 2, '.', '');
$thistest = "8";
$numberinput = (float)$thistest;
echo "<br>";

echo $numberinput;*/
/*
echo "<br>";echo "<br>";
$num1 = "8"; 
//echo number_format($num1)."\n"; 
  echo "<br>";
echo number_format($num1, 2)."\n"; 
  echo "<br>";
$number1 = ($first.'.'.'00');
$number2 = ('0'.'.'.$second);
$number3 = $number1 + $number2; 
echo "<br>";
echo number_format($number3, 2)."\n"; 
echo ((number_format($num1, 2)) - (number_format($number3, 2)));*/

/*$num1 = "8.15"; 
$num2 = number_format($num1, 2);
$first = strtok($num2, '.');
echo $first;
echo "<br>";
$second = substr($num1, strrpos($num1, '.') + 1);
echo $second;
echo "<br>";
echo $totalmin = (($first * 60) + $second);
echo "<br>";

$mystring = '1 hours 30 minutes';
$mystring = str_replace(" hours ",".",$mystring);
$mystring = str_replace(" minutes","",$mystring);
$num3 = number_format($mystring, 2);
$otherfirst = strtok($num3, '.');
echo $otherfirst;
echo "<br>";
$othersecond = substr($num3, strrpos($num3, '.') + 1);
echo $othersecond;
echo "<br>";
echo $othertotalmin = (($otherfirst * 60) + $othersecond);
echo "<br>";
echo $thisminutes =  $totalmin - $othertotalmin;
echo "<br>";
function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
//echo convertToHoursMins($thisminutes, '%02d hours %02d minutes');
echo convertToHoursMins($thisminutes, '%02d.%02d');
*/
?>
                              <input type="hidden" name="class_id" id="class_id" value="<?php echo (isset($row->cl_id) && $row->cl_id != '') ? $row->cl_id : ''; ?>">
                              <input type="hidden" name="total_duration" id="input_duration" value="">	
                              <!--<input type="text" name="testtest" id="testtest" value="">-->
<input type="hidden" name="total_cycle" id="total_cycle" value="<?php echo $row->cl_cycle;?>">					  
                              <td class="posRelative">
                                 <div class="step_box step_2 hidden">
                                    <div class="step_head">
                                       <?php echo TOOLTIP_STEP2_TITLE; ?>
                                       <!--<div class="close">x</div>-->
                                    </div>
                                    <div class="step_text bordercolor">
                                       <p><?php echo TOOLTIP_STEP2_DESCRIPTION; ?></p>
                                       <p class="text-center"><a href="#" class="gobtn"><?php echo TOOLTIP_STEP2_BUTTON; ?> ></a></p>
                                       <div class="checkbox">
                                          <label>
                                          <input type="checkbox"> <?php echo TOOLTIP_STEP2_CHECKBOX_LABEL; ?>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="input-group date" id="datetimepicker1">
                                       <input type="text" class="form-control disabledthis blackColor" name="record_date" />
                                       <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> </span> 
                                    </div>
                                 </div>
                              </td>
                              <td class="posRelative text-center">
                                 <div class="step_box step_3 hidden">
                                    <div class="step_head">
                                       <?php echo TOOLTIP_STEP3_TITLE; ?>
                                       <!--<div class="close">x</div>-->
                                    </div>
                                    <div class="step_text bordercolor">
                                       <p><?php echo TOOLTIP_STEP3_DESCRIPTION; ?></p>
                                       <p class="text-center"><a href="#" class="gobtn"><?php echo TOOLTIP_STEP3_BUTTON; ?> ></a></p>
                                       <div class="checkbox">
                                          <label>
                                          <input type="checkbox"> <?php echo TOOLTIP_STEP3_CHECKBOX_LABEL; ?>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control disabledthis blackColor" placeholder="02:30 PM" id="st_time" name="record_start_time" autocomplete="off" >
                                 </div>
                              </td>
                              <td class="posRelative text-center">
                                 <div class="step_box step_4 hidden">
                                    <div class="step_head">
                                       <?php echo TOOLTIP_STEP4_TITLE; ?>
                                       <!--<div class="close">x</div>-->
                                    </div>
                                    <div class="step_text bordercolor">
                                       <p><?php echo TOOLTIP_STEP4_DESCRIPTION; ?></p>
                                       <p class="text-center"><a href="#" class="gobtn"><?php echo TOOLTIP_STEP4_BUTTON; ?> ></a></p>
                                       <div class="checkbox">
                                          <label>
                                          <input type="checkbox"> <?php echo TOOLTIP_STEP4_CHECKBOX_LABEL; ?>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control disabledthis blackColor" placeholder="05:30 PM" id="en_time" name="record_end_time" autocomplete="off" >
                                 </div>
								 <!--<div class="input-group">
									<input type="text" class="form-control disabledthis blackColor" data-field="time" data-format="hh:mm AA" readonly placeholder="05:30 PM" id="en_time" name="record_end_time">
                                 </div>-->
								 <div id="dtBox"></div>
                              </td>
                              <td class="posRelative" id="duration">2 hours</td>
                              <td class="posRelative">
                                 <div class="step_box step_5 hidden">
                                    <div class="step_head">
                                       <?php echo TOOLTIP_STEP5_TITLE; ?>
                                       <!--<div class="close">x</div>-->
                                    </div>
                                    <div class="step_text bordercolor">
                                       <p><?php echo TOOLTIP_STEP5_DESCRIPTION; ?> </p>
                                       <p class="text-center"><a href="#" class="gobtn"><?php echo TOOLTIP_STEP5_BUTTON; ?> ></a></p>
                                       <div class="checkbox">
                                          <label>
                                          <input type="checkbox"> <?php echo TOOLTIP_STEP5_CHECKBOX_LABEL; ?>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                                 <textarea class="text-center disabledthis blackColor" name="record_remark" placeholder="<?php echo PLEASE_FILL_IN_YOUR_REMARK_HEAR; ?>"></textarea>
                              </td>
                              <td class="posRelative inactive">
                                 <div class="radio disabled">
                                    <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked disabled="">
                                    <?php echo YES_REPORT_IS_CORRECT; ?> </label>
                                 </div>
                                 <div class="radio disabled">
                                    <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" disabled="">
                                    <?php echo NO_REPORT_IS_NOT_CORRECT; ?> </label>
                                 </div>
                              </td>
                              <td class="posRelative inactive">
                                 <div class="row">
                                    <div class="col-md-12"><textarea  class="text-center" disabled=""><?php echo CLIENT_AREA; ?></textarea></div>
                                    <div class="col-md-6"><a href="<?php echo basename($_SERVER['PHP_SELF']).'?c_id='.$row->cl_id; ?>" class="delete pull-left"><?php echo BUTTON_DELETE; ?></a></div>
									<div class="col-md-6 posRelative">
                                       <div class="step_box step_6 hidden">
                                          <div class="step_head">
                                             <?php echo TOOLTIP_STEP6_TITLE; ?>
                                             <!--<div class="close">x</div>-->
                                          </div>
                                          <div class="step_text bordercolor">
                                             <p><?php echo TOOLTIP_STEP6_DESCRIPTION; ?></p>
                                             <p class="text-center"><a href="#" class="gobtn" onClick="disabled()"><?php echo TOOLTIP_STEP6_BUTTON; ?></a></p>
                                             <div class="checkbox">
                                                <label>
                                                <input type="checkbox"> <?php echo TOOLTIP_STEP6_CHECKBOX_LABEL; ?>
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                       <button class="save"><?php echo BUTTON_SAVE; ?></button>
                                    </div>
                                 </div>
                              </td>
                           </form>
                        </tr>
                        <?php } ?>                        
                        <?php 
                        $record_status = array(
                           'done' => '<strong class="green-txt">Correct</strong>', 
                           'notdone'  => '<strong class="red-txt">Incorrect</strong>');

                        if(count($record_arr) > 0) {
                           foreach ($record_arr as $key => $record_row) {                           
                        ?>
                        <tr>
						   <td><?php //echo date("d/m/Y", strtotime($record_row->cr_date)); 
						        if( $record_row->cr_status == 'Tutor Paid' ){
                                        $thisHour = '';
                                        $GetHour = " SELECT cr_cl_id, row_no, cr_date, cr_start_time, cr_id, cr_cycle FROM tk_classes_record WHERE cr_cl_id = '".$record_row->cr_cl_id."' AND row_no = '".$record_row->row_no."' ORDER BY cr_date ASC, cr_start_time ASC, cr_id ASC ";
                                        $reGetHour = $conn->query($GetHour);
                                        if ($reGetHour->num_rows > 0) {
                                            $roGetHour = $reGetHour->fetch_assoc();
                                            $thisHour = $roGetHour['cr_cycle'];
                                        }
                                        
						            echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')<br/><b>Total : '.$thisHour.' hours</b>';

						        }
						        else if( $record_row->cr_status == 'Required Parent To Pay' ){
						            //echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.($record_row->row_no+1).')';
						            echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')';
						        }else{
						            echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')';
						        }
						   ?></td>
                           <td><?php  
                                        if (strpos($record_row->cr_start_time, 'PM') !== false) {
                                            echo str_replace("PM"," PM",$record_row->cr_start_time);
                                        } else {
                                            echo str_replace("AM"," AM",$record_row->cr_start_time);
                                        }
                           //echo $record_row->cr_start_time;?></td>
                           <td><?php 
                                        if (strpos($record_row->cr_end_time, 'PM') !== false) {
                                            echo str_replace("PM"," PM",$record_row->cr_end_time);
                                        } else {
                                            echo str_replace("AM"," AM",$record_row->cr_end_time);
                                        }
                           //echo $record_row->cr_end_time;?></td>
                           <td><?php //echo $record_row->cr_duration;
						   $replaceDuration = $record_row->cr_duration;
						   echo str_replace("&","& <br/>",$replaceDuration );
						   ?></td>
                           <td><?php //echo $record_row->cr_tutor_report;
                                 if( $record_row->cr_tutor_report != ''){
                                     if( strlen($record_row->cr_tutor_report) > 30){
                                         echo substr_replace($record_row->cr_tutor_report, ' .. <a style="text-decoration: underline;" href="javascript:showText('.$record_row->cr_id.')">View More</a>', 30);
                                     }else{
                                         echo $record_row->cr_tutor_report;
                                     }
                                     
                                 }else{
                                     echo '';
                                 }
                           ?></td>
                           <td><?php echo ($record_row->cr_parent_verification != '') ? $record_status[$record_row->cr_parent_verification] : '';?></td>
                           <td><?php //echo $record_row->cr_parent_remark;
                                 if( $record_row->cr_parent_remark != ''){
                                     if( strlen($record_row->cr_parent_remark) > 30){
                                         echo substr_replace($record_row->cr_parent_remark, ' .. <a style="text-decoration: underline;" href="javascript:showText2('.$record_row->cr_id.')">View More</a>', 30);
                                     }else{
                                         echo $record_row->cr_parent_remark;
                                     }
                                     
                                 }else{
                                     echo '';
                                 }
                           ?></td>
                        </tr>
                        <?php 
                           }
                        } else { 
                        ?>
                        <tr>
                           <td colspan="7"><b><?php echo NO_RECORDS_FOUND; ?></b></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
	  
	  
<!-- fadhli test -->
<!-- popup msj tak keluar bila di chrome (bila tekan start)-->
<script type="text/javascript">
    /*
	$(document).ready(function () {
        $("#openModal").trigger("click");
    });
	*/
	</script>






<script type="text/javascript">
 $(window).load(function(){        
   $('#myModaltest').modal('show');
   //alert('test');
    }); 
</script>
 <button data-backdrop="static" data-keyboard="false" type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#tourGuideModal" id="openModal">Open Modal</button>
 <button data-backdrop="static" data-keyboard="false" type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#myModalShowText" id="openModal2">Open Modal</button>

<!--<div id="myModaltest" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Subscribe our Newsletter</h4>
            </div>
            <div class="modal-body">
				<p>Subscribe to our mailing list to get the latest updates straight in your inbox.</p>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>-->
<!-- fadhli test -->



<!-- Modal -->
<div class="modal fade-scale" id="tourGuideModal" tabindex="-1" role="dialog" aria-labelledby="tourGuideModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
         <h4 class="modal-title text-center" id="tourGuideModalLabel"><?php echo POPUP_TITLE; ?> <?php echo ucfirst($_SESSION['auth']['display_name']); ?>!</h4>
      </div>
      <div class="modal-body">
         <p class="text-center note"><?php echo POPUP_DESCRIPTION; ?></p>
         <p class="text-center buttons">
            <button type="button" class="save" onclick="myFunction()"><?php echo POPUP_BUTTON_START; ?></button>
            <button type="button" class="delete" data-dismiss="modal" onclick="noThanks()"><?php echo POPUP_BUTTON_NO_THANKS; ?></button>
         </p>
         <p class="text-center discard_popup">
            <label for="discard_popup"><input type="checkbox" id="discard_popup" value="0"> <?php echo POPUP_CHECKBOX_LABEL; ?></label>
         </p>         
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="myModalShowText" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog vertical-align-center" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <center id="dataShowText"></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php 
if(isset($_GET['action']) && $_GET['action'] == 'add_record') {
   $pop_stat = system::FireCurl(GET_CLASS_GUIDE_URL ."?user_id=". $_SESSION['auth']['user_id']);
   if($pop_stat->flag == 'success' && ($pop_stat->data == '' || $pop_stat->data == '1')) {
      //echo '<script>$(window).on("load",function(){$("#tourGuideModal").modal("show");});</script>';
	  echo '<script type="text/javascript">$(document).ready(function () {$("#openModal").trigger("click");});</script>';
   }
}else{
   $pop_stat = system::FireCurl(GET_CLASS_GUIDE_URL ."?user_id=". $_SESSION['auth']['user_id']);
   if($pop_stat->flag == 'success' && ($pop_stat->data == '' || $pop_stat->data == '1')) {
	  echo '<script type="text/javascript">$(document).ready(function () { $(".step_box.step_1").removeClass("hidden").addClass("show"); });</script>';
   }
}
?>


<!-- fadhli datetimepicker  -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            /*$(function () {
                $('#en_time').datetimepicker({
                    format: 'LT'
                });
            });*/
			
        </script>
		
<!-- Data picker -->
<script src="admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Clock picker -->
<script src="admin/js/plugins/clockpicker/clockpicker.js"></script>
<script type="text/javascript">
    
$(document).ready(function(){
    
  $("#st_time").change(function(){
    var dummyTxt = $('#st_time').val();
    var joy=dummyTxt.match(/.{1,5}/g);
    document.getElementById("st_time").value = joy.join(' ');
  });
  
  $("#en_time").change(function(){
    var dummyTxt = $('#en_time').val();
    var joy=dummyTxt.match(/.{1,5}/g);
    document.getElementById("en_time").value = joy.join(' ');
  });
  
});

function myFunction() {
	$(".delete").trigger("click");
	$('.step_box.step_1').removeClass('hidden').addClass('show');
	
	$('.disabledthis').attr('disabled', true);
    document.getElementById("overlay").style.display = "block";
}

function noThanks() {
    document.getElementById("overlay").style.display = "none";
}

function disabled() {
	$('.disabledthis').attr('disabled', false);
	 document.getElementById("overlay").style.display = "none";
}


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
            $('#en_time').val('');
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
      Calcbalance();
      $('.clockpicker input').on('change', function(){
         var start_time = $('#st_time').val();
         var end_time   = $('#en_time').val();

         var duration = calculateTime(start_time, end_time);
		 
         var res = duration.replace("&", "& <br/>");
		 
         $('#duration').html(res);
         $('#input_duration').val(duration);
      });
	  
	  //fadhli datetimepicker
      /*$('#en_time').on('blur', function(){
         var start_time = $('#st_time').val();
         var end_time   = $('#en_time').val();

         var duration = calculateTime(start_time, end_time);
         
         $('#duration').html(duration);
         $('#input_duration').val(duration);
      });*/
      $('#en_time').on('blur', function(){
         var start_time = $('#st_time').val();
         var end_time   = $('#en_time').val();

         var duration = calculateTime(start_time, end_time);
		 
         var res = duration.replace("&", "& <br/>");
		 
         $('#duration').html(res);
         $('#input_duration').val(duration);
      });
 /*     
$('#st_time').on('blur', function(){
    var start_time = $('#st_time').val();
    document.getElementById("testtest").value = start_time;
});
 */ 

      
$('.clockpicker').clockpicker({
   donetext: '<b style="font-size: 15px;">DONE<b>',
   twelvehour: true,
   autoclose: false,
   leadingZeroHours: false,
   upperCaseAmPm: true,
   leadingSpaceAmPm: true,
   afterHourSelect: function() {
      $('.clockpicker').clockpicker('realtimeDone');
   },
   afterMinuteSelect: function() {
      $('.clockpicker').clockpicker('realtimeDone');
   },
   afterAmPmSelect: function() {
      $('.clockpicker').clockpicker('realtimeDone');
   },
   
   
        //afterDone: function() {
            //st_time
           // clockpicker.val(clockpicker.val().slice(0,-2)+' '+clockpicker.val().slice(-2));
           //document.getElementById("element").innerHTML
             //$('.clockpicker').clockpicker(clockpicker.val().slice(0,-2)+' '+clockpicker.val().slice(-2));
             //document.getElementById("st_time").value='test';
             //alert("after done");
       // }

	
                        //beforeShow: function() {
                            //document.getElementById("st_time").value= (clockpicker.val().slice(0,-2)+' '+clockpicker.val().slice(-2));
/*document.getElementById("testtest").value= document.getElementById("st_time").value;
 var str = 'testtest';
  var chuncks = str.match(/.{1,5}/g);
  var new_value = chuncks.join(" "); //returns 123-456-789
  document.getElementById("st_time").value= new_value;*/
  //alert('test1');
                        //},
                         //afterShow: function() {
                            //document.getElementById("st_time").value= (clockpicker.val().slice(0,-2)+' '+clockpicker.val().slice(-2));
                           
/*document.getElementById("testtest").value= document.getElementById("st_time").value;
 var str = 'testtest';
  var chuncks = str.match(/.{1,5}/g);
  var new_value = chuncks.join(" "); //returns 123-456-789
  document.getElementById("st_time").value= new_value;*/
  //alert('test2');
                        //}
 
   
});
/*
$(document).ready(function(){
    var st_time = document.getElementById("st_time").value;
    if(st_time !==''){
        document.getElementById("st_time").value = 'test';
    }
});
function reply_click(){
    alert('test');
}
$('.container').each(function(){
    var clockpicker = $(this).find('input').clockpicker({
   donetext: 'Done',
   twelvehour: true,
   autoclose: false,
   leadingZeroHours: false,
   upperCaseAmPm: true,
   leadingSpaceAmPm: true,

        afterDone: function() {
            clockpicker.val(clockpicker.val().slice(0,-2) + '  ' + clockpicker.val().slice(-2));
        }
    });

});*/






      $('.input-group.date').datepicker({
         todayBtn: "linked",
         keyboardNavigation: false,
         forceParse: false,
         calendarWeeks: true,
         autoclose: true,
		 todayHighlight: true,
         format: "dd/mm/yyyy"
      });
	  

      $('#discard_popup').on('change', function(){
         var checkbox_val = ($(this).prop("checked") == true) ? 0 : 1;

         $.ajax({
            url: "front_ajax_call.php",
            method: "POST",
            data: {action: 'update_class_guide', status: checkbox_val}, 
            success: function(result){
            }
         });
      });

     /* $('#tourGuideModal .buttons button.save').click(function(){
         $("#tourGuideModal").modal("hide");
         $('.step_box.step_1').removeClass('hidden').addClass('show');
         $('#hider').show();
         return false;
      });*/
	    
      $('.step_box.step_1 a.gobtn').click(function(){
         $('.step_box').removeClass('show').addClass('hidden');
         $('.step_box.step_2').removeClass('hidden').addClass('show');
         return false;
      });

      $('.step_box.step_2 a.gobtn').click(function(){
         $('.step_box').removeClass('show').addClass('hidden');
         $('.step_box.step_3').removeClass('hidden').addClass('show');
         return false;
      });

      $('.step_box.step_3 a.gobtn').click(function(){
         $('.step_box').removeClass('show').addClass('hidden');
         $('.step_box.step_4').removeClass('hidden').addClass('show');
         return false;
      });

      $('.step_box.step_4 a.gobtn').click(function(){
         $('.step_box').removeClass('show').addClass('hidden');
         $('.step_box.step_5').removeClass('hidden').addClass('show');
         return false;
      });

      $('.step_box.step_5 a.gobtn').click(function(){
         $('.step_box').removeClass('show').addClass('hidden');
         $('.step_box.step_6').removeClass('hidden').addClass('show');
         return false;
      });

      $('.step_box.step_6 a.gobtn').click(function(){
         $('.step_box').removeClass('show').addClass('hidden');
         $('#hider').hide();
         return false;
      });

      $('.step_box input[type=checkbox]').click(function(){
         var checkbox_val = ($(this).prop("checked") == true) ? 0 : 1;

         $.ajax({
            url: "front_ajax_call.php",
            method: "POST",
            data: {action: 'update_class_guide', status: checkbox_val}, 
            success: function(result){
            }
         });
      });

      $('.step_box .close').click(function(){
         $(this).parents('.step_box').removeClass('show').addClass('hidden');
         $('#hider').hide();
      });
   });   
</script>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/select2.min.js"></script>
<script>
   $.noConflict();
   jQuery(document).ready(function($){
      
      $("#e1").select2();
      $("#e2").select2();

      $('#dataTables_cl').DataTable({
         "info":false,
         "searching":false,
         "lengthChange":false,
         "bSort":true,
         "bPaginate":true,
         "sPaginationType":"simple_numbers",
         "iDisplayLength": 10,
		 

		 
         "columns": [     
            /*{ "visible": false },	*/
           /* { "orderable": false },
            { "orderable": false },
            { "orderable": false },
            { "orderable": false }, 
            { "orderable": false }, 
            { "orderable": false }, 
            { "orderable": false }      */      
         ],
         /*"order": [[ 0, "desc" ]]*/
      });

      $(".clickable-row").click(function() {
           window.location = $(this).data("href");
      });
      
   });
</script>

<script type="text/javascript">
function Calcbalance(){
      var cl_id = $('#cl_id').val();

      
      if(cl_id != ''){
         $.ajax({
            url: "new_front_ajax_call.php",
            type: "POST",
            dataType: "json",
            data: {
               datanew: {
               cl_id : cl_id,
               },
            },
            success: function(response){

               // $('#new_balance').val(response);
			   //var res = response.replace("&", "& <br/>");

			   var firstDigit = response.substring(0, response.indexOf('.'));
			   var pointNum = parseFloat(firstDigit);
			   var second = response.split('.').splice(1).join('.')
			   //var result = pointNum + ' hours & ' + second + ' minutes';
			   var result2 = parseFloat(response) + ' hours & 00 minutes';
               //$('#hours_balance_new').html(result);

                if(firstDigit.indexOf('-') !== -1){
                  var result = (firstDigit.replace(/-/g, "- ")) + " hours & " + second + " minutes";
                }else{
                    var result = firstDigit + " hours & " + second + " minutes";
                }

			   if(response.indexOf('.') !== -1){
                    $('#hours_balance_new').html(result);
               }else{
                    $('#hours_balance_new').html(result2);
               }
                
               
               
            }
         });
      }
   }
   
			$(document).ready(function()
			{
			    $("#dtBox").DateTimePicker(
			    {
			        minuteInterval: 5,
					setButtonContent:"Done"
			    });
			});
			
$(document).ready(function(){
    $(".not-active").each(function(){
        if($(this).hasClass("not-active")){
            $(this).removeAttr("href");
        }
    });
});

function showText(text){
	$.ajax({
		type:'POST',
		url:'admin/classes-details-save.php',
		data: {
			showText: {text: text},
		},
		success:function(result){
            document.getElementById("dataShowText").innerHTML = result;
            //$('#myModalShowText').modal('show');
            $("#openModal2").trigger("click");
		}
	});
}
function showText2(text2){
	$.ajax({
		type:'POST',
		url:'admin/classes-details-save.php',
		data: {
			showText2: {text2: text2},
		},
		success:function(result){
            document.getElementById("dataShowText").innerHTML = result;
            //$('#myModalShowText').modal('show');
            $("#openModal2").trigger("click");
		}
	});
}
</script>