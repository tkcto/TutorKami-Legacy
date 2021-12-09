<?php 
require_once('includes/head.php'); 
//require_once('classes/location.class.php');

//$initLocation = new location;


?>
<!DOCTYPE html>
<html>
   <head>
    <?php 
     $title = 'Specific Rate | Tutorkami';
     require_once('includes/html_head.php'); 
/*
     // Create connection
     $servername = "localhost";
     $username = "tutorka1_live";
     $password = "_+11pj,oow.L";
     $dbname = "tutorka1_tutorkami_db";
     $conn = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     if ($conn->connect_error) {
		echo "Connection failed : ".str_replace($username, '********', $conn->connect_error);
		exit();
     }
*/
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
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
	 }
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
                        <!--<div class="ibox-content">
                           <div class="form-horizontal">


                              <div class="form-group">
                                 <label class="col-sm-3 control-label">City:</label>
                                 <div class="col-sm-4">
                                    <input readonly type="hidden" class="form-control" name="ud_city2" id="ud_city2" >
                                    <select class="form-control cnty" name="ud_state" id="ud_state">
                                       <option value="">Please Select State</option>
                                       <?php 
                                       /*$country_id = 150;
                                          $stresponse = $initLocation->CountryWiseState($country_id);
                                          if ($stresponse->num_rows > 0) {
                                             while( $cu_row = $stresponse->fetch_assoc() ){
                                                echo '<option value="'. $cu_row['st_id'] .'">'. $cu_row['st_name'] .'</option>';
                                             }
                                          }*/
                                       ?>
                                    </select>
								 </div>
                                 <div class="col-sm-4">
                                    <select class="form-control cnty" name="ud_city" id="ud_city">
                                       <option value="">Please Select City</option>
                                    </select>

                                 </div>
                              </div>
                                 

                                 <div class="form-group">												
                                    <label class="col-sm-3 control-label">Level:</label>
                                    <div class="col-sm-4">
                                       <select class="form-control" name="level" id="level">
										  <option value="">Please Select Level</option>
										  <?php /*if($rowLevel > 0){
											  while ($resultLevel = $queryLevel->fetch_assoc()) {
												?><option value="<?PHP echo $resultLevel['tc_id']; ?>" <?PHP if( $resultLevel['tc_id'] == $resultData['level'] ){echo "selected";}?>> <?PHP echo $resultLevel['tc_title']; ?> </option><?PHP
											  }
										  }*/
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                                 
                                 
                                 
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Tutor's Rate:</label>
                                 <div class="col-sm-2">
                                    <input type="text" class="form-control" name="tutor_rate_min" id="tutor_rate_min" placeholder="" onblur="myFunction()">
								 </div>
                              </div>

                                 
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Note:</label>
                                    <div class="col-sm-7">
										<textarea name="note" id="note" rows="6"  cols="50"></textarea> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-7">
								 <?PHP
								 //if(($_GET['action']) == 'edit'){
								 ?>
								 <button type="button" name="update" id="update" class="btn btn-primary btn-md">UPDATE</button>
								 <?PHP 
								 //}else{
								 ?>
								 <button type="button" name="save" id="save" class="btn btn-primary btn-md"> Save</button>
								 <?PHP
								 //}
								 ?>										
                                    </div>
                                 </div>



                           </div>
                        </div>-->

