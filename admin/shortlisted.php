<?php
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_POST['data'])){
	$data = $_POST['data'];
	
    $queryTutor = " SELECT u_id, u_displayid, u_displayname, u_email, u_role, signature_img, signature_img2, u_status FROM tk_user WHERE u_role = '3' AND u_displayid = '".$data['DisID']."' "; 
    $resultTutor = $conn->query($queryTutor); 
    if($resultTutor->num_rows > 0){
        $rowTutor = $resultTutor->fetch_assoc();
        
        /*if( $rowTutor['signature_img'] == '' && $rowTutor['signature_img2'] == '' ){
            $status = 'T';
        }else{
            $status = 'P';
        }*/
        $status = '';
        
        $queryShortlisted = " SELECT user_job_id, user_display_id FROM tk_shortlisted WHERE user_job_id = '".$data['JobID']."' AND user_display_id = '".$data['DisID']."' "; 
        $resultShortlisted = $conn->query($queryShortlisted); 
        if($rowTutor['u_status'] == 'C'){            echo 'DontHire';        }		else if($resultShortlisted->num_rows > 0){
            echo 'DahAda';
        }else if(($resultShortlisted->num_rows == 0) && ($rowTutor['u_status'] != 'C')){
            $sqlInsert = "INSERT INTO tk_shortlisted SET user_job_id = '".$data['JobID']."', user_id = '".$rowTutor['u_id']."', user_display_id = '".$rowTutor['u_displayid']."', user_display_name = '".htmlspecialchars(trim($rowTutor['u_displayname']), ENT_QUOTES)."', user_email = '".$rowTutor['u_email']."', s_status = '".$status."' ";
            if ($conn->query($sqlInsert) === TRUE) {
                echo "Success";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }else{
        echo 'NoTutor';
    }
}

if(isset($_POST['dataDelete'])){
	$dataDelete = $_POST['dataDelete'];
    $sql = "DELETE FROM tk_shortlisted WHERE id = '".$dataDelete['DisID']."' ";
    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>