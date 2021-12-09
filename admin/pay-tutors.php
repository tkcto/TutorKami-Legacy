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
   $title = 'Pay Tutors | Tutorkami';
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
                    <h5>Pay Tutors <a href="https://docs.google.com/document/d/1FyGMoS9tzDtJlGGr-QGoGBtBIDlH0Hk-MiveLuu-6PE/edit" target="_blank" ><i class="glyphicon glyphicon-info-sign" style="color:#262262" ></i></a></h5>
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
                                <th>Tutor Name</th>
                                <th>Date</th>
                                <th>Cycle Status</th>
                                <th>Verification</th>
                                <th>Class</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        $query = " SELECT last, cl_display_id, cl_tutor_id, cr_create_date, cr_status, cr_parent_verification, time_verification, cl_id, cr_cl_id, cl_hours_balance FROM tk_classes 
                        INNER JOIN tk_classes_record ON cr_cl_id = cl_id
                        WHERE cr_status LIKE '%FM to pay tutor%' ORDER BY cr_create_date DESC";
                        $resultQuery = $conDB->query($query); 
                        if($resultQuery->num_rows > 0){
                        	while($rowQuery = $resultQuery->fetch_assoc()){
                        	    
                            $queryTutor = " SELECT u_displayname, u_displayid, u_id FROM tk_user WHERE u_id = '".$rowQuery['cl_tutor_id']."' ";
                            $resultQueryTutor = $conDB->query($queryTutor); 
                            if($resultQueryTutor->num_rows > 0){ 
                                $rowQueryTutor = $resultQueryTutor->fetch_assoc();
                                $TutorDisplayName = $rowQueryTutor['u_displayname'];
                                $TutorDisplayID   = $rowQueryTutor['u_displayid'];
                                
                            }
                        	    ?>
                                    <tr>
                                        <td>    <a href="https://www.tutorkami.com/admin/job-edit?j=<?php echo $rowQuery['cl_display_id']; ?>" target="_blank"><?php echo $rowQuery['cl_display_id']; ?></a>   </td>
                                        <td>    <a href="https://www.tutorkami.com/admin/manage_user?action=edit&u_id=<?php echo $TutorDisplayID; ?>" target="_blank"><?php echo $TutorDisplayName; ?></a>    </td>
                                        <td><?php 
                                            echo '<span class=hidden>'.$rowQuery['cr_create_date'].'</span>'; 
                                            $old_date_timestamp = strtotime($rowQuery['cr_create_date']);
                                            echo $new_date = date('d/m/y | H:i:s', $old_date_timestamp); 
                                        ?></td>
                                        <td><?php echo ucwords($rowQuery['cr_status']); 

    										if ($rowQuery['cl_hours_balance'] < 0){
    										    $query2 = " SELECT cr_cl_id, current_cycle, cr_date, cr_start_time, cr_status  FROM tk_classes_record WHERE cr_cl_id = '".$rowQuery['cl_id']."' AND current_cycle NOT LIKE '%temp%' ORDER BY cr_date DESC, cr_start_time DESC ";
    										    if ($result2 = $conDB->query($query2)) {
    										        $row2 = $result2->fetch_assoc();
    										        if( $row2['cr_status'] == 'FM to pay tutor' ){
    										            echo '<br/><span> <font size="2" color="red"><b>Tutor insert extra duration</b></font></span>';
    										        }
    										    }
    										}
    										
    										if ($rowQuery['cl_hours_balance'] <= 0){
                                                         if( $rowQuery['last'] == 'This is the last session' ){
                                                             $lastInfo = '<br/><font color=red>'.ucwords($rowQuery['last']).'</font>';
                                                         }else if( $rowQuery['last'] == 'Next class as usual' ){
                                                             $lastInfo = '<br/><font color=green>'.ucwords($rowQuery['last']).'</font>';
                                                         }else if( $rowQuery['last'] == 'Not sure if got next class' ){
                                                             $lastInfo = '<br/><font color=blue>'.ucwords($rowQuery['last']).'</font>';
                                                         }else{
                                                             $lastInfo = '';
                                                         }
                                                         
                                                         echo $lastInfo;
    										}
                                            
                                        ?></td>
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
