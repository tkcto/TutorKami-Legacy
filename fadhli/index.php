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
			<th>Id</th> 
			<th>Level</th> 
			<th>Country</th> 
			<th>State</th> 
			<th>City</th> 
			<th>Rate</th>
			<th>Parent Rate</th>
		</tr> 
	</thead> 
	<tbody> 
<?php
$no = 1;
$sql = "SELECT * FROM tk_location_rate WHERE lr_rate != ''";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
		<tr> 
			<td><?php echo $no; ?></td> 
			<td><?php echo $row["lr_id"]; ?></td> 
			<td><?php 
				//echo $row["level"];
				$sqlLevel = "SELECT tc_id, tc_title FROM tk_tution_course WHERE tc_id = ".$row["lr_jl_id"]."";
				$resultLevel = $conn->query($sqlLevel);
				if ($resultLevel->num_rows > 0) {
					$rowLevel = $resultLevel->fetch_assoc();
					echo $rowLevel["tc_title"];
				}else{
					echo $row["lr_jl_id"];
				}
			?></td> 
			<td><?php if($row["lr_c_id"] == '150'){echo 'Malaysia';}else{echo $row["lr_c_id"];} ?></td> 
			<td><?php 
				//echo $row["state"]; 
				$sqlState = "SELECT st_id, st_name FROM tk_states WHERE st_id = ".$row['lr_st_id']."";
				$resultState = $conn->query($sqlState);
				if ($resultState->num_rows > 0) {
					$rowState = $resultState->fetch_assoc();
					echo $rowState["st_name"]; 
				}
			?></td> 
			<td><?php 
				//echo $row["city"]; 
				$sqlCity = "SELECT city_id, city_name FROM tk_cities WHERE city_id = ".$row['lr_city_id']."";
				$resultCity = $conn->query($sqlCity);
				if ($resultCity->num_rows > 0) {
					$rowCity = $resultCity->fetch_assoc();
					echo $rowCity["city_name"]; 
				}
			?></td> 
			<td><?php echo $row["lr_rate"]; ?></td> 
			<td><?php echo $row["lr_parent_rate"]; ?></td> 
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