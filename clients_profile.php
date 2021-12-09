<?php 

require_once('includes/head.php');
require_once('mobile-detect/mobile-detect.php');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

# SESSION CHECK #
$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['auth'])) {

  header('Location: client_login.php');

  exit();

}



if ($_SESSION['auth']['user_role'] != '4') {

   header('Location:tutor_list_of_classes.php');

   exit();

}

$output = system::FireCurl(PARENT_CLASSES_URL ."?uid=". $_SESSION['auth']['user_id']);

$classes = $output->data;

$thisDisplayID = '';
$UserDetails = " SELECT * FROM tk_user WHERE u_id = '".$_SESSION['auth']['user_id']."' ";
$reUserDetails = $conn->query($UserDetails);
if ($reUserDetails->num_rows > 0) {
    $roUserDetails = $reUserDetails->fetch_assoc();
    $thisDisplayID = $roUserDetails['u_displayid'];
}


include('includes/header.php');

?>

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<style> 
.testting {

  background-color: black !important;

}
.tooltip-inner { 
    width:230px; 
    height:100px;  

} 

.nav>li>a:focus, .nav>li>a:hover {
  background-color: #F3F3F5;
}
</style> 

<button type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#myModal" id="myModalButton" data-backdrop="static" data-keyboard="false" >Open Modal</button>
<div id="myModal" class="modal fade" role="dialog" style="margin-top:5%">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p id="textModal" ></p>
      </div>
      <div class="modal-footer">
          <span id="buttonModal" ></span>
      </div>
    </div>

  </div>
</div>

<section class="clients_profile_2">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt"><?php echo CLIENT_PROFILE; ?></h1>

         <?php include('includes/parent_info.php'); ?>

         <ul class="nav nav-pills" role="tablist">

            <li role="presentation" class=" "><a style="background-color: #979797;color: white;" data-toggle="tab" href="#home" href="javascript: void(0);"><?php echo 'My Feedbacks'; //LIST_OF_CLASSES; ?></a></li>
            <?PHP
            $arrayJob = array();
            $ListJob = " SELECT j_id, j_payment_status, j_deadline, u_id FROM tk_job WHERE u_id = '".$_SESSION['auth']['user_id']."' AND j_payment_status = 'paid' AND j_deadline != '' AND j_deadline != '0000-00-00' ";
            $resultListJob = $conn->query($ListJob);
            if ($resultListJob->num_rows > 0) {
                while($rowListJob = $resultListJob->fetch_assoc()){
                   $arrayJob[] = $rowListJob['j_id'];
                }
                /*echo "<pre>";
                var_dump($arrayJob);
                echo "</pre>";*/
                if(!empty($arrayJob)){
                    $CheckForm = " SELECT displayid FROM tk_rform WHERE displayid = '".$thisDisplayID."' ";
                    $resCheckForm = $conn->query($CheckForm);
                    if ($resCheckForm->num_rows == 0) {
                        echo '<li role="presentation" class=" "><a style="background-color: #979797;color: white;" href="https://www.tutorkami.com/rform?token='.$thisDisplayID.'" target="_blank" >Please click to fill in the registration form</a></li>';
                    }
                }
            }
            ?>
            
            
            <!--<li <?PHP //echo $onclick; ?> ><a style="<?PHP //echo $welcomeWa; ?>" data-toggle="tab" href="#menu1"><?PHP //echo $textTab; ?></a> </li>->
            <?PHP
            /*
                if( $onclick != '' ){
                    echo '<li style="background-color: #F3F3F5;color: white;"> <a data-toggle="tooltip" data-placement="bottom" title="Before click, make sure your device/mobile phone has What’s App in it. After click, make sure you click Send/Enter to confirm subscribe" ><i class="glyphicon glyphicon-question-sign" style="color:#262262;"></i></a> </li>';
                }*/
            ?>
         </ul>         

          <div class="tab-content">
<?php 
//echo $getUserDetails->data[0]->ud_phone_number; 
//echo $welcomeWa;
?>
            <div id="home" class="tab-pane fade in active">
              <h3></h3>
            <!--<div role="tabpanel" class="active" id="home">
               <div class="job-table">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive  text-center" style="background:#fff;" id="dataTables_cl">
                     <thead>
                        <tr class="blue-bg">
                           <td><a href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="right" title="<?php echo TOOLTIP_SORT_BY_ID; ?>"><?php echo ID_NO; ?> </a></td>
                           <td><?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Nama Pelajar"; }else{ echo "Student's Name"; }?></td>
                           <td><?php echo SUBJECT; ?></td>
                           <td><a href="javascript: void(0);" class="btn_edit_d tip-right" data-toggle="btnToolTip" data-placement="right" title="<?php echo TOOLTIP_SORT_BY_STATUS; ?>"><?php echo STATUS; ?></a></td>                           
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
                           <td class="sky-txt"><a href="view_class_detail.php?c_id=<?php echo $row->cl_id;?>" class="btn_edit tip-right" data-toggle="btnToolTip" data-placement="right" title="Click id no to view detail"><?php echo $row->cl_display_id;?></a></td>
                           <td><?php echo $row->cl_student; ?></td>
                           <td><?php echo $row->cl_subject; ?></td>
                           <td><?php echo $status[$row->cl_status];?></td>
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
            </div>-->
            </div>
            
            <!--<div id="menu1" class="tab-pane fade">
              <h3></h3><br/>
              <center><p><?PHP //echo $textInfo; ?></p></center>
            </div>-->
            
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

            null,

            { "orderable": false }

         ]

      });



      $(".clickable-row").click(function() {

           window.location = $(this).data("href");

      });

      

   });
function myFunction() {
    document.getElementById('textModal').innerHTML = 'Please click Ok';
    document.getElementById('buttonModal').innerHTML = '<button type=button class=btn btn-default onClick=closeModal()>Ok</button>';
    document.getElementById('myModalButton').click();   
    window.open("https://wa.me/60103169072?text=Allow%20automatic%20message%20from%20TutorKami.com");
}

function myFunction2(val) {
    if( val != '' ){
      $.ajax({
        type: "POST",
        url: 'active-phone.php',
        data: {val: val},
        success: function(response){
            document.location.reload(true);      
        }
      });        
    }else{
        alert('Error');
    }
}
function closeModal() {
  window.location.href = 'https://www.tutorkami.com/clients_profile';
}

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
