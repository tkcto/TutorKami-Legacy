<?php 
require_once('includes/head.php');
# SESSION CHECK #
if (!isset($_SESSION['auth'])) {
  header('Location: login.php');
  exit();
}
if ($_SESSION['auth']['user_role'] != '3') {
   header('Location:view_class_detail.php');
   exit();
}
if (count($_POST) > 0) {
   $data = $_POST;
   
   $output = system::FireCurl(ADD_RECORD_URL, "POST", "JSON", $data);
   Session::SetFlushMsg($output->flag, $output->message);
   if ($output->flag == 'success') {
      header('Location: ' . basename($_SERVER['PHP_SELF']).'?c_id='.$_POST['class_id']);
      exit();
   }
  
}
if (isset($_GET['c_id']) && $_GET['c_id'] > 0) {
   $output = system::FireCurl(TUTOR_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']."&cid=". $_GET['c_id']);
   $classes = $output->data;
} elseif (isset($_GET['display_id']) && $_GET['display_id'] > 0) {
   $output = system::FireCurl(TUTOR_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']."&displayid=". $_GET['display_id']);
   $classes = $output->data;
}

$row = $classes[0];
$status = array(
   'ongoing' => '<span class="green-txt">Ongoing</span>', 
   'onhold'  => '<span class="org-txt"><strong>On hold</strong></span>', 
   'ended'   => '<span><strong>Ended</strong></span>');

$record = system::FireCurl(CLASS_RECORDS_URL ."?tutor_id=". $_SESSION['auth']['user_id']."&cid=". $row->cl_id);
$record_arr = $record->data;

include('includes/header.php');
?>
<link rel="stylesheet" href="admin/css/plugins/datapicker/datepicker3.css">
<link rel="stylesheet" href="admin/css/plugins/clockpicker/clockpicker.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<section class="class-id">
   <div class="main-body">
      <div class="container">
         <div class="col-md-12">
            <h3 class="text-left text-uppercase org-txt"><strong><?php echo CLASS_ID; ?> : <?php echo $row->cl_display_id;?></strong></h3>
            <hr>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-md-4"><strong><?php echo STUDENT_NAME; ?> :</strong> <?php echo $row->cl_student; //$row->ud_first_name;?> <?php echo $row->ud_last_name;?></div>
               <div class="col-md-4"><strong><?php echo RATE; ?> :</strong> <?php echo $row->cl_rate;?></div>
               <div class="col-md-4"><strong><?php echo STATUS; ?> :<?php echo $status[$row->cl_status];?></strong></div>
               <div class="col-md-4"><strong><?php echo SUBJECT; ?> :</strong> <?php echo $row->cl_subject;?></div>
               <div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> :</strong> <?php echo $row->cl_hours_balance;?> <?php echo HOURS; ?></div>
               <div class="col-md-4"><strong><?php echo ONE_CYCLE; ?> :</strong> <?php echo $row->cl_cycle;?> hours</div>
               <div class="col-md-4"><strong><?php echo TUTOR_NAME; ?> :</strong> <?php echo $_SESSION['auth']['display_name'];?></div>
            </div>
         </div>
         <div class="col-md-12">
            <div class="row" style="margin-bottom:6px;">
               <div class="col-md-1 col-sm-2 col-xs-2"><strong class="org-txt" style="margin-right:15px;"><?php echo RECORD; ?></strong>        
               </div>
               <div class="col-md-2 col-sm-3 col-xs-12 posRelative">
                  <div class="step_box step_1 hidden">
                     <div class="step_head">
                        <?php echo TOOLTIP_STEP1_TITLE; ?>
                        <div class="close">x</div>
                     </div>
                     <div class="step_text">
                        <p><?php echo TOOLTIP_STEP1_DESCRIPTION; ?></p>
                        <p class="text-center"><a href="#" class="gobtn"><?php echo TOOLTIP_STEP1_BUTTON; ?> ></a></p>
                        <div class="checkbox">
                           <label>
                           <input type="checkbox"> <?php echo TOOLTIP_STEP1_CHECKBOX_LABEL; ?>
                           </label>
                        </div>
                     </div>
                  </div>
                  <a href="<?php echo basename($_SERVER['PHP_SELF']).'?action=add_record&c_id='.$row->cl_id; ?>" class="tute_green"> + <?php echo ADD_RECORD; ?></a>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 job-table">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center" style="background:#fff;" id="dataTables_cl">
                     <thead>
                        <tr class="blue-bg">
                           <td width="20%"><?php echo DATE; ?></td>
                           <td width="10%"><?php echo TIME_START; ?></td>
                           <td width="10%"><?php echo TIME_END; ?></td>
                           <td width="10%"><?php echo DURATION; ?></td>
                           <td width="15%"><?php echo TUTOR_REPORT; ?></td>
                           <td width="15%"><?php echo PARENT_VERIFICATION; ?></td>
                           <td width="20%"><?php echo PARENT_REMARKS; ?></td>
                        </tr>
                     </thead>
                     <tbody>   
                        <?php if(isset($_GET['action']) && $_GET['action'] == 'add_record') { ?>
                        <tr>
                           <form action="" method="post" onsubmit="return validate(this);">
                              <input type="hidden" name="class_id" value="<?php echo (isset($row->cl_id) && $row->cl_id != '') ? $row->cl_id : ''; ?>">
                              <input type="hidden" name="total_duration" id="input_duration" value="">
                              <td class="posRelative">
                                 <div class="step_box step_2 hidden">
                                    <div class="step_head">
                                       <?php echo TOOLTIP_STEP2_TITLE; ?>
                                       <div class="close">x</div>
                                    </div>
                                    <div class="step_text">
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
                                       <input type="text" class="form-control" name="record_date" />
                                       <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> </span> 
                                    </div>
                                 </div>
                              </td>
                              <td class="posRelative text-center">
                                 <div class="step_box step_3 hidden">
                                    <div class="step_head">
                                       <?php echo TOOLTIP_STEP3_TITLE; ?>
                                       <div class="close">x</div>
                                    </div>
                                    <div class="step_text">
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
                                    <input type="text" class="form-control" placeholder="02:30 pm" id="st_time" name="record_start_time">
                                 </div>
                              </td>
                              <td class="posRelative text-center">
                                 <div class="step_box step_4 hidden">
                                    <div class="step_head">
                                       <?php echo TOOLTIP_STEP4_TITLE; ?>
                                       <div class="close">x</div>
                                    </div>
                                    <div class="step_text">
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
                                    <input type="text" class="form-control" placeholder="05:30 pm" id="en_time" name="record_end_time">
                                 </div>
                              </td>
                              <td class="posRelative" id="duration">2 hours</td>
                              <td class="posRelative">
                                 <div class="step_box step_5 hidden">
                                    <div class="step_head">
                                       <?php echo TOOLTIP_STEP5_TITLE; ?>
                                       <div class="close">x</div>
                                    </div>
                                    <div class="step_text">
                                       <p><?php echo TOOLTIP_STEP5_DESCRIPTION; ?> </p>
                                       <p class="text-center"><a href="#" class="gobtn"><?php echo TOOLTIP_STEP5_BUTTON; ?> ></a></p>
                                       <div class="checkbox">
                                          <label>
                                          <input type="checkbox"> <?php echo TOOLTIP_STEP5_CHECKBOX_LABEL; ?>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                                 <textarea class="text-center" name="record_remark" placeholder="<?php echo PLEASE_FILL_IN_YOUR_REMARK_HEAR; ?>"></textarea>
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
                                             <div class="close">x</div>
                                          </div>
                                          <div class="step_text">
                                             <p><?php echo TOOLTIP_STEP6_DESCRIPTION; ?></p>
                                             <p class="text-center"><a href="#" class="gobtn"><?php echo TOOLTIP_STEP6_BUTTON; ?></a></p>
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
                           'done' => '<strong class="green-txt">Done</strong>', 
                           'notdone'  => '<strong class="red-txt">Not done</strong>');

                        if(count($record_arr) > 0) {
                           foreach ($record_arr as $key => $record_row) {                           
                        ?>
                        <tr>
                           <td><?php echo $record_row->cr_date;?></td>
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
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Modal -->
<div class="modal fade-scale" id="tourGuideModal" tabindex="-1" role="dialog" aria-labelledby="tourGuideModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title text-center" id="tourGuideModalLabel"><?php echo POPUP_TITLE; ?> <?php echo ucfirst($_SESSION['auth']['display_name']); ?>!</h4>
      </div>
      <div class="modal-body">
         <p class="text-center note"><?php echo POPUP_DESCRIPTION; ?></p>
         <p class="text-center buttons">
            <button type="button" class="save"><?php echo POPUP_BUTTON_START; ?></button>
            <button type="button" class="delete" data-dismiss="modal"><?php echo POPUP_BUTTON_NO_THANKS; ?></button>
         </p>
         <p class="text-center discard_popup">
            <label for="discard_popup"><input type="checkbox" id="discard_popup" value="0"> <?php echo POPUP_CHECKBOX_LABEL; ?></label>
         </p>         
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php');?>
<?php 
if(isset($_GET['action']) && $_GET['action'] == 'add_record') {
   $pop_stat = system::FireCurl(GET_CLASS_GUIDE_URL ."?user_id=". $_SESSION['auth']['user_id']);
   if($pop_stat->flag == 'success' && ($pop_stat->data == '' || $pop_stat->data == '1')) {
      echo '<script>$(window).on("load",function(){$("#tourGuideModal").modal("show");});</script>';
   }
}
?>
<!-- Data picker -->
<script src="admin/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Clock picker -->
<script src="admin/js/plugins/clockpicker/clockpicker.js"></script>
<script type="text/javascript">

   function validate(form) {
      
      return confirm('After you confirm, you cannot change or edit anymore.');
      
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
         } else {            
            var diff = timeEnd.getTime() - timeStart.getTime();
            var sec_num = parseInt(diff, 10);
            var hours = Math.floor(sec_num / (1000 * 60 * 60));            
            var mins = Math.floor((sec_num - (hours * 1000 * 3600)) / (1000 * 60));
            if (mins < 10) {mins = "0"+mins;}    
            
            total_min = (parseInt(hours) * 60) + parseInt(mins);
            total_hrs = total_min / 60;
            // response = hours + " hours" + mins + " minutes";
            // response = hours + " hours";

            response = total_hrs.toFixed(2) + " hours";
         }
      }

      return response;
   }

   $(document).ready(function(){
      $('.clockpicker input').on('change', function(){
         var start_time = $('#st_time').val();
         var end_time   = $('#en_time').val();

         var duration = calculateTime(start_time, end_time);
         
         $('#duration').html(duration);
         $('#input_duration').val(duration);
      });

      $('.clockpicker').clockpicker({
         twelvehour: true,
         // autoclose: true
      });

      $('.input-group.date').datepicker({
         todayBtn: "linked",
         keyboardNavigation: false,
         forceParse: false,
         calendarWeeks: true,
         autoclose: true,
         format: "yyyy-mm-dd"
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
         ]
      });

      $(".clickable-row").click(function() {
           window.location = $(this).data("href");
      });
      
   });
</script>
