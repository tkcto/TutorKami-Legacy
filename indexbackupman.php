<?php 

include('includes/head.php');

include('includes/header.php');?>

<section class="banner">

   <article class="banner_text">

      <div class="container">

         <div class="row">

            <div class="col-md-8 col-md-offset-2">

            <?php 

            // Get Header Text

            $arrHeadText = system::FireCurl(CMS_URL.'?cms_id=21&lang='.$_SESSION['lang_code']);

            foreach($arrHeadText->data as $head){

              echo $head->pmt_pagedetail;

            } 

            ?>

               <div class="form_div">

                  <form action="search_tutor.php" method="get">

                    <input type="hidden" name="subject_id" id="subject_id" value="">

                    <input type="hidden" name="location_id" id="location_id" value="">

                     <div class="form-group">

                        <div class="row">

                           <div class="col-md-5 col-sm-5 col-xs-12">

                              <div class="input-group">

                                 <input type="text" name="subject" class="my_form_control ui-autocomplete-input" id="subject" placeholder="<?php echo HOME_SEARCH_EXAMPLE; ?>">

                                 <span class="input-group-addon"><i class="fa fa-search"></i></span>

                              </div>                              

                           </div>

                           <div class="col-md-4 col-sm-4  col-xs-12">

                              <div class="input-group ui-widget">

                                 <input type="text" name="location" class="my_form_control ui-autocomplete-input" id="location" placeholder="<?php echo HOME_SEARCH_LOCATION_PLACEHOLDER; ?>" />

                                 <span class="input-group-addon"><i class="fa fa-map-pin"></i></span>

                              </div>

                           </div>

                           <div class="col-md-3 col-sm-3  col-xs-12">

                              <button type="submit" class="btn btn-md search_btn"><?php echo HOME_SEARCH_TUTOR_PLACEHOLDER; ?></button>

                           </div>

                        </div>

                     </div>

                  </form>

               </div>

            </div>

         </div>

      </div>

   </article> 

   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">

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

      <!-- man -->
      <!-- <ol class="carousel-indicators">
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item">
          <img src="admin/upload/nonsliderimage.jpg" alt="tutorkami">
          <div class="carousel-caption">
            
          </div>
        </div>
      </div> -->
      <!-- man -->

      <div class="carousel-inner" role="listbox">

        <?php 

         // Get Slider

         $j = 0;

         foreach($arrSlider->data as $sl){

         ?>

         <div class="item <?php if($j==0) {?> active <?php } ?>">

            <img src="admin/<?php echo $sl->sl_image;?>" alt="...">

            <div class="carousel-caption">

            </div>

         </div>

         <?php $j++; } ?>

         

      </div>

   </div>

</section>

