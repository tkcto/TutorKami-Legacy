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

date_default_timezone_set("Asia/Kuala_Lumpur");
$new_date = date("Y-m-d");


    $output .= '<?xml version="1.0" encoding="UTF-8"?>
        <urlset
              xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
              xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    ';

// START STATE ONLY
$qState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    $output .= " \n";
    $output .= ' <!-- ***** STATE ONLY ***** --> ';
    $output .= " \n";
    while($rowState = $resultState->fetch_assoc()){
        
                $stateName = str_replace(' ', '-', $rowState['st_name_bm']);  // Replacing Spaces with -
                $resultIn = 'https://www.tutorkami.com/tuisyen-online?/'.$stateName;
                
                $echoResult = '<url> <loc>'.$resultIn.'</loc> <lastmod>'.$new_date.'T05:44:25+00:00</lastmod> <priority>0.80</priority> </url>';
                
                $output .= $echoResult." \n"; 
                
    }
}
// END STATE ONLY




// START STATE & CITY ONLY
$qState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    $output .= " \n";
    $output .= ' <!-- ***** STATE & CITY ONLY ***** --> ';
    $output .= " \n";
    while($rowState = $resultState->fetch_assoc()){
        
        $qCity = " SELECT * FROM tk_cities WHERE city_st_id = '".$rowState['st_id']."' ORDER BY city_name ASC ";
        $resultCity = $conn->query($qCity);
        if ($resultCity->num_rows > 0) {
            while($rowCity = $resultCity->fetch_assoc()){
                
                $stateName = str_replace(' ', '-', $rowState['st_name_bm']);  // Replacing Spaces with -
                $cityName = str_replace(' ', '-', $rowCity['city_name']);  // Replacing Spaces with -
                $resultIn = 'https://www.tutorkami.com/tuisyen-online?/'.$cityName.'/'.$stateName;
                
                $echoResult = '<url> <loc>'.$resultIn.'</loc> <lastmod>'.$new_date.'T05:44:25+00:00</lastmod> <priority>0.80</priority> </url>';
                
                $output .= $echoResult." \n"; 
                
            }
        }
          
    }
}
// END STATE & CITY ONLY




// LEVEL ONLY
$qState = " SELECT * FROM tk_tution_course WHERE tc_id !='9' ORDER BY sort_by ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    $output .= " \n";
    $output .= ' <!-- ***** LEVEL ONLY ***** --> ';
    $output .= " \n";
    while($rowState = $resultState->fetch_assoc()){
        
                $stateName = str_replace(' ', '-', $rowState['tc_description']);  // Replacing Spaces with -
                $resultIn = 'https://www.tutorkami.com/tuisyen-online?/'.$stateName;
                
                $echoResult = '<url> <loc>'.$resultIn.'</loc> <lastmod>'.$new_date.'T05:44:25+00:00</lastmod> <priority>0.80</priority> </url>';
                
                $output .= $echoResult." \n"; 
    }
}
// END LEVEL




// START LEVEL & SUBJECT ONLY
$qState = " SELECT * FROM tk_tution_course WHERE tc_id !='9' ORDER BY sort_by ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    $output .= " \n";
    $output .= ' <!-- ***** LEVEL & SUBJECT ONLY ***** --> ';
    $output .= " \n";
    while($rowState = $resultState->fetch_assoc()){
        
        $qCity = " SELECT * FROM tk_tution_subject WHERE ts_tc_id = '".$rowState['tc_id']."' ORDER BY ts_title ASC ";
        $resultCity = $conn->query($qCity);
        if ($resultCity->num_rows > 0) {
            while($rowCity = $resultCity->fetch_assoc()){
                
                $stateName = str_replace(' ', '-', $rowState['tc_description']);  // Replacing Spaces with -
                $cityName = str_replace(' ', '-', $rowCity['ts_description']);  // Replacing Spaces with -
                $resultIn = 'https://www.tutorkami.com/tuisyen-online?/'.$cityName.'/'.$stateName;
                
                $echoResult = '<url> <loc>'.$resultIn.'</loc> <lastmod>'.$new_date.'T05:44:25+00:00</lastmod> <priority>0.80</priority> </url>';
                
                $output .= $echoResult." \n"; 
                
            }
        }
          
    }
}
// END LEVEL & SUBJECT ONLY




