
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

$test = "
SELECT * FROM tk_specific WHERE note !=''

";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {
/*
echo '
<table>
  <tr>
    <th>No</th>
    <th>State</th>
    <th>City</th>
    <th>NOTE</th>

  </tr>';
*/
    
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
        $queryLevel = "SELECT * FROM tk_tution_course WHERE tc_id = '".$rowTest['level']."' "; 
        $resultLevel = $conn->query($queryLevel); 
        if($resultLevel->num_rows > 0){ 
            $rowLevel = $resultLevel->fetch_assoc();
            $nameLevel = $rowLevel['tc_title'];  
        }
        
        //$sql = " UPDATE tk_specific SET state_name='$nameState', city_name='$nameCity', level_name='$nameLevel' WHERE id='".$rowTest['id']."' ";
        //$conn->query($sql);   
        
        //$sql = " UPDATE tk_specific SET checkbox='true' WHERE id='".$rowTest['id']."' ";
        //$conn->query($sql);  

        
/*
          echo '<tr>
            <td>'.$rowTest['id'].' </td>
            <td>'.$nameState.' </td>
            <td>'.$nameCity.' </td>
            <td>'.$rowTest['note'].' </td>
            
          </tr>';
        		
            $num++; */
    }
    
//echo '</table>';
}













?>