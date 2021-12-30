<?php
require './admin/classes/config.php.inc';

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['action'])) {
    
    
    
	if ($_POST['action'] == 'CityID') {
		$CityID = $_POST['CityID'];
		
            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_id = '".$CityID."' ";
            $rowDataCity = $conn->query($queryDataCity);
            if ($rowDataCity->num_rows > 0) {
                $resultDataCity = $rowDataCity->fetch_assoc();
                    //$resultDataCity['city_st_id']
                    
                    $queryDataState2 = " SELECT * FROM tk_states WHERE st_id = '".$resultDataCity['city_st_id']."'  ";
                    $rowDataState2 = $conn->query($queryDataState2);
                    if ($rowDataState2->num_rows > 0) {
                        $resultDataState2= $rowDataState2->fetch_assoc();
                        ?>
                            <span><?php echo $resultDataState2['st_name'];?></span>
                        <?PHP
                    }
                    

                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        ?>
                        <select class="hidden" name="search_ud_state" id="search_ud_state" style="width: 100%"  data-rule-required="true" data-msg-required="- required.">
                        <?php 
                        while($resultDataState= $rowDataState->fetch_assoc()){
                    	    ?>
                    	    <option value="<?php echo $resultDataState['st_id'];?>" <?php if ($resultDataState['st_id'] == $resultDataCity['city_st_id'] ) echo 'selected' ; ?>   ><?php echo $resultDataState['st_name'];?></option>
                    	    <?php 
                        }
                        ?></select><?php 
                    }
            }

	}    
  
	if ($_POST['action'] == 'locationID') {
		$locationID = $_POST['locationID'];
		
            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_id = '".$locationID."' ";
            $rowDataCity = $conn->query($queryDataCity);
            if ($rowDataCity->num_rows > 0) {
                $resultDataCity = $rowDataCity->fetch_assoc();
                    //$resultDataCity['city_st_id']
                    
                    $queryDataState2 = " SELECT * FROM tk_states WHERE st_id = '".$resultDataCity['city_st_id']."'  ";
                    $rowDataState2 = $conn->query($queryDataState2);
                    if ($rowDataState2->num_rows > 0) {
                        $resultDataState2= $rowDataState2->fetch_assoc();
                        ?>
                            <span><?php echo $resultDataState2['st_name'];?></span>
                        <?PHP
                    }
                    

                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        ?>
                        <select class="hidden" name="locationWorkplaceState" id="locationWorkplaceState" style="width: 100%"  >
                        <?php 
                        while($resultDataState= $rowDataState->fetch_assoc()){
                    	    ?>
                    	    <option value="<?php echo $resultDataState['st_id'];?>" <?php if ($resultDataState['st_id'] == $resultDataCity['city_st_id'] ) echo 'selected' ; ?>   ><?php echo $resultDataState['st_name'];?></option>
                    	    <?php 
                        }
                        ?></select><?php 
                    }
            }

	} 
  
	if ($_POST['action'] == 'ud_workplace_state') {
		$ud_workplace_state = $_POST['ud_workplace_state'];
		
            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_id = '".$ud_workplace_state."' ";
            $rowDataCity = $conn->query($queryDataCity);
            if ($rowDataCity->num_rows > 0) {
                $resultDataCity = $rowDataCity->fetch_assoc();
                    //$resultDataCity['city_st_id']
                    
                    $queryDataState2 = " SELECT * FROM tk_states WHERE st_id = '".$resultDataCity['city_st_id']."'  ";
                    $rowDataState2 = $conn->query($queryDataState2);
                    if ($rowDataState2->num_rows > 0) {
                        $resultDataState2= $rowDataState2->fetch_assoc();
                        ?>
                            <span><?php echo $resultDataState2['st_name'];?></span>
                        <?PHP
                    }
                    

                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        ?>
                        <select class="hidden" name="ud_workplace_state" id="ud_workplace_state" style="width: 100%"  >
                        <?php 
                        while($resultDataState= $rowDataState->fetch_assoc()){
                    	    ?>
                    	    <option value="<?php echo $resultDataState['st_id'];?>" <?php if ($resultDataState['st_id'] == $resultDataCity['city_st_id'] ) echo 'selected' ; ?>   ><?php echo $resultDataState['st_name'];?></option>
                    	    <?php 
                        }
                        ?></select><?php 
                    }
            }

	}
	

	if ($_POST['action'] == 'state_drop') {
		$state_drop = $_POST['state_drop'];
		
            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_id = '".$state_drop."' ";
            $rowDataCity = $conn->query($queryDataCity);
            if ($rowDataCity->num_rows > 0) {
                $resultDataCity = $rowDataCity->fetch_assoc();
                    //$resultDataCity['city_st_id']
                    
                    $queryDataState2 = " SELECT * FROM tk_states WHERE st_id = '".$resultDataCity['city_st_id']."'  ";
                    $rowDataState2 = $conn->query($queryDataState2);
                    if ($rowDataState2->num_rows > 0) {
                        $resultDataState2= $rowDataState2->fetch_assoc();
                        ?>
                            <span><?php echo $resultDataState2['st_name'];?></span>
                        <?PHP
                    }
                    

                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        ?>
                        <select class="hidden" name="parent_state" id="parent_state" style="width: 100%"  >
                        <?php 
                        while($resultDataState= $rowDataState->fetch_assoc()){
                    	    ?>
                    	    <option value="<?php echo $resultDataState['st_id'];?>" <?php if ($resultDataState['st_id'] == $resultDataCity['city_st_id'] ) echo 'selected' ; ?>   ><?php echo $resultDataState['st_name'];?></option>
                    	    <?php 
                        }
                        ?></select><?php 
                    }
            }

	}	
	

