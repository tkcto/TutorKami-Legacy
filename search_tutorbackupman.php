<?php 
require_once('includes/head.php');

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
  $data = array('subject' => $_GET['subject'], 'location' => $_GET['location']);
  
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
  

  $output = system::FireCurl(SEACRH_TUTOR_URL, "POST", "JSON", $data);
  // var_dump($output);exit();
  $search = $output->data;
}
if (isset($cityID) && $cityID != '') {
   $findCity = system::FireCurl(LIST_CITY_URL."?city_id=".urlencode($cityID));
}
if (isset($subjectID) && $subjectID != '') {
   $findSubj = system::FireCurl(LIST_SUBJECT_URL."?subject_id=".urlencode($subjectID));
}

$total_result = count($search);
include('includes/header.php');
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
      // $(".dropbox").click(function(){
      //    // $(this).next('.dropPop').stop();
      //    $(this).next('.dropPop').slideToggle("slow");
      // });
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
               <input type="hidden" name="subject" value="<?php echo isset($_REQUEST['subject']) ? $_REQUEST['subject']: '';?>">
               <input type="hidden" name="location" value="<?php echo isset($_REQUEST['location']) ? $_REQUEST['location']: '';?>">
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
                                                echo '<script>$(document).ready(function(){get_cities("'.$state->st_id.'", "'.$cities->city_id.'");});</script>';
                                             } else {
                                                $st_selected = '';
                                             }
                                          }
                                       } elseif (isset($stateID) && $stateID == $state->st_id) {
                                          $st_selected = 'selected';
                                          echo '<script>$(document).ready(function(){get_cities("'.$state->st_id.'", "");});</script>';
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
                        <div class="showHide" style="display: none;">
                           <div class="dropbox"><?php echo PLEASE_TICK_THE_AREA; ?></div>
                           <div class="dropPop">
                              <div class="row">
                                 <div class="col-md-12 city_check_uncheck_area"><a href="javascript:void(0);" onclick="tickAll('.city_check');">Tick All</a> <a href="javascript:void(0);" onclick="untickAll('.city_check');">Untick All</a></div>
                                 <div class="city-area"></div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="checkbox">                                    
                                    <input type="checkbox" name="location_other" id="optionsRadios1" value="1" <?php echo (isset($cityID) && $cityID == '') ? 'checked' : ''; ?>>
                                    <label for="optionsRadios1"><?php echo AREA_YOU_CAN_COVER_OTHERS; ?> </label>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <textarea class="form-control" name="location" rows="3" style="resize:none;"><?php echo (isset($cityID) && $cityID == '' && isset($_GET['location']) && $_GET['location'] != '') ? $_GET['location'] : ''; ?></textarea>
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
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="checkbox">                                    
                                    <input type="checkbox" name="subject_other" id="optionsRadios2" value="1" <?php echo (isset($subjectID) && $subjectID == '') ? 'checked' : ''; ?>>
                                    <label for="optionsRadios2"><?php echo SUBJECT_YOU_CAN_TEACH_OTHERS; ?> </label>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <textarea class="form-control" name="subject" rows="3" style="resize:none;"><?php echo (isset($subjectID) && $subjectID == '' && isset($_GET['subject']) && $_GET['subject'] != '') ? $_GET['subject'] : ''; ?></textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo GENDER; ?>:</strong></span></div>
                  <div class="col-md-3">
                     <select class="form-control" name="u_gender">
                        <option value="">All</option>
                        <option value="M"><?php echo MALE; ?> </option>
                        <option value="F"><?php echo FEMALE; ?></option>
                     </select>
                  </div>
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo RACE; ?>:</strong></span></div>
                  <div class="col-md-3">
                     <select class="form-control" name="ud_race">
                        <option value="">All</option>
                        <option value="Malay">Malay</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Indian">Indian</option>
                        <option value="Others">Others</option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3"> <span class="org-txt text-uppercase"><strong><?php echo OCCUPATION; ?>:</strong></span> </div>
                  <div class="col-md-3">
                     <select class="form-control" name="ud_current_occupation">
                        <option value="">All</option>
                        <option value="Full-time tutor"><?php echo FULL_TIME_TUTOR; ?></option>
                        <option value="Kindergarten teacher"><?php echo KINDERGARTEN_TEACHER; ?></option>
                        <option value="Primary school teacher"><?php echo PRIMARY_SCHOOL_TEACHER; ?></option>
                        <option value="Secondary school teacher"><?php echo SECONDARY_SCHOOL_TEACHER; ?></option>
                        <option value="Tuition center teacher"><?php echo TUITION_CENTER_TEACHER; ?></option>
                        <option value="Lacturer"><?php echo LACTURER; ?></option>
                        <option value="Ex-teacher"><?php echo EX_TEACHER; ?></option>
                        <option value="Retired teacher"><?php echo RETIRED_TEACHER; ?></option>
                        <option value="Other"><?php echo OTHER; ?></option>
                     </select>
                  </div>
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo TUTOR_STATUS; ?>:</strong></span> </div>
                  <div class="col-md-3">
                     <select class="form-control" name="ud_tutor_status">
                        <option value="">All</option>
                        <option value="'Full Time'"><?php echo FULL_TIME_TUTOR; ?></option>
                        <option value="'Part Time'"><?php echo PART_TIME; ?></option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo WILL_TEACH_AT_TUITION_CENTER; ?>:</strong></span></div>
                  <div class="col-md-3">
                     <select class="form-control" name="tution_center">
                        <option value="">All</option>
                        <option value="1"><?php echo YES; ?></option>
                        <option value="0"><?php echo NO; ?></option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class=" col-sm-12 col-md-12 search-tb" align="center">
                     <button type="submit" class="btn btn-md search_btn"><?php echo BUTTON_SEARCH_TUTOR; ?></button>
                  </div>
               </div>
            </form>
         </div>
         <div class="col-md-12">
            <div class="job-table" style="margin-top:30px;">
               <div class="top">
                  <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
                  <?php echo SEARCH_RESULTS; ?> : <span class="org-txt"><span id="total_tutor"><?php echo $total_result; ?></span> Tutor(s) found</span>
                  </div>
               </div>
               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center" style="background:#fff;" id="dataTables">
                  <thead>
                     <tr class="blue-bg">
                        <td><?php echo SEARCH_TUTOR_NAME; ?></td>
                        <td><?php echo SEARCH_TUTOR_GENDER; ?></td>
                        <td><?php echo SEARCH_TUTOR_AGE; ?></td>
                        <td><?php echo SEARCH_TUTOR_RATING; ?></td>
                        <td><?php echo SEARCH_TUTOR_CITY; ?></td>
                        <td><?php echo SEARCH_TUTOR_QUALIFICATION; ?></td>
                        <td>&nbsp;</td>
                     </tr>
                  </thead>
                  <tbody>                    
                     <?php 
                     if($total_result > 0) {
                        foreach ($search as $key => $row) {  
                           $split_rating = explode('.', $row->average_rating);
                           $arrCity = $init->GetCity($row->ud_city);
                     ?>
                     <tr class="point" onclick="gotoPage('tutor_profile.php?uid=<?php echo $row->ud_u_id;?>')" data-toggle="btnToolTip" data-placement="top" title="Click to view tutor’s profile">
                        <td class="text-capitalize"><strong><?php echo $row->u_displayname;?></strong> </td>
                        <td><?php echo ($row->u_gender == 'M') ? 'Male' : 'Female';?></td>
                        <td><?php echo system::CalculateAge($row->ud_dob).' '.YEARS_OLD;?></td>
                        <td><?php 
                           for($i = 0; $i < $split_rating[0]; $i++) { ?>
                           <span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>
                           <?php } ?>
                           <?php if(isset($split_rating[1]) && $split_rating[1] != '' && $split_rating[1] == '5') { ?>
                              <span class="rating-input"><span data-value="0" class="fa fa-star-half"></span></span>
                           <?php } elseif(isset($split_rating[1]) && $split_rating[1] != '' && $split_rating[1] > '5') { ?>
                              <span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>
                           <?php } 
                        ?></td>
                        <td><?php echo $row->ud_address;?></td>
                        <td><?php echo $row->ud_qualification;?></td>
                        <td>
                           <a href="javascript: void(0);" class="view-button" target="_blank"><?php echo VIEW_PROFILE; ?></a>
                        </td>
                     </tr>
                     <?php 
                        }
                     }
                     ?>
                  </tbody>
               </table>
            </div>
         </div>         
      </div>
   </div>
</section>
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
      // $(".dropbox").click(function(){
      //    // $(this).next('.dropPop').stop();
      //    $(this).next('.dropPop').slideToggle("slow");
      // });
   });
