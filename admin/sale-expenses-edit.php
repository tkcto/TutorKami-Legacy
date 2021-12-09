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
    $sql = " SELECT * FROM tk_sales_expenses WHERE id = '".$_POST["id"]."' "; 
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
           

            if( $_POST["column"] == 'date' ){

                if( $row['item'] == 'kosong' || $row['amount'] == 'kosong' || $row['note'] == 'kosong' ){
                    $header = '';
                }else{
                    if( $_POST["editval"] != $row['date'] ){
                        $header = date('d/m/Y H:i:s')." | EDIT ( Expenses - ".$_POST["btnTabMonth"]." ".$row['row_no'].") | ".$adminName."\n ### Date : ".trim($row['date'])." => ".trim($_POST["editval"])."\n";
                    }                    
                }
                
            }else if( $_POST["column"] == 'item' ){

                if( $row['item'] == 'kosong' || $row['amount'] == 'kosong' || $row['note'] == 'kosong' ){
                    $header = '';
                }else{
                    if( $_POST["editval"] != $row['item'] ){
                        $header = date('d/m/Y H:i:s')." | EDIT ( Expenses - ".$_POST["btnTabMonth"]." ".$row['row_no'].") | ".$adminName."\n ### Item : ".trim($row['item'])." => ".trim($_POST["editval"])."\n";
                    }                  
                }

            }else if( $_POST["column"] == 'amount' ){

                if( $row['item'] == 'kosong' || $row['amount'] == 'kosong' || $row['note'] == 'kosong' ){
                    $header = '';
                }else{
                    if( $_POST["editval"] != $row['amount'] ){
                        $header = date('d/m/Y H:i:s')." | EDIT ( Expenses - ".$_POST["btnTabMonth"]." ".$row['row_no'].") | ".$adminName."\n ### Amount : ".trim($row['amount'])." => ".trim($_POST["editval"])."\n";
                    }                 
                }

            }else if( $_POST["column"] == 'note' ){

                if( $row['item'] == 'kosong' || $row['amount'] == 'kosong' || $row['note'] == 'kosong' ){
                    $header = '';
                }else{
                    if( $_POST["editval"] != $row['note'] ){
                        $header = date('d/m/Y H:i:s')." | EDIT ( Expenses - ".$_POST["btnTabMonth"]." ".$row['row_no'].") | ".$adminName."\n ### Note : ".trim($row['note'])." => ".trim($_POST["editval"])."\n";
                    }              
                }
                
            }
            else{
                $header = date('d/m/Y H:i:s')." | EDIT ( Expenses - ".$_POST["btnTabMonth"]." ".$row['row_no'].") | ".$adminName."\n ### Error \n";
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
                
                
/*               
                if( $_POST["column"] == 'amount' ){
                    $val = number_format((float)trim($_POST["editval"]), 2, '.', '');  
                }else{
                    $val = trim($_POST["editval"]);
                }
                $Update= " UPDATE tk_sales_expenses set " . trim($_POST["column"]) . " = '".$val."' WHERE id = '".$row['id']."'  ";
                if ($conn->query($Update) === TRUE) {
                    echo "Success";
                } else {
                    echo "Error";
                }
*/                
            }


                if( $_POST["column"] == 'amount' ){
                    $val = number_format((float)trim($_POST["editval"]), 2, '.', '');  
                }else{
                    $val = trim($_POST["editval"]);
                }
                $Update= " UPDATE tk_sales_expenses set " . trim($_POST["column"]) . " = '".$val."' WHERE id = '".$row['id']."'  ";
                if ($conn->query($Update) === TRUE) {
                    echo "Success";
                } else {
                    echo "Error";
                }


    }else{
        echo "Error";
    }
}else{
    echo "session";
}


?>