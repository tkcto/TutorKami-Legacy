<?php 

//unset($_SESSION['firstlogin']);
include('includes/header.php');

$_SESSION['getPage'] = "Tutor Home";
unset($_SESSION["firstlogin"]);
?>


<section class="banner tutor">


   <article class="banner_text">


      <div class="container">


         <div class="row">


            <div class="col-md-8 col-md-offset-2">


               <h1><?php echo TUTOR_PAGE_MESSAGE; ?> 


                  <?php echo TUTOR_PAGE_MESSAGE1; ?> <span><?php echo TUTOR_PAGE_MESSAGE2; ?></span> <?php echo TUTOR_PAGE_MESSAGE3; ?> <span><?php echo TUTOR_PAGE_MESSAGE4; ?></span> <?php echo TUTOR_PAGE_MESSAGE5; ?>


               </h1>


            </div>


         </div>


      </div>


   </article>


   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">


      <!-- Indicators -->


      <ol class="carousel-indicators">


        <?php 


         // Get Slider


         $arrSlider = system::FireCurl(LIST_SLIDER);


         $i = 0;


         foreach($arrSlider->data as $sl){


         ?>


         <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if($i==0) {?> class="active" <?php } ?>></li>


         <?php $i++; } ?>


         


      </ol>


      <!-- Wrapper for slides -->


      <div class="carousel-inner" role="listbox">


        <?php 


         // Get Slider


         $j = 0;


         foreach($arrSlider->data as $sl){


         ?>


         <div class="item <?php if($j==0) {?> active <?php } ?>">


            <!--<img src="admin/<?php //echo $sl->sl_image;?>" alt="...">-->
			
<?php
if(stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")){ // if mobile browser
?>
<img src="images/banner_tutor_1.jpg">
<?php
}
else { // desktop browser
?>
<img src="images/banner_tutor_1.jpg" style="padding-top: 60px;">
<?php
}
?>

            <div class="carousel-caption">


            </div>


         </div>


         <?php $j++; } ?>


         


      </div>


   </div>


</section>


<section class="how_works bott_border">


   <div class="container">


   <div class="col-md-2"></div>


   <?php 


         // Get How it works


         $arrHowitworks = system::FireCurl(CMS_URL.'?cms_id=9&lang='.$_SESSION['lang_code']);


         


         foreach($arrHowitworks->data as $how){?>


       <div class=" col-md-12 tutor_button">


         <div class="row  b_margin_50">


               <h1 class="header"><?=$how->pmt_subtitle?></h1>


         </div>


      </div>


      <div class="row">


        <?php


             echo $how->pmt_pagedetail;


         


         }


         ?>


      </div>


   </div>


</section>

<section class="how_works bott_border">


   <div class="container">


      <?php 


         // Get Why Tutorkami


         $arrWhytutorkami = system::FireCurl(CMS_URL.'?cms_id=8&lang='.$_SESSION['lang_code']);


         


         foreach($arrWhytutorkami->data as $why){?>


      <div class="row  b_margin_50">


         <div class="col-md-12">


            <h1 class="header"><?=$why->pmt_subtitle?></h1>


         </div>


      </div>


      <div class="row">


        <?php


             echo $why->pmt_pagedetail;


         


         }


        ?>


      </div>


   </div>


</section>


<section class="orange_sec white_txt">


   <div class="container">


     <?php 


         // Get How it works


         $arrLike = system::FireCurl(CMS_URL.'?cms_id=10&lang='.$_SESSION['lang_code']);


         


         foreach($arrLike->data as $like){?>


      <div class="row">


         <div class="col-md-10 col-md-offset-1 text-center">


            <h1 class="header_white"><?=$like->pmt_subtitle?></h1>


            <hr class="myhr">


         </div>


      </div>


      <div class="row">


         <?php


             echo $like->pmt_pagedetail;


         


         }


         ?>


      </div>


   </div>


</section>


<section class="latest_job">


   <div class="container">


      <div class="row">


         <div class="col-md-12">


           <?php 


            // Get How it works


            $arrLatestJobs = system::FireCurl(CMS_URL.'?cms_id=11&lang='.$_SESSION['lang_code']);


            


            foreach($arrLatestJobs->data as $jobs){?>


            <h1><span><?=$jobs->pmt_subtitle?></span></h1>


            <?php


             echo $jobs->pmt_pagedetail;


         


           }


           ?>





         </div>


      </div>


   </div>


</section>


<section class="how_works gray_bg">


   <div class="container">


      <div class="row">


         <div class="col-md-8 col-md-offset-2">


            <h1 class="header"><?php echo UPPERCASE_TESTIMONIAL_FROM_TUTOR; ?></h1>


         </div>


      </div>


      <?php 


      // Testimonial

