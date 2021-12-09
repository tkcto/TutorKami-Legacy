<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

function getBetween($content,$start,$end){
$r = explode($start, $content);
if (isset($r[1])){
	$r = explode($end, $r[1]);
	return $r[0];
}
return '';
}
  
if( !empty($_POST["level"]) && !empty($_POST["state"]) ){
	$queryPrice = "SELECT * FROM tk_location_rate2 WHERE level='".$_POST["level"]."' AND state='".$_POST["state"]."' ";
	$rowPrice = $conn->query($queryPrice);
	if ($rowPrice->num_rows > 0) {
		echo "=true:".$_POST["state"]."=";
		while( $resultPrice = $rowPrice->fetch_assoc() ){
			$allrecord = $resultPrice['city'].",";
			echo $allrecord;
		}
	}else{
		echo "=false:".$_POST["state"]."=";
		$allrecord = "".",";
		echo $allrecord;
	}
}

if( !empty($_POST["record"]) ){
	$start = "=";
	$end = ":";
	$output = getBetween($_POST["record"],$start,$end);
	if($output == "true"){
		$start2 = ":";
		$end2 = "=";
		$output2 = getBetween($_POST["record"],$start2,$end2);
		$recordArr =  end(explode('=',$_POST["record"]));
		$removeLast = substr($recordArr, 0, -1);
		$removeLast2 = array($recordArr);
		$cityArray = explode(',', $removeLast);
		/*echo $_POST["record"]."<br/>";
		echo $output2."<br/>";
		echo $recordArr."<br/>";*/
		
		$mystring = substr($_POST["record"], strrpos($_POST["record"], '=' )+1);
		$result = preg_replace('/[ ,]+/', ' ', trim($mystring));
		$mystring2 = $array = explode(' ', $result);
?>
<button type="button" name="btnSelectAll1" id="btnSelectAll1" class="btn btn-success btn-xs">Select All</button>
<button type="button" name="btnRemoveAll1" id="btnRemoveAll1" class="btn btn-success btn-xs">Remove All</button>
<br/>
<select class="js-example-tokenizer no1" name="city" id="city" style="width:250px" multiple="multiple" >
<option></option>
<?PHP
		//$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$output2."' AND city_id NOT IN ('".$removeLast2."') ORDER BY city_name";
		$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$output2."' AND city_id NOT IN (".implode(",",array_map('intval', $mystring2)).") ORDER BY city_name";
		
		$rowCity = $conn->query($queryCity);
		if ($rowCity->num_rows > 0) {      
			while( $resultCity = $rowCity->fetch_assoc() ){
				if(in_array($resultCity['city_id'],$cityArray)){
				}else{
				?>
				<option value="<?php echo $resultCity['city_id']; ?>" <?php if(in_array($resultCity['city_id'],$cityArray)){ echo "disabled"; } ?> ><?PHP echo $resultCity['city_name']; ?></option>
				<?php
				}
			}

		}
?>
</select>
<?PHP

		
	}else{
		$start3 = ":";
		$end3 = "=";
		$output3 = getBetween($_POST["record"],$start3,$end3);
		/*echo $output3."<br/>";*/
?>	
<button type="button" name="btnSelectAll2" id="btnSelectAll2" class="btn btn-success btn-xs">Select All</button>
<button type="button" name="btnRemoveAll2" id="btnRemoveAll2" class="btn btn-success btn-xs">Remove All</button>
<br/>	
<select class="js-example-tokenizer no2" name="city" id="city" style="width:250px" multiple="multiple" >
<option></option>
<?PHP
		$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$output3."' ORDER BY city_name";
		$rowCity = $conn->query($queryCity);
		if ($rowCity->num_rows > 0) {      
			while( $resultCity = $rowCity->fetch_assoc() ){
				?>
				<option value="<?php echo $resultCity['city_id']; ?>"><?PHP echo $resultCity['city_name']; ?></option>
				<?php
			}

		}
?>
</select>
<?PHP

	}
}

if( !empty($_POST["number"]) ){
	$queryData = "SELECT * FROM tk_location_rate2 WHERE id='".$_POST["number"]."' ";
	$rowData = $conn->query($queryData);
	if ($rowData->num_rows > 0) {
		$resultData = $rowData->fetch_assoc();	
		
		echo "=".$_POST["number"]."=";
		echo "-".$resultData['city']."-";
		
		$queryData2 = "SELECT * FROM tk_location_rate2 WHERE level='".$resultData['level']."' AND state='".$resultData['state']."' AND id != '".$_POST["number"]."' ";			
		$rowData2 = $conn->query($queryData2);
		if ($rowData2->num_rows > 0) {
			echo "+true+";
			while($resultData2 = $rowData2->fetch_assoc()){
				echo $resultData2['city'].",";
			}	
		}else{
			echo "+false+";
			$queryData2 = "SELECT * FROM tk_location_rate2 id = '".$_POST["number"]."' ";			
			$rowData2 = $conn->query($queryData2);
			if ($rowData2->num_rows > 0) {
				while($resultData2 = $rowData2->fetch_assoc()){
					echo $resultData2['city'].",";
				}	
			}
			
		}
	}
}

