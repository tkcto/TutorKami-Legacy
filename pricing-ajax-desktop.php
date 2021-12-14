<style>
.alert-message
{
    margin: 20px 0;
    padding: 20px;
    border-left: 3px solid #eee;
}
.alert-message h4
{
    margin-top: 0;
    margin-bottom: 5px;
}
.alert-message p:last-child
{
    margin-bottom: 0;
}
.alert-message code
{
    background-color: #fff;
    border-radius: 3px;
}
.alert-message-success
{
    /*background-color: #F4FDF0;
    border-color: #3C763D;*/
}
.alert-message-success h4
{
    /*color: #3C763D;*/
}
.alert-message-danger
{
    background-color: #fdf7f7;
    border-color: #d9534f;
}
.alert-message-danger h4
{
    color: #d9534f;
}
.alert-message-warning
{
    background-color: #fcf8f2;
    border-color: #f0ad4e;
}
.alert-message-warning h4
{
    color: #f0ad4e;
}
.alert-message-info
{
    background-color: #f4f8fa;
    border-color: #5bc0de;
}
.alert-message-info h4
{
    color: #5bc0de;
}
.alert-message-default
{
    background-color: #EEE;
    border-color: #B4B4B4;
}
.alert-message-default h4
{
    color: #000;
}
.alert-message-notice
{
    background-color: #FCFCDD;
    border-color: #BDBD89;
}
.alert-message-notice h4
{
    color: #444;
}


.fa-question-circle {
  color:#3a87ad;
  margin-left:5px;
}
.no-border {
    border-bottom:0 solid transparent;
}


/* button switch on */
.switch {
  position: relative;
  display: inline-block;
  /*width: 30px;
  height: 17px;*/
  width: 70px;
  height: 27px;
  float:right;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ADD8E6;
  -webkit-transition: .2s;
  transition: .2s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 23px;
  width: 23px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .2s;
  transition: .2s;
}

