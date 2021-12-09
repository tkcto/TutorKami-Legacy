<?php
// https://stackoverflow.com/questions/52446349/post-on-facebook-profile-page-timeline-using-facebook-graph-api-v3-1-php-sdk/52474202

if(!session_id()){
    session_start();
}

// Include the autoloader provided in the SDK
require_once __DIR__ . '/php-graph-sdk-5.x/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*
 * Configuration and setup Facebook SDK
 */
$appId         = 'APP_ID'; //Facebook App ID
$appSecret     = 'APP_SECRET'; //Facebook App Secret
$redirectURL   = 'MAIN_PAGE_URL_SAME_AS_IN_APPS_SETTING'; //Callback URL
//$fbPermissions = array('publish_actions'); //Facebook permission
$fbPermissions = array('manage_pages,publish_pages');                                  

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.6',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }else{
        $accessToken = $helper->getAccessToken();
    }
} catch(FacebookResponseException $e) {
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
}
?>