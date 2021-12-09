<?php
require_once('includes/head.php');

require_once('classes/newsletter.class.php');
$instNews = new newsletter;

if (isset($_POST) && isset($_POST['nwt-send'])) {
    
    if (isset($_POST['u_email']) && $_POST['u_email'] != '') {
        $Sub     = array(
            $_POST['u_email']
        );
        $arrTemp = $instNews->GetNewsTemplateTranslation($_POST['ntt_id']);
        
        $subject = $arrTemp['ntt_subject'];
        $message = $arrTemp['ntt_content_body'];
        $m       = $instNews->sendNewsletterEmailTemplate('', $Sub, $subject, $message);
        
        
        if ($m) {
            Session::SetFlushMsg("success", 'Mail been sent successfully!');
        } else {
            Session::SetFlushMsg("error", 'Mail cannot be sent!');
        }
    } else {
        Session::SetFlushMsg("error", 'No recipient selected!');
    }
    
}

header('Location: newsletter-subscription-list.php');
exit();