<?php
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if( !empty($_POST["tutorID"]) && !empty($_POST["parentID"]) && !empty($_POST["jobID"]) ){
    

    $CekSubmit = " SELECT * FROM tk_review_rating WHERE rr_tutor_id = '".$_POST["tutorID"]."' AND rr_parent_id = '".$_POST["parentID"]."' AND rr_job = '".$_POST["jobID"]."' ";
    $resultCekSubmit = $conn->query($CekSubmit);
    if ($resultCekSubmit->num_rows > 0) {
        echo 'existing';
    }else{
        $rr_create_date 	= date('Y-m-d h:i:s');
    
        $updateRate = "INSERT INTO tk_review_rating SET 
            rr_tutor_id 		= '".$_POST["tutorID"]."',
            rr_parent_id 		= '".$_POST["parentID"]."',
            rr_rating 			= '".$_POST["rating"]."',
            rr_review 			= '".$_POST["review"]."',
            rr_about_tutor 		= '".$_POST["share_about_tutor"]."',
            rr_tutor_improve 	= '".$_POST["tutor_improve"]."',
            rr_create_date  	= '".$rr_create_date."',
            rr_job  	        = '".$_POST["jobID"]."'
            ";
    
    	if ($conn->query($updateRate) === TRUE) {
    	    
            $send_rate = '';
            $GetJob = " SELECT j_id, send_rate  FROM tk_job WHERE j_id = '".$_POST["jobID"]."' ";
            $reGetJob = $conn->query($GetJob);
            if ($reGetJob->num_rows > 0) {
                $roGetJob = $reGetJob->fetch_assoc();
                $send_rate = $roGetJob["send_rate"].' '.$roGetJob["j_id"];
                
                $sqlUpdate = "UPDATE tk_job SET send_rate = '".$send_rate."' WHERE j_id = '".$roGetJob["j_id"]."'  ";
                $conn->query($sqlUpdate);
            }
            
    	    echo 'success';
    	}else{
    	    echo 'x success';
    	}        
    }

}else{
    echo 'error';
}
$conn->close();
?>