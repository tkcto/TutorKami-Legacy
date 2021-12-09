<?php 
require_once('includes/head.php');
//require_once('includes/compress-image.php');
require_once('includes/create-thumb.php');
require_once('includes/create-thumb2.php');

define('IMAGE_SMALL_DIR', 'images/profile/small/');
define('IMAGE_SMALL_SIZE', 50);
define('IMAGE_MEDIUM_DIR', 'images/profile/');
define('IMAGE_MEDIUM_SIZE', 250);

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


    $path_parts = pathinfo($_FILES['u_profile_pic']['name']);

    $imagenumber = rand(5000,10000);
    $namaFile = date("Ymd-His")."-".$data['u_email'];

    
	/*	
      if($_FILES['u_profile_pic']['size'] <= 512000){

        if(in_array($imgext, $extension)){

		  move_uploaded_file($tmpname, "images/profile/000".$imagenumber.'_0.jpg');
          $picture_path = $imagenumber;//luqman buat so nnti image save sbagai number.sbb manfred dh set sume image read sbgai number

        } else{

          $error++;
          Session::SetFlushMsg("error",'File you tried to upload is not an image. You can\'t upload this file.');

        }

      } else {

        if(in_array($imgext, $extension)){

          $path = "images/profile/";
          $actual_image_name = '000'.$imagenumber.'_0.jpg';
          compressImage($imgext,$tmpname,$path,$actual_image_name,'200');
          $picture_path = $imagenumber;//luqman buat so nnti image save sbagai number.sbb manfred dh set sume image read sbgai number

        } else{

          $error++;
          Session::SetFlushMsg("error",'File you tried to upload is not an image. You can\'t upload this file.');

        }

      }    */
