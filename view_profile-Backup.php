<?php 

require_once('includes/head.php');

# SESSION CHECK #

if (!isset($_SESSION['auth'])) {

  header('Location: login.php');

  exit();

}

if ($_SESSION['auth']['user_role'] != '3') {

   header('Location:list_of_classes.php');

   exit();

}

$user_id = $_SESSION['auth']['user_id'];

$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);



// var_dump($getUserDetails->data[0]);

include('includes/header.php');
$_SESSION['getPage'] = "View Profile";
?>

<section class="profile">

 <div class="main-body">

    <div class="container">

       <h1 class="text-center text-uppercase blue-txt"><?php echo VIEW_PROFILE; ?></h1>

       <div class="col-md-10 col-md-offset-1 ">

          <hr>

          <div class="row">

             <div class="col-md-8 col-sm-10">

                <h3 class="org-txt text-capitalize"><strong><?php echo $_SESSION['auth']['display_name'];?> (<?php echo ID_NO; ?> : <?php echo $getUserDetails->data[0]->u_displayid; ?>)</strong></h3>

                <br>

                <strong><?php echo system::CalculateAge($getUserDetails->data[0]->ud_dob); ?> <?php echo YEARS_OLD; ?>, <?php echo ($getUserDetails->data[0]->u_gender == 'M') ? 'Male' : 'Female'; ?>, <?php echo ($getUserDetails->data[0]->ud_race != '' && $getUserDetails->data[0]->ud_race != 'Not selected') ? $getUserDetails->data[0]->ud_race : ''; ?> </strong><br>

                <?php echo $getUserDetails->data[0]->ud_qualification; ?> <br>

                <br>

                <strong><?php echo TUTOR_STATUS; ?> :</strong> <?php echo $getUserDetails->data[0]->ud_tutor_status; ?> <br>

                <br>

                <strong><?php echo EXPERIENCE; ?>:</strong> <?php echo ($getUserDetails->data[0]->ud_tutor_experience != '') ? $getUserDetails->data[0]->ud_tutor_experience.' '.YEARS : ''; ?> <br>

                <br>

                <strong><?php echo OCCUPATION; ?>:</strong> <?php echo $getUserDetails->data[0]->ud_current_occupation == 'Other' ? $getUserDetails->data[0]->ud_current_occupation_other : $getUserDetails->data[0]->ud_current_occupation; ?> <br>

                <br>

                <strong><?php echo WILL_CONSIDER_TEACHING_AT_TUITION_CENTER; ?>:</strong> <?php echo $getUserDetails->data[0]->ud_client_status == 'Tuition Centre' ? 'Yes' : 'No'; ?> <br>

                <br>

                <strong><?php echo AREAS_COVERED_FOR_HOME_TUITION; ?>:</strong> <br>

                

                  <?php 

                  $getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');

                  if ($getAllCountries->flag == 'success' && count($getAllCountries->data) > 0) {

                    $i = 0;

                    foreach ($getAllCountries->data as $key => $country) {

                      // Get State By Country Id

                      $getCountryWiseStates = system::FireCurl(LIST_STATE_URL.'?country_id='.$country->c_id);

                      if ($getCountryWiseStates->flag == 'success' && count($getCountryWiseStates->data) > 0) {

                        foreach ($getCountryWiseStates->data as $key => $state) {

                          // GET User State

                          $checked = system::FireCurl(USER_AREA_URL.'?user_id='.$user_id.'&state_id='.$state->st_id);

                          // GET Other City of the state

                          $OtherState = system::FireCurl(USER_OTHER_AREA_URL.'?user_id='.$user_id.'&state_id='.$state->st_id);

                  ?>

                  <?php if ($checked->flag == 'success' && $checked->data > 0) { ?>

                  <div class="text-capitalize"> 

                    <span class="org-txt"><strong><?php echo $state->st_name; ?>: </strong></span>

                  <?php 

                    // Get City By State Id

                    $getStateWiseCity = system::FireCurl(LIST_CITY_URL.'?state_id='.$state->st_id);

                    if ($getStateWiseCity->flag == 'success' && count($getStateWiseCity->data) > 0) {

                    

                      $cty = '';

                      foreach ($getStateWiseCity->data as $key => $city) {

                        // GET User City

                        $city_ch = system::FireCurl(USER_AREA_URL.'?user_id='.$user_id.'&city_id='.$city->city_id);

                        $cty .= ($city_ch->flag == 'success' && $city_ch->data > 0) ? $city->city_name.', ' : '';



                        $i++;

                      }

                      $cty = rtrim($cty, ', ');

                      echo $cty;

                    }

                    echo ($OtherState->flag == 'success' && $OtherState->data != '' && isset($cty) && $cty != '') ? ', ' : '';

                    echo ($OtherState->flag == 'success' && $OtherState->data != '') ? $OtherState->data : '';

                    ?>

                  </div>

                  <br>

                  <?php } ?>

                  <?php 

                        }

                      }

                  ?>

                  <?php

                    }

                  }

                  ?>

                <br>

                <div class="text-capitalize"> <strong><?php echo SUBJECTS_TAUGHT; ?>: </strong> <br>

                <?php 

                  // Get Course

                  $getCourse = system::FireCurl(LIST_COURSE_URL);

                  if ($getCourse->flag == 'success' && count($getCourse->data) > 0) {

                    $i = 0;

                    foreach ($getCourse->data as $key => $course) {

                      // GET User Course

                      $checked = system::FireCurl(USER_SUBJECT_URL.'?user_id='.$user_id.'&course_id='.$course->tc_id);

                      // Get Other subject from table

                      $OtherCourse = system::FireCurl(USER_OTHER_SUBJECT_URL.'?user_id='.$user_id.'&course_id='.$course->tc_id);

                      if($checked->flag == 'success' && $checked->data > 0) {

                  ?>

                   <span class="org-txt"><?php echo $course->tc_title; ?>: </span> 

                  <?php 

                      // Get Subjects

                      $sub = '';

                      $getSubject = system::FireCurl(LIST_SUBJECT_URL.'?course_id='.$course->tc_id);

                      if ($getSubject->flag == 'success' && count($getSubject->data) > 0) {

                        

                        foreach ($getSubject->data as $key => $subject) {

                          // GET User Subject

                          $sub_chk = system::FireCurl(USER_SUBJECT_URL.'?user_id='.$user_id.'&subject_id='.$subject->ts_id);

                  ?>

                   <?php $sub .= ($sub_chk->data > 0) ? $subject->ts_title.', ' : '';?> 

                  <?php

                          $i++; 

                        }

                        echo rtrim($sub, ', ');

                      }

                      echo ($OtherCourse->flag == 'success' && $OtherCourse->data != '' && isset($sub) && $sub != '') ? ', ' : '';

                      echo ($OtherCourse->flag == 'success' && $OtherCourse->data != '') ? $OtherCourse->data : '';

                  ?>

                    <br>

                  <?php 

                      }

                    }

                  }

                  ?>                  

                </div>

                <div> </div>

             </div>

             <div class="col-md-4 text-center">

                <img src="<?php 

                if (isset( $_SESSION['auth'] )) {

                  if ($_SESSION['auth']['user_pic'] != '') {

                    // echo APP_ROOT.$_SESSION['auth']['user_pic'];
                     //echo APP_ROOT."images/profile/000".$_SESSION['auth']['user_pic']."_0.jpg";
					 
					/* START fadhli */
					$pix = sprintf("%'.07d", $_SESSION['auth']['user_pic']);
					$pixAll = $pix.'_0.jpg';
					echo APP_ROOT."images/profile/".$pixAll;
					/* END fadhli */

                  } elseif ($_SESSION['auth']['user_gender'] == 'M') {

                    echo APP_ROOT."images/tutor_ma.png";

                  } else {

                    echo APP_ROOT."images/tutor_mi1.png";

                  }

                }

                ?>" alt="profile_pic" class="img-thumbnail" height="244" width="190">

                <h4 class="org-txt text-capitalize"><strong><?php echo $_SESSION['auth']['display_name'];?> (<?php echo ID_NO; ?> : <?php echo $getUserDetails->data[0]->u_displayid; ?>)</strong></h4>                

             </div>

          </div>

          <hr>

          <br>

          <!-- Nav tabs -->

          <ul class="nav nav-tabs" role="tablist">

             <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo ABOUT_MYSELF; ?></a></li>

             <li role="presentation"><a href="#testimonials" aria-controls="testimonials" role="tab" data-toggle="tab"><?php echo TESTIMONIALS; ?></a></li>

             <li role="presentation" ><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab"><?php echo REVIEWS; ?></a></li>

          </ul>

          <!-- Tab panes -->

          <div class="tab-content">

             <div role="tabpanel" class="tab-pane active" id="home"><?php echo $getUserDetails->data[0]->ud_about_yourself; ?></div>

             <div role="tabpanel" class="tab-pane" id="testimonials">

                <em><?php echo CLICK_IMAGE_TO_ENLARGE; ?></em><i class="fa fa-plus plus" aria-hidden="true"></i> <br>

                <ul class="whatsapp">

                   <?php 

                    // Get Course

                    $getTestimonial = system::FireCurl(USER_TESTIMONIAL."?uid=".$user_id);

                    if ($getTestimonial->flag == 'success' && count($getTestimonial->data) > 0) {

                      $i = 0;

                      foreach ($getTestimonial->data as $key => $testimonial) {

                   ?>

                   <?php if ($testimonial->ut_user_testimonial1 != '') { ?>

                   <li><img src="<?php echo $testimonial->ut_user_testimonial1; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                   <?php } ?>

                   <?php if ($testimonial->ut_user_testimonial2 != '') { ?>

                   <li><img src="<?php echo $testimonial->ut_user_testimonial2; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                   <?php } ?>

                   <?php if ($testimonial->ut_user_testimonial3 != '') { ?>

                   <li><img src="<?php echo $testimonial->ut_user_testimonial3; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                   <?php } ?>

                   <?php if ($testimonial->ut_user_testimonial4 != '') { ?>

                   <li><img src="<?php echo $testimonial->ut_user_testimonial4; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>

                   <?php } ?>

                   <?php 

                      }

                    }

                   ?>

                </ul>

             </div>

             <div role="tabpanel" class="tab-pane " id="reviews">                

                <?php include('includes/list_tutor_review.php');?>

             </div>

          </div>

       </div>

    </div>

 </div>

</section>

<?php include('includes/footer.php');?>