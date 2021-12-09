<?php 

require_once('includes/head.php');

# SESSION CHECK #

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['auth'])) {

  header('Location: login.php');

  exit();

}

if ($_SESSION['auth']['user_role'] != '3') {

   header('Location:payment_history.php');

   exit();

}

$output = system::FireCurl(PAYMENT_HISTORY_URL ."?uid=". $_SESSION['auth']['user_id']);

$payment_history = $output->data;

include('includes/header.php');
$_SESSION['getPage'] = "Payment History";
unset($_SESSION["firstlogin"]);
?>

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<section class="clients_profile_2">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt "><?php echo PAYMENT_HISTORY; ?></h1>

         <?php include('includes/private_info.php'); ?>

         <ul class="nav nav-tabs" role="tablist">

            <li role="presentation"><a href="my-classes.php"><?php echo LIST_OF_CLASSES; ?></a></li>

            <li role="presentation" class="active"><a href="javascript: void(0);"><?php echo PAYMENT_HISTORY; ?></a></li>

         </ul>

         <div class="tab-content">

            <div role="tabpanel" class="active" id="testimonials">

               <div class="job-table">

                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive  text-center" style="background:#fff;" id="dataTables_cl">

                     <thead>

                        <tr class="blue-bg">

                           <td><?php echo DATE; ?></td>

                           <td><?php echo JOB_ID; ?></td>

                           <td><?php echo PAYMENT_RECEIPT; ?></td>

                           <td><?php echo AMOUNT_PAID_RM; ?></td>

                        </tr>

                     </thead>

                     <tbody>

                        <?php 

                        if(count($payment_history) > 0) {

                           foreach ($payment_history as $key => $row) {                           

                        ?>

                        <tr>

                           <td><?php echo $row->ph_date;?></td>

                           <td><?php echo $row->ph_job_id;?></td>

                           <td><?php echo $row->ph_receipt;?></td>

                           <td><?php echo $row->ph_amount;?></td>

                        </tr>

                        <?php 

                           }

                        } else { 

                        ?>

                        <tr>

                           <td colspan="4"><?php echo 'No records found';//NO_RECORDS_FOUND; ?></td>

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