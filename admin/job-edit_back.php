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


//require_once('classes/dbCon.php');

if(count($_POST) > 0){
 $data = $instJob->RealEscape($_REQUEST);
 $res =  $instJob->SaveJob($data);
 if ($res !== false) {
    if (isset($_POST['save'])) {
        if( isset($_SESSION["tempCreateClasses"]) && $_SESSION["tempCreateClasses"] == 'Save' ){
            if( isset($_SESSION["JHired"]) && $_SESSION["JHired"] != '' ){
               header('Location:job-edit.php?j='.$res);
               exit();                
            }else{
               header('Location:job-list.php');
               exit(); 
            }

        }else{
           header('Location:job-list.php');
           exit();            
        }  
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


$useragentJob=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragentJob)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragentJob,0,4)))
{ 
    //echo "mobile";
    //$marginLeft = 'style="margin-left:-80px;"';
    $marginLeft = '';
    $thisCol = 'col-sm-9';
    $telStyle = 'margin-left:-50px;';
}else{
    //echo "desktop";
    $marginLeft = '';
    $thisCol = 'col-sm-7';
    $telStyle = 'margin-left:-110px;';
}
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
  content: "ON";
  background: #800080;
  color : #ffffff;
}

.flipswitchOnOff {
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

.flipswitchOnOff:after {
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

.flipswitchOnOff:after {
  left: 2%;
  content: "OFF";
}

.flipswitchOnOff:checked:after {
  left: 53%;
  content: "ON";
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

.popover{
    max-width: 100%; 
    /* Max Width of the popover (depending on the container!) */
}

.btn-hijau { 
  color: #ffffff; 
  background-color: #458540; 
  border-color: #458540; 
} 
 
.btn-hijau:hover, 
.btn-hijau:focus, 
.btn-hijau:active, 
.btn-hijau.active, 
.open .dropdown-toggle.btn-hijau { 
  color: #ffffff; 
  background-color: #458540; 
  border-color: #458540; 
} 
 
.btn-hijau:active, 
.btn-hijau.active, 
.open .dropdown-toggle.btn-hijau { 
  background-image: none; 
} 
 
.btn-hijau.disabled, 
.btn-hijau[disabled], 
fieldset[disabled] .btn-hijau, 
.btn-hijau.disabled:hover, 
.btn-hijau[disabled]:hover, 
fieldset[disabled] .btn-hijau:hover, 
.btn-hijau.disabled:focus, 
.btn-hijau[disabled]:focus, 
fieldset[disabled] .btn-hijau:focus, 
.btn-hijau.disabled:active, 
.btn-hijau[disabled]:active, 
fieldset[disabled] .btn-hijau:active, 
.btn-hijau.disabled.active, 
.btn-hijau[disabled].active, 
fieldset[disabled] .btn-hijau.active { 
  background-color: #458540; 
  border-color: #458540; 
} 
 
.btn-hijau .badge { 
  color: #458540; 
  background-color: #ffffff; 
}

.spinner {
  margin: 10px auto 0;
  width: 70px;
  text-align: center;
}

.spinner > div {
  width: 13px;
  height: 13px;
  background-color: #900C3F;

  border-radius: 100%;
  display: inline-block;
  -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
  animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}

.spinner .bounce1 {
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}

.spinner .bounce2 {
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}

@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bouncedelay {
  0%, 80%, 100% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 40% { 
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
  }
}
</style>
<!-- https://kazzkiq.github.io/balloon.css/ -->
<link rel="stylesheet" href="https://www.tutorkami.com/css/balloon.min.css">
<!-- alert message -->
	<link rel="stylesheet" href="plugin/lobibox/documentation.css"/>
	<link rel="stylesheet" href="plugin/lobibox/LobiBox.min.css"/>
<!-- alert message -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
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

$queryID = '';
$TutorPhone = '';
$queryUser = "SELECT * FROM tk_user 
INNER JOIN tk_user_details ON ud_u_id = u_id
WHERE u_email='$arrJb[j_hired_tutor_email]'";
$resultUser = $conDB->query($queryUser);
if ($resultUser->num_rows > 0) {
	$rowUser = $resultUser->fetch_assoc();
	$queryID =  $rowUser['u_id'];
	$TutorPhone =  $rowUser['ud_phone_number'];
	$pvName = str_replace(' ', '-', $rowUser['resit_pv_name']);
}
$queryParent = "SELECT * FROM tk_user WHERE u_email='$arrJb[j_email]'";
$resultParent = $conDB->query($queryParent);
if ($resultParent->num_rows > 0) {
	$rowParent = $resultParent->fetch_assoc();
	$queryParentID = $rowParent['u_id'];
}

$queryWa = " SELECT * FROM tk_send_wa WHERE wa_job_id='".$arrJb['j_id']."' ";
$resultWa = $conDB->query($queryWa);
if ($resultWa->num_rows > 0) {
	$rowWa = $resultWa->fetch_assoc();
	//$queryParentID = $rowWa['u_id'];
	$checkWa = 'checked="checked"';
	$setupForm = '';
}else{
	$checkWa = '';
	$setupForm = 'hidden';
}

$queryWa = " SELECT wa_job_id FROM tk_send_wa2 WHERE wa_job_id='".$arrJb['j_id']."' ";
$resultWa = $conDB->query($queryWa);
if ($resultWa->num_rows > 0) {
	$rowWa = $resultWa->fetch_assoc();
	$checkOnOff = 'checked="checked"';
}else{
	$checkOnOff = '';
}

$logParent = 'false';
$queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$arrJb['j_telephone']."' ";
$resultLogWa = $conDB->query($queryLogWa);
if ($resultLogWa->num_rows > 0) {
    $logParent = 'true';
    $rowLogWa = $resultLogWa->fetch_assoc();
    if( $rowLogWa['wa_note'] == 'Yes' ){
        $welcomeWa = 'TRUE';
    }else{
        $welcomeWa = 'FALSE';
    }
}else{
                                                    
    require_once('classes/whatsapp-api-call.php');
                                            
    $website = "https://wa.tutorkami.my/api-docs/";
    /*
    if( !activeAPI( $website ) ) {
        $welcomeWa = ''; 
    } else {
        $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$arrJb['j_telephone']."' ";
        $resultLogWa2 = $conDB->query($queryLogWa2);
        if ($resultLogWa2->num_rows > 0) {
            $logParent = 'true';
            $rowLogWa2 = $resultLogWa2->fetch_assoc();
            if( $rowLogWa2['wa_note'] == 'Yes' ){
                $welcomeWa = 'TRUE';
            }else{
                $welcomeWa = 'FALSE'; 
            }
        }else{
            $args = new stdClass();
            $xdata = new stdClass();
            $args->contactId = "6".$arrJb['j_telephone']."@c.us";
            $xdata->args = $args;
                                                    	
            $make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
            $response = json_decode($make_call, true);
            $dataPhone     = $response['response']['id'];
                                                    	        
            if( $dataPhone != '' ){
                $logParent = 'true';
                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$arrJb['j_telephone']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                $exeWaNoti = $conDB->query($sqlWaNoti);
                $welcomeWa = 'TRUE';
            }else{
                $welcomeWa = ''; 
            }        
        }
    }
    */
        $queryLogWa2 = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$arrJb['j_telephone']."' ";
        $resultLogWa2 = $conDB->query($queryLogWa2);
        if ($resultLogWa2->num_rows > 0) {
            $logParent = 'true';
            $rowLogWa2 = $resultLogWa2->fetch_assoc();
            if( $rowLogWa2['wa_note'] == 'Yes' ){
                $welcomeWa = 'TRUE';
            }else{
                $welcomeWa = 'FALSE'; 
            }
        }else{
                $logParent = 'true';
                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$arrJb['j_telephone']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                $exeWaNoti = $conDB->query($sqlWaNoti);
                $welcomeWa = 'TRUE';
        }
}

$logTutor = 'false';
$queryLogWaTutor = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$TutorPhone."' ";
$resultLogWaTutor = $conDB->query($queryLogWaTutor);
if ($resultLogWaTutor->num_rows > 0) {
    $logTutor = 'true';
    $rowLogWaTutor = $resultLogWaTutor->fetch_assoc();
    if( $rowLogWaTutor['wa_note'] == 'Yes' ){
        $welcomeWaTutor = 'TRUE';
    }else{
        $welcomeWaTutor = 'FALSE';
    }
}else{
                                                    
    require_once('classes/whatsapp-api-call.php');
                                            
    $website = "https://wa.tutorkami.my/api-docs/";
    /*
    if( !activeAPI( $website ) ) {
        $welcomeWaTutor = ''; 
    } else {
        $queryLogWa2Tutor = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$TutorPhone."' ";
        $resultLogWa2Tutor = $conDB->query($queryLogWa2Tutor);
        if ($resultLogWa2Tutor->num_rows > 0) {
            $logTutor = 'true';
            $rowLogWa2Tutor = $resultLogWa2Tutor->fetch_assoc();
            if( $rowLogWa2Tutor['wa_note'] == 'Yes' ){
                $welcomeWaTutor = 'TRUE';
            }else{
                $welcomeWaTutor = 'FALSE'; 
            }
        }else{
            $args = new stdClass();
            $xdata = new stdClass();
            $args->contactId = "6".$TutorPhone."@c.us";
            $xdata->args = $args;
                                                    	
            $make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
            $response = json_decode($make_call, true);
            $dataPhone     = $response['response']['id'];
                                                    	        
            if( $dataPhone != '' ){
                $logTutor = 'true';
                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$TutorPhone."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                $exeWaNoti = $conDB->query($sqlWaNoti);
                $welcomeWaTutor = 'TRUE';
            }else{
                $welcomeWaTutor = ''; 
            }        
        }
    }
    */
        $queryLogWa2Tutor = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$TutorPhone."' ";
        $resultLogWa2Tutor = $conDB->query($queryLogWa2Tutor);
        if ($resultLogWa2Tutor->num_rows > 0) {
            $logTutor = 'true';
            $rowLogWa2Tutor = $resultLogWa2Tutor->fetch_assoc();
            if( $rowLogWa2Tutor['wa_note'] == 'Yes' ){
                $welcomeWaTutor = 'TRUE';
            }else{
                $welcomeWaTutor = 'FALSE'; 
            }
        }else{
                $logTutor = 'true';
                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$TutorPhone."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                $exeWaNoti = $conDB->query($sqlWaNoti);
                $welcomeWaTutor = 'TRUE';
        }
}

//$dbCon->close();
?>

<!-- Button trigger modal -->
<?PHP 
if( isset($_SESSION["tempCreateClasses"]) && $_SESSION["tempCreateClasses"] != '' ){
    if( isset($_SESSION["JHired"]) && $_SESSION["JHired"] != '' ){
        echo "<script>$(document).ready(function(){ $('#ModalCreateClass').modal('show'); });</script>";
    }
}
?>
<div class="modal fade" id="tempModalExample" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        
      <div class="hidden modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body" id="tempModalExampleBody" ></div>
      <div class="hidden modal-footer" id="tempModalExampleFooter"></div>
      
    </div>
  </div>
</div>

<button type="button" class=" hidden btn btn-primary" data-toggle="modal" data-target="#ModalCreateClass">
  Test
</button>
<div class="modal fade" id="ModalCreateClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="hidden modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">

          <input type="hidden" name="hideModalJob" id="hideModalJob" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_id'] : ''; ?>"> 
          <input type="hidden" name="hideModalPr" id="hideModalPr" value="<?php echo $queryParentID; ?>"> 
          <input type="hidden" name="hideModalTu" id="hideModalTu" value="<?php echo $queryID; ?>"> 
          <input type="hidden" name="hideModalStu" id="hideModalStu" value="<?php echo $arrJb['student_name']; ?>"> 
          <input type="hidden" name="hideModalSubj" id="hideModalSubj" value="<?php echo $arrJbt['jt_subject']; ?>"> 
          <input type="hidden" name="hideModalRate" id="hideModalRate" value="<?php echo $arrJb['j_rate']; ?>"> 
          <input type="hidden" name="hideModalPrRate" id="hideModalPrRate" value="<?php echo $arrJb['parent_rate']; ?>"> 
          <input type="hidden" name="hideModalCycle" id="hideModalCycle" value="<?php echo $arrJb['cycle']; ?>"> 
  
        <center>
            <p>Do you want to create a Class?</p><br>
            <?PHP
                if( isset($_SESSION["tempCreateClasses"]) && $_SESSION["tempCreateClasses"] != '' ){
                    if( $_SESSION["tempCreateClasses"] == 'Save' ){
                        ?><button type="button" class="btn btn-primary" onclick="createClassesHome()" >Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="noClassesHome()">No</button>
                        <?PHP
                    }else{
                        ?><button type="button" class="btn btn-primary" onclick="createClasses()" >Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="noClasses()">No</button>
                        <?PHP
                    }
                }
            ?>
        </center>
      </div>
      
      <div class="hidden modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tempModal" tabindex="-1" role="dialog" aria-labelledby="tempModallLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
      <div class="modal-header hidden" id="tempModalHeader">
      </div>
      <div class="modal-body" id="tempModalBody">
        <center> 
            <div class="spinner hidden"><font style="font-size:14px;color:#900C3F"><b>Loading...</b></font><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div><br/>
            
            <button id="btnInv" onclick="runBtn('Invoice')" type="button" class="btn btn-primary"> Invoice</button> 
            <button id="btnTri" onclick="runBtn('Trial')"   type="button" class="btn btn-secondary"> Trial</button> 
            <br/><br/> 
        </center>
        <input type="hidden" id="hideModalPopup" value="<?PHP echo $arrJb['cycle']; ?>">
        <input type="hidden" id="hideModalType" value="Invoice">
        <input type="hidden" id="hideModalJobID" value="<?PHP echo $arrJb['j_id']; ?>">
        
                <span id="detailsInvoice">

                    <div class="row" style="margin-left:30%;">
                      <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Hours </font></div>
                      <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div>
                      <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="dropHours"><?PHP echo $arrJb['cycle']; ?></font></div>
                    </div><br/>

                    <div class="row" style="margin-left:30%;">
                      <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Rate </font></div>
                      <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div>
                      <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpRate">RM <?PHP echo $arrJb['parent_rate']; ?></font></div>
                    </div><br/>
                    
                    <div class="row" style="margin-left:30%;">
                      <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >R.F </font></div>
                      <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div>
                      <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpRF">RM <?PHP echo $arrJb['rf']; ?></font></div>
                    </div><br/>
                    
                    <div class="row" style="margin-left:30%;">
                      <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Total </font></div>
                      <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div>
                      <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpTotal">
                          <?PHP
                            if( $arrJb['parent_rate'] != '' && $arrJb['cycle'] != ''){
                                if( $arrJb['rf'] != '' ){
                                    $twoPlacedFloat = (($arrJb['parent_rate'] * $arrJb['cycle']) + $arrJb['rf']);
                                    echo 'RM '.number_format((float)$twoPlacedFloat, 2, '.', ''); 
                                }else{
                                    $twoPlacedFloat = ($arrJb['parent_rate'] * $arrJb['cycle']);
                                    echo 'RM '.number_format((float)$twoPlacedFloat, 2, '.', ''); 
                                }
                            }
                          ?>
                      </font></div>
                    </div>

                </span>

                <br/><br/>
        
        <center>
            <b id="detailsInfo" > Confirm to send invoice to client? </b> 
            <br/><br/> 
            <button onclick="runPopUp()" type="button" class="btn btn-primary"> Yes</button> 
            <button data-dismiss="modal" type="button" class="btn btn-secondary"> No</button> 
        </center>
          
      </div>
      <div class="modal-footer hidden" id="tempModalFooter"></div>
      
    </div>
  </div>
</div>

<input type="hidden" name="dumyText" id="dumyText" />
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
                                    if (preg_match('~[0-9]+~', $arrJb['send_rate'])) {
                                        $className = 'btn-hijau';
                                    }else{
                                        $className = 'btn-warning';
                                    }
                                    
								   ?>

  <div class="btn-group">
	  <button class="btn <?PHP echo $className; ?> sign-btn-box mrg-right-15 dropdown-toggle" type="button" data-toggle="dropdown">Sent ( <?PHP echo $words = preg_replace('/[0-9]+/', '', strtoupper($arrJb['send_rate'])); //echo strtoupper($arrJb['send_rate']) ?> ) <span class="caret"></span></button>
	  <ul class="dropdown-menu">
		  <!--<li onclick="getLink(this.id, 'https://www.tutorkami.com/my/parent_review?step=1&tutor_id=<?php //echo $queryID;?>&parent_id=<?php //echo $queryParentID;?>&job_id=<?php //echo $arrJb['j_id'];?>')" id="bm"><a>BM</a></li>
		  <li onclick="getLink(this.id, 'https://www.tutorkami.com/parent_review?step=1&tutor_id=<?php //echo $queryID;?>&parent_id=<?php //echo $queryParentID;?>&job_id=<?php //echo $arrJb['j_id'];?>')" id="bi"><a>English</a></li>-->
		  
		  <li onclick="getLink(this.id, 'https://www.tutorkami.com/my/client_review?/<?php echo $arrJb['j_id'];?>/<?php echo $pvName;?>')" id="bm"><a>BM</a></li>
		  <li onclick="getLink(this.id, 'https://www.tutorkami.com/client_review?/<?php echo $arrJb['j_id'];?>/<?php echo $pvName;?>')" id="bi"><a>English</a></li>
		  <?PHP
		  $queryReview = " SELECT * FROM tk_review_rating WHERE rr_job = '".$arrJb['j_id']."' "; 
		  $resultReview = $conDB->query($queryReview); 
		  if($resultReview->num_rows > 0){
		    $rowReview = $resultReview->fetch_assoc();
		    if( $rowReview['rr_status'] == 'approved' ){
		        $reviewLink = 'https://www.tutorkami.com/admin/review-rating-approved?rr='.$rowReview['rr_id'];
		        ?><li><a href="<?PHP echo $reviewLink; ?>" target="_blank" >Review</a></li><?PHP
		    }else if( $rowReview['rr_status'] == 'not approved' ){
		        $reviewLink = 'https://www.tutorkami.com/admin/review-rating-pending?rr='.$rowReview['rr_id'];
		        ?><li><a href="<?PHP echo $reviewLink; ?>" target="_blank" >Review</a></li><?PHP
		    }else{
		        $reviewLink = 'https://www.tutorkami.com/admin/review-rating-list?rr='.$rowReview['rr_id'];
		        ?><li><a href="<?PHP echo $reviewLink; ?>" target="_blank" >Review</a></li><?PHP
		    }
		  }
		  ?>
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


						   
						   
						   
						   <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit" onclick="btnCreateClasses('Save')" >Save</button>
                           <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit" onclick="btnCreateClasses('S&CE')" >S&CE </button>
                           <?php if(isset($_REQUEST['j'])) { ?>
                           <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15 hidden" type="button" title="Delete" onClick="if(confirm('Are you sure, you want to remove the job?'))document.location.href='job-edit.php?action=delete_job&j_id=<?php echo $arrJb['j_id'];?>'">Delete</button>
                           <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" title="Post WA" onClick="PostWA('<?php echo $arrJb['j_id']; ?>')">Post WA</button>

                           <?PHP /*
                           function hasWord($word, $txt) {
                                $patt = "/(?:^|[^a-zA-Z])" . preg_quote($word, '/') . "(?:$|[^a-zA-Z])/i";
                                return preg_match($patt, $txt);
                           }
                           if ( hasWord('ONLINE', $arrJbt['jt_subject']) ) {
                               $CopyText = "*Job ".$arrJb['j_id']." :* \r\n".ucwords($arrJbt['jt_subject'])." & ".ucwords($rowGetJob['jlt_title'])."\r\n".$waRate."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                           }else{
                               $CopyText = "*Job ".$arrJb['j_id']." :* \r\n".ucwords($arrJbt['jt_subject'])." in ".ucwords($data['j_area']).", ".ucwords($thisCity).". \r\n".$waRate."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                           }*/
                           ?> <!--
                           <div class="btn-group">
                        	  <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15 dropdown-toggle" type="button" data-toggle="dropdown">Post WA <span class="caret"></span></button>
                        	  <ul class="dropdown-menu">
                        		  <li onClick="PostWA('<?php //echo $arrJb['j_id']; ?>')" ><a>Auto</a></li>
                        		  <li onClick="PostWACopy('<?php //echo $CopyText; ?>')" ><a>Copy Text</a></li>
                        	  </ul>
                           </div>-->

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
                                //echo '<p>'.$arrJb['j_id'].' <label class="label label-primary"><a href="classes-add?cl='.$jobRowEm['cl_id'].'" target="_blank" title="ID: '.$jobRowEm['cl_id'].'" style="color:#FFF; text-decoration: none;">View Class</a></label></p>';
                                echo '<p>'.$arrJb['j_id'].' <label class="label label-primary"><a href="classes-add?cl='.$arrJb['j_id'].'" target="_blank" title="ID: '.$jobRowEm['cl_id'].'" style="color:#FFF; text-decoration: none;">View Class</a></label></p>';
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

						


<?PHP
if($_SESSION[DB_PREFIX]['u_first_name'] == 'Mohd Nurfadhli'){
}
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
function SendWhatsApp2() {
	var x = document.getElementById("sendWA2").checked;
	var j_id = document.getElementById("j_id").value;
	var queryParentID = document.getElementById("queryTutorID").value;
    //alert(x + ' ' + j_id + ' ' + queryParentID);
		$.ajax({
			url: "send-waTutor.php",
            method: "POST",
			data: {j_id: j_id, queryParentID: queryParentID, value: x}, 
            success: function(result){
				if(result = 'success'){
				}else{
					alert(result);
				}
            }
		});
}
function SendWhatsApp() {
    
    var JobStage  = document.getElementById("hiddenStage").value;
    var showLabel = document.getElementById("hiddenShow").value;
    
	var x = document.getElementById("sendWA").checked;
	var j_id = document.getElementById("j_id").value;
	var queryParentID = document.getElementById("queryParentID").value;
	//alert(x);    
	
	if(x == true){
	    document.getElementById("setupForm").classList.remove("hidden");
	    $('#shortlistedData').load('shortlisted-data.php?requiredid='+j_id);
	    $('#tutorApplying').load('tutor-applying.php?requiredid='+j_id);
	}else{
	    document.getElementById("setupForm").classList.add("hidden");
	    $('#shortlistedData').load('shortlisted-data.php?requiredid='+j_id);
	    $('#tutorApplying').load('tutor-applying.php?requiredid='+j_id);
	    $('#setupDateInput').prop('required',false);
	}

    if( JobStage == 'class reminder' ){
        if( showLabel == 'Show' ){
    		$.ajax({
    			url: "send-wa.php",
                method: "POST",
    			data: {j_id: j_id, queryParentID: queryParentID, value: x}, 
                success: function(result){
    				if(result = 'success'){
    					//alert(result);
    					if(x == true){
    						document.getElementById("infoClass").innerHTML = "<small>Class reminder will be sent 1 day <br/>before the deadline. <br/>So make sure you set it correctly.</small>";
    						var rating = document.getElementById("changeRating").value;
    						$.ajax({
    							url: "ajax/load-rating.php",
    							method: "POST",
    							data: {action: 'getRate', rating: rating}, 
    							success: function(result){
    								$('#showRating').html(result);
    								document.getElementById("tempshowRating").classList.add("hidden");
    								document.getElementById("showRating").classList.remove("hidden");
    
    							}
    						});
    						document.getElementById("ratingField").classList.remove("hidden");
    					}else{
    					    document.getElementById("infoClass").innerHTML = "";
    						document.getElementById("ratingField").classList.add("hidden");
    					}
    				}else{
    					alert(result);
    				}
                }
    		});    
        }else{
            setTimeout(function() { 
                var x = document.getElementById("sendWA").checked = false;
        		$.ajax({
        			url: "send-wa.php",
                    method: "POST",
        			data: {j_id: j_id, queryParentID: queryParentID, value: x}, 
                    success: function(result){
        				if(result = 'success'){
        					//alert(result);
        					if(x == true){
        					    document.getElementById("infoClass").innerHTML = "<small>Class reminder will be sent 1 day <br/>before the deadline. <br/>So make sure you set it correctly.</small>";
        						var rating = document.getElementById("changeRating").value;
        						$.ajax({
        							url: "ajax/load-rating.php",
        							method: "POST",
        							data: {action: 'getRate', rating: rating}, 
        							success: function(result){
        								$('#showRating').html(result);
        								document.getElementById("tempshowRating").classList.add("hidden");
        								document.getElementById("showRating").classList.remove("hidden");
        
        							}
        						});
        						document.getElementById("ratingField").classList.remove("hidden");
        					}else{
        						document.getElementById("infoClass").innerHTML = "";
        						document.getElementById("ratingField").classList.add("hidden");
        					}
        				}else{
        					alert(result);
        				}
                    }
        		}); 
            }, 500);            
        }
    }else{
		$.ajax({
			url: "send-wa.php",
            method: "POST",
			data: {j_id: j_id, queryParentID: queryParentID, value: x}, 
            success: function(result){
				if(result = 'success'){
					//alert(result);
					if(x == true){
					    document.getElementById("infoClass").innerHTML = "";
					    if( JobStage == 'End cycle' ){
					        document.getElementById("infoEndCycle").innerHTML = "<small>End cycle reminder will be sent <br/>2 days before the deadline. <br/>So make sure you set it correctly</small>";
					    }
					    if( JobStage == 'payment reminder' ){
					        document.getElementById("infoPaymentReminder").innerHTML = "<small>Payment reminder will be sent <br/>5 & 3 days before the deadline. <br/>Make sure you set it correctly.</small>";
					    }
						var rating = document.getElementById("changeRating").value;
						$.ajax({
							url: "ajax/load-rating.php",
							method: "POST",
							data: {action: 'getRate', rating: rating}, 
							success: function(result){
								$('#showRating').html(result);
								document.getElementById("tempshowRating").classList.add("hidden");
								document.getElementById("showRating").classList.remove("hidden");

							}
						});
						document.getElementById("ratingField").classList.remove("hidden");
					}else{
						document.getElementById("infoClass").innerHTML = "";
						if( JobStage == 'End cycle' ){
						    document.getElementById("infoEndCycle").innerHTML = "";
						}
						if( JobStage == 'payment reminder' ){
					        document.getElementById("infoPaymentReminder").innerHTML = "";
					    }
						document.getElementById("ratingField").classList.add("hidden");
					}
				}else{
					alert(result);
				}
            }
		});        
    }
    
    


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


                        <div class="form-group" <?PHP echo $marginLeft;?> >
                            <label class="col-xs-3 control-label">City :</label>
                            <div class="col-xs-3">
                  
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
                            <div class="col-xs-4">
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
                                            } ?><option value="1384" <?php if( '1384' == $rowUser['city']){echo 'selected';}?> >Online Tuition</option><?php
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
                        <!--<div class="form-group">
                           <label class="col-lg-3 control-label" >Telephone :</label>
                           <div class="col-lg-7"><input type="text" class="form-control" name="j_telephone" id="j_telephone" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['j_telephone'] : ''; ?>" required> 
                           </div>
                        </div>-->
                        
                        
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Telephone :</label>
                                 <div class="col-sm-3">
                                    <input type="text" class="form-control" name="j_telephone" id="j_telephone" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_telephone'] : ''; ?>" required> 
								 </div>
                                 <label class="col-sm-2 control-label" style="<?PHP echo $telStyle; ?>" >Alt Tel :</label>
                                 <div class="col-sm-3">
                                        <input type="text" class="form-control" name="j_telephone_alt" id="j_telephone_alt" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_telephone_alt'] : ''; ?>" >
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
                              <select class="form-control" name="j_payment_status" onChange="getPayment(this.value);" required>
                                 <option value='pending' <?php if(isset($_REQUEST['j'])) echo $arrJb['j_payment_status']=="pending"?'selected':''?>>Unpaid</option>
                                 <option value='paid' <?php if(isset($_REQUEST['j'])) echo $arrJb['j_payment_status']=="paid"?'selected':''?>>Paid</option>
                              </select>
                           </div>
                        </div>
                        <!--<div class="form-group" id="date_deadline" <?PHP //echo $marginLeft;?> >
                           <label class="col-xs-3 control-label">Deadline :</label>
                           <div class="col-xs-3">
                              <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="j_deadline" value="<?php 
/*
if(isset($_REQUEST['j'])){
	if($arrJb["j_deadline"] =='0000-00-00' || $arrJb["j_deadline"] ==''){
		echo '';
	}else{
		echo date("d-m-Y", strtotime($arrJb['j_deadline']));
	}
}
*/
								 ?>" />
							 
                              </div>
                           </div>
                            <?PHP
                            if( isset($_REQUEST['j']) && ($arrJb['j_payment_status'] == "paid") ){
                                $hidenBilled = 'hidden';
                            }else{
                                $hidenBilled = 'hidden';
                            }
                            ?>
                            <span id="removeThis" class="<?PHP //echo $hidenBilled; ?>">
                               <label class="col-xs-3 control-label" >Parent Billed:</label>
                               <div class="col-xs-2" >
                                  <div class="input-group" style="margin-top:5px;">
                                     <input type="checkbox" class="form-check-input" name="billed" id="billed" <?php //if ( isset($_REQUEST['j']) && $arrJb['parent_billed'] == 'on') { echo "checked='checked'"; } ?> >
                                  </div>
                               </div>
                            <span>  
                        </div>-->
                        
<!-- START Reminder -->


						<div class="form-group">
                           <label class="col-sm-3 control-label">
							<?PHP
							$thisStage = '';
							if( $arrJb['j_status'] == 'open' && $arrJb['j_payment_status'] =='pending' ){
								echo 'Auto send profile :';
								$thisToolTip = '<a style="margin-left:-15px;" class="pull-right" href="https://docs.google.com/document/d/1cSUndgBFyNYu1KDMIImlV8b5weD_UQwOxYAKz4sNcGs/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262;font-size: 15px;" ></i></a>';
							
								echo '<input type="hidden" id="hiddenStage" value="send profile" />';
								if( $logParent == 'true' && $logTutor == 'true' ){
								    echo '<input type="hidden" id="hiddenShow" value="Show" />';
								}else{
								    echo '<input type="hidden" id="hiddenShow" value="" />';
								}
								$thisStage = 'send profile';
								
								$popoverTitle = 'Profile Log';
								$whatIWant = '';
                                $historyWa = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = 'Apply Job' ORDER BY wa_id ASC ";
                                $resulthistoryWa = $conDB->query($historyWa);
                                if ($resulthistoryWa->num_rows > 0) {
                                	while($rowhistoryWa = $resulthistoryWa->fetch_assoc()){
                                		if( $rowhistoryWa['wa_status'] == 'POST' ){
                                			//$textColor = '<b><span class=text-success>Success</span></b><br/>';
                                            if (strpos($rowhistoryWa['wa_note'], 'Sent Successfully') !== false) {
                                                $textColor = '<b><span class=text-success>Success</span></b><br/>';
                                            }else{
                                                $textColor = '<b><span class=text-danger>Fail</span></b><br/>';
                                            }
                                		}else{
                                			$textColor = '<b><span class=text-danger>Fail</span></b><br/>';
                                		}
                                		
                                		$originalDate = $rowhistoryWa['wa_date'];
                                		$newDate = date("d/m/Y H:i:s", strtotime($originalDate));

                                		$whatIWant.= ' <font color=#13004d><b>'.$newDate.'</b></font> '.substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , "- ") + 1).' '.$textColor; 
                                	}
                                    
                                }
							    
							}
							/*else if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] =='pending' && ($arrJb['j_start_date'] == '' || $arrJb['j_start_date'] == '0000-00-00' || $arrJb['j_start_date'] == NULL ) ){
							    echo 'Auto send first class :';
							}*/
							
							else if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] =='pending' ){
								echo 'Auto send class reminder :';
								$thisToolTip = '<a style="margin-left:-15px;" class="pull-right" href="https://docs.google.com/document/d/1wWgf5BEK4wiicWdroqlmnT5rjAnm8FjkLmHKxUWcEm8/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#FFBE33;font-size: 15px;" ></i></a>';

								echo '<input type="hidden" id="hiddenStage" value="class reminder" />';
								if( $logParent == 'true' && $logTutor == 'true' ){
								    echo '<input type="hidden" id="hiddenShow" value="Show" />';
								}else{
								    echo '<input type="hidden" id="hiddenShow" value="" />';
								}
								$thisStage = 'class reminder';
								
								$popoverTitle = 'Class Log';
								$whatIWant = '';
                                $historyWa = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = 'Class Reminder' ORDER BY wa_id ASC ";
                                $resulthistoryWa = $conDB->query($historyWa);
                                if ($resulthistoryWa->num_rows > 0) {
                                	while($rowhistoryWa = $resulthistoryWa->fetch_assoc()){
                                		if( $rowhistoryWa['wa_status'] == 'POST' ){
                                			//$textColor = '<b><span class=text-success>Success</span></b><br/>';
                                            if (strpos($rowhistoryWa['wa_note'], 'Sent Successfully') !== false) {
                                                $textColor = '<b><span class=text-success>Success</span></b><br/>';
                                            }else{
                                                $textColor = '<b><span class=text-danger>Fail</span></b><br/>';
                                            }
                                		}else{
                                			$textColor = '<b><span class=text-danger>Fail</span></b><br/>';
                                		}
                                		
                                		$originalDate = $rowhistoryWa['wa_date'];
                                		$newDate = date("d/m/Y H:i:s", strtotime($originalDate));
                                		
                                		$idTutor = trim(substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , ": ") + 1));
                                		
                                		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
                                		$resultGetEmail = $conDB->query($GetEmail);
                                		if ($resultGetEmail->num_rows > 0) {
                                		    $rowGetEmail = $resultGetEmail->fetch_assoc();
                                		    $idTutor = $rowGetEmail['u_email'];
                                		}
                                		$whatIWant.= ' <font color=#13004d><b>'.$newDate.'</b></font> '.$idTutor.' '.$textColor; 

                                	}
                                    
                                }
							    
							}else if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] =='paid' ){
							    

                                $LinkKelas = " SELECT * FROM tk_classes_record INNER JOIN tk_classes ON cl_id = cr_cl_id WHERE cl_display_id = '".$arrJb['j_id']."' AND current_cycle NOT LIKE '%temp%' ORDER BY cr_date DESC, cr_start_time DESC ";
                                $resLinkKelas = $conDB->query($LinkKelas);
                                if ($resLinkKelas->num_rows > 0) {
                                    $roLinkKelas = $resLinkKelas->fetch_assoc();
                                    if( $roLinkKelas['cr_status'] =='Tutor Paid'  ){
                                        
                                        echo 'End cycle reminder :';
                                        if( $welcomeWaTutor == 'TRUE' ){
                                            $thisToolTip = '<a style="margin-left:-15px;" class="pull-right" href="https://docs.google.com/document/d/14DjUxNa7j1KrdzCWK5-86_bPMBHa6Ud8VBEGd8Wuaig/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#26D367;font-size: 15px;" ></i></a>';
                                        }else if( $welcomeWaTutor == 'FALSE' ){
                                            $thisToolTip = '<a style="margin-left:-15px;" class="pull-right" href="https://docs.google.com/document/d/14DjUxNa7j1KrdzCWK5-86_bPMBHa6Ud8VBEGd8Wuaig/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#DC3545;font-size: 15px;" ></i></a>';
                                        }else{
                                            $thisToolTip = '<a style="margin-left:-15px;" class="pull-right" href="https://docs.google.com/document/d/14DjUxNa7j1KrdzCWK5-86_bPMBHa6Ud8VBEGd8Wuaig/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:black;font-size: 15px;" ></i></a>';
                                        }
                                        
        								echo '<input type="hidden" id="hiddenStage" value="End cycle" />';
        								if( $logParent == 'true' && $logTutor == 'true' ){
        								    echo '<input type="hidden" id="hiddenShow" value="Show" />';
        								}else{
        								    echo '<input type="hidden" id="hiddenShow" value="" />';
        								}
                                        $thisStage = 'End cycle';
                                        
                                        $popoverTitle = 'End Cycle Reminder Log';
                                        $historyWaCycle = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = 'Cycle Reminder' ORDER BY wa_id ASC ";
                                        $resulthistoryWaCycle = $conDB->query($historyWaCycle);
                                        if ($resulthistoryWaCycle->num_rows > 0) {
                                            while($rowhistoryWaCycle = $resulthistoryWaCycle->fetch_assoc()){
                                                if( $rowhistoryWaCycle['wa_status'] == 'POST' ){
                                                    //$textColorCycle = '<b><span class=text-success>Success</span></b><br/>';
                                                    if (strpos($rowhistoryWaCycle['wa_note'], 'Sent Successfully') !== false) {
                                                        $textColorCycle = '<b><span class=text-success>Success</span></b><br/>';
                                                    }else{
                                                        $textColorCycle = '<b><span class=text-danger>Fail</span></b><br/>';
                                                    }
                                                }else{
                                                    $textColorCycle = '<b><span class=text-danger>Fail</span></b><br/>';
                                                }
                                            		
                                                $originalDateCycle = $rowhistoryWaCycle['wa_date'];
                                                $newDateCycle = date("d/m/Y H:i:s", strtotime($originalDateCycle));
                                            		
                                                $idTutorCycle = trim(substr($rowhistoryWaCycle['wa_user'] , strpos($rowhistoryWaCycle['wa_user'] , ": ") + 1));
                                            		
                                                $GetEmailCycle = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutorCycle."'  ";
                                                $resultGetEmailCycle = $conDB->query($GetEmailCycle);
                                                if ($resultGetEmailCycle->num_rows > 0) {
                                                    $rowGetEmailCycle = $resultGetEmailCycle->fetch_assoc();
                                                    $idTutorCycle = $rowGetEmailCycle['u_email'];
                                                }

                                            $whatIWant.= ' <font color=#13004d><b>'.$newDateCycle.'</b></font> '.$idTutorCycle.' '.$textColorCycle; 
                                            }
                                        }
                                    }else{
        								echo 'Auto send payment reminder :';
        								$thisToolTip = '<a style="margin-left:-15px;" class="pull-right" href="https://docs.google.com/document/d/1hozOgmGaw6uV3Aeq95y9as1ZSlY8LuRy0WNCZIMI3OI/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#458540;font-size: 15px;" ></i></a>';
        							
        								echo '<input type="hidden" id="hiddenStage" value="payment reminder" />';
        								if( $logParent == 'true' && $logTutor == 'true' ){
        								    echo '<input type="hidden" id="hiddenShow" value="Show" />';
        								}else{
        								    echo '<input type="hidden" id="hiddenShow" value="" />';
        								}
        								$thisStage = 'payment reminder';
        								
        								$popoverTitle = 'Payment Log';
                                        $text1stReminder = '';
                                        $text2stReminder = '';
                                        $historyWa1st = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = '1st Payment Reminder' ORDER BY wa_id ASC ";
                                        $resulthistoryWa1st = $conDB->query($historyWa1st);
                                        if ($resulthistoryWa1st->num_rows > 0) {
                                            $text1stReminder = '<b><span class=text-info>1st Reminder</span></b><br/>';
                                        	while($rowhistoryWa1st = $resulthistoryWa1st->fetch_assoc()){
                                        		if( $rowhistoryWa1st['wa_status'] == 'POST' ){
                                        			//$textColor1st = '<b><span class=text-success>Success</span></b><br/>';
                                                    if (strpos($rowhistoryWa1st['wa_note'], 'Sent Successfully') !== false) {
                                                        $textColor1st = '<b><span class=text-success>Success</span></b><br/>';
                                                    }else{
                                                        $textColor1st = '<b><span class=text-danger>Fail</span></b><br/>';
                                                    }
                                        		}else{
                                        			$textColor1st = '<b><span class=text-danger>Fail</span></b><br/>';
                                        		}
                                        
                                        		$originalDate1stReminder = $rowhistoryWa1st['wa_date'];
                                        		$newDate1stReminder = date("d/m/Y H:i:s", strtotime($originalDate1stReminder));
                                        		
                                        		$idTutor = trim(substr($rowhistoryWa1st['wa_user'] , strpos($rowhistoryWa1st['wa_user'] , ": ") + 1));
                                        		
                                        		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
                                        		$resultGetEmail = $conDB->query($GetEmail);
                                        		if ($resultGetEmail->num_rows > 0) {
                                        		    $rowGetEmail = $resultGetEmail->fetch_assoc();
                                        		    $idTutor = $rowGetEmail['u_email'];
                                        		}
                                        		
                                        		$whatIWant1st.= ' <font color=#13004d><b>'.$newDate1stReminder.'</b></font> '.$idTutor.' '.$textColor1st; 
                                        
                                        	}
                                            
                                        }
                                        
                                        
                                        $historyWa2st = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = '2nd Payment Reminder' ORDER BY wa_id ASC ";
                                        $resulthistoryWa2st = $conDB->query($historyWa2st);
                                        if ($resulthistoryWa2st->num_rows > 0) {
                                            $text2stReminder = '<b><span class=text-info>2nd Reminder</span></b><br/>';
                                        	while($rowhistoryWa2st = $resulthistoryWa2st->fetch_assoc()){
                                        		if( $rowhistoryWa2st['wa_status'] == 'POST' ){
                                        			//$textColor2st = '<b><span class=text-success>Success</span></b><br/>';
                                                    if (strpos($rowhistoryWa2st['wa_note'], 'Sent Successfully') !== false) {
                                                        $textColor2st = '<b><span class=text-success>Success</span></b><br/>';
                                                    }else{
                                                        $textColor2st = '<b><span class=text-danger>Fail</span></b><br/>';
                                                    }
                                        		}else{
                                        			$textColor2st = '<b><span class=text-danger>Fail</span></b><br/>';
                                        		}
                                        
                                        		$originalDateWa2st = $rowhistoryWa2st['wa_date'];
                                        		$newDateWa2st = date("d/m/Y H:i:s", strtotime($originalDateWa2st));
                                        		
                                        		$idTutor = trim(substr($rowhistoryWa2st['wa_user'] , strpos($rowhistoryWa2st['wa_user'] , ": ") + 1));
                                        		
                                        		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
                                        		$resultGetEmail = $conDB->query($GetEmail);
                                        		if ($resultGetEmail->num_rows > 0) {
                                        		    $rowGetEmail = $resultGetEmail->fetch_assoc();
                                        		    $idTutor = $rowGetEmail['u_email'];
                                        		}
                                        		
                                        		$whatIWant2st.= ' <font color=#13004d><b>'.$newDateWa2st.'</b></font> '.$idTutor.' '.$textColor2st; 
                                        	}
                                            
                                        }
                                        $whatIWant = $text1stReminder.' '.$whatIWant1st.' '.$text2stReminder.' '.$whatIWant2st;
                                    }
                                }else{
        								echo 'Auto send payment reminder :';
        								$thisToolTip = '<a style="margin-left:-15px;" class="pull-right" href="https://docs.google.com/document/d/1hozOgmGaw6uV3Aeq95y9as1ZSlY8LuRy0WNCZIMI3OI/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#458540;font-size: 15px;" ></i></a>';
        							
        								echo '<input type="hidden" id="hiddenStage" value="payment reminder" />';
        								if( $logParent == 'true' && $logTutor == 'true' ){
        								    echo '<input type="hidden" id="hiddenShow" value="Show" />';
        								}else{
        								    echo '<input type="hidden" id="hiddenShow" value="" />';
        								}
        								$thisStage = 'payment reminder';
        								
        								$popoverTitle = 'Payment Log';
                                        $text1stReminder = '';
                                        $text2stReminder = '';
                                        $historyWa1st = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = '1st Payment Reminder' ORDER BY wa_id ASC ";
                                        $resulthistoryWa1st = $conDB->query($historyWa1st);
                                        if ($resulthistoryWa1st->num_rows > 0) {
                                            $text1stReminder = '<b><span class=text-info>1st Reminder</span></b><br/>';
                                        	while($rowhistoryWa1st = $resulthistoryWa1st->fetch_assoc()){
                                        		if( $rowhistoryWa1st['wa_status'] == 'POST' ){
                                        			//$textColor1st = '<b><span class=text-success>Success</span></b><br/>';
                                                    if (strpos($rowhistoryWa1st['wa_note'], 'Sent Successfully') !== false) {
                                                        $textColor1st = '<b><span class=text-success>Success</span></b><br/>';
                                                    }else{
                                                        $textColor1st = '<b><span class=text-danger>Fail</span></b><br/>';
                                                    }
                                        		}else{
                                        			$textColor1st = '<b><span class=text-danger>Fail</span></b><br/>';
                                        		}
                                        
                                        		$originalDate1stReminder = $rowhistoryWa1st['wa_date'];
                                        		$newDate1stReminder = date("d/m/Y H:i:s", strtotime($originalDate1stReminder));
                                        		
                                        		$idTutor = trim(substr($rowhistoryWa1st['wa_user'] , strpos($rowhistoryWa1st['wa_user'] , ": ") + 1));
                                        		
                                        		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
                                        		$resultGetEmail = $conDB->query($GetEmail);
                                        		if ($resultGetEmail->num_rows > 0) {
                                        		    $rowGetEmail = $resultGetEmail->fetch_assoc();
                                        		    $idTutor = $rowGetEmail['u_email'];
                                        		}
                                        		
                                        		$whatIWant1st.= ' <font color=#13004d><b>'.$newDate1stReminder.'</b></font> '.$idTutor.' '.$textColor1st; 
                                        
                                        	}
                                            
                                        }
                                        
                                        
                                        $historyWa2st = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = '2nd Payment Reminder' ORDER BY wa_id ASC ";
                                        $resulthistoryWa2st = $conDB->query($historyWa2st);
                                        if ($resulthistoryWa2st->num_rows > 0) {
                                            $text2stReminder = '<b><span class=text-info>2nd Reminder</span></b><br/>';
                                        	while($rowhistoryWa2st = $resulthistoryWa2st->fetch_assoc()){
                                        		if( $rowhistoryWa2st['wa_status'] == 'POST' ){
                                        			//$textColor2st = '<b><span class=text-success>Success</span></b><br/>';
                                                    if (strpos($rowhistoryWa2st['wa_note'], 'Sent Successfully') !== false) {
                                                        $textColor2st = '<b><span class=text-success>Success</span></b><br/>';
                                                    }else{
                                                        $textColor2st = '<b><span class=text-danger>Fail</span></b><br/>';
                                                    }
                                        		}else{
                                        			$textColor2st = '<b><span class=text-danger>Fail</span></b><br/>';
                                        		}
                                        
                                        		$originalDateWa2st = $rowhistoryWa2st['wa_date'];
                                        		$newDateWa2st = date("d/m/Y H:i:s", strtotime($originalDateWa2st));
                                        		
                                        		$idTutor = trim(substr($rowhistoryWa2st['wa_user'] , strpos($rowhistoryWa2st['wa_user'] , ": ") + 1));
                                        		
                                        		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
                                        		$resultGetEmail = $conDB->query($GetEmail);
                                        		if ($resultGetEmail->num_rows > 0) {
                                        		    $rowGetEmail = $resultGetEmail->fetch_assoc();
                                        		    $idTutor = $rowGetEmail['u_email'];
                                        		}
                                        		
                                        		$whatIWant2st.= ' <font color=#13004d><b>'.$newDateWa2st.'</b></font> '.$idTutor.' '.$textColor2st; 
                                        	}
                                            
                                        }
                                        $whatIWant = $text1stReminder.' '.$whatIWant1st.' '.$text2stReminder.' '.$whatIWant2st;
                                }
							    
							    
							}else{
								echo 'Not Set';
							}
							?>
						   </label>

                           <div class="<?PHP echo $thisCol; ?>" id="jumpTO">
                              <div class="input-group">
									<div class="form-inline">&nbsp;&nbsp;
										<div class="form-group">
										<?PHP echo $thisToolTip; ?>
											<input <?PHP echo $checkWa; ?> type="checkbox" class="flipswitch" id="sendWA" name="sendWA" onclick="SendWhatsApp()" /> &nbsp;
											<span></span>					
											<input type="hidden" id="queryParentID" name="queryParentID" value="<?PHP echo $queryParentID; ?>" />
											<?PHP
											    if( $thisStage == 'send profile' ){
											        ?> <a><span class="glyphicon glyphicon-user" style="color:white" ></span></a> <?
											    }else{
											        ?> <a onCLick= "showOtherLog(<?PHP echo $arrJb['j_id']; ?>)" id="popoverData" data-html="true" data-content="<?PHP echo $whatIWant; ?>" rel="popover" title="<?PHP echo $popoverTitle; ?>" data-placement="right" data-trigger="hover"><span class="glyphicon glyphicon-user" style="color:#262262" ></span></a> <?
											    }
											?>
											
										</div>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?PHP
										if( $arrJb['j_status'] == 'open' && $arrJb['j_payment_status'] =='pending' ){
											if( $checkWa != ''){
												?>
												<span id="ratingField">
												<div class="form-group" >
													  <select class="form-control" id="changeRating" name="changeRating">
														<option <?PHP if($arrJb['j_rating'] != '' && $arrJb['j_rating'] =='5'){echo 'selected';}?> value="5">5</option>
														<option <?PHP if($arrJb['j_rating'] != '' && $arrJb['j_rating'] =='4'){echo 'selected';}else if($arrJb['j_rating'] == ''){echo 'selected';}?> value="4">4</option>
														<option <?PHP if($arrJb['j_rating'] != '' && $arrJb['j_rating'] =='3'){echo 'selected';}?> value="3">3</option>
														<option <?PHP if($arrJb['j_rating'] != '' && $arrJb['j_rating'] =='2'){echo 'selected';}?> value="2">2</option>
														<option <?PHP if($arrJb['j_rating'] != '' && $arrJb['j_rating'] =='1'){echo 'selected';}?> value="1">1</option>
													  </select>
												</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="form-group" id="tempshowRating"><input type="text" style="border-color:transparent;outline: none;"/></div>
												<div class="form-group hidden" id="showRating"></div>		
												</span>
												<?PHP	
											}else{	
												?>
												<span class="hidden" id="ratingField">
												<div class="form-group" >
													  <select class="form-control" id="changeRating" name="changeRating">
														<option value="5">5</option>
														<option selected value="4">4</option>
														<option value="3">3</option>
														<option value="2">2</option>
														<option value="1">1</option>
													  </select>
												</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<div class="form-group" id="tempshowRating"><input type="text" style="border-color:transparent;outline: none;"/></div>
												<div class="form-group hidden" id="showRating"></div>		
												</span>
												<?PHP												
											}
										}else{
											?><input type="hidden" id="changeRating" name="changeRating" value="<?PHP echo $arrJb['j_rating']; ?>" /> <?PHP
										}
										
										if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] =='pending' ){
										    if( $checkWa != ''){
										        ?> <div id="infoClass" class="form-group" style="margin-left:15px;" ><small>Class reminder will be sent 1 day <br/>before the deadline. <br/>So make sure you set it correctly.</small></div>  <?PHP											        
										    }else{
										        ?> <div id="infoClass" class="form-group" style="margin-left:15px;" ></div>  <?PHP
										    }
										}else{
										    ?> <div id="infoClass" class="form-group" style="margin-left:15px;" ></div>  <?PHP
										}
										
										if( $thisStage == 'End cycle' ){
										    if( $checkWa != ''){
										        ?> <div id="infoEndCycle" class="form-group" style="margin-left:15px;" ><small>End cycle reminder will be sent <br/>2 days before the deadline. <br/>So make sure you set it correctly</small></div>  <?PHP											        
										    }else{
										        ?> <div id="infoEndCycle" class="form-group" style="margin-left:15px;" ></div>  <?PHP
										    }
										}
										
										if( $thisStage == 'payment reminder' ){
										    if( $checkWa != ''){
										        ?> <div id="infoPaymentReminder" class="form-group" style="margin-left:15px;" ><small>Payment reminder will be sent <br/>5 & 3 days before the deadline. <br/>Make sure you set it correctly.</small></div>  <?PHP											        
										    }else{
										        ?> <div id="infoPaymentReminder" class="form-group" style="margin-left:15px;" ></div>  <?PHP
										    }
										}
										?>

										

									</div>	
                              </div>
                              <div class="form-group pull-right" style="margin-top:-40px;">
								<!-- tutor -->
								<?PHP if( $welcomeWaTutor == 'TRUE' ){ ?>
								<a style="" class="btn btn-WA btn-sm" data-balloon-length="large" aria-label="You can only turn ON the slider when both Tutor & Client are Subscribe" data-balloon-pos="up-right" ><i class="fa fa-whatsapp"></i> Tutor</a>
								<?PHP }else if( $welcomeWaTutor == 'FALSE' ){ ?>
								<a style="" class="btn btn-danger btn-sm" data-balloon-length="large" aria-label="You can only turn ON the slider when both Tutor & Client are Subscribe" data-balloon-pos="up-right" ><i class="fa fa-whatsapp"></i> Tutor</a>
								<?PHP }else{ ?>
								<a style="" class="btn btn-WA-black btn-sm" data-balloon-length="large" aria-label="You can only turn ON the slider when both Tutor & Client are Subscribe" data-balloon-pos="up-right" ><i class="fa fa-whatsapp"></i> Tutor</a>
								<?PHP } ?>
								
								<!-- parent -->
								<?PHP if( $welcomeWa == 'TRUE' ){ ?>
								<a style="" class="btn btn-WA btn-sm" onclick="copyWA('https://www.tutorkami.com/subscribeWA')"><i class="fa fa-whatsapp"></i> Subscribe</a>
								<?PHP }else if( $welcomeWa == 'FALSE' ){ ?>
								<a style="" class="btn btn-danger btn-sm" onclick="copyWA('https://www.tutorkami.com/subscribeWA')"><i class="fa fa-whatsapp"></i> Unsubscribe</a>
								<?PHP }else{ ?>
								<a style="" class="btn btn-WA-black btn-sm" onclick="copyWA('https://www.tutorkami.com/subscribeWA')"><i class="fa fa-whatsapp"></i> Not Subscribe</a>
								<?PHP } ?>
								<!--<span style="margin-left:10px;margin-top:5px;" class="" data-balloon-length="large" aria-label="Click label to copy the link for client to click in order to subscribe to WA auto message. If label shows ‘Not Subscribe’, it means client has not clicked the link. If label show ‘Subscribe’ means client has clicked the link" data-balloon-pos="up-right"><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></span>-->
								<a style="margin-left:10px;margin-top:5px;" href="https://docs.google.com/document/d/1RHSK5idFcRL7N6LQj8mzdT4Xup14nUw-mYwRe8_u0U8/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a>
                              </div>
                              
                              
                              <?PHP
                              /*if( $thisStage == 'class reminder' ){
                                  ?>
                                      <div class="form-group pull-right" style="margin-top:-40px;margin-right:200px;">
        								<?PHP if( $welcomeWaTutor == 'TRUE' ){ ?>
        								<a style="" class="btn btn-WA btn-sm" data-balloon-length="large" aria-label="You can only turn ON the slider when both Tutor & Client are Subscribe" data-balloon-pos="up-right" ><i class="fa fa-whatsapp"></i> Tutor</a>
        								<?PHP }else if( $welcomeWaTutor == 'FALSE' ){ ?>
        								<a style="" class="btn btn-danger btn-sm" data-balloon-length="large" aria-label="You can only turn ON the slider when both Tutor & Client are Subscribe" data-balloon-pos="up-right" ><i class="fa fa-whatsapp"></i> Tutor</a>
        								<?PHP }else{ ?>
        								<a style="" class="btn btn-WA-black btn-sm" data-balloon-length="large" aria-label="You can only turn ON the slider when both Tutor & Client are Subscribe" data-balloon-pos="up-right" ><i class="fa fa-whatsapp"></i> Tutor</a>
        								<?PHP } ?>
                                      </div>                                  
                                  <?PHP
                              }*/
                              ?>

                              
                           </div>
                        </div>

