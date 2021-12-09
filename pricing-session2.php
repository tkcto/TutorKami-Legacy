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

        if( $_POST['postState'] != '' ){
            if( $_POST['postState'] == 'Online Tuition' ){
                if( $_POST["postStateSess"] != '' ){
                    $GetRate = "SELECT * FROM tk_location_rate2 WHERE id = ".$_POST["postStateSess"]."  "; 
                    $resultGetRate = $conn->query($GetRate);
                    if ($resultGetRate->num_rows > 0) {
                        $rowGetRate = $resultGetRate->fetch_assoc();
                        $rateGetRate = $rowGetRate['rate'];
                    }else{
                        $rateGetRate = '';
                    }
                }else{
                    $rateGetRate = 'clickButton';
                }
            }else{
                $GetRate = "SELECT * FROM tk_location_rate2 WHERE id = ".$_POST["postStateLoc"]."  "; 
                $resultGetRate = $conn->query($GetRate);
                if ($resultGetRate->num_rows > 0) {
                    $rowGetRate = $resultGetRate->fetch_assoc();
                    $rateGetRate = $rowGetRate['rate'];
                }else{
                    $rateGetRate = '';
                }
            }
        }

    $return_arr = array("rate1" => $rateGetRate);  
    echo json_encode($return_arr);


//}
?>