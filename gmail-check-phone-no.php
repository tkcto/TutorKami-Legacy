<?PHP
require 'fadhli/google/login-with-gmail/db_connection.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

if ( !empty($_POST["phone"]) && !empty($_POST["email"]) && !empty($_POST["image"]) ) {
   //$phone = '0319871239';
   $phone = mysqli_real_escape_string($db_connection, $_POST["phone"]);
   $email = mysqli_real_escape_string($db_connection, $_POST["email"]);
   $image = mysqli_real_escape_string($db_connection, $_POST["image"]);
   

   //echo '3= '.$phone.' '.$email.' '.$image;
   //$get_user = mysqli_query($db_connection, " SELECT * FROM tk_user_details WHERE ud_phone_number = '".$phone."' ");
   $get_user = mysqli_query($db_connection, " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_role = '4' AND ud_phone_number = '".$phone."' ");
   if(mysqli_num_rows($get_user) > 0){
       $resultParent = mysqli_fetch_assoc($get_user); 
       
       $cekEmail = mysqli_query($db_connection, " SELECT * FROM tk_user_details WHERE ud_last_name = '' AND ud_u_id = '".$resultParent['ud_u_id']."' ");
       if(mysqli_num_rows($cekEmail) > 0){
           $resultCekEmail = mysqli_fetch_assoc($cekEmail);
            
           $existUser = mysqli_query($db_connection, " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_role = '4' AND ( u_email = '".$email."' || u_username = '".$email."' || ud_last_name = '".$email."' ) ");
           if(mysqli_num_rows($existUser) > 0){
                echo 'Existing Clients';
                exit;
           }else{

                   $updateUserDetails = mysqli_query($db_connection, " UPDATE tk_user_details SET ud_last_name = '".$email."' WHERE ud_u_id = '".$resultParent['ud_u_id']."' ");
                   if($updateUserDetails){
                       
        				$getJob = mysqli_query($db_connection, " SELECT * FROM tk_job WHERE u_id = '".$resultParent['ud_u_id']."' ");
        				if(mysqli_num_rows($getJob) > 0){
        					while($resultgetJob = mysqli_fetch_assoc($getJob)){
        						$updateEmailJob = mysqli_query($db_connection, " UPDATE tk_job SET actual_email = '".$email."' WHERE j_id = '".$resultgetJob['j_id']."' ");
        					}
        				}
      
        					$getParent = mysqli_query($db_connection, " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_role = '4' AND ud_last_name = '".$email."' ");
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
                                          
                                          if ( isset($_SESSION['url']) && (isset($_SESSION['url']) != '') ) {
                                    			$_SESSION['login_id'] = $id; 
                                    			//header('Location: '.$_SESSION['url']);
                                    			$goTo = $_SESSION['url'];
                                    			echo "Success - ".$goTo;
                                    			exit();
                                          }else{
                                              $_SESSION['login_id'] = $id; 
                                              echo "Success";
                                              if( $resultCheckParent['ud_client_status_2'] == 'Tuition Centre' ){
                                                  if( $resultCheckParent['signature_img3'] == '' ){
                                                      //header("Location: https://www.tutorkami.com/tuition-center-terms");
                                                      $goTo = 'https://www.tutorkami.com/tuition-center-terms';
                                                      echo "Success - ".$goTo;
                                                  }else{
                                                      //header("Location: https://www.tutorkami.com");
                                                      $goTo = 'https://www.tutorkami.com';
                                                      echo "Success - ".$goTo;
                                                  }
                                              }else{
                                                  if( $resultCheckParent['signature_img'] == '' ){
                                                      //header("Location: https://www.tutorkami.com/clients-terms");
                                                      $goTo = 'https://www.tutorkami.com/clients-terms';
                                                      echo "Success - ".$goTo;
                                                  }else{
                                                      //header("Location: https://www.tutorkami.com");
                                                      $goTo = 'https://www.tutorkami.com';
                                                      echo "Success - ".$goTo;
                                                  }
                                              }
                                              exit(); 
                                          }

                                           
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
           }
           

                 
       }else{
           echo 'Sorry, you don’t have permission to access';
       }

   }else{
       //echo 'Sorry, you don’t have permission to login. Please contact our Admin';
       echo 'Sorry, you have entered a wrong phone number';
   }

   
} else {
    echo 'Error !';

}




//echo json_encode(['code'=>404, 'msg'=>$errorMSG]);


?>