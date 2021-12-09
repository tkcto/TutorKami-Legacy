<?php 
require_once '../../api/phpmailer/class.phpmailer.php'; 

$mail = new PHPMailer(true);  


$message = "
    Salam/Hi ".$welcome.",<br><br>
                                    
    Thank you for using our service.<br>
    Attached is the invoice for cycle number #".$thisCycle2." for Class ID ".$jobID.".<br>
    Amount is RM ".$total.".<br><br>
    
    Please make the payment to our Maybank account 569954063020 (TK Edu Sdn Bhd)
    or you can also pay via DuitNow. Just login to your bank or e-wallet mobile app, scan the
    QR code below, enter the amount and pay<br><br>
                                    
    <img src='https://www.tutorkami.com/images/qrcode.PNG' style='max-width: 250px' /><br><br>
                                    
                    
    You can also view the invoice online at your TutorKami profile here
    www.tutorkami.com/client_login<br><br>
                    
    Thank you,<br>Admin TutorKami
";

$mail->IsSMTP();                            // telling the class to use SMTP
$mail->Host       = "220.158.200.81";       // SMTP server
$mail->SMTPAuth   = true;                   // enable SMTP authentication
$mail->Host       = "220.158.200.81";       // sets the SMTP server
$mail->Port       = 26;                     // set the SMTP port for the GMAIL server
$mail->Username   = "fadhli@tutorkami.com"; // SMTP account username
$mail->Password   = "fadhli";               // SMTP account password

$mail->SetFrom('contact@tutorkami.com', 'TutorKami');
$mail->AddReplyTo("contact@tutorkami.com","TutorKami");
$mail->Subject    = "Invoice (Request for Payment) - TutorKami";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($message);

$address1 = "palismz@yahoo.com.my";
$address2 = "mohdnurfadhli@gmail.com";

$mail->AddAddress($address1);
$mail->AddAddress($address2);

$mail->AddAttachment("i699602 Mr Fadhli Client.pdf");   // attachment if any
$mail->AddAttachment("i699602 Mr Fadhli Client.pdf");   // attachment if any

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}


?>