<?php 

require_once('../classes/user.class.php');


$instUser = new user;

// Luqman
if(isset($_POST['data'])){
	$data = $_POST['data'];

	$cl_id				= isset($data['cl_id'])						?	$data['cl_id'] : '';
	//fadhli
	$cl_cycle				= isset($data['cl_cycle'])						?	$data['cl_cycle'] : '';
	

	// echo json_encode(["response"=>$cl_id]);//adaaa

	$calcbalanceNew = $instUser->calcBalanceNew($data);
}
// Luqman

?>