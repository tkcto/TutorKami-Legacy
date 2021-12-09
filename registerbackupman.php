<?php 


require_once('includes/head.php');





# SESSION CHECK #


if (isset($_SESSION['auth'])) {


  header('Location: tutor.php');


  exit();


}











if (count($_POST) > 0) { 


  $data = $_POST;


  $error = 0;


  if (count($_FILES) > 0) { 





    $name       = $_FILES['u_profile_pic']['name'];


    $imgext     = explode(".", $name);


    $imgext     = end($imgext);


    $tmpname    = $_FILES['u_profile_pic']['tmp_name'];


    $extension  = array('jpg', 'jpeg', 'png', 'bmp');





    


      if($_FILES['u_profile_pic']['size'] > 512000){


        $error++;


        Session::SetFlushMsg("error",'File size greater than 500 KB. You can\'t upload this file.');


      } elseif($_FILES['u_profile_pic']['size'] > 0) {


        if(in_array($imgext, $extension)){


          move_uploaded_file($tmpname, "files/".$name);


          $picture_path = "files/".$name;


        } else{


          $error++;


          Session::SetFlushMsg("error",'File you tried to upload is not an image. You can\'t upload this file.');


        } 


      }    


  }





  if ($error == 0) {


    


    $data['u_profile_pic'] = isset($picture_path) ? $picture_path : '';


    $data['ud_dob'] = implode('-', array_reverse($_POST['ud_dob']));


    


    $output = system::FireCurl(REGISTRATION_URL, "POST", "JSON", $data);


    


    if ($output->flag == 'success') {


      header('Location: registration-success.php');


      exit();


    } else {


      Session::SetFlushMsg($output->flag, $output->message);


    }


  }


  


}





$getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');





include('includes/header.php');?>


<style>


  .form_error {


    display: none;


  }


  input.error {


    border: 1px solid #ff0101;


  }


  label.error {


    color: #ff0101;


    font-style: italic;


    font-weight: normal;


  }


  .myform [type="checkbox"]:not(:checked) + label.custom::before, 


  .myform [type="checkbox"]:checked + label.custom::before {


    background: #fff;


    border: 1px solid #ccc;


    border-radius: 0;


    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) inset;


    content: "";


    height: 20px;


    left: 0;


    position: absolute;


    top: 0;


    width: 20px;


  }





  @media (min-width: 768px) {


    label.error {


      position: absolute;


      top: 5px;


      left: 408px;


      width: 290px;


      max-width: 290px;


    }


    label[for="ud_dob_2"].error {


      left: 276px;


    }


    label[for="ud_dob_3"].error {


      left: 144px;


    }


    label[for="agreement"].error {


      left: 280px;


      width: 360px;


      max-width: 360px;


    }


  }


  ui-tooltip-content {


    line-height: 10px;


  }


</style>


