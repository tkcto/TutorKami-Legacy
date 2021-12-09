<?php

require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;


if(isset($_REQUEST['crs-saveBI'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->SaveClientTermsConditionBI($data);
 
 header('Location:clients-terms.php');
 exit();
}
if(isset($_REQUEST['crs-saveBM'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->SaveClientTermsConditionBM($data);
 
 header('Location:clients-terms.php');
 exit();
}

/*$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}*/
$queryTCBI = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='78'");
$resTCBI = $queryTCBI->num_rows;
if($resTCBI > 0){
	if($rowTCBI = $queryTCBI->fetch_assoc()){ 
		$idBI  = $rowTCBI['pmt_id'];
		$desBI = $rowTCBI['pmt_pagedetail'];
	}
}else{
	$idBI = "";
	$desBI = "";
}

$queryTCBM = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='79'");
$resTCBM = $queryTCBM->num_rows;
if($resTCBM > 0){
	if($rowTCBM = $queryTCBM->fetch_assoc()){ 
		$idBM  = $rowTCBM['pmt_id'];
		$desBM = $rowTCBM['pmt_pagedetail'];
	}
}else{
	$idBM = "";
	$desBM = "";
}

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Terms & Condition | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>

<script src="ckeditor/ckeditor.js"></script>
</head>

<body>
  <div id="wrapper">
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include_once('includes/header.php'); ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} 
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>
      
      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5><b>Clients Terms & Condition Form</b></h5>

         </div>
         <div class="ibox-content">
   
	   
	   
<div class="container">
  <div class="row">
    <div class="col-xs12">

      <div id="tab" class="btn-group btn-group-justified" data-toggle="buttons">
        <a href="#bi" class="btn btn-default active" data-toggle="tab">
          <input type="radio" />English Language
        </a>
        <a href="#bm" class="btn btn-default" data-toggle="tab">
          <input type="radio" />Bahasa Malaysia
        </a>
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="bi">
		<br/>
			<form class="form-horizontal" action="" method="post">                            
				<input type="hidden" name="idBI" id="idBI" value="<?php echo $idBI; ?>">       
				<div class="col-lg-12">
					<textarea id="myeditor" name="myeditor" ><?php echo $desBI; ?></textarea>
				</div>                                       
				<div class="col-lg-12">
					<br/><button class="btn btn-sm btn-primary sign-btn-box" type="submit" name="crs-saveBI"><span class="glyphicon glyphicon glyphicon-ok"></span> &nbsp; Save</button>
				</div>

			</form>
		</div>
        <div class="tab-pane" id="bm">
		<br/>
			<form class="form-horizontal" action="" method="post">                            
				<input type="hidden" name="idBM" id="idBM" value="<?php echo $idBM; ?>">       
				<div class="col-lg-12">
					<textarea id="myeditor2" name="myeditor2" ><?php echo $desBM; ?></textarea>
				</div>                                       
				<div class="col-lg-12">
					<br/><button class="btn btn-sm btn-primary sign-btn-box" type="submit" name="crs-saveBM"><span class="glyphicon glyphicon glyphicon-ok"></span> &nbsp; Save</button>
				</div>

			</form>
		</div>
      </div>
    </div>
  </div>
</div>
	   
	   
	   
	   
	   
	   
	   
	   
     </div>
   </div>
 </div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>
<script type="text/javascript">
    CKEDITOR.replace( 'myeditor', {
        height: 400
    } );
    CKEDITOR.replace( 'myeditor2', {
        height: 400
    } );
</script> 
</div> 

</div>

</body>
</html>
 