<!-- END Reminder -->                        

						<div class="form-group" id="date_deadline">
                           <label class="col-sm-3 control-label">Deadline :</label>
                           <div class="col-sm-9">
                              <div class="input-group" style="margin-left:-11px;width:76%;">
									<div class="form-inline">&nbsp;&nbsp;
									
                              <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" style="width:100px;" name="j_deadline" value="<?php 
                                if(isset($_REQUEST['j'])){
                                	if($arrJb["j_deadline"] =='0000-00-00' || $arrJb["j_deadline"] ==''){
                                		echo '';
                                	}else{
                                		echo date("d-m-Y", strtotime($arrJb['j_deadline']));
                                	}
                                }
                                ?>" />
                              </div>

                              <span> <font size="2"></font></span><span> <font size="2" class="<?PHP echo $hidenBilled; ?>"><b>&nbsp;&nbsp;Parent Billed :&nbsp;&nbsp;</b></font></span>
                              <input type="checkbox" class="form-check-input <?PHP echo $hidenBilled; ?>" name="billed" id="billed" <?php if ( isset($_REQUEST['j']) && $arrJb['parent_billed'] == 'on') { echo "checked='checked'"; } ?> >


										<!--<div class="form-group pull-right" style="">
    										<?PHP 
    										if( $welcomeWaTutor == 'TRUE' ){
    										    echo '<a style="margin-left:-10px;" class="pull-right" href="https://docs.google.com/document/d/14DjUxNa7j1KrdzCWK5-86_bPMBHa6Ud8VBEGd8Wuaig/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#26D367;font-size: 15px;" ></i></a>';
    										}else if( $welcomeWaTutor == 'FALSE' ){
    										    echo '<a style="margin-left:-10px;" class="pull-right" href="https://docs.google.com/document/d/14DjUxNa7j1KrdzCWK5-86_bPMBHa6Ud8VBEGd8Wuaig/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#DC3545;font-size: 15px;" ></i></a>';
    										}else{
    										    echo '<a style="margin-left:-10px;" class="pull-right" href="https://docs.google.com/document/d/14DjUxNa7j1KrdzCWK5-86_bPMBHa6Ud8VBEGd8Wuaig/edit" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:black;font-size: 15px;" ></i></a>';
    										}
    										?>
											<input  <?PHP echo $checkOnOff; ?> type="checkbox" class="flipswitchOnOff" id="sendWA2" onclick="SendWhatsApp2()" /> &nbsp;
											<span></span>		
											<input type="hidden" id="queryTutorID" name="queryTutorID" value="<?PHP echo $queryID; ?>" />
											
                                            <?PHP
                                            $historyWaCycle = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = 'Cycle Reminder' ORDER BY wa_id ASC ";
                                            $resulthistoryWaCycle = $conDB->query($historyWaCycle);
                                            if ($resulthistoryWaCycle->num_rows > 0) {
                                            	while($rowhistoryWaCycle = $resulthistoryWaCycle->fetch_assoc()){
                                            		if( $rowhistoryWaCycle['wa_status'] == 'POST' ){
                                            			//$textColorCycle = '<b><span class=text-success>Success</span></b><br/>';
                                                        if (strpos($rowhistoryWaCycle['wa_note'], 'Sent Successfully') !== false) {
                                                            $textColorCycle = '<b><span class=text-success>Success</span></b><br/>';
                                                        }else{
                                                            $textColorCycle = '<b><span class=text-danger>Fail</span></b><br/>';
                                                        }
                                            		}else{
                                            			$textColorCycle = '<b><span class=text-danger>Fail</span></b><br/>';
                                            		}
                                            		
                                            		$originalDateCycle = $rowhistoryWaCycle['wa_date'];
                                            		$newDateCycle = date("d/m/Y H:i:s", strtotime($originalDateCycle));
                                            		
                                            		$idTutorCycle = trim(substr($rowhistoryWaCycle['wa_user'] , strpos($rowhistoryWaCycle['wa_user'] , ": ") + 1));
                                            		
                                            		$GetEmailCycle = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutorCycle."'  ";
                                            		$resultGetEmailCycle = $conDB->query($GetEmailCycle);
                                            		if ($resultGetEmailCycle->num_rows > 0) {
                                            		    $rowGetEmailCycle = $resultGetEmailCycle->fetch_assoc();
                                            		    $idTutorCycle = $rowGetEmailCycle['u_email'];
                                            		}
                                            		
                                            		
                                            		$whatIWantCycle.= ' <font color=#13004d><b>'.$newDateCycle.'</b></font> '.$idTutorCycle.' '.$textColorCycle; 
                                            	}
                                                
                                            }
                                            ?>
											<a onClick="showOtherLog()" id="popoverDataCycle" data-html="true" data-content="<?PHP echo $whatIWantCycle; ?>" rel="popover" title="Cycle Log" data-placement="left" data-trigger="hover"><span class="glyphicon glyphicon-user" style="color:#262262" ></span></a>
										</div>-->
										
									</div>	
                              </div>
                           </div>
                        </div>
                        
                        
                        
                        
                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Hired Tutor :</label>
                           <div class="col-lg-5"><input type="text" class="form-control" name="j_hired_tutor_email" id="j_hired_tutor_email" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_hired_tutor_email'] : ''; ?>" />
                           </div>
                           <div class="col-lg-4">
                            <?php 
                            if(isset($_REQUEST['j']) && $arrJb['j_hired_tutor_email'] != '') {
                              //$userRes = $userInit->GetUserJobAddLink('3', $arrJb['j_hired_tutor_email']);
                              $userRes = $userInit->GetUserJobAddLinkNew('3', $arrJb['u_id_tutor']);
                              
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
                        

                        <div class="form-group">
                           <label class="col-sm-3 control-label" >Shortlisted :</label>
                            <div class="col-sm-5">
                                <div id="shortlistedData"></div>
                            </div>
                            <input type="text" name="btnEnterField" id="btnEnterField" class="enableEnter" style="width:80px; outline:none !important; border:1px solid black; color:black; font-weight:bold;" />&nbsp;&nbsp;
                            <img   style="width:30px;cursor: pointer;" src="img/btnEnter.png" id="btnEnter" onclick="onBtnEnterField()"   />
                        </div>
                        
                        <div class="form-group <?PHP echo $setupForm; ?>" style="margin-top:-15px;" id="setupForm">
                            <label class="col-sm-3 control-label">  </label>
                                <div class="col-sm-6" >
                                    <script>
                                    function proceedNotiTerms(ShortlistedID) {
                                        if(ShortlistedID != ''){
                                            $.ajax({
                                                url: "ajax/allinone.php",
                                                method: "POST",
                                                data: {action: 'proceedNotiTerms', ShortlistedID: ShortlistedID}, 
                                                success: function(result){
                                                    var stringB = result.split("-")[0].trim();
                                                    var stringA = result.split("-")[1].trim();

                                                    if( stringB == 'Sent Successfully' ){
                                                        alert(stringA);
                                                        /*
                                                        $.ajax({
                                                            url: "ajax/allinone.php",
                                                            method: "POST",
                                                            data: {action: 'updateProceedNotiTerms', ShortlistedID: ShortlistedID, stringA: stringA}, 
                                                            success: function(result){
                                                                $('#tempModalExample').modal('hide');
                                                                Lobibox.notify('success', {
                                                                        position: 'top right',
                                                                        width: 250, //Any Integer
                                                                        msg  : 'Sent Successfully',
                                                                        size : 'mini',
                                                                });
                                                                //location.reload();
                                                                //window.location.hash = '#jumpTO';
                                                                //window.location.reload(true);
                                                            }
                                                        }); 
                                                        */
                                                    }else{
                                                        //alert('Error : Something Wrong !. Please check wsapme.');
                                                        alert(stringB);
                                                    }
                                                }
                                            });                                            
                                        }else{
                                            alert('Error');
                                        }

                                    }
                                    function notiTerms(ShortlistedID) {
                                        document.getElementById("tempModalExampleBody").innerHTML = ' <input type="hidden" id="tempModalExampleInput" value="'+ShortlistedID+'" /> ' +
                                        ' <center> Do you want to auto send profile to Client? </center><br><br> ' +
                                        ' <center> <button onclick="proceedNotiTerms('+ShortlistedID+')" type="button" class="btn btn-primary">Yes</button> &nbsp;&nbsp; <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> </center> ';
                                        $('#tempModalExample').modal('show');
                                    }
                                    
                                    function handleSetup(val) {
                                        if( val == 'setupTime' ){
                                            if($('#'+val).is(":checked")){
                                                $('#setupDate').attr('checked', false);
                                                $('.dateSetup').datepicker('setDate', null);
                                                document.getElementById('setupDateInput').value = "";
                                                $('#setupDateInput').prop('required',false);
                                            }else{
                                                $('#setupDateInput').prop('required',false);
                                            }
                                        }else{
                                            if($('#'+val).is(":checked")){
                                                $('#setupTime').attr('checked', false);
                                                $('#setupDateInput').prop('required',true);
                                            }else{
                                                $('.dateSetup').datepicker('setDate', null);
                                                document.getElementById('setupDateInput').value = "";
                                                $('#setupDateInput').prop('required',false);
                                            }
                                        }

                                        var setupTime = document.getElementById('setupTime').checked;
                                        var setupDate = document.getElementById('setupDate').checked;
                                        var isChecked = '';   
                                        var setupTimeInput = document.getElementById('setupTimeInput').value;
                                        var setupDateInput = document.getElementById('setupDateInput');
                                        if(setupTime){
                                          isChecked = 'setupTime';
                                          document.getElementById('setupDateInput').value = "";
                                        }
                                        if(setupDate){ 
                                          isChecked = 'setupDate';
                                          setupDateInput.focus();
                                          setupDateInput.select();
                                        }
                                        
                                        if( isChecked == 'setupTime' ){
                                            //alert(setupTimeInput);
                                        }else if( isChecked == 'setupDate' ){
                                            //alert(setupTimeInput + ' ' + setupDateInput.value);
                                        }else{
                                            //alert('tak select');
                                        }
                                       
                                    }
                                    $(document).ready(function(){
                                        $('.timepickeraa').timepicker({
                                            //defaultTime: '02 PM',
                                            dynamic: true,
                                            dropdown: true,
                                            scrollbar: true
                                        });
                                    });
                                    </script>								 
                                    <div class="pull-left checkbox"  style="margin-top:-15px;margin-left:-15px;">
                                        <!-- data-required checked -->
                                        <label style="font-size: 1em"><input onclick='handleSetup(this.id);' type="checkbox" <?php if($arrJb['j_post_date'] != '') {}else{ if($arrJb['j_post_time'] != ''){ echo "checked"; } } ?>  id="setupTime" name="setupTime" value="setupTime"><span class="cr"><i class="cr-icon fa fa-check"></i></span> <input type="text" id="setupTimeInput" name="setupTimeInput" class="timepickeraa" style="width:130px; outline:none !important; border:1px solid black; text-align:center; color:#800080; font-weight:bold;" value="<?php if($arrJb['j_post_time'] != ''){ echo $arrJb['j_post_time']; }else{ echo '02:00 PM'; } ?>" /> </label><br> 
                                    </div>
                                    <div class="pull-left checkbox"  style="margin-top:-15px;" >
                                        <label style="font-size: 1em"><input onclick='handleSetup(this.id);' type="checkbox" <?php if ( isset($_REQUEST['j']) && $arrJb['j_post_date'] != '') { echo "checked"; } ?>                 id="setupDate" name="setupDate" value="setupDate"><span class="cr"><i class="cr-icon fa fa-check"></i></span></label>&nbsp;&nbsp;<br>
                                    </div>
  
                                    <div class="input-group date"  style="margin-top:-8px;">
                                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;<input                    type="text" id="setupDateInput" name="setupDateInput" class="dateSetup" style="width:100px; outline:none !important; border:1px solid black; text-align:center; color:#800080; font-weight:bold;" value="<?php echo isset($_REQUEST['j']) ? $arrJb['j_post_date'] : ''; ?>"  />
                                    </div>
                                </div>
                        </div>
                        

                        <!-- luqman -->
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Tutor's Applying :</label>
                           <div class="col-sm-7">
                                <div id="tutorApplying"></div>
                                  <!--<div class="well">
                                    <?php 
                                    /*if (isset($_GET['j']) && $_GET['j'] != '') {                                    
                                      $resAJ = $instJob->JobWiseAppliedJobs($_GET['j']);
                                      if ($resAJ->num_rows > 0) {
                                        while( $j_row = $resAJ->fetch_assoc() ){
                                            if($j_row['aj_rate'] != ''){
                                                $showRM = ' RM : ';
                                            }else{
                                                $showRM = '';
                                            }
                                            echo '<label class="label label-primary"  draggable="true" ondragstart="drag(event)" ><a id="'.$j_row['u_email'].'" href="manage_user.php?action=edit&u_id='.$j_row['u_displayid'].'" target="_blank" title="ID: '.$j_row['u_displayid'].'" style="color:#FFF; text-decoration: none;">'.$j_row['u_email'].$showRM.$j_row['aj_rate'].'</a> <input readonly type="text" value="" style="width: 15px;color:black !important;outline:none !important;" > </label> &nbsp;&nbsp;';
                                        }
                                      }
                                    }*/
                                    ?>
                                  </div>-->
                           </div>
<?PHP
$historyWaP = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = 'Apply Job' ORDER BY wa_id ASC ";
$resulthistoryWaP = $conDB->query($historyWaP);
if ($resulthistoryWaP->num_rows > 0) {
	while($rowhistoryWaP = $resulthistoryWaP->fetch_assoc()){
		if( $rowhistoryWaP['wa_status'] == 'POST' ){
			//$textColorP = '<b><span class=text-success>Success</span></b><br/>';
			//$whatIWant.= '<span class=text-secondary>'.substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , "- ") + 1).'</span>';    
                                            if (strpos($rowhistoryWaP['wa_note'], 'Sent Successfully') !== false) {
                                                $textColorP = '<b><span class=text-success>Success</span></b><br/>';
                                            }else{
                                                $textColorP = '<b><span class=text-danger>Fail</span></b><br/>';
                                            }
		}else{
			$textColorP = '<b><span class=text-danger>Fail</span></b><br/>';
			//$whatIWant.= '<span class=text-danger>'.substr($rowhistoryWa['wa_user'] , strpos($rowhistoryWa['wa_user'] , "- ") + 1).'</span>';   
			//$whatIWant.= '';
		}
		
		$originalDateP = $rowhistoryWaP['wa_date'];
		$newDateP = date("d/m/Y H:i:s", strtotime($originalDateP));
		
		
		$whatIWantP.= ' <font color=#13004d><b>'.$newDateP.'</b></font> '.substr($rowhistoryWaP['wa_user'] , strpos($rowhistoryWaP['wa_user'] , "- ") + 1).' '.$textColorP; 
	}
    
}
?>
						   <a onCLick= "showOtherLog(<?PHP echo $arrJb['j_id']; ?>)" id="popoverProfile" data-html="true" data-content="<?PHP echo $whatIWantP; ?>" rel="popover" title="Log" data-placement="left" data-trigger="hover"><span class="glyphicon glyphicon-user" style="color:#262262" ></span></a>
						   &nbsp;&nbsp;<a style="margin-left:-5px;" data-balloon-length="large" aria-label="Log show list of tutors whose profile & phone no has been automatically sent to client" data-balloon-pos="up-right"><span class="glyphicon glyphicon-question-sign" style="color:#262262" ></span></a>
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
                              <textarea class="form-control" rows="5" id="remarks_jt" name="jt_remarks[en]"><?php echo isset($_REQUEST['j']) ? $arrJbt['jt_remarks'] : ''; ?></textarea>
                           </div>
                        </div>
						
<?PHP
if( isset($_REQUEST['j']) && $arrJb['j_start_date'] != '' ){
	if( $arrJb['j_start_date'] == '0000-00-00' ){
	    //$newDateStartDate = '00/00/0000';
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
						
                        <div class="form-group" id="data_3" <?PHP echo $marginLeft;?> >
                           <label class="col-xs-3 control-label">Start Date :</label>
                           <div class="col-xs-7">
                              <div class="input-group date">
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="<?php echo $newDateStartDate; //echo isset($_REQUEST['j']) ? $arrJb['j_start_date'] : ''; ?>"  name="j_start_date" />
                              </div>
                           </div>
<?PHP
/*
$historyWaClassReminder = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = 'Class Reminder' ORDER BY wa_id ASC ";
$resulthistoryWaClassReminder = $conDB->query($historyWaClassReminder);
if ($resulthistoryWaClassReminder->num_rows > 0) {
	while($rowhistoryWaClassReminder = $resulthistoryWaClassReminder->fetch_assoc()){
		if( $rowhistoryWaClassReminder['wa_status'] == 'POST' ){
			$textColorClassReminder = '<b><span class=text-success>Success</span></b><br/>';
		}else{
			$textColorClassReminder = '<b><span class=text-danger>Fail</span></b><br/>';
		}
		
		$originalDateClassReminder = $rowhistoryWaClassReminder['wa_date'];
		$newDateClassReminder = date("d/m/Y H:i:s", strtotime($originalDateClassReminder));
		
		$idTutor = trim(substr($rowhistoryWaClassReminder['wa_user'] , strpos($rowhistoryWaClassReminder['wa_user'] , ": ") + 1));
		
		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
		$resultGetEmail = $conDB->query($GetEmail);
		if ($resultGetEmail->num_rows > 0) {
		    $rowGetEmail = $resultGetEmail->fetch_assoc();
		    $idTutor = $rowGetEmail['u_email'];
		}
		
		
		$whatIWantClassReminder.= ' <font color=#13004d><b>'.$newDateClassReminder.'</b></font> '.$idTutor.' '.$textColorClassReminder; 
	}
    
}*/
?>
						   <!--<a id="popoverDataClassReminder" data-html="true" data-content="<?PHP echo $whatIWantClassReminder; ?>" rel="popover" title="Class Reminder Log" data-placement="left" data-trigger="hover"><span class="glyphicon glyphicon-user" style="color:#262262" ></span></a>-->
						   &nbsp;&nbsp;<a style="margin-left:-5px;" data-balloon-length="large" aria-label="FM use this field for now to mark current cycle start date ( to check if manual record tallies) . Once all tutors have use record function, then we will remove this Start date field" data-balloon-pos="up-right"><span class="glyphicon glyphicon-info-sign" style="color:#262262" ></span></a>
                        </div>
                        <div class="form-group hidden" id="data_4" <?PHP echo $marginLeft;?> >
                           <label class="col-xs-3 control-label">Due Date :</label>
                           <div class="col-xs-7">
                              <div class="input-group date">

                                    <?PHP
                                    $manDueDate = '';
                                    if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] =='paid' ){
                                        
                                        $autoMsjOn = " SELECT wa_job_id FROM tk_send_wa WHERE wa_job_id = '".$arrJb['j_id']."' ";
                                        $reautoMsjOn = $conDB->query($autoMsjOn);
                                        if ($reautoMsjOn->num_rows > 0) {
                                            $qDueDate = " SELECT cl_id, cr_cl_id, cl_display_id, current_cycle, cr_date, cr_start_time, cr_status FROM tk_classes_record
                                            INNER JOIN tk_classes ON cl_id = cr_cl_id
                                            WHERE cl_display_id = '".$arrJb['j_id']."'
                                            AND current_cycle NOT LIKE '%temp%'
                                            ORDER BY cr_date DESC, cr_start_time DESC ";
                                            $resultDueDate = $conDB->query($qDueDate);
                                            if ($resultDueDate->num_rows > 0) {
                                                $rowDueDate = $resultDueDate->fetch_assoc();
                                                if( $rowDueDate['cr_status'] == 'Required Parent To Pay' ){
                                                    //$manDueDate = 'required';
                                                    $manDueDate = '';
                                                }
                                            }                                            
                                        }

                                    }
                                    ?>
                                  
                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="<?php echo $newDateEndDate;//echo isset($_REQUEST['j']) ? $arrJb['j_end_date'] : ''; ?>" name="j_end_date" <?PHP echo $manDueDate; ?>/>
                              </div>
                           </div>
<?PHP
/*
$text1stReminder = '';
$text2stReminder = '';
$historyWa1st = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = '1st Payment Reminder' ORDER BY wa_id ASC ";
$resulthistoryWa1st = $conDB->query($historyWa1st);
if ($resulthistoryWa1st->num_rows > 0) {
    $text1stReminder = '<b><span class=text-info>1st Reminder</span></b><br/>';
	while($rowhistoryWa1st = $resulthistoryWa1st->fetch_assoc()){
		if( $rowhistoryWa1st['wa_status'] == 'POST' ){
			$textColor1st = '<b><span class=text-success>Success</span></b><br/>';
		}else{
			$textColor1st = '<b><span class=text-danger>Fail</span></b><br/>';
		}

		$originalDate1stReminder = $rowhistoryWa1st['wa_date'];
		$newDate1stReminder = date("d/m/Y H:i:s", strtotime($originalDate1stReminder));
		
		$idTutor = trim(substr($rowhistoryWa1st['wa_user'] , strpos($rowhistoryWa1st['wa_user'] , ": ") + 1));
		
		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
		$resultGetEmail = $conDB->query($GetEmail);
		if ($resultGetEmail->num_rows > 0) {
		    $rowGetEmail = $resultGetEmail->fetch_assoc();
		    $idTutor = $rowGetEmail['u_email'];
		}
		
		$whatIWant1st.= ' <font color=#13004d><b>'.$newDate1stReminder.'</b></font> '.$idTutor.' '.$textColor1st; 

	}
    
}


$historyWa2st = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$arrJb['j_id']."' AND wa_remark = '2nd Payment Reminder' ORDER BY wa_id ASC ";
$resulthistoryWa2st = $conDB->query($historyWa2st);
if ($resulthistoryWa2st->num_rows > 0) {
    $text2stReminder = '<b><span class=text-info>2nd Reminder</span></b><br/>';
	while($rowhistoryWa2st = $resulthistoryWa2st->fetch_assoc()){
		if( $rowhistoryWa2st['wa_status'] == 'POST' ){
			$textColor2st = '<b><span class=text-success>Success</span></b><br/>';
		}else{
			$textColor2st = '<b><span class=text-danger>Fail</span></b><br/>';
		}

		$originalDateWa2st = $rowhistoryWa2st['wa_date'];
		$newDateWa2st = date("d/m/Y H:i:s", strtotime($originalDateWa2st));
		
		$idTutor = trim(substr($rowhistoryWa2st['wa_user'] , strpos($rowhistoryWa2st['wa_user'] , ": ") + 1));
		
		$GetEmail = " SELECT u_id, u_email FROM tk_user WHERE u_id = '".$idTutor."'  ";
		$resultGetEmail = $conDB->query($GetEmail);
		if ($resultGetEmail->num_rows > 0) {
		    $rowGetEmail = $resultGetEmail->fetch_assoc();
		    $idTutor = $rowGetEmail['u_email'];
		}
		
		$whatIWant2st.= ' <font color=#13004d><b>'.$newDateWa2st.'</b></font> '.$idTutor.' '.$textColor2st; 
	}
    
}*/
?>
						   <!--<a id="popoverDataPayment" data-html="true" data-content="<?PHP echo $text1stReminder.' '.$whatIWant1st.' '.$text2stReminder.' '.$whatIWant2st; ?>" rel="popover" title="Payment Reminder Log" data-placement="left" data-trigger="hover"><span class="glyphicon glyphicon-user" style="color:#262262" ></span></a>
						   &nbsp;&nbsp;<a style="margin-left:-5px;" data-balloon-length="large" aria-label="Log will show if parent has successfully received payment reminder auto WA message" data-balloon-pos="up-right"><span class="glyphicon glyphicon-question-sign" style="color:#262262" ></span></a>-->
                        </div>
						<?PHP
						if(isset($_REQUEST['j'])){
						?>
<!--
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Parent's Email :</label>
                           <?PHP
                           /*$thisReq =  '';
                           if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] == 'paid' && $arrJb['j_deadline'] != '' && $arrJb['j_deadline'] != '0000-00-00' ){
                                $thisReq =  'required';
                                $thisReq2 =  'data-required';
                           }*/
                           ?>
                           <div class="col-lg-5"><input <?PHP echo $thisReq2; ?> type="email" class="form-control" name="actual_email" id="actual_email" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['actual_email'] : ''; ?>"  > 
                           </div>
                        </div>
-->
                        <div class="form-group">
                           <label class="col-lg-3 control-label">Parent's Email :</label>
                           <div class="col-lg-7">
                           <?PHP
                           $thisReq =  '';
                           if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] == 'paid' && $arrJb['j_deadline'] != '' && $arrJb['j_deadline'] != '0000-00-00' ){
                                $thisReq =  'required';
                                $thisReq2 =  'data-required';
                           }
                           ?>
                              <input type="email" class="form-control" name="actual_email" id="actual_email" value="<?php echo isset($_REQUEST['j']) ? $arrJb['actual_email'] : ''; ?>" style="position:absolute;width:79%;" >
                              <select class="form-control" id="dummySelect"  style="position:absolute;top:0px;left:79%;width:100px;" onchange="actualEmailFunc()">
                                 <!--<option value='' > &#8681; </option>-->
                                 <option value='0' ></option>
                                 <option value='1' >ashikinmuzapa@gmail.com</option>
                              </select>
                              <input name="idValue" id="idValue" type="hidden">
                           </div>
                        </div>

