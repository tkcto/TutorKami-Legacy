<?php 
require_once('includes/head.php');
# SESSION CHECK #
if (!isset($_SESSION['auth'])) {
  header('Location: login.php');
  exit();
}

if (count($_FILES) > 0) {

  $testimonial_path = array();
  /*foreach ($_FILES['user_testimonial']['name'] as $key => $value) {
    
    if ($_FILES['user_testimonial']['size'][$key] > 0) {
      $testimonialname = $_FILES['user_testimonial']['name'][$key];
      $testimonialtemp = $_FILES['user_testimonial']['tmp_name'][$key];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){
        move_uploaded_file($testimonialtemp, "files/".$testimonialname);
        $testimonial_path[] = "files/".$testimonialname;
      }
    }
  }*/
  if(isset($_FILES['user_testimonial1']['name']) && $_FILES['user_testimonial1']['name'] != ''){
      $testimonialname = $_FILES['user_testimonial1']['name'];
      $testimonialtemp = $_FILES['user_testimonial1']['tmp_name'];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){
        move_uploaded_file($testimonialtemp, "files/".$testimonialname);
        $testimonial_path['user_testimonial1'] = "files/".$testimonialname;
      }
  }
  else{
    $testimonial_path['user_testimonial1']= '';
  }
  if(isset($_FILES['user_testimonial2']['name']) && $_FILES['user_testimonial2']['name'] != ''){
      $testimonialname = $_FILES['user_testimonial2']['name'];
      $testimonialtemp = $_FILES['user_testimonial2']['tmp_name'];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){
        move_uploaded_file($testimonialtemp, "files/".$testimonialname);
        $testimonial_path['user_testimonial2'] = "files/".$testimonialname;
      }
  }
  else{
    $testimonial_path['user_testimonial2']= '';
  }
  if(isset($_FILES['user_testimonial3']['name']) && $_FILES['user_testimonial3']['name'] != ''){
      $testimonialname = $_FILES['user_testimonial3']['name'];
      $testimonialtemp = $_FILES['user_testimonial3']['tmp_name'];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){
        move_uploaded_file($testimonialtemp, "files/".$testimonialname);
        $testimonial_path['user_testimonial3'] = "files/".$testimonialname;
      }
  }
  else{
    $testimonial_path['user_testimonial3']= '';
  }
  if(isset($_FILES['user_testimonial4']['name']) && $_FILES['user_testimonial4']['name'] != ''){
      $testimonialname = $_FILES['user_testimonial4']['name'];
      $testimonialtemp = $_FILES['user_testimonial4']['tmp_name'];
      $testimonialext  = explode(".", $testimonialname);
      $testimonialext  = end($testimonialext);
      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp');

      if(in_array($testimonialext, $allowedext)){
        move_uploaded_file($testimonialtemp, "files/".$testimonialname);
        $testimonial_path['user_testimonial4'] = "files/".$testimonialname;
      }
   }
   else{
    $testimonial_path['user_testimonial4']= '';
  }

  $name       = $_FILES['u_profile_pic']['name'];
  $imgext     = explode(".", $name);
  $imgext     = end($imgext);
  $tmpname    = $_FILES['u_profile_pic']['tmp_name'];
  $extension  = array('jpg', 'jpeg', 'png', 'bmp');

  if(in_array($imgext, $extension)){
    move_uploaded_file($tmpname, "files/".$name);
    $picture_path = "files/".$name;
  }else{
    Session::SetFlushMsg("Error",'You Cant Uplod This File.');
  }
  //print_r($testimonial_path);
  //exit();
}

if (count($_POST) > 0) { 
  $data = $_POST;

  $data['u_profile_pic'] = isset($picture_path) ? $picture_path : '';
  $data['u_testimonial'] = count($testimonial_path) > 0 ? $testimonial_path : '';
  $data['ud_dob'] = implode('-', array_reverse($_POST['ud_dob']));
  
  $output = system::FireCurl(PROFILE_UPDATE_URL, "PUT", "JSON", $data);
  
  Session::SetFlushMsg($output->flag, $output->message);
  if ($output->flag == 'success') {
    
  } else {
     
  }
  
}

