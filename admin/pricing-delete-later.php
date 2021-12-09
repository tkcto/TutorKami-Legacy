<!DOCTYPE html>
<html>
   <head>
    <?php 
     $title = 'Price Rate | Tutorkami';
     require_once('includes/html_head.php'); 
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

     $queryLevel = $conn->query("SELECT tc_id, tc_title FROM tk_tution_course ORDER BY tc_id ASC");
     $rowLevel = $queryLevel->num_rows;
	 
     $queryState = $conn->query("SELECT st_id, st_name FROM tk_states ORDER BY st_name ASC");
     $rowState = $queryState->num_rows;
	 
     $queryPrice = "SELECT * FROM tk_location_rate2 ORDER BY level asc, state asc";
     $rowPrice = $conn->query($queryPrice);
	 
	 if($_GET['action'] == 'edit'){
		$getID = $_GET['id'];
		$queryData = "SELECT * FROM tk_location_rate2 WHERE id='$getID' ";
		 $rowData = $conn->query($queryData);
		 if ($rowData->num_rows > 0) {
			$resultData = $rowData->fetch_assoc();			
		 }
	 }
	 
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
	 
    ?>
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
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $dbCon->query($updateLastPage) === TRUE ) {
    //echo "Update Is Successful";
}
$dbCon->close();
?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox float-e-margins">                        
                        <div class="ibox-content">
                           <div class="form-horizontal">
