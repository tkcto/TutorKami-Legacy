<?php
require_once('db.class.php');

class template extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
	}

   function sendEmailTemplate($name,$emails,$emailSubject,$emailBody,$footer) {

		require_once "../api/phpmailer/class.phpmailer.php";

		/*$message = '<html><head>
		<title>Receipt</title>
		</head>
		<body>';
		if($name<>"") {
			$message .= '<h1>Hi ' . $name . '!</h1>';
		}
		$message .= '<p>' . $emailBody . '</p>';
		$message .= "</body></html>";*/
		$message = $emailBody;

		// php mailer code starts
		$mail = new PHPMailer(true);

		try {
			
			$mail->Subject = trim($emailSubject);
			 
			// sending mail from
			$mail->SetFrom('finance@tutorkami.com', 'TutorKami - Receipt');
			foreach($emails as $email){
			// sending to
			  $mail->AddAddress($email);
		    }
			// set the message
			$mail->MsgHTML($message);

			return $mail->send();

		} catch (phpmailerException $e) {
			return $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			return $e->getMessage(); //Boring error messages from anything else!
		}
   }


}