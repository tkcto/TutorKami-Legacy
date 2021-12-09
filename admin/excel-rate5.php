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


$queryRate = " SELECT * FROM tk_specific ORDER BY state_name ASC, city_name ASC, level_name ASC";
$resultRate = $conn->query($queryRate); 
if($resultRate->num_rows > 0){ 
    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>State</th>
                <th>City</th>
                <th>Level</th>
            </tr>
    ';
        while($rowRate = $resultRate->fetch_assoc()){
            
            
            
        if (strpos($rowRate['tutor_rate_min'], ".") !== false) {
            $rateMin = 0;
        }else{
            $rateMin = $rowRate['tutor_rate_min'];
        } 
        
        if (strpos($rowRate['tutor_rate_max'], ".") !== false) {
            $rateMax = 0;
        }else{
            $rateMax = $rowRate['tutor_rate_max'];
        }
            
        $numlengthMin = strlen((string)$rateMin);
        $numlengthMax = strlen((string)$rateMax);
        
        if( $numlengthMin > 2 || $numlengthMax > 2 ){

                                $output .= '
                                    <tr>  
                                        <td>'.$rowRate['state_name'].'</td>
                                        <td>'.$rowRate['city_name'].'</td>
                                        <td>'.$rowRate['level_name'].'</td>
                                        
                                    </tr>
                                ';                
        }else{
            
        }
        
        


                

        }
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=not-two-digit.xls');
  echo $output;
}

?>