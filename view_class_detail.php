<?php 
require_once('includes/head.php');
require_once('mobile-detect/mobile-detect.php');
# SESSION CHECK #
$_SESSION['url'] = 'https://www.tutorkami.com/view_class_detail?action=verify_record&c_id='.$_GET['c_id'];
if (!isset($_SESSION['auth'])) {
  header('Location: client_login.php');
  exit();
}
if ($_SESSION['auth']['user_role'] != '4') {
   header('Location:tutor_view_class_detail.php');
   exit();
}
if (count($_POST) > 0) {
   $data = $_POST;
   // var_dump($data);exit();
   $output = system::FireCurl(VERIFY_RECORD_URL, "PUT", "JSON", $data);
   Session::SetFlushMsg($output->flag, $output->message);
   if ($output->flag == 'success') {
      header('Location: ' . basename($_SERVER['PHP_SELF']).'?c_id='.$_POST['class_id']);
      exit();
   }
  
}
$output = system::FireCurl(PARENT_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']."&cid=". $_GET['c_id']);
$classes = $output->data;

/*
$row = $classes[0];
$status = array(
   'ongoing' => '<span class="green-txt">Ongoing</span>', 
   'onhold'  => '<span class="org-txt"><strong>On hold</strong></span>', 
   'ended'   => '<span><strong>Ended</strong></span>');

$record = system::FireCurl(CLASS_RECORDS_URL ."?student_id=". $_SESSION['auth']['user_id']."&cid=". $_GET['c_id']);
$record_arr = $record->data;
*/
//include('includes/headernonmobile.php');
include('includes/header.php');
?>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<style>
#myModalShowText .modal-dialog {
    -webkit-transform: translate(0,-50%);
    -o-transform: translate(0,-50%);
    transform: translate(0,-50%);
    top: 45%;
    margin: 0 auto;
}
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color: black;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color: black;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    color: black;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: black;
}
input:focus { 
    outline: none !important;
    border-color: none !important;
    box-shadow: none !important;
}
textarea:focus { 
    outline: none !important;
    border-color: none !important;
    box-shadow: none !important;
}
</style>

    <link rel="stylesheet" type="text/css" href="css/responsive-tabs/css/easy-responsive-tabs.css " />
    <script src="css/responsive-tabs/js/easyResponsiveTabs.js"></script>

<section class="class-id">
   <div class="main-body">
       
<?php
/*
   if($row->u_displayname == 'fadhli'){
    require_once('add-classes-mobile-parent.php');
    exit();
   }
  */ 
$row = $classes[0];
$status = array(
   'ongoing' => '<span class="green-txt">Ongoing</span>', 
   'onhold'  => '<span class="org-txt"><strong>On hold</strong></span>', 
   'ended'   => '<span><strong>Ended</strong></span>');
   
$studentName = '';
$ListJob = " SELECT j_id, student_name FROM tk_job where j_id = '".$row->cl_display_id."' ";
$resultListJob = $conn->query($ListJob);
if ($resultListJob->num_rows > 0) {
    $rowListJob = $resultListJob->fetch_assoc();
    $studentName = $rowListJob['student_name'];
                                       
}

$record = system::FireCurl(CLASS_RECORDS_URL ."?student_id=". $_SESSION['auth']['user_id']."&cid=". $_GET['c_id']);
$record_arr = $record->data;

