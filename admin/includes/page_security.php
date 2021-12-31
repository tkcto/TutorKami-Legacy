<?php
$curPage = substr(trim(basename($_SERVER['PHP_SELF'])),0,-4);
/*if($curPage<>'login') {
	//all page except login
	if(!isset($_SESSION[DB_PREFIX]['u_id'])) {
		//if session is not saved
		header("Location:login.html");
	}
} else {
	//signin page
	if(isset($_SESSION[DB_PREFIX]['u_id'])) {
		//if session is set
		header("Location:dashboard.html");
	}
}*/

/* fadhli */
$newTime = date('h:i:s');
$timesplit=explode(':',$newTime);
$newTimeMinutes=($timesplit[0]*60)+($timesplit[1]);
//echo $newTimeMinutes." - ".$newTime."<br/>";

if(isset($_SESSION['current_time'])){
	$newTime2 = $_SESSION['current_time'];
	$sTimesplit=explode(':',$newTime2);
	$sNewTimeMinutes=($sTimesplit[0]*60)+($sTimesplit[1]);
	//echo $sNewTimeMinutes." - ".$newTime2."<br/>";
	$totalInMin = $newTimeMinutes - $sNewTimeMinutes;
	//echo $totalInMin;
}

switch($curPage) {
	case 'logout': {}break;
	case 'login':
	case 'register':
	case 'confirm':
	case 'check-username': {
		//signin page
		if(isset($_SESSION[DB_PREFIX]['u_id'])) {
			//if session is set
			//header("Location:dashboard.php");
			//header("Location:manage_user.php");
		}
		if(isset($_COOKIE["tutorkami_login"]) && isset($_COOKIE["tutorkami_password"])) {
			$data = array(
			'username' => $_COOKIE["tutorkami_login"],
			'password' => $_COOKIE["tutorkami_password"]);

			$return = $instAuth->Login($data);
			/*
			header('Location: '.$_SERVER['REQUEST_URI']);

			    $url1 =  $_SERVER['REQUEST_URI'];
			    header("Refresh: 10; URL=$url1");*/
			    
			    
			//header("Location:dashboard.php");
			//header("Location:manage_user.php");
		}
		break;
	}
	//case 'language-list':{
		//if(!isset($_SESSION[DB_PREFIX]['u_id'])) {
			//if session is not saved
			//header("Location:login.php");
		//}
		//break;
	//}
	default: {
		//all page except public pages
		if(!isset($_SESSION[DB_PREFIX]['u_id'])) {
			//if session is not saved
			// var_dump($_COOKIE);exit();
			if(isset($_COOKIE["tutorkami_login"]) && isset($_COOKIE["tutorkami_password"])) {
				$data = array(
				'username' => $_COOKIE["tutorkami_login"],
				'password' => $_COOKIE["tutorkami_password"]);

				//$return = $instAuth->Login($data);
			}			
			header("Location:login.php");
		} else {
			$pagePerm = $instAuth->CheckPagePerm($curPage.'.html');
			
			if($pagePerm['mp_view']=='1') {
				// View Access Granted
			} else {
				if($curPage=='profile' || $curPage=='change_password' || $curPage=='send_newsletter_manually') {
					//By Pass
				} else {
					header('HTTP/1.0 403 Forbidden');
					header('Location:403.php');
					echo "Access Denied"; exit;
				}
			}
		}
	}
}
?>
