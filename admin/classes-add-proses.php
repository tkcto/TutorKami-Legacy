<?php
/* Database connection start */

$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");

if($_POST['insert']){
	$dataId    = $_POST['insert'][0];
	$dataStart = substr($_POST['insert'][2], -2);
	$dataEnd   = substr($_POST['insert'][3], -2);
	//echo $dataId." - ".$dataStart." - ".$dataEnd;
	
	$querySelect = "SELECT * FROM tk_classes_record WHERE cr_id = '$dataId'";
	$statementSelect = $connect->prepare($querySelect);
	$statementSelect->execute();
	$resultSelect = $statementSelect->fetchAll();
	foreach($resultSelect as $rowSelect ){
		$newStart = substr($rowSelect['cr_start_time'], 0, -2).$dataStart;
		$newEnd   = substr($rowSelect['cr_end_time'], 0, -2).$dataEnd;
		//echo $rowSelect['cr_id']." = ".$newStart." - ".$newEnd;	
	
	$queryUpdate = "UPDATE tk_classes_record SET cr_start_time = '$newStart', cr_end_time = '$newEnd' WHERE cr_id = '$dataId' ";
	$statementUpdate = $connect->prepare($queryUpdate);
	$statementUpdate->execute();
	}
	

	
}else{
    
	$arrFMPayTutor = array();
    $currentCycle = '';
    $queryCurrent = " SELECT cr_cl_id, cr_date, cr_start_time, row_no FROM tk_classes_record WHERE cr_cl_id = {$_POST['id']} ORDER BY cr_date DESC, cr_start_time DESC ";
    $resultCurrent = $conn->query($queryCurrent);
    if ($resultCurrent->num_rows > 0) {
    	$rowCurrent = $resultCurrent->fetch_assoc();
    	$currentCycle = $rowCurrent["row_no"];
    	
        $qFMPayTutor = " SELECT cr_id, cr_cl_id, row_no, cr_status, cr_date, cr_start_time FROM tk_classes_record WHERE cr_cl_id = {$_POST['id']} AND row_no = '".$currentCycle."' AND cr_status = 'Tutor Paid' ORDER BY cr_date DESC, cr_start_time DESC ";
        $reFMPayTutor = $conn->query($qFMPayTutor);
        if ($reFMPayTutor->num_rows > 0) {
            $roFMPayTutor = $reFMPayTutor->fetch_assoc();

            $queryAllID = " SELECT cr_id, cr_cl_id, row_no, cr_status, cr_date, cr_start_time FROM tk_classes_record WHERE cr_cl_id = {$_POST['id']} AND row_no = '". $roFMPayTutor["row_no"]."' AND (cr_status = 'Tutor Paid' OR cr_status = 'new' OR cr_status = 'yes') ORDER BY cr_date DESC, cr_start_time DESC ";
            $reAllID = $conn->query($queryAllID);
            if ($reAllID->num_rows > 0) {
            	while($roAllID = $reAllID->fetch_assoc()){
            	    $arrFMPayTutor[] =  $roAllID["cr_id"];
            	}
            }

        }
        

        $qParentPay = " SELECT cr_id, cr_cl_id, row_no, cr_status, cr_date, cr_start_time FROM tk_classes_record WHERE cr_cl_id = {$_POST['id']} AND row_no = '".$currentCycle."' AND cr_status = 'Required Parent To Pay' ORDER BY cr_date DESC, cr_start_time DESC ";
        $reParentPay = $conn->query($qParentPay);
        if ($reParentPay->num_rows > 0) {
            while($roParentPay = $reParentPay->fetch_assoc()){
                //$arrFMPayTutor[] =  $roParentPay["cr_id"];
            }
        }
    
    }
	
	
$column = array('cr_id');

$query = "
SELECT * FROM tk_classes_record
INNER JOIN tk_classes ON cl_id = cr_cl_id
WHERE cr_cl_id = {$_POST['id']}
AND current_cycle NOT LIKE '%temp%'
ORDER BY cr_date DESC, cr_start_time DESC, cr_id DESC
";
//ORDER BY cr_id DESC

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();



$data = array();

$numItems = count($result);
$i = 0;
foreach($result as $row)
{
 $sub_array = array();

 $sub_array[] = $row['cr_id'];
 
 if($row['cr_status'] =='new Cycle' || $row['cr_status'] =='Required Parent To Pay'){
    $sub_array[] = '<font style="background-color:#3490ff;color:white">'.date("d/m/y", strtotime($row['cr_date'])).'</font> <br>('.date("H:i", strtotime($row['cr_create_date'])).' '.date("d/m/y", strtotime($row['cr_create_date'])).')';
 }else{
    $sub_array[] = date("d/m/y", strtotime($row['cr_date'])).' <br>('.date("H:i", strtotime($row['cr_create_date'])).' '.date("d/m/y", strtotime($row['cr_create_date'])).')';
 }
 
 
 /*
 $sub_array[] = $row['cr_start_time'];
 $sub_array[] = $row['cr_end_time'];
 */
 if (strpos($row['cr_start_time'], 'PM') !== false) {
    $sub_array[] = str_replace("PM"," PM",$row['cr_start_time']);
 } else {
    $sub_array[] = str_replace("AM"," AM",$row['cr_start_time']);
 }

 if (strpos($row['cr_end_time'], 'PM') !== false) {
    $sub_array[] = str_replace("PM"," PM",$row['cr_end_time']);
 } else {
    $sub_array[] = str_replace("AM"," AM",$row['cr_end_time']);
 }
 
 //$sub_array[] = $row['cr_duration'];
 $replaceFirst = str_replace("hours","hour",$row['cr_duration']); 
 $replaceString = str_replace("minutes","min",$replaceFirst);
 $sub_array[] = str_replace("&","&<br>",$replaceString);


 //$sub_array[] = '<strong>'.$row['cr_tutor_report'].'</strong>';
 if( $row['cr_tutor_report'] != ''){
     if( strlen($row['cr_tutor_report']) > 50){
         $sub_array[] = '<strong>'.substr_replace($row['cr_tutor_report'], ' .. <a style="text-decoration: underline;" href="javascript:showText('.$row['cr_id'].')">View More</a>', 50).'</strong>';
     }else{
         $sub_array[] = '<strong>'.$row['cr_tutor_report'].'</strong>';
     }
     
 }else{
     $sub_array[] = '';
 }
 

  if(++$i === $numItems) {
    $sub_array[] = '<font color=#800080>New Cycle <br/>#1</font>';
  }else{
            
             if($row['cr_status'] =='FM to pay tutor'){
            	//$sub_array[] = '<a href="javascript:openwindow()"><font color=red>'.ucwords($row['cr_status']).'</font></a>';
            
            	//if($row['cr_balance'] =='-' ){
            		//$sub_array[] = '';
            	//}else{
            		//$sub_array[] = '<a href="javascript:openwindow()"><font color=red>'.ucwords($row['cr_status']).'</font></a>';
            	//}
            /*
                if(1 === preg_match('~[0-9]~', $row['cr_balance'])){
                   // $sub_array[] = '';
                   $sub_array[] = '<a href="javascript:openwindow('.$row['cr_id'].')"><font color=red> Required Parent To Pay </font></a>';
                }else{
                 $sub_array[] = '<a href="javascript:openwindow('.$row['cr_id'].')"><font color=red>'.ucwords($row['cr_status']).'</font></a>';
                }
            */	
            
                 if( $row['last'] == 'This is the last session' ){
                     $lastInfo = '<br/><br/><font color=red>'.ucwords($row['last']).'</font>';
                 }else if( $row['last'] == 'Next class as usual' ){
                     $lastInfo = '<br/><br/><font color=green>'.ucwords($row['last']).'</font>';
                 }else if( $row['last'] == 'Not sure if got next class' ){
                     $lastInfo = '<br/><br/><font color=blue>'.ucwords($row['last']).'</font>';
                 }else{
                     $lastInfo = '';
                 }
                
                 $sub_array[] = '<a href="javascript:openwindow2('.$row['cr_id'].')"><font color=red>'.ucwords($row['cr_status']).'</font></a>'.$lastInfo;
             }
             else if($row['cr_status'] =='Tutor Paid'){
                 
                 if( $row['last'] == 'This is the last session' ){
                     $lastInfo = '<br/><br/><font color=red>'.ucwords($row['last']).'</font>';
                 }else if( $row['last'] == 'Next class as usual' ){
                     $lastInfo = '<br/><br/><font color=green>'.ucwords($row['last']).'</font>';
                 }else if( $row['last'] == 'Not sure if got next class' ){
                     $lastInfo = '<br/><br/><font color=blue>'.ucwords($row['last']).'</font>';
                 }else{
                     $lastInfo = '';
                 }
                 
                 $sub_array[] = '<font color=blue>Tutor Paid</font>'.$lastInfo;
             }
             else if($row['cr_status'] =='new Cycle'){
            	//$sub_array[] = '<font color=green>New Cycle</font>';
            	if($row['cr_balance'] =='-' ){
            		$sub_array[] = '';
            	}else{
            		$sub_array[] = '<font color=#800080>New Cycle <br/>#'.$row['cr_classes'].'</font>';
            	}
             }
             else if($row['cr_status'] =='Required Parent To Pay'){
                    if($row['invoice'] =='on'){
                        $checked = 'checked=checked';
                    }else{
                        $checked = '';
                    }
                  $sub_array[] = '<a href="javascript:openwindow('.$row['cr_id'].')"><font color=red>'.ucwords($row['cr_status']).'</font></a> <br><input type="checkbox" class="form-check-input" '.$checked.'> <b>Invoice sent</b>';
             }
             
             else{
            	 $sub_array[] = '';
             }      
  }


 //$sub_array[] = $row['cr_parent_verification'];
if( $row["cr_parent_verification"] =='' ){
    $sub_array[] = '';
}else if( $row["cr_parent_verification"]=='done' ){
    if( $row["time_verification"] != '' ){
        $verInfo = preg_replace("/[^a-zA-Z]+/", "", $row["time_verification"]);
        $verTime = explode(" - ", $row["time_verification"], 2);
        //$verTime[0]
        $resultVer = ' ('.$verInfo.')<br/>('.$verTime[0].')';
    }else{
        $resultVer = '';
    }
    $sub_array[] = '<font color=green>Correct</font>'.$resultVer;
}else if( $row["cr_parent_verification"]=='done (Admin)' ){
    $sub_array[] = '<font color=green>Correct </font>(Admin)';
}else if( $row["cr_parent_verification"]=='notdone' ){
    $sub_array[] = '<font color=red>Incorrect</font>';
}else{
    $sub_array[] = '';
}

//$sub_array[] = $row['cr_parent_remark'];
 if( $row['cr_parent_remark'] != ''){
     if( strlen($row['cr_parent_remark']) > 50){
         $sub_array[] = '<strong>'.substr_replace($row['cr_parent_remark'], ' .. <a style="text-decoration: underline;" href="javascript:showText2('.$row['cr_id'].')">View More</a>', 50).'</strong>';
     }else{
         $sub_array[] = '<strong>'.$row['cr_parent_remark'].'</strong>';
     }
     
 }else{
     $sub_array[] = '';
 }
/*
$sub_array[] = '
	<span class="btn-group">
		<a href="classes-details.php?cd='.$row['cr_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
        <a class="gray-text"><button class="btn-white btn edt-btn btn-xs" onClick="return ConfirmDelete('.$row['cr_id'].');" type="submit" id="delete">Delete</button></a>         
	</span>
';
*/

/*
if( $row['cr_status'] =='Tutor Paid' ){
$sub_array[] = '
	<span class="btn-group">
		<a href="classes-report.php?report='.$row['cr_id'].'" class="gray-text" target="_blank" ><button class="btn-white btn edt-btn btn-xs">Report</button></a>   
	</span>
';
}else if ($row['cr_status'] =='new Cycle' || $row['cr_status'] =='yes'){
$sub_array[] = ' ';

		//<a href="classes-details.php?cd='.$row['cr_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
        //<a class="gray-text"><button class="btn-white btn edt-btn btn-xs" onClick="return ConfirmDelete('.$row['cr_id'].');" type="submit" id="delete">Delete</button></a>      	
	
}else{
$sub_array[] = '
	<span class="btn-group">
		<a href="classes-details.php?cd='.$row['cr_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
        <a class="gray-text"><button class="btn-white btn edt-btn btn-xs" onClick="return ConfirmDelete('.$row['cr_id'].');" type="submit" id="delete">Delete</button></a>         
	</span>
';
}
*/

/*
$disabled = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$row['cl_id']."' ORDER BY cr_date DESC, cr_start_time DESC LIMIT 1 ";
$resultdisabled = $conn->query($disabled);
if ($resultdisabled->num_rows > 0) {
	$rowdisabled  = $resultdisabled->fetch_assoc();
	if( $rowdisabled["cr_id"] == $row['cr_id']){
	    $currentdisabled = ''; 
	}else{
	    $currentdisabled = 'disabled'; 
	}
}else{
   $currentdisabled = 'disabled'; 
}



if( $row['cr_classes'] == $currentCycle ){
    

                                            $historyWaCycle = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$row['cr_id']."' AND wa_remark = 'Record Function' ORDER BY wa_id ASC ";
                                            $resulthistoryWaCycle = $conn->query($historyWaCycle);
                                            if ($resulthistoryWaCycle->num_rows > 0) {
                                            	while($rowhistoryWaCycle = $resulthistoryWaCycle->fetch_assoc()){
                                            		if( $rowhistoryWaCycle['wa_status'] == 'POST' ){
                                            			$textColorCycle = '<b><span class=text-success>Success</span></b><br/>';
                                            		}else{
                                            			$textColorCycle = '<b><span class=text-danger>Fail</span></b><br/>';
                                            		}
                                            		
                                            		$originalDateCycle = $rowhistoryWaCycle['wa_date'];
                                            		$newDateCycle = date("d/m/Y H:i:s", strtotime($originalDateCycle));
                                            		

                                            		$whatIWantCycle.= ' <font color=#13004d><b>'.$newDateCycle.'</b></font> '.$textColorCycle; 
                                            	}
                                            	
                                            	$dataPopover = '<a class="popoverRecord" data-html="true" data-content="'.$whatIWantCycle.'" rel="popover" title="Record Log" data-placement="left" data-trigger="hover"><span class="glyphicon glyphicon-user" style="color:#262262" ></span></a>';
                                                
                                            }else{
                                                $dataPopover = '';
                                            }
    
    
$sub_array[] = '
	<span class="btn-group">
		<a href="classes-details.php?cd='.$row['cr_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" '.$currentdisabled.' name="edit">Edit</button></a>
		'.$dataPopover.'
        <a class="gray-text"><button class="btn-white btn edt-btn btn-xs" '.$currentdisabled.' onClick="return ConfirmDelete('.$row['cr_id'].');" type="submit" id="delete">Delete</button></a>         
	</span>
';
}else if ( $row['cr_status'] =='Tutor Paid' ){
$sub_array[] = '
	<span class="btn-group">
		<a href="classes-report.php?report='.$row['cr_id'].'" class="gray-text" target="_blank" ><button class="btn-white btn edt-btn btn-xs">Report</button></a>   
	</span>
';
}else{
	$sub_array[] = '';
}
*/

                                            $historyWaCycle = " SELECT * FROM tk_whatsapp_noti WHERE wa_job_id = '".$row['cr_id']."' AND wa_remark = 'Record Function' ORDER BY wa_id ASC ";
                                            $resulthistoryWaCycle = $conn->query($historyWaCycle);
                                            if ($resulthistoryWaCycle->num_rows > 0) {
                                            	while($rowhistoryWaCycle = $resulthistoryWaCycle->fetch_assoc()){
                                            		if( $rowhistoryWaCycle['wa_status'] == 'POST' ){
                                            			$textColorCycle = '<b><span class=text-success>Success</span></b><br/>';
                                            		}else{
                                            			$textColorCycle = '<b><span class=text-danger>Fail</span></b><br/>';
                                            		}
                                            		
                                            		$originalDateCycle = $rowhistoryWaCycle['wa_date'];
                                            		$newDateCycle = date("d/m/Y H:i:s", strtotime($originalDateCycle));
                                            		

                                            		$whatIWantCycle.= ' <font color=#13004d><b>'.$newDateCycle.'</b></font> '.$textColorCycle; 
                                            	}
                                            	
                                            	$dataPopover = '<a class="popoverRecord" data-html="true" data-content="'.$whatIWantCycle.'" rel="popover" title="Record Log" data-placement="left" data-trigger="hover"><span class="glyphicon glyphicon-user" style="color:#262262" ></span></a>';
                                                
                                            }else{
                                                $dataPopover = '';
                                            }



if( $row['row_no'] == $currentCycle ){
    
    if(!empty($arrFMPayTutor)){
        
        if (in_array($row['cr_id'], $arrFMPayTutor)){
            $sub_array[] = '';
        }else{
            if ( $row['cr_status'] =='new Cycle' ){
                $sub_array[] = '';
            }else{
                $sub_array[] = '
                	<span class="btn-group">
                		<a href="classes-details.php?cd='.$row['cr_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
                		'.$dataPopover.'
                        <a class="gray-text"><button class="btn-white btn edt-btn btn-xs" onClick="return ConfirmDelete('.$row['cr_id'].');" type="submit" id="delete">Delete</button></a>         
                	</span>
                ';            
            }
        }
        
        
    }else{
            if ( $row['cr_status'] =='new Cycle' ){
                //$sub_array[] = '';
                $sub_array[] = '
                	<span class="btn-group">
                		<a href="classes-details.php?cd='.$row['cr_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
                		'.$dataPopover.'
                        <a class="gray-text"><button class="btn-white btn edt-btn btn-xs" onClick="return ConfirmDelete('.$row['cr_id'].');" type="submit" id="delete">Delete</button></a>         
                	</span>
                ';  
            }else{
                $sub_array[] = '
                	<span class="btn-group">
                		<a href="classes-details.php?cd='.$row['cr_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
                		'.$dataPopover.'
                        <a class="gray-text"><button class="btn-white btn edt-btn btn-xs" onClick="return ConfirmDelete('.$row['cr_id'].');" type="submit" id="delete">Delete</button></a>         
                	</span>
                ';            
            }
    }

    
}else{
    if ( $row['cr_status'] =='Tutor Paid' ){
        
        $thisHour = '';
        $GetHour = " SELECT cr_cl_id, row_no, cr_date, cr_start_time, cr_id, cr_cycle FROM tk_classes_record WHERE cr_cl_id = '".$row['cr_cl_id']."' AND row_no = '".$row['row_no']."' ORDER BY cr_date ASC, cr_start_time ASC, cr_id ASC ";
        $reGetHour = $conn->query($GetHour);
        if ($reGetHour->num_rows > 0) {
            $roGetHour = $reGetHour->fetch_assoc();
            $thisHour = $roGetHour['cr_cycle'];
        }


    $sub_array[] = '
    	<span class="btn-group">
    		<a href="classes-report.php?report='.$row['cr_id'].'" class="gray-text" target="_blank" ><button class="btn-white btn edt-btn btn-xs">Report</button></a> <b>Total : '.$thisHour.' hrs</b>  
    	</span>
    ';
    }else{
        $sub_array[] = '';
    }
}

 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "
 SELECT * FROM tk_classes_record
 INNER JOIN tk_classes ON cl_id = cr_cl_id
 WHERE cr_cl_id = {$_POST['id']}
 ORDER BY cr_date DESC, cr_start_time DESC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($connect),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);


}

?>

