<?php
session_start();
session_regenerate_id(true);
// change the information according to your database


$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$db_connection = mysqli_connect($servername, $username, $password, $dbname);
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}



