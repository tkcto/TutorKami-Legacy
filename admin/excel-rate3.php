<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<?php  
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$queryState = " SELECT st_id, st_name, city_id, city_name, city_st_id FROM tk_states 
LEFT JOIN tk_cities ON city_st_id = st_id
ORDER BY st_name ASC, city_name ASC
";
$resultState = $conn->query($queryState); 
if($resultState->num_rows > 0){

    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>State</th>
                <th>City</th>
                <th>Level</th>
                <th>Note</th>
            </tr>
    ';
    

        while($rowState = $resultState->fetch_assoc()){
            $number = 1;
            $querySpecific = " SELECT level, state_name, city_name, level_name, note, tutor_rate_min, tutor_rate_max FROM tk_specific WHERE (tutor_rate_min = '' OR tutor_rate_max = '') AND note NOT LIKE '%Standard Price%' AND state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' ORDER BY level ASC  ";
            $resultSpecific = $conn->query($querySpecific);
            if($resultSpecific->num_rows > 0){
                while($rowSpecific = $resultSpecific->fetch_assoc()){
                        if( $number == '1'){
                            $thisState = $rowSpecific['state_name'];
                            $thisCity = $rowSpecific['city_name'];
                        }else{
                            $thisState = '';
                            $thisCity = '';
                        }
                            $output .= '
                                <tr>  
                                    <td>'.$thisState.'</td>
                                    <td>'.$thisCity.'</td>
                                    <td>'.$rowSpecific['level_name'].'</td>
                                    <td>'.nl2br($rowSpecific['note']).'</td>
                                </tr>
                            ';
                $number++;             
                }
                
                
                
                $thisLevel = '';
                $thisLevel2 = '';
                $querySpecificW = " SELECT state_name, city_name, level_name, level, note FROM tk_specific WHERE state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' AND note NOT LIKE '%Standard Price%' ORDER BY level ASC  ";
                $resultSpecificW = $conn->query($querySpecificW); 
                if($resultSpecificW->num_rows > 0){
                    
                    while($rowSpecific = $resultSpecificW->fetch_assoc()){
                        $thisLevel .= $rowSpecific['level_name'].',';
                        
                    }
                    if($thisLevel != ''){
                        //$a1 = array($thisLevel);
                        $a1 = (explode(",",$thisLevel));
                        $a2 = array('Pre-School','Tahap 1 (Tahun 1-3)','Tahap 2 (UPSR)','Form 1-3 (PT3)','Form 4-5 (SPM)','Primary (International Syllabus)','Lower Secondary (International Syllabus)','Year 10-11 (IGCSE)');
                        $result = array_diff($a2, $a1);  
                        
                        

                            $querySpecificNotSP = " SELECT state_name, city_name, level_name, note FROM tk_specific WHERE note LIKE '%Standard Price%' AND state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' ";
                            $resultSpecificNotSP = $conn->query($querySpecificNotSP);
                            if($resultSpecificNotSP->num_rows > 0){
                                while($rowSpecificNotSP = $resultSpecificNotSP->fetch_assoc()){
                                    $thisLevel2 .= $rowSpecificNotSP['level_name'].',';
                                }
                                
                            }
                            
                            $a5 = (explode(",",$thisLevel2));
                            $result5 = array_diff($result, $a5);  
                        
                        
                        if(!empty($result5)){

                                foreach ($result5 as $cell) {
                                    $output .= "<tr><td></td>"."<td></td>"."<td>" . $cell . "</td>"."<td></td></tr>";
                                }

                        }
                    }
                    
                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

            }else{
                

          






            $thisLevel = '';
            $querySpecific = " SELECT level, state_name, city_name, level_name, note, tutor_rate_min, tutor_rate_max FROM tk_specific WHERE (tutor_rate_min != '' OR tutor_rate_max != '') AND note NOT LIKE '%Standard Price%' AND state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' ORDER BY level ASC  ";
            $resultSpecific = $conn->query($querySpecific);
            if($resultSpecific->num_rows > 0){
                
                while($rowSpecific = $resultSpecific->fetch_assoc()){
                    $thisLevel .= $rowSpecific['level_name'].',';
                }
                    if($thisLevel != ''){
                        $a1 = (explode(",",$thisLevel));
                        $a2 = array('Pre-School','Tahap 1 (Tahun 1-3)','Tahap 2 (UPSR)','Form 1-3 (PT3)','Form 4-5 (SPM)','Primary (International Syllabus)','Lower Secondary (International Syllabus)','Year 10-11 (IGCSE)');
                        $result = array_diff($a2, $a1);  
                        if(!empty($result)){
                                $first = true;
                                foreach ($result as $cell) {
                                    if ( $first ){
                                        $arrayResultState = $rowState['st_name'];
                                        $arrayResultcity = $rowState['city_name'];
                                        $first = false;
                                    }else{
                                        $arrayResultState = '';
                                        $arrayResultcity = '';
                                    }
                                    $output .= "<tr><td>" . $arrayResultState . "</td>"."<td>" . $arrayResultcity . "</td>"."<td>" . $cell . "</td>"."<td></td></tr>";
                                }

                        }
                    }


            }else{
                $number2 = 1;
                $queryLevel = " SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id !='9' ORDER BY tc_id ASC ";
                $resultLevel = $conn->query($queryLevel); 
                if($resultLevel->num_rows > 0){
                    while($rowLevel = $resultLevel->fetch_assoc()){     
                        if( $number2 == '1'){
                            $thisState = $rowState['st_name'];
                            $thisCity = $rowState['city_name'];
                        }else{
                            $thisState = '';
                            $thisCity = '';
                        }
                        
                        
                            $querySpecificNotSP = " SELECT level, state_name, city_name, level_name, note, tutor_rate_min, tutor_rate_max FROM tk_specific WHERE note LIKE '%Standard Price%' AND state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' AND level_name ='".$rowLevel['tc_title']."' ";
                            $resultSpecificNotSP = $conn->query($querySpecificNotSP);
                            if($resultSpecificNotSP->num_rows > 0){
                                
                            }else{
                                        $output .= '
                                            <tr>  
                                                <td>'.$thisState.'</td>
                                                <td>'.$thisCity.'</td>
                                                <td>'.$rowLevel['tc_title'].'</td>
                                                <td></td>
                                            </tr>
                                        ';
                                $number2++;                                     
                            }
                        
                        
   
                    }
                }
            }














                
                
                /*
                $number2 = 1;
                $queryLevel = " SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id !='9' ORDER BY tc_id ASC ";
                $resultLevel = $conn->query($queryLevel); 
                if($resultLevel->num_rows > 0){
                    while($rowLevel = $resultLevel->fetch_assoc()){     
                        if( $number2 == '1'){
                            $thisState = $rowState['st_name'];
                            $thisCity = $rowState['city_name'];
                        }else{
                            $thisState = '';
                            $thisCity = '';
                        }
                            $output .= '
                                <tr>  
                                    <td>'.$thisState.'</td>
                                    <td>'.$thisCity.'</td>
                                    <td>'.$rowLevel['tc_title'].'</td>
                                    <td></td>
                                </tr>
                            ';
                    $number2++;        
                    }
                }*/

            }    
                    



                     
    
        
            

      

        }
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=combine-data.xls');
  echo $output;
}

?>