<?php
/*
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$connect = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($connect->connect_error) {
    die("connection failed : " . $connect->connect_error);
} else {
    // echo "Successfully Connected";
}
*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


date_default_timezone_set("Asia/Kuala_Lumpur");



if(empty($_POST["id"])){
    echo'Empty JobID';
    exit();
}else{
    $id     = $conn->real_escape_string($_POST["id"]);
    
    
/**/
echo $id;

/*
    $chk = " SELECT * FROM tk_applied_job WHERE aj_u_id='".$id."' AND (aj_rate IS NOT NULL AND aj_rate!='') ORDER BY aj_level ASC ";
    $resultChk = $conn->query($chk);
    if ($resultChk->num_rows > 0) {
        
         $chkUser = " SELECT * FROM tk_user_details WHERE ud_u_id='".$id."' ";
         $resultChkUser = $conn->query($chkUser);
         if ($resultChkUser->num_rows > 0) {
             $rowUser = mysqli_fetch_array($resultChkUser);
             $rate = $rowUser['ud_rate_per_hour'];
         }

         $JobID = $JobID2 = $JobID3 = $JobID4 = $JobID5 = $JobID6 = $JobID7 = $JobID8 = $JobID9 = "";
         $loopRecord = $loopRecord2 = $loopRecord3 = $loopRecord4 = $loopRecord5 = $loopRecord6 = $loopRecord7 = $loopRecord8 = $loopRecord9 = "";
         while($rowJob = mysqli_fetch_array($resultChk)){
                //$JobID .= $rowJob['aj_u_id']." ";
                if($rowJob['aj_level'] == '1'){
                    $title = 'Pre-School';
                    $loopRecord .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID = $title.' = '.$loopRecord."\n";
                }
                if($rowJob['aj_level'] == '2'){
                    $title2 = 'Tahap 1 (Tahun 1-3)';
                    $loopRecord2 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID2 = $title2.' = '.$loopRecord2."\n";
                }
                if($rowJob['aj_level'] == '3'){
                    $title3 = 'Tahap 2 (UPSR)';
                    $loopRecord3 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID3 = $title3.' = '.$loopRecord3."\n";
                }
                if($rowJob['aj_level'] == '4'){
                    $title4 = 'Form 1-3 (PT3)';
                    $loopRecord4 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID4 = $title4.' = '.$loopRecord4."\n";
                }
                if($rowJob['aj_level'] == '5'){
                    $title5 = 'Form 4-5 (SPM)';
                    $loopRecord5 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID5 = $title5.' = '.$loopRecord5."\n";
                }
                if($rowJob['aj_level'] == '6'){
                    $title6 = 'Primary (International Syllabus)';
                    $loopRecord6 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID6 = $title6.' = '.$loopRecord6."\n";
                }
                if($rowJob['aj_level'] == '7'){
                    $title7 = 'Lower Secondary (International Syllabus)';
                    $loopRecord7 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID7 = $title7.' = '.$loopRecord7."\n";
                }
                if($rowJob['aj_level'] == '8'){
                    $title8 = 'Year 10-11 (IGCSE)';
                    $loopRecord8 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID8 = $title8.' = '.$loopRecord8."\n";
                }
                if($rowJob['aj_level'] == '9'){
                    $title9 = 'Others / Lain-lain';
                    $loopRecord9 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
                    $JobID9 = $title9.' = '.$loopRecord9."\n";
                }
         }
         $thisJobID = $rate."\n\n***SYSTEM***\n".$JobID.$JobID2.$JobID3.$JobID4.$JobID5.$JobID6.$JobID7.$JobID8.$JobID9;
         //echo $thisJobID;
    }else{
            $thisJobID = "";
            //echo "";
    }     
echo $thisJobID;

*/
}
?>