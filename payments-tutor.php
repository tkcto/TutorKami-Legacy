<?php 

require_once('includes/head.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

# SESSION CHECK #

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['auth'])) {

  header('Location: tutor-login.php');

  exit();

}

if ($_SESSION['auth']['user_role'] != '3') {

   header('Location:list_of_classes.php');

   exit();

}

if( $deviceIs == 'desktop' ){
    $headerDate = 'Date';
    $headerJob = 'Job ID';
    $headerPV = 'PV No';
    $headerCash = 'Amount Paid (RM)';

}else{
    $headerDate = '<svg data-toggle="tooltip" data-placement="bottom" title="Date"        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16"><path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>';
    $headerJob  = '<svg data-toggle="tooltip" data-placement="bottom" title="Job ID"      xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16"><path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/></svg>';
    $headerPV   = '<svg data-toggle="tooltip" data-placement="bottom" title="PV Number"   xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16"><path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/><path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/></svg>';
    $headerCash = '<svg data-toggle="tooltip" data-placement="bottom" title="Amount (RM)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16"><path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/></svg>';
    
}

include('includes/header.php');
$_SESSION['getPage'] = "Payment Voucher";
unset($_SESSION["firstlogin"]);

function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $secret_iv = 'tk_tutorkami2021';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
?>
<style> 

.table thead td{
    border-right: none !important;
    border-left: none !important;

}

table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc_disabled:before {
    display : none;
  content: "" !important;
}
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_desc_disabled:after {
    display : none;
  content: "" !important;
}
.pointer {cursor: pointer;}

.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
    pointer-events:none;
}
.vertical-align-center {
    display: table-cell;
    vertical-align: middle;
    pointer-events:none;
}
.modal-content {
    width:inherit;
    max-width:inherit; 
    height:inherit;
    margin: 0 auto;
    pointer-events:all;
}

::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  font-family: Arial;
  font-size:15px;
}
::-moz-placeholder { /* Firefox 19+ */
  font-family: Arial;
  font-size:15px;
}
:-ms-input-placeholder { /* IE 10+ */
  font-family: Arial;
  font-size:15px;
}
:-moz-placeholder { /* Firefox 18- */
  font-family: Arial;
  font-size:15px;
}
</style>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://www.tutorkami.com/css/balloon.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js" integrity="sha512-sR3EKGp4SG8zs7B0MEUxDeq8rw9wsuGVYNfbbO/GLCJ59LBE4baEfQBVsP2Y/h2n8M19YV1mujFANO1yA3ko7Q==" crossorigin="anonymous"></script>

<section class="clients_profile_2">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt "><?php echo PAYMENT_VOUCHER; ?></h1>

         <?php //include('includes/private_info.php'); ?>
         <hr>
         
<div class="modal fade" id="modalPV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <?PHP
                $sqlCek = "SELECT * FROM tk_payment_history WHERE ph_user_type = '3' AND ph_user_id = '".$_SESSION['auth']['user_id']."' ORDER BY ph_date DESC "; 
                $resultCek = $conn->query($sqlCek); 
                if($resultCek->num_rows > 0){ 
                    ?>
                    <div class="modal-body">
                          <div class="form-group">
                            <label style="font-weight: normal !important;">Full Name:</label>
                            <input type="text" class="form-control" id="PV_FullName">
                          </div>
                          <div class="form-group">
                            <label style="font-weight: normal !important;">IC Number:</label>
                            <input type="text" class="form-control" id="PV_ICNumber" placeholder="e.g. 555555-05-5555" >
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onClick="submitDetails()">Submit</button>
                    </div>
                    <?PHP
                }else{
                    ?>
                    <div class="modal-body">
                          <div class="alert alert-info" role="alert"><center>NO RECORDS FOUND</center></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <?PHP
                }
                ?>

            </div>
        </div>
    </div>
