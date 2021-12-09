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
   $title = 'Bill Parents | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>
</head>
<style>
.no-outline {
  border-top-style: none;
  border-right-style: none;
  border-left-style: none;
  border-bottom-style: none;
}

input[type=checkbox] {
    transform: scale(1.5);
    filter: invert(100%) hue-rotate(18deg) brightness(1.7);
}
</style>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="modalBody">
          

<input type="hidden" class="form-control" required id="JobID"  />
<input type="hidden" class="form-control" required id="cl_id"  />
<input type="hidden" class="form-control" required id="clientID"  />
<input type="hidden" class="form-control" required id="cr_id"  />

<input type="hidden" class="form-control" required id="dataHours"  />
<input type="hidden" class="form-control" required id="dataAmount"  />
<input type="hidden" class="form-control" required id="dataRF"  />
<input type="hidden" class="form-control" required id="dataDisabled"  />

                        <?PHP
                        $dateDueDate = strtotime("+6 day");
                        ?>
						<div class="form-group" id="date_create">
                           <label class="col-sm-3 control-label">Due Date :</label>
                           <div class="col-sm-7">
                              <div class="input-group date">
								 <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" required id="dateDueDate" name="dateDueDate" value="<?PHP echo date('d/m/Y', $dateDueDate); ?>" />
                              </div>
                           </div>
                        </div>
<br/><br/> 
<div class="modal-body row" style="margin-left:20%;">
  <div class="col-xs-2">
    <font style="color:#10084E;font-weight: bold;" >Hours </font>
  </div>
  <div class="col-xs-1">
    <font style="color:#10084E;font-weight: bold;" >=</font>
  </div>
  <div class="col-xs-3">
    <font style="color:#10084E;font-weight: bold;" id="Hours"></font>
  </div>
</div>

<div class="modal-body row" style="margin-left:20%;margin-top:-40px;">
  <div class="col-xs-2">
    <font style="color:#10084E;font-weight: bold;" >Rate </font>
  </div>
  <div class="col-xs-1">
    <font style="color:#10084E;font-weight: bold;" >=</font>
  </div>
  <div class="col-xs-3">
    <font style="color:#10084E;font-weight: bold;" id="Amount"></font>
  </div>
</div>

<div class="modal-body row" style="margin-left:20%;margin-top:-40px;">
  <div class="col-xs-2">
    <font style="color:#10084E;font-weight: bold;" >R.F </font>
  </div>
  <div class="col-xs-1">
    <font style="color:#10084E;font-weight: bold;" >=</font>
  </div>
  <div class="col-xs-3">
    <font style="color:#10084E;font-weight: bold;" id="R.F"></font>
  </div>
</div>

<div class="modal-body row" style="margin-left:20%;margin-top:-40px;">
  <div class="col-xs-2">
    <font style="color:#10084E;font-weight: bold;" >Total </font>
  </div>
  <div class="col-xs-1">
    <font style="color:#10084E;font-weight: bold;" >=</font>
  </div>
  <div class="col-xs-3">
    <font style="color:#10084E;font-weight: bold;" id="Total"></font>
  </div>
</div>
  <center>                     
<p style="font-weight: bold;" >Confirm to send invoice to  client?</p>

<?PHP
if( isset($_SESSION['tk']['u_id']) && $_SESSION['tk']['u_id'] == 8){
}
?>
<p> <button type="button" class="btn btn-primary" onClick="sendInvoice()">Yes</button> &nbsp;&nbsp; <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> </p>
  </center>  

      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>

            <div class="wrapper wrapper-content animated fadeInRight">
             <div class="row">
              <div class="col-lg-12">
               <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bill Parents <a href="https://docs.google.com/document/d/1jq8v6lFADmSg-XCkO3VOdlJmtrbtxsm-gzRqHGPXegk/edit" target="_blank" ><i class="glyphicon glyphicon-info-sign" style="color:#262262" ></i></a></h5>
                    <div class="el-right"></div>
                </div>
