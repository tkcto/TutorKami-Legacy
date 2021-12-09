<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script language="JavaScript" src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!--<script language="JavaScript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script language="JavaScript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>-->

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
                <th>Photo</th>
                <th>Display Name</th>
                <th>Display ID</th>
                <th>Age</th>
                <th>Register</th>
                <th>Last Login</th>
           </tr>
        </thead>
        <tbody>
            <?PHP
            $num = 1;

            $test = " SELECT * FROM tk_user 
            INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
            
            WHERE u_role ='3' AND year(u_modified_date)='2020'

            ORDER BY u_modified_date DESC ";
            $resultTest = $conn->query($test);
            if ($resultTest->num_rows > 0) {
                while($rowTest = $resultTest->fetch_assoc()){
                    
                $pix = sprintf("%'.07d\n", $rowTest['u_profile_pic']);
                                                               
                if ($rowTest['u_profile_pic'] != '') {
                    if ( is_numeric($rowTest['u_profile_pic']) ) {
                        $pic = "<img src=\"".APP_ROOT."https://www.tutorkami.com/images/profile/".$pix."_0.jpg\"  >";
                        $pic = '<img src="https://www.tutorkami.com/images/profile/'.$pix.'_0.jpg      ">';
                    }else{
                        $pic = '<img src="https://www.tutorkami.com/images/profile/'.$rowTest['u_profile_pic'].'.jpg      ">';
                    }
                } elseif ($rowTest['u_gender'] == 'M') {
                    $pic = '<img src="https://www.tutorkami.com/images/tutor_ma.png">';
                } else {
                    $pic = '<img src="https://www.tutorkami.com/images/tutor_mi1.png">';
                }  
                
                if( $rowTest['u_gender'] == 'm' || $rowTest['u_gender'] == 'M' ){
                    $gender = 'Lelaki';
                }else if( $rowTest['u_gender'] == 'f' || $rowTest['u_gender'] == 'F' ){
                    $gender = 'Perempuan';
                }else{
                    $gender = 'Not Set';
                }
                
                $timestamp = strtotime($rowTest['ud_dob']);
                $dateOfBirth = date("d-m-Y", $timestamp);
                $today = date("Y-m-d");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                $age =  $diff->format('%y');
                
                                
                    echo '<tr>';
                    
                    echo '<td>'.$num.' </td>';
                    echo '<td>'.$pic.' </td>';
                    echo '<td>'.$rowTest['u_displayname'].'<br/>'.$rowTest['u_email'].'<br/>'.$gender.'</td>';
                    echo '<td>'.$rowTest['u_displayid'].' </td>';
                    echo '<td>'.$age.' </td>';
                    echo '<td>'.$rowTest['u_create_date'].'<br/><br/>'.date("d/m/Y", strtotime($rowTest['u_create_date'])).' </td>';
                    echo '<td>'.$rowTest['u_modified_date'].'<br/><br/>'.date("d/m/Y", strtotime($rowTest['u_modified_date'])).' </td>';
                            
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