<?PHP 
if(isset($_GET['action']) == 'edit'){
}else{
?>

                        <div class="ibox-content">
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
<?PHP
//if($_SESSION[DB_PREFIX]['u_first_name'] == 'mohd nurfadhli'){
?>

<?PHP
//}
?>
<input type="hidden" class="form-control input-sm" name="table_user" id="table_user" value="<?php echo $_SESSION[DB_PREFIX]['u_first_name'];?>">
<div id="loadContent"></div>

                                    <table id="listingPrice" class="table table-bordered table-striped dataTables-example">    
										<thead>
											<tr>
												<th></th>
												<th class="text-center">State</th>
												<th class="text-center">City</th>
												<th class="text-center">Level</th>
<?PHP
if($_SESSION[DB_PREFIX]['u_first_name'] != 'temporary staff'){
?>

												<th class="text-center">Parent Rate</th>
<?PHP
}
?>
												<th class="text-center">Tutor Rate <br>Min &nbsp;&nbsp; Max</th>
												<th class="text-center">Note</th>
<?PHP
if($_SESSION[DB_PREFIX]['u_first_name'] != 'temporary staff'){
?>

                                             <th class="text-center">Action</th>
<?PHP
}
?>
											</tr>
										</thead>
										<tbody>
										<?php 
										if ($rowPrice->num_rows > 0) {
										while( $resultPrice = $rowPrice->fetch_assoc() ){
										?>
                                          <tr class="footable-even">
                                             <td style="width: 15%;">
                                                <?php //echo $resultPrice['id'];?>
                                             </td>
                                             <td style="width: 10%;">
                                               <?php 
												$queryState2 = $conn->query("SELECT * FROM tk_states WHERE st_id='$resultPrice[state]'");
												$rowState2 = $queryState2->num_rows;
												if($rowState2 > 0){
													$resultState2 = $queryState2->fetch_assoc();
													echo $resultState2['st_name'];
												}
											   ?>
                                             </td>
                                             <td style="width: 10%;">
                                                <?php 
												$queryCity = $conn->query("SELECT * FROM tk_cities WHERE city_id='$resultPrice[city]'");
												$rowCity = $queryCity->num_rows;
												if($rowCity > 0){
													$resultCity = $queryCity->fetch_assoc();
													echo $resultCity['city_name'];
												}
												?>                                                    
                                             </td>
                                             <td style="width: 10%;">
                                                <?php 
												$queryLevel2 = $conn->query("SELECT * FROM tk_tution_course WHERE tc_id='$resultPrice[level]'");
												$rowLevel2 = $queryLevel2->num_rows;
												if($rowLevel2 > 0){
													$resultLevel2 = $queryLevel2->fetch_assoc();
													echo $resultLevel2['tc_title'];
												}
												?>
                                             </td>
<?PHP
if($_SESSION[DB_PREFIX]['u_first_name'] != 'temporary staff'){
?>
                                             <td style="width: 5%;">
                                                 <center>
                                                <input style="width:50px;" type="hidden" class="form-control input-sm" name="table_id" id="table_id"     value="<?php echo $resultPrice['id'];?>">
                                                <input style="width:50px;" type="text" class="form-control input-sm" name="table_rate" id="table_rate" value="<?php //echo $resultPrice['parent_rate'];?>">
                                                 </center>
                                             </td>
<?PHP
}
?>
                                             
                                             
                                             <td style="width: 10%;">
                                                 <center>
                                                <input style="width:50px;" type="text" class="form-control input-sm" name="table_min" id="table_min" value="<?php 
                                                if( $resultPrice['tutor_rate_min'] == '0.001'){
                                                    echo '0';
                                                }else{
                                                    echo $resultPrice['tutor_rate_min'];
                                                }
                                                ?>">
                                                <input style="width:50px;" type="text" class="form-control input-sm" name="table_max" id="table_max" value="<?php echo $resultPrice['tutor_rate_max'];?>">
                                                 </center>
                                             </td>
                                             <td class="footable-visible footable-last-column" style="width: 25%;"  >
                                                <center><textarea name="table_note" id="table_note" rows="3" cols="50"><?php echo $resultPrice['note'];?></textarea> </center>
                                             </td>
<?PHP
if($_SESSION[DB_PREFIX]['u_first_name'] != 'temporary staff'){
?>

                                             <td class="footable-visible footable-last-column" style="width: 15%;"  >
                                                 <center>
											    	 <button type="button" class="btn btn-primary btn-md btnSelect"> Update</button>
											    	 <button type="button" class="btn btn-primary btn-md btnDelete"> Delete</button>
											    	 <div class="checkbox checkbox-success"><input <?php if ($resultPrice['checkbox'] == 'true') { echo "checked='checked'"; } ?> onclick="clickCheckbox(this.value)" value="<?php echo $resultPrice['id'];?>" type="checkbox"><label for="checkbox3"></label></div>
											    	 <div class="checkbox checkbox-success"><?php if ($resultPrice['checkbox'] == 'true') { ?> <span tooltip="Location with job payment status: Paid (Job we manage to match tutor & get payment)" tooltip-position="left"> <i style="font-size:20px;" class="glyphicon glyphicon-question-sign"></i> </span> <?PHP } ?> </div> 
                                                 </center>
                                             </td>
<?PHP
}
?>
                                          </tr>
                                          <?php 
                                             }
                                          } else {
                                             echo '<tr><td colspan="7">No Record Found</td></tr>';
                                          }
                                          ?>   
										</tbody>
                                    </table>



                                 </div>
                              </div>
                           </div>
                        </div>
<?PHP
}
?>
                     </div>
                  </div>
               </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
<!-- https://select2.org/ 
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>-->

         <!--<script src="js/plugins/jeditable/jquery.jeditable.js"></script>-->
         <script src="js/plugins/dataTables/datatables.min.js"></script>
         <!-- Custom and plugin javascript 
         <script src="js/plugins/pace/pace.min.js"></script>-->
<style>
.disabled {
	cursor: not-allowed;
}
</style>