<br/>
                        <div class="form-group">
                           <label class="col-lg-3 control-label" >Parent’s Rate :</label>
                           <!--<div class="col-lg-5">
								<input type="text" class="form-control" name="parent_rate" id="parent_rate" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['parent_rate'] : ''; ?>" > 
                           </div>-->
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <input data-required onkeypress="return isNumberKey(event , this.id)" type="text"  class="form-control decimal" name="parent_rate" id="parent_rate" value="<?php echo isset($_REQUEST['j']) ? $arrJb['parent_rate'] : ''; ?>" style="width:70px;" > <span> <font size="2"></font></span><span> <font size="2"><b>&nbsp;&nbsp;per hour X&nbsp;&nbsp;</b></font></span>
<?PHP
                                            $redOnGoingKelas = '';
                                            $OnGoingKelas = " SELECT cr_id, cl_id, cr_cl_id, cl_display_id, current_cycle, cr_date, cr_start_time, cr_status FROM tk_classes_record
                                            INNER JOIN tk_classes ON cl_id = cr_cl_id
                                            WHERE cl_display_id = '".$arrJb['j_id']."'
                                            AND current_cycle NOT LIKE '%temp%'
                                            ORDER BY cr_date DESC, cr_start_time DESC, cr_id DESC ";
                                            $reOnGoingKelas = $conDB->query($OnGoingKelas);
                                            if ($reOnGoingKelas->num_rows > 0) {
                                                $roOnGoingKelas = $reOnGoingKelas->fetch_assoc();
                                                if( $roOnGoingKelas['cr_status'] == 'new' || $roOnGoingKelas['cr_status'] == 'FM to pay tutor' || $roOnGoingKelas['cr_status'] == 'Required Parent To Pay' || $roOnGoingKelas['cr_status'] == 'new Cycle' ){
                                                    $redOnGoingKelas = '';
                                                }else{
                                                    $redOnGoingKelas = 'readonly';
                                                }
                                            }
