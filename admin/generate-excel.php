<?php 
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$output = '';

$queryJob = " SELECT * FROM tk_job WHERE ( j_deadline !='' AND j_deadline !='0000-00-00' AND j_end_date !='' AND j_end_date !='0000-00-00' )
ORDER BY j_id DESC
";

$resultQueryJob = $conn->query($queryJob); 
if($resultQueryJob->num_rows > 0){ 
    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>ID</th>
                <th>Date</th>
                <th>Deadline</th>
                <th>End Date</th>
                <th>Parent Rate</th>
                <th>Tutor Rate</th>
                <th>Duration</th>
            </tr>
    ';
while($rowQueryJob = $resultQueryJob->fetch_assoc()){

$timeStampCreateDate = strtotime($rowQueryJob["j_create_date"]);
$createDate = date("d/m/Y", $timeStampCreateDate);

$timeStampDeadline = strtotime($rowQueryJob["j_deadline"]);
$deadline = date("d/m/Y", $timeStampDeadline);
    
$timeStampEndDate = strtotime($rowQueryJob["j_end_date"]);
$endDate = date("d/m/Y", $timeStampEndDate);
    
$now = strtotime($rowQueryJob["j_deadline"]);
$your_date = strtotime($rowQueryJob["j_end_date"]);
$datediff = $now - $your_date;
$duration =  round($datediff / (60 * 60 * 24));

    $output .= '
        <tr>  
            <td>'.$rowQueryJob["j_id"].'</td>
            <td>'.$createDate.'</td>
            <td>'.$deadline.'</td>
            <td>'.$endDate.'</td>
            <td>'.$rowQueryJob["parent_rate"].'</td>
            <td>'.$rowQueryJob["j_rate"].'</td>
            <td>'.$duration .'</td>
        </tr>
    ';
}
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Generate-Excel.xls');
  echo $output;
}

?>