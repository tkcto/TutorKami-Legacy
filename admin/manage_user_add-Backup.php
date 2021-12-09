<?php
require_once('classes/newsletter.class.php');
$instNews = new newsletter;
$resNwtt = $instNews->ListNewsletterTemplate();
?>

<style>
.btn.btn-primary:disabled{
    background-color: #FF4500;
	border-color: #FF4500;
}

</style>

<?php
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} 

if(isset($_GET['action']) && $_GET['action'] == 'add_new') {
    $thisPage = 'Add '.$breadcrumb['m_name'].' Page';
    $updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
    if ( $dbCon->query($updateLastPage) === TRUE ) {}
}elseif(isset($_GET['action']) && $_GET['action'] == 'edit') {
    $thisPage = 'Edit '.$breadcrumb['m_name'].' Page';
    $updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
    if ( $dbCon->query($updateLastPage) === TRUE ) {}
}else {
    $thisPage = $breadcrumb['m_name'].' Page';
    $updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
    if ( $dbCon->query($updateLastPage) === TRUE ) {}         
}
$dbCon->close();
?>

<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
      <div class="col-lg-12">
         <form action="" method="post" id="frmMain" enctype="multipart/form-data">
            <?php echo (isset($userRow) && $userRow !== null) ? '<input type="hidden" name="u_id" value="'.$userRow['u_id'].'">' : '' ;?>            
            <div class="ibox float-e-margins localization">
               <div class="ibox-title">
                  <h5> Edit Customer Details</h5>     
    
                  <div class="ibox-tools">
                     <a href="manage_user.php" class="pull-left"><small>(back to customer list)</small></a>
                     <?php 
                     
                     if(isset($userRow) && $userRow !== null && $userRow['u_role'] != 4){//luqman hide approve tutor klu bukan parent
                           if(isset($userRow) && $userRow !== null && $userRow['u_role'] != 2){//luqman hide approve tutor klu bukan admin

                           if ($userRow['u_status'] == 'P' || $userRow['u_status'] == 'A'){//tutor
                        if($userRow['u_admin_approve'] == 0 || $userRow['u_admin_approve']== NULL) {
                           //echo '<button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="approve_tutor" type="submit">Approve Tutor</button>';
$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} 
$dataPhone = "SELECT * FROM ".DB_PREFIX."_user INNER JOIN ".DB_PREFIX."_user_details ON u_id = ud_u_id WHERE (u_status='A' OR u_admin_approve='1' OR u_admin_approve='2')  AND ud_phone_number = '".$userRow['ud_phone_number']."'";
$resultPhone = $dbCon->query($dataPhone);
if ($resultPhone->num_rows > 0) {
	echo '<div id="showBanned" class="btn btn-sm btn-primary sign-btn-box mrg-right-15 href="#" onClick="javascript:showBanned();" type="button">Approve Tutor</div>';
	echo '<div id="showBanned2" style="display:none;background-color: #FF4500;border-color: #FF4500;" class="btn btn-sm btn-primary sign-btn-box mrg-right-15 type="button" disabled>Approve Tutor</div>';
}else{
	echo '<button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="approve_tutor" type="submit">Approve Tutor</button>';
}
	
$dbCon->close();
							
							
						/* START fadhli - Manual Activated*/	
						}else if($userRow['u_admin_approve'] == 10){
							echo '<button class="btn btn-sm btn-info" name="manualActivated" type="submit">Activated Email</button>';
						/* END fadhli */	
						} elseif ($userRow['u_admin_approve'] == 1) {
                           echo '<small>(Admin Approved)</small> <button class="btn btn-sm btn-success" name="manualActive" type="submit">Manual Active</button>';
                        } elseif ($userRow['u_admin_approve'] == 2) {
                           echo '<small>(Activated)</small>';
                        }
                         
                              
                           }elseif ($userRow['u_status'] == 'A'){
                              echo '<small>(Active)</small>';
                           }elseif ($userRow['u_status'] == 'B'){
                              echo '<small>(Banned)</small>';
                           }
                     //tutor
                           //admin
                       }elseif ($userRow['u_status'] == 'P'){
                        echo '<small>(Pending)</small>';
                     }elseif ($userRow['u_status'] == 'A'){
                        echo '<small>(Admin Active)</small>';
                     }elseif ($userRow['u_status'] == 'B'){
                        echo '<small>(Admin Banned)</small>';
                     }

                        //parent
                     }elseif ($userRow['u_status'] == 'P'){
                        echo '<small>(Pending)</small>';
                     }elseif ($userRow['u_status'] == 'A'){
                        echo '<small>(Parent Active)</small>';
                     }elseif ($userRow['u_status'] == 'B'){
                        echo '<small>(Parent Banned)</small>';
                     }
                     //parent

                     ?>
                     <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                     <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">Save and Continue Edit</button>
                     <?php if(isset($userRow) && $userRow !== null) { ?>
                     <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" title="Delete" onClick="if(confirm('Are you sure, you want to remove the user?'))document.location.href='manage_user.php?action=delete_user&u_id=<?php echo $userRow['u_id'];?>'">Delete</button>
                     <?php } ?>
                  </div>
                  <div class="tabs-container">
                     <ul class="nav nav-tabs" id="myid">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Customer Info</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">Customer Roles</a></li>
                        <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                        <li id="this5" class=""><a data-toggle="tab" href="#tab-5">Location Info</a></li>
                        <li id="this6" class=""><a data-toggle="tab" href="#tab-6">Subject Info</a></li>
                        <li id="this3" class=""><a data-toggle="tab" href="#tab-3">Testimonials</a></li>
                        <li id="this4" class=""><a data-toggle="tab" href="#tab-4">Proof of Accepting Terms</a></li>
                        <?php } ?>
                        <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) { ?>
                                <li id="this7" class=""><a data-toggle="tab" href="#tab-7">Send Notifications</a></li>
                         <?php } ?>
                     </ul>
                     <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                           <div class="panel-body">
                              <!-- <div class="form-group hidden">
                                 <label class="col-sm-2 control-label">Username:</label>
                                 <div class="col-sm-10"><input type="hidden" class="form-control" name="u_username" value="<?php echo (isset($userRow) && $userRow !== null) ? $userRow['u_username'] : time() ;?>" data-required></div>
                              </div> -->
                              <!-- luqman hide sbb save sbgai email spatutnya -->
                              <div class="row">
                                 <div class="col-md-12">
								 
								 

                                 <div class="col-md-4 text-right <?php if(isset($_GET['action']) && $_GET['action'] == 'edit' && $userRow['u_role'] == 4){echo "hidden";}?>">
                                    <?php $pix = sprintf("%'.07d\n", $userRow['u_profile_pic']);
                                     if (isset($userRow) && $userRow !== null) {
                                       if ($userRow['u_profile_pic'] != '') {
											//echo "<img src=\"".APP_ROOT."images/profile/".$pix."_0.jpg\" alt=\"profile_pic\" class=\"img-thumbnail\">";//luqman hide, ni accept gmbar yg sedia ada je
											//echo "<img src=\"".APP_ROOT."images/profile/000".$userRow['u_profile_pic']."_0.jpg\" height=\"244\" width=\"190\" alt=\"profile_pic\" class=\"img-thumbnail\">";
											if ( is_numeric($userRow['u_profile_pic']) ) {
												echo "<img src=\"".APP_ROOT."images/profile/".$pix."_0.jpg\" alt=\"profile_pic\" class=\"img-thumbnail\">";
											}else{
												echo "<img src=\"".APP_ROOT."images/profile/".$userRow['u_profile_pic'].".jpg\" alt=\"profile_pic\" class=\"img-thumbnail\">";
											}
                                       } elseif ($userRow['u_gender'] == 'M') {
											echo '<img src="'.APP_ROOT."images/tutor_ma.png".'" alt="profile_pic" class="img-thumbnail">';
                                       } else {
											echo '<img src="'.APP_ROOT."images/tutor_mi1.png".'" alt="profile_pic" class="img-thumbnail">';
                                       }                  
                                     }
                                     ?><p>
                                     <input type="file" name="u_profile_pic" id="file-7" class="inputfile inputfile-6" accept="image/*"></p>
								 </div>

                                 	<!-- add job button -->
                                 	<?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) { ?>
                                 	<div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                    	<label class="col-sm-3 control-label">Add Job:</label>

                                       <?php
                                       		if(isset($_GET['u_id'])){
                                       			$jobResEm = $userInit->GetDisplayIdJobLink($_GET['u_id']);
                                       			$jobRowEm = $jobResEm->fetch_array(MYSQLI_ASSOC);
                                       			if($jobResEm->num_rows > 0) {
                                       				echo '<div class="col-sm-9"><label class="label label-primary"><a href="job-add?u_id='.$jobRowEm['u_id'].'" target="_blank" title="ID: '.$jobRowEm['u_id'].'" style="color:#FFF; text-decoration: none;">Add Job</a></label></div> ';
                                       			}else{
                                       				echo 'no rows found';
                                       			}
                                       		}
                                        ?>
                                       
                                    </div>
                                    <?php } ?>
                                    <!-- add job button -->

                                  <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                                    <div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Display id:</label>
                                       <div class="col-sm-9"><input type="text" class="form-control" name="u_displayid" value="<?php echo (isset($_POST['u_displayid'])) ? $_POST['u_displayid'] : ( (isset($userRow) && $userRow !== null) ? $userRow['u_displayid'] : '' ) ;?>" readonly ></div>
                                    </div>
                                    <?php } ?>
                                    <div class="clearfix "></div>
                                    <div class="hr-line-dashed"></div>
                                    <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { //untuk email tutor?>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Email:</label>
                                       <div class="col-sm-9"><input type="text" class="form-control" name="u_email" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : '');?>" data-email></div>
                                    </div>
                                    <?php } ?>
                                    <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) { //untuk email parent?>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Key:</label>
                                       <div class="col-sm-9">
                                         <!-- <div class="input-group">                -->
                                          <input type="text" class="form-control" name="u_email" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : '');?>" data-email>
                                          <!-- <span class="input-group-addon">@tutorkami.com</span> -->
                                       <!-- </div> -->
                                       </div>
                                    </div>
                                    <?php } ?>
                                    <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 2) { //untuk email parent?>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Email:</label>
                                       <div class="col-sm-9">
                                         <!-- <div class="input-group">                -->
                                          <input type="text" class="form-control" name="u_email" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : '');?>" data-email>
                                          <!-- <span class="input-group-addon">@tutorkami.com</span> -->
                                       <!-- </div> -->
                                       </div>
                                    </div>
                                    <?php } ?>
                                    <!-- kalau insert new -->
                                    <?php
                                    $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
                                    //if($host == 'tutorkami.com/admin/manage_user?action=add_new'){ 
									if($host == 'www.tutorkami.com/admin/manage_user?action=add_new'){
									?>
                                   <div class="form-group">
                                       <label class="col-sm-3 control-label">Key:</label>
                                       <div class="col-sm-5">
                                        
                                          <input type="text" class="form-control" name="u_email" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : '');?>">
                                       </div>
                                       <div class="col-sm-4">
                                          <select class="form-control" name="emailalias" id="emailalias">
                                       <option value="">Please Select</option>
                                       <option value="@tutorkami.com" selected >@tutorkami.com</option>
                                    </select>
                                       </div>
                                    </div>
                                   <?php } ?>
                                   <!-- kalau insert new -->
                                    <div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Password:</label>
                                       <div class="col-sm-9"><input type="password" class="form-control" name="u_password" <?php echo (isset($userRow) && $userRow !== null && $userRow['u_password'] != '') ? '' : 'data-required' ;?>></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Gender: <br>
                                       </label>
                                       <div class="col-sm-9">
                                          <div  class="form-horizontal i-checks">
                                             <label> <input type="radio" <?php echo (isset($_POST['u_gender']) && $_POST['u_gender'] == 'M') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['u_gender'] == 'M') ? 'checked=""' : '' );?> value="M" name="u_gender" data-required> Male</label> 
                                             <label> <input type="radio" <?php echo (isset($_POST['u_gender']) && $_POST['u_gender'] == 'F') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['u_gender'] == 'F') ? 'checked=""' : '' );?> value="F" name="u_gender" data-required> Female</label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">First name:</label>
                                       <div class="col-sm-9"><input type="text" class="form-control" name="ud_first_name" value="<?php echo (isset($_POST['ud_first_name'])) ? $_POST['ud_first_name'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_first_name'] : '' ) ;?>" data-required></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label"><?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) {echo 'Email:';}else{echo 'Last Name:';} ?>  </label>
                                       <div class="col-sm-9"><input type="text" class="form-control" name="ud_last_name" value="<?php echo (isset($_POST['ud_last_name'])) ? $_POST['ud_last_name'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_last_name'] : '' ) ;?>" ></div>
                                    </div>                                    
                                 </div>

                              </div>
                              
                              <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                              
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Display name:</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="u_displayname" value="<?php echo (isset($_POST['u_displayname'])) ? $_POST['u_displayname'] : ( (isset($userRow) && $userRow !== null) ? $userRow['u_displayname'] : '' ) ;?>" ></div>
                              </div>
                              <?php } ?>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group" id="dob">
                                 <label class="col-sm-3 control-label">Date of birth:</label>
                                 <div class="col-sm-9">
                                    <div class="input-group date">
                                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control date_picker" name="ud_dob" value="<?php echo (isset($_POST['ud_dob'])) ? $_POST['ud_dob'] : ( (isset($userRow) && $userRow['ud_dob'] != '' && $userRow['ud_dob'] != '0000-00-00') ? date('d/m/Y', strtotime($userRow['ud_dob'])) : '' );?>" placeholder="select date" />
                                    </div>
                                 </div>
                              </div>
                              <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group" id="current_company">
                                 <label class="col-sm-3 control-label">Company :</label>
                                 <div class="col-sm-9">
                                    <input type="text" class="form-control date_picker" name="ud_current_company" value="<?php echo (isset($_POST['ud_current_company'])) ? $_POST['ud_current_company'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_current_company'] : '' );?>" >
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Address:</label>
                                 <div class="col-sm-9"><textarea class="form-control" name="ud_address2"><?php echo (isset($_POST['ud_address2'])) ? $_POST['ud_address2'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_address2'] : '' );?></textarea></div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <!-- <div class="form-group">
                                 <label class="col-sm-2 control-label">City:</label>
                                 <div class="col-sm-10"><textarea class="form-control" name="ud_address"><?php echo (isset($_POST['ud_address'])) ? $_POST['ud_address'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_address'] : '' );?></textarea></div>
                              </div> -->
                              <!-- luqman -->
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">City:</label>
                                 <div class="col-sm-9"><textarea class="form-control" style="text-transform:uppercase" name="ud_city"><?php echo (isset($_POST['ud_city'])) ? $_POST['ud_city'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_city'] : '' );?></textarea></div>
                              </div>
                              <!-- luqman -->
                              <?php } ?>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Phone:</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="ud_phone_number" value="<?php echo (isset($_POST['ud_phone_number'])) ? $_POST['ud_phone_number'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_phone_number'] : '' );?>" data-numeric></div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group i-checks">
                                 <label class="col-sm-3 control-label">Race:</label>
                                 <div class="col-sm-9">
                                    <label class="udradio"> <input type="radio" value="Malay" id="" name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] == 'Malay') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_race'] == 'Malay') ? 'checked' : '' );?>> Malay  </label> 
                                    <label class="udradio"> <input type="radio" value="Chinese" id=""  name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] == 'Chinese') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_race'] == 'Chinese') ? 'checked' : '' );?>> Chinese</label>
                                    <label class="udradio"> <input type="radio" value="Indian" id=""  name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] == 'Indian') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_race'] == 'Indian') ? 'checked' : '' );?>> Indian</label>
                                    <label class="udradio"> <input type="radio" value="Others" id=""  name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] != 'Malay' && $_POST['ud_race'] != 'Chinese' && $_POST['ud_race'] != 'Indian' && $_POST['ud_race'] != 'Not selected') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_race'] != 'Malay' && $userRow['ud_race'] != 'Chinese' && $userRow['ud_race'] != 'Indian' && $userRow['ud_race'] != 'Not selected') ? 'checked' : '' );?>> Others</label>
                                    <label class="udradio"> <input type="radio" value="Not selected" id=""  name="ud_race" <?php echo (isset($_POST['ud_race']) && $_POST['ud_race'] == 'Not selected') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_race'] == 'Not selected') ? 'checked' : '' );?>> Not Selected </label>
                                    <br>
                                    <div id="other_race_wrap">
                                       <?php 
                                       if (isset($_POST['ud_race']) && $_POST['ud_race'] != 'Malay' && $_POST['ud_race'] != 'Chinese' && $_POST['ud_race'] != 'Indian' && $_POST['ud_race'] != 'Not Selected') {
                                          echo '<textarea name="ud_race" class="form-control">'.$_POST['ud_race'].'</textarea>';
                                       }  elseif (isset($userRow) && $userRow !== null && $userRow['ud_race'] != 'Malay' && $userRow['ud_race'] != 'Chinese' && $userRow['ud_race'] != 'Indian' && $userRow['ud_race'] != 'Not selected') {
                                          echo '<textarea name="ud_race" class="form-control">'.$userRow['ud_race'].'</textarea>';
                                       }
                                       ?>
                                    </div>
                                 </div>
                              </div>
							  <!-- START fadhli - hide Nationality -->
							  <?PHP
							  if(isset($userRow) && $userRow['u_role'] == 3){
							  ?>
                              <div class="clearfix"></div>			  
                              <div class="hr-line-dashed"></div>
							  <div class="form-group i-checks">
                                 <label class="col-sm-3 control-label">Marital Status:</label>
                                 <div class="col-sm-9">
                                    <label class="udradio"> <input type="radio" value="Married" id="" name="ud_marital_status" <?php echo (isset($_POST['ud_marital_status']) && $_POST['ud_marital_status'] == 'Married') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_marital_status'] == 'Married') ? 'checked' : '' );?>> Married  </label> 
                                    <label class="udradio"> <input type="radio" value="Not married" id=""  name="ud_marital_status" <?php echo (isset($_POST['ud_marital_status']) && $_POST['ud_marital_status'] == 'Not married') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_marital_status'] == 'Not married') ? 'checked' : '' );?>> Not Married</label>
                                    <label class="udradio"> <input type="radio" value="Not selected" id=""  name="ud_marital_status" <?php echo (isset($_POST['ud_marital_status']) && $_POST['ud_marital_status'] == 'Not selected') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_marital_status'] == 'Not selected') ? 'checked' : '' );?>> Not Selected</label>
                                 </div>
                              </div>
							  <?PHP
							  }else{
							  ?>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group i-checks">
                                 <label class="col-sm-3 control-label">Nationality:</label>
                                 <div class="col-sm-9">
                                    <label class="udradio"> <input type="radio" value="Malaysian" id="" name="ud_nationality" <?php echo (isset($_POST['ud_nationality']) && $_POST['ud_nationality'] == 'Malaysian') ? 'checked' : ( (isset($userRow) && $userRow !== null && $userRow['ud_nationality'] == 'Malaysian') ? 'checked' : '' );?>>Malaysian  </label> 
                                    <label class="udradio"> <input type="radio" value="Non Malaysian" id="" name="ud_nationality"  <?php echo (isset($_POST['ud_nationality']) && $_POST['ud_nationality'] != 'Malaysian' && $_POST['ud_nationality'] != 'Not Selected') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_nationality'] != 'Malaysian' && $userRow['ud_nationality'] != 'Not Selected') ? 'checked' : '' );?>> Non Malaysian</label>
                                    <label class="udradio"> <input type="radio" value="Not Selected" id="" name="ud_nationality" <?php echo (isset($_POST['ud_nationality']) && $_POST['ud_nationality'] == 'Not Selected') ? 'checked' : ( (isset($userRow) && $userRow !== null && $userRow['ud_nationality'] == 'Not Selected') ? 'checked' : '' );?>> Not Selected </label>
                                    <br>
                                    <div id="other_nationality_wrap"><?php 
                                       if (isset($_POST['ud_nationality']) && $_POST['ud_nationality'] != 'Malaysian' && $_POST['ud_nationality'] != 'Not Selected') {
                                          echo '<textarea name="ud_nationality" class="form-control">'.$_POST['ud_nationality'].'</textarea>';
                                       }  elseif (isset($userRow) && $userRow !== null && $userRow['ud_nationality'] != 'Malaysian' && $userRow['ud_nationality'] != 'Not Selected') {
                                          echo '<textarea name="ud_nationality" class="form-control">'.$userRow['ud_nationality'].'</textarea>';
                                       }
                                       ?></div>
                                 </div>
                              </div>
							  <?PHP
							  }
							  ?>
							  <!-- END fadhli -->
                              <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Status as tutor: <br>
                                 </label>
                                 <div class="col-sm-9">
                                    <div  class="form-horizontal i-checks">
                                       <label> <input type="radio" <?php echo (isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Full Time') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_tutor_status'] == 'Full Time') ? 'checked=""' : '' );?> value="Full Time" name="ud_tutor_status" data-required> Full Time</label> 
                                       <label> <input type="radio" <?php echo (isset($_POST['ud_tutor_status']) && $_POST['ud_tutor_status'] == 'Part Time') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_tutor_status'] == 'Part Time') ? 'checked=""' : '' );?> value="Part Time" name="ud_tutor_status" data-required> Part Time</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Occupation: <br>
                                 </label>
                                 <div class="col-sm-4">
                                    <select class="form-control" name="ud_current_occupation" id="ud_current_occupation">
                                       <option value="">Select one</option>
                                       <option value="Full-time tutor" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Full-time tutor' ? 'selected' : '';?>>Full Time Tutor</option>
                                       <option value="Kindergarten teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Kindergarten teacher' ? 'selected' : '';?>>Kindergarten Teacher</option>
                                       <option value="Primary school teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Primary school teacher' ? 'selected' : '';?>>Primary School Teacher</option>
                                       <option value="Secondary school teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Secondary school teacher' ? 'selected' : '';?>>Secondary School Teacher</option>
                                       <option value="Tuition center teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Tuition center teacher' ? 'selected' : '';?>>Tuition Center Teacher</option>
                                       <option value="Lacturer" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Lacturer' ? 'selected' : '';?>>Lecturer</option>
                                       <option value="Ex-teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Ex-teacher' ? 'selected' : '';?>>Ex Teacher</option>
                                       <option value="Retired teacher" <?php echo isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Retired teacher' ? 'selected' : '';?>>Retired Teacher</option>
                                       <option value="Other" <?php echo (isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Other') ? 'selected' : '';?>>Other</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-5">
                                    <?php 
                                    if(isset($userRow['ud_current_occupation']) && $userRow['ud_current_occupation'] == 'Other') {
                                       $occ_other = $userRow['ud_current_occupation_other'];
                                       $sty_other = 'block';
                                    } else {
                                       $occ_other = '';
                                       $sty_other = 'none';
                                    }
                                    ?>
                                    <input class="form-control" type="text" name="ud_current_occupation_other" value="<?php echo $occ_other;?>" style="display: <?php echo $sty_other;?>;">
                                 </div>
                              </div>
                               
                              
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Tutor's rate/hour (optional) :</label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" name="ud_rate_per_hour"><?php echo (isset($_POST['ud_rate_per_hour'])) ? $_POST['ud_rate_per_hour'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_rate_per_hour'] : '' );?></textarea>
                                 </div>
                              </div>
							  
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Can teach learning disability student? <br>
                                 </label>
                                 <div class="col-sm-9">
                                    <div  class="form-horizontal i-checks">
                                       <label> <input type="radio" <?php echo (isset($_POST['student_disability']) && $_POST['student_disability'] == 'Yes') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['student_disability'] == 'Yes') ? 'checked=""' : '' );?> value="Yes" name="student_disability"> Yes</label> 
                                       <label> <input type="radio" <?php echo (isset($_POST['student_disability']) && $_POST['student_disability'] == 'No') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['student_disability'] == 'No') ? 'checked=""' : '' );?> value="No" name="student_disability"> No</label>
                                    </div>
                                 </div>
                              </div>
							  
                              <?php } ?>
                              <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Qualification:</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="ud_qualification" value="<?php echo (isset($_POST['ud_qualification'])) ? $_POST['ud_qualification'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_qualification'] : '' );?>"></div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Experience:</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="ud_tutor_experience" value="<?php echo (isset($_POST['ud_tutor_experience'])) ? $_POST['ud_tutor_experience'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_tutor_experience'] : '' );?>"></div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">About yourself:</label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" name="ud_about_yourself"><?php echo (isset($_POST['ud_about_yourself'])) ? $_POST['ud_about_yourself'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_about_yourself'] : '' );?></textarea>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Consider tuition center:</label>
                                 <div class="col-sm-9">
                                    <div class="row">
                                       <div class="col-md-6">
                                         <label class="radio-inline" style="font-size:15px;">
                                           <input type="radio" name="ud_client_status" value="1" <?php echo (isset($userRow['ud_client_status']) && $userRow['ud_client_status'] == 'Tuition Centre') ? 'checked' : ''; ?>>
                                           Yes</label>
                                       </div>
                                       <div class="col-md-6">
                                         <label class="radio-inline" style="font-size:15px;">
                                           <input type="radio" name="ud_client_status" value="0" <?php echo (isset($userRow['ud_client_status']) && $userRow['ud_client_status'] != 'Tuition Centre') ? 'checked' : ''; ?>>
                                           No</label>
                                       </div>
                                     </div>
                                 </div>
                              </div>
                              <?php } ?>
                             
                              <?php if(!isset($userRow) || (isset($userRow) && $userRow !== null && $userRow['u_role'] != 3)) { ?>

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Address:</label>
                                 <div class="col-sm-9"><textarea class="form-control" name="ud_address"><?php echo (isset($_POST['ud_address'])) ? $_POST['ud_address'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_address'] : '' );?></textarea></div>
                              </div>
							  
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">City:</label>
                                 <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ud_city2" value="<?php echo (isset($_POST['ud_city'])) ? $_POST['ud_city'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_city'] : '' ) ;?>" >
                                 </div>
                                 <div class="col-sm-4">
                                    <select class="form-control cnty" name="ud_city" id="ud_city">
                                       <option value="0">Select City Name</option>
                                       <!-- error sebab dye insert guna user detail tp nk display guna table city -->
                                       <?php 
                                       if((isset($_POST['ud_state']) && $_POST['ud_state'] != '') || (isset($userRow) && $userRow !== null && $userRow['ud_state'] != '')) {
                                          $state_id = (isset($_POST['ud_state']) && $_POST['ud_state'] != '') ? $_POST['ud_state'] : $userRow['ud_state'];
                                          $ciresponse = $initLocation->StateWiseCity($state_id);
                                          if ($ciresponse->num_rows > 0) {
                                             while( $cu_row = $ciresponse->fetch_assoc() ){
                                                $sel = (isset($_POST['ud_city']) && $_POST['ud_city'] == $cu_row['city_name']) ? 'selected' : (($userRow['ud_city'] == $cu_row['city_name']) ? 'selected' : '' );
                                                echo '<option value="'. $cu_row['city_id'] .'" '.$sel.'>'. $cu_row['city_name'] .'</option>';
                                             }
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
							  
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">State:</label>
                                 <div class="col-sm-9">
                                    <select class="form-control cnty" name="ud_state" id="ud_state">
                                       <option value="0">Select State Name</option>
                                       <?php 
                                       // luqman ubah so xpayah select country atas dah
                                       $country_id = 150;
                                          $stresponse = $initLocation->CountryWiseState($country_id);
                                          if ($stresponse->num_rows > 0) {
                                             while( $cu_row = $stresponse->fetch_assoc() ){
                                                 $sel = (isset($_POST['ud_state']) && $_POST['ud_state'] == $cu_row['st_id']) ? 'selected' : (($userRow['ud_state'] == $cu_row['st_id']) ? 'selected' : '' );
                                                echo '<option value="'. $cu_row['st_id'] .'" '.$sel.'>'. $cu_row['st_name'] .'</option>';
                                             }
                                          }
                                       ?>
                                    </select>
                                 </div>
                              </div>
							  
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Country:</label>
                                 <div class="col-sm-9">
                                    <!-- <input type="text" name="ud_country" id="ud_country" value="Malaysia" data-required disabled> -->
                                    
                                    <select class="form-control cnty" name="ud_country" id="ud_country" data-required>
                                       
                                        <?php while($arrCnt = $resCnt->fetch_assoc()) {?>
                                        <option selected="selected" value="<?php echo $arrCnt['c_id'];?>" <?php echo (isset($_POST['ud_country']) && $_POST['ud_country'] == $arrCnt['c_id']) ? 'selected' : ( (isset($userRow) && $userRow !== null && $userRow['ud_country'] == $arrCnt['c_id'])? 'selected' : '' );?>><?php echo $arrCnt['c_name'];?></option>
                                        <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <?php } else { ?>
                              
                              <?php } ?>
                             
                              
                              
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group i-checks">
                                 <label class="col-sm-3 control-label">Client Status:</label>
                                 <div class="col-sm-9">
                                    <label > <input type="radio" value="Parent" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Parent') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Parent') ? 'checked' : '' );?> data-required> Parent  </label> 
                                    <label> <input type="radio" value="Student" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Student') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Student') ? 'checked' : '' );?> data-required> Student</label>
                                    <label> <input type="radio" value="Tuition Centre" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Tuition Centre') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Tuition Centre') ? 'checked' : '' );?> data-required> Tuition Centre</label>
                                    <label> <input type="radio" value="Agent" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Agent') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Agent') ? 'checked' : '' );?> data-required> Agent </label>
                                    <label> <input type="radio" value="Not Selected" id="" name="ud_client_status_2" <?php echo (isset($_POST['ud_client_status_2']) && $_POST['ud_client_status_2'] == 'Not Selected') ? 'checked=""' : ( (isset($userRow) && $userRow !== null && $userRow['ud_client_status_2'] == 'Not Selected') ? 'checked' : '' );?> data-required>Not Selected </label>
                                 </div>
                              </div>
							  
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group i-checks">
                                 <label class="col-sm-3 control-label">User Status:</label>
                                 <div class="col-sm-9">

                                   
                                       <?php $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
                                    if($host == 'www.tutorkami.com/admin/manage_user?action=add_new'){ ?>
                                       
                                    <?php }else{ 
                                    //if(isset($userRow) && $userRow !== null && $userRow['u_role'] != 4) {
									if(isset($userRow) && $userRow !== null && $userRow['u_status'] == 'P') {
                                    ?>
                                         <label><input type="radio" name="u_status" value="P" id="inlineCheckbox1" <?php echo (isset($_POST['u_status']) && $_POST['u_status'] == 'P')? 'checked' : ((isset($userRow) && $userRow['u_status'] == 'P')?'checked':''); ?>>
											<b>Pending</b>
                                         </label>									
                                    <?php
                                    }
                                    ?>

                                    <?php }?>
                                         <label>
                                           <input type="radio" name="u_status" value="A" id="inlineCheckbox1" <?php echo (isset($_POST['u_status']) && $_POST['u_status'] == 'A')? 'checked' : ((isset($userRow) && $userRow['u_status'] == 'A')?'checked':''); ?>>
                                           Active</label>
                                     
                                         <label>
                                           <input type="radio" name="u_status" value="B" id="inlineCheckbox1" <?php echo (isset($_POST['u_status']) && $_POST['u_status'] == 'B')? 'checked' : ((isset($userRow) && $userRow['u_status'] == 'B')?'checked':''); ?>>
                                           Banned</label>
                                     
                                 </div>
                              </div>
							  
                              
                              <?php if(!isset($userRow) || (isset($userRow) && $userRow !== null && $userRow['u_role'] != 3)) { ?>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group i-checks">
                                 <label class="col-sm-3 control-label">Paying Client:</label>
                                 <div class="col-sm-9"><label class="checkbox-inline"> <input type="checkbox" value="P" id="inlineCheckbox2" name="u_paying_client" <?php echo (isset($_POST['u_paying_client']) && $_POST['u_paying_client'] == 'P')? 'checked' : ((isset($userRow) && $userRow['u_paying_client'] == 'P')?'checked':''); ?>>  </label></div>
                              </div>
                              <?php } ?>
							  

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">List of Past Jobs:</label>
                                 <div class="col-sm-9">
                                    <?php 
                                    // Get all the Job Ids for this tutor
                                    if (isset($userRow) && $userRow !== null) {
                                       if ($userRow['u_role'] != 3) {
                                          $jobList = $userInit->ClientsJob($userRow['u_email']);
                                       } else {
                                          $jobList = $userInit->TutorsJob($userRow['u_email']);   
                                       }
                                       
                                       if ($jobList->num_rows > 0) {
                                          while ($appliedjob = $jobList->fetch_assoc()) {
                                             echo '<label class="label label-primary"><a href="job-edit.php?j='.$appliedjob['j_id'].'" target="_blank" style="color:#FFF; text-decoration: none;">'.$appliedjob['j_id'].'</a></label> ';
                                          }
                                       }
                                    }
                                       
                                    ?>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Admin comment:</label>
                                 <div class="col-sm-9">
                                    <div class="clearfix"></div>
                                    <textarea class="form-control col-lg-12 col-sm-12" rows="5" name="ud_admin_comment"><?php echo (isset($_POST['ud_admin_comment'])) ? $_POST['ud_admin_comment'] : ( (isset($userRow) && $userRow !== null) ? $userRow['ud_admin_comment'] : '' );?></textarea>
                                 </div>
                              </div>
							  
                                  <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 4) { ?>
                                    <div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Created On:</label>
                                       <div class="col-sm-9"><input type="text" class="form-control" name="created_on" value="<?php echo $userRow['u_create_date']; ?>" disabled></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                       <label class="col-sm-3 control-label">Last Login:</label>
                                       <div class="col-sm-9"><input type="text" class="form-control" name="last_login" value="<?php echo $userRow['u_modified_date']; ?>" disabled></div>
                                    </div>
                                    <?php } ?>
							  
							  