<script>  
function myFunction() {
  var min = parseInt(document.getElementById("tutor_rate_min").value);
  var max = parseInt(document.getElementById("tutor_rate_max").value);
  var pr = (((min + max)/2) + 15);

  if( isNaN(pr) ){
      document.getElementById("parent_rate").value = '';
      exit();
  }else{
    document.getElementById("parent_rate").value = pr;
  }

}


function myFunction2() {
  var min = parseInt(document.getElementById("tutor_rate_min").value);
  var max = parseInt(document.getElementById("tutor_rate_max").value);
  var pr = (((min + max)/2) + 15);

  if( isNaN(pr) ){
      document.getElementById("parent_rate").value = '';
  }else{
    document.getElementById("parent_rate").value = pr;
  }

}


$('#save').click(function(){
	var state = $('#ud_state option:selected').val();
	var city = $('#ud_city option:selected').val();
	var level = $('#level option:selected').val();
	var min = $('#tutor_rate_min').val();
	var max = $('#tutor_rate_max').val();
	var rate = $('#parent_rate').val();
	var note = $('#note').val();
	var table_user = $('#table_user').val();
	
	
//alert(state + ' - ' + city + ' - ' + level + ' - ' + min + ' - ' + max + ' - ' + rate + ' - ' + note);
    if(state == ''){
       alert('Please Insert State');
       exit();
    }
    if(city == ''){
       alert('Please Insert City');
       exit();
    }
    if(level == ''){
        alert('Please Insert Level');
       exit();
    }
    if(min == ''){
        alert('Please Insert Rate');
       exit();
    }
    /*if(max == ''){
        alert('Please Insert Max Tutor Rate');
    }
    if(rate == ''){
        alert('Please Insert Parent Rate');
    }*/
    if(note == ''){
        alert('Please Insert Note');
       exit();
    }
	
	$.ajax({
		type:'POST',
		url:'specific-function.php',
		data: {
			//dataSave: {state: state, city: city, level: level, min: min, max: max, rate: rate, note: note},
			dataSave: {state: state, city: city, level: level, min: min, note: note, table_user: table_user},
		},
		beforeSend: function() {
			//$('#demo').html("Loding ... ");
		},
		success:function(result){
			alert(result);
			if(result == "Success! Record Has Been Saved"){
				window.location = "specific.php"
			}else{
			    alert(result);
			}
		}
	});
});





$('#listingPrice').DataTable({
	"order": [ [ 1, "asc" ],[ 2, "asc" ],[ 3, "asc" ] ],
	//hide coloumn id
    "columnDefs": [
        { "visible": false, "targets": 0 }
    ]
  
});  


// code to read selected table row cell data (values).
$("#listingPrice").on('click','.btnSelect',function(){
	var x = confirm("Are you sure you want to update?");
	if (x == true){

    // get the current row
    var currentRow=$(this).closest("tr"); 
         
    var id =   currentRow.find("td:eq(3) input[name='table_id']").val();
    var rate = currentRow.find("td:eq(3) input[name='table_rate']").val();
    var min = currentRow.find("td:eq(4) input[name='table_min']").val();
    var max = currentRow.find("td:eq(4) input[name='table_max']").val();
    var note = currentRow.find("td:eq(5) textarea[name='table_note']").val();
         
    /*var data=id+"\n"+rate+"\n"+min+"\n"+max+"\n"+note;
    alert(data);*/
	$.ajax({
		type:'POST',
		url:'specific-function.php',
		data: {
			dataUpdate: {id: id, rate: rate, min: min, max: max, note: note},
		},
		beforeSend: function() {
		},
		success:function(result){
			/*if(result == "New record created successfully"){
				window.location = "specific.php"
			}else{
			    alert(result);
			}*/
			alert(result);
		}
	});
		
	}
});


$("#listingPrice").on('click','.btnDelete',function(){
	var x = confirm("Are you sure you want to delete?");
	if (x == true){

    // get the current row
    var currentRow=$(this).closest("tr"); 
         
    var id =   currentRow.find("td:eq(3) input[name='table_id']").val();
    
	$.ajax({
		type:'POST',
		url:'specific-function.php',
		data: {
			dataDelete: {id: id},
		},
		beforeSend: function() {
		},
		success:function(result){
			if(result == "Record deleted successfully"){
				window.location = "specific.php"
			}else{
			    alert(result);
			}
		}
	});
		
	}
});

function clickCheckbox(data) {
 //alert(data);
    var id = data;   
	$.ajax({
		type:'POST',
		url:'specific-function.php',
		data: {
			dataCheckbox: {id: id},
		},
		success:function(result){
			alert(result);
		}
	});
}

</script>
         </div>
      </div>
   </body>
</html>