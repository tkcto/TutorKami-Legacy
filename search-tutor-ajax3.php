<?php
/* Database connection start */
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

/* Database connection end */
$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}



function CalculateAge($dob) {
    $dateOfBirth = date("Y-m-d", strtotime($dob));
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');

    return $age;
}



$query = " SELECT * FROM tk_user
INNER JOIN tk_user_details ON ud_u_id = u_id 

LEFT JOIN tk_review_rating ON rr_tutor_id = u_id 
";

if( isset($_POST['conductOnline']) && $_POST['conductOnline'] != ''){
}else{
    if( (isset($_POST['state']) && $_POST['state'] != '') || (isset($_POST['city_check']) && $_POST['city_check'] != '') ){
        $query .= "
        INNER JOIN tk_tutor_area_cover ON tac_u_id = u_id ";
    }    
}



if( (isset($_POST['level']) && $_POST['level'] != '') ){
    $query .= "
    INNER JOIN tk_tutor_subject ON trs_u_id = u_id ";
}

$query .= " WHERE u_id != '' ";




if( isset($_POST['u_gender']) && $_POST['u_gender'] != ''){
 $query .= " AND u_gender = '".$_POST['u_gender']."' ";
}

if( isset($_POST['ud_current_occupation']) && $_POST['ud_current_occupation'] != ''){
	$query .= " AND ud_current_occupation = '".$_POST['ud_current_occupation']."' AND ( ud_current_occupation LIKE '".$_POST['ud_current_occupation']."%' ) ";
}

if( isset($_POST['conductOnline']) && $_POST['conductOnline'] != ''){
 $query .= '
 AND conduct_online LIKE "'.$_POST['conductOnline'].'%"
 ';
}


if( isset($_POST['conductOnline']) && $_POST['conductOnline'] != ''){
}else{
    if( (isset($_POST['state']) && $_POST['state'] != '') ){
        $query .= " AND tac_st_id = '".$_POST['state']."' ";
    }
    if( (isset($_POST['city_check']) && $_POST['city_check'] != '') ){
        $query .= " AND tac_city_id IN(".implode(',',$_POST['city_check']).") ";
    }    
}





if( (isset($_POST['level']) && $_POST['level'] != '') ){
    $query .= " AND trs_tc_id = '".$_POST['level']."' ";
}
if( (isset($_POST['subject_check']) && $_POST['subject_check'] != '') ){
    $query .= " AND trs_ts_id IN(".implode(',',$_POST['subject_check']).") ";
}






$query .= " AND u_status = 'A' AND u_role = '3' ";
//$query .= " GROUP BY u_username ORDER BY u_modified_date DESC ";    
$query .= " GROUP BY u_username ";

        if( (isset($_POST['subject_check']) && $_POST['subject_check'] != '') ){
			$countSubjek = count($_POST['subject_check']);     
        }
        if ( $countSubjek != NULL ) {
            if( $countSubjek >= 2){
                $query .= "HAVING COUNT(distinct trs_ts_id) = '".$countSubjek."'";
            }
        }

$query .= " ORDER BY FIELD(rr_status, 'approved') DESC, u_modified_date DESC, u_profile_pic DESC  ";


$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();



$data = array();

