<?php 

require_once('includes/head.php');
require_once('admin/classes/user.class.php');

$userInit = new user;

//untuk displaykan subject
if(isset($_POST['data'])){

	$data = $_POST['data'];

            $userid             = isset($data['userid'])                  ? $data['userid'] : '';   
            $displayid             = isset($data['displayid'])                  ? $data['displayid'] : '';                        

            	 // echo json_encode(["response"=>$userid]);

            
             $LoadProfileUser = $userInit->LoadProfileUser($data);
          
}
if(isset($_POST['dataBM'])){

	$data = $_POST['dataBM'];

            $userid             = isset($data['userid'])                  ? $data['userid'] : '';   
            $displayid             = isset($data['displayid'])                  ? $data['displayid'] : '';                        

            	 // echo json_encode(["response"=>$userid]);

            
             $LoadProfileUser = $userInit->LoadProfileUserBM($data);
          
}

// untuk displaykan displayid dekat profile page
if(isset($_POST['dataid'])){

	$data = $_POST['dataid'];

            $userid             = isset($data['userid'])                  ? $data['userid'] : '';
            $displayid             = isset($data['displayid'])                  ? $data['displayid'] : '';                        

            	 // echo json_encode(["response"=>$userid]);

            
             $LoadIDUser = $userInit->LoadIdUser($data);
          
}



if(isset($_POST['dataArea'])){

    $data = $_POST['dataArea'];

    $userid    = isset($data['userid'])    ? $data['userid'] : '';
    $displayid = isset($data['displayid']) ? $data['displayid'] : '';                        

    $LoadArea = $userInit->LoadArea($data);
          
}

?>