input.success:checked + .slider {
  background-color: #232662;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(43px);
  -ms-transform: translateX(43px);
  transform: translateX(43px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 17px;
}

.slider.round:before {
  border-radius: 50%;
}

.btn-default, .btn-default:active, .btn-default:visited {
    background-color: #232662 !important;
}

.btn-default:hover {
    background-color: #232662 !important;
    transition: all 1s ease;
    -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    -ms-transition: all 1s ease;
}

.bootstrap{
  width:250px;
  border-radius: 5px;
  background: #fff;
  border: 1px solid #ccc;
  outline:none;
  padding: 6px;
}





.close {
  float: right;
  font-size: 20px;
  font-weight: bold;
  line-height: 18px;
  color: #000000;
  text-shadow: 0 1px 0 #ffffff;
  opacity: 0.2;
  filter: alpha(opacity=20);
}
.close:hover {
  color: #000000;
  text-decoration: none;
  opacity: 0.4;
  filter: alpha(opacity=40);
  cursor: pointer;
}

.alert {
  padding: 8px 35px 8px 14px;
  margin-bottom: 18px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background-color: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  color: #c09853;
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
  background-color: #dff0d8;
  border-color: #d6e9c6;
  color: #468847;
}
.alert-danger,
.alert-error {
  background-color: #f2dede;
  border-color: #eed3d7;
  color: #b94a48;
}
.alert-info {
  background-color: #d9edf7;
  border-color: #bce8f1;
  color: #3a87ad;
}
.alert-block {
  padding-top: 14px;
  padding-bottom: 14px;
}
.alert-block > p,
.alert-block > ul {
  margin-bottom: 0;
}
.alert-block p + p {
  margin-top: 5px;
}

/* https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_outline_buttons */
.btn2 {
  border: 2px solid black;
  background-color: white;
  color: black;
  padding: 7px 14px;
  font-size: 12px;
  cursor: pointer;
}
.success1 {
  background-color: #4CAF50;
  border-color: #4CAF50;
  color: white;
  padding-left:30px;
  padding-right:30px;
}
.success2 {
  border-color: #4CAF50;
  color: green;
  padding-left:30px;
  padding-right:30px;
}


</style>
<?php
//Include the database configuration file
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if(!empty($_POST["level"])){
	
	$queryLevel = "SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id = ".$_POST['level']."";
	$resultLevel = $conn->query($queryLevel);
	if ($resultLevel->num_rows > 0) {
		$rowLevel = $resultLevel->fetch_assoc();
		$thisLevel = $rowLevel['tc_title'];
	}else{
		$thisLevel = $_POST['level'];
	}

// string-after ,	
/*$arr = explode(',', $_POST['state']);
$important = $arr[1];

	$sqlState = "SELECT * FROM tk_states WHERE st_name = ".$important."  ";
	$resultState = $conn->query($sqlState);
	if ($resultState->num_rows > 0) {
		$rowState = $resultState->fetch_assoc();
		$thisState = $rowState['st_id'];
	}*/
	
// string-before ,	
$arrCity = explode(",", $_POST['state'], 2);
$first = trim($arrCity[0]);

	$sqlCity = "SELECT * FROM tk_cities WHERE city_name = '".$first."'  ";
	$resultCity = $conn->query($sqlCity);
	if ($resultCity->num_rows > 0) {
		$rowCity = $resultCity->fetch_assoc();
		$thisCity = $rowCity['city_id'];
		$thisCityName = $rowCity['city_name'];
	}else{
	    $thisCity = '';
	    $thisCityName = '';
	}

// string-after ,	
$arrState = explode(',', $_POST['state']);
$second = trim($arrState[1]);

	$sqlState = "SELECT * FROM tk_states WHERE st_name LIKE '".$second."'  ";
	$resultState = $conn->query($sqlState);
	if ($resultState->num_rows > 0) {
		$rowState = $resultState->fetch_assoc();
		$thisState = $rowState['st_id'];
	    $thisStateName = $rowState['st_name'];
	}else{
	    $thisState = '';
	    $thisStateName = '';
	}
	
	
	
	//$sqltest = "SELECT * FROM tk_location_rate2 WHERE level = ".$_POST['level']." AND state = ".$_POST['state']." ";
	$sqltest = "SELECT * FROM tk_location_rate2 WHERE level = ".$_POST['level']." AND state = ".$thisState." ";
	$resulttest = $conn->query($sqltest);
	if ($resulttest->num_rows > 0) {
		while($rowtest = $resulttest->fetch_assoc()){
			$thisArray = $rowtest['city'];
			//if (in_array($_POST['city'], (explode(',',$thisArray)))){
			if (in_array($thisCity, (explode(',',$thisArray)))){
				$arrThis = $rowtest['id'];
			break;
			}
		}
	}
	
if( $_POST['state'] == 'Online Tuition' ){
    $sqlRate = "SELECT * FROM tk_online_rates WHERE or_level_id = '".$_POST['level']."'  ";
}else{
	//$sqlRate = "SELECT * FROM tk_location_rate2 WHERE level = ".$_POST['level']." AND state = ".$_POST['state']." AND city LIKE '%".$_POST['city']."%' ";
	$sqlRate = "SELECT * FROM tk_location_rate2 WHERE id = ".$arrThis."  ";    
}
	
	$resultRate = $conn->query($sqlRate);
	if ($resultRate->num_rows > 0) {
		$rowRate = $resultRate->fetch_assoc();
			
			if( $_POST['state'] == 'Online Tuition' ){
			    $thisRate = $rowRate['or_rate'];
    			if($_POST['person'] == 1){
    				$MonthlyFee = $thisRate * 1.5 * 4;
    				$pricePerStudent0 = round( $MonthlyFee / $_POST['person'], 1, PHP_ROUND_HALF_UP);
    				$pricePerStudent = number_format($pricePerStudent0, 2);
    				$RegistrationFee = $_POST['person'] * 50;
    				$Total = $MonthlyFee + $RegistrationFee;
    			}else{
    				$MonthlyFee = $thisRate * 1.5 * 4;
    				$pricePerStudent0 = round( $MonthlyFee / $_POST['person'], 1, PHP_ROUND_HALF_UP);
    				$pricePerStudent = number_format($pricePerStudent0, 2);
    				$RegistrationFee = $_POST['person'] * 50;
    				$Total = $MonthlyFee + $RegistrationFee;
    			}
			}else{
			    $thisRate = $rowRate['rate'];
    			/*$OneHour = $thisRate;
    			$halfHour = $thisRate / 2;
    			$OneHalfHour = $OneHour + $halfHour;
    			$fourWeek = $OneHalfHour * 4;*/
    			
    			if($_POST['person'] == 1){
    				$MonthlyFee = $thisRate * 1.5 * 4;
    				$pricePerStudent0 = round( $MonthlyFee / $_POST['person'], 1, PHP_ROUND_HALF_UP);
    				$pricePerStudent = number_format($pricePerStudent0, 2);
    				$RegistrationFee = $_POST['person'] * 50;
    				$Total = $MonthlyFee + $RegistrationFee;
    			}else{
    				$MonthlyFee = $thisRate * 1.5 * 4;
    				$pricePerStudent0 = round( $MonthlyFee / $_POST['person'], 1, PHP_ROUND_HALF_UP);
    				$pricePerStudent = number_format($pricePerStudent0, 2);
    				$RegistrationFee = $_POST['person'] * 50;
    				$Total = $MonthlyFee + $RegistrationFee;
    			}
			}
			
			?>
<?PHP
if( $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/price' ){
	$pageStyle0 = '';
	$pageStyle1 = '';
	$pageStyle2 = 'style="text-align: right;"';
	$pageOpenFont = '';
	$pagecloseFont = '';
	
	$pageStyle3 = 'style="text-align:center;margin-right:-30px;"';
	$pageStyle4 = 'style="margin-right:-30px;"';
	$pageStyle5 = 'style="margin-right:-5px;"';
	$pageStyle6 = 'style="margin-right:-30px;"';
	$pageStyle7 = '';
	$pageStyle8 = 'style="margin-right:-30px;"';
	$pageStyleSpace = '';
	$pageStyle = '';
}else{
	$pageStyle0 = 'style="background-color:white;text-align: left;"';
	$pageStyle1 = 'style="background-color:white;"';
	$pageStyle2 = 'style="text-align: right;color:black;"';
	$pageOpenFont = '<font color="black">';
	$pagecloseFont = '</font>';
	
	$pageStyle3 = 'style="text-align:center;margin-left:-30px;"';
	$pageStyle4 = 'style="margin-left:-30px;"';
	$pageStyle5 = 'style="margin-left:-5px;"';
	$pageStyle6 = 'style="margin-left:-30px;color:white;"';
	$pageStyle7 = 'style="color:white;"';
	$pageStyle8 = 'style="margin-left:-30px;color:white;"';
	$pageStyleSpace = '&nbsp;&nbsp;';
	$pageStyle = '';
	
}
?>


<?php
if (!empty($_SERVER['HTTP_CLIENT_IP']))   {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
    $ip_address = $_SERVER['REMOTE_ADDR'];
}

if( $ip_address == '219.92.185.115' ){
?>
<input style="width:30%;" type="text" id="statePost" class="" value="<?PHP echo $_POST['state']; ?>">
<input style="width:30%;" type="text" id="hiddenCurentRate" class="" value="<?PHP echo $thisRate; ?>">


<input style="width:30%;" id="inputRate_id"    name="inputRate_id"    type="text" class="hidden" value="<?PHP echo $_SESSION['sessionRate_id'];  ?>">
<input style="width:30%;" id="inputRate_rate"  name="inputRate_rate"  type="text" class="hidden" value="<?PHP echo $_SESSION['sessionRate_rate'];  ?>">
<input style="width:30%;" id="inputRate_city"  name="inputRate_city"  type="text" class="hidden" value="<?PHP echo $_SESSION['sessionRate_city'];  ?>">
<input style="width:30%;" id="inputRate_state" name="inputRate_state" type="text" class="hidden" value="<?PHP echo $_SESSION['sessionRate_state'];  ?>">
<?PHP
}else{
?>
<input type="text" id="statePost" class="hidden" value="<?PHP echo $_POST['state']; ?>">
<input type="text" id="hiddenCurentRate" class="hidden" value="<?PHP echo $thisRate; ?>">


<input style="width:30%;" id="inputRate_id"    name="inputRate_id"    type="text" class="hidden" value="<?PHP echo $_SESSION['sessionRate_id'];  ?>">
<input style="width:30%;" id="inputRate_rate"  name="inputRate_rate"  type="text" class="hidden" value="<?PHP echo $_SESSION['sessionRate_rate'];  ?>">
<input style="width:30%;" id="inputRate_city"  name="inputRate_city"  type="text" class="hidden" value="<?PHP echo $_SESSION['sessionRate_city'];  ?>">
<input style="width:30%;" id="inputRate_state" name="inputRate_state" type="text" class="hidden" value="<?PHP echo $_SESSION['sessionRate_state'];  ?>">
<?PHP   
}
?>


			<div class="col-sm-12" <?PHP echo $pageStyle0; ?>>
				<div class="alert-message alert-message-success" <?PHP echo $pageStyle1; ?>>
				<?PHP
				if(preg_match("/^[0-9.]+$/", $thisRate)) {
				?>
<div id="alertOk" class="alert alert-error hidden" style="margin-top: -10px;">
  <a class="close" data-dismiss="alert">×</a>
  Discount code applied. <strong>Enjoy!</strong>
</div>
<div id="alertInvalid" class="alert alert-error hidden" style="margin-top: -10px;">
  <a class="close" data-dismiss="alert">×</a>
  Invalid discount code. Please try again.
</div>
<div id="alertInvalid2" class="alert alert-error hidden" style="margin-top: -10px;">
  <a class="close" data-dismiss="alert">×</a>
  Discount code is invalid. Please select more sessions or/and duration.
</div>
<div id="alertInvalid3" class="alert alert-error hidden" style="margin-top: -10px;">
  <a class="close" data-dismiss="alert">×</a>
  Please insert discount code.
</div>

					<form class="form-horizontal" <?PHP echo $pageStyle1; ?>>
						<div class="form-group">
							<h4 class=" col-xs-6"><strong><?PHP echo $pageStyleSpace.$pageStyleSpace; echo $pageOpenFont; ?>FEES :<?PHP echo $pagecloseFont; ?></strong></h4>
							<div class="col-xs-6">
							
								<h4 id="monthlyFeeOutput" <?PHP echo $pageStyle2; ?>><?PHP echo $pageOpenFont; ?><?PHP echo "<strong> RM ".$MonthlyFee." / month</strong>"; ?><?PHP echo $pagecloseFont; ?></h4>
								<p id="pricePerStudent" style="color:blue;text-align:right;font-size:px;font-style:;margin-top:0px;margin-bottom:5px;display:none;"><b><?PHP echo "(RM ".$pricePerStudent." / student)"; ?></b></p>
							
							</div>
						</div>

						<br/>
						<div class="form-group" style="margin-top:-5px">
							<p class=" col-xs-5">
							    <span id="textNormalTuition">Normal Tuition</span><span id="textOnlineTuition" style="display:none">Online Tuition</span>
							    <br/><font id="slideRight" style="font-size:11px;"><?PHP if( $_POST['state'] == 'Online Tuition' ){ echo '(slide left for Normal Tuition)'; }else{ echo '(slide right for Online Tuition)'; } ?> </font>
							</p>
							
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										    <a style="padding-left:50px;" type="button" data-toggle="tooltip" data-placement="bottom" title="Enjoy lower rates with online class (click the slider on the right)"> <i style="color:#f1592a;font-size:30px;" class="fa fa-question-circle"></i> </a>
										    <span style="padding-left:50px;"></span>
									        <a href="online-tuition-tutoring-class.php" target="blank" type="button" data-toggle="tooltip" data-placement="bottom" title=""> <i style="color:#262262;font-size:30px;" class="fa fa-info-circle"></i> </a>

										<span class="input-group-btn">
											<label style="margin-right:-30px;">&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<label style="margin-right:-5px;"></label>
										</span>
										<span class="input-group-btn">
											<label class="switch">
												<input <?PHP if( $_POST['state'] == 'Online Tuition' ){ echo'checked'; } ?> type="checkbox" class="success" value="false" id="CheckboxnormalTuition" onChange="normalTuitionCheckbox()">
												<span class="slider round"></span>
											</label>
										</span>

									</div>
								</p>
							</div>
						</div>

						<div class="form-group" style="margin-top:-5px">
							<p class=" col-xs-5"><span id="textNormalTutor">Normal Tutor</span><span id="textSchoolTeacher" style="display:none">School Teacher</span>
								<a type="button" data-toggle="tooltip" data-placement="bottom" title="Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years"><i style="color:#f1592a;" class="fa fa-question-circle"></i></a>
							</p>
		    
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input <?PHP echo $pageStyle3; ?> type="text" id="normalTutorInput" class="form-control input-number" value="<?PHP echo "RM ".$thisRate." / hour"; ?>">
						
										<span class="input-group-btn">
											<label <?PHP echo $pageStyle4; ?>>&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<label <?PHP echo $pageStyle5; ?>></label>
										</span>
										<span class="input-group-btn">
											<label class="switch">
												<input type="checkbox" class="success" value="false" id="CheckboxnormalTutor" onChange="normalTutorCheckbox()">
												<span class="slider round"></span>
											</label>
										</span>
										
									</div>
								</p>
							</div>
						</div>

						<div class="form-group" style="margin-top:-5px">
							<p class=" col-xs-5">Student(s) <a data-html="true" type="button" data-toggle="tooltip" data-placement="bottom" title="<p style='text-align:left;'>Only add RM10/hour for each additional student. E.g if the rate for 1 student is RM50/hour, then for 2 students the rate is RM60/hour (so only RM30/hour per student). <b>Note</b>: the students must have the session <b>simultaneously</b> e.g. 2 students undergo 2 hours session and not separately</p>"> <i style="color:#262262;" class="fa fa-info-circle"></i> </a> </p>
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input <?PHP echo $pageStyle3; ?> type="text" id="NoOfStudentsInput" name="NoOfStudentsInput" class="form-control input-number" value="<?PHP echo $_POST['person']; //echo $_POST['person']." pax"; ?>" min="1" max="5" onChange="NoOfStudentsOnChange()">
						
										<span class="input-group-btn">
											<label <?PHP echo $pageStyle4; ?>>&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<button <?PHP echo $pageStyle6; ?> type="button" class="btn btn-default btn-number btn-sm" data-type="minus" data-field="NoOfStudentsInput">
												<span class="glyphicon glyphicon-minus" style="font-size:20px;"></span>
											</button>
										</span>
										<span class="input-group-btn">
											<button <?PHP echo $pageStyle7; ?> type="button" class="btn btn-default btn-number btn-sm" data-type="plus" data-field="NoOfStudentsInput">
												<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
											</button>
										</span>
										
									</div>
								</p>
							</div>
						</div>

						<div class="form-group" style="margin-top:-5px">
							<p class=" col-xs-5">Duration per Session</p>
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input <?PHP echo $pageStyle3; ?> type="text" id="sessionDuration" name="sessionDuration" class="form-control input-number" value="<?PHP echo "1 hour 30 mins"; ?>">

										<span class="input-group-btn">
											<label <?PHP echo $pageStyle4; ?>>&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<button <?PHP echo $pageStyle8; ?> type="button" class="btn btn-default btn-number btn-sm" data-type="minus" data-field="sessionDuration">
												<span class="glyphicon glyphicon-minus" style="font-size:20px;"></span>
											</button>
										</span>
										<span class="input-group-btn">
											<button <?PHP echo $pageStyle7; ?> type="button" class="btn btn-default btn-number btn-sm" data-type="plus" data-field="sessionDuration">
												<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
											</button>
										</span>
										
									</div>
								</p>
							</div>
						</div>
		
						<div class="form-group" style="margin-top:-5px">
							<p class=" col-xs-5">Sessions / Month <a data-html="true" type="button" data-toggle="tooltip" data-placement="bottom" title="<p style='text-align:left;'>Get RM5/hour discount when you take more than 1 session per week (<b>does not</b> apply for online tuition). E.g. If you take 1 session/week & the rate is RM50/hour, then by taking 2 sessions/week (8 sessions/month) the rate will only be RM45/hour. Discounts only applicable when lessons are <b>more than 1 month</b> </p>"> <i style="color:#262262;" class="fa fa-info-circle"></i> </a> <br/>
							<font id="sessionWeek" style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;">1 session(s)/week</font></p>
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input <?PHP echo $pageStyle3; ?> type="text" id="sessionPerMonth" name="sessionPerMonth" class="form-control input-number" value="<?PHP echo "4 sessions"; ?>" min="4" max="16" >
						
										<span class="input-group-btn">
											<label <?PHP echo $pageStyle4; ?>>&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<button <?PHP echo $pageStyle8; ?> type="button" class="btn btn-default btn-number btn-sm" data-type="minus" data-field="sessionPerMonth">
												<span class="glyphicon glyphicon-minus" style="font-size:20px;"></span>
											</button>
										</span>
										<span class="input-group-btn">
											<button <?PHP echo $pageStyle7; ?> type="button" class="btn btn-default btn-number btn-sm" data-type="plus" data-field="sessionPerMonth">
												<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
											</button>
										</span>
										
									</div>
								</p>
							</div>
						</div>
		
						<div class="form-group hidden" style="margin-top:-5px">
							<p class=" col-xs-5">* Discount code </p>
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input type="text" name="discount_code" id="discount_code" class="bootstrap" placeholder="Enter Discount code here">
										
										<span class="input-group-btn">
											<button id="btnDiscount" type="button" class="btn2 success1" style="margin-left:-70px;" onClick="loadDiscount()">
												<span style="font-size:14px;">Done</span>
											</button>
										</span>
										

										
									</div>
								</p>
							</div>
						</div>
<hr>
						<div class="form-group">
							<p class=" col-xs-3">Subtotal</p>
							<div class="col-xs-6"><center><font id="subtotalDic" class="hidden"></font></center></div>
							<div class="col-xs-3">
								<p id="subtotal" style="text-align: right;"><?PHP echo "RM ".$MonthlyFee; ?></p>
							</div>
						</div><div class="clearfix"></div><br/>
						<div class="form-group hidden" style="margin-top:-90px;" id="fieldDiscount">
							<p class=" col-xs-7" id="textDiscount"></p>
							<div class="col-xs-5">
								<p id="textDiscountAmount" style="text-align: right;"><strong><font color="red"><?PHP //echo "- RM ";//.$RegistrationFee; ?></font></strong></p>
							</div>
						</div>
						
						<div class="form-group" style="margin-top:0px;">
							<p class=" col-xs-7">Registration Fees (RM50/student, one-time only)</p>
							<div class="col-xs-5">
							
								<p id="registrationFeeOutput" style="text-align: right;"><?PHP echo "+ RM ".$RegistrationFee; ?></p>
								
							</div>
						</div>
<hr>
						<div class="form-group">
							<h4 class=" col-xs-6"><strong><?PHP echo $pageStyleSpace.$pageStyleSpace; echo $pageOpenFont; ?>TOTAL :<?PHP echo $pagecloseFont; ?></strong></h4>
							<div class="col-xs-6">

								<h4 id="totalOutput" style="text-align: right;"><strong style="color: #3C763D;">RM <?PHP echo $Total; ?> *</strong></h4>
								<!--<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;" id="strikethrough" class="hidden"><del>RM <?PHP //echo $Total; ?></del></p>
								<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;">*for the 1st month</p>-->
							
							</div>
							
							<h4 class=" col-xs-8"><font style="font-size:15px;"><?PHP echo $pageStyleSpace.$pageStyleSpace; echo $pageOpenFont; ?><?PHP if( $_POST['state'] == 'Online Tuition' ){echo $thisLevel.' for Online Tuition';}else{echo $thisLevel.' in '.$thisCityName.', '.$thisStateName;} ?><?PHP echo $pagecloseFont; ?></font></h4>
							<div class="col-xs-4">

								<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;" id="strikethrough" class="hidden"><del>RM <?PHP echo $Total; ?></del></p>
								<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;">*for the 1st month</p>
							
							</div>
						</div>
						
						
						<!--<div class="form-group">
							<div class="col-xs-12">
								<p style="text-align: center;font-size:13px;font-style: oblique;margin-top:0px;">
								*Discounts if you take more than 1 session per week (except intensive classes). Contact our team for further info.
								</p>
							</div>
						</div>-->
					</form>
    
					<?PHP if( $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/price' ){}else{ echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Previous</button>';} ?>
				
				<?
				}else{
				?>
					<div class="alert-message alert-message-danger">
						<h3><?PHP echo "'NOT NUMBER'"; ?></h3>
						<h4><?PHP echo "For further info, please contact our coordinator."; ?></h4>
					</div>
					<?PHP if( $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/price' ){}else{ echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Previous</button>';} ?>
									
				<?
				}
				?>
				</div>
			</div>
			<?PHP
	}else{
	?>
		<div class="col-sm-12">
			<div class="alert-message alert-message-danger">
                <h4><?PHP echo "For further info, please contact our coordinator."; ?></h4>
            </div>		
		</div>
		<?PHP if( $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/price' ){}else{ echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Previous</button>';} ?>
	<?PHP
	}

}
?>

<!-- Modal -->
<div style="margin-top:10%;" class="modal fade centerScreen" id="insertLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-footer">
          
            <div class="form-group label-floating" style="text-align: left;">
                <label class="control-label">Your Location or type Online Tuition <small>(required)</small></label>
                <input style="color: black;" id="selectStateModal" name="selectStateModal" type="text" class="form-control my_form_control">
            </div>
          
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button style="margin-top:-1px;" type="button" class="btn btn-success" onClick="Procced()">Procced</button>
      </div>
    </div>
  </div>
</div>

<script>
function Procced() {
    var selectStateModal1 = '<?PHP echo $_POST['level']; ?>';
    var selectStateModal2 = document.getElementById("selectStateModal").value;
    $.ajax({
        type:'POST',
        url:'pricing-session.php',
        data:{selectStateModal1: selectStateModal1, selectStateModal2: selectStateModal2},
        dataType: 'JSON',
        success:function(result){
            //document.getElementById("selectStateModal2").value = result;

            document.getElementById("inputRate_id").value = result.id;
            document.getElementById("inputRate_rate").value = result.rate;
            document.getElementById("inputRate_city").value = result.city;
            document.getElementById("inputRate_state").value = result.state;

            var RatePerHour = parseFloat(result.rate);
            var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
            if(thisCheckbox == true){
                RateNormalTutor = 10;
            }else{
                RateNormalTutor = 0;
            }            
            var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1));
            var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
            
            firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
            secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
            if(secondDigitMF == '30'){
                valueDuration = parseFloat(firstDigitMF+'.'+'5');
            }else{
                valueDuration = parseFloat(firstDigitMF+'.'+'0');
            }
            
            var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
            if( valueMonth == '4' ){
                rateLess = 0;
                document.getElementById("subtotalDic").classList.add("hidden");
            }else{
                rateLess = 5;
                document.getElementById("subtotalDic").classList.remove("hidden");
            }
            
            document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess)+' / hour';
            document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
            document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
            document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
            
            document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth )+'<br>(price without discount)';
            
            document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
            document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";
            
            $('#insertLocationModal').modal('hide');
        }
    });
}

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
	<?php
		$connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
		$sqlS = "SELECT ts.ts_id, tc.tc_title, ts.ts_title FROM tk_tution_subject ts
				LEFT JOIN tk_tution_course tc ON tc.tc_id = ts.ts_tc_id AND tc.tc_status = 'A'
				WHERE ts.ts_status = 'A'";
		$sqlL = "SELECT tc.city_id, tc.city_name, st.st_name
				FROM tk_cities tc
				LEFT JOIN tk_states st
				ON st.st_id = tc.city_st_id
				WHERE tc.city_status = '1'";
				
		$subjectid = array();
		$locationid = array();
	?>
	var countries = 	[
						<?php
							echo "'Online Tuition',";
							$res = mysqli_query($connect, $sqlL);
							$i = 0;
							while($row = mysqli_fetch_array($res))
							{
								array_push($locationid, $row['city_id']);
								
								if($i != 0)
								{
									echo ",";
								}
								
								echo "'".$row['city_name'].", ".$row['st_name']."'";
								$i++;
							}
						?>
					];