?>
                              <input <?PHP echo $redOnGoingKelas; ?> data-required onkeypress="return isNumberKey(event , this.id)" type="text"  class="form-control decimal" name="cycle" id="cycle" value="<?php echo isset($_REQUEST['j']) ? $arrJb['cycle'] : ''; ?>" style="width:70px;" > <span> <font size="2"><b>&nbsp;&nbsp;+&nbsp;&nbsp;</b></font></span>
                              <input onkeypress="return isNumberKey(event , this.id)" type="text"  class="form-control decimal" name="rf" id="rf" value="<?php echo isset($_REQUEST['j']) ? $arrJb['rf'] : ''; ?>" style="width:70px;" > <font size="2"><b>&nbsp;&nbsp;<span id='totalResult'></span>&nbsp;&nbsp;</b></font>

                                    <?PHP
                                    $disableInvoice = '';
                                    $invBtn = 'btn-copy';
                                    $GetInvoice = " SELECT ph_job_id, ph_user_type, ph_receipt FROM tk_payment_history WHERE ph_job_id = '".$arrJb['j_id']."' AND ph_user_type = '4' AND (ph_receipt = 'temp' OR ph_receipt = '1') ";
                                    $resultInvoice = $conDB->query($GetInvoice);
                                    if ($resultInvoice->num_rows > 0) {
                                        $disableInvoice = 'true';
                                        $invBtn = 'btn-hijau';
                                    }
                                
                                    if( $arrJb['j_status'] == 'closed' && $arrJb['j_payment_status'] == 'pending' && ($arrJb['j_deadline'] != '' && $arrJb['j_deadline'] != '0000-00-00') ){
                                        ?><button type="button" class="btn <?PHP echo $invBtn; ?> btn-sm" onclick="tempInvoice(<?PHP echo $arrJb['j_id']; ?>, <?PHP echo $disableInvoice; ?>)" >Invoice</button><?PHP
                                    }
                                    ?>
                              </div>
                              

                              <div class="form-inline">
                              <input type="text"  class="form-control" style="width:1px;height:1px;border:none" >  <span> <font size="2" style="color:#31597E" ><b>Rate&nbsp;&nbsp;</b></font></span>
                              <input type="text"  class="form-control" style="width:90px;height:1px;border:none" > <span> <font size="2" style="color:#803351" ><b>&nbsp;&nbsp;&nbsp;&nbsp;Cycle&nbsp;&nbsp;</b></font></span>
                              <input type="text"  class="form-control" style="width:48px;height:1px;border:none" > <span> <font size="2" style="color:#338049" ><b>&nbsp;&nbsp;R.F&nbsp;&nbsp;</b></font> </span>
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
                        
                        <!--<div class="form-group">
                           <label class="col-lg-3 control-label">Hour per cycle :</label>
                           <div class="col-lg-7">
                              <div class="form-inline">
                              <input data-required onkeypress="return isNumberKey(event)" type="text"  class="form-control" name="cycle" id="cycle" value="<?php //echo isset($_REQUEST['j']) ? $arrJb['cycle'] : ''; ?>" style="width:50px;" > <span> <font size="2">&nbsp;&nbsp;&nbsp;hours</font></span>
                              </div>
						   </div>
                        </div>-->
