<?php 
require_once('includes/head.php');
# SESSION CHECK #
if (!isset($_SESSION['auth'])) {
  header('Location: login.php');
  exit();
}
if ($_SESSION['auth']['user_role'] != '3') {
   header('Location:list_of_classes.php');
   exit();
}
$output = system::FireCurl(TUTOR_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']);
$classes = $output->data;
include('includes/header.php');
?>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<section class="clients_profile_2">
   <div class="main-body">
      <div class="container">
         <h1 class="text-center text-uppercase blue-txt "><?php echo LIST_OF_CLASSES; ?></h1>
         <?php include('includes/private_info.php'); ?>
         <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="javascript: void(0);"><?php echo LIST_OF_CLASSES; ?></a></li>
            <li role="presentation"><a href="tutor_payment_history.php"><?php echo PAYMENT_HISTORY; ?></a></li>
         </ul>
         <div class="tab-content">
            <div role="tabpanel" class="active" id="home">
               <div class="job-table">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive  text-center" style="background:#fff;" id="dataTables_cl">
                     <thead>
                        <tr class="blue-bg">
                           <td><a href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="right" title="<?php echo TOOLTIP_SORT_BY_ID; ?>"><?php echo ID_NO; ?> </a></td>
                           <td><?php echo STUDENT_NAME; ?></td>
                           <td><?php echo SUBJECT; ?></td>
                           <td><?php echo HOURS_LEFT; ?></td>
                           <td><a href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="right" title="<?php echo TOOLTIP_SORT_BY_STATUS; ?>"><?php echo STATUS; ?></a></td>                           
                           <td>&nbsp;</td>
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                        $status = array(
                           'ongoing' => '<span class="green-txt">Ongoing</span>', 
                           'onhold'  => '<span class="org-txt"><strong>On hold</strong></span>', 
                           'ended'   => '<span><strong>Ended</strong></span>');
                        if(count($classes) > 0) {
                           foreach ($classes as $key => $row) {                           
                        ?>
                        <tr>
                           <td class="sky-txt"><a href="tutor_view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn_edit tip-right" data-toggle="btnToolTip" data-placement="right" title="Click id no to view detail"><?php echo $row->cl_display_id;?></a></td>
                           <td><?php echo $row->cl_student;//$row->u_displayname;?></td>
                           <td><?php echo $row->cl_subject;?></td>
                           <td><?php echo $row->cl_hours_balance;?> <?php echo HOURS; ?></td>
                           <td><?php echo $status[$row->cl_status];?></td>
                           <td>
                              <a href="tutor_view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="view-button "><?php echo VIEW_DETAILS; ?></a>
                              <a href="tutor_view_class_detail.php?action=add_record&c_id=<?php echo $row->cl_id;?>" class="green-button ">+ <?php echo ADD_RECORD; ?></a>
                           </td>
                        </tr>
                        <?php 
                           }
                        } else { 
                        ?>
                        <tr>
                           <td colspan="6"><?php echo NO_RECORDS_FOUND; ?></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
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
            null,           
            { "orderable": false }            
         ]
      });

      $(".clickable-row").click(function() {
           window.location = $(this).data("href");
      });
      
   });
</script>