/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("selectStateModal"), countries);
</script>


<script>
/* ### LOAD THIS PAGE ### */
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();  
	if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1 ){
		$("#pricePerStudent").show();
		
		studentAdded = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo $thisRate ?>);
		document.getElementById("hiddenCurentRate").value = studentAdded;
		document.getElementById("normalTutorInput").value = 'RM '+studentAdded+' / hour';
		
		var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
		var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
		getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
		firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
		secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
		if(secondDigitMF == '30'){
			valueDuration = parseFloat(firstDigitMF+'.'+'5');
		}else{
			valueDuration = parseFloat(firstDigitMF+'.'+'0');
		}
		valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
		calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
		document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
			
		totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
		document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalStudent * 50;
			
		calTotal = calMonthfee + (totalStudent * 50);
		document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		
		var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
		var numb = txtString.match(/\d/g);
		numb = numb.join("");
		document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
		  

	}
    var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
    if(thisCheckbox == true){
        $("#textNormalTuition").hide();
        $("#textOnlineTuition").show();        
    }else{
        $("#textNormalTuition").show();
        $("#textOnlineTuition").hide();   
    }
});

function normalTuitionCheckbox() {
    //$('.hover_bkgr_fricc').show();
/*
    var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
    if(thisCheckbox == true){
        document.getElementById("slideRight").innerHTML = '(slide left for Normal Tuition)';
        
        <?PHP
        //$GetRate = "SELECT * FROM tk_online_rates WHERE or_level_id = '".$_POST['level']."'  ";
        //$resultGetRate = $conn->query($GetRate);
        //if ($resultGetRate->num_rows > 0) {
            //$rowGetRate = $resultGetRate->fetch_assoc();
            //$rateGetRate = $rowGetRate['or_rate'];
        //}else{
            //$rateGetRate = '';
        //}  
        ?>
        var postState     = '<?php echo $_POST['level']; ?>';
        
        $.ajax({
            type:'POST',
            url:'pricing-session3.php',
            data:{postState: postState},
            dataType: 'JSON',
            success:function(result){
                var rateOnline = result.rate1;
            
                var RatePerHour = parseFloat(rateOnline);
                var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
                if(thisCheckbox == true){
                    RateNormalTutor = 10;
                }else{
                    RateNormalTutor = 0;
                }            
                var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1));
                var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
                
                firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
                secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                if(secondDigitMF == '30'){
                    valueDuration = parseFloat(firstDigitMF+'.'+'5');
                }else{
                    valueDuration = parseFloat(firstDigitMF+'.'+'0');
                }
                
                var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
                
                document.getElementById("normalTutorInput").value = 'RM '+(RatePerHour + RateNormalTutor + RateBilPelajar)+' / hour';
                document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) +" / month</strong>";
                document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
                document.getElementById("subtotal").innerHTML = "RM "+ ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) +" ";
                
                document.getElementById("subtotalDic").classList.add("hidden");
                
                document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
                document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";
    
                $("#textNormalTuition").hide();
                $("#textOnlineTuition").show();                 
            }
        });
    }else{
        document.getElementById("slideRight").innerHTML = '(slide right for Online Tuition)';

        var postState     = '<?php echo $_POST['state']; ?>';
        var postStateSess = document.getElementById("inputRate_id").value;
        var postStateLoc  = '<?php echo $arrThis; ?>';
       
        $.ajax({
            type:'POST',
            url:'pricing-session2.php',
            data:{postState: postState, postStateSess: postStateSess, postStateLoc: postStateLoc},
            dataType: 'JSON',
            success:function(result){
                //alert(result.rate1+' - '+result.rate2+' - '+result.rate3); 

                    var rateOnline = result.rate1;
                    if( rateOnline == 'clickButton' ){
                        $("#insertLocationModal").modal();
                        //alert('test1');
                    }else{
                        
                        var GetInputState = document.getElementById("statePost").value;
                        var GetInputSession =  document.getElementById("inputRate_id").value;
                        var GetInputSessionRate =  document.getElementById("inputRate_rate").value;
                        var GetInputCurentRate =  document.getElementById("hiddenCurentRate").value;
                        
                        
                        if( GetInputState == 'Online Tuition' ){
                            if( GetInputSession != '' ){
                                
                                var RatePerHour = parseFloat(GetInputSessionRate);
                                var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
                                if(thisCheckbox == true){
                                    RateNormalTutor = 10;
                                }else{
                                    RateNormalTutor = 0;
                                }            
                                var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1));
                                var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
                                
                                firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
                                secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                                if(secondDigitMF == '30'){
                                    valueDuration = parseFloat(firstDigitMF+'.'+'5');
                                }else{
                                    valueDuration = parseFloat(firstDigitMF+'.'+'0');
                                }
                                
                                var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
                                if( valueMonth == '4' ){
                                    rateLess = 0;
                                    document.getElementById("subtotalDic").classList.add("hidden");
                                }else{
                                    rateLess = 5;
                                    document.getElementById("subtotalDic").classList.remove("hidden");
                                }
            
                                document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess)+' / hour';
                                document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
                                document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
                                document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
                                
                                document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth )+'<br>(price without discount)';
                                
                                document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
                                document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";

                            }else{
                                $("#insertLocationModal").modal();
                            }
                        }else{
                            

                                var RatePerHour = parseFloat(GetInputCurentRate);
                                var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
                                if(thisCheckbox == true){
                                    RateNormalTutor = 10;
                                }else{
                                    RateNormalTutor = 0;
                                }            
                                var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1));
                                var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
                                
                                firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
                                secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                                if(secondDigitMF == '30'){
                                    valueDuration = parseFloat(firstDigitMF+'.'+'5');
                                }else{
                                    valueDuration = parseFloat(firstDigitMF+'.'+'0');
                                }
                                
                                var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
                                if( valueMonth == '4' ){
                                    rateLess = 0;
                                    document.getElementById("subtotalDic").classList.add("hidden");
                                }else{
                                    rateLess = 5;
                                    document.getElementById("subtotalDic").classList.remove("hidden");
                                }
                				
                                document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess)+' / hour';
                                document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
                                document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
                                document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
                                
                                document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth )+'<br>(price without discount)';
                                
                                document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
                                document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";

                        		//studentAdded = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + parseFloat(GetInputCurentRate));
                        		//document.getElementById("normalTutorInput").value = 'RM '+studentAdded+' / hour';
                        		
                        		//var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
                        		//var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
                        		//getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
                        		//firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
                        		//secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        		//if(secondDigitMF == '30'){
                        			//valueDuration = parseFloat(firstDigitMF+'.'+'5');
                        		//}else{
                        			//valueDuration = parseFloat(firstDigitMF+'.'+'0');
                        		//}
                        		//valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
                        		//calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
                        		//document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
                        			
                        		//totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
                        		//document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalStudent * 50;
                        			
                        		//calTotal = calMonthfee + (totalStudent * 50);
                        		//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
                        		//document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
                        		
                        		//var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
                        		//var numb = txtString.match(/\d/g);
                        		//numb = numb.join("");
                        		//document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";

                        }
                   
                    }
                    $("#textNormalTuition").show();
                    $("#textOnlineTuition").hide();   

            }
        });
        
    }
*/
}

