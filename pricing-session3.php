<?php
//Include the database configuration file
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

//if( ($_POST["postState"]) && ($_POST["postStateSess"]) && ($_POST["postStateLoc"]) ){

        $GetRate = "SELECT * FROM tk_online_rates WHERE or_level_id = '".$_POST['postState']."'  ";
        $resultGetRate = $conn->query($GetRate);
        if ($resultGetRate->num_rows > 0) {
            $rowGetRate = $resultGetRate->fetch_assoc();
            $rateGetRate = $rowGetRate['or_rate'];
        }else{
            $rateGetRate = '';
        }  

        $return_arr = array("rate1" => $rateGetRate);  
        echo json_encode($return_arr);  

//}
?>