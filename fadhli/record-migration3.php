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
$get_id = htmlentities(trim($_GET['id']));
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
<p><font size="10" color="green">SUBJECT </font></p>
<table id="example2" class="display" style="width:100%"> 
	<thead> 
		<tr> 
			<th>No</th> 
			<th>Id</th> 
			<th>ts_tc_id</th> 
			<th>ts_title</th> 
			<th>ts_description</th> 
			<th>ts_status</th> 
			<th>ts_country_id</th> 
		</tr> 
	</thead> 
	<tbody> 
<?PHP
$no = 1;
$sql = "SELECT * FROM tk_tution_subject WHERE ts_tc_id = $get_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
		<tr> 
			<td><?php echo $no; ?></td> 
			<td><?php echo $row["ts_id"]; ?></td> 
			<td><?php echo $row["ts_tc_id"]; ?></td> 
			<td><?php echo $row["ts_title"]; ?></td> 
			<td><?php echo $row["ts_description"]; ?></td> 
			<td><?php echo $row["ts_status"]; ?></td> 
			<td><?php echo $row["ts_country_id"]; ?></td> 
		</tr>
<?PHP
$no++;
    }
} 
$conn->close();
?>
	</tbody>
</table>

</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
    $('#example2').DataTable( {
		pageLength: 30,
        dom: 'Bfrtip',
        buttons: [
            /*{
                extend: 'colvis',
                columns: ':not(.noVis)'
            },*/
            /*{
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
            },*/
			'colvis'
        ]
    } );
} );
</script>