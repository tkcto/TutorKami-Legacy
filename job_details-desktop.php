
               <!--<div class="col-md-offset-1 col-md-10">
               <?php if($status != 'closed'){?>

                  <div class="col-md-4 omb_socialButtons"><a href="http://www.facebook.com/share.php?u=<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>&amp;title=<?php echo $row->jt_subject;?>" target="_blank" class="btn btn-lg btn-block omb_btn-facebook"> <i class="fa fa-facebook" aria-hidden="true"></i> <span class="hidden-xs">SHARE</span> </a></div>

                  <div class="col-md-4 omb_socialButtons"><a href="http://twitter.com/home?status=<?php echo $row->jt_subject;?>+<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>" target="_blank" class="btn btn-lg btn-block omb_btn-twitter"> <i class="fa fa-twitter" aria-hidden="true"></i> <span class="hidden-xs">twitter</span> </a></div>

                  <div class="col-md-4 omb_socialButtons"><a href="whatsapp://send?text=<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>" class="btn btn-lg btn-block omb_btn-whatsapp"> <i class="fa fa-whatsapp" aria-hidden="true"></i> <span class="hidden-xs">whatsapp</span> </a></div>

               <?php } ?>
               </div>


               <div class="clearfix"></div>-->

               <?php 

               if(isset($_SESSION['auth'])){

                  $user_job = system::FireCurl(CHECK_APPLIED_JOB_URL."?job_id={$job_id}&user_id={$user_id}");

                  if ($user_job->data > 0) {

                     echo '<h2 class="text-center">You have already <em>applied</em> for this job.</h2>';

                  } else {

               ?>

               <?php if($status != 'closed'){?>

               <div class="col-md-offset-4 col-md-4 col-xs-offset-3">

                  <!--<button type="submit" class="apply text-uppercase"><?php //echo BUTTON_APPLY_JOB; ?></button>-->
				  

<?php 


	if($onTimetable != 'on' && $onRate != 'on'){ 
		?>
		<a href="#" class="apply text-uppercase oriButton" onclick="applyJob()" ><?php echo BUTTON_APPLY_JOB; ?></a>
		<?PHP
	}else if($onTimetable == 'on' && $onRate != 'on'){ 
		?>
		<a class="js-signin-modal-trigger cd-main-nav__item--signin  apply text-uppercase oriButton" href="#0" data-signin="signup"><?php echo BUTTON_APPLY_JOB; ?></a>
		<?PHP
	}else if($onTimetable != 'on' && $onRate == 'on'){
	    ?>
	    <a class="js-signin-modal-trigger cd-main-nav__item--signin  apply text-uppercase oriButton" href="#0" data-signin="login"><?php echo BUTTON_APPLY_JOB; ?></a>
	    <?PHP
	}else{
		?>
		<a class="js-signin-modal-trigger cd-main-nav__item--signin apply text-uppercase oriButton" href="#0" data-signin="login"><?php echo BUTTON_APPLY_JOB; ?></a>
		<?PHP
	}
/*
if( $user_id =='1579981' ||	$user_id =='70886' || $user_id =='1581999'  ){  
echo '<br/><br/><br/><br/><br/><br/>';
    ?><a href="#" class="apply text-uppercase" onclick="applyJobWA()" ><?php echo BUTTON_APPLY_JOB.' WA'; ?></a><?php
} */
?>  

<button type="button" disabled class="hidden btn apply text-uppercase fakeButton "><i class="fa fa-refresh fa-spin"></i> <?php echo BUTTON_APPLY_JOB; ?></button>

               </div>

               <?php } } ?>

               <?php } else { ?>

               <h2 class="text-center"> <em><?php echo PLEASE; ?><strong> <a href="tutor-login.php?redirect=job_details.php&jid=<?php echo $job_id; ?>&status=<?php echo $_GET['status']; ?>" class="org-txt"><?php echo LOGIN; ?> </a></strong><?php echo TO_APPLY_FOR_THIS_JOB; ?></em></h2>

               <?php } ?>






               <div class="clearfix"></div><br/>
               <div class="col-lg-12">
               <?php if($status != 'closed'){?>

<style>
.columnImg {
  float: left;
  width: 23.33%;/*
  padding: 5px;*/
  margin-left: 10%;
  
}
</style>
<div class="row">
  <div class="columnImg">
	<a href="http://www.facebook.com/share.php?u=<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>&amp;title=<?php echo $row->jt_subject;?>" target="_blank"> <img src="images/favicon/facebook.png" alt="facebook" style="width:44%;height:32%"> </a>
  </div>
  <div class="columnImg">
    <a href="http://twitter.com/home?status=<?php echo $row->jt_subject;?>+<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>" target="_blank"> <img src="images/favicon/twitter.png" alt="twitter" style="width:42%;height:30%"> </a>
  </div>
  <div class="columnImg">
    <a href="whatsapp://send?text=<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>"> <img src="images/favicon/whatsapp.png" alt="whatsapp" style="width:40%;height:28%"> </a>  
  </div>
</div>

               <?php } ?>
               </div>