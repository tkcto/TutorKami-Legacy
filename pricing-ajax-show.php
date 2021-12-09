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
    background-color: #F4FDF0;
    border-color: #3C763D;
}
.alert-message-success h4
{
    color: #3C763D;
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
	
	/*echo $_POST['level'];
	echo $_POST['state'];
	echo $_POST['city'];
	echo $_POST['person'];
	echo "<br/>";*/
	$queryLevel = "SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id = ".$_POST['level']."";
	$resultLevel = $conn->query($queryLevel);
	if ($resultLevel->num_rows > 0) {
		$rowLevel = $resultLevel->fetch_assoc();
		$thisLevel = $rowLevel['tc_title'];
	}else{
		$thisLevel = $_POST['level'];
	}
	
	$sqlRate = "SELECT * FROM tk_location_rate WHERE lr_jl_id = ".$_POST['level']." AND lr_st_id = ".$_POST['state']." AND lr_city_id = ".$_POST['city']." ORDER BY lr_id ASC";
	$resultRate = $conn->query($sqlRate);
	if ($resultRate->num_rows > 0) {
		$rowRate = $resultRate->fetch_assoc();
		if($_POST['person'] == 1){
			$thisRate = $rowRate['lr_rate'];
			$OneHour = $thisRate;
			$halfHour = $thisRate / 2;
			$OneHalfHour = $OneHour + $halfHour;
			$fourWeek = $OneHalfHour * 4;
			/*echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM ".$OneHour.".";
			echo "<br/>";
			echo $fourWeek;	echo "<br/>";
			echo "Registration fees is RM50 per student (one time only)";echo "<br/>";
			echo "Note: Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator.";
			*/
?>
<div class="col-sm-12">
            <div class="alert-message alert-message-success">
			<?PHP
			if(preg_match("/^[0-9.]+$/", $thisRate)) {
			?>
                <h4><?PHP echo "Total Price : <strong> RM ".$fourWeek." </strong>"; ?></h4>
				<p> &#9899; <?PHP echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM ".$OneHour."."; ?></p>
				<p> &#9899; <?PHP echo "If class is 1 ½ hour per session, once a week, amount will be RM ".$thisRate."/hour x 1 ½ hour x 4 weeks = RM ".$fourWeek.""; ?></p>
                <p> &#9899; <?PHP echo "Registration fees is RM50 per student (one time only)";?></p>
				<p> &#9899; <?PHP echo "<strong> <font color='red'>Note : </font></strong>  Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator."; ?></p>
			<?
			}else{
			?>
                <h4><?PHP echo "Total Price : <strong> RM 'NOT NUMBER' </strong>"; ?></h4>
				<p> &#9899; <?PHP echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM 'NOT NUMBER'."; ?></p>
				<p> &#9899; <?PHP echo "If class is 1 ½ hour per session, once a week, amount will be RM 'NOT NUMBER'/hour x 1 ½ hour x 4 weeks = RM 'NOT NUMBER'"; ?></p>
                <p> &#9899; <?PHP echo "Registration fees is RM50 per student (one time only)";?></p>
				<p> &#9899; <?PHP echo "<strong> <font color='red'>Note : </font></strong>  Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator."; ?></p>
			<?
			}
			?>

            </div>
</div>
<?PHP
		}else{
			$thisRate = $rowRate['lr_rate'];
			$person = $_POST['person'] - 1;
			$additionalStudent = $person * 10;
			$todalAdditionalStudent = $thisRate + $additionalStudent;
			$halfHour = $todalAdditionalStudent / 2;
			$OneHalfHour = $todalAdditionalStudent + $halfHour;
			$totalAmount = $OneHalfHour * 4;
			
			$amount1Student = ($thisRate + 10) / 2;			
			
			$halfHourSingle = $thisRate / 2;
			$OneHalfHourSingle = ($thisRate + $halfHourSingle) * 4;

?>
<div class="col-sm-12">
            <div class="alert-message alert-message-success">
			<?PHP
			if(preg_match("/^[0-9.]+$/", $thisRate)) {
			?>
                <h4><?PHP echo "Total Price : <strong> RM ".$totalAmount." </strong>"; ?></h4>
				<p> &#9899; <?PHP echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM ".$thisRate."."; ?></p>

				<p> &#9899; <?PHP echo "If class is 1 ½ hour per session, once a week, amount will be RM ".$thisRate."/hour x 1 ½ hour x 4 weeks = RM ".$OneHalfHourSingle.""; ?></p>
				<p> &#9899; <?PHP echo "For each additional student, plus RM10/hour per student. So if ".$person." students rate will be RM ".$todalAdditionalStudent." /hour. Thus rate for 1 student is RM ".$halfHour." only"; ?></p>
				<p> &#9899; <?PHP echo "Total amount a month for ".$_POST['person']." students is  RM ".$OneHalfHour." /hour x 1 ½ hour x 4 weeks = RM ".$totalAmount.""; ?></p>

                <p> &#9899; <?PHP echo "Registration fees is RM50 per student (one time only)";?></p>
				<p> &#9899; <?PHP echo "<strong> <font color='red'>Note : </font></strong>  Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator."; ?></p>
			<?
			}else{
			?>
                <h4><?PHP echo "Total Price : <strong> RM 'NOT NUMBER' </strong>"; ?></h4>
				<p> &#9899; <?PHP echo "For home tuition, rate is by hour. For < ".$thisLevel." > level, the rate is RM 'NOT NUMBER'."; ?></p>

				<p> &#9899; <?PHP echo "If class is 1 ½ hour per session, once a week, amount will be RM 'NOT NUMBER'/hour x 1 ½ hour x 4 weeks = RM 'NOT NUMBER'"; ?></p>
				<p> &#9899; <?PHP echo "For each additional student, plus RM10/hour per student. So if ".$person." students rate will be RM 'NOT NUMBER' /hour. Thus rate for 1 student is RM 'NOT NUMBER' only"; ?></p>
				<p> &#9899; <?PHP echo "Total amount a month for ".$_POST['person']." students is  RM 'NOT NUMBER' /hour x 1 ½ hour x 4 weeks = RM 'NOT NUMBER'"; ?></p>

				<p> &#9899; <?PHP echo "Registration fees is RM50 per student (one time only)";?></p>
				<p> &#9899; <?PHP echo "<strong> <font color='red'>Note : </font></strong>  Price might be higher by RM10/hour or more, if tutor is a school teacher, or has experience more than 5 years. For further info, please contact our coordinator."; ?></p>
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