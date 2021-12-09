<?php
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['action'])) {
    
	if ($_POST['action'] == 'CityID') {
		$CityID = $_POST['CityID'];
		if( $CityID == '1384' ){
                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        ?><option value="" >Select State</option><?php 
                        while($resultDataState= $rowDataState->fetch_assoc()){
                    	    ?>
                    	    <option value="<?php echo $resultDataState['st_id'];?>" ><?php echo $resultDataState['st_name'];?></option>
                    	    <?php 
                        }
                    }
            
		}else{
            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_id = '".$CityID."' ";
            $rowDataCity = $conn->query($queryDataCity);
            if ($rowDataCity->num_rows > 0) {
                $resultDataCity = $rowDataCity->fetch_assoc();
                    //$resultDataCity['city_st_id']
                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        while($resultDataState= $rowDataState->fetch_assoc()){
                    	    ?>
                    	    <option value="<?php echo $resultDataState['st_id'];?>" <?php if ($resultDataState['st_id'] == $resultDataCity['city_st_id'] ) echo 'selected' ; ?>   ><?php echo $resultDataState['st_name'];?></option>
                    	    <?php 
                        }
                    }
            }		    
		}
	}

}





/*
$test = "
SELECT * FROM tk_specific WHERE note !=''

";


$resultTest = $conn->query($test);
if ($resultTest->num_rows > 0) {

    
    while($rowTest = $resultTest->fetch_assoc()){
        
        $queryState = "SELECT * FROM tk_states WHERE st_id = '".$rowTest['state']."' "; 
        $resultState = $conn->query($queryState); 
        if($resultState->num_rows > 0){ 
            $rowState = $resultState->fetch_assoc();
            $nameState = $rowState['st_name'];  
        }
        $queryCity = "SELECT * FROM tk_cities WHERE city_id = '".$rowTest['city']."' "; 
        $resultCity = $conn->query($queryCity); 
        if($resultCity->num_rows > 0){ 
            $rowCity = $resultCity->fetch_assoc();
            $nameCity = $rowCity['city_name'];  
        }
        $queryLevel = "SELECT * FROM tk_tution_course WHERE tc_id = '".$rowTest['level']."' "; 
        $resultLevel = $conn->query($queryLevel); 
        if($resultLevel->num_rows > 0){ 
            $rowLevel = $resultLevel->fetch_assoc();
            $nameLevel = $rowLevel['tc_title'];  
        }
        

    }
    

}
*/












?>