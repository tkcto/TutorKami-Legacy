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
	
	//$sqlRate = "SELECT * FROM tk_location_rate WHERE lr_jl_id = ".$_POST['level']." AND lr_st_id = ".$_POST['state']." AND lr_city_id = ".$_POST['city']." ORDER BY lr_id ASC";
	$sqlRate = "SELECT * FROM tk_location_rate2 WHERE level = ".$_POST['level']." AND state = ".$_POST['state']." AND city LIKE '%".$_POST['city']."%' ";
	$resultRate = $conn->query($sqlRate);
	if ($resultRate->num_rows > 0) {
		$rowRate = $resultRate->fetch_assoc();
		if($_POST['person'] == 1){
			//$thisRate = $rowRate['lr_rate'];
			//$thisRate = $rowRate['lr_parent_rate'];
			$thisRate = $rowRate['rate'];
			$OneHour = $thisRate;
			$halfHour = $thisRate / 2;
			$OneHalfHour = $OneHour + $halfHour;
			$fourWeek = $OneHalfHour * 4;
			
?>
<div class="col-sm-12">
            <div class="alert-message alert-message-success">
			<?PHP
			if(preg_match("/^[0-9.]+$/", $thisRate)) {
			?>
                <!--<h4><?PHP echo "Total Price : <strong> RM ".$fourWeek." </strong>"; ?></h4>
				<p> &#9899; <?PHP echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM ".$OneHour."."; ?></p>
				<p> &#9899; <?PHP echo "If class is 1 ½ hour per session, once a week, amount will be RM ".$thisRate."/hour x 1 ½ hour x 4 weeks = RM ".$fourWeek.""; ?></p>
                <p> &#9899; <?PHP echo "Registration fees is RM50 per student (one time only)";?></p>
				<p> &#9899; <?PHP echo "<strong> <font color='red'>Note : </font></strong>  Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator."; ?></p>
				-->
    <form class="form-horizontal">
        <div class="form-group">
            <h4 class=" col-xs-6"><strong>FEE :</strong></h4>
            <div class="col-xs-6">
                <h4 id="monthlyFeeOutput" style="text-align: right;"><?PHP echo "<strong> RM ".$fourWeek." / month</strong>"; ?></h4>
                <p id="pricePerStudent" style="color:blue;text-align:right;font-size:px;font-style:;margin-top:0px;margin-bottom:5px;"></p>
		   </div>
        </div>

        <div class="form-group" style="margin-top:-5px">
			<p class=" col-xs-5"><span id="textNormalTutor">Normal Tutor</span><span id="textSchoolTeacher" style="display:none">School Teacher</span>
				<a type="button" data-toggle="tooltip" data-placement="bottom" title="Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years"><i class="fa fa-question-circle"></i></a>
			</p>
		    
            <div class="col-xs-7">
                <p style="text-align:right;margin-top:-20px;">
					<div class="input-group" style="margin-right:-20px;">
						<input style="text-align:center;margin-right:-30px;" type="text" id="normalTutorInput" class="form-control input-number" value="<?PHP echo "RM ".$OneHour." / hour"; ?>">
						
						<span class="input-group-btn">
							<label style="margin-right:-30px;">
								&nbsp;&nbsp;
							</label>
						</span>
						<span class="input-group-btn">
							<label style="margin-right:-5px;">
							</label>
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
							<label style="margin-right:-30px;">
								&nbsp;&nbsp;
							</label>
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
							<label style="margin-right:-30px;">
								&nbsp;&nbsp;
							</label>
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
							<label style="margin-right:-30px;">
								&nbsp;&nbsp;
							</label>
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

        <div class="form-group" style="">
            <p class=" col-xs-7">Registration Fee (RM50/student, one-time)</p>
            <div class="col-xs-5">
                <p id="registrationFeeOutput" style="text-align: right;"><?PHP echo "+ RM 50"; ?></p>
            </div>
        </div>
        <div class="form-group">
            <h4 class=" col-xs-6"><strong>TOTAL :</strong></h4>
            <div class="col-xs-6">
                <h4 id="totalOutput" style="text-align: right;"><strong style="color: #3C763D;">RM <?PHP echo ($fourWeek + 50)?></strong></h4>
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
                <!--<h4><?PHP echo "Total Price : <strong> RM 'NOT NUMBER' </strong>"; ?></h4>
				<p> &#9899; <?PHP echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM 'NOT NUMBER'."; ?></p>
				<p> &#9899; <?PHP echo "If class is 1 ½ hour per session, once a week, amount will be RM 'NOT NUMBER'/hour x 1 ½ hour x 4 weeks = RM 'NOT NUMBER'"; ?></p>
                <p> &#9899; <?PHP echo "Registration fees is RM50 per student (one time only)";?></p>
				<p> &#9899; <?PHP echo "<strong> <font color='red'>Note : </font></strong>  Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator."; ?></p>
				-->
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
			/*$thisRate = $rowRate['lr_rate'];
			$person = $_POST['person'] - 1;
			$additionalStudent = $person * 10;
			$todalAdditionalStudent = $thisRate + $additionalStudent;
			$halfHour = $todalAdditionalStudent / 2;
			$OneHalfHour = $todalAdditionalStudent + $halfHour;
			$totalAmount = $OneHalfHour * 4;
			
			$amount1Student = ($thisRate + 10) / 2;			
			
			$halfHourSingle = $thisRate / 2;
			$OneHalfHourSingle = ($thisRate + $halfHourSingle) * 4;*/

/*
			$thisRate = $rowRate['lr_rate'];
			$OneHour = $thisRate;
			$halfHour = $thisRate / 2;
			$OneHalfHour = $OneHour + $halfHour;
			$fourWeek = $OneHalfHour * 4;

			$thisRate = $rowRate['lr_rate'];
			if($_POST['person'] > 1){
				$person = $_POST['person'] - 1;
				$additionalStudent = $person * 10;
				$OneHour = $thisRate + $additionalStudent;
			}else{
				$OneHour = $thisRate;
			}
			$halfHour = $thisRate / 2;
			$OneHalfHour = $OneHour + $halfHour;
			$fourWeek = $OneHour * 4 * 1.5;*/
			
			//$thisRate = $rowRate['lr_rate'];
			//$thisRate = $rowRate['lr_parent_rate'];
			$thisRate = $rowRate['rate'];
			$OneHour = $thisRate;
			$halfHour = $thisRate / 2;
			$OneHalfHour = $OneHour + $halfHour;
			$fourWeek = $OneHalfHour * 4;
?>
<div class="col-sm-12">
            <div class="alert-message alert-message-success">
			<?PHP
			if(preg_match("/^[0-9.]+$/", $thisRate)) {
			?>
                <!--<h4><?PHP echo "Total Price : <strong> RM ".$totalAmount." </strong>"; ?></h4>
				<p> &#9899; <?PHP echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM ".$thisRate."."; ?></p>

				<p> &#9899; <?PHP echo "If class is 1 ½ hour per session, once a week, amount will be RM ".$thisRate."/hour x 1 ½ hour x 4 weeks = RM ".$OneHalfHourSingle.""; ?></p>
				<p> &#9899; <?PHP echo "For each additional student, plus RM10/hour per student. So if ".$person." students rate will be RM ".$todalAdditionalStudent." /hour. Thus rate for 1 student is RM ".$halfHour." only"; ?></p>
				<p> &#9899; <?PHP echo "Total amount a month for ".$_POST['person']." students is  RM ".$OneHalfHour." /hour x 1 ½ hour x 4 weeks = RM ".$totalAmount.""; ?></p>

                <p> &#9899; <?PHP echo "Registration fees is RM50 per student (one time only)";?></p>
				<p> &#9899; <?PHP echo "<strong> <font color='red'>Note : </font></strong>  Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator."; ?></p>
                -->
				
    <form class="form-horizontal">
        <div class="form-group">
            <h4 class=" col-xs-6"><strong>FEE :</strong></h4>
            <div class="col-xs-6">
                <h4 id="monthlyFeeOutput" style="text-align: right;"><?PHP echo "<strong> RM ".$fourWeek." / month</strong>"; ?></h4>
                <p id="pricePerStudent" style="color:blue;text-align:right;font-size:px;font-style:;margin-top:0px;margin-bottom:5px;">
				</p>
		   </div>
        </div>

        <div class="form-group" style="margin-top:-5px">
            <p class=" col-xs-5"><span id="textNormalTutor">Normal Tutor</span><span id="textSchoolTeacher" style="display:none">School Teacher</span>
				<a type="button" data-toggle="tooltip" data-placement="bottom" title="Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years"><i class="fa fa-question-circle"></i></a>
			</p>
            <div class="col-xs-7">
                <p style="text-align:right;margin-top:-20px;">
					<div class="input-group" style="margin-right:-20px;">
						<input style="text-align:center;margin-right:-30px;" type="text" id="normalTutorInput" class="form-control input-number" value="<?PHP echo "RM ".$OneHour." / hour"; ?>">
						
						<span class="input-group-btn">
							<label style="margin-right:-30px;">
								&nbsp;&nbsp;
							</label>
						</span>
						<span class="input-group-btn">
							<label style="margin-right:-5px;">
							</label>
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
							<label style="margin-right:-30px;">
								&nbsp;&nbsp;
							</label>
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
							<label style="margin-right:-30px;">
								&nbsp;&nbsp;
							</label>
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
							<label style="margin-right:-30px;">
								&nbsp;&nbsp;
							</label>
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

        <div class="form-group" style="">
            <p class=" col-xs-7">Registration Fee (RM50/student, one-time)</p>
            <div class="col-xs-5">
                <p id="registrationFeeOutput" style="text-align: right;"><?PHP echo "+ RM ".$_POST['person'] *50; ?></p>
            </div>
        </div>
        <div class="form-group">
            <h4 class=" col-xs-6"><strong>TOTAL :</strong></h4>
            <div class="col-xs-6">
                <h4 id="totalOutput" style="text-align: right;"><strong style="color: #3C763D;">RM <?PHP echo ($fourWeek + ($_POST['person'] *50))?></strong></h4>
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
                <!--<h4><?PHP echo "Total Price : <strong> RM 'NOT NUMBER' </strong>"; ?></h4>
				<p> &#9899; <?PHP echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM 'NOT NUMBER'."; ?></p>

				<p> &#9899; <?PHP echo "If class is 1 ½ hour per session, once a week, amount will be RM 'NOT NUMBER'/hour x 1 ½ hour x 4 weeks = RM 'NOT NUMBER'"; ?></p>
				<p> &#9899; <?PHP echo "For each additional student, plus RM10/hour per student. So if ".$person." students rate will be RM 'NOT NUMBER' /hour. Thus rate for 1 student is RM 'NOT NUMBER' only"; ?></p>
				<p> &#9899; <?PHP echo "Total amount a month for ".$_POST['person']." students is  RM 'NOT NUMBER' /hour x 1 ½ hour x 4 weeks = RM 'NOT NUMBER'"; ?></p>

				<p> &#9899; <?PHP echo "Registration fees is RM50 per student (one time only)";?></p>
				<p> &#9899; <?PHP echo "<strong> <font color='red'>Note : </font></strong>  Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator."; ?></p>
				-->
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
			
		}
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
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
  
	  if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1 ){
		  var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
		  var numb = txtString.match(/\d/g);
		  numb = numb.join("");
		  document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
		  
		  thisb = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo $OneHour ?>);
		  document.getElementById("normalTutorInput").value = 'RM '+thisb+' / hour';
		  
		  valueNormalTutor = document.getElementById("normalTutorInput").value.substring(3, 5);
		  valueDuration = 1.5;
		  valueMonth = 4;
		  calMonthfee = valueNormalTutor * valueDuration * valueMonth;
		  document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
		  //alert(valueNormalTutor+" - "+valueDuration+" - "+valueMonth);
		}else{
		  document.getElementById("pricePerStudent").innerHTML = "";
		  document.getElementById("normalTutorInput").value = "<?php echo 'RM '.$OneHour.' / hour' ?>";
	  }
  
});

