<?php include('includes/header.php');?>
<section class="terms">
   <div class="container">
      
      <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
       <?php 
            // Get About Us
            $arrTerms = system::FireCurl(CMS_URL.'?cms_id=17&lang='.$_SESSION['lang_code']);
            
            foreach($arrTerms->data as $terms){?>
        <h1 class="blue-txt"><?=$terms->pmt_subtitle?></h1>
        <hr>
        <?php echo $terms->pmt_pagedetail; } ?>
        
      </div>
   </div>
</section>
<?php include('includes/footer.php');?>