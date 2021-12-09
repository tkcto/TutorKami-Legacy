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


require_once('classes/dbCon.php');

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
.btn-copy { 
  color: #ffffff; 
  background-color: #244782; 
  border-color: #244782; 
} 
 
.btn-copy:hover, 
.btn-copy:focus, 
.btn-copy:active, 
.btn-copy.active, 
.open .dropdown-toggle.btn-copy { 
  color: #ffffff; 
  background-color: #244782; 
  border-color: #244782; 
} 
 
.btn-copy:active, 
.btn-copy.active, 
.open .dropdown-toggle.btn-copy { 
  background-image: none; 
} 
 
.btn-copy.disabled, 
.btn-copy[disabled], 
fieldset[disabled] .btn-copy, 
.btn-copy.disabled:hover, 
.btn-copy[disabled]:hover, 
fieldset[disabled] .btn-copy:hover, 
.btn-copy.disabled:focus, 
.btn-copy[disabled]:focus, 
fieldset[disabled] .btn-copy:focus, 
.btn-copy.disabled:active, 
.btn-copy[disabled]:active, 
fieldset[disabled] .btn-copy:active, 
.btn-copy.disabled.active, 
.btn-copy[disabled].active, 
fieldset[disabled] .btn-copy.active { 
  background-color: #244782; 
  border-color: #244782; 
} 
 
.btn-copy .badge { 
  color: #244782; 
  background-color: #ffffff; 
}

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
  content: "SEND";
  background: #800080;
  color : #ffffff;
}

.btn-WA-black { 
  color: #ffffff; 
  background-color: #0C0B0D; 
  border-color: #0C0B0D; 
} 
 
.btn-WA-black:hover, 
.btn-WA-black:focus, 
.btn-WA-black:active, 
.btn-WA-black.active, 
.open .dropdown-toggle.btn-WA-black { 
  color: #ffffff; 
  background-color: #0C0B0D; 
  border-color: #0C0B0D; 
} 
 
.btn-WA-black:active, 
.btn-WA-black.active, 
.open .dropdown-toggle.btn-WA-black { 
  background-image: none; 
} 
 
.btn-WA-black.disabled, 
.btn-WA-black[disabled], 
fieldset[disabled] .btn-WA-black, 
.btn-WA-black.disabled:hover, 
.btn-WA-black[disabled]:hover, 
fieldset[disabled] .btn-WA-black:hover, 
.btn-WA-black.disabled:focus, 
.btn-WA-black[disabled]:focus, 
fieldset[disabled] .btn-WA-black:focus, 
.btn-WA-black.disabled:active, 
.btn-WA-black[disabled]:active, 
fieldset[disabled] .btn-WA-black:active, 
.btn-WA-black.disabled.active, 
.btn-WA-black[disabled].active, 
fieldset[disabled] .btn-WA-black.active { 
  background-color: #0C0B0D; 
  border-color: #0C0B0D; 
} 
 
.btn-WA-black .badge { 
  color: #0C0B0D; 
  background-color: #ffffff; 
}

.btn-WA { 
  color: #ffffff; 
  background-color: #25D366; 
  border-color: #25D366; 
} 
 
.btn-WA:hover, 
.btn-WA:focus, 
.btn-WA:active, 
.btn-WA.active, 
.open .dropdown-toggle.btn-WA { 
  color: #ffffff; 
  background-color: #25D366; 
  border-color: #25D366; 
} 
 
.btn-WA:active, 
.btn-WA.active, 
.open .dropdown-toggle.btn-WA { 
  background-image: none; 
} 
 
.btn-WA.disabled, 
.btn-WA[disabled], 
fieldset[disabled] .btn-WA, 
.btn-WA.disabled:hover, 
.btn-WA[disabled]:hover, 
fieldset[disabled] .btn-WA:hover, 
.btn-WA.disabled:focus, 
.btn-WA[disabled]:focus, 
fieldset[disabled] .btn-WA:focus, 
.btn-WA.disabled:active, 
.btn-WA[disabled]:active, 
fieldset[disabled] .btn-WA:active, 
.btn-WA.disabled.active, 
.btn-WA[disabled].active, 
fieldset[disabled] .btn-WA.active { 
  background-color: #25D366; 
  border-color: #25D366; 
} 
 
.btn-WA .badge { 
  color: #25D366; 
  background-color: #ffffff; 
}

.text-success{
	 color: #366C44;
}
</style>
<!-- https://kazzkiq.github.io/balloon.css/ -->
<link rel="stylesheet" href="https://www.tutorkami.com/css/balloon.min.css">
<!-- alert message -->
	<link rel="stylesheet" href="plugin/lobibox/documentation.css"/>
	<link rel="stylesheet" href="plugin/lobibox/LobiBox.min.css"/>
<!-- alert message -->

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
}*/ 
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}


$queryUser = "SELECT * FROM tk_user WHERE u_email='$arrJb[j_hired_tutor_email]'";
$resultUser = $conDB->query($queryUser);
if ($resultUser->num_rows > 0) {
	$rowUser = $resultUser->fetch_assoc();
	$queryID =  $rowUser['u_id'];
}
$queryParent = "SELECT * FROM tk_user WHERE u_email='$arrJb[j_email]'";
$resultParent = $conDB->query($queryParent);
if ($resultParent->num_rows > 0) {
	$rowParent = $resultParent->fetch_assoc();
	$queryParentID = $rowParent['u_id'];
}

$queryWa = "SELECT * FROM tk_send_wa WHERE wa_job_id='$arrJb[j_id]'";
$resultWa = $conDB->query($queryWa);
if ($resultWa->num_rows > 0) {
	$rowWa = $resultWa->fetch_assoc();
	//$queryParentID = $rowWa['u_id'];
	$checkWa = 'checked="checked"';
}else{
	$checkWa = '';
}


