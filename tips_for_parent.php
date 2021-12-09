<?php include('includes/header.php');?>
  	<section class="background">
		<div class="container">
			<div class="col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10">
				<?php 
            // Get About Us
            $arrTips = system::FireCurl(CMS_URL.'?cms_id=18&lang='.$_SESSION['lang_code']);
            
            foreach($arrTips->data as $tips){?>
        <h1 class="blue-txt"><?=$tips->pmt_subtitle?></h1>
        <hr>
        <?php echo $tips->pmt_pagedetail; } ?>
			</div>
		</div>
	</section>


<?php include('includes/footer.php');?>