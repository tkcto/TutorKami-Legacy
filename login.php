<?php 
header('Location: https://www.tutorkami.com/tutor-login' );

require_once('includes/head.php');
# SESSION CHECK #
if (isset($_SESSION['auth'])) {
  header('Location: tutor.php');
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

   $output = system::FireCurl(LOGIN_URL, "POST", "JSON", $_POST);
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

      if (isset($_POST['redirect']) && $_POST['redirect'] != '') {
        if ( (isset($_GET['jid']) && $_GET['jid'] != '') && (isset($_GET['status']) && $_GET['status'] != '') ){
		  $_SESSION["firstlogin"] = "1";
		  header('Location: job_details.php?jid='.$_GET['jid'].'&status='.$_GET['status']);

          exit();
        }else{
          $_SESSION["firstlogin"] = "1";
          header('Location: '.$_POST['redirect']);
          exit();
        }
      } else {
		  if ( isset($_SESSION['url']) && (isset($_SESSION['url']) != '') ) {
			$_SESSION["firstlogin"] = "1";
			header('Location: '.$_SESSION['url']);
			exit();
		  }else{
			$_SESSION["firstlogin"] = "1";
			header('Location: tutor.php');
			exit();
		  }
		  
      }

    } else {
      header('Location: login.php');
      exit();
    }
}

include('includes/header.php');

$arrLogo = system::FireCurl(GET_SETTINGS.'?set=COMPANY_LOGO'); 
?>
<section class="sign_up_fb">
   <div class="container">
      <div class="col-md-12" align="center" >
      <?php foreach($arrLogo->data as $logo){ ?>
        <a href="index.php"><img src="admin/upload/<?php echo $logo->ss_settings_value;?>" alt="logo" class="img-responsive"></a>
      <?php } ?>
      </div>
      <div class="col-md-12 mrg_top30" align="center" >
         <!-- <a href="fb_login.php"><img src="images/fb.jpg" alt="logo" class="img-responsive"></a> -->
         <h2>Tutor Sign In</h2>
      </div>
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 mrg_top30">
         <!-- <div class="row or_style mrg_top30" align="center">
            <hr>
            <h4>OR</h4>
         </div> -->
         <form action="" method="post" class="form-horizontal">
            <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : ''; ?>" />
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
                        <a href="forgot_password.php"><?php echo FORGET_PASSWORD; ?></a>        
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">    
               <button type="submit" class="btn btn-default"><?php echo BUTTON_SIGN_IN; ?></button>   
            </div>
            <div class="form-group">
               <hr>
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col-sm-6 mrg_top20">
                     <p><?php echo DONT_HAVE_AN_ACCOUNT; ?></p>
                  </div>
                  <div class="col-sm-6 lower_btn">
                     <div class="checkbox forget-text">   
                        <a href="register.php" class="btn btn-default"><?php echo BUTTON_REGISTER_NOW; ?></a>   
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</section>
<?php include('includes/footer.php');?>