<?PHP
//}
?>
						
						<?PHP
						}
						?>
						
						
                          <!--<div class="form-group" id="data_2">
                            <label class="col-sm-3 control-label">Bank Name :</label>
                            <div class="col-sm-2">
                                              <select class="form-control" name="BankName" id="BankName" >
                                                 <option value="">Select Bank</option>
                                              </select>
                            </div>
                            
                            <div class="col-sm-5">
                              <label class="col-sm-3 control-label">Acc No :</label>
                              <div class="input-group">
                                <input type="text" class="form-control" id="AccNo" name="AccNo" value="" >
                              </div>
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
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit" onclick="btnCreateClasses('Save')" >Save</button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit" onclick="btnCreateClasses('S&CE')">S&CE </button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" onClick="duplicateJob()">Duplicate </button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" title="Delete" onClick="if(confirm('Are you sure, you want to remove the job?'))document.location.href='job-edit.php?action=delete_job&j_id=<?php echo $arrJb['j_id'];?>'">Delete</button>
                              
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

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };
        $('#shortlistedData').load('shortlisted-data.php?requiredid='+getUrlParameter('j'));
        $('#tutorApplying').load('tutor-applying.php?requiredid='+getUrlParameter('j'));

        
    if( document.getElementById('parent_rate').value != '' && document.getElementById('cycle').value != '' ){
        if( document.getElementById('rf').value != '' ){
            var twoPlacedFloat = parseFloat(( ((parseFloat(document.getElementById('parent_rate').value) * parseFloat(document.getElementById('cycle').value)) + parseFloat(document.getElementById('rf').value)))).toFixed(2)
            document.getElementById('totalResult').innerHTML = ' = RM '+twoPlacedFloat;            
        }else{
            var twoPlacedFloat = parseFloat(( ((parseFloat(document.getElementById('parent_rate').value) * parseFloat(document.getElementById('cycle').value))) )).toFixed(2)
            document.getElementById('totalResult').innerHTML = ' = RM '+twoPlacedFloat;  
        }
    }
    
    
      allUserInfo();
	  loadRating();

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

          $('.dateSetup').datepicker({
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
	 
     function loadRating(){

		var rating = document.getElementById("changeRating").value;
		$.ajax({
			url: "ajax/load-rating.php",
			method: "POST",
			data: {action: 'getRate', rating: rating}, 
			success: function(result){
				$('#showRating').html(result);
				document.getElementById("tempshowRating").classList.add("hidden");
				document.getElementById("showRating").classList.remove("hidden");

			}
		});

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
var rf = encodeURIComponent(document.getElementsByName("rf")[0].value);
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
        window.open('job-duplicate.php?crt='+ j_create_date +'&lvl='+ j_jl_id +'&sbj='+ jt_subject +'&ara='+ j_area +'&stt='+ j_state_id +'&newCity='+ newCity +'&eml='+ j_email +'&tel='+ j_telephone +'&rte='+ j_rate +'&lss='+ jt_lessons +'&prd='+ j_preferred_date_time +'&cms='+ j_commission +'&drt='+ j_duration +'&sts='+ j_status +'&pstt='+ j_payment_status +'&ddl='+ j_deadline +'&hte='+ j_hired_tutor_email +'&rmk='+ jt_remarks +'&str='+ j_start_date +'&end='+ j_end_date +'&crea='+ j_creator_email +'&act='+ actual_email +'&prt='+ parent_rate +'&cycle='+ cycle +'&j_check_rate='+ j_check_rate +'&j_check_timeday='+ j_check_timeday +'&rf='+ rf                   ,'_blank');

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

//$('#popoverData').popover();
$('#popoverData').popover({
    container: 'body'
})
$('#popoverProfile').popover({
    container: 'body'
})
$('#popoverDataCycle').popover({
    container: 'body'
})
$('#popoverDataClassReminder').popover({
    container: 'body'
})
$('#popoverDataPayment').popover({
    container: 'body'
})
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


$('#changeRating').change(function(){
    var rating = $(this).val();
    $.ajax({
        url: "ajax/load-rating.php",
        method: "POST",
        data: {action: 'getRate', rating: rating}, 
        success: function(result){
            $('#showRating').html(result);
			document.getElementById("tempshowRating").classList.add("hidden");
			document.getElementById("showRating").classList.remove("hidden");

        }
    });
})

function getPayment(value) { 
	if( value == 'paid' ){
	    $("#removeThis").removeClass("hidden");
	}else{
	    $("#removeThis").addClass("hidden");
    }
} 

function PostWA(JobID) {
    if( JobID == ''){
        alert('Error..');
    }else{
        var x = confirm("Are you sure you want to post?");
        if (x == true){
        	$.ajax({
        		type:'POST',
        		url:'post-wagroup.php',
        		data: {
        			data: {JobID: JobID},
        		},
        		success:function(result){
        			alert(result);
        		}
        	});
        }
    }
}

$('#frmJob').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
      if( document.getElementById("dumyText").value == 'ya' ){
      }else{
        e.preventDefault();
        return false;          
      }
  }
});

