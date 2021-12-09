<?php 
require_once('includes/head.php');

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

# SESSION CHECK #
if (!isset($_SESSION['auth'])) {
  header('Location: client_login.php');
  exit();
}

$user_id = $_SESSION['auth']['user_id'];
$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);

include('includes/header.php');
$_SESSION['getPage'] = "Client Term";
unset($_SESSION["firstlogin"]);
date_default_timezone_set("Asia/Kuala_Lumpur");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  
<style>
.btn-default {
    background: #DDDDDD;
}
.btn-oren { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
.btn-oren:hover, 
.btn-oren:focus, 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  background-image: none; 
} 
.btn-oren.disabled, 
.btn-oren[disabled], 
fieldset[disabled] .btn-oren, 
.btn-oren.disabled:hover, 
.btn-oren[disabled]:hover, 
fieldset[disabled] .btn-oren:hover, 
.btn-oren.disabled:focus, 
.btn-oren[disabled]:focus, 
fieldset[disabled] .btn-oren:focus, 
.btn-oren.disabled:active, 
.btn-oren[disabled]:active, 
fieldset[disabled] .btn-oren:active, 
.btn-oren.disabled.active, 
.btn-oren[disabled].active, 
fieldset[disabled] .btn-oren.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}

.btn-outline {
    background-color: transparent;
    color: inherit;
    transition: all .5s;
}

.btn-primary.btn-outline {
    color: #428bca;
}

.btn-success.btn-outline {
    color: #5cb85c;
}

.btn-info.btn-outline {
    color: #5bc0de;
}

.btn-warning.btn-outline {
    color: #f0ad4e;
}

.btn-danger.btn-outline {
    color: #d9534f;
}

.btn-primary.btn-outline:hover,
.btn-success.btn-outline:hover,
.btn-info.btn-outline:hover,
.btn-warning.btn-outline:hover,
.btn-danger.btn-outline:hover {
    color: #fff;
}
.notbold{
    font-weight:normal
}

#dvLoading {
background:url(https://www.tutorkami.com/images/loading-spinner.gif) no-repeat center center;
height: 100px;
width: 200px;
z-index: 1000;
}
.cssload-loader {
	width: 244px;
	height: 49px;
	line-height: 49px;
	text-align: center;
	position: absolute;
	left: 50%;
	transform: translate(-50%, -50%);
		-o-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		-webkit-transform: translate(-50%, -50%);
		-moz-transform: translate(-50%, -50%);
	font-family: helvetica, arial, sans-serif;
	text-transform: uppercase;
	font-weight: 900;
	font-size:18px;
	color: rgb(206,66,51);
	letter-spacing: 0.2em;
}
.cssload-loader::before, .cssload-loader::after {
	content: "";
	display: block;
	width: 15px;
	height: 15px;
	background: rgb(206,66,51);
	position: absolute;
	animation: cssload-load 0.81s infinite alternate ease-in-out;
		-o-animation: cssload-load 0.81s infinite alternate ease-in-out;
		-ms-animation: cssload-load 0.81s infinite alternate ease-in-out;
		-webkit-animation: cssload-load 0.81s infinite alternate ease-in-out;
		-moz-animation: cssload-load 0.81s infinite alternate ease-in-out;
}
.cssload-loader::before {
	top: 0;
}
.cssload-loader::after {
	bottom: 0;
}

@keyframes cssload-load {
	0% {
		left: 0;
		height: 29px;
		width: 15px;
	}
	50% {
		height: 8px;
		width: 39px;
	}
	100% {
		left: 229px;
		height: 29px;
		width: 15px;
	}
}

@-o-keyframes cssload-load {
	0% {
		left: 0;
		height: 29px;
		width: 15px;
	}
	50% {
		height: 8px;
		width: 39px;
	}
	100% {
		left: 229px;
		height: 29px;
		width: 15px;
	}
}

@-ms-keyframes cssload-load {
	0% {
		left: 0;
		height: 29px;
		width: 15px;
	}
	50% {
		height: 8px;
		width: 39px;
	}
	100% {
		left: 229px;
		height: 29px;
		width: 15px;
	}
}

@-webkit-keyframes cssload-load {
	0% {
		left: 0;
		height: 29px;
		width: 15px;
	}
	50% {
		height: 8px;
		width: 39px;
	}
	100% {
		left: 229px;
		height: 29px;
		width: 15px;
	}
}

@-moz-keyframes cssload-load {
	0% {
		left: 0;
		height: 29px;
		width: 15px;
	}
	50% {
		height: 8px;
		width: 39px;
	}
	100% {
		left: 229px;
		height: 29px;
		width: 15px;
	}
}

@media (min-width: 768px ) {
	.bottom-align-text {
		margin-left:470px;
	}
}
@media (min-width: 1200px ) {
	.bottom-align-text {
		margin-left:670px;
	}
}
</style>
<?PHP
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 

