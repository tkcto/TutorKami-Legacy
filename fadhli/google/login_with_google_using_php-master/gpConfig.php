<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
 /*
$clientId = '577698388672-u4nadr23kec753t10kp4neej548av9ir.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'Fe9XLxZ745Eh5v0NmXMBl0QV'; //Google client secret
$redirectURL = 'http://localhost/login_with_google_using_php/'; //Callback URL
*/
$clientId = '1028579054867-sovc0vljfgv487ssrtdca64nkj7o0qkj.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'Pd7058ZUNarqwhZP7fIaTxr2'; //Google client secret
$redirectURL = 'https://www.tutorkami.com/fadhli/google/login_with_google_using_php-master/index'; //Callback URL


//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('login_with_google_using_php');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
