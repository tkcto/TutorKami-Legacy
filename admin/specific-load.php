<?PHP
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
     
     $queryPrice = "SELECT * FROM tk_specific ORDER BY id asc";
     $rowPrice = $conn->query($queryPrice);
     
?>

                                    <table id="listingPrice" class="table table-bordered table-striped dataTables-example">    
										<thead>
											<tr>
												<th>ID</th>
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

                                             <td class="footable-visible footable-last-column" style="width: 10%;"  >
                                                 <center>
											    	 <div class="checkbox checkbox-success"><input <?php if ($resultPrice['checkbox'] == 'true') { echo "checked='checked'"; } ?> onclick="clickCheckbox(this.value)" value="<?php echo $resultPrice['id'];?>" type="checkbox"><label for="checkbox3"></label></div>
											    	 <button type="button" class="btn btn-primary btn-md btnSelect"> Update</button>
											    	 <button type="button" class="btn btn-primary btn-md btnDelete"> Delete</button>
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
                                    
                                    
         <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
         <script src="js/plugins/dataTables/datatables.min.js"></script>
         <!-- Custom and plugin javascript -->
         <script src="js/plugins/pace/pace.min.js"></script>
         
<script>
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
                                    