/* ### NORMAL TUTOR CHECKBOX ### */
function normalTutorCheckbox() {
	var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
	if(thisCheckbox == true){
	  
		$("#textNormalTutor").hide();
		$("#textSchoolTeacher").show();
		
		if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
			studentAdded = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo ($thisRate + 10) ?>);
		    document.getElementById("hiddenCurentRate").value = studentAdded;
			
			if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				if( document.getElementById("sessionPerMonth").value == '4 sessions' ){
					studentAddedNi = studentAdded;
				}else{
					studentAddedNi = (studentAdded - 5);
				}
			}else{
				studentAddedNi = studentAdded;
			}
			
			document.getElementById("normalTutorInput").value = 'RM '+studentAddedNi+' / hour';

			var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
			var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
			getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
			firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
			secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
			if(secondDigitMF == '30'){
				valueDuration = parseFloat(firstDigitMF+'.'+'5');
			}else{
				valueDuration = parseFloat(firstDigitMF+'.'+'0');
			}
			valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
			calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
			document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
			if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
			}
					
			totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
			document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalStudent * 50;
			
			calTotal = calMonthfee + (totalStudent * 50);
			//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			
			var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
			var numb = txtString.match(/\d/g);
			numb = numb.join("");
			document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";

/* discount code*/
	var alertOk = document.getElementById("alertOk");//Discount code applied. 
	var alertInvalid = document.getElementById("alertInvalid");//Invalid discount code. Please try again.
	var alertInvalid2 = document.getElementById("alertInvalid2");//Discount code is invalid. Please select more sessions or/and duration.
	var alertInvalid3 = document.getElementById("alertInvalid3");//Please insert discount code.
	var fieldDiscount = document.getElementById("fieldDiscount");
	var strikethrough = document.getElementById("strikethrough");
	var discount_code = document.getElementById("discount_code").value; 
	var discount_code2 = discount_code.toUpperCase();
	
	
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */
			
		}else{
			document.getElementById("hiddenCurentRate").value = "<?php echo ($thisRate + 10) ?>";
			
			if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				if( document.getElementById("sessionPerMonth").value == '4 sessions' ){
					studentAddedNi = "<?php echo ($thisRate + 10) ?>";
				}else{
					studentAddedNi = "<?php echo (($thisRate + 10) - 5) ?>";   
				}
			}else{
				studentAddedNi = "<?php echo ($thisRate + 10) ?>";
			}
			document.getElementById("normalTutorInput").value = 'RM '+studentAddedNi+' / hour';
			
			var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
			var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
			getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
			firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
			secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
			if(secondDigitMF == '30'){
				valueDuration = parseFloat(firstDigitMF+'.'+'5');
			}else{
				valueDuration = parseFloat(firstDigitMF+'.'+'0');
			}
			valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
			calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
			document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
			if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
			}
			
			totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
			document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalStudent * 50;
			
			calTotal = calMonthfee + (totalStudent * 50);
			//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
