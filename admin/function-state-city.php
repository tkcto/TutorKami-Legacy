<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if (isset($_POST['action'])) {


    
	if ($_POST['action'] == 'getAllCity') {
		if ($_POST['state'] != '') {
            //echo $_POST['state'];
            ?>
                                       <select class="js-example-basic-single" name="city_check2[]" id="city_check2" style="width:100%" multiple >
                                          <!--<option value="">Select City</option>-->
                                          <?PHP
                                    		$queryCity = "SELECT * FROM tk_cities WHERE city_st_id='".$_POST['state']."' ORDER BY city_name";
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
		}else{
		    
		}		
	}
    
    
    
    
    
    
}
?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
$(".js-example-basic-single").select2({
	placeholder: " Select City",
});
</script>