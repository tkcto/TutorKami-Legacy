<?php
/* Database connection start */
require_once('includes/head.php'); 
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/* Database connection end */
session_start();


if( !empty($_POST['c_id']) ){
    //echo $_POST['c_id'];
    

    $query = " SELECT * FROM tk_classes_record INNER JOIN tk_classes ON cl_id = cr_cl_id
    WHERE cl_id = '".$_POST['c_id']."' AND current_cycle NOT LIKE '%temp%' ORDER BY cr_date DESC, cr_start_time DESC "; 
    $result = $conn->query($query); 
    $row_cnt = $result->num_rows;
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        
        $reg = '';
        $reg2 = '';
        $queryJob = " SELECT j_id, student_name FROM tk_job WHERE j_id = '".$row['cl_display_id']."' "; 
        $resultJob = $conn->query($queryJob); 
        if($resultJob->num_rows > 0){
            $rowJob = $resultJob->fetch_assoc();
            if( $rowJob['student_name'] == '' ){
                $reg = 'yes';
            }
        }
        
        $Details = " SELECT u_id, bank_name, acc_no FROM tk_user WHERE u_id = '".$row['cl_tutor_id']."' "; 
        $resultDetails = $conn->query($Details); 
        if($resultDetails->num_rows > 0){
            $rowDetails = $resultDetails->fetch_assoc();
            if( $rowDetails['bank_name'] == '' || $rowDetails['acc_no'] == '' ){
                $reg2 = 'yes';
            }
        }
        

         if($row['cr_status'] =='FM to pay tutor'){
             echo 'negative';
         }else{
            if( $row_cnt == 1){
                if( $reg == 'yes'){
                    echo 'yes 1';
                }else{
                    echo 'no 1';
                }
            }        
            else if( $row_cnt == 2){
                if( $reg2 == 'yes'){
                    echo 'yes 2';
                }else{
                    echo 'no 2';
                }
            }else{
                echo 'positif';
            }
         }
            unset($_SESSION['balance']);
    }
    

    /*$query = " SELECT cl_id, cl_hours_balance FROM tk_classes WHERE cl_id = '".$_POST['c_id']."' "; 
    $result = $conn->query($query); 
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();


        if (strpos($row['cl_hours_balance'], "-") !== false) {
            echo 'negative';
        }else{
            //echo 'positif';
            if ( ($row['cl_hours_balance']) <= 0 ) {
                //echo 'negative '.$row['cl_hours_balance'];
                echo 'negative';
            }else{
                //echo 'positif '.$row['cl_hours_balance'];
                echo 'positif';
            }   
        }



    }*/
    else{
        echo 'Error..';
    }

$conn->close();
}
?>