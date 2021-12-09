<?php

require_once('user.class.php');

$userInit = new user;
		
					if(isset($_GET['action']) && $_GET['action'] == 'edit') {
               // $userData = $userInit->GetAllUser('', $_GET['u_id']);
              $userData = $userInit->GetAllUser('', $_GET['u_id']);//luqman tuka baru
               $userRow = $userData->fetch_array(MYSQLI_ASSOC);
               }

// 			if(isset($_POST['u_id'])){
//  			      $user_id = $_POST['u_id'];
//                // $userData = $userInit->GetAllUser('', $_GET['u_id']);
//               // $userData = $userInit->GetAllUserBaru($u_id);//luqman tuka baru
//               echo json_encode(["message"=>$user_id]);
//            }

              // echo json_encode(["message"=>'man']);
?>
