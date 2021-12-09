<?php
/*
require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");


                        
            $test = " SELECT * FROM tk_user_details 
            WHERE conduct_online_text !='' ";
            $resultTest = $conn->query($test);
            if ($resultTest->num_rows > 0) {
                while($rowTest = $resultTest->fetch_assoc()){
                    
                    $sqlUpdate = " UPDATE tk_user_details SET conduct_online_other = '".$rowTest["conduct_online_text"]."' WHERE ud_u_id = '".$rowTest["ud_u_id"]."' ";
                    $conn->query($sqlUpdate);
			 
			 
                                
                              
                }
            }
*/
?>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script language="JavaScript" src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" />

<?php
require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
?>


<div class="col-lg-12">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
`           <tr>
                <th>No</th>
                <th>id</th>
                <th>u_id</th>
                <th>tools (other)</th>
                <th>tools</th>
                <th>Link</th>
           </tr>
        </thead>
        <tbody>
            <?PHP 
            $num = 1;
                        
            $test = " SELECT * FROM tk_user 
            INNER JOIN tk_user_details ON ud_u_id = u_id
            
            
            WHERE conduct_online_text !=''
            
            ORDER BY ud_u_id DESC ";
            $resultTest = $conn->query($test);
            if ($resultTest->num_rows > 0) {
                while($rowTest = $resultTest->fetch_assoc()){
                    

                    echo '<tr>';
                    
                    echo '<td>'.$num.' </td>';
                    echo '<td>'.$rowTest['u_id'].' </td>';
                    echo '<td>'.$rowTest['u_displayid'].' </td>';
                    echo '<td>'.$rowTest['conduct_online_other'].' </td>';
                    echo '<td>'.$rowTest['conduct_online_text'].' </td>';
                    echo '<td> <a href="https://www.tutorkami.com/admin/manage_user?action=edit&u_id='.$rowTest['u_displayid'].'" target="_blank" >Opens New Tab</a></td>';
                            
                    echo '</tr>';
                                
     
                $num++;                              
                }
            }
            ?>
        </tbody>
    </table>
</div>



<script>
$('#example').dataTable( {

} );
</script>
