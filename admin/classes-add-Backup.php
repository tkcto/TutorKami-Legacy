<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;


$userRole = $instAuth = new user;
$resStudent = $userRole->FetchUserByRole(4,'A');
$resTutor = $userRole->FetchUserByRole(3,'A');
$resSubject = $instApp->FetchSubject();
$resClasses = $instApp->FetchClasses(); 
if(isset($_REQUEST['cl-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveClasses($data);
 //echo $res;
 header('Location:classes-list.php');
 exit();
}
// ni dapatkan cl dekat url
if(isset($_REQUEST['cl'])){
 $arrClass = $instApp->GetClasses($_REQUEST['cl']);
 
$recordBalance = $instApp->fd_classes($_REQUEST['cl']);
$linkRecordBalance = $instApp->fd_classes_record($_REQUEST['cl']);
}
?>
<!DOCTYPE html>
<html>
<head>
<?php 
   $title = 'Classes Add | Tutorkami';
   require_once('includes/html_head.php'); 
?>
</head>
<body>
<div class="loaderBackground" id="hider" style="display: none;"></div>
<div class="loaderpop" id="loadermodaldiv" style="display: none;">
   <h4><img src="img/loading.svg" style="width: 50px;" />Loading...</h4>
</div>
<div id="wrapper">
   <?php include_once('includes/sidebar.php'); ?>
   <div id="page-wrapper" class="gray-bg">
      <?php include_once('includes/header.php'); ?>
      <div class="wrapper wrapper-content animated fadeInRight">
         <div class="row">
            <div class="col-lg-12">
               <div class="ibox float-e-margins">
                  <div class="ibox-title">
                     <h5><?PHP if(isset($_REQUEST['cl'])){echo "Edit Class";}else{echo "Classes Add";}?></h5>
                  </div>
                  <div class="ibox-content">
                     <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="cl_id" id="cl_id" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_id'] : ''; ?>">
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Job Id:</label>
                           <div class="col-lg-7"><div class="form-inline">
                              <?php 
                                 /*$used_rand = array();
                                 while($arrClasses = $resClasses->fetch_assoc()){
                                    $used_rand[] = $arrClasses['cl_display_id'];
                                 }
                                 while($rand = rand(10000,99999)){
                                   if(!in_array($rand,$used_rand))
                                    break;
                                 }*/
                                 ?>                                    
                             <?php if(isset($_REQUEST['job_id']) != ''){?>

                              <input <?php /*if(isset($_REQUEST['cl']) != ''){echo "readonly";}*/?>  type="text" class="form-control" name="cl_display_id" id="job_id" value="<?php echo $_REQUEST['job_id']; ?>">
                           <?php }else{ ?>
                              <input <?php /*if(isset($_REQUEST['cl']) != ''){echo "readonly";}*/?>  type="text" class="form-control" name="cl_display_id" id="job_id" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_display_id'] : '';?>" required>
							  <?PHP
							  /* START - fadhli */
							  if(isset($_REQUEST['cl'])){
								  echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="job-add.php?j='.$arrClass['cl_display_id'].'" target="_blank" title="ID: '.$arrClass['cl_display_id'].'" style="color:#FFF; text-decoration: none;">'.$arrClass['cl_display_id'].'</a></label> ';
							  }
							  /* END - fadhli */
							  ?>
                           <?php } 
							  /* START - fadhli */
							  /*if(isset($_REQUEST['job_id']) != ''){
								  $getJobId = $instApp->GetClasses($_REQUEST['job_id']);
								  if ($getJobId->num_rows > 0) {
									echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="job-add.php?j='.$getJobId['cl_display_id'].'" target="_blank" title="ID: '.$getJobId['cl_display_id'].'" style="color:#FFF; text-decoration: none;">'.$getJobId['cl_display_id'].'</a></label> ';
								  } echo "test";
							  }*/
							  /* END - fadhli */
						   ?>
                           </div></div>
                        </div>
                        <!-- if edit, pergi sini -->
                        <?php if(isset($_REQUEST['cl']) != ''){?>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Client Id:</label>
                           <div class="col-lg-7"><div class="form-inline">
                              <input type="text" class="form-control" name="cl_student_id" id="cl_student_id" required>
							  <?PHP
							  /* START - fadhli */
							  if(isset($_REQUEST['cl'])){
									$mysqli = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
									if ($mysqli->connect_errno) {
										echo "Connect failed ".$mysqli->connect_error;
										exit();
									}
									$query = "SELECT * FROM tk_job WHERE j_id = '".$arrClass['cl_display_id']."'";
									if ($result = $mysqli->query($query)) {
										$row = $result->fetch_assoc();
										$query2 = "SELECT * FROM tk_user WHERE u_email = '".$row['j_email']."'";
										if ($result2 = $mysqli->query($query2)) {
											$row2 = $result2->fetch_assoc();
											echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$row2['u_displayid'].'" target="_blank" title="ID: '.$row2['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$row2['u_email'].'</a></label> ';
										}
									}
									$mysqli->close();
							  }
							  /* END - fadhli */
							  ?>
                           </div></div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Tutor:</label>
                           <div class="col-lg-7"><div class="form-inline">
                              <input type="text" class="form-control" name="cl_tutor_id" id="cl_tutor_id" required>
							  <?PHP
							  /* START - fadhli */
							  if(isset($_REQUEST['cl'])){
									$mysqli = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
									if ($mysqli->connect_errno) {
										echo "Connect failed ".$mysqli->connect_error;
										exit();
									}
									$query = "SELECT * FROM tk_job WHERE j_id = '".$arrClass['cl_display_id']."'";
									if ($result = $mysqli->query($query)) {
										$row = $result->fetch_assoc();
										$query2 = "SELECT * FROM tk_user WHERE u_email = '".$row['j_hired_tutor_email']."'";
										if ($result2 = $mysqli->query($query2)) {
											$row2 = $result2->fetch_assoc();
											echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$row2['u_displayid'].'" target="_blank" title="ID: '.$row2['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$row2['u_email'].'</a></label> ';
										}
									}
									$mysqli->close();
							  }
							  /* END - fadhli */
							  ?>
                           </div></div>
                        </div>

                     <?php }?>
                   <?php if(isset($_REQUEST['cl']) == ''){?>
                        <!-- else if add new, pergi sini -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Client ID:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
                                 <input type="text" class="form-control" name="cl_student_id" id="cl_student_id" required>   
                              </div> 
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Tutor:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
                                 <input type="text" class="form-control" name="cl_tutor_id" id="cl_tutor_id" required>   
                              </div> 
                           </div>
                        </div>
                      <?php } ?>
                        <div class="form-group hidden">
                           <label class="col-lg-3 control-label">Subject Id:</label>
                           <div class="col-lg-7">
                              <select class="form-control user-list" name="cl_subject_id" >
                                 <option value="">Select Subject</option>
                                 <?php 
                                    while($arrSubject = $resSubject->fetch_assoc()) {?>
                                 <option value="<?php echo $arrSubject['ts_id'];?>" <?php if(isset($_REQUEST['cl'])) echo $arrClass['cl_subject_id']==$arrSubject['ts_id']?'selected':''?>><?php echo $arrSubject['ts_title'];?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                       
                       
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Subject:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input type="text" class="form-control" name="cl_subject" id="cl_subject" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_subject'] : ''; ?>" required>   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Rate:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input type="text"  class="form-control" name="cl_rate" id="cl_rate" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_rate'] : ''; ?>" required>   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Charge to parent:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input type="text"  class="form-control" name="cl_charge_parent" id="cl_charge_parent" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_charge_parent'] : ''; ?>" required>   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Student's Name:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input type="text" class="form-control" name="cl_student" id="cl_student" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_student'] : ''; ?>" required>   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Hours Balance:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
								<!-- <input type="text"  class="form-control" name="cl_hours_balance" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_hours_balance'] : ''; ?>" > -->
								<input type="text"  class="form-control" name="cl_hours_balance" id="cl_hours_balance" disabled>
                              </div>
						   </div>
                        </div>
                        <!-- luqman -->
                        <!-- <div class="form-group">
                           <label class="col-lg-3 control-label">Hours Balance:</label>
                           <div class="col-lg-7">
                              <input type="text"  class="form-control" name="new_balance" id="new_balance">
                           </div>
                        </div> -->
                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Cycle:</label>
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <!-- fadhli -->
<?php
function is_positive_integer($str) {
	return (is_numeric($str) && $str > 0 && $str == round($str));
}

if ($recordBalance->num_rows > 0) {
	if ($linkRecordBalance->num_rows > 0) {
		$thisBalance = $linkRecordBalance->fetch_assoc();
		if($thisBalance['cr_balance'] >= 0) {
			$thisDisabled = 'readonly';
		}else{
			$thisDisabled = '';
		}
	}else{
		$thisDisabled = "";
	}
}else{
	$thisDisabled = "";
}
?>
                              <input type="text"  class="form-control" name="cl_cycle" id="cl_cycle" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_cycle'] : ''; ?>" required <?php echo $thisDisabled; ?>> <span> <font size="2">&nbsp;&nbsp;&nbsp;hours</font></span>
                              <!--<input type="text"  class="form-control" name="cl_cycle" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_cycle'] : ''; ?>" required>-->
                              </div>
						   </div>
                        </div>

                        <div class="form-group">
                           <label class="col-lg-3 control-label">Status:</label>
                           <div class="col-lg-7" style="width:240px;">
                              <select class="form-control" name="cl_status" required>
                                 <option value="">Select Status</option>
                                 <option value="ongoing" <?php if(isset($_REQUEST['cl'])) echo $arrClass['cl_status']=="ongoing"?'selected':''?>>On Going</option>
                                 <option value="onhold" <?php if(isset($_REQUEST['cl'])) echo $arrClass['cl_status']=="onhold"?'selected':''?>>On Hold</option>
                                 <option value="ended" <?php if(isset($_REQUEST['cl'])) echo $arrClass['cl_status']=="ended"?'selected':''?>>Ended</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-lg-offset-3 col-lg-9">
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="cl-save">Save</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <?php if (isset($_GET['cl']) && $_GET['cl'] != '') { ?>
               <div class="ibox float-e-margins">
                  <div class="ibox-title">
                     <h5>Classes</h5> 
                  </div>
                  <div class="ibox-content">
                     <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                           <div class="col-sm-12">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center dataTable no-footer" style="background:#fff;" id="dataTables_cl">
                                 <thead>
                                    <tr class="blue-bg">
                                       <td width="10%">Date</td>
                                       <td width="7%">Time <br>Start</td>
                                       <td width="7%">Time <br>End</td>
                                       <td width="10%">Duration</td>
                                       <td width="17%">Tutor's <br> remarks</td>
                                       <td width="10%">Cycle Status</td>
                                       <td width="19%">Parent <br>verification</td>
                                       <td width="13%">Parent <br>remarks</td>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                    $record_res = $instApp->ClassWiseRecord($_GET['cl']);
                                    $record_status = array(
                                       'done' => '<strong class="green-txt">Done</strong>', 
                                       'notdone'  => '<strong class="red-txt">Not done</strong>');

                                    if ($record_res->num_rows > 0) {
                                       while( $record_row = $record_res->fetch_assoc() ){                           
                                    ?>
                                    <tr>
                                       <td><?php echo $record_row['cr_date'];?></td>
                                       <td><?php echo $record_row['cr_start_time'];?></td>
                                       <td><?php echo $record_row['cr_end_time'];?></td>
                                       <td><?php echo $record_row['cr_duration'];?></td>
                                       <td><strong><?php echo $record_row['cr_tutor_report'];?></strong></td>


									   <td>
									   <?php
									   if($record_row['cr_status'] =='required parent to pay'){
										   //echo "<a id='".$record_row['cr_cl_id']."' value='value' href='#' onclick='MyFunction(".$record_row['cr_cl_id'].");'><font color=red>".ucwords($record_row['cr_status'])."</font></a>"; 
										   //echo "<button class='btn btn-sm btn-default' type='submit' name='cl-save2'><font color=red>".ucwords($record_row['cr_status'])."</font></button>";
										   //echo "<a id='clickthis' href='payment-form.php?id=$record_row[cr_cl_id]'><font color=red>".ucwords($record_row['cr_status'])."</font></a>";
										   echo "<a href='javascript:openwindow()'><font color=red>".ucwords($record_row['cr_status'])."</font></a>";
									  }else if($record_row['cr_status'] =='new cycle'){
										   echo "<font color=green>New Cycle</font>";
									   }else{
									   }
									   
									   ?>

									   <!--<a href="payment-form.php?pd=<?php echo $record_row['cr_id'];?>" class="gray-text"><?php if($record_row['cr_status'] != "new"){ echo $record_row['cr_status']; }?></a>-->
									   
									   </td>



                                       <td>
                                          <?php echo ($record_row['cr_parent_verification'] != '') ? $record_status[$record_row['cr_parent_verification']] : ''; ?>
                                       </td>
                                       <td>
                                          <?php echo $record_row['cr_parent_remark']; ?>
                                       </td>
                                    </tr>
                                    <?php 
                                       }
                                    } else { 
                                    ?>
                                    <tr>
                                       <td colspan="8">No Records Found</td>
                                    </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>   
               <?php } ?>
            </div>
         </div>
      </div>
      <?php include_once('includes/footer.php'); ?>
   </div>
</div>
<script src="js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>
<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Date range picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

   getEmailClient();
   Calcbalance();
   getRateSubjectClass();

    $('#data .input-group.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: "yyyy-mm-dd"
    });

    $('#job_id').on('keyup', function(){
      var jobId = $(this).val();

      $('#hider, #loadermodaldiv').show();

      $.ajax({
         url: "ajax/ajax_call.php",
         type: "POST",
         data: {action: 'get_job_details', job_id: jobId},          
         dataType: "json",
         success: function(resultData) {
            
            if (resultData == 0) {
               getStickyNote ('error', 'This job id does not exists!');
               return false;
            }
            $('#cl_student_id').val(resultData.j_email);
			$('#cl_tutor_id').val(resultData.j_hired_tutor_email);
            $('#cl_subject').val(resultData.jt_subject);
            $('#cl_rate').val(resultData.j_rate);
            if (typeof resultData.u_id !== 'undefined') {
              $('#cl_tutor_id option[value='+resultData.u_id+']').prop('selected', true);
            }
            else{
               $("#cl_tutor_id option[value='']").prop('selected', true);
            }
            if (typeof resultData.parent_id !== 'undefined') {
              $('#cl_student_id option[value='+resultData.parent_id+']').prop('selected', true);
            }
            else{
              $("#cl_student_id option[value='']").prop('selected', true); 
            }
            $('#hider, #loadermodaldiv').hide();
         },
         error:function(msg){
            $('#hider, #loadermodaldiv').hide();
            getStickyNote ('error', 'Unknown error, try again later.');            
         }
      });
    });

  });
</script>
<script type="text/javascript">
   function getEmailClient(){

      var job_id = $("#job_id").val();
      // alert(job_id);

   if(job_id != ""){
      
      $.ajax({
         url: "ajax/ajax_call_new.php",
         type: "POST",
         dataType: "json",
         data: {
            data: {
               job_id : job_id,
            },
         },
         success: function(response){
            // alert(response);
            console.log(response);

            $('#cl_student_id').val(response.j_email);
            $('#cl_tutor_id').val(response.j_hired_tutor_email);
         }
      });

      
   }else{
      // alert('tiada');
   }
}
</script>

<script type="text/javascript">
   function Calcbalance(){
      var cl_id = $('#cl_id').val();
      // alert(cl_id);
      
      if(cl_id != ''){
         $.ajax({
            url: "ajax/ajax_call_new_calc.php",
            type: "POST",
            dataType: "json",
            data: {
               data: {
               cl_id : cl_id,
               },
            },
            success: function(response){
               console.log(response);

               // $('#new_balance').val(response);
               $('#cl_hours_balance').val(response);
            }
         });
      }
   }
</script>

<script type="text/javascript">
   function getRateSubjectClass(){
      var job_id = $('#job_id').val();
      // alert(job_id);

      if(job_id != ''){
         $.ajax({
            url: "ajax/ajax_call_new.php",
            type: "POST",
            dataType: "json",
            data: {
               dataRS: {
                  job_id : job_id,
               },
            },
            success: function(response){
               console.log(response);

               $('#cl_rate').val(response.j_rate);
               $('#cl_subject').val(response.jt_subject);
               

            }
         });
      }else{

      }
   }

</script>
<script type="text/javascript">/*
$('#clickthis').click(function(event) { 
    event.preventDefault(); 
	if (confirm("Are You Sure !")) {
		$('#hider, #loadermodaldiv').show();
		$.ajax({
			url: $(this).attr('href'),
			success: function(response) {
				$('#hider, #loadermodaldiv').hide();
				window.location = "classes-list.php";
			}
		});
		return false; 
	}else{
		alert("You pressed Cancel!");
	}
});*/

function openwindow(){ 
	if (confirm("Are You Sure !")) {
		
		var dataCycleId = document.getElementById("cl_id").value;
		var dataCycle = document.getElementById("cl_cycle").value;
		var dataBalance = document.getElementById("cl_hours_balance").value;
		var dataString = 'dataCycleId=' + dataCycleId + '&dataCycle=' + dataCycle + '&dataBalance=' + dataBalance;
		
		$('#hider, #loadermodaldiv').show();
		$.ajax({
			type: "POST",
			url: "payment-form.php",
			data: dataString,
			cache: false,
			success: function(html) {
				$('#hider, #loadermodaldiv').hide();
				window.location = "classes-list.php";
			}
		});


	}else{
		alert("You pressed Cancel!");
	}
} 
</script>
</body>
</html>
