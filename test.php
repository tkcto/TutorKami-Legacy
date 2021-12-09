<?php 

require_once('includes/head.php');


include('includes/header.php');

?>

<section class="sign_up_fb">

   <div class="container">

      <div class="col-md-12" align="center" >



      </div>      

      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 mrg_top30">         

         <form action="" method="post" class="form-horizontal">

            <div class="form-group has-feedback">   

               <input type="text" name="u_email" class="form-control" placeholder="Email address" value="" />

               <span class="glyphicon glyphicon-envelope form-control-feedback"></span>   

            </div>

            <div class="form-group has-feedback">    

               <input type="password" name="u_password" class="form-control" placeholder="Password" value="" />

               <span class="glyphicon glyphicon-lock form-control-feedback"></span>   

            </div>

            <div class="form-group">

               <div class="row">

                  <div class="col-sm-6">

                     <div class="checkbox">

                        <label><input type="checkbox" name="remember" id="remember"  /> <?php echo "REMEMBER_ME"; ?></label>        

                     </div>

                  </div>

                  <div class="col-sm-6">

                     <div class="checkbox forget-text">

                        <a href="forget.php"><?php echo "FORGET_PASSWORD"; ?></a>        

                     </div>

                  </div>

               </div>

            </div>

            <div class="form-group">    

               <button type="submit" class="btn btn-default"><?php echo "BUTTON_SIGN_IN"; ?></button>   

            </div>            

         </form>

      </div>

   </div>

</section>

<?php include('includes/footer.php');?>