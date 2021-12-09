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
session_start();

$user_id = $_SESSION['auth']['user_id'];

//echo $user_id;
?>
<style>
.btn-oren { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren:hover, 
.btn-oren:focus, 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  background-image: none; 
} 
 
.btn-oren.disabled, 
.btn-oren[disabled], 
fieldset[disabled] .btn-oren, 
.btn-oren.disabled:hover, 
.btn-oren[disabled]:hover, 
fieldset[disabled] .btn-oren:hover, 
.btn-oren.disabled:focus, 
.btn-oren[disabled]:focus, 
fieldset[disabled] .btn-oren:focus, 
.btn-oren.disabled:active, 
.btn-oren[disabled]:active, 
fieldset[disabled] .btn-oren:active, 
.btn-oren.disabled.active, 
.btn-oren[disabled].active, 
fieldset[disabled] .btn-oren.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}

::-webkit-input-placeholder {
   font-size: 13px;
}

:-moz-placeholder { /* Firefox 18- */
      font-size: 13px;
}

::-moz-placeholder {  /* Firefox 19+ */
      font-size: 13px;
}

:-ms-input-placeholder {
      font-size: 13px;
}
</style>

<?PHP


if( !empty($_GET['ajobid']) && !empty($_GET['alvl']) ){
    
$queryJob = " SELECT * FROM tk_job WHERE j_id='".$_GET['ajobid']."' "; 
$resultJob = $conn->query($queryJob);
if ($resultJob->num_rows > 0) {
    $rowJob = $resultJob->fetch_assoc();
    $onRate = $rowJob['j_check_rate'];
    $onTimetable = $rowJob['j_check_timeday'];
}
?>
<br/>		

<?PHP
$recordFirst = 1;
$queryTT = " SELECT * FROM tk_timetable WHERE tt_tutor='".$user_id."' ORDER BY tt_id ASC"; 
$resultTT = $conn->query($queryTT);
if ($resultTT->num_rows > 0) {
 ?>    


                <input type="hidden" id="hdnListCountExist" value="<?PHP echo $resultTT->num_rows; ?>"/>
                <input type="hidden" id="name3" value="<?PHP echo $resultTT->num_rows; ?>" />
        <form name="add_name2" id="add_name2" class="" style="margin-left:5px;">
            <div class="table-responsive">  
                <input type="hidden" name="tutorPHP" id="tutorPHP" value="<?php echo $user_id;?>"/> 
                <input type="hidden" name="alvlPHP" value="<?php echo $_GET['alvl'];?>">
                <input type="hidden" name="ajobidPHP" value="<?php echo $_GET['ajobid'];?>">
                <!--<input type="hidden" name="rate_input" value="<?php //echo $_GET['rate_input'];?>">-->
                <table class="table" id="dynamic_fieldExist2" >  
                     <?PHP
                     $recordFirst = 1;
                     while($rowTT = $resultTT->fetch_assoc()){
                     ?>
                    <tr id="<?php echo 'thistr'.$rowTT['tt_id'];?>">  
                        <td>
                            <select id="<?php echo 'select'.$rowTT['tt_id'];?>" name="dayPHP[]" class="form-control name_list hahah2" required="" >
                                <option value="Mon" <?PHP if($rowTT['tt_day'] == 'Mon' ){echo 'selected';} ?> >Mon</option>
                                <option value="Tues" <?PHP if($rowTT['tt_day'] == 'Tues' ){echo 'selected';} ?> >Tues</option>
                                <option value="Wed" <?PHP if($rowTT['tt_day'] == 'Wed' ){echo 'selected';} ?> >Wed</option>
                                <option value="Thur" <?PHP if($rowTT['tt_day'] == 'Thur' ){echo 'selected';} ?> >Thur</option>
                                <option value="Fri" <?PHP if($rowTT['tt_day'] == 'Fri' ){echo 'selected';} ?> >Fri</option>
                                <option value="Sat" <?PHP if($rowTT['tt_day'] == 'Sat' ){echo 'selected';} ?> >Sat</option>
                                <option value="Sun"<?PHP if($rowTT['tt_day'] == 'Sun' ){echo 'selected';} ?>  >Sun</option>
                            </select>
                        </td>  
                        <td><input id="<?php echo 'input'.$rowTT['tt_id'];?>" type="text" name="namePHP[]" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list hahah" required="" value="<?php echo $rowTT['tt_time'];?>"  /></td>  
                        <td ><a id="<?php echo 'remove'.$rowTT['tt_id'];?>" style="color:red;font-size:30px;text-decoration: none;" name="remove" class="fa fa-trash-o btn_removePHP"></a></td> 
                    </tr>   
                     <?PHP
                     }
                     ?>
                </table>  
					<?PHP if($onTimetable == 'on' && $onRate != 'on'){ 
					?>
                        <button type="button" name="addMore" id="addMore" class="btn btn-success"><i class="fa fa-plus"></i> Add Day </button>
                        <input type="button" name="updateTimeTable" id="updateTimeTable" class="btn btn-oren" value="Update" />  
					<?PHP
					}else{
					?>
                        <button type="button" name="addMore" id="addMore" class="btn btn-success"><i class="fa fa-plus"></i> Add Day </button>
                        <!--<input type="button" onclick="ButtonCancel()" class="btn btn-oren" value="Back" />-->
                        <input type="button" name="submitExist" id="submitExist" class="btn btn-oren" value="Update" />  
					<?PHP
					}						
					?>
            </div>
         </form> 
    
			
	
    
    
    <?PHP
}else{
    
?>
        <form name="add_name" id="add_name" style="margin-left:5px;">
            <div class="table-responsive">  
                <input type="hidden" id="hdnListCount" value="1"/>  
                <input type="hidden" name="tutor" id="tutor" value="<?php echo $user_id;?>"/> 
                <input type="hidden" name="alvl" value="<?php echo $_GET['alvl'];?>">
                <input type="hidden" name="ajobid" value="<?php echo $_GET['ajobid'];?>">
                <!--<input type="hidden" name="rate_input" value="<?php //echo $_GET['rate_input'];?>">-->
                <table class="table" id="dynamic_field" >  
  
                </table>  
					<?PHP if($onTimetable == 'on' && $onRate != 'on'){ 
					?>
					    <button type="button" name="addNew" id="addNew" class="btn btn-success"><i class="fa fa-plus"></i> Add Day </button>
                        <input type="button" name="updateTimeTable2" id="updateTimeTable2" class="btn btn-oren" value="Update" />  
					<?PHP
					}else{
					?>
					    <button type="button" name="addNew" id="addNew" class="btn btn-success"><i class="fa fa-plus"></i> Add Day </button>
                        <!--<input type="button" onclick="ButtonCancel()" class="btn btn-oren" value="Back" />-->
                        <input type="button" name="submitNew" id="submitNew" class="btn btn-oren" value="Update" />  
					<?PHP
					}						
					?>
                
            </div>
         </form> 
<?PHP   
}
?>                

                




<?PHP
}else{
    echo 'Error';
}
?>

 
 