<section class="how_works">

   <div class="container">

   <div class="col-md-2"></div>

   <?php 

         // Get How it works

         $arrHowitworks = system::FireCurl(CMS_URL.'?cms_id=1&lang='.$_SESSION['lang_code']);

         

         foreach($arrHowitworks->data as $how){?>

       <div class=" col-md-12 tutor_button">

			<!--<h3 class="get_tutor1 sticky">

            <a href="request_a_tutor_form.php" class="green_btn pull-right">GET A TUTOR</a></h3>-->

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

<section class="orange_sec">

   <div class="container">

      <div class="row">

         <div class="col-md-10 col-md-offset-1">

            <div class="pin_box">

               <?php 

               // Get What is tutorkami

               $arrWhatistutorkami = system::FireCurl(CMS_URL.'?cms_id=2&lang='.$_SESSION['lang_code']);

               

               foreach($arrWhatistutorkami->data as $what){?>

                   

               <h1 class="header"><?=$what->pmt_subtitle?></h1>

               <hr class="myhr">

               <?php 

               echo $what->pmt_pagedetail;

               }

               ?>

               </div>

         </div>

      </div>

   </div>

</section>

<section class="how_works bott_border">

   <div class="container">

      <?php 

         // Get Why Tutorkami

         $arrWhytutorkami = system::FireCurl(CMS_URL.'?cms_id=3&lang='.$_SESSION['lang_code']);

         

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

<section class="how_works bott_border">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">

           <?php 

            // Get Our Guarantee

            $arrOurGuarantee = system::FireCurl(CMS_URL.'?cms_id=4&lang='.$_SESSION['lang_code']);

            

            foreach($arrOurGuarantee->data as $guarant){ ?>

            <h1 class="header"><?=$guarant->pmt_subtitle?></h1>

            <?php

                echo $guarant->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<section class="how_works bott_border">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">

          <?php 

            // Get Tutor Text

            $arrTutorText = system::FireCurl(CMS_URL.'?cms_id=22&lang='.$_SESSION['lang_code']);

            

            foreach($arrTutorText->data as $ttext){ ?>

            <h1 class="header"><?php echo $ttext->pmt_subtitle;?></h1>

            <p class="subHead"><?php echo $ttext->pmt_pagedetail;?></p>

            <?php

            }

           ?>

         </div>

      </div>

      <div class="row">

         <div class="col-md-12">

            <ul class="tutor_list">

              <?php 

                 // Get Slider

                 $arrTutor = system::FireCurl(LIST_TUTOR);

                 $i = 0;

                 foreach($arrTutor->data as $tutor){

                   $arrState = system::FireCurl(LIST_STATE_URL.'?state_id='.$tutor->ud_state);

                 foreach($arrState->data as $state){

                     $statename = $state->st_name;

                   }

                   $pix = sprintf("%'.07d\n", $tutor->u_profile_pic);

                 ?>  

               <li style="cursor:pointer">

                  <a href="tutor_profile.php?did=<?php echo $tutor->u_displayid; ?>" target="_blank">

                    <img src="<?php if($tutor->u_profile_pic!='') { echo APP_ROOT."images/profile/".$pix."_0.jpg"; } else { if($tutor->u_gender=='M') echo 'images/tutor_ma.png'; else echo 'images/tutor_mi1.png'; }?>" class="img-responsive center-block" alt=""/>

                    <p class="orange_head"><?=$tutor->u_displayname?></p>

                     <span><?=$tutor->ud_address?></span>

                  </a>

               </li>

               <?php } ?>

             </ul>

            <p class="m_top_30"><a href="search_tutor.php" class="orange_btn"><?php echo BUTTON_VIEW_MORE_TUTOR; ?></a></p>

         </div>

      </div>

   </div>

</section>

<section class="how_works">

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <?php 

            // Get People Saying

            $arrPeopleSaying = system::FireCurl(CMS_URL.'?cms_id=5&lang='.$_SESSION['lang_code']);

            

            foreach($arrPeopleSaying->data as $saying){ ?>

            <h1 class="header"><?=$saying->pmt_subtitle?></h1>

            <?php

             echo $saying->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<section class="join">

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <?php 

            // Get Are you a tutor

            $arrIsTutor = system::FireCurl(CMS_URL.'?cms_id=6&lang='.$_SESSION['lang_code']);

            

            foreach($arrIsTutor->data as $tutor){

                echo $tutor->pmt_pagedetail;

            

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



            <h1 class="header">

            <?php 

            // Get Are you a tutor

            $arrNewsText = system::FireCurl(CMS_URL.'?cms_id=23&lang='.$_SESSION['lang_code']);

            

            foreach($arrNewsText->data as $newst){

              echo $newst->pmt_pagedetail;

            }?>

            </h1>

         </div>

      </div>

      <div class="row">

      <?php // Get Latest News

          if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang){                 

            $lang_url = str_replace('{lang}/', '', LIST_LATESTNEWS_URL);

          }

          else{

            $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_LATESTNEWS_URL);

          }

          $arrLatestNews = system::FireCurl($lang_url);

          // var_dump($lang_url);

           $n = 1;

           $count = sizeof($arrLatestNews->data);

        

           foreach($arrLatestNews->data as $news){

             $post_id = $news->ID;

           ?>

          <div class="col-md-4">

            <div class="thum_bg">

             <a href="<?=$news->post_url?>"><img src="<?=$news->thumbnail_url?>" class="img-responsive" alt="" width="100%"/></a>

             <h4><?=$news->title?></h4>

             <p><?= $news->date?> | <?=$news->author?> | <?=$news->comments_count?> Comment(s)</p>

             <p><?=$news->content?></p>

           </div>

         </div>

      

         <?php if($n%3==0) echo '</div><div class="row hidden-xs">';?>

         

         <?php //if((($n!=0) && (($n+1)%3==0)) || ($n == $count-1))  echo '</div>';?>

       

       <?php $n++ ; } ?>

      </div>

   </div>

</section>



<section class="qe">

   <div class="container">

      <div class="row">

         <div class="col-md-12" style="position:relative;">

            <?php 

            // Get Questions or Enquires

            $arrEnquery = system::FireCurl(CMS_URL.'?cms_id=7&lang='.$_SESSION['lang_code']);

            

            foreach($arrEnquery->data as $entry){

                echo $entry->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<?php include('includes/footer.php');?>

<script>

   $(function() {

      function log( message ) {

         $( "<div>" ).text( message ).prependTo( "#log" );

         $( "#log" ).scrollTop( 0 );

      }



      $("#subject").autocomplete({

         source: function( request, response ) {

            $.ajax( {

               url: "<?php echo SEARCH_SUBJECT_URL; ?>",

               dataType: "json",

               data: {

                  term: request.term

               },

               success: function( data ) {

                  response( data );

               }

            });

         },

         minLength: 2,

         select: function( event, ui ) {

          // alert(ui.item.id)

          $('#subject_id').val(ui.item.id);

            // log( "Selected: " + ui.item.value + " aka " + ui.item.id );

         }

      });

     

      $(document).ready(function(){

        $('.carousel').carousel({

          interval: 2000

        });



//         $('#carousel-example-generic1').carousel({

//         	interval: false

//       });

      

      });    

   

      $("#location").autocomplete({

         source: function( request, response ) {

            $.ajax( {

               url: "<?php echo SEARCH_LOCATION_URL; ?>",

               dataType: "json",

               data: {

                  term: request.term

               },

               success: function( data ) {

                  response( data );

               }

            });

         },

         minLength: 2,

         select: function( event, ui ) {

          $('#location_id').val(ui.item.id);

            // log( "Selected: " + ui.item.value + " aka " + ui.item.id );

         }

      });

   });

</script>



<script>

  equalheight = function(container){



    var currentTallest = 0,

    currentRowStart = 0,

    rowDivs = new Array(),

    $el,

    topPosition = 0;

    $(container).each(function() {



     $el = $(this);

     $($el).height('auto')

     topPostion = $el.position().top;



     if (currentRowStart != topPostion) {

       for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {

         rowDivs[currentDiv].height(currentTallest);

       }

       rowDivs.length = 0; // empty the array

       currentRowStart = topPostion;

       currentTallest = $el.height();

       rowDivs.push($el);

     } else {

       rowDivs.push($el);

       currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

     }

     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {

       rowDivs[currentDiv].height(currentTallest);

     }

   });

  }



  $(window).load(function() {

    equalheight('.how_works .thum_bg');

  });





  $(window).resize(function(){

    equalheight('.how_works .thum_bg');

  });

 // $('.carousel-example-generic1').carousel('pause');  

</script>



