<?php 
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
$output = '';

$json_url = 'https://script.googleusercontent.com/macros/echo?user_content_key=fiqbaHQMixuCyqE3Pv9FwfKLabqqEWl4hP_tJzOnRkTVCHKz6DMPRmpnDCRJs3hJmMA8q9YAXGRH-xTGB12mfAV2M-qYZcPvm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnJessrl2zHSd4DCjiPwH2_6vsMPgtvLKE9d8ZZiK872oFX2CCExIvZ3aXNUfFZw08kV27Ul7Y8DW&lib=MPC-jJ80wqwQF4P8szRre4MPbxISsshVn';
$json = file_get_contents($json_url);
$data = json_decode($json, true);
$entries = $data['user'];

    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>Date</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>School</th>
                <th>Parent Name</th>
                <th>Relation</th>
                
                <th>Phone Ori</th>
                <th>Phone WitouthDash</th>
                <th>Phone WithDash</th>
                
                
                <th>Desc</th>
                <th>Occupation</th>
                <th>Marketing</th>
                <th>Suggestion</th>
                <th>DOB</th>
            </tr>
    ';
foreach ($entries as $entry) {

$phoneOri = $entry['phone'];

$first2digit = substr($phoneOri, 0, 2);
if( $first2digit == '+6' ){
    $first2digit = substr($phoneOri, 2);
}else{
    $first2digit = $phoneOri;
}


$phone = preg_replace('/[^0-9]/', '', $first2digit);
$result = substr($phone, 0, 10);
$countDigit = strlen($result);
if( $countDigit == '9' ){
    $result = '0'.substr($phone, 0, 10);
}else{
    $result = substr($phone, 0, 10);
}

$phoneWitouthDash = $result;
$phoneWithDash = substr_replace($result,'-',3,0); 






    $output .= '
        <tr>  
            <td>'.(date("d/m/Y H:i A",strtotime($entry['date']))).'</td>
            <td>'.$entry['Student_name'].'</td>
            <td>'.$entry['gender'].'</td>
            <td>'.$entry['address'].'</td>
            <td>'.$entry['school'].'</td>
            <td>'.$entry['parent_name'].'</td>
            <td>'.$entry['relation'].'</td>
            <td>'.$phoneOri.'</td>
            <td>'.$phoneWitouthDash.'</td>
            <td>'.$phoneWithDash.'</td>
    ';
    

    
    
    //$output .= ' <td>'.$phoneWithDash.' ==== '.$jobID.'</td> ';   
    $output .= ' <td> ';  

$queryUserD = " SELECT * FROM tk_user_details WHERE ud_phone_number LIKE '%$phoneWitouthDash%' OR ud_phone_number LIKE '%$phoneWithDash%' ";
$resultUserD = $conn->query($queryUserD); 
if($resultUserD->num_rows > 0){ 
    $rowUserD = $resultUserD->fetch_assoc();
    $idUserD = $rowUserD['ud_u_id'];
    
        $queryUser = " SELECT * FROM tk_user WHERE u_id='$idUserD' ";
        $resultUser = $conn->query($queryUser); 
        if($resultUser->num_rows > 0){ 
            $rowUser = $resultUser->fetch_assoc();
            $idUser = $rowUser['u_email'];
            

                $queryJob = " SELECT * FROM tk_job WHERE j_email='$idUser' ";
                $resultJob = $conn->query($queryJob); 
                if($resultJob->num_rows > 0){
                    while($rowJob = $resultJob->fetch_assoc()){
                        $jobID = $rowJob['j_id']; 
                        $jobLVL = $rowJob['j_jl_id']; 
                        
                            $queryJob2 = " SELECT * FROM tk_job_level_translation WHERE jlt_jl_id='$jobLVL' ";
                            $resultJob2 = $conn->query($queryJob2); 
                            if($resultJob2->num_rows > 0){
                                $rowJob2 = $resultJob2->fetch_assoc();
                                $jobTitle = $rowJob2['jlt_title'];         
                            }
                        
                        //$output .=  $jobID."\r\n";   
                        
                            $queryJob3 = " SELECT * FROM tk_job_translation WHERE jt_j_id='$jobID' ";
                            $resultJob3 = $conn->query($queryJob3); 
                            if($resultJob3->num_rows > 0){
                                $rowJob3 = $resultJob3->fetch_assoc();
                                $jobJT = $rowJob3['jt_subject'];        
                                //$output .=  "<font color='red'>".$jobID."</font>".': '.$jobJT."\r\n";   
                               $output .=  ' [[ '.$jobID.' = '.$jobTitle.' = '.$jobJT.' ]] '." \r\n\r\n";  
                                
                                
                            }
         
                    }
                  
                }
            
            
            
            
        }
    
}


    
    $output .= ' </td> ';  



       
    $output .= '
            <td>'.$entry['occupation'].'</td>
            <td>'.$entry['know'].'</td>
            <td>'.$entry['suggestion'].'</td>
    ';
    
    $output .= ' <td> ';  
        if($entry['dob'] != ''){
            $output .= date("d-m-Y", strtotime($entry['dob']));  
        }
    $output .= ' </td> ';  
    
    
    $output .= '
        </tr>
    ';
}
  
  // <td>'.(date("d-m-Y h:i", strtotime($entry['dob']))).'</td>
  $output .= '</table>';
  
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=HOME-TUITION-REGISTRATION.xls');
  echo $output;


?>