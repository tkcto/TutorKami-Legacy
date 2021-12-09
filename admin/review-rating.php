<?PHP
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$dbCon = new mysqli($servername, $username, $password, $dbname);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}
*/
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
    <?php 
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
        /*$purata = '4.5';
        echo $purata;*/
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
    
    }
    //$dbCon->close();    
    
    $allAdmin = array();
    $queryAdmin = " SELECT * FROM tk_user WHERE u_role = '2' "; 
    $resultAdmin = $dbCon->query($queryAdmin); 
    if($resultAdmin->num_rows > 0){ 
        while($rowAdmin = $resultAdmin->fetch_assoc()){ 
            $allAdmin[] = $rowAdmin['u_id'];
        }     
    }
    ?>
 
    
    
    <br/><br/>
    <div class="row">
        <div class="col-xs-12">
          <b>FROM TK TEAM</b>   <button type="button" class="btn btn-rate btn-xs" style="margin-left:40px;" data-toggle="modal" data-target="#myModalRating">Rate This Tutor</button> 
        </div>
        <div class="col-xs-12">
            <?php 
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
            }
            ?>
        </div>
        
        <div class="col-xs-8">
            <div class="pre-scrollable">
                <?PHP
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
                          <p class="lead" style="font-size:15px;"><!--<strong><em><?PHP  //echo ucwords($rowListTK['rr_name']); ?></em></strong>-->
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
                }
                ?>
        
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
                          <!--<p class="lead" style="font-size:15px;"><strong><em><?PHP  //echo ucwords($clientName2.', '.$cityName2); ?></em></strong></p>-->
                          
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
                          
                          
                          
                          
                          
                          
                          
                          <p class="lead" style="font-size:15px;"><strong><em><?php $dt = strtotime($rowListTK['rr_create_date']); echo date("j M Y", strtotime(date("Y-m-d", $dt)));?></em></strong></p>
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
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Rating</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <?PHP
        $queryUser = " SELECT * FROM tk_user_details WHERE ud_u_id='".$_POST['sessionIDLogin']."' "; 
        $resultUser = $dbCon->query($queryUser); 
        if($resultUser->num_rows > 0){ 
            $rowUser = $resultUser->fetch_assoc();
            $userAdminName = ucwords($rowUser['ud_first_name']);
        }else{
            $userAdminName = '';
        }
        ?>
        <input type="hidden" id="tutorID" name="tutorID" value="<?PHP echo $_POST['tutorID']; ?>" />
        <input type="hidden" id="sessionIDLogin" name="sessionIDLogin" value="<?PHP echo $_POST['sessionIDLogin']; ?>" />
          <div class="form-group">
            <label class="col-form-label">Rating :</label>
          </div>

    <fieldset class="rating" style="margin-top:-10px;">
    <input type="hidden" value="1">
      <input type="radio" id="5star" name="ratingStar" value="5" />
      <label class="full" for="5star" title="Excellent"></label>
    
      <input type="radio" id="4halfstar" name="ratingStar" value="4.5" />
      <label class="half" for="4halfstar" title="Good"></label>
    
      <input type="radio" id="4star" name="ratingStar" value="4" />
      <label class="full" for="4star" title="Pretty good"></label>
    
      <input type="radio" id="3halfstar" name="ratingStar" value="3.5" />
      <label class="half" for="3halfstar" title="Nice"></label>
    
      <input type="radio" id="3star" name="ratingStar" value="3" />
      <label class="full" for="3star" title="Ok"></label>
    
      <input type="radio" id="2halfstar" name="ratingStar" value="2.5" />
      <label class="half" for="2halfstar" title="Kinda bad"></label>
    
      <input type="radio" id="2star" name="ratingStar" value="2" />
      <label class="full" for="2star" title="Bad"></label>
    
      <input type="radio" id="1halfstar" name="ratingStar" value="1.5" />
      <label class="half" for="1halfstar" title="Meh"></label>
    
      <input type="radio" id="1star" name="ratingStar" value="1" />
      <label class="full" for="1star" title="Umm"></label>
    
      <input type="radio" id="halfstar" name="ratingStar" value="0.5" />
      <label class="half" for="halfstar" title="Worst"></label>
    </fieldset>    

            
                 
                 
          
          
          <div class="clearfix"></div>
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name :</label>
            <input type="text" class="form-control" id="ratingName" name="ratingName" value="<?PHP //echo $userAdminName; ?>" >
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Comments :</label>
            <textarea rows="5" class="form-control" id="ratingComments" name="ratingComments"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button onclick="submitRating()" type="button" class="btn btn-rate">Submit</button>
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
                                  //$('#loadRating').html(result);
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
    
    var ratingStar = $('input[name="ratingStar"]:checked').val();
    var ratingName = document.getElementById('ratingName').value;
    var ratingComments = document.getElementById('ratingComments').value;
  
  
    if ( tutorID == '' ) {
        alert('Error : tutorID');
    }else if ( sessionIDLogin == '' ) {
        alert('Error : sessionIDLogin');
    }else if (!$("input[name='ratingStar']:checked").val()) {
        alert('Please Insert Rating');
    }else if( ratingName == '' ){
        alert('Please Insert Name');
    }else if( ratingComments == '' ){
        alert('Please Insert Comment');
    }else{
        //alert(tutorID + ' - ' + sessionIDLogin + ' - ' + ratingStar + ' - ' + ratingName + ' - ' + ratingComments); 

        $('#myModalRating').modal('hide');
        document.getElementById('loadRating').innerHTML = "";
     
        $.ajax({
            url: "review-rating-submit.php",
            method: "POST",
            data: {tutorID: tutorID, sessionIDLogin: sessionIDLogin, ratingStar: ratingStar, ratingName: ratingName, ratingComments: ratingComments}, 
            success: function(result){
                
                if(result =='success'){
                    
                         $.ajax({
                            url: "review-rating.php",
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
</script>