/*

	if ($_POST['action'] == 'locations_covered2') {
		$locations_covered2 = $_POST['locations_covered2'];
		$valarray = explode(',',$locations_covered2);
		
            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_id IN(".implode(',',$locations_covered2).") ";
            $rowDataCity = $conn->query($queryDataCity);
            if ($rowDataCity->num_rows > 0) {
                $resultDataCity = $rowDataCity->fetch_assoc();


                    $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
                    $rowDataState = $conn->query($queryDataState);
                    if ($rowDataState->num_rows > 0) {
                        ?>
                        <select class="" name="locations_covered2State" id="locations_covered2State" style="width: 100%" multiple >
                        <?php 
                        while($resultDataState= $rowDataState->fetch_assoc()){
                    	    ?>
                    	    <option value="<?php echo $resultDataState['st_id'];?>" <?php if(in_array(55,$valarray)){ ?>selected="selected"<?php } ?>      ><?php echo $resultDataState['st_name'];?></option>
                    	    <?php 
                        }
                        ?></select><?php 
                    }
            }

	}	

*/










	if ($_POST['action'] == 'locations_covered') {
		$locations_covered = $_POST['locations_covered'];
		


		
		
            $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_id IN(".implode(',',$locations_covered).") ";
            $rowDataCity = $conn->query($queryDataCity);
            if ($rowDataCity->num_rows > 0) {
                $dataPoints1 = $dataPoints2 =  $dataPoints3 =  $dataPoints4 =  $dataPoints5 =  $dataPoints6 =  $dataPoints7 =  $dataPoints8 =  $dataPoints9 =  $dataPoints10 =  $dataPoints11 =  $dataPoints12 =  $dataPoints13 =  $dataPoints14 =  $dataPoints15 =  $dataPoints16 = '';
                while($resultDataCity = $rowDataCity->fetch_assoc()){
                    //$resultDataCity['city_st_id']
                    
                    $queryDataState2 = " SELECT * FROM tk_states WHERE st_id = '".$resultDataCity['city_st_id']."'  ";
                    $rowDataState2 = $conn->query($queryDataState2);
                    if ($rowDataState2->num_rows > 0) {
                        $resultDataState2= $rowDataState2->fetch_assoc();
                            //$dataPoints[] = array("value"=>$resultDataCity['city_id'],"state_name"=>$resultDataState2 ['st_name'],"city_name"=>$resultDataCity ['city_name']);
                                                 if($resultDataState2['st_name'] == 'Johor'){
                                                     $dataPoints1 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Kedah'){
                                                     $dataPoints2 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Kelantan'){
                                                     $dataPoints3 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Negeri Sembilan'){
                                                     $dataPoints4 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Pahang'){
                                                     $dataPoints5 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Perak'){
                                                     $dataPoints6 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Sabah'){
                                                     $dataPoints7 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Sarawak'){
                                                     $dataPoints8 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Selangor'){
                                                     $dataPoints9 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Terengganu'){
                                                     $dataPoints10 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'WP Labuan'){
                                                     $dataPoints11 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Perlis'){
                                                     $dataPoints12 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Kuala Lumpur'){
                                                     $dataPoints13 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Malacca'){
                                                     $dataPoints14 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else if($resultDataState2['st_name'] == 'Penang'){
                                                     $dataPoints15 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }
                                                 else{
                                                     $dataPoints16 .= '<label class="label label-primary"><span onclick="myRemoveSelect('.$resultDataCity['city_id'].')" style="color:#FFF; text-decoration: none; cursor:pointer;"> <span aria-hidden="true">&times;</span> '.$resultDataCity['city_name'].'</span></label> ';
                                                 }


                    }
                    
                }
                        ?>
                            <span>
                                    <?php 
                                          if( $dataPoints1 != ''){
                                              echo '<label class="label label-info text-left" >Johor : </label> &nbsp;'.$dataPoints1.'<br><br>';
                                          }
                                          if( $dataPoints2 != ''){
                                              echo '<label class="label label-info text-left" >Kedah : </label> &nbsp;'.$dataPoints2.'<br><br>';
                                          }
                                          if( $dataPoints3 != ''){
                                              echo '<label class="label label-info text-left" >Kelantan : </label> &nbsp;'.$dataPoints3.'<br><br>';
                                          }
                                          if( $dataPoints4 != ''){
                                              echo '<label class="label label-info text-left" >Negeri Sembilan : </label> &nbsp;'.$dataPoints4.'<br><br>';
                                          }
                                          if( $dataPoints5 != ''){
                                              echo '<label class="label label-info text-left" >Pahang : </label> &nbsp;'.$dataPoints5.'<br><br>';
                                          }
                                          if( $dataPoints6 != ''){
                                              echo '<label class="label label-info text-left" >Perak : </label> &nbsp;'.$dataPoints6.'<br><br>';
                                          }
                                          if( $dataPoints7 != ''){
                                              echo '<label class="label label-info text-left" >Sabah : </label> &nbsp;'.$dataPoints7.'<br><br>';
                                          }
                                          if( $dataPoints8 != ''){
                                              echo '<label class="label label-info text-left" >Sarawak : </label> &nbsp;'.$dataPoints8.'<br><br>';
                                          }
                                          
                                          if( $dataPoints9 != ''){
                                              echo '<label class="label label-info text-left" >Selangor : </label> &nbsp;'.$dataPoints9.'<br><br>';
                                          }
                                          if( $dataPoints10 != ''){
                                              echo '<label class="label label-info text-left" >Terengganu : </label> &nbsp;'.$dataPoints10.'<br><br>';
                                          }
                                          if( $dataPoints11 != ''){
                                              echo '<label class="label label-info text-left" >WP Labuan : </label> &nbsp;'.$dataPoints11.'<br><br>';
                                          }
                                          if( $dataPoints12 != ''){
                                              echo '<label class="label label-info text-left" >Perlis : </label> &nbsp;'.$dataPoints12.'<br><br>';
                                          }
                                          if( $dataPoints13 != ''){
                                              echo '<label class="label label-info text-left" >Kuala Lumpur : </label> &nbsp;'.$dataPoints13.'<br><br>';
                                          }
                                          if( $dataPoints14 != ''){
                                              echo '<label class="label label-info text-left" >Malacca : </label> &nbsp;'.$dataPoints14.'<br><br>';
                                          }
                                          if( $dataPoints15 != ''){
                                              echo '<label class="label label-info text-left" >Penang : </label> &nbsp;'.$dataPoints15.'<br><br>';
                                          }

                                          if( $dataPoints16 != ''){
                                              echo '<label class="label label-info text-left" >Putrajaya : </label> &nbsp;'.$dataPoints16.'<br>';
                                          }
/*$columns = array_column($dataPoints, 'state_name');
array_multisort($columns, SORT_ASC, $dataPoints);

$result = [];
array_walk_recursive($dataPoints, function($v) use (&$result) {
    $result[] = $v;
});
echo implode(' & ', $result);


foreach ($result as $k => $gvalue) {
    echo $k." ".$gvalue["value"]." ".$gvalue["state_name"]." ".$gvalue["city_name"]."<br />";
    if($gvalue["state_name"] =='Johor'){
        echo '<label class="label label-info" >'.$gvalue['state_name'].' : </label>&nbsp; <label class="label label-primary">'.$gvalue['city_name'].'</label>';
    }
    if($gvalue["state_name"] =='Kedah'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Kelantan'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Negeri Sembilan'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Pahang'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Perak'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Sabah'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Sarawak'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Selangor'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Terengganu'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='WP Labuan'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Perlis'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Kuala Lumpur'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Malacca'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Penang'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
    if($gvalue["state_name"] =='Putrajaya'){
        echo '<label class="label label-info" >"'.$gvalue['state_name'].'" : </label>&nbsp; <label class="label label-primary">"'.$gvalue['city_name'].'"</label>';
    }
}*/
                                    ?>
                            </span>
                        <?PHP                
                
                
            }

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>