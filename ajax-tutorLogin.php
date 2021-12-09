<?php
/*
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if( !empty($_POST["tutorID"]) && !empty($_POST["parentID"]) ){

    $rr_create_date 	= date('Y-m-d h:i:s');

    $updateRate = "INSERT INTO tk_review_rating SET 
        rr_tutor_id 		= '".$_POST["tutorID"]."',
        rr_parent_id 		= '".$_POST["parentID"]."',
        rr_rating 			= '".$_POST["rating"]."',
        rr_review 			= '".$_POST["review"]."',
        rr_about_tutor 		= '".$_POST["share_about_tutor"]."',
        rr_tutor_improve 	= '".$_POST["tutor_improve"]."',
        rr_create_date  	= '".$rr_create_date."'";

	if ($conn->query($updateRate) === TRUE) {
	    echo 'success';
	}else{
	    echo 'x success';
	}

}else{
    echo 'error';
}
$conn->close();
*/

/*

	$database_username = 'live_tutorkami';
	$database_password = 'Tutor@kami';
	$pdo_conn = new PDO( 'mysql:host=localhost;dbname=tutorkami_db', $database_username, $database_password );
	*/
	
	
$server = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";
    
$connection = mysqli_connect($server, $username, $password, $dbname);
    
if(!$connection){
    die("Awaiting Resources");
    exti();
}

session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");


function inject_checker ($connection, $field){
    return (htmlentities(trim(mysqli_real_escape_string($connection, $field))));
}


	        $sql = "SELECT * FROM ".DB_PREFIX."_user AS U 
	        INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id 
	        WHERE 
		        u_status <> 'D' AND u_role = '3' AND (
		            u_email = '{$email}' || 
		            u_username = '{$email}'
		        )";
		        
		        

if( isset($_POST['email']) && isset($_POST['password'])   ){
    $login_username = inject_checker($connection, $_POST['email']);
    $login_password = inject_checker($connection, $_POST['password']);
        
    if(empty($login_username)){
        echo "Username Field Can not be empty";
    }elseif(empty($login_password)){
        echo "Password Field Can not be empty";
    }else{
        $query = " SELECT * FROM tk_user
        INNER JOIN tk_user_details ON ud_u_id = u_id 
	        WHERE 
		        u_status <> 'D' AND u_role = '3' AND (
		            u_email = '{$login_username}' || 
		            u_username = '{$login_username}'
		        )
        ";
        $run_query = mysqli_query($connection, $query);
                    
        if(mysqli_num_rows($run_query) == 1){

                            
            while($result = mysqli_fetch_assoc($run_query)){

            
	            if ($result['u_password'] != md5($login_password)) {
	            	echo "Wrong password";
	            } elseif ( $result['u_status'] == 'P' && ($result['u_admin_approve'] == NULL || $result['u_admin_approve'] == '0' || $result['u_admin_approve'] == '') ) {
	            	echo "TutorKami Will Review To Activated Your Account";
	            } elseif ( ($result['u_status'] == 'P' || $result['u_status'] == 'A') && $result['u_admin_approve'] == '1' ) {
	            	echo "Please Check Your Email To Activate";
	            }else if($result['u_status'] == 'B'){
	            	echo "Your Account Has Been Banned !";
				}else {
					
					$updateLastActivity = "UPDATE tk_user SET u_modified_date = '".date('Y-m-d H:i:s')."' WHERE u_id='".$result['u_id']."'";
					$run_updateLastActivity = mysqli_query($connection, $updateLastActivity);
					
					$_SESSION["firstlogin"] = "1";
	                $_SESSION['auth'] = array(
	                    'user_id'       => $result['u_id'],
	                    'user_name'     => $result['u_username'],
	                    'first_name'    => $result['ud_first_name'],
	                    'last_name'     => $result['ud_last_name'],
	                    'display_name'  => $result['u_displayname'],
	                    'user_email'    => $result['u_email'],
	                    'user_role'     => $result['u_role'],
	                    'user_gender'   => $result['u_gender'],
	                    'user_displayid'   => $result['u_displayid'],
	                    'user_pic'      => $result['u_profile_pic']
	                );

                   if(!empty($_POST["remember"])) {
                       if($_POST["remember"] =='On' ){
                          setcookie ("member_login",$login_username,time()+ (10 * 365 * 24 * 60 * 60));
                          setcookie ("member_password",$login_password,time()+ (10 * 365 * 24 * 60 * 60));
                       }
                   }
   
	                echo "Success";
	                
	                
	            }
            
            
            
            
            
            
                                
            }
        }else{
            echo "Email doesnot exists in our record";
        }
    }
}else{
    echo "Login Failed";
}






















?>