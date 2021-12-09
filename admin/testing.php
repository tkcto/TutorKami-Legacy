<?php
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");


        $record = array();
        $sql = " SELECT * FROM tk_sales_sub"; 
        $result = $conn->query($sql); 
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $record[] = array( "id" => $row['id'], "main_id" => $row['main_id'], "tab_name" => $row['tab_name'], "month" => $row['month'] );
            }
            echo json_encode($record);
        }


?>
