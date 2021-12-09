<?php
require_once('includes/head.php');
require_once('classes/user.class.php');
require_once('classes/location.class.php');
require_once('classes/app.class.php');

$userInit = new user;
$initLocation = new location;
$initApp = new app;

$resCnt = $initLocation->GetAllCountry();
$roleData = $userInit->GetAllRole();

if (count($_FILES) > 0) {
    
    $testimonial_path = array();
    /*if (isset($_FILES['user_testimonial'])) {
     foreach ($_FILES['user_testimonial']['name'] as $key => $value) {
     
     if ($_FILES['user_testimonial']['size'][$key] > 0) {
     $testimonialname = $_FILES['user_testimonial']['name'][$key];
     $testimonialtemp = $_FILES['user_testimonial']['tmp_name'][$key];
     $testimonialext  = explode(".", $testimonialname);
     $testimonialext  = end($testimonialext);
     $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
     
     if(in_array($testimonialext, $allowedext)){
     move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
     $testimonial_path[] = "files/".$testimonialname;
     }
     }
     }
     }*/
    if(isset($_FILES['user_testimonial1']['name']) && $_FILES['user_testimonial1']['name'] != ''){
        $testimonialname = $_FILES['user_testimonial1']['name'];
        $testimonialtemp = $_FILES['user_testimonial1']['tmp_name'];
        $testimonialext  = explode(".", $testimonialname);
        $testimonialext  = end($testimonialext);
        $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
        
        if(in_array($testimonialext, $allowedext)){
            move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
            $testimonial_path['user_testimonial1'] = "files/".$testimonialname;
        }
    }
    else{
        $testimonial_path['user_testimonial1']= '';
    }
    if(isset($_FILES['user_testimonial2']['name']) && $_FILES['user_testimonial2']['name'] != ''){
        $testimonialname = $_FILES['user_testimonial2']['name'];
        $testimonialtemp = $_FILES['user_testimonial2']['tmp_name'];
        $testimonialext  = explode(".", $testimonialname);
        $testimonialext  = end($testimonialext);
        $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
        
        if(in_array($testimonialext, $allowedext)){
            move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
            $testimonial_path['user_testimonial2'] = "files/".$testimonialname;
        }
    }
    else{
        $testimonial_path['user_testimonial2']= '';
    }
    if(isset($_FILES['user_testimonial3']['name']) && $_FILES['user_testimonial3']['name'] != ''){
        $testimonialname = $_FILES['user_testimonial3']['name'];
        $testimonialtemp = $_FILES['user_testimonial3']['tmp_name'];
        $testimonialext  = explode(".", $testimonialname);
        $testimonialext  = end($testimonialext);
        $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
        
        if(in_array($testimonialext, $allowedext)){
            move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
            $testimonial_path['user_testimonial3'] = "files/".$testimonialname;
        }
    }
    else{
        $testimonial_path['user_testimonial3']= '';
    }
    if(isset($_FILES['user_testimonial4']['name']) && $_FILES['user_testimonial4']['name'] != ''){
        $testimonialname = $_FILES['user_testimonial4']['name'];
        $testimonialtemp = $_FILES['user_testimonial4']['tmp_name'];
        $testimonialext  = explode(".", $testimonialname);
        $testimonialext  = end($testimonialext);
        $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');
        
        if(in_array($testimonialext, $allowedext)){
            move_uploaded_file($testimonialtemp, "../files/".$testimonialname);
            $testimonial_path['user_testimonial4'] = "files/".$testimonialname;
        }
    }
    else{
        $testimonial_path['user_testimonial4']= '';
    }
    
    
    $name       = $_FILES['u_profile_pic']['name'];
    $imgext     = explode(".", $name);
    $imgext     = end($imgext);
    $tmpname    = $_FILES['u_profile_pic']['tmp_name'];
    $extension  = array('jpg', 'jpeg', 'png', 'bmp');
    $name = uniqid().$imgext[0]."_0".$imgext[1];
    if(in_array($imgext, $extension)){
        move_uploaded_file($tmpname, "../images/profile/".$name);
        $picture_path = "images/profile/".$name;
    }
    
    if (isset($_FILES['ud_proof_of_accepting_terms'])) {
        
        $proof_name       = $_FILES['ud_proof_of_accepting_terms']['name'];
        $proof_imgext     = explode(".", $proof_name);
        $proof_imgext     = end($proof_imgext);
        $proof_tmpname    = $_FILES['ud_proof_of_accepting_terms']['tmp_name'];
        $proof_extension  = array('jpg', 'jpeg', 'png', 'bmp');
        
        if(in_array($proof_imgext, $proof_extension)){
            move_uploaded_file($proof_tmpname, "../files/proof_".time().'.'.$proof_imgext);
            $proof_picture_path = "files/proof_".time().'.'.$proof_imgext;
        }
    }
}