$queryLogWa = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id='".$arrJb['j_id']."' AND wa_status='POST' AND wa_remark='Welcome' AND wa_note = '".$arrJb['j_telephone']."' ";
$resultLogWa = $conDB->query($queryLogWa);
if ($resultLogWa->num_rows > 0) {
	$rowLogWa = $resultLogWa->fetch_assoc();
	$welcomeWa = 'TRUE';
}else{
    
    require_once('classes/whatsapp-api-call.php');

    $website = "https://wa.tutorkami.my/api-docs/";
    if( !activeAPI( $website ) ) {
    	//echo $website ." is down!";
    } else {
    	//echo $website ." functions correctly.";
        
        	$args = new stdClass();
        	$xdata = new stdClass();
        	$args->contactId = "6".$arrJb['j_telephone']."@c.us";
        	$xdata->args = $args;
        	
        	$make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
        	$response = json_decode($make_call, true);
        	$dataPhone     = $response['response']['id'];
        	
        	if( $dataPhone != '' ){
        		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$arrJb['j_id']."', wa_user = '".$arrJb['j_telephone']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = '".$arrJb['j_telephone']."', wa_date = '".date('Y-m-d H:i:s')."' ";
        		$exeWaNoti = $conDB->query($sqlWaNoti);
        		$welcomeWa = 'TRUE';
        	}else{
        		$welcomeWa = '';
        	}  	
    }

}


//$dbCon->close();
?>

      <div class="wrapper wrapper-content animated fadeInRight">
         <div class="row">
            <div class="col-sm-12">
               <form action="" method="post" class="form-horizontal" id="frmJob" enctype="multipart/form-data">
                  <input type="hidden" name="j_id" id="j_id" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_id'] : ''; ?>"> 
                  <div class="ibox float-e-margins localization">
                     <div class="ibox-title">
                        <h5><?PHP if(isset($_REQUEST['j'])){echo "Edit Job";}else{echo "Job  Add";}?></h5>
                        <div class="ibox-tools">
                          <!-- <a href="classes-add.php?job_id=<?php echo $arrJb['j_id'];?>"><button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="view_class" type="button">Add Class</button></a> -->

                           <?php if(isset($_REQUEST['j'])) {
							   if($arrJb['send_rate'] == NULL){
								   //echo '<button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" onclick="myFunction()" >Rating</button>';
  echo '<div class="btn-group">
	  <button class="btn btn-primary sign-btn-box mrg-right-15 dropdown-toggle" type="button" data-toggle="dropdown">Rating <span class="caret"></span></button>
	  <ul class="dropdown-menu">
		  <li onclick="myFunction(this.id)" id="bm"><a>BM</a></li>
		  <li onclick="myFunction(this.id)" id="bi"><a>English</a></li>
	  </ul>
  </div>';		
  
							   }else{
								   //echo '<button class="btn btn-sm btn-warning sign-btn-box mrg-right-15" type="button" onclick="myFunction()" disabled >Sent</button>';
								   //echo '<button class="btn btn-sm btn-warning sign-btn-box mrg-right-15 showurl" type="button">Sent</button>';
								   ?>

  <div class="btn-group">
	  <button class="btn btn-warning sign-btn-box mrg-right-15 dropdown-toggle" type="button" data-toggle="dropdown">Sent ( <?PHP echo strtoupper($arrJb['send_rate']) ?> ) <span class="caret"></span></button>
	  <ul class="dropdown-menu">
		  <li onclick="getLink(this.id, 'https://www.tutorkami.com/my/parent_review?step=1&tutor_id=<?php echo $queryID;?>&parent_id=<?php echo $queryParentID;?>')" id="bm"><a>BM</a></li>
		  <li onclick="getLink(this.id, 'https://www.tutorkami.com/parent_review?step=1&tutor_id=<?php echo $queryID;?>&parent_id=<?php echo $queryParentID;?>')" id="bi"><a>English</a></li>
	  </ul>
  </div>	

								   <?PHP
							   }
						   }
						   ?>


<div id="ModalCopy" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
			<center>Link Successfully Copied</center>
		</div>
      </div>
    </div>
  </div>
</div>


<div id="ModalGif1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
			<center><img src="https://www.tutorkami.com/admin/img/Gif1.gif" /></center>
		</div>
      </div>
    </div>
  </div>
</div>
<div id="ModalGif2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
			<center><img src="https://www.tutorkami.com/admin/img/Gif2.gif" /></center>
		</div>
      </div>
    </div>
  </div>
</div>

<script>