$('.enableEnter').keyup(function (e) {
    if (e.keyCode === 13) {
        var j_id = document.getElementById("j_id").value;
        var btnEnterField = document.getElementById("btnEnterField").value;
        if( j_id != '' && btnEnterField != '' ){
        	$.ajax({
        		type:'POST',
        		url:'shortlisted.php',
        		data: {
        			data: {JobID: j_id, DisID: btnEnterField},
        		},
        		success:function(result){
        			if( result == 'NoTutor' ){
        			    alert('Tutor Not Found!');
        			}else if( result == 'DahAda' ){
        			    alert('Tutors are already on the shortlist.!');
        			}else if( result == 'Success' ){
        			    document.getElementById("btnEnterField").value = '';
        			    $('#shortlistedData').load('shortlisted-data.php?requiredid='+j_id);
        			    alert('Success..');
        			}else{
        			    alert(result);
        			}
        		}
        	});
        }
    }
});

function showOtherLog(jobID) {
    window.open("https://www.tutorkami.com/admin/all-log?jobID="+jobID);
}

function onBtnEnterField() {
    var j_id = document.getElementById("j_id").value;
    var btnEnterField = document.getElementById("btnEnterField").value;
    if( j_id != '' && btnEnterField != '' ){
        	$.ajax({
        		type:'POST',
        		url:'shortlisted.php',
        		data: {
        			data: {JobID: j_id, DisID: btnEnterField},
        		},
        		success:function(result){
        			if( result == 'NoTutor' ){
        			    alert('Tutor Not Found!');
        			}else if( result == 'DahAda' ){
        			    alert('Tutors are already on the shortlist.!');
        			}else if( result == 'Success' ){
        			    document.getElementById("btnEnterField").value = '';
        			    $('#shortlistedData').load('shortlisted-data.php?requiredid='+j_id);
        			    alert('Success..');
        			}else{
        			    alert(result);
        			}
        		}
        	});
    }
}
function removeEnterField(id,job) {
    if( id != '' && job != '' ){
         var x = confirm("Are you sure you want to delete?");
    	 if (x == true){
        	$.ajax({
        		type:'POST',
        		url:'shortlisted.php',
        		data: {
        			dataDelete: {JobID: job, DisID: id},
        		},
        		success:function(result){
                    if( result == 'Success' ){
        			    $('#shortlistedData').load('shortlisted-data.php?requiredid='+job);
        			    alert('Success..');
                    }else{
                        alert(result);
                    }
        		}
        	});
    	 }
    }else{
        alert('Error!');
    }
}
$(document).on('click', function(event) {
    if (event.target.id == 'jt_comments' || event.target.id == 'remarks_jt') {
        document.getElementById("dumyText").value = 'ya';
    }else{
        document.getElementById("dumyText").value = 'bukan';
    }
})

