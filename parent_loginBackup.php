<?php 

require_once('includes/head.php');


# SESSION CHECK #

if (isset($_SESSION['auth'])) {

  header('Location: '.APP_ROOT);

  exit();

}

if (count($_POST) > 0) {

   if(!empty($_POST["remember"])) {

      setcookie ("member_login",$_POST["u_email"],time()+ (10 * 365 * 24 * 60 * 60));

      setcookie ("member_password",$_POST['u_password'],time()+ (10 * 365 * 24 * 60 * 60));

   } else {

      if(isset($_COOKIE["member_login"])) {

        setcookie ("member_login","");

      }

      if(isset($_COOKIE["member_password"])) {

        setcookie ("member_password","");

      }

   }



   $output = system::FireCurl(PARENT_LOGIN_URL, "POST", "JSON", $_POST);

   Session::SetFlushMsg($output->flag, $output->message);



   if ($output->flag == 'success') {



      $_SESSION['auth'] = array(

        'user_id'       => $output->data->user_id,

        'user_name'     => $output->data->user_name,

        'first_name'    => $output->data->first_name,

        'last_name'     => $output->data->last_name,

        'display_name'  => $output->data->display_name,

        'user_email'    => $output->data->user_email,

        'user_role'     => $output->data->user_role,

        'user_gender'   => $output->data->user_gender,

        'user_pic'      => $output->data->user_pic

      );



      header('Location: '.APP_ROOT);

      exit();    

   } else if($output->flag == 'error') {

      $message = $output->message;//ada string mesej

   }else {

      header('Location: parent_login.php');

      exit();

   }

    

}

//include('includes/header.php');
//include('includes/header-parent-login.php');

$arrLogo = system::FireCurl(GET_SETTINGS.'?set=COMPANY_LOGO');

?>


	  <title>Search for Private Tutor, Home Tuition & Tuisyen in Malaysia</title>
	  <meta name="description" content="Tutorkami is Malaysia's trusted and affordable private tutor & home tuition site" />
	  <meta name="keywords" content="home tutor, home tuition, home tuisyen, tuisyen rumah, homeschool, private tutor, private teacher, guru tuisyen" />
  
	  <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="css/swiper.min.css">   
      
      <!-- Autocomplete -->
      <link rel="stylesheet" href="css/jquery-ui.css">
      <link rel="stylesheet" href="css/flush.css">
      <link rel="stylesheet" href="css/custom.css">
      <link rel="stylesheet" type="text/css" href="css/component.css" />






      


      
<section class="sign_up_fb">

   <div class="container">

      <div class="col-md-12" align="center" >

      <?php foreach($arrLogo->data as $logo){ ?>

        <a href="index.php"><img src="admin/upload/<?php echo $logo->ss_settings_value;?>" alt="logo" class="img-responsive"></a>

      <?php } ?>

      </div>    


      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 mrg_top30">         

         <form action="" method="post" class="form-horizontal">


<?php 
if(!empty($message)){
?>	
            <div class="form-group">
				<div class="alert alert-danger" role="alert"><?php echo $message; ?></div>
			</div> 
<?php
}
?>


            <div class="form-group has-feedback">   

               <input type="text" name="u_email" class="form-control" placeholder="Email address" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" />

               <span class="glyphicon glyphicon-envelope form-control-feedback"></span>   

            </div>

            <div class="form-group has-feedback">    

               <input type="password" name="u_password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" />

               <span class="glyphicon glyphicon-lock form-control-feedback"></span>   

            </div>

            <div class="form-group">

               <div class="row">

                  <div class="col-sm-6">

                     <div class="checkbox">

                        <label><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> /> <?php echo REMEMBER_ME; ?></label>        

                     </div>

                  </div>

                  <div class="col-sm-6">

                     <div class="checkbox forget-text">

                        <a href="forget.php"><?php echo FORGET_PASSWORD; ?></a>        

                     </div>

                  </div>

               </div>

            </div>

            <div class="form-group">    

               <button type="submit" class="btn btn-default"><?php echo BUTTON_SIGN_IN; ?></button>   

            </div>            

         </form>
         <!-- **** START Login With Gmail **** -->
            <?php //include('fadhli/google/login-with-gmail/login.php');?>


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
require 'fadhli/google/login-with-gmail/db_connection.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_SESSION['login_id'])){
    header("Location: https://www.tutorkami.com");
    exit;
}

require 'fadhli/google/login-with-gmail/google-api/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('1016710770585-k9kbus08et6t8cpm17m6pna3e3ajmvk6.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('dUPF1BP63K2mcqreT0tge7FV');
// Enter the Redirect URL
$client->setRedirectUri('https://www.tutorkami.com/parent_login');

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
                header('Location: https://www.tutorkami.com/gmail-popup.php');
                exit;
            }
            

        }
        else{

            // if user not exists we will insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `users_google`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");

            if($insert){
                $_SESSION['login_id'] = $id; 
                header('Location: https://www.tutorkami.com/gmail-popup.php');
                exit;
            }else{
                echo "Sign up failed!(Something went wrong).";
            }

        }

    }
    else{
        // kena betulkan
        header('Location: https://www.tutorkami.com/parent_login');
        exit;
    }
    
else: 
?>
  <div id="gSignInWrapper">
    <a id="customBtn" class="customGPlusSignIn ahref" href="<?php echo $client->createAuthUrl(); ?>">
      <span class="icon"></span>
      <span class="buttonText">Login With Google</span>
    </a>
  </div>

<?php endif; ?>
            
            
         <!-- **** END Login With Gmail **** -->
      </div>

   </div>

</section>

<?php include('includes/footer.php');?>