if(!empty($name) || $name != ''){
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	  
	if ($_FILES['u_profile_pic']["error"] > 0) {
		$error++;
		Session::SetFlushMsg("error",'Error in File');
	}
	else if (!in_array($_FILES['u_profile_pic']["type"], $allowedImageType)) {
		$error++;
		Session::SetFlushMsg("error",'You can only upload JPG, PNG and GIF file');
	}
	/*else if (round($_FILES['u_profile_pic']["size"] / 1024) > 1096) {
		$error++;
		Session::SetFlushMsg("error",'You can only upload photo with size up to 1MB');
	}*/ else {
		/*create directory with 777 permission if not exist - start*/
		//createDir(IMAGE_SMALL_DIR);
		createDir(IMAGE_MEDIUM_DIR);
		/*create directory with 777 permission if not exist - end*/
		$path[0] = $_FILES['u_profile_pic']['tmp_name'];
		$file = pathinfo($_FILES['u_profile_pic']['name']);
		$fileType = $file["extension"];
		$desiredExt='jpg';
		//$fileNameNew = "000".$imagenumber.'_0.jpg';
		$fileNameNew = $namaFile.'.jpg';
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
		
		//createThumb($path[0], $path[1], $fileType, IMAGE_MEDIUM_SIZE, IMAGE_MEDIUM_SIZE,IMAGE_MEDIUM_SIZE);
		// https://salman-w.blogspot.com/2008/10/resize-images-using-phpgd-library.html
        process_image_upload('u_profile_pic', $namaFile);
		//createThumb($path[1], $path[2],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE);
		$picture_path = $namaFile;
	}
}


  }





  if ($error == 0) {


    


    $data['u_profile_pic'] = isset($picture_path) ? $picture_path : '';


    $data['ud_dob'] = implode('-', array_reverse($_POST['ud_dob']));


    


    $output = system::FireCurl(REGISTRATION_URL, "POST", "JSON", $data);


    // var_dump($output->flag);die;//NULL bila success tapi data masuk db

 // if ($output->flag != 'error') {//ni kua mesej kt bawah ni
    if ($output->flag == 'success') {
        header('Location: registration-success.php');
        Session::SetFlushMsg($output->flag, $output->message);
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




::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    font-size: 13px;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    font-size: 13px;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    font-size: 13px;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
    font-size: 13px;
}

    .input-group-addon,
    .input-group-addon + input {
       border: none;
       background-color:transparent;
       color:transparent;
    }
    
.select2-results__option { 
  font-size: 15px;
}

.select2-selection__arrow b{
    display:none !important;
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


          <?php echo REGISTER_CONTACT_US_PHONE; ?> </p>


        <div class="col-md-10 mrg_top30">


          <form class="form-horizontal" method="post" enctype="multipart/form-data" id="registration-form">

<!-- luqman -->
            <div class="form-group hidden">


              <label class="control-label col-sm-4" for="pwd"><?php echo USERNAME; ?>*</label>


              <div class="col-sm-8">


                <input type="hidden" class="form-control" name="u_username" id="u_username" value="<?php echo isset($_POST['u_username']) ? $_POST['u_username']: time();?>">


              </div>


            </div>
<!-- luqman -->

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


                <input type="text" class="form-control" placeholder="<?php echo DISPLAY_NAME_EXAMPLE; ?>" id="u_displayname" name="u_displayname" value="<?php echo isset($_POST['u_displayname']) ? $_POST['u_displayname']: '';?>" data-rule-required="true" data-msg-required="- Display name is required.">


                <!--<label class="box_text_1"><?php //echo DISPLAY_NAME_EXAMPLE; ?></label>-->


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

<?php
		/*$ipAddress = $_SERVER['REMOTE_ADDR'];
		$resultIpAddress = json_decode(file_get_contents("http://ipinfo.io/{$ipAddress}/json"));
		$dataIpAddress = $resultIpAddress->ip." - C : ".$resultIpAddress->country." - R : ".$resultIpAddress->region." - CT : ".$resultIpAddress->city;*/
		
		
   if (getenv('HTTP_X_FORWARDED_FOR')) {
       $pipaddress = getenv('HTTP_X_FORWARDED_FOR');
       $ipaddress = getenv('REMOTE_ADDR'); 
       $dataIpAddress = "Proxy IP : ".$pipaddress. "(via $ipaddress)" ; 
   }else { 
       $ipaddress = getenv('REMOTE_ADDR'); 
       $dataIpAddress = "$ipaddress"; 
   }
		

?>
<input type="hidden" class="form-control" id="ip_address" name="ip_address" value="<?php echo $dataIpAddress;?>">


            <!--<div class="form-group">


              <label class="control-label col-sm-4" for="udcity"><?php //echo YOUR_LOCATION; ?>*</label>


              <div class="col-sm-5">


                <textarea name="ud_city" id="ud_city" class="form-control" data-rule-required="true" data-msg-required="- Location information is required."><?php //echo isset($_POST['ud_city']) ? $_POST['ud_city']: '';?></textarea>


                <label class="box_text_1"><?php //echo YOUR_LOCATION_EXAMPLE; ?></label>


              </div>


              <div class="col-sm-3 form_error">Error</div>


            </div>-->
            
            
            
            
            <div class="form-group">
              <label class="control-label col-sm-4"><?php echo 'The location you are currently staying in'; ?>*</label>
                <div class="col-sm-4">
                    <!--<select class="form-control" name="search_ud_state" id="search_ud_state" data-rule-required="true" data-msg-required="- required.">
                    <option value="">Please Select State</option>
                    <?php 
                    /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                    if ($dbCon->connect_error) {
                        die("Connection failed: " . $dbCon->connect_error);
                    } 
                    $queryState = "SELECT * FROM tk_states ORDER BY st_name ASC"; 
                    $resultState = $dbCon->query($queryState); 
                    if($resultState->num_rows > 0){ 
                        while($rowState = $resultState->fetch_assoc()){
                            $sel = (isset($user_info['ud_state']) && $user_info['ud_state'] == $rowState['st_id']) ? 'selected' : (($user_info['ud_state'] == $rowState['st_id']) ? 'selected' : '' );
                            echo '<option value="'. $rowState['st_id'] .'" '.$sel.'>'. $rowState['st_name'] .'</option>';
                        }
                    }*/
                    ?>
                    </select>-->
                    <!--<select class="js-example-basic-single" name="search_ud_state" id="search_ud_state" style="width: 100%"  data-rule-required="true" data-msg-required="- required.">
                    <option value="">Please Select State</option>
                    <?php 
                    /*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                    if ($dbCon->connect_error) {
                        die("Connection failed: " . $dbCon->connect_error);
                    } 
                    $queryState = "SELECT * FROM tk_states ORDER BY st_name ASC"; 
                    $resultState = $dbCon->query($queryState); 
                    if($resultState->num_rows > 0){ 
                        while($rowState = $resultState->fetch_assoc()){
                            $sel = (isset($user_info['ud_state']) && $user_info['ud_state'] == $rowState['st_id']) ? 'selected' : (($user_info['ud_state'] == $rowState['st_id']) ? 'selected' : '' );
                            echo '<option value="'. $rowState['st_id'] .'" '.$sel.'>'. $rowState['st_name'] .'</option>';
                        }
                    }*/
                    ?>
                    </select>-->
                                            <select class="js-example-basic-single" name="search_ud_city" id="search_ud_city" style="width: 100%"  data-rule-required="true" data-msg-required="- The City you are currently staying in is required.">
                                            <option value="">Please Select State</option>
										   <?php 
											 $conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
											 if ($conn->connect_error) {
											    die("Connection failed: " . $conn->connect_error);
											 }
											 $queryDataState = " SELECT * FROM tk_states ORDER BY st_name ASC ";
											 $rowDataState = $conn->query($queryDataState);
											 if ($rowDataState->num_rows > 0) {
												while($resultDataState= $rowDataState->fetch_assoc()){
													echo '<optgroup label="'. $resultDataState['st_name'] .'">';
													
														 $queryDataCity = " SELECT * FROM tk_cities WHERE city_status='1' AND city_st_id = '".$resultDataState['st_id']."' ORDER BY city_name ASC ";
														 $rowDataCity = $conn->query($queryDataCity);
														 if ($rowDataCity->num_rows > 0) {
															while($resultDataCity = $rowDataCity->fetch_assoc()){
																echo '<option value="'. $resultDataCity['city_id'] .'">'. $resultDataCity['city_name'] .'</option>';
															}			
														 }
													
													echo '</optgroup>';
												}			
											 }
										   ?>
                                       </select><label class="box_text_1"><font color="#262262"><?php echo YOUR_LOCATION_EXAMPLE; ?></font></label>
                    
                    
                    
                    
                    
                </div>
                <div class="col-sm-4">
                    
                    <div id="search_ud_stateText" name="search_ud_stateText"></div>
                                       
                    <!--<select class="form-control" name="search_ud_city" id="search_ud_city" data-rule-required="true" data-msg-required="- The City you are currently staying in is required.">
                        <?PHP
                        /*if(isset($user_info['ud_state']) && $user_info['ud_state'] != ''){
                            $queryCity = "SELECT * FROM tk_cities WHERE city_st_id = '".$user_info['ud_state']."' ORDER BY city_name ASC"; 
                            $resultCity = $dbCon->query($queryCity); 
                            if($resultCity->num_rows > 0){ 
                                while($rowCity = $resultCity->fetch_assoc()){
                                    $sel2 = (isset($user_info['ud_city']) && $user_info['ud_city'] == $rowCity['city_id']) ? 'selected' : (($user_info['ud_city'] == $rowCity['city_id']) ? 'selected' : '' );
                                    echo '<option value="'. $rowCity['city_id'] .'" '.$sel2.'>'. $rowCity['city_name'] .'</option>';
                                }
                            }                            
                        }*/
                        ?>
                    </select><label class="box_text_1"><font color="#262262"><?php //echo YOUR_LOCATION_EXAMPLE; ?></font></label>-->
                    
                    <!--<select class="js-example-basic-single" name="search_ud_city" id="search_ud_city" style="width: 100%"  data-rule-required="true" data-msg-required="- The City you are currently staying in is required.">
                        <?PHP
                        /*if(isset($user_info['ud_state']) && $user_info['ud_state'] != ''){
                            $queryCity = "SELECT * FROM tk_cities WHERE city_st_id = '".$user_info['ud_state']."' ORDER BY city_name ASC"; 
                            $resultCity = $dbCon->query($queryCity); 
                            if($resultCity->num_rows > 0){ 
                                while($rowCity = $resultCity->fetch_assoc()){
                                    $sel2 = (isset($user_info['ud_city']) && $user_info['ud_city'] == $rowCity['city_id']) ? 'selected' : (($user_info['ud_city'] == $rowCity['city_id']) ? 'selected' : '' );
                                    echo '<option value="'. $rowCity['city_id'] .'" '.$sel2.'>'. $rowCity['city_name'] .'</option>';
                                }
                            }                            
                        }*/
                        ?>
                    </select>-->
                    
                    
                </div>
                <div class="col-sm-3 form_error">Error</div>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd"><?php echo CONDUCT_ONLINE; ?>*
              <br/><a href="https://www.tutorkami.com/tuition/kelas-online-part-1/" target="_blank" class="box_text_2 sample-tooltip"><font color="blue" style="text-decoration: underline;"><?php echo 'Click here to learn how you can start online tutoring'; ?></font></a>
              </label>
              <div class="col-sm-8 radio_font">
                <div class="row">
                  <div class="col-md-6">
                    <label class="radio-inline udradio2" style="font-size:15px;">
                      <input type="radio" name="conduct_online" value="Yes" <?php echo isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'Yes' ? 'checked' : (!isset($_POST['conduct_online']) ? '' : '');?> data-rule-required="true" data-msg-required="- Conduct Online is required.">
                      <?php echo YES; ?></label>
                  </div>

                  <div class="col-md-6">
                    <label class="radio-inline udradio2" style="font-size:15px;">
                      <input type="radio" name="conduct_online" value="No" <?php echo isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'No' ? 'checked' : '';?>>
                      <?php echo NO; ?></label>
                  </div>
                </div>
                <!--<div class="notice"><?PHP //if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo ""; }else{ echo "If you tick Yes, please specify in ‘About Yourself’ section what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc"; }?></div>-->
                <div id="conduct_online_wrap">

                   <?php 

                   if ( isset($_POST['conduct_online']) && $_POST['conduct_online'] == 'Yes' ) {

                      echo '<textarea style="height:70px;" placeholder="Please state what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc" name="conduct_online_text" class="form-control">'.$_POST['conduct_online_text'].'</textarea>';

                   }  
                   ?>

                </div>
              </div>
               <div class="col-sm-3 form_error">Error</div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd"><?php echo CONDUCT_CLASS; ?>*</label>
              <div class="col-sm-8 radio_font">
                <div class="row">
                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="conduct_class" value="Yes" <?php echo isset($_POST['conduct_class']) && $_POST['conduct_class'] == 'Yes' ? 'checked' : (!isset($_POST['conduct_class']) ? '' : '');?> data-rule-required="true" data-msg-required="- Conduct class is required.">
                      <?php echo YES; ?></label>
                  </div>

                  <div class="col-md-6">
                    <label class="radio-inline" style="font-size:15px;">
                      <input type="radio" name="conduct_class" value="No" <?php echo isset($_POST['conduct_class']) && $_POST['conduct_class'] == 'No' ? 'checked' : '';?>>
                      <?php echo NO; ?></label>
                  </div>
                </div>
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

<input type="hidden" name="clickornot<?php echo $state->st_id; ?>" id="clickornot<?php echo $state->st_id; ?>" value="clickornot<?php echo $state->st_id; ?>">
                         <input type="checkbox" name="cover_area_state[]" id="ca_state_<?php echo $state->st_id; ?>" value="<?php echo $state->st_id; ?>" onchange="checkAll(this, '<?php echo 'cover_area_city_'.$state->st_id;?>')" <?php echo isset($_POST['cover_area_state']) && (in_array($state->st_id, $_POST['cover_area_state'])) ? 'checked':'';?>>


                         <!--<label for="ca_state_<?php echo $state->st_id; ?>" class="custom"><?php echo $state->st_name; ?></label>-->
                         <label  id="ca_state_<?php echo $state->st_id; ?>" class="custom" value="<?php echo $state->st_id; ?>" onClick="myFunction(this, '<?php echo 'cover_area_city_'.$state->st_id;?>', '<?php echo $state->st_id;?>')" ><?php echo $state->st_name; ?></label>

<!-- sini problem -->
                        <?php 


                        // Get City By State Id


                        $getStateWiseCity = system::FireCurl(LIST_CITY_URL.'?state_id='.$state->st_id);


                        if ($getStateWiseCity->flag == 'success' && count($getStateWiseCity->data) > 0) {//5


                        ?>

<!-- sini problem -->
                        <div class="showHide" style="display: <?php echo isset($_POST['cover_area_state']) && (in_array($state->st_id, $_POST['cover_area_state'])) ? 'block':'none';?>;">


                           <!--<div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>-->


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


                           <div class="row hidden">


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
					
array_multisort(array_column($getCourse->data, "sort_by"), SORT_ASC, $getCourse->data); 
                    foreach ($getCourse->data as $key => $course) {
                  ?>
                  <div class="col-md-6">                    
                    <div class="checkbox">  
<input type="hidden" name="clickornottwo<?php echo $course->tc_id; ?>" id="clickornottwo<?php echo $course->tc_id; ?>" value="clickornottwo<?php echo $course->tc_id; ?>">
                      <input type="checkbox" name="tutor_course[]" id="tu_course_<?php echo $course->tc_id; ?>" value="<?php echo $course->tc_id; ?>" onchange="checkAll(this, '<?php echo 'tutor_subject_'.$course->tc_id;?>')" <?php echo isset($_POST['tutor_course']) && (in_array($course->tc_id, $_POST['tutor_course'])) ? 'checked':'';?>>
                      <!--<label for="tu_course_<?php echo $course->tc_id; ?>" class="custom"><?php echo $course->tc_title; ?></label>-->
<label id="tu_course_<?php echo $course->tc_id; ?>" class="custom" value="<?php echo $course->tc_id; ?>" onClick="myFunction2(this, '<?php echo 'tutor_subject_'.$course->tc_id;?>', '<?php echo $course->tc_id;?>')" ><?php echo $course->tc_title; ?></label>

					  <div class="showHide" style="display: <?php echo isset($_POST['tutor_course']) && (in_array($course->tc_id, $_POST['tutor_course'])) ? 'block':'none';?>;">
                       <!--<div class="dropbox"><?php echo PLEASE_TICK_THE_SUBJECT; ?></div>-->
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


                       <div class="row hidden">


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
<!--fadhli -->
            <div class="form-group">
              <label class="control-label col-sm-4" for="pwd"><?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Boleh anda mengajar pelajar kurang upaya?"; }else{ echo "Can you teach student with learning disability?"; }?></label>
              <div class="col-sm-8 radio_font">
                <div class="row">
                  <div class="col-md-6">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="student_disability" value="Yes">
                      <?php echo YES; ?></label>
                  </div>
                  <div class="col-md-6">
                    <label class="radio-inline udradio" style="font-size:15px;">
                      <input type="radio" name="student_disability" value="No" checked>
                      <?php echo NO; ?></label>
                  </div>
                </div>
                <!--<div class="notice"><?PHP //if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Jika anda tandakan Ya, sila sebutkan di seksyen 'Mengenai Diri Anda'. Seperti Dyslexia, ADHD, Autism dan lain-lain."; }else{ echo "If you tick Yes, please mention in ‘About Yourself’ section the types you can attend to e.g Dyslexia, ADHD, Autism etcs"; }?></div>-->
                <div id="student_disability_wrap">

                   <?php 

                   if ( isset($_POST['student_disability']) && $_POST['student_disability'] == 'Yes' ) {

                      echo '<textarea style="height:70px;" placeholder="Please state the type of disabilities you can attend to e.g Dyslexia, ADHD, Autism etcs" name="student_disability_text" class="form-control">'.$_POST['student_disability_text'].'</textarea>';

                   }  
                   
                   ?>

                </div>
              </div>
            </div>


         <div class="hidden form-group">


              <label class="control-label col-sm-4" for="pwd">


              <?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Kadar/jam"; }else{ echo "Your rate/hour"; }?>
			  <br>


              </label>


              <div class="col-sm-8">


                <textarea class="form-control" placeholder="<?PHP if(isset($_SESSION['lang_code']) && ($_SESSION['lang_code'] == 'BM')){ echo "Contoh: UPSR: RM35 / jam, SPM: RM50 / jam, IGCSE: RM70 / jam. Tinggalkan kosong jika anda tidak pasti"; }else{ echo "Example: UPSR: RMXX/hour, SPM: RMXX/hour, IGCSE: RMXX/hour.\n\nIf you can conduct class at your house or place and offer a lower rate, please mention your rate here too. Example : Rate teaching at my house: UPSR: RMXX/hour”"; }?>" style="height: 90px;" name="ud_rate_per_hour" id="ud_rate_per_hour"><?php echo (isset($_POST['ud_rate_per_hour']) && $_POST['ud_rate_per_hour'] != '') ? $_POST['ud_rate_per_hour']:'';?></textarea>


              </div>


            </div>

            <div class="form-group">


              <label class="control-label col-sm-4" for="pwd"><?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION; ?></label>


              <div class="col-sm-8">


                <input type="text" class="form-control" placeholder="<?php echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION_EXAMPLE; ?>" id="ud_qualification" name="ud_qualification" value="<?php echo (isset($_POST['ud_qualification']) && $_POST['ud_qualification'] != '') ? $_POST['ud_qualification']:'';?>">


                <!--<label class="box_text_1"><?php //echo HIGHEST_QUALIFICATION_NAME_OF_INSTITUTION_EXAMPLE; ?></label>-->


              </div>


            </div>


            <div class="form-group">


              <label class="control-label col-xs-4" ><?php echo TUTORING_EXPERIENCE; ?>* </label>


              <div class="col-xs-8 form-inline">


           


    		<div class="input-group">
    			<input style="width: 50px;" onkeypress="return isNumberKey(event)" maxlength="2" type="text" class="form-control" id="ud_tutor_experience" name="ud_tutor_experience" value="<?php echo (isset($_POST['ud_tutor_experience']) && $_POST['ud_tutor_experience'] != '') ? $_POST['ud_tutor_experience']:'';?>" data-rule-required="true" data-msg-required="">
    			<span class="input-group-addon"></span>
                    <!--<p class="box_text_3"> <?php //echo YEAR; ?> </p>-->
                    <select class="form-control" name="experienceMonth" id="experienceMonth" data-rule-required="true" data-msg-required="- Experience is required." style="">
                    <option value="">Please Choose</option>
                    <option value="year">Year(s)</option>
                    <option value="month">Month(s)</option>
                    </select>
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


                <!--<a href="javascript:void(0);" class="box_text_1 sample-tooltip" data-toggle="tooltip" data-html="true" data-placement="top" title="<small style='font-size: 10px;'><?php echo VIEW_SAMPLE_POPUP_TEXT; ?></small>"><?php echo VIEW_SAMPLE; ?></a>-->
                <a href="https://www.tutorkami.com/tuition/guide-tips-about-yourself/" target="_blank" class="box_text_2 sample-tooltip"><font color="blue" style="text-decoration: underline;"><?php echo VIEW_SAMPLE; ?></font></a>


              </div>


            </div>

<style>
.fileUpload {
    position: relative;
    overflow: hidden;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    /*font-size: 20px;*/
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}

</style>
<script>
$(document).on('change','.up', function(e){
		   	var names = [];
		   	var length = $(this).get(0).files.length;
			    for (var i = 0; i < $(this).get(0).files.length; ++i) {
			        names.push($(this).get(0).files[i].name);
			    }
			    // $("input[name=file]").val(names);
				if(length>2){
				  var fileName = names.join(', ');
				  $(this).closest('.form-group').find('.form-control').attr("value",length+" files selected");
  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
    document.getElementById("previewpopup").src = e.target.result;
      $('#myModalImg').modal('show');
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
				}
				else{
					$(this).closest('.form-group').find('.form-control').attr("value",names);
  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
    document.getElementById("previewpopup").src = e.target.result;
      $('#myModalImg').modal('show');
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
				}
	   });

function doneButton() {
	$('#myModalImg').modal('hide');
	var element = document.getElementById("preview");
	element.classList.remove("hidden");
}
function changeButton() {
	$('#myModalImg').modal('hide');
	$('#up').click(); 
}
function clickInput() {
	var element = document.getElementById("preview");
	element.classList.add("hidden");
}

</script>

<div id="myModalImg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <center><img id="previewpopup" class="img-thumbnail"></center>
			<center><button type="button" class="btn btn-success" onClick="doneButton()">Done</button> <button type="button" class="btn btn-danger" onClick="changeButton()">Change</button></center>
        </div>
    </div>
  </div>
</div>
           <div class="form-group">
		   
              <label class="control-label col-sm-4" for="pwd"><?php echo UPLOAD_PROFILE_PICTURE; ?><br>
                <p class="box_text_2"><?php //echo UPLOAD_PROFILE_PICTURE_MESSAGE; ?></p>
              </label>


             <div class="col-sm-8">
                <!--<input type="file" name="u_profile_pic" id="file-7" class="inputfile inputfile-6" accept="image/*" style="display:none;">
                <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <?php //echo CHOOSE_A_FILE; ?></strong></label>
                -->
<div class="input-group">
  <input type="text" class="form-control" readonly>
 <div class="input-group-btn">
  <span class="fileUpload btn btn-default">
      <span class="upl" id="upload"><?php echo CHOOSE_A_FILE; ?></span>
      <input onClick="clickInput()" name="u_profile_pic" type="file" class="upload up" id="up" onchange="readURL(this);" />
    </span>
 </div>
 </div>

  <img src="https://placehold.it/80x80" id="preview" class="hidden img-thumbnail">

				<div class="notice"><?php echo REGISTER_UPLOAD_PROFILE_PIC_MESSAGE; ?></div>              
              </div>

            </div>


              <div class="form-group">


              <div class="col-md-12">


              <div class="checkbox">


              


              <input type="checkbox" value="1" name="agreement" id="agreement" data-rule-required="true" data-msg-required="- Before continuing, you’ll need to agree to our terms.">


              <label style="font-size:13px; color:#F1951F;" for="agreement"><?php echo REGISTER_AGREEMENT; ?> 
			  <?PHP
			  $getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
			  if($getLan == "/my/"){	
			  ?>
				<a href="https://www.tutorkami.com/my/terms_condition" target="_blank" class="sky-txt">Terma & Syarat</a>
			  <?PHP
			  }else{
			  ?>
				<a href="https://www.tutorkami.com/terms_condition" target="_blank" class="sky-txt">Terms & Conditions</a>
			  <?PHP
			  }
			  ?>
			  </label>


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


<?php //include('includes/footer.php');?>

<!-- START FOOTER -->
<style>
.gsc-control-cse
{
	padding:0px !important;
	border-width:0px !important;
}

form.gsc-search-box,table.gsc-search-box
{
	margin-bottom:0px !important;
}

.gsc-search-box .gsc-input
{
	padding:0px 4px 0px 6px !important;
}

#gsc-iw-id1
{
	border-width: 0px !important;
	height: auto !important;
	box-shadow:none !important;
}

#gs_tti50
{
	padding:0px !important;
}

#gsc-i-id1
{
	height:33px !important;
	padding:0px !important;
	background:none !important;
	text-indent:0px !important;
}

.gsib_b
{
	display:none;
}

button.gsc-search-button
{
        display:block;
        width:13px !important;
        height:13px !important;
        border-width:0px !important;
        margin:0px !important;
        padding: 10px 6px 10px 13px !important;
        outline:none;
        cursor:pointer;
        box-shadow:none !important;
        box-sizing: content-box !important;
}

.gsc-branding
{
	display:none !important;
}

.gsc-control-cse,#gsc-iw-id1
{
	background-color:transparent !important;
}


#search-box
{
	width:300px;
	height: 37px;
	margin:0 auto;
	background-color: #FFF;
	/*padding: 3px;*/
	border: 2px solid #000;
	border-radius: 4px;
}

#gsc-i-id1
{
	color:#000;
}

button.gsc-search-button
{
	padding:10px !important;
	background-color: #f1592a !important;
	border-radius: 3px !important;
}/**/
</style>
<footer <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'parent_login.php' || basename($_SERVER['PHP_SELF']) == 'forgot_password.php') ? 'class="hidden"' : '' ;?>>

   <section class="addr">

      <div class="container">

         <div class="row">

            <div class="col-md-5 col-sm-6 col-md-push-1">

               <h3><?php echo FOLLOW_US_ON_SOCIAL_MEDIA; ?> :</h3>

               <ul class="footer_followus">

                

                <?php // Get Social

                   $arrSocial = system::FireCurl(LIST_SOCIAL_URL);

                   

                   foreach($arrSocial->data as $social){

                     $post_id = $social->ID;

                   ?>

                  <li><a href="<?=$social->media_url?>"><i class="fa <?=$social->icon_name?>" aria-hidden="true"></i></a></li>

                  <?php } ?>

                </ul>

               <ul class="addr_list">

                <?php // Get Social

                  if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_CONTACT_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_CONTACT_URL);

                  }

                  $arrContact = system::FireCurl($lang_url);

                

                   

                   foreach($arrContact->data as $contact){

                     $post_id = $contact->ID;

                   ?>

                  <li><?=$contact->office_address?>

                  </li>

                  <li><?=$contact->phoneno?></li>

                  <li><?=$contact->emailid?></li>

                  <?php } ?>

               </ul>

            </div>

            <div class="col-md-2 col-sm-2">

               <h3><?php echo SITE_NAVIGATION; ?></h3>

               <ul class="nl">

                 <?php // Get Site Navigation

                 if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang){                 

                    $lang_url = str_replace('{lang}/', '', LIST_NAV_URL);

                  }

                  elseif($_SESSION['lang_code']=='BM'){
                    ?>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="https://www.tutorkami.com/blog/">Berita Terkini</a></li>
                    <li><a href="https://www.tutorkami.com/my/about.php">Tentang Kami</a></li>
                    <li><a href="https://www.tutorkami.com/my/tutor.php">Saya Tutor</a></li>
                    <li><a href="https://www.tutorkami.com/my/tips_for_parent.php">Tips untuk ibubapa</a></li>
                    <li><a href="https://www.tutorkami.com/login.php">Log Masuk</a></li>
                    <?php
                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_NAV_URL);

                  }

                 

                    $arrNav = system::FireCurl($lang_url);

                    $k=1;

                   foreach($arrNav->data as $nav){

                   ?>

                  <li><a href="<?=$nav->url?>" <?php if($k==1) {?> class="active" <?php } ?>><?=$nav->title?></a></li>

                  <?php $k++; } ?>

               </ul>

            </div>

            <div class="col-md-4 col-sm-4">

               <h3><?php echo SEARCH_THIS_SITE; ?></h3>

               <ul class="nl">

                  <?php // Get Site Navigation

                   $arrSearch = system::FireCurl(LIST_SEARCH_URL);

                    

                   foreach($arrSearch->data as $search){

                     //echo $search->content;

                   }

                  ?>
				<!--  
