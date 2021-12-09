<style>
.paging_simple_numbers a.paginate_button {
    color: #f1592a !important;
}
.paging_simple_numbers a.paginate_active {
    color: #f1592a !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding : 2px;
    margin-left: 2px;
    /*display: inline;*/
    border: 2px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    border: 2px;
}
</style>
<style>
.tooltip2 {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip2 .tooltiptext2 {
  visibility: hidden;
  width: 250px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  bottom: 100%;
  left: 50%;
  margin-left: -180px;
}

.tooltip2:hover .tooltiptext2 {
  visibility: visible;
}



    /* custom oren buttons */
 .btn-oren { 
  color: #FFFFFF; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren:hover, 
.btn-oren:focus, 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  color: #FFFFFF; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren:active, 
.btn-oren.active, 
.open .dropdown-toggle.btn-oren { 
  background-image: none; 
} 
 
.btn-oren.disabled, 
.btn-oren[disabled], 
fieldset[disabled] .btn-oren, 
.btn-oren.disabled:hover, 
.btn-oren[disabled]:hover, 
fieldset[disabled] .btn-oren:hover, 
.btn-oren.disabled:focus, 
.btn-oren[disabled]:focus, 
fieldset[disabled] .btn-oren:focus, 
.btn-oren.disabled:active, 
.btn-oren[disabled]:active, 
fieldset[disabled] .btn-oren:active, 
.btn-oren.disabled.active, 
.btn-oren[disabled].active, 
fieldset[disabled] .btn-oren.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-oren .badge { 
  color: #F1592A; 
  background-color: #FFFFFF; 
}

#loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
    position: fixed;
    top: 50%;
    left: 45%;
}   
 
 
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.circular-square {
  width:120px;
  height:120px;
  border-radius: 50%;
}
</style>
	<link href='css-pricing/rotating-card/rotating-card-seo.css' rel='stylesheet' />
	<link rel="stylesheet" type="text/css" href="css-pricing/adaptor/css/custom.css" />
<?php 

require_once('includes/head.php');
include('includes/header.php');


$findCity = $stateID = $cityID = '';

$findSubj = $levelID = $subjectID = '';



if (isset($_GET['location_id']) && $_GET['location_id'] != '') {

   $splitLocIDs = explode('||', $_GET['location_id']);

   $stateID = $splitLocIDs[0];

   $cityID = $splitLocIDs[1];   

}

if (isset($_GET['subject_id']) && $_GET['subject_id'] != '') {

   $splitSubIDs = explode('||', $_GET['subject_id']);

   $levelID = $splitSubIDs[0];

   $subjectID = $splitSubIDs[1];

}



if (count($_POST) > 0) {

  $data = $_POST;

  

  $output = system::FireCurl(SEACRH_TUTOR_URL, "POST", "JSON", $data);

  // var_dump($output);

  $search = $output->data;

  

} else {

if (isset($_GET['subject']) && $_GET['subject'] != '' && isset($_GET['location']) && $_GET['location'] != '') {
	$data = array('subject' => $_GET['subject'], 'location' => $_GET['location']);
}
  

  if ($stateID != '') {

     $data['cover_area_state'][] = $stateID;

  }

  if ($stateID != '' && $cityID != '') {

     $data['cover_area_city_'.$stateID][] = $cityID;

  }

  if ($stateID != '' && $cityID == '') {

     $data['location_other'] = 1;

  }



  if ($levelID != '') {

     $data['tutor_course'][] = $levelID;

  }

  if ($levelID != '' && $subjectID != '') {

     $data['tutor_subject_'.$levelID][] = $subjectID;

  }

  if ($levelID != '' && $subjectID == '') {

     $data['subject_other'] = 1;

  }


}

if (isset($cityID) && $cityID != '') {

   $findCity = system::FireCurl(LIST_CITY_URL."?city_id=".urlencode($cityID));

}

if (isset($subjectID) && $subjectID != '') {

   $findSubj = system::FireCurl(LIST_SUBJECT_URL."?subject_id=".urlencode($subjectID));

}



$total_result = count($search);


?>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<script> 

   function tickAll(className) {

      $(className).prop('checked', true);

   }



   function untickAll(className) {

      $(className).prop('checked', false);

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



   function get_cities(StateId, CityId) {

      $.ajax({

         url: "front_ajax_call.php",

         method: "POST",

         data: {action: 'get_cities', state_id: StateId, city_id: CityId}, 

         success: function(result){

            if (result == '') {

               $('.city_check_uncheck_area').hide();

            } else{

               $('.city_check_uncheck_area').show();

            }

            

            $('.city-area').html(result);

            $('.showHide, .showHide .dropPop').show();

            $('#hider, #loadermodaldiv').hide();
      
      <?php
      
        if(isset($_GET['location_id']))
        {
          echo "$(city_check_".$_GET['location_id'].").prop('checked', true);";
        }
        
      ?>

         }

      });

   }



   function get_subjects(LevelId, SubjectId) {

      $.ajax({

         url: "front_ajax_call.php",

         method: "POST",

         data: {action: 'get_subjects', level_id: LevelId, subject_id: SubjectId}, 

         success: function(result){

            if (result == '') {

               $('.subject_check_uncheck_area').hide();

            } else{

               $('.subject_check_uncheck_area').show();

            }

            $('.subject-area').html(result);

            $('.levelShowHide, .levelShowHide .dropPop').show();

            $('#hider, #loadermodaldiv').hide();
      
      <?php
      
        if(isset($_GET['subject_id']))
        {
          echo "$(subject_check".$_GET['subject_id'].").prop('checked', true);";
        }
      ?>

         }

      });

   }

   

   $(document).ready(function(){



      $('#state_drop').on('change', function(){

         $('#hider, #loadermodaldiv').show();

         var StateId = $(this).val();

         get_cities(StateId, '');

      });



      $('#level_drop').on('change', function(){

         $('#hider, #loadermodaldiv').show();

         var LevelId = $(this).val();

         get_subjects(LevelId, '');

      });


   });

</script>



<section class="search_tutor myform">

   <div class="main-body">

      <div class="container">



         <h1 class="text-center text-uppercase blue-txt"><?php echo SEARCH_TUTOR; ?></h1>

         <hr>

         <div class="col-md-offset-2 col-md-8">

          <div class="clearfix"></div>
      
      
            <form method="post" id="filter_user">

               <input type="hidden" name="action" value="search_tutor">
<?PHP
if (isset($_REQUEST['subject']) && $_REQUEST['subject'] != '' && isset($_REQUEST['location']) && $_REQUEST['location'] != '') {
?>
               <input type="hidden" name="subject" value="<?php echo isset($_REQUEST['subject']) ? $_REQUEST['subject']: '';?>">

               <input type="hidden" name="location" value="<?php echo isset($_REQUEST['location']) ? $_REQUEST['location']: '';?>">

<?PHP
}
?>

               <div class="row">

                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo STATE; ?>:</strong></span></div>

                  <div class="col-md-9">

                     <div class="form-group">

                        <select class="form-control" name="cover_area_state[]" id="state_drop">

                           <option value=""><?php echo SEARCH_TUTOR_SELECT_STATE; ?></option>

                           <?php 

                           $getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');

                           if ($getAllCountries->flag == 'success' && count($getAllCountries->data) > 0) {

                              $i = 0;

                              foreach ($getAllCountries->data as $key => $country) {

                                 // Get State By Country Id

                                 $getCountryWiseStates = system::FireCurl(LIST_STATE_URL.'?country_id='.$country->c_id);

                                 if ($getCountryWiseStates->flag == 'success' && count($getCountryWiseStates->data) > 0) {

                                    foreach ($getCountryWiseStates->data as $key => $state) {

                                       $st_selected = '';

                                       if ($findCity != '') {

                                          foreach ($findCity->data as $cities) {

                                             if ($cities->city_st_id == $state->st_id) {

                                                $st_selected = 'selected';

                                                echo '<script>
                                                $(document).ready(function(){
                                                  get_cities("'.$state->st_id.'", "'.$cities->city_id.'");
                                                });
                                                </script>';

                                             } else {

                                                $st_selected = '';

                                             }

                                          }

                                       } elseif (isset($stateID) && $stateID == $state->st_id) {

                                          $st_selected = 'selected';

                                          echo '<script>
                                          $(document).ready(function(){
                                            get_cities("'.$state->st_id.'", "");
                                          });
                                          </script>';

                                       }

                           ?>

                           <option value="<?php echo $state->st_id; ?>" <?php echo (isset($_POST['cover_area_state']) && in_array($state->st_id, $_POST['cover_area_state'])) ? 'selected' : $st_selected;?>><?php echo $state->st_name; ?></option>

                           <?php 

                                    }

                                 }

                              }

                           }

                           ?>

                        </select>

                     </div>

                     <div class="form-group">

                        <div class="showHide" <?php 
                          if(!isset($_GET['location_id']))
                          { 
                            echo "style='display: none;'"; 
                          } 
                          else if($_GET['location_id'] == "")
                          { 
                            echo "style='display: none;'"; 
                          } 
                        ?>>

                           <div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>

                           <div class="dropPop">

                              <div class="row">

                                 <div class="col-md-12 city_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAll('.city_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('.city_check');">Untick All</a></div>

                                 <div class="city-area"></div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="row">

                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo SEARCH_JOB_LEVELS; ?>:</strong></span></div>

                  <div class="col-md-9">

                     <div class="form-group">

                        <select class="form-control" name="tutor_course[]" id="level_drop">

                           <option value="">Choose subject</option>

                           <?php 

                           // Get Course

                           $getCourse = system::FireCurl(LIST_COURSE_URL);

                           if ($getCourse->flag == 'success' && count($getCourse->data) > 0) {

                              $i = 0;

                              foreach ($getCourse->data as $key => $course) {

                                 $sub_selected = '';

                                 if ($findSubj != '') {

                                    foreach ($findSubj->data as $subjects) {

                                       if ($subjects->ts_tc_id == $course->tc_id) {

                                          $sub_selected = 'selected';

                                          echo '<script>$(document).ready(function(){get_subjects("'.$course->tc_id.'", "'.$subjects->ts_id.'");});</script>';

                                       } else {

                                          $sub_selected = '';

                                       }

                                    }

                                 } elseif (isset($levelID) && $levelID == $course->tc_id) {

                                    $sub_selected = 'selected';

                                    echo '<script>$(document).ready(function(){get_subjects("'.$course->tc_id.'", "");});</script>';

                                 }

                           ?>

                           <option value="<?php echo $course->tc_id; ?>" <?php echo (isset($_POST['tutor_course']) && in_array($course->tc_id, $_POST['tutor_course'])) ? 'selected' : $sub_selected;?>><?php echo $course->tc_title; ?></option>

                           <?php 

                             }

                           }

                           ?>

                        </select>

                     </div>

                     <div class="form-group">

                        <div class="levelShowHide" style="display: none;">

                           <div class="dropbox"><?php echo PLEASE_TICK_THE_SUBJECT; ?></div>

                           <div class="dropPop">

                              <div class="row">

                                 <div class="col-md-12 subject_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAll('.subject_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('.subject_check');">Untick All</a></div>

                                 <div class="subject-area"></div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>

               <div class="row">

                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo GENDER; ?>:</strong></span></div>

                  <div class="col-md-3">

                     <select class="form-control" name="u_gender" id="u_gender">

                        <option value="">All</option>

                        <option value="M"><?php echo MALE; ?> </option>

                        <option value="F"><?php echo FEMALE; ?></option>

                     </select>

                  </div>
				  
				  
                  <div class="col-md-3"> <span class="org-txt text-uppercase"><strong><?php echo OCCUPATION; ?>:</strong></span> </div>

                  <div class="col-md-3">

                     <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">

                        <option value="">All</option>

                        <option value="Full-time tutor"><?php echo FULL_TIME_TUTOR; ?></option>

                        <option value="Kindergarten teacher"><?php echo KINDERGARTEN_TEACHER; ?></option>

                        <option value="Primary school teacher"><?php echo PRIMARY_SCHOOL_TEACHER; ?></option>

                        <option value="Secondary school teacher"><?php echo SECONDARY_SCHOOL_TEACHER; ?></option>

                        <option value="Tuition center teacher"><?php echo TUITION_CENTER_TEACHER; ?></option>

                        <option value="Lecturer"><?php echo LACTURER; ?></option>

                        <option value="Ex-teacher"><?php echo EX_TEACHER; ?></option>

                        <option value="Retired teacher"><?php echo RETIRED_TEACHER; ?></option>

                        <option value="Other"><?php echo OTHER; ?></option>

                     </select>

                  </div>
				 


                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo 'CONDUCT ONLINE TUITION'; ?>:</strong></span> 
                        <div class="tooltip2"><span class="glyphicon glyphicon-info-sign" style="color:#262262"></span><span class="tooltiptext2">For online tuition, please ignore the tutor’s location as tutor can conduct online tuition for you from any location</span></div>                  
                  </div>
                  <div class="col-md-3">
                     <select class="form-control" name="conductOnline" id="conductOnline">
                        <option value="">All</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                     </select>
                  </div>
                  
                  

                  <div class="col-md-3 hidden"><span class="org-txt text-uppercase"><strong><?php echo RACE; ?>:</strong></span></div>

                  <div class="col-md-3 hidden">

                     <select class="form-control" name="ud_race" id="ud_race">

                        <option value="">All</option>

                        <option value="Malay">Malay</option>

                        <option value="Chinese">Chinese</option>

                        <option value="Indian">Indian</option>

                        <option value="Others">Others</option>

                     </select>

                  </div>

               </div>

               <div class="row">


                  <div class="col-md-3 hidden"><span class="org-txt text-uppercase"><strong><?php echo TUTOR_STATUS; ?>:</strong></span> </div>

                  <div class="col-md-3 hidden">

                     <select class="form-control" name="ud_tutor_status" id="ud_tutor_status">

                        <option value="">All</option>

                        <option value="'Full Time'"><?php echo FULL_TIME_TUTOR; ?></option>

                        <option value="'Part Time'"><?php echo PART_TIME; ?></option>

                     </select>

                  </div>

               </div>

               <div class="row hidden">

                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo WILL_TEACH_AT_TUITION_CENTER; ?>:</strong></span></div>

                  <div class="col-md-3">

                     <select class="form-control" name="tution_center" id="tution_center">

                        <option value="">All</option>

                        <option value="1"><?php echo YES; ?></option>

                        <option value="0"><?php echo NO; ?></option>

                     </select>

                  </div>

               </div>

               <div class="row">

                  <div class=" col-sm-12 col-md-12 search-tb" id="submitsearch" align="center">

<br><input type="button" name="filter2" id="filter2" class="btn btn-md search_btn" value="<?php echo BUTTON_SEARCH_TUTOR; ?>">
<input type="hidden" id="stateValue" >	
<input type="hidden" id="levelValue" >			    
<?PHP
if( isset($_SESSION['auth']['user_id']) == '1579981' ){ 
    //echo '<input type="button" name="filter2" id="filter2" class="btn btn-md search_btn" value="BUTTON_SEARCH_TUTOR">';
}
?>



                  </div>

               </div>

            </form>
      
      <?php 
        $fromIndex = false;
        if(isset($_GET['location_id']))
        {
          $fromIndex = true;
          $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
          $sql = "SELECT city_st_id FROM tk_cities WHERE city_id = '".$_GET['location_id']."'";
          $row = mysqli_fetch_array(mysqli_query($connect, $sql));
          
          echo '<script>get_cities("'.$row['city_st_id'].'", ""); $("#state_drop").val("'.$row['city_st_id'].'");</script>'; 
          echo '<script>document.getElementById("stateValue").value = "'.$row['city_st_id'].'";</script>'; 
          mysqli_close($connect);
        } 
		
        if(isset($_GET['subject_id']))
        { 
          $fromIndex = true;
          $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
          $sql = "SELECT ts_tc_id FROM tk_tution_subject WHERE ts_id = '".$_GET['subject_id']."'";
          $row = mysqli_fetch_array(mysqli_query($connect, $sql));
          
          echo '<script>get_subjects("'.$row['ts_tc_id'].'", ""); $("#level_drop").val("'.$row['ts_tc_id'].'");</script>'; 
          echo '<script>document.getElementById("levelValue").value = "'.$row['ts_tc_id'].'";</script>'; 
          mysqli_close($connect);
        } 
        
        if($fromIndex)
        {
          echo "<script>window.onload = function () { cariTutor(); }</script>";
        }
      ?>

         </div>

         <div class="col-md-12">

            <div class="job-table" style="margin-top:30px;">

               <div class="top">

                <div class="dataTables_info hidden" id="example_info" role="status" aria-live="polite">

                  <?php echo SEARCH_RESULTS; ?> : <span class="org-txt"><span id="counttutor"></span> Tutor(s) found</span>

                  </div>

               </div>
	    
			    
<?PHP
//if( isset($_SESSION['auth']['user_id']) == '1579981' ){
?>

<?PHP
if(stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")){
//mobile
?>
               <table id="tutor-grid-layout" width="100%">
					<thead>
						<tr>
                            <th></th>
						</tr>
					</thead>
			    </table>    
<?PHP
}else{
// desktop
?>
               <table id="tutor-grid-layout" width="100%">
					<thead>
						<tr>
                            <th></th>
						</tr>
					</thead>
			    </table>    
<?PHP
}
?>
<?php
//}
?>
			    

               <br>

            </div>

         </div>         

      </div>

   </div>

</section>



<script src="js/jquery-1.12.4.js"></script>

<script src="js/jquery.dataTables.min.js"></script>

<script> 

   function tickAll(className) {

      $(className).prop('checked', true);

   }



   function untickAll(className) {

      $(className).prop('checked', false);

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


    $(document).ready(function(){
      //cariTutor();

      $('#state_drop').on('change', function(){

         $('#hider, #loadermodaldiv').show();

         var StateId = $(this).val();

         $.ajax({

            url: "front_ajax_call.php",

            method: "POST",

            data: {action: 'get_cities', state_id: StateId}, 

            success: function(result){

               if (result == '') {

                  $('.city_check_uncheck_area').hide();

               } else{

                  $('.city_check_uncheck_area').show();

               }

               

               $('.city-area').html(result);

               $('.showHide, .showHide .dropPop').show();

               $('#hider, #loadermodaldiv').hide();

            }

         });

      });



      $('#level_drop').on('change', function(){

         $('#hider, #loadermodaldiv').show();

         var LevelId = $(this).val();

         $.ajax({

            url: "front_ajax_call.php",

            method: "POST",

            data: {action: 'get_subjects', level_id: LevelId}, 

            success: function(result){

               if (result == '') {

                  $('.subject_check_uncheck_area').hide();

               } else{

                  $('.subject_check_uncheck_area').show();

               }

               $('.subject-area').html(result);

               $('.levelShowHide, .levelShowHide .dropPop').show();

               $('#hider, #loadermodaldiv').hide();

            }

         });

      });

   });



$(document).ready(function(){

    var isMobile = false; //initiate as false
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true; 
    
    var postURL = 'search-tutor-ajax3.php';
}else{
    var postURL = 'search-tutor-ajax2.php';
}
    



    // processing': '$("#loadermodaldiv").show();'
    function datatableLayout(state = '', city_check = '', level = '', subject_check = '', u_gender = '', ud_current_occupation = '', conductOnline = ''){
		var dataTable = $('#tutor-grid-layout').DataTable({
			"processing" : true,
			"serverSide" : true,

			"order": [],
			"columnDefs": [ { orderable: false, targets: [0]}],
			
			"searching" : false,
			//"ordering": false,
			'paging': true,			
            'language': {
                'loadingRecords': '&nbsp;',
                'processing': '<div id="loader"></div>'
            },
			"ajax" : {
				url:postURL,
				type:"POST",
				data:{
					state:state, city_check:city_check, level:level, subject_check:subject_check, u_gender:u_gender, ud_current_occupation:ud_current_occupation, conductOnline:conductOnline
				}
			}
			,"fnDrawCallback": function () {
				document.getElementById("counttutor").innerHTML = this.fnSettings().fnRecordsTotal();
			}
				
				
		});
	}
    $('#filter2').click(function(){
        
        document.getElementById("example_info").classList.remove('hidden');
        
        var state                   = $('#state_drop').val();
        var u_gender                = $('#u_gender').val();
        var ud_current_occupation   = $('#ud_current_occupation').val();
        var conductOnline           = $('#conductOnline').val();
        

        var city_check = [];
            $('.city_check:checked').each(function(i){
                city_check[i] = $(this).val();
            });


        var level                   = $('#level_drop').val();
        var subject_check = [];
            $('.subject_check:checked').each(function(i){
                subject_check[i] = $(this).val();
            });
			        
        if(state != '' || city_check != '' || level != '' || subject_check != '' || u_gender != '' || ud_current_occupation != '' || conductOnline != ''  ){
				$('#tutor-grid-layout').DataTable().destroy();
				datatableLayout(state, city_check, level, subject_check, u_gender, ud_current_occupation, conductOnline);
		}else{
				$('#tutor-grid-layout').DataTable().destroy();
				datatableLayout();
        }


    });
    
    
    
    
 
    
    function fill_datatable(state = '', city_check = '', level = '', subject_check = '', u_gender = '', ud_current_occupation = '', conductOnline = ''){
		var dataTable = $('#tutor-grid').DataTable({
			"processing" : true,
			"serverSide" : true,
			"order" : [ ],
			"searching" : false,
			"ordering": false,
			'paging': true,				
			"ajax" : {
				url:"search-tutor-ajax.php",
				type:"POST",
				data:{
					state:state, city_check:city_check, level:level, subject_check:subject_check, u_gender:u_gender, ud_current_occupation:ud_current_occupation, conductOnline:conductOnline
				}
			}
			,"fnDrawCallback": function () {
				document.getElementById("counttutor").innerHTML = this.fnSettings().fnRecordsTotal();
			}
				
				
		});
	}

    $('#filter').click(function(){
		
        var state                   = $('#state_drop').val();
        var u_gender                = $('#u_gender').val();
        var ud_current_occupation   = $('#ud_current_occupation').val();
        var conductOnline           = $('#conductOnline').val();

        var city_check = [];
            $('.city_check:checked').each(function(i){
                city_check[i] = $(this).val();
            });


        var level                   = $('#level_drop').val();
        var subject_check = [];
            $('.subject_check:checked').each(function(i){
                subject_check[i] = $(this).val();
            });


        
        if(state != '' || city_check != '' || level != '' || subject_check != '' || u_gender != '' || ud_current_occupation != '' || conductOnline != ''  ){
				$('#tutor-grid').DataTable().destroy();
				fill_datatable(state, city_check, level, subject_check, u_gender, ud_current_occupation, conductOnline);
		}else{
				$('#tutor-grid').DataTable().destroy();
				fill_datatable();
        }


    });









function codeAddress() {
    if (window.location.href.indexOf('?subject_id=') > 0) {
            var city_check = [];
            var subject_check = [];
            var urllocation_id = window.location.href;
            var urllocation_id = new URL(urllocation_id);
            city_check[0] = urllocation_id.searchParams.get("location_id");

            var urlsubject_id = window.location.href;
            var urlsubject_id = new URL(urlsubject_id);
            subject_check[0] = urlsubject_id.searchParams.get("subject_id");
            
            //alert(urllocation_id + ' - ' + urlsubject_id);

            document.getElementById("example_info").classList.remove('hidden');
            
            var state                   = document.getElementById("stateValue").value;
            var level                   = document.getElementById("levelValue").value;
            var u_gender                = $('#u_gender').val();
            var ud_current_occupation   = $('#ud_current_occupation').val();
            var conductOnline           = $('#conductOnline').val();
    
            //alert(state + ' - ' + city_check + ' - ' + level + ' - ' + subject_check);
            
            if(state != '' || city_check != '' || level != '' || subject_check != '' || u_gender != '' || ud_current_occupation != '' || conductOnline != ''  ){
    				$('#tutor-grid-layout').DataTable().destroy();
    				datatableLayout(state, city_check, level, subject_check, u_gender, ud_current_occupation, conductOnline);
    		}else{
    				$('#tutor-grid-layout').DataTable().destroy();
    				datatableLayout();
            }
    }    
}
window.onload = codeAddress;






});

</script>
<?php include('includes/footer-new.php');?>