function runPopUp() {
    var JobID = document.getElementById("hideModalJobID").value;
    var type  = document.getElementById("hideModalType").value;
    var cycle = document.getElementById("hideModalPopup").value;
    var rate  = document.getElementById("popUpRate").innerHTML.replace('RM ','').trim();
    var rf    = document.getElementById("popUpRF").innerHTML.replace('RM ','').trim();
    var total = document.getElementById("popUpTotal").innerHTML.replace('RM ','').trim();
    //alert(JobID + ' ' + type + ' ' + cycle + ' ' + rate + ' ' + rf + ' ' + total);
    //$("#tempModal").modal('hide');
    $(".spinner").removeClass("hidden");
            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'tempInvoice', jobID: JobID,type: type,parentRate: rate,cycle: cycle,rf: rf}, 
                success: function(result){
                    if( result == 'Error' ){
                        $(".spinner").addClass("hidden");
                        alert(result);
                    }else if( result == 'true' ){
                        $(".spinner").addClass("hidden");
                        if( type == 'Invoice' ){
                            alert('First invoice has been generated for this client');
                        }else{
                            alert('Trial session invoice has been generated for this client');
                        }
                        $("#tempModal").modal('hide');
                    }else{
                        response = JSON.parse(result);
                        var id = response[0];
                        var date = response[1];
                        var jobID = response[2];
                        $(".spinner").addClass("hidden");
                        $("#tempModal").modal('hide');
                        window.open("https://www.tutorkami.com/admin/templates-pdf-user?last="+id+"&date="+date+"&jobID="+jobID);
                    }
                }
            });
}