if($_SESSION['auth']['user_role'] == '4') {
	$queryUserPopUp = $conn->query(" SELECT u_id, signature_img, signature_img2 FROM tk_user WHERE u_id='$user_id' ");
	$resUserPopUp = $queryUserPopUp->num_rows;
	if($resUserPopUp > 0){
        $rowUserPopUp = $queryUserPopUp->fetch_assoc();
        if ( $rowUserPopUp['signature_img'] == '' && $rowUserPopUp['signature_img2'] == '' ) {
            if( $_SESSION["hideterms"] != 'yes' ){
                echo "<script>$(document).ready(function(){ 
                    document.getElementById('textModal').innerHTML = 'Please read & sign Terms A (1-to-1 Tuition) or Terms B (if you are requesting for Group Tuition) before you can proceed. If you have any question about the terms, please ask our Coordinators.';
                    document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default data-dismiss=modal onClick=oneTime()>Close</button>';
                    document.getElementById('myModalButton').click();  
                });</script>";                
            }
        }
	}

	if( isset($_SESSION['clickWA']) ){
	    /*
	    if( $_SESSION['clickWA'] == "none" ){
    	    unset($_SESSION['clickWA']);
            echo "<script>$(document).ready(function(){  
                document.getElementById('textModal').innerHTML = 'Please click &#39;OK&#39; (and then click Send/Enter) to give us permission to send you automatic message via What&#39;s App (you have to do this in a device/mobile phone that has What&#39;s App in it).<br/><br/>This will enable you to receive tutor&#39;s profile faster, receive class reminder & receive payment reminder automatically';
                document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default onClick=clickOk()>OK</button>&nbsp;&nbsp;<button style=background-color:#357BB6 type=button class=btn btn-default onClick=clickNotNow()>Not Now</button>&nbsp;&nbsp;<button id=thisClose type=button class=close hidden data-dismiss=modal>&times;</button>';
                document.getElementById('myModalButton').click();  
            });</script>";	        
	    }else{
    	    unset($_SESSION['clickWA']);
            echo "<script>$(document).ready(function(){  
                document.getElementById('textModal').innerHTML = 'Thank you for agreeing with our terms';
                document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default onClick=closeModal()>Close</button>';
                document.getElementById('myModalButton').click();  
            });</script>";	        
	    }
	    */
    	    unset($_SESSION['clickWA']);
            echo "<script>$(document).ready(function(){  
                document.getElementById('textModal').innerHTML = 'Thank you for agreeing with our terms';
                document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default onClick=closeModal()>Close</button>';
                document.getElementById('myModalButton').click();  
            });</script>";	   
	}
}
?>

<section class="profile">
 <div class="main-body">
    <div class="container">

<!-- Modal -->
<button type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#myModal" id="myModalButton" data-backdrop="static" data-keyboard="false" >Open Modal</button>
<div id="myModal" class="modal fade" role="dialog" style="margin-top:5%">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="background-color: #F1592A;color: white;">
      <div class="modal-body">
        <p id="textModal" ></p>
      </div>
      <div class="modal-footer">
          <span id="buttonModal" ></span>
      </div>
    </div>

  </div>
</div>


<button type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" data-target="#myModalGetFullName" id="myModalButtonGetFullName" data-backdrop="static" data-keyboard="false" >Open Modal</button>
<div id="myModalGetFullName" class="modal fade" role="dialog" style="margin-top:5%">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
          <div class="form-group">
            <label>Please enter your full name : </label>
            <input type="text" class="form-control" id="txtsubmitName" >
            <input type="hidden" id="txtsubmitNameID" value="<?PHP echo $user_id; ?>"  >
          </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <button onClick="submitName()" type="button" class="btn btn-success">Submit</button>
      </div>
    </div>

  </div>
</div>

<?PHP
/*
if($_SESSION['auth']['user_role'] == '4') { 

	$dropdownClickAT = 0;

	$queryUserAT = $conn->query(" SELECT * FROM tk_user WHERE u_id='$user_id' ");
	$resUserAT = $queryUserAT->num_rows;
	if($resUserAT > 0){
        $rowUserAT = $queryUserAT->fetch_assoc();
        
        $tutorDisplayIDAT = $rowUserAT['u_displayid'];
        
        if ( $rowUserAT['signature_img'] != '' ) {
 
    		$getSigAT = strtok($rowUserAT['signature_img'], '_');
    		$getSigAT = str_replace('-', '/', $getSigAT);
    		$dateConvertAT = strtotime($getSigAT); 
    		
    		$bAT = explode('/',$getSig);
    		$dateFormatAT = (int)($bAT[2].$bAT[1].$bAT[0]);
    		
            $getTimeAT = getBetween($rowUserAT['signature_img'],"_","_");
			if(strlen($getTimeAT) == '7'){
				$getTimeAT = str_replace("-",":",substr($getTimeAT, 0, -2)).':00';
			}else{
				$getTimeAT = str_replace("-",":",$getTimeAT).':00';
			}
			
                $queryProof1AT = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='78' AND pmt_noti='TRUE' "; 
                $resultProof1AT = $conn->query($queryProof1AT); 
                if($resultProof1AT->num_rows > 0){ 
						
						$rowProof1AT = $resultProof1AT->fetch_assoc();
						$dateLastupdated2AT = $rowProof1AT['pmt_lastupdated'];
						$timeSaveTermsAT = $rowProof1AT['pmt_time'];
			
						$dateConvert2AT = strtotime($dateLastupdated2AT); 
						
					
						$aAT = explode('/',$rowProof1AT['pmt_lastupdated']);
						$dateFormat2AT = (int)($aAT[2].$aAT[1].$aAT[0]);
					
						$queryProof1AT = " SELECT * FROM tk_term_popup WHERE tp_id ='".$user_id."' "; 
						$resultProof1AT = $conn->query($queryProof1AT); 
						if($resultProof1AT->num_rows > 0){ 
						}else{
							if($dateFormat2AT > $dateFormatAT){
						        echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
							}else if($dateFormat2AT < $dateFormatAT){
							}else if($dateFormat2AT = $dateFormatAT){
								if($timeSaveTermsAT >= $getTimeAT){
                                    echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
								}else{
									
								}
							}else{
							    echo "<script>$(document).ready(function(){ $('#myModalPopUp').modal('show'); });</script>";
							}                    
						}
                }
        }
	}
	
}
*/