if( !empty($_POST["number2"]) ){
	$removeLast = substr($_POST["number2"], 0, -1);
	
	$startGetID = "=";
	$endGetID = "=";
	$outputGetID = getBetween($removeLast,$startGetID,$endGetID);

	$startGetSelectCity = "-";
	$endGetSelectCity = "-";
	$outputGetSelectCity = getBetween($removeLast,$startGetSelectCity,$endGetSelectCity);

	$startTrueFalse = "+";
	$endTrueFalse = "+";
	$outputTrueFalse = getBetween($removeLast,$startTrueFalse,$endTrueFalse);

	$outputGetAllSelectCity =  end(explode('+',$removeLast ));
	
	$cityArrayGetSelectCity = explode(',', $outputGetSelectCity);
	$cityArrayGetAllSelectCity = explode(',', $outputGetAllSelectCity);
	
	
	$removeLast2 = array($outputGetAllSelectCity);
	
		$mystring = substr($_POST["number2"], strrpos($_POST["number2"], '+' )+1);
		$result = preg_replace('/[ ,]+/', ' ', trim($mystring));
		$mystring2 = $array = explode(' ', $result);

	/*echo $_POST["number2"];
	echo "<br/>";
	echo $removeLast;
	echo "<br/>";
	echo $outputGetID;
	echo "<br/>";
	echo $outputGetSelectCity;
	echo "<br/>";
	echo $outputTrueFalse;
	echo "<br/>";
	echo $outputGetAllSelectCity;*/

	$queryData = "SELECT * FROM tk_location_rate2 WHERE id='".$outputGetID."' ";
	$rowData = $conn->query($queryData);
	if ($rowData->num_rows > 0) {
		$resultData = $rowData->fetch_assoc();	
?>		
<button type="button" name="btnSelectAll3" id="btnSelectAll3" class="btn btn-success btn-xs">Select All</button>
<button type="button" name="btnRemoveAll3" id="btnRemoveAll3" class="btn btn-success btn-xs">Remove All</button>
<br/>
<select class="js-example-tokenizer no3" name="city" id="city" style="width:250px" multiple="multiple" >
<option></option>
<?PHP
		if($outputTrueFalse == "true"){
			//$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$resultData['state']."' AND city_id NOT IN ('".$removeLast2."') ORDER BY city_name";
			$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$resultData['state']."' AND city_id NOT IN (".implode(",",array_map('intval', $mystring2)).") ORDER BY city_name";
		
			$rowCity = $conn->query($queryCity);
			if ($rowCity->num_rows > 0) {      
				while( $resultCity = $rowCity->fetch_assoc() ){
					if(in_array($resultCity['city_id'],$cityArrayGetAllSelectCity)){
					}else{
					?>
					<option value="<?php echo $resultCity['city_id']; ?>" <?php if(in_array($resultCity['city_id'],$cityArrayGetSelectCity)){ echo"selected"; } ?> <?php if(in_array($resultCity['city_id'],$cityArrayGetAllSelectCity)){ echo "disabled"; } ?> ><?PHP echo $resultCity['city_name']; ?></option>
					<?php
					}
				}
			}			
		}
		if($outputTrueFalse == "false"){
			$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$resultData['state']."' ORDER BY city_name";
			$rowCity = $conn->query($queryCity);
			if ($rowCity->num_rows > 0) {      
				while( $resultCity = $rowCity->fetch_assoc() ){
					?>
					<option value="<?php echo $resultCity['city_id']; ?>" <?php if(in_array($resultCity['city_id'],$cityArrayGetSelectCity)){ echo"selected"; } ?>  ><?PHP echo $resultCity['city_name']; ?></option>
					<?php
				}
			}
		}
?>
</select>
<?PHP

		
	}
}



if( !empty($_POST["duplicate"]) ){
	$queryData = "SELECT * FROM tk_location_rate2 WHERE id='".$_POST["duplicate"]."' ";
	$rowData = $conn->query($queryData);
	if ($rowData->num_rows > 0) {
		$resultData = $rowData->fetch_assoc();	
		
		echo "=".$_POST["duplicate"]."=";
		echo "-".$resultData['city']."-";
		
		$queryData2 = "SELECT * FROM tk_location_rate2 WHERE level='".$resultData['level']."' AND state='".$resultData['state']."' AND id != '".$_POST["duplicate"]."' ";			
		$rowData2 = $conn->query($queryData2);
		if ($rowData2->num_rows > 0) {
			echo "+true+";
			while($resultData2 = $rowData2->fetch_assoc()){
				echo $resultData2['city'].",";
			}	
		}else{
			echo "+false+";
			$queryData2 = "SELECT * FROM tk_location_rate2 id = '".$_POST["duplicate"]."' ";			
			$rowData2 = $conn->query($queryData2);
			if ($rowData2->num_rows > 0) {
				while($resultData2 = $rowData2->fetch_assoc()){
					echo $resultData2['city'].",";
				}	
			}
			
		}
	}
}

