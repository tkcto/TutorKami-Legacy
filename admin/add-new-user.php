<?php
require_once('includes/head.php');
require_once('classes/user.class.php');
require_once('classes/location.class.php');
require_once('classes/app.class.php');


/* START - fahli = create,update image/picture */
require_once('../includes/create-thumb.php');
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
    $name       = $_FILES['u_profile_pic']['name'];
    $imgext     = explode(".", $name);
    $imgext     = end($imgext);
    $tmpname    = $_FILES['u_profile_pic']['tmp_name'];
    $extension  = array('jpg', 'jpeg', 'png', 'bmp', 'JPEG', 'JPG');
    $name = uniqid().$imgext[0]."_0".$imgext[1];
    $path_parts = pathinfo($_FILES['u_profile_pic']['name']);

    if(in_array($imgext, $extension)){
		/* START fadhli*/		
		/*create directory with 777 permission if not exist - start*/
		//createDir(IMAGE_SMALL_DIR);
		createDir(IMAGE_MEDIUM_DIR);
		
		//$imagenumber = rand(5000,10000);
		$dataPic = $_POST;
		
		$namaFile = date("Ymd-His")."-".$dataPic['u_email'];
		$path[0] = $_FILES['u_profile_pic']['tmp_name'];
		$file = pathinfo($_FILES['u_profile_pic']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		$fileNameNew = $namaFile.'.jpg';
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
		
		createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE);
		$picture_path = $namaFile;
		/* END - fadhli */
    }

}