function getLink(value, value2) {
	if(value = 'bm'){
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value2;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
	
    $(this).tooltip('hide');
  	$("#ModalCopy").modal();
	
	}else{
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value2;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
	
    $(this).tooltip('hide');
  	$("#ModalCopy").modal();
	
	}

}
</script>


						   
						   
						   
						   <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                           <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">S&CE </button>
                           <?php if(isset($_REQUEST['j'])) { ?>
                           <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" title="Delete" onClick="if(confirm('Are you sure, you want to remove the job?'))document.location.href='job-edit.php?action=delete_job&j_id=<?php echo $arrJb['j_id'];?>'">Delete</button>
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
                           <label class="col-sm-3 control-label" style="margin-top:-7px;">Job ID :</label>
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
                                 <!--<label class="label label-warning"><a href="classes-add.php?job_id=<?php //echo $arrJb['j_id'];?>" style="color:#FFF; text-decoration: none;">Add Class</a></label>-->
                                 <label class="label label-warning"><a onclick="javascript:addClasses('classes-add.php?job_id=<?php echo $arrJb['j_id'];?>')" style="color:#FFF; text-decoration: none;">Add Class</a></label>
                               </p>
                                <?php
                                
                              }
                             }
                             ?>
							 <button data-balloon-length="large" aria-label="Link to Job’s front end" data-balloon-pos="up-right" style="margin-right:23px;margin-top:-30px;" type="button" class="btn btn-copy btn-sm pull-right" onclick="copyFrontEnd('https://www.tutorkami.com/job_details?jid=<?php echo isset($_REQUEST['j']) ? $arrJb['j_id'] : ''; ?>&status=<?php echo isset($_REQUEST['j']) ? $arrJb['j_status'] : ''; ?>')"><i class="fa fa-copy"></i> Copy Link</button>
								  
                           </div>
                        </div>
                        

						<!--<div class="form-group">
						    <label class="col-sm-3 control-label" >Link To Job’s Front End :</label>
						    <div class="col-sm-7"> <button type="button" class="btn btn-copy btn-sm" onclick="copyFrontEnd('https://www.tutorkami.com/job_details?jid=<?php echo isset($_REQUEST['j']) ? $arrJb['j_id'] : ''; ?>&status=<?php echo isset($_REQUEST['j']) ? $arrJb['j_status'] : ''; ?>')"><i class="fa fa-copy"></i> Copy Link</button> </div>
						</div>-->


<?php 
//if( isset($_REQUEST['j']) && $arrJb['j_status']=="open" ){
?>

						<div class="form-group">
						    <label class="col-sm-3 control-label" >
<?PHP
if( $arrJb['j_status'] == 'open' && $arrJb['j_payment_status'] =='pending' ){
	echo 'Auto send profile :';
}else if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] =='pending' ){
	echo 'Auto send class reminder :';
}else if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] =='paid' ){
	echo 'Auto send payment reminder :';
}else{
	echo 'Not Set';
}
?>
							</label>
							<div class="col-sm-7"> 
								<div class="fixed-footer">
								  <div class="btn-toolbar b-container">
									<input <?PHP echo $checkWa; ?> type="checkbox" class="flipswitch" id="sendWA" onclick="SendWhatsApp()" /> &nbsp;
									<!--<input <?PHP echo $checkWa; ?> type="checkbox" class="" id="sendWA" onclick="SendWhatsApp()" /> &nbsp;-->
									<span></span>					
									<input type="hidden" id="queryParentID" name="queryParentID" value="<?PHP echo $queryParentID; ?>" />
									
									<span style="margin-left:10px;margin-top:5px;" class="pull-right" data-balloon-length="large" aria-label="Click label to copy the link for client to click in order to subscribe to WA auto message. If label shows ‘Not Subscribe’, it means client has not clicked the link. If label show ‘Subscribe’ means client has clicked the link" data-balloon-pos="up-right"><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></span>
									 

<?PHP
if( $welcomeWa == 'TRUE' ){
	?>
									 <a style="" class="btn btn-WA btn-sm pull-right" onclick="copyWA('https://wa.me/60103169072?text=Subscribe%20TK%20Notification')"><i class="fa fa-whatsapp"></i> Subscribe</a>
	<?PHP
}else{
	?>
									 <a style="" class="btn btn-WA-black btn-sm pull-right" onclick="copyWA('https://wa.me/60103169072?text=Subscribe%20TK%20Notification')"><i class="fa fa-whatsapp"></i> Not Subscribe</a>
	<?PHP
}
?>
								  </div>
								</div>
							</div>
						</div>
						

<?PHP
//}	
?>

