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
        
        //echo $_POST["id"].' = '.$_POST["btnTabMonth"].' = '.$_POST["datePaid"].' = '.$_POST["amountPaid"].' = '.$_POST["GrossProfit"].' = '.$_POST["note"];


            if( $row['row_no'] == '999999' ){
                $rowNo = 'CF';
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
            
           
            $header = date('d/m/Y H:i:s')." | ADD (".$row['tab_name']." - ".$_POST["btnTabMonth"]." - ".$rowNo.") | ".$adminName;

            if( trim($_POST["datePaid"]) != $row['no6'] ){
                $header .= "\n ### Date Tutor : ".trim($row['no6'])." => ".trim($_POST["datePaid"])."\n";
            }
            if( trim($_POST["amountPaid"]) != $row['no7'] ){
                $header .= "\n ### Amount Tutor : ".trim($row['no7'])." => ".trim($_POST["amountPaid"])."\n";
            }
            
            $string = trim($_POST["note"]);
            $thisno11 = str_replace(array('<div style="overflow-y: scroll; height:20px;">', '</div>'), '', $string);
                    
            if( $thisno11 != $row['no11'] ){
                $header .= "\n ### Note            : ".trim($row['no11'])." => ".$thisno11."\n";
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
                
           
                if( $row['no6'] == '' && $row['no7'] == '' ){


                    $string = trim($_POST["note"]);
                    $thisno11 = str_replace(array('<div style="overflow-y: scroll; height:20px;">', '</div>'), '', $string);

                    $Update= " UPDATE tk_sales_sub set no6 = '".trim($_POST["datePaid"])."', no7 = '".trim($_POST["amountPaid"])."', no9 = '".trim($_POST["GrossProfit"])."', no11 = '".$thisno11."' WHERE id = '".$row['id']."'  ";
                    if ($conn->query($Update) === TRUE) {
                        //echo "Success";

                        $ChangeStatus = " SELECT cr_id, cl_id, cr_cl_id, row_no, cl_display_id, current_cycle, cr_date, cr_start_time, cr_status FROM tk_classes_record
                        INNER JOIN tk_classes ON cl_id = cr_cl_id
                        WHERE cl_display_id = '".$row["no2"]."' AND current_cycle NOT LIKE '%temp%'
                        ORDER BY cr_date DESC, cr_start_time DESC ";
                        $resultChangeStatus = $conn->query($ChangeStatus);
                        if ($resultChangeStatus->num_rows > 0) {
                            $rowChangeStatus = $resultChangeStatus->fetch_assoc();
                            if( $rowChangeStatus["cr_status"] == 'FM to pay tutor' ){
                                $qryUpdate = "UPDATE tk_classes_record SET cr_status = 'Tutor Paid' WHERE cr_id = '".$rowChangeStatus["cr_id"]."'";
                                $conn->query($qryUpdate);
                                
                                $ChangeStatusOther = " SELECT cr_id, cr_cl_id, row_no, cr_status FROM tk_classes_record WHERE cr_cl_id = '".$rowChangeStatus["cr_cl_id"]."' AND row_no = '".$rowChangeStatus["row_no"]."' AND cr_status = 'new'      ";
                                $resultChangeStatusOther = $conn->query($ChangeStatusOther);
                                if ($resultChangeStatusOther->num_rows > 0) {
                                    while($rowChangeStatusOther = $resultChangeStatusOther->fetch_assoc()){
                                        $qryUpdateOther = "UPDATE tk_classes_record SET cr_status = 'yes' WHERE cr_id = '".$rowChangeStatusOther["cr_id"]."'";
                                        $conn->query($qryUpdateOther);
                                    }
                                }

                            }
                        }

                        $sqlGetData = " SELECT * FROM tk_sales_sub WHERE id = '".$row["id"]."' ";
                        $resultGetData = $conn->query($sqlGetData);
                        if ($resultGetData->num_rows > 0) {
                            $rowGettData = $resultGetData->fetch_assoc();
                            /* Save jon details (AC) */
                            $sqlGetJob = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$rowGettData["no2"]."' ";
                            $resultGetJob = $conn->query($sqlGetJob);
                            if ($resultGetJob->num_rows > 0) {
                                $rowGetJob = $resultGetJob->fetch_assoc();
                                
                                $rateTutor = ( (float) filter_var( $rowGetJob['j_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
                                
                                        $Cycle = " SELECT ph_user_id, ph_date, ph_job_id, ph_id, ph_receipt FROM tk_payment_history WHERE ph_user_id='".$rowGetJob['u_id']."' AND ph_job_id ='".$rowGettData["no2"]."' ORDER BY ph_date DESC, ph_id DESC  ";
                                        $resCycle = $conn->query($Cycle); 
                                        if($resCycle->num_rows > 0){
                                            $rowCycle = $resCycle->fetch_assoc();
                                            if( $rowCycle['ph_receipt'] == 'trial' || $rowCycle['ph_receipt'] == 'trial paid' ){
                                                $NoCycle = 'trial paid';
                                            }
                                            else if (strpos($rowCycle['ph_receipt'], 'beginning') !== false) {
                                                $NoCycle = filter_var($rowCycle['ph_receipt'], FILTER_SANITIZE_NUMBER_INT);
                                            }else{
                                                $NoCycle = (((int)$rowCycle['ph_receipt']) + 1);
                                            }
                                        }else{
                                            $NoCycle = '1';
                                        }
                                        
                                        $CycleTutor = " SELECT ph_user_id, ph_date, ph_job_id, ph_id, ph_receipt FROM tk_payment_history WHERE ph_user_id='".$rowGetJob['u_id_tutor']."' AND ph_job_id ='".$rowGettData["no2"]."' ORDER BY ph_date DESC, ph_id DESC  ";
                                        $resCycleTutor = $conn->query($CycleTutor); 
                                        if($resCycleTutor->num_rows > 0){
                                            $rowCycleTutor = $resCycleTutor->fetch_assoc();
                                            if( $rowCycleTutor['ph_receipt'] == 'trial' ){
                                                $NoCycleTutor = 'trial paid';
                                            }
                                            else if (strpos($rowCycleTutor['ph_receipt'], 'beginning') !== false) {
                                                $NoCycleTutor = filter_var($rowCycleTutor['ph_receipt'], FILTER_SANITIZE_NUMBER_INT);
                                            }else{
                                                $NoCycleTutor = (((int)$rowCycleTutor['ph_receipt']) + 1);
                                            }
                                        }else{
                                            $NoCycleTutor = '1';
                                        }
                                $re_JT = $conn -> real_escape_string($rowGetJob['jt_comments']);
                                if( $NoCycle == 'trial paid' ){
                                    $thisAC = trim($rowGettData["no6"])."-Tutor completed ".trim($rowGettData["no10"])." hours for trial session. Payment ".trim($rowGettData["no10"])." hrs x RM".trim($rateTutor)."/hour = RM".trim($_POST["amountPaid"])." made- ".$adminName." - System\r\n".$re_JT;
                                }else{
                                    $thisAC = trim($rowGettData["no6"])."-Tutor completed ".trim($rowGettData["no10"])." hours for cycle #".$NoCycleTutor.". Payment ".trim($rowGettData["no10"])." hrs x RM".trim($rateTutor)."/hour = RM".trim($_POST["amountPaid"])." made- ".$adminName." - System\r\n".$re_JT;
                                }  

                                $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$thisAC."' WHERE jt_j_id = '".$rowGettData["no2"]."' AND jt_id = '".$rowGetJob["jt_id"]."'   ";
                                if ($conn->query($sqlAC) === TRUE) {
                                    //echo "Success";
                                } else {
                                    //echo "Error";
                                }
                                
                            }
                            /* Save jon details (AC) */      
                            echo $row['id'];
                            
                        }else{
                            echo "Error";
                        }
                        
                    } else {
                        echo "Error";
                    }                        
                }else{
                    
                    $string = trim($_POST["note"]);
                    $thisno11 = str_replace(array('<div style="overflow-y: scroll; height:20px;">', '</div>'), '', $string);
                    
                    $Update= " UPDATE tk_sales_sub set no6 = '".trim($_POST["datePaid"])."', no7 = '".trim($_POST["amountPaid"])."', no9 = '".trim($_POST["GrossProfit"])."', no11 = '".$thisno11."' WHERE id = '".$row['id']."'  ";
                    if ($conn->query($Update) === TRUE) {
                        echo "Success";
                    } else {
                        echo "Error";
                    }   
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
