<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_POST['dataSave'])){
	$dataSave = $_POST['dataSave'];
	//if( !empty($dataSave["state"]) && !empty($dataSave["city"]) && !empty($dataSave["level"]) && !empty($dataSave["min"]) && !empty($dataSave["max"]) && !empty($dataSave["rate"]) ){
	if( !empty($dataSave["state"]) && !empty($dataSave["city"]) && !empty($dataSave["level"]) && !empty($dataSave["note"]) ){
	    
	    $sessionUser = $dataSave["table_user"];
	    
	    if($dataSave["min"] == 0){
	        $dataMin = '0.001';
	    }else{
	        $dataMin = $dataSave["min"];
	    }
      
        $queryPrice = "SELECT * FROM tk_specific WHERE state='".$dataSave['state']."' AND city='".$dataSave['city']."' AND level='".$dataSave['level']."' ";
        $rowPrice = $conn->query($queryPrice);
        if ($rowPrice->num_rows > 0) {
            //echo 'Sorry! Exisitng Record ';
            $thiPrice = $rowPrice->fetch_assoc();
            
            $Id = $thiPrice["id"];
            $Parent = $thiPrice["parent_rate"];
            $Min = $thiPrice["tutor_rate_min"];
            $Max = $thiPrice["tutor_rate_max"];
            $Note = $thiPrice["note"];
/*
            if($dataSave["min"] = 0){
                $getMinMax = array($dataSave["min"],$Min,$Max);
                $getMinMax = array_filter($getMinMax);
                $min = '0';
                $max = max($getMinMax);  
                  
            }else{
                $getMinMax = array($dataSave["min"],$Min,$Max);
                $getMinMax = array_filter($getMinMax);
                $min = min($getMinMax);
                $max = max($getMinMax);              
            }

                $getMinMax = array($dataSave["min"],$Min,$Max);
                $getMinMax = array_filter($getMinMax);
                $min = min($getMinMax);
                $max = max($getMinMax);


$getMinMax = array_diff(array($dataSave["min"],$Min,$Max), array(null));
                $getMinMax = array_filter($getMinMax);
                $min = min($getMinMax);
                $max = max($getMinMax);

*/



                $getMinMax = array($dataMin,$Min,$Max);
                $getMinMax = array_filter($getMinMax);
                $min = min($getMinMax);
                $max = max($getMinMax); 
				
				if($min == $max){
					$max = $Max;
				}
				
				




            $calParent = ((($min + $max)/2) + 15);
            
            

            if( $sessionUser == 'temporary staff' ){
                $outputUser = 'PT';
            }else{
                $queryUser = "SELECT * FROM tk_user  
                INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
                WHERE ud_first_name ='".$sessionUser."'  ";
                $rowUser = $conn->query($queryUser);
                if ($rowUser->num_rows > 0) {
                    $thisUser = $rowUser->fetch_assoc();
                        if( $thisUser['u_email'] =='coordinator@tutorkami.com' ){
                            $outputUser = 'C1';
                        }else if( $thisUser['u_email'] =='coordinator2@tutorkami.com' ){
                            $outputUser = 'C2';
                        }else if( $thisUser['u_email'] =='coordinator3@tutorkami.com' ){
                            $outputUser = 'C3';
                        }else if( $thisUser['u_email'] =='finance@tutorkami.com' ){
                            $outputUser = 'FM';
                        }else if( $thisUser['u_email'] =='hi@tutorkami.com' ){
                            $outputUser = 'MM';
                        }else if( $thisUser['u_email'] =='hambal@tutorkami.com' ){
                            $outputUser = 'AHN';
                        }
                        else{
                            $outputUser = 'NOT CO';
                        }
                }else{
                    $outputUser = 'NOT USER';
                }
            }
            
            //$newNote = $thiPrice["note"].'\n'.date('d/m/Y').' '.$dataSave['note'].' '.$dataSave["min"].' -'.$outputUser;
            $newNote = $thiPrice["note"].'\n'.date('d/m/Y').' -'.$outputUser.' '.$dataSave['note'].' '.$dataSave["min"];
            

            $sql = "UPDATE tk_specific SET parent_rate='".$calParent."', tutor_rate_min='".$min."', tutor_rate_max='".$max."', note='".$newNote."' WHERE id='".$Id."'";

            if ($conn->query($sql) === TRUE) {
                //echo "Records Has Been Successfully Save";
                echo "Success! Record Has Been Saved";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }     

             
            
        }else{
            
            if( $sessionUser == 'temporary staff' ){
                $outputUser = 'PT';
            }else{
                $queryUser = "SELECT * FROM tk_user  
                INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
                WHERE ud_first_name ='".$sessionUser."'  ";
                $rowUser = $conn->query($queryUser);
                if ($rowUser->num_rows > 0) {
                    $thisUser = $rowUser->fetch_assoc();
                        if( $thisUser['u_email'] =='coordinator@tutorkami.com' ){
                            $outputUser = 'C1';
                        }else if( $thisUser['u_email'] =='coordinator2@tutorkami.com' ){
                            $outputUser = 'C2';
                        }else if( $thisUser['u_email'] =='coordinator3@tutorkami.com' ){
                            $outputUser = 'C3';
                        }else if( $thisUser['u_email'] =='finance@tutorkami.com' ){
                            $outputUser = 'FM';
                        }else if( $thisUser['u_email'] =='hi@tutorkami.com' ){
                            $outputUser = 'MM';
                        }else if( $thisUser['u_email'] =='hambal@tutorkami.com' ){
                            $outputUser = 'AHN';
                        }
                        else{
                            $outputUser = 'NOT CO';
                        }
                }else{
                    $outputUser = 'NOT USER';
                }
            }
            
	    	//$newNote = date('d/m/Y').' '.$dataSave['note'].' '.$dataSave["min"].' -'.$outputUser;
	    	$newNote = date('d/m/Y').' -'.$outputUser.' '.$dataSave['note'].' '.$dataSave["min"];
	    	
	    	
            $queryState = "SELECT * FROM tk_states WHERE st_id='".$dataSave['state']."' ";
            $rowState = $conn->query($queryState);
            if ($rowState->num_rows > 0) {
                $thiState = $rowState->fetch_assoc();
                $dataState = $thiState['st_name'];
            }
            $queryCity = "SELECT * FROM tk_cities WHERE city_id='".$dataSave['city']."' ";
            $rowCity = $conn->query($queryCity);
            if ($rowCity->num_rows > 0) {
                $thisCity = $rowCity->fetch_assoc();
                $dataCity = $thisCity['city_name'];
            }
            $queryLevel = "SELECT * FROM tk_tution_course WHERE tc_id='".$dataSave['level']."' ";
            $rowLevel = $conn->query($queryLevel);
            if ($rowLevel->num_rows > 0) {
                $thisLevel = $rowLevel->fetch_assoc();
                $dataLevel = $thisLevel['tc_title'];
            }
	    	
	    	
	    	

	    	$sql = "INSERT INTO tk_specific (state, city, level, parent_rate, tutor_rate_min, tutor_rate_max, note, state_name, city_name, level_name) VALUES 
		    ('".$dataSave['state']."', '".$dataSave['city']."', '".$dataSave['level']."', '".$dataSave['rate']."', '".$dataMin."', '".$dataSave['max']."', '".$newNote."', '".$dataState."', '".$dataCity."', '".$dataLevel."')";

		    if ($conn->query($sql) === TRUE) {
			    echo "Success! Record Has Been Saved";
		    } else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
		    }      
        }

        

        
	}
}



















