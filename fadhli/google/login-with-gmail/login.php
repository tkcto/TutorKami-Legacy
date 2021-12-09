<?PHP
/*
https://www.w3jar.com/login-with-google-account-using-php-mysqli-source-code/
Client ID : 1028579054867-sovc0vljfgv487ssrtdca64nkj7o0qkj.apps.googleusercontent.com
Client Secret : Pd7058ZUNarqwhZP7fIaTxr2
*/
?>



  <style type="text/css">
    #customBtn {
      display: inline-block;
      background: white;
      color: #444;
      width: 190px;
      border-radius: 5px;
      border: thin solid #888;
      box-shadow: 1px 1px 1px grey;
      white-space: nowrap;
    }
    #customBtn:hover {
      cursor: pointer;
    }
    span.label {
      font-family: serif;
      font-weight: normal;
    }
    span.icon {
      background: url('https://developers.google.com/identity/sign-in/g-normal.png') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      width: 42px;
      height: 42px;
    }
    span.buttonText {
      display: inline-block;
      vertical-align: middle;
      /*padding-left: 42px;
      padding-right: 42px;*/
      padding-left: 5px;
      
      font-size: 14px;
      font-weight: bold;
      /* Use the Roboto font that is loaded in the <head> */
      font-family: 'Roboto', sans-serif;
    }
    
    .ahref { 
        text-decoration: none; 
    } 

  </style>
<?php
require 'db_connection.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_SESSION['login_id'])){
    //header('Location: home.php');
    header("Location: https://www.tutorkami.com");
    exit;
}

require 'google-api/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('1028579054867-sovc0vljfgv487ssrtdca64nkj7o0qkj.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('Pd7058ZUNarqwhZP7fIaTxr2');
// Enter the Redirect URL
$client->setRedirectUri('https://www.tutorkami.com/fadhli/google/login-with-gmail/login');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);

        // checking user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT * FROM users_google WHERE google_id='$id'");
        if(mysqli_num_rows($get_user) > 0){
            $user = mysqli_fetch_assoc($get_user);
            $googleEmail = $user['email'];
            //$googleEmail = 'fadhlisbmz_client@gmail.com';

            $checkParent = mysqli_query($db_connection, " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_role='4' AND (u_email = '$googleEmail' || u_username = '$googleEmail' || ud_last_name = '$googleEmail') ");
            if(mysqli_num_rows($checkParent) > 0){
                $resultCheckParent = mysqli_fetch_assoc($checkParent);
                
                if($resultCheckParent['u_status'] == 'A'){

                      $updateLastActivity = mysqli_query($db_connection, " UPDATE tk_user SET u_modified_date = '".date('Y-m-d H:i:s')."' WHERE u_id='".$resultCheckParent['u_id']."' ");
                      if($updateLastActivity){
                          $_SESSION['auth'] = array(
                    
    	                    'user_id'       => $resultCheckParent['u_id'],
    	                    'user_name'     => $resultCheckParent['u_username'],
    	                    'first_name'    => $resultCheckParent['ud_first_name'],
    	                    'last_name'     => $resultCheckParent['ud_last_name'],
    	                    'display_name'  => $resultCheckParent['u_displayname'],
    	                    'user_email'    => $resultCheckParent['u_email'],
    	                    'user_role'     => $resultCheckParent['u_role'],
    	                    'user_gender'   => $resultCheckParent['u_gender'],
    	                    'user_pic'      => $resultCheckParent['u_profile_pic']
                    
                          );
                          
                          $_SESSION['login_id'] = $id; 
                          header("Location: https://www.tutorkami.com");
                          exit(); 
                      }else{
                          echo "Sign up failed!(Something went wrong).";
                          exit;
                      }   
                      
                }else if($resultCheckParent['u_status'] == 'B'){
                    echo "Your Account Has Been Banned !";
                    exit;
                }else{
                    echo "Your Account is not activated yet.";
                    exit;
                }
            }else{
                $_SESSION['login_id'] = $id; 
                header('Location: popup.php');
                exit;
            }
            
/*
            //$_SESSION['googleEmail'] = $user['email'];
            $_SESSION['login_id'] = $id; 
            //header('Location: home.php');
            header('Location: popup.php');
            exit;
*/
        }
        else{

            // if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `users_google`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");

            if($insert){
                $_SESSION['login_id'] = $id; 
                header('Location: popup.php');
                exit;
            }else{
                echo "Sign up failed!(Something went wrong).";
            }

        }

    }
    else{
        // kena betulkan
        header('Location: login.php');
        exit;
    }
    
else: 
    // Google Login Url = $client->createAuthUrl(); 
?>
  <div id="gSignInWrapper">
    <a id="customBtn" class="customGPlusSignIn ahref" href="<?php echo $client->createAuthUrl(); ?>">
      <span class="icon"></span>
      <span class="buttonText">Login With Google</span>
    </a>
  </div>
    <!--<a class="login-btn" href="<?php //echo $client->createAuthUrl(); ?>">Login</a>-->

<?php endif; ?>