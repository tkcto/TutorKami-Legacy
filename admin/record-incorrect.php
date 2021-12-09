<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;
$instUser = new user;


if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
 <?php 
   $title = ' Record Incorrect | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>
</head>
<body>
    <div id="wrapper">
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php');
            
            $sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
            $thisPage = $breadcrumb['m_name'].' Page';
            $updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
            if ( $conDB->query($updateLastPage) === TRUE ) {}            
            ?>



            <div class="wrapper wrapper-content animated fadeInRight">
             <div class="row">
              <div class="col-lg-12">
               <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> Record Incorrect <a href="https://docs.google.com/document/d/143CwwJrsytGQMIHoQwk-STds05C_F_H4m8Vj8920oyU/edit" target="_blank" ><i class="glyphicon glyphicon-info-sign" style="color:#262262" ></i></a></h5>
                    <div class="el-right"></div>
                </div>
                
                <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                   <div class="col-sm-12">
                    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></style>
                
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Job ID</th>
                                <th>Client Name</th>
                                <th>Date</th>
                                <th>Cycle Status</th>
                                <th>Verification</th>
                                <th>Class</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        $query = " SELECT cl_display_id, cl_tutor_id, cr_create_date, cr_status, cr_parent_verification, time_verification, cl_id, cr_cl_id, cl_student_id FROM tk_classes 
                        INNER JOIN tk_classes_record ON cr_cl_id = cl_id
                        WHERE cr_parent_verification = 'notdone' ORDER BY cr_create_date DESC ";
                        $resultQuery = $conDB->query($query); 
                        if($resultQuery->num_rows > 0){
                        	while($rowQuery = $resultQuery->fetch_assoc()){
                        	    
                            $queryClient = " SELECT u_id, ud_u_id, ud_first_name, u_displayid FROM tk_user 
                            INNER JOIN tk_user_details ON ud_u_id = u_id
                            WHERE u_id = '".$rowQuery['cl_student_id']."' ";
                            $resultQueryClient = $conDB->query($queryClient); 
                            if($resultQueryClient->num_rows > 0){ 
                                $rowQueryClient = $resultQueryClient->fetch_assoc();
                                $ClientName = $rowQueryClient['ud_first_name'];
                                $ClientID   = $rowQueryClient['u_displayid'];
                            }
                        	    ?>
                                    <tr>
                                        <td>    <a href="https://www.tutorkami.com/admin/job-edit?j=<?php echo $rowQuery['cl_display_id']; ?>" target="_blank"><?php echo $rowQuery['cl_display_id']; ?></a>   </td>
                                        <td>    <a href="https://www.tutorkami.com/admin/manage_user?action=edit&u_id=<?php echo $ClientID; ?>" target="_blank"><?php echo $ClientName; ?></a>    </td>
                                        <td><?php 
                                            echo '<span class=hidden>'.$rowQuery['cr_create_date'].'</span>'; 
                                            $old_date_timestamp = strtotime($rowQuery['cr_create_date']);
                                            echo $new_date = date('d/m/y | H:i:s', $old_date_timestamp); 
                                        ?></td>
                                        <td><?php echo ucwords($rowQuery['cr_status']); ?></td>
                                        <td><?php 
                                            if( $rowQuery["cr_parent_verification"] =='' ){
                                                echo '';
                                            }else if( $rowQuery["cr_parent_verification"]=='done' ){
                                                if( $rowQuery["time_verification"] != '' ){
                                                    $verInfo = preg_replace("/[^a-zA-Z]+/", "", $rowQuery["time_verification"]);
                                                    $verTime = explode(" - ", $rowQuery["time_verification"], 2);
                                            
                                                    $resultVer = ' ('.$verInfo.')<br/>('.$verTime[0].')';
                                                }else{
                                                    $resultVer = '';
                                                }
                                                echo '<font color=green>Correct</font>'.$resultVer;
                                            }else if( $rowQuery["cr_parent_verification"]=='notdone' ){
                                                //echo '<font color=red>Incorrect</font>';
                                                if( $rowQuery["time_verification"] != '' ){
                                                    $verInfo = preg_replace("/[^a-zA-Z]+/", "", $rowQuery["time_verification"]);
                                                    $verTime = explode(" - ", $rowQuery["time_verification"], 2);
                                            
                                                    $resultVer = ' ('.$verInfo.')<br/>('.$verTime[0].')';
                                                }else{
                                                    $resultVer = '';
                                                }
                                                echo '<font color=red>Incorrect</font>'.$resultVer;
                                            }else{
                                                echo '';
                                            }
                                        ?></td>
                                        <td>    <a type="button" class="btn btn-success btn-sm" href="https://www.tutorkami.com/admin/classes-add?cl=<?php echo $rowQuery['cl_display_id']; ?>" target="_blank"><span class="glyphicon glyphicon-zoom-in"></span> View Class</a>    </td>
                                    </tr>                        	    
                        	    <?PHP
                        	}
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                </div>                  
                </div>
                </div>

               </div>
              </div>
             </div>
            </div>
            <?php include_once('includes/footer.php'); ?>

        </div> 

    </div>
    <!-- Mainly scripts -->
</body>
</html>

<script>
$(document).ready(function() {
    $('#example').dataTable( {
    "order": [[ 3, 'desc' ]]
    } );
} );
</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
