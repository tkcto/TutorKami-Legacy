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
    // Transform hours like "1:45" into the total number of minutes, "105". 
    function hoursToMinutes($hours) 
    { 
        $minutes = 0; 
        if (strpos($hours, ':') !== false) 
        { 
            // Split hours and minutes. 
            list($hours, $minutes) = explode(':', $hours); 
        } 
        return $hours * 60 + $minutes; 
    } 
    
    // Transform minutes like "105" into hours like "1:45". 
    function minutesToHours($minutes) 
    { 
        $hours = (int)($minutes / 60); 
        $minutes -= $hours * 60; 
        return sprintf("%d.%02.0f", $hours, $minutes); 
    } 
	
	function convertToHoursMins($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}

if(isset($_POST['data'])){
    $data = $_POST['data'];

    $res = explode("/", $data["date"]);
    $newDate = $res[2]."-".$res[1]."-".$res[0];

    //$newStartTime = str_replace(' ', '', $data['startTime']);
    $newStartTime = $data['startTime'];
    

        //$tetData = $newDate.' | '.$newStartTime.' | '.$data['endTime'].' | '.$data['duration'].' | '.$data['tutorRemark'].' | '.$data['parentVer'].' | '.$data['parentRemark'].' | '.$newCurrBalance;
        //echo $tetData;
		/*$sqlInsert = "UPDATE tk_classes_record SET invoice='".$tetData."' WHERE cr_id='".$data['cr_id']."'";*/
		
		if( $data['parentVer'] == 'done' ){
		    $HistoryVer = " SELECT cr_id, cr_parent_verification FROM tk_classes_record WHERE cr_id = '".$data['cr_id']."' ";
		    $reHistoryVer = $conn->query($HistoryVer);
		    if ($reHistoryVer->num_rows > 0) {
                $roHistoryVer = $reHistoryVer->fetch_assoc();
                if( $roHistoryVer["cr_parent_verification"] == 'notdone' ){
                      $parentVer = 'done (Admin)';          
                }else{
                    $parentVer = $data['parentVer'];
                }
		    }else{
		        $parentVer = $data['parentVer'];
		    }
		}else{
		    $parentVer = $data['parentVer'];
		}
		
		$sqlInsert = "UPDATE tk_classes_record SET cr_date='".$newDate."', cr_start_time='".$newStartTime."', cr_end_time='".$data['endTime']."', cr_duration='".$data['duration']."', cr_tutor_report='".$data['tutorRemark']."', cr_parent_verification='".$parentVer."', cr_parent_remark='".$data['parentRemark']."' WHERE cr_id='".$data['cr_id']."'";
        if ( ($conn->query($sqlInsert) === TRUE) ) {
            
            
                    $GetCurrCycle = " SELECT cl_id, cl_cycle FROM tk_classes WHERE cl_id = '".$data['cr_cl_id']."' ";
                    $reGetCurrCycle = $conn->query($GetCurrCycle);
                    if ($reGetCurrCycle->num_rows > 0) {
                        $roGetCurrCycle = $reGetCurrCycle->fetch_assoc();
                            $currCycle = $roGetCurrCycle["cl_cycle"];
                    }
                    
                    $GetRowNo = " SELECT cr_id, row_no FROM tk_classes_record WHERE cr_id = '".$data['cr_id']."' ";
                    $reGetRowNo = $conn->query($GetRowNo);
                    if ($reGetRowNo->num_rows > 0) {
                        $roGetRowNo = $reGetRowNo->fetch_assoc();
                            $currRowNo = $roGetRowNo["row_no"];
                    }
                    
                    $row = 1;
                    $adaNegative = 0;
                    $thisStatus = false;
                    $RekodKelas = " SELECT * FROM tk_classes_record WHERE cr_cl_id = '".$data["cr_cl_id"]."' AND row_no = '".$currRowNo."' ORDER BY cr_date ASC, cr_start_time ASC ";
                    $reRekodKelas = $conn->query($RekodKelas);
                    if ($reRekodKelas->num_rows > 0) {
                        while($roRekodKelas = $reRekodKelas->fetch_assoc()){
                            
                            if($row == 1) {
                                if( $roRekodKelas['cr_status'] == 'new Cycle' ){
            
                        								$balanceLastRecord = number_format(($currCycle), 2); 
                        								if( $balanceLastRecord < 0 ){
                        									$replaceNegative = str_replace("-","",$balanceLastRecord);
                        									$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
                        									$convert = hoursToMinutes($balanceLastRecord1);
                        									$balanceLastRecord2 = '-'.$convert;
                        								}else{
                        									$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
                        									$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
                        								}	
                        								
                        								$classDuration =  str_replace(" hours & ", ":", $roRekodKelas['cr_duration']);
                        								$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
                        								$classBalance2 = (hoursToMinutes($replaceClassDuration));	
                        
                        								$dataClassBalance = ($balanceLastRecord2 - $classBalance2);
                        								
                        								if( $dataClassBalance >= 0 ){
                        										$currBalance = (minutesToHours($dataClassBalance));
                        										$newBalanceAfterCal = '0'.$currBalance;	
                        										if( $newBalanceAfterCal == '00.00' ){
                        											$thisStatus = true;
                        											$adaNegative++;
                        										}
                        								}else{
                        										$dataBalanceReplace = str_replace("-","",$dataClassBalance);
                        										$currBalance = (minutesToHours($dataBalanceReplace));	
                        										$newBalanceAfterCal = '-0'.$currBalance;
                        										$adaNegative == 1;
                        										$adaNegative++;
                        				
                        								}
                        								
                        								if( $adaNegative == 0 ){
                        									if( $thisStatus == true ){
                        										$status = 'FM to pay tutor';
                        									}else{
                        										$status = 'new';
                        									}
                        								}else if( $adaNegative == 1 ){
                        									$status = 'FM to pay tutor';
                        								}else if( $adaNegative == 2 ){
                        									$status = 'Required Parent To Pay';
                        								}else{
                        									$status = 'Error..';
                        								}
                        								$sqlUpdateAll = " UPDATE tk_classes_record SET cr_cycle = '".$balanceLastRecord."', cr_balance = '".$newBalanceAfterCal."', cr_status = 'new Cycle' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
                        								$conn->query($sqlUpdateAll);
                                }else{
            
                        								$balanceLastRecord = number_format(($currCycle), 2);
                        								if( $balanceLastRecord < 0 ){
                        									$replaceNegative = str_replace("-","",$balanceLastRecord);
                        									$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
                        									$convert = hoursToMinutes($balanceLastRecord1);
                        									$balanceLastRecord2 = '-'.$convert;
                        								}else{
                        									$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
                        									$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
                        								}	
                        								
                        								$classDuration =  str_replace(" hours & ", ":", $roRekodKelas['cr_duration']);
                        								$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
                        								$classBalance2 = (hoursToMinutes($replaceClassDuration));	
                        
                        								$dataClassBalance = ($balanceLastRecord2 - $classBalance2);
                        								
                        								if( $dataClassBalance >= 0 ){
                        										$currBalance = (minutesToHours($dataClassBalance));
                        										$newBalanceAfterCal = '0'.$currBalance;	
                        										if( $newBalanceAfterCal == '00.00' ){
                        											$thisStatus = true;
                        											$adaNegative++;
                        										}
                        								}else{
                        										$dataBalanceReplace = str_replace("-","",$dataClassBalance);
                        										$currBalance = (minutesToHours($dataBalanceReplace));	
                        										$newBalanceAfterCal = '-0'.$currBalance;
                        										$adaNegative == 1;
                        										$adaNegative++;
                        				
                        								}
                        								
                        								if( $adaNegative == 0 ){
                        									if( $thisStatus == true ){
                        										$status = 'FM to pay tutor';
                        									}else{
                        										$status = 'new';
                        									}
                        								}else if( $adaNegative == 1 ){
                        									$status = 'FM to pay tutor';
                        								}else if( $adaNegative == 2 ){
                        									$status = 'Required Parent To Pay';
                        								}else{
                        									$status = 'Error..';
                        								}
                        								$sqlUpdateAll = " UPDATE tk_classes_record SET cr_cycle = '".$balanceLastRecord."', cr_balance = '".$newBalanceAfterCal."', cr_status = '".$status."' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
                        								$conn->query($sqlUpdateAll);
                                }
                            }else{
            
            								if( $balanceLastRecord < 0 ){
            									$replaceNegative = str_replace("-","",$balanceLastRecord);
            									$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
            									$convert = hoursToMinutes($balanceLastRecord1);
            									$balanceLastRecord2 = '-'.$convert;
            								}else{
            									$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
            									$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
            								}	
            								
            								$classDuration =  str_replace(" hours & ", ":", $roRekodKelas['cr_duration']);
            								$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
            								$classBalance2 = (hoursToMinutes($replaceClassDuration));	
            
            								$dataClassBalance = ($balanceLastRecord2 - $classBalance2);
            								
            								if( $dataClassBalance >= 0 ){
            										$currBalance = (minutesToHours($dataClassBalance));
            										$newBalanceAfterCal = '0'.$currBalance;	
            										if( $newBalanceAfterCal == '00.00' ){
            											$thisStatus = true;
            											$adaNegative++;
            										}
            								}else{	
            										$dataBalanceReplace = str_replace("-","",$dataClassBalance);
            										$currBalance = (minutesToHours($dataBalanceReplace));	
            										$newBalanceAfterCal = '-0'.$currBalance;
            										$adaNegative == 1;
            										$adaNegative++;
            				
            								}
            								
            								if( $adaNegative == 0 ){
            									if( $thisStatus == true ){
            										$status = 'FM to pay tutor';
            									}else{
            										$status = 'new';
            									}
            								}else if( $adaNegative == 1 ){
            									$status = 'FM to pay tutor';
            								}else if( $adaNegative == 2 ){
            									$status = 'Required Parent To Pay';
            								}else{
            									$status = 'Error..';
            								}
            								$sqlUpdateAll = " UPDATE tk_classes_record SET cr_cycle = '".$balanceLastRecord."', cr_balance = '".$newBalanceAfterCal."', cr_status = '".$status."' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
            								$conn->query($sqlUpdateAll);
                            }
                            
                        $row++;
                        $balanceLastRecord = $newBalanceAfterCal;
                        }
                    }
                    
                    if( $currRowNo > 1 ){
                        $Update1stRekodKelas = " SELECT * FROM tk_classes_record WHERE cr_cl_id = '".$data["cr_cl_id"]."' AND row_no = '".$currRowNo."' ORDER BY cr_date ASC, cr_start_time ASC ";
                        $reUpdate1stRekodKelas = $conn->query($Update1stRekodKelas);
                        if ($reUpdate1stRekodKelas->num_rows > 0) {
                            $roUpdate1stRekodKelas = $reUpdate1stRekodKelas->fetch_assoc();
                                $sqlUpdateAll = " UPDATE tk_classes_record SET cr_status = 'new Cycle' WHERE cr_id = '".$roUpdate1stRekodKelas["cr_id"]."' ";
                                $conn->query($sqlUpdateAll);
                        }
                    }
                    
                    $sqlBalance = " UPDATE tk_classes SET cl_hours_balance='".$newBalanceAfterCal."', cl_cycle='".$currCycle."' WHERE cl_id='".$data['cr_cl_id']."' ";
                    if ( ($conn->query($sqlBalance) === TRUE) ) {
                        echo "Record Has Been Updated";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

        
        
        
        
        
        
        
    
/*
    $queryLastRecord = " SELECT * FROM tk_classes WHERE cl_id='".$data['cr_cl_id']."' ";
    $resultLastRecord = $conn->query($queryLastRecord);
    if ($resultLastRecord->num_rows > 0) {
        if($rowLastRecord = $resultLastRecord->fetch_assoc()) {
            $balanceLastRecord = number_format(($rowLastRecord["cl_hours_balance"]), 2); 
			if( $balanceLastRecord < 0 ){
				$replaceNegative = str_replace("-","",$balanceLastRecord);
				$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
				$convert = hoursToMinutes($balanceLastRecord1);
				$balanceLastRecord2 = '-'.$convert;
			}else{
			   	$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
				$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
			}
        }
    }

    $queryGetThisRecord = " SELECT * FROM tk_classes_record WHERE cr_id='".$data['cr_id']."' ";
    $resultGetThisRecord = $conn->query($queryGetThisRecord);
    if ($resultGetThisRecord->num_rows > 0) {
        if($rowGetThisRecord = $resultGetThisRecord->fetch_assoc()) {
			$currentCycle =  $rowGetThisRecord["cr_classes"];
            $mainId    =  $rowGetThisRecord["cr_id"];
            $secId     =  $rowGetThisRecord["cr_cl_id"];
            $startTime =  $rowGetThisRecord["cr_start_time"];
            $endTime   =  $rowGetThisRecord["cr_end_time"];
            $duration  =  $rowGetThisRecord["cr_duration"];
						
			$classDuration =  str_replace(" hours & ", ":", $rowGetThisRecord['cr_duration']);
			$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
			$classBalance2 = (hoursToMinutes($replaceClassDuration));	

			$dataClassBalance = ($balanceLastRecord2 + $classBalance2);
			
			$keyInRepDuration =  str_replace(" hours & ", ":", $data['duration']);
			$keyInDuration =  str_replace(" minutes", "", $keyInRepDuration);
			$inputDurationInMin = (hoursToMinutes($keyInDuration));	
			
			if( $dataClassBalance >= 0 ){
				$currentBalanceInMinit = ($dataClassBalance - $inputDurationInMin);
				if( $currentBalanceInMinit >= 0){
					$currBalance = (minutesToHours($currentBalanceInMinit));
					$newCurrBalance = $currBalance;			
					if( $newCurrBalance == '0.00'){
						$status = 'FM to pay tutor';
					}else{
						$status = 'new';
					}
				}else{
					$dataBalanceReplace = str_replace("-","",$currentBalanceInMinit);
					$currBalance = (minutesToHours($dataBalanceReplace));	
					$newCurrBalance = '-'.$currBalance;
					if( $newCurrBalance < 0 ){
						$status = 'Required Parent To Pay';
					}
				}
			}else{
				$currentBalanceInMinit = ($dataClassBalance - $inputDurationInMin);
				$dataBalanceReplace = str_replace("-","",$currentBalanceInMinit);
				$currBalance = (minutesToHours($dataBalanceReplace));
				$newCurrBalance = '-'.$currBalance;
				if( $newCurrBalance < 0 ){
					$status = 'Required Parent To Pay';
				}
			}
			
			//$queryAllRecord = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$secId."' AND ( cr_status !='yes' AND cr_status !='Tutor Paid' AND cr_status !='new Cycle' ) ORDER BY cr_id DESC ";
			$queryAllRecord = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$secId."' AND cr_classes='".$currentCycle."' AND cr_status !='new Cycle' ORDER BY cr_date DESC, cr_start_time DESC ";
			$resultAllRecord = $conn->query($queryAllRecord);
			if ($resultAllRecord->num_rows > 0) {
				while($rowGetThisRecord = $resultAllRecord->fetch_assoc()) {
					$updateStatus = " UPDATE tk_classes_record SET cr_status='new' WHERE cr_id='".$rowGetThisRecord["cr_id"]."' ";
					$conn->query($updateStatus);
				}	
				if( $status == 'FM to pay tutor' ){
					$queryAllRecord2 = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$secId."' AND cr_classes='".$currentCycle."' AND cr_status !='new Cycle' ORDER BY cr_date DESC, cr_start_time DESC LIMIT 1 ";
					$resultAllRecord2 = $conn->query($queryAllRecord2);
					if ($resultAllRecord2->num_rows > 0) {
						$rowGetThisRecord2 = $resultAllRecord2->fetch_assoc();
							$updateStatus = " UPDATE tk_classes_record SET cr_status='FM to pay tutor' WHERE cr_id='".$rowGetThisRecord2["cr_id"]."' ";
							$conn->query($updateStatus);
					}
				}
				if( $status == 'Required Parent To Pay' ){
					$queryAllRecord2 = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$secId."' AND cr_classes='".$currentCycle."' AND cr_status !='new Cycle' ORDER BY cr_date DESC, cr_start_time DESC LIMIT 1 ";
					$resultAllRecord2 = $conn->query($queryAllRecord2);
					if ($resultAllRecord2->num_rows > 0) {
						$rowGetThisRecord2 = $resultAllRecord2->fetch_assoc();
							$updateStatus = " UPDATE tk_classes_record SET cr_status='Required Parent To Pay' WHERE cr_id='".$rowGetThisRecord2["cr_id"]."' ";
							$conn->query($updateStatus);
					}
					$queryAllRecord3 = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$secId."' AND cr_classes='".$currentCycle."' AND cr_status !='new Cycle' ORDER BY cr_date DESC, cr_start_time DESC LIMIT 1,1 ";
					$resultAllRecord3 = $conn->query($queryAllRecord3);
					if ($resultAllRecord3->num_rows > 0) {
						$rowGetThisRecord3 = $resultAllRecord3->fetch_assoc();
							$updateStatus = " UPDATE tk_classes_record SET cr_status='FM to pay tutor' WHERE cr_id='".$rowGetThisRecord3["cr_id"]."' ";
							$conn->query($updateStatus);
					}
				}
				
			}
			
			
		
        }
    }

		$sqlInsert = "UPDATE tk_classes_record SET cr_date='".$newDate."', cr_start_time='".$newStartTime."', cr_end_time='".$data['endTime']."', cr_duration='".$data['duration']."', cr_tutor_report='".$data['tutorRemark']."', cr_parent_verification='".$data['parentVer']."', cr_parent_remark='".$data['parentRemark']."', cr_balance='".$newCurrBalance."' WHERE cr_id='".$data['cr_id']."'";
        $sqlBalance = " UPDATE tk_classes SET cl_hours_balance='".$newCurrBalance."' WHERE cl_id='".$data['cr_cl_id']."' ";

        if ( ($conn->query($sqlInsert) === TRUE) && ($conn->query($sqlBalance) === TRUE) ) {
			echo "Record Has Been Updated";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
        exit();
*/

			
    
}








if(isset($_POST['dataDelete'])){
	$dataDelete = $_POST['dataDelete'];
	
	$sql2 = "DELETE FROM tk_classes_record WHERE cr_cl_id='".$dataDelete['id']."'";
	$sql = "DELETE FROM tk_classes WHERE cl_id='".$dataDelete['id']."'";
	
	if (($conn->query($sql) === TRUE) && ($conn->query($sql2) === TRUE)) {
		echo "Data Has Been Deleted";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	} /*echo $dataDelete['id'];*/
	
}

if(isset($_POST['dataDeleteClassesRecord'])){
    $dataDeleteClassesRecord = $_POST['dataDeleteClassesRecord'];
    
    $queryGetStartEndTime = " SELECT * FROM tk_classes_record WHERE cr_id='".$dataDeleteClassesRecord['id']."' ";
    $resulGetStartEndTime = $conn->query($queryGetStartEndTime);
    if ($resulGetStartEndTime->num_rows > 0) {
        $rowGetStartEndTime = $resulGetStartEndTime->fetch_assoc();
            $mainId    =  $rowGetStartEndTime["cr_id"];
            $secId     =  $rowGetStartEndTime["cr_cl_id"];
            $startTime =  $rowGetStartEndTime["cr_start_time"];
            $endTime   =  $rowGetStartEndTime["cr_end_time"];
            $duration  =  $rowGetStartEndTime["cr_duration"];
			
				// get rekod 1st
				$data1stID = '';
				$thisCycle = '';
                $Get1strekod = " SELECT * FROM tk_classes_record WHERE cr_cl_id = '".$rowGetStartEndTime["cr_cl_id"]."' AND row_no = '".$rowGetStartEndTime["row_no"]."' ORDER BY cr_date ASC, cr_start_time ASC ";
                $reGet1strekod = $conn->query($Get1strekod);
				$row_cnt = $reGet1strekod->num_rows;
                if ($reGet1strekod->num_rows > 0) {
                    $rowGet1strekod = $reGet1strekod->fetch_assoc();
					$data1stID = $rowGet1strekod["cr_id"];
					$thisCycle = $rowGet1strekod["cr_cycle"];
					if($row_cnt == 1){
						$newBalanceAfterCal = $rowGet1strekod["cr_cycle"];
					}	
                }
			
            $first =  str_replace(" hours & ", ".", $duration);
            $newDuration = number_format((str_replace(" minutes", "", $first)), 2); /* contoh: 2 hours & 30 minutes - output = 2.3*/
            
            if( $rowGetStartEndTime["cr_status"] == 'new Cycle' ){
                
                $thisNewCycle = true;
                
                $row = 1;
                $adaNegative = 0;
                $thisStatus = false;
                $queryCurr = " SELECT * FROM tk_classes_record WHERE cr_cl_id = '".$rowGetStartEndTime["cr_cl_id"]."' AND row_no = '".$rowGetStartEndTime["row_no"]."' AND cr_id != '".$rowGetStartEndTime["cr_id"]."' ORDER BY cr_date ASC, cr_start_time ASC      ";
                $resultCurr = $conn->query($queryCurr);
                if ($resultCurr->num_rows > 0) {
                    while($rowCurr = $resultCurr->fetch_assoc()){
                        
                        if($row == 1) {
            								$balanceLastRecord = number_format(($rowGetStartEndTime["cr_cycle"]), 2); 
            								if( $balanceLastRecord < 0 ){
            									$replaceNegative = str_replace("-","",$balanceLastRecord);
            									$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
            									$convert = hoursToMinutes($balanceLastRecord1);
            									$balanceLastRecord2 = '-'.$convert;
            								}else{
            									$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
            									$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
            								}	
            								
            								$classDuration =  str_replace(" hours & ", ":", $rowCurr['cr_duration']);
            								$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
            								$classBalance2 = (hoursToMinutes($replaceClassDuration));	
            
            								$dataClassBalance = ($balanceLastRecord2 - $classBalance2);
            								
            								if( $dataClassBalance >= 0 ){
            										$currBalance = (minutesToHours($dataClassBalance));
            										$newBalanceAfterCal = '0'.$currBalance;	
            										if( $newBalanceAfterCal == '00.00' ){
            											$thisStatus = true;
            											$adaNegative++;
            										}
            								}else{
            										$dataBalanceReplace = str_replace("-","",$dataClassBalance);
            										$currBalance = (minutesToHours($dataBalanceReplace));	
            										$newBalanceAfterCal = '-0'.$currBalance;
            										$adaNegative == 1;
            										$adaNegative++;
            				
            								}
            								
            								if( $adaNegative == 0 ){
            									if( $thisStatus == true ){
            										$status = 'FM to pay tutor';
            									}else{
            										$status = 'new';
            									}
            								}else if( $adaNegative == 1 ){
            									$status = 'FM to pay tutor';
            								}else if( $adaNegative == 2 ){
            									$status = 'Required Parent To Pay';
            								}else{
            									$status = 'Error..';
            								}
            								$sqlUpdateAll = " UPDATE tk_classes_record SET cr_cycle = '".$balanceLastRecord."', cr_balance = '".$newBalanceAfterCal."', cr_status = 'new Cycle' WHERE cr_id = '".$rowCurr["cr_id"]."' ";
            								$conn->query($sqlUpdateAll);
                        }else{
								if( $balanceLastRecord < 0 ){
									$replaceNegative = str_replace("-","",$balanceLastRecord);
									$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
									$convert = hoursToMinutes($balanceLastRecord1);
									$balanceLastRecord2 = '-'.$convert;
								}else{
									$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
									$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
								}	
								
								$classDuration =  str_replace(" hours & ", ":", $rowCurr['cr_duration']);
								$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
								$classBalance2 = (hoursToMinutes($replaceClassDuration));	

								$dataClassBalance = ($balanceLastRecord2 - $classBalance2);
								
								if( $dataClassBalance >= 0 ){
										$currBalance = (minutesToHours($dataClassBalance));
										$newBalanceAfterCal = '0'.$currBalance;	
										if( $newBalanceAfterCal == '00.00' ){
											$thisStatus = true;
											$adaNegative++;
										}
								}else{	
										$dataBalanceReplace = str_replace("-","",$dataClassBalance);
										$currBalance = (minutesToHours($dataBalanceReplace));	
										$newBalanceAfterCal = '-0'.$currBalance;
										$adaNegative == 1;
										$adaNegative++;
				
								}
								
								if( $adaNegative == 0 ){
									if( $thisStatus == true ){
										$status = 'FM to pay tutor';
									}else{
										$status = 'new';
									}
								}else if( $adaNegative == 1 ){
									$status = 'FM to pay tutor';
								}else if( $adaNegative == 2 ){
									$status = 'Required Parent To Pay';
								}else{
									$status = 'Error..';
								}
								$sqlUpdateAll = " UPDATE tk_classes_record SET cr_cycle = '".$balanceLastRecord."', cr_balance = '".$newBalanceAfterCal."', cr_status = '".$status."' WHERE cr_id = '".$rowCurr["cr_id"]."' ";
								$conn->query($sqlUpdateAll);
                        }
                        
                    $row++;
                    $balanceLastRecord = $newBalanceAfterCal;
                    $sqlBalance = " UPDATE tk_classes SET cl_hours_balance='".$newBalanceAfterCal."', cl_cycle='".$rowGetStartEndTime["cr_cycle"]."' WHERE cl_id='".$rowCurr["cr_cl_id"]."' ";
                    $conn->query($sqlBalance);
                    }
                }else{
                    $thisNewCycle = false;
                }
                
                
                

                $queryLastRecord = " SELECT * FROM tk_classes_record WHERE (cr_status = 'FM to pay tutor' || cr_status = 'Tutor Paid') AND cr_classes = '".$rowGetStartEndTime["cr_classes"]."' AND row_no = '".($rowGetStartEndTime["row_no"]-1)."' AND cr_cl_id = '".$rowGetStartEndTime["cr_cl_id"]."'     ";
                $resultLastRecord = $conn->query($queryLastRecord);
                if ($resultLastRecord->num_rows > 0) {
                    $rowLastRecord = $resultLastRecord->fetch_assoc();
                    $newBalanceAfterCal = $rowLastRecord["cr_balance"];
                }else{
                    $newBalanceAfterCal = 'ERROR';
                }

                $queryLastRecord2 = " SELECT * FROM tk_classes_record WHERE cr_status = 'yes' AND cr_classes = '".$rowGetStartEndTime["cr_classes"]."' AND row_no = '".($rowGetStartEndTime["row_no"]-1)."' AND cr_cl_id = '".$rowGetStartEndTime["cr_cl_id"]."' ORDER BY cr_date ASC, cr_start_time ASC ";
                $resultLastRecord2 = $conn->query($queryLastRecord2);
                if ($resultLastRecord2->num_rows > 0) {
					$rowLastRecord2 = $resultLastRecord2->fetch_assoc();
					$thisCycle = intval($rowLastRecord2["cr_cycle"]);
                }else{
					$thisCycle = 'ERROR';
                }                  
                

            }else{
					$row = 1;
					$adaNegative = 0;
					$thisStatus = false;
					$RekodKelas = " SELECT * FROM tk_classes_record WHERE cr_cl_id = '".$rowGetStartEndTime["cr_cl_id"]."' AND row_no = '".$rowGetStartEndTime["row_no"]."' AND cr_id != '".$mainId."' ORDER BY cr_date ASC, cr_start_time ASC ";
					$reRekodKelas = $conn->query($RekodKelas);
					if ($reRekodKelas->num_rows > 0) {
						while($roRekodKelas = $reRekodKelas->fetch_assoc()){
													
							if($row == 1) {
							    
							    if( $roRekodKelas['cr_status'] == 'new Cycle' ){

            								$balanceLastRecord = number_format(($thisCycle), 2); /* contoh: 04.30 - output = 4.3*/
            								if( $balanceLastRecord < 0 ){
            									$replaceNegative = str_replace("-","",$balanceLastRecord);
            									$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
            									$convert = hoursToMinutes($balanceLastRecord1);
            									$balanceLastRecord2 = '-'.$convert;
            								}else{
            									$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
            									$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
            								}	
            								
            								$classDuration =  str_replace(" hours & ", ":", $roRekodKelas['cr_duration']);
            								$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
            								$classBalance2 = (hoursToMinutes($replaceClassDuration));	
            
            								$dataClassBalance = ($balanceLastRecord2 - $classBalance2);
            								
            								if( $dataClassBalance >= 0 ){
            										$currBalance = (minutesToHours($dataClassBalance));
            										$newBalanceAfterCal = '0'.$currBalance;	
            										if( $newBalanceAfterCal == '00.00' ){
            											$thisStatus = true;
            											$adaNegative++;
            										}
            								}else{
            										$dataBalanceReplace = str_replace("-","",$dataClassBalance);
            										$currBalance = (minutesToHours($dataBalanceReplace));	
            										$newBalanceAfterCal = '-0'.$currBalance;
            										$adaNegative == 1;
            										$adaNegative++;
            				
            								}
            								
            								if( $adaNegative == 0 ){
            									if( $thisStatus == true ){
            										$status = 'FM to pay tutor';
            									}else{
            										$status = 'new';
            									}
            								}else if( $adaNegative == 1 ){
            									$status = 'FM to pay tutor';
            								}else if( $adaNegative == 2 ){
            									$status = 'Required Parent To Pay';
            								}else{
            									$status = 'Error..';
            								}
            								//$sqlUpdateAll = " UPDATE tk_classes_record SET invoice = '".($balanceLastRecord.' | '.$newBalanceAfterCal.' | '.$status)."' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
            								$sqlUpdateAll = " UPDATE tk_classes_record SET cr_cycle = '".$balanceLastRecord."', cr_balance = '".$newBalanceAfterCal."', cr_status = 'new Cycle' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
            								$conn->query($sqlUpdateAll);	
							        
							    }else{
            								
            								$balanceLastRecord = number_format(($thisCycle), 2); /* contoh: 04.30 - output = 4.3*/
            								if( $balanceLastRecord < 0 ){
            									$replaceNegative = str_replace("-","",$balanceLastRecord);
            									$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
            									$convert = hoursToMinutes($balanceLastRecord1);
            									$balanceLastRecord2 = '-'.$convert;
            								}else{
            									$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
            									$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
            								}	
            								
            								$classDuration =  str_replace(" hours & ", ":", $roRekodKelas['cr_duration']);
            								$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
            								$classBalance2 = (hoursToMinutes($replaceClassDuration));	
            
            								$dataClassBalance = ($balanceLastRecord2 - $classBalance2);
            								
            								if( $dataClassBalance >= 0 ){
            										$currBalance = (minutesToHours($dataClassBalance));
            										$newBalanceAfterCal = '0'.$currBalance;	
            										if( $newBalanceAfterCal == '00.00' ){
            											$thisStatus = true;
            											$adaNegative++;
            										}
            								}else{
            										$dataBalanceReplace = str_replace("-","",$dataClassBalance);
            										$currBalance = (minutesToHours($dataBalanceReplace));	
            										$newBalanceAfterCal = '-0'.$currBalance;
            										$adaNegative == 1;
            										$adaNegative++;
            				
            								}
            								
            								if( $adaNegative == 0 ){
            									if( $thisStatus == true ){
            										$status = 'FM to pay tutor';
            									}else{
            										$status = 'new';
            									}
            								}else if( $adaNegative == 1 ){
            									$status = 'FM to pay tutor';
            								}else if( $adaNegative == 2 ){
            									$status = 'Required Parent To Pay';
            								}else{
            									$status = 'Error..';
            								}
            								//$sqlUpdateAll = " UPDATE tk_classes_record SET invoice = '".($balanceLastRecord.' | '.$newBalanceAfterCal.' | '.$status)."' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
            								
            								if( $roRekodKelas['cr_status'] == 'Tutor Paid' ){
            								    $status = 'Tutor Paid';
            								}
            								
            								$sqlUpdateAll = " UPDATE tk_classes_record SET cr_cycle = '".$balanceLastRecord."', cr_balance = '".$newBalanceAfterCal."', cr_status = '".$status."' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
            								$conn->query($sqlUpdateAll);							        
							    }

							}else{
								
								
								if( $balanceLastRecord < 0 ){
									$replaceNegative = str_replace("-","",$balanceLastRecord);
									$balanceLastRecord1 = str_replace(".", ":", $replaceNegative);
									$convert = hoursToMinutes($balanceLastRecord1);
									$balanceLastRecord2 = '-'.$convert;
								}else{
									$balanceLastRecord1 = str_replace(".", ":", $balanceLastRecord);
									$balanceLastRecord2 = hoursToMinutes($balanceLastRecord1);
								}	
								
								$classDuration =  str_replace(" hours & ", ":", $roRekodKelas['cr_duration']);
								$replaceClassDuration =  str_replace(" minutes", "", $classDuration);
								$classBalance2 = (hoursToMinutes($replaceClassDuration));	

								$dataClassBalance = ($balanceLastRecord2 - $classBalance2);
								
								if( $dataClassBalance >= 0 ){
										$currBalance = (minutesToHours($dataClassBalance));
										$newBalanceAfterCal = '0'.$currBalance;	
										if( $newBalanceAfterCal == '00.00' ){
											$thisStatus = true;
											$adaNegative++;
										}
								}else{	
										$dataBalanceReplace = str_replace("-","",$dataClassBalance);
										$currBalance = (minutesToHours($dataBalanceReplace));	
										$newBalanceAfterCal = '-0'.$currBalance;
										$adaNegative == 1;
										$adaNegative++;
				
								}
								
								if( $adaNegative == 0 ){
									if( $thisStatus == true ){
										$status = 'FM to pay tutor';
									}else{
										$status = 'new';
									}
								}else if( $adaNegative == 1 ){
									$status = 'FM to pay tutor';
								}else if( $adaNegative == 2 ){
									$status = 'Required Parent To Pay';
								}else{
									$status = 'Error..';
								}
								//$sqlUpdateAll = " UPDATE tk_classes_record SET invoice = '".($balanceLastRecord.' | '.$newBalanceAfterCal.' | '.$status)."' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
            								
								if( $roRekodKelas['cr_status'] == 'Tutor Paid' ){
								    $status = 'Tutor Paid';
								}
            								
								$sqlUpdateAll = " UPDATE tk_classes_record SET cr_cycle = '".$balanceLastRecord."', cr_balance = '".$newBalanceAfterCal."', cr_status = '".$status."' WHERE cr_id = '".$roRekodKelas["cr_id"]."' ";
								$conn->query($sqlUpdateAll);
							}
							
							
						$row++;
						$balanceLastRecord = $newBalanceAfterCal;
						}
					}
            }
    }
    
    if( $thisNewCycle != true ){
            $sqlBalance = " UPDATE tk_classes SET cl_hours_balance='".$newBalanceAfterCal."', cl_cycle='".$thisCycle."' WHERE cl_id='".$secId."' ";
            
            $queryStatus = " SELECT cr_id, cr_cl_id, cr_status, cr_classes, row_no FROM tk_classes_record WHERE cr_id='".$dataDeleteClassesRecord['id']."' ";
            $resultStatus = $conn->query($queryStatus);
            if ($resultStatus->num_rows > 0) {
                $rowStatus = $resultStatus->fetch_assoc();
                if( $rowStatus["cr_status"] == 'new Cycle' ){
        			
        			if( $rowStatus['row_no'] == 1 ){
        				$thisRowMain = 1;
        			}else{
        				$thisRowMain = ($rowStatus['row_no'] - 1);
        			}
        					
                    $queryLoop = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$rowStatus['cr_cl_id']."' AND cr_classes='".$rowStatus['cr_classes']."' AND row_no = '".$thisRowMain."' ";
                    $resultLoop = $conn->query($queryLoop);
                    if ($resultLoop->num_rows > 0) {
                        while($rowLoop = $resultLoop->fetch_assoc()){
                            
        					if( $rowLoop['row_no'] == 1 ){
        						$thisRow = 1;
        					}else{
        						$thisRow = ($rowLoop['row_no'] - 1);
        					}
        					
                            if( $rowLoop["cr_status"] == 'yes' ){
                                $sqlChange = " UPDATE tk_classes_record SET cr_status='new', cr_classes='".($rowLoop['cr_classes'] - 1)."', row_no='".$thisRow."' WHERE cr_id='".$rowLoop["cr_id"]."' ";
                                $conn->query($sqlChange);
                            }
                            if( $rowLoop["cr_status"] == 'FM to pay tutor' ){
                                $sqlChange2 = " UPDATE tk_classes_record SET cr_classes='".($rowLoop['cr_classes'] - 1)."', row_no='".$thisRow."' WHERE cr_id='".$rowLoop["cr_id"]."' ";
                                $conn->query($sqlChange2);
                            }
                            if( $rowLoop["cr_status"] == 'Tutor Paid' ){
                                $sqlChange2 = " UPDATE tk_classes_record SET cr_classes='".($rowLoop['cr_classes'] - 1)."', row_no='".$thisRow."' WHERE cr_id='".$rowLoop["cr_id"]."' ";
                                $conn->query($sqlChange2);
                            }
                        }
                    }
                    
                }
            }        
    }


    
    
    $sqlDelete = " DELETE FROM tk_classes_record WHERE cr_id='".$dataDeleteClassesRecord['id']."' ";
    $conn->query($sqlDelete);
    if ( ($conn->query($sqlBalance) === TRUE) ) {
        echo "Record Has Been Deleted";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    exit();

	
}


if(isset($_POST['showText'])){
    $showText = $_POST['showText'];
    $query = " SELECT * FROM tk_classes_record WHERE cr_id='".$showText['text']."' ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['cr_tutor_report'];
    }else{
        echo 'error';
    }
}
if(isset($_POST['showText2'])){
    $showText2 = $_POST['showText2'];
    $query = " SELECT * FROM tk_classes_record WHERE cr_id='".$showText2['text2']."' ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['cr_parent_remark'];
    }else{
        echo 'error';
    }
}



$conn->close();
?>