foreach($result as $row){
 $sub_array = array();



if( (strtolower($row["ud_current_occupation"]) ) == ''){
    $Occu =  ''; 
}else if( (strtolower($row["ud_current_occupation"]) ) != ''){

    if( (strtolower($row["ud_current_occupation"]) ) == 'other'){
        if( (strtolower($row["ud_current_occupation_other"]) ) != ''){
            $Occu =  $row["ud_current_occupation_other"];
        }else if((strtolower($row["ud_current_occupation_other"]) ) == ''){
            $resStr = str_replace('-', ' ', $row["ud_current_occupation"]); 
            $resStr = ucwords($resStr);
            $Occu =  $resStr; 
        }else{
            $Occu =  ''; 
        }
    }else if( (strtolower($row["ud_current_occupation"]) ) != 'other'){
        $resStr = str_replace('-', ' ', $row["ud_current_occupation"]); 
        $resStr = ucwords($resStr);
        $Occu =  $resStr; 
    }else{
        $resStr = str_replace('-', ' ', $row["ud_current_occupation"]); 
        $resStr = ucwords($resStr);
        $Occu =  $resStr; 
    }

}else{
    $resStr = str_replace('-', ' ', $row["ud_current_occupation"]); 
    $resStr = ucwords($resStr);
    $Occu =  $resStr; 
}

$sqlRating= " SELECT rr_tutor_id, rr_rating, rr_status FROM tk_review_rating WHERE rr_status ='approved' AND rr_tutor_id = '".$row['u_id']."' ";
$stmt = $connect->prepare($sqlRating);
$stmt->execute();
$text = "";
$text2 = "";
$noRate = 1;
while($rowRating = $stmt->fetch(PDO::FETCH_ASSOC)){
    $rr_rating = $rowRating['rr_rating'];

    $text += $rr_rating;
    $text2 += $noRate;
    
}

if($text != '' && $text2 != ''){
    $purata = ($text / $text2);    
               $split_rating = explode('.', $purata);
                $rr_rating = '';
                for($i = 0; $i < $split_rating[0]; $i++) {
                    $rr_rating .= '<span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>';
                }
                if(isset($split_rating[1]) && $split_rating[1] != '' && $split_rating[1] == '5') {
                    $rr_rating .= '<span class="rating-input"><span data-value="0" class="fa fa-star-half"></span></span>';
                }elseif(isset($split_rating[1]) && $split_rating[1] != '' && $split_rating[1] > '5') {
                    $rr_rating .= '<span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>';
                }    
 $showRating = $rr_rating;
                
}else{
    $showRating = '';
}


    if ($row['u_profile_pic'] != '') {
        $pix = sprintf("%'.07d", $row['u_profile_pic']);
        $pixAll = $pix.'_0.jpg';
        if ( is_numeric($row['u_profile_pic']) ) {
            $picProfile = "https://www.tutorkami.com/images/profile/".$pixAll;
        }else{
            $picProfile =  "https://www.tutorkami.com/images/profile/".$row['u_profile_pic'].".jpg";
        }
				  
    } elseif ($row['u_gender'] == 'M') {
        $picProfile =  "https://www.tutorkami.com/images/tutor_ma.png";
    } else {
        $picProfile =  "https://www.tutorkami.com/images/tutor_mi1.png";
    }

    if ($row['u_gender'] == 'M') {
        $showGender =  "M";
    } else if ($row['u_gender'] == 'F') {
        $showGender =  "F";
    }else{
        $showGender =  "";
    }


$showLevel2 ='';
if( (isset($_POST['level']) && $_POST['level'] != '') ){

    $getLevel = " SELECT trs_u_id, trs_tc_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' AND  trs_tc_id ='".$_POST['level']."' "; 
    $rowGetLevel = $conn->query($getLevel); 
    if($rowGetLevel->num_rows > 0){ 
        $ResultGetLevel = $rowGetLevel->fetch_assoc();

            $getLevel2 = " SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id = '".$ResultGetLevel['trs_tc_id']."' "; 
            $rowGetLevel2 = $conn->query($getLevel2); 
            if($rowGetLevel2->num_rows > 0){ 
                $ResultGetLevel2 = $rowGetLevel2->fetch_assoc();
                $showLevelTitle    = $ResultGetLevel2['tc_title'].', ';
            }

    }else{
        $showLevelTitle    = '';
    }
    
    
    $sqlLevel = " SELECT trs_u_id, trs_tc_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' AND trs_tc_id !='".$_POST['level']."' GROUP BY trs_tc_id ORDER BY RAND() LIMIT 2 "; 
    $stmtLevel = $conn->query($sqlLevel); 
    if($stmtLevel->num_rows > 0){ 
        while($rowLevel = $stmtLevel->fetch_assoc()){
            
            $sqlLevel2= " SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id = '".$rowLevel['trs_tc_id']."' ";
            $stmtLevel2 =  $conn->query($sqlLevel2); 
            if($stmtLevel2->num_rows > 0){ 
                while($rowLevel2 = $stmtLevel2->fetch_assoc()){
                    $showLevel2 .= $rowLevel2['tc_title'].', ';
                }
            }
            
        }
    }
    
    /*$sqlLevelC = " SELECT trs_u_id, trs_tc_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' GROUP BY trs_tc_id "; 
    $stmtLevelC = $conn->query($sqlLevelC); 
    $countLevelC = $stmtLevelC->num_rows;
    if($countLevelC > 1){
        if( ($countLevelC - 2) == 0){
            $countLevelC ='';
        }else{
            $countLevelC = '<span class="badge badge-secondary"> + '.($countLevelC - 2).' more</span>';
        }
    }else{
        $countLevelC ='';
    }*/

}else{

    $sqlLevel = " SELECT trs_u_id, trs_tc_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' GROUP BY trs_tc_id ORDER BY RAND() LIMIT 2 "; 
    $stmtLevel = $conn->query($sqlLevel); 
    if($stmtLevel->num_rows > 0){ 
        while($rowLevel = $stmtLevel->fetch_assoc()){
            
            $sqlLevel2= " SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id = '".$rowLevel['trs_tc_id']."' ";
            $stmtLevel2 =  $conn->query($sqlLevel2); 
            if($stmtLevel2->num_rows > 0){ 
                while($rowLevel2 = $stmtLevel2->fetch_assoc()){
                    $showLevel2 .= $rowLevel2['tc_title'].', ';
                }
            }
            
        }
    }
    
    /*$sqlLevelC = " SELECT trs_u_id, trs_tc_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' GROUP BY trs_tc_id "; 
    $stmtLevelC = $conn->query($sqlLevelC); 
    $countLevelC = $stmtLevelC->num_rows;
    if($countLevelC > 1){
        if( ($countLevelC - 2) == 0){
            $countLevelC ='';
        }else{
            $countLevelC = '<span class="badge badge-secondary"> + '.($countLevelC - 2).' more</span>';
        }
    }else{
        $countLevelC ='';
    }*/
    
}


        if (is_numeric($row['ud_city'])) {
			$citysqltest = " SELECT * FROM tk_cities WHERE city_id = ".$row['ud_city']." ";
			$cityqrytest = $conn->query($citysqltest); 
            if($cityqrytest->num_rows > 0){
                $rowtest = $cityqrytest->fetch_assoc();
                $ud_city = $rowtest['city_name'];
            }else{
                $ud_city ='';
            }
        }else{
            $ud_city = $row['ud_city'];
        }

 
 
 
 
$showSub2 ='';
if( (isset($_POST['subject_check']) && $_POST['subject_check'] != '') ){
//$query .= " AND trs_ts_id IN(".implode(',',$_POST['subject_check']).") ";
    
    $getSub = " SELECT trs_u_id, trs_tc_id, trs_ts_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' AND  trs_tc_id ='".$_POST['level']."' AND trs_ts_id IN(".implode(',',$_POST['subject_check']).") "; 
    $rowGetSub = $conn->query($getSub); 
    if($rowGetSub->num_rows > 0){ 
        $ResultGetSub = $rowGetSub->fetch_assoc();

            $getSub2 = " SELECT ts_id, ts_title, ts_tc_id FROM tk_tution_subject WHERE ts_id = '".$ResultGetSub['trs_ts_id']."' "; 
            $rowGetSub2 = $conn->query($getSub2); 
            if($rowGetSub2->num_rows > 0){ 
                $ResultGetSub2 = $rowGetSub2->fetch_assoc();
                $showSubID      = $ResultGetSub2['ts_tc_id'];
                $showSubTitle   = $ResultGetSub2['ts_title'].', ';
            }

    }else{
        $showSubID    = '';
        $showSubTitle    = '';
    }
    
    
    $sqSub = " SELECT trs_u_id, trs_tc_id, trs_ts_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' AND trs_ts_id !='".$showSubID."'  ORDER BY trs_ts_id DESC LIMIT 4 "; 
    $stmtSub = $conn->query($sqSub); 
    if($stmtSub->num_rows > 0){ 
        while($rowSub = $stmtSub->fetch_assoc()){
            
            $sqSub2= " SELECT ts_id, ts_title FROM tk_tution_subject WHERE ts_id = '".$rowSub['trs_ts_id']."' ";
            $stmtSub2 =  $conn->query($sqSub2); 
            if($stmtSub2->num_rows > 0){ 
                while($rowSub2 = $stmtSub2->fetch_assoc()){
                    $showSub2 .= $rowSub2['ts_title'].', ';
                }
            }
            
        }
    }
    
    /*$sqSubC = " SELECT trs_u_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' "; 
    $stmtSubC = $conn->query($sqSubC); 
    $countSubC = $stmtSubC->num_rows;
    if($countSubC > 1){
        if( ($countSubC - 2) == 0){
            $countSubC ='';
        }else{
            $countSubC = '<span class="badge badge-secondary"> + '.($countSubC - 2).' more</span>';
        }
    }else{
        $countSubC ='';
    }*/

}else{

    $sqSub = " SELECT trs_u_id, trs_tc_id, trs_ts_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."'  ORDER BY trs_ts_id DESC LIMIT 4 "; 
    $stmtSub = $conn->query($sqSub); 
    if($stmtSub->num_rows > 0){ 
        while($rowSub = $stmtSub->fetch_assoc()){
            
            $sqSub2= " SELECT ts_id, ts_title FROM tk_tution_subject WHERE ts_id = '".$rowSub['trs_ts_id']."' ";
            $stmtSub2 =  $conn->query($sqSub2); 
            if($stmtSub2->num_rows > 0){ 
                while($rowSub2 = $stmtSub2->fetch_assoc()){
                    $showSub2 .= $rowSub2['ts_title'].', ';
                }
            }
            
        }
    }
    
    /*$sqSubC = " SELECT trs_u_id FROM tk_tutor_subject WHERE trs_u_id = '".$row['u_id']."' "; 
    $stmtSubC = $conn->query($sqSubC); 
    $countSubC = $stmtSubC->num_rows;
    if($countSubC > 1){
        if( ($countSubC - 2) == 0){
            $countSubC ='';
        }else{
            $countSubC = '<span class="badge badge-secondary"> + '.($countSubC - 2).' more</span>';
        }
    }else{
        $countSubC ='';
    }*/
    
    
    
}
 
 
 
 
 
$showCity2 ='';
if( (isset($_POST['city_check']) && $_POST['city_check'] != '') ){
     //$query .= " AND tac_city_id IN(".implode(',',$_POST['city_check']).") ";
     
    $getCity = " SELECT tac_u_id, tac_st_id, tac_city_id FROM tk_tutor_area_cover WHERE tac_u_id = '".$row['u_id']."' AND  tac_st_id ='".$_POST['state']."' AND tac_city_id IN(".implode(',',$_POST['city_check']).") "; 
    $rowGetCity = $conn->query($getCity); 
    if($rowGetCity->num_rows > 0){ 
        $ResultGeCity = $rowGetCity->fetch_assoc();

            $getCity2 = " SELECT city_id, city_name FROM tk_cities WHERE city_id = '".$ResultGeCity['tac_city_id']."' "; 
            $rowGetCity2 = $conn->query($getCity2); 
            if($rowGetCity2->num_rows > 0){ 
                $ResultGetCity2 = $rowGetCity2->fetch_assoc();
                $showCityTitle   = $ResultGetCity2['city_name'].', ';
            }

    }else{
        $showCityID    = '';
        $showCityTitle    = '';
    }
    

    $sqCity = " SELECT tac_u_id, tac_st_id, tac_city_id FROM tk_tutor_area_cover WHERE tac_u_id = '".$row['u_id']."' AND tac_st_id ='".$_POST['state']."'  ORDER BY tac_city_id DESC LIMIT 4 "; 
    $stmtCity = $conn->query($sqCity); 
    if($stmtCity->num_rows > 0){ 
        while($rowCity = $stmtCity->fetch_assoc()){
            
            $sqCity2= " SELECT city_id, city_name FROM tk_cities WHERE city_id = '".$rowCity['tac_city_id']."' ";
            $stmtCity2 =  $conn->query($sqCity2); 
            if($stmtCity2->num_rows > 0){ 
                while($rowCity2 = $stmtCity2->fetch_assoc()){
                    $showCity2 .= $rowCity2['city_name'].', ';
                }
            }
            
        }
    }

}else{

    $sqCity = " SELECT tac_u_id, tac_st_id, tac_city_id FROM tk_tutor_area_cover WHERE tac_u_id = '".$row['u_id']."'  ORDER BY tac_city_id DESC LIMIT 4 "; 
    $stmtCity = $conn->query($sqCity); 
    if($stmtCity->num_rows > 0){ 
        while($rowCity = $stmtCity->fetch_assoc()){
            
            $sqCity2= " SELECT city_id, city_name FROM tk_cities WHERE city_id = '".$rowCity['tac_city_id']."' ";
            $stmtCity2 =  $conn->query($sqCity2); 
            if($stmtCity2->num_rows > 0){ 
                while($rowCity2 = $stmtCity2->fetch_assoc()){
                    $showCity2 .= $rowCity2['city_name'].', ';
                }
            }
            
        }
    }

}
 
 
 $dataSubjek = strtolower($showSubTitle.rtrim($showSub2, ", "));
 if( $dataSubjek != '' ){
    $array = explode(', ', $dataSubjek);
    $array2 = (array_slice(array_unique($array),2));
    $dataSubjek1 = implode(", ",$array2);
    if( $dataSubjek1 == ''){
        $arr = explode(",", $dataSubjek, 2);
        $dataSubjek1 = $arr[0];
        
    }
 }
 if( (isset($_POST['subject_check']) && $_POST['subject_check'] != '') ){
     $showSubTitle = $showSubTitle;
 }
 
 
 $dataCity = strtolower($showCityTitle.rtrim($showCity2, ", "));
 if( $dataCity != '' ){
    $arrayS = explode(', ', $dataCity);
    $array2S = (array_slice(array_unique($arrayS),2));
    $dataCity1 = implode(", ",$array2S);
    if( $dataCity1 == ''){
        $arrS = explode(",", $dataCity, 2);
        $dataCity1 = $arrS[0];
        
    }
 }
 if( (isset($_POST['city_check']) && $_POST['city_check'] != '') ){
     $showCityTitle = $showCityTitle;
 }

if( isset($_POST['conductOnline']) && $_POST['conductOnline'] != '' ){
    if( $_POST['conductOnline'] == 'Yes' ){
        //$showContent = 'Tools : '.$row["conduct_online_text"]; 
        if(strpos($row["conduct_online_text"], 'Others') !== false){
            $showContent = 'Tools : '.str_replace("Others"," ",$row["conduct_online_text"]).' '.$row["conduct_online_other"];
        } else{
            $showContent = 'Tools : '.$row["conduct_online_text"]; 
        }
    }else{
        $showContent = 'Location : '.ucwords($showCityTitle.$dataCity1);
    }
}else{
    $showContent = 'Location : '.ucwords($showCityTitle.$dataCity1);
}

                                                                            $langString = strip_tags($row['ud_about_yourself']);
                                                                            if (strlen($langString) > 400) {
                                                                            
                                                                                $langStringCut = substr($langString, 0, 400);
                                                                                $langStringEndPoint = strrpos($langStringCut, ' ');
                                                                            
                                                                                $langString = $langStringEndPoint? substr($langStringCut, 0, $langStringEndPoint) : substr($langStringCut, 0);
                                                                            	$langString .= ' ...';
                                                                            	$aboutMe =  '<br/>'.$langString; 	
                                                                            }else{
                                                                            	$aboutMe = '<br/>'.$langString; 
                                                                            }
 
 
 
 /*
$sub_array[] = '
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-body">
              <div class="col-sm-2">
                    <center><img alt="User Pic" src="'.$picProfile.'" width="100" height="100" class="img-circle img-responsive"> <br/> '.$showRating.'</center>
              </div><br/>
              <div class="col-sm-3">
                  <center>'.$row['u_displayname'].' <br/><br/> '.$showGender.' <br/><br/> '.CalculateAge($row['ud_dob']).' years old <br/><br/> '.$Occu.'</center>
              </div><br/>
              <div class="col-sm-7">
                  <center>'.ucwords($showSubTitle.$dataSubjek1).' <br/><br/> '.$showLevelTitle.rtrim($showLevel2, ", ").' <br/><br/> '.ucwords($showCityTitle.$dataCity1).' <br/><br/> <a href="tutor_profile.php?did='.$row['u_displayid'].'" class="btn btn-oren" target="_blank">View Profile</a> </center> 
              </div>
              
              
        </div>
      </div>
    </div>';

 */ 
 
/* 
                                                                    <div class="cover">
                                                                    </div>
                                                                    <div class="user">
                                                                        <img width="100" height="100" class="img-circle img-responsive" src="'.$picProfile.'"/>
                                            						</div>
*/
$sub_array[] = '
                                                     <div class="col-md-3 col-sm-3 text-center">
                                                         <div class="card-container">
                                                            <div class="card">
                                                                <div class="front">
                                                                
                                                                        <br/><br/><img class="rounded-circle2" src="'.$picProfile.'" alt="Circle image" width="160" height="160">
                                            						<br/>'.$showRating.' <br/>
                                                                    <div class="content">
                                                                        <div class="main"> 
                                                                            <span class="thisfont" style="color:#262262"><strong> '.$row['u_displayname'].' </strong></span><br/><br/>
                                                                            <span class="thisfont"><strong>'.$showGender.', '.CalculateAge($row['ud_dob']).', '.$Occu.'</strong></span><br/>
                                                                            <span class="thisfont"><strong></strong></span><br/>
                                                                            <span class="thisfont"><strong> '.ucwords($showSubTitle.$dataSubjek1).' </strong></span><br/>
                                                                            <br/><span class="thisfont"><strong> '.$showLevelTitle.rtrim($showLevel2, ", ").' </strong></span><br/><br/>
                                                                            <span class="thisfont"><strong> '.$showContent.' </strong></span><br/>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="back">
                                                                    <div class="header">
                                                                        <h5 class="motto"><a href="tutor_profile.php?did='.$row['u_displayid'].'" target="_blank" class="btn btn-info">View Profile</a></h5>
                                                                    </div>
                                                                    <div class="content">
                                                                        <div class="main">
                                                                            <h4 class="text-center"><strong>About Me </strong></h4>
                                                                            <p class="alert-message alert-message-info text-center thisfont">'.$aboutMe.'</p>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div> 
                                                        </div> 
                                                    </div>
 ';


 
 








 $data[] = $sub_array;
}




