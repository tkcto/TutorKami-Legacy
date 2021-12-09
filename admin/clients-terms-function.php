<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_POST['dataUpdate'])){
	$dataUpdate = $_POST['dataUpdate'];
	if( !empty($dataUpdate["idBI"]) && !empty($dataUpdate["idBM"]) ){

    $myeditor = htmlspecialchars($dataUpdate['myeditor'], ENT_QUOTES);
    $myeditor2 = htmlspecialchars($dataUpdate['myeditor2'], ENT_QUOTES);        

    $historyBI = htmlspecialchars($dataUpdate['historyBI'], ENT_QUOTES);
    $historyBM = htmlspecialchars($dataUpdate['historyBM'], ENT_QUOTES);    
    
    
	    $sqlInsert = "INSERT INTO tk_history_terms (ht_pmt_id, ht_pmt_pagedetail, ht_date, ht_pmt_pagedetai_BM, ht_time) VALUES 
	    ('".$dataUpdate['idBI']."', '".$historyBI."', '".date('d/m/Y')."', '".$historyBM."', '".date('H:i')."')";
    
	    $sqlBI = "UPDATE tk_page_manage_translation SET pmt_pagedetail = '".$myeditor."', pmt_lastupdated = '".date('d/m/Y')."', pmt_noti = 'TRUE', pmt_time = '".date('H:i')."' WHERE pmt_id = '".$dataUpdate['idBI']."'";
	    $sqlBM = "UPDATE tk_page_manage_translation SET pmt_pagedetail = '".$myeditor2."', pmt_lastupdated = '".date('d/m/Y')."', pmt_noti = 'TRUE', pmt_time = '".date('H:i')."' WHERE pmt_id = '".$dataUpdate['idBM']."'";

        if ( ($conn->query($sqlInsert) === TRUE) && ($conn->query($sqlBI) === TRUE) && ($conn->query($sqlBM) === TRUE)  ) {
            echo "Success! Record Has Been Saved";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }      
     
	}
}
$conn->close();
?>