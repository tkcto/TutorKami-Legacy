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

if( isset($_GET['locationNAme']) && $_GET['locationNAme'] != '' && isset($_GET['locationID']) && $_GET['locationID'] != '' ){
    
    $queryUser = " SELECT * FROM tk_user INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id WHERE u_role = '3' AND u_status = 'A' AND ud_state = '".$_GET['locationID']."' ";    
    
    $queryUser .= 'ORDER BY u_modified_date DESC ';
        
    
    $resultQueryUser = $conn->query($queryUser); 
    if($resultQueryUser->num_rows > 0){ 
        $output .= '
            <table class="table" bordered="1">  
                <tr>  
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Current City</th>
                    <th>Phone Number</th>
                    <th>Last Activity</th>
                </tr>
        ';
    while($rowQueryUser = $resultQueryUser->fetch_assoc()){
    
    

     if($rowQueryUser['ud_dob'] == NULL){
        $age = 0;
     }else{
        $age = CalculateAge($rowQueryUser['ud_dob']);
     }
    
     
     $sqlCity = "SELECT * FROM tk_cities WHERE city_id = '".$rowQueryUser['ud_city']."' ";
     $resultCity = $conn->query($sqlCity); 
     if($resultCity->num_rows > 0){ 
    	$rowCity = $resultCity->fetch_assoc();
    	$thisCity = $rowCity["city_name"];
     }else{
    	$thisCity = '';
     }
    
    if( $rowQueryUser['u_gender'] == 'M' || $rowQueryUser['u_gender'] == 'm' ){
        $gender = 'Lelaki';
    }else if( $rowQueryUser['u_gender'] == 'F' || $rowQueryUser['u_gender'] == 'f' ){
        $gender = 'Perempuan';
    }else{
        $gender = '';
    }





    
        if($rowQueryUser["u_create_date"] == NULL || $rowQueryUser["u_create_date"] =='0000-00-00 00:00:00' || $rowQueryUser["u_create_date"] ==''){
            $createDate = '';
        }else{
            $createDate = date("d/m/Y", strtotime($rowQueryUser['u_create_date']));
        }
            
        if($rowQueryUser["u_modified_date"] == NULL || $rowQueryUser["u_modified_date"] =='0000-00-00 00:00:00' || $rowQueryUser["u_modified_date"] ==''){
            $modifiedDate = '';
        }else{
            $modifiedDate = date("d/m/Y", strtotime($rowQueryUser['u_modified_date']));
        }
    
    
        $output .= '
            <tr>  
                <td>'.$rowQueryUser['u_email'].'</td>
                <td>'.(ucwords(strtolower($rowQueryUser['ud_first_name']))).'</td>
                <td>'.(ucwords(strtolower($rowQueryUser['ud_last_name']))).'</td>
                <td>'.$gender.'</td>
                <td>'.date('d/m/Y', strtotime($rowQueryUser['ud_dob'])).'</td>
                <td>'.ucwords($thisCity).'</td>
                <td>6'.$rowQueryUser['ud_phone_number'].'</td>
                <td>'.$modifiedDate.'</td>
            </tr>
        ';
    }
      
      
      $output .= '</table>';
      header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename="'.$_GET['locationNAme'].'".xls');
      echo $output;
    }
    
    
}else{
  echo 'Error !!';
}

















?>