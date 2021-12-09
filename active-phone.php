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


if( !empty($_POST['val']) ){

    $sql = "UPDATE tk_whatsapp_noti SET wa_note = 'Yes' WHERE wa_user = '0".$_POST['val']."' AND wa_remark = 'Welcome' AND wa_status = 'POST' ";
    if ($connect->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $connect->error;
    }

$connect->close();
}
?>