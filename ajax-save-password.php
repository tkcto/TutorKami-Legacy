<?php
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

if (isset($_POST['action'])) {
    

	if ($_POST['action'] == 'savePassword') {
	    $old_password     = $conn->real_escape_string($_POST['old_password']);
	    $new_password     = $conn->real_escape_string($_POST['new_password']);
	    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

        if( isset($_SESSION['auth']['user_id']) && isset($_SESSION['auth']['user_id']) > 0 ){
    	    $user_id = $_SESSION['auth']['user_id'];
            $chk = " SELECT * FROM tk_user WHERE u_id = '".$user_id."' AND u_password = '".md5($old_password)."' ";
            $qry = $conn->query($chk);
            if ($qry->num_rows == 0) {
            	echo 'Old password mismatch';
            } elseif($new_password != $confirm_password){
            	echo 'Password mismatch';
            } else {
                $sqly = " UPDATE tk_user SET u_password = '".md5($new_password)."' WHERE u_id = '".$user_id."' ";
                if ( ($conn->query($sqly) === TRUE) ) {
            	    echo 'success';
                }else{
                    echo 'Database error';
                }
            }
        }else{
            echo 'Error';
        }
	} 
	
	
}
?>