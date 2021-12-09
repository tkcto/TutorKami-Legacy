<?php
require_once('includes/head.php'); 
require_once('classes/user.class.php');
require_once('classes/app.class.php');
require_once('classes/job.class.php');
$instApp = new app;
$instJob = new job;
$userInit = new user;

$resLang = $instApp->FetchLanguage();
$resJobLevel = $instJob->FetchJobLevel();
$resStates = $instApp->FetchStatesByCountry(150);

if(count($_POST) > 0){
 $data = $instJob->RealEscape($_REQUEST);
 $res =  $instJob->SaveJob($data);
 if ($res !== false) {
    if (isset($_POST['save'])) {
       header('Location:job-list.php');
       exit();
    } elseif (isset($_POST['save_edit'])) {               
       header('Location:job-edit.php?j='.$res);
       exit();
    }elseif (isset($_POST['save2'])) {               
       header('Location:job-list.php');
       exit();
    } elseif (isset($_POST['save_edit2'])) {               
       header('Location:job-edit.php?j='.$res);
       exit();
    }    
 }
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_job') {
   if (isset($_GET['j_id']) && $_GET['j_id'] != '') {
      $saveData = $instJob->DeleteJob($_GET['j_id']);
      header('Location:job-list.php');
      exit();
   }   
}