function count_all_data($connect){
    

$query = " SELECT * FROM tk_user
INNER JOIN tk_user_details ON ud_u_id = u_id 

LEFT JOIN tk_review_rating ON rr_tutor_id = u_id 
";

if( isset($_POST['conductOnline']) && $_POST['conductOnline'] != ''){
}else{
    if( (isset($_POST['state']) && $_POST['state'] != '') || (isset($_POST['city_check']) && $_POST['city_check'] != '') ){
        $query .= "
        INNER JOIN tk_tutor_area_cover ON tac_u_id = u_id ";
    }
}






if( (isset($_POST['level']) && $_POST['level'] != '') ){
    $query .= "
    INNER JOIN tk_tutor_subject ON trs_u_id = u_id ";
}

$query .= " WHERE u_id != '' ";




if( isset($_POST['u_gender']) && $_POST['u_gender'] != ''){
 $query .= " AND u_gender = '".$_POST['u_gender']."' ";
}

if( isset($_POST['ud_current_occupation']) && $_POST['ud_current_occupation'] != ''){
	$query .= " AND ud_current_occupation = '".$_POST['ud_current_occupation']."' AND ( ud_current_occupation LIKE '".$_POST['ud_current_occupation']."%' ) ";
}

if( isset($_POST['conductOnline']) && $_POST['conductOnline'] != ''){
 $query .= '
 AND conduct_online LIKE "'.$_POST['conductOnline'].'%"
 ';
}


if( isset($_POST['conductOnline']) && $_POST['conductOnline'] != ''){
}else{
    if( (isset($_POST['state']) && $_POST['state'] != '') ){
        $query .= " AND tac_st_id = '".$_POST['state']."' ";
    }
    if( (isset($_POST['city_check']) && $_POST['city_check'] != '') ){
        $query .= " AND tac_city_id IN(".implode(',',$_POST['city_check']).") ";
    }    
}



if( (isset($_POST['level']) && $_POST['level'] != '') ){
    $query .= " AND trs_tc_id = '".$_POST['level']."' ";
}
if( (isset($_POST['subject_check']) && $_POST['subject_check'] != '') ){
    $query .= " AND trs_ts_id IN(".implode(',',$_POST['subject_check']).") ";
}






$query .= " AND u_status = 'A' AND u_role = '3' ";
//$query .= " GROUP BY u_username ORDER BY u_modified_date DESC ";    
$query .= " GROUP BY u_username ";

        if( (isset($_POST['subject_check']) && $_POST['subject_check'] != '') ){
			$countSubjek = count($_POST['subject_check']);     
        }
        if ( $countSubjek != NULL ) {
            if( $countSubjek >= 2){
                $query .= "HAVING COUNT(distinct trs_ts_id) = '".$countSubjek."'";
            }
        }

$query .= " ORDER BY FIELD(rr_status, 'approved') DESC, u_modified_date DESC, u_profile_pic DESC  ";


 
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($connect),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);
?>
