<?php 
require_once('includes/head.php');

if (count($_POST) > 0) {
  $data = $_POST;
  
  $output = system::FireCurl(SEACRH_JOB_URL, "POST", "JSON", $data);
  $search = $output->data;
  
} else {
  $data = array('status' => 'open');
  
  $output = system::FireCurl(SEACRH_JOB_URL, "POST", "JSON", $data);
  $search = $output->data;
}

include('includes/header.php');
?>
<link rel="stylesheet" href="css/select2.css">
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

<section class="profile searchjob">
   <div class="main-body">
      <div class="container">
         <h1 class="text-center text-uppercase blue-txt"><?php echo SEARCH_JOB; ?></h1>
         <div class="col-md-12 ">
            <hr>
            <form method="post">
               <div class="col-md-10 col-md-offset-1 ">               
                  <table class="table table-responsive " width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td class="org-txt " width="20%"><strong><?php echo SEARCH_JOB_STATE; ?>:</strong></td>
                           <td width="80%" class="from_all">
                              <div class="form-group">
                                 <select multiple id="e1" class="form-control" name="state[]">
                                    <?php 
                                    // Get Country
                                    $getAllCountries = system::FireCurl(LIST_COUNTRIES_URL.'?country_id=150');
                                    if ($getAllCountries->flag == 'success' && count($getAllCountries->data) > 0) {
                                      $i = 0;
                                      foreach ($getAllCountries->data as $key => $country) {
                                        // Get State By Country Id
                                        $getCountryWiseStates = system::FireCurl(LIST_STATE_URL.'?country_id='.$country->c_id);
                                        if ($getCountryWiseStates->flag == 'success' && count($getCountryWiseStates->data) > 0) {
                                          foreach ($getCountryWiseStates->data as $key => $state) {
                                    ?>
                                    <option value="<?php echo $state->st_id; ?>"><?php echo $state->st_name; ?></option>
                                    <?php 
                                          }
                                        }
                                      }
                                    }
                                    ?>                                  
                                 </select>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td class="org-txt"><strong><?php echo SEARCH_JOB_LEVELS; ?>:</strong></td>
                           <td >
                              <div class="form-group">
                                 <select multiple id="e2" class="form-control" name="course[]">
                                    <?php 
                                    // Get Course
                                    $getCourse = system::FireCurl(LIST_LEVEL_URL);
                                    if ($getCourse->flag == 'success' && count($getCourse->data) > 0) {
                                      $i = 0;
                                      foreach ($getCourse->data as $key => $course) {
                                    ?>
                                    <option value="<?php echo $course->jl_id; ?>"><?php echo $course->jlt_title; ?></option>
                                    <?php 
                                      }
                                    }
                                    ?>
                                 </select>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td class="org-txt"><strong><?php echo SEARCH_JOB_STATUS; ?>:</strong></td>
                           <td >
                              <div class="form-group">
                                 <select class="form-control" id="status" name="status">
                                    <option value="open">Open</option>
                                    <option value="closed">Closed</option>
                                 </select>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td class="org-txt"><strong><?php echo SEARCH_JOB_JOB_ID; ?> :</strong></td>
                           <td ><input id="job_id" type="text" class="form-control" name="job_id" placeholder="Type job ID here..."></td>
                        </tr>
                     </tbody>
                  </table>            
               </div>
               <div class="clearfix"></div>
               <div class="col-md-offset-5 col-md-4 col-xs-offset-3">
                  <button type="submit" class="apply text-uppercase"><?php echo BUTTON_SEARCH_JOB; ?></button>
               </div>
            </form>
            <div class="clearfix"></div>
            <div class="job-table">
               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-responsive mrg-top-bot text-center" style="background:#fff;" id="dataTables_cl">
                     <thead>
                     <tr class="blue-bg">
                        <td width="10%"><?php echo SEARCH_JOB_JOB_ID; ?></td>
                        <td width="10%"><?php echo SEARCH_JOB_DATE; ?></td>
                        <td width="10%"><?php echo SEARCH_JOB_LEVEL; ?></td>
                        <td width="20%"><?php echo SEARCH_JOB_SUBJECT; ?></td>
                        <td width="15%"><?php echo SEARCH_JOB_LOCATION; ?></td>
                        <td width="15%"><?php echo SEARCH_JOB_RATE; ?></td>
                        <td width="20%"><?php echo SEARCH_JOB_REMARKS; ?></td>
                     </tr>
                     </thead>
                     <tbody>
                     <?php 
                     if(count($search) > 0) {
                        foreach ($search as $key => $row) {                           
                     ?>
                     <tr class="point" onclick="gotoPage('job_details.php?jid=<?php echo $row->j_id;?>&status=<?php echo $data['status']; ?>')" data-toggle="btnToolTip" data-placement="top" title="Please click to view job detail">
                        <td><a><?php echo $row->j_id;?></a></td>
                        <td><?php echo date('d/m/Y', strtotime($row->j_create_date));?></td>
                        <td><?php echo $row->jlt_title;?></td>
                        <td><?php echo $row->jt_subject;?></td>
                        <td><?php echo $row->st_name;?></td>
                        <td><?php echo isset($_SESSION['auth']) ? $row->j_rate : '<a href="login.php?redirect=search_job.php" class="org-txt"><strong><em>Login to view</em></strong></a>';?></td>
                        <td><?php echo $row->jt_remarks;?></td>
                     </tr>
                     <?php 
                        }
                     } else { 
                     ?>
                     <tr>
                        <td colspan="7"><?php echo NO_RECORDS_FOUND; ?></td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
            <hr>
         </div>
         <div class="clearfix"></div>
      </div>
   </div>
</section>
<?php include('includes/footer.php');?>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/select2.min.js"></script>
<script>
   $.noConflict();
   jQuery(document).ready(function($){
      
      $("#e1").select2();
      $("#e2").select2();

      $('#dataTables_cl').DataTable({
         "info":false,
         "searching":false,
         "lengthChange":false,
         "bSort":true,
         "bPaginate":true,
         "sPaginationType":"simple_numbers",
         "iDisplayLength": 10,
         "columns": [            
            null,
            null,
            null,
            { "orderable": false },
            { "orderable": false },
            null,
            { "orderable": false }            
         ],
         "order": [[ 0, "desc" ]]
      });

      $(".clickable-row").click(function() {
           window.location = $(this).data("href");
      });
      
   });
</script>