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
INNER JOIN tk_user_testimonial ON tk_user_testimonial.ut_u_id = tk_user.u_id
WHERE u_role = '3'
";
$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {
echo '
<table>
  <tr>
    <th>NO</th>
    <th>ID</th>
    <th>STATUS</th>
    <th>DISPLAY ID</th>
    <th>TESTI 1</th>
    <th>TESTI 2</th>
    <th>TESTI 3</th>
    <th>TESTI 4</th>

  </tr>';
   
    while($rowTest = $resultTest->fetch_assoc()){
				
		if( $rowTest['ut_user_testimonial1'] != '' || $rowTest['ut_user_testimonial2'] != '' || $rowTest['ut_user_testimonial3'] != '' || $rowTest['ut_user_testimonial4'] ){
                echo '<tr>';
                echo '<td>'.$num.'</td>';
                echo '<td>'.$rowTest['u_id'].'</td>';
                //echo '<td>'.$rowTest['u_status'].'</td>';
				if( $rowTest['u_status'] == 'A' ){
					echo '<td> <font color="#30932F"><b>Active</b></font> </td>';
				}else if( $rowTest['u_status'] == 'B' ){
					echo '<td> <font color="#B02D2D"><b>Banned</b></font> </td>';
				}else{
					echo '<td>ELSE</td>';
				}
				
				
				
                echo '<td> <font color="#2D63B0"><b>'.$rowTest['u_displayid'].'</b></font> </td>';
				
                //echo '<td>'.$rowTest['ut_user_testimonial1'].'</td>';
				if (file_exists('../../'.$rowTest['ut_user_testimonial1'])) {
					//exists
					//echo '<td> ADA = '.$rowTest['ut_user_testimonial1'].'</td>';
					//echo '<td> <img src="../../'.$rowTest['ut_user_testimonial1'].'" width="50" height="50"> </td>';
					//echo '<td> Exists </td>';
					if( $rowTest['ut_user_testimonial1'] != ''){
						echo '<td> Exists </td>';
					}else{
						echo '<td> </td>';
					}
				}else {
					//does not exists
					//echo '<td> XDA = '.$rowTest['ut_user_testimonial1'].'</td>';
					echo '<td> <font color="#B02D2D"><b>Does Not Exists</b></font> </td>';
				}
				
                //echo '<td>'.$rowTest['ut_user_testimonial2'].'</td>';
				if (file_exists('../../'.$rowTest['ut_user_testimonial2'])) {
					//echo '<td> Exists </td>';
					if( $rowTest['ut_user_testimonial2'] != ''){
						echo '<td> Exists </td>';
					}else{
						echo '<td> </td>';
					}
				}else {
					echo '<td> <font color="#B02D2D"><b>Does Not Exists</b></font> </td>';
				}

                //echo '<td>'.$rowTest['ut_user_testimonial3'].'</td>';
				if (file_exists('../../'.$rowTest['ut_user_testimonial3'])) {
					//echo '<td> Exists </td>';
					if( $rowTest['ut_user_testimonial3'] != ''){
						echo '<td> Exists </td>';
					}else{
						echo '<td> </td>';
					}
				}else {
					echo '<td> <font color="#B02D2D"><b>Does Not Exists</b></font> </td>';
				}
				
                //echo '<td>'.$rowTest['ut_user_testimonial4'].'</td>';
				if (file_exists('../../'.$rowTest['ut_user_testimonial4'])) {
					//echo '<td> Exists </td>';
					if( $rowTest['ut_user_testimonial4'] != ''){
						echo '<td> Exists </td>';
					}else{
						echo '<td> </td>';
					}
				}else {
					echo '<td> <font color="#B02D2D"><b>Does Not Exists</b></font> </td>';
				}
				
                echo '</tr>'; 
		$num++;    				
		}/*
                echo '<tr>';
                echo '<td>'.$num.'</td>';
                echo '<td>'.$rowTest['u_id'].'</td>';
                echo '<td>'.$rowTest['u_displayid'].'</td>';
                echo '<td>'.$rowTest['ut_user_testimonial1'].'</td>';
                echo '<td>'.$rowTest['ut_user_testimonial2'].'</td>';
                echo '<td>'.$rowTest['ut_user_testimonial3'].'</td>';
                echo '<td>'.$rowTest['ut_user_testimonial4'].'</td>';
                echo '</tr>'; 


     $num++;     */
    }
    echo '</table>';
}








?>