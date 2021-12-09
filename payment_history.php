<?php 

require_once('includes/head.php');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

# SESSION CHECK #

if (!isset($_SESSION['auth'])) {

  header('Location: client_login.php');

  exit();

}

if ($_SESSION['auth']['user_role'] != '4') {

	header('Location:tutor_payment_history.php');

	exit();

}

$output = system::FireCurl(PAYMENT_HISTORY_URL ."?uid=". $_SESSION['auth']['user_id']);

$payment_history = $output->data;

include('includes/header.php');

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<section class="clients_profile_2">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt "><?php echo 'INVOICE/RECEIPT(S)'; //PAYMENT_HISTORY; ?></h1>

         <?php //include('includes/parent_info.php'); ?>
        <?php 
        $getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$_SESSION['auth']['user_id']);
        
        ?>
        <div class="col-md-12 ">
           <hr>
           <h3 class="org-txt"><strong><?php //echo WELCOME; ?> <?php //echo ucwords($getUserDetails->data[0]->ud_first_name); ?> <?php //echo $getUserDetails->data[0]->ud_last_name; ?></strong></h3>
           <p>
                Click invoice/receipt number below to view/download it
           </p>
           <div class="clearfix"></div>
           <hr>
        </div>
         

         <ul class="nav nav-tabs" role="tablist">

            <li role="presentation"><a href="list_of_classes.php"><?php echo LIST_OF_CLASSES; ?></a></li>

            <li role="presentation" class="active"><a href="javascript: void(0);"><?php echo 'Invoice/Receipt'; //echo PAYMENT_HISTORY; ?></a></li>

         </ul>

         <div class="tab-content">

            <div role="tabpanel" class="active" id="home">

               <div class="job-table">

                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive  text-center" style="background:#fff;" id="dataTables_cl">

                     <thead>

                        <tr class="blue-bg">
      							<td><?php echo DATE; ?></td>
      							
      							<?PHP
      							    if(count($payment_history) > 0) {
      							        ?>
      							        <td><?php echo DATE; ?></td>
      							        <?PHP
      							    }
      							?>

      							

      							<td><?php echo 'Class ID';//echo CLASS_ID; ?></td>

      							<td><?php echo 'Invoice/Receipt';//echo PAYMENT_RECEIPT; ?></td>

                           <td><?php echo 'Amount (RM)';//echo AMOUNT_PAID_RM; ?></td>

						      </tr>

                     </thead>

                     <tbody>

                        <?php 

                        if(count($payment_history) > 0) {

                           foreach ($payment_history as $key => $row) {
                               
                               if( $row->ph_receipt == 'trial' ){
                                      $CekExist = " SELECT ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '4' AND ph_user_id = '".$row->ph_user_id."' AND ph_job_id = '".$row->ph_job_id."' AND ph_receipt = 'trial paid'  "; 
                                      $rowCekExist = $conn->query($CekExist); 
                                      if($rowCekExist->num_rows > 0){
                                            $resCekExist = $rowCekExist->fetch_assoc();
                                         
                                      }else{
                                            ?>
                                            <tr>
                                               <td><?php 
                                                    echo $row->ph_date;
                                               ?></td>
                                               <td><?php 
                                                    //echo $row->ph_date;
                                                    echo date("d/m/Y", strtotime($row->ph_date));
                                               ?></td>
                    
                                               <td><?php echo $row->ph_job_id;?></td>
                    
                                               <td>
                                                   <a href="pdf_user.php?last=<?php echo $row->ph_id.generateRandomString();?>" target="_blank"><?php echo 'i'.$row->ph_job_id.'T';?></a>
                                               </td>
                    
                                               <td><?php echo number_format((($row->ph_amount + $row->ph_rf)), 2);?></td>
                                            </tr>
                                            <?php  
                                      }
                               }
                               else if( $row->ph_receipt == 'trial paid' ){
                                            ?>
                                            <tr>
                                               <td><?php 
                                                    echo $row->ph_date;
                                               ?></td>
                                               <td><?php 
                                                    //echo $row->ph_date;
                                                    echo date("d/m/Y", strtotime($row->ph_date));
                                               ?></td>
                    
                                               <td><?php echo $row->ph_job_id;?></td>
                    
                                               <td>
                                                   <a href="pdf_user.php?last=<?php echo $row->ph_id.generateRandomString();?>" target="_blank"><?php echo 'i'.$row->ph_job_id.'T (paid)';?></a>
                                               </td>
                    
                                               <td><?php echo number_format((($row->ph_amount + $row->ph_rf)), 2);?></td>
                                            </tr>
                                            <?php  
                                      
                               }
                               
                               else if( $row->ph_receipt == 'temp' ){
                                   
                                      $CekExist = " SELECT ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '4' AND ph_user_id = '".$row->ph_user_id."' AND ph_job_id = '".$row->ph_job_id."' AND (ph_receipt = '1' OR ph_receipt = '01') "; 
                                      $rowCekExist = $conn->query($CekExist); 
                                      if($rowCekExist->num_rows > 0){
                                            $resCekExist = $rowCekExist->fetch_assoc();
                                         
                                      }else{
                                            ?>
                                            <tr>
                                               <td><?php 
                                                    echo $row->ph_date;
                                               ?></td>
                                               <td><?php 
                                                    //echo $row->ph_date;
                                                    echo date("d/m/Y", strtotime($row->ph_date));
                                               ?></td>
                    
                                               <td><?php echo $row->ph_job_id;?></td>
                    
                                               <td><?php 
                                                    //echo $row->ph_receipt;
                                                    $pad_length = 2;
                                                    $pad_char = 0;
                                                    if( $row->ph_receipt == 'temp' ){
                                                        $thisCycle = '01';
                                                    }else{
                                                        $thisCycle = str_pad($row->ph_receipt, $pad_length, $pad_char, STR_PAD_LEFT).' (paid)';
                                                    }
                                                
                                                    //echo 'R'.$row->ph_job_id.$thisCycle;
                                                                           ?>
                                                   <a href="pdf_user.php?last=<?php echo $row->ph_id.generateRandomString();?>" target="_blank"><?php echo 'i'.$row->ph_job_id.$thisCycle;?></a>
                                               </td>
                    
                                               <td><?php echo number_format((($row->ph_amount + $row->ph_rf)), 2);?></td>
                                            </tr>
                                            <?php  
                                      }

                                   
                               }else if (strpos($row->ph_receipt, 'beginning') !== false) {
                                   
                                        $CycleNo = filter_var($row->ph_receipt, FILTER_SANITIZE_NUMBER_INT);
                                        $CycleNo2  = str_pad($CycleNo, $pad_length, $pad_char, STR_PAD_LEFT);
                                        
                                      $CekExist = " SELECT ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '4' AND ph_user_id = '".$row->ph_user_id."' AND ph_job_id = '".$row->ph_job_id."' AND (ph_receipt = '".$CycleNo."' OR ph_receipt = '".$CycleNo2."') "; 
                                      $rowCekExist = $conn->query($CekExist); 
                                      if($rowCekExist->num_rows > 0){
                                            $resCekExist = $rowCekExist->fetch_assoc();
                                         
                                      }else{
                                            ?>
                                            <tr>
                                               <td><?php 
                                                    echo $row->ph_date;
                                               ?></td>
                                               <td><?php 
                                                    //echo $row->ph_date;
                                                    echo date("d/m/Y", strtotime($row->ph_date));
                                               ?></td>
                    
                                               <td><?php echo $row->ph_job_id;?></td>
                    
                                               <td><?php 
                                                    //echo $row->ph_receipt;
                                                    $pad_length = 2;
                                                    $pad_char = 0;
                                                    if( $row->ph_receipt == 'temp' ){
                                                        $thisCycle = '01';
                                                    }else if (strpos($row->ph_receipt, 'beginning') !== false) {
                                                        $thisCycle = str_pad(filter_var($row->ph_receipt, FILTER_SANITIZE_NUMBER_INT), $pad_length, $pad_char, STR_PAD_LEFT);
                                                    }else{
                                                        $thisCycle = str_pad($row->ph_receipt, $pad_length, $pad_char, STR_PAD_LEFT).' (paid)';
                                                    }
                                                
                                                    //echo 'R'.$row->ph_job_id.$thisCycle;
                                                                           ?>
                                                   <a href="pdf_user.php?last=<?php echo $row->ph_id.generateRandomString();?>" target="_blank"><?php echo 'i'.$row->ph_job_id.$thisCycle;?></a>
                                               </td>
                    
                                               <td><?php echo number_format((($row->ph_amount + $row->ph_rf)), 2);?></td>
                                            </tr>
                                            <?php  
                                      }
                               }else{
                                    ?>
                                    <tr>
                                       <td><?php 
                                            echo $row->ph_date;
                                       ?></td>
                                       <td><?php 
                                            //echo $row->ph_date;
                                            echo date("d/m/Y", strtotime($row->ph_date));
                                       ?></td>
            
                                       <td><?php echo $row->ph_job_id;?></td>
            
                                       <td><?php 
                                            //echo $row->ph_receipt;
                                            $pad_length = 2;
                                            $pad_char = 0;
                                            if( $row->ph_receipt == 'temp' ){
                                                $thisCycle = '01';
                                            }else{
                                                $thisCycle = str_pad($row->ph_receipt, $pad_length, $pad_char, STR_PAD_LEFT).' (paid)';
                                            }
                                        
                                            //echo 'R'.$row->ph_job_id.$thisCycle;
                                                                   ?>
                                           <a href="pdf_user.php?last=<?php echo $row->ph_id.generateRandomString();?>" target="_blank"><?php echo 'i'.$row->ph_job_id.$thisCycle;?></a>
                                       </td>
            
                                       <td><?php echo number_format((($row->ph_amount + $row->ph_rf)), 2);?></td>
                                    </tr>
                                    <?php                                    
                               }

                           }

                        } else { 

                        ?>

                        <tr>

                           <td colspan="4"><?php echo 'You have not engaged any tutor yet. Once a class has started, the details will be displayed here'; ?></td>

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

         "columnDefs":[
            {"orderData": 0, "targets": 1},
            {"visible": false, "targets":0}
         ],

         "info":false,

         "searching":false,

         "lengthChange":false,

         "bSort":true,

         "bPaginate":true,

         "sPaginationType":"simple_numbers",

         "iDisplayLength": 10,
         
         "order": [[ 0, 'desc' ]],

         "columns": [            

            { "orderable": true },

            { "orderable": true },

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