<?php 

require_once('includes/head.php');

if (!isset($_SESSION['auth'])) {

  header('Location: login.php');

  exit();

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

}/*


$user_id = isset($_SESSION['auth']['user_id']) ? $_SESSION['auth']['user_id'] : 0;
$getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$user_id);
$user_info = (array) $getUserDetails->data[0];*/
$getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');



?>

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
array_multisort(array_column($getCourse->data, "sort_by"), SORT_ASC, $getCourse->data); 
                    foreach ($getCourse->data as $key => $course) {

                      // GET User Course

                      $checked = system::FireCurl(USER_SUBJECT_URL.'?user_id='.$user_id.'&course_id='.$course->tc_id);

                      // Get Other subject from table

                      $OtherCourse = system::FireCurl(USER_OTHER_SUBJECT_URL.'?user_id='.$user_id.'&course_id='.$course->tc_id);

                  ?>

                  <div class="col-md-10">                    

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