<section class="client_profile myform">


  <div class="container">


    <div class="row">


      <div class="col-md-12 col-sm-8">


        <div>


          <h1 class="blue-txt text-uppercase text-center"><?php echo TUTOR_REGISTRATION; ?></h1>


          <hr>


        </div>


        <p><span class="rad-txt">*</span> <?php echo REQUIRED; ?><br>


          <?php echo REGISTER_CONTACT_US_PHONE; ?></p>


        <div class="col-md-10 mrg_top30">


          <form class="form-horizontal" method="post" enctype="multipart/form-data" id="registration-form">


            <div class="form-group hidden">


              <label class="control-label col-sm-4" for="pwd"><?php echo USERNAME; ?>*</label>


              <div class="col-sm-8">


                <input type="hidden" class="form-control" name="u_username" id="u_username" value="<?php echo isset($_POST['u_username']) ? $_POST['u_username']: time();?>">


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo EMAIL; ?>*</label>


              <div class="col-sm-5">


                <input type="email" class="form-control" id="u_email" name="u_email" value="<?php echo isset($_POST['u_email']) ? $_POST['u_email']: '';?>" data-rule-required="true" data-msg-required="- Email is required.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo PASSWORD; ?>*</label>


              <div class="col-sm-5">


                <input type="password" class="form-control" id="u_password" name="u_password" data-rule-required="true" data-msg-required="- Password is required.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo CONFIRM_PASSWORD; ?>*</label>


              <div class="col-sm-5">


                <input type="password" class="form-control" id="con_password" name="con_password" data-rule-equalto="#u_password" data-msg-required="- Password mismatch.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo FIRST_NAME; ?>*</label>


              <div class="col-sm-5">


                <input type="text" class="form-control" id="ud_first_name" name="ud_first_name" value="<?php echo isset($_POST['ud_first_name']) ? $_POST['ud_first_name']: '';?>" data-rule-required="true" data-msg-required="- First name is required.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo LAST_NAME; ?>*</label>


              <div class="col-sm-5">


                <input type="text" class="form-control" id="ud_last_name" name="ud_last_name" value="<?php echo isset($_POST['ud_last_name']) ? $_POST['ud_last_name']: '';?>" data-rule-required="true" data-msg-required="- Last name is required.">


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo DISPLAY_NAME; ?>*</label>


              <div class="col-sm-5">


                <input type="text" class="form-control" id="u_displayname" name="u_displayname" value="<?php echo isset($_POST['u_displayname']) ? $_POST['u_displayname']: '';?>" data-rule-required="true" data-msg-required="- Display name is required.">


                <label class="box_text_1"><?php echo DISPLAY_NAME_EXAMPLE; ?></label>


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo PHONE_NUMBER; ?>*</label>


              <div class="col-sm-5">


                <input type="text" class="form-control" id="ud_phone_number" name="ud_phone_number" value="<?php echo isset($_POST['ud_phone_number']) ? $_POST['ud_phone_number']: '';?>" />


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="ud_dob_1"><?php echo DOB; ?>*</label>


              <div class="col-sm-5">


                <div class="row rdc_pad">


                  <div class="col-md-4">


                    <select class="form-control" id="ud_dob_1" name="ud_dob[0]">


                      <option value=""><?php echo DOB_DAY; ?></option>


                      <?php


                      for ($i=1; $i < 32; $i++) {


                        $sl1 =  (isset($_POST) && $_POST['ud_dob'][0] == $i) ? 'selected' : '';


                        $dt = ($i < 10)? '0'.$i : $i;


                        echo '<option value="'.$dt.'" '.$sl1.'>'.$i.'</option>';


                      }


                      ?>


                    </select>


                  </div>


                  <div class="col-md-4">


                    <select class="form-control" id="ud_dob_2" name="ud_dob[1]">


                      <option value=""><?php echo DOB_MONTH; ?></option>


                      <?php


                      $m_arr = array('01' => 'January',


                        '02' => 'February',


                        '03' => 'March ',


                        '04' => 'April ',


                        '05' => 'May ',


                        '06' => 'June ',


                        '07' => 'July ',


                        '08' => 'August ',


                        '09' => 'September',


                        '10' =>'October',


                        '11' => 'November',


                        '12' => 'December'


                        );


                      foreach ($m_arr as $key => $value) {


                        $sl2 =  (isset($_POST) && $_POST['ud_dob'][1] == $key) ? 'selected' : '';


                        echo '<option value="'.$key.'" '.$sl2.'>'.$value.'</option>';


                      }


                      ?>


                    </select>


                  </div>


                  <div class="col-md-4">


                    <select class="form-control" id="ud_dob_3" name="ud_dob[2]">


                      <option value=""><?php echo DOB_YEAR; ?></option>


                      <?php


                      for ($j=2005; $j > 1950; $j--) {


                        $sl3 =  (isset($_POST) && $_POST['ud_dob'][2] == $j) ? 'selected' : '';


                        echo '<option value="'.$j.'" '.$sl3.'>'.$j.'</option>';


                      }


                      ?>


                    </select>


                  </div>


                </div>


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="u_gender_m"><?php echo GENDER; ?>*</label>


              <div class="col-sm-8 radio_font">


                <div class="row">


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="u_gender" value="M" id="u_gender_m" <?php echo isset($_POST['u_gender']) && $_POST['u_gender'] == 'M' ? 'checked' : (!isset($_POST['u_gender']) ? 'checked' : '');?>>


                      <?php echo MALE; ?></label>


                  </div>


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="u_gender" value="F" id="u_gender_f" <?php echo isset($_POST['u_gender']) && $_POST['u_gender'] == 'F' ? 'checked' : '';?>>


                      <?php echo FEMALE; ?></label>


                  </div>


                </div>


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="ud_address"><?php echo YOUR_LOCATION; ?>*</label>


              <div class="col-sm-5">


                <textarea name="ud_address" id="ud_address" class="form-control" data-rule-required="true" data-msg-required="- Location is required."><?php echo isset($_POST['ud_address']) ? $_POST['ud_address']: '';?></textarea>


                <label class="box_text_1"><?php echo YOUR_LOCATION_EXAMPLE; ?></label>


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo STATUS_AS_TUTOR; ?></label>


              <div class="col-sm-8 radio_font">


                <div class="row">


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="ud_tutor_status" value="Full Time" <?php echo isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Full Time' ? 'checked' : (!isset($_POST['ud_tutor_status']) ? 'checked' : '');?>>


                      <?php echo FULL_TIME; ?></label>


                  </div>


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="ud_tutor_status" value="Part Time" <?php echo isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Part Time' ? 'checked' : '';?>>


                      <?php echo PART_TIME; ?></label>


                  </div>


                </div>


              </div>


            </div>

