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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$num = 1;

//WHERE state = '1658' OR state = '1046'
$test = "
SELECT * FROM tk_specific 
GROUP BY city, state
ORDER BY city_name ASC
";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
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
        }else{
            $tisstateC = '';
        }


            $test2 = "
            SELECT * FROM tk_specific
            WHERE state_name != '".$rowTest['state_name']."' AND city_name = '".$rowTest['city_name']."' AND id != '".$rowTest['id']."'
            GROUP BY state_name
            ORDER BY city_name ASC
            ";
            $resultTest2 = $conn->query($test2);
            if ($resultTest2->num_rows > 0) {
                while($rowTest2 = $resultTest2->fetch_assoc()){
                    
                    echo '<tr>';
                    echo '<td>'.$rowTest2['state_name'].'</td>';
                    echo '<td>'.$rowTest2['city_name'].'</td>';
                    echo '<td>'.$rowTest2['level_name'].' </td>';
                    echo '<td><textarea rows="3" cols="50">'.$rowTest2['note'].'</textarea></td>';
                    echo '</tr>';                      
                }
            }


        
     $num++;     
    }
    
    echo '</table>';
}
?>









<?php
/*
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$num = 1;

//WHERE state = '1658' OR state = '1046'
$test = "
SELECT * FROM tk_specific 
ORDER BY state DESC, city DESC
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
        }else{
            $tisstateC = '';
        }


        if( $rowTest['city_name'] != $tisstateC ){
            
            


                echo '<tr>';
                echo '<td>'.$rowTest['id'].'</td>';
                echo '<td>'.$tisstate.'</td>';
                echo '<td>'.$rowTest['city_name'].'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$rowTest['level_name'].' </td>';
                echo '<td><textarea rows="3" cols="50">'.$rowTest['note'].'</textarea></td>';
                echo '</tr>';     

        }



     



        

        
     $num++;     
    }
    
    echo '</table>';
}
*/
?>



