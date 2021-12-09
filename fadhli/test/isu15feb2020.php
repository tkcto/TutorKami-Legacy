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
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed'
GROUP BY city
ORDER BY state ASC, city DESC
";*/




/*
$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1037'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1038'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1039'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1040'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1041'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1042'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1046'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1047'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1657'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1658'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1659'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1660'
GROUP BY city
ORDER BY state ASC, city ASC
";

$test = "
SELECT * FROM tk_job
WHERE j_payment_status = 'paid' AND j_status = 'closed' AND state = '1661'
GROUP BY city
ORDER BY state ASC, city ASC
";
*/



$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {
/*
echo '
<table>
  <tr>
    <th>No</th>
    <th>Job ID</th>
    <th>State</th>
    <th>City</th>
  </tr>';
*/
    
    while($rowTest = $resultTest->fetch_assoc()){
/*
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
*/

        $test2 = " SELECT * FROM tk_specific WHERE state = '".$rowTest['state']."' AND city = '".$rowTest['city']."' ";
        $resultTest2 = $conn->query($test2);
        if ($resultTest2->num_rows > 0) {
            $rowthis = $resultTest2->fetch_assoc();
            $thisID = $rowthis['id'];  
/*
        $queryState2 = "SELECT * FROM tk_states WHERE st_id = '".$rowthis['state']."' "; 
        $resultState2 = $conn->query($queryState2); 
        if($resultState2->num_rows > 0){ 
            $rowState2 = $resultState2->fetch_assoc();
            $nameState2 = $rowState2['st_name'];  
        }
        $queryCity2 = "SELECT * FROM tk_cities WHERE city_id = '".$rowthis['city']."' "; 
        $resultCity2 = $conn->query($queryCity2); 
        if($resultCity2->num_rows > 0){ 
            $rowCity2 = $resultCity2->fetch_assoc();
            $nameCity2 = $rowCity2['city_name'];  
        }*/
           
            //$sql = " UPDATE tk_specific SET checkbox='true' WHERE id='".$thisID."' ";
            //$conn->query($sql);

/*
  echo '<tr>
    <td>'.$num.' </td>
    <td>'.$rowthis['id'].' </td>
    <td>'.$rowthis['state'].' - '.$nameState2.' </td>
    <td>'.$rowthis['city'].' - '.$nameCity2.' </td>
  </tr>';   
   */     
            
        }

/*
  echo '<tr>
    <td>'.$num.' </td>
    <td>'.$rowTest['j_id'].' </td>
    <td>'.$rowTest['state'].' - '.$nameState.' </td>
    <td>'.$rowTest['city'].' - '.$nameCity.' </td>
  </tr>';    

*/



		
    //$num++;  
    }
    
//echo '</table>';
}








?>