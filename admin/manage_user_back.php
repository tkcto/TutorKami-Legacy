<?php
require_once('includes/head.php');
require_once('classes/user.class.php');
require_once('classes/location.class.php');
require_once('classes/app.class.php');


/* START - fahli = create,update image/picture */
require_once('../includes/create-thumb.php');
require_once('create-thumb2.php');
define('IMAGE_SMALL_DIR', '../images/profile/small/');
define('IMAGE_SMALL_SIZE', 50);
define('IMAGE_MEDIUM_DIR', '../images/profile/');
define('IMAGE_MEDIUM_SIZE', 250);
/* END - fahli */

$userInit = new user;
$initLocation = new location;
$initApp = new app;


$resCnt = $initLocation->GetAllCountry();
$roleData = $userInit->GetAllRole();


if (count($_FILES) > 0) {

    $testimonial_path = array();
	
    $dataPic = $_POST;
		
    $testiFileName = date("Ymd-His")."-".$dataPic['u_displayid'];
	
    if(isset($_FILES['user_testimonial1']['name']) && $_FILES['user_testimonial1']['name'] != ''){
        /*$testimonialname = $_FILES['user_testimonial1']['name'];
        $testimonialtemp = $_FILES['user_testimonial1']['tmp_name'];
        $testimonialext  = explode(".", $testimonialname);
        $testimonialext  = end($testimonialext);
        $allowedext      = array('jpg', 'jpeg', 'png', 'bmp', 'JPEG', 'JPG');

        if(in_array($testimonialext, $allowedext)){
            //move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
            //$testimonial_path['user_testimonial1'] = "files/".$testimonialname;
			
            move_uploaded_file($testimonialtemp, "../images/testimonial/".time()."_".$testimonialname);
            $testimonial_path['user_testimonial1'] = "images/testimonial/".time()."_".$testimonialname;
			
        }*/
		  $testimonialname = $_FILES['user_testimonial1']['name'];
		  $testimonialext  = explode(".", $testimonialname);
		  $testimonialext  = end($testimonialext);
		  $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
		  if(in_array($testimonialext, $allowedext)){			
			process_image_upload_testi('user_testimonial1', $testiFileName.'-1');
			$testimonial_path['user_testimonial1'] = "images/testimonial/".$testiFileName.'-1.jpg';
		  }
    }else{
        $testimonial_path['user_testimonial1']= '';
        // Session::SetFlushMsg("danger", 'Image format not correct.');
        // echo 'danger';//luqman hidekan
    }
	
    if(isset($_FILES['user_testimonial2']['name']) && $_FILES['user_testimonial2']['name'] != ''){
        /*$testimonialname = $_FILES['user_testimonial2']['name'];
        $testimonialtemp = $_FILES['user_testimonial2']['tmp_name'];
        $testimonialext  = explode(".", $testimonialname);
        $testimonialext  = end($testimonialext);
        $allowedext      = array('jpg', 'jpeg', 'png', 'bmp', 'JPEG', 'JPG');

        if(in_array($testimonialext, $allowedext)){
            //move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
            //$testimonial_path['user_testimonial2'] = "files/".$testimonialname;
			
            move_uploaded_file($testimonialtemp, "../images/testimonial/".time()."_".$testimonialname);
            $testimonial_path['user_testimonial2'] = "images/testimonial/".time()."_".$testimonialname;
        }*/
		  $testimonialname = $_FILES['user_testimonial2']['name'];
		  $testimonialext  = explode(".", $testimonialname);
		  $testimonialext  = end($testimonialext);
		  $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
		  if(in_array($testimonialext, $allowedext)){			
			process_image_upload_testi('user_testimonial2', $testiFileName.'-2');
			$testimonial_path['user_testimonial2'] = "images/testimonial/".$testiFileName.'-2.jpg';
		  }
    }else{
        $testimonial_path['user_testimonial2']= '';
    }
	
    if(isset($_FILES['user_testimonial3']['name']) && $_FILES['user_testimonial3']['name'] != ''){
        /*$testimonialname = $_FILES['user_testimonial3']['name'];
        $testimonialtemp = $_FILES['user_testimonial3']['tmp_name'];
        $testimonialext  = explode(".", $testimonialname);
        $testimonialext  = end($testimonialext);
        $allowedext      = array('jpg', 'jpeg', 'png', 'bmp', 'JPEG', 'JPG');

        if(in_array($testimonialext, $allowedext)){
            //move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
            //$testimonial_path['user_testimonial3'] = "files/".$testimonialname;
			
            move_uploaded_file($testimonialtemp, "../images/testimonial/".time()."_".$testimonialname);
            $testimonial_path['user_testimonial3'] = "images/testimonial/".time()."_".$testimonialname;
        }*/
		  $testimonialname = $_FILES['user_testimonial3']['name'];
		  $testimonialext  = explode(".", $testimonialname);
		  $testimonialext  = end($testimonialext);
		  $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
		  if(in_array($testimonialext, $allowedext)){			
			process_image_upload_testi('user_testimonial3', $testiFileName.'-3');
			$testimonial_path['user_testimonial3'] = "images/testimonial/".$testiFileName.'-3.jpg';
		  }
    }else{
        $testimonial_path['user_testimonial3']= '';
    }
	
    if(isset($_FILES['user_testimonial4']['name']) && $_FILES['user_testimonial4']['name'] != ''){
        /*$testimonialname = $_FILES['user_testimonial4']['name'];
        $testimonialtemp = $_FILES['user_testimonial4']['tmp_name'];
        $testimonialext  = explode(".", $testimonialname);
        $testimonialext  = end($testimonialext);
        $allowedext      = array('jpg', 'jpeg', 'png', 'bmp', 'JPEG', 'JPG');

        if(in_array($testimonialext, $allowedext)){
            //move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
            //$testimonial_path['user_testimonial4'] = "files/".$testimonialname;
			
            move_uploaded_file($testimonialtemp, "../images/testimonial/".time()."_".$testimonialname);
            $testimonial_path['user_testimonial4'] = "images/testimonial/".time()."_".$testimonialname;
        }*/
		  $testimonialname = $_FILES['user_testimonial4']['name'];
		  $testimonialext  = explode(".", $testimonialname);
		  $testimonialext  = end($testimonialext);
		  $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
		  if(in_array($testimonialext, $allowedext)){			
			process_image_upload_testi('user_testimonial4', $testiFileName.'-4');
			$testimonial_path['user_testimonial4'] = "images/testimonial/".$testiFileName.'-4.jpg';
		  }
    }else{
        $testimonial_path['user_testimonial4']= '';
    }


    $name       = $_FILES['u_profile_pic']['name'];
    $imgext     = explode(".", $name);
    $imgext     = end($imgext);
    $tmpname    = $_FILES['u_profile_pic']['tmp_name'];
    $extension  = array('jpg', 'jpeg', 'png', 'bmp', 'JPEG', 'JPG');
    $name = uniqid().$imgext[0]."_0".$imgext[1];
// luqmanimage
    $path_parts = pathinfo($_FILES['u_profile_pic']['name']);//man

    if(in_array($imgext, $extension)){

      //move_uploaded_file($tmpname, "../images/profile/000".$path_parts['filename'].'_0.jpg');

          //$picture_path = $path_parts['filename'];
		

		/* START fadhli*/		
		/*create directory with 777 permission if not exist - start*/
		//createDir(IMAGE_SMALL_DIR);
		createDir(IMAGE_MEDIUM_DIR);
		
		//$imagenumber = rand(5000,10000);
		//$dataPic = $_POST;
		
		$namaFile = date("Ymd-His")."-".$dataPic['u_email'];
		$path[0] = $_FILES['u_profile_pic']['tmp_name'];
		$file = pathinfo($_FILES['u_profile_pic']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		//$fileNameNew = "000".$imagenumber.'_0.jpg';
		$fileNameNew = $namaFile.'.jpg';
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
		
		createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE);
		//createThumb($path[1], $path[2],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE);
		//$picture_path = $imagenumber;
		$picture_path = $namaFile;
		/* END - fadhli */
		
    }
// luqmanimage
    if (isset($_FILES['ud_proof_of_accepting_terms'])) {

        $proof_name       = $_FILES['ud_proof_of_accepting_terms']['name'];
        $proof_imgext     = explode(".", $proof_name);
        $proof_imgext     = end($proof_imgext);
        $proof_tmpname    = $_FILES['ud_proof_of_accepting_terms']['tmp_name'];
        $proof_extension  = array('jpg', 'jpeg', 'png', 'bmp', 'JPEG', 'JPG');

        if(in_array($proof_imgext, $proof_extension)){
            //move_uploaded_file($proof_tmpname, "../files/proof_".time().'.'.$proof_imgext);
            //$proof_picture_path = "files/proof_".time().'.'.$proof_imgext;
			
			/*fadhli - change dir */
			move_uploaded_file($proof_tmpname, "../images/proof/proof_".time().'.'.$proof_imgext);
            $proof_picture_path = "images/proof/proof_".time().'.'.$proof_imgext;
        }
    }
}