if (count($_POST) > 0) {
    $data = $_POST;

    $data['u_profile_pic'] = isset($picture_path) ? $picture_path : '';

    $saveData = $userInit->SaveUser($data);

    if ($saveData !== false) {
        if (isset($_POST['save'])) {
            header('Location:manage_user.php');
            exit();
        }
        if (isset($_POST['save_edit'])) {
          $u_id = $_GET['u_id'];
          if($u_id != ''){
          header('Location:manage_user.php?action=edit&u_id='.$u_id);
            exit();
          }
        }
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
  
    <script type="text/javascript" language="javascript" src="js/manageuserjs/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.jqueryui.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.jqueryui.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.print.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/buttons.colVis.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/manageuserjs/dataTables.checkboxes.min.js"></script>

    <script type="text/javascript" language="javascript" src="js/plugins/pace/pace.min.js"></script>
   <script type="text/javascript" language="javascript" src="js/manage_user.js"></script>

   <style>
      .localization .dt-buttons.btn-group {
         display: block;
      }
      .html5buttons {
         float: left;
      }

   </style>
   <!-- https://bootsnipp.com/snippets/VQpB -->
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
<!-- -->
            <?php
				if($_SESSION[DB_PREFIX]['u_first_name'] != 'mohd nurfadhli'){
					/*echo "<font color='red' size='5'> under construction</font>";
					exit();*/
				}
            ?>
<style>
.btn.btn-primary:disabled{
    background-color: #FF4500;
	border-color: #FF4500;
}
</style>

<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <form action="" method="post" id="frmMain" enctype="multipart/form-data">
            <?php echo (isset($userRow) && $userRow !== null) ? '<input type="hidden" name="u_id" value="'.$userRow['u_id'].'">' : '' ;?>            
            <div class="ibox float-e-margins localization">
               <div class="ibox-title">
                  <h5> User Profile</h5>     
    
                  <div class="ibox-tools">
                     <a href="manage_user.php" class="pull-left"><small>(back to user list)</small></a>

<style>
body {
    margin-bottom: 120px;   
}

.btn.dropdown-toggle ~ .dropdown-menu, 
ul.nav li.dropdown ul.dropdown-menu {
    background-color: rgb(244, 244, 244);
	background-color: rgb(255, 255, 255);
	border: 0 solid rgb(66, 133, 244);
	box-shadow: 0px 0px 3px rgba(25, 25, 25, 0.3);
	top: 0px;
	margin: 0px;
    padding: 0px;
}
ul.nav li.dropdown ul.dropdown-menu {
    position: absolute;
    width: 100%;
}
.dropdown-menu .dropdown-plus-title {
	width: 100%;
	color: rgb(51, 51, 51);
	padding: 6px 12px;
	font-weight: 800;
	border: 0 solid rgb(173, 173, 173);
	border-bottom-width: 2px;
	cursor: pointer;
}

ul.nav li.dropdown ul.dropdown-menu .dropdown-plus-title {
    padding-top: 10px;
    padding-bottom: 10px;
    line-height: 20px;
}

.btn.dropdown-toggle.btn-primary ~ .dropdown-menu .dropdown-plus-title {
    border-color: rgb(53, 126, 189);
}
.btn.dropdown-toggle.btn-success ~ .dropdown-menu .dropdown-plus-title {
    border-color: rgb(76, 174, 76);
}
.btn.dropdown-toggle.btn-info ~ .dropdown-menu .dropdown-plus-title {
    border-color: rgb(70, 184, 218);
}
.btn.dropdown-toggle.btn-warning ~ .dropdown-menu .dropdown-plus-title {
    border-color: rgb(238, 162, 54);
}
.btn.dropdown-toggle.btn-danger ~ .dropdown-menu .dropdown-plus-title {
    border-color: rgb(212, 63, 58);
}

@media (min-width: 768px) {
    ul.nav li.dropdown ul.dropdown-menu .dropdown-plus-title {
        padding-top: 15px;
        padding-bottom: 15px;
    }
}
@media (min-width: 768px) {
    ul.nav li.dropdown ul.dropdown-menu {
        width: auto;
    }
}
.buttonTransparent {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
	margin-top:5px;
	margin-bottom:5px;
	margin-left:8px;
}

select[readonly].select2-hidden-accessible + .select2-container {
    pointer-events: none;
    touch-action: none;

    .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }
}
</style>
<!--
<div class="btn-group">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
	<ul class="dropdown-menu pull-right" role="menu">
		<li class="dropdown-plus-title">Option<b class="pull-right glyphicon glyphicon-chevron-up"></b></li>
		<li><button class="buttonTransparent" name="save" type="submit">Save</button></li>
		<li><button class="buttonTransparent" name="save_edit" type="submit">Save and Continue Edit</button></li>
	</ul>
</div>
-->                
                
                



                     <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                     <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">S&CE</button>

                  </div>
                  <div class="tabs-container">
                     <ul class="nav nav-tabs" id="myid">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> User Info</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">User Roles</a></li>
                     </ul>
                     <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                           <div class="panel-body">
                              <div class="row">
                                 <div class="col-md-12">
								 
								 

                                 <div class="col-md-4 text-right <?php if(isset($_GET['action']) && $_GET['action'] == 'edit' && $userRow['u_role'] == 4){echo "hidden";}?>">
                                    <?php $pix = sprintf("%'.07d\n", $userRow['u_profile_pic']);
                                     if (isset($userRow) && $userRow !== null) {
                                       if ($userRow['u_profile_pic'] != '') {
											if ( is_numeric($userRow['u_profile_pic']) ) {
												echo "<img src=\"".APP_ROOT."images/profile/".$pix."_0.jpg\" alt=\"profile_pic\" class=\"img-thumbnail\">";
											}else{
												echo "<img src=\"".APP_ROOT."images/profile/".$userRow['u_profile_pic'].".jpg\" alt=\"profile_pic\" class=\"img-thumbnail\">";
											}
                                       } elseif ($userRow['u_gender'] == 'M') {
											echo '<img src="'.APP_ROOT."images/tutor_ma.png".'" alt="profile_pic" class="img-thumbnail">';
                                       } else {
											echo '<img src="'.APP_ROOT."images/tutor_mi1.png".'" alt="profile_pic" class="img-thumbnail">';
                                       }                  
                                     }
                                     ?><p>
                                     <input type="file" name="u_profile_pic" id="file-7" class="inputfile inputfile-6" accept="image/*"></p>
								 </div>


<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">Email :</label> <!-- Last name = email -->
	<div class="col-sm-8"><input type="text" class="form-control" name="ud_last_name" value="<?php if(isset($_SESSION['tempLast'])){echo $_SESSION['tempLast'];}  ?>" ></div>
</div>  
        
<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">Password :</label>
	<div class="col-sm-8"><input type="password" class="form-control" name="u_password" value="<?php if(isset($_SESSION['tempPass'])){echo $_SESSION['tempPass'];}else{echo '123456';}  ?>"></div>
</div>

<div class="clearfix "></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">Key :</label> <!-- Email = key -->
	<div class="col-sm-4">
		<input type="text" class="form-control" name="u_email" value="<?php if(isset($_SESSION['tempEmail'])){echo $_SESSION['tempEmail'];}  ?>"  >
	</div>
	<div class="col-sm-4">
		<select class="form-control" name="emailalias" id="emailalias">
			<option value="">Please Select</option>
			<option value="@tutorkami.com" selected >@tutorkami.com</option>
		</select>
	</div>
</div>

                                    <div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                       <label class="col-sm-2 control-label">Salutation :</label>
                                       <div class="col-sm-1">
                                            <select class="form-control" name="Salutation" id="Salutation" data-required>
                                               <option value=""> </option>
                                               <option value="Encik" >Encik</option>
                                               <option value="Puan"  selected>Puan</option>
                                               <option value="Cik"   >Cik</option>
                                               <option value="Mr"    >Mr</option>
                                               <option value="Mrs"   >Mrs</option>
                                               <option value="Madam" >Madam</option>
                                               <option value="Dato"  >Dato</option>
                                               <option value="Datin" >Datin</option>
                                               <option value="Mrs"   >Mrs</option>
                                            </select>
                                    </div>
                                    </div>

<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">First Name :</label>
	<div class="col-sm-8"><input type="text" class="form-control" name="ud_first_name" value="<?php if(isset($_SESSION['tempFirst'])){echo $_SESSION['tempFirst'];}  ?>" data-required></div>
</div>

<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">Gender : <br></label>
	<div class="col-sm-8">
		<div  class="form-horizontal i-checks">
			<label> <input type="radio" value="M" name="u_gender" <?php if(isset($_SESSION['tempGender'])){ if($_SESSION['tempGender'] == 'M'){echo 'checked';} }  ?> data-required> Male </label> &nbsp;&nbsp;&nbsp;&nbsp;
			<label> <input type="radio" value="F" name="u_gender" <?php if(isset($_SESSION['tempGender'])){ if($_SESSION['tempGender'] == 'F'){echo 'checked';} }else{echo 'checked';}  ?> data-required> Female </label>
		</div>
	</div>
</div>

   
                               
                                 </div>
                              </div>
                              
							  
<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group" id="dob">
	<label class="col-sm-2 control-label">Date Of Birth :</label>
	<div class="col-sm-8">
		<div class="input-group date">
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control date_picker" name="ud_dob" placeholder="select date" value="<?php if(isset($_SESSION['tempDOB'])){echo $_SESSION['tempDOB'];}  ?>" />
		</div>
	</div>
</div>
							  
<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">Phone :</label>
	<div class="col-sm-8"><input type="text" class="form-control" name="ud_phone_number" value="<?php if(isset($_SESSION['tempPhone'])){echo $_SESSION['tempPhone'];}  ?>" data-numeric></div>
</div>

<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group i-checks">
	<label class="col-sm-2 control-label">Race :</label>
	<div class="col-sm-8">
		<label class="udradio"> <input type="radio" value="Malay"   name="ud_race" <?php if(isset($_SESSION['tempRace'])){ if($_SESSION['tempRace'] == 'Malay'){echo 'checked';} }else{echo 'checked';}  ?> > Malay  </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label class="udradio"> <input type="radio" value="Chinese" name="ud_race" <?php if(isset($_SESSION['tempRace'])){ if($_SESSION['tempRace'] == 'Chinese'){echo 'checked';} }  ?> > Chinese </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label class="udradio"> <input type="radio" value="Indian"  name="ud_race" <?php if(isset($_SESSION['tempRace'])){ if($_SESSION['tempRace'] == 'Indian'){echo 'checked';} }  ?> > Indian </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label class="udradio"> <input type="radio" value="Others"  name="ud_race" <?php if(isset($_SESSION['tempRace'])){ if($_SESSION['tempRace'] == 'Others'){echo 'checked';} }  ?> > Others </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label class="udradio"> <input type="radio" value="Not selected" name="ud_race" <?php if(isset($_SESSION['tempRace'])){ if($_SESSION['tempRace'] == 'Not selected'){echo 'checked';} }  ?> > Not Selected </label>
	</div>
</div>

<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group i-checks">
	<label class="col-sm-2 control-label">Nationality :</label>
	<div class="col-sm-8">
		<label class="udradio"> <input type="radio" value="Malaysian"     name="ud_nationality" <?php if(isset($_SESSION['tempNat'])){ if($_SESSION['tempNat'] == 'Malaysian'){echo 'checked';} }else{echo 'checked';}  ?> > Malaysian </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label class="udradio"> <input type="radio" value="Non Malaysian" name="ud_nationality" <?php if(isset($_SESSION['tempNat'])){ if($_SESSION['tempNat'] == 'Non Malaysian'){echo 'checked';} }  ?> > Non Malaysian </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label class="udradio"> <input type="radio" value="Not Selected"  name="ud_nationality" <?php if(isset($_SESSION['tempNat'])){ if($_SESSION['tempNat'] == 'Non Selected'){echo 'checked';} }  ?> > Not Selected </label>
	</div>
</div>

<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">Address :</label>
	<div class="col-sm-8"><textarea class="form-control" name="ud_address" data-required><?php if(isset($_SESSION['tempAddress'])){echo $_SESSION['tempAddress'];}  ?></textarea></div>
</div>

	  
<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">City :</label>
	<div class="col-sm-4">
		<!--<select class="form-control cnty" name="ud_state" id="ud_state" data-required>
			<option value="" disabled selected hidden>Please Choose State...</option>
			
			<?php 
			/*$country_id = 150;
			$stresponse = $initLocation->CountryWiseState($country_id);
			if ($stresponse->num_rows > 0) {
				while( $cu_row = $stresponse->fetch_assoc() ){
					$sel = (isset($_POST['ud_state']) && $_POST['ud_state'] == $cu_row['st_id']) ? 'selected' : (($userRow['ud_state'] == $cu_row['st_id']) ? 'selected' : '' );
					
					
					//echo '<option value="'. $cu_row['st_id'] .'" '.$sel.'>'. $cu_row['st_name'] .'</option>';
					?>
					<option value="<?PHP echo $cu_row['st_id']; ?>"             
					<?PHP
					if(isset($_SESSION['tempState'])){ 
					    if($_SESSION['tempState'] == $cu_row['st_id']){
					        echo 'selected';
					    } 
					}
					?>
					><?PHP echo $cu_row['st_name']; ?></option>
					<?PHP
				}
			}*/
			?>
		</select>-->
                                       <select class="js-example-basic-single" name="ud_city" id="ud_city" style="width:100%;" data-required>
                                            <option></option>
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
															    if(isset($_SESSION['tempCity'])){if($_SESSION['tempCity'] == $resultDataCity['city_id']){$CityPlace = "selected='selected'";}else{$CityPlace = "";}}
																echo '<option '.$CityPlace.' value="'. $resultDataCity['city_id'] .'">'. $resultDataCity['city_name'] .'</option>';
															}			
														 }
													
													echo '</optgroup>';
												}
											     echo '<optgroup label="Online Tuition">';
											     	if(isset($_SESSION['tempCity'])){if($_SESSION['tempCity'] == '1384'){$CityPlace = "selected='selected'";}else{$CityPlace = "";}}
											     	echo '<option '.$CityPlace.' value="1384">Online Tuition</option>';
											     echo '</optgroup>';
											 }
										   ?>
                                       </select>
	</div>
	<div class="col-sm-4">
		<!--<select class="form-control cnty" name="ud_city" id="ud_city" data-required>
			<option value="" disabled selected hidden>Please Choose City...</option>
			<?php /*
					if(isset($_SESSION['tempCity'])){ 
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}
$query = "SELECT * FROM tk_cities WHERE city_st_id='$_SESSION[tempState]' ORDER BY city_name ASC"; 
$result = $dbCon->query($query); 
    if($result->num_rows > 0){ 
        while($rowThis = $result->fetch_assoc()){  
            ?><option value="<?php echo $rowThis['city_id']; ?>" <?php if ($_SESSION['tempCity'] == $rowThis['city_id'] ) echo 'selected' ; ?> ><?php echo $rowThis['city_name']; ?></option><?php
        } 
    }
    
$dbCon->close();  
					}*/
			?>
		</select>-->
                                           <?PHP
                                           if( isset($_SESSION['tempState']) && $_SESSION['tempState'] != ''){
                                               if( $_SESSION['tempCity'] != '1384' ){
                                                   $thisreadonly = 'readonly';
                                               }else{
                                                   $thisreadonly = '';
                                               }
                                           }else{
                                               $thisreadonly = 'readonly';
                                           }
                                           ?>
                                       <select class="js-example-basic-single" name="ud_state" id="ud_state" style="width:100%;" data-required <?PHP echo $thisreadonly; ?> >
                                           <?PHP
                                           if( isset($_SESSION['tempState']) && $_SESSION['tempState'] != ''){
    											 $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
    											 $rowDataState = $conDB->query($queryDataState);
    											 if ($rowDataState->num_rows > 0) {
    												while($resultDataState= $rowDataState->fetch_assoc()){
    												    if(isset($_SESSION['tempState'])){if($_SESSION['tempState'] == $resultDataState['st_id']){$StatePlace = "selected='selected'";}else{$StatePlace = "";}}
    												    echo '<option '.$StatePlace.' value="'. $resultDataState['st_id'] .'">'. $resultDataState['st_name'] .'</option>';
    												}
    											 }                                               
                                           }
                                           ?>
                                       </select>
		
		
	</div>
