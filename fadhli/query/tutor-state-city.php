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
require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}



$num = 1;

$test = "
SELECT * FROM tk_user
INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
WHERE u_role = '3' 
AND ud_city REGEXP '[a-zA-Z]';
";



$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
    <th>No</th>
    <th>Display ID</th>
    <th>City</th>

  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){
        
        
        $queryCity = "SELECT * FROM tk_cities WHERE city_name = '".$rowTest['ud_city']."' "; 
        $resultCity = $conn->query($queryCity); 
        if($resultCity->num_rows > 0){ 
            $rowCity = $resultCity->fetch_assoc();
            $nameCity = $rowCity['city_name']; 

            $cityCode = $rowCity['city_id'];  
            $stateCode = $rowCity['city_st_id'];  
            
            //$sqlUpdate = " UPDATE tk_user_details SET ud_city = '".$cityCode."', ud_state = '".$stateCode."' WHERE ud_u_id = '".$rowTest['ud_u_id']."' ";
            //$conn->query($sqlUpdate);
    
        }
        /*else{
            $nameCity = 'NULL';
            $stateCode = 'NULL';
        }*/

echo '<tr>';
echo '<td>'.$num.' </td>';
echo '<td>'.$rowTest['u_displayid'].' </td>';
echo '<td>'.$rowTest['ud_city'].' </td>';


echo '</tr>';
        

		
    $num++;  
    }
    
echo '</table>';
}













?>