<style>
.alert {
  padding: 15px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 4px;
}

.alert h4 {
  margin-top: 0;
  color: inherit;
}

.alert .alert-link {
  font-weight: bold;
}

.alert > p,
.alert > ul {
  margin-bottom: 0;
}

.alert > p + p {
  margin-top: 5px;
}

.alert-dismissable,
.alert-dismissible {
  padding-right: 35px;
}

.alert-dismissable .close,
.alert-dismissible .close {
  position: relative;
  top: -2px;
  right: -21px;
  color: inherit;
}

.alert-test {
  background-color: #FDFEFE;
  border-color: #868e96;
  color: #566573;
}

</style>
<?php
/* Database connection start */
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$connect = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($connect->connect_error) {
    die("connection failed : " . $connect->connect_error);
} else {
    // echo "Successfully Connected";
}
/* Database connection end */
date_default_timezone_set("Asia/Kuala_Lumpur");



if(empty($_POST["thisuser"])){
    echo'Empty User';
    exit();
}else{
    $thisuser   = $connect->real_escape_string($_POST["thisuser"]);

    

		$recordFirst = 1;
		$queryTT = " SELECT * FROM tk_timetable WHERE tt_tutor='".$thisuser."' ORDER BY tt_id ASC"; 
		$resultTT = $connect->query($queryTT);
		if ($resultTT->num_rows > 0) {
		?>
<p>Is this your updated available time slots?</p><br/>
<div class="alert alert-test">
    
					<div class="table-responsive">  
						<table class="table" id="dynamic_fieldExistShow" >  
							 <?PHP
							 $recordFirst = 1;
							 while($rowTT = $resultTT->fetch_assoc()){
							 ?>
							<tr>  
								<td>
									<select class="form-control name_list " disabled>
										<option value="Mon" <?PHP if($rowTT['tt_day'] == 'Mon' ){echo 'selected';} ?> >Mon</option>
										<option value="Tues" <?PHP if($rowTT['tt_day'] == 'Tues' ){echo 'selected';} ?> >Tues</option>
										<option value="Wed" <?PHP if($rowTT['tt_day'] == 'Wed' ){echo 'selected';} ?> >Wed</option>
										<option value="Thur" <?PHP if($rowTT['tt_day'] == 'Thur' ){echo 'selected';} ?> >Thur</option>
										<option value="Fri" <?PHP if($rowTT['tt_day'] == 'Fri' ){echo 'selected';} ?> >Fri</option>
										<option value="Sat" <?PHP if($rowTT['tt_day'] == 'Sat' ){echo 'selected';} ?> >Sat</option>
										<option value="Sun"<?PHP if($rowTT['tt_day'] == 'Sun' ){echo 'selected';} ?>  >Sun</option>
									</select>
								</td>  
								<td><input disabled type="text" placeholder="10-11.30am, 5-7pm, 8-10pm" class="form-control name_list" value="<?php echo $rowTT['tt_time'];?>"  /></td>  
							</tr>   
							 <?PHP
							 }
							 ?>
						</table>  
						<br/>
					</div>
			
			
			
		<?PHP
		}else{
		?>

<p>Your available time slots are currently empty. Leave it empty? (not recommended)</p><br/>
<div class="alert alert-test">
					<div class="table-responsive">  
						<table class="table" id="dynamic_fieldShow" >  
							<tr>  
								<td>
									<select class="form-control name_list " disabled>
										<option>Please Select Day</option>
									</select>
								</td>  
								<td><input disabled type="text" placeholder="" class="form-control name_list" value=""  /></td>  
							</tr>  
						</table>  
						<br/>
					</div>
</div>
		<?PHP   
		}
		?>
</div>
<?PHP 
}
?>