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
<?php 

require_once('includes/head.php');
//include('includes/headernonmobile.php');
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

  



  // $output = system::FireCurl(SEACRH_TUTOR_URL, "POST", "JSON", $data);//punca slow view more tutor

  // var_dump($output);exit();

  // $search = $output->data;

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
	//to indicate whether subject and area have been checked and repopulate or not before performing the initial cariTutor()
	var subjectPopulateDone = false;
	var areaPopulateDone = false;
	var checkPopulation;
	
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
			
		if(isset($_GET['area'])) {
			if($_GET['area'] != "") {
				$areaArr = explode(",", $_GET['area']);
				
				foreach($areaArr as $j) {
					echo "$('label').filter(function() {
							return $(this).text() == '".$j."';
						}).prev().attr('checked','checked');";
				}
				
			}
		}
      ?>

			areaPopulateDone = true;
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
		
		if(isset($_GET['subject'])) {
			if($_GET['subject'] != "") {
				$subjectArr = explode(",", $_GET['subject']);
				
				foreach($subjectArr as $i) {
					echo "$('label').filter(function() {
							return $(this).text() == '".$i."';
						}).prev().attr('checked','checked');";
				}

			}
		}
      ?>
			subjectPopulateDone = true;
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

						<?php	
							$stateSelected = "";
							$stateSelector = "";
							
							if(isset($_GET['state'])) {
								$stateSelected = $_GET['state'];
								$stateSelector = "$('#state_drop option:contains(".$stateSelected.")').attr('selected', 'selected');";
							} else if(isset($_POST['cover_area_state'])) {
								$stateSelected = $_POST['cover_area_state'][0];
								$stateSelector = "$('#state_drop').val('".$stateSelected."');";
							}
						?>
                        <select class="form-control" name="cover_area_state[]" id="state_drop">

                           <option value=""><?php echo SEARCH_TUTOR_SELECT_STATE; ?></option>
                           <option value="All"><?php echo "All"; ?></option>

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

								 <option value="<?php echo $state->st_id; ?>" <?php echo (strcasecmp($stateSelected, $state->st_id) == 0 || strcasecmp($stateSelected, $state->st_name) == 0 ? "selected" : ""); ?>><?php echo $state->st_name; ?></option>

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

						<?php	
							$levelSelected = "";
							$levelSelector = "";
							
							if(isset($_GET['level'])) {
								$levelSelected = $_GET['level'];
								$levelSelector = "$('#level_drop option:contains(".$levelSelected.")').attr('selected', 'selected');";
							} else if(isset($_POST['tutor_course'])) {
								$levelSelected = $_POST['tutor_course'][0];
								$levelSelector = "$('#level_drop').val('".$levelSelected."');";
							}
						?>
						
                        <select class="form-control" name="tutor_course[]" id="level_drop">

                           <option value="">Choose subject</option>
                           <option value="All"><?php echo "All"; ?></option>

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

                           <option value="<?php echo $course->tc_id; ?>" <?php echo (strcasecmp($levelSelected, $course->tc_id) == 0 || strcasecmp($levelSelected, $course->tc_title) == 0 ? "selected" : ""); ?>><?php echo $course->tc_title; ?></option>

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

				<?php	
					if(isset($_GET['gender'])) {
						$genderSelected = $_GET['gender'];
					} else if(isset($_POST['u_gender'])) {
						$genderSelected = $_POST['u_gender'];
					}
				?>
                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo GENDER; ?>:</strong></span></div>

                  <div class="col-md-3">

                     <select class="form-control" name="u_gender" id="u_gender">

                        <option value="">All</option>

                        <option value="M" <?php echo (strcasecmp($genderSelected, "M") == 0 || strcasecmp($genderSelected, MALE) == 0 ? "selected" : "") ?>><?php echo MALE; ?> </option>

                        <option value="F" <?php echo (strcasecmp($genderSelected, "F") == 0 || strcasecmp($genderSelected, FEMALE) == 0 ? "selected" : "") ?>><?php echo FEMALE; ?></option>

                     </select>

                  </div>
				  
				  
                  <div class="col-md-3"> <span class="org-txt text-uppercase"><strong><?php echo OCCUPATION; ?>:</strong></span> </div>

                  <div class="col-md-3">

				     <?php	
						$occupationSelected = "";
						
						if(isset($_GET['occupation'])) {
							$occupationSelected = $_GET['occupation'];
						} else if(isset($_POST['ud_current_occupation'])) {
							$occupationSelected = $_POST['ud_current_occupation'];
						}
					?>
                     <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">

                        <option value="" <?php echo ($occupationSelected == "" ? "selected" : "") ?>>All</option>

                        <option value="Full-time tutor" <?php echo (strcasecmp($occupationSelected, "Full-time tutor") == 0 || strcasecmp($occupationSelected, FULL_TIME_TUTOR) == 0 ? "selected" : ""); ?>><?php echo FULL_TIME_TUTOR; ?></option>

                        <option value="Kindergarten teacher" <?php echo (strcasecmp($occupationSelected, "Kindergarten teacher") == 0 || strcasecmp($occupationSelected, KINDERGARTEN_TEACHER) == 0 ? "selected" : ""); ?>><?php echo KINDERGARTEN_TEACHER; ?></option>

                        <option value="Primary school teacher" <?php echo (strcasecmp($occupationSelected, "Primary school teacher") == 0 || strcasecmp($occupationSelected, PRIMARY_SCHOOL_TEACHER) == 0 ? "selected" : ""); ?>><?php echo PRIMARY_SCHOOL_TEACHER; ?></option>

                        <option value="Secondary school teacher" <?php echo (strcasecmp($occupationSelected, "Secondary school teacher") == 0 || strcasecmp($occupationSelected, SECONDARY_SCHOOL_TEACHER) == 0 ? "selected" : ""); ?>><?php echo SECONDARY_SCHOOL_TEACHER; ?></option>

                        <option value="Tuition center teacher" <?php echo (strcasecmp($occupationSelected, "Tuition center teacher") == 0 || strcasecmp($occupationSelected, TUITION_CENTER_TEACHER) == 0 ? "selected" : ""); ?>><?php echo TUITION_CENTER_TEACHER; ?></option>

                        <option value="Lacturer" <?php echo (strcasecmp($occupationSelected, "Lacturer") == 0 || strcasecmp($occupationSelected, LACTURER) == 0 ? "selected" : ""); ?>><?php echo LACTURER; ?></option>

                        <option value="Ex-teacher" <?php echo (strcasecmp($occupationSelected, "Ex-teacher") == 0 || strcasecmp($occupationSelected, EX_TEACHER) == 0 ? "selected" : ""); ?>><?php echo EX_TEACHER; ?></option>

                        <option value="Retired teacher" <?php echo (strcasecmp($occupationSelected, "Retired teacher") == 0 || strcasecmp($occupationSelected, RETIRED_TEACHER) == 0 ? "selected" : ""); ?>><?php echo RETIRED_TEACHER; ?></option>

                        <option value="Other" <?php echo (strcasecmp($occupationSelected, "Other") == 0 || strcasecmp($occupationSelected, OTHER) == 0 ? "selected" : ""); ?>><?php echo OTHER; ?></option>

                     </select>

                  </div>
				  

                  <div class="col-md-3"><span class="org-txt text-uppercase"><strong><?php echo RACE; ?>:</strong></span></div>

                  <div class="col-md-3">

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

                  <!--<div class="col-md-3"> <span class="org-txt text-uppercase"><strong><?php echo OCCUPATION; ?>:</strong></span> </div>

                  <div class="col-md-3">

                     <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">

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

                  </div> -->

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

                     <!-- <button type="submit" class="btn btn-md search_btn" onclick="cariTutor()"><?php echo BUTTON_SEARCH_TUTOR; ?></button> -->
                     <br><input type="button" name="submitBtn" class="btn btn-md search_btn" onclick="preSubmission()" value="<?php echo BUTTON_SEARCH_TUTOR; ?>">

                  </div>

               </div>

            </form>
			<script>
				function preSubmission() {
					var selectedState = encodeURI($("#state_drop :selected").html().trim());
					var selectedLevel = encodeURI($("#level_drop :selected").html().trim());
					var selectedGender = encodeURI($("#u_gender :selected").html().trim());
					var selectedOccupation = encodeURI($("#ud_current_occupation :selected").html().trim());
					var selectedArea = new Array();
					var selectedSubject = new Array();
					
					$(".city_check").each(
						function() {
							if($(this).is(":checked")) {
								selectedArea.push(encodeURI($(this).next().html().trim()));
							}
						}
					);
					
					$(".subject_check").each(
						function() {
							if($(this).is(":checked")) {
								selectedSubject.push(encodeURI($(this).next().html().trim()));
							}
						}
					);
					
					var parameterArr = new Array();
					
					if($("#state_drop").val() != "") {
						parameterArr.push("state=" + selectedState);
					}
					if($("#level_drop").val() != "") {
						parameterArr.push("level=" + selectedLevel);
					}
					if($("#u_gender").val() != "") {
						parameterArr.push("gender=" + selectedGender);
					}
					if($("#ud_current_occupation").val() != "") {
						parameterArr.push("occupation=" + selectedOccupation);
					}
					if(selectedArea.length > 0) {
						parameterArr.push("area=" + selectedArea.join(","));
					}
					if(selectedSubject.length > 0) {
						parameterArr.push("subject=" + selectedSubject.join(","));
					}
					
					
					<?php
						$urlArr = explode("?", $_SERVER['REQUEST_URI']);
						$getUrl = $urlArr[0];
					?>
					
					var getUrl = "<?php echo $getUrl; ?>?" + parameterArr.join("&");
					//alert(getUrl);
					$("#filter_user").prop("action", getUrl);
					$("#filter_user").submit();
				}
			</script>
      
      <?php 
        $fromIndex = false;
        if(isset($_GET['location_id']))
        {
          $fromIndex = true;
          $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
          $sql = "SELECT city_st_id FROM tk_cities WHERE city_id = '".$_GET['location_id']."'";
          $row = mysqli_fetch_array(mysqli_query($connect, $sql));
          
          echo '<script>get_cities("'.$row['city_st_id'].'", ""); $("#state_drop").val("'.$row['city_st_id'].'");</script>'; 
          mysqli_close($connect);
        } 
		
        if(isset($_GET['subject_id']))
        { 
          $fromIndex = true;
          $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
          $sql = "SELECT ts_tc_id FROM tk_tution_subject WHERE ts_id = '".$_GET['subject_id']."'";
          $row = mysqli_fetch_array(mysqli_query($connect, $sql));
          
          echo '<script>get_subjects("'.$row['ts_tc_id'].'", ""); $("#level_drop").val("'.$row['ts_tc_id'].'");</script>'; 
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

                <div class="dataTables_info" id="example_info" role="status" aria-live="polite">

                  <?php echo SEARCH_RESULTS; ?> : <span class="org-txt"><span id="counttutor"></span> Tutor(s) found</span>

                  </div>

               </div>

             

               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive text-center" style="background:#fff;" id="dataTable">

                  <thead>

                     <tr class="blue-bg">
						
						<!--<th class="hidden"><center><?php //echo "DATE"; ?></center></th>-->

                        <th><center><?php echo SEARCH_TUTOR_NAME; ?></center></th>

                        <th><center><?php echo SEARCH_TUTOR_GENDER; ?></center></th>

                        <th><center><?php echo SEARCH_TUTOR_AGE; ?></center></th>

                        <th><center><?php echo "LOCATION";//SEARCH_TUTOR_CITY; ?></center></th>

                        <th><center><?php echo "OCCUPATION"; ?></center></th>

                        <th><center><?php echo SEARCH_TUTOR_RATING; ?></center></th>

                        <th><center>ACTION</center></th>

                     </tr>

                  </thead>

               </table>

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



</script>

<script>
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


function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
$(document).ready(function() { 
	<?php
		if($levelSelected != "") {
			echo	$levelSelector.'
					var levelid = $("#level_drop").val();
					get_subjects(levelid, "");';
		} else {
			echo "subjectPopulateDone = true;";
		}
		
		if($stateSelected != "") {
			echo	$stateSelector.'
					var stateid = $("#state_drop").val();
					get_cities(stateid, "");';
		} else {
			echo "areaPopulateDone = true;";
		}
		
	?>
	checkPopulation = setInterval(startSearch, 500);
});

	function startSearch() {
		if(subjectPopulateDone && areaPopulateDone) {
			clearInterval(checkPopulation);
			cariTutor();
		}
	}
	
  function cariTutor(){

    var gender = $("#u_gender").val();
    var ud_race = $("#ud_race").val();
    var current_occupation = $("#ud_current_occupation").val();
    var ud_tutor_status = $("#ud_tutor_status").val();
    var tution_center = $("#tution_center").val();

    var areas = $("#state_drop").val();
    var location = $("#location").val();
    var course = $("#level_drop").val();
	
    var city_check = [];
			$('.city_check:checked').each(function(i){
				city_check[i] = $(this).val();
			});
	var subject_check = [];
			$('.subject_check:checked').each(function(i){
				subject_check[i] = $(this).val();
			});
			
    var subject = $("#subject").val();

    var getaarea = getUrlVars()['location_id'];
    var getSub = getUrlVars()['subject_id'];
	
	if( city_check == "" ){
		if(getaarea != "" && getaarea !== undefined){
			city_check[0] = getaarea;
		}else{
			$('.city_check:checked').each(function(i){
				city_check[i] = $(this).val();
			});
		}
	}else{
        $('.city_check:checked').each(function(i){
          city_check[i] = $(this).val();
        });
	}

	if( subject_check == "" ){
		if(getSub != "" && getSub !== undefined){
			subject_check[0] = getSub;
		}else{
			$('.subject_check:checked').each(function(i){
				subject_check[i] = $(this).val();
			});
		}
	}else{
        $('.subject_check:checked').each(function(i){
          subject_check[i] = $(this).val();
        });
	}
			$('#dataTable').DataTable().destroy();
			var dataTable = $('#dataTable').DataTable({
				pageLength: 5,
				language: {
                          "emptyTable":     "Tiada Maklumat Dijumpai!",
						  "info": "Showing _START_ to _END_ of _TOTAL_ tutors",
						  "infoEmpty":      "Showing 0 to 0 of 0 tutors",
                        },	

				"sPaginationType": "simple_numbers", //full_numbers
				paging: true,
				searching: true,
				/*"columnDefs": [
					{
						"targets": [ 0 ],
						"visible": false,
						"searchable": false
					}
				],*/
				
				"processing" : true,
				"serverSide" : true,
				//"order" : [ ],
				//"searching" : false,
				"ordering": false,
				
				"ajax" : {
					url:"ajax-load-search-tutor.php",
					type:"POST",
					data:{
						state:areas, area:city_check, level:course, subjek:subject_check, gender2:gender, occupation:current_occupation
					}
				}
			});
		
	
	
	
	
    return false;
  }

</script>
<!-- luqman -->

<?php include('includes/footer.php');?>



