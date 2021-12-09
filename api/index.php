<?php 
/** 
 * @author: Subhadeep Chowdhury
 * Project: Tutorkami
 * Caution: Please do not change the order of the included files.
 */
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kuala_Lumpur');
# LOAD GLOBAL CONFIG FILE #
require_once('../admin/classes/config.php.inc');

require_once('../admin/classes/user.class.php');
require_once('core/RestHandler.php');
require_once('modules/APIUser.php');
require_once('modules/APIJob.php');
require_once('modules/APICms.php');

$handler = new RestHandler();

$action = "";
if(isset($_REQUEST["action"]))
	$action = $_REQUEST["action"];

switch($action){

	case "login":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$init = new APIUser;
			$result = $init->SignIn($data);
		}
		
		$handler->sendResponse($result);
		break;

	case "parent-login":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$init = new APIUser;
			$result = $init->ParentSignIn($data);
		}
		
		$handler->sendResponse($result);
		break;

	case "fb-login":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$init = new APIUser;
			$result = $init->fbLogin($data);
		}
		
		$handler->sendResponse($result);
		break;

	case "forgot":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$init = new APIUser;
			$result = $init->ForgetPassword($data);
		}
		
		$handler->sendResponse($result);
		break;

	case "registration":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$init = new APIUser;
			$result = $init->SignUp($data);
		}
		
		$handler->sendResponse($result);
		break;

	case "RFORM":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$init = new APIUser;
			$result = $init->RFORM($data);
		}
		
		$handler->sendResponse($result);
		break;

	case "parent-registration":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$init = new APIUser;
			$result = $init->ParentSignUp($data);
		}
		
		$handler->sendResponse($result);
		break;

	case "list-course":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			$instUser = new APIUser;
			$course_id = (isset($_GET['course_id']) && $_GET['course_id'] > 0) ? $_GET['course_id'] : '';
			$resUser = $instUser->ListCourse($course_id);
			$arrUser = array();

			if ($resUser->num_rows > 0) {
	            while( $row = $resUser->fetch_assoc() ){
	            	array_push($arrUser, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrUser);
		}

		$handler->sendResponse($result);
		break;

	case "list-subject":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			$instUser = new APIUser;
			$subject_id = (isset($_GET['subject_id']) && $_GET['subject_id'] > 0) ? $_GET['subject_id'] : '';
			$resUser = (isset($_GET['course_id']) && $_GET['course_id'] > 0) ? $instUser->CourseWiseSubject($_GET['course_id']) : $instUser->ListSubject($subject_id);
			$arrUser = array();

			if ($resUser->num_rows > 0) {
	            while( $row = $resUser->fetch_assoc() ){
	            	array_push($arrUser, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrUser);
		}

		$handler->sendResponse($result);
		break;

	case "list-countries":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			$instUser = new APIUser;
			$country_id = (isset($_GET['country_id']) && $_GET['country_id'] > 0) ? $_GET['country_id'] : '';
			$resUser = $instUser->ListCountry($country_id);
			$arrUser = array();

			if ($resUser->num_rows > 0) {
	            while( $row = $resUser->fetch_assoc() ){
	            	array_push($arrUser, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrUser);
		}

		$handler->sendResponse($result);
		break;

	case "list-state":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			
			$arrUser = array();
			$instUser = new APIUser;

			if(isset($_GET['country_id']) && $_GET['country_id'] > 0){
				$resUser = $instUser->CountryWiseState((int)$_GET['country_id']);
			} elseif (isset($_GET['state_id']) && $_GET['state_id'] > 0) {
				$resUser = $instUser->ListState((int)$_GET['state_id']);
			} else {
				$resUser = $instUser->ListState();
			}

			if ($resUser->num_rows > 0) {
	            while( $row = $resUser->fetch_assoc() ){
	            	array_push($arrUser, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrUser);
		}

		$handler->sendResponse($result);
		break;
		
	case "list-city":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			
			$arrUser = array();
			$instUser = new APIUser;

			if(isset($_GET['state_id']) && $_GET['state_id'] > 0){
				$resUser = $instUser->StateWiseCity((int)$_GET['state_id']);
			} elseif (isset($_GET['city_id']) && $_GET['city_id'] > 0) {
				$resUser = $instUser->ListCity((int)$_GET['city_id']);
			} else {
				$resUser = $instUser->ListCity();
			}

			if ($resUser->num_rows > 0) {
	            while( $row = $resUser->fetch_assoc() ){
	            	array_push($arrUser, $row);
	            	
	            }
	        }
				//	$arrUser = sort($arrUser);
				 //asort($arrUser);
			//	usort($arrUser, function($a, $b){ return strcmp($a["city_name"], $b["city_name"]); });
			//	print_r($arrUser);
				// array_multisort($arrUser[1], SORT_ASC, SORT_STRING, $ar[0]);
	        $result = array('flag' => 'success', 'data' => $arrUser);
		}

		$handler->sendResponse($result);
		break;

	case "list-user":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			$instUser = new APIUser;
			if(isset($_GET['user_id']) && $_GET['user_id'] > 0){
				$resUser = $instUser->GetUser('', (int)$_GET['user_id']);
			} elseif(isset($_GET['display_id']) && $_GET['display_id'] != ''){
				$resUser = $instUser->GetTutorByDisplayID($_GET['display_id']);
			} else {
				$resUser = $instUser->GetUser();
			}
			
			$arrUser = array();

			if ($resUser->num_rows > 0) {
	            while( $row = $resUser->fetch_assoc() ){
	            	array_push($arrUser, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrUser);
		}

		$handler->sendResponse($result);
		break;

	case "update-profile":
		/**
		 * METHOD: PUT
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method PUT.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);

			$init = new APIUser;
			$result = $init->UpdateAccount($data);
		}		

		$handler->sendResponse($result);
		break;

	case "user-password":
		/**
		 * METHOD: PUT
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method PUT.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);

			$init = new APIUser;
			$result = $init->UpdatePassword($data);
		}		

		$handler->sendResponse($result);
		break;

	case "user-area-count":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			
			$instUser = new APIUser;
			$user_id  = isset($_GET['user_id']) && $_GET['user_id'] > 0 ? (int)$_GET['user_id'] : '';
			$state_id = isset($_GET['state_id']) && $_GET['state_id'] > 0 ? (int)$_GET['state_id'] : '';
			$city_id  = isset($_GET['city_id']) && $_GET['city_id'] > 0 ? (int)$_GET['city_id'] : '';

			if($user_id == ''){
				$result = array('flag' => 'error', 'message' => "User ID is required.");
			} elseif ($state_id != '') {
				$resUser = $instUser->UserWiseState($user_id, $state_id);
		        $result  = array('flag' => 'success', 'data' => $resUser->num_rows);
			} elseif ($city_id != '') {
				$resUser = $instUser->UserWiseCity($user_id, $city_id);
		        $result  = array('flag' => 'success', 'data' => $resUser->num_rows);
			} else {
				$result = array('flag' => 'error', 'message' => "User State ID or City ID is required.");
		    }
		}

		$handler->sendResponse($result);
		break;

	case "user-area-other":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			
			$instUser 	= new APIUser;
			$user_id  = isset($_GET['user_id']) && $_GET['user_id'] > 0 ? (int)$_GET['user_id'] : '';
			$state_id = isset($_GET['state_id']) && $_GET['state_id'] > 0 ? (int)$_GET['state_id'] : '';
			
			if($user_id == ''){
				$result = array('flag' => 'error', 'message' => "User ID is required.");
			} elseif ($state_id != '') {
				$resUser = $instUser->UserWiseOtherState($user_id, $state_id);
		        $result  = array('flag' => 'success', 'data' => $resUser);
			} else {
				$result = array('flag' => 'error', 'message' => "User State ID is required.");
		    }
		}

		$handler->sendResponse($result);
		break;

	case "user-subject-count":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			
			$instUser 	= new APIUser;
			$user_id  	= isset($_GET['user_id']) && $_GET['user_id'] > 0 ? (int)$_GET['user_id'] : '';
			$course_id 	= isset($_GET['course_id']) && $_GET['course_id'] > 0 ? (int)$_GET['course_id'] : '';
			$subject_id = isset($_GET['subject_id']) && $_GET['subject_id'] > 0 ? (int)$_GET['subject_id'] : '';

			if($user_id == ''){
				$result = array('flag' => 'error', 'message' => "User ID is required.");
			} elseif ($course_id != '') {
				$resUser = $instUser->UserWiseCourse($user_id, $course_id);
		        $result  = array('flag' => 'success', 'data' => $resUser->num_rows);
			} elseif ($subject_id != '') {
				$resUser = $instUser->UserWiseSubject($user_id, $subject_id);
		        $result  = array('flag' => 'success', 'data' => $resUser->num_rows);
			} else {
				$result = array('flag' => 'error', 'message' => "User Course ID or Subject ID is required.");
		    }
		}

		$handler->sendResponse($result);
		break;

	case "user-subject-other":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			
			$instUser 	= new APIUser;
			$user_id  	= isset($_GET['user_id']) && $_GET['user_id'] > 0 ? (int)$_GET['user_id'] : '';
			$course_id 	= isset($_GET['course_id']) && $_GET['course_id'] > 0 ? (int)$_GET['course_id'] : '';
			
			if($user_id == ''){
				$result = array('flag' => 'error', 'message' => "User ID is required.");
			} elseif ($course_id != '') {
				$resUser = $instUser->UserWiseOtherCourse($user_id, $course_id);
		        $result  = array('flag' => 'success', 'data' => $resUser);
			} else {
				$result = array('flag' => 'error', 'message' => "User Course ID is required.");
		    }
		}

		$handler->sendResponse($result);
		break;

	case "check-applied-job":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			$instJob = new APIJob;
			$job_id = (isset($_GET['job_id']) && $_GET['job_id'] > 0) ? $_GET['job_id'] : 0;
			$user_id = (isset($_GET['user_id']) && $_GET['user_id'] > 0) ? $_GET['user_id'] : 0;
			$resJob = $instJob->JobUserStatus($job_id, $user_id);
			
	        $result = array('flag' => 'success', 'data' => $resJob);
		}

		$handler->sendResponse($result);
		break;

	case "list-level":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			$instJob = new APIJob;
			$lang_code = (isset($_GET['lang_code']) && $_GET['lang_code'] > 0) ? $_GET['lang_code'] : 'en';
			$level_id = (isset($_GET['level_id']) && $_GET['level_id'] > 0) ? $_GET['level_id'] : '';
			$resJob = $instJob->ListLevel($lang_code, $level_id);
			$arrJob = array();

			if ($resJob->num_rows > 0) {
	            while( $row = $resJob->fetch_assoc() ){
	            	array_push($arrJob, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrJob);
		}

		$handler->sendResponse($result);
		break;

	case "search-job":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$arrJob = array();
			$init 	 = new APIJob;
			$resJob = $init->SearchJob($data);

			if ($resJob->num_rows > 0) {
	            while ( $row = $resJob->fetch_assoc() ) {	            	
	            	array_push($arrJob, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrJob);
		}
		
		$handler->sendResponse($result);
		break;

	case "apply-job":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$arrJob = array();
			$init 	 = new APIJob;
			$result = $init->ApplyJob($data);
		}
		
		$handler->sendResponse($result);
		break;

	case "search-location":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APIUser;
			$result = $init->SearchLocation($_GET);
		}
		
		$handler->sendResponse($result);
		break;

	case "search-subject":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APIUser;
			$result = $init->SearchSubject($_GET);
		}
		
		$handler->sendResponse($result);
		break;

    case "cms":
         $arrCms = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init 	 = new APICms;
			$lang_code = (isset($_GET['lang']) && $_GET['lang'] != '') ? $_GET['lang'] : $init->GetDefaultLanguage();
			$resCms = $init->GetContent($_GET['cms_id'],$lang_code);

			if ($resCms->num_rows > 0) {
	            while( $row = $resCms->fetch_assoc() ){
	            	array_push($arrCms, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrCms);
		 }
		
		$handler->sendResponse($result);
		break;

	case "slider":
	    $arrSlider = array();
            if($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		    } else {
			$init 	 = new APICms;
			$resSlider = $init->GetSlider();

			if ($resSlider->num_rows > 0) {
	            while( $row = $resSlider->fetch_assoc() ){
	            	array_push($arrSlider, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrSlider);
		 }
		
		$handler->sendResponse($result);
		break;
		
    case "user-testimonial":
        $arrTestimonial = array();
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	= new APIUser;
			$limit 	= isset($_GET['limit']) ? $_GET['limit'] : '';
			$uid 	= isset($_GET['uid']) ? $_GET['uid'] : '';
			$resTestimonial = $init->GetUserTestimonial($uid, $limit);

			if ($resTestimonial->num_rows > 0) {
	            while( $row = $resTestimonial->fetch_assoc() ){
	            	array_push($arrTestimonial, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrTestimonial);
		}
		
		$handler->sendResponse($result);
		break;

	case "search-tutor":
		/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$arrTutor = array();
			$init 	 = new APIUser;
			$resTutor = $init->SearchTutor($data);

			if ($resTutor->num_rows > 0) {
	            while ( $row = $resTutor->fetch_assoc() ) {	            	
	            	array_push($arrTutor, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrTutor);
		}
		
		$handler->sendResponse($result);
		break;

    case "list-tutor":
	    $arrTutor = array();
        if($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APICms;
			$resTutor = $init->GetTutor();

			if ($resTutor->num_rows > 0) {
	            while( $row = $resTutor->fetch_assoc() ){
	            	array_push($arrTutor, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrTutor);
		}
		
		$handler->sendResponse($result);
		break;

    case "list-tutor2":
	    $arrTutor = array();
        if($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APICms;
			$resTutor = $init->GetTutor2();

			if ($resTutor->num_rows > 0) {
	            while( $row = $resTutor->fetch_assoc() ){
	            	array_push($arrTutor, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrTutor);
		}
		
		$handler->sendResponse($result);
		break;
		
		
		

	case "list-language":
         $arrLang = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init 	 = new APICms;
			$resLang = $init->GetLanguage();

			if ($resLang->num_rows > 0) {
	            while( $row = $resLang->fetch_assoc() ){
	            	array_push($arrLang, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrLang);
		 }
		
		$handler->sendResponse($result);
		break;

	 case "get-language":
	  	$arrLanguage = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init = new APICms;
			$lang = (isset($_GET['lan']) && $_GET['lan'] != '') ? $_GET['lan'] : $init->GetDefaultLanguage();
			$resLanguage = $init->SelectedLanguage($lang);

			if ($resLanguage->num_rows > 0) {
	            while( $row = $resLanguage->fetch_assoc() ){
	            	array_push($arrLanguage, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrLanguage);
		 }
		
		$handler->sendResponse($result);
		break;

	 case "get-seo":
	  	$arrLanguage = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init 	 = new APICms;
			$resLanguage = $init->GetLanguageSEOContent($_GET['current_page'], $_GET['lang_code']);

			if ($resLanguage->num_rows > 0) {
	            while( $row = $resLanguage->fetch_assoc() ){
	            	array_push($arrLanguage, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrLanguage);
		 }
		
		$handler->sendResponse($result);
		break;

	 case "get-resource":
	  	$arrLanguage = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init = new APICms;
			$lang = (isset($_GET['lang_code']) && $_GET['lang_code'] != '') ? $_GET['lang_code'] : $init->GetDefaultLanguage();
			$resLanguage = $init->GetLanguageRESContent($lang);

			if ($resLanguage->num_rows > 0) {
	            while( $row = $resLanguage->fetch_assoc() ){
	            	array_push($arrLanguage, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrLanguage);
		 }
		
		$handler->sendResponse($result);
		break;

	 case "tutor-request":
	  	/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$arrJob = array();
			$init 	 = new APIUser;
			$result = $init->TutorRequest($data);
		}
		
		$handler->sendResponse($result);
		break;    
		
	 case "tutor-request2":
	  	/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$arrJob = array();
			$init 	 = new APIUser;
			$result = $init->TutorRequest2($data);
		}
		
		$handler->sendResponse($result);
		break;   

	 case "tutor-classes":
	  	/**
		 * METHOD: GET
		 */
	  	$data_arr = array();
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APIUser;
			$class_id = isset($_GET['cid']) ? $_GET['cid'] : '';
			$display_id = isset($_GET['displayid']) ? $_GET['displayid'] : '';
			$res = $init->TutorWiseClasses($_GET['uid'], $class_id, $display_id);

			if ($res->num_rows > 0) {
	            while($row = $res->fetch_assoc()){
	            	array_push($data_arr, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $data_arr);
		}
		
		$handler->sendResponse($result);
		break;    

	 case "parent-classes":
	  	/**
		 * METHOD: GET
		 */
	  	$data_arr = array();
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APIUser;
			$class_id = isset($_GET['cid']) ? $_GET['cid'] : '';
			$res = $init->StudentWiseClasses($_GET['uid'], $class_id);

			if ($res->num_rows > 0) {
	            while( $row = $res->fetch_assoc() ){
	            	array_push($data_arr, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $data_arr);
		}
		
		$handler->sendResponse($result);
		break;

	 case "payment-history":
	  	/**
		 * METHOD: GET
		 */
	  	$data_arr = array();
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APIUser;
			$res = $init->UserWisePaymentHistory($_GET['uid']);

			if ($res->num_rows > 0) {
	            while( $row = $res->fetch_assoc() ){
	            	array_push($data_arr, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $data_arr);
		}
		
		$handler->sendResponse($result);
		break;

	 case "class-records":
	  	/**
		 * METHOD: GET
		 */
	  	$data_arr = array();
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APIUser;
			$class_id = isset($_GET['cid']) ? $_GET['cid'] : '';
			$tutor_id = isset($_GET['tutor_id']) ? $_GET['tutor_id'] : '';
			$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : '';
			$res = $init->ClassWiseRecord($class_id, $student_id, $tutor_id);

			if ($res->num_rows > 0) {
	            while( $row = $res->fetch_assoc() ){
	            	array_push($data_arr, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $data_arr);
		}
		
		$handler->sendResponse($result);
		break;

	 case "add-class-records":
	  	/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$arrJob = array();
			$init 	 = new APIUser;
			$result = $init->AddRecord($data);
		}
		
		$handler->sendResponse($result);
		break;

	 case "verify-class-records":
	  	/**
		 * METHOD: PUT
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method PUT.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$arrJob = array();
			$init 	 = new APIUser;
			$result = $init->VerifyRecord($data);
		}
		
		$handler->sendResponse($result);
		break;

	 case "review-tutor":
	  	/**
		 * METHOD: POST
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method POST.');
		} else {
			$fp = fopen('php://input', 'r');
			$rawData = stream_get_contents($fp);
			$data = json_decode($rawData, true);
			
			$arrJob = array();
			$init 	 = new APIUser;
			$result = $init->ReviewTutor($data);
		}
		
		$handler->sendResponse($result);
		break;

	 case "list-review":
	  	/**
		 * METHOD: GET
		 */
	  	$data_arr = array();
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APIUser;
			$tutor_id = isset($_GET['tutor_id']) ? $_GET['tutor_id'] : '';
			$parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : '';

			if ($parent_id != '') {
				$res = $init->ParentListReview($parent_id);
			}else{
				$res = $init->TutorListReview($tutor_id);
			}

			if ($res->num_rows > 0) {
	            while( $row = $res->fetch_assoc() ){
	            	array_push($data_arr, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $data_arr);
		}
		
		$handler->sendResponse($result);
		break;

	 case "list-review-approve":
	  	/**
		 * METHOD: GET
		 */
	  	$data_arr = array();
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else {
			$init 	 = new APIUser;
			$tutor_id = isset($_GET['tutor_id']) ? $_GET['tutor_id'] : '';
			$parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : '';

			if ($parent_id != '') {
				$res = $init->ParentListReviewApprove($parent_id);
			}else{
				$res = $init->TutorListReviewApprove($tutor_id);
			}

			if ($res->num_rows > 0) {
	            while( $row = $res->fetch_assoc() ){
	            	array_push($data_arr, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $data_arr);
		}
		
		$handler->sendResponse($result);
		break;

	 case "get-settings":
	  	$arrSetttings = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init 	 = new APICms;
			$resSetttings = $init->GetSettings($_GET['set']);

			if ($resSetttings->num_rows > 0) {
	            while( $row = $resSetttings->fetch_assoc() ){
	            	array_push($arrSetttings, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrSetttings);
		 }
		
		$handler->sendResponse($result);
		break;

	 case "tutor-activation":
	  	$arrSetttings = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init 	= new APIUser;
			$result = $init->ActivateTutor($_GET['u_email']);
		 }
		
		$handler->sendResponse($result);
		break;

	 case "get-class-guide":
	  	$arrSetttings = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init 	= new APIUser;
			$response = $init->GetClassGuide($_GET['user_id']);
			$result = array('flag' => 'success', 'data' => $response);
		 }
		
		$handler->sendResponse($result);
		break;

	 case "update-class-guide":
	  	$arrSetttings = array();
         if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		 } else {
			$init 	= new APIUser;
			$response = $init->UpdateClassGuide($_GET['user_id'], $_GET['status']);
			$result = array('flag' => 'success', 'data' => $response);
		 }
		
		$handler->sendResponse($result);
		break;
    
    case "find-city":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			
			$arrUser = array();
			$instUser = new APIUser;
			$cityTerm = isset($_GET['city_name']) ? urldecode($_GET['city_name']) : '';

			$resUser = $instUser->ListCity('', $cityTerm);

			if ($resUser->num_rows > 0) {
	            while( $row = $resUser->fetch_assoc() ){
	            	array_push($arrUser, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrUser);
		}

		$handler->sendResponse($result);
		break;
    
    case "find-subject":
		/**
		 * METHOD: GET
		 */
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET. ');
		} else {
			
			$arrUser = array();
			$instUser = new APIUser;
			$subjectTerm = isset($_GET['subject_title']) ? urldecode($_GET['subject_title']) : '';

			$resUser = $instUser->ListSubject('', $subjectTerm);

			if ($resUser->num_rows > 0) {
	            while( $row = $resUser->fetch_assoc() ){
	            	array_push($arrUser, $row);
	            }
	        }

	        $result = array('flag' => 'success', 'data' => $arrUser);
		}

		$handler->sendResponse($result);
		break;

}
?>