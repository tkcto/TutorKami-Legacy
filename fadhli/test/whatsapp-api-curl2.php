<?php
function url_test( $url ) {
	$timeout = 10;
	$ch = curl_init();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
	
	

   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'key: ePc8i7mnWq98Mi6vd1NxsxmRKQ4UsVa5',
      'Content-Type: application/json',
   ));
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
	
	$http_respond = curl_exec($ch);
	$http_respond = trim( strip_tags( $http_respond ) );
	$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
	if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
		return true;
	} else {
		// you can return $http_code here if necessary or wanted
		return false;
	}
	curl_close( $ch );
}

// simple usage:
$website = "https://wa.tutorkami.my/api-docs/";
if( !url_test( $website ) ) {
	echo $website ." is down!";
} else {
	echo $website ." functions correctly.";
}
?>