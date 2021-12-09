<?php 
require_once('includes/head.php');
# SESSION CHECK #
if (!isset($_SESSION['auth'])) {
  header('Location: login.php');
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
$row = $classes[0];
$status = array(
   'ongoing' => '<span class="green-txt">Ongoing</span>', 
   'onhold'  => '<span class="org-txt"><strong>On hold</strong></span>', 
   'ended'   => '<span><strong>Ended</strong></span>');

$record = system::FireCurl(CLASS_RECORDS_URL ."?student_id=". $_SESSION['auth']['user_id']."&cid=". $_GET['c_id']);
$record_arr = $record->data;

include('includes/headernonmobile.php');
?>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<section class="class-id">
   <div class="main-body">
      <div class="container">
         <div class="col-md-12">
            <h3 class="text-left text-uppercase org-txt"><strong><?php echo CLASS_ID; ?> : <?php echo $row->cl_display_id;?></strong></h3>
            <hr>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-md-4"><strong><?php echo STUDENT_NAME; ?> :</strong> <?php echo $row->cl_student;//$_SESSION['auth']['display_name'];?></div>
               <div class="col-md-4"><strong><?php echo RATE; ?> :</strong> <?php echo $row->cl_charge_parent;?></div>
               <div class="col-md-4"><strong><?php echo STATUS; ?> :<?php echo $status[$row->cl_status];?></strong></div>
               <div class="col-md-4"><strong><?php echo SUBJECT; ?> :</strong> <?php echo $row->cl_subject;?></div>
               <!--<div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> :</strong> <?php echo $row->cl_hours_balance;?> <?php echo HOURS; ?></div>-->
               <input type="hidden" id="hr_balance" name="hr_balance" value="<?php echo $row->cl_hours_balance;?>">
               <div class="col-md-4"><strong><?php echo HOURS_BALANCE; ?> : </strong><i id="hours_balance_new"></i></div>
               <div class="col-md-4"><strong><?php echo ONE_CYCLE; ?> :</strong> <?php echo $row->cl_cycle;?> <?php echo HOURS; ?></div>
               <div class="col-md-4"><strong><?php echo TUTOR_NAME; ?> :</strong> <?php echo $row->u_displayname;?></div>
            </div>
         </div>
         <div class="col-md-12">
            <h3 class="text-left text-uppercase org-txt"><strong>Record &amp; report</strong></h3>
            <h5 class="red-txt"><strong><em><?php echo VIEW_CLASS_DETAILS_NOTED; ?></em></strong></h5>
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
                        <td width="19%"><?php echo PARENT_VERIFICATION; ?></td>
                        <td width="13%"><?php echo PARENT_REMARKS; ?></td>
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
                        <form action="" method="post">
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
                        </form>
                     </tr>
                     <?php 
                        }
                     } else { 
                     ?>
                     <tr>
                        <td colspan="8"><?php echo NO_RECORDS_FOUND; ?></td>
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
         
</script>