</div>

<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group i-checks">
	<label class="col-sm-2 control-label">Client Status :</label>
	<div class="col-sm-8">
		<label> <input type="radio" value="Parent"         name="ud_client_status_2" <?php if(isset($_SESSION['tempStatus2'])){ if($_SESSION['tempStatus2'] == 'Parent'){echo 'checked';} }else{echo 'checked';}  ?> data-required> Parent </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label> <input type="radio" value="Student"        name="ud_client_status_2" <?php if(isset($_SESSION['tempStatus2'])){ if($_SESSION['tempStatus2'] == 'Student'){echo 'checked';} }  ?> data-required> Student </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label> <input type="radio" value="Tuition Centre" name="ud_client_status_2" <?php if(isset($_SESSION['tempStatus2'])){ if($_SESSION['tempStatus2'] == 'Tuition Centre'){echo 'checked';} }  ?> data-required> Tuition Centre </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label> <input type="radio" value="Agent"          name="ud_client_status_2" <?php if(isset($_SESSION['tempStatus2'])){ if($_SESSION['tempStatus2'] == 'Agent'){echo 'checked';} }  ?> data-required> Agent </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label> <input type="radio" value="Not Selected"   name="ud_client_status_2" <?php if(isset($_SESSION['tempStatus2'])){ if($_SESSION['tempStatus2'] == 'Not Selected'){echo 'checked';} }  ?> data-required> Not Selected </label>
	</div>
