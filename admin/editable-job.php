<?php
require_once('classes/config.php.inc');

// Create connection <!-- DONE BACKUP -->
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
session_start();
if(!empty($_POST["JobID"])) {
    
    if (!ctype_digit($_POST["JobID"])) {
        echo trim("No"); 
    }else{
        $sqlJob = " SELECT j_id, j_rate, parent_rate, cycle, j_hired_tutor_email, rf  FROM tk_job WHERE j_id = '".$_POST["JobID"]."' "; 
        $resultJob = $conn->query($sqlJob); 
        if($resultJob->num_rows > 0){
            $rowJob = $resultJob->fetch_assoc();
    
            $sqlTutor = " SELECT * FROM tk_user 
            INNER JOIN tk_user_details ON ud_u_id = u_id
            WHERE u_email = '".$rowJob['j_hired_tutor_email']."' "; 
            $resultTutor = $conn->query($sqlTutor); 
            if($resultTutor->num_rows > 0){
                $rowTutor = $resultTutor->fetch_assoc();
                $tutorDispalyName = $rowTutor['u_displayname'];
            }else{
                $tutorDispalyName = '';
            }
            
            if(!empty($_POST["amountReceived"])) {
                $rate = ( (float) filter_var( $rowJob['j_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
                //$_SESSION['PaidtoTutor'] = number_format(($rate * $rowJob['cycle']), 2);  
                //$_SESSION['GrossProfit'] = number_format(($_POST["amountReceived"] - (number_format(($rate * $rowJob['cycle']), 2))), 2);
            }
    
    
            echo $rowJob['j_rate'].','.$rowJob['parent_rate'].','.$rowJob['cycle'].','.$rowJob['j_hired_tutor_email'].','.$tutorDispalyName.','.$_SESSION['tk']['u_first_name'].','.$rowJob['rf'];
    
        }else{
            echo trim("No"); 
        }    
    }

}else{
   echo trim("Error 3"); 
}
?>


