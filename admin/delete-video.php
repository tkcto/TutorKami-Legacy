<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_POST['dataReset'])){
	$dataReset = $_POST['dataReset'];
	if( !empty($dataReset["id"]) ){


        $sql = "DELETE FROM tk_upload_video WHERE v_filename2 = '".$dataReset['id']."' ";
        if ($conn->query($sql) === TRUE) {
            unlink('../video/'.$dataReset['id']);
            echo 'success';            
        }else{
            echo 'error';
        }



    
	}
}


if(isset($_POST['deleteApprovedRating'])){
	$deleteApprovedRating = $_POST['deleteApprovedRating'];
	if( !empty($deleteApprovedRating["id"]) ){
        $sql = "DELETE FROM tk_review_rating WHERE rr_id = '".$deleteApprovedRating['id']."' ";
        if ($conn->query($sql) === TRUE) {
            echo 'success';            
        }else{
            echo 'error';
        }
	}
}
?>