<!-- prob -->
            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo AREA_YOU_CAN_COVER; ?>*</label>


              <div class="col-sm-8">


                <div class="row">


                  <?php 


                  if ($getAllCountries->flag == 'success' && count($getAllCountries->data) > 0) {//1


                    $i = 0;


                    foreach ($getAllCountries->data as $key => $country) {//2


                      // Get State By Country Id


                      $getCountryWiseStates = system::FireCurl(LIST_STATE_URL.'?country_id='.$country->c_id);


                      if ($getCountryWiseStates->flag == 'success' && count($getCountryWiseStates->data) > 0) {//3


                        foreach ($getCountryWiseStates->data as $key => $state) {//4


                  ?>


                  <div class="col-md-6">


                     <div class="checkbox">                        


                         <input type="checkbox" name="cover_area_state[]" id="ca_state_<?php echo $state->st_id; ?>" value="<?php echo $state->st_id; ?>" onchange="checkAll(this, '<?php echo 'cover_area_city_'.$state->st_id;?>')" <?php echo isset($_POST['cover_area_state']) && (in_array($state->st_id, $_POST['cover_area_state'])) ? 'checked':'';?>>


                         <label for="ca_state_<?php echo $state->st_id; ?>" class="custom"><?php echo $state->st_name; ?></label>

<!-- sini problem -->
                        <?php 


                        // Get City By State Id


                        $getStateWiseCity = system::FireCurl(LIST_CITY_URL.'?state_id='.$state->st_id);


                        if ($getStateWiseCity->flag == 'success' && count($getStateWiseCity->data) > 0) {//5


                        ?>

<!-- sini problem -->
                        <div class="showHide" style="display: <?php echo isset($_POST['cover_area_state']) && (in_array($state->st_id, $_POST['cover_area_state'])) ? 'block':'none';?>;">


                           <div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>


                           <div class="dropPop" style="display: <?php echo isset($_POST['cover_area_state']) && (in_array($state->st_id, $_POST['cover_area_state'])) ? 'block':'none';?>;">


                              <div class="row">


                                 <div class="col-md-12"><a href="javascript:void(0);" onclick="tickAll('ca_state_<?php echo $state->st_id; ?>', '<?php echo 'cover_area_city_'.$state->st_id;?>');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('ca_state_<?php echo $state->st_id; ?>', '<?php echo 'cover_area_city_'.$state->st_id;?>');">Untick All</a></div>


                                 <?php foreach ($getStateWiseCity->data as $key => $city) {//6 ?>


                                 <div class="col-md-6">


                                    


                                    <input type="checkbox" id="cover_area_city_<?php echo $state->st_id;?>_<?php echo $i; ?>" name="cover_area_city_<?php echo $state->st_id;?>[<?php echo $i; ?>]" value="<?php echo $city->city_id;?>" data-pid="<?php echo $state->st_id;?>" data-cname="cover_area_city_" data-pname="ca_state_" onchange="check_parent(this)" <?php echo isset($_POST['cover_area_city_'.$state->st_id]) && (in_array($city->city_id, $_POST['cover_area_city_'.$state->st_id])) ? 'checked':'';?>> 


                                    <label for="cover_area_city_<?php echo $state->st_id;?>_<?php echo $i; ?>" class="custom"><?php echo $city->city_name;?></label>


                                 </div>

<!-- sini problem -->
                                 <?php $i++;}//6 ?> 
<!-- sini problem -->

                              </div>


                           </div>


                           <div class="row">


                              <div class="col-md-12">


                                <div class="checkbox">                                  


                                  <input type="checkbox" name="other_area_<?php echo $state->st_id;?>" id="other_area_<?php echo $state->st_id;?>" value="1" onchange="toggleOther(this, 'cover_area_other_<?php echo $state->st_id;?>')" <?php echo (isset($_POST['other_area_'.$state->st_id]) && $_POST['other_area_'.$state->st_id] == '1') ? 'checked':'';?>>


                                  <label for="other_area_<?php echo $state->st_id;?>"><?php echo AREA_YOU_CAN_COVER_OTHERS; ?></label>


                                </div>


                              </div>


                              <div class="col-md-12" style="display: <?php echo (isset($_POST['other_area_'.$state->st_id]) && $_POST['other_area_'.$state->st_id] == '1') ? 'block':'none';?>;">


                                <textarea class="form-control" name="cover_area_other_<?php echo $state->st_id;?>" rows="3" style="resize:none;"><?php echo (isset($_POST['cover_area_other_'.$state->st_id]) && $_POST['cover_area_other_'.$state->st_id] != '') ? $_POST['cover_area_other_'.$state->st_id]:'';?></textarea>


                              </div>


                            </div>


                        </div>


                        <?php }//5 ?>


                     </div>


                  </div>


                  <?php 


                        }//4


                      }//3


                    }//2


                  }//1


                  ?>                   


                </div>                


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo SUBJECT_YOU_CAN_TEACH; ?>*</label>


              <div class="col-sm-8">


                <div class="row">


                  <?php 


                  // Get Course


                  $getCourse = system::FireCurl(LIST_COURSE_URL);


                  if ($getCourse->flag == 'success' && count($getCourse->data) > 0) {


                    $i = 0;


                    foreach ($getCourse->data as $key => $course) {


                  ?>


                  <div class="col-md-6">                    


                    <div class="checkbox">                      


                      <input type="checkbox" name="tutor_course[]" id="tu_course_<?php echo $course->tc_id; ?>" value="<?php echo $course->tc_id; ?>" onchange="checkAll(this, '<?php echo 'tutor_subject_'.$course->tc_id;?>')" <?php echo isset($_POST['tutor_course']) && (in_array($course->tc_id, $_POST['tutor_course'])) ? 'checked':'';?>>


                      <label for="tu_course_<?php echo $course->tc_id; ?>" class="custom"><?php echo $course->tc_title; ?></label>


                      <div class="showHide" style="display: <?php echo isset($_POST['tutor_course']) && (in_array($course->tc_id, $_POST['tutor_course'])) ? 'block':'none';?>;">


                       <div class="dropbox"><?php echo PLEASE_TICK_THE_SUBJECT; ?></div>


                       <div class="dropPop" style="display: <?php echo isset($_POST['tutor_course']) && (in_array($course->tc_id, $_POST['tutor_course'])) ? 'block':'none';?>;">


                          <div class="row">


                              <div class="col-md-12"><a href="javascript:void(0);" onclick="tickAll('tu_course_<?php echo $course->tc_id; ?>', '<?php echo 'tutor_subject_'.$course->tc_id;?>');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('tu_course_<?php echo $course->tc_id; ?>', '<?php echo 'tutor_subject_'.$course->tc_id;?>');">Untick All</a></div>


                             <?php 


                                 // Get Subjects


                                 $getSubject = system::FireCurl(LIST_SUBJECT_URL.'?course_id='.$course->tc_id);


                                 if ($getSubject->flag == 'success' && count($getSubject->data) > 0) {


                                   


                                   foreach ($getSubject->data as $key => $subject) {


                                    


                             ?>


                            <div class="col-md-12">  


                               <input type="checkbox" name="tutor_subject_<?php echo $course->tc_id;?>[<?php echo $i; ?>]" id="tutor_subject_<?php echo $course->tc_id;?>_<?php echo $i; ?>" value="<?php echo $subject->ts_id;?>" data-pid="<?php echo $course->tc_id;?>" data-cname="tutor_subject_" data-pname="tu_course_" onchange="check_parent(this)" <?php echo isset($_POST['tutor_subject_'.$course->tc_id]) && (in_array($subject->ts_id, $_POST['tutor_subject_'.$course->tc_id])) ? 'checked':'';?>> 


                               <label for="tutor_subject_<?php echo $course->tc_id;?>_<?php echo $i; ?>" class="custom"><?php echo $subject->ts_title;?></label>


                            </div>


                             <?php


                                     $i++; 


                                   }


                                   


                                 } else {


                                   echo "<p>No Subject Found</p>";


                                 }


                             ?>         


                          </div>


                       </div>


                       <div class="row">


                          <div class="col-md-12">


                             <div class="checkbox">            


                                <input type="checkbox" name="subject_<?php echo $course->tc_id;?>" id="subject_<?php echo $course->tc_id;?>" value="1" onchange="toggleOther(this, 'other_subject_<?php echo $course->tc_id;?>')" <?php echo (isset($_POST['subject_'.$course->tc_id]) && $_POST['subject_'.$course->tc_id] == '1') ? 'checked':'';?>>


                                <label for="subject_<?php echo $course->tc_id;?>"><?php echo SUBJECT_YOU_CAN_TEACH_OTHERS; ?> </label>


                             </div>


                          </div>


                          <div class="col-md-12" style="display: <?php echo (isset($_POST['subject_'.$course->tc_id]) && $_POST['subject_'.$course->tc_id] == '1') ? 'block':'none';?>;">


                             <textarea class="form-control" name="other_subject_<?php echo $course->tc_id;?>" rows="3" style="resize:none;"><?php echo (isset($_POST['other_subject_'.$course->tc_id]) && $_POST['other_subject_'.$course->tc_id] != '') ? $_POST['other_subject_'.$course->tc_id]:'';?></textarea>


                          </div>


                       </div>


                    </div>


                    </div>                                    


                  </div>


                  <?php    


                    }





                  } else {


                    echo "<p>No Course Found</p>";


                  }


                  ?>


                </div>


              </div>


            </div>
