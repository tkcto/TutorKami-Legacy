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





//$output = '';

$queryJob = " SELECT * FROM tk_user WHERE u_role = '3' AND u_status = 'A' ORDER BY u_id ASC ";

$resultQueryJob = $conn->query($queryJob); 
if($resultQueryJob->num_rows > 0){ 
    /*$output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>ID</th>
                <th>Date</th>
            </tr>
    ';*/
$output .= '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
                
';
    
while($rowQueryJob = $resultQueryJob->fetch_assoc()){

    
                $resultIn = 'https://www.tutorkami.com/tutor_profile?did='.$rowQueryJob['u_displayid'];
                
                $echoResult = '<url> <loc>'.$resultIn.'</loc> <lastmod>2020-05-29T05:44:25+00:00</lastmod> <priority>0.80</priority> </url>';
                

                $output .= $echoResult." \n"; 
            
    
}
  
  
  $output .= '</urlset>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Tutor Profiles.xml');
  echo $output;
}

?>