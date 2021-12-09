<!DOCTYPE html>
<html>
<head>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<title>Missing AC</title>
<style>
</style>
</head>
<body>
<?PHP
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!--  TABLE 1 -->
	<div class="row" style="width: 50%; float: left;padding-left:10px;">
	    
	<table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>u_id</th>
                <th>ud_u_id</th>
                <th>u_email</th>
                <th>u_role</th>
                <th>ud_phone_number</th>
                <th>ud_admin_comment</th>
            </tr>
        </thead>
        <tbody>
            
<?php
$num = 1;
$sql = " 
SELECT * FROM tk_user 
LEFT JOIN  tk_user_details
ON tk_user.u_id =  tk_user_details.ud_u_id
WHERE u_role = '3' AND
ud_admin_comment = ''

";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        
?>
            <tr>
                <td><?PHP echo $num; ?></td>
                <td><?PHP echo $row["u_id"]; ?></td>
                <td><?PHP echo $row["ud_u_id"]; ?></td>
                <td><?PHP echo $row["u_email"]; ?></td>
                <td><?PHP echo $row["u_role"]; ?></td>
                <td><?PHP echo $row["ud_phone_number"]; ?></td>
                <td><?PHP echo $row["ud_admin_comment"]; ?></td>
                
            </tr>
<?PHP
$num++;
    }
} else {
    echo "0 results";
}
?>
            
        </tbody>
    </table>
    
	</div>
<!--  TABLE 1 -->

         


<!--  TABLE 2 -->
	<div class="row" style="width: 50%; float: left;padding-left:10px;">
	    
	<table id="example2" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>u_id</th>
                <th>ud_u_id</th>
                <th>u_email</th>
                <th>u_role</th>
                <th>ud_phone_number</th>
                <th>ud_admin_comment</th>
            </tr>
        </thead>
        <tbody>
            
<?php
$num = 1;
$sql = " 
SELECT * FROM tk_user 
LEFT JOIN  tk_user_details
ON tk_user.u_id =  tk_user_details.ud_u_id
WHERE u_role = '3' AND
ud_admin_comment != ''

";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        
?>
            <tr>
                <td><?PHP echo $num; ?></td>
                <td><?PHP echo $row["u_id"]; ?></td>
                <td><?PHP echo $row["ud_u_id"]; ?></td>
                <td><?PHP echo $row["u_email"]; ?></td>
                <td><?PHP echo $row["u_role"]; ?></td>
                <td><?PHP echo $row["ud_phone_number"]; ?></td>
                <td><?PHP echo $row["ud_admin_comment"]; ?></td>
                
            </tr>
<?PHP
$num++;
    }
} else {
    echo "0 results";
}
?>
            
        </tbody>
    </table>
    
	</div>
<!--  TABLE 2 -->




		 
<?php

mysqli_close($conn);
?>
            





</body>
<script>
$(document).ready(function() {
    $('#example').DataTable(
        
         {     

      "aLengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
        "iDisplayLength": 50
       } 
        );


    $('#example2').DataTable(
        
         {     

      "aLengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
        "iDisplayLength": 50
       } 
        );
        
} );

</script>

</html>








<?php
/*
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$num = 1;
$user = " 
SELECT * FROM tk_user LEFT JOIN tk_user_details 
ON tk_user.u_id = tk_user_details.ud_u_id 
WHERE u_role='3' AND ud_admin_comment =''

";

$resultUser = $conn->query($user);
if ($resultUser->num_rows > 0) {
    while($rowUser = $resultUser->fetch_assoc()){
        
        $job = " SELECT * FROM tk_job  WHERE j_hired_tutor_email = '".$rowUser['u_email']."' ";
        $resultJob = $conn->query($job);
        if ($resultJob->num_rows > 0) {
            echo $num.' - '.$rowUser['u_modified_date'].' - <font color=green>u_role:</font> '.$rowUser['u_role'].' <font color=green>ud_id:</font> '.$rowUser['ud_id'].' </font> <font color=green>displayid:</font> '.$rowUser['u_displayid']. '</font> <font color=blue>'.$rowUser['ud_admin_comment'].'</font>'.'<br/>';
            $num++;
        }
            //echo $num. ' <font color=green>u_role:</font> '.$rowUser['u_role'].' <font color=green>ud_id:</font> '.$rowUser['ud_id'].' </font> <font color=green>displayid:</font> '.$rowUser['u_displayid']. '</font> <font color=blue>'.$rowUser['ud_admin_comment'].'</font>'.'<br/>';
            //$num++;
        
        
	}
}
*/
	
?>