<?php 
require_once('includes/head.php');

if (isset($_GET['email']) && $_GET['email'] != '') {
	$output = system::FireCurl(ACTIVATION_URL.'?u_email='.$_GET['email']);
	if ($output->flag == 'error') {
		Session::SetFlushMsg($output->flag, $output->message);
		header('Location:login.php');
		exit();
	}
} else {
	header('Location:login.php');
	exit();
}

include('includes/header.php');?>
<section class="parent_rating">
   <div class="container">
      <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-10">
        <h1 class="blue-txt"> <?php echo ACCOUNT_ACTIVATION; ?> </h1>
        <hr>
		<p class="text-center martop"><?php echo ACCOUNT_ACTIVATION_DESCRIPTION; ?></p>
		<br>
		<div class="col-md-4 col-md-offset-4 col-xs-offset-3">
		  <a href="login.php" class="apply text-uppercase"><?php echo BUTTON_LOGIN; ?></a>
		</div>
      </div>
   </div>
</section>
<?php include('includes/footer.php');?>