$user_id = isset($_SESSION['auth']['user_id']) ? $_SESSION['auth']['user_id'] : 0;

$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);
if ($getUserDetails->flag == 'error') {
  Session::SetFlushMsg($output->flag, $output->message);
  header('Location: logout.php');
  exit();
}

if(count($getUserDetails->data) == 0){
  header('Location: logout.php');
  exit();
}
// var_dump((array) $getUserDetails->data[0]);exit();
$user_info = (array) $getUserDetails->data[0];
$user_info['ud_dob'] = explode('-', $user_info['ud_dob']);
$user_info['ud_dob'] = array_reverse($user_info['ud_dob']);

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
      left: 408px;
      position: absolute;
      top: 5px;
      width: 300px;
      max-width: 300px;
    }
  }
</style>
<section class="client_profile myform">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-8">
        <div>
          <h1 class="blue-txt text-uppercase text-center"> <?php echo MY_PROFILE; ?></h1>
          <hr>
        </div>
        <p><span class="rad-txt">*</span> <?php echo REQUIRED; ?><br>
          <?php echo EDIT_ACCOUNT_CONTACT_US_PHONE; ?> </p>
        <div class="col-md-10 mrg_top30">
          <form class="form-horizontal" method="post" enctype="multipart/form-data" id="registration-form">
            <input type="hidden" name="u_id" value="<?php echo isset($user_info['u_id']) ? $user_info['u_id']: '';?>">
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo EMAIL; ?>*</label>
              <div class="col-sm-5">
                <input type="email" class="form-control" value="<?php echo isset($user_info['u_email']) ? $user_info['u_email']: '';?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo FIRST_NAME; ?>*</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="<?php echo isset($user_info['ud_first_name']) ? $user_info['ud_first_name']: '';?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo LAST_NAME; ?>*</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="<?php echo isset($user_info['ud_last_name']) ? $user_info['ud_last_name']: '';?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="u_displayname"><?php echo DISPLAY_NAME; ?>*</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="u_displayname" name="u_displayname" value="<?php echo isset($user_info['u_displayname']) ? $user_info['u_displayname']: '';?>" data-rule-required="true" data-msg-required="- Display name is required.">
                <label class="box_text_1"><?php echo DISPLAY_NAME_EXAMPLE; ?></label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ud_phone_number"><?php echo PHONE_NUMBER; ?>*</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="ud_phone_number" name="ud_phone_number" value="<?php echo isset($user_info['ud_phone_number']) ? $user_info['ud_phone_number']: '';?>" />
              </div>
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
                        $sl1 =  (isset($user_info) && $user_info['ud_dob'][0] == $i) ? 'selected' : '';
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
                        $sl2 =  (isset($user_info) && $user_info['ud_dob'][1] == $key) ? 'selected' : '';
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
                        $sl3 =  (isset($user_info) && $user_info['ud_dob'][2] == $j) ? 'selected' : '';
                        echo '<option value="'.$j.'" '.$sl3.'>'.$j.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="u_gender_m"><?php echo GENDER; ?>*</label>
              <div class="col-sm-5 radio_font">
                <div class="row">
                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="u_gender" value="M" id="u_gender_m" <?php echo isset($user_info['u_gender']) && $user_info['u_gender'] == 'M' ? 'checked' : '';?>>
                      <?php echo MALE; ?></label>
                  </div>
                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="u_gender" value="F" id="u_gender_f" <?php echo isset($user_info['u_gender']) && $user_info['u_gender'] == 'F' ? 'checked' : '';?>>
                      <?php echo FEMALE; ?></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo RACE; ?></label>
              <div class="col-sm-5 radio_font">
                <div class="row">
                  <div class="col-md-4">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="ud_race" value="Malay" <?php echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Malay' ? 'checked' : '';?>>
                      Malay</label>
                  </div>
                  <div class="col-md-4">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="ud_race" value="Chinese" <?php echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Chinese' ? 'checked' : '';?>>
                      Chinese</label>
                  </div>
                  <div class="col-md-4">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="ud_race" value="Indian" <?php echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Indian' ? 'checked' : '';?>>
                      Indian</label>
                  </div>
                  <div class="col-md-4">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="ud_race" value="Others" <?php echo (isset($user_info['ud_race']) && $user_info['ud_race'] != 'Malay' && $user_info['ud_race'] != 'Chinese' && $user_info['ud_race'] != 'Indian' && $user_info['ud_race'] != 'Not selected') ? 'checked' : '';?>>
                      Others</label>
                  </div>
                  <div class="col-md-6">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="ud_race" value="Not selected" <?php echo isset($user_info['ud_race']) && $user_info['ud_race'] == 'Not selected' ? 'checked' : '';?>>
                      Not selected</label>
                  </div>
                </div>
                <br>
                <div id="other_race_wrap">
                   <?php 
                   if (isset($_POST['ud_race']) && $_POST['ud_race'] != 'Malay' && $_POST['ud_race'] != 'Chinese' && $_POST['ud_race'] != 'Indian' && $_POST['ud_race'] != 'Not Selected') {
                      echo '<textarea name="ud_race" class="form-control">'.$_POST['ud_race'].'</textarea>';
                   }  elseif (isset($user_info) && $user_info !== null && $user_info['ud_race'] != 'Malay' && $user_info['ud_race'] != 'Chinese' && $user_info['ud_race'] != 'Indian' && $user_info['ud_race'] != 'Not selected') {
                      echo '<textarea name="ud_race" class="form-control">'.$user_info['ud_race'].'</textarea>';
                   }
                   ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo MARITAL_STATUS; ?></label>
              <div class="col-sm-5 radio_font">
                <div class="row">
                  <div class="col-md-3">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="ud_marital_status" value="Married" <?php echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Married' ? 'checked' : '';?>>
                      Married</label>
                  </div>
                  <div class="col-md-4">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="ud_marital_status" value="Not married" <?php echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Not married' ? 'checked' : '';?>>
                      Not married</label>
                  </div>
                  <div class="col-md-5">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="ud_marital_status" value="Not selected" <?php echo isset($user_info['ud_marital_status']) && $user_info['ud_marital_status'] == 'Not selected' ? 'checked' : '';?>>
                      Not selected</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ud_address2"><?php echo STREET_ADDRESS; ?></label>
              <div class="col-sm-5">
                <textarea name="ud_address2" id="ud_address2" class="form-control" rows="3" style="resize:none;"><?php echo isset($user_info['ud_address2']) ? $user_info['ud_address2']: '';?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ud_address"><?php echo YOUR_LOCATION; ?>*</label>
              <div class="col-sm-5">
                <textarea name="ud_address" id="ud_address" class="form-control" data-rule-required="true" data-msg-required="- Location is required."><?php echo isset($user_info['ud_address']) ? $user_info['ud_address']: '';?></textarea>
                <label class="box_text_1"><?php echo YOUR_LOCATION_EXAMPLE; ?></label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo STATUS_AS_TUTOR; ?></label>
              <div class="col-sm-8 radio_font">
                <div class="row">
                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="ud_tutor_status" value="Full Time" <?php echo isset($user_info['ud_tutor_status']) && $user_info['ud_tutor_status'] == 'Full Time' ? 'checked' : '';?>>
                      <?php echo FULL_TIME; ?></label>
                  </div>
                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="ud_tutor_status" value="Part Time" <?php echo isset($user_info['ud_tutor_status']) && $user_info['ud_tutor_status'] == 'Part Time' ? 'checked' : '';?>>
                      <?php echo PART_TIME; ?></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ud_current_occupation"><?php echo CURRENT_OCCUPATION; ?></label>
              <div class="col-sm-4">
                <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">
                  <option value="">Select one</option>
                  <option value="Full-time tutor" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Full-time tutor' ? 'selected' : '';?>><?php echo FULL_TIME_TUTOR; ?></option>
                  <option value="Kindergarten teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Kindergarten teacher' ? 'selected' : '';?>><?php echo KINDERGARTEN_TEACHER; ?></option>
                  <option value="Primary school teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Primary school teacher' ? 'selected' : '';?>><?php echo PRIMARY_SCHOOL_TEACHER; ?></option>
                  <option value="Secondary school teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Secondary school teacher' ? 'selected' : '';?>><?php echo SECONDARY_SCHOOL_TEACHER; ?></option>
                  <option value="Tuition center teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Tuition center teacher' ? 'selected' : '';?>><?php echo TUITION_CENTER_TEACHER; ?></option>
                  <option value="Lacturer" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Lacturer' ? 'selected' : '';?>>Lecturer</option>
                  <option value="Ex-teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Ex-teacher' ? 'selected' : '';?>><?php echo EX_TEACHER; ?></option>
                  <option value="Retired teacher" <?php echo isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Retired teacher' ? 'selected' : '';?>><?php echo RETIRED_TEACHER; ?></option>
                  <option value="Other" <?php echo (isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Other') ? 'selected' : '';?>><?php echo OTHER; ?></option>
                </select>
              </div>
              <div class="col-sm-4">
                <?php 
                 if(isset($user_info['ud_current_occupation']) && $user_info['ud_current_occupation'] == 'Other') {
                  $occ_other = $user_info['ud_current_occupation_other'];
                  $sty_other = 'block';
                 } else {
                  $occ_other = '';
                  $sty_other = 'none';
                 }
                ?>
                <input class="form-control" type="text" name="ud_current_occupation_other" value="<?php echo $occ_other;?>" style="display: <?php echo $sty_other;?>;">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ud_current_company"><?php echo CURRENT_COMPANY; ?></label>
              <div class="col-sm-8">
                <input type="text" name="ud_current_company" id="ud_current_company" class="form-control" value="<?php echo isset($user_info['ud_current_company']) ? $user_info['ud_current_company']: '';?>" />
                <label class="box_text_1"><?php echo CURRENT_COMPANY_EXAMPLE; ?></label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo AREA_YOU_CAN_COVER; ?>*</label>
              <div class="col-sm-8">
                <div class="row">
                  <?php 
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
                  <div class="col-md-6">
                     <div class="checkbox">                        
                         <input type="checkbox" name="cover_area_state[]" id="ca_state_<?php echo $state->st_id; ?>" value="<?php echo $state->st_id; ?>" onchange="checkAll(this, '<?php echo 'cover_area_city_'.$state->st_id;?>')" <?php echo ($checked->flag == 'success' && $checked->data > 0) ? 'checked' : '';?> >
                         <label class="custom"><?php echo $state->st_name; ?></label>
                         <!--  for="ca_state_<?php echo $state->st_id; ?>" -->
                         <a href="javascript: void(0);" class="toggleShowHide"><i class="fa fa-plus-square-o"></i></a>
                        <?php 
                        // Get City By State Id
                        $getStateWiseCity = system::FireCurl(LIST_CITY_URL.'?state_id='.$state->st_id);
                        if ($getStateWiseCity->flag == 'success' && count($getStateWiseCity->data) > 0) {
                        ?>
                        <div class="showHide" style="display:none<?php //echo ($checked->flag == 'success' && $checked->data > 0) ? 'block' : 'none';?>">
                           <div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>
                           <div class="dropPop" <?php /* ?>style="display:<?php echo ($checked->flag == 'success' && $checked->data > 0) ? 'block' : 'none';?>"<?php */ ?>>
                              <div class="row">
                                 <div class="col-md-12"><a href="javascript:void(0);" onclick="tickAll('ca_state_<?php echo $state->st_id; ?>', '<?php echo 'cover_area_city_'.$state->st_id;?>');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('ca_state_<?php echo $state->st_id; ?>', '<?php echo 'cover_area_city_'.$state->st_id;?>');">Untick All</a></div>
                                 <?php 
                                 foreach ($getStateWiseCity->data as $key => $city) { 
                                    // GET User City
                                    $city_ch = system::FireCurl(USER_AREA_URL.'?user_id='.$user_id.'&city_id='.$city->city_id);
                                  ?>
                                 <div class="col-md-6">
                                    
                                    <input type="checkbox" id="cover_area_city_<?php echo $state->st_id;?>_<?php echo $i; ?>" name="cover_area_city_<?php echo $state->st_id;?>[<?php echo $i; ?>]" value="<?php echo $city->city_id;?>" data-pid="<?php echo $state->st_id;?>" data-cname="cover_area_city_" data-pname="ca_state_" onchange="check_parent(this)" <?php echo ($city_ch->flag == 'success' && $city_ch->data > 0) ? 'checked' : '';?>> 
                                    <label for="cover_area_city_<?php echo $state->st_id;?>_<?php echo $i; ?>" class="custom"><?php echo $city->city_name;?></label>
                                 </div>
                                 <?php $i++;} ?> 
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                <div class="checkbox">                                  
                                  <input type="checkbox" name="other_area_<?php echo $state->st_id;?>" id="other_area_<?php echo $state->st_id;?>" value="1" onchange="toggleOther(this, 'cover_area_other_<?php echo $state->st_id;?>', 'ca_state_<?php echo $state->st_id; ?>')" <?php echo ($OtherState->flag == 'success' && $OtherState->data != '') ? 'checked' : '';?>>
                                  <label for="other_area_<?php echo $state->st_id;?>"><?php echo AREA_YOU_CAN_COVER_OTHERS; ?></label>
                                </div>
                              </div>
                              <div class="col-md-12" style="display: <?php echo ($OtherState->flag == 'success' && $OtherState->data != '') ? 'block' : 'none';?>;">
                                <textarea class="form-control" name="cover_area_other_<?php echo $state->st_id;?>" rows="3" style="resize:none;"><?php echo ($OtherState->flag == 'success' && $OtherState->data != '') ? $OtherState->data : '';?></textarea>
                              </div>
                            </div>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
                  <?php 
                        }
                      }
                    }
                  }
                  ?>                   
                </div>                
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo SUBJECT_YOU_CAN_TEACH; ?>*</label>
              <div class="col-sm-8">
                <div class="row">
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
                  ?>
                  <div class="col-md-6">                    
                    <div class="checkbox">                      
                      <input type="checkbox" name="tutor_course[]" id="tu_course_<?php echo $course->tc_id; ?>" value="<?php echo $course->tc_id; ?>" onchange="checkAll(this, '<?php echo 'tutor_subject_'.$course->tc_id;?>')" <?php echo ($checked->flag == 'success' && $checked->data > 0) ? 'checked' : '';?> >
                      <label  class="custom"><?php echo $course->tc_title; ?></label>
                      <!-- for="tu_course_<?php echo $course->tc_id; ?>" -->
                      <a href="javascript: void(0);" class="toggleShowHide"><i class="fa fa-plus-square-o"></i></a>
                      <?php 
                      // Get Subjects
                      $getSubject = system::FireCurl(LIST_SUBJECT_URL.'?course_id='.$course->tc_id);
                      if ($getSubject->flag == 'success' && count($getSubject->data) > 0) {
                        $stl = 'style="display:';
                        $stl .= ($checked->flag == 'success' && $checked->data > 0) ? 'block' : 'none';
                        $stl .= '"';
                      ?>
                      <div class="showHide" style="display:none"<?php //echo $stl; ?>>
                       <div class="dropbox"><?php echo PLEASE_TICK_THE_SUBJECT; ?></div>
                       <div class="dropPop" <?php //echo $stl; ?>>
                          <div class="row">
                            <div class="col-md-12"><a href="javascript:void(0);" onclick="tickAll('tu_course_<?php echo $course->tc_id; ?>', '<?php echo 'tutor_subject_'.$course->tc_id;?>');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('tu_course_<?php echo $course->tc_id; ?>', '<?php echo 'tutor_subject_'.$course->tc_id;?>');">Untick All</a></div>
                            <?php 
                            foreach ($getSubject->data as $key => $subject) { 
                              // GET User Subject
                              $sub_chk = system::FireCurl(USER_SUBJECT_URL.'?user_id='.$user_id.'&subject_id='.$subject->ts_id);
                              
                            ?>
                            <div class="col-md-12">  
                               <input type="checkbox" name="tutor_subject_<?php echo $course->tc_id;?>[<?php echo $i; ?>]" id="tutor_subject_<?php echo $course->tc_id;?>_<?php echo $i; ?>" value="<?php echo $subject->ts_id;?>" data-pid="<?php echo $course->tc_id;?>" data-cname="tutor_subject_" data-pname="tu_course_" onchange="check_parent(this)" <?php echo ($sub_chk->data > 0) ? 'checked' : '';?>> 
                               <label for="tutor_subject_<?php echo $course->tc_id;?>_<?php echo $i; ?>" class="custom"><?php echo $subject->ts_title;?></label>
                            </div>
                            <?php $i++; } ?>                                      
                          </div>
                       </div>
                       <div class="row">
                        <div class="col-md-12">
                           <div class="checkbox">            
                              <input type="checkbox" name="subject_<?php echo $course->tc_id;?>" id="subject_<?php echo $course->tc_id;?>" value="1" onchange="toggleOther(this, 'other_subject_<?php echo $course->tc_id;?>', 'tu_course_<?php echo $course->tc_id; ?>')" <?php echo ($OtherCourse->flag == 'success' && $OtherCourse->data != '') ? 'checked' : '';?>>
                              <label for="subject_<?php echo $course->tc_id;?>"><?php echo SUBJECT_YOU_CAN_TEACH_OTHERS; ?> </label>
                           </div>
                        </div>
                        <div class="col-md-12" style="display: <?php echo ($OtherCourse->flag == 'success' && $OtherCourse->data != '') ? 'block' : 'none';?>;"
                        var_dump($sub_chk);>
                           <textarea class="form-control" name="other_subject_<?php echo $course->tc_id;?>" rows="3" style="resize:none;"><?php echo ($OtherCourse->flag == 'success' && $OtherCourse->data != '') ? $OtherCourse->data : '';?></textarea>
                        </div>
                      </div>
                    </div>
                    <?php 
                    }
                    ?>
                    </div>                                    
                  </div>
                  <?php 
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd">
              Your rate/hour (optional) <br>
              </label>
              <div class="col-sm-8">
                <textarea class="form-control" placeholder="Example: UPSR : RM35/hour, SPM : RM50/hour, IGCSE: RM70/hour. Leave empty if you are not sure" style="height: 90px;" name="ud_rate_per_hour" id="ud_rate_per_hour"><?php echo isset($user_info['ud_rate_per_hour']) ? $user_info['ud_rate_per_hour']: '';?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ud_qualification"><?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION; ?></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="ud_qualification" name="ud_qualification" value="<?php echo isset($user_info['ud_qualification']) ? $user_info['ud_qualification']: '';?>">
                <label class="box_text_1"><?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION_EXAMPLE; ?></label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ud_tutor_experience"><?php echo TUTORING_EXPERIENCE; ?></label>
              <div class="col-sm-8">
                <div class="row">
                  <div class="col-md-6 col-sm-7">
                    <input type="text" class="form-control" id="ud_tutor_experience" name="ud_tutor_experience" value="<?php echo isset($user_info['ud_tutor_experience']) ? $user_info['ud_tutor_experience']: '';?>">
                  </div>
                  <div class="col-md-6 col-sm-5">
                    <p class="box_text_3"> <?php echo YEAR; ?> </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo WILL_TEACH_AT_TUITION_CENTER; ?></label>
              <div class="col-sm-8 radio_font">
                <div class="row">
                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="tution_center" value="1" <?php echo (isset($user_info['ud_client_status']) && $user_info['ud_client_status'] == 'Tuition Centre') ? 'checked' : ''; ?>>
                      <?php echo YES; ?></label>
                  </div>
                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="tution_center" value="0" <?php echo (isset($user_info['ud_client_status']) && $user_info['ud_client_status'] != 'Tuition Centre') ? 'checked' : ''; ?>>
                      <?php echo NO; ?></label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="ud_about_yourself">
              <?php echo ABOUT_YOURSELF; ?> <br>
              <p class="box_text_2"><?php echo ABOUT_YOURSELF_MESSAGE; ?>*</p>
              </label>
              <div class="col-sm-8">
                <textarea class="form-control" style="height: 90px;" name="ud_about_yourself" id="ud_about_yourself"><?php echo isset($user_info['ud_about_yourself']) ? $user_info['ud_about_yourself']: '';?></textarea>
                <a href="javascript:void(0);" class="box_text_1 sample-tooltip" data-toggle="tooltip" data-html="true" data-placement="top" title="<small style='font-size: 10px;'><?php echo VIEW_SAMPLE_POPUP_TEXT; ?></small>"><?php echo VIEW_SAMPLE; ?></a>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4">
              <?php echo UPLOAD_PROFILE_PICTURE; ?> <br>
              <p class="box_text_2"><?php echo UPLOAD_PROFILE_PICTURE_MESSAGE; ?></p>
              </label>
              <div class="col-sm-8">
                <input type="file" name="u_profile_pic" id="file-7" class="inputfile inputfile-6" accept="image/*" style="display:none;">
                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php echo CHOOSE_A_FILE; ?></strong></label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4"></label>
              <div class="col-sm-8">
                <img src="<?php 
                if ($user_info['u_profile_pic'] != '') {
                  echo APP_ROOT.$user_info['u_profile_pic'];
                } elseif ($user_info['u_gender'] == 'M') {
                  echo APP_ROOT."images/tutor_ma.png";
                } else {
                  echo APP_ROOT."images/tutor_mi1.png";
                }
                ?>" alt="profile_pic" class="img-thumbnail" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4">
              <?php echo UPLOAD_TESTIMONIALS; ?> <br>
              <p class="box_text_2"><?php echo UPLOAD_TESTIMONIALS_MESSAGE1; ?><br>
                <br>
                <?php echo UPLOAD_TESTIMONIALS_MESSAGE2; ?></p>
              </label>
              <div class="col-sm-8">
              <?php 
              $image1 = $image2 = $image3 = $image4 = '';
              $getTestimonial = system::FireCurl(USER_TESTIMONIAL."?uid=".$user_id); 
               foreach ($getTestimonial->data as $key => $testimonial) {
                if($testimonial->ut_user_testimonial1 !='') $image1 = substr($testimonial->ut_user_testimonial1,6);
                else $image1 = '';
                if($testimonial->ut_user_testimonial2 !='') $image2 = substr($testimonial->ut_user_testimonial2,6);
                else $image2 = '';
                if($testimonial->ut_user_testimonial3 !='') $image3 = substr($testimonial->ut_user_testimonial3,6);
                else $image3 = '';
                if($testimonial->ut_user_testimonial4 !='') $image4 = substr($testimonial->ut_user_testimonial4,6);
                else $image4 = '';
              }
              ?>
                <input type="file" name="user_testimonial1" id="testimonial_1" class="inputfile inputfile-6" style="display:none;">
                <label for="testimonial_1"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php echo CHOOSE_A_FILE; ?></strong></label><div class="testid"><?=$image1;?></div>
                <input type="file" name="user_testimonial2" id="testimonial_2" class="inputfile inputfile-6" style="display:none;">
                <label for="testimonial_2"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php echo CHOOSE_A_FILE; ?></strong></label><div class="testid"><?=$image2;?></div>
                <input type="file" name="user_testimonial3" id="testimonial_3" class="inputfile inputfile-6" style="display:none;">
                <label for="testimonial_3"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php echo CHOOSE_A_FILE; ?></strong></label><div class="testid"><?=$image3;?></div>
                <input type="file" name="user_testimonial4" id="testimonial_4" class="inputfile inputfile-6" style="display:none;">
                <label for="testimonial_4"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php echo CHOOSE_A_FILE; ?></strong></label><div class="testid"><?=$image4;?></div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div id="testimonials">
                  <em><?php echo CLICK_IMAGE_TO_ENLARGE; ?></em><i class="fa fa-plus plus" aria-hidden="true"></i> <br>
                  <ul class="whatsapp">
                     <?php 
                      // Get Course
                      
                      if ($getTestimonial->flag == 'success' && count($getTestimonial->data) > 0) {
                        $i = 0;
                      foreach ($getTestimonial->data as $key => $testimonial) {
                          if($testimonial->ut_user_testimonial1 !=''){
                     ?>
                     <li style="width: 215px;"><img src="<?php echo $testimonial->ut_user_testimonial1; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                     <?php 
                         } if($testimonial->ut_user_testimonial2 !='') { ?>
                     <li style="width: 215px;"><img src="<?php echo $testimonial->ut_user_testimonial2; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                      <?php } if($testimonial->ut_user_testimonial3 !='') { ?>
                     <li style="width: 215px;"><img src="<?php echo $testimonial->ut_user_testimonial3; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li> 
                     <?php } if($testimonial->ut_user_testimonial4 !='') { ?>
                     <li style="width: 215px;"><img src="<?php echo $testimonial->ut_user_testimonial4; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                     <?php } }
                      }
                     ?>
                  </ul>
               </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-default"><?php echo BUTTON_SAVE; ?></button>
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

    function toggleOther(ele, id, parentid) {
      if (ele.checked) {
          $('#'+parentid).prop('checked', true);
          $('[name^="'+id+'"]').parent('.col-md-12').show();
      } else {
          $('#'+parentid).prop('checked', false);
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

    $(document).ready(function(){
      $('select[name=ud_current_occupation]').on('change', function(){
        if($(this).val() == 'Other') {
          $('input[name=ud_current_occupation_other]').show();
        } else {
          $('input[name=ud_current_occupation_other]').hide();
        }
      });

      $('.sample-tooltip').tooltip({
          content: function () {
              return $(this).prop('title');
          }
      });

      $('.toggleShowHide').click(function(){
        $(this).parent('.checkbox').find('.showHide').toggle();
        $(this).parent('.checkbox').find('.dropPop').toggle();
        $(this).find('.fa').toggleClass( 'fa-plus-square-o fa-minus-square-o' );
      });

      function raceOther() {
        var v = $('input[name=ud_race]:checked').val();
        if (v == 'Others') {
           $('#other_race_wrap').html('<textarea name="ud_race" class="form-control"></textarea>');
        } else {
           $('#other_race_wrap').html('');
        }
      }

      $('.udradio').on('click', function(){
        var ele = $(this).find('input[type=radio]').attr('name');
        if(ele == 'ud_race'){
           raceOther();
        }

        if(ele == 'ud_nationality'){
           nationalityOther();
        }
        
      });
    });
</script>