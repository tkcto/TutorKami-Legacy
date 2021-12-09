
<div class="media-left">
  	<a href="tutor_profile.php?uid=<?php echo $_SESSION['rating']['tutor_id']; ?>">
  		<img class="media-object profile img-responsive" src="<?php 
                /*if (isset( $getUserDetails->data[0]->u_profile_pic )) {
                  	if ($getUserDetails->data[0]->u_profile_pic != '') {
                    	echo APP_ROOT.$getUserDetails->data[0]->u_profile_pic;
                  	} elseif ($getUserDetails->data[0]->u_gender == 'M') {
                    	echo APP_ROOT."images/tutor_ma.png";
                  	} else {
                    	echo APP_ROOT."images/tutor_mi1.png";
                  	}                  
                }*/
                
                $pix = sprintf("%'.07d\n", $getUserDetails->data[0]->u_profile_pic);
           if ($getUserDetails->data[0]->u_profile_pic != '') {
                if ( is_numeric($getUserDetails->data[0]->u_profile_pic) ) {
                    echo APP_ROOT."images/profile/".$pix."_0.jpg";
                }else{
                    echo APP_ROOT."images/profile/".$getUserDetails->data[0]->u_profile_pic.".jpg";
                }
           } elseif ($getUserDetails->data[0]->u_gender == 'M') {
                echo APP_ROOT."images/tutor_ma.png";
           } else {
                 echo APP_ROOT."images/tutor_mi1.png";
           } 
                
                
                ?>" alt="<?php echo $getUserDetails->data[0]->ud_first_name; ?> <?php echo $getUserDetails->data[0]->ud_last_name; ?>">
  	</a>
  	<h5 class="org-txt"><?php echo $getUserDetails->data[0]->ud_first_name; ?> <?php echo $getUserDetails->data[0]->ud_last_name; ?> ( <?php echo ID_NO; ?> : <?php echo $getUserDetails->data[0]->u_displayid; ?>)</h5>
</div>