<script>
  (function() {
    var cx = '012605317305899767437:wmbhz60c7bk';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>-->
<div id="search-box">
   <!--<script>
     (function() {
	   var cx = '012605317305899767437:wmbhz60c7bk';
	   var gcse = document.createElement("script");
	   gcse.type = "text/javascript";
	   gcse.async = true;
	   gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
	   var s = document.getElementsByTagName("script")[0];
	   s.parentNode.insertBefore(gcse, s);
     })();
     window.onload = function()
     { 
	   var searchBox =  document.getElementById("gsc-i-id1");
	   searchBox.placeholder="Google Custom Search";
	   searchBox.title="Google Custom Search"; 
     }
   </script>-->
   <gcse:search></gcse:search>
</div>



                  <?php // Get Site Navigation

                  if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_TERM_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_TERM_URL);

                  }

                  

                  $arrNav1 = system::FireCurl($lang_url);

                   foreach($arrNav1->data as $nav1){

                   ?>

                  <li><a href="<?=$nav1->url?>"><?=$nav1->title?></a></li>

                  <?php } ?>

               </ul>

            </div>

         </div>

      </div>

   </section>

   <section class="copyright">

      <div class="container">

         <div class="row">

            <div class="col-md-12">



            <?php // Get Site Navigation

                /* if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang || $_SESSION['lang_code']=='BM'){                 

                    $lang_url = str_replace('{lang}/', '', LIST_COPYRIGHT_URL);

                  }

                  else{

                    $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_COPYRIGHT_URL);

                  }

                 

                   $arrCopyright = system::FireCurl($lang_url);

                 

                    

                   foreach($arrCopyright->data as $copy){

                     echo $copy->content;

                   }*/
                  ?>
				  
				  Copyright &copy; <?php $fromYear = 2013; 
										 $thisYear = (int)date('Y'); 
										echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : ''); ?> Tutorkami. All Rights Reserved.

               </div>

         </div>

      </div>

   </section>