<script type="text/javascript">  
var i=1; 
var ii=1; 

var aaa=0; 
var bbb=0; 
var ccc=0; 
var ddd=0; 
var eee=0; 
var fff=0; 
var ggg=0; 
var hhh=0; 


      $('#addNew').click(function(){  
           i++;  
           if((document.getElementById('hdnListCount').value) <= '7' ){
               
                aaa = document.getElementById('hdnListCount').value;
                document.getElementById('hdnListCount').value =  parseInt(aaa) + 1;
                $('#dynamic_field').append('<tr id="rowNew'+i+'" class="dynamic-added">     <td><select name="day[]" class="form-control name_list thishahah2" required onchange="changeDay(this.options[this.selectedIndex].value,'+i+')"><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name2" name="nameNew[]" placeholder="State your available slots e.g 10-11.30am, 5-7pm, 8-10pm" class="form-control name_list thishahah" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" onclick="ButtonRemove('+i+')" name="remove" id="'+i+'" class="fa fa-trash-o btn_remove"></a></td>       </tr>');  
           } else {  
                alert('You can add 7 record only!');  
           }
      });
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#rowNew'+button_id+'').remove();  
           
           bbb = document.getElementById('hdnListCount').value;
           document.getElementById('hdnListCount').value =  parseInt(bbb) - 1;
      }); 
      /*function ButtonRemove (id){ 
           $('#rowNew'+id+'').remove();  
           bbb = document.getElementById('hdnListCount').value;
           document.getElementById('hdnListCount').value =  parseInt(bbb) - 1;
      }*/
	  
      function ButtonCancel (){
			document.getElementById("loadDataTimeTable").innerHTML = "";
			$('#loadDataTimeTable').html("");
			$("#addClass").removeClass("hidden");
			$("#addClass2").addClass("hidden");
			$("#addClass3").addClass("hidden");
      }
      $('#submitNew').click(function(){      
            var name2 = document.getElementById("name2");
            if(name2){
                var name2 = document.getElementById('name2').value;
               if(name2 == ''){
                   alert('Empty Description');
                   exit();
               }else{

					if($('.thishahah2').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Day');
						exit();
						return false;
					}				   
					if($('.thishahah').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Description');
						exit();
						return false;
					}
					   $.ajax({  
							url:"ajax-rate-timetable.php",  
							method:"POST",  
							data:$('#add_name').serialize(),
							type:'json',
							cache: false,
							success:function(data) {
								if(data == 'Updated'){
									alert(data);
									document.getElementById("loadCurrTimeSlot").innerHTML = "";
									var thisuser   = document.getElementById("tutor").value;
										$.ajax({
											type: "POST",
											url: "loadCurrTimeSlot.php",
											data: {thisuser: thisuser},  
											cache: true,
											success: function(response) {
												$('#loadCurrTimeSlot').html(response);
											}
										});
									$("#addClass").removeClass("hidden");
									$("#addClass2").addClass("hidden");
									$("#addClass3").addClass("hidden");
								}else{
									alert(data);
								}
							}  
					   }); 
               }                
            }else{
               alert('Please Add Day');
               exit();
            }
      });
 
	  
	  



      $(document).on('click', '.btn_removePHP', function(){  
           var button_id = $(this).attr("id");    
           button_id = button_id.replace(/[^0-9\.]+/g, "");
           $('#thistr'+button_id+'').remove(); 
		   
            ccc = document.getElementById('hdnListCountExist').value;
           document.getElementById('hdnListCountExist').value =  parseInt(ccc) - 1;
		   
            ddd = document.getElementById('name3').value;
		   document.getElementById('name3').value = parseInt(ddd) - 1;
 
      }); 
      $('#addMore').click(function(){  
           ii++;  
           if((document.getElementById('hdnListCountExist').value) <= '6' ){
               
                eee = document.getElementById('hdnListCountExist').value;
                document.getElementById('hdnListCountExist').value =  parseInt(eee) + 1;
				
                fff = document.getElementById('name3').value;
                document.getElementById('name3').value = parseInt(fff) + 1;
		   
                $('#dynamic_fieldExist2').append('<tr id="rowExist'+ii+'" class="dynamic-addedThis">     <td><select name="dayPHP[]" class="form-control name_list hahah2" required ><option value="" disabled selected>Please Select Day</option><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" id="name3" name="namePHP[]" placeholder="State your available slots e.g 10-11.30am, 5-7pm, 8-10pm" class="form-control name_list hahah" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" onclick="ButtonRemove2('+ii+')" name="remove" id="'+ii+'" class="fa fa-trash-o btn_removeExist"></a></td>       </tr>');  
           } else {  
                alert('You can add 7 record only!');  
           }
      });
      $(document).on('click', '.btn_removeExist', function(){  
           var button_id = $(this).attr("id");   
           $('#rowExist'+button_id+'').remove();  
           
           var bbb = document.getElementById('hdnListCountExist').value;
           document.getElementById('hdnListCountExist').value =  parseInt(bbb) - 1;

           var thistotal = document.getElementById('name3').value;
           document.getElementById('name3').value = parseInt(thistotal) - 1;
      });    
      $('#submitExist').click(function(){      
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
					if($('.hahah2').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Day');
						exit();
						return false;
					}				   
					if($('.hahah').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Description');
						exit();
						return false;
					}
				   $.ajax({  
						url:"ajax-rate-timetable2.php",  
						method:"POST",  
						data:$('#add_name2').serialize(),
						type:'json',
						success:function(data)  {
								if(data == 'Updated'){
									alert(data);
									document.getElementById("loadCurrTimeSlot").innerHTML = "";
									var thisuser   = document.getElementById("tutorPHP").value;
										$.ajax({
											type: "POST",
											url: "loadCurrTimeSlot.php",
											data: {thisuser: thisuser},  
											cache: true,
											success: function(response) {
												$('#loadCurrTimeSlot').html(response);
											}
										});
									$("#addClass").removeClass("hidden");
									$("#addClass2").addClass("hidden");
									$("#addClass3").addClass("hidden");
								}else{
									alert(data);
								}
						}  
				   }); 
				   
				   
               }                
            }else{
               alert('Please Add Day');
               exit();
            }
      });




