<?php 
require_once('includes/head.php'); 
require_once('classes/user.class.php');

$userRole = $instAuth = new user;
$roleData = $userRole->GetAllRole();

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
   <head>
    <?php 
     $title = 'User Role List | Tutorkami';
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
                           <h5>User Role</h5>
                           <div class="ibox-tools">
                              <a href="user-role-manage.php" class="btn btn-primary">Add new</a>
                           </div>
                        </div>
                        <div class="ibox-content">
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded" data-page-size="15">
                                       <thead>
                                          <tr>
                                             <th class="footable-visible footable-first-column footable-sortable">Name<span class="footable-sort-indicator"></span></th>
                                             <th data-hide="phone" class="footable-visible footable-sortable">System name<span class="footable-sort-indicator"></span></th>
                                             <th data-hide="phone" class="footable-visible footable-sortable"><span class="footable-sort-indicator"></span></th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          if ($roleData->num_rows > 0) {
                                             while( $row = $roleData->fetch_assoc() ){
                                          ?>
                                          <tr class="footable-even" style="display: table-row;">
                                             <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                                <?php echo $row['r_name'];?>
                                             </td>
                                             <td class="footable-visible">
                                                <?php echo $row['r_system_name'];?>
                                             </td>
                                             <td class="footable-visible footable-last-column">
                                                <div class="btn-group">
                                                   <a href="user-role-manage.php?role_id=<?php echo $row['r_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
                                                </div>
                                             </td>
                                          </tr>
                                          <?php 
                                             }
                                          } else {
                                             echo '<tr><td colspan="3">No Record Found</td></tr>';
                                          }
                                          ?>   
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
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