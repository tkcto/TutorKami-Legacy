<?PHP
require 'db_connection.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

if ( !empty($_POST["phone"]) && !empty($_POST["email"]) && !empty($_POST["image"]) ) {
   //$phone = '0319871239';
   $phone = mysqli_real_escape_string($db_connection, $_POST["phone"]);
   $email = mysqli_real_escape_string($db_connection, $_POST["email"]);
   $image = mysqli_real_escape_string($db_connection, $_POST["image"]);
   
   //echo $phone.' '.$email.' '.$image;
   $get_user = mysqli_query($db_connection, "SELECT * FROM tk_user_details WHERE ud_phone_number='$phone'");
   if(mysqli_num_rows($get_user) > 0){
       $resultParent = mysqli_fetch_assoc($get_user);
       
       $updateUser = mysqli_query($db_connection, " UPDATE tk_user SET u_email = '".$email."' WHERE u_id='".$resultParent['ud_u_id']."' ");
       if($updateUser){
           $updateUserDetails = mysqli_query($db_connection, " UPDATE tk_user_details SET ud_last_name = '".$email."' WHERE ud_u_id='".$resultParent['ud_u_id']."' ");
           if($updateUserDetails){
               




                    $getParent = mysqli_query($db_connection, " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_role='4' AND u_email = '$email' ");
                    if(mysqli_num_rows($getParent) > 0){
                        $resultCheckParent = mysqli_fetch_assoc($getParent);
                        
                        if($resultCheckParent['u_status'] == 'A'){
        
                              $updateLastActivity = mysqli_query($db_connection, " UPDATE tk_user SET u_modified_date = '".date('Y-m-d H:i:s')."' WHERE u_id='".$resultCheckParent['u_id']."' ");
                              if($updateLastActivity){
                                  $_SESSION['auth'] = array(
                            
            	                    'user_id'       => $resultCheckParent['u_id'],
            	                    'user_name'     => $resultCheckParent['u_username'],
            	                    'first_name'    => $resultCheckParent['ud_first_name'],
            	                    'last_name'     => $resultCheckParent['ud_last_name'],
            	                    'display_name'  => $resultCheckParent['u_displayname'],
            	                    'user_email'    => $resultCheckParent['u_email'],
            	                    'user_role'     => $resultCheckParent['u_role'],
            	                    'user_gender'   => $resultCheckParent['u_gender'],
            	                    'user_pic'      => $resultCheckParent['u_profile_pic']
                            
                                  );
                                  
                                  $_SESSION['login_id'] = $id; 
                                  echo "Success";
                                  exit(); 
                              }else{
                                  echo "Sign up failed!(Something went wrong).";
                                  exit;
                              }   
                              
                        }else if($resultCheckParent['u_status'] == 'B'){
                            echo "Your Account Has Been Banned !";
                            exit;
                        }else{
                            echo "Your Account is not activated yet.";
                            exit;
                        }
                    }else{
                        echo "Empty User.";
                        exit;
                    }














               
           }else{
                echo 'Error. Something Went Wrong Please Try Again ! [code 5545]';
           }
       }else{
           echo 'Error. Something Went Wrong Please Try Again !';
       }
       
       
       
       
   }else{
       echo 'Sorry, Phone Number Not Available';
   }
   
   
} else {
    echo 'Error !';

}




//echo json_encode(['code'=>404, 'msg'=>$errorMSG]);


?>