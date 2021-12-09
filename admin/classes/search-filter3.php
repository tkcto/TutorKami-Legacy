<?php
/* Database connection start */
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
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


$resultSearch = array();

if(isset($_POST['dataSearch'])){
    $dataSearch = $_POST['dataSearch'];
    
    
    $image      = $dataSearch['user_w_image'];
    $email      = $dataSearch['u_email'];
    $first      = $dataSearch['ud_first_name'];
    $last       = $dataSearch['ud_last_name'];
    $display    = $dataSearch['u_displayname'];
    $phone      = $dataSearch['ud_phone_number'];
    $gender     = $dataSearch['u_gender'];
    $race       = $dataSearch['ud_race'];
    $status     = $dataSearch['ud_tutor_status'];
    $occupation = $dataSearch['ud_current_occupation'];
    $tuition    = $dataSearch['tution_center'];
    $approve    = $dataSearch['u_admin_approve'];
    $validated  = $dataSearch['validated'];
    

    if($dataSearch['validated'] == 'paid'){
        //echo 'paid';
/*
        $queryPaid = " 
            SELECT * FROM tk_user
            inner JOIN tk_user_details   ON  tk_user_details.ud_u_id = tk_user.u_id
        ";
        $resultPaid = $conn->query($queryPaid);
        if ($resultPaid->num_rows > 0) {
            while($rowPaid = $resultPaid->fetch_assoc()){
           
				$u_id = $rowPaid['u_id'];
				$ori_u_create_date = $rowPaid['u_create_date'];
				$ori_u_modified_date = $rowPaid['u_modified_date'];

				$u_displayid = $rowPaid['u_displayid'];
				$u_email = $rowPaid['u_email'];
				$ud_first_name = $rowPaid['ud_first_name'];
				$u_displayname = $rowPaid['u_displayname'];

				if( $rowPaid['u_status'] == 'P' && ($rowPaid['u_admin_approve'] == NULL || $rowPaid['u_admin_approve'] == '0' || $rowPaid['u_admin_approve'] == '') ){
					$u_status = "<p style='color:DarkRed'>P</p>";
				}
				else if($rowPaid['u_status'] == 'P' && $rowPaid['u_admin_approve'] == '1'){
					$u_status = "<p style='color:DarkBlue'>W</p>";
				}
				else if($rowPaid['u_status'] == 'P' && $rowPaid['u_admin_approve'] == '10'){
					$u_status = "<p style='color:LightSkyBlue'>E</p>";
				}
				else if( $rowPaid['u_status'] == 'A' && ($rowPaid['u_admin_approve'] == NULL || $rowPaid['u_admin_approve'] == '2') ){
					$u_status = "<p style='color:DarkGreen'>A</p>";
				}
				else if( $rowPaid['u_status'] == 'B' ){
					$u_status = "<p style='color:OrangeRed'>B</p>";
				}
				else{
					$u_status = "ERROR";
				}

		
				if($rowPaid['ud_dob'] == NULL){
					$ud_dob = 0;
				}else{
					$ud_dob = CalculateAge($rowPaid['ud_dob']);
				}


				if (is_numeric($rowPaid['ud_city'])) {
					$citysqltest = "SELECT * FROM tk_cities WHERE city_id = '".$rowPaid['ud_city']."' ";
					$cityqrytest = $conn->query($citysqltest);
					if ($cityqrytest->num_rows > 0) {
						$rowPaidtest = $cityqrytest->fetch_assoc();
						$ud_city = $rowPaidtest['city_name'];
					}else{
						$ud_city ='';
					}
				}else{
					$ud_city = $rowPaid['ud_city'];
				}

				$ud_phone_number = $rowPaid['ud_phone_number'];

				if($rowPaid["u_create_date"] == NULL || $rowPaid["u_create_date"] =='0000-00-00 00:00:00' || $rowPaid["u_create_date"] ==''){
					$u_create_date = '';
				}else{
					$u_create_date = date("d/m/Y", strtotime($rowPaid['u_create_date']));
				}
				if($rowPaid["u_modified_date"] == NULL || $rowPaid["u_modified_date"] =='0000-00-00 00:00:00' || $rowPaid["u_modified_date"] ==''){
					$u_modified_date = '';
				}else{
					$u_modified_date = date("d/m/Y", strtotime($rowPaid['u_modified_date']));
				}
        
				$ud_rate_per_hour = $rowPaid['ud_rate_per_hour'];

				$resultSearch[] = array(
				    "u_id" => $u_id,
					"ori_u_create_date" => $ori_u_create_date,
					"ori_u_modified_date" => $ori_u_modified_date
				);  
         

            }
            echo json_encode($resultSearch);
        }
        echo json_encode(["message"=>'Tiada Maklumat!']);
   */             echo json_encode(["message"=>'Tiada Maklumat1111!']);
        
    }else if($dataSearch['validated'] == 'unpaid'){
        //echo 'unpaid';
    }else{
        //echo 'none';
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>