</footer>

     
<!--
<div id="toast-container" class="toast-top-right" aria-live="polite" role="alert">

   <?php 

   //if( isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != '' ) {

      //$flash = Session::ReadFlushMsg();?>

   <div id="sticky-container" class="toast toast-<?php //echo $flash['msg_type']; ?>" style="">

      <div id="alert_progress_bar" class="toast-progress" style="width: 100%;"></div>

      <button type="button" class="toast-close-button" role="button">×</button>

      <script>hideErrDiv('sticky-container', 'alert_progress_bar');</script>

      <div class="toast-message"><?php //echo $flash['msg_text'];?></div>

   </div>

   <?php //} ?>     

</div>-->


<?php 
if( isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != '' ) {
    $flash = Session::ReadFlushMsg();
?>
<script>$(document).ready(function(){ $('#myModalFlash').modal('show'); });</script>
<?PHP
}
?>

    <div id="myModalFlash" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body" style="background-color:#f1592a;">
          <font style="color:white;">
          <center><?php echo $flash['msg_text'];?><br><button type="button" class="btn btn-primary btn-xs closeMyModalFlash"> OK </button></center>
          </font>
        </div>
      </div>
      
    </div>
  </div>

<!-- Load Facebook SDK for JavaScript -->
<!--<style>
.fb_customer_chat_bounce_out_v2 {
    display: none;
}
</style>--><!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v3.2'
    });
  };
