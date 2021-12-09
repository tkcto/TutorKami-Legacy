<?php 
require_once('includes/head.php'); 

require_once('classes/user.class.php');
require_once('classes/location.class.php');
require_once('classes/job.class.php');

$userRole = $instAuth = new user;
$initLocation = new location;
$instJob = new job;

/*
$roleData = $userRole->GetOnlineRate();

$resJl = $instJob->FetchJobLevel();
*/
if (count($_POST) > 0) {
	$saveData = $userRole->SaveOnlineRate($_POST);
	if ($saveData !== false) {
        if (isset($_POST['save_rate'])) {
			header('Location:online-rates.php');
			exit();
        }
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
     $title = 'Online Rates | Tutorkami';
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
                     
<?PHP
if(isset($_GET['or_id'])  && $_GET['or_id'] != '') {
    $queryRecord = "SELECT * FROM tk_online_rates WHERE or_id = '".$_GET['or_id']."' "; 
    $roleDataRecord = $conDB->query($queryRecord); 
    if ($roleDataRecord->num_rows > 0) {
        $rowRecord = $roleDataRecord->fetch_assoc();
        $dataOnlineID = $rowRecord['or_id'];
        $dataOnlineLvl = $rowRecord['or_level'];
        $dataOnlineRate = $rowRecord['or_rate'];
    }else{
        $dataOnlineID = '';
        $dataOnlineLvl = '';
        $dataOnlineRate = '';
    }
?>
                        <div class="ibox-content">
                           <div class="form-horizontal">
                              
                              <form action="" method="post">
                                  <input type="hidden" class="form-control" name="or_id" value="<?php echo $dataOnlineID; ?>">
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Level</label>
                                    <div class="col-lg-7">
                                       <input readonly type="text" class="form-control" name="or_level" value="<?php echo $dataOnlineLvl; ?>">
                                    </div>
                                 </div>
								 
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Rate</label>
                                    <div class="col-lg-7">
                                       <input type="text" class="form-control" name="or_rate" value="<?php echo $dataOnlineRate; ?>">
                                    </div>
                                 </div>
                                 
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-7">
                                       <button type="submit" class="btn btn-primary" name="save_rate">SAVE</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>

<?PHP
}
?>
                     
                     
                     
                     
                     
                        <div class="ibox-content">
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                       <table id="specific-grid" class="table table-bordered table-striped ">
                                       <thead>
                                            <tr>
                                             <th style="">Level</th>
                                             <th style="">Rate</th>
                                             <th style="">Action</th>
 
                                            </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          
                                          $query = "SELECT * FROM tk_online_rates ORDER BY or_id DESC "; 
                                          $roleData = $conDB->query($query); 
                                          if ($roleData->num_rows > 0) {
                                             while( $row = $roleData->fetch_assoc() ){
                                          ?>
                                          <tr class="footable-even">

                                             <td style="">
                                                <?php echo $row['or_level'];?>
                                             </td>
                                             <td style="">
                                                <?php echo $row['or_rate'];?>
                                             </td>
                                             <td class="footable-visible footable-last-column" style=""  >
                                                <div class="btn-group">
                                                  <a href="online-rates.php?or_id=<?php echo $row['or_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
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
            <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
         <script src="js/plugins/dataTables/datatables.min.js"></script>
         <script src="js/plugins/pace/pace.min.js"></script>
         <script>
            $(document).ready(function(){
              $('#specific-grid').DataTable({
             });
            
            
            
            });
            

         </script>
         </div>
      </div>
   </body>
</html>