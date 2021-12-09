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
/*
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/
require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$num = 1;
/*
$test = "
SELECT * 
FROM tk_user_details 
WHERE ud_phone_number NOT REGEXP '^[0-9]+$' 
";
*/
$test = "
SELECT * 
FROM tk_user
LEFT JOIN tk_user_details
ON u_id = ud_u_id
WHERE ud_phone_number NOT REGEXP '^[0-9]+$' 
";
$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
    <th>No</th>
    <th>ud_id</th>
    <th>ud_phone_number</th>
    <th>u_displayid</th>

  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){
        
echo '<tr>';
echo '<td>'.$num.' </td>';
echo '<td>'.$rowTest['ud_id'].' </td>';
echo '<td>'.$rowTest['ud_phone_number'].' </td>';
echo '<td>'.$rowTest['u_displayid'].' </td>';



echo '</tr>';
        

		
    $num++;  
    }
    
echo '</table>';
}













?>