function normalTutorCheckbox() {
  var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
  if(thisCheckbox == true){
	  
	  /*var textNormalTutor = document.getElementById("textNormalTutor");
	  if (textNormalTutor.style.display === "none") {
		textNormalTutor.style.display = "block";
	  } else {
		textNormalTutor.style.display = "none";
	  }*/ $("#textNormalTutor").hide();
	  $("#textSchoolTeacher").show();

	  
	  if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
		thisa = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo ($OneHour + 10) ?>);
		document.getElementById("normalTutorInput").value = 'RM '+thisa+' / hour';
		valueNormalTutor = thisa;
	  }else{
		document.getElementById("normalTutorInput").value = "<?php echo 'RM '.($OneHour + 10).' / hour' ?>"; //'RM '+(parseFloat(document.getElementById("normalTutorInput").value.substring(3, 5)) + 10)+' / hour';
		valueNormalTutor = "<?php echo ($OneHour + 10) ?>";
	  }
/*
	  document.getElementById("normalTutorInput").value = "<?php echo 'RM '.($OneHour + 10).' / hour' ?>"; //'RM '+(parseFloat(document.getElementById("normalTutorInput").value.substring(3, 5)) + 10)+' / hour';
	  valueNormalTutor = "<?php echo ($OneHour + 10) ?>";
*/
	  firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
	  secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
	  if(secondDigitMF == '30'){
		  valueDuration = parseFloat(firstDigitMF+'.'+'5');
	  }else{
		  valueDuration = parseFloat(firstDigitMF+'.'+'0');
	  }
	  valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
	  calMonthfee = valueNormalTutor * valueDuration * valueMonth;
	  calTotal = calMonthfee + (parseFloat(document.getElementById("NoOfStudentsInput").value) * 50);
	  document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
	  if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1 ){
		  var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
		  var numb = txtString.match(/\d/g);
		  numb = numb.join("");
		  document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
	  }else{
		  document.getElementById("pricePerStudent").innerHTML = "";
	  }
	  document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
  
 }else{
	 
	  $("#textSchoolTeacher").hide();
	  $("#textNormalTutor").show();
	  
	  if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
		thisa = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo $OneHour ?>);
		document.getElementById("normalTutorInput").value = 'RM '+thisa+' / hour';
		valueNormalTutor = thisa;
	  }else{
		document.getElementById("normalTutorInput").value = "<?php echo 'RM '.$OneHour.' / hour' ?>"; //'RM '+(parseFloat(document.getElementById("normalTutorInput").value.substring(3, 5)) + 10)+' / hour';
		valueNormalTutor = "<?php echo $OneHour ?>";
	  }
