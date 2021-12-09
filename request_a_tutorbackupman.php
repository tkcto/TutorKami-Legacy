<?php 
require_once('includes/head.php');

if (count($_POST) > 0) { 
	$data = $_POST;
	$output = system::FireCurl(TUTOR_REQUEST_URL, "POST", "JSON", $data);
	Session::SetFlushMsg($output->flag, $output->message);
	if ($output->flag == 'success') {

	} else {
	 
	}
  
}

include('includes/header.php');?>
<section class="blog">
	<div class="container">
		<h1 class="blue-txt"><?php echo REQUEST_A_TUTOR_FORM; ?></h1>
		<hr>
		<p><?php echo REQUEST_A_TUTOR_FORM_MESSAGE; ?></p>
		<div class="request">
			<form class="form-horizontal" method="post">
				<div class="form-group">
					<div class="col-sm-5">
                    <label><span class="org-txt"><?php echo NAME; ?></span> <?php echo REQUIRED; ?>*</label>
						<input type="text" class="form-control" id="tr_name" name="tr_name" required> </div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
                     <label><span class="org-txt"><?php echo LOCATION; ?></span> <?php echo REQUIRED; ?>*</label>
						<input type="text" class="form-control" id="tr_location" name="tr_location" required>
                         </div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
                      <label><span class="org-txt"><?php echo PHONE_NUMBER; ?></span> <?php echo REQUIRED; ?>*</label>
						<input type="text" class="form-control" id="tr_phone_number" name="tr_phone_number" required> </div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
                    	 <label><span class="org-txt"><?php echo SUBJECT_LEVEL; ?></span> <?php echo REQUIRED; ?>*</label>
						<input type="text" class="form-control" id="tr_subject" name="tr_subject" required> </div>
				</div>
				<div class="form-group">
					<p><?php echo ADDITIONAL_COMMENT; ?></p>
					<div class="col-sm-6">
						<textarea class="form-control" placeholder="Example : Request tutor id 1093308" name="tr_additional_comment"><?php 
						if(isset($_GET['tutor_id']) && $_GET['tutor_id'] != ''){
							echo 'Request tutor id '.$_GET['tutor_id'];
						}
						?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<button type="submit" class="btn btn-default rate-your"><?php echo BUTTON_SUBMIT; ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<?php include('includes/footer.php');?>