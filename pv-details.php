<?php 
require_once('admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
session_start();


if( !empty($_POST["name"]) && !empty($_POST["ic"]) ){
    $_SESSION['tk_pv_name'] = $_POST["name"];
    $_SESSION['tk_pv_ic']   = $_POST["ic"];

    echo 'Success';
}else{
    unset($_SESSION['tk_pv_name']);
    unset($_SESSION['tk_pv_ic']);
    
    echo 'Error !';
}
?>


