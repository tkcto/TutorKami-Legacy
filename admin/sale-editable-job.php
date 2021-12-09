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
        echo "No";
    }else{
        $sqlJob = " SELECT j_id, u_id, j_rate, parent_rate, cycle, j_hired_tutor_email, rf  FROM tk_job WHERE j_id = '".$_POST["JobID"]."' "; 
        $resultJob = $conn->query($sqlJob); 
        if($resultJob->num_rows > 0){
            $rowJob = $resultJob->fetch_assoc();
    
            $sqlTutor = " SELECT u_id, ud_u_id, u_email, resit_pv_name FROM tk_user 
            INNER JOIN tk_user_details ON ud_u_id = u_id
            WHERE u_email = '".$rowJob['j_hired_tutor_email']."' "; 
            $resultTutor = $conn->query($sqlTutor); 
            if($resultTutor->num_rows > 0){
                $rowTutor = $resultTutor->fetch_assoc();
                $tutorDispalyName = $rowTutor['resit_pv_name'];
            }else{
                $tutorDispalyName = '';
            }
            
            /*if(!empty($_POST["amountReceived"])) {
                $rate = ( (float) filter_var( $rowJob['j_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
                //$_SESSION['PaidtoTutor'] = number_format(($rate * $rowJob['cycle']), 2);  
                //$_SESSION['GrossProfit'] = number_format(($_POST["amountReceived"] - (number_format(($rate * $rowJob['cycle']), 2))), 2);
            }*/
            
            $Admin = " SELECT u_id, ud_u_id, ud_first_name FROM tk_user 
            INNER JOIN tk_user_details ON ud_u_id = u_id
            WHERE u_id = '".$_SESSION['tk']['u_id']."' "; 
            $resultAdmin = $conn->query($Admin); 
            if($resultAdmin->num_rows > 0){
                $rowAdmin = $resultAdmin->fetch_assoc();
                $thisAdmin = $rowAdmin['ud_first_name'];
            }else{
                $thisAdmin = 'Error';
            }
            
            $Cycle = " SELECT * FROM tk_payment_history WHERE ph_user_id='".$rowJob['u_id']."' AND ph_job_id ='".trim($_POST["JobID"])."' ORDER BY ph_date DESC, ph_id DESC  ";
            $resCycle = $conn->query($Cycle); 
            if($resCycle->num_rows > 0){
                $rowCycle = $resCycle->fetch_assoc();
                if( $rowCycle['ph_receipt'] == 'trial' ){
                    $NoCycle = 'T.S';
                    $hours = $rowCycle['hour'];
                    $rf = '';
                }else if (strpos($rowCycle['ph_receipt'], 'beginning') !== false) {
                    $NoCycle = filter_var($rowCycle['ph_receipt'], FILTER_SANITIZE_NUMBER_INT);
                    $hours = $rowJob['cycle'];
                    $rf = $rowJob['rf'];
                }else{
                    $NoCycle = (((int)$rowCycle['ph_receipt']) + 1);
                    $hours = $rowJob['cycle'];
                    $rf = $rowJob['rf'];
                }
            }else{
                $NoCycle = '1';
                $hours = $rowJob['cycle'];
                $rf = $rowJob['rf'];
            }
            
            
            $rate = ( (float) filter_var( $rowJob['j_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
            
            if( $NoCycle == 'T.S' ){
                echo $rate.','.$rowJob['parent_rate'].','.$hours.','.$rowJob['j_hired_tutor_email'].','.$tutorDispalyName.','.$thisAdmin.','.$rf.','.$NoCycle;
            }else{
                echo $rate.','.$rowJob['parent_rate'].','.$hours.','.$rowJob['j_hired_tutor_email'].','.$tutorDispalyName.','.$thisAdmin.','.$rf.','.$NoCycle;
            }
    
            
    
        }else{
            echo "No"; 
        }    
    }

}else{
   echo "Error 3"; 
}
?>


