<p>Available Time Slots for Classes</p><br>

<?PHP
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$conn = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($conn->connect_error) {
    die("connection failed : " . $conn->connect_error);
} else {
    // echo "Successfully Connected";
}

date_default_timezone_set("Asia/Kuala_Lumpur");

//echo $_GET['ID'];

if( isset($_POST['IDtimeTableUser']) && $_POST['IDtimeTableUser'] != ''){

		$recordFirst = 1;
		$queryTT = " SELECT * FROM tk_timetable WHERE tt_tutor='".$_POST['IDtimeTableUser']."' ORDER BY tt_id ASC"; 
		$resultTT = $conn->query($queryTT);
		if ($resultTT->num_rows > 0) {
			?>

			
		 <input type="hidden" id="hdnListCountExist" value="<?PHP echo $resultTT->num_rows; ?>"/>
		 <input type="hidden" id="name3" value="<?PHP echo $resultTT->num_rows; ?>" />
				<form name="add_name2" id="add_name2" class="" style="margin-left:5px;">
					<div class="table-responsive">  
						<input type="hidden" id="hdnListCount" value="1"/>  
						<input type="hidden" name="tutorPHP" id="tutorPHP" value="<?php echo $_POST['IDtimeTableUser'];?>"/> 
						<table class="table" id="dynamic_fieldExist" >  
		<?PHP
							 $recordFirst = 1;
							 while($rowTT = $resultTT->fetch_assoc()){
		?>
							<tr id="<?php echo 'thistr'.$rowTT['tt_id'];?>">  
								<td>
									<select id="<?php echo 'select'.$rowTT['tt_id'];?>" name="dayPHP[]" class="form-control name_list" required="" >
										<option value="Mon" <?PHP if($rowTT['tt_day'] == 'Mon' ){echo 'selected';} ?> >Mon</option>
										<option value="Tues" <?PHP if($rowTT['tt_day'] == 'Tues' ){echo 'selected';} ?> >Tues</option>
										<option value="Wed" <?PHP if($rowTT['tt_day'] == 'Wed' ){echo 'selected';} ?> >Wed</option>
										<option value="Thur" <?PHP if($rowTT['tt_day'] == 'Thur' ){echo 'selected';} ?> >Thur</option>
										<option value="Fri" <?PHP if($rowTT['tt_day'] == 'Fri' ){echo 'selected';} ?> >Fri</option>
										<option value="Sat" <?PHP if($rowTT['tt_day'] == 'Sat' ){echo 'selected';} ?> >Sat</option>
										<option value="Sun"<?PHP if($rowTT['tt_day'] == 'Sun' ){echo 'selected';} ?>  >Sun</option>
									</select>
								</td>  
								<td><input id="<?php echo 'input'.$rowTT['tt_id'];?>" type="text" name="namePHP[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list" required="" value="<?php echo $rowTT['tt_time'];?>"  /></td>  
								<?PHP
								//if ($recordFirst == 1) { 
										//$recordFirst++; 
										?>
										<!--<td><input type="hidden" id="name3" value="<?PHP //echo $resultTT->num_rows; ?>" /> <input type="hidden" id="hdnListCountExist" value="<?PHP //echo $resultTT->num_rows; ?>"/></td> -->
										<?PHP
								//}else{
										?>
										<td ><a id="<?php echo 'remove'.$rowTT['tt_id'];?>" style="color:red;font-size:30px;text-decoration: none;" name="remove" class="fa fa-trash-o btn_removePHP"></a></td>  
										<?PHP                            
								//}
								?>
							</tr>   
		<?PHP
							 }
		?>
						</table>  
							<br/>
							<button type="button" name="addMore" id="addMore" class="btn btn-success"><i class="fa fa-plus"></i> Add Day</button>
						<input style="background-color: #ED4917;color: white;" type="button" name="submitExist" id="submitExist" class="btn btn-oren" value="Update" />  
					</div>
				 </form> 
			
			
			
			<?PHP
		}else{
			
		?>
<input type="hidden" id="changeDayArray" />  
				<form name="add_name" id="add_name" style="margin-left:5px;">
					<div class="table-responsive">  
						<input type="hidden" id="hdnListCount" value="1"/>  
						<input type="hidden" name="tutor" id="tutor" value="<?php echo $_POST['IDtimeTableUser'];?>"/> 
						<table class="table" id="dynamic_field" >  
							<!--<tr>  
								<td>
									<select name="day[]" class="form-control name_list" required=""  >
										<option value="" disabled selected>Please Select Day</option>
										<option value="Mon">Mon</option>
										<option value="Tues">Tues</option>
										<option value="Wed">Wed</option>
										<option value="Thur">Thur</option>
										<option value="Fri">Fri</option>
										<option value="Sat">Sat</option>
										<option value="Sun">Sun</option>
									</select>
								</td>  
								<td><input type="text" id="name2" name="name[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list" required="" /></td>  
							</tr>  -->
						</table>  
						<br/>
						<button type="button" name="addTimeTable" id="addTimeTable" class="btn btn-success"><i class="fa fa-plus"></i> Add Day</button>
						<input style="background-color: #ED4917;color: white;" type="button" name="submit" id="submit" class="btn btn-oren" value="Update" />  
					</div>
				 </form> 
		<?PHP   
		}
		?>
		

           
<!-- ****************** START TIMETABLE ******************-->
<script type="text/javascript">  
      var postURL = "/ajax-rate-timetable.php";
      var postURL2 = "/ajax-rate-timetable2.php";
      var i=1; 

      $('#addTimeTable').click(function(){  
           i++;  
           if((document.getElementById('hdnListCount').value) <= '7' ){
               
                var aaa = document.getElementById('hdnListCount').value;
                document.getElementById('hdnListCount').value =  parseInt(aaa) + 1;


//item = document.getElementById("changeDayArray").value;
//var arr = ["Mon", "Thur"];
/*
var arr = [document.getElementById("changeDayArray").value];
$("#daySelOption option").each(function(){
   if(jQuery.inArray($(this).val(),arr) != -1){
     $(this).attr('disabled', 'disabled');
   };
});
*/
				
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">     <td class="changeDay"><select id="daySelOption" name="day[]" class="form-control name_list" required onchange="changeDay()"><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name2" name="name[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="'+i+'" class="fa fa-trash-o btn_remove"></a></td>       </tr>');  
           } else {  
                alert('You can add 7 record only!');  
           }
      });

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
           
           var bbb = document.getElementById('hdnListCount').value;
           document.getElementById('hdnListCount').value =  bbb - 1;
           
      }); 
      
      $('#submit').click(function(){      
            var name2 = document.getElementById("name2");
            if(name2){
                var name2 = document.getElementById('name2').value;
               if(name2 == ''){
                   alert('Empty Description');
                   exit();
               }else{
                   $.ajax({  
                        url:postURL,  
                        method:"POST",  
                        data:$('#add_name').serialize(),
                        type:'json',
						cache: false,
                        success:function(data)  
                        {
                          	//i=1;
                          	//$('.dynamic-added').remove();
                          	//$('#add_name')[0].reset();
            				        //alert('Record Inserted Successfully.');
            				        //alert(data);
            				        //document.getElementById("timetable").click();
									location.reload();
                        }  
                   }); 
               }                
            }else{
               alert('Please Add Day');
               exit();
            }
      });
      
      
      
      
      $('#addMore').click(function(){  
           i++;  
           //if((document.getElementById('hdnListCountExist').value) <= '6' ){
               
                var aaa = document.getElementById('hdnListCountExist').value;
                document.getElementById('hdnListCountExist').value =  parseInt(aaa) + 1;
				
                var thistotal = document.getElementById('name3').value;
                document.getElementById('name3').value = parseInt(thistotal) + 1;
		   
                $('#dynamic_fieldExist').append('<tr id="row'+i+'" class="dynamic-addedThis">     <td><select name="dayPHP[]" class="form-control name_list" required ><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name3" name="namePHP[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="'+i+'" class="fa fa-trash-o btn_removeExist"></a></td>       </tr>');  
           //} else {  
                //alert('You can add 7 record only!');  
           //}
      });

      $(document).on('click', '.btn_removeExist', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
           
           var bbb = document.getElementById('hdnListCountExist').value;
           document.getElementById('hdnListCountExist').value =  parseInt(bbb) - 1;

           var thistotal = document.getElementById('name3').value;
           document.getElementById('name3').value = parseInt(thistotal) - 1;
      });  
      
      $(document).on('click', '.btn_removePHP', function(){  
           var button_id = $(this).attr("id");    
           button_id = button_id.replace(/[^0-9\.]+/g, "");
           /*alert(button_id);*/
           $('#thistr'+button_id+'').remove(); 
		   
            var ccc = document.getElementById('hdnListCountExist').value;
           document.getElementById('hdnListCountExist').value =  parseInt(ccc) - 1;
		   
            var thistotal = document.getElementById('name3').value;
		   document.getElementById('name3').value = parseInt(thistotal) - 1;
           
		   /*$.ajax({
                type:'POST',
                url:'job_details-ajax-remove.php',
                data: {
                    dataRemove: {button_id: button_id},
                },
                success:function(result){
			        if(result = 'Record deleted successfully'){
    			         $("#select"+button_id).remove(); 
    			         $("#input"+button_id).remove(); 
    			         $("#remove"+button_id).remove(); 
    			         
    			         document.getElementById('hdnListCountExist').value = (hdnListCountExist -1);
    			         document.getElementById('name3').value = (thistotal -1);
    			         //alert('Deleted');
			        }else{
			            alert(result);
			        }
                }
           });*/

           
      }); 

      $('#submitExist').click(function(){      
               /*$.ajax({  
                    url:postURL2,  
                    method:"POST",  
                    data:$('#add_name2').serialize(),
                    type:'json',
                    success:function(data)  
                    {
                      	//i=1;
                      	//$('.dynamic-addedThis').remove();
                      	//$('#add_name2')[0].reset();
        				        //alert('Record Inserted Successfully.');
								if(data == 'Empty Rate'){
									alert(data);
								}else{
									alert(data);
									//document.getElementById("timetable").click();
									//$("#add_name2").addClass("hidden");
									//$("#updateSuccess").removeClass("hidden");
								}
                    }  
               });
                */
            var name3 = document.getElementById("name3");
            if(name3){
                var name3 = document.getElementById('name3').value;
               if(name3 == '0'){
                   alert('Please Add Day');
                   exit();
               }else if(name3 == ''){
                   alert('Empty Description');
                   exit();
               }else{
                   //alert('ok');
                   $.ajax({  
                        url:postURL2,  
                        method:"POST",  
                        data:$('#add_name2').serialize(),
                        type:'json',
						cache: false,
                        success:function(data)  
                        {
                          	//i=1;
                          	//$('.dynamic-addedThis').remove();
                          	//$('#add_name2')[0].reset();
            				        //alert('Record Inserted Successfully.');
    								if(data == 'Empty Rate'){
    									alert(data);
    								}else{
    									//alert(data);
    									//document.getElementById("timetable").click();
    									//$("#add_name2").addClass("hidden");
    									//$("#updateSuccess").removeClass("hidden");
										location.reload();
    								}
                        }  
                   });
               }                
            }else{
               alert('Please Add Day');
               exit();
            }

      });
 
 
 
function changeDay() {

// dynamic_field
var changeDayVal = new Array();

$('#dynamic_field tr').each(function() {   
    var tdObject = $(this).find('td:eq(0)'); //locate the <td> holding select;
    var selectObject = tdObject.find("select"); //grab the <select> tag assuming that there will be only single select box within that <td> 
    var selCntry = selectObject.val(); // get the selected country from current <tr>
	changeDayVal.push('"'+selCntry+'" ');
});
	//alert(changeDayVal);
	document.getElementById("changeDayArray").value = changeDayVal;
	
}
</script> 
<!-- ****************** END TIMETABLE ******************-->
		
<?PHP
}else{
	echo 'ERROR';
}
?> 	
		
		
		
		
		
