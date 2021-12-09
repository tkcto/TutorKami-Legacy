<?php 
require_once('includes/head.php'); 
//require_once('classes/user.class.php');
require_once('classes/location.class.php');
//require_once('classes/job.class.php');

$initLocation = new location;
/*
$userRole = $instAuth = new user;
$instJob = new job;

$roleData = $userRole->GetLocationRate();

$resJl = $instJob->FetchJobLevel();
*/
        if($_SESSION[DB_PREFIX]['u_first_name'] != 'mohd nurfadhli'){
            //echo 'Under Development';
            //exit();				
        }

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
/*
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $dbCon->query($updateLastPage) === TRUE ) {
    //echo "Update Is Successful";
}
$dbCon->close();*/
?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox float-e-margins">                        
                        <div class="ibox-content">
                           <div class="form-horizontal">

<?PHP
//if($_SESSION[DB_PREFIX]['u_first_name'] != 'mohd nurfadhli1'){
?>
<!--<center><p><button type="button" class="btn btn-danger">UNDER MAINTENANCE</button></p></center>-->
<?PHP
//exit();				
//}
?>
<input type="hidden" id="changeDayArray" />  
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">City :</label>
                                 <div class="col-sm-4">
                                       <select class="js-example-basic-single" name="ud_city" id="ud_city" style="width:600px;" multiple >
										   <?php 
											 $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
											 $rowDataState = $conn->query($queryDataState);
											 if ($rowDataState->num_rows > 0) {
												while($resultDataState= $rowDataState->fetch_assoc()){
													echo '<optgroup label="'. $resultDataState['st_name'] .'">';
													
														 $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_st_id = '".$resultDataState['st_id']."' ORDER BY city_name ASC ";
														 $rowDataCity = $conn->query($queryDataCity);
														 if ($rowDataCity->num_rows > 0) {
															while($resultDataCity = $rowDataCity->fetch_assoc()){
																echo '<option value="'. $resultDataCity['city_id'] .'">'. $resultDataCity['city_name'] .'</option>';
															}			
														 }
													
													echo '</optgroup>';
												}			
											 }
										   ?>
                                       </select>
									
									
								 </div>
                              </div>
                              <!--<div class="form-group">
                                 <label class="col-sm-3 control-label">City :</label>
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
                              </div>-->
                                 

                                 <div class="form-group">												
                                    <label class="col-sm-3 control-label">Level :</label>
                                    <div class="col-sm-4">
                                       <select class="form-control" name="level" id="level">
										  <option value="">Please Select Level</option>
										  <?php if($rowLevel > 0){
											  while ($resultLevel = $queryLevel->fetch_assoc()) {
												?><option value="<?PHP echo $resultLevel['tc_id']; ?>" <?PHP if( $resultLevel['tc_id'] == $resultData['level'] ){echo "selected";}?>> <?PHP echo $resultLevel['tc_title']; ?> </option><?PHP
											  }
										  }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                                 
                                 
                                 
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Tutor's Rate :</label>
                                 <div class="col-sm-2">
                                    <input type="text" class="form-control" name="tutor_rate_min" id="tutor_rate_min" placeholder="" onblur="myFunction()">
								 </div>
                                 <!--<div class="col-sm-1">
                                    <input type="text" class="form-control" name="tutor_rate_max" id="tutor_rate_max" placeholder="max : e.g 30" onblur="myFunction2()">

                                 </div>-->
                              </div>

                              <!--<div class="form-group">
                                 <label class="col-sm-3 control-label">Parent's Rate:</label>
                                 <div class="col-sm-1">
                                    <input type="text" class="form-control" name="parent_rate" id="parent_rate" placeholder="min : e.g 10">
								 </div>
                              </div>-->
                                 

                                 
                                 
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Note :</label>
                                    <div class="col-sm-7">
										<textarea name="note" id="note" rows="6"  cols="50"></textarea> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-7">
								 <?PHP
								 if(($_GET['action']) == 'edit'){
								 ?>
								 <button type="button" name="update" id="update" class="btn btn-primary btn-md">UPDATE</button>
								 <?PHP 
								 }else{
								 ?>
								 <!--<button type="button" name="save" id="save" class="btn btn-primary btn-md"> Save</button>-->
								 <button type="button" name="savenew" id="savenew" class="btn btn-primary btn-md"> Save</button>
<?PHP
if($_SESSION[DB_PREFIX]['u_first_name'] == 'mohd nurfadhli'){
}else{
}
?>
								 <?PHP
								 }
								 ?>										
                                    </div>
                                 </div>



                           </div>
                        </div>

<?PHP 
if(isset($_GET['action']) == 'edit'){
}else{
?>

                        <div class="ibox-content">
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
<?PHP
if($_SESSION[DB_PREFIX]['u_first_name'] == 'mohd nurfadhli'){
?>

<?PHP
}
?>
<input type="hidden" class="form-control input-sm" name="table_user" id="table_user" value="<?php echo $_SESSION[DB_PREFIX]['u_first_name'];?>">
<div id="loadContent"></div>

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
<!-- https://select2.org/ -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<style>
.disabled {
	cursor: not-allowed;
}
</style>
<script>  

$(".js-example-basic-single").select2({
	placeholder: "Choose one of the following...",
});

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




$(document).ready( function() {
    //$("#loadContent").load("specific-load.php");

});



$('#ud_city').on('change', function() {

	var changeDayVal = new Array();
	var selCntry = $(this).val();
	changeDayVal.push(selCntry);

	document.getElementById("changeDayArray").value = changeDayVal;
 });


$('#savenew').click(function(){
	
	var city = document.getElementById("changeDayArray").value;
	var level = $('#level option:selected').val();
	var min = $('#tutor_rate_min').val();
	var note = $('#note').val();
	var table_user = $('#table_user').val();
	
	if(city == ''){
		alert('Please Select City');
		exit();
	}	
	if(level == ''){
		alert('Please Select Level');
		exit();
	}	
	if(note == ''){
		alert('Please Insert Note');
		exit();
	}
	
	$.ajax({
		type:'POST',
		url:'specific-function.php',
		data: {
			dataSaveNew: {city: city, level: level, min: min, note: note, table_user: table_user},
		},
		beforeSend: function() {
		},
		success:function(result){
			alert(result);
			if(result == "Success! Record Has Been Saved"){
				//window.location = "specific.php"
			}else{
			    alert(result);
			}
		}
	});
	
});
</script>
         </div>
      </div>
   </body>
</html>