<!-- pricing-delete-later.php -->
<!DOCTYPE html>
<html>
   <head>
    <?php 
     $title = 'pricing-delete-later.php';
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
	 
     $queryPrice = "SELECT * FROM tk_location_rate2";
     $rowPrice = $conn->query($queryPrice);
    ?>
   </head>
   <body>
      <div id="wrapper">
         <?php include_once('includes/sidebar.php'); ?>
         <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php'); ?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox float-e-margins">                        
                        <div class="ibox-content">
                           <div class="form-horizontal">
                                 <div class="form-group">												
                                    <label class="col-lg-3 control-label">Level:</label>
                                    <div class="col-lg-7">
                                       <select class="selectpicker show-menu-arrow" name="lr_jl_id" id="level" data-live-search="true" data-width="250px" title="Choose one of the following...">
                                                                 
                                          <?php 
										  if($rowLevel > 0){
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
                                       <select class="selectpicker show-menu-arrow" name="lr_st_id" id="ud_state" data-live-search="true" data-width="250px" title="Choose one of the following...">
                                     
                                          <?PHP
                                          if($rowState > 0){
											  while ($resultState = $queryState->fetch_assoc()) {
												?><option value="<?PHP echo $resultState['st_id']; ?>"> <?PHP echo $resultState['st_name']; ?> </option><?PHP
											  }
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
								 
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">City:</label>
                                    <div class="col-lg-7">
                                       <select class="selectpicker show-menu-arrow" name="lr_city_id" id="ud_city" data-live-search="true" multiple data-selected-text-format="count > 4" data-width="250px" data-actions-box="true" title="Choose one or more...">
                                          
                                          
                                       </select>
                                    </div>
                                 </div>
                           <button type="button" name="filter" id="filter" class="btn btn-info btn-md">Filter</button>
                           </div>
                        </div>
                        <div class="ibox-content">
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
								 
									<div id="test"></div>
                                    <table id="joblist-grid" class="table table-bordered table-striped">    
										<thead>
											<tr>
												<th>Level</th>
												<th>State</th>
												<th>City</th>
												<th>Rate</th>
												<th>Note</th>
												<th>Update</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										if ($rowPrice->num_rows > 0) {
										while( $resultPrice = $rowPrice->fetch_assoc() ){
										?>
                                          <tr class="footable-even">
                                             <td style="width: 20%;">
                                                <?php 
												$queryLevel2 = $conn->query("SELECT * FROM tk_tution_course WHERE tc_id='$resultPrice[level]'");
												$rowLevel2 = $queryLevel2->num_rows;
												if($rowLevel2 > 0){
													$resultLevel2 = $queryLevel2->fetch_assoc();
													echo $resultLevel2['tc_title'];
												}
												?>
                                             </td>
                                             <td style="width: 20%;">
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
                                                <?php 
                                                $cityArray = explode(',', $resultPrice['city']);
                                                foreach($cityArray as $resCity){
													$queryCity = $conn->query("SELECT * FROM tk_cities WHERE city_id='$resCity'");
													$rowCity = $queryCity->num_rows;
													if($rowCity > 0){
														$resultCity = $queryCity->fetch_assoc();
														echo $resultCity['city_name'].','.'<br>';
													}
                                                }
												?>
                                                
                                             </td>
                                             <td style="width: 20%;">
                                                <?php echo $resultPrice['rate'];?>
                                             </td>
                                             <td style="width: 20%;">
                                                <?php echo $resultPrice['note'];?>
                                             </td>
                                             <td class="footable-visible footable-last-column" style="width: 20%;"  >
                                                <div class="btn-group">
                                                   <a href="pricing.php?action=edit&lr_id=<?php //echo $row['lr_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
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
                     </div>
                  </div>
               </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
            <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
         <script src="js/plugins/dataTables/datatables.min.js"></script>
         <!-- Custom and plugin javascript -->
         <script src="js/plugins/pace/pace.min.js"></script>
         <script>
            $(document).ready(function(){
              $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                ]
             });
            
              /* Init DataTables */
              var oTable = $('#editable').DataTable();
            
              /* Apply the jEditable handlers to the table */
              oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                  var aPos = oTable.fnGetPosition( this );
                  oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                  return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                  };
                },
            
                "width": "90%",
                "height": "100%"
              } );
            
            
            });
            
            function fnClickAddRow() {
              $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );
            
            }
         </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
