<?php 

require_once('includes/head.php');

# SESSION CHECK #

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

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
$_SESSION['getPage'] = "List Of Classes";
?>

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<section class="clients_profile_2">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt "><?php echo LIST_OF_CLASSES; ?></h1>

         <?php include('includes/private_info.php'); ?>

         <ul class="nav nav-tabs" role="tablist">

            <li role="presentation" class="active"><a href="javascript: void(0);"><?php echo LIST_OF_CLASSES; ?></a></li>

            <!--<li role="presentation"><a href="tutor_payment_history.php"><?php echo PAYMENT_HISTORY; ?></a></li>-->

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

                           <td width="20%"><?php echo HOURS_LEFT; ?></td>

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


<?PHP
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
        $queryCity = "SELECT * FROM tk_cities WHERE city_id = '".$row->ud_city."' "; 
        $resultCity = $conn->query($queryCity); 
        if($resultCity->num_rows > 0){ 
            $rowCity = $resultCity->fetch_assoc();
            $nameCity = $rowCity['city_name']; 

        }
?>



                           <td><?php echo $row->ud_first_name.', '.$nameCity;//$row->u_displayname;//$row->cl_student;?></td>

                           <td><?php echo $row->cl_subject;?></td>

                           <td><?php 
if( $row->cl_hours_balance < 0){
	//echo '-';
	$outputTwoDigit =  number_format((float)$row->cl_hours_balance, 2, '.', '');
	
	$first = strtok($outputTwoDigit, '.');
	$searchForValue = '-';

	if( strpos($first, $searchForValue) !== false ) {
		echo preg_replace('/[ -]+/', ' - ', trim($first)) .' hours &';
	}else{
		echo intval($first) .' hours &';
	}
	echo '<br/>';
	echo substr($outputTwoDigit, strrpos($outputTwoDigit, '.' )+1) .' min';
}else{
	//echo '+';
	if( $row->cl_hours_balance == '-'){
		echo '00 hours & <br/> 00 min';
	}else{
		$outputTwoDigit =  number_format((float)$row->cl_hours_balance, 2, '.', '');
		$first = strtok($outputTwoDigit, '.');
		$searchForValue = '-';

		if( strpos($first, $searchForValue) !== false ) {
			echo preg_replace('/[ -]+/', ' - ', trim($first)) .' hours &';
		}else{
			echo intval($first) .' hours &';
		}
		echo '<br/>';
		echo substr($outputTwoDigit, strrpos($outputTwoDigit, '.' )+1) .' min';
		
	}
}



						   //echo $row->cl_hours_balance;?> <?php //echo HOURS; ?></td>

                           <td><?php echo $status[$row->cl_status];?></td>

                           <td>

                              <!--<a href="tutor_view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="view-button "><?php echo VIEW_DETAILS; ?></a>

                              <a href="tutor_view_class_detail.php?action=add_record&c_id=<?php echo $row->cl_id;?>" class="green-button ">+ <?php echo ADD_RECORD; ?></a>-->
							  
<a href="tutor_view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-search"></span> <?php echo "View"; //VIEW_DETAILS; ?></a>
<div style="margin-bottom:5px;"></div>
<a href="tutor_view_class_detail.php?action=add_record&c_id=<?php echo $row->cl_id;?>" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-plus"></span> &nbsp;<?php echo "Add"; //ADD_RECORD; ?>&nbsp;</a>


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