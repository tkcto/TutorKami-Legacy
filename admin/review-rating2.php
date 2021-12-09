<?PHP
require_once('classes/config.php.inc');
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $dbCon->connect_error);
    exit();
}

if( (isset($_POST['tutorID']) && $_POST['tutorID'] != '') && (isset($_POST['sessionIDLogin']) && $_POST['sessionIDLogin'] != '') ) {
?>
    
    <style>
    .btn-rate { 
      color: #ffffff; 
      background-color: #AD3649; 
      border-color: #AD3649; 
    } 
     
    .btn-rate:hover, 
    .btn-rate:focus, 
    .btn-rate:active, 
    .btn-rate.active, 
    .open .dropdown-toggle.btn-rate { 
      color: #ffffff; 
      background-color: #AD3649; 
      border-color: #AD3649; 
    } 
     
    .btn-rate:active, 
    .btn-rate.active, 
    .open .dropdown-toggle.btn-rate { 
      background-image: none; 
    } 
     
    .btn-rate.disabled, 
    .btn-rate[disabled], 
    fieldset[disabled] .btn-rate, 
    .btn-rate.disabled:hover, 
    .btn-rate[disabled]:hover, 
    fieldset[disabled] .btn-rate:hover, 
    .btn-rate.disabled:focus, 
    .btn-rate[disabled]:focus, 
    fieldset[disabled] .btn-rate:focus, 
    .btn-rate.disabled:active, 
    .btn-rate[disabled]:active, 
    fieldset[disabled] .btn-rate:active, 
    .btn-rate.disabled.active, 
    .btn-rate[disabled].active, 
    fieldset[disabled] .btn-rate.active { 
      background-color: #AD3649; 
      border-color: #AD3649; 
    } 
     
    .btn-rate .badge { 
      color: #AD3649; 
      background-color: #ffffff; 
    }
    
.rating {
  border: none;
  float: left;
}

.rating {
  margin: 0;
  padding: 0;
}

.rating input {
  display: none;
}

.rating label:before {
  margin: 13px;
  font-size: 45px;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating .half:before {
  content: "\f089";
  position: absolute;
}

.rating label {
  color: #ddd;
  float: right;
}

.rating input:checked~label,

/* show gold star when clicked */

.rating:not(:checked) label:hover,

/* hover current star */

.rating:not(:checked) label:hover~label {
  color: #FFD700;
}


/* hover previous stars in list */

.rating input:checked+label:hover,

/* hover current star when changing rating */

.rating input:checked~label:hover,
.rating label:hover~input:checked~label,

/* lighten current selection */

.rating input:checked~label:hover~label {
  color: #FFED85;
}
    </style>
<style>
.jumbotron {
  padding-top: 10px !important;
  padding-bottom: 10px !important;
} 

.btn-delete { 
  color: #ffffff; 
  background-color: #DB1C1C; 
  border-color: #DB1C1C; 
} 
 
.btn-delete:hover, 
.btn-delete:focus, 
.btn-delete:active, 
.btn-delete.active, 
.open .dropdown-toggle.btn-delete { 
  color: #ffffff; 
  background-color: #DB1C1C; 
  border-color: #DB1C1C; 
} 
 
.btn-delete:active, 
.btn-delete.active, 
.open .dropdown-toggle.btn-delete { 
  background-image: none; 
} 
 
.btn-delete.disabled, 
.btn-delete[disabled], 
fieldset[disabled] .btn-delete, 
.btn-delete.disabled:hover, 
.btn-delete[disabled]:hover, 
fieldset[disabled] .btn-delete:hover, 
.btn-delete.disabled:focus, 
.btn-delete[disabled]:focus, 
fieldset[disabled] .btn-delete:focus, 
.btn-delete.disabled:active, 
.btn-delete[disabled]:active, 
fieldset[disabled] .btn-delete:active, 
.btn-delete.disabled.active, 
.btn-delete[disabled].active, 
fieldset[disabled] .btn-delete.active { 
  background-color: #DB1C1C; 
  border-color: #DB1C1C; 
} 
 
.btn-delete .badge { 
  color: #DB1C1C; 
  background-color: #ffffff; 
}


</style>
<style>
.btnOutline {
  border: 2px solid black;
  background-color: white;
  color: black;
  padding: 7px 14px;
  font-size: 12px;
  cursor: pointer;
}

/* Green */
.success {
  border-color: #04AA6D;
  color: green;
}
.success:hover {
  /*background-color: #04AA6D;
  color: white;*/
}

/* Blue */
.info {
  border-color: #2196F3;
  color: dodgerblue;
}
.info:hover {
  /*background: #2196F3;
  color: white;*/
}

/* Orange */
.warning {
  border-color: #ff9800;
  color: orange;
}

.warning:hover {
  /*background: #ff9800;
  color: white;*/
}

/* Red */
.danger {
  border-color: #f44336;
  color: red;
}

.danger:hover {
  /*background: #f44336;
  color: white;*/
}

/* Gray */
.default {
  border-color: black;
  color: black;
}

.default:hover {
  /*background: #e7e7e7;*/
}
</style>
    <?php  
    $allAdmin = array();
    $queryAdmin = " SELECT * FROM tk_user WHERE u_role = '2' "; 
    $resultAdmin = $dbCon->query($queryAdmin); 
    if($resultAdmin->num_rows > 0){ 
        while($rowAdmin = $resultAdmin->fetch_assoc()){ 
            $allAdmin[] = $rowAdmin['u_id'];
        }     
    }    
    
			$numRowRatingTTeam = 0;
            $queryRatingTTeam = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
            $resultRatingTTeam = $dbCon->query($queryRatingTTeam); 
            if($resultRatingTTeam->num_rows > 0){
				$rowRatingTTeam = $resultRatingTTeam->fetch_assoc();
				
				if( $rowRatingTTeam['ri_jobs'] =='true' || $rowRatingTTeam['ri_jobs'] =='true2' ){ $numRowRatingTTeam++; }
				if( $rowRatingTTeam['ri_experience'] =='true' || $rowRatingTTeam['ri_experience'] =='true2' ){ $numRowRatingTTeam++; }
				if( $rowRatingTTeam['ri_signed'] =='true' || $rowRatingTTeam['ri_signed'] =='true2' ){ $numRowRatingTTeam++; }
				if( $rowRatingTTeam['ri_location'] =='true' || $rowRatingTTeam['ri_location'] =='true2' ){ $numRowRatingTTeam++; }
				if( $rowRatingTTeam['ri_session'] =='true' || $rowRatingTTeam['ri_session'] =='true2' ){ $numRowRatingTTeam++; }
				if( $rowRatingTTeam['ri_postponed'] =='true' || $rowRatingTTeam['ri_postponed'] =='true2' ){ $numRowRatingTTeam++; }
				if( $rowRatingTTeam['ri_replied'] =='true' || $rowRatingTTeam['ri_replied'] =='true2' ){ $numRowRatingTTeam++; }
				if( $rowRatingTTeam['ri_cycles'] =='true' || $rowRatingTTeam['ri_cycles'] =='true2' ){ $numRowRatingTTeam++; }
                	for($iTeam = 0; $iTeam < $numRowRatingTTeam; $iTeam++) {
						if ($iTeam == 5) { break; }
                	}
                	$resultTeam = $iTeam;
			}else{
                 $resultTeam = '0';
            }

            $purataRatingPParent = 0;
            $numRowRatingPParent = 0;
            $purataPParent = '';
            $queryRatingPParent = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$_POST['tutorID']."' AND rr_status = 'approved' AND rr_parent_id NOT IN ( '" . implode( "', '" , $allAdmin ) . "' ) "; 
            $resultRatingPParent = $dbCon->query($queryRatingPParent); 
            if($resultRatingPParent->num_rows > 0){
                while($rowRatingPParent = $resultRatingPParent->fetch_assoc()){
                       $purataRatingPParent+=  $rowRatingPParent['rr_rating'];
                       $numRowRatingPParent++;
                } 
                $purataPParent = ($purataRatingPParent / $numRowRatingPParent);
            }else{
                 $purataPParent = '0';
            }
            $purataPParentR = round($purataPParent, 2);
    
    if( $resultTeam != '0' && $purataPParentR != '0' ){
        $thisCombined = (($resultTeam + $purataPParentR) / 2);
    }else{
        if( $resultTeam != '0' ){
            $thisCombined = $resultTeam;
        }else{
            $thisCombined = $purataPParentR;
        }
    }
    //echo $resultTeam;
    echo '<p><label><b>Combined Average Rating</b></label></p>';
        if (strpos($thisCombined, ".") !== false) {
            $beforeDecimal = explode('.',$thisCombined);
        	for($i = 0; $i < $beforeDecimal[0]; $i++) { ?>
        	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
        	<?php } ?>
        	<span class="rating-input"><span data-value="0" class="fa fa-star-half" style="color:orange;font-size: 20px;"></span></span><?php
        }else{
        	for($i = 0; $i < $thisCombined; $i++) { ?>
        	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
        	<?php }
        } 
    
    /*
    $purataRating = 0;
    $numRowRating = 0;
    $purata = '';
    $queryRating = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$_POST['tutorID']."' AND rr_status = 'approved' "; 
    $resultRating = $dbCon->query($queryRating); 
    if($resultRating->num_rows > 0){ 
        echo '<p><label><b>Combined Average Rating</b></label></p>';
        while($rowRating = $resultRating->fetch_assoc()){  
               $purataRating+=  $rowRating['rr_rating'];
               $numRowRating++;
        } 
        $purata = ($purataRating / $numRowRating);
        if (strpos($purata, ".") !== false) {
            $beforeDecimal = explode('.',$purata);
        	for($i = 0; $i < $beforeDecimal[0]; $i++) { ?>
        	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
        	<?php } ?>
        	<span class="rating-input"><span data-value="0" class="fa fa-star-half" style="color:orange;font-size: 20px;"></span></span><?php
        }else{
        	for($i = 0; $i < $purata; $i++) { ?>
        	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
        	<?php }
        }    
    
    }*/
    //$dbCon->close();    
    

    ?>
 
    
    
    <br/><br/>
	
    <div class="row">
        <div class="col-xs-12">
          <b>FROM TK TEAM</b>   <button id="buttonModal" type="button" class="hidden btn btn-rate btn-xs" style="margin-left:40px;" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModalRating"></button> 
          <a href="https://docs.google.com/document/d/10ASjY8xShUAaKJjQ51bD7kRGy3YkeBL542eDfj-lfTU/edit" target="_blank"><span class="glyphicon glyphicon-info-sign" style="color:#262262"></span></a>
        </div>
        <div class="col-xs-12">
            <?php 
			$numRowRatingT = 0;
            $queryRatingT = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$_POST['tutorID']."' "; 
            $resultRatingT = $dbCon->query($queryRatingT); 
            if($resultRatingT->num_rows > 0){
				$rowRatingT = $resultRatingT->fetch_assoc();
				
				if( $rowRatingT['ri_jobs'] =='true' || $rowRatingT['ri_jobs'] =='true2' ){ $numRowRatingT++; }
				if( $rowRatingT['ri_experience'] =='true' || $rowRatingT['ri_experience'] =='true2' ){ $numRowRatingT++; }
				if( $rowRatingT['ri_signed'] =='true' || $rowRatingT['ri_signed'] =='true2' ){ $numRowRatingT++; }
				if( $rowRatingT['ri_location'] =='true' || $rowRatingT['ri_location'] =='true2' ){ $numRowRatingT++; }
				if( $rowRatingT['ri_session'] =='true' || $rowRatingT['ri_session'] =='true2' ){ $numRowRatingT++; }
				if( $rowRatingT['ri_postponed'] =='true' || $rowRatingT['ri_postponed'] =='true2' ){ $numRowRatingT++; }
				if( $rowRatingT['ri_replied'] =='true' || $rowRatingT['ri_replied'] =='true2' ){ $numRowRatingT++; }
				if( $rowRatingT['ri_cycles'] =='true' || $rowRatingT['ri_cycles'] =='true2' ){ $numRowRatingT++; }
				/*echo $numRowRatingT.' Review(s)';*/
				echo '<br/>';
                	for($i = 0; $i < $numRowRatingT; $i++) { 
						if ($i == 5) { break; }
					?>
                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                	<?php }
			}else{
                 echo '';
            }
			
			/*
            $purataRatingT = 0;
            $numRowRatingT = 0;
            $purataT = '';
            $queryRatingT = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$_POST['tutorID']."' AND rr_status = 'approved' AND rr_parent_id IN ( '" . implode( "', '" , $allAdmin ) . "' ) "; 
            $resultRatingT = $dbCon->query($queryRatingT); 
            if($resultRatingT->num_rows > 0){ 
                while($rowRatingT = $resultRatingT->fetch_assoc()){  
                       $purataRatingT+=  $rowRatingT['rr_rating'];
                       $numRowRatingT++;
                } 
                $purataT = ($purataRatingT / $numRowRatingT);
                echo $numRowRatingT.' Review(s)';
                if (strpos($purataT, ".") !== false) {
                    $beforeDecimalT = explode('.',$purataT);
                	for($i = 0; $i < $beforeDecimalT[0]; $i++) { ?>
                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                	<?php } ?>
                	<span class="rating-input"><span data-value="0" class="fa fa-star-half" style="color:orange;font-size: 20px;"></span></span><?php
                }else{
                	for($i = 0; $i < $purataT; $i++) { ?>
                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                	<?php }
                }    
            
            }else{
                 echo '0 Review(s)';
            }*/
            ?>
        </div>
        
        <div class="col-xs-8">
		<?PHP
		$Cno1 = $Cno2 = $Cno3 = $Cno4 = $Cno5 = $Cno6 = $Cno7 = $Cno8 = '';
		$queryCheckbox = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor = '".$_POST['tutorID']."' "; 
		$resultCheckbox = $dbCon->query($queryCheckbox); 
		if($resultCheckbox->num_rows > 0){ 
			$rowCheckbox = $resultCheckbox->fetch_assoc();
			$comment = $rowCheckbox['ri_comments'];
			if( $rowCheckbox['ri_jobs'] =='true' || $rowCheckbox['ri_jobs'] =='true2' ){ $no1 = 'checked'; if( $rowCheckbox['ri_jobs'] =='true2' ){$Cno1 = 'checked';} }else{ $no1 = ''; }
			if( $rowCheckbox['ri_experience'] =='true' || $rowCheckbox['ri_experience'] =='true2' ){ $no2 = 'checked'; if( $rowCheckbox['ri_experience'] =='true2' ){$Cno2 = 'checked';}  }else{ $no2 = ''; }
			if( $rowCheckbox['ri_signed'] =='true' || $rowCheckbox['ri_signed'] =='true2' ){ $no3 = 'checked'; if( $rowCheckbox['ri_signed'] =='true2' ){$Cno3 = 'checked';}  }else{ $no3 = ''; }
			if( $rowCheckbox['ri_location'] =='true' || $rowCheckbox['ri_location'] =='true2' ){ $no4 = 'checked'; if( $rowCheckbox['ri_location'] =='true2' ){$Cno4 = 'checked';}  }else{ $no4 = ''; }
			if( $rowCheckbox['ri_session'] =='true' || $rowCheckbox['ri_session'] =='true2' ){ $no5 = 'checked'; if( $rowCheckbox['ri_session'] =='true2' ){$Cno5 = 'checked';}  }else{ $no5 = ''; }
			if( $rowCheckbox['ri_postponed'] =='true' || $rowCheckbox['ri_postponed'] =='true2' ){ $no6 = 'checked'; if( $rowCheckbox['ri_postponed'] =='true2' ){$Cno6 = 'checked';}  }else{ $no6 = ''; }
			if( $rowCheckbox['ri_replied'] =='true' || $rowCheckbox['ri_replied'] =='true2' ){ $no7 = 'checked'; if( $rowCheckbox['ri_replied'] =='true2' ){$Cno7 = 'checked';}  }else{ $no7 = ''; }
			if( $rowCheckbox['ri_cycles'] =='true' || $rowCheckbox['ri_cycles'] =='true2' ){ $no8 = 'checked'; if( $rowCheckbox['ri_cycles'] =='true2' ){$Cno8 = 'checked';}  }else{ $no8 = ''; }
		}else{
			$comment = '';
			$no1 = '';
			$no2 = '';
			$no3 = '';
			$no4 = '';
			$no5 = '';
			$no6 = '';
			$no7 = '';
			$no8 = '';
		}
		?>
		<!-- style="color:green" -->
			<div class="pull-left">
				<div class="checkbox">
					<label style="font-size: 1em"><input <?PHP echo $no1; ?> type="checkbox" onchange="handleRating(this.id);" id="1" name="internalRating" value="1"><span class="cr"><i class="cr-icon fa fa-check" <?PHP if($Cno1 != ''){}else{ echo 'style="color:#f1592a"'; }; ?> ></i></span>1. Have 5 jobs or more</label><br>
					<label style="font-size: 1em"><input <?PHP echo $no2; ?> type="checkbox" onchange="handleRating(this.id);" id="2" name="internalRating" value="2"><span class="cr"><i class="cr-icon fa fa-check" <?PHP if($Cno2 != ''){}else{ echo 'style="color:#f1592a"'; }; ?> ></i></span>2. Experience 3 years & above</label><br>
					<label style="font-size: 1em"><input <?PHP echo $no3; ?> type="checkbox" onchange="handleRating(this.id);" id="3" name="internalRating" value="3"><span class="cr"><i class="cr-icon fa fa-check" <?PHP if($Cno3 != ''){}else{ echo 'style="color:#f1592a"'; }; ?> ></i></span>3. Have signed the latest online terms</label><br>
					<label style="font-size: 1em"><input <?PHP echo $no4; ?> type="checkbox" onchange="handleRating(this.id);" id="4" name="internalRating" value="4"><span class="cr"><i class="cr-icon fa fa-check" <?PHP if($Cno4 != ''){}else{ echo 'style="color:#f1592a"'; }; ?> ></i></span>4. Only applied jobs that really okay with the location & schedule</label><br>
					<label style="font-size: 1em"><input <?PHP echo $no5; ?> type="checkbox" onchange="handleRating(this.id);" id="5" name="internalRating" value="5"><span class="cr"><i class="cr-icon fa fa-check" <?PHP if($Cno5 != ''){}else{ echo 'style="color:#f1592a"'; }; ?> ></i></span>5. Parent okay after 1st session & make payment</label><br>
					<label style="font-size: 1em"><input <?PHP echo $no6; ?> type="checkbox" onchange="handleRating(this.id);" id="6" name="internalRating" value="6"><span class="cr"><i class="cr-icon fa fa-check" <?PHP if($Cno6 != ''){}else{ echo 'style="color:#f1592a"'; }; ?> ></i></span>6. Seldom canceled or postponed class</label><br>
					<label style="font-size: 1em"><input <?PHP echo $no7; ?> type="checkbox" onchange="handleRating(this.id);" id="7" name="internalRating" value="7"><span class="cr"><i class="cr-icon fa fa-check" <?PHP if($Cno7 != ''){}else{ echo 'style="color:#f1592a"'; }; ?> ></i></span>7. Has job & always replied our messages quickly/within 12 hours</label><br>
					<label style="font-size: 1em"><input <?PHP echo $no8; ?> type="checkbox" onchange="handleRating(this.id);" id="8" name="internalRating" value="8"><span class="cr"><i class="cr-icon fa fa-check" <?PHP if($Cno8 != ''){}else{ echo 'style="color:#f1592a"'; }; ?> ></i></span>8. Has a job which is more than 6 cycles</label><br>
				</div>	
			</div>	
			<div class="pull-right">
				<textarea style="overflow-y:scroll;" rows="8" cols="50" class="form-control" name=""><?PHP echo $comment; ?></textarea>
			</div>	



			
            <div class="pre-scrollable">
<!--
                <?PHP
/*
                $queryListTK = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$_POST['tutorID']."' AND rr_status = 'approved' AND rr_parent_id IN ( '" . implode( "', '" , $allAdmin ) . "' ) ORDER BY rr_create_date DESC  "; 
                $resultListTK = $dbCon->query($queryListTK); 
                if($resultListTK->num_rows > 0){ 
                    
                    while($rowListTK = $resultListTK->fetch_assoc()){  
                    
                    $queryUser2 = "SELECT * FROM tk_user_details WHERE ud_u_id='".$rowListTK['rr_parent_id']."' "; 
                    $resultUser2 = $dbCon->query($queryUser2); 
                    if($resultUser2->num_rows > 0){ 
                        $rowUser2 = $resultUser2->fetch_assoc(); 
                        $clientName2 = $rowUser2['ud_first_name']; 
                        
                        $queryCity2 = "SELECT * FROM tk_cities WHERE city_id='".$rowUser2['ud_city']."' "; 
                        $resultCity2 = $dbCon->query($queryCity2); 
                        if($resultCity2->num_rows > 0){ 
                            $rowCity2 = $resultCity2->fetch_assoc();
                            $cityName2 = $rowCity2['city_name'];   
                        }else{
                            $cityName2 = '';
                        }
                    }
                    ?>
                        <button type="button" class="btn btn-delete btn-xs" onclick="deleteRate('<?PHP  echo $rowListTK['rr_id']; ?>');">Delete <?PHP  echo ucwords($rowListTK['rr_name']); ?> </button> 
                        <div class="jumbotron">
                          <p class="lead" style="font-size:15px;">
                              <div class="pull-left">  <font class="lead" style="font-size:15px;"><strong><em><?PHP echo ucwords($rowListTK['rr_name']); ?></em></strong></font>       </div>
                              <div class="pull-right"> 
                                <?PHP
                                if (strpos($rowListTK['rr_rating'], ".") !== false) {
                                    $beforeDecimalT2 = explode('.',$rowListTK['rr_rating']);
                                	for($i = 0; $i < $beforeDecimalT2[0]; $i++) { ?>
                                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                                	<?php } ?>
                                	<span class="rating-input"><span data-value="0" class="fa fa-star-half" style="color:orange;font-size: 20px;"></span></span><?php
                                }else{
                                	for($i = 0; $i < $rowListTK['rr_rating']; $i++) { ?>
                                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                                	<?php }
                                }
                                ?>
                              </div>
                          </p><br/><br/>
                          
                          <p class="lead" style="font-size:15px;"><strong><em><?php $dt = strtotime($rowListTK['rr_create_date']); echo date("j M Y", strtotime(date("Y-m-d", $dt)));?></em></strong></p>
                          <br/>
                          <p class="lead" style="font-size:15px;"><strong><em><?PHP echo $rowListTK['rr_review']; ?></em></strong></p>
                        </div>                
                    <?PHP
                    } 
                }*/
                ?>
-->
            </div>    
        </div>        
    </div>
	
	
	
	
    
    <br/><br/><br/><br/><br/>
    <div class="row">
        <div class="col-xs-12">
          <b>FROM PARENTS</b> 
        </div>
        <div class="col-xs-12">
            <?php 
            $purataRatingP = 0;
            $numRowRatingP = 0;
            $purataP = '';
            $queryRatingP = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$_POST['tutorID']."' AND rr_status = 'approved' AND rr_parent_id NOT IN ( '" . implode( "', '" , $allAdmin ) . "' ) "; 
            $resultRatingP = $dbCon->query($queryRatingP); 
            if($resultRatingP->num_rows > 0){ 
                while($rowRatingP = $resultRatingP->fetch_assoc()){  
                       $purataRatingP+=  $rowRatingP['rr_rating'];
                       $numRowRatingP++;
                } 
                $purataP = ($purataRatingP / $numRowRatingP);
                echo $numRowRatingP.' Review(s)';
                if (strpos($purataP, ".") !== false) {
                    $beforeDecimalP = explode('.',$purataP);
                	for($i = 0; $i < $beforeDecimalP[0]; $i++) { ?>
                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                	<?php } ?>
                	<span class="rating-input"><span data-value="0" class="fa fa-star-half" style="color:orange;font-size: 20px;"></span></span><?php
                }else{
                	for($i = 0; $i < $purataP; $i++) { ?>
                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                	<?php }
                }    
            
            }else{
                 echo '0 Review(s)';
            }
            ?>
        </div>
        
        <div class="col-xs-8">
            <div class="pre-scrollable">
                <?PHP
                $queryListTK = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$_POST['tutorID']."' AND rr_status = 'approved' AND rr_parent_id NOT IN ( '" . implode( "', '" , $allAdmin ) . "' ) ORDER BY rr_create_date DESC "; 
                $resultListTK = $dbCon->query($queryListTK); 
                if($resultListTK->num_rows > 0){ 
                    
                    while($rowListTK = $resultListTK->fetch_assoc()){  
                    
                    $queryUser2 = "SELECT * FROM tk_user_details WHERE ud_u_id='".$rowListTK['rr_parent_id']."' "; 
                    $resultUser2 = $dbCon->query($queryUser2); 
                    if($resultUser2->num_rows > 0){ 
                        $rowUser2 = $resultUser2->fetch_assoc(); 
                        $clientName2 = $rowUser2['ud_first_name']; 
                        
                        $queryCity2 = "SELECT * FROM tk_cities WHERE city_id='".$rowUser2['ud_city']."' "; 
                        $resultCity2 = $dbCon->query($queryCity2); 
                        if($resultCity2->num_rows > 0){ 
                            $rowCity2 = $resultCity2->fetch_assoc();
                            $cityName2 = $rowCity2['city_name'];   
                        }else{
                            $cityName2 = '';
                        }
                    }
                    ?>
                        <div class="jumbotron">
                          
                          <p class="lead" style="font-size:15px;">
                              <div class="pull-left">  <font class="lead" style="font-size:15px;"><strong><em><?PHP echo ucwords($clientName2.', '.$cityName2); ?></em></strong></font>       </div>
                              <div class="pull-right"> 
                                <?PHP
                                if (strpos($rowListTK['rr_rating'], ".") !== false) {
                                    $beforeDecimalT3 = explode('.',$rowListTK['rr_rating']);
                                	for($i = 0; $i < $beforeDecimalT3[0]; $i++) { ?>
                                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                                	<?php } ?>
                                	<span class="rating-input"><span data-value="0" class="fa fa-star-half" style="color:orange;font-size: 20px;"></span></span><?php
                                }else{
                                	for($i = 0; $i < $rowListTK['rr_rating']; $i++) { ?>
                                	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                                	<?php }
                                }
                                ?>
                              </div>
                          </p><br/><br/>
                          
                          
                          
                          
                          
                          
                          
                          <p class="lead" style="font-size:15px;"><strong><em><?php $dt = strtotime($rowListTK['rr_create_date']); echo date("j M Y", strtotime(date("Y-m-d", $dt)));?></em></strong>
                          <span onclick="goReviewPage(<?php echo $rowListTK['rr_id']; ?>)" class="btnOutline default pull-right">See All</span>
                          </p>
                          <br/>
                          <p class="lead" style="font-size:15px;"><strong><em><?PHP echo $rowListTK['rr_review']; ?></em></strong></p>
                        </div>                
                    <?PHP
                    }
                }
                ?>
        
            </div>    
        </div>
        
    </div>



  



    
<?PHP
}else{
    echo 'Error ! : Undefined UserID ';
}
?>

<!-- Modal -->
<div class="modal fade" id="myModalRating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form>
        <input type="hidden" id="tutorID" name="tutorID" value="<?PHP echo $_POST['tutorID']; ?>" />
        <input type="hidden" id="sessionIDLogin" name="sessionIDLogin" value="<?PHP echo $_POST['sessionIDLogin']; ?>" />
        <input type="hidden" name="bookId" id="bookId" />
		
        <input type="hidden" name="bookId2" id="bookId2" />
        <input type="hidden" name="bookId3" id="bookId3" />
		
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comments :</label>
            <textarea rows="5" class="form-control" id="ratingComments" name="ratingComments"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button onclick="submitRating()" type="button" class="btn btn-rate">Submit</button>
        <!--<div class="alert alert-danger" role="alert"><center>Under Maintenance</center></div>-->
      </div>
    </div>
  </div>
</div>


<script>
function deleteRate(id) {
    
    var tutorID = document.getElementById('tutorID').value;
    var sessionIDLogin = document.getElementById('sessionIDLogin').value;

	var x = confirm("Are you sure you want to delete?");
	if (x == true){
                         $.ajax({
                            url: "review-rating-delete.php",
                            method: "POST",
                            data: {id: id}, 
                            success: function(result){
                                if(result =='success delete'){
                                         $.ajax({
                                            url: "review-rating.php",
                                            method: "POST",
                                            data: {tutorID: tutorID, sessionIDLogin: sessionIDLogin}, 
                                            success: function(result){
                                                  $('#loadRating').html(result);
                                            }
                                         });
                                }else{
                                    alert(result);
                                }
                            }
                         });
        	
        	
	}
    
    
}


function submitRating() {
    
    var tutorID = document.getElementById('tutorID').value;
    var sessionIDLogin = document.getElementById('sessionIDLogin').value;
    
    //var ratingStar = $('input[name="ratingStar"]:checked').val();
    var ratingName = document.getElementById('bookId').value;
    var ratingName2 = document.getElementById('bookId2').value;
    var ratingComments = document.getElementById('ratingComments').value;
  
  
    if ( tutorID == '' ) {
        alert('Error : Empty Tutor ID');
    }else if ( sessionIDLogin == '' ) {
        alert('Error : Empty Session ID Login');
    }else if( ratingName == '' ){
        alert('Error : Empty Session Checkbox ID');
    }else if( ratingName2 == '' ){
        alert('Error : Empty Session Checkbox Value');
    }/*else if( ratingComments == '' ){
        alert('Please Insert Comment');
    }*/else{

        $('#myModalRating').modal('hide');
        document.getElementById('loadRating').innerHTML = "";
    
        $.ajax({
            url: "review-rating-submit.php",
            method: "POST",
            data: {tutorID: tutorID, sessionIDLogin: sessionIDLogin, ratingName: ratingName, ratingName2: ratingName2, ratingComments: ratingComments}, 
            success: function(result){
 				
                if(result =='success'){

                         $.ajax({
                            url: "review-rating2.php",
                            method: "POST",
                            data: {tutorID: tutorID, sessionIDLogin: sessionIDLogin}, 
                            success: function(result){
                                  $('#loadRating').html(result);
                            }
                         });
                    
                }else if(result =='x success'){
                    alert('Error : 1');
                }else{
                    alert('Error : 2');
                }

            }	
        }); 
	
    }

}




function handleRating(id) {
	var favorite = [];
	$.each($("input[name='internalRating']:checked"), function(){            
		favorite.push($(this).val());
	});

	var checkedValue = $("#"+id).is(":checked");
	$(".modal-body #bookId").val( id );
	$(".modal-body #bookId2").val( checkedValue );
	
	document.getElementById("bookId3").value = favorite.join(", ");
	document.getElementById('buttonModal').click();
}
</script>




