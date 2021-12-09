<?php
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

?> 
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> 



</head>
<body>
<table id="example" class="display" style="width:100%"> 
	<thead> 
		<tr> 
			<th>No</th> 
			<th>id</th> 
			<th>create</th> 
			<th>Level</th>
			<th>subject</th>  
			<th>area</th> 
			<th>duration</th> 
			<th>lessons</th> 
			<th>remark</th> 
		</tr> 
	</thead> 
	<tbody> 
<?php
$no = 1;
$sql = "SELECT * FROM tk_job WHERE j_jl_id = '5' ORDER BY j_id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        
$sqlSubject = " SELECT * FROM tk_job_translation WHERE jt_j_id = $row[j_id] ";
$querySubject = $conn->query($sqlSubject);
if ($querySubject->num_rows > 0) {
    $rowSubject = $querySubject->fetch_assoc();
    $subject =  $rowSubject["jt_subject"];
    $jt_lessons =  $rowSubject["jt_lessons"];
    $jt_remarks =  $rowSubject["jt_remarks"];
}
        
?>
		<tr> 
			<td><?php echo $no; ?></td> 
			<td><?php echo $row[j_id]; ?></td> 
			<td><?php echo $row["j_create_date"]; ?></td> 
			<td><?php 
$sqlLvl = " SELECT * FROM tk_job_level_translation WHERE jlt_jl_id = $row[j_jl_id] ";
$queryLvl = $conn->query($sqlLvl);
if ($queryLvl->num_rows > 0) {
    $rowLvl = $queryLvl->fetch_assoc();
    echo $rowLvl["jlt_title"];
}
			?></td> 
			<td><?php echo $subject;?></td> 
			<td><?php echo $row["j_area"]; ?>
			-
			<?php echo $row["j_state_id"]; ?>
			</td> 
			<td><?php echo $row["j_duration"]; ?></td> 
			<td><?php echo $jt_lessons;?></td> 
			<td><?php echo $jt_remarks;?></td> 
		</tr> 
<?php
$no++;
    }
} 
$conn->close();
?>

	</tbody>
</table>

<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
		pageLength: 50,
        dom: 'Bfrtip',
        buttons: [
            /*{
                extend: 'colvis',
                columns: ':not(.noVis)'
            },*/
            {
                extend: 'excelHtml5',
                title: 'Export Rate',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                title: 'Export Rate',
                exportOptions: {
                    columns: ':visible'
                }
            },
			'colvis'
        ]
    } );
} );
</script>


</body>
</html>