/*
      $getTestimonial = system::FireCurl(USER_TESTIMONIAL."?limit=10");
      if ($getTestimonial->flag == 'success' && count($getTestimonial->data) > 0) {
        $i = 0;        
      ?>
      <div class="row">
         <div class="col-md-12">
            <div class="owl-carousel owl-theme">
              <?php 
              foreach ($getTestimonial->data as $key => $testimonial) {
                $getUser = system::FireCurl(USER_LISTING_URL."?user_id=".$testimonial->ut_u_id);
              ?>
              <?php if ($testimonial->ut_user_testimonial1 != '') { ?>
              <div class="item">
                <figure>
                  <img src="<?php echo $testimonial->ut_user_testimonial1; ?>" class="img-responsive center-block" alt=""/>
                </figure>
              </div>
              <?php } ?>
              <?php if ($testimonial->ut_user_testimonial2 != '') { ?>
              <div class="item">
                <figure>
                  <img src="<?php echo $testimonial->ut_user_testimonial2; ?>" class="img-responsive center-block" alt=""/>
                </figure>
              </div>
              <?php } ?>
              <?php if ($testimonial->ut_user_testimonial3 != '') { ?>
              <div class="item">
                <figure>
                  <img src="<?php echo $testimonial->ut_user_testimonial3; ?>" class="img-responsive center-block" alt=""/>
                </figure>
              </div>
              <?php } ?>
              <?php if ($testimonial->ut_user_testimonial4 != '') { ?>
              <div class="item">
                <figure>
                  <img src="<?php echo $testimonial->ut_user_testimonial4; ?>" class="img-responsive center-block" alt=""/>
                </figure>
              </div>
              <?php } ?>
              <?php if ($testimonial->ut_user_testimonial5 != '') { ?>
              <div class="item">
                <figure>
                  <img src="<?php echo $testimonial->ut_user_testimonial5; ?>" class="img-responsive center-block" alt=""/>
                </figure>
              </div>
              <?php } ?>
              <?php 
                $i++;
              }
             ?>
            </div>
         </div>
      </div>
      <?php } 
*/	  
	  ?>
<!-- START fadhli -->
      <div class="row">
         <div class="col-md-12">
            <div class="owl-carousel owl-theme">

              <div class="item">
                <figure>
                  <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/tutor1.jpeg" style="width: 270px; height: 480px;" class="img-responsive center-block" alt=""/>
                </figure>
              </div>

              <div class="item">
                <figure>
                  <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/tutor2.jpeg" style="width: 270px; height: 480px;" class="img-responsive center-block" alt=""/>
                </figure>
              </div>

              <div class="item">
                <figure>
                  <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/tutor3.jpeg" style="width: 270px; height: 480px;" class="img-responsive center-block" alt=""/>
                </figure>
              </div>

              <div class="item">
                <figure>
                  <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/tutor4.jpeg" style="width: 270px; height: 480px;" class="img-responsive center-block" alt=""/>
                </figure>
              </div>
  
            </div>
         </div>
      </div>
<!-- END fadhli -->


   </div>


</section>

<section class="how_works">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <h1 class="header">Supported By</h1>
         </div>
      </div>
	  <br/><br/>
      <div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://erezeki.my/partners" target="_blank"><img alt="mdec logo" class="img-responsive center-block" src="images/mdec-logo.png" style="width:80%" /></a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://erezeki.my/partners" target="_blank"><img alt="erezeki logo" class="img-responsive center-block" src="images/eRezeki-logo.png" style="width:80%" /></a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:30px;">
				<a href="https://www.cradle.com.my/" target="_blank"><img alt="cradle logo" class="img-responsive center-block" src="images/cradle-logo.png" style="width:80%" /></a>
			</div>
      </div>
   </div>
</section>


<section class="qe">


   <div class="container">


      <div class="row">


         <div class="col-md-12" style="position:relative;">


           <?php 


            // Get How it works


            $arrRegister = system::FireCurl(CMS_URL.'?cms_id=13&lang='.$_SESSION['lang_code']);


            


            foreach($arrRegister->data as $reg){?>


            <h1><?=$reg->pmt_subtitle?></h1>


            <?php


                echo $reg->pmt_pagedetail;


              }


             ?>


         </div>


      </div>


   </div>


</section>


<section class="fb">


   <div class="container">


      <div class="row">


         <div class="col-md-8 col-md-offset-2" style="position:relative;">


          <?php 


            // Get How it works


            $arrFacebook = system::FireCurl(CMS_URL.'?cms_id=14&lang='.$_SESSION['lang_code']);


            


            foreach($arrFacebook->data as $face){?>


            <h1><span><?=$face->pmt_subtitle?></span>


            </h1>


            <?php


                echo $face->pmt_pagedetail;


              }


             ?>


         </div>


      </div>


   </div>


</section>


<?php include('includes/footer.php');?>