if(isset($_POST['dataUpdate'])){
	$dataUpdate = $_POST['dataUpdate'];
	if( !empty($dataUpdate["id"]) ){
        
        $sql = "UPDATE tk_specific SET parent_rate='".$dataUpdate['rate']."', tutor_rate_min='".$dataUpdate['min']."', tutor_rate_max='".$dataUpdate['max']."', note='".$dataUpdate['note']."' WHERE id='".$dataUpdate['id']."'";

        if ($conn->query($sql) === TRUE) {
            echo "Success! Record Has Been Saved";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }            
     
	}
}


if(isset($_POST['dataDelete'])){
	$dataDelete = $_POST['dataDelete'];
	if( !empty($dataDelete["id"]) ){
        
        $sql = " DELETE FROM tk_specific WHERE id='".$dataDelete['id']."' ";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }            
     
	}
}

if(isset($_POST['dataCheckbox'])){
	$dataCheckbox= $_POST['dataCheckbox'];
	if( !empty($dataCheckbox["id"]) ){
	    
        $queryCheckbox = "SELECT * FROM tk_specific WHERE id='".$dataCheckbox['id']."'  ";
        $rowCheckbox = $conn->query($queryCheckbox);
        if ($rowCheckbox->num_rows > 0) {
            $thisCheckbox= $rowCheckbox->fetch_assoc();
            
            $checkbox = $thisCheckbox["checkbox"];
            
            
            if($checkbox == ''){
                $value = 'true';
            }
            if($checkbox == NULL){
                $value = 'true';
            }
            if($checkbox == 'true'){
                $value = 'false';
            }
            if($checkbox == 'false'){
                $value = 'true';
            }
            

            $sql = "UPDATE tk_specific SET checkbox='".$value."' WHERE id='".$dataCheckbox['id']."'";

            if ($conn->query($sql) === TRUE) {
                echo "Validated";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }  
             
            
        }

	}
}