if (count($_POST) > 0) {
    $data = $_POST;

    $data['u_profile_pic'] = isset($picture_path) ? $picture_path : '';
    $data['ud_proof_of_accepting_terms'] = isset($proof_picture_path) ? $proof_picture_path : '';
    $data['u_testimonial'] = count($testimonial_path) > 0 ? $testimonial_path : '';

    $saveData = $userInit->SaveUser($data);




    // luqman
    if ($saveData !== false) {
        if (isset($_POST['save'])) {
            header('Location:manage_user.php');
            exit();
          // echo "test1";
        } elseif (isset($_POST['save_edit'])) {
            // header('Location:manage_user.php?action=edit&u_id='.$saveData);
          
          $u_id = $_GET['u_id'];
          if($u_id != ''){
          header('Location:manage_user.php?action=edit&u_id='.$u_id);
            exit();
          }
            // ni untuk save continue masa register
          // }elseif($displayid !=''){
          //   header('Location:manage_user.php?action=edit&u_id='.$displayid);
          //   exit();
          // }
        } elseif (isset($_POST['approve_tutor'])) {
            $approveTutor = $userInit->ApproveUser($saveData);
            header('Location:manage_user.php?action=edit&u_id='.$saveData);
            exit();
        }
/* START fadhli - Manual Activated*/
else if (isset($_POST['manualActivated'])) {
            $manualActivated = $userInit->ManualActivated($saveData);
            header('Location:manage_user.php?action=edit&u_id='.$saveData);
            exit();
}	
else if (isset($_POST['manualActive'])) {
            $manualActive = $userInit->manualActive($saveData);
            header('Location:manage_user.php?action=edit&u_id='.$saveData);
            exit();
}

/* END fadhli */
		
		
    }
    // luqman
}