if(isset($_REQUEST['j'])){
  $arrJb  = $instJob->GetJob($_REQUEST['j']);
  $resJbt = $instJob->GetJobTranslationByJob($_REQUEST['j']);
  $arrJbt = $resJbt->fetch_array(MYSQLI_ASSOC);
  $resJobEmail = $instJob->FetchJobEmail();
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
    <?php 
	if(isset($_REQUEST['j'])){
		$title = 'Job Edit | Tutorkami';
	}else{
		$title = 'Job Add | Tutorkami';
	}
    require_once('includes/html_head.php'); 
    ?>
<style>
.checkbox label:after {
  content: '';
  display: table;
  clear: both;
}

.checkbox .cr {
  position: relative;
  display: inline-block;
  border: 1px solid #a9a9a9;
  border-radius: .25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: .5em;
}

.checkbox .cr .cr-icon {
  position: absolute;
  font-size: .8em;
  line-height: 0;
  top: 50%;
  left: 15%;
}

.checkbox label input[type="checkbox"] {
  display: none;
}

.checkbox label input[type="checkbox"]+.cr>.cr-icon {
  opacity: 0;
}

.checkbox label input[type="checkbox"]:checked+.cr>.cr-icon {
  opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled+.cr {
  opacity: .5;
}

.btn-orange { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-orange:hover, 
.btn-orange:focus, 
.btn-orange:active, 
.btn-orange.active, 
.open .dropdown-toggle.btn-orange { 
  color: #ffffff; 
  background-color: #f1592a; 
  border-color: #F1592A; 
} 
 
.btn-orange:active, 
.btn-orange.active, 
.open .dropdown-toggle.btn-orange { 
  background-image: none; 
} 
 
.btn-orange.disabled, 
.btn-orange[disabled], 
fieldset[disabled] .btn-orange, 
.btn-orange.disabled:hover, 
.btn-orange[disabled]:hover, 
fieldset[disabled] .btn-orange:hover, 
.btn-orange.disabled:focus, 
.btn-orange[disabled]:focus, 
fieldset[disabled] .btn-orange:focus, 
.btn-orange.disabled:active, 
.btn-orange[disabled]:active, 
fieldset[disabled] .btn-orange:active, 
.btn-orange.disabled.active, 
.btn-orange[disabled].active, 
fieldset[disabled] .btn-orange.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-orange .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}
</style>
    </head>
    <body>
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
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>

      <div class="wrapper wrapper-content animated fadeInRight">
         <div class="row">
            <div class="col-lg-12">
               <form action="" method="post" class="form-horizontal" id="formJob">
                  <input type="hidden" name="j_id" id="j_id" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_id'] : ''; ?>"> 
                  <div class="ibox float-e-margins localization">
                     <div class="ibox-title">
                        <h5><?PHP if(isset($_REQUEST['j'])){echo "Edit Job";}else{echo "Job  Add";}?></h5>
                        <div class="ibox-tools">
                          <!-- <a href="classes-add.php?job_id=<?php echo $arrJb['j_id'];?>"><button class="btn btn-sm btn-orange sign-btn-box mrg-right-15" name="view_class" type="button">Add Class</button></a> -->
                           <button class="btn btn-sm btn-orange sign-btn-box mrg-right-15 btnDisabled1" name="save" type="submit">Save</button>
                           <button class="btn btn-sm btn-orange sign-btn-box mrg-right-15 btnDisabled2" name="save_edit" type="submit">S&#38;CE</button>
                           <?php if(isset($_REQUEST['j'])) { ?>
                           <button class="btn btn-sm btn-orange sign-btn-box mrg-right-15" type="button" title="Delete" onClick="if(confirm('Are you sure, you want to remove the job?'))document.location.href='job-edit.php?action=delete_job&j_id=<?php echo $arrJb['j_id'];?>'">Delete</button>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="ibox-content">
                      <div class="form-group">
                           <!-- <label class="col-lg-3 control-label">User ID:</label> -->
                           <div class="col-lg-7">
                            <input type="hidden" name="u_id" id="u_id" value="<?php echo $_GET['u_id'];?>">                            
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Job ID :</label>
                           <div class="col-sm-7">
                               <!-- <p><?php echo isset($_REQUEST['j']) ? $arrJb['j_id'] : ''; ?></p> -->
                               <?php 
                             if (isset($_REQUEST['j'])) {
                              $jobResEm = $userInit->GetJobIdLink($arrJb['j_id']);
                              $jobRowEm = $jobResEm->fetch_array(MYSQLI_ASSOC);
                              if ($jobResEm->num_rows > 0) {
                                // echo '<label class="label label-primary"><a href="classes-add?cl='.$jobRowEm['cl_id'].'" target="_blank" title="ID: '.$jobRowEm['cl_id'].'" style="color:#FFF; text-decoration: none;">View Class</a></label> ';
                                echo '<p>'.$arrJb['j_id'].' <label class="label label-primary"><a href="classes-add?cl='.$jobRowEm['cl_id'].'" target="_blank" title="ID: '.$jobRowEm['cl_id'].'" style="color:#FFF; text-decoration: none;">View Class</a></label></p>';
                              }else{
                                ?>

                                   
                               <p><?php echo isset($_REQUEST['j']) ? $arrJb['j_id'] : ''; ?> <i class="label label-danger">No classes created yet!</i>
                                 <label class="label label-warning"><a href="classes-add.php?job_id=<?php echo $arrJb['j_id'];?>" style="color:#FFF; text-decoration: none;">Add Class</a></label>
                               </p>
                                <?php
                                
                              }
                             }
                             ?>
                           </div>
                        </div>
                        <!--<div class="form-group" id="data_1">-->
						<div class="form-group" id="date_create">
                           <label class="col-sm-3 control-label">Date :</label>
                           <div class="col-sm-7">
                              <div class="input-group date">
                                 <!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" required="" name="j_date" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['j_create_date'] : ''; ?>">-->
								 <!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="j_date" value="<?php // if(isset($_REQUEST['j'])){echo $arrJb['j_create_date'];}else{echo date('Y-m-d');} ?>">-->
								 <!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="j_create_date" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['j_create_date'] : ''; ?>" />-->
								 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" required name="j_create_date" value="<?php if(isset($_REQUEST['j'])){
									 //echo date("d/m/Y", strtotime($arrJb['j_create_date']));
 if($arrJb["j_create_date"] =='0000-00-00 00:00:00' || $arrJb["j_create_date"] ==''){
	 echo '';
 }else{
	echo date("d/m/Y", strtotime($arrJb['j_create_date']));
 }
									 }else{
										 echo date('d/m/Y');} ?>" />
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Created By :</label>
                           <div class="col-lg-7">
						   <!-- START fadhli -->
						   <?PHP
						   if(isset($_REQUEST['j'])){
						   ?>
								<select class="form-control" id="j_creator_email" name="j_creator_email">
									<?php while($arrJobEmail = $resJobEmail->fetch_assoc()){ ?>
									<option value="<?php echo $arrJobEmail['email']; ?>" <?php if(isset($_REQUEST['j'])) echo $arrJb['j_creator_email']==$arrJobEmail['email']?'selected':''?>><?php echo $arrJobEmail['email']; ?></option>
									<?php } ?>
								</select>  
						   <?PHP
						   }else{
						   ?>
								<textarea class="form-control" name="j_creator_email" readonly="true"><?php echo isset($_REQUEST['j']) ? $arrJb['j_creator_email'] : $_SESSION[DB_PREFIX]['u_email']; ?></textarea>
						   <?PHP
						   }
						   ?>
						   <!-- END fadhli -->
                           </div>
                        </div>
						
						
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Level :</label>
                           <div class="col-lg-7">
                              <select class="form-control" name="j_jl_id">
                                <?php 
                                $resJobLvl = $instJob->FetchJobLevelByLanguage('en');
                                while($arrJobLvl = $resJobLvl->fetch_assoc()){
                                ?>
                                <option value="<?=$arrJobLvl['jlt_jl_id']?>" <?php if(isset($_REQUEST['j'])) echo ($arrJobLvl['jlt_jl_id']==$arrJb['j_jl_id'])?'selected':''?>><?=$arrJobLvl['jlt_title']?></option>
                                <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Subject :</label>
                           <div class="col-lg-7">
                            <input type="text" class="form-control" name="jt_subject[en]" id="jt_subject" value="<?php echo isset($_REQUEST['j']) ? $arrJbt['jt_subject'] : ''; ?>" required/> 
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Area :</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="j_area" id="j_area" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_area'] : ''; ?>" required> 
                           </div>
                        </div>
                        <!--<div class="form-group">
                           <label class="col-lg-3 control-label">State:</label>
                           <div class="col-lg-7">
                              <select class="form-control" name="j_state_id" id="j_state_id" required>
                                 <option value="">Select State</option>
                                 <?php //while($arrStates = $resStates->fetch_assoc()){?>
                                 <option value="<?//=$arrStates['st_id']?>" <?php //if(isset($_REQUEST['j'])) echo ($arrStates['st_id']==$arrJb['j_state_id'])?'selected':''?>><?php //echo $arrStates['st_name']?></option>
                                 <?php //}?>
                              </select>
                           </div>
                        </div>-->
                        
                        

                        <div class="form-group">
                            <label class="col-sm-3 control-label">City :</label>
                            <div class="col-sm-3">
                  
                              <select class="form-control" name="j_state_id" id="j_state_id" required>
                                 <option value="">Select State</option>
                                 <?php while($arrStates = $resStates->fetch_assoc()){?>
                                 <option value="<?=$arrStates['st_id']?>" <?php if(isset($_REQUEST['j'])) echo ($arrStates['st_id']==$arrJb['j_state_id'])?'selected':''?>><?php echo $arrStates['st_name']?></option>
                                 <?php }?>
                              </select>
								 
                            </div>
                            
<?PHP

if($_SESSION[DB_PREFIX]['u_first_name'] == 'Mohd Nurfadhli'){
    

}
?>


                            <div class="col-sm-4">
                                <select class="form-control" name="newCity" id="newCity" required>
                                    <option>Select City Name</option>
                                    <?php 
                                        /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                                        if ($dbCon->connect_error) {
                                            die("Connection failed: " . $dbCon->connect_error);
                                        }*/
                                        if(isset($_GET['u_id'])){
                                            //echo $_GET['u_id'];
                                            $qUser = " SELECT * FROM tk_user_details WHERE ud_u_id='".$_GET['u_id']."' "; 
                                            $rUser = $conDB->query($qUser); 
                                            if($rUser->num_rows > 0){ 
                                                $rowUser = $rUser->fetch_assoc();
                                            }
                                            
                                        }
                                        $query = "SELECT * FROM tk_cities WHERE city_st_id='".$rowUser['ud_state']."' ORDER BY city_name ASC"; 
                                        $result = $conDB->query($query); 
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()){
                                                ?><option value="<?php echo $row['city_id']; ?>" <?php if($row['city_id'] == $rowUser['ud_city']){echo 'selected';}?> ><?php echo $row['city_name']; ?></option><?php
                                            }
                                            ?><option value="1384" <?php if('1384' == $rowUser['ud_city']){echo 'selected';}?> >Online Tuition</option><?php
                                        }
                                        //$dbCon->close();                                          
                                      
                                    ?>
                                </select>
                            </div>


                            
                            
                            
                        </div>



                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Key :</label>
                           <div class="col-lg-5"><input type="email" class="form-control" name="j_email" id="j_email" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_email'] : ''; ?>" required> 
                           </div>
                           <div class="col-lg-4">
                             <?php 
                             if (isset($_REQUEST['j'])) {
                              $userResEm = $userInit->GetUserJobAddLink('4', $arrJb['j_email']);
                              $userRowEm = $userResEm->fetch_array(MYSQLI_ASSOC);
                              if ($userResEm->num_rows > 0) {
                                
                                echo '<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$userRowEm['u_displayid'].'" target="_blank" title="ID: '.$userRowEm['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$userRowEm['u_email'].'</a></label> ';
                              }else{
                                echo '<label class="label label-danger">Parent not exists</label> ';
                              }
                             }
                             ?>
                           </div>
                        </div>
                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Telephone :</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="j_telephone" id="j_telephone" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_telephone'] : ''; ?>" required> 
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Lessons :</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="jt_lessons[en]" value="<?php echo isset($_REQUEST['j']) ? $arrJbt['jt_lessons'] : ''; ?>" required /> 
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Preferred Time & Day :</label>
                           <div class="col-lg-7">
                                <div class="input-group">
                                    <input style="height:45px;" type="text" class="form-control" name="j_preferred_date_time" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_preferred_date_time'] : ''; ?>" required> 
                                    <span class="input-group-addon">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="j_check_timeday"><span class="cr" style="margin-left:-10px;"><i class="cr-icon glyphicon glyphicon-ok"></i></span></label>
                                        </div>
                                    </span>
                                </div>                           
                           </div>
                        </div>

                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Duration :</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="j_duration" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_duration'] : ''; ?>" required> 
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Status :</label>
                           <div class="col-lg-7">
                              <select class="form-control" name="j_status" required>
                                 <option value='open' <?php if(isset($_REQUEST['j'])) echo $arrJb['j_status']=="open"?'selected':''?>>Open</option>
                                 <option value='closed' <?php if(isset($_REQUEST['j'])) echo $arrJb['j_status']=="closed"?'selected':''?>>Closed</option>
                                 <option value='negotiating' <?php if(isset($_REQUEST['j'])) echo $arrJb['j_status']=="negotiating"?'selected':''?>>Negotiating</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Payment Status :</label>
                           <div class="col-lg-7">
                              <select class="form-control" name="j_payment_status" required>
                                 <option value='pending' <?php if(isset($_REQUEST['j'])) echo $arrJb['j_payment_status']=="pending"?'selected':''?>>Unpaid</option>
                                 <option value='paid' <?php if(isset($_REQUEST['j'])) echo $arrJb['j_payment_status']=="paid"?'selected':''?>>Paid</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group" id="date_deadline">
                           <label class="col-sm-3 control-label">Deadline :</label>
                           <div class="col-sm-7">
                              <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="j_deadline" value="<?php 
								 //echo isset($_REQUEST['j']) ? $arrJb['j_deadline'] : ''; 
if(isset($_REQUEST['j'])){
	if($arrJb["j_deadline"] =='0000-00-00' || $arrJb["j_deadline"] ==''){
		echo '';
	}else{
		echo date("d-m-Y", strtotime($arrJb['j_deadline']));
	}
}
								 
								 ?>" />
							 
                              </div>
                           </div>
                        </div>
                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Hired Tutor :</label>
                           <div class="col-lg-5"><input type="text" class="form-control" name="j_hired_tutor_email" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_hired_tutor_email'] : ''; ?>" />
                           </div>
                           <div class="col-lg-4">
                            <?php 
                            if(isset($_REQUEST['j']) && $arrJb['j_hired_tutor_email'] != '') {
                              $userRes = $userInit->GetUserJobAddLink('3', $arrJb['j_hired_tutor_email']);
                              $userRow = $userRes->fetch_array(MYSQLI_ASSOC);
                              // var_dump($userRes);die;
                              if ($userRes->num_rows > 0) {
                                // print_r('ada row');die;
                                echo '<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$userRow['u_displayid'].'" target="_blank" title="ID: '.$userRow['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$userRow['u_email'].'</a></label> ';
                              }else{
                                echo '<label class="label label-danger">Tutor not exists</label> ';
                              }
                            }
                            ?>
                           </div>
                        </div>
                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Tutor's Applying :</label>
                           <div class="col-lg-7">
                              <div class="well">
                                <?php 
                                if (isset($_GET['j']) && $_GET['j'] != '') {                                    
                                  $resAJ = $instJob->JobWiseAppliedJobs($_GET['j']);
                                  if ($resAJ->num_rows > 0) {
                                    while( $j_row = $resAJ->fetch_assoc() ){
                                      echo '<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$j_row['u_displayid'].'" target="_blank" title="ID: '.$j_row['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$j_row['u_email'].'</a></label> ';
                                    }
                                  }
                                }
                                ?>
                              </div>
                           </div>
                        </div>
						
                        <!--<div class="form-group">
                           <label class="col-lg-3 control-label" >Tutor’s Rate:</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="j_rate" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['j_rate'] : ''; ?>" required> 
                           </div>
                        </div>-->
                        
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Tutor’s Rate :</label>
                           <div class="col-lg-7">
                                <div class="input-group">
                                    <input style="height:45px;" type="text" class="form-control" name="j_rate" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_rate'] : ''; ?>" required> 
                                    <span class="input-group-addon">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="j_check_rate"><span class="cr" style="margin-left:-10px;"><i class="cr-icon glyphicon glyphicon-ok"></i></span></label>
                                        </div>
                                    </span>
                                </div>                           
                           </div>
                        </div>
                        
                        
                        

                        
                        <!--<div class="form-group">
                           <label class="col-lg-3 control-label">Preferred Time & Day:</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="j_preferred_date_time" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_preferred_date_time'] : ''; ?>" required> 
                           </div>
                        </div>-->
                        
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Commission :</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="j_commission" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_commission'] : ''; ?>" required> 
                           </div>
                        </div>
						
						
						
						
						
						
						
						
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Remarks :</label>
                           <div class="col-lg-7">
                              <textarea class="form-control" rows="5" name="jt_remarks[en]"><?php echo isset($_REQUEST['j']) ? $arrJbt['jt_remarks'] : ''; ?></textarea>
                           </div>
                        </div>
                        <div class="form-group" id="data_3">
                           <label class="col-sm-3 control-label">Start Date :</label>
                           <div class="col-sm-7">
                              <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_start_date'] : ''; ?>"  name="j_start_date" />
                              </div>
                           </div>
                        </div>
                        <div class="form-group" id="data_4">
                           <label class="col-sm-3 control-label">Due Date :</label>
                           <div class="col-sm-7">
                              <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_end_date'] : ''; ?>" name="j_end_date" />
                              </div>
                           </div>
                        </div>

                        

                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Parent's Email :</label>
                           <div class="col-lg-5"><input type="email" class="form-control" name="actual_email" id="actual_email" value="<?php echo isset($_REQUEST['j']) ? $arrJb['actual_email'] : ''; ?>" > 
                           </div>
                        </div>
                        
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Parent’s Rate :</label>
                           <!--<div class="col-lg-7">
                               <input type="text" class="form-control" name="parent_rate" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['parent_rate'] : ''; ?>" > 
                           </div>
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <input onkeypress="return isNumberKey(event)" type="text"  class="form-control" name="parent_rate" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['parent_rate'] : ''; ?>" style="width:55px;" > <span> <font size="2">&nbsp;&nbsp;&nbsp;hour</font></span>
                              </div>
						   </div>-->
						   
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <input onkeypress="return isNumberKey(event , this.id)" type="text"  class="form-control decimal" name="parent_rate" id="parent_rate" value="<?php echo isset($_REQUEST['j']) ? $arrJb['parent_rate'] : ''; ?>" style="width:70px;" > <span> <font size="2"></font></span><span> <font size="2"><b>&nbsp;&nbsp;per hour X&nbsp;&nbsp;</b></font></span>
                              <input onkeypress="return isNumberKey(event , this.id)" type="text"  class="form-control decimal" name="cycle" id="cycle" value="<?php echo isset($_REQUEST['j']) ? $arrJb['cycle'] : ''; ?>" style="width:70px;" > <span> <font size="2"><b>&nbsp;&nbsp;+&nbsp;&nbsp;</b></font></span>
                              <input onkeypress="return isNumberKey(event , this.id)" type="text"  class="form-control decimal" name="rf" id="rf" value="<?php echo isset($_REQUEST['j']) ? $arrJb['rf'] : ''; ?>" style="width:70px;" > <font size="2"><b>&nbsp;&nbsp;<span id='totalResult'></span>&nbsp;&nbsp;</b></font>
                              </div>
                              

                              <div class="form-inline">
                              <input type="text"  class="form-control" style="width:1px;height:1px;border:none" >  <span> <font size="2" style="color:#070775" ><b>Rate&nbsp;&nbsp;</b></font></span>
                              <input type="text"  class="form-control" style="width:90px;height:1px;border:none" > <span> <font size="2" style="color:red" ><b>&nbsp;&nbsp;&nbsp;&nbsp;Cycle&nbsp;&nbsp;</b></font></span>
                              <input type="text"  class="form-control" style="width:48px;height:1px;border:none" > <span> <font size="2" style="color:green" ><b>&nbsp;&nbsp;R.F&nbsp;&nbsp;</b></font> </span>
                              </div>
                              
                              
						   </div>
						   
						   
						   
                        </div>
                        
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Student’s Name :</label>
                           <div class="col-lg-5"><input type="text" class="form-control" name="student_name" id="student_name" value="<?php echo isset($_REQUEST['j']) ? $arrJb['student_name'] : ''; ?>" > 
                           </div>
                        </div>
                        <!--<div class="form-group">
                           <label class="col-lg-3 control-label">Hour per cycle :</label>
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <input onkeypress="return isNumberKey(event)" type="text"  class="form-control" name="cycle" id="cycle" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['cycle'] : ''; ?>" style="width:50px;" > <span> <font size="2">&nbsp;&nbsp;&nbsp;hours</font></span>
                              </div>
						   </div>
                        </div>-->







<!--
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Parent’s Rate:</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="parent_rate" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['parent_rate'] : ''; ?>" > 
                           </div>
                        </div>-->
                        
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Admin's Comment :</label>
                           <div class="col-lg-7">
                              <textarea class="form-control" rows="5" id="jt_comments" name="jt_comments[en]"><?php echo isset($_REQUEST['j']) ? $arrJbt['jt_comments'] : ''; ?></textarea>
                           </div>
                        </div>
                        <div class="form-group mrg-top-30">
                           <div class="col-lg-offset-3 col-lg-9">
                              <button class="btn btn-sm btn-orange sign-btn-box mrg-right-15 btnDisabled3" name="save" type="submit">Save</button>
                              <button class="btn btn-sm btn-orange sign-btn-box mrg-right-15 btnDisabled4" name="save_edit" type="submit">S&#38;CE</button>
                              <button class="hidden" name="save2" type="submit">Save</button>
                              <button class="hidden" name="save_edit2" type="submit">S&#38;CE</button>
                           </div>
                        </div>
                     </div>               
                  </div>
                </form>
            </div>
         </div>
         <?php include_once('includes/footer.php'); ?>
      </div>
   </div>
   <!-- Mainly scripts -->
   <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
   <script src="js/plugins/dataTables/datatables.min.js"></script>
   <!-- Data picker -->
   <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
   <!-- Date range picker -->
   <script src="js/plugins/daterangepicker/daterangepicker.js"></script>
   <!-- Custom and plugin javascript -->
   <script src="js/plugins/pace/pace.min.js"></script>
   <!-- Image cropper -->
   <script src="js/plugins/cropper/cropper.min.js"></script>
   <!-- Page-Level Scripts -->

   <script src="js/disabled.js"></script>
   <script>
    $(document).ready(function(){
      allUserInfo();

        $('.dataTables-example').DataTable({
              dom: '<"html5buttons"B>lTfgitp',
              buttons: [
              { extend: 'copy'},
              {extend: 'csv'},
              {extend: 'excel', title: 'ExampleFile'},
              {extend: 'pdf', title: 'ExampleFile'},
      
              {extend: 'print',
              customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
      
                  $(win.document.body).find('table')
                  .addClass('compact')
                  .css('font-size', 'inherit');
              }
            }
          ]
      
        });
      
          /* Init DataTables */
          var oTable = $('#editable').DataTable();
      
          /* Apply the jEditable handlers to the table */
          oTable.$('td').editable( '../example_ajax.php', {
              "callback": function( sValue, y ) {
                  var aPos = oTable.fnGetPosition( this );
                  oTable.fnUpdate( sValue, aPos[0], aPos[1] );
              },
              "submitdata": function ( value, settings ) {
                  return {
                      "row_id": this.parentNode.getAttribute('id'),
                      "column": oTable.fnGetPosition( this )[2]
                  };
              },
      
              "width": "90%",
              "height": "100%"
          } );
      
      
      });
      
      function fnClickAddRow() {
          $('#editable').dataTable().fnAddData( [
              "Custom row",
              "New row",
              "New row",
              "New row",
              "New row" ] );
      
      }
   </script>
   <script>
      $(document).ready(function(){
      
          var $image = $(".image-crop > img");
          $($image).cropper({
              aspectRatio: 1.618,
              preview: ".img-preview",
              done: function(data) {
                      // Output the result data for cropping image.
                  }
              });
      
          $('#date_create .input-group.date').datepicker({
              startView: 0,
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              format: "dd/mm/yyyy"
          });


	  
          $('#data_1 .input-group.date').datepicker({
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              calendarWeeks: true,
              autoclose: true,
              format: "yyyy-mm-dd"
          });
      
          $('#date_deadline .input-group.date').datepicker({
              startView: 0,
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              format: "dd-mm-yyyy"
          });
      
          $('#data_3 .input-group.date').datepicker({
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              format: "yyyy-mm-dd"
          });
      
          $('#data_4 .input-group.date').datepicker({
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              format: "yyyy-mm-dd"
          });
      
          $('#data_5 .input-daterange').datepicker({
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true
          });
      
          $('.clockpicker').clockpicker();
      
          $('input[name="daterange"]').daterangepicker();
      
          $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      
          $('#reportrange').daterangepicker({
              format: 'yyyy-mm-dd',
              startDate: moment().subtract(29, 'days'),
              endDate: moment(),
              minDate: '01/01/2012',
              maxDate: '12/31/2015',
              dateLimit: { days: 60 },
              showDropdowns: true,
              showWeekNumbers: true,
              timePicker: false,
              timePickerIncrement: 1,
              timePicker12Hour: true,
              ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              opens: 'right',
              drops: 'down',
              buttonClasses: ['btn', 'btn-sm'],
              applyClass: 'btn-primary',
              cancelClass: 'btn-default',
              separator: ' to ',
              locale: {
                  applyLabel: 'Submit',
                  cancelLabel: 'Cancel',
                  fromLabel: 'From',
                  toLabel: 'To',
                  customRangeLabel: 'Custom',
                  daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                  monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                  firstDay: 1
              }
          }, function(start, end, label) {
              console.log(start.toISOString(), end.toISOString(), label);
              $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          });
      
      
          $(".touchspin1").TouchSpin({
              buttondown_class: 'btn btn-white',
              buttonup_class: 'btn btn-white'
          });
      
          $(".touchspin2").TouchSpin({
              min: 0,
              max: 100,
              step: 0.1,
              decimals: 2,
              boostat: 5,
              maxboostedstep: 10,
              postfix: '%',
              buttondown_class: 'btn btn-white',
              buttonup_class: 'btn btn-white'
          });
      
          $(".touchspin3").TouchSpin({
              verticalbuttons: true,
              buttondown_class: 'btn btn-white',
              buttonup_class: 'btn btn-white'
          });
      
      
      });
      
   </script>

   <script type="text/javascript">
     function allUserInfo(){
      var u_id = $('#u_id').val();
      // alert(u_id);

      if(u_id != ''){
        $.ajax({
          url: "ajax/ajax_call_new.php",
          type: "POST",
          dataType: "json",
          data: {
            dataUJ: {
              u_id : u_id,
            },
          },
          success: function(response){
            console.log(response);

            $('#j_area').val(response.area);
            $('#j_state_id').val(response.state);
            $('#j_email').val(response.email);
            $('#j_telephone').val(response.phoneno);
            $('#jt_comments').val(response.admincomment);
            $('#actual_email').val(response.ud_last_name);
            //$('#newCity').val(response.city);
            if( response.city == '1384' ){
                $('#jt_subject').val('(ONLINE) ');
            }
            

            
          }
        })
      }else{
      }
     }
     
        $('#j_state_id').change(function(){

			var StateId = $(this).val();
/*			alert(StateId);*/

			$.ajax({

				url: "ajax/ajax_call.php",

				method: "POST",

				data: {action: 'get_city', state_id: StateId}, 

				success: function(result){

					$('#newCity').html(result);

				}

			});

		});


/*
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}*/
$('.decimal').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
    if( document.getElementById('parent_rate').value != '' && document.getElementById('cycle').value != '' ){
        if( document.getElementById('rf').value != '' ){
            var twoPlacedFloat = parseFloat(( ((parseFloat(document.getElementById('parent_rate').value) * parseFloat(document.getElementById('cycle').value)) + parseFloat(document.getElementById('rf').value)))).toFixed(2)
            document.getElementById('totalResult').innerHTML = ' = RM '+twoPlacedFloat;            
        }else{
            var twoPlacedFloat = parseFloat(( ((parseFloat(document.getElementById('parent_rate').value) * parseFloat(document.getElementById('cycle').value))) )).toFixed(2)
            document.getElementById('totalResult').innerHTML = ' = RM '+twoPlacedFloat;  
        }
    }
    
});


$('#newCity').on('change', function(){
    var cityId = $(this).val();
    if( cityId == '1384' ){

        var SubjectValue = document.getElementById("jt_subject").value;
        if( SubjectValue != '' ){
            if (SubjectValue.indexOf('(ONLINE)') > -1){
                $('#jt_subject').val(SubjectValue);
            }else{
                var resultSubject = '(ONLINE) ' + document.getElementById("jt_subject").value;
                $('#jt_subject').val(resultSubject);
            }
        }else{
            $('#jt_subject').val('(ONLINE) ');
        }
        
    }
});
</script>
</body>
</html>
