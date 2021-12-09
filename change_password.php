<?php 

require_once('includes/head.php');

# SESSION CHECK #

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['auth'])) {

  header('Location: tutor-login.php');

  exit();

}



if (count($_POST) > 0) {

  $data = $_POST;



  $output = system::FireCurl(PASSWORD_UPDATE_URL, "PUT", "JSON", $data);

  

  Session::SetFlushMsg($output->flag, $output->message);

  if ($output->flag == 'success') {

    if( isset($_SESSION['auth']['user_role']) && $_SESSION['auth']['user_role'] == '4' ){
        header('Location: clients_profile.php');
        exit();
    }

  } else {

     

  }

  

}



//unset($_SESSION['firstlogin']);
include('includes/header.php');
$_SESSION['getPage'] = "Change Password";
unset($_SESSION["firstlogin"]);
?>

<section class="my_profile">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">

            <div>

               <h1 class="blue-txt text-uppercase text-center"> Change Password</h1>

               <hr>

            </div>

            <div class="col-md-12 mrg_top30">

               <form method="post" class="form-horizontal">

                  <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['auth']['user_id']) ? $_SESSION['auth']['user_id'] : '';?>">

                  <div class="form-group">

                     <label class="control-label col-sm-4" for="pwd"><?php echo OLD_PASSWORD; ?>:</label>

                     <div class="col-sm-8"> 

                        <input type="password" class="form-control" id="pwd" name="old_password">

                     </div>

                  </div>

                  <div class="form-group">

                     <label class="control-label col-sm-4" for="pwd"><?php echo NEW_PASSWORD; ?>:</label>

                     <div class="col-sm-8"> 

                        <input type="password" class="form-control" id="pwd_1" name="new_password">

                     </div>

                  </div>

                  <div class="form-group">

                     <label class="control-label col-sm-4" for="pwd"><?php echo RE_ENTER_PASSWORD; ?>:</label>

                     <div class="col-sm-8"> 

                        <input type="password" class="form-control" id="pwd_2" name="confirm_password">

                     </div>

                  </div>

                  <div class="form-group">

                     <div class="col-sm-6">

                        <button type="submit" class="btn btn-default"><?php echo CHANGE; ?></button>

                     </div>

                  </div>

               </form>

            </div>

            

         </div>

      </div>

   </div>

</section>

<?php include('includes/footer.php');?>