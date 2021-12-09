<?php 
require_once('includes/head.php');

$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}

if (isset($_POST['action'])) {
    
	if ($_POST['action'] == 'get_subjects') {
		if( isset($_POST['level_id']) ){
        		$level_id = $_POST['level_id'];
        		$sub_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        		$selected = '';
        		if ($level_id != '') {
        			$i = 0;
        			
        			if($level_id =='AllLevel'){
        				$querySubject = "SELECT * FROM tk_tution_subject WHERE ts_status ='A' GROUP BY ts_description ORDER BY ts_description ASC"; 
        			}else{
        				$querySubject = "SELECT * FROM tk_tution_subject WHERE ts_tc_id ='".$level_id."' ORDER BY ts_description ASC"; 
        			}
        			$resultSubject = $dbCon->query($querySubject); 
        			if($resultSubject->num_rows > 0){ 
        				while($rowSubject = $resultSubject->fetch_assoc()){  
        					$selected = ($sub_id != '' && $sub_id == $rowSubject['ts_id']) ? 'checked="checked"' : '';
        
        					echo '<div class="col-md-6">
        	                    <input name="tutor_subject_'. $level_id.'['. $i .']" class="subject_check" id="subject_check'.$rowSubject['ts_id'].'" value="'.$rowSubject['ts_id'].'" type="checkbox" '.$selected.' data-cname="tutor_subject_" data-pname="ca_state_">
        	                  <label for="subject_check'.$rowSubject['ts_id'].'">'.$rowSubject['ts_description'].'</label> 
        	                </div>';
        
        	                $i++;
        				} 
        			}
        			
        		}
		}
		if( isset($_POST['level_id']) && isset($_POST['subject_id']) ){
		    
            		    $currentData = (explode(" *", $_POST['subject_id'])); 
                		$selected0 =  str_replace(" *",",",$_POST['subject_id']);
                		$array0=(explode(',', $selected0));
                		$selected = '';
                		
                		$string =  str_replace(" *",",",$_POST['subject_id']);
                		$array=(explode(',', $string));
                		$array = implode("','",$array);
            
                        if (in_array("AllLevel", $currentData)){
                              $querySubject = "SELECT * FROM tk_tution_subject WHERE ts_status ='A' GROUP BY ts_description ORDER BY ts_description ASC"; 
                        }else{
                              $queryLevel = " SELECT * FROM tk_tution_course WHERE tc_description IN ('".$array."') ";
                              $resultLevel = $dbCon->query($queryLevel); 
                              if($resultLevel->num_rows > 0){ 
                                  $rowLevel = $resultLevel->fetch_assoc();
                                  $state_id = $rowLevel['tc_id'];
                              }else{
                                  $state_id = '';
                              }
                              $querySubject = "SELECT * FROM tk_tution_subject WHERE ts_tc_id ='".$state_id."' ORDER BY ts_description ASC"; 
                        }

                			$resultSubject = $dbCon->query($querySubject); 
                			if($resultSubject->num_rows > 0){ 
                				while($rowSubject = $resultSubject->fetch_assoc()){  
                				    $selected = ($array0 != '' && (in_array($rowSubject['ts_description'], $array0))) ? 'checked="checked"' : '';
                
                					echo '<div class="col-md-6">
                	                    <input name="tutor_subject_'. $level_id.'['. $i .']" class="subject_check" id="subject_check'.$rowSubject['ts_id'].'" value="'.$rowSubject['ts_id'].'" type="checkbox" '.$selected.' data-cname="tutor_subject_" data-pname="ca_state_">
                	                  <label for="subject_check'.$rowSubject['ts_id'].'">'.$rowSubject['ts_description'].'</label> 
                	                </div>';
                
                	                $i++;
                				}
                			}

		    
		}
		
	}

	
	
	
	
	


}
?>