if(isset($_GET['action']) && $_GET['action'] == 'approve_tutor') {
    if (isset($_GET['u_id']) && $_GET['u_id'] != '') {
        $saveData = $userInit->ApproveUser($_GET['u_id']);
        header('Location:manage_user.php?action=edit&u_id='.$_GET['u_id']);
        exit();
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_user') {
    if (isset($_GET['u_id']) && $_GET['u_id'] != '') {
        $saveData = $userInit->DeleteUser($_GET['u_id']);
        header('Location:manage_user.php');
        exit();
    }
}


if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>


<!DOCTYPE html>
<html>
   <head>
   <?php
    $title = 'Manage User | Tutorkami';
    require_once('includes/html_head.php');
   ?>

    <link rel="stylesheet" type="text/css" href="css/manageusercss/jquery.dataTables.min.css"></style>
     <link rel="stylesheet" type="text/css" href="css/manageusercss/jquery-ui.css">
    
    <!-- Luqman -->
    <script type="text/javascript" language="javascript" src="js/manageuserjs/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.jqueryui.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.jqueryui.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/jszip.min.js"></script>
    <!-- <script type="text/javascript" language="javascript" src="js/manageuserjs/pdfmake.min.js"></script> -->
    <!-- <script type="text/javascript" language="javascript" src="js/manageuserjs/vfs_fonts.js"></script> -->
    <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.print.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.colVis.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.checkboxes.min.js"></script>
    <!-- Luqman -->

    <!-- <script type="text/javascript" language="javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.9/js/dataTables.checkboxes.min.js"></script> -->
    <script type="text/javascript" language="javascript" src="js/plugins/pace/pace.min.js"></script>
   <script type="text/javascript" language="javascript" src="js/manage_user.js"></script>
   
<!-- https://developer.snapappointments.com/bootstrap-select/ -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
   

   <style>
      .localization .dt-buttons.btn-group {
         display: block;
      }
      .html5buttons {
         float: left;
      }

   </style>
<style>
[data-tooltip],
.tooltip {
  position: relative;
  cursor: pointer;
}

/* Base styles for the entire tooltip */
[data-tooltip]:before,
[data-tooltip]:after,
.tooltip:before,
.tooltip:after {
  position: absolute;
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: 
      opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        -webkit-transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
    -moz-transition:    
        opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        -moz-transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
    transition:         
        opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform:    translate3d(0, 0, 0);
  transform:         translate3d(0, 0, 0);
  pointer-events: none;
}

/* Show the entire tooltip on hover and focus */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after,
[data-tooltip]:focus:before,
[data-tooltip]:focus:after,
.tooltip:hover:before,
.tooltip:hover:after,
.tooltip:focus:before,
.tooltip:focus:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

/* Base styles for the tooltip's directional arrow */
.tooltip:before,
[data-tooltip]:before {
  z-index: 1001;
  border: 6px solid transparent;
  background: transparent;
  content: "";
}

/* Base styles for the tooltip's content area */
.tooltip:after,
[data-tooltip]:after {
  z-index: 1000;
  padding: 8px;
  /*width: 160px;*/
  width: 260px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  font-size: 14px;
  line-height: 1.2;
}

/* Directions */

/* Top (default) */
[data-tooltip]:before,
[data-tooltip]:after,
.tooltip:before,
.tooltip:after,
.tooltip-top:before,
.tooltip-top:after {
  bottom: 100%;
  left: 50%;
}

[data-tooltip]:before,
.tooltip:before,
.tooltip-top:before {
  margin-left: -6px;
  margin-bottom: -12px;
  border-top-color: #000;
  border-top-color: hsla(0, 0%, 20%, 0.9);
}

/* Horizontally align top/bottom tooltips */
[data-tooltip]:after,
.tooltip:after,
.tooltip-top:after {
  margin-left: -80px;
}

[data-tooltip]:hover:before,
[data-tooltip]:hover:after,
[data-tooltip]:focus:before,
[data-tooltip]:focus:after,
.tooltip:hover:before,
.tooltip:hover:after,
.tooltip:focus:before,
.tooltip:focus:after,
.tooltip-top:hover:before,
.tooltip-top:hover:after,
.tooltip-top:focus:before,
.tooltip-top:focus:after {
  -webkit-transform: translateY(-12px);
  -moz-transform:    translateY(-12px);
  transform:         translateY(-12px); 
}

/* Left */
.tooltip-left:before,
.tooltip-left:after {
  right: 100%;
  bottom: 50%;
  left: auto;
}

.tooltip-left:before {
  margin-left: 0;
  margin-right: -12px;
  margin-bottom: 0;
  border-top-color: transparent;
  border-left-color: #000;
  border-left-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-left:hover:before,
.tooltip-left:hover:after,
.tooltip-left:focus:before,
.tooltip-left:focus:after {
  -webkit-transform: translateX(-12px);
  -moz-transform:    translateX(-12px);
  transform:         translateX(-12px); 
}

/* Bottom */
.tooltip-bottom:before,
.tooltip-bottom:after {
  top: 100%;
  bottom: auto;
  left: 50%;
}

.tooltip-bottom:before {
  margin-top: -12px;
  margin-bottom: 0;
  border-top-color: transparent;
  border-bottom-color: #000;
  border-bottom-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-bottom:hover:before,
.tooltip-bottom:hover:after,
.tooltip-bottom:focus:before,
.tooltip-bottom:focus:after {
  -webkit-transform: translateY(12px);
  -moz-transform:    translateY(12px);
  transform:         translateY(12px); 
}

/* Right */
.tooltip-right:before,
.tooltip-right:after {
  bottom: 50%;
  left: 100%;
}

.tooltip-right:before {
  margin-bottom: 0;
  margin-left: -12px;
  border-top-color: transparent;
  border-right-color: #000;
  border-right-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-right:hover:before,
.tooltip-right:hover:after,
.tooltip-right:focus:before,
.tooltip-right:focus:after {
  -webkit-transform: translateX(12px);
  -moz-transform:    translateX(12px);
  transform:         translateX(12px); 
}

/* Move directional arrows down a bit for left/right tooltips */
.tooltip-left:before,
.tooltip-right:before {
  top: 3px;
}

/* Vertically center tooltip content for left/right tooltips */
.tooltip-left:after,
.tooltip-right:after {
  margin-left: 0;
  margin-bottom: -16px;
}

.cursor{
    cursor:pointer;cursor:hand

}
</style>
<style>
.alert {
padding: 8px 35px 8px 14px;
margin-bottom: 18px;
color: #c09853;
text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
background-color: #fcf8e3;
border: 1px solid #fbeed5;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}

.alert-heading {
color: inherit;
}

.alert .close {
position: relative;
top: -2px;
right: -21px;
line-height: 18px;
}
.alert-success {
color: #468847;
background-color: #dff0d8;
border-color: #d6e9c6;
}

.btn-excel { 
  color: #ffffff; 
  background-color: #454447; 
  border-color: #454447; 
} 
 
.btn-excel:hover, 
.btn-excel:focus, 
.btn-excel:active, 
.btn-excel.active, 
.open .dropdown-toggle.btn-excel { 
  color: #ffffff; 
  background-color: #3B393D; 
  border-color: #454447; 
} 
 
.btn-excel:active, 
.btn-excel.active, 
.open .dropdown-toggle.btn-excel { 
  background-image: none; 
} 
 
.btn-excel.disabled, 
.btn-excel[disabled], 
fieldset[disabled] .btn-excel, 
.btn-excel.disabled:hover, 
.btn-excel[disabled]:hover, 
fieldset[disabled] .btn-excel:hover, 
.btn-excel.disabled:focus, 
.btn-excel[disabled]:focus, 
fieldset[disabled] .btn-excel:focus, 
.btn-excel.disabled:active, 
.btn-excel[disabled]:active, 
fieldset[disabled] .btn-excel:active, 
.btn-excel.disabled.active, 
.btn-excel[disabled].active, 
fieldset[disabled] .btn-excel.active { 
  background-color: #454447; 
  border-color: #454447; 
} 
#startDateExcel, #endDateExcel {
    width: 50%;  
    float: left;
}

.alert {
  padding: 15px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 4px;
}

.alert h4 {
  margin-top: 0;
  color: inherit;
}

.alert .alert-link {
  font-weight: bold;
}

.alert > p,
.alert > ul {
  margin-bottom: 0;
}

.alert > p + p {
  margin-top: 5px;
}

.alert-dismissable,
.alert-dismissible {
  padding-right: 35px;
}

.alert-dismissable .close,
.alert-dismissible .close {
  position: relative;
  top: -2px;
  right: -21px;
  color: inherit;
}

.alert-success {
  background-color: #dff0d8;
  border-color: #d6e9c6;
  color: #3c763d;
}

.alert-success hr {
  border-top-color: #c9e2b3;
}

.alert-success .alert-link {
  color: #2b542c;
}

.alert-info {
  background-color: #d9edf7;
  border-color: #bce8f1;
  color: #31708f;
}

.alert-info hr {
  border-top-color: #a6e1ec;
}

.alert-info .alert-link {
  color: #245269;
}

.alert-warning {
  background-color: #fcf8e3;
  border-color: #faebcc;
  color: #8a6d3b;
}

.alert-warning hr {
  border-top-color: #f7e1b5;
}

.alert-warning .alert-link {
  color: #66512c;
}

.alert-danger {
  background-color: #f2dede;
  border-color: #ebccd1;
  color: #a94442;
}

.alert-danger hr {
  border-top-color: #e4b9c0;
}

.alert-danger .alert-link {
  color: #843534;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
  border-radius: 5px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
</style>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>

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

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {
    //echo "Update Is Successful";
}
//$dbCon->close();
?>
            
            <?php
            if(isset($_GET['action']) && $_GET['action'] == 'add_new') {
				//include_once('manage_user_add.php');
				/*fadhli 23/11/2018 - create new form, tak nak ada conflict dgn edit form*/
				/*if($_SESSION[DB_PREFIX]['u_first_name'] == 'mohd nurfadhli'){
					include_once('add-new-user.php');
				}else{
					include_once('manage_user_add.php');
				}*/
				include_once('manage_user_add.php');
            }
            elseif(isset($_GET['action']) && $_GET['action'] == 'edit') {
				$userData = $userInit->GetAllUser('', $_GET['u_id']);//luqman tuka baru
				$userRow = $userData->fetch_array(MYSQLI_ASSOC);
				//   // var_dump($GET['u_id']);die;
				include_once('manage_user_add.php');
            }
            else {
               $userData = $userInit->GetAllUser();
           }
            ?>

            <div class="wrapper wrapper-content animated fadeInRight" <?php if(isset($_GET['action']) && ($_GET['action'] == 'edit' || $_GET['action'] == 'add_new')) echo "hidden"; ?>>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox float-e-margins localization">
                        <div class="ibox-title">
                           <h5>User Listing</h5> <?php //echo $_SESSION[DB_PREFIX]['u_id']; ?>
                           <div class="ibox-tools">
                              <!--<a href="manage_user.php?action=add_new" class="btn btn-primary ">Add New</a>-->
                              <a href="add-new-user.php" class="btn btn-primary ">Add New</a>
                           </div>
                        </div>
                        <div class="ibox-content">
                           <div class="form-horizontal">
                              <form action="manage_user.php" method="get">
                                 <input type="hidden" name="action" value="edit">
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">User ID :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <div class="input-group">
                                          <input type="text" class="form-control" name="u_id" id="u_id">
                                          <span class="input-group-btn">
                                             <button type="submit" class="btn btn-primary">Go</button>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                              <form action="manage_user" method="POST" id="filter_user">
                                 <input type="hidden" name="action" id="action" value="search_user" />
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">List Tutors Only :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="is_tutor" id="is_tutor" >
                                          <option value="All">All</option>
                                          <option value="Yes">Yes</option>
                                          <option value="No">No</option>
										  <?PHP if($_SESSION[DB_PREFIX]['r_id'] == 1){
                                           echo '<option value="Admin">Admin</option>';
										  } ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors" id="withpic" style="display: block;">
                                    <label class="col-lg-3 control-label">With Picture :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="user_w_image" id="user_w_image">
                                          <option value="All">All</option>
                                          <option value="Yes">Yes</option>
                                          <option value="No">No</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Email :</label>
                                    <div class="col-lg-4" style="width:50%"><input type="email" class="form-control" name="u_email" id="u_email" /></div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">First Name :</label>
                                    <div class="col-lg-4" style="width:50%"><input type="text" class="form-control" name="ud_first_name" id="ud_first_name" /></div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Last Name :</label>
                                    <div class="col-lg-4" style="width:50%"><input type="text" class="form-control" name="ud_last_name" id="ud_last_name" /></div>
                                 </div>
                                 <div class="form-group for-tutors" style="display: none;">
                                    <label class="col-lg-3 control-label">Displayed Name :</label>
                                    <div class="col-lg-4" style="width:50%"><input type="text" class="form-control" name="u_displayname" id="u_displayname" /></div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Phone :</label>
                                    <div class="col-lg-4" style="width:50%"><input type="text" class="form-control" name="ud_phone_number" id="ud_phone_number" /></div>
                                 </div>

                                 <div class="form-group for-tutors for-non-tutors">
                                    <label class="col-lg-3 control-label">Gender :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="u_gender" id="u_gender">
                                          <option value="">All</option>
                                          <option value="M">Male</option>
                                          <option value="F">Female</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Race :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="ud_race" id="ud_race">
                                          <option value="">All</option>
                                          <option value="Malay">Malay</option>
                                          <option value="Chinese">Chinese</option>
                                          <option value="Indian">Indian</option>
                                          <option value="Not selected">Others</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Tutor Status :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="ud_tutor_status" id="ud_tutor_status">
                                          <option value="">All</option>
                                          <option value="Full Time">Full Time</option>
                                          <option value="Part Time">Part Time</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Occupation :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">
                                          <option value="">All</option>
                                          <option value="Full-Time Tutor">Full-Time Tutor</option>
                                          <option value="Kindergarten Teacher">Kindergarten Teacher</option>
                                          <option value="Primary School Teacher">Primary School Teacher</option>
                                          <option value="Secondary School Teacher">Secondary School Teacher</option>
                                          <option value="Tuition Center Teacher">Tuition Center Teacher</option>
                                          <option value="Lecturer">Lecturer</option>
                                          <option value="Ex-Teacher">Ex-Teacher</option>
                                          <option value="Retired Teacher">Retired Teacher</option>
                                          <option value="Other">Other</option>
                                          <option value="unselected">Unselected</option>
                                       </select>
                                    </div>
                                 </div>
                                 
                                 
                                 
                              <div class="form-group for-tutors">
                                 <label class="col-sm-3 control-label">Current Location :</label>
                                 <div class="col-sm-3">

                                    <select class="js-example-basic-single cnty" name="search_ud_state" id="search_ud_state" style="width:100%;" data-required>
                                       <option value="">Please Select State</option>
                                       <?php 
                                       $country_id = 150;
                                          $stresponse = $initLocation->CountryWiseState($country_id);
                                          if ($stresponse->num_rows > 0) {
                                             while( $cu_row = $stresponse->fetch_assoc() ){
                                                 $sel = (isset($_POST['ud_state']) && $_POST['ud_state'] == $cu_row['st_id']) ? 'selected' : (($userRow['ud_state'] == $cu_row['st_id']) ? 'selected' : '' );
                                                echo '<option value="'. $cu_row['st_id'] .'" '.$sel.'>'. $cu_row['st_name'] .'</option>';
                                             }
                                          }
                                       ?>
                                    </select>
								 
								 
								 </div>
                                 <div class="col-sm-3">
                                    <select class="js-example-basic-single cnty" name="search_ud_city" id="search_ud_city" style="width:100%;" data-required>
                                       <option value="">Please Select City</option>
                                       <?php 
/*
                                       if((isset($_POST['ud_state']) && $_POST['ud_state'] != '') || (isset($userRow) && $userRow !== null && $userRow['ud_state'] != '')) {
                                          $state_id = (isset($_POST['ud_state']) && $_POST['ud_state'] != '') ? $_POST['ud_state'] : $userRow['ud_state'];
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}
$query = "SELECT * FROM tk_cities WHERE city_st_id='$state_id' ORDER BY city_name ASC"; 
$result = $dbCon->query($query); 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){  
            ?><option value="<?php echo $row['city_id']; ?>" <?php if ( $userRow['ud_city'] == $row['city_id'] ) echo 'selected' ; ?> ><?php echo $row['city_name']; ?></option><?php
        } 
    }
    
$dbCon->close();                                          

                                       }*/
                                       ?>
                                    </select>

                                 </div>
                              </div>

                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
  
                              <div class="form-group for-tutors">
                                 <label class="col-sm-3 control-label">Workplace Location :</label>
                                 <div class="col-sm-3">

                                    <select class="js-example-basic-single cnty" name="ud_workplace_state" id="ud_workplace_state" style="width:100%;" data-required>
                                       <option value="">Please Select State</option>
                                       <?php 
                                       $country_id = 150;
                                          $stresponse = $initLocation->CountryWiseState($country_id);
                                          if ($stresponse->num_rows > 0) {
                                             while( $cu_row = $stresponse->fetch_assoc() ){
                                                 $sel = (isset($_POST['ud_state']) && $_POST['ud_state'] == $cu_row['st_id']) ? 'selected' : (($userRow['ud_state'] == $cu_row['st_id']) ? 'selected' : '' );
                                                echo '<option value="'. $cu_row['st_id'] .'" '.$sel.'>'. $cu_row['st_name'] .'</option>';
                                             }
                                          }
                                       ?>
                                    </select>
								 
								 
								 </div>
                                 <div class="col-sm-3">
                                    <select class="js-example-basic-single cnty" name="ud_workplace_city" id="ud_workplace_city" style="width:100%;" data-required>
                                       <option value="">Please Select City</option>
                                       <?php 
                                       ?>
                                    </select>

                                 </div>
                              </div>
                                 
                                 
                                 
                            
                                 
								 
								 
                                 <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">City :</label>
                                    <div class="col-lg-4">
                                            <select class="js-example-basic-single cnty" name="parent_city" id="parent_city" style="width: 50%"  data-rule-required>
                                            <option value="">Please Select City</option>
										   <?php 
											 /*$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
											 if ($conn->connect_error) {
											    die("Connection failed: " . $conn->connect_error);
											 }*/
											 $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
											 $rowDataState = $conDB->query($queryDataState);
											 if ($rowDataState->num_rows > 0) {
												while($resultDataState= $rowDataState->fetch_assoc()){
													echo '<optgroup label="'. $resultDataState['st_name'] .'">';
													
														 $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_st_id = '".$resultDataState['st_id']."' ORDER BY city_name ASC ";
														 $rowDataCity = $conDB->query($queryDataCity);
														 if ($rowDataCity->num_rows > 0) {
															while($resultDataCity = $rowDataCity->fetch_assoc()){
																echo '<option value="'. $resultDataCity['city_id'] .'">'. $resultDataCity['city_name'] .'</option>';
															}			
														 }
													
													echo '</optgroup>';
												}			
											 }
										   ?>
                                       </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <div id="parent_cityText" name="parent_cityText"></div>
                                    </div>
                                 </div>
								 
								 
								 
								 
								 
                                 <div class="form-group for-tutors hidden">
                                    <label class="col-lg-3 control-label">State Covered :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="js-example-basic-single" name="cover_area_state[]" id="state_drop" style="width:48%" >
                                          <option value="">Select state</option>
                                          <?php
                         
                                          $getCountryWiseStates = $initLocation->CountryWiseState(150);
                                          if ($getCountryWiseStates->num_rows > 0) {
                                             while ($state = $getCountryWiseStates->fetch_object()) {
                                          ?>
                                          <option value="<?php echo $state->st_id; ?>"><?php echo $state->st_name; ?></option>
                                          <?php
                                             }
                                          }
                                          ?>
                                       </select>	
                                    </div>
                                 </div>
                                 <div id="removeHidden" class="form-group for-tutors hidden">
                                    <label class="col-lg-3 control-label">City :</label>
                                    <div class="col-lg-4" style="width:50%">									   
                                       <div id="hideSelectOptionCity">
                                       <!--<select class="js-example-basic-single" name="citytest" id="citytest" style="width:48%" multiple >
											<option value="">Select City</option>
										</select>-->
									   </div>
									   
									   
									   
                                    </div>
                                 </div>
								 
								 
								 
								 
								 
                                 <!--<div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Covered Areas :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="js-example-basic-single" name="cover_area_state[]" id="state_drop" style="width:48%" >
                                          <option value="">Select state</option>
                                          <?php
/*
                                          $getCountryWiseStates = $initLocation->CountryWiseState(150);
                                          if ($getCountryWiseStates->num_rows > 0) {
                                             while ($state = $getCountryWiseStates->fetch_object()) {
                                          ?>
                                          <option value="<?php echo $state->st_id; ?>"><?php echo $state->st_name; ?></option>
                                          <?php
                                             }
                                          }*/
                                          ?>
                                       </select>									   
                                    </div>
									<br/>
                                    <div class="col-lg-5" style="margin-left:10px;">
                                       <div class="showHide" style="display: none;">
                                          <div class="dropbox">Please tick the area(s)</div>
                                          <div class="dropPop">
                                             <div class="row">
                                                <div class="col-md-12 city_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAllClass('.city_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAllClass('.city_check');">Untick All</a></div>
                                                <div class="city-area"></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>-->

<?PHP
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
//if( $sessionIDLogin == '8'){
    ?>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Locations Covered :</label>
                                    <div class="col-lg-6">
                                            <select class="js-example-basic-single cnty" name="locations_covered" id="locations_covered" style="width: 100%"  data-rule-required multiple>
                                            <option value="">Please Select City</option>
										   <?php 
											 /*$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
											 if ($conn->connect_error) {
											    die("Connection failed: " . $conn->connect_error);
											 }*/
											 $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
											 $rowDataState = $conDB->query($queryDataState);
											 if ($rowDataState->num_rows > 0) {
												while($resultDataState= $rowDataState->fetch_assoc()){
													echo '<optgroup label="'. $resultDataState['st_name'] .'">';
													
														 $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_st_id = '".$resultDataState['st_id']."' ORDER BY city_name ASC ";
														 $rowDataCity = $conDB->query($queryDataCity);
														 if ($rowDataCity->num_rows > 0) {
															while($resultDataCity = $rowDataCity->fetch_assoc()){
																echo '<option value="'. $resultDataCity['city_id'] .'">'. $resultDataState['st_name'] .' : '. $resultDataCity['city_name'] .'</option>';
															}			
														 }
													
													echo '</optgroup>';
												}			
											 }
										   ?>
                                       </select>
                                    </div>
                                 </div>  
<?PHP if( $sessionIDLogin == '8'){
    ?>
                                 <!--<div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label"> &nbsp; </label>
                                    <div class="col-lg-6 text-left">
                                        <div class="text-left" id="locations_coveredText" name="locations_coveredText"></div>
                                    </div>
                                 </div> -->
    <?PHP
} ?>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Subjects Taught :</label>
                                    <div class="col-lg-6">
                                            <select class="js-example-basic-single cnty" name="subjects_taught" id="subjects_taught" style="width: 100%"  data-rule-required multiple>
                                            <option value="">Please Select City</option>
										   <?php 
											 /*$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
											 if ($conn->connect_error) {
											    die("Connection failed: " . $conn->connect_error);
											 }*/
											 $queryDataCourse = " SELECT * FROM tk_tution_course ORDER BY tc_id ASC ";
											 $rowDataCourse = $conDB->query($queryDataCourse);
											 if ($rowDataCourse->num_rows > 0) {
												while($resultDataCourse= $rowDataCourse->fetch_assoc()){
													echo '<optgroup label="'. $resultDataCourse['tc_title'] .'">';
													
														 $queryDataSubject = " SELECT * FROM tk_tution_subject WHERE ts_status	='A' AND ts_tc_id = '".$resultDataCourse['tc_id']."' ORDER BY ts_title ASC ";
														 $rowDataSubject = $conDB->query($queryDataSubject);
														 if ($rowDataSubject->num_rows > 0) {
															while($resultDataSubject = $rowDataSubject->fetch_assoc()){
																echo '<option value="'. $resultDataSubject['ts_id'] .'">'. $resultDataCourse['tc_title'] .' : '. $resultDataSubject['ts_title'] .'</option>';
															}			
														 }
													
													echo '</optgroup>';
												}			
											 }
										   ?>
                                       </select>
                                    </div>
                                 </div>   
    
    <?PHP
//}
?>

                                 

                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Level Taught : 
                                    <a style="text-align: left;" class="tooltip-top" data-tooltip="Use this filter if you want to filter tutors by Level taught. E.g filter tutors who teach SPM level" ><span class="glyphicon glyphicon-info-sign" style="color:#262262"></span></a>
									</label>
                                    <div class="col-lg-6">
                                            <select class="js-example-basic-single cnty" name="level_taught" id="level_taught" style="width: 100%"  data-rule-required >
                                            <option value="">Please Select Level</option>
										   <?php 
                                            $getCourse = $initApp->ListCourseNew();
                                              if ($getCourse->num_rows > 0) {
                                                while ( $course = $getCourse->fetch_object() ) {
                                              ?>
                                              <option value="<?php echo $course->tc_id; ?>"><?php echo $course->tc_title; ?></option>
                                              <?php
                                                }
                                              }
										   ?>
                                       </select>
                                    </div>
                                 </div>   


                                 <!--<div class="form-group for-tutors hidden">
                                    <label class="col-lg-3 control-label">Subjects Taught :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="tutor_course[]" id="level_drop">
                                          <option value="">Choose subject</option>
                                          <?php
                                          /*$getCourse = $initApp->ListCourseNew();
                                          if ($getCourse->num_rows > 0) {
                                            while ( $course = $getCourse->fetch_object() ) {
                                          ?>
                                          <option value="<?php echo $course->tc_id; ?>"><?php echo $course->tc_title; ?></option>
                                          <?php
                                            }
                                          }*/
                                          ?>
                                       </select>
                                    </div><br/>
                                    <div class="col-lg-5" style="margin-left:10px;">
                                       <div class="levelShowHide" style="display: none;">
                                          <div class="dropbox">Please tick the subject(s)</div>
                                          <div class="dropPop">
                                             <div class="row">
                                                <div class="col-md-12 subject_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAllClass('.subject_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAllClass('.subject_check');">Untick All</a></div>
                                                <div class="subject-area"></div>
                                             </div>
                                          </div>
                                           <div class="row" style="margin-top: 10px; margin-right: 5px;">
                                             <div class="col-md-5">
                                                <div class="checkbox">
                                                   <label for="optionsRadios2">Others (optional) </label>
                                                </div>
                                             </div>
                                             <div class="col-md-7">
                                                <input type="text" class="form-control" name="subject" id="subject" />
                                             </div>
                                          </div> 
                                       </div>
                                    </div>
                                 </div>-->

                                 
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Consider Tuition Centre :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="tution_center" id="tution_center">
                                          <option value="">All</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                       </select>
                                    </div>
                                 </div>
                                 
                                 

                                 
                                 
			
                              <div class="form-group for-tutors">
                                 <label class="col-lg-3 control-label">Conduct Online Tuition :</label>
                                 <div class="col-lg-1" style="width:100px;" >
                                    <select onchange="ConductOnlineTuition()" class="form-control cnty" name="searchConductOnline" id="searchConductOnline" data-required>
                                          <option value="">All</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                    </select>								 
								 </div>
                                 <div class="col-lg-5">
<style>
/* https://bootsnipp.com/snippets/VgWg8 */
.panel {
    /*position: absolute;
    z-index: 100 !important;
    z-index: 99 !important;
  border-width: 0 0 1px 0;
  border-style: solid;*/
  /*border-color: #868e96;
  box-shadow: none;*/

  background-color: #ffffff;
  border: 1px solid #dddddd;
  border-radius: 4px;
/*
  
-webkit-box-shadow: 16px 10px 16px -13px rgba(0,0,0,0.75);
-moz-box-shadow: 16px 10px 16px -13px rgba(0,0,0,0.75);
box-shadow: 16px 10px 16px -13px rgba(0,0,0,0.75);*/
}

.panel:last-child {
  /*border-color: #868e96;*/
}

.panel-group > .panel:first-child .panel-heading {
  border-radius: 4px 4px 0 0;
}

.panel-group .panel {
  border-radius: 0;
}

.panel-group .panel + .panel {
  margin-top: 0;
}

.panel-heading {
  /*background-color: #f9f9f9;*/
  border-radius: 0;
  border: none;
  color: #fff;
  padding: 0;
}

.panel-title a {
  display: block;
  color: #000000;
  padding: 9px;
  position: relative;
  font-size: 14px;
  font-weight: 400;
}

.panel-body {
  /*background: #f9f9f9;*/
  /*box-shadow: 2px 5px 4px #888888;*/
}

.panel:last-child .panel-body {
  border-radius: 0 0 4px 4px;
}

.panel:last-child .panel-heading {
  border-radius: 0 0 4px 4px;
  transition: border-radius 0.3s linear 0.2s;
}

.panel:last-child .panel-heading.active {
  border-radius: 0;
  transition: border-radius linear 0s;
}

.panel-heading a:before {
  position: absolute;
  font-family: 'Material Icons';
  right: 5px;
  top: 10px;
  font-size: 24px;
  transition: all 0.5s;
  transform: scale(1);
}

.panel-heading.active a:before {
  content: ' ';
  transition: all 0.5s;
  transform: scale(0);
}

#bs-collapse .panel-heading a:after {
  content: ' ';
  font-size: 24px;
  position: absolute;
  font-family: 'Material Icons';
  right: 5px;
  top: 10px;
  transform: scale(0);
  transition: all 0.5s;
}

#bs-collapse .panel-heading.active a:after {
  transform: scale(1);
  transition: all 0.5s;
}

#accordion .panel-heading a:before {
  font-size: 24px;
  position: absolute;
  font-family: 'Material Icons';
  right: 5px;
  top: 10px;
  transform: rotate(180deg);
  transition: all 0.5s;
}

#accordion .panel-heading.active a:before {
  transform: rotate(0deg);
  transition: all 0.5s;
}
/* https://bootsnipp.com/snippets/oPgeG */
.checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}

