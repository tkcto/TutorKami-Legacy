<!-- DONE BACKUP -->
<?php
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

if(!empty($_POST['id'])) {
    if( (isset($_SESSION['tk']['u_id'])) && ($_SESSION['tk']['u_id'] == '1' || $_SESSION['tk']['u_id'] == '8' || $_SESSION['tk']['u_id'] == '1579926' || $_SESSION['tk']['u_id'] == '1581081' || $_SESSION['tk']['u_id'] == '3') ){
        $header = '';
        $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$_POST["id"]."' "; 
        $result = $conn->query($sql); 
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            
    
            $header = date('d/m/Y H:i:s')." | DELETE (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name'];
            $header .= "\n ### Date Client Paid : ".trim($row['no1']);
            $header .= "\n ### Job : ".trim($row['no2']);
            $header .= "\n ### Tutor's Name : ".trim($row['no3']);
            $header .= "\n ### Received : ".trim($row['no4']);
            $header .= "\n ### Note : ".trim($row['no5']);
            $header .= "\n ### Date Tutor Paid : ".trim($row['no6']);
            $header .= "\n ### Paid to Tutor/Refund to pr : ".trim($row['no7']);
            $header .= "\n ### Gst : ".trim($row['no8']);
            $header .= "\n ### Gross Profit : ".trim($row['no9']);
            $header .= "\n ### Hour : ".trim($row['no10']);
            $header .= "\n ### Note : ".trim($row['no11']);
                
            $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '".$row['main_id']."' ";
            $resultMain = $conn->query($sqlMain);
            if ($resultMain->num_rows > 0) {
                $rowMain = $resultMain->fetch_assoc();
                $fileName = str_replace(' ', '', "Log-".$rowMain['name'].$rowMain['year'].".txt");
            }else{
                $fileName = "Log-temp.txt";
            }
    
            if( $header != '' ){
                $myFile = $fileName;
                $message = $header;
                if (file_exists($myFile)) {
                  $fh = fopen($myFile, 'a');
                  fwrite($fh, $message."\n");
                } else {
                  $fh = fopen($myFile, 'w');
                  fwrite($fh, $message."\n");
                }
                fclose($fh);   
                
                require_once("dbcontroller.php");
                $db_handle = new DBController();

                $sql = "UPDATE tk_sales_sub set temp = 'Delete' WHERE  id=".$_POST["id"];
                $result = $db_handle->executeUpdate($sql);
            	
            }
           
        }else{
            echo 'Error';
        }        
    }else{
        echo "session";
    }

}else{
    echo 'Error';
}
?>
