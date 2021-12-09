

               <?php 

               if(isset($_SESSION['auth'])){

                  $user_job = system::FireCurl(CHECK_APPLIED_JOB_URL."?job_id={$job_id}&user_id={$user_id}");

                  if ($user_job->data > 0) {

                     echo '<h2 class="text-center">You have already <em>applied</em> for this job.</h2>';

                  } else {

               ?>

               <?php if($status != 'closed'){?>

               <div class="col-xs-12">
<center>
                  <!--<button type="submit" class="apply text-uppercase"><?php //echo BUTTON_APPLY_JOB; ?></button>-->
				  

<?php 
//if( $user_id =='1579981'){  
//echo '<br/><br/><br/><br/><br/><br/>';

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

//} 
?>  
<button type="button" disabled class="hidden btn apply text-uppercase fakeButton "><i class="fa fa-refresh fa-spin"></i> <?php echo BUTTON_APPLY_JOB; ?></button>				  
				  
</center>
               </div>

               <?php } } ?>

               <?php } else { ?>

               <h2 class="text-center"> <em><?php echo PLEASE; ?><strong> <a href="tutor-login.php?redirect=job_details.php&jid=<?php echo $job_id; ?>&status=<?php echo $_GET['status']; ?>" class="org-txt"><?php echo LOGIN; ?> </a></strong><?php echo TO_APPLY_FOR_THIS_JOB; ?></em></h2>

               <?php } ?>






               <div class="clearfix"></div><br/>
               <div class="col-xs-12">
               <?php if($status != 'closed'){?>

<style>
.columnImg {
  float: left;
  width: 33.33%;
  padding: 5px;
}
</style>
<div class="row">
  <div class="columnImg">
	<a href="http://www.facebook.com/share.php?u=<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>&amp;title=<?php echo $row->jt_subject;?>" target="_blank"> <img src="images/favicon/facebook.png" alt="facebook" style="width:73%;height:53%"> </a>
  </div>
  <div class="columnImg">
    <a href="http://twitter.com/home?status=<?php echo $row->jt_subject;?>+<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>" target="_blank"> <img src="images/favicon/twitter.png" alt="twitter" style="width:70%;height:45%"> </a>
  </div>
  <div class="columnImg">
    <a href="whatsapp://send?text=<?php echo APP_ROOT;?>job_details.php?jid=<?php echo $job_id; ?>"> <img src="images/favicon/whatsapp.png" alt="whatsapp" style="width:67%;height:45%"> </a>  
  </div>
</div>

               <?php } ?>
               </div>















