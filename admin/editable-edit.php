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

if( (isset($_SESSION['tk']['u_id'])) && ($_SESSION['tk']['u_id'] == '1' || $_SESSION['tk']['u_id'] == '8' || $_SESSION['tk']['u_id'] == '1579926' || $_SESSION['tk']['u_id'] == '1581081' || $_SESSION['tk']['u_id'] == '3') ){
    $header = '';
    $sql = " SELECT * FROM tk_sales_sub WHERE id = '".$_POST["id"]."' "; 
    $result = $conn->query($sql); 
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        
            if( $_POST["column"] == 'no1' ){
                if( $_POST["editval"] != $row['no1'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Date Client Paid : ".trim($row['no1'])." => ".trim($_POST["editval"])." ### ";
                }
                
            }else if( $_POST["column"] == 'no2' ){
                if( $_POST["editval"] != $row['no2'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Job : ".trim($row['no2'])." => ".trim($_POST["editval"]);
                }
                
            }else if( $_POST["column"] == 'no3' ){
                if( $_POST["editval"] != $row['no3'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Tutor's Name : ".trim($row['no3'])." => ".trim($_POST["editval"]);
                }
                
            }else if( $_POST["column"] == 'no4' ){
                if( $_POST["editval"] != $row['no4'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Received : ".trim($row['no4'])." => ".trim($_POST["editval"]);
                }
                
            }else if( $_POST["column"] == 'no5' ){
                if( $_POST["editval"] != $row['no5'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Note : ".trim($row['no5'])." => ".trim($_POST["editval"]);
                }
                
            }
            else if( $_POST["column"] == 'no6' ){
                if( $_POST["editval"] != $row['no6'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Date Tutor Paid : ".$row['no6']." => ".$_POST["editval"];
                }
                
            }else if( $_POST["column"] == 'no7' ){
                if( $_POST["editval"] != $row['no7'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Paid to Tutor/Refund to pr : ".$row['no7']." => ".$_POST["editval"];
                }
                
            }
            else if( $_POST["column"] == 'no8' ){
                if( $_POST["editval"] != $row['no8'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Gst : ".trim($row['no8'])." => ".trim($_POST["editval"]);
                }
                
            }else if( $_POST["column"] == 'no9' ){
                if( $_POST["editval"] != $row['no9'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Gross Profit : ".trim($row['no9'])." => ".trim($_POST["editval"]);
                }
                
            }else if( $_POST["column"] == 'no10' ){
                if( $_POST["editval"] != $row['no10'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Hour : ".trim($row['no10'])." => ".trim($_POST["editval"]);
                }
                
            }

            else if( $_POST["column"] == 'saveManual' ){
                if( $_POST["dateTutor"] != $row['no6'] || $_POST["paidTutor"] != $row['no7'] || $_POST["note"] != $row['no11'] ){
                    $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Date Tutor Paid : ".trim($row['no6'])." => ".trim($_POST["dateTutor"])." & Paid to Tutor/Refund to pr : ".trim($row['no7'])." => ".trim($_POST["paidTutor"])." & Note : ".trim($row['no11'])." => ".trim($_POST["note"]);
                }
                
            }
            
            else{
                $header = date('d/m/Y H:i:s')." | EDIT (".$row['tab_name']." - ".$row['row_no'].") | ".$_SESSION['tk']['u_first_name']."\n ### Error";
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
                    
                if( $_POST["column"] == 'no4' ){
                    $sql = "UPDATE tk_sales_sub set " . $_POST["column"] . " = '".trim($_POST["editval"])."', no9 = '".trim($_POST["GrossProfit"])."' WHERE  id=".$_POST["id"];
                    $result = $db_handle->executeUpdate($sql); 
                    if( $_POST["column"] == 'no7' ){
                        $sqlGetData = " SELECT * FROM tk_sales_sub WHERE id = '".$_POST["id"]."' ";
                        $resultGetData = $conn->query($sqlGetData);
                        if ($resultGetData->num_rows > 0) {
                            $rowGettData = $resultGetData->fetch_assoc();
                            /* Save jon details (AC) */
                            $sqlGetJob = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$rowGettData["no2"]."' ";
                            $resultGetJob = $conn->query($sqlGetJob);
                            if ($resultGetJob->num_rows > 0) {
                                $rowGetJob = $resultGetJob->fetch_assoc();
                                
                                $rateTutor = ( (float) filter_var( $rowGetJob['j_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
                                $thisRate = number_format(($rowGettData["no10"] * $rateTutor), 2); 

                                $thisAC = date("d/m/Y")."-Tutor completed ".trim($rowGettData["no10"])." hours. Payment ".trim($rowGettData["no10"])." hrs x RM".trim($rateTutor)."/hour = RM".trim($_POST["editval"])." made- ".$_SESSION['tk']['u_first_name']."\r\n".$rowGetJob["jt_comments"];

                                $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$thisAC."' WHERE jt_j_id = '".$rowGettData["no2"]."' AND jt_id = '".$rowGetJob["jt_id"]."'   ";
                                $conn->query($sqlAC);
                                
                            }
                            /* Save jon details (AC) */                            
                        }
                    }
                }else if( $_POST["column"] == 'saveManual' ){
                    $sql = "UPDATE tk_sales_sub set no6 = '".trim($_POST["dateTutor"])."', no7 = '".trim($_POST["paidTutor"])."', no9 = '".trim($_POST["GrossProfit"])."', no11 = '".trim($_POST["note"])."' WHERE  id=".$_POST["id"];
                    $result = $db_handle->executeUpdate($sql); 

                        $sqlGetData = " SELECT * FROM tk_sales_sub WHERE id = '".$_POST["id"]."' ";
                        $resultGetData = $conn->query($sqlGetData);
                        if ($resultGetData->num_rows > 0) {
                            $rowGettData = $resultGetData->fetch_assoc();
                            /* Save jon details (AC) */
                            $sqlGetJob = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$rowGettData["no2"]."' ";
                            $resultGetJob = $conn->query($sqlGetJob);
                            if ($resultGetJob->num_rows > 0) {
                                $rowGetJob = $resultGetJob->fetch_assoc();
                                
                                $rateTutor = ( (float) filter_var( $rowGetJob['j_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
                                $thisRate = number_format(($rowGettData["no10"] * $rateTutor), 2); 

                                $thisAC = date("d/m/Y")."-Tutor completed ".trim($rowGettData["no10"])." hours. Payment ".trim($rowGettData["no10"])." hrs x RM".trim($rateTutor)."/hour = RM".trim($_POST["paidTutor"])." made- ".$_SESSION['tk']['u_first_name']."\r\n".$rowGetJob["jt_comments"];

                                $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$thisAC."' WHERE jt_j_id = '".$rowGettData["no2"]."' AND jt_id = '".$rowGetJob["jt_id"]."'   ";
                                $conn->query($sqlAC);
                                
                            }
                            /* Save jon details (AC) */                            
                        }
                    
                }else if( $_POST["column"] == 'no7' ){
                    $sql = "UPDATE tk_sales_sub set " . $_POST["column"] . " = '".$_POST["editval"]."', no9 = '".trim($_POST["GrossProfit"])."' WHERE  id=".$_POST["id"];
                    $result = $db_handle->executeUpdate($sql);    
                }
                else{
                    $sql = "UPDATE tk_sales_sub set " . $_POST["column"] . " = '".trim($_POST["editval"])."' WHERE  id=".$_POST["id"];
                    $result = $db_handle->executeUpdate($sql);                    
                }
            }
        
    }else{
        echo 'Error';
    }
}else{
    echo "session";
}


?>
