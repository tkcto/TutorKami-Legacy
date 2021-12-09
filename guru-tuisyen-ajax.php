<?php 
require_once('includes/head.php');

$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}

if (isset($_POST['action'])) {
    
	if ($_POST['action'] == 'get_cities') {
		//$state_id = $_POST['state_id'];
		//$ct_id = isset($_POST['city_id']) ? $_POST['city_id'] : '';
		
		
		if( isset($_POST['state_id']) ){
		    $state_id = $_POST['state_id'];
    		$selected = '';
    		if ($state_id != '') {
    			$i = 0;
    
    			if($state_id =='AllState'){
    				$queryCity = "SELECT * FROM tk_cities WHERE city_status ='1' ORDER BY city_name ASC"; 
    			}else{
    				$queryCity = "SELECT * FROM tk_cities WHERE city_status ='1' AND city_st_id ='".$state_id."' ORDER BY city_name ASC"; 
    			}
    			$resultCity = $dbCon->query($queryCity); 
    			if($resultCity->num_rows > 0){ 
    				while($rowCity = $resultCity->fetch_assoc()){  
    					//$selected = ($ct_id != '' && $ct_id == $rowCity['city_id']) ? 'checked="checked"' : '';
    					
    					
    					$selected = ($ct_id != '' && (in_array($rowCity['city_name'], $currentData))) ? 'checked="checked"' : '';
    					
    					
    					
    
    					echo '<div class="col-md-6">
    	                    <input name="cover_area_city_'. $state_id.'['. $i .']" class="city_check" id="city_check_'.$rowCity['city_id'].'" value="'.$rowCity['city_id'].'" type="checkbox" '.$selected.' data-cname="cover_area_city_" data-pname="ca_state_">
    	                  <label for="city_check_'.$rowCity['city_id'].'">'.$rowCity['city_name'].'</label> 
    	                </div>';
    
    	                $i++;
    				} 
    			}
    		}
		}
		if( isset($_POST['state_id']) && isset($_POST['city_id']) ){


    
		    $currentData = (explode(" *", $_POST['city_id'])); 
		    
 
    		$selected0 =  str_replace(" *",",",$_POST['city_id']);
    		$array0=(explode(',', $selected0));
		    
    		$selected = '';
    		
    		
    		$string =  str_replace(" *",",",$_POST['city_id']);
    		$array=(explode(',', $string));
    		$array = implode("','",$array);



            if (in_array("AllState", $currentData)){
              //echo "Match found";
                  $queryCity = "SELECT * FROM tk_cities WHERE city_status ='1' ORDER BY city_name ASC"; 
            }else{
                  $queryCity2 = " SELECT * FROM tk_states WHERE st_name_bm IN ('".$array."') ";
                  $resultCity2 = $dbCon->query($queryCity2); 
                  if($resultCity2->num_rows > 0){ 
                      $rowCity2 = $resultCity2->fetch_assoc();
                      $state_id = $rowCity2['st_id'];
                  }else{
                      $state_id = '';
                  }
                  $queryCity = "SELECT * FROM tk_cities WHERE city_status ='1' AND city_st_id ='".$state_id."' ORDER BY city_name ASC"; 
            }

    			$resultCity = $dbCon->query($queryCity); 
    			if($resultCity->num_rows > 0){ 
    				while($rowCity = $resultCity->fetch_assoc()){  
    					//$selected = ($ct_id != '' && $ct_id == $rowCity['city_id']) ? 'checked="checked"' : '';
    					
    					$selected = ($array0 != '' && (in_array($rowCity['city_name'], $array0))) ? 'checked="checked"' : '';
    					
    
    					echo '<div class="col-md-6">
    	                    <input name="cover_area_city_'. $state_id.'['. $i .']" class="city_check" id="city_check_'.$rowCity['city_id'].'" value="'.$rowCity['city_id'].'" type="checkbox" '.$selected.' data-cname="cover_area_city_" data-pname="ca_state_">
    	                  <label for="city_check_'.$rowCity['city_id'].'">'.$rowCity['city_name'].'</label> 
    	                </div>';
    
    	                $i++;
    				} 
    			}
		}
	}




	if ($_POST['action'] == 'get_subjects') {
		if( isset($_POST['level_id']) ){
        		$level_id = $_POST['level_id'];
        		$sub_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
        		$selected = '';
        		if ($level_id != '') {
        			$i = 0;
        			
        			if($level_id =='AllLevel'){
        				$querySubject = "SELECT * FROM tk_tution_subject WHERE ts_status ='A' GROUP BY ts_title ORDER BY ts_title ASC"; 
        			}else{
        				$querySubject = "SELECT * FROM tk_tution_subject WHERE ts_tc_id ='".$level_id."' ORDER BY ts_title ASC"; 
        			}
        			$resultSubject = $dbCon->query($querySubject); 
        			if($resultSubject->num_rows > 0){ 
        				while($rowSubject = $resultSubject->fetch_assoc()){  
        					$selected = ($sub_id != '' && $sub_id == $rowSubject['ts_id']) ? 'checked="checked"' : '';
        
        					echo '<div class="col-md-6">
        	                    <input name="tutor_subject_'. $level_id.'['. $i .']" class="subject_check" id="subject_check'.$rowSubject['ts_id'].'" value="'.$rowSubject['ts_id'].'" type="checkbox" '.$selected.' data-cname="tutor_subject_" data-pname="ca_state_">
        	                  <label for="subject_check'.$rowSubject['ts_id'].'">'.$rowSubject['ts_title'].'</label> 
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
                              $querySubject = "SELECT * FROM tk_tution_subject WHERE ts_status ='A' GROUP BY ts_title ORDER BY ts_title ASC"; 
                        }else{
                              $queryLevel = " SELECT * FROM tk_tution_course WHERE tc_title IN ('".$array."') ";
                              $resultLevel = $dbCon->query($queryLevel); 
                              if($resultLevel->num_rows > 0){ 
                                  $rowLevel = $resultLevel->fetch_assoc();
                                  $state_id = $rowLevel['tc_id'];
                              }else{
                                  $state_id = '';
                              }
                              $querySubject = "SELECT * FROM tk_tution_subject WHERE ts_tc_id ='".$state_id."' ORDER BY ts_title ASC"; 
                        }

                			$resultSubject = $dbCon->query($querySubject); 
                			if($resultSubject->num_rows > 0){ 
                				while($rowSubject = $resultSubject->fetch_assoc()){  
                				    $selected = ($array0 != '' && (in_array($rowSubject['ts_title'], $array0))) ? 'checked="checked"' : '';
                
                					echo '<div class="col-md-6">
                	                    <input name="tutor_subject_'. $level_id.'['. $i .']" class="subject_check" id="subject_check'.$rowSubject['ts_id'].'" value="'.$rowSubject['ts_id'].'" type="checkbox" '.$selected.' data-cname="tutor_subject_" data-pname="ca_state_">
                	                  <label for="subject_check'.$rowSubject['ts_id'].'">'.$rowSubject['ts_title'].'</label> 
                	                </div>';
                
                	                $i++;
                				}
                			}

		    
		}
		
	}

	
	
	
	
	


}
?>