<?PHP
/*
// ISU JUNE 2020 - NO 31 - chk job 7635 
//if($_SESSION[DB_PREFIX]['u_first_name'] == 'Mohd Nurfadhli'){
    //echo 'fadhli';
    $allAdmin = array();
    $queryAdmin = " SELECT * FROM tk_user WHERE u_role = '2' "; 
    $resultAdmin = $conDB->query($queryAdmin); 
    if($resultAdmin->num_rows > 0){ 
        while($rowAdmin = $resultAdmin->fetch_assoc()){ 
            $allAdmin[] = $rowAdmin['u_id'];
        }     
    }	
	
	if (isset($_GET['j']) && $_GET['j'] != '') {                                    
		$resAJ = $instJob->JobWiseAppliedJobs($_GET['j']);
		if ($resAJ->num_rows > 0) {
			
			$allLink = array();
			$allLink = [];
			$allLink2 = array();
			$allLink2 = [];
			while( $j_row = $resAJ->fetch_assoc() ){

				$arrayTutorProfile = array();
				$queryGetID = " SELECT * FROM tk_user WHERE u_displayid = '".$j_row['u_displayid']."' "; 
				$resultGetID = $conDB->query($queryGetID); 
				if($resultGetID->num_rows > 0){ 
					while($rowGetID = $resultGetID->fetch_assoc()){ 
						
							$purataRatingT = 0;
							$numRowRatingT = 0;
							$purataT = '';
							$queryRatingT = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$rowGetID['u_id']."' AND rr_status = 'approved' AND rr_parent_id IN ( '" . implode( "', '" , $allAdmin ) . "' ) "; 
							$resultRatingT = $conDB->query($queryRatingT); 
							if($resultRatingT->num_rows > 0){ 
								while($rowRatingT = $resultRatingT->fetch_assoc()){  
									   $purataRatingT+=  $rowRatingT['rr_rating'];
									   $numRowRatingT++;
								} 
								$purataT = ($purataRatingT / $numRowRatingT);
								if($purataT >= 4){
									//echo $purataT.'<br/>';
									//$parentPhoneNo = $arrJb['j_telephone'];
									//$parentPhoneNo = '0122372526';
									//$headerTitle = rawurlencode('This is an automatic message sent from TutorKami.com as you have given us permission to auto send you tutor’s profiles. Please do not reply to this what’s app message. If you don’t want to receive this message anymore, please inform our Coordinator. Thank you.');
									$sendTutorProfile = 'https://www.tutorkami.com/tutor_profile?did='.$j_row['u_displayid'];
									//$arrayTutorProfile = $sendTutorProfile;
									//echo  "<a href='https://wa.me/6".$parentPhoneNo."?text=".$headerTitle.'%0A%0A'.$sendTutorProfile."' target='_blank'>Click</a>";
									//echo "<a href='https://wa.me/6".$parentPhoneNo."?text=".$sendTutorProfile."' target='_blank'>Click2</a>";
									//$WALink =  $sendTutorProfile;
									$allLink[] = $sendTutorProfile;
									$allLink2[] = $j_row['u_id'];
								}
							}	
						
						
					}     
				}
				
				
			}
			if( !empty($allLink) && !empty($allLink2) ) {
				
				//$parentPhoneNo = $arrJb['j_telephone'];
				//$parentPhoneNo = '0122370000';
				if( strpos($arrJb['j_telephone'], '-') !== false ) {
					$parentPhoneNo =  str_replace("-","",$arrJb['j_telephone']);
				}else{
					$parentPhoneNo = $arrJb['j_telephone'];
				}
				
				$headerTitle = rawurlencode('This is an automatic message sent from TutorKami.com as you have given us permission to auto send you tutor’s profiles. Please do not reply to this what’s app message. If you don’t want to receive this message anymore, please inform our Coordinator. Thank you.');
						?>
						<div class="form-group">
						    <label class="col-sm-3 control-label" >Auto send profile :</label>
						    <div class="col-sm-8"> 
							
								<input <?PHP echo $checkWa; ?> type="checkbox" class="flipswitch" id="sendWA" onclick="SendWhatsApp()" /> &nbsp;
								<span></span>
								<!--<input type="checkbox" checked="checked" class="flipswitch" /> &nbsp;
								<span></span>-->						
								<?PHP 
									//echo "<a href='https://wa.me/6".$parentPhoneNo."?text=".$headerTitle.'%0A%0A'; foreach($allLink as $linkProfileTutor){ echo $linkProfileTutor.'%0A%0A'; } echo "' target='_blank'>Click</a>"; 
								$linkValue = " https://wa.me/6".$parentPhoneNo."?text=".$headerTitle.'%0A%0A'; foreach($allLink as $linkProfileTutor){ $linkValue .= $linkProfileTutor.'%0A%0A'; }
								?>
								<input type="hidden" id="queryParentID" name="queryParentID" value="<?PHP echo $queryParentID; ?>" />
								<input type="hidden" id="sendWAValue" name="sendWAValue" value="<?PHP echo $linkValue; ?>" />	
								<input type="hidden" id="sendWAValue2" name="sendWAValue2" value="<?PHP echo implode(",",$allLink2); ?>" />	
								<button style="margin-top:-30px;" type="button" class="btn btn-WA btn-sm" onclick="copyWA('https://wa.me/60103169072?text=Subscribe%20TK%20Notification')"><i class="fa fa-whatsapp"></i> WA Subscribe</button> 
							</div>
						</div>
						<?PHP
				//echo "<a href='https://wa.me/6".$parentPhoneNo."?text=".$headerTitle.'%0A%0A'; foreach($allLink as $linkProfileTutor){ echo $linkProfileTutor.'%0A%0A'; } echo "' target='_blank'>Click</a>";
			}			
		}
	}
//}
*/
?>
<script>	
function SendWhatsApp() {
	var x = document.getElementById("sendWA").checked;
	var j_id = document.getElementById("j_id").value;
	var queryParentID = document.getElementById("queryParentID").value;
		$.ajax({
			url: "send-wa.php",
            method: "POST",
			data: {j_id: j_id, queryParentID: queryParentID, value: x}, 
            success: function(result){
				if(result = 'success'){
					//alert(result);
				}else{
					alert(result);
				}
            }
		});
/*
  var x = document.getElementById("sendWA").checked;
  var sendWAValue = document.getElementById("sendWAValue").value;
  var j_id = document.getElementById("j_id").value;
  var sendWAValue2 = document.getElementById("sendWAValue2").value;
  if(x == true){
         $.ajax({
            url: "send-wa.php",
            method: "POST",
            //data: {j_id: j_id, sendWAValue2: sendWAValue2}, 
			data: {j_id: j_id}, 
            success: function(result){
				if(result = 'success'){
					//window.open(sendWAValue,'_blank');
					location.reload();
				}else{
					alert(result);
				}
            }
         });
  }else{
	//alert('xxx ok');
  }
*/
}
</script>
 
 
 
<div id="ModalCopy" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
			<center>Link Successfully Copied</center>
		</div>
      </div>
    </div>
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
                            <input type="text" class="form-control" name="jt_subject[en]" value="<?php echo isset($_REQUEST['j']) ? $arrJbt['jt_subject'] : ''; ?>" required/> 
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
                                 <option value="<?=$arrStates['st_id']?>" <?php if(isset($_REQUEST['j'])) echo ($arrStates['st_id']==$arrJb['state'])?'selected':''?>><?php echo $arrStates['st_name']?></option>
                                 <?php }?>
                              </select>
								 
                            </div>
<?PHP
//if($_SESSION[DB_PREFIX]['u_first_name'] == 'mohd nurfadhli'){
    //$_GET['u_id']
