<?php
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

if( (isset($_SESSION['tk']['u_id'])) && ($_SESSION['tk']['u_id'] == '1' || $_SESSION['tk']['u_id'] == '8' || $_SESSION['tk']['u_id'] == '1579926' || $_SESSION['tk']['u_id'] == '1581081' || $_SESSION['tk']['u_id'] == '3') ){
    $header = '';
    $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$_POST["id"]."' "; 
    $result = $conn->query($sql); 
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        
        //echo $_POST["column"].' = '.$_POST["editval"].' = '.$_POST["id"].' = '.$_POST["btnTabMonth"].' = '.$_POST["GrossProfit"];
        
            if( $row['row_no'] == '999999' ){
                $rowNo = 'CF '.$row['cf'];
            }else{
                 $rowNo = $row['row_no'];
            }
            
            $adminName = '';
            $Admin = " SELECT ud_u_id, ud_first_name FROM tk_user_details WHERE ud_u_id = '".$_SESSION['tk']['u_id']."' "; 
            $resultAdmin = $conn->query($Admin); 
            if($resultAdmin->num_rows > 0){
                $rowAdmin = $resultAdmin->fetch_assoc();
                $adminName = $rowAdmin['ud_first_name'];
            }
$abc = $conn ->real_escape_string(trim($_POST["editval"]));

            if( $_POST["column"] == 'no1' ){
                if( $_POST["editval"] != $row['no1'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Date Client Paid : ".trim($row['no1'])." => ".$abc."\n";
                }
                
            }else if( $_POST["column"] == 'no2' ){
                if( $_POST["editval"] != $row['no2'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Job : ".trim($row['no2'])." => ".$abc."\n";
                }
                
            }else if( $_POST["column"] == 'no3' ){
                if( $_POST["editval"] != $row['no3'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Tutor's Name : ".trim($row['no3'])." => ".$abc."\n";
                }
                
            }else if( $_POST["column"] == 'no4' ){
                if( $_POST["editval"] != $row['no4'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Received : ".trim($row['no4'])." => ".$abc."\n";
                }
                
            }else if( $_POST["column"] == 'no5' ){
                if( $_POST["editval"] != $row['no5'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Note : ".trim($row['no5'])." => ".$abc."\n";
                }
                
            }
            
else if( $_POST["column"] == 'no6' ){
                if( $_POST["editval"] != $row['no6'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Date Tutor : ".trim($row['no6'])." => ".$abc."\n";
                }
            }
else if( $_POST["column"] == 'no7' ){
                if( $_POST["editval"] != $row['no7'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Amount Tutor : ".trim($row['no7'])." => ".$abc."\n";
                }
            }
            
            
            else if( $_POST["column"] == 'no8' ){
                if( $_POST["editval"] != $row['no8'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Gst : ".trim($row['no8'])." => ".$abc."\n";
                }
                
            }else if( $_POST["column"] == 'no9' ){
                if( $_POST["editval"] != $row['no9'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Gross Profit : ".trim($row['no9'])." => ".$abc."\n";
                }
                
            }else if( $_POST["column"] == 'no10' ){
                if( $_POST["editval"] != $row['no10'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Hour : ".trim($row['no10'])." => ".$abc."\n";
                }
                
            }else if( $_POST["column"] == 'no11' ){
                if( $_POST["editval"] != $row['no11'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName."\n ### Note : ".trim($row['no11'])." => ".$abc."\n";
                }
                
            }
            else{
                $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$rowNo.") | ".$adminName."\n ### Error \n";
            }
        
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
                $message = $header."\n";
                if (file_exists($myFile)) {
                  $fh = fopen($myFile, 'a');
                  //fwrite($fh, $message."\n");
                    $datafromfile = file_get_contents($myFile);
                    file_put_contents($myFile, $message.$datafromfile);
                } else {
                  $fh = fopen($myFile, 'w');
                  fwrite($fh, $message."\n");
                }
                fclose($fh);   
 /*               
                if( $_POST["column"] == 'no8' ){

                var amountRate = $(editableObj).text();
                var hour = document.getElementById('no10').value;
                document.getElementById('no4').value = parseFloat((amountRate * hour)).toFixed(2);
                document.getElementById('txt_no4').innerHTML = parseFloat((amountRate * hour)).toFixed(2);
            
                var amountReceived = document.getElementById('no4').value;
                var amountTutor    = document.getElementById('no7').value;
                document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
                document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);

                $Received = number_format((float)(trim($_POST["editval"]) * $row['no10']), 2, '.', '');  
*/                

$abc = $conn ->real_escape_string(trim($_POST["editval"]));

                $Update= " UPDATE tk_sales_sub set " . trim($_POST["column"]) . " = '".$abc."', no9 = '".trim($_POST["GrossProfit"])."' WHERE id = '".$row['id']."'  ";
                if ($conn->query($Update) === TRUE) {
                    echo "Success";
                } else {
                    echo "Error";
                }
                    
 
                
                
            }else{
                echo "Error";
            }
        
    }else{
        echo "Error";
    }
}else{
    echo "session";
}


?>