<!-- prob -->

            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd">


              Your rate/hour (optional) <br>


              </label>


              <div class="col-sm-8">


                <textarea class="form-control" placeholder="Example: UPSR : RM35/hour, SPM : RM50/hour, IGCSE: RM70/hour. Leave empty if you are not sure" style="height: 90px;" name="ud_rate_per_hour" id="ud_rate_per_hour"><?php echo (isset($_POST['ud_rate_per_hour']) && $_POST['ud_rate_per_hour'] != '') ? $_POST['ud_rate_per_hour']:'';?></textarea>


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION; ?></label>


              <div class="col-sm-8">


                <input type="text" class="form-control" id="ud_qualification" name="ud_qualification" value="<?php echo (isset($_POST['ud_qualification']) && $_POST['ud_qualification'] != '') ? $_POST['ud_qualification']:'';?>">


                <label class="box_text_1"><?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION_EXAMPLE; ?></label>


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo TUTORING_EXPERIENCE; ?></label>


              <div class="col-sm-8">


                <div class="row">


                  <div class="col-md-6 col-sm-7">


                    <input type="text" class="form-control" id="ud_tutor_experience" name="ud_tutor_experience" value="<?php echo (isset($_POST['ud_tutor_experience']) && $_POST['ud_tutor_experience'] != '') ? $_POST['ud_tutor_experience']:'';?>">


                  </div>


                  <div class="col-md-6 col-sm-5">


                    <p class="box_text_3"> <?php echo YEAR; ?> </p>


                  </div>


                </div>


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo WILL_TEACH_AT_TUITION_CENTER; ?></label>


              <div class="col-sm-8 radio_font">


                <div class="row">


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="tution_center" value="1" <?php echo (isset($_POST['tution_center']) && $_POST['tution_center'] == '1') ? 'checked': (!isset($_POST['tution_center']) ? 'checked' : '');?>>


                      <?php echo YES; ?></label>


                  </div>


                  <div class="col-md-6">


                    <label class="radio-inline" style="font-size:15px;">


                      <input type="radio" name="tution_center" value="0" <?php echo (isset($_POST['tution_center']) && $_POST['tution_center'] == '0') ? 'checked':'';?>>


                      <?php echo NO; ?></label>


                  </div>


                </div>


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd">


              <?php echo ABOUT_YOURSELF; ?>* <br>


              <p class="box_text_2"><?php echo ABOUT_YOURSELF_MESSAGE; ?></p>


              </label>


              <div class="col-sm-8">


                <textarea class="form-control" style="height: 90px;" name="ud_about_yourself" id="ud_about_yourself"><?php echo (isset($_POST['ud_about_yourself']) && $_POST['ud_about_yourself'] != '') ? $_POST['ud_about_yourself']:'';?></textarea>


                <a href="javascript:void(0);" class="box_text_1 sample-tooltip" data-toggle="tooltip" data-html="true" data-placement="top" title="<small style='font-size: 10px;'><?php echo VIEW_SAMPLE_POPUP_TEXT; ?></small>"><?php echo VIEW_SAMPLE; ?></a>


              </div>


            </div>


           <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo UPLOAD_PROFILE_PICTURE; ?><br>


                <p class="box_text_2"><?php echo UPLOAD_PROFILE_PICTURE_MESSAGE; ?></p>


              </label>


             <div class="col-sm-8">


                <input type="file" name="u_profile_pic" id="file-7" class="inputfile inputfile-6" accept="image/*" style="display:none;">


                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php echo CHOOSE_A_FILE; ?></strong></label>


                <div class="notice"><?php echo REGISTER_UPLOAD_PROFILE_PIC_MESSAGE; ?></div>              


              </div>


              


            </div>


              <div class="form-group">


              <div class="col-md-12">


              <div class="checkbox">


              


              <input type="checkbox" value="1" name="agreement" id="agreement" data-rule-required="true" data-msg-required="- Before continuing, you’ll need to agree to our terms.">


              <label style="font-size:13px; color:#F1951F;" for="agreement"><?php echo REGISTER_AGREEMENT; ?> <a href="#" class="sky-txt">TERMS_CONDITION</a></label>


              </div>


              </div>


              </div>


            <div class="form-group">


              <div class="col-sm-6">


                <button type="submit" class="btn btn-default"><?php echo BUTTON_SUBMIT; ?></button>


              </div>


            </div>


          </form>


        </div>


      </div>


    </div>


  </div>