if ($tablet_browser > 0 || $mobile_browser > 0) {
   ?>
<style>
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
.custombtn {
    width: 78px !important;
	height: 30px;
}
.font-size {
    font-size: 16px;
}

.alignleft {
    float: left;
    text-align:left;
    width:33.33333%;
}
.aligncenter {
    float: left;
    text-align:center;
    width:33.33333%;
}
.alignright {
    float: left;
    text-align:right;
    width:33.33333%;
}
  .btnCollapsible:after {
    font-family: "Glyphicons Halflings";
    content:"\e027";
    margin-left: 15px;
  }
  .btnCollapsible.collapsed:after {
    content:"\e026";
  }
</style>

      <div class="container">
         <div class="col-md-12">
            <h3 class="text-left text-uppercase org-txt"><strong><?php echo 'CLASS ID'; //echo JOB_ID; ?> : <?php echo $row->cl_display_id;?></strong></h3>
            <hr>
            <div class="row">
               <div class="col-md-4">
                   <h4 class="text-left">
                       <a href="list_of_classes.php" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-hand-left"></span> &nbsp;&nbsp;<?php echo "Back"; ?></a>
                    </h4>
               </div>
            </div>
            
            <div id="section">
                <ul class="resp-tabs-list hor_1">
                    <li>Class info</li>
                    <li>Not sure what to do? Click here</li>
                </ul>
                <div class="resp-tabs-container hor_1">
                    <div>
                                    <div class="row">
                                       <div class="col-md-4"><strong><?php echo STUDENT_NAME; ?> :</strong> <?php echo $studentName;//$_SESSION['auth']['display_name'];?></div>
                                       <div class="col-md-4"><strong><?php echo RATE; ?> :</strong> RM<?php echo $row->parent_rate;?> per hour</div>
                                       <div class="col-md-4"><strong><?php echo STATUS; ?> : <?php echo $status[$row->cl_status];?></strong></div>
                                       <div class="col-md-4"><strong><?php echo SUBJECT; ?> :</strong> <?php echo $row->cl_subject;?></div>
                                       <!--<div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> :</strong> <?php echo $row->cl_hours_balance;?> <?php echo HOURS; ?></div>-->
                                       
                                       <input type="hidden" id="hr_balance" name="hr_balance" value="<?php echo $row->cl_hours_balance;?>">
                                       <div class="col-md-4"><strong><?php echo 'Current cycle'; ?> : </strong><span>
                                        <?PHP
                                        $i = 0;
                                        $len = count($record_arr);
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
                                        ?>
                                       </span></div>
                                       <div class="col-md-4"><strong><?php echo ONE_CYCLE; ?> :</strong> <?php echo intval($row->cl_cycle);?> <?php echo HOURS; ?></div>
                                       <div class="col-md-4"><strong><?php echo TUTOR_NAME; ?> :</strong> <a href="https://www.tutorkami.com/tutor_profile?did=<?php echo $row->u_displayid;?>" target="_blank" style="text-decoration: none;color:blue"><?php if( $row->resit_pv_name != '' ){ echo $row->resit_pv_name; }else{ echo $row->u_displayname; } ?></a></div>
                                       
                                       <?PHP
                                        $QRequired = " SELECT cr_cl_id, cr_date, cr_start_time, cr_status, row_no FROM tk_classes_record where cr_cl_id = '".$_GET['c_id']."' ORDER BY cr_date DESC, cr_start_time DESC ";
                                        $reQRequired = $conn->query($QRequired);
                                        if ($reQRequired->num_rows > 0) {
                                            $roQRequired = $reQRequired->fetch_assoc();
                                            if( $roQRequired['cr_status'] == 'Required Parent To Pay' ){
                                                ?><div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong><span>Please make payment for cycle #<?PHP echo ($roQRequired['row_no']+1); ?></span></div><?PHP
                                            }else{
                                                ?><div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong><span id="hours_balance_new"></span></div><?PHP
                                            }
                                        }else{
                                            ?><div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong><span id="hours_balance_new"></span></div><?PHP
                                        }
                                       ?>
                                    </div>
                    </div>
                    <div>
                        <span>Each row is a record submitted by the tutor for the time & date of each class completed.</span>
                        <br><br>
                        <span>Please verify the record by choosing ‘Yes, record is correct ‘ or ‘No, record is incorrect’ . You can then insert any remarks to tutor/us if you want. Then click ‘Submit’</span>
                        <br><br>
                        <span class="red-txt" >Note: </span> <span>The record will be automatically set to ‘Yes, record is correct’ if you did not verify it within 48 hours of the tutor's submission.</span>
                    </div>
                </div>
            </div>     
            
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-md-4">
                   <h5 class="text-left">
                       <strong> Please click &nbsp;<a type="button" class="btn btn-primary btn-xs">Remarks &nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i></a>&nbsp; to verify record(s) or to read/insert any remarks</strong>
                       <br/><br/><strong>Please verify the record for row(s) with <img border="0"  src="images/verified.png" width="20" height="20"> symbol</strong>
                    </h5>
               </div>
            </div>
            
                        
                                    <div class="job-table">
                        
                                             <?php 
                                             $record_status = array(
                                                'done' => '<strong class="green-txt">Correct</strong>', 
                                                'notdone'  => '<strong class="red-txt">Incorrect</strong>');
                        
                                             if(count($record_arr) > 0) {
                                                foreach ($record_arr as $key => $record_row) {                           
                                             ?>
                            
                                                <form action="" method="post">
                                                   <input type="hidden" name="class_id" value="<?php echo (isset($_GET['c_id']) && $_GET['c_id'] != '') ? $_GET['c_id'] : ''; ?>">
                                                   <input type="hidden" name="class_record_id" value="<?php echo $record_row->cr_id;?>">
                        				<div class="container">
                        					<div class="panel panel-default">
                        
                        						<div class="col-lg-12">
                        							<div class="form-horizontal">
                        
                                                        <div class="row">
                                                            <!--<div class="col-xs-4"></div>-->
                                                            <div class="col-xs-12">
                                                                <?php 
                                                                    if($record_row->cr_parent_verification == '' || $record_row->cr_parent_verification == NULL) { 
                                                                        ?>
                                                                        <p class="text-center font-size">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("d/m/y", strtotime($record_row->cr_date)); ?> 
                                                                            <img src="images/verified.png" style="margin-top:6px;" width="20" height="20" class="pull-right">
                                                                            <?php 
                                                						        if( $record_row->cr_status == 'Required Parent To Pay' ){
                                                						            //echo '<br/>(Cycle #'.($record_row->row_no+1).')'; 
                                                						            echo '<br/>(Cycle #'.$record_row->row_no.')'; 
                                                						        }else{
                                                						            echo '<br/>(Cycle #'.$record_row->row_no.')'; 
                                                						        }
                                                                            ?> 
                                                                        </p>
                                                                        <?PHP
                                                                    }else{
                                        						        if( $record_row->cr_status == 'Tutor Paid' ){
                                                                                $thisHour = '';
                                                                                $GetHour = " SELECT cr_cl_id, row_no, cr_date, cr_start_time, cr_id, cr_cycle FROM tk_classes_record WHERE cr_cl_id = '".$record_row->cr_cl_id."' AND row_no = '".$record_row->row_no."' ORDER BY cr_date ASC, cr_start_time ASC, cr_id ASC ";
                                                                                $reGetHour = $conn->query($GetHour);
                                                                                if ($reGetHour->num_rows > 0) {
                                                                                    $roGetHour = $reGetHour->fetch_assoc();
                                                                                    $thisHour = $roGetHour['cr_cycle'];
                                                                                }
                                                                                
                                        						            ?><p class="text-center font-size"><?php echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')<br/><b>Total : '.$thisHour.' hours</b>'; ?></p><?PHP
                                        						        }
                                        						        else if( $record_row->cr_status == 'Required Parent To Pay' ){
                                        						            ?><p class="text-center font-size"><?php echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')'; //echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.($record_row->row_no+1).')'; ?></p><?PHP
                                        						        }else{
                                        						            ?><p class="text-center font-size"><?php echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')'; ?></p><?PHP
                                        						        }
                                                                    }
                                                                ?>
                                                            </div>
                                                            <!--<div class="col-xs-4"></div>-->
                                                        </div>
                                                        <div class="row">
                                                            <!--<div class="col-xs-4">
                                                                <p class="text-center font-size"><?php 
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
                                                                <p class="text-center font-size"><?php 
                                                                if (strpos($record_row->cr_end_time, 'PM') !== false) {
                                                                    echo str_replace("PM"," PM",$record_row->cr_end_time);
                                                                } else {
                                                                    echo str_replace("AM"," AM",$record_row->cr_end_time);
                                                                }
                                                                //echo $record_row->cr_end_time;?></p>
                                                            </div>-->
                                                            <div class="col-xs-12">
                                                                <p class="alignleft font-size">
                                                                <?php 
                                                                if (strpos($record_row->cr_start_time, 'PM') !== false) {
                                                                    echo str_replace("PM"," PM",$record_row->cr_start_time);
                                                                } else {
                                                                    echo str_replace("AM"," AM",$record_row->cr_start_time);
                                                                }?>
                                                                </p>
                                                                <p class="aligncenter font-size horizontalline"></p>
                                                                <p class="alignright font-size">
                                                                <?php 
                                                                if (strpos($record_row->cr_end_time, 'PM') !== false) {
                                                                    echo str_replace("PM"," PM",$record_row->cr_end_time);
                                                                } else {
                                                                    echo str_replace("AM"," AM",$record_row->cr_end_time);
                                                                }?>
                                                                </p>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-4">
                                                                <p class="text-center" style="margin-top:-10px;"><a type="button" data-toggle="tooltip" data-placement="right" title="Start Time"><i class="fa fa-info-circle"></i></a></p>
                                                            </div>
                                                            <div class="col-xs-4">
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <p class="text-center" style="margin-top:-10px;"><a type="button" data-toggle="tooltip" data-placement="right" title="End Time"><i class="fa fa-info-circle"></i></a></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-1"></div>
                                                            <div class="col-xs-10">
                                                                <p class="text-center panel panel-primary font-size"><?php echo $record_row->cr_duration;?> <a type="button" data-toggle="tooltip" data-placement="right" title="Class Duration"><i class="fa fa-info-circle icon-background"></i></a></p>
                                                            </div>
                                                            <div class="col-xs-1"></div>
                                                            <!--<div class="col-xs-12">
                                                                <p class="text-center panel panel-primary"><?php echo $record_row->cr_duration;?> <a type="button" data-toggle="tooltip" data-placement="right" title="Class Duration"><i class="fa fa-info-circle icon-background"></i></a></p
                                                            </div>-->
                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-1">
                                                            </div>
                                                            <div class="col-xs-10">
                        									    <!--<button type="button" class="btn btn-primary col-xs-12" data-toggle="collapse" data-target="#<?php echo $record_row->cr_id;?>">Remarks &nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i></button>-->
                        									    <button type="button" class="btn btn-primary col-xs-12 btnCollapsible collapsed" data-toggle="collapse" data-target="#<?php echo $record_row->cr_id;?>">Remarks</button>
                                                            </div>
                                                            <div class="col-xs-1">
                                                            </div>
                                                        </div><br/>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                        									    <div id="<?php echo $record_row->cr_id;?>" class="collapse">
                        										<center><b>TUTOR’S REMARKS</b></center>
                        										<center><textarea disabled rows="5" style="width:100%;margin-left:0px;right:0px;"><?php echo $record_row->cr_tutor_report;?></textarea><center/>
                        										<div class="form-group">
                        											<div class="col-xs-12">
                        												<b>CLIENT’S SECTION</b>
                        											</div>
                        											<div class="col-xs-12">
                        
                                                      <?php if($record_row->cr_parent_verification == '') { ?>
                                                      <div class="radio mrg_top0">
                                                         <label>
                                                         <input type="radio" name="parent_verification_<?php echo $key; ?>" id="optionsRadios_<?php echo $key; ?>_1" value="done" checked>
                                                         <?php echo YES_REPORT_IS_CORRECT; ?>
                                                         </label>
                                                      </div>
                                                      <div class="radio mrg_top0">
                                                         <label>
                                                         <input type="radio" name="parent_verification_<?php echo $key; ?>" id="optionsRadios_<?php echo $key; ?>_2" value="notdone">
                                                         <?php echo NO_REPORT_IS_NOT_CORRECT; ?>
                                                         </label>
                                                      </div>
                                                      <?php 
                                                      } else { 
                                                         echo $record_status[$record_row->cr_parent_verification];
                                                      } 
                        							  ?>
                        											</div>
                        											<br/><br/>
                        										</div>
                                                                <center>
                        										<!--<textarea rows="5" style="width:100%;margin-left:0px;right:0px;"><?php echo $record_row->cr_parent_remark;?></textarea>-->
                                                      <?php if($record_row->cr_parent_verification == '') { ?>
                                                  
                        								 <textarea rows="5" style="width:100%;margin-left:0px;right:0px;" id="description_<?php echo $key; ?>" name="parent_remark_<?php echo $key; ?>" placeholder="<?php echo 'Type your remarks here (optional)'; //echo PARENT_REMARK_PLACEHOLDER; ?>" ></textarea>
                                                      
                                                      <br>
                                                      <button type="button" onclick="clearTextarea(<?php echo $key; ?>);" style="height:41px;margin-top:-5px;" class="btn btn-secondary btn-sm custombtn"><font size='3'>Clear</font></button>
                        
                                                      <button type="submit" style="height:41px;margin-top:-5px;" class="btn btn-primary btn-sm custombtn apply custombtn"><font size='3'>Submit</font></button>
                        							  <br><br>
                                                      <?php 
                                                      } else { 
                        								 ?><textarea disabled rows="5" style="width:100%;margin-left:0px;right:0px;"> <?php echo $record_row->cr_parent_remark; ?></textarea><?php 
                                                      } 
                                                      ?>
                        										
                        										<center/>
                        											
                        									    </div>
                                                            </div>
                                                        </div>
                        								
                        							</div>
                        						</div>
                        
                        					</div>
                        				</div>
                                                </form>
                                                <!--<form action="" method="post">
                                                   <input type="hidden" name="class_id" value="<?php echo (isset($_GET['c_id']) && $_GET['c_id'] != '') ? $_GET['c_id'] : ''; ?>">
                                                   <input type="hidden" name="class_record_id" value="<?php echo $record_row->cr_id;?>">
                                                   <td><?php echo $record_row->cr_date;?></td>
                        						   <td><?php echo date("d/m/Y", strtotime($record_row->cr_date));?></td>
                                                   <td><?php echo $record_row->cr_start_time;?></td>
                                                   <td><?php echo $record_row->cr_end_time;?></td>
                                                   <td><?php echo $record_row->cr_duration;?></td>
                                                   <td><strong><?php echo $record_row->cr_tutor_report;?></strong></td>
                                                   <td>
                                                      <?php if($record_row->cr_parent_verification == '') { ?>
                                                      <div class="radio mrg_top0">
                                                         <label>
                                                         <input type="radio" name="parent_verification_<?php echo $key; ?>" id="optionsRadios_<?php echo $key; ?>_1" value="done" checked>
                                                         <?php echo YES_REPORT_IS_CORRECT; ?>
                                                         </label>
                                                      </div>
                                                      <div class="radio mrg_top0">
                                                         <label>
                                                         <input type="radio" name="parent_verification_<?php echo $key; ?>" id="optionsRadios_<?php echo $key; ?>_2" value="notdone">
                                                         <?php echo NO_REPORT_IS_NOT_CORRECT; ?>
                                                         </label>
                                                      </div>
                                                      <?php 
                                                      } else { 
                                                         echo $record_status[$record_row->cr_parent_verification];
                                                      } 
                                                      ?>
                                                   </td>
                                                   <td>
                                                      <?php if($record_row->cr_parent_verification == '') { ?>
                                                      <div class="form-group">
                                                         <textarea  class="form-control" id="description_<?php echo $key; ?>" name="parent_remark_<?php echo $key; ?>" placeholder="<?php echo PARENT_REMARK_PLACEHOLDER; ?>"></textarea>
                                                      </div>
                                                      <br>
                                                      <button type="submit" class="apply text-uppercase"><?php echo BUTTON_SAVE; ?></button>
                                                      <?php 
                                                      } else { 
                                                         echo $record_row->cr_parent_remark;
                                                      } 
                                                      ?>
                                                   </td>
                                                </form>-->
                                            
                                             <?php 
                                                }
                                             } else { 
                                             ?>
                        				<div class="container">
                        					<div class="panel panel-default">
                        						<?php echo 'Class has not started yet and/or Tutor has not inserted any record yet'; //echo NO_RECORDS_FOUND; ?> 
                        					</div>
                        				</div>
                                   
                                             <?php } ?>
                            
                                    </div>
            
         </div>
      </div>



   

        
        <script>
        $(document).ready(function() {
                $('#section').easyResponsiveTabs({
                    type: 'default', //Types: default, vertical, accordion
                    width: 'auto', //auto or any width like 600px
                    closed: true,
                    fit: true, // 100% fit in a container
                    tabidentify: 'hor_1', // The tab groups identifier
                    activate: function(event) { // Callback function if tab is switched
        
                        var $tab = $(this);
                        var $info = $('#nested-tabInfo');
                        var $name = $('span', $info);
                        $name.text($tab.text());
                        $info.show();
                        //alert($tab.text());
                    }
                });
        });
        </script>
<?php include('includes/footer.php');?>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/select2.min.js"></script>
<script>
   $.noConflict();
   jQuery(document).ready(function($){
      
      $('#dataTables_cl').DataTable({
		  order : [[0,"desc"]],
         "columnDefs": [{
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
         }],
         "info":false,
         "searching":false,
         "lengthChange":false,
         "bSort":true,
         "bPaginate":true,
         "sPaginationType":"simple_numbers",
         "iDisplayLength": 10
         /*"columns": [            
            null,
            { "orderable": false },
            { "orderable": false },
            { "orderable": false }, 
            { "orderable": false }, 
            { "orderable": false }, 
            { "orderable": false }            
         ]*/
      });

      $(".clickable-row").click(function() {
           window.location = $(this).data("href");
      });
      
   });
   
                                      
    $(document).ready( function() { 
        var hr_balance = $('#hr_balance').val();
        
        var firstDigit = hr_balance.substring(0, hr_balance.indexOf('.'));
        var pointNum = parseFloat(firstDigit);
        
        var second = hr_balance.split('.').splice(1).join('.')
        //01.20
        var result = pointNum + ' hours & ' + second + ' minutes';
        var result2 = parseFloat(hr_balance) + ' hours & 00 minutes';
        
        if(hr_balance == '-' || hr_balance == '- '){
            $('#hours_balance_new').html('0 hours & 00 minutes');
        }else{
            if(hr_balance.indexOf('.') !== -1){
                $('#hours_balance_new').html(result);
            }else{
                $('#hours_balance_new').html(result2);
             }
        }
        
    }); 
$("[data-toggle=tooltip").tooltip();

function clearTextarea(id) {
	//alert(id);
	document.getElementById('description_'+id).value = "";
}
</script>
   <?PHP
   exit();
}
/*
if ($tablet_browser > 0) {
   //print 'is tablet';
   require_once('add-classes-mobile-parent.php');
   exit();
}
if ($mobile_browser > 0) {
   //print 'is mobile';
   require_once('add-classes-mobile-parent.php');
   exit();
}
*/
?>       
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
      <div class="container">
         <div class="col-md-12">
            <h3 class="text-left text-uppercase org-txt"><strong><?php echo 'CLASS ID'; //echo JOB_ID; ?> : <?php echo $row->cl_display_id;?></strong></h3>
            <hr>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-md-4"><strong><?php echo STUDENT_NAME; ?> :</strong> <?php echo $studentName;//$_SESSION['auth']['display_name'];?></div>
               <div class="col-md-4"><strong><?php echo RATE; ?> :</strong> RM<?php echo $row->parent_rate;?> per hour</div>
               <div class="col-md-4"><strong><?php echo STATUS; ?> : <?php echo $status[$row->cl_status];?></strong></div>
               <div class="col-md-4"><strong><?php echo SUBJECT; ?> :</strong> <?php echo $row->cl_subject;?></div>
               <!--<div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> :</strong> <?php echo $row->cl_hours_balance;?> <?php echo HOURS; ?></div>-->
               <input type="hidden" id="hr_balance" name="hr_balance" value="<?php echo $row->cl_hours_balance;?>">
               <div class="col-md-4"><strong><?php echo 'Current cycle'; ?> : </strong><span>
