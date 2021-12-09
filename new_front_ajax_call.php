<?php 

require_once('includes/head.php');
require_once('admin/classes/user.class.php');
$userInit = new user;

if(isset($_POST['data'])){

	$data = $_POST['data'];

            $gender             = isset($data['u_gender'])                  ? $data['u_gender'] : '';               
            $ud_race            = isset($data['ud_race'])                   ? $data['ud_race'] : '';                
            $ud_tutor_status    = isset($data['ud_tutor_status'])           ? $data['ud_tutor_status'] : '';        
            $current_occupation = isset($data['ud_current_occupation'])     ? $data['ud_current_occupation'] : '';  
            $tution_center      = isset($data['tution_center'])             ? $data['tution_center']    : '';       
            
            $areas              = isset($data['state_drop'])                ? $data['state_drop'] : '';             
            $course             = isset($data['level_drop'])                ? $data['level_drop'] : '';             
            $u_admin_approve    = isset($data['u_admin_approve'])           ? $data['u_admin_approve'] : '';        
            $subject            = isset($data['subject'])                   ? $data['subject'] : '';
            $location           = isset($data['location'])                  ? $data['location'] : '';
            $subject_check      = isset($data['subject_check'])             ? $data['subject_check'] : '';
            $city_check         = isset($data['city_check'])                ? $data['city_check'] : '';


            $conductOnline             = isset($data['conductOnline'])                  ? $data['conductOnline'] : '';        

                   // echo json_encode(["response"=>$data['state_drop']]);
                   $SearchTutorFE = $userInit->SearchTutorFE($data);
                   
            /*(if($conductOnline != ''){
                  require_once('admin/classes/user-class.php');
                  $userInit = new user;
                  $SearchTutorConductOnline = $userInit->SearchConductOnline($data);
            }else{
                  
                  require_once('admin/classes/user.class.php');
                  $userInit = new user;
                  $SearchTutorFE = $userInit->SearchTutorFE($data);
            }*/
          
}

if(isset($_POST['datanew'])){
      $data = $_POST['datanew'];
      $cl_id      = isset($data['cl_id']) ?     $data['cl_id'] : '';
      $calcBalanceNewFE = $userInit->calcBalanceNewFE($data);
}
?>