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
SELECT * FROM tk_user
INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
WHERE u_role = '3' AND ud_tutor_experience !=''
";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {
/*
echo '
<table>
  <tr>
    <th>No</th>
    <th>u_id</th>
    <th>ud_u_id2</th>
    <th>Experience</th>
  </tr>';
*/
    
    while($rowTest = $resultTest->fetch_assoc()){


        if(!preg_match('#[^0-9]#',$rowTest['ud_tutor_experience'])){
        }else{
        
        
if (strpos($rowTest['ud_tutor_experience'], 'month') !== false) {
/*
echo '<tr>';
echo '<td>'.$num.' </td>';
echo '<td>'.$rowTest['u_id'].' </td>';
echo '<td>'.$rowTest['ud_u_id'].' </td>';
            echo '<td>'.$rowTest['ud_tutor_experience'].' </td>';
echo '</tr>';
    $num++;  
*/
            //$sql = " UPDATE tk_user_details SET ud_tutor_experience_month='month' WHERE ud_u_id='".$rowTest['ud_u_id']."' ";
            //$conn->query($sql);            

}

        }

        
        
    }
    
//echo '</table>';
}













?>