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

  /* Icon when the collapsible content is shown */
  .btnCollapsible:after {
    font-family: "Glyphicons Halflings";
    content:"\e027";
    /*float: right;*/
    margin-left: 15px;
  }
  /* Icon when the collapsible content is hidden */
  .btnCollapsible.collapsed:after {
    content:"\e026";
  }
</style>
      <div class="container">
         <div class="col-md-12">
            <h3 class="text-left text-uppercase org-txt"><strong><?php echo 'CLASS ID'; //echo JOB_ID; ?> : <?php echo $row->cl_display_id;?></strong></h3>
            <hr>
            <div class="clearfix"></div>
            <div class="row">

               <div class="col-md-4"><strong><?php echo STUDENT_NAME; ?> :</strong> <?php echo $studentName;//$_SESSION['auth']['display_name'];?></div>
               <div class="col-md-4"><strong><?php echo RATE; ?> :</strong> RM<?php echo $row->cl_charge_parent;?> per hour</div>
               <div class="col-md-4"><strong><?php echo STATUS; ?> : <?php echo $status[$row->cl_status];?></strong></div>
               <div class="col-md-4"><strong><?php echo SUBJECT; ?> :</strong> <?php echo $row->cl_subject;?></div>
               <!--<div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> :</strong> <?php echo $row->cl_hours_balance;?> <?php echo HOURS; ?></div>-->
               
               <input type="hidden" id="hr_balance" name="hr_balance" value="<?php echo $row->cl_hours_balance;?>">
               <div class="col-md-4"><strong><?php echo 'Current Cycle'; ?> : </strong><span>
<?PHP
$i = 0;
$len = count($record_arr);
foreach ($record_arr as $key => $record_row) {
    if ($i == 0) {
        echo '#'.$record_row->cr_classes;
    } else if ($i == $len - 1) {
        // last
    }
    // …
    $i++;
}
?>
               </span></div>
               <div class="col-md-4"><strong><?php echo ONE_CYCLE; ?> :</strong> <?php echo $row->cl_cycle;?> <?php echo HOURS; ?></div>
               <div class="col-md-4"><strong><?php echo TUTOR_NAME; ?> :</strong> <a href="https://www.tutorkami.com/tutor_profile?did=<?php echo $row->u_displayid;?>" target="_blank" style="text-decoration: none;color:blue"><?php echo $row->u_displayname;?></a></div>
               <div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong><span id="hours_balance_new"></span></div>
               <!--<div class="col-md-4"><strong><?php echo TUTOR_NAME; ?> :</strong> <?php echo $row->u_displayname;?></div>-->
               <div class="col-md-4">
                   <h4 class="text-left text-uppercase">
                       <a href="list_of_classes.php" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-hand-left"></span> &nbsp;&nbsp;<?php echo "Back"; ?></a>
                       <br/><br/>
                       <strong> Please click &nbsp;<a type="button" class="btn btn-primary btn-xs">Remarks &nbsp;&nbsp;<i class="glyphicon glyphicon-circle-arrow-down"></i></a>&nbsp; to approve the record</strong>
                    </h4>
                   <h5 class="red-txt"><strong><?php echo VIEW_CLASS_DETAILS_NOTED; ?></strong></h5>
               </div>
            </div>
         </div>
            <!--<h3 class="text-left text-uppercase org-txt"><strong>Record &amp; report</strong></h3>
            <h5 class="red-txt"><strong><em><?php echo VIEW_CLASS_DETAILS_NOTED; ?></em></strong></h5>-->
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
                                        <p class="text-center font-size"><?php echo date("d/m/y", strtotime($record_row->cr_date)).'<br/>(Cycle#'.$record_row->row_no.')'; ?></p>
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
                                        <p class="text-center" style="margin-top:-15px;"><a type="button" data-toggle="tooltip" data-placement="right" title="Start Time"><i class="fa fa-info-circle"></i></a></p>
                                    </div>
                                    <div class="col-xs-4">
                                    </div>
                                    <div class="col-xs-4">
                                        <p class="text-center" style="margin-top:-15px;"><a type="button" data-toggle="tooltip" data-placement="right" title="End Time"><i class="fa fa-info-circle"></i></a></p>
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