<?php
//require_once('includes/head.php');
require_once('classes/user.class.php');
$return = false;
$message = 'Please enable javascript in your browser.';
$instUser = new user;
if(isset($_REQUEST) && isset($_REQUEST['e'])) {
  $uid = base64_decode($_REQUEST['e']);
  
  $arrUser = $instUser->GetUserDetail($uid);
}
if(isset($_POST['rstpass'])){
   $data = $instUser->RealEscape($_POST);
   $res = $instUser->ResetAdminPassword($data);
   switch($res) {
        case '0': {
            $msg = '<div class="alert alert-danger">Database Error Occured.</div>';
            break;
        }
        case '1': {
            $msg = '<div class="alert alert-success">
                         <strong>Password  </strong> Reset Successfull.
                        </div>';
            break;
        }
        case '2': {
            $msg = '<div class="alert alert-warning">Password and Confirm Password Value Do Not Match</div>';
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
               
            <p>RESET PASSWORD</p>
            <form class="m-t" role="form" name="loginForm" id="loginForm" action="" method="post"> 
             <?php if(isset($_POST) && isset($_POST['rstpass'])) { echo $msg; }?>
                <input type="hidden" name="u_id" id="u_id" value="<?php echo isset($_REQUEST['e']) ? $arrUser['u_id'] : ''; ?>">
                <div class="form-group">
                    <input type="text" id="username" name="username"  class="form-control"   value="<?=$arrUser['u_username']?>" readonly="">
                </div>
                <div class="form-group">
                    <input type="password" id="pass" name="pass"  class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" id="cpass" name="cpass"  class="form-control" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="rstpass">Save</button>
                <input type="reset" class="btn btn-primary block full-width m-b" name="reset"/>
              </form>
            <p class="m-t"> <small>Copyright © 2017 TutorKami. All rights reserved</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    
</body>

</html>