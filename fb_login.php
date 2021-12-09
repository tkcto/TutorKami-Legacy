<?php 
require_once('includes/head.php');
# SESSION CHECK #
if (isset($_SESSION['auth'])) {
  header('Location: tutor.php');
  exit();
}
define('FACEBOOK_SDK_V4_SRC_DIR', DIR_ROOT.'/admin/libraries/Facebook/');

require_once(DIR_ROOT. 'admin/libraries/Facebook/autoload.php');
# Facebook APP #
$fb = new Facebook\Facebook([
	'app_id' => FB_APP_ID,
	'app_secret' => FB_APP_SECRET,
	'default_graph_version' => 'v2.8',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['publish_actions'];
// $permissions = ['user_likes'];

try {
	if (isset($_SESSION['fb_auth']['fb_app_token'])) {
		# Get Access Token from Session Variable #
		$accessToken = $_SESSION['fb_auth']['fb_app_token'];
	} else {
		# Get Access Token from User's FB #
		$accessToken = $helper->getAccessToken();
	}	
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	# When Graph returns error #
	echo "Graph returned an error: ". $e->getMessage();
	exit();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	# When validation fails or other local issues #
	echo "Facebook SDK returned an error: ". $e->getMessage();
	exit();
}

if (isset($accessToken)) {
	if (isset($_SESSION['fb_auth']['fb_app_token'])) {
		# Setting default access token to be used in script #
		$fb->setDefaultAccessToken($_SESSION['fb_auth']['fb_app_token']);
	} else {
		# Get short-lived access token #
		$_SESSION['fb_auth']['fb_app_token'] = (string) $accessToken;
		# Sample short-lived access token #
		// access_token=EAAZAytpe5zZCABACNiGKrKtWjbtObZBAd1PO1OvvLyGSBTBTjg3loCLAcy3PiR9pmRIHVyhrF7FOgO8eYglpK7E3J5Vu2KmTcjUTe98xGjxdjTRunbwhspRRltTx7c8TG21rQJO3ZC9Nc4Rzo8X0ifZALcDmOaNb9fRiUFUf4hwZDZD

		# OAuth 2.0 client handler #
		$oAuth2Client = $fb->getOAuth2Client();

		# Exchange a short-lived access token for a long-lived one #
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_auth']['fb_app_token']);
		# Sample long-lived access token #
		// access_token=EAAZAytpe5zZCABAFgOjhp3j0mofhK1GZCYDmOiuZBxoqOgwHO11iV16eY5BmZCUGdZCR63ZAViC3BXisPRI0iKoUNj7Wv8iqgSmmeNaODi6NdumVykHARALaeyIWfjmAY7R67CjDQJm5mzwns54EkGGlzGTny8dN6cZD&expires=5184000

		$_SESSION['fb_auth']['fb_app_token'] = (string) $longLivedAccessToken;

		# Setting default access token to be used in script #
		$fb->setDefaultAccessToken($_SESSION['fb_auth']['fb_app_token']);
	}

	# Redirect the user back to the same page if it has "code" GET variable #
	if (isset($_GET['code'])) {
		header('Location: fb_login.php');
	}

	# Getting basic info about user #
	try {
		$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
		$profile = $profile_request->getGraphNode()->asArray();
		$userNode = $profile_request->getGraphUser();

		$fb_profile = $profile;
		$fb_profile['u_email'] = $userNode->getField('email');
		$fb_profile['fb_app_token'] = $_SESSION['fb_auth']['fb_app_token'];
		$fb_profile['pic'] = 'https://graph.facebook.com/'. $profile['id'] .'/picture';

		/* Connect to core system */ 
		$output = system::FireCurl(FB_LOGIN_URL, "POST", "JSON", $fb_profile);
		Session::SetFlushMsg($output->flag, $output->message);

		if ($output->flag == 'success') {
			$_SESSION['auth'] = array(
				'user_id'       => $output->data->user_id,
				'user_name'     => $output->data->user_name,
				'display_name'  => $output->data->display_name,
				'user_email'    => $output->data->user_email,
				'user_role'     => $output->data->user_role,
				'user_gender'   => $output->data->user_gender,
				'user_pic'      => $output->data->user_pic
			);
			
			header('Location: '.APP_ROOT.'tutor.php');
			exit();
		} else{
			header('Location: '.APP_ROOT.'login.php');
			exit();
		}

	} catch (Facebook\Exceptions\FacebookResponseException $e) {
		# When Graph returns an error #
		echo "Graph returned an error: ". $e->getMessage();
		session_destroy();
		# Redirecting the user to app login page #
		header('Location: login.php');
		exit();
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		# When validation fails or other local issues #
		echo "Facebook SDK returned an error: ". $e->getMessage();
		header('Location: login.php');
		exit();
	}

	# Printing $profile array on the screen which holds the basic info about user #
	// var_dump($_SESSION);

	# Now you can redirect to anotherr page and use the access token from $_SESSION['fb_auth']['fb_app_token'] #
} else {
	# Replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here #
	$loginUrl = $helper->getLoginUrl(APP_ROOT.'fb_login.php/', $permissions);
	header("Location: ".$loginUrl);
}
