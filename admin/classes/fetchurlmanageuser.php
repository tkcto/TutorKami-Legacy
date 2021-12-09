<?php
// man
// require_once('includes/head.php');
require_once('user.class.php');
// require_once('classes/location.class.php');
// require_once('classes/app.class.php');

$userInit = new user;
// $initLocation = new location;
// $initApp = new app;

  // luqman
           if(isset($_POST['is_tutor'], $_POST['data'])){

            // $data = $_POST['data'];
              
                    $istutor = $_POST['is_tutor'];

            $search_tutor          = isset($data['is_tutor'])                ? $data['is_tutor'] : '';
            $search_email          = isset($data['u_email'])                 ? $data['u_email'] : '';
            $userimage             = isset($data['data_pic'])               ? $data['data_pic'] : '';
            $search_first_name     = isset($data['ud_first_name'])           ? $data['ud_first_name'] : '';
            $search_last_name      = isset($data['ud_last_name'])            ? $data['ud_last_name'] : '';
            $search_display_name   = isset($data['u_displayname'])           ? $data['u_displayname'] : '';
            $search_phone_number   = isset($data['ud_phone_number'])         ? $data['ud_phone_number'] : '';


            $displayname        = isset($data['u_displayname'])             ? $data['u_displayname'] : '';          //ada
            $areas              = isset($data['state_drop'])                ? $data['state_drop'] : '';                   //ada nombor
            $course             = isset($data['level_drop'])                ? $data['level_drop'] : '';               //ada nombor    
            $u_admin_approve    = isset($data['u_admin_approve'])           ? $data['u_admin_approve'] : '';        //ada
            $subject            = isset($data['subject'])                   ? $data['subject'] : '';
            $location           = isset($data['location'])                  ? $data['location'] : '';
            $gender             = isset($data['u_gender'])                  ? $data['u_gender'] : '';               //ada
            $ud_race            = isset($data['ud_race'])                   ? $data['ud_race'] : '';                //ada
            $ud_tutor_status    = isset($data['ud_tutor_status'])           ? $data['ud_tutor_status'] : '';        //ada
            $tution_center      = isset($data['tution_center'])             ? $data['tution_center']    : '';       //ada nombor
            $current_occupation = isset($data['ud_current_occupation'])     ? $data['ud_current_occupation'] : '';  //ada
            $subject_check      = isset($data['subject_check'])             ? $data['subject_check'] : '';
            $city_check         = isset($data['city_check'])                ? $data['city_check'] : '';

            $validatedaa    = isset($data['validatedaa'])           ? $data['validatedaa'] : '';        //ada
            $experience    = isset($data['experience'])           ? $data['experience'] : '';        

        // } elseif ($search_tutor == 'No') {

            // For Non-Tutor

            // $search_role         = isset($data['u_role'])          ? $data['u_role'] : '';                       //ada nomborKOMEN
            $client_status  = isset($data['ud_client_status'])  ? $data['ud_client_status'] : '';                   //ada      
			$user_status  = isset($data['user_status'])  ? $data['user_status'] : ''; 
            // $ud_state       = isset($data['ud_state'])   ? $data['ud_state'] : '';                               //ada nomborKOMEN
            $messagecheckbox  = isset($data['messagecheckbox'])   ? $data['messagecheckbox'] : '';                    //TAK HANTAR VALUE LAGI
            
            $searchConductOnline = isset($data['searchConductOnline']) ? $data['searchConductOnline'] : ''; 
            $hiddentoolsname = isset($data['hiddentoolsname']) ? $data['hiddentoolsname'] : ''; 
            
            $searchConductClass  = isset($data['searchConductClass'])  ? $data['searchConductClass'] : '';   
            
            

            $search_ud_state = isset($data['search_ud_state']) ? $data['search_ud_state'] : ''; 
            $search_ud_city  = isset($data['search_ud_city'])  ? $data['search_ud_city'] : '';   
            $ud_workplace_state = isset($data['ud_workplace_state']) ? $data['ud_workplace_state'] : ''; 
            $ud_workplace_city  = isset($data['ud_workplace_city'])  ? $data['ud_workplace_city'] : '';   
            

            $level_taught  = isset($data['level_taught'])  ? $data['level_taught'] : '';   
            
            
            $parent_city  = isset($data['parent_city'])  ? $data['parent_city'] : '';   

                    $function = $_POST['functionname'];
                    $data = $_POST['data'];
                    // $rowperpage = $_POST['rowperpage'];

                switch($istutor){
                  case "Yes": 
                  $isTutor = $userInit->isTutor($data);
                  // echo json_encode(["message"=>$search_email]);
                  // echo json_encode(["message"=>$data['subject_check']]);//adaa
                   break;
                
                   case "No":
                   $isTutor = $userInit->isTutor($data);
                   // echo json_encode(["message"=>$messagecheckbox]);
                   break;
                   // break;
                   case "All":
                   $isTutor = $userInit->isTutor($data);
                   break;
				   
                   case "Admin":
                   $isTutor = $userInit->isTutor($data);
                   break;
                   default:
                   
                   echo json_encode(["message"=>'nope']);
                   break;
              }
           }
// luqman
            
?>