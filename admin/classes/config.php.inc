<?php

const DEVELOPMENT_HOST = array('tk.io');

# Database Credentials
if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1' || in_array($_SERVER['HTTP_HOST'], DEVELOPMENT_HOST)) {

    define('HOSTNAME', 'mysql');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DBNAME', 'tutorkami');

    # Data directory Root
    define('APP_ROOT', 'http://' . $_SERVER['SERVER_NAME'] . '/');
    define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

    # Facebook App Details
    define('FB_APP_ID', '183402138857627');
    define('FB_APP_SECRET', '6aad6a3a4eaaaa99a484341a8894041d');
    define('FB_REDIRECT_URI', APP_ROOT . 'social_login.php');

    # Mail gun
    define('MAILGUN_KEY', 'key-03de9383bdf046e8b1d1af9066911573');
    define('MAILGUN_DOMAIN', 'https://api.mailgun.net/v3/manfredinfotech.com');
} else {

    # DB Credencials
    define('HOSTNAME', 'localhost');
    define('DB_USER', 'tutorka1_live');
    define('DB_PASS', '_+11pj,oow.L');
    define('DBNAME', 'tutorka1_tutorkami_db');

    # Data directory Root
    define('APP_ROOT', 'https://' . $_SERVER['SERVER_NAME'] . '/');
    //define('APP_ROOT', 'http://'.$_SERVER['SERVER_NAME'].'/');
    define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');


    # Facebook App Details
    define('FB_APP_ID', '1323875851064715');
    define('FB_APP_SECRET', 'e75ac08c99169207f5ed2d93a0aebe2d');

    # Mailgun
    define('MAILGUN_KEY', 'key-03de9383bdf046e8b1d1af9066911573');
    define('MAILGUN_DOMAIN', 'https://api.mailgun.net/v3/manfredinfotech.com');
}

# Max number of failed password in loging
define('MAX_FAILED_PASSWD', '5');

# Session time out in sec
define('MAX_INACTIVE_TIME', '36000');
define('MAX_INACTIVE_TIME_SU', '36000');

# PREFIX
define('DB_PREFIX', 'tk');

# Date Variable
define('NULL_DATE', '0000-00-00 00:00:00');

# Theme
define('THEME', 'blue');
date_default_timezone_set("Asia/Kuala_Lumpur");