?>
                            <div class="col-sm-4">
                                <select class="form-control" name="newCity" id="newCity" required>
                                    <option>Select City Name</option>
                                    <?php 
                                        /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                                        if ($dbCon->connect_error) {
                                            die("Connection failed: " . $dbCon->connect_error);
                                        }*/
                                        if(isset($_GET['j'])){
                                            //echo $_GET['u_id'];
                                            $qUser = " SELECT * FROM tk_job WHERE j_id='".$_GET['j']."' "; 
                                            $rUser = $conDB->query($qUser); 
                                            if($rUser->num_rows > 0){ 
                                                $rowUser = $rUser->fetch_assoc();
                                            }
                                            
                                        }
                                        $query = "SELECT * FROM tk_cities WHERE city_st_id='".$rowUser['state']."' ORDER BY city_name ASC"; 
                                        $result = $conDB->query($query); 
                                        if($result->num_rows > 0){ 
                                            while($row = $result->fetch_assoc()){  
                                                ?><option value="<?php echo $row['city_id']; ?>" <?php if($row['city_id'] == $rowUser['city']){echo 'selected';}?> ><?php echo $row['city_name']; ?></option><?php
                                            } 
                                        }
                                        //$dbCon->close();                                          
                                      
                                    ?>
                                </select>
                            </div>
<?PHP
//}
?>                            
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
                                            <label>
												<input type="checkbox" id="j_check_timeday" name="j_check_timeday" <?php if ( isset($_REQUEST['j']) && $arrJb['j_check_timeday'] == 'on') { echo "checked='checked'"; } ?> ><span class="cr" style="margin-left:-18px;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
												&nbsp;&nbsp;&nbsp;
                                            </label><a onclick="openGif2()" style="margin-left:-5px;" data-balloon-length="large" aria-label="Check this box to enable tutor to fill in their schedule. Click here to see a preview" data-balloon-pos="up-right"><span class="glyphicon glyphicon-question-sign" style="color:#262262" ></span></a>
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
                           <label class="col-lg-3 control-label" >Hired Tutor's Email :</label>
                           <div class="col-lg-5"><input type="text" class="form-control" name="j_hired_tutor_email" id="j_hired_tutor_email" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_hired_tutor_email'] : ''; ?>" />
                           </div>
                           <div class="col-lg-4">
                            <?php 
                            if(isset($_REQUEST['j']) && $arrJb['j_hired_tutor_email'] != '') {
                              $userRes = $userInit->GetUserJobAddLink('3', $arrJb['j_hired_tutor_email']);
                              $userRow = $userRes->fetch_array(MYSQLI_ASSOC);
                              // var_dump($userRes);die;
                              if ($userRes->num_rows > 0) {
                                // print_r('ada row');die;
                                echo '<label ondrop="drop(event)" ondragover="allowDrop(event)" class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$userRow['u_displayid'].'" target="_blank" title="ID: '.$userRow['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$userRow['u_email'].'</a></label> ';
                              }else{
                                echo '<label ondrop="drop(event)" ondragover="allowDrop(event)" class="label label-danger">Tutor not exists</label> ';
                              }
                            }
                            ?><a style="margin-left:0%;" data-balloon-length="large" aria-label="You can drag & drop email from Tutor’s Applying to this field" data-balloon-pos="up-right"><span class="glyphicon glyphicon-question-sign" style="color:#262262" ></span></a>
                           </div>
                        </div>
                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Tutor's Applying :</label>
                           <div class="col-sm-7">
                              <div class="well">
                                <?php 
                                if (isset($_GET['j']) && $_GET['j'] != '') {                                    
                                  $resAJ = $instJob->JobWiseAppliedJobs($_GET['j']);
                                  if ($resAJ->num_rows > 0) {
                                    while( $j_row = $resAJ->fetch_assoc() ){
                                        if($j_row['aj_rate'] != ''){
                                            $showRM = ' RM : ';
                                        }else{
                                            $showRM = '';
                                        }
                                      //echo '<label class="label label-primary"><a href="manage_user.php?action=edit&u_id='.$j_row['u_displayid'].'" target="_blank" title="ID: '.$j_row['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$j_row['u_email'].$showRM.$j_row['aj_rate'].'</a></label> ';
									  ?> <!--<label onclick="NewTab('<?php echo $j_row['u_displayid']; ?>');"  id="<?PHP echo $j_row['u_email'];?>" draggable="true" ondragstart="drag(event)" class="label label-primary" style="cursor:pointer" ><?PHP echo $j_row['u_email'].$showRM.$j_row['aj_rate']; ?></label> --> <?PHP
									  echo '<label class="label label-primary"  draggable="true" ondragstart="drag(event)" ><a id="'.$j_row['u_email'].'" href="manage_user.php?action=edit&u_id='.$j_row['u_displayid'].'" target="_blank" title="ID: '.$j_row['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$j_row['u_email'].$showRM.$j_row['aj_rate'].'</a></label> ';
                                    }
                                  }
                                }
                                ?>
                              </div>
                           </div>
<?PHP
$historyWa = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = 'Apply Job' ";
$resulthistoryWa = $conDB->query($historyWa);
if ($resulthistoryWa->num_rows > 0) {
	while($rowhistoryWa = $resulthistoryWa->fetch_assoc()){
		if( $rowhistoryWa['wa_status'] == 'POST' ){
			//$textColor = '<b><span class=text-success>Success</span></b>';
			$whatIWant.= '<span class=text-secondary>'.substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , "- ") + 1).'</span>';    
		}else{
			//$textColor = '<b><span class=text-danger>Fail</span></b>';
			//$whatIWant.= '<span class=text-danger>'.substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , "- ") + 1).'</span>';   
			$whatIWant.= '';
		}
		//$whatIWant.= substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , "- ") + 1).' '.$textColor; 
	}
    
}
?>
						   <a id="popoverData" data-html="true" data-content="<?PHP echo $whatIWant; ?>" rel="popover" title="WhatsApp Log" data-placement="left" data-trigger="hover"><span class="glyphicon glyphicon-user" style="color:#262262" ></span></a>
						   &nbsp;&nbsp;<a style="margin-left:-5px;" data-balloon-length="large" aria-label="This will show list of tutors whose profile has been automatically sent to client" data-balloon-pos="up-right"><span class="glyphicon glyphicon-question-sign" style="color:#262262" ></span></a>
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
                                            <label>
												<input type="checkbox" id="j_check_rate" name="j_check_rate" <?php if ( isset($_REQUEST['j']) && $arrJb['j_check_rate'] == 'on') { echo "checked='checked'"; } ?> ><span class="cr" style="margin-left:-18px;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
												&nbsp;&nbsp;&nbsp;
											</label><a onclick="openGif1()" style="margin-left:-5px;" data-balloon-length="large" aria-label="Check this box to enable tutor to put in their suggested rate. Click here to see a preview" data-balloon-pos="up-right"><span class="glyphicon glyphicon-question-sign" style="color:#262262" ></span></a>
										</div>
                                    </span>
                                </div>                           
                           </div>
                        </div>
                        

                        
                        <!--<div class="form-group">
                           <label class="col-lg-3 control-label">Preferred Time & Day:</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="j_preferred_date_time" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['j_preferred_date_time'] : ''; ?>" required> 
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
						
