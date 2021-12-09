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
SELECT * FROM tk_specific_test2 
WHERE state != '1658' AND state != '1046'
ORDER BY state ASC, city DESC
";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
    <th>id</th>
    <th>state</th>
    <th>city</th>
    <th>level</th>
    <th>state_name</th>
    <th>city_name</th>
    <th>level_name</th>
    <th>note</th>
  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){


        $state = " SELECT * FROM tk_states WHERE st_id = '".$rowTest['state']."' ";
        $astate = $conn->query($state);
        if ($astate->num_rows > 0) {
            $bstate = $astate->fetch_assoc();
            $tisstate = $bstate['st_name'];
        }
        
        
        $stateC = " SELECT * FROM tk_cities WHERE city_id = '".$rowTest['city']."' ";
        $astateC = $conn->query($stateC);
        if ($astateC->num_rows > 0) {
            $bstateC = $astateC->fetch_assoc();
            $tisstateC = $bstateC['city_name'];
        }
        
        if( $rowTest['city_name'] != $tisstateC ){

                echo '<tr>';
                echo '<td>'.$rowTest['id'].' </td>';
                echo '<td>'.$rowTest['state'].' '.$tisstate.'</td>';
                echo '<td>'.$rowTest['city'].' '.$tisstateC.'</td>';
                echo '<td>'.$rowTest['level'].' </td>';
                echo '<td>'.$rowTest['state_name'].' </td>';
                echo '<td>'.$rowTest['city_name'].' </td>';
                echo '<td>'.$rowTest['level_name'].' </td>';
                echo '<td>'.$rowTest['note'].' </td>';
                echo '</tr>';                          
        }
        

        


     



        

        
     $num++;     
    }
    
    echo '</table>';
}













?>