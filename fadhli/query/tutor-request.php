<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script language="JavaScript" src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js" type="text/javascript"></script>


<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" />

<?php
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


            <div class="col-lg-12">
                2019
                <table id="2019" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Mac</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Jun</th>
                            <th>Julai</th>
                            <th>Ogos</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Disember</th>
                            <th>Total</th>

                        </tr>
                    </thead>
					<tbody>
					    <tr>
    					    <?PHP
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='01' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total1 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';
                            
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='02' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total2 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';	
                            
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='03' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total3 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';	

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='04' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total4 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='05' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total5 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='06' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total6 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='07' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total7 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='08' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total8 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='09' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total9 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='10' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total10 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='11' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total11 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2019' AND month(tr_create_date)='12' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total12 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $totalResult = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10 + $total11 + $total12;
                            echo '<td>'.$totalResult.' </td>';
    					    ?>					        
					    </tr>    
					</tbody>
                </table>
                
                2020
                <table id="2020" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Mac</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Jun</th>
                            <th>Julai</th>
                            <th>Ogos</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Disember</th>
                            <th>Total</th>

                        </tr>
                    </thead>
					<tbody>
					    <tr>
    					    <?PHP
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='01' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total1 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';
                            
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='02' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total2 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';	
                            
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='03' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total3 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';	

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='04' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total4 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='05' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total5 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='06' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total6 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='07' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total7 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='08' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total8 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='09' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total9 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='10' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total10 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='11' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total11 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2020' AND month(tr_create_date)='12' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total12 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $totalResult = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10 + $total11 + $total12;
                            echo '<td>'.$totalResult.' </td>';
    					    ?>					        
					    </tr>    
					</tbody>
                </table>
                
                2021
                <table id="2021" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Mac</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Jun</th>
                            <th>Julai</th>
                            <th>Ogos</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Disember</th>
                            <th>Total</th>

                        </tr>
                    </thead>
					<tbody>
					    <tr>
    					    <?PHP
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='01' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total1 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';
                            
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='02' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total2 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';	
                            
                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='03' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total3 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';	

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='04' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total4 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='05' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total5 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='06' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total6 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='07' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total7 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='08' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total8 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='09' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total9 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='10' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total10 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='11' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total11 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $test = " SELECT * FROM tk_tutor_request WHERE year(tr_create_date)='2021' AND month(tr_create_date)='12' GROUP BY tr_phone_number   ";
                            $resultTest = $conn->query($test);
                            $total12 = $resultTest->num_rows;
                            echo '<td>'.$resultTest->num_rows.' </td>';

                            $totalResult = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10 + $total11 + $total12;
                            echo '<td>'.$totalResult.' </td>';
    					    ?>					        
					    </tr>    
					</tbody>
                </table>
                
                
                
                
                
                

            </div>



<script>
$('#example').dataTable( {
  /*"columns": [
    { "width": "5%" },
    { "width": "5%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "15%" },
    { "width": "15%" },
    null
  ]*/
} );
</script>