<?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] != 4) { 
$dbConnection = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
} 
$dataUser = "SELECT * FROM tk_user WHERE u_id='$userRow[ud_u_id]'";
$resultUser = $dbConnection->query($dataUser);
if ($resultUser->num_rows > 0) {
    /*while($row = $result->fetch_assoc()) {
        echo "u_id: " . $row["u_id"]. " - u_username: " . $row["u_username"]. " " . $row["u_create_date"]. "<br>";
    }*/
	$rowUser = $resultUser->fetch_assoc();
	$createDate = $rowUser["u_create_date"];
	$lastActivity = $rowUser["u_modified_date"];
	$ipAddress = $rowUser["ip_address"];
	$lastPage = $rowUser["last_page"];
} /*else {
    echo "0 results";
}*/
$dbConnection->close();


$replaceThis = Array(
'- C :' => ' - ',
'- R :' => ' ',
'- CT :' => ', ',
);

$replacedText = str_replace(array_keys($replaceThis), $replaceThis, $ipAddress);
?>

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">IP Address :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="ip_address" value="<?PHP echo $replacedText; ?>" disabled></div>
                              </div>

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Registration Date :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="registration_date" value="<?PHP echo $createDate; ?>" disabled></div>
                              </div>

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Last Activity :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="last_activity" value="<?PHP echo $lastActivity; ?>" disabled></div>
                              </div>
							  

                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Last Visited Page :</label>
                                 <div class="col-sm-9"><input type="text" class="form-control" name="last_visited_page" value="<?PHP echo $lastPage; ?>" disabled></div>
                              </div>
							  
							  