/* discount code*/
	var alertOk = document.getElementById("alertOk");//Discount code applied. 
	var alertInvalid = document.getElementById("alertInvalid");//Invalid discount code. Please try again.
	var alertInvalid2 = document.getElementById("alertInvalid2");//Discount code is invalid. Please select more sessions or/and duration.
	var alertInvalid3 = document.getElementById("alertInvalid3");//Please insert discount code.
	var fieldDiscount = document.getElementById("fieldDiscount");
	var strikethrough = document.getElementById("strikethrough");
	var discount_code = document.getElementById("discount_code").value; 
	var discount_code2 = discount_code.toUpperCase();
	
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */

		}
	}else{
	 
		$("#textSchoolTeacher").hide();
		$("#textNormalTutor").show();
		
		if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
			studentAdded = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo $thisRate ?>);
			document.getElementById("hiddenCurentRate").value = studentAdded;
			
			if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				if( document.getElementById("sessionPerMonth").value == '4 sessions' ){
					studentAddedNi = studentAdded;
				}else{
					studentAddedNi = (studentAdded - 5);
				}
			}else{
				studentAddedNi = studentAdded;
			}
			
			document.getElementById("normalTutorInput").value = 'RM '+studentAddedNi+' / hour';
			
			var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
			var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
			getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
			firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
			secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
			if(secondDigitMF == '30'){
				valueDuration = parseFloat(firstDigitMF+'.'+'5');
			}else{
				valueDuration = parseFloat(firstDigitMF+'.'+'0');
			}
			valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
			calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
			document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
			if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
			}
			
			totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
			document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalStudent * 50;
			
			calTotal = calMonthfee + (totalStudent * 50);
			//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
					
			var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
			var numb = txtString.match(/\d/g);
			numb = numb.join("");
			document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