</div>
							  
<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group i-checks">
	<label class="col-sm-2 control-label">User Status :</label>
	<div class="col-sm-8">
		<label><input type="radio" name="u_status" value="A" id="inlineCheckbox1" <?php if(isset($_SESSION['tempStatus'])){ if($_SESSION['tempStatus'] == 'A'){echo 'checked';} }else{echo 'checked';}  ?> > Active </label> &nbsp;&nbsp;&nbsp;&nbsp;
		<label><input type="radio" name="u_status" value="B" id="inlineCheckbox1" <?php if(isset($_SESSION['tempStatus'])){ if($_SESSION['tempStatus'] == 'B'){echo 'checked';} }  ?> > Banned </label>				<!-- new user status added on 14/10/21 (siti) value is C-->		<label><input type="radio" name="u_status" value="C" id="inlineCheckbox1" <?php if(isset($_SESSION['tempStatus'])){ if($_SESSION['tempStatus'] == 'C'){echo 'checked';} }  ?> > DON'T HIRE </label>
	</div>
</div>

<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group i-checks">
	<label class="col-sm-2 control-label">Paying Client :</label>
	<div class="col-sm-8">
		<label class="checkbox-inline"> <input type="checkbox" value="P" id="inlineCheckbox2" name="u_paying_client" <?php if(isset($_SESSION['tempPay'])){ if($_SESSION['tempPay'] == 'P'){echo 'checked';} }  ?>>  </label>
	</div>
