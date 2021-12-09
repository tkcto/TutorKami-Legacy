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
  width: 50px;
  height: 20px;
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
  height: 18px;
  width: 18px;
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
  -webkit-transform: translateX(30px);
  -ms-transform: translateX(30px);
  transform: translateX(30px);
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
  width:100%;
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
  padding: 5px 12px;
  font-size: 8px;
  cursor: pointer;
}
.success1 {
  background-color: #4CAF50;
  border-color: #4CAF50;
  color: white;
  padding-left:20px;
  padding-right:20px;
}
.success2 {
  border-color: #4CAF50;
  color: green;
  padding-left:20px;
  padding-right:20px;
}


/* Overriding placeholder */
::-webkit-input-placeholder {
   font-size: 25px;
}

:-moz-placeholder { /* Firefox 18- */
      font-size: 25px;
}

::-moz-placeholder {  /* Firefox 19+ */
      font-size: 25px;
}



::-webkit-input-placeholder {
   font-size: 13px!important;
}

:-moz-placeholder { /* Firefox 18- */
      font-size: 13px!important;
}
::-moz-placeholder {  /* Firefox 19+ */
      font-size: 13px!important;
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
	
// string-before ,	
$arrCity = explode(",", $_POST['state'], 2);
$first = trim($arrCity[0]);

	$sqlCity = "SELECT * FROM tk_cities WHERE city_name = '".$first."'  ";
	$resultCity = $conn->query($sqlCity);
	if ($resultCity->num_rows > 0) {
		$rowCity = $resultCity->fetch_assoc();
		$thisCity = $rowCity['city_id'];
	}else{
	    $thisCity = 'xda city';
	}

// string-after ,	
$arrState = explode(',', $_POST['state']);
$second = trim($arrState[1]);

	$sqlState = "SELECT * FROM tk_states WHERE st_name LIKE '".$second."'  ";
	$resultState = $conn->query($sqlState);
	if ($resultState->num_rows > 0) {
		$rowState = $resultState->fetch_assoc();
		$thisState = $rowState['st_id'];
	}else{
	    $thisState = 'xda state';
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
	
	
	//$sqlRate = "SELECT * FROM tk_location_rate2 WHERE level = ".$_POST['level']." AND state = ".$_POST['state']." AND city LIKE '%".$_POST['city']."%' ";
	$sqlRate = "SELECT * FROM tk_location_rate2 WHERE id = ".$arrThis."  ";
	$resultRate = $conn->query($sqlRate);
	if ($resultRate->num_rows > 0) {
		$rowRate = $resultRate->fetch_assoc();
			$thisRate = $rowRate['rate'];
			
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
			
			?>
			<div class="col-sm-12" style="margin-top:-25px;">
				<div>
				<?PHP
				if(preg_match("/^[0-9.]+$/", $thisRate)) {
				?>
<div id="alertOk" class="alert alert-error hidden" style="margin-top:25px;">
  <a class="close" data-dismiss="alert">×</a>
  Discount code applied. <strong>Enjoy!</strong>
</div>
<div id="alertInvalid" class="alert alert-error hidden" style="margin-top:25px;">
  <a class="close" data-dismiss="alert">×</a>
  Invalid discount code. Please try again.
</div>
<div id="alertInvalid2" class="alert alert-error hidden" style="margin-top:25px;">
  <a class="close" data-dismiss="alert">×</a>
  Discount code is invalid. Please select more sessions or/and duration.
</div>
<div id="alertInvalid3" class="alert alert-error hidden" style="margin-top:25px;">
  <a class="close" data-dismiss="alert">×</a>
  Please insert discount code.
</div>

					<form class="form-horizontal">					
						<div style="margin-left:13px;">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<h4><strong>FEES :</strong></h4>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<h4 id="monthlyFeeOutput" class="text-left"><strong><?PHP echo "<strong> RM ".$MonthlyFee." / month</strong>"; ?></strong></h4>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6"></div>
								<div class="col-xs-6">
									<p id="pricePerStudent" class="text-left" style="width:150px;color:blue;margin-left:-14px;margin-bottom:10px;display:none;"><b><?PHP echo "(RM ".$pricePerStudent." / student)"; ?></b></p>		
								</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-xs-6">
								<p>Online Tuition</p>
							</div>
							<div class="col-xs-4" style="margin-left:-33px;margin-top:-5px;">
								<a type="button" data-toggle="tooltip" data-placement="bottom" title="Enjoy lower rates with online class (click the slider on the right)"> <i style="color:#f1592a;font-size:35px;" class="fa fa-question-circle"></i> </a>&nbsp;&nbsp;
								<a href="online-tuition-tutoring-class.php" target="blank" type="button" data-toggle="tooltip" data-placement="bottom" title=""> <i style="color:#262262;font-size:35px;" class="fa fa-info-circle"></i> </a>
							</div>
							<div class="col-xs-2">
								<span class="input-group-btn">
									<label></label>
								</span>
								<span class="input-group-btn">
									<label class="switch" style="margin-top:10px;">
										<input type="checkbox" class="success" value="false" id="CheckboxnormalTutor1111" onChange="normalTutorCheckbox()111">
										<span class="slider round"></span>
									</label>
								</span>
							</div>
						</div>
						
						

						<div class="row">
							<div class="col-xs-6">
								<p><span id="textNormalTutor">Normal Tutor</span><span id="textSchoolTeacher" style="display:none;">School Teacher</span>
									<a type="button" data-toggle="tooltip" data-placement="bottom" title="Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years"><i style="color:#f1592a;" class="fa fa-question-circle"></i></a>
								</p>
							</div>
							<div class="col-xs-4" style="margin-left:-33px;margin-top:-5px;">
								<input readonly style="text-align:center;width:93px;" type="text" id="normalTutorInput" class="form-control input-number" value="<?PHP echo "RM ".$thisRate." / hour"; ?>">
							</div>
							<div class="col-xs-2">
								<span class="input-group-btn">
									<label></label>
								</span>
								<span class="input-group-btn">
									<label class="switch" style="margin-top:10px;">
										<input type="checkbox" class="success" value="false" id="CheckboxnormalTutor" onChange="normalTutorCheckbox()">
										<span class="slider round"></span>
									</label>
								</span>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-6"><p>Student(s) <a data-html="true" type="button" data-toggle="tooltip" data-placement="bottom" title="<p style='text-align:left;' >Only add RM10/hour for each additional student. E.g if the rate for 1 student is RM50/hour, then 2 students the rate is RM60/hour (so only RM30/hour per student). <b>Note</b>: the students must have the session together e.g 2 students undergo 2 hours session (not separately e.g 2 hours session, but each student undergo only 1 hour separately)</p>"> <i style="color:#262262;" class="fa fa-info-circle"></i> </a></p></div>
							<div class="col-xs-4" style="margin-left:-33px;margin-top:-5px;">
								<input readonly style="text-align:center;width:93px;" type="text" id="NoOfStudentsInput" name="NoOfStudentsInput" class="form-control input-number" value="<?PHP echo $_POST['person'];//echo $_POST['person']." pax"; ?>" min="1" max="5" onChange="NoOfStudentsOnChange()">
							</div>
							<div class="col-xs-2" style="margin-left:-12px;">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number btn-xs" data-type="minus" data-field="NoOfStudentsInput">
										<span class="glyphicon glyphicon-minus" style="font-size:18px;width:8px;"></span>
									</button>
								</span>
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number btn-xs" data-type="plus" data-field="NoOfStudentsInput">
										<span class="glyphicon glyphicon-plus" style="font-size:18px;width:8px;"></span>
									</button>
								</span>
							</div>
						</div>
		
						<div class="row">
							<div class="col-xs-6"><p>Duration per Session</p></div>
							<div class="col-xs-4" style="margin-left:-33px;margin-top:-5px;">
								<input readonly style="text-align:left;width:93px;" type="text" id="sessionDuration" name="sessionDuration" class="form-control input-number" value="<?PHP echo "1 hour 30 mins"; ?>">
							</div>
							<div class="col-xs-2" style="margin-left:-12px;">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number btn-xs" data-type="minus" data-field="sessionDuration">
										<span class="glyphicon glyphicon-minus" style="font-size:18px;width:8px;"></span>
									</button>
								</span>
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number btn-xs" data-type="plus" data-field="sessionDuration">
										<span class="glyphicon glyphicon-plus" style="font-size:18px;width:8px;"></span>
									</button>
								</span>
							</div>
						</div>
		
						<div class="row">
							<div class="col-xs-6"><p>Sessions / Month <a data-html="true" type="button" data-toggle="tooltip" data-placement="bottom" title="<p style='text-align:left;' >Get discount RM5/hour when you choose to have more than 1 session per week. E.g If you choose 1 session/week & the rate is RM50/hour, then by choosing 2 sessions/week the rate will only be RM45/hour </p>"> <i style="color:#262262;" class="fa fa-info-circle"></i> </a> <br/>
								<font id="sessionWeek" style="text-align: left;font-size:10px;font-style: oblique;margin-top:0px;">1 session(s)/week</font></p></p>
							</div>
							<div class="col-xs-4" style="margin-left:-33px;margin-top:-5px;">
								<input readonly style="text-align:center;width:93px;" type="text" id="sessionPerMonth" name="sessionPerMonth" class="form-control input-number" value="<?PHP echo "4 sessions"; ?>" min="4" max="16" >
							</div>
							<div class="col-xs-2" style="margin-left:-12px;">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number btn-xs" data-type="minus" data-field="sessionPerMonth">
										<span class="glyphicon glyphicon-minus" style="font-size:18px;width:8px;"></span>
									</button>
								</span>
								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number btn-xs" data-type="plus" data-field="sessionPerMonth">
										<span class="glyphicon glyphicon-plus" style="font-size:18px;width:8px;"></span>
									</button>
								</span>
							</div>
						</div>
		
						<div class="row hidden">
							<div class="col-xs-6"><p>* Discount code</p></div>
							<div class="col-xs-4" style="margin-left:-33px;margin-top:-5px;">
								<input type="text" name="discount_code" id="discount_code" class="bootstrap" placeholder="Enter Discount code here">
							</div>
							<div class="col-xs-2" style="margin-left:-12px;">
							    
								<span class="input-group-btn">
								    <button id="btnDiscount" type="button" class="btn2 success1" style="margin-left:0px;margin-top:-5px;" onClick="loadDiscount()">
								        <span style="font-size:13px;">Done</span>
								    </button>
								</span>
							</div>
						</div>
						
<hr>
						<div class="row">
							<div class="col-xs-8">Subtotal</div>
							<div class="col-xs-4">
								<p id="subtotal" style="text-align: right;"><?PHP echo "RM ".$MonthlyFee; ?></p>	
							</div>
						</div>
						<div class="row hidden" id="fieldDiscount">
							<div class="col-xs-8"><p id="textDiscount"></p></div>
							<div class="col-xs-4">
								<p id="textDiscountAmount" style="text-align: right;"><strong><font color="red"><?PHP echo "- RM ";//.$RegistrationFee; ?></font></strong></p>	
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-xs-8">Registration Fees (RM50/student, one-time only)</div>
							<div class="col-xs-4">
								<p id="registrationFeeOutput" style="text-align: right;"><?PHP echo "+ RM ".$RegistrationFee; ?></p>	
							</div>
						</div>
<hr>

						<div class="form-group">
							<h4 class=" col-xs-6"><strong>TOTAL :</strong></h4>
							<div class="col-xs-6">
								<h4 id="totalOutput" style="text-align: right;"><strong style="color: #3C763D;">RM <?PHP echo $Total; ?></strong></h4>
								<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;" id="strikethrough" class="hidden"><del>RM <?PHP echo $Total; ?></del></p>
								<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;">*for first month</p>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12">
								<p style="text-align: center;font-size:13px;font-style: oblique;margin-top:0px;">
								*Discounts if you take more than 1 session per week (except intensive classes). Contact our team for further info.
								</p>
							</div>
						</div>
						
					</form>
    
			
				<?
				}else{
				?>
					<div class="alert-message alert-message-danger">
						<h3><?PHP echo "'NOT NUMBER'"; ?></h3>
						<h4><?PHP echo "For further info, please contact our coordinator."; ?></h4>
					</div>	
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
	<?PHP
	}

}
?>

<script>
/* ### LOAD THIS PAGE ### */
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();  
	if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1 ){
		$("#pricePerStudent").show();
		
		studentAdded = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo $thisRate ?>);
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
});

/* ### NORMAL TUTOR CHECKBOX ### */
function normalTutorCheckbox() {
	var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
	if(thisCheckbox == true){
	  
		$("#textNormalTutor").hide();
		$("#textSchoolTeacher").show();
		
		if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
			studentAdded = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo ($thisRate + 10) ?>);
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
			document.getElementById("normalTutorInput").value = "<?php echo 'RM '.($thisRate + 10).' / hour' ?>";
			
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
			document.getElementById("normalTutorInput").value = "<?php echo 'RM '.$thisRate.' / hour' ?>";

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
						document.getElementById("normalTutorInput").value = 'RM '+studentAdded+' / hour';
					}else{
						studentAdded = (((parseFloat((currentVal - 1)) -1) * 10) + <?php echo $thisRate ?>);
						document.getElementById("normalTutorInput").value = 'RM '+studentAdded+' / hour';
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
						document.getElementById("normalTutorInput").value = 'RM '+studentAdded+' / hour';
					}else{
						studentAdded = (((parseFloat((currentVal + 1)) -1) * 10) + <?php echo $thisRate ?>);
						document.getElementById("normalTutorInput").value = 'RM '+studentAdded+' / hour';
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