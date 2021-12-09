<?php 
require_once('includes/head.php'); 
require_once('classes/user.class.php');

$userRole = $instAuth = new user;

if (isset($_GET['role_id'])) {  
  $response = $userRole->GetAllRole($_GET['role_id']);
  $row = $response->fetch_array(MYSQLI_ASSOC);
}

if (count($_POST) > 0) {
  $roleData = $userRole->SaveRole($_POST);
  if (isset($_POST['save'])) {
    header('Location:user-role-list.php');
    exit();
  }
  elseif (isset($_POST['save_edit'])) {      
    header('Location:user-role-manage.php?role_id='.$roleData);
    exit();
  }
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
   <head>
    <?php 
     $title = 'User Role Add | Tutorkami';
     require_once('includes/html_head.php'); 
    ?>
   </head>
   <body>
      <div id="wrapper">
         <?php include_once('includes/sidebar.php'); ?>
         <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php'); ?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox float-e-margins">
                        <div class="ibox-title">
                           <h5>Add A New User Role</h5>
                        </div>
                        <div class="ibox-content">
                           <form method="post" class="form-horizontal">
                              <input type="hidden" name="r_id" value="<?php echo isset($_GET['role_id']) ? $_GET['role_id'] : '';?>">
                              <div class="form-group">
                                 <label class="col-lg-3 control-label">Name:</label>
                                 <div class="col-lg-7"><input type="text" class="form-control" name="r_name" value="<?php echo isset($_GET['role_id']) ? $row['r_name'] : ''; ?>" required> 
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-lg-3 control-label">System name:</label>
                                 <div class="col-lg-7"><input type="text" class="form-control" name="r_system_name" value="<?php echo isset($_GET['role_id']) ? $row['r_system_name'] : ''; ?>"></div>
                              </div>                              
                              <div class="form-group">
                                 <div class="col-lg-offset-3 col-lg-9">
                                    <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                                    <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">Save and Continue Edit</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
         </div>
      </div>
      <!-- Mainly scripts -->
      <script src="js/jquery-2.1.1.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
      <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
      <!-- Custom and plugin javascript -->
      <script src="js/theme.js"></script>
      <!-- jQuery UI -->
      <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>      
   </body>
</html>