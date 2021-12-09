<?php 
require_once('includes/head.php'); 
require_once('classes/user.class.php');
$instUser = new user;
$resRole = $instUser->FetchRole('A');
if(isset($_REQUEST['r_id'])&&$_REQUEST['r_id']<>'') {
	$flag = $instSys->SaveMenuPermByRole($_REQUEST['r_id'], $_REQUEST['view']);
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!doctype html>
<html>
<head>

 <?php 
 $title = 'Manage Permission | Tutorkami';
 require_once('includes/html_head.php'); 
 ?>
 <script type="text/javascript" src="js/manage_permission.js"></script>

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
           <h5>Permission Management</h5>
           
        </div>
        <div class="ibox-content">

         <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
          <div class="row">
           <div class="content noPad">
            <div style="padding:20px 0px 0px 20px;">
              <span>Select Role : </span>
              <select name="role" id="role">
                <option value="">Select</option>
                <?php
                while($arrRole = $resRole->fetch_assoc()) {
                //Hide Super Admin
                  if($arrRole['r_id']==1 && $_SESSION[DB_PREFIX]['r_id']<>1) { continue; }
                  ?>
                  <option value="<?=$arrRole['r_id']?>" <?php if($_REQUEST['role']==$arrRole['r_id']) { ?>selected<?php } ?>><?=$arrRole['r_name']?></option>
                  <?php
                }
                ?>
              </select>
            </div>

          </div>
          <div class="row">
           <div class="col-sm-12">
            <?php
            if(isset($_REQUEST['role'])&&$_REQUEST['role']<>'') {
              $arrMenuPerm = $instSys->GetMenuPerm($_REQUEST['role']);
              ?>
              <form name="permForm" id="permForm" action="" method="post">
                <input type="hidden" name="r_id" id="r_id" value="<?=$_REQUEST['role']?>">
                <table class="table table-bordered responsive" id="boardList">
                  <thead>
                    <tr>
                      <th>Menu Name</th>
                      <th>View</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $resMainMenu = $instSys->FetchMenu(0);
                    while($arrMainMenu = $resMainMenu->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><strong><?=$arrMainMenu['m_name']?></strong></td>
                        <td>
                          <input type="checkbox" name="view[<?=$arrMainMenu['m_id']?>]" id="view_<?=$arrMainMenu['m_id']?>" value="1" <?php if($arrMenuPerm[$arrMainMenu['m_id']]==1) { ?>checked<?php } ?>>
                        </td>
                      </tr>
                      <?php
                      if($arrMainMenu['m_submenu']==1) {
                        $resSubMenu = $instSys->FetchMenu($arrMainMenu['m_id']);
                        while($arrSubMenu = $resSubMenu->fetch_assoc()) {
                          ?>
                          <tr>
                            <td><?=$arrSubMenu['m_name']?></td>
                            <td>
                              <input type="checkbox" name="view[<?=$arrSubMenu['m_id']?>]" id="view_<?=$arrSubMenu['m_id']?>" value="1" <?php if($arrMenuPerm[$arrSubMenu['m_id']]==1) { ?>checked<?php } ?>>
                            </td>
                          </tr>
                          <?php
                        }
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <div style="padding:10px;">
                  <input type="button" class="btn btn-primary" name="saveBtn" id="saveBtn" value="Save">
                </div>
              </form>
              <?php
            }
            ?>
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

<!-- End #wrapper -->
</body>
</html>