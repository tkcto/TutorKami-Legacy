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

if($_POST["id"]){
    $id = $_POST["id"];
    $email_parent = $_POST["email_parent"];
    $email_parent_dumy = $_POST["email_parent_dumy"];
    $email_tutor = $_POST["email_tutor"];
    $sendemail_template = '18';
    $value = $_POST["value"];
    $emailDummy = 'fadhlisbmz@gmail.com';
    
    $queryUser = "SELECT * FROM tk_user WHERE u_email='$email_tutor'";
    $resultUser = $conn->query($queryUser);
    if ($resultUser->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();
            $queryID = 'tutor_id='.$rowUser['u_id'];
            $queryDisplayID = $rowUser['u_displayid'];
            $queryDisplayName = $rowUser['u_displayname'];
            $pvName = str_replace(' ', '-', $rowUser['resit_pv_name']);
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
        $pvName = '';
        $queryPic = '';
    }

    //$queryParent = "SELECT * FROM tk_user WHERE u_email='$email_parent'";
	$queryParent = "SELECT * FROM tk_user WHERE u_email='$email_parent_dumy'";
    $resultParent = $conn->query($queryParent);
    if ($resultParent->num_rows > 0) {
        $rowParent = $resultParent->fetch_assoc();
        $queryParentID = 'parent_id='.$rowParent['u_id'];
    }else {
        $queryParentID = '';
    }


    if (isset($_POST['email_parent']) && $_POST['email_parent'] != '') {
        $Sub     = array(
            $_POST['email_parent']
            //$emailDummy
        );
        $arrTemp = $instNews->GetNewsTemplateTranslation($sendemail_template);

        if($value == 'bm'){
            $subject = 'Maklum balas untuk '.$queryDisplayName;
            $content = 'Apa pendapat anda tentang ';
            $description = 'Tuliskan pendapat atau komen anda tentang tutor ini, dan apa yang boleh diperbaiki. Komen anda akan dapat bantu meningkatkan kualiti tutor dan juga servis TutorKami.com ';
            $button = 'Beri pendapat anda';
            $footer  = 'bm';
            $buttonname = 'BM';
            //$url = 'https://www.tutorkami.com/my/parent_review.php';
            $url = 'https://www.tutorkami.com/my/client_review?/'.$id.'/'.$pvName;
            $JobID = 'job_id='.$id;
        }else{
            $subject = 'Provide your feedback on  '.$queryDisplayName.'`s service';
            $content = 'What is your feedback for ';
            $description = 'Please give a rating and your comment about this tutor. Your feedback will help us to improve in the future ';
            $button = 'Rate the tutor now';
            $footer = 'bi';
            $buttonname = 'EN';
            //$url = 'https://www.tutorkami.com/parent_review.php';
            $url = 'https://www.tutorkami.com/client_review?/'.$id.'/'.$pvName;
            $JobID = 'job_id='.$id;
        }

        $phrase  = $arrTemp['ntt_content_body'];
        //$findValue = ["https://www.tutorkami.com/images/profile/20190827-122414-yusrikornan06@gmail.com.jpg", "How your feel for", "Muhammad Yusri Kornan", "yks3pwc","tutor_id=167","parent_id=15","job_id=15","The test description","Rate the tutor now","https://www.tutorkami.com/parent_review.php"];
        //$replaceValue   = [$queryPic, $content, $queryDisplayName, $queryDisplayID, $queryID, $queryParentID, $JobID, $description, $button, $url];
        
        $findValue = ["https://www.tutorkami.com/images/profile/20190827-122414-yusrikornan06@gmail.com.jpg", "How your feel for", "Muhammad Yusri Kornan", "yks3pwc","The test description","Rate the tutor now","https://www.tutorkami.com/parent_review.php?step=1&amp;tutor_id=167&amp;parent_id=15&amp;job_id=15"];
        $replaceValue   = [$queryPic, $content, $queryDisplayName, $queryDisplayID, $description, $button, $url];
        
        $newPhrase = str_replace($findValue, $replaceValue, $phrase);

        //$subject = $arrTemp['ntt_subject'];
        $message = $newPhrase;
        $m       = $instNews->sendNewsletterEmailTemplate('', $Sub, $subject, $message, $footer);
        
        
        if ($m) {
            //$queryUpdateJob = "UPDATE tk_job SET send_rate='send' WHERE j_id='$id'";
            $queryUpdateJob = "UPDATE tk_job SET send_rate='$buttonname' WHERE j_id='$id'";
            $resultUpdateJob = $conn->query($queryUpdateJob);
            echo 'Mail been sent successfully!';
        } else {
            echo 'Mail cannot be sent!';
        }
    } else {
        echo 'No recipient selected!';
    }
 
   
   
   
}
?>