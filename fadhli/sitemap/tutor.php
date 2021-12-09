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

// TUTOR
echo ' <font color=red>***** TUTOR *****</font> <br/><br/>';

$qState = " SELECT * FROM tk_user WHERE u_role = '3' AND u_status = 'A' ORDER BY u_id ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    while($rowState = $resultState->fetch_assoc()){
        
                
                $resultIn = 'https://www.tutorkami.com/tutor_profile?did='.$rowState['u_displayid'];
                
                
                $echoResult = '<url>
                  <loc>'.$resultIn.'</loc>
                  <lastmod>2020-05-29T05:44:25+00:00</lastmod>
                  <priority>0.80</priority>
                </url>';
                
                echo htmlentities($echoResult, ENT_QUOTES).'<br/>'; 
                

          
          
          
        		
    }
}








?>