</div>
          
<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">List of Past Jobs :</label>
	<div class="col-sm-8">
	<?php 
	// Get all the Job Ids for this tutor
	/*if (isset($userRow) && $userRow !== null) {
		if ($userRow['u_role'] != 3) {
			$jobList = $userInit->ClientsJob($userRow['u_email']);
		} else {
			$jobList = $userInit->TutorsJob($userRow['u_email']);   
		}
                                       
		if ($jobList->num_rows > 0) {
			while ($appliedjob = $jobList->fetch_assoc()) {
				echo '<label class="label label-primary"><a href="job-edit.php?j='.$appliedjob['j_id'].'" target="_blank" style="color:#FFF; text-decoration: none;">'.$appliedjob['j_id'].'</a></label> ';
			}
		}
	}*/
	?>
	</div>
</div>
			
<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">Admin Comment :</label>
	<div class="col-sm-8">
		<div class="clearfix"></div>
		<textarea class="form-control col-lg-12 col-sm-12" rows="5" name="ud_admin_comment" ><?php if(isset($_SESSION['tempComm'])){echo $_SESSION['tempComm'];}  ?></textarea>
	</div>
</div>
							 						  
<div class="clearfix"></div>
<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="col-sm-2 control-label">Country :</label>
	<div class="col-sm-8">
		<select class="form-control cnty" name="ud_country" id="ud_country" data-required>
			<?php while($arrCnt = $resCnt->fetch_assoc()) {?>
				<option selected="selected" value="<?php echo $arrCnt['c_id'];?>" <?php echo (isset($_POST['ud_country']) && $_POST['ud_country'] == $arrCnt['c_id']) ? 'selected' : ( (isset($userRow) && $userRow !== null && $userRow['ud_country'] == $arrCnt['c_id'])? 'selected' : '' );?>><?php echo $arrCnt['c_name'];?></option>
			<?php } ?>
		</select>
	</div>