/* discount code*/
	var alertOk = document.getElementById("alertOk");//Discount code applied. 
	var alertInvalid = document.getElementById("alertInvalid");//Invalid discount code. Please try again.
	var alertInvalid2 = document.getElementById("alertInvalid2");//Discount code is invalid. Please select more sessions or/and duration.
	var alertInvalid3 = document.getElementById("alertInvalid3");//Please insert discount code.
	var fieldDiscount = document.getElementById("fieldDiscount");
	var strikethrough = document.getElementById("strikethrough");
	var discount_code = document.getElementById("discount_code").value; 
	var discount_code2 = discount_code.toUpperCase();
	
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */

			
		}else{
		    document.getElementById("hiddenCurentRate").value = "<?php echo $thisRate ?>";
			
			if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				if( document.getElementById("sessionPerMonth").value == '4 sessions' ){
					studentAddedNi = "<?php echo $thisRate ?>";
				}else{
					studentAddedNi = "<?php echo ($thisRate - 5) ?>";       
				}
			}else{
				studentAddedNi = "<?php echo $thisRate ?>";
			}
			
			document.getElementById("normalTutorInput").value = 'RM '+studentAddedNi+' / hour';

			var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
			var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
			getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
			firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
			secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
			if(secondDigitMF == '30'){
				valueDuration = parseFloat(firstDigitMF+'.'+'5');
			}else{
				valueDuration = parseFloat(firstDigitMF+'.'+'0');
			}
			valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
			calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
			document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
			if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
			}
					
			totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
			document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalStudent * 50;
			
			calTotal = calMonthfee + (totalStudent * 50);
			//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
/* discount code*/
	var alertOk = document.getElementById("alertOk");//Discount code applied. 
	var alertInvalid = document.getElementById("alertInvalid");//Invalid discount code. Please try again.
	var alertInvalid2 = document.getElementById("alertInvalid2");//Discount code is invalid. Please select more sessions or/and duration.
	var alertInvalid3 = document.getElementById("alertInvalid3");//Please insert discount code.
	var fieldDiscount = document.getElementById("fieldDiscount");
	var strikethrough = document.getElementById("strikethrough");
	var discount_code = document.getElementById("discount_code").value; 
	var discount_code2 = discount_code.toUpperCase();
	
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */

		}
		
	}
}






$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
	
	var currentTime = input.val();
	var firstDigit = currentTime.substring(0, 1);
	var secondDigit = currentTime.substring(7, 9);
	var resultTime = parseFloat(firstDigit+'.'+secondDigit);
	//alert(fieldName +" - "+currentTime+" - "+firstDigit+" - "+secondDigit+" - "+resultTime);

	var alertOk = document.getElementById("alertOk");//Discount code applied. 
	var alertInvalid = document.getElementById("alertInvalid");//Invalid discount code. Please try again.
	var alertInvalid2 = document.getElementById("alertInvalid2");//Discount code is invalid. Please select more sessions or/and duration.
	var alertInvalid3 = document.getElementById("alertInvalid3");//Please insert discount code.
	var fieldDiscount = document.getElementById("fieldDiscount");
	var strikethrough = document.getElementById("strikethrough");
	var discount_code = document.getElementById("discount_code").value; 
	var discount_code2 = discount_code.toUpperCase();
	
    if (!isNaN(currentVal)) {

		if(fieldName == 'NoOfStudentsInput'){
			if(type == 'minus') {
				if(currentVal > input.attr('min')) {
			
					document.getElementById("NoOfStudentsInput").value = (currentVal - 1) +"<?PHP //echo ' pax' ?>";
					totalRegistrationFee = (currentVal - 1) * 50;

					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						studentAdded = (((parseFloat((currentVal - 1)) -1) * 10) + <?php echo ($thisRate + 10) ?>);
						document.getElementById("hiddenCurentRate").value = studentAdded;
						if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
							if( document.getElementById("sessionPerMonth").value == '4 sessions' ){
								studentAddedNi = studentAdded;
							}else{
								studentAddedNi = (studentAdded - 5);
							}
						}else{
							studentAddedNi = studentAdded;
						}
						document.getElementById("normalTutorInput").value = 'RM '+studentAddedNi+' / hour';
					}else{
						studentAdded = (((parseFloat((currentVal - 1)) -1) * 10) + <?php echo $thisRate ?>);
						document.getElementById("hiddenCurentRate").value = studentAdded;
						if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
							if( document.getElementById("sessionPerMonth").value == '4 sessions' ){
								studentAddedNi = studentAdded;
							}else{
								studentAddedNi = (studentAdded - 5);
							}
						}else{
							studentAddedNi = studentAdded;
						}
						document.getElementById("normalTutorInput").value = 'RM '+studentAddedNi+' / hour';
					}
					
					var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
					getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
					valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
					if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
						document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
					}
			
					document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalRegistrationFee;
					
					var monthlyFeeDigit = document.getElementById("monthlyFeeOutput").innerHTML;
					var monthlyFee = monthlyFeeDigit.match(/\d/g);
					monthlyFee = monthlyFee.join("");
					calTotal =  parseFloat(monthlyFee) + totalRegistrationFee;
					//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
							
					if((currentVal - 1) >= 2){
						$("#pricePerStudent").show();
						pricePerStudent = parseFloat(monthlyFee) / (currentVal - 1)
						document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + pricePerStudent.toFixed(2) +" / student)</b> ";
					}else{
						$("#pricePerStudent").hide();
					}
					
					
