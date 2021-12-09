<?php
/* Database connection start */
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* Database connection end */

$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");


function CalculateAge($dob) {
    $dateOfBirth = date("Y-m-d", strtotime($dob));
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');

    return $age;
}



$query = " SELECT * FROM tk_user
INNER JOIN tk_user_details ON ud_u_id = u_id 
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
$query .= " GROUP BY u_username ORDER BY u_modified_date DESC ";




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

 $sub_array[] = '<a href="tutor_profile.php?did='.$row['u_displayid'].'" target="_blank">'.$row['u_displayname'].'</a>';
 
 $sub_array[] = $row["u_gender"];

 $sub_array[] = CalculateAge($row['ud_dob']);

 $sqlCity = "SELECT * FROM tk_cities WHERE city_id = $row[ud_city]";
 $queryCity = $connect->prepare($sqlCity);
 $queryCity->execute();
 $resultCity = $queryCity->fetchAll();
 foreach($resultCity as $rowCity){
	$thisCity = $rowCity["city_name"];
 }
 $sub_array[] = $thisCity;

 
if( (strtolower($row["ud_current_occupation"]) ) == ''){
    $sub_array[] =  ''; 
}else if( (strtolower($row["ud_current_occupation"]) ) != ''){

    if( (strtolower($row["ud_current_occupation"]) ) == 'other'){
        if( (strtolower($row["ud_current_occupation_other"]) ) != ''){
            $sub_array[] =  $row["ud_current_occupation_other"];
        }else if((strtolower($row["ud_current_occupation_other"]) ) == ''){
            $resStr = str_replace('-', ' ', $row["ud_current_occupation"]); 
            $resStr = ucwords($resStr);
            $sub_array[] =  $resStr; 
        }else{
            $sub_array[] =  ''; 
        }
    }else if( (strtolower($row["ud_current_occupation"]) ) != 'other'){
        $resStr = str_replace('-', ' ', $row["ud_current_occupation"]); 
        $resStr = ucwords($resStr);
        $sub_array[] =  $resStr; 
    }else{
        $resStr = str_replace('-', ' ', $row["ud_current_occupation"]); 
        $resStr = ucwords($resStr);
        $sub_array[] =  $resStr; 
    }

}else{
    $resStr = str_replace('-', ' ', $row["ud_current_occupation"]); 
    $resStr = ucwords($resStr);
    $sub_array[] =  $resStr; 
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
 $sub_array[] = $rr_rating;
                
}else{
    $sub_array[] = '';
}




                


 $sub_array[] = '<a href="tutor_profile.php?did='.$row['u_displayid'].'" class="btn btm-xs view-button" target="_blank">View Profile</a>';

 $data[] = $sub_array;
}




function count_all_data($connect){
    

$query = " SELECT * FROM tk_user
INNER JOIN tk_user_details ON ud_u_id = u_id 
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
$query .= " GROUP BY u_username ORDER BY u_modified_date DESC ";


 
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