$('.selectpicker').selectpicker();

$("#level").change(function(){
	var level = $('#level option:selected').val();
	var state = $('#ud_state option:selected').val();
	if(level !== "0" && state !== "0" ){
		$.ajax({
			type:'POST',
			url:'pricing-function.php',
			data:{level: level, state: state},
			success:function(result){
				//$("#ud_city").html(result).selectpicker('refresh');
				//$("#test").html(result);
		$.ajax({
			type:'POST',
			url:'pricing-function.php',
			data:{record: result},
			success:function(result2){
				//$("#test").html(result2);
				$("#ud_city").html(result2).selectpicker('refresh');
			}
		});
			}
		});
	}
})
$("#ud_state").change(function(){
	var level = $('#level option:selected').val();
	var state = $('#ud_state option:selected').val();
	if(level !== "0" && state !== "0" ){
		$.ajax({
			type:'POST',
			url:'pricing-function.php',
			data:{level: level, state: state},
			success:function(result){
				//$("#ud_city").html(result).selectpicker('refresh');
				//$("#test").html(result);
		$.ajax({
			type:'POST',
			url:'pricing-function.php',
			data:{record: result},
			success:function(result2){
				//$("#test").html(result2);
				$("#ud_city").html(result2).selectpicker('refresh');
			}
		});
			}
		});
	}
	/*if(state !== "0" ){
		$.ajax({
			url: "ajax/ajax_call.php",
			method: "POST",
			data: {action: 'get_city2', state_id: state}, 
			success: function(result){
				$("#ud_city").html(result).selectpicker('refresh');
			}

		});
	}*/
});
$("#ud_city").change(function(){
	var city = $('.selectpicker#ud_city').val();
	//alert(city);

})
$('#filter').click(function(){
	var level = $('#level option:selected').val();
	var state = $('#ud_state option:selected').val();
	var city = $('.selectpicker#ud_city').val();
	$.ajax({
		type:'POST',
		url:'pricing-save.php',
		data:{level: level, state: state, city: city},
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
</script>
         </div>
      </div>
   </body>
</html>
<!-- pricing-delete-later.php -->

<!-- pricing-function.php -->
<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
if( !empty($_POST["level"]) && !empty($_POST["state"]) ){
	$queryPrice = "SELECT * FROM tk_location_rate2 WHERE level='".$_POST["level"]."' AND state='".$_POST["state"]."' ";
	$rowPrice = $conn->query($queryPrice);
	if ($rowPrice->num_rows > 0) {
		while( $resultPrice = $rowPrice->fetch_assoc() ){
			$allrecord = $resultPrice['city'].",";
			echo $allrecord;
		}
	}else{
		$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$_POST["state"]."' ";
		$rowCity = $conn->query($queryCity);
		if ($rowCity->num_rows > 0) {       
			while( $resultCity = $rowCity->fetch_assoc() ){
				$allrecord = $resultCity['city_id'].",";
				echo $allrecord;
			}
		}
	}
}
/*if( !empty($_POST["record"]) ){
	$cityArray = explode(',', $_POST["record"]);
	foreach($cityArray as $resCity){
		$queryCity = $conn->query("SELECT * FROM tk_cities WHERE city_id='$resCity'");
		$rowCity = $queryCity->num_rows;
		if($rowCity > 0){
			$resultCity = $queryCity->fetch_assoc();
			//echo $resultCity['city_name'].','.'<br>';
			echo '<option value="'.$resultCity['city_id'].'">'.$resultCity['city_name'].'</option>';
		}
	}
}*/
if( !empty($_POST["record"]) ){
	$cityArray = explode(',', $_POST["record"]);
	foreach($cityArray as $resCity){
	echo '<option value="'.$resCity.'">'.$resCity.'</option>';
		/*$queryCity = $conn->query("SELECT * FROM tk_cities WHERE city_id='$resCity'");
		$rowCity = $queryCity->num_rows;
		if($rowCity > 0){
			$resultCity = $queryCity->fetch_assoc();
			echo '<option value="'.$resultCity['city_id'].'">'.$resultCity['city_name'].'</option>';
		}*/
	}
}
$conn->close();
?>
<!-- pricing-function.php -->