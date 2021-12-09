<!-- DONE BACKUP -->
<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
session_start();
if(!empty($_POST["salesSubID"])) {

            $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$_POST["salesSubID"]."' ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                $main_id  = $row["main_id"];
                $tab_name = $row["tab_name"];

                    $sqlLargestNo = " SELECT MAX(CONVERT(row_no,UNSIGNED INTEGER)) AS max FROM tk_sales_sub WHERE main_id = '".$main_id."' AND tab_name = '".$tab_name."' AND month = '".$_POST["btnTabMonth"]."' AND row_no != '0' ";
                    $resultLargestNo = $conn->query($sqlLargestNo);
                    if ($resultLargestNo->num_rows > 0) {
                        $rowLargestNo = $resultLargestNo->fetch_assoc();
                        echo $largestNumber = ($rowLargestNo['max'] + 1);
                    }else{
                        echo $largestNumber = '1';
                    }
            }else{
                echo "1";
            }    

}else{
   echo "Error 3"; 
}
?>


