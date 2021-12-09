<?php
/* Database connection start */
/*$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");

$query = "
SELECT * FROM tk_specific
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

 $sqlState = " SELECT * FROM tk_states WHERE st_id ='".$row['state']."' ";
 $queryState=mysqli_query($conn, $sqlState) or die("get tk_states");
 if( $rowState=mysqli_fetch_array($queryState) ) {
	$sub_array[] = $rowState["st_name"];
 }

 $sqlCity = " SELECT * FROM tk_cities WHERE city_id ='".$row['city']."' ";
 $queryCity=mysqli_query($conn, $sqlCity) or die("get tk_cities");
 if( $rowCity=mysqli_fetch_array($queryCity) ) {
	$sub_array[] = $rowCity["city_name"];
 }

 $sqlLevel = " SELECT * FROM tk_tution_course WHERE tc_id ='".$row['level']."' ";
 $queryLevel=mysqli_query($conn, $sqlLevel) or die("get tk_tution_course");
 if( $rowLevel=mysqli_fetch_array($queryLevel) ) {
	$sub_array[] = $rowLevel["tc_title"];
 }
 
 $sub_array[] = '
    <center>
        <input style="width:50px;" type="hidden" class="form-control input-sm" name="table_id" id="table_id"   value="'.$row['id'].'">
        <input style="width:50px;" type="text" class="form-control input-sm" name="table_rate" id="table_rate" value="">
    </center>
 ';
 

    if( $row['tutor_rate_min'] == '0.001'){
        $thisMin = '0';
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

 if ($row['checkbox'] == 'true') { $thisCheckBox = "checked='checked'"; }
 
 if ($row['checkbox'] == 'true') { 
    $thisInfo = '<span tooltip="Location with job payment status: Paid (Job we manage to match tutor & get payment)" tooltip-position="left"> <i style="font-size:20px;" class="glyphicon glyphicon-question-sign"></i> </span>';
 } 
 $sub_array[] = '
    <center>
        <button type="button" class="btn btn-primary btn-md btnSelect"> Update</button>
        <button type="button" class="btn btn-primary btn-md btnDelete"> Delete</button>
        <div class="checkbox checkbox-success"><input '.$thisCheckBox.'  onclick="clickCheckbox(this.value)" value="'.$row['id'].'" type="checkbox"><label for="checkbox3"></label></div>
        <div class="checkbox checkbox-success">'.$thisInfo.'</div> 
    </center> 
 ';
 
 
 $data[] = $sub_array;
}




function count_all_data($connect)
{
 $query = "SELECT * FROM tk_specific ";
 
 
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
*/





$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$requestData= $_REQUEST;
 
 
$columns = array(
    0 =>'state',
    1 => 'city',
    2=> 'level',
    3=> 'pr_rate',
    4=> 'min_max',
    5=> 'note'
);
 
$sql = "SELECT id,state, city, level, tutor_rate_min, tutor_rate_max, note, checkbox, state_name, city_name, level_name FROM tk_specific";
$query=mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;
 
$searchKeyWord = htmlspecialchars($requestData['search']['value']);
if( !empty($searchKeyWord) ) {
    $sql.=" WHERE state_name LIKE '".$searchKeyWord."%' ";
    $sql.=" OR city_name LIKE '".$searchKeyWord."%' ";
    $sql.=" OR level_name LIKE '".$searchKeyWord."%' ";
    $sql.=" OR note LIKE '%".$searchKeyWord."%' ";
    $query=mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
 
}
    //$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $sql.=" ORDER BY state_name ASC, city_name ASC, level_name ASC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    //$sql.=" ORDER BY id ASC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql);
 
 
$data = array();
while( $row=mysqli_fetch_array($query) ) {
    
 $sqlState = " SELECT * FROM tk_states WHERE st_id ='".$row['state']."' ";
 $queryState=mysqli_query($conn, $sqlState) or die("get tk_states");
 if( $rowState=mysqli_fetch_array($queryState) ) {
	$subState = $rowState["st_name"];
 }

 $sqlCity = " SELECT * FROM tk_cities WHERE city_id ='".$row['city']."' ";
 $queryCity=mysqli_query($conn, $sqlCity) or die("get tk_cities");
 if( $rowCity=mysqli_fetch_array($queryCity) ) {
	$subCity = $rowCity["city_name"];
 }else{
     $subCity = '';
 }

 $sqlLevel = " SELECT * FROM tk_tution_course WHERE tc_id ='".$row['level']."' ";
 $queryLevel=mysqli_query($conn, $sqlLevel) or die("get tk_tution_course");
 if( $rowLevel=mysqli_fetch_array($queryLevel) ) {
	$subLevel = $rowLevel["tc_title"];
 }
 
 $pr_rate = '
    <center>
        <input style="width:50px;" type="hidden" class="form-control input-sm" name="table_id" id="table_id"   value="'.$row['id'].'">
        <input style="width:50px;" type="text" class="form-control input-sm" name="table_rate" id="table_rate" value="">
    </center>
 ';
    
    if( $row['tutor_rate_min'] == '0.001'){
        $thisMin = '0';
    }else{
        $thisMin = $row['tutor_rate_min'];
    }
 $min_max = '
    <center>
        <input style="width:50px;" type="text" class="form-control input-sm" name="table_min" id="table_min" value="'.$thisMin.'">
        <input style="width:50px;" type="text" class="form-control input-sm" name="table_max" id="table_max" value="'.$row['tutor_rate_max'].'">
    </center>
 ';
    
 $note= '
    <center><textarea name="table_note" id="table_note" rows="3" cols="50">'.$row['note'].'</textarea> </center>
 ';
 
 
 if ($row['checkbox'] == 'true') { 
     $thisCheckBox = "checked='checked'"; 
     $thisInfo = '<span tooltip="Entry with validated tutors available" tooltip-position="left"> <i style="font-size:20px;" class="glyphicon glyphicon-question-sign"></i> </span>';
 }else{
     $thisCheckBox = '';
     $thisInfo = '';
 }
 
 /*if ($row['checkbox'] == 'true') { 
    $thisInfo = '<span tooltip="Location with job payment status: Paid (Job we manage to match tutor & get payment)" tooltip-position="left"> <i style="font-size:20px;" class="glyphicon glyphicon-question-sign"></i> </span>';
 } */
 $action = '
    <center>
        <button type="button" class="btn btn-primary btn-md btnSelect"> Update</button>
        <button type="button" class="btn btn-primary btn-md btnDelete"> Delete</button>
        <div class="checkbox checkbox-success"><input '.$thisCheckBox.'  onclick="clickCheckbox(this.value)" value="'.$row['id'].'" type="checkbox"><label for="checkbox3"></label></div>
        <div class="checkbox checkbox-success">'.$thisInfo.'</div>
    </center> 
 ';
 
 
 
    
    $data[] = [ 'id'=>$row['id'],'state'=>$subState,'city'=>$subCity,'level'=>$subLevel,'pr_rate'=>$pr_rate,'min_max'=>$min_max,'note'=>$note,'action'=>$action  ];
}
 
 
 
$json_data = array(
    "draw"            => intval( $requestData['draw'] ),
    "recordsTotal"    => intval( $totalData ),
    "recordsFiltered" => intval( $totalFiltered ),
    "data"            => $data
);
 
echo json_encode($json_data);


?>
