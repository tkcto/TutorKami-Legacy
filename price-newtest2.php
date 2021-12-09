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
  width: 30px;
  height: 17px;
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
  background-color: #ccc;
  -webkit-transition: .2s;
  transition: .2s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .2s;
  transition: .2s;
}

input.success:checked + .slider {
  background-color: #5cb85c;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
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
	
	$sqltest = "SELECT * FROM tk_location_rate2 WHERE level = ".$_POST['level']." AND state = ".$_POST['state']." ";
	$resulttest = $conn->query($sqltest);
	if ($resulttest->num_rows > 0) {
		while($rowtest = $resulttest->fetch_assoc()){
			$thisArray = $rowtest['city'];
			if (in_array($_POST['city'], (explode(',',$thisArray)))){
				//echo  $rowtest['id'];
				//echo "Match found";
				//echo "<br/>";
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
			
			?>
			<div class="col-sm-12">
				<div class="alert-message alert-message-success">
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

					<form class="form-horizontal">
						<div class="form-group">
							<h4 class=" col-xs-6"><strong>FEES :</strong></h4>
							<div class="col-xs-6">
							
								<h4 id="monthlyFeeOutput" style="text-align: right;"><?PHP echo "<strong> RM ".$MonthlyFee." / month</strong>"; ?></h4>
								<p id="pricePerStudent" style="color:blue;text-align:right;font-size:px;font-style:;margin-top:0px;margin-bottom:5px;display:none;"><b><?PHP echo "(RM ".$pricePerStudent." / student)"; ?></b></p>
							
							</div>
						</div>

						<div class="form-group" style="margin-top:-5px">
							<p class=" col-xs-5"><span id="textNormalTutor">Normal Tutor</span><span id="textSchoolTeacher" style="display:none">School Teacher</span>
								<a type="button" data-toggle="tooltip" data-placement="bottom" title="Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years"><i class="fa fa-question-circle"></i></a>
							</p>
		    
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input style="text-align:center;margin-right:-30px;" type="text" id="normalTutorInput" class="form-control input-number" value="<?PHP echo "RM ".$thisRate." / hour"; ?>">
						
										<span class="input-group-btn">
											<label style="margin-right:-30px;">&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<label style="margin-right:-5px;"></label>
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
							<p class=" col-xs-5">No. Of Students</p>
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input style="text-align:center;margin-right:-30px;" type="text" id="NoOfStudentsInput" name="NoOfStudentsInput" class="form-control input-number" value="<?PHP echo $_POST['person']." pax"; ?>" min="1" max="5" onChange="NoOfStudentsOnChange()">
						
										<span class="input-group-btn">
											<label style="margin-right:-30px;">&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<button style="margin-right:-30px;" type="button" class="btn btn-default btn-number btn-sm" data-type="minus" data-field="NoOfStudentsInput">
												<span class="glyphicon glyphicon-minus" style="font-size:20px;"></span>
											</button>
										</span>
										<span class="input-group-btn">
											<button type="button" class="btn btn-default btn-number btn-sm" data-type="plus" data-field="NoOfStudentsInput">
												<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
											</button>
										</span>
										
									</div>
								</p>
							</div>
						</div>

						<div class="form-group" style="margin-top:-5px">
							<p class=" col-xs-5">Session Duration</p>
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input style="text-align:center;margin-right:-30px;" type="text" id="sessionDuration" name="sessionDuration" class="form-control input-number" value="<?PHP echo "1 hour 30 mins"; ?>">

										<span class="input-group-btn">
											<label style="margin-right:-30px;">&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<button style="margin-right:-30px;" type="button" class="btn btn-default btn-number btn-sm" data-type="minus" data-field="sessionDuration">
												<span class="glyphicon glyphicon-minus" style="font-size:20px;"></span>
											</button>
										</span>
										<span class="input-group-btn">
											<button type="button" class="btn btn-default btn-number btn-sm" data-type="plus" data-field="sessionDuration">
												<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
											</button>
										</span>
										
									</div>
								</p>
							</div>
						</div>
		
						<div class="form-group" style="margin-top:-5px">
							<p class=" col-xs-5">Session Per Month <br/>
							<font id="sessionWeek" style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;">1 session(s)/week</font></p>
							<div class="col-xs-7">
								<p style="text-align:right;margin-top:-20px;">
									<div class="input-group" style="margin-right:-20px;">
									
										<input style="text-align:center;margin-right:-30px;" type="text" id="sessionPerMonth" name="sessionPerMonth" class="form-control input-number" value="<?PHP echo "4 session"; ?>" min="4" max="16" >
						
										<span class="input-group-btn">
											<label style="margin-right:-30px;">&nbsp;&nbsp;</label>
										</span>
										<span class="input-group-btn">
											<button style="margin-right:-30px;" type="button" class="btn btn-default btn-number btn-sm" data-type="minus" data-field="sessionPerMonth">
												<span class="glyphicon glyphicon-minus" style="font-size:20px;"></span>
											</button>
										</span>
										<span class="input-group-btn">
											<button type="button" class="btn btn-default btn-number btn-sm" data-type="plus" data-field="sessionPerMonth">
												<span class="glyphicon glyphicon-plus" style="font-size:20px;"></span>
											</button>
										</span>
										
									</div>
								</p>
							</div>
						</div>
		
						<div class="form-group" style="margin-top:-5px">
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
							<p class=" col-xs-7">Subtotal</p>
							<div class="col-xs-5">
								<p id="subtotal" style="text-align: right;"><?PHP echo "RM ".$MonthlyFee; ?></p>
							</div>
						</div>
						<div class="form-group hidden" style="margin-top:-90px;" id="fieldDiscount">
							<p class=" col-xs-7" id="textDiscount"></p>
							<div class="col-xs-5">
								<p id="textDiscountAmount" style="text-align: right;"><strong><font color="red"><?PHP echo "- RM ";//.$RegistrationFee; ?></font></strong></p>
							</div>
						</div>
						
						<div class="form-group" style="margin-top:-90px;">
							<p class=" col-xs-7">Registration Fees (RM50/student, one-time)</p>
							<div class="col-xs-5">
							
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
	
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
	
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
	
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
	
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
	
    if (!isNaN(currentVal)) {

		if(fieldName == 'NoOfStudentsInput'){
			if(type == 'minus') {
				if(currentVal > input.attr('min')) {
			
					document.getElementById("NoOfStudentsInput").value = (currentVal - 1) +"<?PHP echo ' pax' ?>";
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
	
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
					document.getElementById("NoOfStudentsInput").value = (currentVal + 1) +"<?PHP echo ' pax' ?>";
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
	
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
					document.getElementById("sessionPerMonth").value = (currentVal - 4) +"<?PHP echo ' session' ?>";
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
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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
					document.getElementById("sessionPerMonth").value = (currentVal + 4) +"<?PHP echo ' session' ?>";
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
			if( document.getElementById("discount_code").value == null || document.getElementById("discount_code").value === '' ){
				document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
			}else{
				var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
				var replace = sessionPerMonth.replace(" session", "");
				var sessionDuration = document.getElementById("sessionDuration").value; 
				var replace2 = sessionDuration.replace(" hour ", ".");
				var replace3 = replace2.replace(" mins", "");
				
				if( document.getElementById("discount_code").value == 'TKBEST5' && (replace >= 8 || replace3 >= 3) ){

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

	
	var sessionPerMonth = document.getElementById("sessionPerMonth").value; 
	var replace = sessionPerMonth.replace(" session", "");
	
	var sessionDuration = document.getElementById("sessionDuration").value; 
	var replace2 = sessionDuration.replace(" hour ", ".");
	var replace3 = replace2.replace(" mins", "");
	
	
	if(discount_code === ""){
		alertOk.classList.add("hidden");	
		alertInvalid.classList.add("hidden");	
		alertInvalid2.classList.add("hidden");	
		alertInvalid3.classList.add("hidden");	
		fieldDiscount.classList.add("hidden");	
		strikethrough.classList.add("hidden");
		
		alertInvalid3.classList.remove("hidden");	
	}
	else if(discount_code !== 'TKBEST5'){
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
/*
					var getValueNormalTutorInput = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInput = getValueNormalTutorInput.match(/\d/g);
					getValueDigitNormalTutorInput2 = getValueDigitNormalTutorInput.join("");			
					//getValueDigitNormalTutorInput = getValueDigitNormalTutorInput2 - 5;	
					getValueDigitNormalTutorInput = getValueDigitNormalTutorInput2;	
					
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

					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(calMonthfee) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
		
					document.getElementById("subtotal").innerHTML = "RM "+ calMonthfee +" ";
					
					$("#textDiscount").html("<strong><font color='red'>Discount ( " + discount_code + " )</font></strong>");
			
//after discount 
					var getValueNormalTutorInputWD = document.getElementById("normalTutorInput").value;
					var getValueDigitNormalTutorInputWD = getValueNormalTutorInputWD.match(/\d/g);
					getValueDigitNormalTutorInputWD2 = getValueDigitNormalTutorInputWD.join("");			
					getValueDigitNormalTutorInputthis = getValueDigitNormalTutorInputWD2 - 5;		
	
					
					firstDigitMFWD = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMFWD = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMFWD == '30'){
						valueDurationWD = parseFloat(firstDigitMFWD+'.'+'5');
					}else{
						valueDurationWD = parseFloat(firstDigitMFWD+'.'+'0');
					}
					valueMonthWD = parseInt(document.getElementById("sessionPerMonth").value);
					calMonthfeeWD = getValueDigitNormalTutorInputthis * valueDurationWD * valueMonthWD;
					amountDiscount = calMonthfee - calMonthfeeWD;
					document.getElementById("textDiscountAmount").innerHTML = "<strong><font color=red>- RM " + amountDiscount + "</font></strong>";		


					totalStudent = document.getElementById("NoOfStudentsInput").value.substring(0, 1);
					amountstrikethrough = calMonthfee + (totalStudent * 50);
					document.getElementById("strikethrough").innerHTML = "<font size='2px'><del>RM " + amountstrikethrough + " </del></font>"; 
*/
		
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

	
	
	
	//$(".btn-number").triggerHandler("click");


	var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	if (isMobile) {
		if(level != '' && state != '' && city != '' && person != ''){
			/*$.ajax({
                type:'POST',
                url:'pricing-ajax-mobile.php',
                data:{level: level, state: state, city: city, person: person},
                beforeSend: function() {
					$('#demo').html("Loding ... ");
                },
                success:function(result){
					$('#demo').html(result);
                }
			});*///$('#demo').html('aaaaa');
		}
	}else{
		if(level != '' && state != '' && city != '' && person != ''){
			/*$.ajax({
                type:'POST',
                url:'pricing-ajax-desktop.php',
                data:{level: level, state: state, city: city, person: person},
                beforeSend: function() {
					$('#demo').html("Loding ... ");
                },
                success:function(result){
					$('#demo').html(result);
                }
			});*///$('#demo').html('bbbb');
		}
	}
}
</script>
<script>
</script>