</section>


<?php include('includes/footer.php');?>


<script type="text/javascript">


    function checkAll(ele, id) {


        var checkboxes = document.getElementsByTagName('input');


        var patt1 = /[^0-9]/g;





        if (ele.checked) {


            // $('[name^="'+id+'"]').prop('checked', true);


            $('[name^="'+id+'"]').parents('.showHide').show();


            $(ele).parent('.checkbox').find('.dropPop').show();


        } else {


            // $('[name^="'+id+'"]').prop('checked', false);


            $('[name^="'+id+'"]').parents('.showHide').hide();


            $(ele).parent('.checkbox').find('.dropPop').hide();


        }


    }





    function tickAll(pid, id) {


      $('#'+pid).prop('checked', true);


      $('[name^="'+id+'"]').prop('checked', true);


    }





    function untickAll(pid, id) {


      $('#'+pid).prop('checked', false);


      $('[name^="'+id+'"]').prop('checked', false);


    }





    function toggleOther(ele, id) {


      if (ele.checked) {


          $('[name^="'+id+'"]').parent('.col-md-12').show();


      } else {


          $('[name^="'+id+'"]').parent('.col-md-12').hide();


      }


    }





    function check_parent(ele) {





      var parentID = $(ele).data('pid');


      var parentName = $(ele).data('pname');


      var childName = $(ele).data('cname');


      var checkboxes = document.getElementsByTagName('input');


      


      if (ele.checked) {


        for (var i = 0; i < checkboxes.length; i++) {


             if (checkboxes[i].type == 'checkbox' && checkboxes[i].id == parentName+parentID){


               checkboxes[i].checked = true;


             }


         }


      } else {


        for (var i = 0; i < checkboxes.length; i++) {                


            if (checkboxes[i].type == 'checkbox' && checkboxes[i].id == parentName+parentID) {


               if ($('input[name^="'+childName+parentID+'"]:checked').length == 0) {


                  checkboxes[i].checked = false;


               }


               


            }


         }


      }


    }





    $('.sample-tooltip').tooltip({


        content: function () {


            return $(this).prop('title');


        }


    });


</script>