function dropHours() {
    var parentRate  = document.getElementById("parent_rate").value;
    val = document.getElementById("dropHours").value;
    document.getElementById('popUpTotal').innerHTML = 'RM '+parseFloat((parseFloat(parentRate) * val));  
    document.getElementById("hideModalPopup").value = val;
}
function runBtn(btn) {
    var parentRate  = document.getElementById("parent_rate").value;
    var cycle       = document.getElementById("cycle").value;
    var rf          = document.getElementById("rf").value;
    var totalAmount = '';
    
    if( parentRate != '' && cycle != '' ){
        if( rf != '' ){
            totalAmount = parseFloat(( ((parseFloat(parentRate) * parseFloat(cycle)) + parseFloat(rf)))).toFixed(2)
        }else{
            totalAmount = parseFloat(( ((parseFloat(parentRate) * parseFloat(cycle))) )).toFixed(2)
        }
    }
        
    if( btn == 'Invoice' ){
        document.getElementById("detailsInfo").innerHTML = ' Confirm to send invoice to client? ';
        document.getElementById("hideModalType").value = btn;
        document.getElementById("hideModalPopup").value = cycle;
        document.getElementById("btnInv").className = "btn btn-primary";
        document.getElementById("btnTri").className = "btn btn-secondary";

        document.getElementById("detailsInvoice").innerHTML = ' <div class="row" style="margin-left:30%;"> ' +
                      ' <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Hours </font></div> ' +
                      ' <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div> ' +
                      ' <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="dropHours">' + cycle + '</font></div> ' +
                    ' </div><br/> ' +

                    ' <div class="row" style="margin-left:30%;"> ' +
                      ' <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Rate </font></div> ' +
                      ' <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div> ' +
                      ' <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpRate">RM ' + parentRate + '</font></div> ' +
                    ' </div><br/> ' +
                    
                    ' <div class="row" style="margin-left:30%;"> ' +
                      ' <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >R.F </font></div> ' +
                      ' <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div> ' +
                      ' <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpRF">RM ' + rf + '</font></div> ' +
                    ' </div><br/> ' +
                    
                    ' <div class="row" style="margin-left:30%;"> ' +
                      ' <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Total </font></div> ' +
                      ' <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div> ' +
                      ' <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpTotal">RM ' + totalAmount + '</font></div> ' +
                    ' </div> ' 
        ;
    }else{
        document.getElementById("detailsInfo").innerHTML = ' Confirm to send invoice for trial session to client? ';
        document.getElementById("hideModalType").value = btn;
        document.getElementById("hideModalPopup").value = 1;
        document.getElementById("btnInv").className = "btn btn-secondary";
        document.getElementById("btnTri").className = "btn btn-primary";

        document.getElementById("detailsInvoice").innerHTML = ' <div class="row" style="margin-left:30%;"> ' +
                      ' <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Hours </font></div> ' +
                      ' <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div> ' +
                      ' <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" > ' +
                            ' <select id="dropHours" onchange="dropHours()"> ' +
                              ' <option value="1"   >1</option> ' +
                              ' <option value="1.5" >1.5</option> ' +
                              ' <option value="2"   >2</option> ' +
                              ' <option value="2.5" >2.5</option> ' +
                            ' </select> ' +
                      ' </font></div> ' +
                    ' </div><br/> ' +

                    ' <div class="row" style="margin-left:30%;"> ' +
                      ' <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Rate </font></div> ' +
                      ' <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div> ' +
                      ' <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpRate">RM ' + parentRate + '</font></div> ' +
                    ' </div><br/> ' +
                    
                    ' <div class="row" style="margin-left:30%;"> ' +
                      ' <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >R.F </font></div> ' +
                      ' <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div> ' +
                      ' <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpRF">RM 0</font></div> ' +
                    ' </div><br/> ' +
                    
                    ' <div class="row" style="margin-left:30%;"> ' +
                      ' <div class="col-xs-2"><font style="color:#10084E;font-weight: bold;" >Total </font></div> ' +
                      ' <div class="col-xs-1"><font style="color:#10084E;font-weight: bold;" >=</font></div> ' +
                      ' <div class="col-xs-3"><font style="color:#10084E;font-weight: bold;" id="popUpTotal">RM ' + parseFloat((parseFloat(parentRate) * 1)) + '</font></div> ' +
                    ' </div> ' 
        ;
    }
}
function tempInvoice(jobID,dis) {

    if( dis == true ){
        alert('First invoice has been generated for this client');
    }else{  
        var parentRate  = document.getElementById("parent_rate").value;
        var cycle       = document.getElementById("cycle").value;
        var rf          = document.getElementById("rf").value;
        if( jobID == '' ){
            alert('Error !');
        }else if( parentRate == '' || cycle == '' ){
            alert('Rate & Cycle Required');
        }else{
            $('#tempModal').modal({backdrop: 'static', keyboard: false}); 
            /*
            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'tempInvoice', jobID: jobID,parentRate: parentRate,cycle: cycle,rf: rf}, 
                success: function(result){
                    if( result == 'Error' ){
                        alert(result);
                    }else if( result == 'true' ){
                        alert('First invoice has been generated for this client');
                    }else{
                        response = JSON.parse(result);
                        var id = response[0];
                        var date = response[1];
                        var jobID = response[2];
                        //alert(result);
                        window.open("https://www.tutorkami.com/admin/templates-pdf-user?last="+id+"&date="+date+"&jobID="+jobID);
                    }
                }
            });
            */
        }
    }

}

function btnCreateClasses(type) {
    var Job = document.getElementById("hideModalJob").value;
            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'tempCreateClasses', Job: Job, type: type}, 
                success: function(result){
                }
            });
}

function noClassesHome() {
            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'tempUnsetClasses', type: 'no'}, 
                success: function(result){
                    window.location.href = "https://www.tutorkami.com//admin/job-list.php";
                }
            });
}
function noClasses() {
            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'tempUnsetClasses', type: 'no'}, 
                success: function(result){
                }
            });
}
function createClassesHome() {
    var Job = document.getElementById("hideModalJob").value;
    var PrID = document.getElementById("hideModalPr").value;
    var TuID = document.getElementById("hideModalTu").value;
    var Student = document.getElementById("hideModalStu").value;
    var Subj = document.getElementById("hideModalSubj").value;
    var Rate = document.getElementById("hideModalRate").value;
    var PrRate = document.getElementById("hideModalPrRate").value;
    var Cycle = document.getElementById("hideModalCycle").value;

            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'CreateClasses', Job: Job, PrID: PrID, TuID: TuID, Student: Student, Subj: Subj, Rate: Rate, PrRate: PrRate, Cycle: Cycle}, 
                success: function(result){
                    if( result == 'Error' ){
                        alert(result);
                    }
                    $('#ModalCreateClass').modal('hide');
                    window.location.href = "https://www.tutorkami.com/admin/job-list.php";
                }
            });
}
function createClasses() {
    var Job = document.getElementById("hideModalJob").value;
    var PrID = document.getElementById("hideModalPr").value;
    var TuID = document.getElementById("hideModalTu").value;
    var Student = document.getElementById("hideModalStu").value;
    var Subj = document.getElementById("hideModalSubj").value;
    var Rate = document.getElementById("hideModalRate").value;
    var PrRate = document.getElementById("hideModalPrRate").value;
    var Cycle = document.getElementById("hideModalCycle").value;

            $.ajax({
                url: "ajax/allinone.php",
                method: "POST",
                data: {action: 'CreateClasses', Job: Job, PrID: PrID, TuID: TuID, Student: Student, Subj: Subj, Rate: Rate, PrRate: PrRate, Cycle: Cycle}, 
                success: function(result){
                    if( result == 'Error' ){
                        alert(result);
                    }
                    $('#ModalCreateClass').modal('hide');
                    location.reload();
                }
            });
}

/* https://stackoverflow.com/questions/18309059/drop-down-menu-text-field-in-one*/
function actualEmailFunc() {
    var optVal= $("#dummySelect option:selected").text();
    if( optVal != '' ){
        document.getElementById('actual_email').value = optVal;
        $("#dummySelect option[value='0']").prop("selected", true);
    }
}
</script>
<?PHP $conDB -> close();  ?>
</body>
</html>