<?PHP
if($_GET['action'] == 'duplicate'){
	$getID = $_GET['id'];
	$queryData = "SELECT * FROM tk_location_rate2 WHERE id='$getID' ";
	$rowData = $conn->query($queryData);
	if ($rowData->num_rows > 0) {
		$resultDataDuplicate = $rowData->fetch_assoc();			
		?>
                                 <div class="form-group">												
                                    <label class="col-lg-3 control-label">Level:</label>
                                    <div class="col-lg-7">
                                       <select class="js-example-basic-single" name="levelDuplicate" id="levelDuplicate" style="width:250px" >
										  <option></option>
										  <?php if($rowLevel > 0){
											  while ($resultLevel = $queryLevel->fetch_assoc()) {
												?><option value="<?PHP echo $resultLevel['tc_id']; ?>"> <?PHP echo $resultLevel['tc_title']; ?> </option><?PHP
											  }
										  }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">State:</label>
                                    <div class="col-lg-7">
                                       <select class="js-example-basic-single" name="stateDuplicate" id="stateDuplicate" style="width:250px" <?PHP if($resultDataDuplicate['state'] != NULL){echo"disabled";} ?>>
										  <option></option>
                                          <?PHP
                                          if($rowState > 0){
											  while ($resultState = $queryState->fetch_assoc()) {
												?><option value="<?PHP echo $resultState['st_id']; ?>" <?PHP if( $resultState['st_id'] == $resultDataDuplicate['state'] ){echo "selected";}?>> <?PHP echo $resultState['st_name']; ?> </option><?PHP
											  }
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
								 
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">City:</label>
                                    <div class="col-lg-7">
                                       <div id="outputCity"></div>
                                       <div id="hideSelectOption">
                                       <select class="js-example-basic-single" style="width:250px" multiple >
                                       <option></option>
                                       </select></div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Rate:</label>
                                    <div class="col-lg-7">
										<input type="text" class="form-control" name="rateDuplicate" id="rateDuplicate" style="width:250px" >
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Note:</label>
                                    <div class="col-lg-7">
										<textarea name="noteDuplicate" id="noteDuplicate" rows="4"  cols="50" style="width:250px"></textarea> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-7">
					
								
                                    <button type="button" name="duplicate" id="duplicate" class="btn btn-primary btn-md">Duplicate</button>
								 										
                                    </div>
                                 </div>
		<?PHP
	}
}else{
?>	

                                 <div class="form-group">												
                                    <label class="col-lg-3 control-label">Level:</label>
                                    <div class="col-lg-7">
                                       <select class="js-example-basic-single" name="level" id="level" style="width:250px" <?PHP if($resultData['level'] != NULL){echo"disabled";} ?>>
										  <option></option>
										  <?php if($rowLevel > 0){
											  while ($resultLevel = $queryLevel->fetch_assoc()) {
												?><option value="<?PHP echo $resultLevel['tc_id']; ?>" <?PHP if( $resultLevel['tc_id'] == $resultData['level'] ){echo "selected";}?>> <?PHP echo $resultLevel['tc_title']; ?> </option><?PHP
											  }
										  }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
<!-- ** THIS ** -->
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">State:</label>
                                    <div class="col-lg-7">
                                       <select class="js-example-basic-single" name="state" id="state" style="width:250px" <?PHP if($resultData['state'] != NULL){echo"disabled";} ?>>
										  <option></option>
                                          <?PHP
                                          if($rowState > 0){
											  while ($resultState = $queryState->fetch_assoc()) {
												?><option value="<?PHP echo $resultState['st_id']; ?>" <?PHP if( $resultState['st_id'] == $resultData['state'] ){echo "selected";}?>> <?PHP echo $resultState['st_name']; ?> </option><?PHP
											  }
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
								 
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">City:</label>
                                    <div class="col-lg-7">
                                       <div id="outputCity"></div>
                                       <div id="hideSelectOption">
                                       <select class="js-example-basic-single" style="width:250px" multiple >
                                       <option></option>
                                       </select></div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Rate:</label>
                                    <div class="col-lg-7">
										<input type="text" class="form-control" name="rate" id="rate" style="width:250px" value="<?PHP echo $resultData['rate']; ?>" >
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Note:</label>
                                    <div class="col-lg-7">
										<textarea name="note" id="note" rows="4"  cols="50" style="width:250px"><?PHP echo $resultData['note']; ?></textarea> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-7">
								 <?PHP
								 if(($_GET['action']) == 'edit'){
								 ?>
								 <button type="button" name="update" id="update" class="btn btn-primary btn-md">UPDATE</button>
								 <?PHP 
								 }else{
								 ?>
								 <button type="button" name="save" id="save" class="btn btn-primary btn-md">SAVE</button>
								 <?PHP
								 }
								 ?>										
                                    </div>
                                 </div>
<?PHP
}
?>

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
								 
                                    <table id="listingPrice" class="table table-bordered table-striped dataTables-example">    
										<thead>
											<tr>
												<th>Level</th>
												<th>State</th>
												<th>City</th>
												<th>Rate to Client</th>
												<th>Note</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										if ($rowPrice->num_rows > 0) {
										while( $resultPrice = $rowPrice->fetch_assoc() ){
										?>
                                          <tr class="footable-even">
                                             <td style="width: 15%;">
                                                <?php 
												$queryLevel2 = $conn->query("SELECT * FROM tk_tution_course WHERE tc_id='$resultPrice[level]'");
												$rowLevel2 = $queryLevel2->num_rows;
												if($rowLevel2 > 0){
													$resultLevel2 = $queryLevel2->fetch_assoc();
													echo $resultLevel2['tc_title'];
												}
												?>
                                             </td>
                                             <td style="width: 15%;">
                                               <?php 
												$queryState2 = $conn->query("SELECT * FROM tk_states WHERE st_id='$resultPrice[state]'");
												$rowState2 = $queryState2->num_rows;
												if($rowState2 > 0){
													$resultState2 = $queryState2->fetch_assoc();
													echo $resultState2['st_name'];
												}
											   ?>
                                             </td>
                                             <td style="width: 20%;">
                                                <textarea rows="10"  cols="20">
                                                <?php 
												$cityArray = trim($resultPrice['city']);												
                                                $cityArray2 = explode(',', $cityArray);{
                                                echo "\n";
                                                foreach($cityArray2 as $resCity){
													$queryCity = $conn->query("SELECT * FROM tk_cities WHERE city_id='$resCity'");
													$rowCity = $queryCity->num_rows;
													if($rowCity > 0)
														$resultCity = $queryCity->fetch_assoc();
														//echo $resultCity['city_name'].','.'<br/>';
														echo $resultCity['city_name'].","."\n";
													}
                                                }
												?>                                                    
                                                </textarea> 
                                             </td>
                                             <td style="width: 10%;">
                                                <?php echo $resultPrice['rate'];?>
                                             </td>
                                             <td style="width: 30%;">
                                                <?php echo $resultPrice['note'];?>
                                             </td>
                                             <td class="footable-visible footable-last-column" style="width: 10%;"  >
                                                <div class="btn-group">
                                                   <a href="pricing.php?action=edit&id=<?php echo $resultPrice['id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Update</button></a>
                                                </div>
                                                <div class="btn-group">
                                                   <a href="pricing.php?action=duplicate&id=<?php echo $resultPrice['id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Duplicate</button></a>
                                                </div>
                                                <div class="btn-group">
													<button class="btn-white btn edt-btn btn-xs" onClick="return ConfirmDelete(<?php echo $resultPrice['id'];?>);" type="submit" id="delete">Delete</button>
                                                </div>
												
                                             </td>
                                          </tr>
                                          <?php 
                                             }
                                          } else {
                                             echo '<tr><td colspan="6">No Record Found</td></tr>';
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
<!-- https://select2.org/ -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<style>
.disabled {
	cursor: not-allowed;
}
</style>
         <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
         <script src="js/plugins/dataTables/datatables.min.js"></script>
         <!-- Custom and plugin javascript -->
         <script src="js/plugins/pace/pace.min.js"></script>
<script>
$('#listingPrice').DataTable({
	"order": [[ 0, "asc" ],[ 1, "asc" ],[ 2, "asc" ]],
});      
</script>
<script>
$(".js-example-basic-single").select2({
	placeholder: "Choose one of the following...",
});

$("#level").change(function(){
	var level = $('#level option:selected').val();
	var state = $('#state option:selected').val();
	if(level !== "0" && state !== "0" ){
		$.ajax({
			type:'POST',
			url:'pricing-function.php',
			data:{level: level, state: state},
			success:function(result){
				//$("#outputCity").html(result);
				$.ajax({
					type:'POST',
					url:'pricing-function.php',
					data:{record: result},
					success:function(result2){
						document.getElementById("hideSelectOption").style.display = "none";
						$("#outputCity").html(result2);
						//$("#city").html(result2).select2();

					}
				});
			}
		});
	}
})
$("#state").change(function(){
	var level = $('#level option:selected').val();
	var state = $('#state option:selected').val();
	if(level !== "0" && state !== "0" ){
		$.ajax({
			type:'POST',
			url:'pricing-function.php',
			data:{level: level, state: state},
			success:function(result){
				//$("#outputCity").html(result);
				$.ajax({
					type:'POST',
					url:'pricing-function.php',
					data:{record: result},
					success:function(result2){
					    document.getElementById("hideSelectOption").style.display = "none";
						$("#outputCity").html(result2);
						//$("#city").html(result2).select2();
					}
				});
			}
		});
	}

});

$('#save').click(function(){
	var level = $('#level option:selected').val();
	var state = $('#state option:selected').val();
	var city = $('#city').val();
	var rate = $('#rate').val();
	var note = $('#note').val();
	$.ajax({
		type:'POST',
		url:'pricing-save.php',
		//data:{level: level, state: state, city: city, rate: rate, note: note},
		data: {
			dataSave: {level: level, state: state, city: city, rate: rate, note: note},
		},
		beforeSend: function() {
			//$('#demo').html("Loding ... ");
		},
		success:function(result){
			alert(result);
			if(result == "New record created successfully"){
				window.location = "pricing.php"
			}
		}
	});
});
function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
	});
	return vars;
}
if (window.location.search.indexOf('action=edit') > -1) {

	var mytext = getUrlVars()["action"];
	var number = getUrlVars()["id"];

		$.ajax({
			type:'POST',
			url:'pricing-function.php',
			data:{number: number,},
			success:function(result){
				$.ajax({
					type:'POST',
					url:'pricing-function.php',
					data:{number2: result},
					success:function(result2){
						//$("#city").html(result2).select2();
						document.getElementById("hideSelectOption").style.display = "none";
						$("#outputCity").html(result2);
						//alert(result2);
					}
				});
			}
		});
}
if (window.location.search.indexOf('action=duplicate') > -1) {

	var mytext = getUrlVars()["action"];
	var duplicate = getUrlVars()["id"];

		$.ajax({
			type:'POST',
			url:'pricing-function.php',
			data:{duplicate: duplicate,},
			success:function(result){
				$.ajax({
					type:'POST',
					url:'pricing-function.php',
					data:{duplicate2: result},
					success:function(result2){
						document.getElementById("hideSelectOption").style.display = "none";
						$("#outputCity").html(result2);
					}
				});
			}
		});
}
$('#update').click(function(){
	var level = $('#level option:selected').val();
	var state = $('#state option:selected').val();
	var city = $('#city').val();
	var rate = $('#rate').val();
	var note = $('#note').val();
	
	var mytext = getUrlVars()["action"];
	var number = getUrlVars()["id"];
	/*alert(number + " - " + city + " - " + rate + " - " + note);*/
	
	$.ajax({
		type:'POST',
		url:'pricing-save.php',
		//data:{number: number, city: city, rate: rate, note: note},
		data: {
			dataUpdate: {number: number, city: city, rate: rate, note: note},
		},
		beforeSend: function() {
			//$('#demo').html("Loding ... ");
		},
		success:function(result){
			alert(result);
			if(result == "Update Is Successful"){
				window.location = "pricing.php"
			}
		}
	});
});

