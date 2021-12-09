<div class="media">
   <?php include('review_left_panel.php');?>
   <div class="media-body media_edit">
      <form action="" method="post">
         <input type="hidden" name="currentstep" value="1">
         <input type="hidden" name="nextstep" value="2">
         <h4 class="media-heading org-txt"><?php echo REVIEW_STEP1_TITLE; ?> <?php echo $getUserDetails->data[0]->ud_first_name; ?> <?php echo $getUserDetails->data[0]->ud_last_name; 
$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
if($getLan == "/my/"){	

}else{
	echo '’s';
}
         
         ?> <?php echo TEXT_CLASS; ?></h4>
         <p class="martop"><?php echo REVIEW_STEP1_DESCRIPTION; ?></p>
         <h4 class="martop"><?php echo REVIEW_STEP1_QUESTION; ?> <small><?php echo REQUIRED; ?></small></h4>               
         <fieldset class="rating">
            <input type="radio" id="star5" name="rating" value="5" required="" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
            <input type="radio" id="star4half" name="rating" value="4.5" required="" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
            <input type="radio" id="star4" name="rating" value="4" required="" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
            <input type="radio" id="star3half" name="rating" value="3.5" required="" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
            <input type="radio" id="star3" name="rating" value="3" required="" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
            <input type="radio" id="star2half" name="rating" value="2.5" required="" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
            <input type="radio" id="star2" name="rating" value="2" required="" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
            <input type="radio" id="star1half" name="rating" value="1.5" required="" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
            <input type="radio" id="star1" name="rating" value="1" required="" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
            <input type="radio" id="starhalf" name="rating" value="0.5" required="" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
         </fieldset>
         <div class="clearfix"></div>
         <button type="submit" class="btn-lg btn-warning text-center rate-your"><?php echo BUTTON_NEXT; ?></button>
      </form>
   </div>
</div>