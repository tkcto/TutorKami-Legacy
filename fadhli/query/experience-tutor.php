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
";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
    <th>No</th>
    <th>Display ID</th>
    <th>Year / Month</th>
    <th>Experience</th>
  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){
        
echo '<tr>';
echo '<td>'.$num.' </td>';
echo '<td>'.$rowTest['u_displayid'].' </td>';
echo '<td>'.$rowTest['ud_tutor_experience_month'].' </td>';

        if(!preg_match('#[^0-9]#',$rowTest['ud_tutor_experience'])){
            //echo "Value is numeric";
            echo '<td>'.$rowTest['ud_tutor_experience'].' </td>';
        }else{
            //echo "Value not numeric";
            echo '<td>Value not numeric = '.$rowTest['ud_tutor_experience'].'</td>';
        }
echo '</tr>';
        
   
      /*echo '<tr>
        <td>'.$num.' </td>
        <td>'.$rowTest['u_id'].' </td>
        <td>'.$rowTest['ud_tutor_experience'].' </td>
      </tr>';*/
		
    $num++;  
    }
    
echo '</table>';
}













?>