<?PHP
if( isset($_REQUEST['j']) && $arrJb['j_start_date'] != '' ){
	if( $arrJb['j_start_date'] == '0000-00-00' ){
		$newDateStartDate = '';
	}else{
		$arrStartDate = explode('-', $arrJb['j_start_date']);
		$newDateStartDate = $arrStartDate[2].'/'.$arrStartDate[1].'/'.$arrStartDate[0];
	}
}else{
	$newDateStartDate = '';
}


if( isset($_REQUEST['j']) && $arrJb['j_end_date'] != '' ){
	if( $arrJb['j_end_date'] == '0000-00-00' ){
		$newDateEndDate = '';
	}else{
		$arrEndDate = explode('-', $arrJb['j_end_date']);
		$newDateEndDate = $arrEndDate[2].'/'.$arrEndDate[1].'/'.$arrEndDate[0];
	}
}else{
	$newDateEndDate = '';
}
?>
						
                        <div class="form-group" id="data_3">
                           <label class="col-sm-3 control-label">Start Date :</label>
                           <div class="col-sm-7">
                              <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="<?php echo $newDateStartDate; //echo isset($_REQUEST['j']) ? $arrJb['j_start_date'] : ''; ?>"  name="j_start_date" />
                              </div>
                           </div>
                        </div>
                        <div class="form-group" id="data_4">
                           <label class="col-sm-3 control-label">Due Date :</label>
                           <div class="col-sm-7">
                              <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="<?php echo $newDateEndDate;//echo isset($_REQUEST['j']) ? $arrJb['j_end_date'] : ''; ?>" name="j_end_date" />
                              </div>
                           </div>
                        </div>
						<?PHP
						if(isset($_REQUEST['j'])){
						?>
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Parent's Email :</label>
                           <div class="col-lg-5"><input type="email" class="form-control" name="actual_email" id="actual_email" value="<?php echo isset($_REQUEST['j']) ? $arrJb['actual_email'] : ''; ?>" > 
                           </div>
                        </div>

                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Parent’s Rate :</label>
                           <!--<div class="col-lg-5">
								<input type="text" class="form-control" name="parent_rate" id="parent_rate" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['parent_rate'] : ''; ?>" > 
                           </div>-->
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <input data-required onkeypress="return isNumberKey(event)" type="text"  class="form-control" name="parent_rate" id="parent_rate" value="<?php echo isset($_REQUEST['j']) ? $arrJb['parent_rate'] : ''; ?>" style="width:55px;" > <span> <font size="2">&nbsp;&nbsp;&nbsp;hour</font></span>
                              </div>
						   </div>
                        </div>
						
						
<?PHP
//if($_SESSION[DB_PREFIX]['u_first_name'] == 'mohd nurfadhli'){
?>
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Student’s Name :</label>
                           <div class="col-lg-5"><input type="text" class="form-control" name="student_name" id="student_name" value="<?php echo isset($_REQUEST['j']) ? $arrJb['student_name'] : ''; ?>" > 
                           </div>
                        </div>
                        
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Hour per cycle :</label>
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <input data-required onkeypress="return isNumberKey(event)" type="text"  class="form-control" name="cycle" id="cycle" value="<?php echo isset($_REQUEST['j']) ? $arrJb['cycle'] : ''; ?>" style="width:50px;" > <span> <font size="2">&nbsp;&nbsp;&nbsp;hours</font></span>
                              </div>
						   </div>
                        </div>
<?PHP
//}
?>
						
						<?PHP
						}
						?>
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Admin's Comment :</label>
                           <div class="col-lg-7">
                              <textarea class="form-control" rows="5" id="jt_comments" name="jt_comments[en]"><?php echo isset($_REQUEST['j']) ? $arrJbt['jt_comments'] : ''; ?></textarea>
                           </div>
                        </div>
                        <div class="form-group mrg-top-30">
                           <div class="col-lg-offset-3 col-lg-9">
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">S&CE </button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" onClick="duplicateJob()">Duplicate </button>
                              
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
              format: "dd/mm/yyyy"
          });
      
          $('#data_4 .input-group.date').datepicker({
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              format: "dd/mm/yyyy"
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


          }
        })
      }else{
      }
     }
