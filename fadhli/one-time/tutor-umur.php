<?php  
require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

function CalculateAge($dob) {
    $dateOfBirth = date("Y-m-d", strtotime($dob));
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');

    return $age;
}


$output = '';

if( isset($_GET['AgeStart']) && $_GET['AgeStart'] != '' && isset($_GET['AgeEnd']) && $_GET['AgeEnd'] != '' && isset($_GET['selectpaid']) && $_GET['selectpaid'] != '' ){
    
    $AgeStart = (int)$_GET['AgeStart'];
    $AgeEnd = (int)$_GET['AgeEnd'];

    
    
    //$queryUser = " SELECT * FROM tk_user INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id WHERE u_role = '3' AND u_status = 'A' AND ud_state = '".$_GET['locationID']."' ";    
    $queryUser = " 
            SELECT * FROM tk_job 
            INNER JOIN tk_user ON u_email = j_hired_tutor_email
            WHERE j_payment_status = '".$_GET['selectpaid']."'
            GROUP BY j_hired_tutor_email

    ";    
    $queryUser .= 'ORDER BY u_modified_date DESC ';

    $resultQueryUser = $conn->query($queryUser); 
    if($resultQueryUser->num_rows > 0){
        $output .= '
            <table class="table" bordered="1">  
                <tr>  
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Phone</th>
                    <th>Emel</th>
                    <th>ID Number</th>
                    <th>Last Activity</th>
                </tr>
        ';
        
        if( $_GET['selectpaid'] == 'paid' ){

            while($rowQueryUser = $resultQueryUser->fetch_assoc()){
                $testDetails = " SELECT ud_u_id, ud_dob, ud_first_name, ud_last_name, ud_phone_number FROM tk_user_details WHERE ud_u_id = '".$rowQueryUser['u_id']."' ";
                $resultTestDetails = $conn->query($testDetails);
                if ($resultTestDetails->num_rows > 0) {
                    $rowTest2 = $resultTestDetails->fetch_assoc();
                    
                    if( CalculateAge($rowTest2['ud_dob']) >= $AgeStart && CalculateAge($rowTest2['ud_dob']) <= $AgeEnd ){
       
                         if($rowTest2['ud_dob'] == NULL){
                            $age = 0;
                         }else{
                            $age = CalculateAge($rowTest2['ud_dob']);
                         }
                         
                        if( $rowQueryUser['u_gender'] == 'M' || $rowQueryUser['u_gender'] == 'm' ){
                            $gender = 'Male';
                        }else if( $rowQueryUser['u_gender'] == 'F' || $rowQueryUser['u_gender'] == 'f' ){
                            $gender = 'Female';
                        }else{
                            $gender = '';
                        }
                                    
                        if($rowQueryUser["u_modified_date"] == NULL || $rowQueryUser["u_modified_date"] =='0000-00-00 00:00:00' || $rowQueryUser["u_modified_date"] ==''){
                            $modifiedDate = '';
                        }else{
                            $modifiedDate = date("d/m/Y", strtotime($rowQueryUser['u_modified_date']));
                        }
                        
                        $output .= '
                            <tr>  
                                <td>'.ucwords(strtolower($rowTest2['ud_first_name'].' '.$rowTest2['ud_last_name'])).'</td>
                                <td>'.$age.'</td>
                                <td>'.$gender.'</td>
                                <td>'.date('d/m/Y', strtotime($rowTest2['ud_dob'])).'</td>
                                <td>6'.$rowTest2['ud_phone_number'].'</td>
                                <td>'.$rowQueryUser['u_email'].'</td>
                                <td>'.$rowQueryUser['u_displayid'].'</td>
                                <td>'.$modifiedDate.'</td>
                            </tr>
                        ';                      
                    }
                }
            }
            
        }else{
            while($rowQueryUser = $resultQueryUser->fetch_assoc()){
                $CekJob = " SELECT j_hired_tutor_email, j_payment_status FROM tk_job WHERE j_hired_tutor_email = '".$rowQueryUser['j_hired_tutor_email']."' AND j_payment_status = 'paid' ";
                $resultCekJob = $conn->query($CekJob);
                if ($resultCekJob->num_rows > 0) {
                }else{

                        $testDetails = " SELECT ud_u_id, ud_dob, ud_first_name, ud_last_name, ud_phone_number FROM tk_user_details WHERE ud_u_id = '".$rowQueryUser['u_id']."' ";
                        $resultTestDetails = $conn->query($testDetails);
                        if ($resultTestDetails->num_rows > 0) {
                            $rowTest2 = $resultTestDetails->fetch_assoc();
                            
                            if( CalculateAge($rowTest2['ud_dob']) >= $AgeStart && CalculateAge($rowTest2['ud_dob']) <= $AgeEnd ){
               
                                 if($rowTest2['ud_dob'] == NULL){
                                    $age = 0;
                                 }else{
                                    $age = CalculateAge($rowTest2['ud_dob']);
                                 }
                                 
                                if( $rowQueryUser['u_gender'] == 'M' || $rowQueryUser['u_gender'] == 'm' ){
                                    $gender = 'Male';
                                }else if( $rowQueryUser['u_gender'] == 'F' || $rowQueryUser['u_gender'] == 'f' ){
                                    $gender = 'Female';
                                }else{
                                    $gender = '';
                                }
                                            
                                if($rowQueryUser["u_modified_date"] == NULL || $rowQueryUser["u_modified_date"] =='0000-00-00 00:00:00' || $rowQueryUser["u_modified_date"] ==''){
                                    $modifiedDate = '';
                                }else{
                                    $modifiedDate = date("d/m/Y", strtotime($rowQueryUser['u_modified_date']));
                                }
                                
                                $output .= '
                                    <tr>  
                                        <td>'.ucwords(strtolower($rowTest2['ud_first_name'].' '.$rowTest2['ud_last_name'])).'</td>
                                        <td>'.$age.'</td>
                                        <td>'.$gender.'</td>
                                        <td>'.date('d/m/Y', strtotime($rowTest2['ud_dob'])).'</td>
                                        <td>6'.$rowTest2['ud_phone_number'].'</td>
                                        <td>'.$rowQueryUser['u_email'].'</td>
                                        <td>'.$rowQueryUser['u_displayid'].'</td>
                                        <td>'.$modifiedDate.'</td>
                                    </tr>
                                ';                      
                            }
                        }
                    
                }
                
            }
        }
        
        
        

        
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename="List-of-Tutors.xls"');
        echo $output;
    }
}else{
  echo 'Error !!';
}

?>