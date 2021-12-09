<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;
$instUser = new user;
if(isset($_REQUEST['phd'])){
  $res = $instApp->DeletePayment($_REQUEST['phd']);
}

$resPay = $instApp->FetchPayment();  

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
   $title = 'Payment List | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>


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
                 <h5>Payments</h5>
                 <div class="el-right">
                  <a href="payment-add.php" class="btn btn-primary">Add New</a>
                  
              </div>
          </div>
          <div class="ibox-content">

             <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
              
<div class="row">
   <div class="col-sm-12">
    <table class="table table-striped" data-page-size="15">
     <thead>
      <tr>
       <th class="footable-visible footable-first-column footable-sortable">User Type<span class="footable-sort-indicator"></span></th>
       <th class="footable-visible footable-first-column footable-sortable">User<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">Date<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Job ID<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Amount<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Payment Receipt<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">Edit<span class="footable-sort-indicator"></span></th>

   </tr>
</thead>
<tbody>
  <?php while($arrPay = $resPay->fetch_assoc()) {
    $resRole = $instUser->GetAllRole($arrPay['ph_user_type']);
    $arrRole = $resRole->fetch_assoc();
    $arrUser = $instUser->GetUserDetail($arrPay['ph_user_id']); ?>
  <tr class="footable-even" style="display: table-row;">
   <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
     
    <?php echo $arrRole['r_name']; ?>
   </td>
   <td class="footable-visible">
     <?php echo $arrUser['u_username'];?>
   </td>
   <td class="footable-visible">
     <?php 
     //echo $arrPay['ph_date'];
     echo date("d/m/Y", strtotime($arrPay['ph_date']));
     ?>
   </td>

   <td class="footable-visible">
    <?php echo $arrPay['ph_job_id'];?>
     
   </td>
   <td class="footable-visible">
    <?php echo $arrPay['ph_amount'];?>
     
   </td>
   <td class="footable-visible">
    <?php 
    $pad_length = 2;
    $pad_char = 0;
    $thisCycle = str_pad($arrPay['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT);
    echo 'R'.$arrPay['ph_job_id'].$thisCycle;
    
    ?>
     
   </td>
  <td class="footable-visible footable-last-column">
   <div class="btn-group">
     <a href="payment-add.php?ph=<?php echo $arrPay['ph_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
     <a href="payment-list.php?phd=<?php echo $arrPay['ph_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
 </div>
 </td>
</tr>
<?php } ?>


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



</body>
</html>
