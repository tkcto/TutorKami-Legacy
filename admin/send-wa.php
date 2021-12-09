<?PHP

require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

$er == '';

if( (isset($_POST['j_id']) && $_POST['j_id'] != '') && (isset($_POST['queryParentID']) && $_POST['queryParentID'] != '') && (isset($_POST['value']) && $_POST['value'] != '') ) {
    if( $_POST['value'] == 'true' ){
        
        $query = " INSERT INTO tk_send_wa (wa_id, wa_job_id, wa_user, wa_date) VALUES ( '', '".$_POST['j_id']."', '".$_POST['queryParentID']."', '".date("Y-m-d H:i:s")."' )  "; 
        if( $conn->query($query) ) {
            $er = 'success';
        }else{
            $er = 'Error';
        }
        
		if( $er != '' && $er = 'success'){
			echo 'success';
		}else{
			echo 'Error ! : Inser Into DB Fail..';
		}
        
    }else{
        
        $query = " DELETE FROM tk_send_wa WHERE wa_job_id = '".$_POST['j_id']."' AND wa_user = '".$_POST['queryParentID']."' ";
        if( $conn->query($query) ) {
            $er = 'success';
        }else{
            $er = 'Error';
        }
        
		if( $er != '' && $er = 'success'){
			echo 'success';
		}else{
			echo 'Error ! : Inser Into DB Fail..';
		}

    }
}else{
    echo 'Error !';
}

/*
if( (isset($_POST['j_id']) && $_POST['j_id'] != '') && (isset($_POST['sendWAValue2']) && $_POST['sendWAValue2'] != '') ) {
	//echo $_POST['sendWAValue2'];
	$er = '';
	$myArray = explode(',', $_POST['sendWAValue2']); //echo $myArray;

		if(is_array($myArray)){
			foreach ($myArray as $row) {
				//$fieldVal1 = mysql_real_escape_string($records[$row][0]);
				//$fieldVal2 = mysql_real_escape_string($records[$row][1]);
				//$fieldVal3 = mysql_real_escape_string($records[$row][2]);
				//$query ="INSERT INTO programming_lang (field1, field2, field3) VALUES ( '". $fieldVal1."','".$fieldVal2."','".$fieldVal3."' )";
				//mysqli_query($conn, $query);
				
				
                $query = " INSERT INTO tk_send_wa (wa_id, wa_job_id, wa_user, wa_date) VALUES ( '', '".$_POST['j_id']."', '".$row."', '".date("Y-m-d H:i:s")."' )  "; 
				if( $conn->query($query) ) {
					$er = 'success';
				}else{
					$er = 'Error';
				}
				
				
			}
		}
		if( $er != '' && $er = 'success'){
			echo 'success';
		}else{
			echo 'Error ! : Inser Into DB Fail..';
		}

	
	
	

}else{
    echo 'Error !';
}
*/
?>