$('#duplicate').click(function(){
	var level = $('#levelDuplicate option:selected').val();
	var state = $('#stateDuplicate option:selected').val();
	var city = $('#cityDuplicate').val();
	var rate = $('#rateDuplicate').val();
	var note = $('#noteDuplicate').val();
	
	var mytext = getUrlVars()["action"];
	var number = getUrlVars()["id"];
	/*alert(number + " - " + level + " - " + state + " - " + city + " - " + rate + " - " + note);
	if(number == '' || level == '' || state == '' || city == '' || rate == ''){
		alert("Please Insert Level, State, City And Rate");
	}*/
	
	$.ajax({
		type:'POST',
		url:'pricing-save.php',
		//data:{number: number, city: city, rate: rate, note: note},
		data: {
			dataDuplicate: {number: number, level: level, state: state, city: city, rate: rate, note: note},
		},
		beforeSend: function() {
			//$('#demo').html("Loding ... ");
		},
		success:function(result){
			alert(result);
			if(result == "Duplicate Successful Save"){
				window.location = "pricing.php"
			}
		}
	});
});

function ConfirmDelete(id){
	var x = confirm("Are you sure you want to delete?");
	if (x == true){
		//alert(id);
	$.ajax({
		type:'POST',
		url:'pricing-save.php',
		data: {
			dataDelete: {id: id},
		},
		beforeSend: function() {
		},
		success:function(result){
			alert(result);
			if(result == "Data Has Been Deleted"){
				window.location = "pricing.php"
			}
		}
	});
		
	}
}
</script>
         </div>
      </div>
   </body>
</html>