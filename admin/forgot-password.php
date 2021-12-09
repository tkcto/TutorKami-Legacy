<?php
//require_once('includes/head.php');
require_once('classes/user.class.php');
$return = false;
$message = 'Please enable javascript in your browser.';
$instUser = new user;
if(isset($_REQUEST) && isset($_REQUEST['forgetpass'])) {
  $email = $_REQUEST['email'];
  
  $resUser = $instUser->GetUserByEmail($email);
  if($resUser->num_rows){

    $arrUser = $resUser->fetch_assoc();
    $uname = $arrUser['u_username'];
    $user_id = base64_encode($arrUser['u_id']);
    
    $host = 'https://'.$_SERVER['SERVER_NAME']; 
    $from = "durga@manfredinfotech.com";

    $link = $host."/tutorkami/admin/reset-password.php?e=".$user_id; 
    $header = "Mime-Version: 1.0 \r\n";
    $header .= "Content-type: text/html; charset=\"UTF-8\";\r\n";
    $header .= "From:<$from>";
    
    $subject = "Your Tutorkami Password Reset";
    $message = "Hi $uname,<br><br> Greetings from tutorkami.com Team !!!!! <br><br> You have attempted to reset the password for the registered email ID $email.<br>";
    $message .= "Please click on the below link to reset your password: <br><br> <a href='".$link."'>$link</a><br><br><br><br>";
    $message .= "Thanks & Regards, <br>Tutorkami Team";
    $m = mail($email,$subject,$message,$header);
    if($m){
        $msg = '<div class="alert alert-success">Mail been sent successfully!</div>';
        }
    else{
        
        $msg = '<div class="alert alert-danger">Mail cannot be sent!</div>';
    }
  }
  else{
      $msg = '<div class="alert alert-warning">This is not a registerd email!</div>';
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
               
            <p>FORGOT YOUR PASSWORD!</p>
            <form class="m-t" role="form" name="loginForm" id="loginForm" action="" method="post"> 
             <?php if(isset($_REQUEST) && isset($_REQUEST['forgetpass'])) { echo $msg; }?>
                <div class="form-group">
                    <input type="email" id="email" name="email"  class="form-control" placeholder="Your Registered Email" required>
                </div>
                
                <button type="submit" class="btn btn-primary block full-width m-b" name="forgetpass">Send Link</button>
            </form>
            <p class="m-t"> <small>Copyright © 2017 TutorKami. All rights reserved</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
</body>

</html>
