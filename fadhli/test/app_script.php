
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

date_default_timezone_set("Asia/Kuala_Lumpur");

$json_url = 'https://script.google.com/macros/s/AKfycbx2YKKJMxS_473Gs_SaB1PrhhKrrlaGjo9PcbsK4ZTIgiYSBU0/exec';
$json = file_get_contents($json_url);
    
$data = json_decode($json, true);
$entries = $data['user'];

echo '
<table>
  <tr>
    <th>Date Client Paid</th>
    <th>Job</th>
    <th>Tutors Name</th>
    <th>Received</th>
    <th>Note</th>
    
    <th>Date Tutor Paid</th>
    <th>Paid to Tutor</th>
    <th>GST</th>
    <th>Gross Profit</th>
    <th>Hour</th>
    <th>Note</th>

  </tr>';

    $i = 0;
    foreach ($entries as $entry) {


/*
        $date = date("d/m/Y", strtotime($entry['date']));
        $job = $entry['job'];
        $tutor = $entry['tutor'];
        $amount = $entry['amount'];
        $hours = $entry['hours'];
*/
  
          echo '<tr>
            <td>'.date('d/m/Y', strtotime($entry['date'])).' </td>
            <td>'.$entry['job'].' </td>
            <td>'.$entry['tutor'].' </td>
            <td>'.$entry['amount'].' </td>
            <td>'.$entry['note'].' </td>
            
            <td>'.$entry['hiden'].' </td>
            <td>'.$entry['tutor_paid'].' </td>
            <td>'.$entry['kosong'].' </td>
            <td>'.$entry['gst'].' </td>
            <td>'.$entry['gp'].' </td>
            <td>'.$entry['hours'].' </td>
            <td>'.$entry['note_last'].' </td>
            
          </tr>';
        


    $i++;
    }

echo '</table>';
/*
$num = 1;
$test = " SELECT * FROM tk_specific WHERE note !='' ";
$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

echo '
<table>
  <tr>
    <th>No</th>
    <th>State</th>
    <th>City</th>
    <th>NOTE</th>

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

          echo '<tr>
            <td>'.$rowTest['id'].' </td>
            <td>'.$nameState.' </td>
            <td>'.$nameCity.' </td>
            <td>'.$rowTest['note'].' </td>
            
          </tr>';
            $num++;
    }

echo '</table>';
}

*/











?>