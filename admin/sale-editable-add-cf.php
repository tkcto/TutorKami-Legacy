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
if(!empty($_POST["mainID"])) {
    
    
    if( (isset($_SESSION['tk']['u_id'])) && ($_SESSION['tk']['u_id'] == '1' || $_SESSION['tk']['u_id'] == '8' || $_SESSION['tk']['u_id'] == '1579926' || $_SESSION['tk']['u_id'] == '1581081' || $_SESSION['tk']['u_id'] == '3') ){
        
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
            $header = date('d/m/Y H:i:s')." | ADD (".trim($_POST["btnTab"])." - ".trim($_POST["btnTabMonth"])." - ".trim($_POST["no2"])." ".htmlspecialchars(trim($_POST["no3"]), ENT_QUOTES)." ".trim($_POST["no4"]).") | ".$adminName."\n";
            /*if( $header != '' ){
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
            }*/
            if( $header != '' ){
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
        
        

        if( $_POST["addRowBetween"] == 'Yes' ){
            
            if( $_POST["RFno2"] != '' ){
                $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE main_id = '".$_POST["mainID"]."' AND tab_name = '".$_POST["btnTab"]."' AND month = '".$_POST["btnTabMonth"]."' AND cf >= '".$_POST["row_no"]."' AND row_no = '999999'    ";
                $resultOldNo = $conn->query($OldNo);
                if ($resultOldNo->num_rows > 0) {
                    while($rowOldNo = $resultOldNo->fetch_assoc()){
                        $updateNo = "UPDATE tk_sales_sub SET cf = '".($rowOldNo["cf"]+2)."' WHERE id = '".$rowOldNo["id"]."' ";
                        $conn->query($updateNo);                    
                    }
                }
                $sqlInsert = " INSERT INTO tk_sales_sub (main_id, tab_name, month, row_no, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11, cf) VALUES 
                ('".trim($_POST["mainID"])."', '".trim($_POST["btnTab"])."', '".trim($_POST["btnTabMonth"])."', '999999', '".trim($_POST["no1"])."', '".trim($_POST["no2"])."', '".htmlspecialchars(trim($_POST["no3"]), ENT_QUOTES)."', '".trim($_POST["no4"])."', '".$conn -> real_escape_string(trim($_POST["no5"]))."', '".trim($_POST["no6"])."', '".trim($_POST["no7"])."', '".trim($_POST["no8"])."', '".trim($_POST["no9"])."', '".trim($_POST["no10"])."', '".$conn -> real_escape_string(trim($_POST["no11"]))."', '".$_POST["row_no"]."') ";
                if ( ($conn->query($sqlInsert) === TRUE) ) {
                    $last_id = $conn->insert_id;
                    $sqlInsertRF = " INSERT INTO tk_sales_sub (main_id, tab_name, month, row_no, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11, cf) VALUES 
                    ('".trim($_POST["mainID"])."', '".trim($_POST["btnTab"])."', '".trim($_POST["btnTabMonth"])."', '999999', '".trim($_POST["RFno1"])."', '".trim($_POST["RFno2"])."', '".trim($_POST["RFno3"])."', '".trim($_POST["RFno4"])."', '".$_POST["RFno5"]."', '".trim($_POST["RFno6"])."', '".trim($_POST["RFno7"])."', '".trim($_POST["RFno8"])."', '".trim($_POST["RFno9"])."', '".trim($_POST["RFno10"])."', '".trim($_POST["RFno11"])."', '".trim($_POST["row_no"]+1)."') ";
                    if ( ($conn->query($sqlInsertRF) === TRUE) ) {
$aDate = explode('/',trim($_POST["no1"]));
$my_new_date = '20'.$aDate[2].'-'.$aDate[1].'-'.$aDate[0];
                            /* Save jon details (AC) */
                            if( trim($_POST["no3"]) != 'R.F' ){
                                $sqlGetJob = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".trim($_POST["no2"])."' ";
                                $resultGetJob = $conn->query($sqlGetJob);
                                if ($resultGetJob->num_rows > 0) {
                                    $rowGetJob = $resultGetJob->fetch_assoc();

                                        $Cycle = " SELECT ph_user_id, ph_date, ph_job_id, ph_id, ph_receipt FROM tk_payment_history WHERE ph_user_id='".$rowGetJob['u_id']."' AND ph_job_id ='".trim($_POST["no2"])."' ORDER BY ph_date DESC, ph_id DESC  ";
                                        $resCycle = $conn->query($Cycle); 
                                        if($resCycle->num_rows > 0){
                                            $rowCycle = $resCycle->fetch_assoc();
                                            if( $rowCycle['ph_receipt'] == 'trial' ){
                                                $NoCycle = 'trial paid';
                                            }else if (strpos($rowCycle['ph_receipt'], 'beginning') !== false) {
                                                $NoCycle = filter_var($rowCycle['ph_receipt'], FILTER_SANITIZE_NUMBER_INT);
                                            }else{
                                                $NoCycle = (((int)$rowCycle['ph_receipt']) + 1);
                                            }
                                        }else{
                                            $NoCycle = '1';
                                        } 
                                        
                                        $CycleTutor = " SELECT ph_user_id, ph_date, ph_job_id, ph_id, ph_receipt FROM tk_payment_history WHERE ph_user_id='".$rowGetJob['u_id_tutor']."' AND ph_job_id ='".trim($_POST["no2"])."' ORDER BY ph_date DESC, ph_id DESC  ";
                                        $resCycleTutor = $conn->query($CycleTutor); 
                                        if($resCycleTutor->num_rows > 0){
                                            $rowCycleTutor = $resCycleTutor->fetch_assoc();
                                            if( $rowCycleTutor['ph_receipt'] == 'trial' ){
                                                $NoCycleTutor = 'trial paid';
                                            }else if (strpos($rowCycleTutor['ph_receipt'], 'beginning') !== false) {
                                                $NoCycleTutor = filter_var($rowCycleTutor['ph_receipt'], FILTER_SANITIZE_NUMBER_INT);
                                            }else{
                                                $NoCycleTutor = (((int)$rowCycleTutor['ph_receipt']) + 1);
                                            }
                                        }else{
                                            $NoCycleTutor = '1';
                                        }
                                        
                                		$queryUser = " SELECT * FROM tk_user 
                                		INNER JOIN tk_user_details ON ud_u_id = u_id
                                		WHERE u_email ='".$rowGetJob['j_hired_tutor_email']."' ";
                                		$resultQueryUser = $conn->query($queryUser); 
                                		if($resultQueryUser->num_rows > 0){ 
                                			$rowQueryUser = $resultQueryUser->fetch_assoc();
											$displayname = htmlspecialchars($rowQueryUser['u_displayname'], ENT_QUOTES);
                                		}else{
                                		    $displayname = '';
                                		}
                                		
                                        /* insert payment */
                                        $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) VALUES  
                                        ('4', '".$rowGetJob['u_id']."', '".$my_new_date."', '".trim($_POST["no2"])."', '".$NoCycle."', '".trim($_POST["no4"])."', '".trim($_POST["RFno4"])."', '".trim($_POST["no10"])."', '".$displayname."') ";
                                        $conn->query($insertPayment);
                                        $last_id = $conn->insert_id;
                                        /* insert payment */
                                        
                                        if( $_POST["RFno2"] != '' ){
                                            $thisRate = number_format((($rowGetJob['parent_rate'] * $_POST["no10"]) + $_POST["RFno4"]), 2); 
                                            if( $NoCycle == 'trial paid' ){
                                                $thisAC = trim($_POST["no1"])."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours + RM".trim($_POST["RFno4"])." R.F = RM ".trim($thisRate)." received. Trial receipt issued - ".$conn -> real_escape_string(trim($_POST["no5"]))."\r\n";
                                            }else{
                                                $thisAC = trim($_POST["no1"])."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours + RM".trim($_POST["RFno4"])." R.F = RM ".trim($thisRate)." received. Receipt issued - ".$conn -> real_escape_string(trim($_POST["no5"]))."\r\n";
                                            }
                                        }else{
                                            if( $NoCycle == 'trial paid' ){
                                                $thisAC = trim($_POST["no1"])."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours = RM ".trim($_POST["no4"])." received. Trial receipt issued - ".$conn -> real_escape_string(trim($_POST["no5"]))."\r\n";
                                            }else{
                                                $thisAC = trim($_POST["no1"])."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours = RM ".trim($_POST["no4"])." received. Receipt issued - ".$conn -> real_escape_string(trim($_POST["no5"]))."\r\n";
                                            }
                                        }                
                                        
                                        if( trim($_POST["no6"]) != '' && trim($_POST["no7"]) != '' ){
                                            $rateTutor = ( (float) filter_var( $rowGetJob['j_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
                                            if( $NoCycleTutor == 'trial paid' ){
                                                $thisAC2 = trim($_POST["no6"])."-Tutor completed ".trim($_POST["no10"])." hours for trial session. Payment ".trim($_POST["no10"])." hrs x RM".trim($rateTutor)."/hour = RM".trim($_POST["no7"])." made- ".$conn -> real_escape_string(trim($_POST["no5"]))." - System\r\n";
                                            }else{
                                                $thisAC2 = trim($_POST["no6"])."-Tutor completed ".trim($_POST["no10"])." hours for cycle #".$NoCycleTutor.". Payment ".trim($_POST["no10"])." hrs x RM".trim($rateTutor)."/hour = RM".trim($_POST["no7"])." made- ".$conn -> real_escape_string(trim($_POST["no5"]))." - System\r\n";
                                            }
                                        }else{      
                                            $thisAC2 = "";
                                        }
                                        
                                        $re_JT = $conn -> real_escape_string($rowGetJob['jt_comments']);
                                        $resAC = $thisAC.$thisAC2.$re_JT;
            
                                        $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$resAC."' WHERE jt_j_id = '".trim($_POST["no2"])."' AND jt_id = '".$rowGetJob["jt_id"]."'   ";
                                        $conn->query($sqlAC);
                                    
                                    
                                                                                  
                                                	$queryClasses = " SELECT * FROM tk_classes WHERE cl_display_id='".trim($_POST["no2"])."'  ";
                                                	$resultClasses = $conn->query($queryClasses); 
                                                	if($resultClasses->num_rows > 0){
                                                		$rQClasses = $resultClasses->fetch_assoc();
                                                		
                                                		$UpdateParentBilled = " UPDATE tk_job SET parent_billed = '' WHERE j_id='".trim($_POST["no2"])."' ";
                                                		$conn->query($UpdateParentBilled);
                                                		
                                                
                                                		$queryClassesRecord = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' AND cr_status = 'Required Parent To Pay' ";
                                                		$resultClassesRecord = $conn->query($queryClassesRecord); 
                                                		if($resultClassesRecord->num_rows > 0){
                                                			$rowClassesRecord = $resultClassesRecord->fetch_assoc();
                                                			
                                                					$latestBalance =  $rowClassesRecord['cr_balance'];
                                                					$newBalance = trim($_POST["no10"]) + $latestBalance;
                                                
                                                					if ( $latestBalance < 0 ) {
                                                						$convertNegative = abs($latestBalance);
                                                					
                                                						$balTwoDecimalPlaces = number_format((float)$convertNegative, 2, '.', '');  // Outputs -> 105.00
                                                						$balanceInMinutes = (hoursToMinutes($balTwoDecimalPlaces));
                                                						
                                                						$cycleHourTwoDecimalPlaces = number_format((float)trim($_POST["no10"]), 2, '.', '');  // Outputs -> 105.00
                                                						$cycleHourInMinutes = (hoursToMinutes($cycleHourTwoDecimalPlaces));
                                                						
                                                						$totalBalanceInMin = $cycleHourInMinutes - $balanceInMinutes;
                                                						$newBalance2 = (minutesToHours($totalBalanceInMin));
                                                					}else{
                                                						$findDots = strpos($newBalance, '.');
                                                						if(is_int($findDots)){
                                                						 $getValueAfterDots = substr($newBalance, strrpos($newBalance, '.') + 1);
                                                						 $stringToDigit = (int)$getValueAfterDots;
                                                						 if ( strlen((string)$stringToDigit) == '1' ){
                                                							 if ( $getValueAfterDots >= 6 ){
                                                								 $thisvalue = ($getValueAfterDots - 6);
                                                								 
                                                								 $first = strtok($newBalance, '.');
                                                						
                                                								 $newBalance2 = ((int)$first + 1).'.'.$thisvalue.'0';
                                                								 
                                                							 }else{
                                                								 $newBalance2 = $newBalance;
                                                							 }
                                                						 }else{
                                                							 if ( $getValueAfterDots >= 60 ){
                                                								 $thisvalue = ($getValueAfterDots - 60);
                                                								 
                                                								 $first = strtok($newBalance, '.');
                                                						
                                                								 $newBalance2 = ((int)$first + 1).'.'.$thisvalue;
                                                								 
                                                							 }else{
                                                								 $newBalance2 = $newBalance;
                                                							 }
                                                						 }
                                                						}else{
                                                							$newBalance2 = $newBalance;
                                                						}
                                                					}
                                                
                                                
                                                					$newCycle = $rowClassesRecord['cr_classes'] + 1;
                                                					//$row_no = $rowClassesRecord['row_no'] + 1;
                                                					$row_no = $rowClassesRecord['row_no'];
                                                					$sqlUpdateBalS = " UPDATE tk_classes_record SET cr_cycle = '".trim($_POST["no10"])."', cr_balance = '".(trim($_POST["no10"]) + ($rowClassesRecord['cr_balance']))."',  cr_status = 'new Cycle', row_no = '".$row_no."', cr_classes = '".$newCycle."' WHERE cr_id = '".$rowClassesRecord['cr_id']."' ";
                                                					$conn->query($sqlUpdateBalS);
                                                					
                                                            		$UpdateDueDate = " UPDATE tk_job SET j_end_date = '' WHERE j_id='".trim($_POST["no2"])."' ";
                                                            		$conn->query($UpdateDueDate);
                                                					
                                                					$sqlUpdateBalWhile = " SELECT * FROM tk_classes_record WHERE cr_status = 'new' AND cr_cl_id ='".$rQClasses["cl_id"]."' ";
                                                					$resultsqlUpdateBalWhile = $conn->query($sqlUpdateBalWhile); 
                                                					if($resultsqlUpdateBalWhile->num_rows > 0){
                                                						while($rowUpdateBalWhile= $resultsqlUpdateBalWhile->fetch_assoc()){
                                                							$sqlUpdateBalS = " UPDATE tk_classes_record SET cr_status='yes', cr_classes = '".$newCycle."' WHERE cr_id='".$rowUpdateBalWhile['cr_id']."' ";
                                                							$conn->query($sqlUpdateBalS);
                                                						}
                                                					}
                                                					$sqlUpdateBalWhile2 = " SELECT * FROM tk_classes_record WHERE cr_status = 'Tutor Paid' AND cr_cl_id ='".$rQClasses["cl_id"]."' ORDER BY cr_date DESC  ";
                                                					$resultsqlUpdateBalWhile2 = $conn->query($sqlUpdateBalWhile2); 
                                                					if($resultsqlUpdateBalWhile2->num_rows > 0){
                                                						$rowUpdateBalWhile2= $resultsqlUpdateBalWhile2->fetch_assoc();
                                                							$sqlUpdateBalS2 = " UPDATE tk_classes_record SET cr_classes = '".$newCycle."' WHERE cr_id='".$rowUpdateBalWhile2['cr_id']."' ";
                                                							$conn->query($sqlUpdateBalS2);
                                                					}
                                                					
                                                		$qTutorEmail = $rowGetJob['j_hired_tutor_email'];
                                                		$queryUserT = " SELECT * FROM tk_user WHERE u_email='".$qTutorEmail."'  ";
                                                		$resultQueryUserT = $conn->query($queryUserT); 
                                                		if($resultQueryUserT->num_rows > 0){ 
                                                			$rowQueryUserT = $resultQueryUserT->fetch_assoc();
                                                			$qUserT = $rowQueryUserT['u_id'];
                                                			$u_displayidT = $rowQueryUserT['u_displayname'];
                                                    	
                                                			$queryUserDT = " SELECT * FROM tk_user_details WHERE ud_u_id='".$qUserT."'  ";
                                                			$resultQueryUserDT = $conn->query($queryUserDT); 
                                                			if($resultQueryUserDT->num_rows > 0){ 
                                                				$rowQueryUserDT = $resultQueryUserDT->fetch_assoc();
                                                				$qUserDT = $rowQueryUserDT['ud_phone_number'];
                                                			}
                                                		}
                                                					
                                                					$sqlUpdateBal = " UPDATE tk_classes SET cl_hours_balance='".$newBalance2."',cl_cycle='".trim($_POST["no10"])."'  WHERE cl_id = '".$rQClasses["cl_id"]."' ";
                                                					if($conn->query($sqlUpdateBal)){
                                                					    /*
                                                						$args = new stdClass();
                                                						$xdata = new stdClass();
                                                						$args->to = "6".$qUserDT."@c.us";
                                                						$args->content = "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".trim($_POST["no2"]).". Thank you\r\n- message from Finance Manager TutorKami -\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                                                						$xdata->args = $args;
                                                						
                                                						$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                                                						*/
                                                						$xdata = array( "to" => "6".$qUserDT,
                                                						        "message" => "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".trim($_POST["no2"]).". Thank you newLine - message from Finance Manager TutorKami - newLine (This is an auto message from TutorKami.com. Please do not reply to this number) " );
                                                						$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                                					}
                                                		}
                                                		$queryClassesRecordTP = " SELECT cr_id, cr_cl_id, cr_status, cr_date  FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' AND cr_status = 'Tutor Paid' ORDER BY cr_date DESC ";
                                                		$resultClassesRecordTP = $conn->query($queryClassesRecordTP); 
                                                		if($resultClassesRecordTP->num_rows > 0){
                                                			$rowClassesRecordTP = $resultClassesRecordTP->fetch_assoc();
                                                			
                                                			$queryCekLast = " SELECT cr_id, cr_cl_id, cr_date FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' ORDER BY cr_date DESC ";
                                                			$resultCekLast = $conn->query($queryCekLast); 
                                                			if($resultCekLast->num_rows > 0){
                                                				$rowCekLast = $resultCekLast->fetch_assoc();
                                                				$dataLastRekod = $rowCekLast["cr_id"];
                                                			}else{
                                                				$dataLastRekod = '';
                                                			}
                                                			if( $rowClassesRecordTP["cr_id"] == $dataLastRekod ){
                                                				$thisTemp = 'temp - '.$cl_cycle;
                                                				//$createClass = "INSERT INTO tk_classes_record (cr_cl_id, current_cycle) VALUES ('".$rQClasses["cl_id"]."', '".$thisTemp."') ";
                                                				//$conn->query($createClass);		
                                                			}
                                                		}
                                                		
                                                		
                                                	}else{
                                                
                                                		$qeJob = " SELECT * FROM tk_job WHERE j_id='".trim($_POST["no2"])."'  ";
                                                		$resQueryJob = $conn->query($qeJob); 
                                                		if($resQueryJob->num_rows > 0){
                                                			$rQJob = $resQueryJob->fetch_assoc();
                                                			
                                                			$qParent = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_email']."'  ";
                                                			$rParent = $conn->query($qParent); 
                                                			if($rParent->num_rows > 0){ 
                                                				$rowParent = $rParent->fetch_assoc();
                                                				$thisParent = $rowParent['u_id'];
                                                
                                                			}
                                                			$qTutor = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_hired_tutor_email']."'  ";
                                                			$rTutor = $conn->query($qTutor); 
                                                			if($rTutor->num_rows > 0){ 
                                                				$rowTutor = $rTutor->fetch_assoc();
                                                				$thisutor = $rowTutor['u_id'];
                                                			}
                                                			$qSubject = " SELECT * FROM tk_job_translation WHERE jt_j_id='".trim($_POST["no2"])."'  ";
                                                			$rSubject = $conn->query($qSubject); 
                                                			if($rSubject->num_rows > 0){ 
                                                				$rowSubject = $rSubject->fetch_assoc();
                                                				$thisSubject = $rowSubject['jt_subject'];
                                                			}
                                                			
                                                            $sqlCekKelas = " SELECT * FROM tk_classes WHERE cl_display_id='".trim($_POST["no2"])."' ";
                                                			$resCekKelas = $conn->query($sqlCekKelas); 
                                                			if($resCekKelas->num_rows > 0){
                                                			}else{
                                                				$createClass = "INSERT INTO tk_classes 
                                                				(cl_display_id, cl_student_id, cl_tutor_id, cl_student, cl_subject, cl_rate, cl_charge_parent, cl_hours_balance, cl_cycle, cl_status, cl_country_id, cl_create_date) 
                                                				VALUES 
                                                				('".trim($_POST["no2"])."', '".$thisParent."', '".$thisutor."', '".$rQJob['student_name']."', '".$thisSubject."', '".$rQJob['j_rate']."', '".$rQJob['parent_rate']."', '".$rQJob['cycle']."', '".$rQJob['cycle']."', 'ongoing', '150', '".date('Y-m-d H:i:s')."') ";
                                                				$conn->query($createClass);				
                                                			}
                                                
                                                			$UpdateParentBilled = " UPDATE tk_job SET parent_billed = '' WHERE j_id='".trim($_POST["no2"])."' ";
                                                			$conn->query($UpdateParentBilled);
                                                		}
                                                	}
                                    
      
                                    
                                    
                                    
                                    
                                    
                                    //echo "Success".$last_id;
                                    echo "Success".$last_id;
                                }else{
                                    //echo "Success".$last_id;
                                    echo "Error";
                                }
                            }else{
                                //echo "Success".$last_id;
                                echo "R.F ".$last_id;
                            }
                            /* Save jon details (AC) */
                    }else{
                        echo "Error 1";
                    }
                    
                } else {
                    echo "Error 1";
                }  
            }else{
                $OldNo = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE main_id = '".$_POST["mainID"]."' AND tab_name = '".$_POST["btnTab"]."' AND month = '".$_POST["btnTabMonth"]."' AND cf >= '".$_POST["row_no"]."' AND row_no = '999999'    ";
                $resultOldNo = $conn->query($OldNo);
                if ($resultOldNo->num_rows > 0) {
                    while($rowOldNo = $resultOldNo->fetch_assoc()){
                        $updateNo = "UPDATE tk_sales_sub SET cf = '".($rowOldNo["cf"]+1)."' WHERE id = '".$rowOldNo["id"]."' ";
                        $conn->query($updateNo);                    
                    }
                }
                $sqlInsert = " INSERT INTO tk_sales_sub (main_id, tab_name, month, row_no, no1, no2, no3, no4, no5, no6, no7, no8, no9, no10, no11, cf) VALUES 
                ('".trim($_POST["mainID"])."', '".trim($_POST["btnTab"])."', '".trim($_POST["btnTabMonth"])."', '999999', '".trim($_POST["no1"])."', '".trim($_POST["no2"])."', '".htmlspecialchars(trim($_POST["no3"]), ENT_QUOTES)."', '".trim($_POST["no4"])."', '".$conn -> real_escape_string(trim($_POST["no5"]))."', '".trim($_POST["no6"])."', '".trim($_POST["no7"])."', '".trim($_POST["no8"])."', '".trim($_POST["no9"])."', '".trim($_POST["no10"])."', '".$conn -> real_escape_string(trim($_POST["no11"]))."', '".$_POST["row_no"]."') ";
                if ( ($conn->query($sqlInsert) === TRUE) ) {
                    $last_id = $conn->insert_id;
                        /* Save jon details (AC) */
                        if( trim($_POST["no3"]) != 'R.F' ){
                                $sqlGetJob = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".trim($_POST["no2"])."' ";
                                $resultGetJob = $conn->query($sqlGetJob);
                                if ($resultGetJob->num_rows > 0) {
                                    $rowGetJob = $resultGetJob->fetch_assoc();
                                    
                                    $aDate = explode('/',trim($_POST["no1"]));
                                    $my_new_date = '20'.$aDate[2].'-'.$aDate[1].'-'.$aDate[0];
                                    
                                        $Cycle = " SELECT ph_user_id, ph_date, ph_job_id, ph_id, ph_receipt FROM tk_payment_history WHERE ph_user_id='".$rowGetJob['u_id']."' AND ph_job_id ='".trim($_POST["no2"])."' ORDER BY ph_date DESC, ph_id DESC  ";
                                        $resCycle = $conn->query($Cycle); 
                                        if($resCycle->num_rows > 0){
                                            $rowCycle = $resCycle->fetch_assoc();
                                            if( $rowCycle['ph_receipt'] == 'trial' ){
                                                $NoCycle = 'trial paid';
                                            }else if (strpos($rowCycle['ph_receipt'], 'beginning') !== false) {
                                                $NoCycle = filter_var($rowCycle['ph_receipt'], FILTER_SANITIZE_NUMBER_INT);
                                            }else{
                                                $NoCycle = (((int)$rowCycle['ph_receipt']) + 1);
                                            }
                                        }else{
                                            $NoCycle = '1';
                                        } 

                                        $CycleTutor = " SELECT ph_user_id, ph_date, ph_job_id, ph_id, ph_receipt FROM tk_payment_history WHERE ph_user_id='".$rowGetJob['u_id_tutor']."' AND ph_job_id ='".trim($_POST["no2"])."' ORDER BY ph_date DESC, ph_id DESC  ";
                                        $resCycleTutor = $conn->query($CycleTutor); 
                                        if($resCycleTutor->num_rows > 0){
                                            $rowCycleTutor = $resCycleTutor->fetch_assoc();
                                            if( $rowCycleTutor['ph_receipt'] == 'trial' ){
                                                $NoCycleTutor = 'trial paid';
                                            }else if (strpos($rowCycleTutor['ph_receipt'], 'beginning') !== false) {
                                                $NoCycleTutor = filter_var($rowCycleTutor['ph_receipt'], FILTER_SANITIZE_NUMBER_INT);
                                            }else{
                                                $NoCycleTutor = (((int)$rowCycleTutor['ph_receipt']) + 1);
                                            }
                                        }else{
                                            $NoCycleTutor = '1';
                                        }

                                		$queryUser = " SELECT * FROM tk_user 
                                		INNER JOIN tk_user_details ON ud_u_id = u_id
                                		WHERE u_email ='".$rowGetJob['j_hired_tutor_email']."' ";
                                		$resultQueryUser = $conn->query($queryUser); 
                                		if($resultQueryUser->num_rows > 0){ 
                                			$rowQueryUser = $resultQueryUser->fetch_assoc();
											$displayname = htmlspecialchars($rowQueryUser['u_displayname'], ENT_QUOTES);
                                		}else{
                                		    $displayname = '';
                                		}     
                                		
                                        /* insert payment */
                                        $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) VALUES  
                                        ('4', '".$rowGetJob['u_id']."', '".$my_new_date."', '".trim($_POST["no2"])."', '".$NoCycle."', '".trim($_POST["no4"])."', '".trim($_POST["RFno4"])."', '".trim($_POST["no10"])."', '".$displayname."') ";
                                        $conn->query($insertPayment);
                                        $last_id = $conn->insert_id;
                                        /* insert payment */   
                                        
                                    if( $_POST["RFno2"] != '' ){
                                        $thisRate = number_format((($rowGetJob['parent_rate'] * $_POST["no10"]) + $_POST["RFno4"]), 2);  
                                        if( $NoCycle == 'trial paid' ){
                                            $thisAC = trim($_POST["no1"])."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours + RM".trim($_POST["RFno4"])." R.F = RM ".trim($thisRate)." received. Trial receipt issued - ".$conn -> real_escape_string(trim($_POST["no5"]))."\r\n";
                                        }else{
                                            $thisAC = trim($_POST["no1"])."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours + RM".trim($_POST["RFno4"])." R.F = RM ".trim($thisRate)." received. Receipt issued - ".$conn -> real_escape_string(trim($_POST["no5"]))."\r\n";
                                        }
                                    }else{
                                        if( $NoCycle == 'trial paid' ){
                                            $thisAC = trim($_POST["no1"])."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours = RM ".trim($_POST["no4"])." received. Trial receipt issued - ".$conn -> real_escape_string(trim($_POST["no5"]))."\r\n";
                                        }else{
                                            $thisAC = trim($_POST["no1"])."-Payment RM".trim($rowGetJob['parent_rate'])."/hour x ".trim($_POST["no10"])." hours = RM ".trim($_POST["no4"])." received. Receipt issued - ".$conn -> real_escape_string(trim($_POST["no5"]))."\r\n";
                                        }
                                    }                
                                        
                                    if( trim($_POST["no6"]) != '' && trim($_POST["no7"]) != '' ){
                                        $rateTutor = ( (float) filter_var( $rowGetJob['j_rate'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
                                        if( $NoCycleTutor == 'trial paid' ){
                                            $thisAC2 = trim($_POST["no6"])."-Tutor completed ".trim($_POST["no10"])." hours for trial session. Payment ".trim($_POST["no10"])." hrs x RM".trim($rateTutor)."/hour = RM".trim($_POST["no7"])." made- ".$conn -> real_escape_string(trim($_POST["no5"]))." - System\r\n";
                                        }else{
                                            $thisAC2 = trim($_POST["no6"])."-Tutor completed ".trim($_POST["no10"])." hours for cycle #".$NoCycleTutor.". Payment ".trim($_POST["no10"])." hrs x RM".trim($rateTutor)."/hour = RM".trim($_POST["no7"])." made- ".$conn -> real_escape_string(trim($_POST["no5"]))." - System\r\n";
                                        }
                                    }else{      
                                        $thisAC2 = "";
                                    }
                                    
                                    $re_JT = $conn -> real_escape_string($rowGetJob['jt_comments']);
                                    $resAC = $thisAC.$thisAC2.$re_JT;
            
                                    $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$resAC."' WHERE jt_j_id = '".trim($_POST["no2"])."' AND jt_id = '".$rowGetJob["jt_id"]."'   ";
                                    $conn->query($sqlAC);
                                    
                                                                                  
                                                	$queryClasses = " SELECT * FROM tk_classes WHERE cl_display_id='".trim($_POST["no2"])."'  ";
                                                	$resultClasses = $conn->query($queryClasses); 
                                                	if($resultClasses->num_rows > 0){
                                                		$rQClasses = $resultClasses->fetch_assoc();
                                                		
                                                		$UpdateParentBilled = " UPDATE tk_job SET parent_billed = '' WHERE j_id='".trim($_POST["no2"])."' ";
                                                		$conn->query($UpdateParentBilled);
                                                		
                                                
                                                		$queryClassesRecord = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' AND cr_status = 'Required Parent To Pay' ";
                                                		$resultClassesRecord = $conn->query($queryClassesRecord); 
                                                		if($resultClassesRecord->num_rows > 0){
                                                			$rowClassesRecord = $resultClassesRecord->fetch_assoc();
                                                			
                                                					$latestBalance =  $rowClassesRecord['cr_balance'];
                                                					$newBalance = trim($_POST["no10"]) + $latestBalance;
                                                
                                                					if ( $latestBalance < 0 ) {
                                                						$convertNegative = abs($latestBalance);
                                                					
                                                						$balTwoDecimalPlaces = number_format((float)$convertNegative, 2, '.', '');  // Outputs -> 105.00
                                                						$balanceInMinutes = (hoursToMinutes($balTwoDecimalPlaces));
                                                						
                                                						$cycleHourTwoDecimalPlaces = number_format((float)trim($_POST["no10"]), 2, '.', '');  // Outputs -> 105.00
                                                						$cycleHourInMinutes = (hoursToMinutes($cycleHourTwoDecimalPlaces));
                                                						
                                                						$totalBalanceInMin = $cycleHourInMinutes - $balanceInMinutes;
                                                						$newBalance2 = (minutesToHours($totalBalanceInMin));
                                                					}else{
                                                						$findDots = strpos($newBalance, '.');
                                                						if(is_int($findDots)){
                                                						 $getValueAfterDots = substr($newBalance, strrpos($newBalance, '.') + 1);
                                                						 $stringToDigit = (int)$getValueAfterDots;
                                                						 if ( strlen((string)$stringToDigit) == '1' ){
                                                							 if ( $getValueAfterDots >= 6 ){
                                                								 $thisvalue = ($getValueAfterDots - 6);
                                                								 
                                                								 $first = strtok($newBalance, '.');
                                                						
                                                								 $newBalance2 = ((int)$first + 1).'.'.$thisvalue.'0';
                                                								 
                                                							 }else{
                                                								 $newBalance2 = $newBalance;
                                                							 }
                                                						 }else{
                                                							 if ( $getValueAfterDots >= 60 ){
                                                								 $thisvalue = ($getValueAfterDots - 60);
                                                								 
                                                								 $first = strtok($newBalance, '.');
                                                						
                                                								 $newBalance2 = ((int)$first + 1).'.'.$thisvalue;
                                                								 
                                                							 }else{
                                                								 $newBalance2 = $newBalance;
                                                							 }
                                                						 }
                                                						}else{
                                                							$newBalance2 = $newBalance;
                                                						}
                                                					}
                                                
                                                
                                                					$newCycle = $rowClassesRecord['cr_classes'] + 1;
                                                					//$row_no = $rowClassesRecord['row_no'] + 1;
                                                					$row_no = $rowClassesRecord['row_no'];
                                                					$sqlUpdateBalS = " UPDATE tk_classes_record SET cr_cycle = '".trim($_POST["no10"])."', cr_balance = '".(trim($_POST["no10"]) + ($rowClassesRecord['cr_balance']))."',  cr_status = 'new Cycle', row_no = '".$row_no."', cr_classes = '".$newCycle."' WHERE cr_id = '".$rowClassesRecord['cr_id']."' ";
                                                					$conn->query($sqlUpdateBalS);
                                                					
                                                            		$UpdateDueDate = " UPDATE tk_job SET j_end_date = '' WHERE j_id='".trim($_POST["no2"])."' ";
                                                            		$conn->query($UpdateDueDate);
                                                					
                                                					$sqlUpdateBalWhile = " SELECT * FROM tk_classes_record WHERE cr_status = 'new' AND cr_cl_id ='".$rQClasses["cl_id"]."' ";
                                                					$resultsqlUpdateBalWhile = $conn->query($sqlUpdateBalWhile); 
                                                					if($resultsqlUpdateBalWhile->num_rows > 0){
                                                						while($rowUpdateBalWhile= $resultsqlUpdateBalWhile->fetch_assoc()){
                                                							$sqlUpdateBalS = " UPDATE tk_classes_record SET cr_status='yes', cr_classes = '".$newCycle."' WHERE cr_id='".$rowUpdateBalWhile['cr_id']."' ";
                                                							$conn->query($sqlUpdateBalS);
                                                						}
                                                					}
                                                					$sqlUpdateBalWhile2 = " SELECT * FROM tk_classes_record WHERE cr_status = 'Tutor Paid' AND cr_cl_id ='".$rQClasses["cl_id"]."' ORDER BY cr_date DESC  ";
                                                					$resultsqlUpdateBalWhile2 = $conn->query($sqlUpdateBalWhile2); 
                                                					if($resultsqlUpdateBalWhile2->num_rows > 0){
                                                						$rowUpdateBalWhile2= $resultsqlUpdateBalWhile2->fetch_assoc();
                                                							$sqlUpdateBalS2 = " UPDATE tk_classes_record SET cr_classes = '".$newCycle."' WHERE cr_id='".$rowUpdateBalWhile2['cr_id']."' ";
                                                							$conn->query($sqlUpdateBalS2);
                                                					}
                                                					
                                                		$qTutorEmail = $rowGetJob['j_hired_tutor_email'];
                                                		$queryUserT = " SELECT * FROM tk_user WHERE u_email='".$qTutorEmail."'  ";
                                                		$resultQueryUserT = $conn->query($queryUserT); 
                                                		if($resultQueryUserT->num_rows > 0){ 
                                                			$rowQueryUserT = $resultQueryUserT->fetch_assoc();
                                                			$qUserT = $rowQueryUserT['u_id'];
                                                			$u_displayidT = $rowQueryUserT['u_displayname'];
                                                    	
                                                			$queryUserDT = " SELECT * FROM tk_user_details WHERE ud_u_id='".$qUserT."'  ";
                                                			$resultQueryUserDT = $conn->query($queryUserDT); 
                                                			if($resultQueryUserDT->num_rows > 0){ 
                                                				$rowQueryUserDT = $resultQueryUserDT->fetch_assoc();
                                                				$qUserDT = $rowQueryUserDT['ud_phone_number'];
                                                			}
                                                		}
                                                					
                                                					$sqlUpdateBal = " UPDATE tk_classes SET cl_hours_balance='".$newBalance2."',cl_cycle='".trim($_POST["no10"])."'  WHERE cl_id = '".$rQClasses["cl_id"]."' ";
                                                					if($conn->query($sqlUpdateBal)){
                                                					    /*
                                                						$args = new stdClass();
                                                						$xdata = new stdClass();
                                                						$args->to = "6".$qUserDT."@c.us";
                                                						$args->content = "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".trim($_POST["no2"]).". Thank you\r\n- message from Finance Manager TutorKami -\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                                                						$xdata->args = $args;
                                                						
                                                						$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );  
                                                						*/
                                                						$xdata = array( "to" => "6".$qUserDT,
                                                						        "message" => "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".trim($_POST["no2"]).". Thank you newLine - message from Finance Manager TutorKami - newLine (This is an auto message from TutorKami.com. Please do not reply to this number) " );
                                                						$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                                					}
                                                		}
                                                		$queryClassesRecordTP = " SELECT cr_id, cr_cl_id, cr_status, cr_date  FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' AND cr_status = 'Tutor Paid' ORDER BY cr_date DESC ";
                                                		$resultClassesRecordTP = $conn->query($queryClassesRecordTP); 
                                                		if($resultClassesRecordTP->num_rows > 0){
                                                			$rowClassesRecordTP = $resultClassesRecordTP->fetch_assoc();
                                                			
                                                			$queryCekLast = " SELECT cr_id, cr_cl_id, cr_date FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' ORDER BY cr_date DESC ";
                                                			$resultCekLast = $conn->query($queryCekLast); 
                                                			if($resultCekLast->num_rows > 0){
                                                				$rowCekLast = $resultCekLast->fetch_assoc();
                                                				$dataLastRekod = $rowCekLast["cr_id"];
                                                			}else{
                                                				$dataLastRekod = '';
                                                			}
                                                			if( $rowClassesRecordTP["cr_id"] == $dataLastRekod ){
                                                				$thisTemp = 'temp - '.$cl_cycle;
                                                				//$createClass = "INSERT INTO tk_classes_record (cr_cl_id, current_cycle) VALUES ('".$rQClasses["cl_id"]."', '".$thisTemp."') ";
                                                				//$conn->query($createClass);		
                                                			}
                                                		}
                                                		
                                                		
                                                	}else{
                                                
                                                		$qeJob = " SELECT * FROM tk_job WHERE j_id='".trim($_POST["no2"])."'  ";
                                                		$resQueryJob = $conn->query($qeJob); 
                                                		if($resQueryJob->num_rows > 0){
                                                			$rQJob = $resQueryJob->fetch_assoc();
                                                			
                                                			$qParent = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_email']."'  ";
                                                			$rParent = $conn->query($qParent); 
                                                			if($rParent->num_rows > 0){ 
                                                				$rowParent = $rParent->fetch_assoc();
                                                				$thisParent = $rowParent['u_id'];
                                                
                                                			}
                                                			$qTutor = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_hired_tutor_email']."'  ";
                                                			$rTutor = $conn->query($qTutor); 
                                                			if($rTutor->num_rows > 0){ 
                                                				$rowTutor = $rTutor->fetch_assoc();
                                                				$thisutor = $rowTutor['u_id'];
                                                			}
                                                			$qSubject = " SELECT * FROM tk_job_translation WHERE jt_j_id='".trim($_POST["no2"])."'  ";
                                                			$rSubject = $conn->query($qSubject); 
                                                			if($rSubject->num_rows > 0){ 
                                                				$rowSubject = $rSubject->fetch_assoc();
                                                				$thisSubject = $rowSubject['jt_subject'];
                                                			}
                                                			
                                                            $sqlCekKelas = " SELECT * FROM tk_classes WHERE cl_display_id='".trim($_POST["no2"])."' ";
                                                			$resCekKelas = $conn->query($sqlCekKelas); 
                                                			if($resCekKelas->num_rows > 0){
                                                			}else{
                                                				$createClass = "INSERT INTO tk_classes 
                                                				(cl_display_id, cl_student_id, cl_tutor_id, cl_student, cl_subject, cl_rate, cl_charge_parent, cl_hours_balance, cl_cycle, cl_status, cl_country_id, cl_create_date) 
                                                				VALUES 
                                                				('".trim($_POST["no2"])."', '".$thisParent."', '".$thisutor."', '".$rQJob['student_name']."', '".$thisSubject."', '".$rQJob['j_rate']."', '".$rQJob['parent_rate']."', '".$rQJob['cycle']."', '".$rQJob['cycle']."', 'ongoing', '150', '".date('Y-m-d H:i:s')."') ";
                                                				$conn->query($createClass);				
                                                			}
                                                
                                                			$UpdateParentBilled = " UPDATE tk_job SET parent_billed = '' WHERE j_id='".trim($_POST["no2"])."' ";
                                                			$conn->query($UpdateParentBilled);
                                                		}
                                                	}
                                    
      
                                    
                                    
                                    //echo "Success".$last_id;
                                    echo "Success".$last_id;
                                }else{
                                    //echo "Success".$last_id;
                                    echo "Error";
                                }
                        }else{
                            //echo "Success".$last_id;
                            echo "R.F ".$last_id;
                        }
                        /* Save jon details (AC) */
                } else {
                    echo "Error 1";
                }                
            }
        
        }else{
            
        }
    }else{
        echo "session";
    }
}else{
   echo "Error 3"; 
}
?>

