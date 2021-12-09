<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


if(isset($_POST['approveReview'])){
	$approveReview = $_POST['approveReview'];
	
	$sql = " UPDATE tk_review_rating SET rr_status='approved' WHERE rr_id='".$approveReview["id"]."' ";
	
	if ( $conn->query($sql) === TRUE ) {
		echo "Data Has Been Approve";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}

if(isset($_POST['deleteReview'])){
	$deleteReview = $_POST['deleteReview'];
	
	$sql = "DELETE FROM tk_review_rating WHERE rr_id='".$deleteReview['id']."'";
	
	if ( $conn->query($sql) === TRUE ) {
		echo "Data Has Been Delete";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}


$conn->close();
?>