<?PHP
$i = 0;
$len = count($record_arr);
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
?>
               </span></div>
               <div class="col-md-4"><strong><?php echo ONE_CYCLE; ?> :</strong> <?php echo intval($row->cl_cycle);?> <?php echo HOURS; ?></div>
               <div class="col-md-4"><strong><?php echo TUTOR_NAME; ?> :</strong> <a href="https://www.tutorkami.com/tutor_profile?did=<?php echo $row->u_displayid;?>" target="_blank" style="text-decoration: none;color:blue"><?php if( $row->resit_pv_name != '' ){ echo $row->resit_pv_name; }else{ echo $row->u_displayname; } ?></a></div>
               
               <?PHP
               $QRequired = " SELECT cr_cl_id, cr_date, cr_start_time, cr_status, row_no FROM tk_classes_record where cr_cl_id = '".$_GET['c_id']."' ORDER BY cr_date DESC, cr_start_time DESC ";
               $reQRequired = $conn->query($QRequired);
               if ($reQRequired->num_rows > 0) {
                    $roQRequired = $reQRequired->fetch_assoc();
                    if( $roQRequired['cr_status'] == 'Required Parent To Pay' ){
                        ?><div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong><span>Please make payment for cycle #<?PHP echo ($roQRequired['row_no']+1); ?></span></div><?PHP
                    }else{
                        ?><div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong><span id="hours_balance_new"></span></div><?PHP
                    }
               }else{
                    ?><div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong><span id="hours_balance_new"></span></div><?PHP
               }
               ?>
            </div>
         </div>
         <div class="col-md-12">
            <h3 class="text-left text-uppercase org-txt"><strong>Record &amp; report</strong></h3>
            <h5 class="red-txt"><strong><?php echo VIEW_CLASS_DETAILS_NOTED; ?></strong></h5>
            <div class="job-table">
               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center" style="background:#fff;" id="dataTables_cl">
                  <thead>
                     <tr class="blue-bg">
                        <td width="10%"><?php //echo "cr_date"; ?></td>
                        <td width="10%"><?php echo DATE; ?></td>
                        <td width="7%"><?php echo TIME_START; ?></td>
                        <td width="7%"><?php echo TIME_END; ?></td>
                        <td width="10%"><?php echo DURATION; ?></td>
                        <td width="17%"><?php echo TUTOR_REMARKS; ?></td>
                        <td width="19%"><?php echo 'Client’s verification'; //echo PARENT_VERIFICATION; ?></td>
                        <td width="13%"><?php echo 'Client’s remarks'; //echo PARENT_REMARKS; ?></td>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                     $record_status = array(
                        'done' => '<strong class="green-txt">Correct</strong>', 
                        'notdone'  => '<strong class="red-txt">Incorrect</strong>');

                     if(count($record_arr) > 0) {
                        foreach ($record_arr as $key => $record_row) {                           
                     ?>
                     <tr>
                        <form action="" method="post">
                           <input type="hidden" name="class_id" value="<?php echo (isset($_GET['c_id']) && $_GET['c_id'] != '') ? $_GET['c_id'] : ''; ?>">
                           <input type="hidden" name="class_record_id" value="<?php echo $record_row->cr_id;?>">
                           <td><?php echo $record_row->cr_date;?></td>
						   <td><?php 
						        if( $record_row->cr_status == 'Tutor Paid' ){
                                        $thisHour = '';
                                        $GetHour = " SELECT cr_cl_id, row_no, cr_date, cr_start_time, cr_id, cr_cycle FROM tk_classes_record WHERE cr_cl_id = '".$record_row->cr_cl_id."' AND row_no = '".$record_row->row_no."' ORDER BY cr_date ASC, cr_start_time ASC, cr_id ASC ";
                                        $reGetHour = $conn->query($GetHour);
                                        if ($reGetHour->num_rows > 0) {
                                            $roGetHour = $reGetHour->fetch_assoc();
                                            $thisHour = $roGetHour['cr_cycle'];
                                        }
                                        
						            echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')<br/><b>Total : '.$thisHour.' hours</b>';

						        }else if( $record_row->cr_status == 'Required Parent To Pay' ){
						            //echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.($record_row->row_no+1).')';
						            echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')';
						        }else{
						            echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle #'.$record_row->row_no.')';
						        }
						   ?></td>
                           <td><?php 
                            if (strpos($record_row->cr_start_time, 'PM') !== false) {
                             //echo 'PM';
                             echo str_replace("PM"," PM",$record_row->cr_start_time);
                            } 
                            else {
                             //echo 'AM';
                             echo str_replace("AM"," AM",$record_row->cr_start_time);
                            }
                           //echo $record_row->cr_start_time;?></td>
                           
                           <td><?php 
                            if (strpos($record_row->cr_end_time, 'PM') !== false) {
                             //echo 'PM';
                             echo str_replace("PM"," PM",$record_row->cr_end_time);
                            } 
                            else {
                             //echo 'AM';
                             echo str_replace("AM"," AM",$record_row->cr_end_time);
                            }
                           //echo $record_row->cr_end_time;?></td>
                           <td><?php echo $record_row->cr_duration;?></td>
                           <td><strong><?php 
                                //echo $record_row->cr_tutor_report;
                                 if( $record_row->cr_tutor_report != ''){
                                     if( strlen($record_row->cr_tutor_report) > 30){
                                         echo substr_replace($record_row->cr_tutor_report, ' .. <a style="text-decoration: underline;" href="javascript:showText('.$record_row->cr_id.')">View More</a>', 30);
                                     }else{
                                         echo $record_row->cr_tutor_report;
                                     }
                                     
                                 }else{
                                     echo '';
                                 }
                           ?></strong></td>
                           <td>
                              <?php if($record_row->cr_parent_verification == '') { ?>
                              <div class="radio mrg_top0">
                                 <label>
                                 <input type="radio" name="parent_verification_<?php echo $key; ?>" id="optionsRadios_<?php echo $key; ?>_1" value="done" checked>
                                 <?php echo YES_REPORT_IS_CORRECT; ?>
                                 </label>
                              </div>
                              <div class="radio mrg_top0">
                                 <label>
                                 <input type="radio" name="parent_verification_<?php echo $key; ?>" id="optionsRadios_<?php echo $key; ?>_2" value="notdone">
                                 <?php echo NO_REPORT_IS_NOT_CORRECT; ?>
                                 </label>
                              </div>
                              <?php 
                              } else { 
                                 echo $record_status[$record_row->cr_parent_verification];
                              } 
                              ?>
                           </td>
                           <td>
                              <?php if($record_row->cr_parent_verification == '') { ?>
                              <div class="form-group">
                                 <textarea  class="form-control" id="description_<?php echo $key; ?>" name="parent_remark_<?php echo $key; ?>" placeholder="<?php echo PARENT_REMARK_PLACEHOLDER; ?>"></textarea>
                              </div>
                              <br>
                              <button type="submit" class="apply text-uppercase"><?php echo BUTTON_SAVE; ?></button>
                              <?php 
                              } else { 
                                 //echo $record_row->cr_parent_remark;
                                 if( $record_row->cr_parent_remark != ''){
                                     if( strlen($record_row->cr_parent_remark) > 30){
                                         echo substr_replace($record_row->cr_parent_remark, ' .. <a style="text-decoration: underline;" href="javascript:showText2('.$record_row->cr_id.')">View More</a>', 30);
                                     }else{
                                         echo $record_row->cr_parent_remark;
                                     }
                                     
                                 }else{
                                     echo '';
                                 }
                              } 
                              ?>
                           </td>
                        </form>
                     </tr>
                     <?php 
                        }
                     } else { 
                     ?>
                     <tr>
                        <td colspan="8"><?php echo 'Class has not started yet and/or Tutor has not inserted any record yet';//echo NO_RECORDS_FOUND; ?></td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>
<?php include('includes/footer.php');?>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/select2.min.js"></script>
<script>
   $.noConflict();
   jQuery(document).ready(function($){
      
      
        var hr_balance = $('#hr_balance').val();
        var firstDigit = hr_balance.substring(0, hr_balance.indexOf('.'));
        var pointNum = parseFloat(firstDigit);
        
        var second = hr_balance.split('.').splice(1).join('.')
        //01.20
        //var result = pointNum + ' hours & ' + second + ' minutes';
        var result2 = parseFloat(hr_balance) + ' hours & 00 minutes';

if(firstDigit.indexOf('-') !== -1){
  var result = (firstDigit.replace(/-/g, "- ")) + " hours & " + second + " minutes";
}else{
    var result = firstDigit + " hours & " + second + " minutes";
}

        if(hr_balance == '-' || hr_balance == '- '){
            $('#hours_balance_new').html('0 hours & 00 minutes');
        }else{
            if(hr_balance.indexOf('.') !== -1){
                $('#hours_balance_new').html(result);
            }else{
                $('#hours_balance_new').html(result2);
             }
        }
        
        
        
      $('#dataTables_cl').DataTable({
		  order : [[0,"desc"]],
         "columnDefs": [{
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
         }],
         "info":false,
         "searching":false,
         "lengthChange":false,
         "bSort":true,
         "bPaginate":true,
         "sPaginationType":"simple_numbers",
         "iDisplayLength": 10
         /*"columns": [            
            null,
            { "orderable": false },
            { "orderable": false },
            { "orderable": false }, 
            { "orderable": false }, 
            { "orderable": false }, 
            { "orderable": false }            
         ]*/
      });

      $(".clickable-row").click(function() {
           window.location = $(this).data("href");
      });
      
   });

/*                                
    $(document).ready( function() { 
        var hr_balance = $('#hr_balance').val();
        alert(hr_balance);
        var firstDigit = hr_balance.substring(0, hr_balance.indexOf('.'));
        var pointNum = parseFloat(firstDigit);
        
        var second = hr_balance.split('.').splice(1).join('.')
        //01.20
        var result = pointNum + ' hours & ' + second + ' minutes';
        var result2 = parseFloat(hr_balance) + ' hours & 00 minutes';
        
        if(hr_balance == '-' || hr_balance == '- '){
            $('#hours_balance_new').html('0 hours & 00 minutes');
        }else{
            if(hr_balance.indexOf('.') !== -1){
                $('#hours_balance_new').html(result);
            }else{
                $('#hours_balance_new').html(result2);
             }
        }
        
    }); 
 */       
 function showText(text){
	$.ajax({
		type:'POST',
		url:'admin/classes-details-save.php',
		data: {
			showText: {text: text},
		},
		success:function(result){
            document.getElementById("dataShowText").innerHTML = result;
            $('#myModalShowText').modal('show');
		}
	});
    //alert(result);
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
            $('#myModalShowText').modal('show');
		}
	});
}
</script>