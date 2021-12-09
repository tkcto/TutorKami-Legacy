<?php

require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;


if(isset($_REQUEST['crs-save'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->SaveUserNotification($data);
 
 header('Location:user-notification.php');
 exit();
}
if(isset($_REQUEST['save-News'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->SaveUserNews($data);
 
 header('Location:user-notification.php');
 exit();
}
//$Noti = $instApp->GetUserNotification();
/*$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}*/
$queryNoti = $conDB->query("SELECT * FROM tk_user_notification");
$resNoti = $queryNoti->num_rows;
    if($resNoti > 0){
        if($rowNoti = $queryNoti->fetch_assoc()){ 
            $idNoti = $rowNoti['id'];
            $titleNoti = $rowNoti['title'];
            $textNoti = $rowNoti['text'];
        }
    }else{
         $idNoti = "";
         $titleNoti = "";
         $textNoti = "";
    }
    

$queryNews = $conDB->query("SELECT * FROM tk_user_news");
$resNews = $queryNews->num_rows;
    if($resNews > 0){
        if($rowNews = $queryNews->fetch_assoc()){ 
            $idNews = $rowNews['id'];
            $titleNews = $rowNews['title'];
            $textNews = $rowNews['text'];
        }
    }else{
         $idNews = "";
         $titleNews = "";
         $textNews = "";
    }
    
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'User Notification | Tutorkami';
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
           <h5><b>Announcement Form</b></h5>

         </div>

         <div class="ibox-content">
   
	   
	   
<div class="container">
  <div class="row">
    <div class="col-xs12">

      <div id="tab" class="btn-group btn-group-justified" data-toggle="buttons">
        <a href="#Announcement" class="btn btn-default active" data-toggle="tab">
          <input type="radio" />Announcement
        </a>
        <a href="#News" class="btn btn-default" data-toggle="tab">
          <input type="radio" />News
        </a>
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="Announcement">
		<br/>

    
          <form class="form-horizontal" action="" method="post">                            
            <input type="hidden" name="id" id="id" value="<?php echo $idNoti; ?>">  
            <div class="form-group"><label class="col-lg-3 control-label"></label>

              <div class="col-lg-12"><input type="hidden" class="form-control" name="title" id="title" required value="<?php echo $titleNoti; ?>"> 
              </div>
            </div>
            <div class="form-group"><label class="col-lg-3 control-label"></label>

              <div class="col-lg-12">
				<textarea id="myeditor" name="myeditor"><?php echo $textNoti; ?></textarea>
              </div>
           </div>

                                                            
          <div class="col-lg-12">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="crs-save">Save</button>
         </div>

       </form>
 
     
		</div>
        <div class="tab-pane" id="News">
		<br/>
          <form class="form-horizontal" action="" method="post">                            
            <input type="hidden" name="idNews" id="idNews" value="<?php echo $idNews; ?>">  
            <div class="form-group"><label class="col-lg-3 control-label"></label>

              <div class="col-lg-12"><input type="hidden" class="form-control" name="titleNews" id="titleNews" required value="<?php echo $titleNews; ?>"> 
              </div>
            </div>
            <div class="form-group"><label class="col-lg-3 control-label"></label>

              <div class="col-lg-12">
				<textarea id="myeditor2" name="myeditor2"><?php echo $textNews; ?></textarea>
              </div>
           </div>

                                                            
          <div class="col-lg-12">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="save-News">Save</button>
         </div>

       </form>
		
		</div>
      </div>
    </div>
  </div>
</div>
	   
	   
	   
	   
	   
	   
	   
	   
     </div>
         <!--<div class="ibox-content">
          <form class="form-horizontal" action="" method="post">                            
            <input type="hidden" name="id" id="id" value="<?php echo $idNoti; ?>">  
            <div class="form-group"><label class="col-lg-3 control-label">Title:</label>

              <div class="col-lg-7"><input type="text" class="form-control" name="title" id="title" required value="<?php //echo $titleNoti; ?>"> 
              </div>
            </div>
            <div class="form-group"><label class="col-lg-3 control-label">Description:</label>

              <div class="col-lg-7">
				<textarea id="myeditor" name="myeditor"><?php //echo $textNoti; ?></textarea>
              </div>
           </div>

                                                            
          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="crs-save">Save</button>
             
           </div>
         </div>

       </form>
     </div>-->
   </div>
 </div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>
<script type="text/javascript">
	//CKEDITOR.replace('myeditor');
    CKEDITOR.replace( 'myeditor', {




    } );
    CKEDITOR.replace( 'myeditor2', {


    } );
</script> 
</div> 

</div>

</body>
</html>
 