</div>
<?PHP //echo 'Name : '.$_SESSION['tk_pv_name'].'<br/>IC :'.$_SESSION['tk_pv_ic'];?>
                  <p>Click the PV number to view/download the statement</p>
                  <p>If you need the official PVs (e.g for applying loan purposes), please click <a class="pointer" onClick="showPV()">here</a> &nbsp; <span data-balloon-pos="down" data-balloon-break data-balloon-length="large" aria-label="When you click ‘here’ , system will ask you to enter your full name & IC number.&#10;&#10;All the PVs below will automatically have your full name & IC number in it.&#10;&#10;After you log out, the PVs will revert to its previous format because we do not save your IC number in our system for security purposes." ><i class="glyphicon glyphicon-info-sign" style="color:#f1592a" ></i></span> </p>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive  text-center table-striped table-bordered" style="background:#fff;" id="dataTables_cl">

                     <thead>
                        <tr class="blue-bg">
                           <td width="20%"><font style="margin-right:-12px;"><?PHP echo $headerDate;?></font></td>
                           <td width="20%"><font style="margin-right:-12px;"><?PHP echo $headerJob;?> </font></td>
                           <td width="20%"><font style="margin-right:-12px;"><?PHP echo $headerPV;?>  </font></td>
                           <td width="20%"><font style="margin-right:-12px;"><?PHP echo $headerCash;?></font></td>
                        </tr>
                     </thead>

                     <tbody>
                        <?php 

                        $sql = "SELECT * FROM tk_payment_history WHERE ph_user_type = '3' AND ph_user_id = '".$_SESSION['auth']['user_id']."' ORDER BY ph_date DESC "; 
                        $result = $conn->query($sql); 
                        if($result->num_rows > 0){ 
                            while($row = $result->fetch_assoc()){
                                
                                $link = encryptor('encrypt', $row['ph_id']);

                                $timestamp = strtotime($row['ph_date']);
                                $new_date = date("d/m/Y", $timestamp);

                                if( $row['ph_receipt'] == 'trial paid' ){
                                    $runnNO = 'T';
                                }
                                else if( $row['ph_receipt'] <= '9'){
                                    //$runnNO = '01';
                                    $runnNO = '0'.$row['ph_receipt'];
                                }else{
                                    $runnNO = $row['ph_receipt'];
                                }
                                ?>
                                <tr>
                                    <td><?PHP echo $new_date;?></td>
                                    <td><?PHP echo $row['ph_job_id'];?></td>
                                    <td>
                                        <a href="generate-pv.php?token=<?php echo $link;?>" target="_blank">PV<?PHP echo $row['ph_job_id'].$runnNO;?></a>
                                    </td>
                                    <td><?PHP echo $row['ph_amount'];?></td>
                                </tr>
                                <?PHP
                            }
                
                        }else{
                            ?><tr><td colspan="6"><font color="#e03444"><b>NO RECORDS FOUND</b></font></td></tr><?PHP
                        }
                        ?>
                     </tbody>

                  </table>


         <div class="clearfix"></div>

      </div>

   </div>

</section>


<!--START footer -->
<?php include('includes/footer.php');?>
<!--END footer -->

<script src="js/jquery-1.12.4.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

<script src="js/select2.min.js"></script>

<script>

   $.noConflict();

   jQuery(document).ready(function($){


    $('#searchBoxx').on( 'keyup click', function () {
       $('#dataTables_cl').DataTable().search(
           $('#searchBoxx').val()
       ).draw();
    } ); 
    
    

      $("#e1").select2();

      $("#e2").select2();
      
      

      $('#dataTables_cl').DataTable({

         "order": [[ 0, "desc" ]],
         
         "sDom": 'lrtip',

         "info":false,

         "searching":true,

         "lengthChange":false,

         "bSort":true,

         "bPaginate":true,

         "sPaginationType":"simple_numbers",

         "iDisplayLength": 10,

         "columns": [            

            { "orderable": true },

            { "orderable": true },

            { "orderable": true },

            { "orderable": true }          

         ]

      });



      $(".clickable-row").click(function() {

           window.location = $(this).data("href");

      });

      

   });
   

function showPV() {
    $('#modalPV').modal('show');
}

function submitDetails() {

    var name = document.getElementById('PV_FullName').value;
    var ic   = document.getElementById('PV_ICNumber').value;
    
    if( name == '' || ic == '' ){
        alert('Please Insert Full Name & IC Number');
    }else{
        $.ajax({
            type:'POST',
            url:'pv-details.php',
            data:{name: name, ic: ic},
            success:function(result){
                if( result.trim() == 'Success' ){
                    $('#modalPV').modal('hide');
                }else{
                    alert(result.trim());
                }
            }
        });
    }
}


$(document).ready(function(){
    $(":input").inputmask();
    $("#PV_ICNumber").inputmask({
        mask: '999999-99-9999',
        placeholder: ' ',
        showMaskOnHover: false,
        showMaskOnFocus: false,
        onBeforePaste: function (pastedValue, opts) {
        var processedValue = pastedValue;
        return processedValue;
        }
    });
});
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>