<?PHP
/*
                            // 8837 
                            //$test = " SELECT * FROM tk_sales_sub WHERE no2 = '8837' AND no3 != 'R.F' ORDER BY no1 DESC, id DESC ";
                            $test = " SELECT * FROM tk_sales_sub WHERE no2 = '8416' AND no3 != 'R.F' AND no4 NOT IN ('%0%','%0.00%')  AND no11 NOT LIKE '%rtc%' ORDER BY no1 DESC, id DESC ";
                            $resulttest = $conDB->query($test); 
                            $row_cnt = $resulttest->num_rows;
                            echo $row_cnt.'<br>';
                            if($resulttest->num_rows > 0){
                                while($rowttt = $resulttest->fetch_assoc()){
                                    echo $rowttt['id'].'<br>';
                                }
                            }
*/
?>
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
                                <th>Invoice sent <a href="" target="_blank" ><i class="glyphicon glyphicon-question-sign" style="color:#262262" ></i></a></th>
                                <th>Verification</th>
                                <th>Class</th>
                                <th>Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        // isu WA 14/6/21
                        $query = " SELECT cl_display_id, cl_tutor_id, cr_id, invoice, cr_create_date, cr_status, cr_parent_verification, time_verification, cl_id, cr_cl_id, cl_student_id, j_id, j_deadline FROM tk_classes 
                        INNER JOIN tk_classes_record ON cr_cl_id = cl_id
                        INNER JOIN tk_job ON j_id = cl_display_id
                        WHERE cr_status LIKE '%Required Parent To Pay%' AND (j_deadline IS NOT NULL AND j_deadline != '0000-00-00') ORDER BY cr_create_date DESC ";
                        $resultQuery = $conDB->query($query); 
                        if($resultQuery->num_rows > 0){
                        	while($rowQuery = $resultQuery->fetch_assoc()){
                        	    
                            $queryClient = " SELECT u_id, ud_u_id, ud_first_name, u_displayid FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id
                            WHERE u_id = '".$rowQuery['cl_student_id']."' ";
                            $resultQueryClient = $conDB->query($queryClient); 
                            if($resultQueryClient->num_rows > 0){ 
                                $rowQueryClient = $resultQueryClient->fetch_assoc();
                                $ClientName = $rowQueryClient['ud_first_name'];
                                $Clientu_id = $rowQueryClient['u_id'];
                                $ClientID   = $rowQueryClient['u_displayid'];
                            }
                            $queryJob = " SELECT j_id, j_deadline, parent_billed FROM tk_job WHERE j_id = '".$rowQuery['cl_display_id']."' ";
                            $resultQueryJob = $conDB->query($queryJob); 
                            if($resultQueryJob->num_rows > 0){ 
                                $rowQueryJob = $resultQueryJob->fetch_assoc();
                                $TutorDeadline = $rowQueryJob['j_deadline'];
                                //$JobBilled = $rowQueryJob['parent_billed'];
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
                                        <td>
                                            <?php 
                                                if($rowQuery['invoice'] == 'on' ){
                                                    $disabled = "checked='checked'";
                                                    $disabled2 = "1";
                                                }else{
                                                    $disabled = "";
                                                    $disabled2 = "0";
                                                }
                                            ?>
                                            <input type="checkbox" class="form-check-input" <?php echo $disabled ?> disabled> &nbsp;&nbsp;&nbsp; <button onclick="showInvoicePopup(<?php echo $rowQuery['cl_display_id']; ?>, <?php echo $rowQuery['cl_id']; ?>, <?php echo $Clientu_id; ?>, <?php echo $rowQuery['cr_id']; ?>, <?php echo $disabled2 ?>)" type="button" class="btn btn-primary btn-xs">Invoice</button>      </td>
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
                                        <td>    <a type="button" class="btn btn-success btn-xs" href="https://www.tutorkami.com/admin/classes-add?cl=<?php echo $rowQuery['cl_display_id']; ?>" target="_blank"><span class="glyphicon glyphicon-zoom-in"></span> View Class</a>    </td>
                                        <td><?php 
                                            if( $TutorDeadline == '' || $TutorDeadline == '0000-00-00' ){
                                                echo '';
                                            }else{
                                                echo '<span class=hidden>'.$TutorDeadline.'</span>'; 
                                                $old_date_Deadline = strtotime($TutorDeadline);
                                                echo $new_date = date('d/m/y', $old_date_Deadline);                                                 
                                            }

                                        ?></td>
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
    
          $('#date_create .input-group.date').datepicker({
              startView: 0,
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              format: "dd/mm/yyyy"
          });
    
    
    $('#example').dataTable( {
    "order": [[ 3, 'desc' ]]
    } );
} );

function showInvoicePopup(JobID, cl_id, clientID, cr_id, disabled) {
    //alert(JobID + ' ' + cl_id + ' ' + clientID + ' ' + cr_id);
    $.ajax({
        url: "ajax/allinone.php",
        method: "POST",
        data: {action: 'showInvoicePopup', JobID: JobID}, 
        success: function(result){
            if( result == 'Error' ){
                alert('Error..');
            }else{
                response = JSON.parse(result);
                var rate = response[0];
                var cycle = response[1];
                var rf = response[2];

                document.getElementById("Hours").innerHTML = cycle;
                document.getElementById("Amount").innerHTML = ' RM '+rate;
                document.getElementById("R.F").innerHTML = ' RM '+rf;
                
                document.getElementById("JobID").value = JobID;
                document.getElementById("cl_id").value = cl_id;
                document.getElementById("clientID").value = clientID;
                document.getElementById("cr_id").value = cr_id;

                document.getElementById("dataHours").value = cycle;
                document.getElementById("dataAmount").value = rate;
                document.getElementById("dataRF").value = rf;
                document.getElementById("dataDisabled").value = disabled;
                
                if( rate != '' && cycle != '' ){
                    if( rf != '' ){
                        var twoPlacedFloat = parseFloat(( ((parseFloat(rate) * parseFloat(cycle)) + parseFloat(rf)))).toFixed(2)
                        document.getElementById('Total').innerHTML = ' RM '+twoPlacedFloat;            
                    }else{
                        var twoPlacedFloat = parseFloat(( ((parseFloat(rate) * parseFloat(cycle))) )).toFixed(2)
                        document.getElementById('Total').innerHTML = ' RM '+twoPlacedFloat;  
                    }
                }                
                $("#exampleModal").modal();
            }
            
        }
    });
}

function sendInvoice() {
    var JobID    = document.getElementById("JobID").value;
    var cl_id    = document.getElementById("cl_id").value;
    var clientID = document.getElementById("clientID").value;
    var dateDueDate = document.getElementById("dateDueDate").value;
    var cr_id    = document.getElementById("cr_id").value;

    var Hours    = document.getElementById("dataHours").value;
    var Amount   = document.getElementById("dataAmount").value;
    var RF       = document.getElementById("dataRF").value;    
    var Disabled = document.getElementById("dataDisabled").value;    
    
    /*alert(Hours + " " + Amount + " " + RF + " " + cl_id + " " + cr_id);*/
    if( Disabled == '1' ){
        alert('Invoice has already been sent');
    }else{
        $.ajax({
            url: "ajax/allinone.php",
            method: "POST",
            data: {action: 'saveDueDate', JobID: JobID, cl_id: cl_id, clientID: clientID, dateDueDate: dateDueDate, cr_id: cr_id, Hours: Hours, Amount: Amount, RF: RF}, 
            success: function(result){
                if( result == 'Success' ){
                    $("#exampleModal").modal('hide');
                    
                    document.getElementById("modalBody").innerHTML = "<center>You have emailed the Invoice to client.<br/><br/><button type='button' class='btn btn-primary' onClick='closeModal()'>Close</button> </center>";
                    setTimeout(function() { $("#exampleModal").modal(); }, 1500);

                }else{
                    alert(result);
                }
            }
        });        
    }
}
function closeModal() {
    location.reload();
}

</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