</div>

<!--
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">IP Address :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="ip_address" value="<?PHP echo $replacedText; ?>" disabled></div>
                              </div>

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Registration Date :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="registration_date" value="<?PHP echo $createDate; ?>" disabled></div>
                              </div>

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Last Activity :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="last_activity" value="<?PHP echo $lastActivity; ?>" disabled></div>
                              </div>
							  

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Last Visited Page :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="last_visited_page" value="<?PHP echo $lastPage; ?>" disabled></div>
                              </div>
							  
-->				
							  
							  
							  
							  
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                           </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                           <div class="panel-body">
                              <?php //aaaa
                              if ($roleData->num_rows > 0) {$ur = 0;
                                 while( $row = $roleData->fetch_assoc() ){

                                    if($row['r_id'] >= $_SESSION[DB_PREFIX]['r_id']) {
                              ?>
                            
                              <div class="form-group i-checks">
                                 <label class="col-sm-2 control-label"><?php echo $row['r_name'];?> :</label>
                                 <div class="col-sm-10"><label class="checkbox-inline"><input type="radio" value="<?php echo $row['r_id'];?>" id="u_role" name="u_role" <?php 
                                 if ((isset($_POST['u_role']) && $_POST['u_role'] == $row['r_id']) || ( isset($userRow) && $userRow !== null && $row['r_id'] == $userRow['u_role'] )) {
                                    echo 'checked';
                                 } elseif (!isset($userRow) && $ur == 3) {
                                    echo 'checked';
                                 }
                                 ?> checked='checked' data-required/></label></div>
                              </div>
                        
                           
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <?php 
                                       $ur++;
                                    }
                                 }
                              }
                              ?>
                           </div>
                        </div>

                     </div>
                     <div class="panel-body hidelater">
                        <div class="form-group">
                           <div class="col-sm-10 col-sm-offset-2">
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">S&CE</button>
<!--                              
<div class="btn-group">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
	<ul class="dropdown-menu pull-right" role="menu">
		<li class="dropdown-plus-title">Option<b class="pull-right glyphicon glyphicon-chevron-up"></b></li>
		<li><button class="buttonTransparent" name="save" type="submit">Save</button></li>
		<li><button class="buttonTransparent" name="save_edit" type="submit">Save and Continue Edit</button></li>
	</ul>
