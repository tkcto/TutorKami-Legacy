<?php
// https://share-system.com/membuat-form-html-posting-ke-telegram/

//File Name telegram_post.php

/*$email = $_POST['email'];
$pesan = $_POST['pesan'];
$date = date('d F Y').'%0A';
*/



//$message = $date.'Bro ada pesan ni di share-system.com dari '.$email.' : %0A'.$pesan.'';

$message = 'Dari tutorkami.com123';

$api = 'https://api.telegram.org/bot949461220:AAG6FTbPq2q7RG8a841Eo7G3saEDsvDtfoQ/sendMessage?chat_id=-402175084&text='.$message.'';


$ch = curl_init($api);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

//var_dump($api);
?>