/*
	  document.getElementById("normalTutorInput").value = 'RM '+(parseFloat(document.getElementById("normalTutorInput").value.substring(3, 5)))+' / hour';//"<?php echo 'RM '.$OneHour.' / hour' ?>";
	  valueNormalTutor = "<?php echo $OneHour ?>";
*/
	  firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
	  secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
	  if(secondDigitMF == '30'){
		  valueDuration = parseFloat(firstDigitMF+'.'+'5');
	  }else{
		  valueDuration = parseFloat(firstDigitMF+'.'+'0');
	  }
	  valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
	  calMonthfee = valueNormalTutor * valueDuration * valueMonth;
	  calTotal = calMonthfee + (parseFloat(document.getElementById("NoOfStudentsInput").value) * 50);
	  document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
	  if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
		  var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
		  var numb = txtString.match(/\d/g);
		  numb = numb.join("");
		  document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
	  }else{
		  document.getElementById("pricePerStudent").innerHTML = "";
	  }
	  document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
  }
}

//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
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
    if (!isNaN(currentVal)) {
		
if(fieldName == 'NoOfStudentsInput'){
        if(type == 'minus') {
            if(currentVal > input.attr('min')) {
                //input.val(currentVal - 1).change();
				document.getElementById("NoOfStudentsInput").value = (currentVal - 1) +"<?PHP echo ' pax' ?>";
				totalAmountRf = (currentVal - 1) * 50;
				document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalAmountRf;

				var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
				if(thisCheckbox == true){
					if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
						thisa = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo ($OneHour + 10) ?>);
						document.getElementById("normalTutorInput").value = 'RM '+thisa+' / hour';
					}else{
						document.getElementById("normalTutorInput").value = "<?php echo 'RM '.($OneHour + 10).' / hour' ?>";
					}
				}else{
					if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
						thisa = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo $OneHour ?>);
						document.getElementById("normalTutorInput").value = 'RM '+thisa+' / hour';
					}else{
						document.getElementById("normalTutorInput").value = "<?php echo 'RM '.$OneHour.' / hour' ?>";
					}
				}
				
				valueNormalTutor = document.getElementById("normalTutorInput").value.substring(3, 5);
				firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
				valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				calMonthfee = valueNormalTutor * valueDuration * valueMonth;
				calTotal = calMonthfee + (parseFloat(document.getElementById("NoOfStudentsInput").value) * 50);
				document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
				if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
					var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
					var numb = txtString.match(/\d/g);
					numb = numb.join("");
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
				}else{
					document.getElementById("pricePerStudent").innerHTML = "";
				}
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		  } 
			if(currentVal == '1') {
				alert("Sorry the minimum value has been reached");
			}
        } else if(type == 'plus') {
            if(currentVal < input.attr('max')) {
                //input.val(currentVal + 1).change();
				document.getElementById("NoOfStudentsInput").value = (currentVal + 1) +"<?PHP echo ' pax' ?>";
				totalAmountRf = (currentVal + 1) * 50;
				document.getElementById("registrationFeeOutput").innerHTML = "<?PHP echo '+ RM '  ?>" + totalAmountRf;


				var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
				if(thisCheckbox == true){
					if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
						thisa = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo ($OneHour + 10) ?>);
						document.getElementById("normalTutorInput").value = 'RM '+thisa+' / hour';
					}else{
						document.getElementById("normalTutorInput").value = "<?php echo 'RM '.($OneHour + 10).' / hour' ?>";
					}
				}else{
					if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
						thisa = (((parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1)) -1) * 10) + <?php echo $OneHour ?>);
						document.getElementById("normalTutorInput").value = 'RM '+thisa+' / hour';
					}else{
						document.getElementById("normalTutorInput").value = "<?php echo 'RM '.$OneHour.' / hour' ?>";
					}
				}
				

				valueNormalTutor = document.getElementById("normalTutorInput").value.substring(3, 5);
				firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
				valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				calMonthfee = valueNormalTutor * valueDuration * valueMonth;
				calTotal = calMonthfee + (parseFloat(document.getElementById("NoOfStudentsInput").value) * 50);
				document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
				if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
					var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
					var numb = txtString.match(/\d/g);
					numb = numb.join("");
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
				}else{
					document.getElementById("pricePerStudent").innerHTML = "";
				}
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";

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
				 
				valueNormalTutor = document.getElementById("normalTutorInput").value.substring(3, 5);
				firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
				valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				calMonthfee = valueNormalTutor * valueDuration * valueMonth;
				calTotal = calMonthfee + (parseFloat(document.getElementById("NoOfStudentsInput").value) * 50);
				document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
				if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
					var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
					var numb = txtString.match(/\d/g);
					numb = numb.join("");
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
				}else{
					document.getElementById("pricePerStudent").innerHTML = "";
				}
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		 
            } 
			if(resultTime == parseFloat(1.3)) {
				alert("Sorry the minimum value has been reached");
			}
        } else if(type == 'plus') {
            if(resultTime < parseFloat(3.0)) {
				 outputTime = (resultTime + 0.3);
				 decimals = (outputTime - Math.floor(outputTime)).toFixed(1);
				 if(decimals == 0.6){
					 document.getElementById("sessionDuration").value = (parseInt(firstDigit) + 1) +' hour 00 mins';
				 }else{
					 document.getElementById("sessionDuration").value = (parseInt(firstDigit)) +' hour '+ '30' +' mins';
				 }
				 
				valueNormalTutor = document.getElementById("normalTutorInput").value.substring(3, 5);
				firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
				valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				calMonthfee = valueNormalTutor * valueDuration * valueMonth;
				calTotal = calMonthfee + (parseFloat(document.getElementById("NoOfStudentsInput").value) * 50);
				document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
				if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
					var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
					var numb = txtString.match(/\d/g);
					numb = numb.join("");
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
				}else{
					document.getElementById("pricePerStudent").innerHTML = "";
				}
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		 
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

				valueNormalTutor = document.getElementById("normalTutorInput").value.substring(3, 5);
				firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
				valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				calMonthfee = valueNormalTutor * valueDuration * valueMonth;
				calTotal = calMonthfee + (parseFloat(document.getElementById("NoOfStudentsInput").value) * 50);
				document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
				if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
					var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
					var numb = txtString.match(/\d/g);
					numb = numb.join("");
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
				}else{
					document.getElementById("pricePerStudent").innerHTML = "";
				}
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		 
		   }        
			if(currentVal == '4') {
				alert("Sorry the minimum value has been reached");
			}
        } else if(type == 'plus') {
            if(currentVal < input.attr('max')) {
				document.getElementById("sessionPerMonth").value = (currentVal + 4) +"<?PHP echo ' session' ?>";
				document.getElementById("sessionWeek").innerHTML = ((currentVal + 4) / 4) + ' session(s)/week';

				valueNormalTutor = document.getElementById("normalTutorInput").value.substring(3, 5);
				firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
				valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				calMonthfee = valueNormalTutor * valueDuration * valueMonth;
				calTotal = calMonthfee + (parseFloat(document.getElementById("NoOfStudentsInput").value) * 50);
				document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ calMonthfee +" / month</strong>";
				if(document.getElementById("NoOfStudentsInput").value.substring(0, 1) > 1){
					var txtString = document.getElementById("monthlyFeeOutput").innerHTML;
					var numb = txtString.match(/\d/g);
					numb = numb.join("");
		  //parseFloat( ).toFixed(2);
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat(parseFloat(numb) / parseFloat(document.getElementById("NoOfStudentsInput").value.substring(0, 1))).toFixed(2) +" / student)</b> ";
				}else{
					document.getElementById("pricePerStudent").innerHTML = "";
				}
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ calTotal +"</strong>";
		 
            }
			if(currentVal == '16') {
				alert("Sorry the maximum value has been reached");
			}
        }
}
    } else {
        input.val(0);
    }


});/*
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
	
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {5 years
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});*/
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
</script>
<script>
</script>