if (count($_POST) > 0) {
    $data = $_POST;
    
    $data['u_profile_pic'] = isset($picture_path) ? $picture_path : '';
    $data['ud_proof_of_accepting_terms'] = isset($proof_picture_path) ? $proof_picture_path : '';
    $data['u_testimonial'] = count($testimonial_path) > 0 ? $testimonial_path : '';
    
    $saveData = $userInit->SaveUser($data);
    
    if ($saveData !== false) {
        if (isset($_POST['save'])) {
            header('Location:manage_user.php');
            exit();
        } elseif (isset($_POST['save_edit'])) {
            header('Location:manage_user.php?action=edit&u_id='.$saveData);
            exit();
        } elseif (isset($_POST['approve_tutor'])) {
            $approveTutor = $userInit->ApproveUser($saveData);
            header('Location:manage_user.php?action=edit&u_id='.$saveData);
            exit();
        }
    }
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
?>
<!DOCTYPE html>
<html>
   <head>
   <?php 
    $title = 'Manage User | Tutorkami';
    require_once('includes/html_head.php'); 
   ?>

   <link rel="stylesheet" type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.9/css/dataTables.checkboxes.css" rel="stylesheet" />
   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></style>
     <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.jqueryui.min.css">
	  <link rel="stylesheet" type="text/css" href="/css/buttons.jqueryui.min.css">
	   
   <!-- -->

  <!--  -->


  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="css/plugins/dataTables/datatables.min.css">  -->
   
  <!--<script type="text/javascript" language="javascript" src="js/plugins/dataTables/datatables.min.js"></script>-->
 	 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.jqueryui.min.js"></script>
   <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
	 <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.jqueryui.min.js"></script>
	 <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">	</script>
	 <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js">	</script>
	 <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js">	</script>
	 <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js">	</script> 
	 <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js">	</script>
	 <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js">	</script>
	  
	  
	  
	  <script type="text/javascript" language="javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.9/js/dataTables.checkboxes.min.js"></script>
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
            if(isset($_GET['action']) && $_GET['action'] == 'add_new') {
               include_once('manage_user_add.php');
            } elseif(isset($_GET['action']) && $_GET['action'] == 'edit') {
               $userData = $userInit->GetAllUser('', $_GET['u_id']);
               $userRow = $userData->fetch_array(MYSQLI_ASSOC);
//var_dump($userRow);
//die();
               include_once('manage_user_add.php');
            } elseif(isset($_GET['action']) && $_GET['action'] == 'search_user') {
              //  echo $_GET['u_id']."ORNOT";
                $data['u_id']            = isset($_GET['u_id'])            ? $_GET['u_id'] : '';
                $data['is_tutor']        = isset($_GET['is_tutor'])        ? $_GET['is_tutor'] : '';
                $data['u_email']         = isset($_GET['u_email'])         ? $_GET['u_email'] : '';
                $data['ud_first_name']   = isset($_GET['ud_first_name'])   ? $_GET['ud_first_name'] : '';
                $data['ud_last_name']    = isset($_GET['ud_last_name'])    ? $_GET['ud_last_name'] : '';
                $data['ud_phone_number'] = isset($_GET['ud_phone_number']) ? $_GET['ud_phone_number'] : '';
                
                //function GetAllUser($user_role = NULL, $user_id = NULL, $user_status = NULL, $search_tutor = NULL, $search_email = NULL, $search_first_name = NULL, $search_last_name = NULL, $search_phone_number = NULL) {
               
               $userData = $userInit->SearchUser($data);
              //  $userData = $userInit->GetAllUser('','','',$data['is_tutor'] ,  $data['u_email'],$data['ud_first_name'] ,$data['ud_last_name'],$data['ud_phone_number']  );
              //  echo $data['u_id'] ;
                //$userData = $userInit->GetAllUser('', $data['u_id'],'','' ,  $data['u_email'],$data['ud_first_name'] ,$data['ud_last_name'],$data['ud_phone_number']);
              // var_dump($userData);
                $userRow = $userData->fetch_array(MYSQLI_ASSOC);
                //var_dump($userRow);
             include_once('manage_user_add.php');
            }else {
               $userData = $userInit->GetAllUser();
           }
            ?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">                     
                     <div class="ibox float-e-margins localization">
                        <div class="ibox-title">
                           <h5>User Listing</h5>
                           <div class="ibox-tools">                            
                              <a href="manage_user.php?action=add_new" class="btn btn-primary ">Add New</a> 
                           </div>
                        </div>
                        <div class="ibox-content">
                           <div class="form-horizontal">
                              <form action="manage_user.php" method="get">
                                 <input type="hidden" name="action" value="edit">
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Go to ID or Display ID:</label>
                                    <div class="col-lg-7">
                                       <div class="input-group">
                                          <input type="text" class="form-control" name="u_id">
                                          <span class="input-group-btn"> 
                                             <button type="submit" class="btn btn-primary">Go!</button> 
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                              <form action="manage_user" method="GET" id="filter_user">
                                 <input type="hidden" name="action" value="search_user" />
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">List Tutors Only:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="is_tutor" id="is_tutor">
                                          <option value="">All</option>
                                          <option value="Yes">Yes</option>
                                          <option value="No">No</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Email:</label>
                                    <div class="col-lg-7"><input type="email" class="form-control" name="u_email" /></div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">First name:</label>
                                    <div class="col-lg-7"><input type="text" class="form-control" name="ud_first_name" /></div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Last name:</label>
                                    <div class="col-lg-7"><input type="text" class="form-control" name="ud_last_name" /></div>
                                 </div>
                                 <div class="form-group for-tutors" style="display: none;">
                                    <label class="col-lg-3 control-label">Displayed name:</label>
                                    <div class="col-lg-7"><input type="text" class="form-control" name="u_displayname" /></div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Phone:</label>
                                    <div class="col-lg-7"><input type="text" class="form-control" name="ud_phone_number" /></div>
                                 </div>
                                 <div class="form-group for-tutors for-non-tutors">
                                    <label class="col-lg-3 control-label">Gender:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="u_gender">
                                          <option value="">All</option>
                                          <option value="M">Male</option>
                                          <option value="F">Female</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Race:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="ud_race">
                                          <option value="">All</option>
                                          <option value="Malay">Malay</option>
                                          <option value="Chinese">Chinese</option>
                                          <option value="Indian">Indian</option>
                                          <option value="Not selected">Others</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Tutor Status:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="ud_tutor_status">
                                          <option value="">All</option>
                                          <option value="Full Time">Full Time</option>
                                          <option value="Part Time">Part Time</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Occupation:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="ud_current_occupation">
                                          <option value="">All</option>
                                          <option value="Full-time tutor">Full-time tutor</option>
                                          <option value="Kindergarten teacher">Kindergarten teacher</option>
                                          <option value="Primary school teacher">Primary school teacher</option>
                                          <option value="Secondary school teacher">Secondary school teacher</option>
                                          <option value="Tuition center teacher">Tuition center teacher</option>
                                          <option value="Lacturer">Lacturer</option>
                                          <option value="Ex-teacher">Ex-teacher</option>
                                          <option value="Retired teacher">Retired teacher</option>
                                          <option value="Other">Other</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Areas:</label>
                                    <div class="col-lg-4">
                                       <select class="form-control" name="cover_area_state[]" id="state_drop">
                                          <option value="">Select state</option>
                                          <?php 
                                          // Get State By Country Id
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
                                    <div class="col-lg-5">
                                       <div class="showHide" style="display: none;">
                                          <div class="dropbox">Please tick the area(s)</div>
                                          <div class="dropPop">
                                             <div class="row">
                                                <div class="col-md-12 city_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAllClass('.city_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAllClass('.city_check');">Untick All</a></div>
                                                <div class="city-area"></div>
                                             </div>
                                          </div>
                                          <div class="row" style="margin-top: 10px; margin-right: 5px;">
                                             <div class="col-md-5">
                                                <div class="checkbox">
                                                   <label for="optionsRadios1">Others (optional) </label>
                                                </div>
                                             </div>
                                             <div class="col-md-7">
                                                <input type="text" class="form-control" name="location" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Subjects:</label>
                                    <div class="col-lg-4">
                                       <select class="form-control" name="tutor_course[]" id="level_drop">
                                          <option value="">Choose subject</option>
                                          <?php 
                                          // Get Course
                                          $getCourse = $initApp->ListCourse();
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
                                    <div class="col-lg-5">
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
                                                <input type="text" class="form-control" name="subject" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Consider Tuition Centre:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="tution_center">
                                          <option value="">All</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-tutors">
                                    <label class="col-lg-3 control-label">Tutor activated:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="u_admin_approve">
                                          <option value="">All</option>
                                          <option value="A">Yes</option>
                                          <option value="P">No</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">Client Status:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="ud_client_status">
                                          <option value="">All</option>
                                          <option value="Parent">Parent</option>
                                          <option value="Student">Student</option>
                                          <option value="TuitionCentre">Tuition Centre</option>
                                          <option value="Agent">Agent</option>
                                          <option value="Not Selected">Not Selected</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">User Role:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="u_role">
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
                                 </div>
                                 <div class="form-group for-non-tutors">
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
                                 </div>
                                 <div class="form-group for-non-tutors">
                                    <label class="col-lg-3 control-label">Paying Client:</label>
                                    <div class="col-lg-7">
                                       <label class="checkbox-inline"> <input type="checkbox" value="A" id="inlineCheckbox2" name="u_paying_client">  </label>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-9">
                                       <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit">Search</button>
                                       <a class="btn btn-sm btn-default sign-btn-box mrg-right-15" href="manage_user.php">Reset</a>
                                    </div>
                                 </div>
                                 *due to performance, search results are limited to 100 rows.
                              </form>
                           </div>
                        </div>
                        <div class="ibox-content">
                           <form id="frm-user-listing" action="export-selected-user.php" method="POST">
                              <div class="table-responsive">
                                <!-- <button class="btn btn-default btn-sm" type="submit" style="position: absolute; left: 110px; padding: 6px 8px;">Export Selected</button> -->
                                 <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded user-listing" data-page-size="15">
                                    <thead>
                                       <tr>
                                          <th></th>
                                          <th>Display ID</th>
                                        <!--     <th>Image</th> -->
                                          <th>Email</th>
                                          <th>First name</th>
                                        <!-- <th>Last name</th> -->  
                                          <th>Display Name</th>
                                          <th>Active</th>
                                          <th>Age</th>
                                          <th>City</th>
                                          <th>Phone Number</th>
                                          <th>Type</th>
                                          <th>Created on</th>
                                          <th>Last activity</th>
                                          <th style="width: 100px;"></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                       if ($userData->num_rows > 0) {
                                          $sl = 1;
                                          while( $row = $userData->fetch_assoc() ){
                                             $userCity = $initLocation->GetCity($row['ud_city']);
                                             $cityRow = ($userCity !== false) ? $userCity->fetch_array(MYSQLI_ASSOC) : array('city_name' => '');

                                             $userRole = $userInit->GetAllRole($row['u_role']);
                                             $roleRow = $userRole->fetch_array(MYSQLI_ASSOC);
                                             ?>
                                 
                                       <tr class="footable-even" style="display: table-row;">
                                          <td><?php echo $row['u_id'];?></td>
                                          <td class="footable-visible">
                                          <?php echo $row['u_displayid'];?>
                                          </td>
                                        <!--  <td class="footable-visible">
                                           <?php 
//                                              if (isset($row) && $row !== null) {
//                                                if ($row['u_profile_pic'] != 'x') {
                                                   
//                                                  //  print_r($row); die(); 
//                                                    $pix = sprintf("%'.07d\n", $row['u_profile_pic']);
//                                                  echo "<img height=200 width=100 src=\"".APP_ROOT."images/profile/".$pix."_0.jpg\" alt=\"profile_pic\" class=\"img-thumbnail\">";
//                                                } elseif ($row['u_gender'] == 'M') {
//                                                  echo '<img height=200 width=100 src="'.APP_ROOT."images/tutor_ma.png".'" alt="profile_pic" class="img-thumbnail">';
//                                                } else {
//                                                  echo '<img height=200 width=100 src="'.APP_ROOT."images/tutor_mi1.png".'" alt="profile_pic" class="img-thumbnail">';
//                                                }                  
//                                              } ?>
                                        </td> -->  
                                          <td class="footable-visible">
                                             <a target=_blank href=manage_user?action=edit&u_id=<?php echo $row['u_displayid'].">".$row['u_email'];?></a>
                                          </td>
                                          <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                             <?php echo $row['ud_first_name'];?>
                                          </td>
                                        <!--  <td class="footable-visible">
                                             <?php echo $row['ud_last_name'];?>
                                          </td> --> 
                                          <td><?php echo ($row['u_role'] == 3) ? $row['u_displayname'] : '';?></td>
                                          <td class="footable-visible">
                                             <?php echo ($row['u_status'] != 'A') ? '<i class="fa fa-times text-red"></i>' : '<i class="fa fa-check text-green"></i>';?>
                                          </td>
                                          <td class="footable-visible">
                                             <?php echo system::CalculateAge($row['ud_dob']);?>
                                          </td>
                                          <td class="footable-visible">
                                             <?php echo $row['ud_address'];?>
                                          </td>
                                          <td class="footable-visible">
                                             <?php echo $row['ud_phone_number'];?>
                                          </td>
                                          <td class="footable-visible">
                                           <?php switch($row['u_role']) {
                                              case 2: $urole = "Admin"; break;
                                              case 3: $urole = "Tutor"; break;
                                              case 4: $urole = "Client"; break;
                                                        }
                                          echo $urole; ?>
                                          </td>
                                          <td class="footable-visible">
                                             <?php echo $row['u_create_date'];?>
                                          </td>
                                          <td class="footable-visible">
                                             <?php echo $row['u_modified_date'];?>
                                          </td>
                                          <td class="footable-visible footable-last-column">
                                             <div class="btn-group">
                                                <a href="manage_user.php?action=edit&u_id=<?php echo $row['u_id'];?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:void(0);" title="Delete" onClick="if(confirm('Are you sure, you want to remove the user?'))document.location.href='manage_user.php?action=delete_user&u_id=<?php echo $row['u_id'];?>'" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i></a>
                                             </div>
                                          </td>
                                       </tr>
                                       <?php 
                                             $sl++;
                                          }
                                       } else {
                                          echo '<tr><td colspan="11">No Record Found</td></tr>';
                                       }
                                       ?>   
                                    </tbody>
                                 </table>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php //} ?>
            <?php include_once('includes/footer.php'); ?>
         </div>
      </div>
      <script>
   
    </script>
      
   </body>
</html>