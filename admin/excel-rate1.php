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



$queryRate = " SELECT * FROM tk_specific WHERE (tutor_rate_min = '' OR tutor_rate_max = '') ORDER BY state_name ASC, city_name ASC, level_name ASC";
//$queryRate = " SELECT * FROM tk_specific WHERE tutor_rate_max = ''  ORDER BY state_name ASC, city_name ASC, level_name ASC";
$resultRate = $conn->query($queryRate); 
if($resultRate->num_rows > 0){ 
    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>State</th>
                <th>City</th>
                <th>Level</th>
                <th>Note</th>
            </tr>
    ';
        while($rowRate = $resultRate->fetch_assoc()){
            /*
             $sqlState = "SELECT * FROM tk_states WHERE st_id = '".$rowRate['state']."' ";
             $resultState = $conn->query($sqlState); 
             if($resultState->num_rows > 0){ 
            	$rowState = $resultState->fetch_assoc();
            	$thisState = $rowState["st_name"];
             }
             
            
             $thisID = $rowRate['j_id'];
*/
                $output .= '
                    <tr>  
                        <td>'.$rowRate['state_name'].'</td>
                        <td>'.$rowRate['city_name'].'</td>
                        <td>'.$rowRate['level_name'].'</td>
                        <td>'.$rowRate['note'].'</td>
                    </tr>
                ';
        }
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=rate-one-data.xls');
  echo $output;
}

?>