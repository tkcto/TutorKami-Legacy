<?php
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
// php -q /home/hambalnoorsham/public_html/admin/run-cronjob.php	




$sql = "INSERT INTO dbtest (col1, col2, col3, col4, col5, col6, col7, col8, col9, col10, col11) VALUES ('John', 'John', 'John', 'John', 'John', 'John', 'John', 'John', 'John', '".date("d/m/Y")."', '".date("h:i:s")."')";
$conn->query($sql);

?>