</div>
-->							  
							  
							  
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div class="clearfix"></div>
</div>








<!-- -->
            <?php include_once('includes/footer.php'); ?>
         </div>
      </div>
   </body>
</html>
<script>/*
  function reply_click(clicked_id)
  {
      alert(clicked_id);
  }


    $(document).ready(function(){
        $("input[name='u_role']").click(function(){
        	var radioValue = $("input[name='u_role']:checked").val();
            if(radioValue){
                alert("Your are a - " + radioValue);
            }
        });
    });*/
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>  
$(".js-example-basic-single").select2({
	placeholder: "Choose one of the following...",
	allowClear: true,

});

$('#ud_city').on('change', function() {
	//var selCntry = $(this).val();
    //alert(selCntry);
    var getAddressV = document.getElementsByName("ud_address")[0].value;
    var CityID = $(this).val();
    if( CityID == '1384' ){
        $('#ud_state').attr("readonly", false); 
        
        if( getAddressV != '' ){
            //document.getElementsByName("ud_address")[0].innerHTML = getAddressV + '&nbsp;';
            if (!getAddressV.replace(/\s/g, '').length) {
                document.getElementsByName("ud_address")[0].innerHTML = '&nbsp;';
            }else{
                document.getElementsByName("ud_address")[0].innerHTML = getAddressV + '&nbsp;';
            }            
        }else{
            document.getElementsByName("ud_address")[0].innerHTML = '&nbsp;';
        }

            
        $.ajax({
            url: "ajax-get-location.php",
            method: "POST",
            data: {action: 'CityID', CityID: CityID}, 
            success: function(result){
                $('#ud_state').html(result);
            }
        });     
    }else{
        $('#ud_state').attr("readonly", true); 
        if( getAddressV != '' ){
            if (!getAddressV.replace(/\s/g, '').length) {
                document.getElementsByName("ud_address")[0].innerHTML = '';
            }else{
                document.getElementsByName("ud_address")[0].innerHTML = getAddressV + '&nbsp;';
            }            
        }else{
            document.getElementsByName("ud_address")[0].innerHTML = '';
        }
        $.ajax({
            url: "ajax-get-location.php",
            method: "POST",
            data: {action: 'CityID', CityID: CityID}, 
            success: function(result){
                $('#ud_state').html(result);
            }
        });        
    }
 });
 

 
 
 
 
 
</script>