if(isset($_POST['dataSaveNew'])){
	$dataSaveNew = $_POST['dataSaveNew'];
$success_count = 0;
	if( !empty($dataSaveNew["city"]) && !empty($dataSaveNew["level"]) && !empty($dataSaveNew["note"]) ){
    
	    $sessionUser = $dataSaveNew["table_user"];
		    
	    if($dataSaveNew["min"] == 0){
	        $dataMin = '0.001';
	    }else{
	        $dataMin = $dataSaveNew["min"];
	    }


	    $new_Array = explode(',',$dataSaveNew["city"]);
	    foreach($new_Array as $data){
	        
            $aa = " SELECT * FROM tk_cities WHERE city_id='".$data."' ";
            $bb = $conn->query($aa);
            if ($bb->num_rows > 0) {
                $cc = $bb->fetch_assoc();
                $dd = $cc["city_st_id"];
                $ee = $cc["city_id"];
            }else{
                $dd = '';
                $ee = '';
            }
	        
            //$queryPrice = "SELECT * FROM tk_specific WHERE state='".$dd."' AND city='".$data."' AND level='".$dataSaveNew['level']."' ";
            $queryPrice = "SELECT * FROM tk_specific WHERE state='".$dd."' AND city='".$ee."' AND level='".$dataSaveNew['level']."' ";
            $rowPrice = $conn->query($queryPrice);
            if ($rowPrice->num_rows > 0) {
                $thiPrice = $rowPrice->fetch_assoc();
                            
                            $Id = $thiPrice["id"];
                            $Parent = $thiPrice["parent_rate"];
                            $Min = $thiPrice["tutor_rate_min"];
                            $Max = $thiPrice["tutor_rate_max"];
                            $Note = $thiPrice["note"];
                            
                            $getMinMax = array($dataMin,$Min,$Max);
                            $getMinMax = array_filter($getMinMax);
                            $min = min($getMinMax);
                            $max = max($getMinMax); 
                				
                            if($min == $max){
                                $max = $Max;
                            }
                				
                            $calParent = ((($min + $max)/2) + 15);
                
                
                            if( $sessionUser == 'temporary staff' ){
                                $outputUser = 'PT';
                            }else{
                                $queryUser = "SELECT * FROM tk_user  
                                INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
                                WHERE ud_first_name ='".$sessionUser."'  ";
                                $rowUser = $conn->query($queryUser);
                                if ($rowUser->num_rows > 0) {
                                    $thisUser = $rowUser->fetch_assoc();
                                        if( $thisUser['u_email'] =='coordinator@tutorkami.com' ){
                                            $outputUser = 'C1';
                                        }else if( $thisUser['u_email'] =='coordinator2@tutorkami.com' ){
                                            $outputUser = 'C2';
                                        }else if( $thisUser['u_email'] =='coordinator3@tutorkami.com' ){
                                            $outputUser = 'C3';
                                        }else if( $thisUser['u_email'] =='finance@tutorkami.com' ){
                                            $outputUser = 'FM';
                                        }else if( $thisUser['u_email'] =='hi@tutorkami.com' ){
                                            $outputUser = 'MM';
                                        }else if( $thisUser['u_email'] =='hambal@tutorkami.com' ){
                                            $outputUser = 'AHN';
                                        }
                                        else{
                                            $outputUser = 'NOT USER1';
                                        }
                                }else{
                                    $outputUser = 'NOT USER2';
                                }
                            }
                            
                            $newNote = $thiPrice["note"].'\n'.date('d/m/Y').' -'.$outputUser.' '.$dataSaveNew['note'].' '.$dataSaveNew["min"];
                            
                
                            $sql = "UPDATE tk_specific SET parent_rate='".$calParent."', tutor_rate_min='".$min."', tutor_rate_max='".$max."', note='".$newNote."' WHERE id='".$Id."'";
                
                            if ($conn->query($sql) === TRUE) {
                                //echo "Success! Record Has Been Saved";
                                $success_count++;
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }   
                            /*
                            $sql = "UPDATE dbtest SET col4='".$calParent."', col5='".$min."', col6='".$max."', col7='".$newNote."' WHERE id='".$Id."'";
                            if ($conn->query($sql) === TRUE) {
                                //echo "Success! Record Has Been Saved";
                            } else {
                                //echo "Error: " . $sql . "<br>" . $conn->error;
                            }   */
                
            }else{

                            if( $sessionUser == 'temporary staff' ){
                                $outputUser = 'PT';
                            }else{
                                $queryUser = "SELECT * FROM tk_user  
                                INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
                                WHERE ud_first_name ='".$sessionUser."'  ";
                                $rowUser = $conn->query($queryUser);
                                if ($rowUser->num_rows > 0) {
                                    $thisUser = $rowUser->fetch_assoc();
                                        if( $thisUser['u_email'] =='coordinator@tutorkami.com' ){
                                            $outputUser = 'C1';
                                        }else if( $thisUser['u_email'] =='coordinator2@tutorkami.com' ){
                                            $outputUser = 'C2';
                                        }else if( $thisUser['u_email'] =='coordinator3@tutorkami.com' ){
                                            $outputUser = 'C3';
                                        }else if( $thisUser['u_email'] =='finance@tutorkami.com' ){
                                            $outputUser = 'FM';
                                        }else if( $thisUser['u_email'] =='hi@tutorkami.com' ){
                                            $outputUser = 'MM';
                                        }else if( $thisUser['u_email'] =='hambal@tutorkami.com' ){
                                            $outputUser = 'AHN';
                                        }
                                        else{
                                            $outputUser = 'NOT USER1';
                                        }
                                }else{
                                    $outputUser = 'NOT USER2';
                                }
                            }
                            
                	    	$newNote = date('d/m/Y').' -'.$outputUser.' '.$dataSaveNew['note'].' '.$dataSaveNew["min"];
                	    	
                	    	
                            $queryState = "SELECT * FROM tk_states WHERE st_id='".$dd."' ";
                            $rowState = $conn->query($queryState);
                            if ($rowState->num_rows > 0) {
                                $thiState = $rowState->fetch_assoc();
                                $dataState = $thiState['st_name'];
                            }
                            $queryCity = "SELECT * FROM tk_cities WHERE city_id='".$ee."' ";
                            $rowCity = $conn->query($queryCity);
                            if ($rowCity->num_rows > 0) {
                                $thisCity = $rowCity->fetch_assoc();
                                $dataCity = $thisCity['city_name'];
                            }
                            $queryLevel = "SELECT * FROM tk_tution_course WHERE tc_id='".$dataSaveNew['level']."' ";
                            $rowLevel = $conn->query($queryLevel);
                            if ($rowLevel->num_rows > 0) {
                                $thisLevel = $rowLevel->fetch_assoc();
                                $dataLevel = $thisLevel['tc_title'];
                            }
                	    	
                
                	    	$sql = "INSERT INTO tk_specific (state, city, level, parent_rate, tutor_rate_min, tutor_rate_max, note, state_name, city_name, level_name) VALUES 
                		    ('".$dd."', '".$ee."', '".$dataSaveNew['level']."', '".$dataSaveNew['rate']."', '".$dataMin."', '".$dataSaveNew['max']."', '".$newNote."', '".$dataState."', '".$dataCity."', '".$dataLevel."')";
                
                		    if ($conn->query($sql) === TRUE) {
                			    //echo "Success! Record Has Been Saved";
                			    $success_count++;
                		    } else {
                			    echo "Error: " . $sql . "<br>" . $conn->error;
                		    }     
                		    

                	    	/*$sql = "INSERT INTO dbtest (col1, col2, col3, col4, col5, col6, col7, col8, col9, col10) VALUES 
                		    ('".$dd."', '".$data."', '".$dataSaveNew['level']."', '".$dataSaveNew['rate']."', '".$dataMin."', '".$dataSaveNew['max']."', '".$newNote."', '".$dataState."', '".$dataCity."', '".$dataLevel."')";
                
                		    if ($conn->query($sql) === TRUE) {
                			    //echo "Success! Record Has Been Saved";
                		    } else {
                			    //echo "Error: " . $sql . "<br>" . $conn->error;
                		    }*/
                		    
            }
	        
	    }
	    //echo 'Success! Record Has Been Saved';


	}
    if($success_count > 0){
        echo "Success! Record Has Been Saved";
    }else{
        echo "Error";
    }
	
	

}

$conn->close();
?>
