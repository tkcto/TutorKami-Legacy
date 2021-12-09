<?php 
SESSION_START();
include('header.php');
?>
<title</title>
<script src="notification.js"></script>
<?php //include('container.php');?>
<div class="container">		
	<h2></h2>	
	<h3>User Account </h3>
	
<?php                        
    date_default_timezone_set("Asia/Kuala_Lumpur");
     $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($key['notif_repeat']*60));
     echo $nextime.'<br/>';
     echo $_SESSION['username'].'<br/>';
?>
	
	
	<?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin') { ?>
		<a href="manage_notification.php">Manage Notification</a> | 
	<?php } ?>
	<?php if(isset($_SESSION['username']) && $_SESSION['username']) { ?>
		<a href="logout.php">Logout</a>
	<?php } else { ?>
		<a href="login.php">Login</a>
	<?php } ?>
	<hr> 
	<?php if (isset($_SESSION['username'])) { ?>
		<h4>Welcome back <strong><?php echo $_SESSION['username']; ?></strong></h4>	
	<?php } ?>	
	

</div>	
<?php include('footer.php');?>






