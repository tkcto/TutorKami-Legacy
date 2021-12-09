<?php 
require_once('includes/head.php'); 
?>
<!DOCTYPE html>
<html>
   <head>
    <?php 
     $title = 'WhatsApp | Tutorkami';
     require_once('includes/html_head.php'); 
     // Create connection
     /*$servername = "localhost";
     $username = "live_tutorkami";
     $password = "Tutor@kami";
     $dbname = "tutorkami_db";
     $conn = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     if ($conn->connect_error) {
		echo "Connection failed : ".str_replace($username, '********', $conn->connect_error);
		exit();
     }

     $queryLevel = $conn->query("SELECT tc_id, tc_title FROM tk_tution_course ORDER BY tc_id ASC");
     $rowLevel = $queryLevel->num_rows;
	 
     $queryState = $conn->query("SELECT st_id, st_name FROM tk_states ORDER BY st_name ASC");
     $rowState = $queryState->num_rows;
	 
     $queryPrice = "SELECT * FROM tk_specific ORDER BY id asc";
     $rowPrice = $conn->query($queryPrice);
	 
	 if($_GET['action'] == 'edit'){
		$getID = $_GET['id'];
		$queryData = "SELECT * FROM tk_location_rate2 WHERE id='$getID' ";
		 $rowData = $conn->query($queryData);
		 if ($rowData->num_rows > 0) {
			$resultData = $rowData->fetch_assoc();			
		 }
	 }*/
    ?>

<style>
.checkbox {
  padding-left: 20px;
}

.checkbox label {
  display: inline-block;
  vertical-align: middle;
  position: relative;
  padding-left: 5px;
}

.checkbox label::before {
  content: "";
  display: inline-block;
  position: absolute;
  width: 17px;
  height: 17px;
  left: 0;
  margin-left: -20px;
  border: 1px solid #cccccc;
  border-radius: 3px;
  background-color: #fff;
  -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
  -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
  transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
}

.checkbox label::after {
  display: inline-block;
  position: absolute;
  width: 16px;
  height: 16px;
  left: 0;
  top: 0;
  margin-left: -20px;
  padding-left: 3px;
  padding-top: 1px;
  font-size: 11px;
  color: #555555;
}

.checkbox input[type="checkbox"] {
  opacity: 0;
  z-index: 1;
}

.checkbox input[type="checkbox"]:focus + label::before {
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}

.checkbox input[type="checkbox"]:checked + label::after {
  font-family: 'FontAwesome';
  content: "\f00c";
}

.checkbox input[type="checkbox"]:disabled + label {
  opacity: 0.65;
}

.checkbox input[type="checkbox"]:disabled + label::before {
  background-color: #eeeeee;
  cursor: not-allowed;
}

.checkbox.checkbox-circle label::before {
  border-radius: 50%;
}

.checkbox.checkbox-inline {
  margin-top: 0;
}

.checkbox-primary input[type="checkbox"]:checked + label::before {
  background-color: #428bca;
  border-color: #428bca;
}

.checkbox-primary input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.checkbox-danger input[type="checkbox"]:checked + label::before {
  background-color: #d9534f;
  border-color: #d9534f;
}

.checkbox-danger input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.checkbox-info input[type="checkbox"]:checked + label::before {
  background-color: #5bc0de;
  border-color: #5bc0de;
}

.checkbox-info input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.checkbox-warning input[type="checkbox"]:checked + label::before {
  background-color: #f0ad4e;
  border-color: #f0ad4e;
}

.checkbox-warning input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.checkbox-success input[type="checkbox"]:checked + label::before {
  background-color: #5cb85c;
  border-color: #5cb85c;
}

.checkbox-success input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.radio {
  padding-left: 20px;
}

.radio label {
  display: inline-block;
  vertical-align: middle;
  position: relative;
  padding-left: 5px;
}

.radio label::before {
  content: "";
  display: inline-block;
  position: absolute;
  width: 17px;
  height: 17px;
  left: 0;
  margin-left: -20px;
  border: 1px solid #cccccc;
  border-radius: 50%;
  background-color: #fff;
  -webkit-transition: border 0.15s ease-in-out;
  -o-transition: border 0.15s ease-in-out;
  transition: border 0.15s ease-in-out;
}

.radio label::after {
  display: inline-block;
  position: absolute;
  content: " ";
  width: 11px;
  height: 11px;
  left: 3px;
  top: 3px;
  margin-left: -20px;
  border-radius: 50%;
  background-color: #555555;
  -webkit-transform: scale(0, 0);
  -ms-transform: scale(0, 0);
  -o-transform: scale(0, 0);
  transform: scale(0, 0);
  -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
  -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
  -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
  transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
}