/*	 
function myFunction() {
    var j_id = $('#j_id').val();
    var actual_email = $('#actual_email').val(); // parent
    var j_hired_tutor_email = $('#j_hired_tutor_email').val(); //tutor
	if(actual_email == ''){
		alert('Invalid Email');
	}else{
		//alert(j_id + ' - ' + actual_email + ' - ' + j_hired_tutor_email);
        $.post("send-email-all.php",{ 
            id:j_id,
            email_parent:actual_email,
            email_tutor:j_hired_tutor_email
        },
        function(response,status){ // Required Callback Function
            alert("Response : " + response + "\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
            location.reload();
        });
	}
}*/
function myFunction(value) {
	var x = confirm("Confirm to proceed?");
	if (x == true){
		var j_id = $('#j_id').val();
		var actual_email = $('#actual_email').val(); // parent
		var parentDumyEmail = $('#j_email').val(); // parent
		var j_hired_tutor_email = $('#j_hired_tutor_email').val(); //tutor
		if(actual_email == ''){
			alert('Invalid Email');
		}else{
			//alert(j_id + ' - ' + actual_email + ' - ' + j_hired_tutor_email);
			$.post("send-email-all.php",{ 
				id:j_id,
				email_parent:actual_email,
				email_parent_dumy:parentDumyEmail,
				email_tutor:j_hired_tutor_email,
				value:value
			},
			function(response,status){ // Required Callback Function
				alert("Response : " + response + "\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
				location.reload();
			});
		}
	}
}
function addClasses(value) {
	var x = confirm("Confirm to proceed?");
	if (x == true){
		window.open(value,"_self")

	}
}

function duplicateJob() {
    //alert('under construction');
var j_create_date = encodeURIComponent(document.getElementsByName("j_create_date")[0].value);
var j_jl_id = encodeURIComponent(document.getElementsByName("j_jl_id")[0].value);
var jt_subject = encodeURIComponent(document.getElementsByName("jt_subject[en]")[0].value);
var j_area = encodeURIComponent(document.getElementsByName("j_area")[0].value);
var j_state_id = encodeURIComponent(document.getElementsByName("j_state_id")[0].value);
var newCity = encodeURIComponent(document.getElementsByName("newCity")[0].value);
var j_email = encodeURIComponent(document.getElementsByName("j_email")[0].value);
var j_telephone = encodeURIComponent(document.getElementsByName("j_telephone")[0].value);
var j_rate = encodeURIComponent(document.getElementsByName("j_rate")[0].value);
var jt_lessons = encodeURIComponent(document.getElementsByName("jt_lessons[en]")[0].value);
var j_preferred_date_time = encodeURIComponent(document.getElementsByName("j_preferred_date_time")[0].value);
var j_commission = encodeURIComponent(document.getElementsByName("j_commission")[0].value);
var j_duration = encodeURIComponent(document.getElementsByName("j_duration")[0].value);
var j_status = encodeURIComponent(document.getElementsByName("j_status")[0].value);
var j_payment_status = encodeURIComponent(document.getElementsByName("j_payment_status")[0].value);
var j_deadline = encodeURIComponent(document.getElementsByName("j_deadline")[0].value);
var j_hired_tutor_email = encodeURIComponent(document.getElementsByName("j_hired_tutor_email")[0].value);

var jt_remarks = encodeURIComponent(document.getElementsByName("jt_remarks[en]")[0].value);
var j_start_date = encodeURIComponent(document.getElementsByName("j_start_date")[0].value);
var j_end_date = encodeURIComponent(document.getElementsByName("j_end_date")[0].value);
var j_creator_email = encodeURIComponent(document.getElementsByName("j_creator_email")[0].value);
var actual_email = encodeURIComponent(document.getElementsByName("actual_email")[0].value);
var parent_rate = encodeURIComponent(document.getElementsByName("parent_rate")[0].value);
var cycle = encodeURIComponent(document.getElementsByName("cycle")[0].value);

var jt_comments = encodeURIComponent(document.getElementsByName("jt_comments[en]")[0].value);
var jt_comments2 = document.getElementsByName("jt_comments[en]")[0].value;

var j_check_rate=$("#j_check_rate").is(":checked");
var j_check_timeday=$("#j_check_timeday").is(":checked");
/*
alert(j_create_date + '\n' + j_jl_id + '\n' + jt_subject + '\n' + j_area + '\n' + j_state_id + '\n' + j_email + '\n' + j_telephone + '\n' + j_rate + '\n' + jt_lessons + '\n' + j_preferred_date_time + '\n' + j_commission
 + '\n' + j_duration + '\n' + j_status + '\n' + j_payment_status + '\n' + j_deadline + '\n' + j_hired_tutor_email 
);
*/

   /*$.ajax({
        url: "ajax/ajax-session.php",
        method: "POST",
        data: {action: 'jt_comments', jt_comments: jt_comments}, 
        success: function(result){
            window.open('job-duplicate.php?crt='+ j_create_date +'&lvl='+ j_jl_id +'&sbj='+ jt_subject +'&ara='+ j_area +'&stt='+ j_state_id +'&newCity='+ newCity +'&eml='+ j_email +'&tel='+ j_telephone +'&rte='+ j_rate +'&lss='+ jt_lessons +'&prd='+ j_preferred_date_time +'&cms='+ j_commission +'&drt='+ j_duration +'&sts='+ j_status +'&pstt='+ j_payment_status +'&ddl='+ j_deadline +'&hte='+ j_hired_tutor_email +'&rmk='+ jt_remarks +'&str='+ j_start_date +'&end='+ j_end_date +'&crea='+ j_creator_email +'&act='+ actual_email +'&prt='+ parent_rate +'&j_check_rate='+ j_check_rate +'&j_check_timeday='+ j_check_timeday                   ,'_blank');

        }
    });*/


$.ajax({
    type: "POST",
    url: 'ajax/ajax-session.php',
    data: {jt_comments2: jt_comments2},
    success: function(data){
        //alert(data);
        window.open('job-duplicate.php?crt='+ j_create_date +'&lvl='+ j_jl_id +'&sbj='+ jt_subject +'&ara='+ j_area +'&stt='+ j_state_id +'&newCity='+ newCity +'&eml='+ j_email +'&tel='+ j_telephone +'&rte='+ j_rate +'&lss='+ jt_lessons +'&prd='+ j_preferred_date_time +'&cms='+ j_commission +'&drt='+ j_duration +'&sts='+ j_status +'&pstt='+ j_payment_status +'&ddl='+ j_deadline +'&hte='+ j_hired_tutor_email +'&rmk='+ jt_remarks +'&str='+ j_start_date +'&end='+ j_end_date +'&crea='+ j_creator_email +'&act='+ actual_email +'&prt='+ parent_rate +'&cycle='+ cycle +'&j_check_rate='+ j_check_rate +'&j_check_timeday='+ j_check_timeday                   ,'_blank');

    }
});

    //window.open('job-duplicate.php?crt='+ j_create_date +'&lvl='+ j_jl_id +'&sbj='+ jt_subject +'&ara='+ j_area +'&stt='+ j_state_id +'&newCity='+ newCity +'&eml='+ j_email +'&tel='+ j_telephone +'&rte='+ j_rate +'&lss='+ jt_lessons +'&prd='+ j_preferred_date_time +'&cms='+ j_commission +'&drt='+ j_duration +'&sts='+ j_status +'&pstt='+ j_payment_status +'&ddl='+ j_deadline +'&hte='+ j_hired_tutor_email +'&rmk='+ jt_remarks +'&str='+ j_start_date +'&end='+ j_end_date +'&crea='+ j_creator_email +'&act='+ actual_email +'&prt='+ parent_rate +'&cmm='+ jt_comments +'&j_check_rate='+ j_check_rate +'&j_check_timeday='+ j_check_timeday                   ,'_blank');

//alert(jt_comments);
}

function copyFrontEnd(value) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
	
    $(this).tooltip('hide');
  	$("#ModalCopy").modal();
}
function copyWA(value) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
	
    $(this).tooltip('hide');
  	$("#ModalCopy").modal();
}


