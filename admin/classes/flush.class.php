<?php

/**
 * Session Management
 * @author : Subhadeep Chowdhury
 */
class Session
{

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }

    }

    public static function SetFlushMsg($type = '', $msg = '') {
        // $msgVal = ($type == 'success') ? 'alert-success' : 'alert-error';
        // $_SESSION['flash_msg']['msg_type'] = $msgVal;

        // luqman
        // $messagearray = array();
        $_SESSION['flash_msg']['msg_type'] = $type;//error & success
        $_SESSION['flash_msg']['msg_text'] = $msg; //Phone number has been used previously

        // $messagearray[] = array($message => $type, $message2 => $msg);
        // var_dump($messagearray);die;	
        // luqman
    }

    public static function ReadFlushMsg() {
        if (isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != '') {
            $message = $_SESSION['flash_msg'];
            unset($_SESSION['flash_msg']);
            return $message;
        }
        return null;
    }

}

