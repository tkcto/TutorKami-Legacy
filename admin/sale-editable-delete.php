<?php
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

if(!empty($_POST["mainID"])) {
 
    if( (isset($_SESSION['tk']['u_id'])) && ($_SESSION['tk']['u_id'] == '1' || $_SESSION['tk']['u_id'] == '8' || $_SESSION['tk']['u_id'] == '1579926' || $_SESSION['tk']['u_id'] == '1581081' || $_SESSION['tk']['u_id'] == '3') ){
        $header = '';
        $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$_POST["id"]."' "; 
        $result = $conn->query($sql); 
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            
                    $i = 1;
                    $OldNo = " SELECT id, main_id, tab_name, month, row_no FROM tk_sales_sub WHERE id != '".$row['id']."' AND main_id = '".$row["main_id"]."' AND tab_name = '".$row["tab_name"]."' AND month = '".$row["month"]."' AND row_no != '0' AND row_no != '999999' ORDER BY row_no ASC   ";
                    $resultOldNo = $conn->query($OldNo);
                    if ($resultOldNo->num_rows > 0) {
                        while($rowOldNo = $resultOldNo->fetch_assoc()){
                            $updateNo = "UPDATE tk_sales_sub SET row_no = '".$i."' WHERE id = '".$rowOldNo["id"]."' ";
                            $conn->query($updateNo);  
                        $i++;
                        }
                    }else{
                        $i = 2;
                    }
            
                    if($i >= 2){
                        $adminName = '';
                        $Admin = " SELECT ud_u_id, ud_first_name FROM tk_user_details WHERE ud_u_id = '".$_SESSION['tk']['u_id']."' "; 
                        $resultAdmin = $conn->query($Admin); 
                        if($resultAdmin->num_rows > 0){
                            $rowAdmin = $resultAdmin->fetch_assoc();
                            $adminName = $rowAdmin['ud_first_name'];
                        }
            
                        $header = date('d/m/Y H:i:s')." | DELETE (".$row['tab_name']." - ".$_POST["btnTabMonth"].") | ".$adminName;
                        $header .= "\n ### Date Client Paid : ".trim($row['no1']);
                        $header .= "\n ### Job              : ".trim($row['no2']);
                        $header .= "\n ### Tutor's Name     : ".trim($row['no3']);
                        $header .= "\n ### Received         : ".trim($row['no4']);
                        $header .= "\n ### Note             : ".trim($row['no5']);
                        $header .= "\n ### Date Tutor Paid  : ".trim($row['no6']);
                        $header .= "\n ### Paid to Tutor/Refund to pr : ".trim($row['no7']);
                        $header .= "\n ### Gst              : ".trim($row['no8']);
                        $header .= "\n ### Gross Profit     : ".trim($row['no9']);
                        $header .= "\n ### Hour             : ".trim($row['no10']);
                        $header .= "\n ### Note             : ".trim($row['no11']);
                            
                        $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '".$row['main_id']."' ";
                        $resultMain = $conn->query($sqlMain);
                        if ($resultMain->num_rows > 0) {
                            $rowMain = $resultMain->fetch_assoc();
                            $fileName = str_replace(' ', '', "Log-".$rowMain['name'].$rowMain['year'].".txt");
                        }else{
                            $fileName = "Log-temp.txt";
                        }
               
                        if( $header != '' ){
                            /*$myFile = $fileName;
                            $message = $header;
                            if (file_exists($myFile)) {
                              $fh = fopen($myFile, 'a');
                              fwrite($fh, $message."\n");
                            } else {
                              $fh = fopen($myFile, 'w');
                              fwrite($fh, $message."\n");
                            }
                            fclose($fh);*/
                            $myFile = $fileName;
                            $message = $header."\n";
                            if (file_exists($myFile)) {
                              $fh = fopen($myFile, 'a');
                                $datafromfile = file_get_contents($myFile);
                                file_put_contents($myFile, $message.$datafromfile);
                            } else {
                              $fh = fopen($myFile, 'w');
                              fwrite($fh, $message."\n");
                            }
                            fclose($fh);
                            
                            $Delete = "DELETE FROM tk_sales_sub WHERE id = '".$row['id']."' ";
                            if ($conn->query($Delete) === TRUE) {
                              echo "Success";
                            } else {
                              echo "Error";
                            }
                        }
                    }

        }else{
            echo "Error";
        }
    }else{
        echo "session";
    }

}else{
    echo "Error";
}
?>
