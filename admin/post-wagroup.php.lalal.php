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

    $queryJob = " SELECT * FROM tk_job 
    INNER JOIN tk_job_translation on jt_j_id = j_id
    WHERE j_id = '".$data['JobID']."' "; 
    $resultJob = $conn->query($queryJob); 
    if($resultJob->num_rows > 0){
        $rowJob = $resultJob->fetch_assoc();
        
            $sqlGetJob = "SELECT jlt_lang_code, jlt_jl_id, jlt_title FROM tk_job_level_translation WHERE jlt_lang_code = 'en' AND jlt_jl_id = '".$rowJob['j_jl_id']."' ";
            $resultGetJob = $conn->query($sqlGetJob); 
            if($resultGetJob->num_rows > 0){
                $rowGetJob = $resultGetJob->fetch_assoc();
                $thisJobName = $rowGetJob['jlt_title'];
            }else{
                $thisJobName = '';
            }
            
			$sqlCity = "SELECT city_id, city_name FROM tk_cities WHERE city_id = '".$rowJob['city']."' ";
            $resultCity = $conn->query($sqlCity); 
            if($resultCity->num_rows > 0){
                $rowCity = $resultCity->fetch_assoc();
			    $thisCity = $rowCity['city_name'];
            }else{
			    $thisCity = '';
            }
            
            /*
            //$website = "https://wa.tutorkami.my/api-docs/";
            $website = "https://api.wsapme.com/v1/";
           // if ( hasWord('ONLINE', $rowJob['jt_subject']) ) {
               if ( hasWord('Success', $rowJob['jt_subject']) ) {    
                if( !activeAPI( $website ) ) {
                    echo 'Server Offline! Please try again later..';
                } else {
                   // $loopPhone = array('60122309743-1543553367@g.us','60196412395-1614695624@g.us','60172327809-1600591965@g.us');
                    $loopPhone = array('60122309743-1543553367@g.us','60196412395-1614695624@g.us');
                    foreach ($loopPhone as $fn) {
                        $args = new stdClass();
                        $xdata = new stdClass();
                        $args->to = $fn;
                        $args->content = "*Job ".$rowJob['j_id']." :* \r\n".ucwords($rowJob['jt_subject'])." & ".ucwords($thisJobName)."\r\n".$rowJob['j_rate']."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$rowJob['j_id']."&status=".$rowJob['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                        $xdata->args = $args;
                        $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                    }
                    $response = json_decode($make_call, true);
                    $success  = $response['success'];
                    $response = $response['response'];
                    if( $success == '1' && $response != '' ){
                        echo 'Successful..';
                    }else{
                        echo 'Unsuccessful..';
                    }
                }

            }else{
            */

                /* Selangor & KL */ /*
                if( $rowJob['j_state_id'] == '1046' || $rowJob['j_state_id'] == '1658' || $rowJob['j_state_id'] == '1661' ){
                    if( !activeAPI( $website ) ) {
                        echo 'Server Offline! Please try again later..';
                    } else {
                        /*$args = new stdClass();
                        $xdata = new stdClass();
                        $args->to = "60122309743-1543553367@g.us";
                        $args->content = "*Job ".$rowJob['j_id']." :* \r\n".ucwords($rowJob['jt_subject'])." in ".ucwords($rowJob['j_area']).", ".ucwords($thisCity).". \r\n".$rowJob['j_rate']."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$rowJob['j_id']."&status=".$rowJob['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                        $xdata->args = $args;
                        $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                        
                        $response = json_decode($make_call, true);
                        $success  = $response['success'];
                        $response = $response['response'];
                        if( $success == '1' && $response != '' ){
                            echo 'Successful..';
                        }else{
                            echo 'Unsuccessful..';
                        }*/ /*
                        $loopPhone = array('60122309743-1543553367@g.us','60196412395-1614695624@g.us');
                        foreach ($loopPhone as $fn) {
                            $args = new stdClass();
                            $xdata = new stdClass();
                            $args->to = $fn;
                            $args->content = "*Job ".$rowJob['j_id']." :* \r\n".ucwords($rowJob['jt_subject'])." in ".ucwords($rowJob['j_area']).", ".ucwords($thisCity).". \r\n".$rowJob['j_rate']."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$rowJob['j_id']."&status=".$rowJob['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                            $xdata->args = $args;
                            $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                        }
                        $response = json_decode($make_call, true);
                        $success  = $response['success'];
                        $response = $response['response'];
                        if( $success == '1' && $response != '' ){
                            echo 'Successful..';
                        }else{
                            echo 'Unsuccessful..';
                        }
                    }
 
                } */
                /* N.Sembian */
             //   if( $rowJob['j_state_id'] == '1040' ){
                    /*
                    if( !activeAPI( $website ) ) {
                        echo 'Server Offline! Please try again later..';
                    } else {
                        $args = new stdClass();
                        $xdata = new stdClass();
                        $args->to = "60172327809-1600591965@g.us";
                        $args->content = "*Job ".$rowJob['j_id']." :* \r\n".ucwords($rowJob['jt_subject'])." in ".ucwords($rowJob['j_area']).", ".ucwords($thisCity).". \r\n".$rowJob['j_rate']."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$rowJob['j_id']."&status=".$rowJob['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                        $xdata->args = $args;
                        $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                        
                        $response = json_decode($make_call, true);
                        $success  = $response['success'];
                        $response = $response['response'];
                        if( $success == '1' && $response != '' ){
                            echo 'Successful..';
                        }else{
                            echo 'Unsuccessful..';
                        }
                    }
                    */
                    
                        $mesej2 = "*Job ".$rowJob['j_id']." :* newLine".ucwords($rowJob['jt_subject'])." in ".ucwords($rowJob['j_area']).", ".ucwords($thisCity).". newLine".$rowJob['j_rate']."newLinePlease click link to applynewLinehttps://www.tutorkami.com/job_details?jid=".$rowJob['j_id']."&status=".$rowJob['j_status']."newLine newLine(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                        $mesej = str_replace('newLine','\n',$mesej2);
                        
                        
                        $curl = curl_init();
                        
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://api.wsapme.com/v1/sendMessage',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          
                          CURLOPT_POSTFIELDS =>'{
                                "device" : "237",
                                "to": "60172327809-1600591965@g.us",
                                "message": "'.$mesej.'"
                        }',
                        
                          CURLOPT_HTTPHEADER => array(
                            'x-wsapme-token: 238ce7ee762d4e14f48e4d53e546b316',
                            'Content-Type: application/json'
                          ),
                        ));
                        
                        $response = curl_exec($curl);
                        
                        curl_close($curl);
                        $response2 = json_decode($response, true);
                        $data     = $response2['message'];
                        if( $data == 'Sent Successfully' ){
                            echo 'Successful..';
                        }else{
                            echo 'Unsuccessful..';
                        }

               // }
                
            }
			
			
			
			
			
			
			
					
    }else{
        echo 'Error !';
    }
}
$conn->close();
?>