if( !empty($_POST["duplicate2"]) ){
	$removeLast = substr($_POST["duplicate2"], 0, -1);
	
	$startGetID = "=";
	$endGetID = "=";
	$outputGetID = getBetween($removeLast,$startGetID,$endGetID);

	$startGetSelectCity = "-";
	$endGetSelectCity = "-";
	$outputGetSelectCity = getBetween($removeLast,$startGetSelectCity,$endGetSelectCity);

	$startTrueFalse = "+";
	$endTrueFalse = "+";
	$outputTrueFalse = getBetween($removeLast,$startTrueFalse,$endTrueFalse);

	$outputGetAllSelectCity =  end(explode('+',$removeLast ));
	
	$cityArrayGetSelectCity = explode(',', $outputGetSelectCity);
	$cityArrayGetAllSelectCity = explode(',', $outputGetAllSelectCity);
	
	
	$removeLast2 = array($outputGetAllSelectCity);
	
		$mystring = substr($_POST["duplicate2"], strrpos($_POST["duplicate2"], '+' )+1);
		$result = preg_replace('/[ ,]+/', ' ', trim($mystring));
		$mystring2 = $array = explode(' ', $result);


	$queryData = "SELECT * FROM tk_location_rate2 WHERE id='".$outputGetID."' ";
	$rowData = $conn->query($queryData);
	if ($rowData->num_rows > 0) {
		$resultData = $rowData->fetch_assoc();	
?>		
<!--<button type="button" name="btnSelectAll3" id="btnSelectAll3" class="btn btn-success btn-xs">Select All</button>
<button type="button" name="btnRemoveAll3" id="btnRemoveAll3" class="btn btn-success btn-xs">Remove All</button>
<br/>-->
<select class="js-example-tokenizer no3" name="cityDuplicate" id="cityDuplicate" style="width:250px" multiple="multiple" disabled>
<option></option>
<?PHP
		if($outputTrueFalse == "true"){
			$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$resultData['state']."' AND city_id NOT IN (".implode(",",array_map('intval', $mystring2)).") ORDER BY city_name";
		
			$rowCity = $conn->query($queryCity);
			if ($rowCity->num_rows > 0) {      
				while( $resultCity = $rowCity->fetch_assoc() ){
					if(in_array($resultCity['city_id'],$cityArrayGetAllSelectCity)){
					}else{
					?>
					<option value="<?php echo $resultCity['city_id']; ?>" <?php if(in_array($resultCity['city_id'],$cityArrayGetSelectCity)){ echo"selected"; } ?> <?php if(in_array($resultCity['city_id'],$cityArrayGetAllSelectCity)){ echo "disabled"; } ?> ><?PHP echo $resultCity['city_name']; ?></option>
					<?php
					}
				}
			}			
		}
		if($outputTrueFalse == "false"){
			$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$resultData['state']."' ORDER BY city_name";
			$rowCity = $conn->query($queryCity);
			if ($rowCity->num_rows > 0) {      
				while( $resultCity = $rowCity->fetch_assoc() ){
					?>
					<option value="<?php echo $resultCity['city_id']; ?>" <?php if(in_array($resultCity['city_id'],$cityArrayGetSelectCity)){ echo"selected"; } ?>  ><?PHP echo $resultCity['city_name']; ?></option>
					<?php
				}
			}
		}
?>
</select>
<?PHP

		
	}
}
$conn->close();
?>
<script>
$(".js-example-tokenizer").select2({
    /*tags: true,
    tokenSeparators: [','],*/
    closeOnSelect: false

});

$("#btnSelectAll1").click(function(){
	$(".no1 > option").prop("selected","selected");
	$(".no1").trigger("change");
});
$("#btnRemoveAll1").click(function(){
	$(".no1 > option").removeAttr("selected");
	$(".no1").trigger("change");
});

$("#btnSelectAll2").click(function(){
	$(".no2 > option").prop("selected","selected");
	$(".no2").trigger("change");
});
$("#btnRemoveAll2").click(function(){
	$(".no2 > option").removeAttr("selected");
	$(".no2").trigger("change");
});

$("#btnSelectAll3").click(function(){
	$(".no3 > option").prop("selected","selected");
	$(".no3").trigger("change");
});
$("#btnRemoveAll3").click(function(){
	$(".no3 > option").removeAttr("selected");
	$(".no3").trigger("change");
});
</script>
