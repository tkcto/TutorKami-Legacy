<?php 
require_once('includes/head.php');

if (count($_POST) > 0) {

   $output = system::FireCurl(FORGOT_URL, "POST", "JSON", $_POST);
   Session::SetFlushMsg($output->flag, $output->message);

   if ($output->flag == 'success') {
      header('Location: forget-confirm.php');
      exit();
   } else {
      header('Location: forget.php');
      exit();
   }
}
include('includes/header.php');
?>
<section class="send_link">
   <div class="container">
      <div class="col-md-12" align="center">
         <?php foreach($arrLogo->data as $logo){ ?>
         <a href="index.php"><img src="admin/upload/<?php echo $logo->ss_settings_value;?>" alt="logo" class="img-responsive"></a>
         <?php } ?>
         <p><em><?php echo FORGOT_PASSWORD_MESSAGE; ?></em>
         </p>
         <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 mrg_top30">
            <form action="" method="post" class="form-horizontal">
               <div class="form-group has-feedback">
                  <div class="col-sm-12">
                     <input type="text" name="u_email" class="form-control" placeholder="Email address" />
                     <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-12">
                     <button type="submit" class="btn btn-default"><?php echo BUTTON_SEND_RESET_LINK; ?></button>
                  </div>
               </div>
            </form>
            <hr>
            <i class="fa fa-angle-left" aria-hidden="true"></i> <span><a href="login.php"> <?php echo BUTTON_GO_BACK; ?> </a></span>
         </div>
      </div>
   </div>
</section>
<?php include('includes/footer.php');?>