if( $getUserDetails->data[0]->ud_client_status_2 != NULL && $getUserDetails->data[0]->ud_client_status_2 == 'Tuition Centre'){
    if($getLan == "/my/"){
        $headerTitle = "Terma";
        $headerButton = "";
    }else{
        $headerTitle = "Terms";
        $headerButton = "";
    }
}else{    
    if($getLan == "/my/"){
        $headerTitle = "Terma Ibu Bapa";
        $headerButton = "Terma A (Tuisyen 1-to-1)";
        $headerButton2 = "Terma B (Tuisyen Berkumpulan)";
        $signAgreed = "Saya telah baca dan bersetuju dengan semua terma di atas";
        $signHereText = "(Sila tanda tangan disini)";
        $btnSave = "Sahkan";
        $btnClear = "Padam";
    }else{
        $headerTitle = "Client's Terms";
        $headerButton = "Terms A (1-to-1 Tuition)";
        $headerButton2 = "Terms B (Group Tuition)";
        $signAgreed = "I have read and agreed to all the terms above";
        $signHereText = "(Please sign here)";
        $btnSave = "Save signature";
        $btnClear = "Clear signature";
    }
}
?>

<h1 class="text-center blue-txt"><?php echo $headerTitle; ?></h1><hr>

<?PHP
if($getLan == "/my/"){	
?>   
<a href="https://www.tutorkami.com/clients-terms.php" type="button" class="btn btn-oren" >English</a>  
<?PHP
}else{
?>   
<a href="https://www.tutorkami.com/my/clients-terms.php" type="button" class="btn btn-oren" >Bahasa Melayu</a>  
<?PHP
}
?>

	<div id="content1" class="collapse in"><br/>
  
		<a href="clients-terms.php" id="thisno1" type="button" class="btn btn-success btn-primary"><?php echo $headerButton; ?></a> 
		<?PHP if( $deviceIs == "mobile" ){ echo '<p></p>'; } ?>
		<a href="clients-terms-group.php"      id="thisno2" type="button" class="btn btn-success btn-outline"><?php echo $headerButton2; ?></a>

			<input type="hidden" name="displayid" id="displayid" value="<?php echo $getUserDetails->data[0]->u_displayid; ?>">
			<div id="thiscontent1" class="collapse in">
			<form method="post" action="client-terms-of-accepting.php">
			<div class="sigPad">

					<div class="row">
						<div class="col-lg-12"><br/>
						<?PHP
						function getBetween2($string, $start = "", $end = ""){
							if (strpos($string, $start)) { 
								$startCharCount = strpos($string, $start) + strlen($start);
								$firstSubStr = substr($string, $startCharCount, strlen($string));
								$endCharCount = strpos($firstSubStr, $end);
								if ($endCharCount == 0) {
									$endCharCount = strlen($firstSubStr);
								}
								return substr($firstSubStr, 0, $endCharCount);
							} else {
								return '';
							}
						}

						if($getLan == "/my/"){	
							$queryTCBM = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='79'");
							$resTCBM = $queryTCBM->num_rows;
							if($resTCBM > 0){
								
								if($rowTCBM = $queryTCBM->fetch_assoc()){ 
							
									$idBM  = $rowTCBM['pmt_id'];
									
									$dateLastupdated2Color = $rowTCBM['pmt_lastupdated'];
									$dateConvert2Color = strtotime($dateLastupdated2Color); 
									
									$a1 = explode('/',$rowTCBM['pmt_lastupdated']);
									$dateFormat2Color = (int)($a1[2].$a1[1].$a1[0]);
									
									$timeSaveTerms = $rowTCBM['pmt_time'];
									
									if ( $getUserDetails->data[0]->signature_img != '' ) {

										$getSigColor = $getUserDetails->data[0]->signature_img;
										$getSigColor = strtok($getSigColor, '_');
										$getSigColor = str_replace('-', '/', $getSigColor);
										$dateConvertColor = strtotime($getSigColor); 

										$a2 = explode('/',$getSigColor);
										$dateFormatColor = (int)($a2[2].$a2[1].$a2[0]);
										
										$getTime = getBetween2($getUserDetails->data[0]->signature_img,"_","_");
										if(strlen($getTime) == '7'){
											$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
										}else{
											$getTime = str_replace("-",":",$getTime).':00';
										}
										
										$healthy = ['<span class="marker">', '</span>'];
										$yummy   = ['<font style="color:#dc3545;font-style: Arial, Helvetica, sans-serif;">', '</font>'];

																		if($dateFormat2Color > $dateFormatColor){
																			$newPhrase = str_replace($healthy, $yummy, htmlspecialchars_decode($rowTCBM['pmt_pagedetail']));
																			echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.$newPhrase.'</font>';
																		}else if($dateFormat2Color < $dateFormatColor){
																			 echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.htmlspecialchars_decode($rowTCBM['pmt_pagedetail']).'</font>';
																		}else if($dateFormat2Color = $dateFormatColor){
																			if($timeSaveTerms >= $getTime){
																				$newPhrase = str_replace($healthy, $yummy, htmlspecialchars_decode($rowTCBM['pmt_pagedetail']));
																				echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.$newPhrase.'</font>';
																			}else{
																				 echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.htmlspecialchars_decode($rowTCBM['pmt_pagedetail']).'</font>';
																			}
																		}else{
																			  echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.htmlspecialchars_decode($rowTCBM['pmt_pagedetail']).'</font>';
																		}                    
									}else{
										echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.htmlspecialchars_decode($rowTCBM['pmt_pagedetail']).'</font>';
									}
								}
							}
						}else{
							$queryTCBI = $conn->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='78'");
							$resTCBI = $queryTCBI->num_rows;
							if($resTCBI > 0){
								if($rowTCBI = $queryTCBI->fetch_assoc()){ 
									$idBI  = $rowTCBI['pmt_id'];
								
									$dateLastupdated2Color = $rowTCBI['pmt_lastupdated'];
									$dateConvert2Color = strtotime($dateLastupdated2Color); 
									
									$a3 = explode('/',$rowTCBI['pmt_lastupdated']);
									$dateFormat2Color = (int)($a3[2].$a3[1].$a3[0]);
									
									$timeSaveTerms = $rowTCBI['pmt_time'];
									
									if ( $getUserDetails->data[0]->signature_img != '' ) {
										$getSigColor = $getUserDetails->data[0]->signature_img;
										$getSigColor = strtok($getSigColor, '_');
										$getSigColor = str_replace('-', '/', $getSigColor);
										$dateConvertColor = strtotime($getSigColor); 
										
										$a4 = explode('/',$getSigColor);
										$dateFormatColor = (int)($a4[2].$a4[1].$a4[0]);
										
										$getTime = getBetween2($getUserDetails->data[0]->signature_img,"_","_");
										if(strlen($getTime) == '7'){
											$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
										}else{
											$getTime = str_replace("-",":",$getTime).':00';
										}
										
										$healthy = ['<span class="marker">', '</span>'];
										$yummy   = ['<font style="color:#dc3545;font-style: Arial, Helvetica, sans-serif;">', '</font>'];

																		if($dateFormat2Color > $dateFormatColor){
																			$newPhrase = str_replace($healthy, $yummy, htmlspecialchars_decode($rowTCBI['pmt_pagedetail']));
																			echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.$newPhrase.'</font>';
																		}else if($dateFormat2Color < $dateFormatColor){
																			 echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.htmlspecialchars_decode($rowTCBI['pmt_pagedetail']).'</font>';
																		}else if($dateFormat2Color = $dateFormatColor){
																			if($timeSaveTerms >= $getTime){
																				$newPhrase = str_replace($healthy, $yummy, htmlspecialchars_decode($rowTCBI['pmt_pagedetail']));
																				echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.$newPhrase.'</font>';
																			}else{
																				 echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.htmlspecialchars_decode($rowTCBI['pmt_pagedetail']).'</font>';
																			}
																		}else{
																			  echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.htmlspecialchars_decode($rowTCBI['pmt_pagedetail']).'</font>';
																		}
											
									}else{
										echo '<font style="font-style: Arial, Helvetica, sans-serif;">'.htmlspecialchars_decode($rowTCBI['pmt_pagedetail']).'</font>';
									}
								}
							}
						}
						
								    if( $deviceIs == "mobile" ){
								        $width = '300';
								        $style = 'style="border: 1px solid black;margin-right:23px;"';
								        $textRead = 'font-size: 15.5px;';
		
								        if($getLan == "/my/"){
								            $signHere = 'position: absolute;margin-left:16%;margin-top:30%';
								        }else{
								            $signHere = 'position: absolute;margin-left:23%;margin-top:30%';
								        }
								    }else{
								        $width = '450';
								        $style = 'style="border: 1px solid black;"';
								        $textRead = 'font-size: 18px;';
								        
								        if($getLan == "/my/"){
								            $signHere = 'position: absolute;margin-left:12%;margin-top:10%';
								        }else{
								            $signHere = 'position: absolute;margin-left:14%;margin-top:10%';
								        }
								    }
						?>


							<div class="col-lg-12 text-right">
								<p class="notbold"><font style="font-style: Arial, Helvetica, sans-serif;<?PHP echo $textRead; ?>"> <?PHP echo $signAgreed; ?> </font></p>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="pull-right" id="canvas" > 
								<?PHP
									$pix = $getUserDetails->data[0]->signature_img;
									$pixAll = $pix.".png";
									
                            		$getSig = strtok($pix, '_');
                            		$getSig = str_replace('-', '/', $getSig);
                            		$dateConvert = strtotime($getSig); 
                            		
                            		$a5 = explode('/',$getSig);
                            		$dateFormat = (int)($a5[2].$a5[1].$a5[0]);
										

									if ($getUserDetails->data[0]->signature_img != '') {									
										
												$queryProof1 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='78' AND pmt_noti='TRUE' "; 
												$resultProof1 = $conn->query($queryProof1); 
												if($resultProof1->num_rows > 0){ 
												  
													$rowProof1 = $resultProof1->fetch_assoc();
													$dateLastupdated2 = $rowProof1['pmt_lastupdated'];
				
													$timeSaveTerms = $rowProof1['pmt_time'];
												
													$dateConvert2 = strtotime($dateLastupdated2); 
													
													$a6 = explode('/',$rowProof1['pmt_lastupdated']);
													$dateFormat2 = (int)($a6[2].$a6[1].$a6[0]);
													
													$getTime = getBetween2($getUserDetails->data[0]->signature_img,"_","_");
													if(strlen($getTime) == '7'){
														$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
													}else{
														$getTime = str_replace("-",":",$getTime).':00';
													}

													if($dateFormat2 > $dateFormat){
														?> 
														<span id="signHere" class="" style="<?PHP echo $signHere; ?>" ><b><?PHP echo $signHereText; ?></b></span>
														<div class="sig sigWrapper">
															<div class="typed"></div>
															<!-- style="border: 1px solid black;" -->
															<canvas class="pad" id="newSignature" width="<?PHP echo $width; ?>" height="314" ontouchstart="touchSign()" onClick="touchSign2()" onmouseover="touchSign3()" <?PHP echo $style; ?> ></canvas>
															<input type="hidden" id="output" name="output" class="output">
														</div>
														<?PHP
													}else if($dateFormat2 < $dateFormat){
														?><img width="<?PHP echo $width; ?>" height="314" src="<?php echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature"> <?PHP
													}else if($dateFormat2 = $dateFormat){
														if($timeSaveTerms >= $getTime){
															?> 
															<span id="signHere" class="" style="<?PHP echo $signHere; ?>" ><b><?PHP echo $signHereText; ?></b></span>
															<div class="sig sigWrapper">
																<div class="typed"></div>
																<canvas class="pad" id="newSignature" width="<?PHP echo $width; ?>" height="314" ontouchstart="touchSign()" onClick="touchSign2()" onmouseover="touchSign3()" <?PHP echo $style; ?> ></canvas>
																<input type="hidden" id="output" name="output" class="output">
															</div>
															<?PHP
														}else{
															?><img width="<?PHP echo $width; ?>" height="314" src="<?php echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature"> <?PHP
														}
													}else{
														 ?><img width="<?PHP echo $width; ?>" height="314" src="<?php echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature"> <?PHP
													}
												}else{
													?><img width="<?PHP echo $width; ?>" height="314" src="<?php echo APP_ROOT."images/signature/".$pixAll; ?>" alt="signature"> <?PHP
												}
									} else {
										?> 
										<span id="signHere" class="" style="<?PHP echo $signHere; ?>" ><b><?PHP echo $signHereText; ?></b></span>
										<div class="sig sigWrapper">
											<div class="typed"></div>
											<canvas class="pad" id="newSignature" width="<?PHP echo $width; ?>" height="314" ontouchstart="touchSign()" onClick="touchSign2()" onmouseover="touchSign3()" <?PHP echo $style; ?> ></canvas>
											<input type="hidden" id="output" name="output" class="output">
										</div>
										<?PHP
									}
									?>
								</div>
								<div class="clearfix"> </div>

								<div class="notbold pull-left bottom-align-text"> 
								<?PHP
								if ($getUserDetails->data[0]->signature_img != '') {
									$salutation = $getUserDetails->data[0]->salutation;
									$firstname = $getUserDetails->data[0]->ud_first_name;
									//$fullname = $firstname." ".$getUserDetails->data[0]->ud_last_name;
									$fullname = ucwords($salutation.' '.$firstname);

									$date = $getUserDetails->data[0]->signature_img;
									$date = strtok($date, '_');
									
									
												$queryProof3 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='78' AND pmt_noti='TRUE' "; 
												$resultProof3 = $conn->query($queryProof3); 
												if($resultProof3->num_rows > 0){ 
												  
													$rowProof3 = $resultProof3->fetch_assoc();
													$dateLastupdated3 = $rowProof3['pmt_lastupdated'];
													$timeSaveTerms = $rowProof3['pmt_time'];
													
													$getTime = getBetween2($getUserDetails->data[0]->signature_img,"_","_");
													if(strlen($getTime) == '7'){
														$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
													}else{
														$getTime = str_replace("-",":",$getTime).':00';
													}
												
													$dateConvert3 = strtotime($dateLastupdated3); 
													
													$a7 = explode('/',$rowProof3['pmt_lastupdated']);
													$dateFormat3 = (int)($a7[2].$a7[1].$a7[0]);
													
													if($dateFormat3 > $dateFormat){
													}else if($dateFormat3 < $dateFormat){
														echo 'Name : '.$fullname.'<br/>';
														echo 'Date : '.$date;
													}else if($dateFormat3 = $dateFormat){
														if($timeSaveTerms >= $getTime){
														}else{
															echo 'Name : '.$fullname.'<br/>';
															echo 'Date : '.$date;
														}
													}else{
														echo 'Name : '.$fullname.'<br/>';
														echo 'Date : '.$date;
													}
													
													
												}else{
													echo 'Name : '.$fullname.'<br/>';
													echo 'Date : '.$date;
												}
									
									
								}
								?>
								</div>
							</div>

		
							<div class="col-lg-12">
								<div class="text-right pull-right" style="margin-top:10px;">
								<?PHP
								if ($getUserDetails->data[0]->signature_img != '') {
												$queryProof4 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='78' AND pmt_noti='TRUE' "; 
												$resultProof4 = $conn->query($queryProof4); 
												if($resultProof4->num_rows > 0){ 
												  
													$rowProof4 = $resultProof4->fetch_assoc();
													$dateLastupdated4 = $rowProof4['pmt_lastupdated'];
										  
													$timeSaveTerms = $rowProof4['pmt_time'];
													$getTime = getBetween2($getUserDetails->data[0]->signature_img,"_","_");
													if(strlen($getTime) == '7'){
														$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
													}else{
														$getTime = str_replace("-",":",$getTime).':00';
													}
													
													$dateConvert4 = strtotime($dateLastupdated4); 
													
													$a8 = explode('/',$rowProof4['pmt_lastupdated']);
													$dateFormat4 = (int)($a8[2].$a8[1].$a8[0]);
													
													if($dateFormat4 > $dateFormat){
														//echo "<p style='font-style: Arial, Helvetica, sans-serif;font-size: 12px;'> * Please sign at the designated area</p>";
													}else if($dateFormat4 < $dateFormat){
													}else if($dateFormat4 = $dateFormat){
														if($timeSaveTerms >= $getTime){
															//echo "<p style='font-style: Arial, Helvetica, sans-serif;font-size: 12px;'> * Please sign at the designated area</p>";
														}else{
														}
													}else{
													}
												}else{
												}
								} else {
									//echo "<p style='font-style: Arial, Helvetica, sans-serif;font-size: 12px;'> * Please sign at the designated area</p>";
								}
								?>
								<?PHP 
								if ($getUserDetails->data[0]->signature_img != '') {
												$queryProof5 = "SELECT * FROM tk_page_manage_translation WHERE pmt_id='78' AND pmt_noti='TRUE' "; 
												$resultProof5 = $conn->query($queryProof5); 
												if($resultProof5->num_rows > 0){ 
												  
													$rowProof5 = $resultProof5->fetch_assoc();
													$dateLastupdated5 = $rowProof5['pmt_lastupdated'];

										  
													$timeSaveTerms = $rowProof5['pmt_time'];
													$getTime = getBetween2($getUserDetails->data[0]->signature_img,"_","_");
													if(strlen($getTime) == '7'){
														$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
													}else{
														$getTime = str_replace("-",":",$getTime).':00';
													}
												   
													$a9 = explode('/', $rowProof5['pmt_lastupdated']);
													$dateFormat5 = (int)$a9[2].$a9[1].$a9[0];

													if($dateFormat5 > $dateFormat){
														echo '<button type="button" id="btnSave" class="btn btn-success" onclick="signatureSave()">'.$btnSave.'</button>&nbsp;';
														echo '<button type="button" id="btnLoading" class="btn btn-success hidden" disabled> <i class="fa fa-spinner fa-spin"></i> Loading </button>&nbsp;';
														echo '<a type="button" class="btn btn-danger clearButton" href="#clear">'.$btnClear.'</a>';
													}else if($dateFormat5 < $dateFormat){
														echo '<button type="submit" class="btn btn-primary" style="margin-top:-90px;">Copy PDF</button>';
													}else if($dateFormat5 = $dateFormat){
														if($timeSaveTerms >= $getTime){
															echo '<button type="button" id="btnSave" class="btn btn-success" onclick="signatureSave()">'.$btnSave.'</button>&nbsp;';
															echo '<button type="button" id="btnLoading" class="btn btn-success hidden" disabled> <i class="fa fa-spinner fa-spin"></i> Loading </button>&nbsp;';
															echo '<a type="button" class="btn btn-danger clearButton" href="#clear">'.$btnClear.'</a>';
														}else{
															echo '<button type="submit" class="btn btn-primary" style="margin-top:-90px;">Copy PDF</button>';
														}
													}else{
														echo '<button type="submit" class="btn btn-primary" style="margin-top:-90px;">Copy PDF</button>';
													}
												}else{
													echo '<button type="submit" class="btn btn-primary" style="margin-top:-90px;">Copy PDF</button>';
												}
									
									
									
								}else{
									echo '<button type="button" id="btnSave" class="btn btn-success" onclick="signatureSave()">'.$btnSave.'</button>&nbsp;';
									echo '<button type="button" id="btnLoading" class="btn btn-success hidden" disabled> <i class="fa fa-spinner fa-spin"></i> Loading </button>&nbsp;';
									echo '<a type="button" class="btn btn-danger clearButton" href="#clear">'.$btnClear.'</a>';
								}
								?>				
								</div>
							</div>



						</div>
					</div>
			</div>
			</form>
			</div>
			

	</div>

    </div>
   </div>
