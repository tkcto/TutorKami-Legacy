<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;


$userRole = $instAuth = new user;
$resStudent = $userRole->FetchUserByRole(4,'A');
$resTutor = $userRole->FetchUserByRole(3,'A');
$resSubject = $instApp->FetchSubject();
$resClasses = $instApp->FetchClasses(); 
/*
if(isset($_REQUEST['cl'])){
    $test = $_REQUEST['cl'];
}else{
    $test = 'xda';
    
    $data['cl_display_id'];
    
									$mysqli = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
									if ($mysqli->connect_errno) {
										echo "Connect failed ".$mysqli->connect_error;
										exit();
									}
									$query = "SELECT * FROM tk_job WHERE j_id = '".$arrClass['cl_display_id']."'";
									if ($result = $mysqli->query($query)) {
										$row = $result->fetch_assoc();
										$query2 = "SELECT * FROM tk_user WHERE u_email = '".$row['j_email']."'";
										if ($result2 = $mysqli->query($query2)) {
											$row2 = $result2->fetch_assoc();
											echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$row2['u_displayid'].'" target="_blank" title="ID: '.$row2['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$row2['u_email'].'</a></label> ';
										}
									}
									$mysqli->close();
									
}*/
	

if(isset($_REQUEST['cl-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveClasses($data);
 //echo $res;
 header('Location:classes-list.php');
 exit();
}
if(isset($_REQUEST['save_edit'])){
/*
 if(isset($_REQUEST['cl'])){
 }else{
    $mysqli = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
    if ($mysqli->connect_errno) {
        echo "Connect failed ".$mysqli->connect_error;
        exit();
    }
    $queryExisting = " SELECT * FROM tk_classes WHERE cl_display_id = '".$data['cl_display_id']."' ";
    if ($resultExisting = $mysqli->query($queryExisting)) {
        $rowExisting = $resultExisting->fetch_assoc();
        if($rowExisting > 0){
            echo '<script type="text/javascript">';
            echo ' alert("Sorry! Existing Classes")';  //not showing an alert box.
            echo '</script>';
            exit();
        }
    }
    $mysqli->close();
 }
*/									
    
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveClasses($data);
 if( $_REQUEST['cl'] != '' ){
     header('Location:classes-add.php?cl='.$_REQUEST['cl']);
     exit();     
 }else{ 
     header('Location:classes-list.php');
     exit();
 }
}


// ni dapatkan cl dekat url
if(isset($_REQUEST['cl'])){
    /*
									$mysqli = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
									if ($mysqli->connect_errno) {
										echo "Connect failed ".$mysqli->connect_error;
										exit();
									}
									//$query = " SELECT * FROM tk_classes_record WHERE cr_status = 'FM to pay tutor' AND cr_cl_id = '".$_REQUEST['cl']."' ORDER BY cr_id DESC ";
									//$query = " SELECT * FROM tk_classes_record WHERE cr_balance LIKE '%-%' AND (cr_status != 'new Cycle' AND cr_status != 'Tutor Paid') AND cr_cl_id = '".$_REQUEST['cl']."' ORDER BY cr_id DESC ";
									$query = " SELECT * FROM tk_classes_record WHERE cr_balance LIKE '%-%' AND cr_classes != 'this' AND cr_cl_id = '".$_REQUEST['cl']."' ORDER BY cr_id DESC LIMIT 2 ";
									if ($result = $mysqli->query($query)) {
									    if($result->num_rows >= 2) {
										    //while($row = $result->fetch_assoc()){}
										    $row = $result->fetch_assoc();
										    //echo '<br>'.$row['cr_id'].'<br>';
									        //echo '2';
									        $updateStatus = " UPDATE tk_classes_record SET cr_status='Required Parent To Pay' WHERE cr_id='".$row['cr_id']."' ";
									        $mysqli->query($updateStatus);
										    
									    }else{
										    //$row = $result->fetch_assoc();
										    //echo '<br>'.$row['cr_id'].'<br>';
									        //echo '1';
									    }
										
									}
									$mysqli->close();
									
									$query = " SELECT * FROM tk_classes_record WHERE cr_cl_id = '".$_REQUEST['cl']."' ORDER BY cr_id DESC LIMIT 1 ";
									if ($result = $mysqli->query($query)) {
									    if($result->num_rows > 0) {
										    $row = $result->fetch_assoc();
										        if( $row['cr_status'] == 'FM to pay tutor' && $row['cr_balance'] < 0 ){
										            //$updateStatus = " UPDATE tk_classes_record SET cr_status='Required Parent To Pay' WHERE cr_id='".$row['cr_id']."' ";
									                //$mysqli->query($updateStatus);
										        }
									    }
									}
									$mysqli->close();*/

    
$arrClass = $instApp->GetClasses($_REQUEST['cl']);
 
$recordBalance = $instApp->fd_classes($_REQUEST['cl']);
$linkRecordBalance = $instApp->fd_classes_record($_REQUEST['cl']);
}
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<?php 
   $title = 'Classes Add | Tutorkami';
   require_once('includes/html_head.php'); 
?>
    <link rel="stylesheet" href="https://www.tutorkami.com/css/balloon.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <style>
        .my-input-class {
            padding: 3px 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .my-confirm-class {
            padding: 3px 6px;
            font-size: 12px;
            color: white;
            text-align: center;
            vertical-align: middle;
            border-radius: 4px;
            background-color: #337ab7;
            text-decoration: none;
        }
        .my-cancel-class {
            padding: 3px 6px;
            font-size: 12px;
            color: white;
            text-align: center;
            vertical-align: middle;
            border-radius: 4px;
            background-color: #a94442;
            text-decoration: none;
        }
        .error {
            border: solid 1px;
            border-color: #a94442;
        }
        .destroy-button{
            padding:5px 10px 5px 10px;
            border: 1px blue solid;
            background-color:lightgray;
        }
        
        .modal{
            position: fixed;
            left: 8%;
            top: 10%;
        }
        
.flipswitch {
  position: relative;
  background: white;
  width: 120px;
  height: 40px;
  -webkit-appearance: initial;
  border-radius: 3px;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  outline: none;
  font-size: 14px;
  font-family: Trebuchet, Arial, sans-serif;
  font-weight: bold;
  cursor: pointer;
  border: 1px solid #ddd;
}

.flipswitch:after {
  position: absolute;
  top: 5%;
  display: block;
  line-height: 32px;
  width: 45%;
  height: 90%;
  background: #fff;
  box-sizing: border-box;
  text-align: center;
  transition: all 0.3s ease-in 0s;
  color: black;
  border: #888 1px solid;
  border-radius: 3px;
}

.flipswitch:after {
  left: 2%;
  content: "OFF";
}

.flipswitch:checked:after {
  left: 53%;
  content: "ON";
  background: #800080;
  color : #ffffff;
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
               <div class="ibox float-e-margins">
                  <div class="ibox-title">
                     <h5><?PHP if(isset($_REQUEST['cl'])){echo "Edit Class";}else{echo "Classes Add";}?></h5>
                     <?php //echo $test; 


/*
$profitloss ='-01.00';

if ( $profitloss < 0 ) {
   echo "negative";
}else{
   echo "positif";
}

$pos = strpos('5', '.');
if($pos === false){
 echo 'dot not found';
}else{
 echo 'dot found';
}


function hoursandmins($time, $format = '%02d:%02d')
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
//echo hoursandmins('225', '%02d Hours, %02d Minutes');
echo hoursandmins('225', '%02d.%02d');


// Transform hours like "1.45" into the total number of minutes, "105". 
function hoursToMinutes($hours) { 
    $minutes = 0; 
    if (strpos($hours, '.') !== false) 
    { 
        // Split hours and minutes. 
        list($hours, $minutes) = explode('.', $hours); 
    } 
    return $hours * 60 + $minutes; 
} 

// Transform minutes like "105" into hours like "1.45". 
function minutesToHours($minutes) { 
    $hours = (int)($minutes / 60); 
    $minutes -= $hours * 60; 
    return sprintf("%d.%02.0f", $hours, $minutes); 
}


$latestBalance =-02.00;
$convertNegative = abs($latestBalance);
echo hoursToMinutes($convertNegative);

echo number_format((float)$convertNegative, 2, '.', '');  // Outputs -> 105.00
*/	

                     ?>
                  </div>
<div class="modal" tabindex="-1" role="dialog" id="myModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Cycle</h5>
      </div>
      <div class="modal-body">
          <input type="hidden" name="newcr_idInput" id="newcr_idInput" class="form-control" style="width:150px;">
        <center><input type="text" name="newCycleInput" id="newCycleInput" class="form-control" style="width:150px;" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_cycle'] : ''; ?>"></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="SaveChanges()">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="myModalShowText" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <center id="dataShowText"></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                  <div class="ibox-content">
                     <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="cl_id" id="cl_id" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_id'] : ''; ?>">
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Job Id:</label>
                           <div class="col-lg-7"><div class="form-inline">
                              <?php 
                                 /*$used_rand = array();
                                 while($arrClasses = $resClasses->fetch_assoc()){
                                    $used_rand[] = $arrClasses['cl_display_id'];
                                 }
                                 while($rand = rand(10000,99999)){
                                   if(!in_array($rand,$used_rand))
                                    break;
                                 }*/
                                 ?>                                    
                             <?php if(isset($_REQUEST['job_id']) != ''){?>

                              <input <?php /*if(isset($_REQUEST['cl']) != ''){echo "readonly";}*/?>  type="text" class="form-control" name="cl_display_id" id="job_id" value="<?php echo $_REQUEST['job_id']; ?>">
                           <?php }else{ ?>
                              <input <?php /*if(isset($_REQUEST['cl']) != ''){echo "readonly";}*/?>  type="text" class="form-control" name="cl_display_id" id="job_id" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_display_id'] : '';?>" required>
							  <?PHP
							  /* START - fadhli */
							  if(isset($_REQUEST['cl'])){
								  echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="job-edit.php?j='.$arrClass['cl_display_id'].'" target="_blank" title="ID: '.$arrClass['cl_display_id'].'" style="color:#FFF; text-decoration: none;">'.$arrClass['cl_display_id'].'</a></label> ';
							  }
							  /* END - fadhli */
							  ?>
                           <?php } 
							  /* START - fadhli */
							  /*if(isset($_REQUEST['job_id']) != ''){
								  $getJobId = $instApp->GetClasses($_REQUEST['job_id']);
								  if ($getJobId->num_rows > 0) {
									echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="job-add.php?j='.$getJobId['cl_display_id'].'" target="_blank" title="ID: '.$getJobId['cl_display_id'].'" style="color:#FFF; text-decoration: none;">'.$getJobId['cl_display_id'].'</a></label> ';
								  } echo "test";
							  }*/
							  /* END - fadhli */
						   ?>
                           </div></div>
                        </div>
                        <!-- if edit, pergi sini -->
                        <?php if(isset($_REQUEST['cl']) != ''){?>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Client Id:</label>
                           <div class="col-lg-7"><div class="form-inline">
                              <input type="text" class="form-control" name="cl_student_id" id="cl_student_id" required>
							  <?PHP
							  /* START - fadhli */
							  if(isset($_REQUEST['cl'])){
									/*$mysqli = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
									if ($mysqli->connect_errno) {
										echo "Connect failed ".$mysqli->connect_error;
										exit();
									}*/
									$query = "SELECT * FROM tk_job WHERE j_id = '".$arrClass['cl_display_id']."'";
									if ($result = $conDB->query($query)) {
										$row = $result->fetch_assoc();
										$query2 = "SELECT * FROM tk_user WHERE u_email = '".$row['j_email']."'";
										if ($result2 = $conDB->query($query2)) {
											$row2 = $result2->fetch_assoc();
											echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$row2['u_displayid'].'" target="_blank" title="ID: '.$row2['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$row2['u_email'].'</a></label> ';
										}
									}
									//$mysqli->close();
							  }
							  /* END - fadhli */
							  ?>
                           </div></div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Tutor:</label>
                           <div class="col-lg-7"><div class="form-inline">
                              <input type="text" class="form-control" name="cl_tutor_id" id="cl_tutor_id" required>
							  <?PHP
							  /* START - fadhli */
							  if(isset($_REQUEST['cl'])){
									/*$mysqli = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
									if ($mysqli->connect_errno) {
										echo "Connect failed ".$mysqli->connect_error;
										exit();
									}*/
									$query = "SELECT * FROM tk_job WHERE j_id = '".$arrClass['cl_display_id']."'";
									if ($result = $conDB->query($query)) {
										$row = $result->fetch_assoc();
										$query2 = "SELECT * FROM tk_user WHERE u_email = '".$row['j_hired_tutor_email']."'";
										if ($result2 = $conDB->query($query2)) {
											$row2 = $result2->fetch_assoc();
											echo '&nbsp;&nbsp;&nbsp;<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$row2['u_displayid'].'" target="_blank" title="ID: '.$row2['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$row2['u_email'].'</a></label> ';
										}
									}
									//$mysqli->close();
							  }
							  /* END - fadhli */
							  ?>
                           </div></div>
                        </div>

                     <?php }?>
                   <?php if(isset($_REQUEST['cl']) == ''){?>
                        <!-- else if add new, pergi sini -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Client ID:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
                                 <input type="text" class="form-control" name="cl_student_id" id="cl_student_id" required>   
                              </div> 
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Tutor:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
                                 <input type="text" class="form-control" name="cl_tutor_id" id="cl_tutor_id" required>   
                              </div> 
                           </div>
                        </div>
                      <?php } ?>
                        <div class="form-group hidden">
                           <label class="col-lg-3 control-label">Subject Id:</label>
                           <div class="col-lg-7">
                              <select class="form-control user-list" name="cl_subject_id" >
                                 <option value="">Select Subject</option>
                                 <?php 
                                    while($arrSubject = $resSubject->fetch_assoc()) {?>
                                 <option value="<?php echo $arrSubject['ts_id'];?>" <?php if(isset($_REQUEST['cl'])) echo $arrClass['cl_subject_id']==$arrSubject['ts_id']?'selected':''?>><?php echo $arrSubject['ts_title'];?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                       
                       
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Subject:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input type="text" class="form-control" name="cl_subject" id="cl_subject" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_subject'] : ''; ?>" required>   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Tutor’s Rate:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input type="text"  class="form-control" name="cl_rate" id="cl_rate" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_rate'] : ''; ?>" required>   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Charge to parent:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input type="text"  class="form-control" name="cl_charge_parent" id="cl_charge_parent" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_charge_parent'] : ''; ?>" required>   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Student's Name:</label>
                           <div class="col-lg-7">
                              <div class="input-group date">
                                 <input type="text" class="form-control" name="cl_student" id="cl_student" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_student'] : ''; ?>" required>   
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Hours Balance:</label>
                           <div class="col-lg-7">
                              <div class="input-group">
								<!-- <input type="text"  class="form-control" name="cl_hours_balance" value="<?php //echo isset($_REQUEST['cl']) ? $arrClass['cl_hours_balance'] : ''; ?>" > -->
								<!--<input type="hidden"  class="form-control" name="cl_hours_balance" id="cl_hours_balance" disabled>
                                <input type="text"  class="form-control" name="showOutput" id="showOutput" disabled>-->
                              </div>
                              
                              <div class="form-inline">
                                    <input type="hidden"  class="form-control" name="cl_hours_balance" id="cl_hours_balance" disabled>
                                    <input type="text"  class="form-control" name="showOutput" id="showOutput" disabled>
                                    
									<?PHP
									$mysqli = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
									if ($mysqli->connect_errno) {
										echo "Connect failed ".$mysqli->connect_error;
										exit();
									}
									$query = " SELECT cl_id, cl_hours_balance FROM tk_classes WHERE cl_id = '".$_REQUEST['cl']."' ";
									if ($result = $mysqli->query($query)) {
										$row = $result->fetch_assoc();
										if ($row['cl_hours_balance'] < 0){
										    //echo $row['cl_hours_balance'];
										    $query2 = " SELECT * FROM tk_classes_record WHERE cr_cl_id = '".$row['cl_id']."' AND current_cycle NOT LIKE '%temp%' ORDER BY cr_date DESC, cr_start_time DESC ";
										    if ($result2 = $mysqli->query($query2)) {
										        $row2 = $result2->fetch_assoc();
										        //echo $row2['cr_status'];
										        if( $row2['cr_status'] == 'FM to pay tutor' ){
										            echo '<span> <font size="2" color="red"><b>&nbsp;&nbsp;&nbsp;Tutor insert extra duration</b></font></span>';
										        }
										    }
										}
									}
									$mysqli->close();
									?>

                              </div>
                              
						   </div>
                        </div>
                        <!-- luqman -->
                        <!-- <div class="form-group">
                           <label class="col-lg-3 control-label">Hours Balance:</label>
                           <div class="col-lg-7">
                              <input type="text"  class="form-control" name="new_balance" id="new_balance">
                           </div>
                        </div> -->
                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Cycle:</label>
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <!-- fadhli -->
<?php
function is_positive_integer($str) {
	return (is_numeric($str) && $str > 0 && $str == round($str));
}

if ($recordBalance->num_rows > 0) {
	if ($linkRecordBalance->num_rows > 0) {
		$thisBalance = $linkRecordBalance->fetch_assoc();
		if($thisBalance['cr_balance'] >= 0) {
			$thisDisabled = 'readonly';
		}else{
			//$thisDisabled = '';
			$thisDisabled = 'readonly';
		}
	}else{
		//$thisDisabled = "";
		$thisDisabled = 'readonly';
	}
}else{
	//$thisDisabled = "";
    $thisDisabled = 'readonly';
}
?>
                              <input type="text"  class="form-control" name="cl_cycle" id="cl_cycle" value="<?php echo isset($_REQUEST['cl']) ? $arrClass['cl_cycle'] : ''; ?>" required <?php echo $thisDisabled; ?>> <span> <font size="2">&nbsp;&nbsp;&nbsp;hours</font></span>
                              <!--<input type="text"  class="form-control" name="cl_cycle" value="<?php //echo isset($_REQUEST['cl']) ? $arrClass['cl_cycle'] : ''; ?>" required>-->
                              </div>
						   </div>
                        </div>

                        <div class="form-group">
                           <label class="col-lg-3 control-label">Status:</label>
                           <div class="col-lg-7" style="width:240px;">
                              <select class="form-control" name="cl_status" id="cl_status" required>
                                 <option value="">Select Status</option>
                                 <option value="ongoing" <?php if(isset($_REQUEST['cl'])) echo $arrClass['cl_status']=="ongoing"?'selected':''?>>On Going</option>
                                 <option value="onhold" <?php if(isset($_REQUEST['cl'])) echo $arrClass['cl_status']=="onhold"?'selected':''?>>On Hold</option>
                                 <option value="ended" <?php if(isset($_REQUEST['cl'])) echo $arrClass['cl_status']=="ended"?'selected':''?>>Ended</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-lg-offset-3 col-lg-9">
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="save_edit" >S&CE</button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="cl-save">Save</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <?php if (isset($_GET['cl']) && $_GET['cl'] != '') { ?>
               <div class="ibox float-e-margins">
                  <div class="ibox-title">
                     <h5>Classes</h5> 


                                        <?PHP
    									$queryParent = "SELECT j_id, j_email FROM tk_job WHERE j_id = '".$arrClass['cl_display_id']."'";
    									if ($resultParent = $conDB->query($queryParent)) {
    										$rowParent = $resultParent->fetch_assoc();
    										$queryParent2 = "SELECT u_id, u_email FROM tk_user WHERE u_email = '".$rowParent['j_email']."'";
    										if ($resultParent2 = $conDB->query($queryParent2)) {
    											$rowParent2 = $resultParent2->fetch_assoc();
    											$queryParentID = $rowParent2['u_id'];
    										}
    									}

    									$queryCheckWa = "SELECT cl_id, cl_wa FROM tk_classes WHERE cl_id = '".$_REQUEST['cl']."'";
    									if ($resultCheckWa = $conDB->query($queryCheckWa)) {
    									    $rowCheckWa = $resultCheckWa->fetch_assoc();
    									    if( $rowCheckWa['cl_wa'] == 'Yes' ){
    									        $checkWa = 'checked="checked"';
    									    }else{
    										    $checkWa = '';	    
    									    }
    									}else{
    									    $checkWa = '';
    									}
                                        ?>
						<div class="form-group" style="margin-left:140px;">
                           <label class="col-sm-2 control-label">WA record notification </label>
                              <div class="input-group">
									<div class="form-inline"> :&nbsp;&nbsp;
										<div class="form-group">
											<input <?PHP echo $checkWa; ?> type="checkbox" class="flipswitch" id="sendWA" onclick="SendWhatsApp()" /> &nbsp;
											<span></span>					
										</div>
										<input type="hidden" id="queryParentID" name="queryParentID" value="<?PHP echo $queryParentID; ?>" />
										<a style="margin-left:-5px;" data-balloon-length="large" aria-label="Turn this ON if client agree to receive WA auto msg every time tutor submit a record for this class" data-balloon-pos="up-left"><span class="glyphicon glyphicon-question-sign" style="color:#262262;font-size: 20px;" ></span></a>
									</div>	
                              </div>
                        </div>
                     
                  </div>
                  <div class="ibox-content">
                     <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                           <div class="col-sm-12">
                              <!--<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center dataTable no-footer" style="background:#fff;" id="dataTables_cl">
                                 <thead>
                                    <tr class="blue-bg">
                                       <td width="10%">Date</td>
                                       <td width="7%">Time <br>Start</td>
                                       <td width="7%">Time <br>End</td>
                                       <td width="10%">Duration</td>
                                       <td width="17%">Tutor's <br> remarks</td>
                                       <td width="10%">Cycle Status</td>
                                       <td width="19%">Parent <br>verification</td>
                                       <td width="13%">Parent <br>remarks</td>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                    $record_res = $instApp->ClassWiseRecord($_GET['cl']);
                                    $record_status = array(
                                       'done' => '<strong class="green-txt">Done</strong>', 
                                       'notdone'  => '<strong class="red-txt">Not done</strong>');

                                    if ($record_res->num_rows > 0) {
                                       while( $record_row = $record_res->fetch_assoc() ){                           
                                    ?>
                                    <tr>
                                       <td><?php echo $record_row['cr_date'];?></td>
                                       <td><?php echo $record_row['cr_start_time'];?></td>
                                       <td><?php echo $record_row['cr_end_time'];?></td>
                                       <td><?php echo $record_row['cr_duration'];?></td>
                                       <td><strong><?php echo $record_row['cr_tutor_report'];?></strong></td>


									   <td>
									   <?php
									   if($record_row['cr_status'] =='required parent to pay'){
										  //echo "<a href='javascript:openwindow()'><font color=red>".ucwords($record_row['cr_status'])."</font></a>";
										  echo "<font color=red>".ucwords($record_row['cr_status'])."</font>";
									  }else if($record_row['cr_status'] =='new cycle'){
										   echo "<font color=green>New Cycle</font>";
									   }else{
									   }
									   
									   ?>   
									   </td>



                                       <td>
                                          <?php echo ($record_row['cr_parent_verification'] != '') ? $record_status[$record_row['cr_parent_verification']] : ''; ?>
                                       </td>
                                       <td>
                                          <?php echo $record_row['cr_parent_remark']; ?>
                                       </td>
                                    </tr>
                                    <?php 
                                       }
                                    } else { 
                                    ?>
                                    <tr>
                                       <td colspan="8">No Records Found</td>
                                    </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>-->
                              <table id="myAdvancedTable" class="table table-bordered table-striped">
								<thead>
									<tr>
                                       <th>ID</th>
                                       <th width="10%">Date</th>
                                       <th width="10%">Time <br>Start</th>
                                       <th width="10%">Time <br>End</th>
                                       <th width="10%">Duration</th>
                                       <th width="20%">Tutor's <br> Remarks</th>
                                       <th width="10%">Cycle Status</th>
                                       <th width="10%">Verification</th>
                                       <th width="20%">Client’s<br>Remarks</th>

                                       <?PHP //if($_SESSION[DB_PREFIX]['u_username'] == 'mohdnurfadhli@gmail.com'){ ?>
                                            <th width="20%">Action</th>
                                        <?PHP //} ?>
									</tr>
								</thead>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>   
               <?php } ?>
            </div>
         </div>
      </div>
      <?php include_once('includes/footer.php'); ?>
   </div>
</div>
<script src="js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>
<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Date range picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

   getEmailClient();
   Calcbalance();
   getRateSubjectClass();

    $('#data .input-group.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: "yyyy-mm-dd"
    });

    $('#job_id').on('keyup', function(){
      var jobId = $(this).val();

      $('#hider, #loadermodaldiv').show();

      $.ajax({
         url: "ajax/ajax_call.php",
         type: "POST",
         data: {action: 'get_job_details', job_id: jobId},          
         dataType: "json",
         success: function(resultData) {
            
            if (resultData == 0) {
               getStickyNote ('error', 'This job id does not exists!');
               return false;
            }
            $('#cl_student_id').val(resultData.j_email);
			$('#cl_tutor_id').val(resultData.j_hired_tutor_email);
            $('#cl_subject').val(resultData.jt_subject);
            $('#cl_rate').val(resultData.j_rate);
            if (typeof resultData.u_id !== 'undefined') {
              $('#cl_tutor_id option[value='+resultData.u_id+']').prop('selected', true);
            }
            else{
               $("#cl_tutor_id option[value='']").prop('selected', true);
            }
            if (typeof resultData.parent_id !== 'undefined') {
              $('#cl_student_id option[value='+resultData.parent_id+']').prop('selected', true);
            }
            else{
              $("#cl_student_id option[value='']").prop('selected', true); 
            }
            $('#hider, #loadermodaldiv').hide();
         },
         error:function(msg){
            $('#hider, #loadermodaldiv').hide();
            getStickyNote ('error', 'Unknown error, try again later.');            
         }
      });
    });

  });
</script>
<script type="text/javascript">
   function getEmailClient(){

      var job_id = $("#job_id").val();
      // alert(job_id);

   if(job_id != ""){
      
      $.ajax({
         url: "ajax/ajax_call_new.php",
         type: "POST",
         dataType: "json",
         data: {
            data: {
               job_id : job_id,
            },
         },
         success: function(response){
            // alert(response);
            console.log(response);

            $('#cl_student_id').val(response.j_email);
            $('#cl_tutor_id').val(response.j_hired_tutor_email);
         }
      });

      
   }else{
      // alert('tiada');
   }
}
</script>

<script type="text/javascript">
   function Calcbalance(){
      var cl_id = $('#cl_id').val();
      // alert(cl_id);
      
      if(cl_id != ''){
         $.ajax({
            url: "ajax/ajax_call_new_calc.php",
            type: "POST",
            dataType: "json",
            data: {
               data: {
               cl_id : cl_id,
               },
            },
            success: function(response){
               console.log(response);

               // $('#new_balance').val(response);
               $('#cl_hours_balance').val(response);
               var first = response.split('.').shift();
               var second = response.substring(response.indexOf('.') + 1);

               var firstinteger = parseInt(first);
               var secondinteger = second; //parseInt(second);
               //var showOutput = firstinteger + " hours & " + secondinteger + " minutes";
               //var showOutput = first + " hours & " + secondinteger + " minutes";
if(first.indexOf('-') !== -1){
  var showOutput = (first.replace(/-/g, "- ")) + " hours & " + secondinteger + " minutes";
}else{
    var showOutput = first + " hours & " + secondinteger + " minutes";
}

               
               var showOutput2 = firstinteger + " hours & 00 minutes";
               //$('#showOutput').val(showOutput);

               if(response == '-'){
                    $('#showOutput').val('0 hours & 00 minutes');
               }else{
			        if(response.indexOf('.') !== -1){
				        //Found . in str
				        $('#showOutput').val(showOutput);
			        }else{
				        $('#showOutput').val(showOutput2);
			        }
               }
			   

            }
         });
      }
   }
</script>

<script type="text/javascript">
   function getRateSubjectClass(){
      var job_id = $('#job_id').val();
      // alert(job_id);

      if(job_id != ''){
         $.ajax({
            url: "ajax/ajax_call_new.php",
            type: "POST",
            dataType: "json",
            data: {
               dataRS: {
                  job_id : job_id,
               },
            },
            success: function(response){
               console.log(response);

               $('#cl_rate').val(response.j_rate);
               $('#cl_subject').val(response.jt_subject);
               $('#cl_charge_parent').val(response.parent_rate);
               $('#cl_student').val(response.student_name);
               //$('#cl_cycle').val(response.cycle);
               if (window.location.href.indexOf("job_id") > -1) { 
                   $('#cl_cycle').val(response.cycle);
               }
               
               
               //$('#cl_status').val('ongoing');
               document.getElementById("cl_status").value = "ongoing";

               

            }
         });
      }else{

      }
   }

</script>
<script type="text/javascript">/*
$('#clickthis').click(function(event) { 
    event.preventDefault(); 
	if (confirm("Are You Sure !")) {
		$('#hider, #loadermodaldiv').show();
		$.ajax({
			url: $(this).attr('href'),
			success: function(response) {
				$('#hider, #loadermodaldiv').hide();
				window.location = "classes-list.php";
			}
		});
		return false; 
	}else{
		alert("You pressed Cancel!");
	}
});*/
function showText(text){
	$.ajax({
		type:'POST',
		url:'classes-details-save.php',
		data: {
			showText: {text: text},
		},
		success:function(result){
            document.getElementById("dataShowText").innerHTML = result;
            $('#myModalShowText').modal('show');
		}
	});
    //alert(result);
}
function showText2(text2){
	$.ajax({
		type:'POST',
		url:'classes-details-save.php',
		data: {
			showText2: {text2: text2},
		},
		success:function(result){
            document.getElementById("dataShowText").innerHTML = result;
            $('#myModalShowText').modal('show');
		}
	});
    //alert(result);
}

function openwindow(id){
	if (confirm("Are You Sure !")) {
	    
	    document.getElementById("newcr_idInput").value = id;
	    $('#myModal').modal('show');
		/*var dataCycleId = document.getElementById("cl_id").value;
		var dataCycle = document.getElementById("cl_cycle").value;
		var dataBalance = document.getElementById("cl_hours_balance").value;
		var cr_id = id;
		 var dataString = 'dataCycleId=' + dataCycleId + '&dataCycle=' + dataCycle + '&dataBalance=' + dataBalance + '&cr_id=' + cr_id;
		
		$('#hider, #loadermodaldiv').show();
		$.ajax({
			type: "POST",
			url: "payment-form.php",
			data: dataString,
			cache: false,
			success: function(html) {
				$('#hider, #loadermodaldiv').hide();
				//window.location = "classes-list.php";
				location.reload();
				
			}
		});*/
	}else{
		alert("You pressed Cancel!");
	}
} 
function openwindow2(id){
	if (confirm("Are You Sure !")) {
		var dataCycleId = document.getElementById("cl_id").value;
		var dataCycle = document.getElementById("cl_cycle").value;
		var dataBalance = document.getElementById("cl_hours_balance").value;
		var cr_id = id;
		 var dataString = 'dataCycleId=' + dataCycleId + '&dataCycle=' + dataCycle + '&dataBalance=' + dataBalance + '&cr_id=' + cr_id;
		
		$('#hider, #loadermodaldiv').show();
		$.ajax({
			type: "POST",
			url: "payment-form.php",
			data: dataString,
			cache: false,
			success: function(html) {
				$('#hider, #loadermodaldiv').hide();
				//window.location = "classes-list.php";
				location.reload();
				
			}
		});
	}else{
		alert("You pressed Cancel!");
	}
} 
function SaveChanges(){
		var dataCycleId = document.getElementById("cl_id").value;
		var dataCycle   = document.getElementById("newCycleInput").value;
		var dataBalance = document.getElementById("cl_hours_balance").value;
		var cr_id       = document.getElementById("newcr_idInput").value;
		var dataString = 'dataCycleId=' + dataCycleId + '&dataCycle=' + dataCycle + '&dataBalance=' + dataBalance + '&cr_id=' + cr_id;
		/*alert(dataString);*/
		
		$('#hider, #loadermodaldiv').show();
		$.ajax({
			type: "POST",
			url: "payment-form.php",
			data: dataString,
			cache: false,
			success: function(html) {
				$('#hider, #loadermodaldiv').hide();
				//window.location = "classes-list.php";
				location.reload();
				
			}
		});
}
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="http://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
jQuery.fn.dataTable.Api.register('MakeCellsEditable()', function (settings) {
    var table = this.table();

    jQuery.fn.extend({
        // UPDATE
        updateEditableCell: function (callingElement) {
            // Need to redeclare table here for situations where we have more than one datatable on the page. See issue6 on github
            var table = $(callingElement).closest("table").DataTable().table();
            var row = table.row($(callingElement).parents('tr'));
            var cell = table.cell($(callingElement).parents('td, th'));
            var columnIndex = cell.index().column;
            var inputField =getInputField(callingElement);

            // Update
            var newValue = inputField.val();
            if (!newValue && ((settings.allowNulls) && settings.allowNulls != true)) {
                // If columns specified
                if (settings.allowNulls.columns) {
                    // If current column allows nulls
                    if (settings.allowNulls.columns.indexOf(columnIndex) > -1) {
                        _update(newValue);
                    } else {
                        _addValidationCss();
                    }
                    // No columns allow null
                } else if (!newValue) {
                    _addValidationCss();
                }
                //All columns allow null
            } else if (newValue && settings.onValidate) {
                if (settings.onValidate(cell, row, newValue)) {
                    _update(newValue);
                } else {
                    _addValidationCss();
                }
            }
            else {
                _update(newValue);
            }
            function _addValidationCss() {
                // Show validation error
                if (settings.allowNulls.errorClass) {
                    $(inputField).addClass(settings.allowNulls.errorClass);
                } else {
                    $(inputField).css({ "border": "red solid 1px" });
                }
            }
            function _update(newValue) {
                var oldValue = cell.data();
                cell.data(newValue);
                //Return cell & row.
                settings.onUpdate(cell, row, oldValue);
            }
            // Get current page
            var currentPageIndex = table.page.info().page;

            //Redraw table
            table.page(currentPageIndex).draw(false);
        },
        // CANCEL
        cancelEditableCell: function (callingElement) {
            var table = $(callingElement.closest("table")).DataTable().table();
            var cell = table.cell($(callingElement).parents('td, th'));
            // Set cell to it's original value
            cell.data(cell.data());

            // Redraw table
            table.draw();
        }
    });

    // Destroy
    if (settings === "destroy") {
        $(table.body()).off("click", "td");
        table = null;
    }

    if (table != null) {
        // On cell click
        $(table.body()).on('click', 'td', function () {

            var currentColumnIndex = table.cell(this).index().column;

            // DETERMINE WHAT COLUMNS CAN BE EDITED
            if ((settings.columns && settings.columns.indexOf(currentColumnIndex) > -1) || (!settings.columns)) {
                var row = table.row($(this).parents('tr'));
                editableCellsRow = row;

                var cell = table.cell(this).node();
                var oldValue = table.cell(this).data();
                // Sanitize value
                oldValue = sanitizeCellValue(oldValue);

                // Show input
                if (!$(cell).find('input').length && !$(cell).find('select').length && !$(cell).find('textarea').length) {
                    // Input CSS
                    var input = getInputHtml(currentColumnIndex, settings, oldValue);
                    $(cell).html(input.html);
                    if (input.focus) {
                        $('#ejbeatycelledit').focus();
                    }
                }
            }
        });
    }

});

function getInputHtml(currentColumnIndex, settings, oldValue) {
    var inputSetting, inputType, input, inputCss, confirmCss, cancelCss, startWrapperHtml = '', endWrapperHtml = '', listenToKeys = false;

    input = {"focus":true,"html":null};

    if(settings.inputTypes){
		$.each(settings.inputTypes, function (index, setting) {
			if (setting.column == currentColumnIndex) {
				inputSetting = setting;
				inputType = inputSetting.type.toLowerCase();
			}
		});
	}

    if (settings.inputCss) { inputCss = settings.inputCss; }
    if (settings.wrapperHtml) {
        var elements = settings.wrapperHtml.split('{content}');
        if (elements.length === 2) {
            startWrapperHtml = elements[0];
            endWrapperHtml = elements[1];
        }
    }
    
    if (settings.confirmationButton) {
        if (settings.confirmationButton.listenToKeys) { listenToKeys = settings.confirmationButton.listenToKeys; }
        confirmCss = settings.confirmationButton.confirmCss;
        cancelCss = settings.confirmationButton.cancelCss;
        inputType = inputType + "-confirm";
    }
    switch (inputType) {
        case "list":
            input.html = startWrapperHtml + "<select class='" + inputCss + "' onchange='$(this).updateEditableCell(this);'>";
            $.each(inputSetting.options, function (index, option) {
                if (oldValue == option.value) {
                   input.html = input.html + "<option value='" + option.value + "' selected>" + option.display + "</option>"
                } else {
                   input.html = input.html + "<option value='" + option.value + "' >" + option.display + "</option>"
                }
            });
            input.html = input.html + "</select>" + endWrapperHtml;
            input.focus = false;
            break;
        case "list-confirm": // List w/ confirm
            input.html = startWrapperHtml + "<select class='" + inputCss + "'>";
            $.each(inputSetting.options, function (index, option) {
                if (oldValue == option.value) {
                   input.html = input.html + "<option value='" + option.value + "' selected>" + option.display + "</option>"
                } else {
                   input.html = input.html + "<option value='" + option.value + "' >" + option.display + "</option>"
                }
            });
            input.html = input.html + "</select>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this);'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
            input.focus = false;
            break;
        case "datepicker": //Both datepicker options work best when confirming the values
        case "datepicker-confirm":
            // Makesure jQuery UI is loaded on the page
            if (typeof jQuery.ui == 'undefined') {
                alert("jQuery UI is required for the DatePicker control but it is not loaded on the page!");
                break;
            }
	        jQuery(".datepick").datepicker("destroy");
	        input.html = startWrapperHtml + "<input id='ejbeatycelledit' type='text' name='date' class='datepick " + inputCss + "'   value='" + oldValue + "'></input> &nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
	        setTimeout(function () { //Set timeout to allow the script to write the input.html before triggering the datepicker
	            var icon = "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif";
                // Allow the user to provide icon
	            if (typeof inputSetting.options !== 'undefined' && typeof inputSetting.options.icon !== 'undefined') {
	                icon = inputSetting.options.icon;
	            }
	            var self = jQuery('.datepick').datepicker(
                    {
                        showOn: "button",
                        buttonImage: icon,
                        buttonImageOnly: true,
                        buttonText: "Select date"
                    });
	        },100);
	        break;
        case "text-confirm": // text input w/ confirm
            input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' value='"+oldValue+"'" + (listenToKeys ? " onkeyup='if(event.keyCode==13) {$(this).updateEditableCell(this);} else if (event.keyCode===27) {$(this).cancelEditableCell(this);}'" : "") + "></input>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
            break;
        case "undefined-confirm": // text input w/ confirm
            input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' value='" + oldValue + "'" + (listenToKeys ? " onkeyup='if(event.keyCode==13) {$(this).updateEditableCell(this);} else if (event.keyCode===27) {$(this).cancelEditableCell(this);}'" : "") + "></input>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
            break;
        case "textarea":
        case "textarea-confirm":
            input.html = startWrapperHtml + "<textarea id='ejbeatycelledit' class='" + inputCss + "'>"+oldValue+"</textarea><a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
            break;
        default: // text input
            input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' onfocusout='$(this).updateEditableCell(this)' value='" + oldValue + "'></input>" + endWrapperHtml;
            break;
    }
    return input;
}

function getInputField(callingElement) {
    // Update datatables cell value
    var inputField;
    switch ($(callingElement).prop('nodeName').toLowerCase()) {
        case 'a': // This means they're using confirmation buttons
            if ($(callingElement).siblings('input').length > 0) {
                inputField = $(callingElement).siblings('input');
            }
            if ($(callingElement).siblings('select').length > 0) {
                inputField = $(callingElement).siblings('select');
            }
            if ($(callingElement).siblings('textarea').length > 0) {
                inputField = $(callingElement).siblings('textarea');
            }
        break;
        default:
            inputField = $(callingElement);
    }
    return inputField;
}

function sanitizeCellValue(cellValue) {
    if (typeof (cellValue) === 'undefined' || cellValue === null || cellValue.length < 1) {
        return "";
    }

    // If not a number
    if (isNaN(cellValue)) {
        // escape single quote
        cellValue = cellValue.replace(/'/g, "&#39;");
    }
    return cellValue;
}




var table;
$(document).ready(function () {

var url = window.location.href;
var newUrl = new URL(url);
var getPara = newUrl.searchParams.get("cl");

fill_datatable(getPara);
		function fill_datatable(id){
			var table = $('#myAdvancedTable').DataTable({
				"processing" : true,
				"serverSide" : true,
				"columnDefs": [
					{
						"targets": [ 0 ],
						"visible": false,
						"searchable": false
					}
				],
				"searching" : false,
				"ordering": false,
				"ajax" : {
					url:"classes-add-proses.php",
					type:"POST",
					data:{
						id:id
					}
				},
				
				drawCallback: function() {
                    $('.popoverRecord').popover({
                        container: 'body'
                    })
				}  
				
				
				
			});
			
			
/*
    table.MakeCellsEditable({
        "onUpdate": myCallbackFunction,
        "inputCss":'my-input-class',
		"columns": [2,3],
        "confirmationButton": { // could also be true
            "confirmCss": 'my-confirm-class',
            "cancelCss": 'my-cancel-class'
        },
		"inputTypes": [
            {
                "column":2, 
                "type": "list",
                "options":[
                    { "value": "AM", "display": "AM" },
                    { "value": "PM", "display": "PM" }
                ]
            },
            {
                "column":3, 
                "type": "list",
                "options":[
                    { "value": "AM", "display": "AM" },
                    { "value": "PM", "display": "PM" }
                ]
            }
		]
    });
*/

			
		}

	

});

function myCallbackFunction (updatedCell, updatedRow, oldValue) {
    $.ajax({
		type: "POST",
		data: {insert: updatedRow.data()},
		url: "classes-add-proses.php",
		success: function(result){
			/*alert(result);*/
		}
    }); 
	
}

function destroyTable() {
    if ($.fn.DataTable.isDataTable('#myAdvancedTable')) {
        table.destroy();
        table.MakeCellsEditable("destroy");
    }
}
/* get parameter value */
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function ConfirmDelete(id){
    var paraValue = getUrlVars()["cl"];
    
	var x = confirm("Are you sure you want to delete?");
	if (x == true){
        //alert(id);
	$.ajax({
		type:'POST',
		url:'classes-details-save.php',
		data: {
			dataDeleteClassesRecord: {id: id},
		},
		beforeSend: function() {
		},
		success:function(result){
			alert(result);
			if(result == "Record Has Been Deleted"){
                window.location ='classes-add?cl='+paraValue;
			}
		}
	});
		
	}
}

function SendWhatsApp() {
	var x = document.getElementById("sendWA").checked;
	var cl_id = document.getElementById("cl_id").value;
	var queryParentID = document.getElementById("queryParentID").value;
		$.ajax({
			url: "send-wa-kelas.php",
            method: "POST",
			data: {cl_id: cl_id, queryParentID: queryParentID, value: x}, 
            success: function(result){
				if(result = 'success'){
				}else{
					alert(result);
				}
            }
		});
}
</script>
</body>
</html>
