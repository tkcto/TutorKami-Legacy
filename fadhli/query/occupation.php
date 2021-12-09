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
WHERE u_role = '3' AND
ud_current_occupation != 'Lecturer' AND ud_current_occupation != 'Full-Time tutor' AND ud_current_occupation != 'Secondary school teacher'
AND ud_current_occupation != 'Other' AND ud_current_occupation != 'Tuition Center Teacher' AND ud_current_occupation != 'Primary school teacher'
AND ud_current_occupation != 'Kindergarten teacher' AND ud_current_occupation != 'Ex-Teacher' AND ud_current_occupation != 'Retired teacher'
";



$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
    <th>No</th>
    <th>Display ID</th>
    <th>Occupation</th>
  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){
        
echo '<tr>';
echo '<td>'.$num.' </td>';
echo '<td>'.$rowTest['u_displayid'].' </td>';
echo '<td>'.$rowTest['ud_current_occupation'].' </td>';


echo '</tr>';
        

		
    $num++;  
    }
    
echo '</table>';
}













?>