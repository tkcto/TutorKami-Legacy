<style>/*
input[type=text], select {
  width: 100%;
  padding: 6px 10px;
  margin: 4px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
*/
.save {
  width: 50%;
  background-color: #4CAF50;
  color: white;
  padding: 7px 10px;
  margin: 4px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.save:hover {
  background-color: #45a049;
}

.form-control[readonly] {
	background-color: white;
	opacity: 1
}
.bordercolor {
    -moz-box-shadow: 0 0 2px black;
    -webkit-box-shadow: 0 0 2px black;
    box-shadow: 0 0 2px black;
}

.horizontalline  {
  margin-top: 1rem;
  margin-bottom: 1rem;
  /*border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);*/
  border: 2px solid rgba(0, 0, 0, 0.1);
}
textarea {
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}
.panel-primary{
    border-color:#f1592a;
}
.icon-background {
    color: #f1592a;
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
<link rel="stylesheet" type="text/css" href="fadhli/DateTimePicker/DateTimePicker.css" />
<script type="text/javascript" src="fadhli/DateTimePicker/jquery-1.11.0.min.js"></script>
<!--<script type="text/javascript" src="fadhli/DateTimePicker/jquery-3.1.0.min.js"></script>-->
<script>
/*
if(!!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime)){
    document.write('<scr'+'ipt type="text/javascript" src="fadhli/DateTimePicker/jquery-1.11.0.min.js" ></scr'+'ipt>');


}*/
</script>
<script type="text/javascript" src="fadhli/DateTimePicker/DateTimePickerMobile.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/tooltip.js"></script>
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
         <div class="col-md-12">
            <h3 style="margin-top: -10px;" class="text-left text-uppercase org-txt"><strong><?php echo JOB_ID; ?> : <?php echo $row->cl_display_id;?></strong></h3>
            <input type="hidden" id="cl_id" name="cl_id" value="<?php echo $row->cl_id;?>">
            <hr>
            <div class="clearfix"></div>
         </div>
		 
         <?php if(isset($_GET['action']) && $_GET['action'] == 'add_record') { ?>
         <div class="col-md-12">
			<div class="row">
				<form action="" method="post" onsubmit="return validate()" name="ClassForm" > 
					<input type="hidden" name="class_id" id="class_id" value="<?php echo (isset($row->cl_id) && $row->cl_id != '') ? $row->cl_id : ''; ?>">
					<input type="hidden" name="total_duration" id="total_duration" value="">		
					<input type="hidden" name="total_cycle" id="total_cycle" value="<?php echo $row->cl_cycle;?>">					  
 

					<div class="form-group col-xs-7">
						<label>Class Date</label>
						<div class="input-group date" id="datetimepicker1">
							<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
							<input type="text" class="form-control disabledthis blackColor" name="record_date" readonly />
							
                                 <div class="step_box step_1 hidden" style="margin-top:65px;">
<div class="triangle-up"></div>
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
							
						</div>
					</div>
<!--
					<div class="form-group ">
						<div class="col-xs-6">
							<label>Start Time</label>
							<div class="input-group clockpicker" data-autoclose="true">
								<input type="text" class="form-control" placeholder="02:30 pm" id="st_time" name="record_start_time">
							</div>
						</div>
						<div class="col-xs-6">
							<label>End Time</label>
							<div class="input-group clockpicker" data-autoclose="true" data-placement="bottom" data-align="right">
								<input type="text" class="form-control" placeholder="05:30 pm" id="en_time" name="record_end_time">
							</div>
						</div>
					</div>
-->
<div class="clearfix"></div>
  <div class="form-group col-xs-6">
    <label class="col-sm-1">Start Time</label>
    <div class="col-md-6">
							<!--<div class="input-group">
								<input type="text" class="form-control disabledthis blackColor" data-field="time" data-format="hh:mm AA" readonly placeholder="02:30 PM" id="st_time" name="record_start_time">-->
							<div class="input-group clockpicker" data-autoclose="true" data-placement="bottom" data-align="left">
								<input type="text" class="form-control disabledthis blackColor" placeholder="02:30 PM" id="st_time" name="record_start_time" readonly autocomplete="off" >

                                 <div class="step_box step_2 hidden" style="margin-top:65px;">
<div class="triangle-up"></div>
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
							</div>
    </div>
  </div>
  <!--<div class="form-group col-xs-6">
    <label class="col-sm-1">End Time</label>
    <div class="col-md-6">
							<div class="input-group clockpicker" data-autoclose="true" data-placement="bottom" data-align="right">
								<input type="text" class="form-control" placeholder="05:30 pm" id="en_time" name="record_end_time" readonly>
							</div>
    </div>
  </div>
  <div class="form-group col-xs-6">
    <label class="col-sm-1">End Time</label>
    <div class="col-md-6">
							<div class="input-group datetimepicker">
								<input type="text" class="form-control" placeholder="05:30 pm" id="en_time" name="record_end_time" readonly="true">
							</div>
    </div>
  </div>-->
  <div class="form-group col-xs-6">
    <label class="col-sm-1">End Time</label>
    <div class="col-md-6">
							<div class="input-group clockpicker" data-autoclose="true" data-placement="bottom" data-align="right">
								<input type="text" class="form-control disabledthis blackColor" placeholder="05:30 PM" id="en_time" name="record_end_time" readonly autocomplete="off" >
								
								
                                 <div class="step_box step_3 hidden" style="margin-top:65px;margin-left:55px;">
<div class="triangle-up2"></div>
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
							</div><div id="dtBox"></div>
    </div>
  </div>
  
					<div class="clearfix"></div>

					<div class="form-group col-xs-7">
						<label style="margin-top:10px;">Duration</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
							<input disabled type="text" class="form-control blackColor" id="duration2" value="2 hours"/>
							<!--<p id="durationmobile"></p>-->
						</div>
					</div>

					<div class="form-group">							
						<div class="col-xs-12">
							<label>Remarks</label>
							
							<div class="input-group">
                                 <div class="step_box step_4 hidden" style="margin-top:-195px">
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
                                    </div><div class="triangle-bottom"></div>
                                 </div>
							</div>
							<textarea class="form-control blackColor" name="record_remark" rows="6" placeholder="Fill in your remarks here"></textarea>
						</div>
					</div>
					
					<div class="clearfix"></div>	 
					<div class="form-group col-sm-6">
						<div style="margin-top:10px;">
							<!--<button class="save"><?php echo BUTTON_SAVE; ?></button>-->
							<a href="my-classes.php" class="btn btn-default"><span class="glyphicon glyphicon-hand-left"></span> &nbsp;&nbsp;<?php echo "Back"; ?></a>
							<button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;<?php echo BUTTON_SAVE; ?></button>
							
                                       <div class="input-group">
                                       <div class="step_box step_5 hidden" style="margin-top:-195px;margin-left:55px;">
                                          <div class="step_head">
                                             <?php echo TOOLTIP_STEP6_TITLE; ?>
                        
                                          </div>
                                          <div class="step_text bordercolor">
                                             <p><?php echo TOOLTIP_STEP6_DESCRIPTION; ?></p>
                                             <p class="text-center"><a href="#" class="gobtn" onClick="disabled()"><?php echo TOOLTIP_STEP6_BUTTON; ?></a></p>
                                             <div class="checkbox">
                                                <label>
                                                <input type="checkbox"> <?php echo TOOLTIP_STEP6_CHECKBOX_LABEL; ?>
                                                </label>
                                             </div>
                                          </div><div class="triangle-bottom"></div>
                                       </div>
                                       </div>
						</div>
					</div>
								 
				</form>    
			</div>
         </div>
         <?php }else{ ?> 
         <div class="col-md-12">
			<div class="row">
               <div class="col-md-4"><strong><?php echo 'Student';//echo STUDENT_NAME; ?> :</strong> <?php echo $row->cl_student;?></div>
               <div class="col-md-4"><strong><?php echo 'Rate'; ?> :</strong> <?php echo $row->cl_rate;?></div>
               <div class="col-md-4"><strong><?php echo STATUS; ?> : <?php echo $status[$row->cl_status];?></strong></div>
               <div class="col-md-4"><strong><?php echo SUBJECT; ?> :</strong> <?php echo $row->cl_subject;?></div>
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
               <div class="col-md-4"><strong><?php echo ONE_CYCLE; ?> :</strong> <?php echo intval($row->cl_cycle);?> hours</div>
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
			</div>
            <div class="row" style="margin-bottom:6px;">
               <div class="col-md-2 col-sm-3 col-xs-12 posRelative">
				  <a href="my-classes.php" class="btn btn-default"><span class="glyphicon glyphicon-hand-left"></span> &nbsp;&nbsp;<?php echo "Back"; ?></a>
				  <?php if(!isset($_GET['action']) || $_GET['action'] != 'add_record') { 
				  ?>
				  
                  <div class="step_box view_step_1 hidden" style="margin-top:-240px;margin-left:40px;">
                     <div class="step_head">
                        <?php echo TOOLTIP_STEP1_TITLE; ?>
                
                     </div>
                     <div class="step_text bordercolor">
                        <p><?php echo TOOLTIP_STEP1_DESCRIPTION; ?></p>
                        <p class="text-center"><a href="#" class="gobtn" onclick="close()"><?php if(isset($_GET['action']) && $_GET['action'] == 'add_record') {echo TOOLTIP_STEP1_BUTTON; echo'>';}else{echo TOOLTIP_VIEW;} ?> </a></p>
                        <div class="checkbox">
                           <label>
                           <input type="checkbox"> <?php echo TOOLTIP_STEP1_CHECKBOX_LABEL; ?>
                           </label>
                        </div>
                     </div><div class="triangle-bottom"></div>
                  </div>
					<a href="<?php echo basename($_SERVER['PHP_SELF']).'?action=add_record&c_id='.$row->cl_id; ?>" class="btn btn-success btn-sm <?PHP echo $disableAdd; ?>" <?PHP echo $disableAdd2; ?> role="button"><span class="glyphicon glyphicon-plus"></span> <?php echo ADD_RECORD; ?></a>
				  <?php
				  }?>
               </div>
            </div>
			<div class="row">
			
			

			<?php 
			$record_status = array(
				'done' => '<strong class="green-txt">Correct</strong>', 
			'notdone'  => '<strong class="red-txt">Incorrect</strong>');

			if(count($record_arr) > 0) {
				foreach ($record_arr as $key => $record_row) {                           
			?>			
				<div class="container">
					<div class="panel panel-default">

						<div class="col-lg-12">
							<div class="form-horizontal">

                                <div class="row">
                                    <div class="col-xs-4">
                                        <?PHP
            						        if( $record_row->cr_status == 'Tutor Paid' ){
                                                    $thisHour = '';
                                                    $GetHour = " SELECT cr_cl_id, row_no, cr_date, cr_start_time, cr_id, cr_cycle FROM tk_classes_record WHERE cr_cl_id = '".$record_row->cr_cl_id."' AND row_no = '".$record_row->row_no."' ORDER BY cr_date ASC, cr_start_time ASC, cr_id ASC ";
                                                    $reGetHour = $conn->query($GetHour);
                                                    if ($reGetHour->num_rows > 0) {
                                                        $roGetHour = $reGetHour->fetch_assoc();
                                                        $thisHour = $roGetHour['cr_cycle'];
                                                    }
                                                    
            						            echo '<small style="font-size: 10px;">Cycle #'.$record_row->row_no.'<br/><b>Total : '.$thisHour.' hours</b></small>';
            						        }
            						        else if( $record_row->cr_status == 'Required Parent To Pay' ){
            						            //echo '<small style="font-size: 10px;">Cycle #'.($record_row->row_no+1).'</small>';
            						            echo '<small style="font-size: 10px;">Cycle #'.$record_row->row_no.'</small>';
            						        }else{
            						            echo '<small style="font-size: 10px;">Cycle #'.$record_row->row_no.'</small>';
            						        }
        						        ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <p class="text-center"><?php echo date("d/m/Y", strtotime($record_row->cr_date)); ?></p>
                                    </div>
                                    <div class="col-xs-4">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p class="text-center"><?php 
                                        if (strpos($record_row->cr_start_time, 'PM') !== false) {
                                            echo str_replace("PM"," PM",$record_row->cr_start_time);
                                        } else {
                                            echo str_replace("AM"," AM",$record_row->cr_start_time);
                                        }
                                        //echo $record_row->cr_start_time;?></p>
                                    </div>
                                    <div class="col-xs-4">
                                         <div class="horizontalline" style="margin-left:-0px;margin-right:-0px;"></div>
                                    </div>
                                    <div class="col-xs-4">
                                        <p class="text-center"><?php 
                                        if (strpos($record_row->cr_end_time, 'PM') !== false) {
                                            echo str_replace("PM"," PM",$record_row->cr_end_time);
                                        } else {
                                            echo str_replace("AM"," AM",$record_row->cr_end_time);
                                        }
                                        //echo $record_row->cr_end_time;?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p class="text-center" style="margin-top:-15px;"><a type="button" data-toggle="tooltip" data-placement="right" title="Start Time"><i class="fa fa-info-circle"></i></a></p>
                                    </div>
                                    <div class="col-xs-4">
                                    </div>
                                    <div class="col-xs-4">
                                        <p class="text-center" style="margin-top:-15px;"><a type="button" data-toggle="tooltip" data-placement="right" title="End Time"><i class="fa fa-info-circle"></i></a></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                    </div>
                                    <div class="col-xs-8">
                                        <p class="text-center panel panel-primary"><?php echo $record_row->cr_duration;?> <a type="button" data-toggle="tooltip" data-placement="right" title="Class Duration"><i class="fa fa-info-circle icon-background"></i></a></p>
                                    </div>
                                    <div class="col-xs-2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2">
                                    </div>
                                    <div class="col-xs-8">
									    <button type="button" class="btn btn-primary col-xs-12" data-toggle="collapse" data-target="#<?php echo $record_row->cr_id;?>">Remarks &nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i></button>
                                    </div>
                                    <div class="col-xs-2">
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-xs-12">
									    <div id="<?php echo $record_row->cr_id;?>" class="collapse">
										
										<center><textarea rows="5" style="width:100%;margin-left:0px;right:0px;"><?php echo $record_row->cr_tutor_report;?></textarea><center/>
										<div class="form-group">
											<div class="col-xs-12">
												FOR PARENTS USE ONLY :
											</div>
											<div class="col-xs-12">
												<div class="checkbox"><label><input type="checkbox" <?php if($record_row->cr_parent_verification == 'done'){ echo 'checked';} ?> disabled>Yes, record is correct</label></div>
												<div class="checkbox"><label><input type="checkbox" <?php if($record_row->cr_parent_verification == 'notdone'){ echo 'checked';} ?> disabled>No, record is incorrect</label></div>
											</div>
											<br/><br/>
										</div>
                                        <center><textarea rows="5" style="width:100%;margin-left:0px;right:0px;"><?php echo $record_row->cr_parent_remark;?></textarea><center/>
											
									    </div>
                                    </div>
                                </div>
<!--  
								<div class="form-group">
									<div class="col-xs-6 col-xs-offset-4">
										<?php echo date("d/m/Y", strtotime($record_row->cr_date)); ?>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-4">
										<?php echo $record_row->cr_start_time;?>
									</div>
									<div class="col-xs-4">
										<div class="horizontalline" style="margin-left:-0px;margin-right:-0px;"></div>
									</div>
									<div class="col-xs-4">
										<?php echo $record_row->cr_end_time;?>
									</div>
								</div>  
								<div class="form-group">
									<div class="col-xs-8 col-xs-offset-3">
										<?php echo $record_row->cr_duration;?>
									</div>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-primary col-xs-6 col-xs-offset-3" data-toggle="collapse" data-target="#<?php echo $record_row->cr_id;?>">Remarks &nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i></button>
									<div id="<?php echo $record_row->cr_id;?>" class="collapse">
										<br/><br/>
										<center><textarea rows="5" style="width:80%;margin-left:0px;right:0px;"><?php echo $record_row->cr_tutor_report;?></textarea><center/>
							
										<div class="form-group">
											<div class="col-xs-12">
												FOR PARENTS USE ONLY :
											</div>
											<div class="col-xs-12">
												<div class="checkbox"><label><input type="checkbox" <?php if($record_row->cr_parent_verification == 'done'){ echo 'checked';} ?> disabled>Yes, record is correct</label></div>
												<div class="checkbox"><label><input type="checkbox" <?php if($record_row->cr_parent_verification == 'notdone'){ echo 'checked';} ?> disabled>No, record is incorrect</label></div>
											</div>
											<br/><br/>
											<center><textarea rows="5" style="width:80%;margin-left:0px;right:0px;"><?php echo $record_row->cr_parent_remark;?></textarea><center/>
										</div>
											
											
									</div>
								</div>	


								

								
  -->				 
							</div>
						</div>

					</div>
				</div>
			<?php 
				}
			} else { 
			?>
				<div class="container">
					<div class="panel panel-default">
						<b><?php echo NO_RECORDS_FOUND; ?> </b>
					</div>
				</div>
			<?php } ?>
						
						
			
			
               <!--<div class="col-md-12 job-table">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center" style="background:#fff;" id="dataTables_cl">
                     <thead>
                        <tr class="blue-bg">
                           <td width="20%"><?php echo "Class Date";//DATE; ?></td>
                           <td width="10%"><?php echo "Start Time";//TIME_START; ?></td>
                           <td width="10%"><?php echo "End Time";//TIME_END; ?></td>
                           <td width="10%"><?php echo DURATION; ?></td>
                           <td width="15%"><?php echo TUTOR_REPORT; ?></td>
                           <td width="15%"><?php echo PARENT_VERIFICATION; ?></td>
                           <td width="20%"><?php echo PARENT_REMARKS; ?></td>
                        </tr>
                     </thead>
                     <tbody>                       
                        <?php 
                        $record_status = array(
                           'done' => '<strong class="green-txt">Done</strong>', 
                           'notdone'  => '<strong class="red-txt">Not done</strong>');

                        if(count($record_arr) > 0) {
                           foreach ($record_arr as $key => $record_row) {                           
                        ?>
                        <tr>
                           <td><?php echo date("d/m/Y", strtotime($record_row->cr_date)); ?></td>
                           <td><?php echo $record_row->cr_start_time;?></td>
                           <td><?php echo $record_row->cr_end_time;?></td>
                           <td><?php echo $record_row->cr_duration;?></td>
                           <td><?php echo $record_row->cr_tutor_report;?></td>
                           <td><?php echo ($record_row->cr_parent_verification != '') ? $record_status[$record_row->cr_parent_verification] : '';?></td>
                           <td><?php echo $record_row->cr_parent_remark;?></td>
                        </tr>
                        <?php 
                           }
                        } else { 
                        ?>
                        <tr>
                           <td colspan="7"><?php echo NO_RECORDS_FOUND; ?></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>-->
			</div>
         </div>
		 <?php } ?>
		 
<button data-backdrop="static" data-keyboard="false" type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#tourGuideModal" id="openModal">Open Modal</button>
<!-- Modal -->
<div class="modal fade-scale" id="tourGuideModal" tabindex="-1" role="dialog" aria-labelledby="tourGuideModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

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
	  echo '<script type="text/javascript">$(document).ready(function () { $(".step_box.view_step_1").removeClass("hidden").addClass("show"); });</script>';
   }
}
?>
<script type="text/javascript">
function myFunction() {
	$(".delete").trigger("click");
	$('.step_box.step_1').removeClass('hidden').addClass('show');
}

      $('.step_box.view_step_1 a.gobtn').click(function(){
         $('.step_box').removeClass('show').addClass('hidden');
         return false;
      });
</script>

<?php //include('includes/footer.php');?>

<!-- fadhli datetimepicker  -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            /*$(function () {
                $('#en_time').datetimepicker({
                    format: 'LT', 
					ignoreReadonly: true, 
					allowInputToggle: true
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
         
         $('#duration').html(duration);
		 if(start_time != '' && end_time != ''){
			$('#duration2').val(duration);
			$('#total_duration').val(duration);
			document.getElementById("durationmobile").innerHTML = duration.replace("&", "& <br/>");
		 }
      });
	  //fadhli datetimepicker
      $('#en_time').on('blur', function(){
         var start_time = $('#st_time').val();
         var end_time   = $('#en_time').val();

         var duration = calculateTime(start_time, end_time);
         
         $('#duration').html(duration);
		 if(start_time != '' && end_time != ''){
			$('#duration2').val(duration);
			$('#total_duration').val(duration);
			document.getElementById("durationmobile").innerHTML = duration.replace("&", "& <br/>");
		 }
      });
	  
/*
      $('.clockpicker').clockpicker({
         twelvehour: true,
         // autoclose: true
		 autoclose: false,
		 donetext: 'Done'
		 
      });*/
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
   }
});
	  
	  
	  

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

      $('#tourGuideModal .buttons button.save').click(function(){
         $("#tourGuideModal").modal("hide");
         $('.step_box.step_1').removeClass('hidden').addClass('show');
         $('#hider').show();
         return false;
      });

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
            null,
            { "orderable": false },
            { "orderable": false },
            { "orderable": false }, 
            { "orderable": false }, 
            { "orderable": false }, 
            { "orderable": false }            
         ],
         "order": [[ 1, "desc" ]]
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
               //$('#hours_balance_new').html(response);
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
</script>
<script>
$("[data-toggle=tooltip").tooltip();
</script>

