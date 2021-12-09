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

// START STATE & CITY ONLY
echo ' <font color=red>***** STATE & CITY ONLY *****</font> <br/><br/>';

$qState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    while($rowState = $resultState->fetch_assoc()){
        
        //$stateName = str_replace(' ', '-', $rowState['st_name']);  // Replacing Spaces with -
        //echo $stateName.'<br/>';
        
        $qCity = " SELECT * FROM tk_cities WHERE city_st_id = '".$rowState['st_id']."' ORDER BY city_name ASC ";
        $resultCity = $conn->query($qCity);
        if ($resultCity->num_rows > 0) {
            while($rowCity = $resultCity->fetch_assoc()){
                
                $stateName = str_replace(' ', '-', $rowState['st_name']);  // Replacing Spaces with -
                $cityName = str_replace(' ', '-', $rowCity['city_name']);  // Replacing Spaces with -
                //echo 'https://www.tutorkami.com/guru-tuisyen?/'.$cityName.'/'.$stateName.'<br/>';
                $resultIn = 'https://www.tutorkami.com/guru-tuisyen?/'.$cityName.'/'.$stateName;
                
                
                $echoResult = '<url>
                  <loc>'.$resultIn.'</loc>
                  <lastmod>2020-05-29T05:44:25+00:00</lastmod>
                  <priority>0.80</priority>
                </url>';
                
                //echo htmlentities($echoResult, ENT_QUOTES).'<br/>'; 
                
            }
        }
          
          
          
        		
    }
}
// END STATE & CITY ONLY



// START STATE, CITY & LEVEL ONLY
echo '<br/><br/> <font color=red>***** STATE, CITY & LEVEL ONLY *****</font> <br/><br/>';

$qState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    while($rowState = $resultState->fetch_assoc()){
        
        //$stateName = str_replace(' ', '-', $rowState['st_name']);  // Replacing Spaces with -
        //echo $stateName.'<br/>';
        
        $qCity = " SELECT * FROM tk_cities WHERE city_st_id = '".$rowState['st_id']."' ORDER BY city_name ASC ";
        $resultCity = $conn->query($qCity);
        if ($resultCity->num_rows > 0) {
            while($rowCity = $resultCity->fetch_assoc()){
                /*
                $stateName = str_replace(' ', '-', $rowState['st_name']);  // Replacing Spaces with -
                $cityName = str_replace(' ', '-', $rowCity['city_name']);  // Replacing Spaces with -
                $resultIn = 'https://www.tutorkami.com/guru-tuisyen?/'.$cityName.'/'.$stateName;
                
                
                $echoResult = '<url>
                  <loc>'.$resultIn.'</loc>
                  <lastmod>2020-05-29T05:44:25+00:00</lastmod>
                  <priority>0.80</priority>
                </url>';
                
                echo htmlentities($echoResult, ENT_QUOTES).'<br/>'; */
                $qLevel = " SELECT * FROM tk_tution_course WHERE tc_id !='9' ORDER BY tc_id ASC ";
                $resultLevel = $conn->query($qLevel);
                if ($resultLevel->num_rows > 0) {
                    while($rowLevel = $resultLevel->fetch_assoc()){
                        
                        $stateName = str_replace(' ', '-', $rowState['st_name']);  // Replacing Spaces with -
                        $cityName = str_replace(' ', '-', $rowCity['city_name']);  // Replacing Spaces with -
                        $LevelName = str_replace(' ', '-', $rowLevel['tc_title']);  // Replacing Spaces with -
                        $resultIn = 'https://www.tutorkami.com/guru-tuisyen?/'.$LevelName.'/'.$cityName.'/'.$stateName;
                        
                        
                        $echoResult = '<url>
                          <loc>'.$resultIn.'</loc>
                          <lastmod>2020-05-29T05:44:25+00:00</lastmod>
                          <priority>0.80</priority>
                        </url>';
                        
                        //echo $num.' '.htmlentities($echoResult, ENT_QUOTES).'<br/>';
                        //echo htmlentities($echoResult, ENT_QUOTES).'<br/>';
                        $num++;
                    } 
                }
                
                
                
                
                
            }
        }
          
          
          
    		
    }
}
// START STATE, CITY & LEVEL ONLY



// START STATE, CITY, LEVEL & COURSE ONLY
echo '<br/><br/> <font color=red>***** STATE, CITY, LEVEL & COURSE ONLY *****</font> <br/><br/>';

$qState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    while($rowState = $resultState->fetch_assoc()){
        
        //$stateName = str_replace(' ', '-', $rowState['st_name']);  // Replacing Spaces with -
        //echo $stateName.'<br/>';
        
        $qCity = " SELECT * FROM tk_cities WHERE city_st_id = '".$rowState['st_id']."' ORDER BY city_name ASC ";
        $resultCity = $conn->query($qCity);
        if ($resultCity->num_rows > 0) {
            while($rowCity = $resultCity->fetch_assoc()){

                $qLevel = " SELECT * FROM tk_tution_course WHERE tc_id !='9' ORDER BY tc_id ASC ";
                $resultLevel = $conn->query($qLevel);
                if ($resultLevel->num_rows > 0) {
                    while($rowLevel = $resultLevel->fetch_assoc()){

                        $qCourse = " SELECT * FROM tk_tution_subject WHERE ts_tc_id ='".$rowLevel['tc_id']."' ORDER BY ts_title ASC ";
                        $resultCourse = $conn->query($qCourse);
                        if ($resultCourse->num_rows > 0) {
                            while($rowCourse = $resultCourse->fetch_assoc()){
        
                                $stateName = str_replace(' ', '-', $rowState['st_name']);  // Replacing Spaces with -
                                $cityName = str_replace(' ', '-', $rowCity['city_name']);  // Replacing Spaces with -
                                $LevelName = str_replace(' ', '-', $rowLevel['tc_title']);  // Replacing Spaces with -
                                $CourseName = str_replace(' ', '-', $rowCourse['ts_title']);  // Replacing Spaces with -
                                $resultIn = 'https://www.tutorkami.com/guru-tuisyen?/'.$CourseName.'/'.$LevelName.'/'.$cityName.'/'.$stateName;
                                
                                
                                $echoResult = '<url>
                                  <loc>'.$resultIn.'</loc>
                                  <lastmod>2020-05-29T05:44:25+00:00</lastmod>
                                  <priority>0.80</priority>
                                </url>';
                                
                                
                                echo htmlentities($echoResult, ENT_QUOTES).'<br/>';
                                        
                                
                            }
                        }

                    }
                }
                
                
                
                
                
            }
        }
          
          
          
        		
    }
}
// START STATE, CITY, LEVEL & COURSE ONLY








?>