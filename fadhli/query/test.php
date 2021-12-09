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





$test = "
SELECT * FROM tk_payment_history WHERE ph_date LIKE '%2020%' AND ph_rf != '0.00'
AND ph_id != '80'
AND ph_id != '451'
AND ph_id != '844'
AND ph_id != '1039'
AND ph_id != '1157'
";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>

    <th>ph_id</th>
    <th>ph_date</th>
    <th>ph_amount</th>
    <th>ph_rf</th>
    <th>Bal</th>
  </tr>';

    
    while($rowTest = $resultTest->fetch_assoc()){
        
        $cal = number_format((float)($rowTest['ph_amount'] - $rowTest['ph_rf']), 2, '.', '');
        
        //$sqlUpdate = " UPDATE tk_payment_history SET ph_amount = '".$cal."' WHERE ph_id = '".$rowTest['ph_id']."' ";
        //$conn->query($sqlUpdate);
        //echo $rowTest['ph_id'].' '.$rowTest['ph_date'].' '.$rowTest['ph_amount'].' '.$rowTest['ph_rf'].' '.$cal.'<br/>';
        
echo '<tr>';

echo '<td>'.$rowTest['ph_id'].' </td>';
echo '<td>'.$rowTest['ph_date'].' </td>';
echo '<td>'.$rowTest['ph_amount'].' </td>';
echo '<td>'.$rowTest['ph_rf'].' </td>';
echo '<td>'.$cal.' </td>';


echo '</tr>';
        

		

    }
    
echo '</table>';
}













?>