<?php
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

$datetime = date('Y-m-d H:i:s');
$timestamp = strtotime($datetime);

$Job = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_status = 'open' ";
$resultJob = $conn->query($Job);
if ($resultJob->num_rows > 0) {
	while($rowJob = $resultJob->fetch_assoc()){
	    
        $note = date('d/m/y')." - System auto closed job because it has been opened for more than 30 days\n".$rowJob['jt_comments'];
	    
	    if( strtotime(date('Y-m-d',strtotime($rowJob['j_create_date'])) . "+30 days") <= $timestamp ){
            $sql = " UPDATE tk_job SET j_status ='closed' WHERE j_id = '".$rowJob['j_id']."' ";
            if ( ($conn->query($sql) === TRUE) ) {
                $sql2 = " UPDATE tk_job_translation SET jt_comments = '".$note."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                $conn->query($sql2);
            }
	    }
	    
	}
}
$conn -> close();
?>