/*
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  //js.src = 'xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/
setTimeout( function () {
   (function(d,s,id){
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
          //js.src = 'xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
      }
      (document, "script", "facebook-jssdk")
   );
   
   
     (function() {
	   var cx = '012605317305899767437:wmbhz60c7bk';
	   var gcse = document.createElement("script");
	   gcse.type = "text/javascript";
	   gcse.async = true;
	   gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
	   var s = document.getElementsByTagName("script")[0];
	   s.parentNode.insertBefore(gcse, s);
     })();
     window.onload = function()
     { 
	   var searchBox =  document.getElementById("gsc-i-id1");
	   searchBox.placeholder="Google Custom Search";
	   searchBox.title="Google Custom Search"; 
     }
   
   
   
}, 3000);
</script>

<!-- Your customer chat code 193594130789161 -->
<div class="fb-customerchat" attribution=setup_tool page_id="193594130789161" greeting_dialog_display="hide" theme_color="#f1592a"> </div>

</body>

</html>
<!-- END FOOTER -->


<script type="text/javascript">

function myFunction(ele, id, realid) {
	var clickornot = document.getElementById("clickornot"+realid).value;
	/*alert(clickornot);*/
	if(clickornot == "click"){
		document.getElementById("clickornot"+realid).value="";
		$('[name^="'+id+'"]').parents('.showHide').hide();
		$(ele).parent('.checkbox').find('.dropPop').hide();
	}else{
		document.getElementById("clickornot"+realid).value="click";
		$('[name^="'+id+'"]').parents('.showHide').show();
		$(ele).parent('.checkbox').find('.dropPop').show();		
	}
}
function myFunction2(ele, id, realid) {
	var clickornot = document.getElementById("clickornottwo"+realid).value;
	if(clickornot == "click"){
		document.getElementById("clickornottwo"+realid).value="";
		$('[name^="'+id+'"]').parents('.showHide').hide();
		$(ele).parent('.checkbox').find('.dropPop').hide();
	}else{
		document.getElementById("clickornottwo"+realid).value="click";
		$('[name^="'+id+'"]').parents('.showHide').show();
		$(ele).parent('.checkbox').find('.dropPop').show();		
	}
}

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
/*
$('#search_ud_state').change(function(){
    var StateId = $(this).val();
    $.ajax({
        type: "POST",
        url: 'ajax-city.php',
        data: {state_id: StateId},
        success: function(data){
            $('#search_ud_city').html(data);
        }
    });
});*/
$('#search_ud_city').on('change', function() {
    var CityID = $(this).val();
    $.ajax({
        url: "ajax-get-location.php",
        method: "POST",
        data: {action: 'CityID', CityID: CityID}, 
        success: function(result){
            //$('#search_ud_state').html(result);
            $('#search_ud_stateText').html(result);
        }
    });
 });

      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }



 $(document).ready(function(){
     
      function conduct_online() {
        var v = $('input[name=conduct_online]:checked').val();
        if (v == 'Yes') {
           $('#conduct_online_wrap').html('<textarea style="height:70px;" placeholder="Please state what kind of tools for online teaching that you are familiar with. E.g Zoom, Skype, What’s App, Phone calls, Emel, Facebook etc" name="conduct_online_text" class="form-control"></textarea>');
        } else {
           $('#conduct_online_wrap').html('');
        }
      }

      function student_disability() {
        var v = $('input[name=student_disability]:checked').val();
        if (v == 'Yes') {
           $('#student_disability_wrap').html('<textarea style="height:70px;" placeholder="Please state the type of disabilities you can attend to e.g Dyslexia, ADHD, Autism etcs" name="student_disability_text" class="form-control"></textarea>');
        } else {
           $('#student_disability_wrap').html('');
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


        if(ele == 'student_disability'){
           student_disability();
        }

      });
      
      $('.udradio2').on('click', function(){
        var ele = $(this).find('input[type=radio]').attr('name');
        if(ele == 'conduct_online'){
           conduct_online();
        }
    

      });
      
 });


$('.closeMyModalFlash').click(function(){
    $('#myModalFlash').modal('hide');
}) 
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>  
$(".js-example-basic-single").select2({
	placeholder: "Choose one of the following...",
});

</script>