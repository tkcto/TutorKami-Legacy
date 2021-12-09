<?php
require_once('classes/config.php.inc');

require_once('classes/newsletter.class.php');
$instNews = new newsletter;

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if($_POST["sendemail_email"]){
    $sendemail_displayid = $_POST["sendemail_displayid"];
    $sendemail_email = $_POST["sendemail_email"];
    $sendemail_userdetail = $_POST["sendemail_userdetail"];
    $sendemail_template = $_POST["sendemail_template"];
    $emailDummy = 'fadhlisbmz@gmail.com';

    $queryUser = "SELECT * FROM tk_user WHERE u_email='$sendemail_userdetail'";
    $resultUser = $conn->query($queryUser);
    if ($resultUser->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();
            $queryID = 'tutor_id='.$rowUser['u_id'];
            $queryDisplayID = $rowUser['u_displayid'];
            $queryDisplayName = $rowUser['u_displayname'];
            //$queryPic = $rowUser['u_profile_pic'];
            $pix = sprintf("%'.07d", $rowUser['u_profile_pic']);

            if ($rowUser['u_profile_pic'] != '') {
                if ( is_numeric($rowUser['u_profile_pic']) ) {
                    $queryPic = 'https://www.tutorkami.com/images/profile/'.$pix.'_0.jpg';
                }else{
                    $queryPic = 'https://www.tutorkami.com/images/profile/'.$rowUser['u_profile_pic'].'.jpg';
                }
           } elseif ($rowUser['u_gender'] == 'M') {
                $queryPic = 'https://www.tutorkami.com/images/tutor_ma.png';
           } else {
                 $queryPic = 'https://www.tutorkami.com/images/tutor_mi1.png';
           } 


        
    }else {
        $queryID = '';
        $queryDisplayID = '';
        $queryDisplayName = '';
        $queryPic = '';
    }

    $queryParent = "SELECT * FROM tk_user WHERE u_email='$sendemail_email'";
    $resultParent = $conn->query($queryParent);
    if ($resultParent->num_rows > 0) {
        $rowParent = $resultParent->fetch_assoc();
        $queryParentID = 'parent_id='.$rowParent['u_id'];
    }else {
        $queryParentID = '';
    }
/*
    echo $queryID.'<br/>';
    echo $queryDisplayID.'<br/>';
    echo $queryDisplayName.'<br/>';
    echo $queryPic.'<br/>';
*/



    if (isset($_POST['sendemail_email']) && $_POST['sendemail_email'] != '') {
        $Sub     = array(
            $_POST['sendemail_email']
            //$emailDummy
        );
        $arrTemp = $instNews->GetNewsTemplateTranslation($_POST['sendemail_template']);
        
        //Search the string "Hello World!", find the value "world" and replace it with "Peter":
        //echo str_replace("world","Peter","Hello world!");

        $phrase  = $arrTemp['ntt_content_body'];
        $findValue = ["https://www.tutorkami.com/images/profile/20190827-122414-yusrikornan06@gmail.com.jpg", "Muhammad Yusri Kornan", "yks3pwc","tutor_id=167","parent_id=15"];
        $replaceValue   = [$queryPic, $queryDisplayName, $queryDisplayID,$queryID,$queryParentID];

        $newPhrase = str_replace($findValue, $replaceValue, $phrase);

        $subject = $arrTemp['ntt_subject'];
        //$message = $arrTemp['ntt_content_body'];
        //$message = str_replace("https://www.tutorkami.com/images/profile/20190827-122414-yusrikornan06@gmail.com.jpg","https://www.tutorkami.com/images/profile/0007478_0.jpg",$arrTemp['ntt_content_body']);;
        $message = $newPhrase;
        $m       = $instNews->sendNewsletterEmailTemplate('', $Sub, $subject, $message);
        
        
        if ($m) {
            echo 'Mail been sent successfully!';
        } else {
            echo 'Mail cannot be sent!';
        }
    } else {
        echo 'No recipient selected!';
    }




//echo " Email : " .$sendemail_email. " - sendemail_displayid : " .$sendemail_displayid . " - sendemail_template - " .$sendemail_template. " - sendemail_userdetail - " .$sendemail_userdetail; 

}
?>