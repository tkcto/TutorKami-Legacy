<?php
/* Database connection start */

$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


$connect = new PDO("mysql:host=localhost;dbname=tutorkami_db", "live_tutorkami", "Tutor@kami");

	
//$column = array('tr_id');

$query = "
SELECT * FROM tk_user WHERE u_role != '0' AND u_role != '1' AND u_role != '2' AND u_profile_pic !=''
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
 
 $sub_array[] = $row['u_id'];
 $sub_array[] = $row['u_displayid'];


				$pix = sprintf("%'.07d", $row['u_profile_pic']);
				$pixAll = $pix.'_0.jpg';
				
				$thisFolder = 'https://www.tutorkami.com/images/profile/'.$pixAll;

				if (@getimagesize($thisFolder)) {
					 $sub_array[] = '<img width="42" height="42" style="border-radius:50%;" src="https://www.tutorkami.com/images/profile/'.$pixAll.'">';
				}else{
					 $sub_array[] = $pixAll;
				}





 $sub_array[] = $row['u_email'];
 $sub_array[] = $row['u_role'];
 $sub_array[] = $row['u_username'];
 
 
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM tk_user WHERE u_role != '0' AND u_role != '1' AND u_role != '2' AND u_profile_pic !=''";
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