@media only screen and (max-width: 600px) {
  .mobileCheckbox {
    padding-right:3%;
  }
  .mobileCheckboxFont {
    font-size: 0.7em;
  }
}
@media only screen and (min-width: 601px) {
  .mobileCheckbox {
    padding-right:20%;
  }
  .mobileCheckboxFont {
    font-size: 1em;
  }
}
</style>
    <div class="hidden panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top:-5px;">
      <div class="panel">
        <div onClick="collapseOne()" class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Tools <i class="pull-right glyphicon glyphicon-chevron-down"></i> <i class="hidden pull-right glyphicon glyphicon-chevron-up"></i>
        </a>
      </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" >
          <div class="panel-body">
				<div class="pull-left checkbox mobileCheckboxFont">
				    
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Microsoft Teams"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Microsoft Teams</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Google Hangouts"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Hangouts</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Google Meet"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Meet</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Google Classroom"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Classroom</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Google Duo"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Duo</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Google Doc"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Google Doc</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Zoom"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Zoom</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Skype"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Skype</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="WhatsApp"><span class="cr"><i class="cr-icon fa fa-check"></i></span>What's App</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Telegram"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Telegram</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Lark"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Lark</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="GeoGebra"><span class="cr"><i class="cr-icon fa fa-check"></i></span>GeoGebra</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Whereby"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Whereby</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Others"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Others</label><br>

					<!--<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Teams">Microsoft Teams</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Hangouts">Google Hangouts</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Meet">Google Meet</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Classroom">Google Classroom</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Duo">Google Duo</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Google Doc">Google Doc</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Zoom">Zoom</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Skype">Skype</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="WhatsApp">WhatsApp</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Telegram">Telegram</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Lark">Lark</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="GeoGebra">GeoGebra</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Whereby">Whereby</label><br>-->
				</div>
				<div class="pull-right checkbox mobileCheckbox mobileCheckboxFont">

					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Phone Call"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Phone Call</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Video Call"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Video Call</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Webex"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Webex</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="YouTube"><span class="cr"><i class="cr-icon fa fa-check"></i></span>YouTube</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Facebook"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Facebook</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="FaceTime"><span class="cr"><i class="cr-icon fa fa-check"></i></span>FaceTime</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Instagram"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Instagram</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Email"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Email</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Quizziz"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Quizziz</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Kahoot"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Kahoot</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Chegg"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Chegg</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="Edmodo"><span class="cr"><i class="cr-icon fa fa-check"></i></span>Edmodo</label><br>
					<label style="font-size: 1em"><input type="checkbox" onchange="handleChange();" name="toolsname" value="TeamLink"><span class="cr"><i class="cr-icon fa fa-check"></i></span>TeamLink</label><br>
				    
					<!--<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Phone Call">Phone Call</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Video Call">Video Call</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Webex">Cisco Webex</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="YouTube">YouTube</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Facebook">Facebook</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="FaceTime">FaceTime</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Instagram">Instagram</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Email">Email</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Quizziz">Quizziz</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Kahoot">Kahoot</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Chegg">Chegg</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="Edmodo">Edmodo</label><br>
					<label><input type="checkbox" onchange="handleChange();" name="toolsname" value="TeamLink">TeamLink</label><br>-->
				</div>
          </div>
        </div>
      </div>
    </div><input type="hidden" id="hiddentoolsname" name="hiddentoolsname" >


                                 </div>
                              </div>


    