<?php } ?>
							  
							  
							  
							  
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                           </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                           <div class="panel-body">
                              <?php //aaaa
                              if ($roleData->num_rows > 0) {$ur = 0;
                                 while( $row = $roleData->fetch_assoc() ){
                                    //if($row['r_id'] > $_SESSION[DB_PREFIX]['r_id']) {
                                    /* START fadhli */
                                    if($row['r_id'] >= $_SESSION[DB_PREFIX]['r_id']) {
                              ?>
                              <?php $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
                                    if($host == 'www.tutorkami.com/admin/manage_user?action=add_new'){ ?>
                              <div class="form-group i-checks">
                                 <label class="col-sm-2 control-label"><?php echo $row['r_name'];?> :</label>
                                 <div class="col-sm-10"><label class="checkbox-inline"><input type="radio" value="<?php echo $row['r_id'];?>" id="u_role" name="u_role" <?php 
                                 if ((isset($_POST['u_role']) && $_POST['u_role'] == $row['r_id']) || ( isset($userRow) && $userRow !== null && $row['r_id'] == $userRow['u_role'] )) {
                                    echo 'checked';
                                 } elseif (!isset($userRow) && $ur == 3) {
                                    echo 'checked';
                                 }
                                 ?> checked='checked' data-required/></label></div>
                              </div>
                           <?php }else{?>
                           
                           <div class="form-group i-checks">
                                 <label class="col-sm-2 control-label"><?php echo $row['r_name'];?> :</label>
                                 <div class="col-sm-10"><label class="checkbox-inline"><input type="radio" value="<?php echo $row['r_id'];?>" id="u_role" name="u_role" <?php 
                                 if ((isset($_POST['u_role']) && $_POST['u_role'] == $row['r_id']) || ( isset($userRow) && $userRow !== null && $row['r_id'] == $userRow['u_role'] )) {
                                    echo 'checked';
                                 } elseif (!isset($userRow) && $ur == 3) {
                                    echo 'checked';
                                 }
                                 ?> data-required/></label></div>
                              </div>
                           <?php }?>
                              <div class="clearfix"></div>
                              <div class="hr-line-dashed"></div>
                              <?php 
                                       $ur++;
                                    }
                                 }
                              } else {
                                 echo '<tr><td colspan="3">No Record Found</td></tr>';
                              }
                              ?>
                           </div>
                        </div>


                        <div id="tab-7" class="tab-pane">
                           <div class="panel-body">  
                           
                           
                           <input class="form-control" id="sendemail_displayid" type="hidden" value="<?php echo (isset($_POST['u_displayid'])) ? $_POST['u_displayid'] : ( (isset($userRow) && $userRow !== null) ? $userRow['u_displayid'] : '' ) ;?>"> 

                             <div class="form-horizontal">
                                <div class="form-group">
                                   <label class="col-lg-3 control-label">Email:</label>
                                   <div class="col-lg-9">
                                      <input class="form-control" id="sendemail_email" type="text" value="<?php echo (isset($_POST['u_email'])) ? $_POST['u_email'] : ((isset($userRow) && $userRow !== null) ? $userRow['u_email'] : '');?>" readonly> 
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-lg-3 control-label"> User Details:</label>
                                   <div class="col-lg-9">
                                   <select class="form-control" id="sendemail_userdetail">
                                         <option value="">Select User Details</option>
