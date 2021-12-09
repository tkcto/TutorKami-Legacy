<?php
require_once('classes/user.class.php');
$instUser = new user;

if(!empty($_POST["u_type"])) {
	$resUser = $instUser->FetchUserByRole($_POST["u_type"],'A');
	
?>
	<option value="">Select User</option>
<?php

	while($arrUser = $resUser->fetch_assoc()) {
?>
    <option value="<?php echo $arrUser['u_id'];?>" <?php if(isset($_REQUEST['ph'])) echo $arrPay['ph_user_id']==$arrUser['u_id']?'selected':''?>><?php echo $arrUser['u_email'];?></option>
<?php
	}
}
?>