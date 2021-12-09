<?PHP
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

if( (isset($_POST['j_id']) && $_POST['j_id'] != '') && (isset($_POST['sendWAValue2']) && $_POST['sendWAValue2'] != '') ) {
	$er = '';
	$myArray = explode(',', $_POST['sendWAValue2']); //echo $myArray;
	
				$queryGetID = " SELECT * FROM tk_user WHERE u_id IN (".implode(',',$myArray).") "; 
				$resultGetID = $conn->query($queryGetID); 
				if($resultGetID->num_rows > 0){ 
					while($rowGetID = $resultGetID->fetch_assoc()){ 
					    $sendTutorProfile = 'https://www.tutorkami.com/tutor_profile?did='.$rowGetID['u_displayid'];
					    $allLink[] = $sendTutorProfile;
					}     
				}
    			if( !empty($allLink) ) {
    				
    				$queryJob = " SELECT * FROM tk_job WHERE j_id ='".$_POST['j_id']."' "; 
    				$resultJob = $conn->query($queryJob); 
    				if($resultJob->num_rows > 0){ 
    					$rowJob = $resultJob->fetch_assoc();
    					//$parentPhoneNo = $rowJob['j_telephone'];
    					//$parentPhoneNo = '012-2370000';
    					if( strpos($rowJob['j_telephone'], '-') !== false ) {
    					    //echo "Found";
    					    $parentPhoneNo =  str_replace("-","",$rowJob['j_telephone']);
    					}else{
    					    $parentPhoneNo = $rowJob['j_telephone'];
    					}
    				}else{
    				    $parentPhoneNo = '';
    				}
    				
    				
    				$headerTitle = rawurlencode('This is an automatic message sent from TutorKami.com as you have given us permission to auto send you tutor’s profiles. Please do not reply to this what’s app message. If you don’t want to receive this message anymore, please inform our Coordinator. Thank you.');
    		
                    $linkValue = " https://wa.me/6".$parentPhoneNo."?text=".$headerTitle.'%0A%0A'; foreach($allLink as $linkProfileTutor){ $linkValue .= $linkProfileTutor.'%0A%0A'; }
                    echo $linkValue;
                    //echo $parentPhoneNo;
    			}
	
	
	

}else{
    echo 'Error !';
}
?>





