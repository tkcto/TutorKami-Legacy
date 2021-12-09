<?php require_once('includes/head.php'); ?>
<?php
$return = false;
$message = 'Please enable javascript in your browser.';
if(isset($_REQUEST) && isset($_REQUEST['login'])) {
    $return = $instAuth->Login($_REQUEST);
    //echo $return;
    //exit;
    switch($return) {
        case '0': {
            $message = '<div class="alert alert-warning">Please provide both username and password.</div>';
            break;
        }
        case '1': {
            $message = '<div class="alert alert-danger">
                         <strong>Invalid  </strong> Username or Password.
                        </div>';
            break;
        }
        case '2': {
            $message = '<div class="alert alert-warning">User has been temporarily disabled. Please contact system admin.</div>';
            break;
         }
        default: {
            
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<?php 
$title = 'Login | Tutorkami';
require_once('includes/html_head.php'); 
?>
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name"><a href="index.php"><img src="img/logo.png" alt="logo-img"></a></h1>
            </div>
            <h3>Welcome to <span class="orange">Tutorkami</span></h3>
            <p>Better Tutors , Better Results </p>
            <p>PLEASE SIGN IN!</p>
            <form class="m-t" role="form" name="loginForm" id="loginForm" action="" method="post"> 
             <?php if(isset($_REQUEST) && isset($_REQUEST['login'])) { echo $message; }?>
                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" value="<?php if(isset($_COOKIE["tutorkami_login"])) { echo $_COOKIE["tutorkami_login"]; } ?>" />
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" value="<?php if(isset($_COOKIE["tutorkami_password"])) { echo $_COOKIE["tutorkami_password"]; } ?>" />
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["tutorkami_login"])) { ?> checked <?php } ?> /> Keep me logged in
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="login">Login</button>
            </form>
            <a href="forgot-password.php" class="forget-link"><small>Forgot password?</small></a>
            <p class="m-t"> <small>Copyright © 2017 TutorKami. All rights reserved</small> </p>
        </div>
    </div>
</body>
</html>