<?php 

require_once('includes/head.php');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

# SESSION CHECK #

if (!isset($_SESSION['auth'])) {

  //header('Location: login.php');
  header('Location: client_login.php');


  exit();

}

if ($_SESSION['auth']['user_role'] != '4') {

   header('Location:tutor_list_of_classes.php');

   exit();

}

$output = system::FireCurl(PARENT_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']);

$classes = $output->data;

      $goTo = " SELECT * FROM tk_user WHERE u_id = '".$_SESSION['auth']['user_id']."' "; 
      $resultgoTo = $conn->query($goTo); 
      if($resultgoTo->num_rows > 0){
            $rowgoTo = $resultgoTo->fetch_assoc();
            
            if ( $rowgoTo['signature_img'] == '' && $rowgoTo['signature_img2'] == '') {
                  header("Location: https://www.tutorkami.com/clients-terms");
            }            
      }

include('includes/header.php');

?>
<style>
.btn-primary2 { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-primary2:hover, 
.btn-primary2:focus, 
.btn-primary2:active, 
.btn-primary2.active, 
.open .dropdown-toggle.btn-primary2 { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-primary2:active, 
.btn-primary2.active, 
.open .dropdown-toggle.btn-primary2 { 
  background-image: none; 
} 
 
.btn-primary2.disabled, 
.btn-primary2[disabled], 
fieldset[disabled] .btn-primary2, 
.btn-primary2.disabled:hover, 
.btn-primary2[disabled]:hover, 
fieldset[disabled] .btn-primary2:hover, 
.btn-primary2.disabled:focus, 
.btn-primary2[disabled]:focus, 
fieldset[disabled] .btn-primary2:focus, 
.btn-primary2.disabled:active, 
.btn-primary2[disabled]:active, 
fieldset[disabled] .btn-primary2:active, 
.btn-primary2.disabled.active, 
.btn-primary2[disabled].active, 
fieldset[disabled] .btn-primary2.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-primary2 .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}

.tooltip-inner { 
    width:180px; 
}
.tooltip-inner {
    white-space:pre-wrap;
}
.table thead td{
    border-right: none !important;
    border-left: none !important;

}

table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc_disabled:before {
    display : none;
  content: "" !important;
}
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_desc_disabled:after {
    display : none;
  content: "" !important;
}

.table tbody td{
    border-bottom: #f2f2f2 solid 1px !important;
    border-right: none !important;
    border-left: none !important;
}
</style>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<section class="clients_profile_2">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt "><?php echo 'DETAILS'; //LIST_OF_CLASSES; ?></h1>

         <?php //include('includes/parent_info.php'); ?>
            <?php 
            $getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$_SESSION['auth']['user_id']);
            if( $deviceIs == 'desktop' ){
                $imageHours = HOURS_LEFT; 
            }else{
                $imageHours = '<img data-toggle="btnToolTip" data-placement="bottom" title="Duration of hours tutor need to do to complete 1 cycle"  src="images/duration-icon-29.png" alt="Duration" width="25" height="25">'; 
            }
            ?>
            <div class="col-md-12 ">
               <hr>
               <!--<h3 class="org-txt"><strong><?php echo WELCOME; ?> <?php echo $getUserDetails->data[0]->ud_first_name; ?> <?php //echo $getUserDetails->data[0]->ud_last_name; ?></strong></h3>-->
               <br> 

               <p>

                   <?PHP
                   if( $deviceIs == 'mobile' ){
                       echo 'For classes with icon <img border="0"  src="images/verified.png" width="20" height="20"> please verify the latest record submitted by tutor
                       <br/><br/>You can click some icon/header/text below to see more details.
                       <br/><br/>Click Invoice/Receipt to view documents related to payments 
                       ';
                   }else{
                       echo 'For classes with icon <img border="0"  src="images/verified.png" width="20" height="20"> please verify the latest record submitted by tutor
                       <br/><br/>Click Invoice/Receipt to view documents related to payments';
                   }
                   ?>
               </p>
               <div class="clearfix"></div>
               <hr>
            </div>
         

         <ul class="nav nav-tabs" role="tablist">

            <li role="presentation" class="active"><a href="javascript: void(0);"><?php echo 'My Classes';//LIST_OF_CLASSES; ?></a></li>

            <li role="presentation"><a href="payment_history.php"><?php echo 'Invoice/Receipt';//PAYMENT_HISTORY; ?></a></li>

         </ul>

         <div class="tab-content">

            <div role="tabpanel" class="active" id="home">

               <div class="job-table">

                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive  text-center" style="background:#fff;" id="dataTables_cl">

                     <thead>

                        <tr class="blue-bg">

                           <!--<td><a href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="right" title="<?php echo TOOLTIP_SORT_BY_ID; ?>"><?php echo ID_NO; ?></a></td>-->
                           <td><a style="text-decoration: none;" href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="bottom" title="<?php echo 'Click it to sort rows by Class IDs'; //echo TOOLTIP_SORT_BY_ID; ?>"><font style="color:#fff;margin-right:-12px;"><?php echo 'Class&nbsp;ID'; //echo 'Job&nbsp;ID';?></font></a></td>

                           <td><?php echo STUDENT_NAME; ?></td>

                           <?PHP
                           if( $deviceIs == 'desktop' ){
                                echo '<td>'.SUBJECT.'</td>';
                           }else{
                                echo '<td><a style="text-decoration: none;" href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="bottom" title="Click the subject name below to see details"><font style="color:#fff;margin-right:-12px;">'.SUBJECT.'</font></a></td>';
                           }
                           ?>

                           <td width="20%"><?php echo $imageHours; ?></td>

                           <td><a style="text-decoration: none;" href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="bottom" title="<?php echo 'Click Status to sort Classes by its status'; //echo TOOLTIP_SORT_BY_STATUS; ?>"><font style="color:#fff;margin-right:-12px;"><?php echo STATUS; ?></font></a></td> 

                           <td>Action</td>

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
                               
                                $studentName = '';
                                $ListJob = " SELECT j_id, student_name FROM tk_job where j_id = '".$row->cl_display_id."' ";
                                $resultListJob = $conn->query($ListJob);
                                if ($resultListJob->num_rows > 0) {
                                    $rowListJob = $resultListJob->fetch_assoc();
                                    $studentName = $rowListJob['student_name'];
                                       
                                }
                        ?>

                        <tr>

                           <td class="sky-txt"><a href="view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn_edit tip-right" data-toggle="btnToolTip" data-placement="right" title="Click id no to view detail"><?php echo $row->cl_display_id;?></a></td>

                           <td><?php echo $studentName; //$row->cl_student;//$row->u_displayname;?></td>


                       

                           <td><?php 
                                if( $deviceIs == 'desktop' ){
                                    echo $row->cl_subject;
                                }else{
                                    $firstWord = explode(' ',trim($row->cl_subject));
                                    //echo $firstWord[0]; 
                                    echo "<span data-toggle='btnToolTip' data-placement='bottom' title='".$row->cl_subject."' >".$firstWord[0]."</span>";
                                }
                           ?></td>
                           <td>
                           <?php 
                           
                                if( $deviceIs == 'desktop' ){
                                    $txtHours = ' hours &';
                                }else{
                                    $txtHours = ' hrs &';
                                }
                                if( $row->cl_hours_balance < 0){
                                	//echo '-';
                                	$outputTwoDigit =  number_format((float)$row->cl_hours_balance, 2, '.', '');
                                	
                                	$first = strtok($outputTwoDigit, '.');
                                	$searchForValue = '-';
                                
                                	if( strpos($first, $searchForValue) !== false ) {
                                		echo preg_replace('/[ -]+/', ' - ', trim($first)) .$txtHours;
                                	}else{
                                		echo intval($first) .$txtHours;
                                	}
                                	echo '<br/>';
                                	echo substr($outputTwoDigit, strrpos($outputTwoDigit, '.' )+1) .' min';
                                }else{
                                	//echo '+';
                                	if( $row->cl_hours_balance == '-'){
                                		echo '00'.$txtHours.' <br/> 00 min';
                                	}else{
                                		$outputTwoDigit =  number_format((float)$row->cl_hours_balance, 2, '.', '');
                                		$first = strtok($outputTwoDigit, '.');
                                		$searchForValue = '-';
                                
                                		if( strpos($first, $searchForValue) !== false ) {
                                			echo preg_replace('/[ -]+/', ' - ', trim($first)) .$txtHours;
                                		}else{
                                			echo intval($first) .$txtHours;
                                		}
                                		echo '<br/>';
                                		echo substr($outputTwoDigit, strrpos($outputTwoDigit, '.' )+1) .' min';
                                		
                                	}
                                }

						   //echo $row->cl_hours_balance;?> <?php //echo HOURS; ?></td>
                           

                           <td><?php echo $status[$row->cl_status];?></td>

                           <td>
                                <?PHP
                                $thisVerify = 'No';
                                $NeedVerify = " SELECT cr_cl_id, cr_parent_verification FROM tk_classes_record WHERE cr_cl_id = '".$row->cl_id."' AND (cr_parent_verification IS NULL OR cr_parent_verification = '') "; 
                                $resultNeedVerify = $conn->query($NeedVerify); 
                                if($resultNeedVerify->num_rows > 0){
                                    $rowNeedVerify = $resultNeedVerify->fetch_assoc();
                                    $thisVerify = 'Yes';
                                }


                                if( $deviceIs == 'desktop' ){
                                        if( $thisVerify == 'No' ){
                                            ?><a href="view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-search"></span> View</a><?PHP
                                            ?><div style="margin-bottom:5px;"></div><?PHP
                                        }else{
                                            ?><a href="vclass.php?c_id=<?php echo $row->cl_id;?>" ><img border="0"  src="images/verified.png" width="30" height="30"></a><?PHP
                                        }
                                }else{
                                        if( $thisVerify == 'No' ){
                                            ?><a href="view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-search"></span></a><?PHP
                                            ?><div style="margin-bottom:5px;"></div><?PHP
                                        }else{
                                            ?><a href="vclass.php?c_id=<?php echo $row->cl_id;?>" ><img border="0"  src="images/verified.png" width="30" height="30"></a><?PHP
                                        }
                                }
                                ?>
                           </td>

                        </tr>

                        <?php 

                           }

                        } else { 

                        ?>

                        <tr>

                           <td colspan="6"><?php echo 'You have not engaged any tutor yet. Once a class has started, the details will be updated here'; ?></td>

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
          
          "order": [[ 0, "desc" ]],

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