</script>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
   $.noConflict();
   jQuery(document).ready(function($){      
      var table = $('#dataTables').DataTable({
         "pageLength": 5,
         "info":false,
         "searching":false,
         "lengthChange":false,
         "bSort":false,
         "bPaginate":true,
         "sPaginationType":"simple_numbers",
         "columns": [            
            { width: '20%' },
            { width: '5%' },
            { width: '15%' },
            { width: '10%' },
            { width: '15%' },
            { "orderable": false, width: '20%' },
            { "orderable": false, width: '15%' }            
         ]
      });

      $('form#filter_user').submit(function(e) {
         e.preventDefault();
         
         $('#hider, #loadermodaldiv').show();
         var formData = new FormData(this);
         
         $.ajax({
            url: "front_ajax_call.php",
            type: "POST",
            data: formData, 
            contentType: false,
            dataType: "json",
            cache: false,
            processData:false,
            success: function(resultData) {
               table.clear().draw();
               var totalCount = resultData.length;
               $('#total_tutor').text(totalCount);
               
               for (i = 0; i < totalCount; i++) {
                  
                  var count = parseInt(i) + 1;
                  $('#dataTables').DataTable().row.add([                     
                     resultData[i].name,
                     resultData[i].gender,
                     resultData[i].dob,
                     resultData[i].rating,
                     resultData[i].city_name,
                     resultData[i].ud_qualification,
                     '<a href="tutor_profile.php?uid='+ resultData[i].u_id +'" class="view-button" target="_blank"><?php echo VIEW_PROFILE; ?></a>'
                  ]).draw();
               }

               $('#hider, #loadermodaldiv').hide();
            },
            error:function(msg){
               $('#hider, #loadermodaldiv').hide();
            }
         });

         return false;
      });      
   });
</script>
<?php include('includes/footer.php');?>