/* discount code*/
	var alertOk = document.getElementById("alertOk");//Discount code applied. 
	var alertInvalid = document.getElementById("alertInvalid");//Invalid discount code. Please try again.
	var alertInvalid2 = document.getElementById("alertInvalid2");//Discount code is invalid. Please select more sessions or/and duration.
	var alertInvalid3 = document.getElementById("alertInvalid3");//Please insert discount code.
	var fieldDiscount = document.getElementById("fieldDiscount");
	var strikethrough = document.getElementById("strikethrough");
	var discount_code = document.getElementById("discount_code").value; 
	var discount_code2 = discount_code.toUpperCase();
	
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */
					
					
					
					
					
					
					
					
				} 
				if(currentVal == '1') {
					alert("Sorry the minimum value has been reached");
				}
			} else if(type == 'plus') {
				if(currentVal < input.attr('max')) {
					document.getElementById("NoOfStudentsInput").value = (currentVal + 1) +"<?PHP //echo ' pax' ?>";
					totalRegistrationFee = (currentVal + 1) * 50;	
					
					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						studentAdded = (((parseFloat((currentVal + 1)) -1) * 10) + <?php echo ($thisRate + 10) ?>);
						document.getElementById("hiddenCurentRate").value = studentAdded;
						if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
							if( document.getElementById("sessionPerMonth").value == '4 sessions' ){
								studentAddedNi = studentAdded;
							}else{
								studentAddedNi = (studentAdded - 5);
							}
						}else{
							studentAddedNi = studentAdded;
						}
						document.getElementById("normalTutorInput").value = 'RM '+studentAddedNi+' / hour';
					}else{
						studentAdded = (((parseFloat((currentVal + 1)) -1) * 10) + <?php echo $thisRate ?>);
						document.getElementById("hiddenCurentRate").value = studentAdded;
						if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
							if( document.getElementById("sessionPerMonth").value == '4 sessions' ){
								studentAddedNi = studentAdded;
							}else{
								studentAddedNi = (studentAdded - 5);
							}
						}else{
							studentAddedNi = studentAdded;
						}
						document.getElementById("normalTutorInput").value = 'RM '+studentAddedNi+' / hour';
					}
					
					var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
					getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
					valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
					if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
						document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
					}
					
					document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalRegistrationFee;
					
					var monthlyFeeDigit = document.getElementById("monthlyFeeOutput").innerHTML;
					var monthlyFee = monthlyFeeDigit.match(/\d/g);
					monthlyFee = monthlyFee.join("");
					calTotal =  parseFloat(monthlyFee) + totalRegistrationFee;
					//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		
					if((currentVal + 1) >= 2){
						$("#pricePerStudent").show();
						pricePerStudent = parseFloat(monthlyFee) / (currentVal + 1)
						document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + pricePerStudent.toFixed(2) +" / student)</b> ";
					}else{
						$("#pricePerStudent").hide();
					}
					
/* discount code*/
	var alertOk = document.getElementById("alertOk");//Discount code applied. 
	var alertInvalid = document.getElementById("alertInvalid");//Invalid discount code. Please try again.
	var alertInvalid2 = document.getElementById("alertInvalid2");//Discount code is invalid. Please select more sessions or/and duration.
	var alertInvalid3 = document.getElementById("alertInvalid3");//Please insert discount code.
	var fieldDiscount = document.getElementById("fieldDiscount");
	var strikethrough = document.getElementById("strikethrough");
	var discount_code = document.getElementById("discount_code").value; 
	var discount_code2 = discount_code.toUpperCase();
	
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */
					

				}
				if(currentVal == '5') {
					alert("Sorry the maximum value has been reached");
				}
			}
		} 	
		if(fieldName == 'sessionDuration'){
			if(type == 'minus') {
				 if(resultTime > parseFloat(1.3)) {
					outputTime = (resultTime - 0.7);
					decimals = (outputTime - Math.floor(outputTime)).toFixed(1);
					if(decimals == 0.3){
						document.getElementById("sessionDuration").value = (parseInt(firstDigit) - 1) +' hour 30 mins';
					}else{
						document.getElementById("sessionDuration").value = (parseInt(firstDigit)) +' hour 00 mins';
					}
					
					var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
					getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
					valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
					if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
						document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
					}
		
					var registrationFeeDigit = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFee = registrationFeeDigit.match(/\d/g);
					registrationFee = registrationFee.join("");
					calTotal =  calMonthfee + parseFloat(registrationFee);
					//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		
					totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
					pricePerStudent = calMonthfee / totalStudent;
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + pricePerStudent.toFixed(2) +" / student)</b> ";
					
/* discount code*/
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */
					
					
					
				 }
				 if(resultTime == parseFloat(1.3)) {
					alert("Sorry the minimum value has been reached");
				 }
			}else if(type == 'plus') {
				if(resultTime < parseFloat(3.0)) {
					outputTime = (resultTime + 0.3);
					decimals = (outputTime - Math.floor(outputTime)).toFixed(1);
					if(decimals == 0.6){
						document.getElementById("sessionDuration").value = (parseInt(firstDigit) + 1) +' hour 00 mins';
					}else{
						document.getElementById("sessionDuration").value = (parseInt(firstDigit)) +' hour '+ '30' +' mins';
					}
					
					var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
					getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
					valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
					if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
						document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
					}
							
					var registrationFeeDigit = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFee = registrationFeeDigit.match(/\d/g);
					registrationFee = registrationFee.join("");
					calTotal =  calMonthfee + parseFloat(registrationFee);
					//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		
					totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
					pricePerStudent = calMonthfee / totalStudent;
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + pricePerStudent.toFixed(2) +" / student)</b> ";
					
/* discount code*/
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */
					
				}
				if(resultTime == parseFloat(3.0)) {
					alert("Sorry the maximum value has been reached");
				}
			}
		}
		if(fieldName == 'sessionPerMonth'){
			if(type == 'minus') {
				if(currentVal > input.attr('min')) {
				    if( (currentVal - 4) >= 8 ){
				        if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				            var hiddenCurentRate = document.getElementById("hiddenCurentRate").value;
				            document.getElementById("normalTutorInput").value = 'RM '+(hiddenCurentRate - 5)+' / hour';
				        }
						
						firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
						if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
							document.getElementById("subtotalDic").innerHTML = 'RM '+(((hiddenCurentRate * valueDuration) * (currentVal - 4)))+'<br>(price without discount)';
							document.getElementById("subtotalDic").classList.remove("hidden");	
						}
				    }else{
				        if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				            var hiddenCurentRate = document.getElementById("hiddenCurentRate").value;
				            document.getElementById("normalTutorInput").value = 'RM '+(hiddenCurentRate)+' / hour';
				        }
						
						firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
						if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
							document.getElementById("subtotalDic").innerHTML = 'RM '+(((hiddenCurentRate * valueDuration) * (currentVal - 4)))+'<br>(price without discount)';
							document.getElementById("subtotalDic").classList.add("hidden");
						}
				    }
					document.getElementById("sessionPerMonth").value = (currentVal - 4) +"<?PHP echo ' sessions' ?>";
					document.getElementById("sessionWeek").innerHTML = ((currentVal - 4) / 4) + ' session(s)/week';
					
					var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
					getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
					valueMonth = (currentVal - 4);
					calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
					if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
						document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
					}
							
					var registrationFeeDigit = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFee = registrationFeeDigit.match(/\d/g);
					registrationFee = registrationFee.join("");
					calTotal =  calMonthfee + parseFloat(registrationFee);
					//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
						
					totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
					pricePerStudent = calMonthfee / totalStudent;
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + pricePerStudent.toFixed(2) +" / student)</b> ";
					
