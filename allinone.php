<?php
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");


if (isset($_POST['action'])) {


	if ($_POST['action'] == '1rekod') {
        $update = "UPDATE tk_job SET student_name = '".$_POST["name"]."' WHERE j_id = '".$_POST["job"]."' ";
	    if ($conn->query($update) === TRUE) {
	        echo "Success";
	    } else {
	        echo "Error";
	    }
	}


	if ($_POST['action'] == '2rekod') {
	    
        $query = " SELECT j_id, j_hired_tutor_email FROM tk_job WHERE j_id = '".$_POST['job']."' ";
        $result = $conn->query($query); 
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();

                $update = "UPDATE tk_user SET bank_name = '".$_POST["bank"]."', acc_no = '".$_POST["acc"]."' WHERE u_email = '".$row['j_hired_tutor_email']."' ";
        	    if ($conn->query($update) === TRUE) {
        	        //echo "Success";
                    $myArr = array($_POST["bank"], $_POST["acc"]);
                    $myJSON = json_encode($myArr);
                    echo $myJSON;
        	    } else {
        	        echo "Error";
        	    }
            
        }else{
            echo "Error";
        }
        
	}


	if ($_POST['action'] == 'getBank') {
	    
        $query = " SELECT j_id, j_hired_tutor_email FROM tk_job WHERE j_id = '".$_POST['job']."' ";
        $result = $conn->query($query); 
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();

            $query2 = " SELECT u_email, bank_name, acc_no FROM tk_user WHERE u_email = '".$row['j_hired_tutor_email']."' ";
            $result2 = $conn->query($query2); 
            if($result2->num_rows > 0){
                $row2 = $result2->fetch_assoc();
                $myArr = array($row2["bank_name"], $row2["acc_no"]);
                $myJSON = json_encode($myArr);
                echo $myJSON;
            }else{
                echo 'Error';
            }
            
        }else{
            echo "Error";
        }

	}


	if ($_POST['action'] == 'showWa') {
	    
        $query = " SELECT j_id, j_hired_tutor_email FROM tk_job WHERE j_id = '".$_POST['job']."' ";
        $result = $conn->query($query); 
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            
            $Details = " SELECT * FROM tk_user
            INNER JOIN tk_user_details on ud_u_id = u_id
            WHERE u_email = '".$row['j_hired_tutor_email']."' ";
            $resultDetails = $conn->query($Details); 
            if($resultDetails->num_rows > 0){
                $rowDetails = $resultDetails->fetch_assoc();
                //$rowDetails['ud_phone_number'];
                

                    $welcomeWaTutor = '';
                    $queryLogWaTutor = " SELECT wa_user FROM tk_whatsapp_noti WHERE wa_user = '".$rowDetails['ud_phone_number']."' ";
                    $resultLogWaTutor = $conn->query($queryLogWaTutor);
                    if ($resultLogWaTutor->num_rows > 0) {
                        echo 'TRUE';
                    }else{
                                                                        
                        require_once('admin/classes/whatsapp-api-call.php');
                                                                
                        $website = "https://wa.tutorkami.my/api-docs/";
                        if( !activeAPI( $website ) ) {
                            echo ''; 
                        } else {
                            $queryLogWa2Tutor = " SELECT wa_user FROM tk_whatsapp_noti WHERE wa_user = '".$rowDetails['ud_phone_number']."' ";
                            $resultLogWa2Tutor = $conn->query($queryLogWa2Tutor);
                            if ($resultLogWa2Tutor->num_rows > 0) {
                                echo 'TRUE';
                            }else{
                                $args = new stdClass();
                                $xdata = new stdClass();
                                $args->contactId = "6".$rowDetails['ud_phone_number']."@c.us";
                                $xdata->args = $args;
                                                                        	
                                $make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
                                $response = json_decode($make_call, true);
                                $dataPhone     = $response['response']['id'];
                                                                        	        
                                if( $dataPhone != '' ){
                                    $logTutor = 'true';
                                    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$rowDetails['ud_phone_number']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                                    $exeWaNoti = $conn->query($sqlWaNoti);
                                    echo 'TRUE';
                                }else{
                                    echo ''; 
                                }        
                            }
                        }
                    }
                
                
                
            }else{
                echo 'Error';
            }
        }else{
            echo 'Error';
        }

	}
    

    


	
	
	
	
	
	
	
	
	
}
$conn->close();
?>