</section>

<script src="pdf/signature-pad-master/jquery.signaturepad.js"></script>
<script>
$(document).ready(function() {
	$('.sigPad').signaturePad({
		drawOnly:true, 
		lineTop:220, 
		bgColour : '#ffffff', 
		penColour : '#000000',
		penWidth : 5
	});
});
</script>
<script src="pdf/signature-pad-master/assets/json2.min.js"></script>

 <style>
.gsc-control-cse{
	padding:0px !important;
	border-width:0px !important;
}

form.gsc-search-box,table.gsc-search-box{
	margin-bottom:0px !important;
}
.gsc-search-box .gsc-input{
	padding:0px 4px 0px 6px !important;
}
#gsc-iw-id1{
	border-width: 0px !important;
	height: auto !important;
	box-shadow:none !important;
}
#gs_tti50{
	padding:0px !important;
}
#gsc-i-id1{
	height:33px !important;
	padding:0px !important;
	background:none !important;
	text-indent:0px !important;
}
.gsib_b{
	display:none;
}
button.gsc-search-button{
        display:block;
        width:13px !important;
        height:13px !important;
        border-width:0px !important;
        margin:0px !important;
        padding: 10px 6px 10px 13px !important;
        outline:none;
        cursor:pointer;
        box-shadow:none !important;
        box-sizing: content-box !important;
}
.gsc-branding{
	display:none !important;
}
.gsc-control-cse,#gsc-iw-id1{
	background-color:transparent !important;
}
#search-box{
	width:300px;
	height: 37px;
	margin:0 auto;
	background-color: #FFF;
	border: 2px solid #000;
	border-radius: 4px;
}
#gsc-i-id1{
	color:#000;
}
button.gsc-search-button{
	padding:10px !important;
	background-color: #f1592a !important;
	border-radius: 3px !important;
}
</style>
<footer >

   <section class="addr">
      <div class="container">
         <div class="row">
            <div class="col-md-5 col-sm-6 col-md-push-1">
               <h3>Follow us on social media :</h3>
               <ul class="footer_followus">                
                  <li><a href="https://www.facebook.com/TutorKamiDotCom"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="https://twitter.com/TutorKami"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="https://www.instagram.com/tutorkami/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
                <ul class="addr_list">                
                  <li>Office : 27-2, Jalan Selasih U12/J, <br>
                  Section U12, Taman Cahaya Alam,<br>
                  Shah Alam 40170 Selangor
                  </li>
                  <li>012-230 9743</li>
                  <li><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="385b57564c595b4c784c4d4c574a53595551165b5755">[email&#160;protected]</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-2">
               <h3>Site Navigation</h3>
               <ul class="nl">
                  <li><a href="index.php"  class="" >Home</a></li>
                  <li><a href="https://www.tutorkami.com/blog/" >Latest News</a></li>
                  <li><a href="about.php" >About Us</a></li>
                  <li><a href="tutor.php" >I'm a Tutor</a></li>
                  <li><a href="https://www.tutorkami.com/tips_for_parent.php" >Tips for Parents</a></li>
                  <li><a href="tutor-login.php" >Sign In</a></li>
               </ul>
            </div>
            <div class="col-md-4 col-sm-4">
               <h3>Search this site</h3>
               <ul class="nl">
					<div id="search-box">
					   <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
						 (function() {
						   var cx = '012605317305899767437:wmbhz60c7bk';
						   var gcse = document.createElement("script");
						   gcse.type = "text/javascript";
						   gcse.async = true;
						   gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
						   var s = document.getElementsByTagName("script")[0];
						   s.parentNode.insertBefore(gcse, s);
						 })();
						 window.onload = function()
						 { 
						   var searchBox =  document.getElementById("gsc-i-id1");
						   searchBox.placeholder="Google Custom Search";
						   searchBox.title="Google Custom Search"; 
						 }
					   </script>
					   <gcse:search></gcse:search>
					</div>                 
                  <li><a href="https://www.tutorkami.com/">Privacy Policy</a></li>
                  <li><a href="https://www.tutorkami.com/terms_condition.php">Terms of Use</a></li>
               </ul>
            </div>
         </div>
      </div>
   </section>
   
<script>
function signatureSave() {
    
	document.getElementById('btnLoading').classList.remove("hidden");
	document.getElementById('btnSave').classList.add("hidden");

	var displayid = document.getElementById("displayid").value;
	var output = document.getElementById("output").value;
	var canvas = document.getElementById("newSignature");
	var dataURL = canvas.toDataURL("image/png");
	
	 
	 if( output == "" ){
        setTimeout(function() {
            document.getElementById('btnLoading').classList.add("hidden");
            document.getElementById('btnSave').classList.remove("hidden");
            alert("Empty Signature");
        }, 1000);
	 }else{
		 if(displayid != ''){
			$.ajax({
				type: "POST",
				url: 'clients-terms2.php',
				data: {displayid: displayid, dataURL: dataURL},
				success: function(response){
                    /*setTimeout(function() {
    				    document.getElementById('btnLoading').classList.add("hidden");
    				    document.getElementById('btnSave').classList.remove("hidden");
    					//alert(response);
    					//document.location.reload(true);
                        document.getElementById('myModalButtonGetFullName').click();   
                    }, 1000);*/
        			$.ajax({
        				type: "POST",
        				url: 'show-popup.php',
        				data: {displayid: displayid},
        				success: function(result){
        				    if( result == 'no' ){
        				        document.getElementById('myModalButtonGetFullName').click(); 
        				    }else if( result == 'yes' ){
        				        document.location.reload(true);
        				    }else{
        				        alert(result);
        				    }
        				}
        			});
				}
			});
		 }else{
            setTimeout(function() {
			    document.getElementById('btnLoading').classList.add("hidden");
    			document.getElementById('btnSave').classList.remove("hidden");
			    alert("Something Wrong Happened !!");
            }, 1000);
		 }
	 }

}

function closeModal() {
  window.location.href = 'https://www.tutorkami.com/clients_profile';
}
function clickOk() {
  document.getElementById('thisClose').click(); 
  setTimeout(function() {
      document.getElementById('textModal').innerHTML = 'Please click Ok';
      document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default onClick=closeModal()>Ok</button>';
      document.getElementById('myModalButton').click();   
      window.open("https://wa.me/60103169072?text=Allow%20automatic%20message%20from%20TutorKami.com");
  }, 500);
/*  
  window.open("https://wa.me/60103169072?text=Allow%20automatic%20message%20from%20TutorKami.com");
  window.location.href = 'https://www.tutorkami.com/clients_profile';

  setTimeout(function() { 
      document.getElementById('textModal').innerHTML = 'Thank you, we will contact you soon';
      document.getElementById('buttonModal').innerHTML = '<button type=button class=btn btn-default onClick=closeModal()>Close</button>';
      document.getElementById('myModalButton').click();          
  }, 1200);
*/
}
function clickNotNow() {
  document.getElementById('thisClose').click();  
  setTimeout(function() { 
      document.getElementById('textModal').innerHTML = 'If you want to give us permission later, you can go to your Profile, and click the button &#39;To subscribe… &#39;. Thank you.';
      document.getElementById('buttonModal').innerHTML = '<button style=background-color:#357BB6 type=button class=btn btn-default onClick=closeModal()>Close</button>';
      document.getElementById('myModalButton').click();          
  }, 1200);

}

function touchSign() {
  document.getElementById('signHere').classList.add("hidden");
}
function touchSign2() {
  document.getElementById('signHere').classList.add("hidden");
}
function touchSign3() {
  document.getElementById('signHere').classList.add("hidden");
}

function submitName() {
  var name = document.getElementById('txtsubmitName').value;
  var ID = document.getElementById('txtsubmitNameID').value;
  if( name == '' ){
      alert('Please enter your full name');
  }else if( ID == '' ){
      alert('Error! Something happen..');
  }else{
      $.ajax({
        type: "POST",
        url: 'clients-terms2-name.php',
        data: {ID: ID, name: name},
        success: function(response){
            //alert(name + ' ' + ID);
            document.location.reload(true);      
        }
      });
  }
}

function oneTime() {
      $.ajax({
        type: "POST",
        url: 'show-popup-terms.php',
        data: {hide: 'yes'},
        success: function(response){
            //alert(response);  
        }
      });
}
</script>