function openGif1() {
	$("#ModalGif1").modal();
}
function openGif2() {
	$("#ModalGif2").modal();
}


$('#j_state_id').change(function(){
    var StateId = $(this).val();
    $.ajax({
        url: "ajax/ajax_call.php",
        method: "POST",
        data: {action: 'get_city', state_id: StateId}, 
        success: function(result){
            $('#newCity').html(result);
        }
    });
});

$('#popoverData').popover();

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

<script src="plugin/lobibox/lobibox.min.js"></script>
<script>
   $('form#frmJob').submit(function(){
      var error = 0;
      var errEl = '';
      var reg_number = /^[0-9]+$/;
      var reg_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      var elem = document.getElementById('frmJob').elements;
      for(var i = 0; i < elem.length; i++) {
         if (elem[i].hasAttribute("data-required")) {
            if (elem[i].type == 'radio' || elem[i].type == 'checkbox') {
               var elemName = document.getElementsByName(elem[i].name);
               var r_err = 0;
               for(var k = 0; k < elemName.length; k++) {
                  // alert(k+'='+elemName[k].checked)
                  if (elemName[k].checked == false) {
                     r_err++;
                  }  
               }
               // alert(r_err+'='+elemName.length)
               if (r_err == elemName.length) {
                  if (elemName != errEl) {
                     error++;
                     errEl = elemName;
                     var field_name  = elem[i].name;
                     var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                         filed_label = filed_label.split('_').join(' ');
                         filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

                     //getStickyNote ('error', filed_label + ' is required');   
						Lobibox.notify('error', {
							position: 'top right',
							 //icon: false,
							 width: 250, //Any Integer
							 size: 'mini',
							 //title: filed_label + ' is required'
							 msg: filed_label + ' is required'
						});
                  }
                  
               }

            } else if(elem[i].value == '') {
               error++;
               var field_name  = elem[i].name;
               var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                   filed_label = filed_label.split('_').join(' ');
                   filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

               //getStickyNote ('error', filed_label + ' is required');
                Lobibox.notify('error', {
                    position: 'top right',
                    //icon: false,
					width: 250, //Any Integer
					size: 'mini',
					//title: filed_label + ' is required'
                    msg: filed_label + ' is required'
                });
			   
            }
         }

         if(elem[i].hasAttribute("data-numeric") && !elem[i].value.match(reg_number)) {
            error++;
            var field_name  = elem[i].name;
            var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                filed_label = filed_label.split('_').join(' ');
                filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

            //getStickyNote ('error', filed_label + ' must be numeric');
                Lobibox.notify('error', {
                    position: 'top right',
                    //icon: false,
					width: 250, //Any Integer
					size: 'mini',
					//title: filed_label + ' is required'
                    msg: filed_label + ' must be numeric'
                });
         }

         if(elem[i].hasAttribute("data-email") && !elem[i].value.match(reg_email)) {
            error++;
            var field_name  = elem[i].name;
            var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                filed_label = filed_label.split('_').join(' ');
                filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

            //getStickyNote ('error', filed_label + ' must be valid email');
                Lobibox.notify('error', {
                    position: 'top right',
                    //icon: false,
					width: 250, //Any Integer
					size: 'mini',
					//title: filed_label + ' is required'
                    msg: filed_label + ' must be valid email'
                });
         }
      }

      if (error > 0) {
         return false;  
      }
   });

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.innerText = document.getElementById(data).innerText;
}

function NewTab(value) { 
	window.open( 'manage_user.php?action=edit&u_id='+value, "_blank"); 
} 
</script>

</body>
</html>