.radio input[type="radio"] {
  opacity: 0;
  z-index: 1;
}

.radio input[type="radio"]:focus + label::before {
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}

.radio input[type="radio"]:checked + label::after {
  -webkit-transform: scale(1, 1);
  -ms-transform: scale(1, 1);
  -o-transform: scale(1, 1);
  transform: scale(1, 1);
}

.radio input[type="radio"]:disabled + label {
  opacity: 0.65;
}

.radio input[type="radio"]:disabled + label::before {
  cursor: not-allowed;
}

.radio.radio-inline {
  margin-top: 0;
}

.radio-primary input[type="radio"] + label::after {
  background-color: #428bca;
}

.radio-primary input[type="radio"]:checked + label::before {
  border-color: #428bca;
}

.radio-primary input[type="radio"]:checked + label::after {
  background-color: #428bca;
}

.radio-danger input[type="radio"] + label::after {
  background-color: #d9534f;
}

.radio-danger input[type="radio"]:checked + label::before {
  border-color: #d9534f;
}

.radio-danger input[type="radio"]:checked + label::after {
  background-color: #d9534f;
}

.radio-info input[type="radio"] + label::after {
  background-color: #5bc0de;
}

.radio-info input[type="radio"]:checked + label::before {
  border-color: #5bc0de;
}

.radio-info input[type="radio"]:checked + label::after {
  background-color: #5bc0de;
}

.radio-warning input[type="radio"] + label::after {
  background-color: #f0ad4e;
}

.radio-warning input[type="radio"]:checked + label::before {
  border-color: #f0ad4e;
}

.radio-warning input[type="radio"]:checked + label::after {
  background-color: #f0ad4e;
}

.radio-success input[type="radio"] + label::after {
  background-color: #5cb85c;
}

.radio-success input[type="radio"]:checked + label::before {
  border-color: #5cb85c;
}

.radio-success input[type="radio"]:checked + label::after {
  background-color: #5cb85c;
}




[tooltip]{
  /*margin:20px 60px;*/
  position:relative;
  display:inline-block;
}
[tooltip]::before {
    content: "";
    position: absolute;
    top:-6px;
    left:50%;
    transform: translateX(-50%);
    border-width: 4px 6px 0 6px;
    border-style: solid;
    border-color: rgba(0,0,0,0.7) transparent transparent     transparent;
    z-index: 99;
    opacity:0;
}

[tooltip-position='left']::before{
  left:0%;
  top:50%;
  margin-left:-12px;
  width:250px;
  transform:translatey(-50%) rotate(-90deg) 
}
[tooltip-position='top']::before{
  left:50%;
}
[tooltip-position='buttom']::before{
  top:100%;
  margin-top:8px;
  transform: translateX(-50%) translatey(-100%) rotate(-180deg)
}
[tooltip-position='right']::before{
  left:100%;
  top:50%;
  margin-left:1px;
  transform:translatey(-50%) rotate(90deg)
}

[tooltip]::after {
    content: attr(tooltip);
    position: absolute;
    left:50%;
    top:-6px;
    transform: translateX(-50%)   translateY(-100%);
    background: rgba(0,0,0,0.7);
    text-align: center;
    color: #fff;
    padding:4px 2px;
    font-size: 12px;
    min-width: 80px;
    border-radius: 5px;
    pointer-events: none;
    padding: 4px 4px;
    z-index:99;
    opacity:0;
}

[tooltip-position='left']::after{
  left:0%;
  top:50%;
  margin-left:-8px;
  width:250px;
  transform: translateX(-100%)   translateY(-50%);
}
[tooltip-position='top']::after{
  left:50%;
}
[tooltip-position='buttom']::after{
  top:100%;
  margin-top:8px;
  transform: translateX(-50%) translateY(0%);
}
[tooltip-position='right']::after{
  left:100%;
  top:50%;
  margin-left:8px;
  transform: translateX(0%)   translateY(-50%);
}

[tooltip]:hover::after,[tooltip]:hover::before {
   opacity:1
}

.btn-send { 
  color: #ffffff; 
  background-color: #2D6342; 
  border-color: #2D6342; 
} 
 
.btn-send:hover, 
.btn-send:focus, 
.btn-send:active, 
.btn-send.active, 
.open .dropdown-toggle.btn-send { 
  color: #ffffff; 
  background-color: #2D6342; 
  border-color: #2D6342; 
} 
 
.btn-send:active, 
.btn-send.active, 
.open .dropdown-toggle.btn-send { 
  background-image: none; 
} 
 
