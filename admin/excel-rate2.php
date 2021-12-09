<?php  
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

            /*
             $sqlState = "SELECT * FROM tk_states WHERE st_id = '".$rowRate['state']."' ";
             $resultState = $conn->query($sqlState); 
             if($resultState->num_rows > 0){ 
            	$rowState = $resultState->fetch_assoc();
            	$thisState = $rowState["st_name"];
             }
             $thisID = $rowRate['j_id'];
            */


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
            </tr>
    ';
        while($rowState = $resultState->fetch_assoc()){
            $thisLevel = '';
            $querySpecific = " SELECT * FROM tk_specific WHERE state_name ='".$rowState['st_name']."' AND city_name ='".$rowState['city_name']."' ORDER BY level_name ASC ";
            $resultSpecific = $conn->query($querySpecific); 
            if($resultSpecific->num_rows > 0){
                
                while($rowSpecific = $resultSpecific->fetch_assoc()){
                    $thisLevel .= $rowSpecific['level_name'].',';
                    
                }
                if($thisLevel != ''){
                    //$a1 = array($thisLevel);
                    $a1 = (explode(",",$thisLevel));
                    $a2 = array('Pre-School','Tahap 1 (Tahun 1-3)','Tahap 2 (UPSR)','Form 1-3 (PT3)','Form 4-5 (SPM)','Primary (International Syllabus)','Lower Secondary (International Syllabus)','Year 10-11 (IGCSE)','Others / Lain-lain');
                    $result = array_diff($a2, $a1);  
                    if(!empty($result)){
                        $output .= '
                            <tr>  
                                <td>'.$rowState['st_name'].'</td>
                                <td>'.$rowState['city_name'].'</td>
                                <td>'.implode(",",$result).'</td>
                            </tr>
                        ';  
                    }
                }
                
            }else{
                    $output .= '
                        <tr>  
                            <td>'.$rowState['st_name'].'</td>
                            <td>'.$rowState['city_name'].'</td>
                            <td>ALL LEVEL</td>
                        </tr>
                    ';    
            }

                    /*$output .= '
                        <tr>  
                            <td>'.$rowState['st_id'].'</td>
                            <td>'.$rowState['city_id'].'</td>
                            <td>'.$rowState['st_name'].'</td>
                            <td>'.$rowState['city_name'].'</td>
                        </tr>
                    ';  */          

        }
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=rate-no-data.xls');
  echo $output;
}

?>