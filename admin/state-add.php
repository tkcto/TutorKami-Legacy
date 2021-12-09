<?php
require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;

$resCnt = $instApp->FetchCountry();  
if(isset($_REQUEST['s-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res = $instApp->SaveState($data);
 header('Location:state-list.php');
 exit();
}
if(isset($_REQUEST['st'])){
 $arrSt = $instApp->GetState($_REQUEST['st']);
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'State Add | Tutorkami';
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
if ( $conDB->query($updateLastPage) === TRUE ) {
    //echo "Update Is Successful";
}
//$dbCon->close();
?>
      
      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5>State</h5>

         </div>
         <div class="ibox-content">
          <form class="form-horizontal" action="" method="post">    
          <input type="hidden" name="st_id" id="st_id" value="<?php echo isset($_REQUEST['st']) ? $arrSt['st_id'] : ''; ?>">
            <div class="form-group"><label class="col-lg-3 control-label">Country Name:</label>

                                    <div class="col-lg-7">
                                     <select class="form-control" name="st_c_id" required="required">
                                        <option value="">Select Country Name</option>
                                        <?php while($arrCnt = $resCnt->fetch_assoc()) {?>
                                        <option value="<?php echo $arrCnt['c_id'];?>" <?php if(isset($_REQUEST['st'])) echo ($arrSt['st_c_id']==$arrCnt['c_id'])?'selected':''?>><?php echo $arrCnt['c_name'];?></option>
                                        <?php } ?>
                                    </select> 
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-lg-3 control-label">State Name:</label>

                                    <div class="col-lg-7">
                                       <input type="text" class="form-control" name="st_name" value="<?php echo isset($_REQUEST['st']) ? $arrSt['st_name'] : ''; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-lg-3 control-label">State Name (BM):</label>

                                    <div class="col-lg-7">
                                       <input type="text" class="form-control" name="st_name_bm" value="<?php echo isset($_REQUEST['st']) ? $arrSt['st_name_bm'] : ''; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-lg-3 control-label">Status:</label>

					            <div class="col-lg-7"><select class="form-control" name="st_status">
					              <option value="1" <?php if(isset($_REQUEST['st'])) $arrSt['st_status']=="1"?'selected':''?>>Active</option>
					              <option value="0" <?php if(isset($_REQUEST['st'])) $arrSt['st_status']=="0"?'selected':''?>>Inactive</option>
					            </select></div>
					          </div>                                                             
          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="s-save">Save</button>
             <!-- <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit">Save and Continue Edit</button> -->

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

</body>
</html>
