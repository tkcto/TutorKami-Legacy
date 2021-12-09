<?php 

require_once('includes/head.php');

if (count($_POST) > 0) { 
	$data = $_POST;
	$output = system::FireCurl(TUTOR_REQUEST_URL, "POST", "JSON", $data);
	Session::SetFlushMsg($output->flag, $output->message);
	if ($output->flag == 'success') {
	    header( "refresh:5;url=http://www.tutorkami.my" );
        die("<strong>Thank you. Our Coordinator will get to you soon.</strong>");
	} else {
	    header( "refresh:5;url=http://www.tutorkami.my/request-tutor.php");
	    die("<font color=red>ERROR! Please try again!</font>");
	}
  
}
