<?php
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');

// Create connection <!-- DONE BACKUP -->
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

function hoursToMinutes($hours) { 
    $minutes = 0; 
    if (strpos($hours, '.') !== false) { 
        // Split hours and minutes. 
        list($hours, $minutes) = explode('.', $hours); 
    } 
    return $hours * 60 + $minutes; 
} 

// Transform minutes like "105" into hours like "1.45". 
function minutesToHours($minutes) { 
    $hours = (int)($minutes / 60); 
    $minutes -= $hours * 60; 
    return sprintf("%d.%02.0f", $hours, $minutes); 
}


session_start();
if( !empty($_POST["mainID"]) && !empty($_POST["btnTabMonth"]) ) {
    
    
    if( (isset($_SESSION['tk']['u_id'])) && ($_SESSION['tk']['u_id'] == '1' || $_SESSION['tk']['u_id'] == '8' || $_SESSION['tk']['u_id'] == '1579926' || $_SESSION['tk']['u_id'] == '1581081' || $_SESSION['tk']['u_id'] == '3') ){
        
        $ThisRow = 1;
        $GetRow = " SELECT id, main_id, month, row_no FROM tk_sales_expenses WHERE main_id = '".trim($_POST["mainID"])."' AND month = '".trim($_POST["btnTabMonth"])."' ORDER BY id DESC "; 
        $resultGetRow = $conn->query($GetRow); 
        if($resultGetRow->num_rows > 0){
            $rowGetRow = $resultGetRow->fetch_assoc();
            $ThisRow = ($rowGetRow['row_no']+1);
        }  
        

        $sqlInsert = " INSERT INTO tk_sales_expenses (main_id, month, date, item, amount, note, row_no) VALUES ('".trim($_POST["mainID"])."', '".trim($_POST["btnTabMonth"])."', '".trim($_POST["today"])."', 'kosong', 'kosong', 'kosong', '".$ThisRow."') ";
        if ( ($conn->query($sqlInsert) === TRUE) ) {
            $last_id = $conn->insert_id;

            $adminName = '';
            $Admin = " SELECT ud_u_id, ud_first_name FROM tk_user_details WHERE ud_u_id = '".$_SESSION['tk']['u_id']."' "; 
            $resultAdmin = $conn->query($Admin); 
            if($resultAdmin->num_rows > 0){
                $rowAdmin = $resultAdmin->fetch_assoc();
                $adminName = $rowAdmin['ud_first_name'];
            }            
            
            $sqlMain = " SELECT * FROM tk_sales_main WHERE id = '".trim($_POST["mainID"])."' ";
            $resultMain = $conn->query($sqlMain);
            if ($resultMain->num_rows > 0) {
                $rowMain = $resultMain->fetch_assoc();
                $fileName = str_replace(' ', '', "Log-".$rowMain['name'].$rowMain['year'].".txt");
            }else{
                $fileName = "Log-temp.txt";
            }            
            
            $header = date('d/m/Y H:i:s')." | ADD ( Expenses - ".trim($_POST["btnTabMonth"])." ".$ThisRow.") | ".$adminName."\n";
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
                fclose($fh); */
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
            }     
            
            echo $last_id;
            
        }else{
            echo "Error.."; 
        }










    }else{
        echo "session";
    }
}else{
   echo "Error 3"; 
}
?>