// START STATE & LEVEL ONLY
$qState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    $output .= " \n";
    $output .= ' <!-- ***** STATE & LEVEL ONLY ***** --> ';
    $output .= " \n";
    while($rowState = $resultState->fetch_assoc()){
        
        $qCity = " SELECT * FROM tk_tution_course WHERE tc_id !='9' ORDER BY sort_by ASC ";
        $resultCity = $conn->query($qCity);
        if ($resultCity->num_rows > 0) {
            while($rowCity = $resultCity->fetch_assoc()){
                
                $stateName = str_replace(' ', '-', $rowState['st_name_bm']);  // Replacing Spaces with -
                $cityName = str_replace(' ', '-', $rowCity['tc_description']);  // Replacing Spaces with -
                $resultIn = 'https://www.tutorkami.com/tuisyen-online?/'.$cityName.'/'.$stateName;
                
                $echoResult = '<url> <loc>'.$resultIn.'</loc> <lastmod>'.$new_date.'T05:44:25+00:00</lastmod> <priority>0.80</priority> </url>';
                
                $output .= $echoResult." \n"; 
                
            }
        }
          
    }
}
// END STATE & LEVEL ONLY










// START STATE, CITY & LEVEL ONLY
$qState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    $output .= " \n";
    $output .= ' <!-- *****  STATE, CITY & LEVEL ONLY ***** --> ';
    $output .= " \n";
    while($rowState = $resultState->fetch_assoc()){
        
        $qCity = " SELECT * FROM tk_cities WHERE city_st_id = '".$rowState['st_id']."' ORDER BY city_name ASC ";
        $resultCity = $conn->query($qCity);
        if ($resultCity->num_rows > 0) {
            while($rowCity = $resultCity->fetch_assoc()){
                
                $qLevel = " SELECT * FROM tk_tution_course WHERE tc_id !='9' ORDER BY tc_id ASC ";
                $resultLevel = $conn->query($qLevel);
                if ($resultLevel->num_rows > 0) {
                    while($rowLevel = $resultLevel->fetch_assoc()){
                        
                        $stateName = str_replace(' ', '-', $rowState['st_name_bm']);  // Replacing Spaces with -
                        $cityName = str_replace(' ', '-', $rowCity['city_name']);  // Replacing Spaces with -
                        $LevelName = str_replace(' ', '-', $rowLevel['tc_description']);  // Replacing Spaces with -
                        $resultIn = 'https://www.tutorkami.com/tuisyen-online?/'.$LevelName.'/'.$cityName.'/'.$stateName;
                        
                        
                        $echoResult = '<url> <loc>'.$resultIn.'</loc> <lastmod>'.$new_date.'T05:44:25+00:00</lastmod> <priority>0.80</priority> </url>';
                
                        $output .= $echoResult." \n"; 
                        
                    } 
                }
                
            }
        }
          
    }
}
// START STATE, CITY & LEVEL ONLY




// START STATE, CITY, LEVEL & COURSE ONLY
$qState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
$resultState = $conn->query($qState);
if ($resultState->num_rows > 0) {
    $output .= " \n";
    $output .= ' <!-- *****  STATE, CITY, LEVEL & COURSE ONLY ***** --> ';
    $output .= " \n";
    while($rowState = $resultState->fetch_assoc()){
        
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
        
                                $stateName = str_replace(' ', '-', $rowState['st_name_bm']);  // Replacing Spaces with -
                                $cityName = str_replace(' ', '-', $rowCity['city_name']);  // Replacing Spaces with -
                                $LevelName = str_replace(' ', '-', $rowLevel['tc_description']);  // Replacing Spaces with -
                                $CourseName = str_replace(' ', '-', $rowCourse['ts_description']);  // Replacing Spaces with -
                                $resultIn = 'https://www.tutorkami.com/tuisyen-online?/'.$CourseName.'/'.$LevelName.'/'.$cityName.'/'.$stateName;
                                
                                
                                $echoResult = '<url> <loc>'.$resultIn.'</loc> <lastmod>'.$new_date.'T05:44:25+00:00</lastmod> <priority>0.80</priority> </url>';
                
                                $output .= $echoResult." \n";
                                
                                        
                            }
                        }

                    }
                }
                
            }
        }
    }
}
// START STATE, CITY, LEVEL & COURSE ONLY



















  $output .= "\n\n";
  $output .= '</urlset>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=auto-sitemap-tuisyen-online.xml');
  echo $output;










?>