.btn-send.disabled, 
.btn-send[disabled], 
fieldset[disabled] .btn-send, 
.btn-send.disabled:hover, 
.btn-send[disabled]:hover, 
fieldset[disabled] .btn-send:hover, 
.btn-send.disabled:focus, 
.btn-send[disabled]:focus, 
fieldset[disabled] .btn-send:focus, 
.btn-send.disabled:active, 
.btn-send[disabled]:active, 
fieldset[disabled] .btn-send:active, 
.btn-send.disabled.active, 
.btn-send[disabled].active, 
fieldset[disabled] .btn-send.active { 
  background-color: #2D6342; 
  border-color: #2D6342; 
} 
 
.btn-send .badge { 
  color: #2D6342; 
  background-color: #ffffff; 
}
</style>
   </head>
   <body>
      <div id="wrapper">
         <?php include_once('includes/sidebar.php'); ?>
         <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php'); ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} 
?>

            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox float-e-margins">    


                        <div class="ibox-content">
						
<!--
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
										<div class="table-responsive">
										<table id="wa-grid" class="table table-bordered table-striped">
											<thead>
											<tr>
												<th>Job ID</th>
												<th>Tutor's Applying ( Display ID )</th>
												<th>Action</th>
										 
											</tr>
											</thead>
										</table>
										</div>
                                 </div>
                              </div>
                           </div>
						   
						   
<table id="whatsapp" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0172327809</td>
                <td><button onClick="waAPI(this.id)" type="button" class="btn btn-send btn-xs" id="0172327809"> SEND </button></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
-->

<?PHP
require_once '../fadhli/test/API/twilio-php-main/src/Twilio/autoload.php';
use Twilio\Rest\Client; 
 
$sid    = "ACa4064889163d4b608f86141e3958d242"; 
$token  = "2b386e86b67e4b47418e765f69f8d3b0"; 
$twilio = new Client($sid, $token); 
?>
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Message</th>
                            <th>Direction</th>
                        </tr>
                    </thead>
					<tbody>                              
                            <?PHP
                            $messages = $twilio->messages
                                               ->read([]);
                            
                            foreach ($messages as $record) {                                
                                echo '<tr>';
                                
                                echo '<td>'. $record->from .'</td>';
                                echo '<td>'. $record->to .'</td>';
                                echo '<td>'. $record->status .'</td>';
                                echo '<td>'. $record->price .'</td>';
                                echo '<td><textarea rows="3" cols="80">'. $record->body .'</textarea></td>';
                                echo '<td>'. $record->direction .'</td>';
                                
                                echo '</tr>';
                            }
                            ?>
					</tbody>
                </table>

						   
						   
                        </div>

                     </div>
                  </div>
               </div>
            </div>
            <?php include_once('includes/footer.php'); ?>

         <script src="js/plugins/dataTables/datatables.min.js"></script>

<style>
.disabled {
	cursor: not-allowed;
}
</style>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
/* 
$(document).ready(function() {
    $('#whatsapp').DataTable();
} );
 
        $(document).ready(function() {
            var dataTable = $('#wa-grid').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax":{
                    //url :"whatsapp-list.php",
					//url :"whatsapp-list2.php",
					url :"whatsapp-list3.php",
                    type: "post",
                    error: function(){

                    }
                },
                "aoColumns": [
                    { data: 'JobID' } ,
					{ data: 'ApplyID' },
					{ data: 'action' }
                ]
            } );
        } );
		
		
function reply_click(clicked_id){
	var j_id = clicked_id.substr(0, clicked_id.indexOf('***')); 
	var sendWAValue2  = clicked_id.split('***').pop();

			 $.ajax({
				url: "send-wa.php",
				method: "POST",
				data: {j_id: j_id, sendWAValue2: sendWAValue2}, 
				success: function(result){
					if(result = 'success'){
						//alert(result);
						//$('#wa-grid').DataTable().ajax.reload();
							 $.ajax({
								url: "send-wa2.php",
								method: "POST",
								data: {j_id: j_id, sendWAValue2: sendWAValue2}, 
								success: function(result){
									if(result !== 'Error'){
										$('#wa-grid').DataTable().ajax.reload();
										window.open(result,'_blank');
										//alert(result);										
									}else{
										alert(result);	
									}
								}
							 });
					}else{
						alert(result);
					}
				}
			 });
}
*/

function waAPI(phone){
	/*
			 $.ajax({
				url: "twilio-API/send-message.php",
				method: "POST",
				data: {phone: phone}, 
				success: function(result){
					alert(result);
				}
			 });*/
}
</script>
         </div>
      </div>
   </body>
</html>