<?PHP
$dbConnection = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
} 
$test1 = "SELECT * FROM tk_job WHERE j_email='$userRow[u_email]'";
$test2 = $dbConnection->query($test1);
if ($test2->num_rows > 0) {
    while($test3 = $test2->fetch_assoc()) {
        ?>
        <option value="<?php echo $test3['j_hired_tutor_email'];?>"><?php echo $test3['j_hired_tutor_email'];?></option>
        <?PHP
    }
}else {
    echo "0 results";
}
$dbConnection->close();
?>
                                      </select>


                                      
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-lg-3 control-label">Email Template:</label>
                                   <div class="col-lg-9">
                                      <select class="form-control" id="sendemail_template">
                                         <option value="">Select Email Template</option>
                                         <?php 
                                         $resNwtt1 = $instNews->ListNewsletterTemplate();
                                         while($arrNwtt1 = $resNwtt1->fetch_assoc()) {?>
                                         <option value="<?php echo $arrNwtt1['ntt_id'];?>"><?php echo $arrNwtt1['ntt_subject'];?></option>
                                         <?php } ?>
                                      </select>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <div class="col-lg-offset-3 col-lg-3">
                                      <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="button" id="send_newsletter" onClick="send_newsletter()">SEND</button>
                                   </div>
                                </div>
                             </div>

                           </div>
                        </div>





                        <?php if(isset($userRow) && $userRow !== null && $userRow['u_role'] == 3) { ?>
                        <div id="tab-3" class="tab-pane">
                           <div class="panel-body">
                              <div class="form-group">
                                <label class="control-label col-sm-4">
                                Upload Testimonial
                                </label>
                                <div class="col-sm-8">                                
                                  <input type="file" name="user_testimonial1" id="testimonial_1" class="inputfile inputfile-6">
                                  
                                  <input type="file" name="user_testimonial2" id="testimonial_2" class="inputfile inputfile-6">
                                  
                                  <input type="file" name="user_testimonial3" id="testimonial_3" class="inputfile inputfile-6">
                                  
                                  <input type="file" name="user_testimonial4" id="testimonial_4" class="inputfile inputfile-6">
                                  
                                </div>
                              </div>
                              <!-- luqman -->
                              <ul class="whatsapp">
                                 <?php 
                                 // Get Testimonial
                                 $testData = $userInit->GetUserTestimonial($userRow['u_id']);
                                 if ($testData->num_rows > 0) {
                                    while( $testimonial = $testData->fetch_assoc() ){
										// images/testimonial/testimonial_0.jpg
										
										if($testimonial['ut_user_testimonial1'] != ''){
										?>
                                 <li>
                                    <a class="example-image-link" href="<?php APP_ROOT.$testimonial['ut_user_testimonial1']; ?>" data-lightbox="example-set">
                                    <img src="<?php echo APP_ROOT.$testimonial['ut_user_testimonial1']; ?>" alt="testimonial1" class="cropped img-responsive admin-testm-img">
                                 </a>
                                 </li>
										
										<?PHP
										}
										if($testimonial['ut_user_testimonial2'] != ''){
										?>
                                 <li>
                                    <a class="example-image-link" href="<?php echo APP_ROOT.$testimonial['ut_user_testimonial2']; ?>" data-lightbox="example-set">
                                    <img src="<?php echo APP_ROOT.$testimonial['ut_user_testimonial2']; ?>" alt="testimonial2" class="cropped img-responsive admin-testm-img">
                                 </a>
                                 </li>
										
										<?PHP
										}
										if($testimonial['ut_user_testimonial3'] != ''){
										?>
                                 <li>
                                    <a class="example-image-link" href="<?php echo APP_ROOT.$testimonial['ut_user_testimonial3']; ?>" data-lightbox="example-set">
                                    <img src="<?php echo APP_ROOT.$testimonial['ut_user_testimonial3']; ?>" alt="testimonial3" class="cropped img-responsive admin-testm-img">
                                 </a>
                                 </li>
										
										<?PHP
										}
										if($testimonial['ut_user_testimonial4'] != ''){
										?>
                                 <li>
                                    <a class="example-image-link" href="<?php echo APP_ROOT.$testimonial['ut_user_testimonial4']; ?>" data-lightbox="example-set">
                                    <img src="<?php echo APP_ROOT.$testimonial['ut_user_testimonial4']; ?>" alt="testimonial4" class="cropped img-responsive admin-testm-img">
                                 </a>
                                 </li>
										
										<?PHP
										}
                                 ?>

    <!--                              <h3>A Four Image Set</h3>
    <div>
      <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-3.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
         <img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-3.jpg" alt=""/>
      </a>

      <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-4.jpg" data-lightbox="example-set" data-title="Or press the right arrow on your keyboard."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-4.jpg" alt="" /></a>
      <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-5.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-5.jpg" alt="" /></a>
      <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-6.jpg" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-6.jpg" alt="" /></a>
    </div> -->

                                 <div id="myModal" class="modal">
                                  <span class="close cursor" onclick="closeModal()">&times;</span>
                                  <div class="modal-content">

                                   <div class="mySlides">
                                    <div class="numbertext">1 / 4</div>
                                    <img src="<?php echo APP_ROOT.$testimonial['ut_user_testimonial1']; ?>" style="width:100%">
                                 </div>

                                 <div class="mySlides">
                                    <div class="numbertext">2 / 4</div>
                                    <img src="<?php echo APP_ROOT.$testimonial['ut_user_testimonial2']; ?>" style="width:100%">
                                 </div>

                                 <div class="mySlides">
                                    <div class="numbertext">3 / 4</div>
                                    <img src="<?php echo APP_ROOT.$testimonial['ut_user_testimonial3']; ?>" style="width:100%">
                                 </div>

                                 <div class="mySlides">
                                    <div class="numbertext">4 / 4</div>
                                    <img src="<?php echo APP_ROOT.$testimonial['ut_user_testimonial4']; ?>" style="width:100%">
                                 </div>

                                 <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                 <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                 <div class="caption-container">
                                    <p id="caption"></p>
                                 </div>

                              </div>
                           </div>
                                 <?php 
                                     }
                                   }
                                 ?>
                              </ul>


                              
                                 <!-- luqman -->
                           </div>
                        </div>

                        <div id="tab-4" class="tab-pane">
                           <div class="panel-body">
                              <div class="form-group">
                                <label class="control-label col-sm-4">
                                Proof of Accepting Terms
                                </label>
                                <div class="col-sm-8">                                
                                  <input type="file" name="ud_proof_of_accepting_terms" id="ud_proof_of_accepting_terms" class="inputfile inputfile-6">                                  
                                </div>
                              </div>
                              <ul class="whatsapp">
                              <?php 
                              if (isset($userRow) && $userRow !== null) {
                                 if ($userRow['ud_proof_of_accepting_terms'] != '') {
                              ?>
                                 <li><img src="<?php echo APP_ROOT.$userRow['ud_proof_of_accepting_terms']; ?>" alt="whatsApp" data-action="zoom" class="cropped img-responsive"></li>
                              <?php 
                                 }
                              }
                              ?>
                              </ul>
                           </div>
                        </div>

<!-- luqman city -->
                        <div id="tab-5" class="tab-pane">
                           <div class="panel-body">
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Area you can cover: <br></label>
                                <div class="col-sm-10">
                                    <div class="row"><!-- row -->
                                        <?php 
                                       $areaCnt = $initLocation->GetAllCountry(150);
                                       if ($areaCnt->num_rows > 0) {
                                          $i = 0;
                                          while($country = $areaCnt->fetch_assoc()) {
                                             // Get State By Country Id
                                             $getCountryWiseStates = $initLocation->CountryWiseState($country['c_id']);
                                             if ($getCountryWiseStates->num_rows > 0) {
                                                $i = 0;//man tambah
                                             while ($state = $getCountryWiseStates->fetch_assoc()) {
                                                // GET User State
                                                $checked = $initLocation->UserWiseState($userRow['u_id'], $state['st_id'])->num_rows;

                                                // GET Other City of the state
                                                $OtherState = $initLocation->UserWiseOtherState($userRow['u_id'], $state['st_id']);
                                       ?>
                                       <div class="col-md-6"><!-- col-md-6 -->
                                          <div class="checkbox">
                                             <input type="checkbox" name="cover_area_state[]" id="ca_state_<?php echo $state['st_id']; ?>" value="<?php echo $state['st_id']; ?>" onchange="checkAll(this, '<?php echo 'cover_area_city_'.$state['st_id'];?>')" <?php echo ($checked > 0) ? 'checked' : '';?>>
                                             <label class="custom toggleShowHide"><?php echo $state['st_name']; ?></label>
                                                  <?php 
                                             // Get City By State Id
                                             $getStateWiseCity = $initLocation->StateWiseCity($state['st_id']);

                                             if ($getStateWiseCity->num_rows > 0) {
                                             ?>
                                             <div class="showHide" style="display:none;"<?php //echo $stl; ?>>
                                                <div class="dropbox">Please tick the area(s)</div>
                                                <div class="dropPop" <?php //echo $stl; ?>>
                                                   <div class="row">                                      
                                         <?php 
                                          $city_arr = $initLocation->UserWiseCity($userRow['u_id']);//bukan array
                                          // print_r($city_arr);die;
                                         while ($city = $getStateWiseCity->fetch_assoc()) {
                                             
                                                  
                                                       ?>
                                                      <div class="col-md-6">
                                                            <input type="checkbox" name="cover_area_city_<?php echo $state['st_id']; ?>[<?php echo $i; ?>]" id="cover_area_city_<?php echo $state['st_id'];?>_<?php echo $i; ?>" 
                                             value="<?php echo $city['city_id'];?>" data-pid="<?php echo $state['st_id'];?>" data-cname="cover_area_city_" data-oname="other_area_" 
                                             data-pname="ca_state_" onchange="check_parent( this)" <?php echo(in_array($city['city_id'],$city_arr))? 'checked="checked"' : '' ; ?>>
                                                         
                                                         <label for="cover_area_city_<?php echo $state['st_id'];?>_<?php echo $i; ?>" class="custom"><?php echo $city['city_name'];?></label>        
                                                      </div>

                                                      <?php   $i++; } ?>
                                                      <!-- SLOW ATAS -->
                                                   </div>
                                                </div>   
                                             </div>
                                             <?php } ?>

                                          </div><!-- checkbox -->
                                       </div><!-- col-md-6 -->
                                          <?php 
                                       }
                                    }
                                 } 
                              }
                              ?> 
                                    </div><!-- row -->
                                 </div>

                              </div>
                           </div>
                        </div>
<!-- luqman city -->
                        <div id="tab-6" class="tab-pane">
                           <div class="panel-body">
                              <div class="form-group" id="dob">
                                 <label class="col-sm-2 control-label">Subject you can teach:</label>
                                 <div class="col-sm-10">
                                    <div class="row">
                                       <?php 
                                       // Get Course
                                       $getCourse = $initApp->ListCourseNew();

                                       if ($getCourse->num_rows > 0) {
                                          $i = 0;
                                          while ( $course = $getCourse->fetch_assoc() ) {
                                             $checked = $initApp->UserWiseCourse($userRow['u_id'], $course['tc_id'])->num_rows;
                                             $OtherCourse = $initApp->UserWiseOtherCourse($userRow['u_id'], $course['tc_id']);
                                       ?>
                                       <div class="col-md-6">                    
                                          <div class="checkbox">                      
                                             <input type="checkbox" name="tutor_course[]" id="tu_course_<?php echo $course['tc_id']; ?>" value="<?php echo $course['tc_id']; ?>" onchange="checkAll(this, '<?php echo 'tutor_subject_'.$course['tc_id'];?>')" <?php echo ($checked > 0) ? 'checked' : '';?>>
                                             <label class="custom toggleShowHide"><?php echo $course['tc_title']; ?></label>
                                              <?php 
                                          $getSubject = $initApp->CourseWiseSubject($course['tc_id']);

                                          if ($getSubject->num_rows > 0) {
                                          ?>
                                          <div class="showHide" style="display:none;">
                                             <div class="dropbox">Please tick the subject(s)</div>
                                             <div class="dropPop">
                                                <div class="row">
                                                   <?php 

                                                   $subject_arr = $initApp->UserWiseSubject($userRow['u_id']);
                                                   while ($subject = $getSubject->fetch_assoc()) { 
                                                   ?>
                                                   <div class="col-md-12">
                                                      <input type="checkbox" name="tutor_subject_<?php echo $course['tc_id'];?>[<?php echo $i; ?>]" id="tutor_subject_<?php echo $course['tc_id'];?>_<?php echo $i; ?>" value="<?php echo $subject['ts_id'];?>" data-pid="<?php echo $course['tc_id'];?>" data-cname="tutor_subject_" data-oname="subject_" data-pname="tu_course_" onchange="check_parent( this)" <?php echo(in_array($subject['ts_id'],$subject_arr))? 'checked="checked"' : '' ; ?>>

                                                      <label for="tutor_subject_<?php echo $course['tc_id'];?>_<?php echo $i; ?>" class="custom"><?php echo $subject['ts_title'];?></label>
                                                   </div>
                                                   <?php   $i++; } ?>                                     
                                                </div>
                                             </div>
                                          </div>
                                          <?php } ?>
                                          </div>                                    
                                       </div>
                                       <?php 
                                         }
                                       }
                                       ?>
                                    </div>


									
									
                                 </div>
                              </div>
                           </div>
                        </div>

                        <?php } ?>
                     </div>
                     <div class="panel-body hidelater">
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                           <div class="col-sm-10 col-sm-offset-2">
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save" type="submit">Save</button>
                              <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" name="save_edit" type="submit">Save and Continue Edit</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div class="clearfix"></div>
