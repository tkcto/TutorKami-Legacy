<?php 
require_once('includes/head.php'); 
require_once('classes/job.class.php');

$instJob = new job;
$resAJ = $instJob->AppliedJobs();

if (count($_POST) > 0 && $_POST['action'] == 'save_applied_job') {
   $saveData = $instJob->SaveAppliedJob($_POST);

   if ($saveData !== false) {
      header('Location:applied-jobs.php');
      exit();
   }
}

if(isset($_GET['action']) && $_GET['action'] == 'edit') {
   $queryAJ = $instJob->AppliedJobs($_GET['aj_id']);
   $AppliedJobRow = $queryAJ->fetch_array(MYSQLI_ASSOC);
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
                        <?php if(isset($_GET['action']) && $_GET['action'] == 'edit') { ?>
                        <div class="ibox-content">
                           <div class="form-horizontal">
                              <form action="" method="post">
                                 <input type="hidden" name="action" value="save_applied_job">
                                 <?php echo (isset($AppliedJobRow) && $AppliedJobRow !== null) ? '<input type="hidden" name="aj_id" value="'.$AppliedJobRow['aj_id'].'">' : '' ;?>
								 <div class="row">
								 	<div class="col-md-6">
								 		<div class="well well-sm">
								 			<h3>Job Details</h3>
								 			<table class="table table-responsive " width="100%" cellspacing="0" cellpadding="0" border="0">
							                  <tbody>
							                     <tr>
							                        <td class="org-txt " width="50%"><strong>Job ID :</strong></td>
							                        <td width="50%"><?php echo $AppliedJobRow['aj_id'];?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong> Date:</strong></td>
							                        <td><?php echo date('d/m/Y', strtotime($AppliedJobRow['j_preferred_date_time']));?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong>Subject:</strong></td>
							                        <td><?php echo $AppliedJobRow['jt_subject'];?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong>Area:</strong></td>
							                        <td><?php echo $AppliedJobRow['j_area'];?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong>Rate:</strong></td>
							                        <td><?php echo $AppliedJobRow['j_rate'];?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong>Lesson:</strong></td>
							                        <td><?php echo $AppliedJobRow['jt_lessons'];?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong>Commision to tutorkami:</strong></td>
							                        <td><?php echo $AppliedJobRow['j_commission'];?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong>Duration of engagement:</strong></td>
							                        <td><?php echo $AppliedJobRow['j_duration'];?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong>Status:</strong></td>
							                        <td><?php echo ucfirst($AppliedJobRow['j_status']);?></td>
							                     </tr>
							                     <tr>
							                        <td class="org-txt "><strong>Remark:</strong></td>
							                        <td><?php echo $AppliedJobRow['jt_remarks'];?></td>
							                     </tr>
							                  </tbody>
							               </table>
								 		</div>
								 	</div>
								 	<div class="col-md-6">
								 		<div class="ibox float-e-margins">
								 			<h5>Tutor Detail</h5>                        
								 			<div>
								 				<div class="ibox-content no-padding border-left-right">
								 					<img alt="image" class="img-responsive" src="<?php 
													if ($AppliedJobRow['u_profile_pic'] != '') {
														echo APP_ROOT.$AppliedJobRow['u_profile_pic'];
													} elseif ($AppliedJobRow['u_gender'] == 'M') {
														echo APP_ROOT."images/tutor_ma.png";
													} else {
														echo APP_ROOT."images/tutor_mi1.png";
													}                  
													?>">
								 				</div>
								 				<div class="ibox-content profile-content">
								 					<h4><strong><?php echo $AppliedJobRow['u_displayname'];?></strong></h4>
								 					<p><i class="fa fa-user"></i> <?php echo $AppliedJobRow['u_displayid'];?></p>
								 					<h5><?php echo ($AppliedJobRow['u_gender'] == 'M') ? 'Male' : 'Female'; ?></h5>
								 					<p><?php echo $AppliedJobRow['u_email'];?></p>
								 				</div>
								 			</div>
								 			<div class="form-group">
			                                    <label class="col-lg-3 control-label">Job Status:</label>
			                                    <div class="col-lg-7">
			                                       <select class="form-control" name="aj_status" id="aj_status">
			                                          <option value="A" <?php echo (isset($_POST['aj_status']) && $_POST['aj_status'] == 'A') ? 'selected' : ( (isset($AppliedJobRow) && $AppliedJobRow !== null && $AppliedJobRow['aj_status'] == 'A')? 'selected' : '' );?>>Accept</option>
			                                          <option value="P" <?php echo (isset($_POST['aj_status']) && $_POST['aj_status'] == 'P') ? 'selected' : ( (isset($AppliedJobRow) && $AppliedJobRow !== null && $AppliedJobRow['aj_status'] == 'P')? 'selected' : '' );?>>Pending</option>
			                                          <option value="R" <?php echo (isset($_POST['aj_status']) && $_POST['aj_status'] == 'R') ? 'selected' : ( (isset($AppliedJobRow) && $AppliedJobRow !== null && $AppliedJobRow['aj_status'] == 'R')? 'selected' : '' );?>>Reject</option>
			                                       </select>
			                                    </div>
			                                 </div>
								 		</div>
								 	</div>
								 </div>	                                                                  
                                 <div class="form-group">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-7">
                                       <button type="submit" class="btn btn-primary">Update Status</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <?php } ?>
                        <div class="ibox-content">
                           <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded" data-page-size="15">
                                       <thead>
                                          <tr>
                                             <th>User</th>
                                             <th>Subject</th>
                                             <th>Lessons</th>
                                             <th>Rate</th>
                                             <th>Status</th>
                                             <th>Date</th>
                                             <th></th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php 
                                          if ($resAJ->num_rows > 0) {
                                             while( $row = $resAJ->fetch_assoc() ){
                                          ?>
                                          <tr class="footable-even" style="display: table-row;">
                                             <td>
                                                <?php echo $row['u_displayname'];?>
                                             </td>
                                             <td>
                                                <?php echo $row['jt_subject'];?>
                                             </td>
                                             <td>
                                                <?php echo $row['jt_lessons'];?>
                                             </td>
                                             <td>
                                                <?php echo $row['j_rate'];?>
                                             </td>
                                             <td>
                                                <?php echo $row['aj_status'];?>
                                             </td>
                                             <td>
                                                <?php echo $row['aj_date'];?>
                                             </td>
                                             <td class="footable-visible footable-last-column">
                                                <div class="btn-group">
                                                   <a href="applied-jobs.php?action=edit&aj_id=<?php echo $row['aj_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
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
   </body>
</html>