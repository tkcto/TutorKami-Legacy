<style>

</style>
<?php 
$review_obj_approve = system::FireCurl(LIST_REVIEW_URL_APPROVE.'?tutor_id='.$user_id);
?>
<div class="row">
  <div class="col-sm-12">
  <?PHP 

	$total=0;
	foreach($review_obj_approve->data as $key=>$value){
		//echo $key. " = " .$value->rr_rating. "<br>"; 
		$total+= $value->rr_rating;
	}
	$purata = ($total / count($review_obj_approve->data));
	//echo $purata;
	?>
	
<?php
if ( count($review_obj_approve->data) > 0 ) {
?>

	<strong><em><?php echo count($review_obj_approve->data); ?> Review(s) &nbsp;&nbsp;</em></strong>

	<?php 
	$whole = floor($purata);     // 1
	$decimal = fmod($purata, 1); //0.25

	for($i = 0; $i < $whole; $i++) { ?>
	<span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>
	<?php } ?>
	<?php if($decimal != ''){ ?>
	<span class="rating-input"><span data-value="0" class="fa fa-star-half"></span></span>
	<?php } ?>
<?php
}
?>
	
	
  </div>
</div>



<?PHP
if ($review_obj_approve->flag == 'success' && count($review_obj_approve->data) > 0) {
	$i = 0;
	foreach ($review_obj_approve->data as $key => $review) {
        $split_rating = explode('.', $review->rr_rating);
        
        if($review->rr_status =="approved"){
?>
		<!-- style="background-color:white" -->
<div class="reviews-bg" style="background-color:white;border-top: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;border-right: 1px solid black;">
   	<div class="row text-capitalize txt-size-16">

<div class="col-xs-12">
	<div class="media">
		<!--<a class="pull-left" href="#">
			<img class="img-circle" width = "80" height = "80" src="<?php /*$pix = sprintf("%'.07d\n", $review->u_profile_pic);
			if ($review->u_gender == 'M') {
                echo "https://www.tutorkami.com/images/tutor_ma.png";
			} else {
                 echo "https://www.tutorkami.com/images/tutor_mi1.png";
			} */?>" alt="<?php //echo $review->ud_first_name; ?>">
		</a>-->
		<div class="media-body">
			<p></p>
			<p><strong><em>
			<?php 
    $dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
    if ($dbCon->connect_error) {
		die("Connection failed: " . $dbCon->connect_error);
    } 
/*
    $queryCity2 = "SELECT * FROM tk_cities WHERE city_id='".$review->ud_city."' "; 
    $resultCity2 = $dbCon->query($queryCity2); 
    if($resultCity2->num_rows > 0){ 
        $rowCity2 = $resultCity2->fetch_assoc();
        $outputCity2 = $rowCity2['city_name'];   
    }else{
        $outputCity2 = $review->ud_city;
    }
    $dbCon->close();   
			echo $review->ud_first_name.', '.$outputCity2; 
*/
    $queryUser = "SELECT * FROM tk_user_details WHERE ud_u_id='".$review->rr_parent_id."' "; 
    $resultUser = $dbCon->query($queryUser); 
    if($resultUser->num_rows > 0){ 
        $rowUser = $resultUser->fetch_assoc(); 
        $clientName = ucwords($rowUser['salutation'].' '.$rowUser['ud_first_name']); 
        
        $queryCity = "SELECT * FROM tk_cities WHERE city_id='".$rowUser['ud_city']."' "; 
        $resultCity = $dbCon->query($queryCity); 
        if($resultCity->num_rows > 0){ 
            $rowCity = $resultCity->fetch_assoc();
            $cityName = $rowCity['city_name'];   
        }else{
            $cityName = '';
        }
        
        echo $clientName.', '.$cityName; 
    }
			?> 
			</em></strong></p>
			<p><strong><em><?php $dt = strtotime($review->rr_create_date); echo date("j M Y", strtotime(date("Y-m-d", $dt)));?> </em></strong></p>
		</div>
	</div>
</div>

   	</div><br/>
   	<p><strong><em><?php echo $review->rr_review; ?></em></strong></p>
	
</div>

<?php 
        }
	}
}
?>