</div>
<script>
function showBanned() {
	$("#showBanned").hide();
	$("#showBanned2").show();
	alert("Phone number is already used");
}


$("#myid li").click(function() {
    if(this.id == 'this7'){
      $('#tab-7').addClass('active');
      $(".hidelater").hide();
    }else{
      $(".hidelater").show();
    }
});


$(document).ready(function(){
$("#send_newsletter").click(function(){

    var sendemail_displayid = $('#sendemail_displayid').val();
    var sendemail_email = $('#sendemail_email').val();
    var sendemail_userdetail = $('#sendemail_userdetail').val();
    var sendemail_template = $('#sendemail_template').val();

    if (sendemail_email == '' && sendemail_displayid == '' ){
        alert('Empty Email');
    }else if(sendemail_userdetail == ''){
        alert('Please Select User Details');
    }else if(sendemail_template == ''){
        alert('Please Select Email Template');
    } else{
        $.post("send_email_newsletter.php",{ 
            sendemail_displayid:sendemail_displayid,
            sendemail_email:sendemail_email,
            sendemail_userdetail:sendemail_userdetail,
            sendemail_template:sendemail_template
        },
        function(response,status){ // Required Callback Function
            alert("Response : " + response + "\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
            location.reload();
        });
    }

});
});
</script>
