<?php
/* Database connection start */
require_once('includes/head.php'); 
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/* Database connection end */
session_start();


if( !empty($_POST['c_id']) && !empty($_POST['checkedValue']) ){

    $sql = "UPDATE tk_classes SET last = '".$_POST['checkedValue']."' WHERE cl_id = '".$_POST['c_id']."' ";
    if ($conn->query($sql) === TRUE) {
      unset($_SESSION["balance"]);
      echo "success";
    } else {
      echo "Error updating record: " . $conn->error;
    }

$conn->close();
}
?>