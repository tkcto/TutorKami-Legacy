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
    $sql = " SELECT * FROM tk_sales_deposit WHERE id = '".$_POST["id"]."' "; 
    $result = $conn->query($sql); 
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $adminName = '';
        $Admin = " SELECT ud_u_id, ud_first_name FROM tk_user_details WHERE ud_u_id = '".$_SESSION['tk']['u_id']."' "; 
        $resultAdmin = $conn->query($Admin); 
        if($resultAdmin->num_rows > 0){
            $rowAdmin = $resultAdmin->fetch_assoc();
            $adminName = $rowAdmin['ud_first_name'];
        } 
            
        $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '".trim($row["main_id"])."' ";
        $resultMain = $conn->query($sqlMain);
        if ($resultMain->num_rows > 0) {
            $rowMain = $resultMain->fetch_assoc();
            $fileName = str_replace(' ', '', "Log-".$rowMain['name'].$rowMain['year'].".txt");
        }else{
            $fileName = "Log-temp.txt";
        }              
            
        $header = date('d/m/Y H:i:s')." | DELETE ( Deposit - ".trim($_POST["btnTabMonth"])." ".$row['row_no'].") | ".$adminName;
        $header .= "\n ### Date   : ".trim($row['date']);
        $header .= "\n ### Item   : ".trim($row['item']);
        $header .= "\n ### Amount : ".trim($row['amount']);
        $header .= "\n ### Note   : ".trim($row['note'])."\n";            
            
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
            
            $delete= " DELETE FROM tk_sales_deposit WHERE id = '".$row['id']."'  ";
            if ($conn->query($delete) === TRUE) {
                
                $ThisRow = 1;
                $GetRow = " SELECT id, main_id, month, row_no FROM tk_sales_deposit WHERE main_id = '".$row['main_id']."' AND month = '".$row['month']."' ORDER BY id ASC "; 
                $resultGetRow = $conn->query($GetRow); 
                if($resultGetRow->num_rows > 0){
                    while($rowGetRow = $resultGetRow->fetch_assoc()){
                        $Update= " UPDATE tk_sales_deposit set row_no = '".$ThisRow."' WHERE id = '".$rowGetRow['id']."'  ";
                        $conn->query($Update);
                        $ThisRow++;
                    }
                }
                
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