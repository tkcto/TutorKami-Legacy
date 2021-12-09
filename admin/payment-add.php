<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;


$userRole = $instAuth = new user;
$roleData = $userRole->GetParentTutorRole();

if(isset($_REQUEST['ph-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SavePayment($data);
 //echo $res;
 header('Location:payment-list.php');
 exit();
}
if(isset($_REQUEST['ph'])){
 $arrPay = $instApp->GetPayment($_REQUEST['ph']);
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Payment Add | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>
  <script type="text/javascript">
   function getUser(ut){
     $.ajax({
       type:'POST',
       url:'get-user.php',
       data:'u_type='+ut,
       success:function(result){
         $('.user-list').empty();
         $('.user-list').html(result)
       }
     })

   }
 </script>
</head>

<body>
  <div id="wrapper">
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include_once('includes/header.php'); ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>
      
      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5>Payment Add</h5>

         </div>
         <div class="ibox-content">
          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">    <input type="hidden" name="ph_id" id="ph_id" value="<?php echo isset($_REQUEST['ph']) ? $arrPay['ph_id'] : ''; ?>">
            <div class="form-group"><label class="col-lg-3 control-label" >User Type:</label>
              <div class="col-lg-7">                                    
                <select class="form-control" name="ph_user_type" onChange="getUser(this.value);">
                  <option value="">Select User Type</option>
                  <?php while($row = $roleData->fetch_assoc()){?>
                  <option value="<?php echo $row['r_id'];?>" <?php if(isset($_REQUEST['ph'])) echo $arrPay['ph_user_type']==$row['r_id']?'selected':''?>><?php echo $row['r_name'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>                           
            <div class="form-group"><label class="col-lg-3 control-label">User:</label>
             <div class="col-lg-7">
              <select class="form-control user-list" name="ph_user_id">
              <?php if(isset($_REQUEST['ph'])){
                $resUser = $userRole->FetchUserByRole($arrPay['ph_user_type'],'A');
                while($arrUser = $resUser->fetch_assoc()) {?>
                <option value="<?php echo $arrUser['u_id'];?>" <?php if(isset($_REQUEST['ph'])) echo $arrPay['ph_user_id']==$arrUser['u_id']?'selected':''?>><?php echo $arrUser['u_displayname'];?></option>
                <?php } } ?>
              </select>
            </div>
          </div>
          <div class="form-group" id="data"><label class="col-lg-3 control-label">Date:</label>

            <div class="col-lg-7">
             <div class="input-group date">
               <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"  class="form-control" name="ph_date" value="<?php echo isset($_REQUEST['ph']) ? $arrPay['ph_date'] : ''; ?>" required>   
             </div>
           </div>
         </div>

         <div class="form-group"><label class="col-lg-3 control-label">Job Id:</label>

          <div class="col-lg-7">
            <input type="text"  class="form-control" name="ph_job_id" value="<?php echo isset($_REQUEST['ph']) ? $arrPay['ph_job_id'] : ''; ?>" required>
          </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Payment Amount:</label>

          <div class="col-lg-7">
            <input type="text"  class="form-control" name="ph_amount" value="<?php echo isset($_REQUEST['ph']) ? $arrPay['ph_amount'] : ''; ?>" required>
          </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Payment Receipt:</label>

          <div class="col-lg-7">
            <input type="text"  class="form-control" name="ph_receipt" value="<?php 
    $pad_length = 2;
    $pad_char = 0;
    $thisCycle = str_pad($arrPay['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT);
    
            echo isset($_REQUEST['ph']) ? 'R'.$arrPay['ph_job_id'].$thisCycle : ''; 
            
            ?>" required>
          </div>
        </div>                                                              
        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-9">
           <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="ph-save">Save</button>

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
<script src="js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>
<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Date range picker -->
<script src="js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#data .input-group.date').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true,
      format: "yyyy-mm-dd"
    });

  });
</script>

</body>
</html>
