<?php
/* Database connection start */
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$connect = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($connect->connect_error) {
    die("connection failed : " . $connect->connect_error);
} else {
    // echo "Successfully Connected";
}
/* Database connection end */
session_start();


if( !empty($_POST['ID']) && !empty($_POST['name']) ){

    $sql = "UPDATE tk_user_details SET ud_first_name = '".$_POST['name']."' WHERE ud_u_id = '".$_POST['ID']."' ";
    if ($connect->query($sql) === TRUE) {
      $_SESSION['auth']['first_name'] = $_POST['name'];
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $connect->error;
    }

$connect->close();
}
?>