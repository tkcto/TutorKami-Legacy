
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
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$num = 1;
/*
$test = "
SELECT * FROM tk_specific
WHERE ( state = '1046' OR state = '1658' ) AND 
( level = '1' OR level = '2' OR level = '3' OR level = '4' OR level = '5' ) AND
tutor_rate_min !='' AND tutor_rate_max != ''
ORDER BY state ASC, city ASC, level ASC
";
*/
$test = "
SELECT * FROM tk_specific
WHERE
( level = '1' OR level = '2' OR level = '3' OR level = '4' OR level = '5' ) AND
tutor_rate_min !='' AND tutor_rate_max != ''
GROUP BY city 
HAVING COUNT(*)>=5
ORDER BY state ASC, city DESC
";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
    <th>No</th>
    <th>State</th>
    <th>City</th>

  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){
        
        $queryState = "SELECT * FROM tk_states WHERE st_id = '".$rowTest['state']."' "; 
        $resultState = $conn->query($queryState); 
        if($resultState->num_rows > 0){ 
            $rowState = $resultState->fetch_assoc();
            $nameState = $rowState['st_name'];  
        }
        $queryCity = "SELECT * FROM tk_cities WHERE city_id = '".$rowTest['city']."' "; 
        $resultCity = $conn->query($queryCity); 
        if($resultCity->num_rows > 0){ 
            $rowCity = $resultCity->fetch_assoc();
            $nameCity = $rowCity['city_name'];  
        }
        $queryLevel = "SELECT * FROM tk_job_level_translation WHERE jlt_jl_id = '".$rowTest['level']."' "; 
        $resultLevel = $conn->query($queryLevel); 
        if($resultLevel->num_rows > 0){ 
            $rowLevel = $resultLevel->fetch_assoc();
            $nameLevel = $rowLevel['jlt_title'];  
        }
        

          echo '<tr>
            <td>'.$num.' </td>
            <td>'.$nameState.' </td>
            <td>'.$nameCity.' </td>
            
          </tr>';
        		
            $num++; 
    }
    
echo '</table>';
}













?>