<?PHP			
if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="img/little-logo.png" />
                </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"></span> <span class="block m-t-xs"> <strong class="font-bold">Tutorkami</strong>
                    </span> <span class="text-muted text-xs block">Better Tutors, Better Results</span>
                    </a>
                        </div>
                        <div class="logo-element">
                            <img src="img/little-logo.png" alt="little-logo">
                        </div>
                    </li>
                    
                    <li><a href="specific.php"><span>Specific</span></a></li>
                    <li><a href="view-specific.php"><span>View Specific</span></a></li>
                    
                    
                    
                    <li><a href="logout.php"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>
        </ul>
</div>
</nav>
<?PHP
}else{
?>  
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="img/little-logo.png" />
                </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"></span> <span class="block m-t-xs"> <strong class="font-bold">Tutorkami</strong>
                    </span> <span class="text-muted text-xs block">Better Tutors, Better Results</span>
                    </a>
                        </div>
                        <div class="logo-element">
                            <img src="img/little-logo.png" alt="little-logo">
                        </div>
                    </li>
                    <?php
                     $resMainMenu = $instSys->FetchMenuByRole($_SESSION[DB_PREFIX]['r_id'], 0);
                    ?>
                    <?php
                    while($arrMainMenu = $resMainMenu->fetch_assoc()) {
                        if($arrMainMenu['m_status']<>'A') { continue; }
                        if($arrMainMenu['m_display']<>'Y') { continue; }
                        if($arrMainMenu['mp_view']<>1) { continue; }
                        if($arrMainMenu['m_submenu']==1) { $mainMenu['m_url'] = "javascript:void(0);"; }
                        if($arrMainMenu['m_icon']=='') {
                            $arrMainMenu['m_icon'] = 'icomoon-icon-play';
                        }
                        $mpage = substr(trim(basename($arrMainMenu['m_url'])),0,-4);
                        
                        
                       // echo $arrMainMenu['m_name'];
$active1 = basename(trim($_SERVER["REQUEST_URI"],"/")).'.html';
$active2 = $arrMainMenu['m_url'];
//echo $active1; //classes-list.html
//echo $arrMainMenu['m_parent_id'];
/*
$dbConActive = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConActive->connect_error) {
    die("Connection failed: " . $dbConActive->connect_error);
} */
$dataActive = "SELECT * FROM tk_menu WHERE m_url='$active1' ";
$resultActive = $conDB->query($dataActive);
if ($resultActive->num_rows > 0) {
    $rowActive = $resultActive->fetch_assoc();
    $thisActive = $rowActive['m_parent_id'];   
}else{
    $thisActive = '';
}
//echo $thisActive; 50
//echo $arrMainMenu['m_name']; Classes Management
$dataActive2 = "SELECT * FROM tk_menu WHERE m_name='$arrMainMenu[m_name]' ";
$resultActive2 = $conDB->query($dataActive2);
if ($resultActive2->num_rows > 0) {
    $rowActive2 = $resultActive2->fetch_assoc();
    $thisActive2 = $rowActive2['m_id'];   
}else{
    $thisActive2 = '';
}
//echo $thisActive;
$dataActive3 = "SELECT * FROM tk_menu WHERE m_id='$thisActive' ";
$resultActive3 = $conDB->query($dataActive3);
if ($resultActive3->num_rows > 0) {
    $rowActive3 = $resultActive3->fetch_assoc();
    $thisActive3 = $rowActive3['m_name'];   
}else{
    $thisActive3 = '';
}

//echo $thisActive3;
                        ?>
                        <li class="<?PHP 
                        if($active1 == $active2){echo 'active';}
                        else if($thisActive == $thisActive2){
                            echo 'active';
                        }
                        else if($arrMainMenu['m_name'] == $thisActive3){
                            echo 'active';
                        }
                        
                        ?>" >
                          <!--<a href="<?php if($arrMainMenu['m_submenu']==1) echo '#'; else echo $mpage.'php';?>"><span class="icon16 <?= $arrMainMenu['m_icon']?>"></span> <?=$arrMainMenu['m_name']?></a>-->
                          <a href="<?php if($arrMainMenu['m_submenu']==1) echo '#'; else echo $mpage.'php';?>"><?=$arrMainMenu['m_name']?> 
                          <?php
                          if($arrMainMenu['m_submenu']==1) {
if( $arrMainMenu['m_name'] == 'Content Management' ){

	$directory = "../video/";
	$filecount = 0;
	$files = glob($directory . "*");
	if ($files){
	 $filecount = (count($files)-1);
	}
	if( $filecount >= 1){
		echo ' <span class="badge badge-danger"> '.$filecount.'</span>';
	}

}
/*
if( $arrMainMenu['m_name'] == 'Classes Management' ){
    $queryNotDone = " SELECT cr_parent_verification FROM tk_classes_record WHERE cr_parent_verification = 'notdone' ";
    $resultNotDone = $conDB->query($queryNotDone); 
    $num_rows = $resultNotDone->num_rows;
    if($num_rows > 0){
        echo ' <span class="badge badge-danger"> '.$num_rows.'</span>';
    }
}
*/
                              ?>
                              <span class="fa arrow"></span>
                              <?PHP
                          }
                          ?>
                          </a>
                          <?php
                          if($arrMainMenu['m_submenu']==1) {
                              $resSubMenu = $instSys->FetchMenuByRole($_SESSION[DB_PREFIX]['r_id'], $arrMainMenu['m_id']);
                              ?>
                              <ul class="nav nav-second-level collapse" style="margin-left:20px;">
                                <?php
                                while($arrSubMenu = $resSubMenu->fetch_assoc()) {
                                    if($arrSubMenu['m_status']<>'A') { continue; }
                                    if($arrSubMenu['m_display']<>'Y') { continue; }
                                    if($arrSubMenu['mp_view']<>1) { continue; }
                                    if($arrSubMenu['m_submenu']==1) { $mainMenu['m_url'] = "javascript:void(0);"; }
                                    if($arrSubMenu['m_icon']=='') {
                                        $arrSubMenu['m_icon'] = 'icomoon-icon-play';
                                    }
                                    $subpage = substr(trim(basename($arrSubMenu['m_url'])),0,-4);

$active3 = basename(trim($_SERVER["REQUEST_URI"],"/")).'.html';
$active4 = $arrSubMenu['m_parent_id'];


$dataActive = "SELECT * FROM tk_menu WHERE m_url='$active3' ";
$resultActive = $conDB->query($dataActive);
if ($resultActive->num_rows > 0) {
    $rowActive = $resultActive->fetch_assoc();
    $thisActive = $rowActive['m_name'];   
}else{
    $thisActive = '';
}
	
//$dbConActive->close();

//echo  $arrSubMenu['m_name'] ;
                                    ?>
                                    <!--<li><a href="<?=$subpage?>php"><span class="icon16 <?=$arrSubMenu['m_icon']?>"></span> <?=$arrSubMenu['m_name']?></a></li>-->
									

                                    <li class="<?PHP if($thisActive == $arrSubMenu['m_name']){echo 'active';} ?>" >
									<?PHP
									if( $arrSubMenu['m_name'] == 'Video Profile' ){
										?><a href="<?=$subpage?>php"><?=$arrSubMenu['m_name']?></a><?PHP
										
									}else if( $arrSubMenu['m_name'] == 'Pay Tutors' ){
										?><a href="<?=$subpage?>php"><?=$arrSubMenu['m_name']?>
                                        <?PHP
                                        $queryPayTutor = " SELECT cl_id, cr_cl_id, cr_status FROM tk_classes INNER JOIN tk_classes_record ON cr_cl_id = cl_id WHERE cr_status LIKE '%FM to pay tutor%' ";
                                        $resultPayTutor = $conDB->query($queryPayTutor); 
                                        $num_rowsPay = $resultPayTutor->num_rows;
                                        if($num_rowsPay > 0){
                                            echo ' <span class="badge badge-danger"> '.$num_rowsPay.'</span>';
                                        }
                                        ?>
										</a><?PHP
									}else if( $arrSubMenu['m_name'] == 'Bill Parents' ){
										?><a href="<?=$subpage?>php"><?=$arrSubMenu['m_name']?>
                                        <?PHP
                                        $queryBill = " SELECT cl_id, cr_cl_id, cr_status, cl_display_id, j_id, j_deadline, invoice FROM tk_classes INNER JOIN tk_classes_record ON cr_cl_id = cl_id 
                                        INNER JOIN tk_job ON j_id = cl_display_id
                                        WHERE cr_status LIKE '%Required Parent To Pay%' AND (j_deadline IS NOT NULL AND j_deadline != '0000-00-00') AND invoice = '' ";
                                        $resultBill = $conDB->query($queryBill); 
                                        $num_rowsBill = $resultBill->num_rows;
                                        if($num_rowsBill > 0){
                                            echo ' <span class="badge badge-danger"> '.$num_rowsBill.'</span>';
                                        }
                                        ?>
										</a><?PHP
									}else if( $arrSubMenu['m_name'] == 'Record Incorrect' ){
										?><a href="<?=$subpage?>php"><?=$arrSubMenu['m_name']?>
                                        <?PHP
                                        $queryIncorrect = " SELECT cl_id, cr_cl_id, cr_parent_verification FROM tk_classes INNER JOIN tk_classes_record ON cr_cl_id = cl_id WHERE cr_parent_verification = 'notdone' ";
                                        $resultIncorrect = $conDB->query($queryIncorrect); 
                                        $num_rowsIncorrect = $resultIncorrect->num_rows;
                                        if($num_rowsIncorrect > 0){
                                            echo ' <span class="badge badge-danger"> '.$num_rowsIncorrect.'</span>';
                                        }
                                        ?>
										</a><?PHP
									}else if( $arrSubMenu['m_name'] == 'WA Record Not Sent' ){
										?><a href="<?=$subpage?>php"><?=$arrSubMenu['m_name']?>
                                        <?PHP
                                        $queryWA = " SELECT wa_remark, wa_status, wa_manual FROM tk_whatsapp_noti WHERE wa_remark = 'Record Function' AND wa_status != 'POST' AND wa_manual = ''  ";
                                        $resultWA = $conDB->query($queryWA); 
                                        $num_rowsWA = $resultWA->num_rows;
                                        if($num_rowsWA > 0){
                                            echo ' <span class="badge badge-danger"> '.$num_rowsWA.'</span>';
                                        }
                                        ?>
										</a><?PHP
									}else if( $arrSubMenu['m_name'] == 'Pending' ){
										?><a href="<?=$subpage?>php"><?=$arrSubMenu['m_name']?>
                                        <?PHP
                                        $queryPending = " SELECT rr_status FROM tk_review_rating WHERE rr_status = 'not approved' ";
                                        $resultPending = $conDB->query($queryPending); 
                                        $num_rowsPending = $resultPending->num_rows;
                                        if($num_rowsPending > 0){
                                            echo ' <span class="badge badge-danger"> '.$num_rowsPending.'</span>';
                                        }
                                        ?>
										</a><?PHP
									}
									
									
									else{
										?><a href="<?=$subpage?>php"><?=$arrSubMenu['m_name']?></a><?PHP
									}
									?>
									</li>
									
									
									<?PHP
									//if($arrSubMenu['m_name'] == 'Approved'){
										?>
							<!--<li>
								<a href="#">Tutor’s Terms</a>
								<ul class="nav nav-third-level collapse" style="margin-left:-20px;">
									<li><a href="terms-condition.php">General Terms</a></li>
									<li><a href="tutors-terms.php">Terms for Accepting Home Tuition Jobs</a></li>
								</ul>
							</li>		-->								
										
										<?PHP
									//}
									?>
									

			
                                    <?php
									
                                }
                                ?>
                            </ul>
                            <?php 
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>

				
                    <li class="<?PHP 
                    if($active1 == 'terms-condition.html'){echo 'active';} 
                    else if($active1 == 'tutors-terms.html'){
                        echo 'active';
                    }
                    //else if($active1 == 'clients-terms.html'){
                    else if($active1 == 'parents-terms.html'){
                        echo 'active';
                    }
                    /*else if($active1 == 'terms-group-tuition.html'){
                        echo 'active';
                    }*/
                    
                    ?>" >
						<a href="#"> <!--<i class="fas fa-handshake"></i>-->Terms & Condition <span class="fa arrow"></span> </a>
						<ul class="nav nav-second-level collapse">
						
							<li class="<?PHP 
                    if($active1 == 'terms-condition.html'){echo 'active';} 
                    else if($active1 == 'tutors-terms.html'){
                        echo 'active';
                    }
                    ?>" >
								<a href="#" style="margin-left:10px;" >Tutor’s Terms <span class="fa arrow"></span></a>
								<ul class="nav nav-third-level collapse" style="margin-left:-20px;">
									<li class="<?PHP if($active1 == 'terms-condition.html'){echo 'active';}?>" ><a href="terms-condition.php">General Terms</a></li>
									<li class="<?PHP if($active1 == 'tutors-terms.html'){echo 'active';}?>" ><a href="tutors-terms.php">Terms for Accepting Home Tuition Jobs</a></li>
								</ul>
							</li>
							<li class="<?PHP 
                    if($active1 == 'parents-terms.html'){echo 'active';} 
                    else if($active1 == 'tuition-center.html'){
                        echo 'active';
                    }
                    ?>" >
								<a href="#" style="margin-left:10px;" >Client’s Terms <span class="fa arrow"></span></a>
								<ul class="nav nav-third-level collapse" style="margin-left:-20px;">
									<li class="<?PHP if($active1 == 'parents-terms.html'){echo 'active';}?>" ><a href="parents-terms.php">Parent’s Terms</a></li>
									<li class="<?PHP if($active1 == 'tuition-center.html'){echo 'active';}?>" ><a href="tuition-center.php">Tuition Center</a></li>
								</ul>
							</li>
							<!--<li class="<?PHP //if($active1 == 'parents-terms.html'){echo 'active';} ?>" >
							    <a href="parents-terms.php">Client’s Terms</a>
							</li>-->
							
							
						</ul>
                    </li>

                    <!--<li class="<?PHP if($active1 == 'generate-receipt.html'){echo 'active';} ?>" >
						<a href="generate-receipt.php">Generate Receipt & Report</a>
                    </li>-->
					
                    <li><a href="logout.php"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>

<?PHP			
if($_SESSION[DB_PREFIX]['u_first_name'] == 'Mohd Nurfadhli'){
?>
                    <li>
						<a href="fadhli-test.php">fadhli</a>
						<a href="fadhli-test2.php">fadhli2</a>
                    </li>




<!--

                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="#" id="damian">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>

                                </ul>
                            </li>
                            <li><a href="#">Second Level Item</a></li>
                            <li>
                                <a href="#">Second Level Item</a></li>
                            <li>
                                <a href="#">Second Level Item</a></li>
                        </ul>
                    </li>
-->


                    
<?PHP	
//$dbConActive->close();
}
?>
                    
                    
                </ul>

            </div>
        </nav>

<?PHP
}
?>






<script>

</script>