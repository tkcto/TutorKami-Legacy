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
   $title = 'WA Record | Tutorkami';
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
                    <h5>WA Record Not Sent <a href="https://docs.google.com/document/d/15b1ZrOFejW-0DVmk9mFzhv9i_oVCrq64dLL2hxkQEGo/edit" target="_blank" ><i class="glyphicon glyphicon-info-sign" style="color:#262262" ></i></a></h5>
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
                                <th>Date</th>
                                <th>Class ID</th>
                                <th>Job ID</th>
                                <th>Client</th>
                                <th>Tutor</th>
                                <th>Verification</th>
                                <th>Sent Manually?</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        $query = " SELECT wa_id, wa_job_id, wa_remark, wa_status, wa_date, wa_manual, cr_cl_id, cr_id, cl_id, cl_display_id, cl_student_id, cl_tutor_id, cr_parent_verification FROM tk_whatsapp_noti 
                        INNER JOIN tk_classes_record ON cr_id = wa_job_id
                        INNER JOIN tk_classes ON cl_id = cr_cl_id
                        WHERE wa_remark = 'Record Function' AND wa_status != 'POST' ORDER BY wa_date DESC ";
                        $resultQuery = $conDB->query($query); 
                        if($resultQuery->num_rows > 0){
                        	while($rowQuery = $resultQuery->fetch_assoc()){
                        	    
                        	    $arr = explode(' ',$rowQuery['wa_date']);
                        	    $old_date = explode('-', $arr[0]); 
                        	    $new_data = $old_date[2].'/'.$old_date[1].'/'.$old_date[0];
                        	    
                        	    $thisP = '';
                        	    $thisT = '';
                                $queryP = " SELECT u_id, ud_u_id, salutation, resit_pv_name, ud_first_name FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_id = '".$rowQuery['cl_student_id']."' ";
                                $resultQueryP = $conDB->query($queryP); 
                                if($resultQueryP->num_rows > 0){
                                    $rowQueryP = $resultQueryP->fetch_assoc();
                                    $thisP = $rowQueryP['salutation'].' '.$rowQueryP['ud_first_name'];
                                }
                                
                                $queryT = " SELECT u_id, ud_u_id, salutation, resit_pv_name, ud_first_name FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_id = '".$rowQuery['cl_tutor_id']."' ";
                                $resultQueryT = $conDB->query($queryT); 
                                if($resultQueryT->num_rows > 0){
                                    $rowQueryT = $resultQueryT->fetch_assoc();
                                    $thisT = $rowQueryT['resit_pv_name'];
                                }
                                
                                if( $rowQuery['cr_parent_verification'] == '' ){
                                    $status = '';
                                }else if( $rowQuery['cr_parent_verification'] == 'done' ){
                                    $status = '<font color=green>Correct</font>';
                                }else if( $rowQuery['cr_parent_verification'] == 'notdone' ){
                                    $status = '<font color=red>Incorrect</font>';
                                }else{
                                    $status = '';
                                }

                        	    ?>
                                    <tr>
                                        <td><?PHP echo $new_data; ?></td>
                                        <td> <a href="https://www.tutorkami.com/admin/classes-add?cl=<?php echo $rowQuery['cl_display_id']; ?>" target="_blank"> <?PHP echo $rowQuery['cr_cl_id']; ?> </a> </td>
                                        <td><?PHP echo $rowQuery['cl_display_id']; ?></td>
                                        <td><?PHP echo ucwords($thisP); ?></td>
                                        <td><?PHP echo ucwords($thisT);  ?></td>
                                        <td><?PHP echo $status; ?></td>
                                        <td>   
                                            <input <?PHP if( $rowQuery['wa_manual'] == 'Yes' ){ echo 'checked'; }?> type="checkbox" id="SentManual<?PHP echo $rowQuery['wa_id']; ?>" value="Yes" onclick="myFunction(<?PHP echo $rowQuery['wa_id']; ?>)">
                                        </td>
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


function myFunction(id) {
  var checkBox = document.getElementById("SentManual"+id);
  if (checkBox.checked == true){
    var x = confirm("Confirm you have sent notification manually to Client?");
    if (x == true){

            $.ajax({
                type:'POST',
                url:'sale-process.php',
                data: {
                    sentManual: {id: id},
                },
                success:function(result){
                    if( result == 'Success' ){
                    }else{
                        alert('Error');
                    }
                }
            });

    }else{
        document.getElementById("SentManual"+id).checked = false;
    }
  } else {
    document.getElementById("SentManual"+id).checked = true;
  }
}
</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
