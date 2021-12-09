<?php 
require_once('includes/head.php'); 
require_once('classes/user.class.php');
require_once('classes/location.class.php');
require_once('classes/job.class.php');

$userRole = $instAuth = new user;
$initLocation = new location;
$instJob = new job;

$roleData = $userRole->GetLocationRate();

$resJl = $instJob->FetchJobLevel();
/*if (count($_POST) > 0 && $_POST['action'] == 'save_rate') {
   $saveData = $userRole->SaveLocationRate($_POST);

   if ($saveData !== false) {
      header('Location:pricing.php');
      exit();
   }
}*/
if (count($_POST) > 0) {
	$saveData = $userRole->SaveLocationRate($_POST);
	if ($saveData !== false) {
        if (isset($_POST['save_rate'])) {
			header('Location:pricing-old.php');
			exit();
        }
        else if (isset($_POST['delete'])) {
			$deleteData = $userRole->deletePricing($_POST);
			header('Location:pricing-old.php');
			exit();
        }
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'edit') {
   $userData = $userRole->GetLocationRate($_GET['lr_id']);
   $userRow = $userData->fetch_array(MYSQLI_ASSOC);
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>
   <head>
    <?php 
     $title = 'Location wise Rate | Tutorkami';
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
                        <div class="ibox-content">
                           <div class="form-horizontal">
                              
                              <form action="" method="post">
                                 <!--<input type="hidden" name="action" value="save_rate">-->
                                 <?php echo (isset($userRow) && $userRow !== null) ? '<input type="hidden" name="lr_id" value="'.$userRow['lr_id'].'">' : '' ;?>
                                 <div class="form-group hidden">
                                    <label class="col-lg-3 control-label">Country:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="lr_c_id" id="ud_country">
                                        <!-- luqman -->
                                 <!--          <option value="0">Select Country Name</option> -->
                                          <?php 
                                          $resCnt = $initLocation->GetAllCountry();
                                          while($arrCnt = $resCnt->fetch_assoc()) {
                                          ?>
                                          <option value="<?php echo $arrCnt['c_id'];?>" <?php echo (isset($_POST['lr_c_id']) && $_POST['lr_c_id'] == $arrCnt['c_id']) ? 'selected' : ( (isset($userRow) && $userRow !== null && $userRow['lr_c_id'] == $arrCnt['c_id'])? 'selected' : '' );?>><?php echo $arrCnt['c_name'];?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                                 
                                <!--  <div class="form-group">
                                    <label class="col-lg-3 control-label">Country:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="lr_c_id" id="ud_country">
                                          <option value="150">Malaysia</option>
                                       </select>
                                    </div>
                                 </div> -->
                                 
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">State:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="lr_st_id" id="ud_state">
                                          <option value="0">Select State Name</option>
                                          <?php 
                                          // if((isset($_POST['lr_c_id']) && $_POST['lr_c_id'] != '') || (isset($userRow) && $userRow !== null && $userRow['lr_c_id'] != '')) {
                                             // $country_id = (isset($_POST['lr_c_id']) && $_POST['lr_c_id'] != '') ? $_POST['lr_c_id'] : $userRow['lr_c_id'];
                                          $country_id = 150;
                                             $stresponse = $initLocation->CountryWiseState($country_id);
                                             if ($stresponse->num_rows > 0) {
                                                while( $cu_row = $stresponse->fetch_assoc() ){
                                                   $sel = (isset($_POST['lr_st_id']) && $_POST['lr_st_id'] == $cu_row['st_id']) ? 'selected' : (($userRow['lr_st_id'] == $cu_row['st_id']) ? 'selected' : '' );
                                                   echo '<option value="'. $cu_row['st_id'] .'" '.$sel.'>'. $cu_row['st_name'] .'</option>';
                                                }
                                             }
                                          // }
                                          ?>
                                       </select>
                                       <!-- luqman -->
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">City:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="lr_city_id" id="ud_city">
                                          <option value="0">Select City Name</option>
                                          <?php 
                                          if((isset($_POST['lr_st_id']) && $_POST['lr_st_id'] != '') || (isset($userRow) && $userRow !== null && $userRow['lr_st_id'] != '')) {
                                             $state_id = (isset($_POST['lr_st_id']) && $_POST['lr_st_id'] != '') ? $_POST['lr_st_id'] : $userRow['lr_st_id'];
                                             $ciresponse = $initLocation->StateWiseCity($state_id);
                                             if ($ciresponse->num_rows > 0) {
                                                while( $cu_row = $ciresponse->fetch_assoc() ){
                                                   $sel = (isset($_POST['lr_city_id']) && $_POST['lr_city_id'] == $cu_row['city_id']) ? 'selected' : (($userRow['lr_city_id'] == $cu_row['city_id']) ? 'selected' : '' );
                                                   echo '<option value="'. $cu_row['city_id'] .'" '.$sel.'>'. $cu_row['city_name'] .'</option>';
                                                }
                                             }
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Level:</label>
                                    <div class="col-lg-7">
                                       <select class="form-control" name="lr_jl_id">
                                          <option value="0">Select Level</option>                                       
                                          <?php 
                                          while($arrJl = $resJl->fetch_assoc()){
                                             $defaultLangJobLevel = $instJob->GetDefaultLanguageJobLevel($arrJl['jl_id']);
                                             $level_id = (isset($_POST['lr_jl_id']) && $_POST['lr_jl_id'] != '') ? $_POST['lr_jl_id'] : $userRow['lr_jl_id'];
                                             $sel = (isset($_POST['lr_jl_id']) && $_POST['lr_jl_id'] == $arrJl['jl_id']) ? 'selected' : (($userRow['lr_jl_id'] == $arrJl['jl_id']) ? 'selected' : '' );
                                          ?>
                                          <option value="<?=$arrJl['jl_id']?>" <?=$sel?>><?=$defaultLangJobLevel['jlt_title']?></option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Parent’s Rate/hour</label>
                                    <div class="col-lg-7">
                                       <input type="text" class="form-control" name="lr_parent_rate" value="<?php echo $userRow['lr_parent_rate']; ?>">
                                    </div>
                                 </div>
								 
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label">Note</label>
                                    <div class="col-lg-7">
                                       <input type="text" class="form-control" name="lr_rate" value="<?php echo $userRow['lr_rate']; ?>">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-7">
                                       <!--<button type="submit" class="btn btn-primary">SAVE</button>-->
                                       <button type="submit" class="btn btn-primary" name="save_rate">SAVE</button>
									   <?PHP
									   if(isset($_GET['action']) && $_GET['action'] == 'edit') {
										   echo '<button type="submit" class="btn btn-primary" name="delete">DELETE</button>';
									   }
									   ?>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="ibox-content">
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded dataTables-example" data-page-size="15">
                                       <thead>
                                          <tr>
                                             <th style="width: 20%;">Level</th>
                                             <th style="width: 20%;">Parent’s Rate/hour</th>
                                             <th style="width: 20%;">Location</th>
                                             <th style="width: 20%;">Note</th>
                                             <th style="width: 20%;"></th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          if ($roleData->num_rows > 0) {
                                             while( $row = $roleData->fetch_assoc() ){
                                          ?>
                                          <tr class="footable-even">
                                             <td style="width: 20%;">
                                                <?php echo $row['jlt_title'];?>
                                             </td>
                                             <td style="width: 20%;">
                                               <?php echo $row['lr_parent_rate']; ?>
                                             </td>
                                             <td style="width: 20%;">
                                                
                                                <?php echo $row['city_name'];?>,
                                                <?php echo $row['st_name'];?>
                                                
                                             </td>
                                             <td style="width: 20%;">
                                                <?php echo $row['lr_rate'];?>
                                             </td>
                                             <td class="footable-visible footable-last-column" style="width: 20%;"  >
                                                <div class="btn-group">
                                                   <a href="pricing-old.php?action=edit&lr_id=<?php echo $row['lr_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
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
         <!-- Custom and plugin javascript -->
         <script src="js/plugins/pace/pace.min.js"></script>
         <script>
            $(document).ready(function(){
              $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                ]
             });
            
              var oTable = $('#editable').DataTable();
            
              oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                  var aPos = oTable.fnGetPosition( this );
                  oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                  return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                  };
                },
            
                "width": "90%",
                "height": "100%"
              } );
            
            
            });
            
            function fnClickAddRow() {
              $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );
            
            }
         </script>
         </div>
      </div>
   </body>
</html>