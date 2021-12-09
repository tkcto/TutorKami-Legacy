<?php
require_once('user.class.php');
$userInit = new user;

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if(isset($_POST['data'])){

$tutor_arr = array();
        $qeJob = " SELECT * FROM tk_job ORDER BY j_create_date DESC, j_id DESC  ";
        $resQueryJob = $conn->query($qeJob); 
        if($resQueryJob->num_rows > 0){
            while($rQJob = $resQueryJob->fetch_assoc()){
                
                 if( $rQJob["j_create_date"] =='' ){
                	 $thisDate = $rQJob["j_create_date"];
                 }else if( $rQJob["j_create_date"]=='0000-00-00 00:00:00' ){
                	 $thisDate = '';
                 }else if( (date("Y", strtotime($rQJob['j_create_date'])))=='1970' ){
                	 $thisDate = '';
                 }else{
                    $day = date('d', strtotime($rQJob['j_create_date']));
                    $month = date('m', strtotime($rQJob['j_create_date']));
                    $year = date('Y', strtotime($rQJob['j_create_date']));
                    //$year = substr( $year, -2);
                	
                	$thisDate = $day.'/'.$month.'/'.$year;
                 }
                
                $Level = " SELECT jlt_jl_id, jlt_title FROM tk_job_level_translation WHERE jlt_jl_id = '".$rQJob["j_jl_id"]."' ";
                $resLevel = $conn->query($Level); 
                if($resLevel->num_rows > 0){
                    $rLevel = $resLevel->fetch_assoc();
                    $thisLevel = $rLevel["jlt_title"];
                }else{
                    $thisLevel = '';
                }
                
                $Subject = " SELECT jt_j_id, jt_subject FROM tk_job_translation WHERE jt_j_id = '".$rQJob["j_id"]."' ";
                $resSubject = $conn->query($Subject); 
                if($resSubject->num_rows > 0){
                    $rSubject = $resSubject->fetch_assoc();
                    //$thisSubject = htmlspecialchars($rSubject["jt_subject"], ENT_QUOTES);    //$rSubject["jt_subject"];
                    $thisSubject = htmlspecialchars(htmlentities($rSubject["jt_subject"]), ENT_QUOTES); 
                }else{
                    $thisSubject = '';
                }
/*
$thisSubject = '';
*/
                $thisArea = $rQJob["j_area"];

                $State = " SELECT st_id, st_name FROM tk_states WHERE st_id = '".$rQJob["state"]."' ";
                $resState = $conn->query($State); 
                if($resState->num_rows > 0){
                    $rState = $resState->fetch_assoc();
                    $thisState = $rState["st_name"];
                }else{
                    $thisState = '';
                }
                
                $thisCity = '';
                $thisCityState = '';
                $City = " SELECT city_id, city_name FROM tk_cities WHERE city_id = '".$rQJob["city"]."' ";
                $resCity = $conn->query($City); 
                if($resCity->num_rows > 0){
                    $rCity = $resCity->fetch_assoc();
                    $thisCity = $rCity["city_name"];
                }
                
                $thisCityState = '<font><span class="tooltip-left cursor" data-tooltip="'.$thisState.'" >'.$thisCity.'</span></font>';

                $thisStatus = $rQJob["j_status"];
                
                 if($rQJob["j_payment_status"] == 'pending'){
                	$thisPStatus = 'Unpaid';
                 }else{
                	$thisPStatus = $rQJob["j_payment_status"];
                 }

                //$thisApplied = '<input disabled type="checkbox" >';
                $thisApplied = 'no';
                $Applied = " SELECT * FROM tk_applied_job WHERE aj_j_id = '".$rQJob["j_id"]."' ";
                $resApplied = $conn->query($Applied); 
                if($resApplied->num_rows > 0){
                    $rApplied = $resApplied->fetch_assoc();
                    //$thisApplied = '<input disabled type="checkbox" checked>';
                    $thisApplied = 'yes';
                }
                
                if( $rQJob["j_deadline"] =='' ){
                    $thisDeadline = $rQJob["j_deadline"];
                }else if( $rQJob["j_deadline"]=='0000-00-00' ){
                    $thisDeadline = '';
                }else{
                    $thisDeadline = date("d/m/Y", strtotime($rQJob['j_deadline']));
                }
/*
 $thisAction = '
	<span class="btn-group">
		<a href="job-edit.php?j='.$rQJob['j_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
	</span>';
*/
                
                $jobDetails[] = array("Data_OriCreate" => $rQJob["j_create_date"],"Data_ID" => $rQJob["j_id"],"Data_Date" => $thisDate,"Data_Level" => $thisLevel,"Data_Subject" => $thisSubject,"Data_Area" => $thisArea,"Data_City" => $thisCityState,"Data_Status" => $thisStatus,"Data_PaymentStatus" => $thisPStatus,"Data_Applied" => $thisApplied,"Data_Deadline" => $thisDeadline);  
            }
            echo json_encode($jobDetails);
        }else{
            echo json_encode(["message"=>'Tiada Maklumat!']);
        }
    

    
}
?>