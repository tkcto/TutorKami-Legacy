<?php 

require_once('../classes/location.class.php');
require_once('../classes/app.class.php');
require_once('../classes/user.class.php');
require_once('../classes/job.class.php');

$instApp = new app;
$instLocation = new location;
$instUser = new user;
$instJob = new job;



// Luqman
if(isset($_POST['data'])){

	$data = $_POST['data'];

	$job_id 			= isset($data['job_id'])					?	$data['job_id'] : '';
	
	
	// echo json_encode(["response"=>$job_id]);//adaaa
	$jobidclientname = $instApp->getClientName($data);


}

if(isset($_POST['dataRS'])){

	$dataRS = $_POST['dataRS'];

	$job_id				= isset($dataRS['job_id'])					?	$dataRS['job_id'] : '';

	// echo json_encode(["response"=>$job_id]);//adaaa

	$getRateSubjectClass = $instUser->getRateSubjectClassFunc($dataRS);
}

if(isset($_POST['dataUJ'])){
	$dataUJ = $_POST['dataUJ'];

	$u_id				= isset($dataUJ['u_id'])					?	$dataUJ['u_id'] : '';

	// echo json_encode((["response"=> $u_id]));

	$getAllUserInfo = $instUser->getAllUserInfoFunc($dataUJ); 
}
// Luqman

?>