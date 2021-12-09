<?php
require_once('includes/head.php');
require_once('admin/classes/user.class.php');
require_once('admin/classes/location.class.php');
require_once('admin/classes/app.class.php');

include('includes/header.php');
?>

<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<section class="search_tutor myform">

   <div class="main-body">

      <div class="container">



         <h1 class="text-center text-uppercase blue-txt"><?php echo SEARCH_TUTOR; ?></h1>

         <hr>

         <div class="col-md-offset-2 col-md-8">

          <div class="clearfix"></div>

            <form method="post" id="filter_user">

               <input type="hidden" name="action" value="search_tutor">

               <input type="hidden" name="subject" value="<?php echo isset($_REQUEST['subject']) ? $_REQUEST['subject']: '';?>">

               <input type="hidden" name="location" value="<?php echo isset($_REQUEST['location']) ? $_REQUEST['location']: '';?>">

           </form>

       </div>

     </div>

 </div>

</section>

