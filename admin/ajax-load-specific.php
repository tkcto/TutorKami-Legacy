<?php
/* Database connection start */
$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");

$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


/*
$queryLevel = " SELECT tc_id, tc_title FROM tk_tution_course ORDER BY tc_id ASC ";
$statementLevel = $connect->prepare($queryLevel);
$statementLevel->execute();
$rowLevel = $statementLevel->rowCount();     
     
$queryState = " SELECT st_id, st_name FROM tk_states ORDER BY st_name ASC ";
$statementState = $connect->prepare($queryState);
$statementState->execute();
$rowState = $statementState->rowCount();       

$queryPrice = $connect->prepare(" SELECT * FROM tk_specific ORDER BY id asc ");
$queryPrice->execute();
$rowPrice = $queryPrice->fetchAll();

*/

/*
$query = "
SELECT * FROM tk_job 
";

if( isset($_POST['j_email']) || isset($_POST['j_rate']) || isset($_POST['j_hired_tutor_email']) || isset($_POST['j_telephone']) || isset($_POST['j_date']) || isset($_POST['j_jl_id']) || isset($_POST['j_state_id']) || isset($_POST['newCity']) || isset($_POST['j_status']) || isset($_POST['j_payment_status']) || isset($_POST['j_deadline']) || isset($_POST['j_start_date']) || isset($_POST['j_end_date']) || isset($_POST['sort_by']) || isset($_POST['j_creator_email']) ){
 $query .= ' WHERE j_id IS NOT NULL ';
}
*/


$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value








$query = "
SELECT * FROM tk_specific 
";


/*

## Search 
$searchQuery = " ";
if($searchValue != ''){
    

$queryState2 = $connect->prepare(" SELECT * FROM tk_states WHERE st_name LIKE '%".$searchValue."%' ");
$queryState2->execute();
$rowState2 = $queryState2->fetchAll();
foreach($rowState2 as $resultState2) {
    $thisSearchValue =	$resultState2['st_id'];
}									
 
$queryCity2 = $connect->prepare(" SELECT * FROM tk_cities WHERE city_name LIKE '%".$searchValue."%' ");
$queryCity2->execute();
$rowCity2 = $queryCity2->fetchAll();
foreach($rowCity2 as $resultCity2) {
    $thisSearchValue =	$resultCity2['city_id'];
}									
 
$queryLevel2 = $connect->prepare(" SELECT * FROM tk_tution_course WHERE tc_title LIKE '%".$searchValue."%' ");
$queryLevel2->execute();
$rowLevel2 = $queryLevel2->fetchAll();
foreach($rowLevel2 as $resultLevel2) {
    $thisSearchValue =	$resultLevel2['tc_id'];
}


$test = " SELECT * FROM tk_cities WHERE city_name LIKE '%".$searchValue."%' ";
$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {
    $rowTest = $resultTest->fetch_assoc();
    $thisSearchValue = $rowTest['city_id'];
}
 
 
 
 
   $query .= " and (state = '".$thisSearchValue."' or 
        city = '".$thisSearchValue."' or 
        level ='".$thisSearchValue."' ) ";
}
 */
$query .= "
ORDER BY state ASC, IF(city RLIKE '^[a-z]', 1, 2), city
";



















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

foreach($result as $row)
{
 $sub_array = array();

    $sub_array[] = $row["id"];
 
$queryState = $connect->prepare(" SELECT * FROM tk_states WHERE st_id='".$row['state']."' ");
$queryState->execute();
$rowState = $queryState->fetchAll();
foreach($rowState as $resultState) {
    $sub_array[] =	$resultState['st_name'];
}									
 
$queryCity = $connect->prepare(" SELECT * FROM tk_cities WHERE city_id='".$row['city']."' ");
$queryCity->execute();
$rowCity = $queryCity->fetchAll();
foreach($rowCity as $resultCity) {
    $sub_array[] =	$resultCity['city_name'];
}									
 
$queryLevel = $connect->prepare(" SELECT * FROM tk_tution_course WHERE tc_id='".$row['level']."' ");
$queryLevel->execute();
$rowLevel = $queryLevel->fetchAll();
foreach($rowLevel as $resultLevel) {
    $sub_array[] =	$resultLevel['tc_title'];
}									
 
    $sub_array[] = '
        <center>
            <input style="width:50px;" type="hidden" class="form-control input-sm" name="table_id" id="table_id"   value="'.$row['id'].'">
            <input style="width:50px;" type="text" class="form-control input-sm" name="table_rate" id="table_rate" value="">
        </center>
    ';


    if( $row['tutor_rate_min'] == "0.001"){
        $thisMin =  '0';
    }else{
        $thisMin = $row['tutor_rate_min'];
    }
    $sub_array[] = '
        <center>
            <input style="width:50px;" type="text" class="form-control input-sm" name="table_min" id="table_min" value="'.$thisMin.'">
            <input style="width:50px;" type="text" class="form-control input-sm" name="table_max" id="table_max" value="'.$row['tutor_rate_max'].'">
        </center>
    ';

    $sub_array[] = '
        <center><textarea name="table_note" id="table_note" rows="3" cols="50">'.$row['note'].'</textarea> </center>
    ';
 

    if ($row['checkbox'] == 'true') {
        $thicChecked =  "checked='checked'"; 
    } 
    $sub_array[] = '
        <center>
            <button type="button" class="btn btn-primary btn-md btnSelect"> Update</button>
            <button type="button" class="btn btn-primary btn-md btnDelete"> Delete</button>
            <div class="checkbox checkbox-success"><input '.$thicChecked.' onclick="clickCheckbox(this.value)" value="'.$row['id'].'" type="checkbox"><label for="checkbox3"></label></div>
        </center>
    ';
 
 
 
 
 $data[] = $sub_array;
}




function count_all_data($connect)
{
 $query = "SELECT * FROM tk_specific 
ORDER BY state ASC, IF(city RLIKE '^[a-z]', 1, 2), city";
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