<?PHP 
/*if( $sessionIDLogin == '8'){
}*/
?>


                              
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Conduct Class At Your House / Place :</label>
                                    <div class="col-lg-4" style="width:50%">
										<select class="form-control cnty" name="searchConductClass" id="searchConductClass" data-required>
											  <option value="">All</option>
											  <option value="yes">Yes</option>
											  <option value="no">No</option>
										</select>
                                    </div>
                                 </div>

                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Tutor Activated :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="u_admin_approve" id="u_admin_approve">
                                          <option value="">All</option>
                                          <option value="A">Yes</option>
                                          <option value="P">No</option>
                                          <option value="B">Banned</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Validated :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="validatedaa" id="validatedaa">
                                          <option value="">All</option>
                                          <option value="paid">Paid <!--( tutor with at least 1 job, and that job status is Paid )--></option>
                                          <option value="unpaid">Unpaid <!--( tutor with at least 1 job, but none of the job status is Paid )--></option>
                                          <option value="none">None <!--( tutors who never have even 1 job )--></option>
                                       </select>
                                    </div>
                                 </div>
                                 
                                 
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Experience :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control selectpicker show-tick" name="experience" id="experience" data-live-search="true" title="Choose one of the following..." data-width="fit">
                                          <option value="">All</option>
                                          <option value="2" data-subtext="Years & Above">2 </option>
                                          <option value="3" data-subtext="Years & Above">3 </option>
                                          <option value="4" data-subtext="Years & Above">4 </option>
                                          <option value="5" data-subtext="Years & Above">5 </option>
                                          <option value="6" data-subtext="Years & Above">6 </option>
                                          <option value="7" data-subtext="Years & Above">7 </option>
                                          <option value="8" data-subtext="Years & Above">8 </option>
                                          <option value="9" data-subtext="Years & Above">9 </option>
                                          <option value="10" data-subtext="Years & Above">10 </option>
                                          
                                       </select>
                                    </div>
                                 </div>
                                 
                                 
                                 <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">Client Status :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="ud_client_status" id="ud_client_status">
                                          <option value="">All</option>
                                          <option value="Parent">Parent</option>
                                          <option value="Student">Student</option>
                                          <option value="Tuition Centre">Tuition Centre</option>
                                          <option value="Agent">Agent</option>
                                          <option value="Not Selected">Not Selected</option>
                                       </select>
                                    </div>
                                 </div>
                                 <!-- <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">User Role:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="u_role" id="u_role">
                                          <option value="">All</option>
                                          <?php
                                          if ($roleData->num_rows > 0) {
                                             while( $row = $roleData->fetch_assoc() ){
                                                if($row['r_id'] > $_SESSION[DB_PREFIX]['r_id']) {
                                                   if ($row['r_id'] != 3) {
                                          ?>
                                          <option value="<?php echo $row['r_id'];?>"><?php echo $row['r_name'];?></option>
                                          <?php
                                                   }
                                                }
                                             }
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div> -->
                                <!--  <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">State:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control cnty" name="ud_state" id="ud_state">
                                          <option value="">Select State Name</option>
                                          <?php
                                          $get_states = $initLocation->CountryWiseState(150);
                                          if ($get_states->num_rows > 0) {
                                             while( $cu_row = $get_states->fetch_assoc() ){
                                                echo '<option value="'. $cu_row['st_id'] .'">'. $cu_row['st_name'] .'</option>';
                                             }
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div> -->
                                 <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">Paying Client :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <label class="checkbox-inline"> <input class="messagecheckbox" type="checkbox" value="P" id="inlineCheckbox2" name="u_paying_client" id="u_paying_client">  </label>
                                    </div>
                                 </div>


                                 <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">User Status :</label>
                                    <div class="col-lg-4" style="width:50%">
                                       <select class="form-control" name="user_status" id="user_status">
                                          <option value="active">Active</option>
                                          <option value="banned">Banned</option>
                                       </select>
                                    </div>
                                 </div>


                                 <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-4" style="width:50%">
                                        <!--<div class="alert alert-warning">-->
                                        
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p class="lead">
<h5 style="margin-left:5px;" class="text-muted"><strong> Lower To Higher</strong></h5>         
<div class="form-group" style="margin-left:5px;">
<!-- Date Picker -->
    <div class="input-group date " id="startDateExcel">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span> 
        </span>
        <input type='text' class="form-control" placeholder="Start Date ( Created On )" name="dateCreatedStart" id="dateCreatedStart"/>
    </div>
<!-- Time Picker -->
    <div class="input-group date" id="endDateExcel">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span> 
        </span>
            <input type='text' class="form-control" placeholder="End Date ( Created On )" name="dateCreatedtEnd" id="dateCreatedtEnd" />
    </div>
</div>
<button type="button" name="exportExcel" id="exportExcel" class="btn btn-excel btn-md">Export To Excel</button>    
    </p>
  </div>
</div>
                                        
                                    </div>
                                 </div>

								 
								 
                                 <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-9">
                                       <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" onclick="cariTutor()"><i class="fa fa-search"></i> Search</button>
                                       <a class="btn btn-sm btn-default sign-btn-box mrg-right-15" href="manage_user.php"><i class="fa fa-eraser"></i> Reset</a>
                                       
                                       <!--<div class="btn-group">
                                            <div class="btn-group">
                                                <a class="checkbox checkbox-success">&nbsp;&nbsp;<input onclick="clickCheckbox()" value="" type="checkbox"><label for="checkbox3"></label></a>
                                            </div>
                                       </div>-->
                                       
                                    </div>
                                 </div>
                                 *due to performance, search results are limited to 20 rows.
                              </form>
                           </div>
                        </div>
                          <!-- luqman -->
                          <form id="frm-user-listing" action="export-selected-user.php" method="POST">
                              <!-- <button class="btn btn-default btn-sm" type="submit" style="position: absolute; left: 110px; padding: 6px 8px;">Export Selected</button> -->
                        <!--<div class="ibox-content">-->
                        <div class="">
                            <div class="table-responsive">
                              <!-- <div class="container" style="margin-top:35px;"> -->
                              <!--<div id="show_result"></div>-->
                              <h4 style="margin-bottom: 20px;" class="org-txt text-danger"><strong>Search Results : <span id="counttutor"></span></strong></h4>



                                <div style="height: 200px;">
                              <table class = "table table-striped" id="search_table" style="width:100%;">
    <thead></thead>                                                                                                         
    <tbody></tbody>                                                              
</table>

                            </div>
                          </div>
                        </div>
                          </form>
                          <!-- luqman -->
                     </div>
                  </div>
               </div>
            </div>
            <?php //} ?>
            <?php include_once('includes/footer.php'); ?>
         </div>
      </div>
   </body>
</html>
<!-- https://select2.org/ -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
$(".js-example-basic-single").select2({
	//placeholder: "Choose one of the following...",
});

function ConductOnlineTuition() {
  var x = document.getElementById("searchConductOnline").value;
  if( x == 'yes' ){
	  $('.collapse').collapse('hide');	
	  document.getElementById("accordion").classList.remove("hidden"); 
	  document.getElementById("textTools").classList.remove("hidden"); 
  }else if( x == 'no' ){
	  document.getElementById("accordion").classList.add("hidden"); 
	  document.getElementById("textTools").classList.add("hidden"); 
  }else{
	  document.getElementById("accordion").classList.add("hidden"); 
	  document.getElementById("textTools").classList.add("hidden"); 
  }
}

function handleChange() {
	var favorite = [];
	$.each($("input[name='toolsname']:checked"), function(){            
		favorite.push($(this).val());
	});
	//alert(favorite.join(", "));
	document.getElementById("hiddentoolsname").value = favorite.join(", ");
}
function collapseOne() {
	if($(".collapse").hasClass('in')){
	  document.getElementsByClassName("glyphicon-chevron-up")[0].classList.add("hidden"); 
	  document.getElementsByClassName("glyphicon-chevron-down")[0].classList.add("hidden"); 
	  document.getElementsByClassName("glyphicon-chevron-down")[0].classList.remove("hidden"); 
	}else {
	  document.getElementsByClassName("glyphicon-chevron-up")[0].classList.add("hidden"); 
	  document.getElementsByClassName("glyphicon-chevron-down")[0].classList.add("hidden"); 
	  document.getElementsByClassName("glyphicon-chevron-up")[0].classList.remove("hidden"); 
	}
}
</script>

<script type="text/javascript">
    var rowperpage = 10;
       $(document).ready(function(){
        cariTutor();
        // bannedPhoneNumber();
    });

  function cariTutor(){

var search_user = $("#search_user").val();

        var search_id = $("#u_id").val();
    var istutor = document.getElementById("is_tutor").value;//dapatkan value dari dropdown html
    var search_email = $("#u_email").val();//dapat je kt fetchurlmanageuser
    var search_pic = document.getElementById("user_w_image").value;
    var search_first_name = $("#ud_first_name").val();//dapat je kt fetchurlmanageuser
    var search_last_name = $("#ud_last_name").val();//dapat je kt fetchurlmanageuser
    var search_display_name = $("#u_displayname").val();//dapat je kt fetchurlmanageuser
    var search_phone_number = $("#ud_phone_number").val();//dapat je kt fetchurlmanageuser
    // kalau yes

    var gender = $("#u_gender").val();
    var ud_race = $("#ud_race").val();
    var ud_tutor_status = $("#ud_tutor_status").val();
    var current_occupation = $("#ud_current_occupation").val();
    var areas = $("#state_drop").val();//cover_area_State dapat number
    var location = $("#location").val();//cover_area_State dapat number
    // var areas = document.getElementById("cover_area_state").value;
    var course = $("#level_drop").val();//tutor_course
    // var subject_check = $('.subject_check:checked').val();//dapat value subject dalam course



 var subject_check = [];
        $('.subject_check:checked').each(function(i){
          subject_check[i] = $(this).val();
        });


    // var city_check = $('.city_check:checked').val();//dapat value subject dalam areas
    var city_check = [];
        $('.city_check:checked').each(function(i){
          city_check[i] = $(this).val();
        });
		
    var subject = $("#subject").val();//tutor_course
    var tution_center = $("#tution_center").val();
    var u_admin_approve = $("#u_admin_approve").val();
 
    var validatedaa = $("#validatedaa").val();
    var experience = $("#experience").val();
    
    var searchConductOnline = $("#searchConductOnline").val();
	var hiddentoolsname = $("#hiddentoolsname").val();
	
    var searchConductClass  = $("#searchConductClass").val();

 // kalau no

    var client_status = $("#ud_client_status").val();
    var user_status = $("#user_status").val();
	
    // var u_role = document.getElementById("u_role").value;
    // var ud_state = $("#ud_state").val();
    var messagecheckbox = $('.messagecheckbox:checked').val();      //TAK HANTAR VALUE LAGI
    // alert(messagecheckbox);
    // alert(areas + ',' + city_check + ',' + course + ',' + subject_check);
    
    var parent_city = $("#parent_city").val();
    
    
		var search_ud_state = $("#search_ud_state").val();       // Current Location : State
		var search_ud_city = $("#search_ud_city").val();         // Current Location : City
    
		var ud_workplace_state = $("#ud_workplace_state").val(); // Workplace Location : State
		var ud_workplace_city = $("#ud_workplace_city").val();   // Workplace Location :  City
    
		//var city_check2 = $("#city_check2").val();
		var city_check2 = $("#locations_covered").val();         // Locations Covered : City = multiple
		city_check = city_check2;
		
		var subjects_taught2 = $("#subjects_taught").val();      // Subjects Taught : Subject = multiple
		subject_check = subjects_taught2;
		
        var level_taught = $("#level_taught").val();             // Level Taught : Level

    
    
//alert(city_check);
    if(istutor =="Yes"){

if(validatedaa !=''){

      $.ajax({
        method:"POST",
        url:"classes/fetchurlmanageuser.php",
        dataType:"json",
        data:{
          is_tutor:istutor,
          data: {
            is_tutor:istutor,
            u_email:search_email,
			data_pic:search_pic,
            ud_first_name:search_first_name,
            ud_last_name:search_last_name,
            u_displayname:search_display_name,
            ud_phone_number:search_phone_number,
            u_gender:gender,
            ud_race:ud_race,
            ud_tutor_status:ud_tutor_status,
            ud_current_occupation:current_occupation,
            state_drop:areas,
            location:location,
            level_drop:course,
            subject_check: subject_check,
            city_check:city_check,
            subject:subject,
            experience:experience,
            
            search_ud_state:search_ud_state,
            search_ud_city:search_ud_city,
            
            ud_workplace_state:ud_workplace_state,
            ud_workplace_city:ud_workplace_city,

            tution_center:tution_center,
            u_admin_approve:u_admin_approve,
			
            searchConductOnline:searchConductOnline,
			hiddentoolsname:hiddentoolsname,
            searchConductClass:searchConductClass,
            
            level_taught:level_taught,
            validatedaa:validatedaa,

            rowperpage:rowperpage,
          },
          functionname:'isTutor'

        },
        success:function(response){
          // alert(response);
             createTablerowTwo(response);
             console.log(response);
             document.getElementById("counttutor").innerHTML = response.length;

        }
      });
/*
    //alert(validatedaa);
      $.ajax({
        method:"POST",
        url:"classes/search-filter.php",
        dataType:"json",
        data:{
          is_tutor:istutor,
          data: {
            is_tutor:istutor,
            u_email:search_email,
			data_pic:search_pic,
            ud_first_name:search_first_name,
            ud_last_name:search_last_name,
            u_displayname:search_display_name,
            ud_phone_number:search_phone_number,
            u_gender:gender,
            ud_race:ud_race,
            ud_tutor_status:ud_tutor_status,
            ud_current_occupation:current_occupation,
            state_drop:areas,
            location:location,
            level_drop:course,
            subject:subject,

            tution_center:tution_center,
            u_admin_approve:u_admin_approve,
            validatedaa:validatedaa,
            experience:experience,
            
            searchConductOnline:searchConductOnline,
            searchConductClass:searchConductClass,

            
            search_ud_state:search_ud_state,
            search_ud_city:search_ud_city,            
            ud_workplace_state:ud_workplace_state,
            ud_workplace_city:ud_workplace_city,
            city_check:city_check,
            subject_check: subject_check,
            level_taught:level_taught,

            rowperpage:rowperpage,
          },
          functionname:'isTutor'

        },
        success:function(response){
             createTablerowThree(response);
             console.log(response);
             document.getElementById("counttutor").innerHTML = response.length;

        }
      });  
*/

}else{
      $.ajax({
        method:"POST",
        url:"classes/fetchurlmanageuser.php",
        dataType:"json",
        data:{
          is_tutor:istutor,
          data: {
            is_tutor:istutor,
            u_email:search_email,
			data_pic:search_pic,
            ud_first_name:search_first_name,
            ud_last_name:search_last_name,
            u_displayname:search_display_name,
            ud_phone_number:search_phone_number,
            u_gender:gender,
            ud_race:ud_race,
            ud_tutor_status:ud_tutor_status,
            ud_current_occupation:current_occupation,
            state_drop:areas,
            location:location,
            level_drop:course,
            subject_check: subject_check,
            city_check:city_check,
            subject:subject,
            experience:experience,
            
            search_ud_state:search_ud_state,
            search_ud_city:search_ud_city,
            
            ud_workplace_state:ud_workplace_state,
            ud_workplace_city:ud_workplace_city,

            tution_center:tution_center,
            u_admin_approve:u_admin_approve,
			
            searchConductOnline:searchConductOnline,
			hiddentoolsname:hiddentoolsname,
			
            searchConductClass:searchConductClass,
            
            level_taught:level_taught,

            rowperpage:rowperpage,
          },
          functionname:'isTutor'

        },
        success:function(response){
          // alert(response);
             createTablerowTwo(response);
             console.log(response);
             document.getElementById("counttutor").innerHTML = response.length;
             // return false;

             // document.getElementById("filter_user").reset();//kalau guna ni, bile kt table tekan next dye xkua id sama
             // document.getElementById("cover_area_State").reset();//kalau guna ni, bile kt table tekan next dye xkua id sama

        }
      });    
}




    }else if(istutor == "No"){
       $.ajax({
        method:"POST",
        url:"classes/fetchurlmanageuser.php",
        dataType:"json",
        data:{
          is_tutor:istutor,
          data: {
            is_tutor:istutor,
            u_email:search_email,
			data_pic:search_pic,
            ud_first_name:search_first_name,
            ud_last_name:search_last_name,
            ud_phone_number:search_phone_number,
            u_gender:gender,
            ud_client_status:client_status,
            user_status:user_status,
            messagecheckbox:messagecheckbox,
            
            parent_city:parent_city,
            // u_role:search_role,
            // ud_state:ud_state,
          },
          functionname:'isTutor'
          // rowperpage:rowperpage

        },
        success:function(response){
          // alert(response);
             createTablerow(response);
             console.log(response);
             document.getElementById("counttutor").innerHTML = response.length;
             // return false;  //prevent dari table tak load search baru
             // document.getElementById("filter_user").reset();
        }
      });

    }else if (istutor == "Admin") {
      $.ajax({
        method:"POST",
        url:"classes/fetchurlmanageuser.php",
        dataType:"json",
        data:{
          is_tutor:istutor,
          data: {
            is_tutor:istutor,
            u_email:search_email,
			data_pic:search_pic,
            ud_first_name:search_first_name,
            ud_last_name:search_last_name,
            ud_phone_number:search_phone_number,
          },
          functionname:'isTutor'
        },
        success:function(response){
             createTablerow(response);
             console.log(response);
             document.getElementById("counttutor").innerHTML = response.length;
        }
      });
    }else if (istutor == "All") {
      $.ajax({
        method:"POST",
        url:"classes/fetchurlmanageuser.php",
        dataType:"json",
        data:{
          is_tutor:istutor,
          data: {
            is_tutor:istutor,
            u_email:search_email,
			data_pic:search_pic,
            ud_first_name:search_first_name,
            ud_last_name:search_last_name,
            ud_phone_number:search_phone_number,
          },
          functionname:'isTutor'
          // rowid:rowid,
          // rowperpage:rowperpage
        },
        success:function(response){
          // alert(response);
             createTablerow(response);
             console.log(response);
             // return false;  //prevent dari table tak load search baru
             // document.getElementById("filter_user").reset();

             document.getElementById("counttutor").innerHTML = response.length;
             
             
             
        }
      });
    }
    return false;
  }

   /* Create Table */
   function createTablerow(data){

    $.fn.dataTable.moment( 'DD/MM/YYYY' );
       $('#search_table').DataTable({
            pageLength: 20,
            destroy:true,//elakkan dari error initialise
             language: {
                          "emptyTable":     "Tiada Maklumat Dijumpai!"
                        },
              
            paging: true,
            searching: true,
            deferRender: true,
            data : data,
            order : [[2,"desc"],[1,"desc"]],

            

              "columnDefs": [
            {
                "targets": [ 0 , 1 , 2],
                "visible": false,
                "searchable": false
            },
        ],//hidekan userID
            columns: [{
        title: 'Display ID',
        data: "u_id"
      },
      {
        title: 'create',
        data: "ori_u_create_date"
      },
	  {
        title: 'last',
        data: "ori_u_modified_date"
      },
	  
      {
        title: 'ID',
        data: "u_displayid",
			render: function ( data, type, JsonResultRow, meta ) {
				var u_displayid = JsonResultRow['u_displayid'];
				var u_email = JsonResultRow['u_email'];
				return '<a style="white-space: pre-line;" data-html="true" href="manage_user.php?action=edit&u_id='+u_displayid+'" class="tooltip-right" data-tooltip="'+u_email+'" target="_blank">'+u_displayid+'</a>'
			}
      },
      /*{
        title: 'Email',
        data: "u_email",
        render: function ( data, type, JsonResultRow, meta ) {
                              // var u_id = JsonResultRow['u_id'];
                              var u_displayid = JsonResultRow['u_displayid'];
                              var u_email = JsonResultRow['u_email'];
                              // console.log(JsonResultRow);
                              return '<a href="manage_user.php?action=edit&u_id='+u_displayid+'" target="_blank">'+u_email+'</a>'

                              // return '<a href="manage_user.php?u_id='+u_displayid+'" onclick="Loadprofile();return false;">'+u_email+'</a>'
                            }
      },*/
      {
        title: 'First Name',
        data: "ud_first_name"
      },
      {
        title: 'Display Name',
        data: "u_displayname"
      },
      {
        title: 'Active',
        data: "u_status"
      },
      {
        title: 'Age',
        data: "ud_dob"
      },
      {
        title: 'City',
        data: "ud_city"
      },
      {
        title: 'Phone Number',
        data: "ud_phone_number"
      },
      {
        title: 'Type',
        data: "u_role"
      },
      {
        title: 'Created On',
        data: "u_create_date"

      },
      
      {
        title: 'Last Activity',
        data: "u_modified_date"
      }
    ]

          });

        }
        

/* Create Table Two*/
function createTablerowTwo(data){

    $.fn.dataTable.moment( 'DD/MM/YYYY' );
       $('#search_table').DataTable({
            pageLength: 20,
            destroy:true,//elakkan dari error initialise
             language: {
                          "emptyTable":     "Tiada Maklumat Dijumpai!"
                        },
              
            paging: true,
            searching: true,
            deferRender: true,
            data : data,
            order : [[2,"desc"],[1,"desc"]],



              "columnDefs": [
            {
                "targets": [ 0 , 1 , 2, 9],
                "visible": false,
                "searchable": false
            },
            
      { "width": "10px", "targets": 0 },
      { "width": "100px", "targets": 1 },
      { "width": "10px", "targets": 2 },
      { "width": "10px", "targets": 3 },
      { "width": "20px", "targets": 4 },
      { "width": "20px", "targets": 5 },
      { "width": "10px", "targets": 6 },
      { "width": "20px", "targets": 7 },
      { "width": "20px", "targets": 8 },
      { "width": "10px", "targets": 9 }
            
            
            
        ],//hidekan userID
            columns: [{
        title: 'Display ID',
        data: "u_id"
      },
      {
        title: 'create',
        data: "ori_u_create_date"
      },
	  {
        title: 'last',
        data: "ori_u_modified_date"
      },
	  
      {
        title: 'ID',
        data: "u_displayid",
			render: function ( data, type, JsonResultRow, meta ) {
				var u_displayid = JsonResultRow['u_displayid'];
				var u_email = JsonResultRow['u_email'];
				return '<a style="white-space: pre-line;" data-html="true" href="manage_user.php?action=edit&u_id='+u_displayid+'" class="tooltip-right" data-tooltip="'+u_email+'" target="_blank">'+u_displayid+'</a>'
			}
      },
      
      
      {
        title: 'Display Name',
        data: "u_displayname"
      },
      {
        title: 'Active',
        data: "u_status"
      },
      {
        title: 'Age',
        data: "ud_dob"
      },
      {
        title: 'City',
        data: "ud_city"
      },
      {
        title: 'Phone No',
        data: "ud_phone_number"
      },
      {
        title: 'Type',
        data: "u_role"
      },
      
      {
        title: 'Rate',
        data: "ud_rate_per_hour",
			/*render: function ( data, type, JsonResultRow, meta ) {
				var ud_rate_per_hour = JsonResultRow['ud_rate_per_hour'];
				if(ud_rate_per_hour !== ''){
				    //return '<font color="blue"><span class="tooltip-left cursor" data-tooltip="'+ud_rate_per_hour+'" >..Cursor Here</span></font>'
				    return '<font color="blue"><span style="white-space: pre-line;" data-html="true" class="tooltip-left cursor" data-tooltip="'+ud_rate_per_hour+'" > <img src="img/output-onlinepngtools.png" alt="Smiley face" height="20" width="40"> </span></font>'
				}else{
				    return ''
				}
			}
			render: function ( data, type, JsonResultRow, meta ) {
				var ud_rate_per_hour = JsonResultRow['ud_rate_per_hour'];
				var res = ud_rate_per_hour.replace("testtest", "\n\n***SYSTEM***\n");
			
				if(ud_rate_per_hour !== ''){
				    return '<font color="blue"><span style="white-space: pre-line;" class="tooltip-left cursor" data-html="true" data-tooltip="'+res+'" > <img src="img/output-onlinepngtools.png" alt="Smiley face" height="20" width="40"> </span></font>'
				}else{
				    return ''
				}		
			}*/
			render: function ( data, type, JsonResultRow, meta ) {
				var ud_rate_per_hour = JsonResultRow['ud_rate_per_hour'];
				//var res = ud_rate_per_hour.replace("testtest", "\n\n***SYSTEM***\n");
				var u_id = JsonResultRow['u_id'];
				if(ud_rate_per_hour !== ''){
					return '<font color="blue"><span style="white-space: pre-line;" data-html="true" class="tooltip-left cursor" data-tooltip="'+ud_rate_per_hour+'" > <img src="img/output-onlinepngtools.png" alt="Smiley face" height="20" width="40"> </span></font>'

/*
tippy('#ajax-tippy'+u_id, {
  content: '<span style="white-space: pre-line;">'+ud_rate_per_hour+'</span>',
  allowHTML: true,
  arrow:  true,
  placement: 'left',
  flipOnUpdate: true
});
return '<font color="blue"><span id="ajax-tippy'+u_id+'" style="white-space: pre-line;"><img src="img/output-onlinepngtools.png" alt="Smiley face" height="20" width="40"></span></font> '
  */
				}else{
				    return ''
				}
			}
			
			
			
      },
      {
        title: 'Last Activity',
        data: "u_modified_date"
      },
      {
        title: 'Created On',
        data: "u_create_date"

      }
    ]

          });

}




/* Create Table Three*/
function createTablerowThree(data){

    $.fn.dataTable.moment( 'DD/MM/YYYY' );
       $('#search_table').DataTable({
            pageLength: 20,
            destroy:true,//elakkan dari error initialise
             language: {
                          "emptyTable":     "Tiada Maklumat Dijumpai!"
                        },
              
            paging: true,
            searching: true,
            deferRender: true,
            data : data,
            order : [[2,"desc"],[1,"desc"]],



              "columnDefs": [
            {
                "targets": [ 0 , 1 , 2, 9],
                "visible": false,
                "searchable": false
            },
            
      { "width": "10px", "targets": 0 },
      { "width": "100px", "targets": 1 },
      { "width": "10px", "targets": 2 },
      { "width": "10px", "targets": 3 },
      { "width": "20px", "targets": 4 },
      { "width": "20px", "targets": 5 },
      { "width": "10px", "targets": 6 },
      { "width": "20px", "targets": 7 },
      { "width": "20px", "targets": 8 },
      { "width": "10px", "targets": 9 }
            
            
            
        ],//hidekan userID
            columns: [{
        title: 'Display ID',
        data: "u_id"
      },
      {
        title: 'create',
        data: "ori_u_create_date"
      },
	  {
        title: 'last',
        data: "ori_u_modified_date"
      },
	  
      {
        title: 'ID',
        data: "u_displayid",
			render: function ( data, type, JsonResultRow, meta ) {
				var u_displayid = JsonResultRow['u_displayid'];
				var u_email = JsonResultRow['u_email'];
				return '<a style="white-space: pre-line;" data-html="true" href="manage_user.php?action=edit&u_id='+u_displayid+'" class="tooltip-right" data-tooltip="'+u_email+'" target="_blank">'+u_displayid+'</a>'
			}
      },
      
      
      {
        title: 'Display Name',
        data: "u_displayname"
      },
      {
        title: 'Active',
        data: "u_status"
      },
      {
        title: 'Age',
        data: "ud_dob"
      },
      {
        title: 'City',
        data: "ud_city"
      },
      {
        title: 'Phone No',
        data: "ud_phone_number"
      },
      {
        title: 'Type',
        data: "u_role"
      },

      {
        title: 'Rate',
        data: "ud_rate_per_hour",
			render: function ( data, type, JsonResultRow, meta ) {
				var ud_rate_per_hour = JsonResultRow['ud_rate_per_hour'];
				var res = ud_rate_per_hour.replace("testtest", "\n\n***SYSTEM***\n");
/*	
this	
*/				
				if(ud_rate_per_hour !== ''){
				    return '<font color="blue"><span style="white-space: pre-line;" class="tooltip-left cursor" data-html="true" data-tooltip="'+res+'" > <img src="img/output-onlinepngtools.png" alt="Smiley face" height="20" width="40"> </span></font>'
				}else{
				    return ''
				}		
			}
      },
      {
        title: 'Last Activity',
        data: "u_modified_date"
      },
      {
        title: 'Created On',
        data: "u_create_date"

      }
    ]

          });

}


$('.selectpicker').selectpicker({
  showSubtext:true
});



$('#startDateExcel').datepicker({
    startView: 1,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: "dd/mm/yyyy"
});

$('#endDateExcel').datepicker({
    startView: 2,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: "dd/mm/yyyy"
});

		$('#exportExcel').click(function(){
			var u_id             = $('#u_id').val();
			var u_email          = $('#u_email').val();
			var ud_first_name    = $('#ud_first_name').val();
			var ud_last_name     = $('#ud_last_name').val();
			var ud_phone_number  = $('#ud_phone_number').val();
			var u_gender         = $('#u_gender').val();
			var ud_client_status = $('#ud_client_status').val();
			var user_status      = $('#user_status').val();
			var dateCreatedStart = $('#dateCreatedStart').val();
			var dateCreatedtEnd = $('#dateCreatedtEnd').val();
			
			//alert(u_id + ' - ' + u_email + ' - ' + ud_first_name + ' - ' + ud_last_name + ' - ' + ud_phone_number + ' - ' + u_gender + ' - ' + ud_client_status + ' - ' + user_status + ' - ' + dateCreatedStart + ' - ' + dateCreatedtEnd);
			window.open("https://www.tutorkami.com/admin/user-excel.php?u_id="+ u_id +"&u_email="+ u_email +"&ud_first_name="+ ud_first_name +"&ud_last_name="+ ud_last_name +"&ud_phone_number="+ ud_phone_number +"&u_gender="+ u_gender +"&ud_client_status="+ ud_client_status +"&user_status="+ user_status +"&dateCreatedStart="+ dateCreatedStart +"&dateCreatedtEnd="+ dateCreatedtEnd, "_blank");
			


		});

$("#state_drop").change(function(){
	var state = $('#state_drop option:selected').val();

	if(state !== "" ){
		$.ajax({
			type:'POST',
			url:'function-state-city.php',
			data: {action: 'getAllCity', state: state}, 
			success:function(result){
				$("#removeHidden").removeClass("hidden");
				$("#hideSelectOptionCity").html(result);
			}
		});
	}else{
		$.ajax({
			type:'POST',
			url:'function-state-city.php',
			data: {action: 'getAllCity', state: state}, 
			success:function(result){
				$("#hideSelectOptionCity").html(result);
				$("#removeHidden").addClass("hidden");
			}
		});
	}

});


$('#parent_city').on('change', function() {
    var state_drop = $(this).val();
    $.ajax({
        url: "../ajax-get-location.php",
        method: "POST",
        data: {action: 'state_drop', state_drop: state_drop}, 
        success: function(result){
            $('#parent_cityText').html(result);
        }
    });
 });
 /*
 $('#locations_covered').on('change', function() {
    var locations_covered = $(this).val();
    $.ajax({
        url: "../ajax-get-location.php",
        method: "POST",
        data: {action: 'locations_covered', locations_covered: locations_covered}, 
        success: function(result){
            $('#locations_coveredText').html(result);
        }
    });
 });

 $('#locations_covered').on('change', function() {
    var locations_covered2 = $(this).val();
    $.ajax({
        url: "../ajax-get-location.php",
        method: "POST",
        data: {action: 'locations_covered2', locations_covered2: locations_covered2}, 
        success: function(result){
            $('#locations_coveredText').html(result);
        }
    });
 });
*/
function myRemoveSelect(thisid) {
  //alert(id);
  //807
/*
    var $select = $('#locations_covered');
    var idToRemove = thisid.trim();

    var values = $select.val();
    if (values) {
        var i = values.indexOf(idToRemove);
        if (i >= 0) {
            values.splice(i, 1);
            $select.val(values).change();
        }
    }*/
    //$('#locations_covered').select2('val', thisid);
    
//$("select option[value='volvo']").prop("selected", false);


}
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<!-- https://atomiks.github.io/tippyjs/v5/getting-started/-->
<script src="https://unpkg.com/popper.js@1"></script>
<script src="https://unpkg.com/tippy.js@5"></script>
