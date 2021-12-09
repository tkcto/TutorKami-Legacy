<?php
$link = mysqli_connect("localhost", "tutorka1_live", "_+11pj,oow.L", "tutorka1_tutorkami_db");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['dataCycleId'])) {
	
    function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    // Transform hours like "1.45" into the total number of minutes, "105". 
    function hoursToMinutes($hours) { 
        $minutes = 0; 
        if (strpos($hours, '.') !== false) 
        { 
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

    $dataCycleId = $_POST['dataCycleId'];
    $dataCycle = $_POST['dataCycle'];
    $dataBalance = $_POST['dataBalance'];
    $cr_id = $_POST['cr_id'];


    $sql1 = "SELECT * FROM tk_classes_record WHERE cr_id ='".$cr_id."' ";
    if($result = mysqli_query($link, $sql1)){
        if(mysqli_num_rows($result) > 0){
            $rowResult = mysqli_fetch_array($result);
            
            
                    $latestBalance =  $rowResult['cr_balance'];
                    $newBalance = $dataCycle + $latestBalance;
    			
                    if ( $latestBalance < 0 ) {
                    	$convertNegative = abs($latestBalance);
                    
                    	$balTwoDecimalPlaces = number_format((float)$convertNegative, 2, '.', '');  // Outputs -> 105.00
                    	$balanceInMinutes = (hoursToMinutes($balTwoDecimalPlaces));
                    	
                    	$cycleHourTwoDecimalPlaces = number_format((float)$dataCycle, 2, '.', '');  // Outputs -> 105.00
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
                    
                    
            
    			if( $rowResult['cr_status'] == 'FM to pay tutor' ){
    				    $qryUpdate = "UPDATE tk_classes_record SET cr_status = 'Tutor Paid' WHERE cr_id = '".$cr_id."'";
    				    mysqli_query($link, $qryUpdate);    
    				    exit(); 
    			}
    			if( $rowResult['cr_status'] == 'Required Parent To Pay' ){
    				    $newCycle = $rowResult['cr_classes'] + 1;
    				    $row_no = $rowResult['row_no'] + 1;
    				    
    				    $qryUpdate = " UPDATE tk_classes_record SET cr_cycle = '".$dataCycle."', cr_balance = '".$newBalance2."', cr_status = 'new Cycle', cr_classes = '".$newCycle."', row_no = '".$row_no."'  WHERE cr_id = '".$cr_id."' ";
    				    mysqli_query($link, $qryUpdate);  
    					
    				    $sql2 = "SELECT * FROM tk_classes_record WHERE cr_status = 'new' AND cr_cl_id ='".$rowResult['cr_cl_id']."' ";
    					if($result2 = mysqli_query($link, $sql2)){
    						if(mysqli_num_rows($result2) > 0){
    							while($rowResult2 = mysqli_fetch_array($result2)){
    								   $sqlsql2 = " UPDATE tk_classes_record SET cr_status='yes', cr_classes = '".$newCycle."' WHERE cr_id='".$rowResult2['cr_id']."' ";
    								   mysqli_query($link, $sqlsql2);
    							}
    						}
    					}
    					// tak update 'FM to pay tutor' sebab kena bayar tutor dulu. (cr_classes)
    				    $sql3 = "SELECT * FROM tk_classes_record WHERE cr_status = 'Tutor Paid' AND cr_cl_id ='".$rowResult['cr_cl_id']."' ORDER BY cr_date DESC ";
    					if($result3 = mysqli_query($link, $sql3)){
    						if(mysqli_num_rows($result3) > 0){
    							$rowResult3 = mysqli_fetch_array($result3);
    								   $sqlsql3 = " UPDATE tk_classes_record SET cr_classes = '".$newCycle."' WHERE cr_id='".$rowResult3['cr_id']."' ";
    								   mysqli_query($link, $sqlsql3);
    						}
    					}
    					
    
    				    $qry = " UPDATE tk_classes SET cl_hours_balance='".$newBalance2."',cl_cycle='".$dataCycle."'  WHERE cl_id = '".$dataCycleId."' ";
    				    mysqli_query($link, $qry);  
    				    exit(); 
    			}
        }
    }




	
	
	
	
	
	
	
	
}

mysqli_close($link);
?>