/* discount code*/
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */
					
				}       
				if(currentVal == '4') {
					alert("Sorry the minimum value has been reached");
				}
			}else if(type == 'plus') {
				if(currentVal < input.attr('max')) {
				    if( (currentVal + 4) >= 8 ){
				        if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				            var hiddenCurentRate = document.getElementById("hiddenCurentRate").value;
				            document.getElementById("normalTutorInput").value = 'RM '+(hiddenCurentRate - 5)+' / hour';
				        }
						
						firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
						if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
							document.getElementById("subtotalDic").innerHTML = 'RM '+(((hiddenCurentRate * valueDuration) * (currentVal + 4)))+'<br>(price without discount)';
							document.getElementById("subtotalDic").classList.remove("hidden");	
						}
				    }else{
				        if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
				            var hiddenCurentRate = document.getElementById("hiddenCurentRate").value;
				            document.getElementById("normalTutorInput").value = 'RM '+(hiddenCurentRate)+' / hour';
				        }
						
						firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
						if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
							document.getElementById("subtotalDic").innerHTML = 'RM '+(((hiddenCurentRate * valueDuration) * (currentVal + 4)))+'<br>(price without discount)';
							document.getElementById("subtotalDic").classList.add("hidden");
						}
				    }
					document.getElementById("sessionPerMonth").value = (currentVal + 4) +"<?PHP echo ' sessions' ?>";
					document.getElementById("sessionWeek").innerHTML = ((currentVal + 4) / 4) + ' session(s)/week';
					
					var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
					getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
					valueMonth = (currentVal + 4);
					calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
					if( document.getElementById("statePost").value != '' && document.getElementById("statePost").value != 'Online Tuition' ){
						document.getElementById("subtotalDic").innerHTML = 'RM '+((parseInt(document.getElementById("hiddenCurentRate").value) * valueDuration) * valueMonth)+'<br>(price without discount)';
					}
							
					var registrationFeeDigit = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFee = registrationFeeDigit.match(/\d/g);
					registrationFee = registrationFee.join("");
					calTotal =  calMonthfee + parseFloat(registrationFee);
					//document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
						
					totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
					pricePerStudent = calMonthfee / totalStudent;
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + pricePerStudent.toFixed(2) +" / student)</b> ";
					
/* discount code*/
			if( discount_code2 == null || discount_code2 === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" sessions", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( discount_code2 == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertOk.classList.remove("hidden");	
					fieldDiscount.classList.remove("hidden");	
					strikethrough.classList.remove("hidden");	
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 
					
				}else{
					alertOk.classList.add("hidden");	
					alertInvalid.classList.add("hidden");	
					alertInvalid2.classList.add("hidden");	
					alertInvalid3.classList.add("hidden");	
					fieldDiscount.classList.add("hidden");
					strikethrough.classList.add("hidden");
		
					alertInvalid2.classList.remove("hidden");	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
				}
			}
/* discount code */
					
				}
				if(currentVal == '16') {
					alert("Sorry the maximum value has been reached");
				}
			}
		}

    } else {
        input.val(0);
    }
});

$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	
function loadDiscount() {
	var level  = document.getElementById("selectthisLevel").value;  
	var state  = document.getElementById("selectState").value; 
	var city   = document.getElementById("selectCities").value; 
	var person = document.getElementById("selectPerson").value; 

	var alertOk = document.getElementById("alertOk");//Discount code applied. 
	var alertInvalid = document.getElementById("alertInvalid");//Invalid discount code. Please try again.
	var alertInvalid2 = document.getElementById("alertInvalid2");//Discount code is invalid. Please select more sessions or/and duration.
	var alertInvalid3 = document.getElementById("alertInvalid3");//Please insert discount code.
	var strikethrough = document.getElementById("strikethrough");
	var fieldDiscount = document.getElementById("fieldDiscount");
	
	var btnDiscount = document.getElementById("btnDiscount");
	btnDiscount.classList.remove("success1");
	btnDiscount.classList.add("success2");
	
	var discount_code = document.getElementById("discount_code").value; 
	var discount_code2 = discount_code.toUpperCase();

	
	var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
	var replace = sessionPerMonth.replace(" sessions", "");
	
	var sessionDuration = document.getElementById("sessionDuration").value; 
	var replace2 = sessionDuration.replace(" hour ", ".");
	var replace3 = replace2.replace(" mins", "");
	
	
	if(discount_code2 === ""){
		alertOk.classList.add("hidden");	
		alertInvalid.classList.add("hidden");	
		alertInvalid2.classList.add("hidden");	
		alertInvalid3.classList.add("hidden");	
		fieldDiscount.classList.add("hidden");	
		strikethrough.classList.add("hidden");
		
		alertInvalid3.classList.remove("hidden");	
	}
	else if(discount_code2 !== 'TKBEST5'){
		alertOk.classList.add("hidden");	
		alertInvalid.classList.add("hidden");	
		alertInvalid2.classList.add("hidden");	
		alertInvalid3.classList.add("hidden");		
		fieldDiscount.classList.add("hidden");
		strikethrough.classList.add("hidden");
		
		alertInvalid.classList.remove("hidden");	
	}
	
	else if(replace >= 8 || replace3 >= 3 ){
		alertOk.classList.add("hidden");	
		alertInvalid.classList.add("hidden");	
		alertInvalid2.classList.add("hidden");	
		alertInvalid3.classList.add("hidden");		
		fieldDiscount.classList.add("hidden");
		strikethrough.classList.add("hidden");
		
		alertOk.classList.remove("hidden");	
		fieldDiscount.classList.remove("hidden");	
		strikethrough.classList.remove("hidden");	
					
					
					
					var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
					getValueDigitNormalTutorInput = getValueDigitNormalTutorInput.join("");
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
					valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfee = getValueDigitNormalTutorInput * valueDuration * valueMonth;
					
					var registrationFeeDigitDis2 = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis2 = registrationFeeDigitDis2.match(/\d/g);
					registrationFeeDis2 = registrationFeeDis2.join("");
					calTotal =  calMonthfee + parseFloat(registrationFeeDis2);
					
					
					
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
										
					var getValueNormalTutorInputDis = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputDis = getValueNormalTutorInputDis.match(/\d/g);
					getValueDigitNormalTutorInputDis = getValueDigitNormalTutorInputDis.join("");
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputDis - 5;	
					
					firstDigitMFDis = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFDis = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFDis == '30'){
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'5');
					}else{
						valueDurationDis = parseFloat(firstDigitMFDis+'.'+'0');
					}
					
					valueMonthDis = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeDis = getValueDigitNormalTutorInputthis * valueDurationDis * valueMonthDis;
					
					var registrationFeeDigitDis = document.getElementById("registrationFeeOutput").innerHTML;
					var registrationFeeDis = registrationFeeDigitDis.match(/\d/g);
					registrationFeeDis = registrationFeeDis.join("");
					calTotalDis =  calMonthfeeDis + parseFloat(registrationFeeDis);
										
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + (calTotal - calTotalDis) + "</font></strong>";	
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotalDis +"</strong>";
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + calTotal + " </del></font>"; 				


		
	}
	else if(replace < 8 || replace3 < 3){
		alertOk.classList.add("hidden");	
		alertInvalid.classList.add("hidden");	
		alertInvalid2.classList.add("hidden");	
		alertInvalid3.classList.add("hidden");	
		fieldDiscount.classList.add("hidden");	
		strikethrough.classList.add("hidden");
		
		alertInvalid2.classList.remove("hidden");	
	}
	else{
		alertOk.classList.add("hidden");	
		alertInvalid.classList.add("hidden");	
		alertInvalid2.classList.add("hidden");	
		alertInvalid3.classList.add("hidden");		
		fieldDiscount.classList.add("hidden");
		strikethrough.classList.add("hidden");
		
		alertInvalid.classList.remove("hidden");	
	}

}
</script>
<script>
</script>