$('#updateTimeTable2').click(function(){   
            var name2 = document.getElementById("name2");
            if(name2){
                var name2 = document.getElementById('name2').value;
               if(name2 == ''){
                   alert('Empty Description');
                   exit();
               }else{

					if($('.thishahah2').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Day');
						exit();
						return false;
					}				   
					if($('.thishahah').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Description');
						exit();
						return false;
					}
					
					   $.ajax({  
							url:"ajax-rate-timetable.php",  
							method:"POST",  
							data:$('#add_name').serialize(),
							type:'json',
							cache: false,
							success:function(data) {
								if(data == 'Updated'){
									alert(data);
									document.getElementById("loadCurrTimeSlot").innerHTML = "";
									var thisuser   = document.getElementById("tutor").value;
										$.ajax({
											type: "POST",
											url: "loadCurrTimeSlot.php",
											data: {thisuser: thisuser},  
											cache: true,
											success: function(response) {
												$('#loadCurrTimeSlot').html(response);
											}
										});
									$("#addClass").removeClass("hidden");
									$("#addClass2").addClass("hidden");
									$("#addClass3").addClass("hidden");
								}else{
									alert(data);
								}
							}  
					   }); 
               }                
            }else{
               alert('Please Add Day');
               exit();
            }
});


$('#updateTimeTable').click(function(){   
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
					if($('.hahah2').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Day');
						exit();
						return false;
					}				   
					if($('.hahah').filter(function(){ return !this.value.trim(); }).length){
						alert('Empty Description');
						exit();
						return false;
					}
				   $.ajax({  
						url:"ajax-rate-timetable2.php",  
						method:"POST",  
						data:$('#add_name2').serialize(),
						type:'json',
						success:function(data)  {
								if(data == 'Updated'){
									alert(data);
									document.getElementById("loadCurrTimeSlot").innerHTML = "";
									var thisuser   = document.getElementById("tutorPHP").value;
										$.ajax({
											type: "POST",
											url: "loadCurrTimeSlot.php",
											data: {thisuser: thisuser},  
											cache: true,
											success: function(response) {
												$('#loadCurrTimeSlot').html(response);
											}
										});
									$("#addClass").removeClass("hidden");
									$("#addClass2").addClass("hidden");
									$("#addClass3").addClass("hidden");
								}else{
									alert(data);
								}
						}  
				   }); 
				   
				   
               }                
            }else{
               alert('Please Add Day');
               exit();
            }
});



</script> 