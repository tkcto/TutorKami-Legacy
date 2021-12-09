<?php
/* Database connection start */
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
/* Database connection end */
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
if( !empty($_POST['displayid']) && !empty($_POST['dataURL']) ){

	$displayid = $_POST['displayid'];               
	$base64data = $_POST['dataURL'];     

	$sql = "SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_displayid = '$displayid'";
	$result = $connect->query($sql);
 
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id = $row['u_id'];
		$text =  date("d-m-Y")."_".date("H-i")."-1_".$id;
		$sql = "UPDATE tk_user SET signature_img = '$text' WHERE u_id = {$id}";
		
		define('UPLOAD_DIR', 'images/signature/');
		$img = $base64data;
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $text . '.png';
		$success = file_put_contents($file, $data);



		if($connect->query($sql) === TRUE) {

            $queryLogWa = " SELECT wa_user, wa_remark, wa_status FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$row['ud_phone_number']."' ";
            $resultLogWa = $connect->query($queryLogWa);
            if ($resultLogWa->num_rows > 0) {
            	$rowLogWa = $resultLogWa->fetch_assoc();
            	$_SESSION['clickWA'] = $id;
            }else{
                //$_SESSION['clickWA'] = "none";
                
                require_once('admin/classes/whatsapp-api-call.php');
                
                    		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$row['ud_phone_number']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                    		$exeWaNoti = $connect->query($sqlWaNoti);
                    		$_SESSION['clickWA'] = $id;
                /*
                $website = "https://wa.tutorkami.my/api-docs/";
                if( !activeAPI( $website ) ) {
                } else {
                    	$args = new stdClass();
                    	$xdata = new stdClass();
                    	$args->contactId = "6".$row['ud_phone_number']."@c.us";
                    	$xdata->args = $args;
                    	
                    	$make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
                    	$response = json_decode($make_call, true);
                    	$dataPhone     = $response['response']['id'];
                    	
                    	if( $dataPhone != '' ){
                    		$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$row['ud_phone_number']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                    		$exeWaNoti = $connect->query($sqlWaNoti);
                    		$_SESSION['clickWA'] = $id;
                    	}else{
                    	    $_SESSION['clickWA'] = "none";
                    	}  	
                }
                */
            
            }
			echo "Your signature has been successfully saved";
			
		} else {
			echo "Erorr while updating record : ". $connect->error;
		}
	} 
	$connect->close();
}
?>