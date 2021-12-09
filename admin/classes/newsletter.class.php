<?php
/*
************************************************
** Page Name     : job.class.php 
** Page Author   : Durga Charan Garai
** Created On    : 01/06/2017
************************************************
*/
require_once('db.class.php');

class newsletter extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
	}
    /**
    *Functions for Newsletter Subscription List Management
    **/
	function FetchNewletterSubscribersList(){
		$sql = "SELECT * FROM ".DB_PREFIX."_newsletter";
   	   /*if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE news_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }*/
   	   return $this->db->query($sql);
		
	}
	function SearchSubscribersByEmail($email){
          return $this->db->query("SELECT * FROM ".DB_PREFIX."_newsletter WHERE news_email= '".$email."'");
	}
	function UpdateNewletter($data){
		$q = "UPDATE ".DB_PREFIX."_newsletter SET news_email='".$data['news_email']."' ,news_status='".$data['news_status']."', news_modified_date='".date('Y-m-d H:i:s')."'  WHERE news_id = '".$data['news_id']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Newletter Email Updated Successfully.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			} 
	}
	function GetNewsletterSubscription($nid){
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_newsletter WHERE news_id= '".$nid."'")->fetch_assoc();
	}
    function DeleteNewsletterSubscription($nid){
    	if($this->db->query("DELETE FROM ".DB_PREFIX."_newsletter WHERE news_id = '".$nid."'")){
          Session::SetFlushMsg("success", 'Newsletter  Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error);
	 }
    }
    function SaveSubscribers($data){
    	foreach($data as $key => $csv) {
    		$sql = "INSERT INTO ".DB_PREFIX."_newsletter(news_group, news_level, news_id_numer, news_name, news_email, news_status, news_create_date, news_country_id) VALUES('".$data[$key]['Group']."', '".$data[$key]['Level']."', '".$data[$key]['IdNumber']."', '".$data[$key]['Name']."', '".$data[$key]['Email']."', '".$data[$key]['Status']."', '".date('Y-m-d H:i:s')."','".$_SESSION[DB_PREFIX]['u_country_id']."')";

          	if($this->db->query($sql)) {
				Session::SetFlushMsg("success", 'CSV file imported Successfully.');
			} else {
				Session::SetFlushMsg("error", 'CSV  import failed.');
			}
	    }
    }

    /**
    *Fucntions for Newsletter Template Management
    **/
	function SaveNewsletterTemplate($data){
  	 if($data['nwtemp_id']=='') {
			
				
			if($this->db->query("INSERT INTO ".DB_PREFIX."_newsletter_template(nwtemp_bcc,nwtemp_email_account,nwtemp_status,nwtemp_create_date,nwtemp_country_id) VALUES('".$data['nwtemp_bcc']."','".$data['nwtemp_email_account']."','".$data['nwtemp_status']."','".date('Y-m-d H:i:s')."','".$_SESSION[DB_PREFIX]['u_country_id']."')")) {

				$insert_id = $this->db->insert_id;

				foreach($data['ntt_subject'] as $key=>$value){

                     $this->db->query("INSERT INTO ".DB_PREFIX."_newsletter_template_translation(ntt_nwtemp_id,ntt_lang_code,ntt_subject,ntt_content_body) VALUES('".$insert_id."','".$key."','".$value."','".$data['ntt_content_body'][$key]."')");
				
				}
				Session::SetFlushMsg("success", 'Newsletter Template Added Successfully.');
				
			} else {
				Session::SetFlushMsg("error", 'Insert Sql failed.'.$this->db->error);
			}
		} else {
			
				$q = "UPDATE ".DB_PREFIX."_newsletter_template SET nwtemp_bcc = '".$data['nwtemp_bcc']."',nwtemp_modified_date='".date('Y-m-d H:i:s')."',nwtemp_status='".$data['nwtemp_status']."' WHERE nwtemp_id = '".$data['nwtemp_id']."'";

				foreach($data['ntt_subject'] as $key=>$value){
                  $this->db->query("UPDATE ".DB_PREFIX."_newsletter_template_translation SET ntt_subject = '".$value."',ntt_content_body='".$data['ntt_content_body'][$key]."' WHERE ntt_nwtemp_id = '".$data['nwtemp_id']."' AND ntt_lang_code='".$key."'");
                     
				
				} 
			    if($this->db->query($q)) {
				  Session::SetFlushMsg("success", 'Newsletter Template Updated Successfully.');
			    } else {
				  Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			    }

			}
		
   }
   function FetchNewsletterTemplate(){
   	  $sql = "SELECT * FROM ".DB_PREFIX."_newsletter_template";
   	   /*if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE nwtemp_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }*/
   	   return $this->db->query($sql);
   	  
   }
   function DeleteNewsletterTemplate($tempid){
   	  if($this->db->query("DELETE FROM ".DB_PREFIX."_newsletter_template WHERE nwtemp_id = '".$tempid."'")){

   	  	$this->db->query("DELETE FROM ".DB_PREFIX."_newsletter_template_translation WHERE ntt_nwtemp_id = '".$tempid."'");
  	 	Session::SetFlushMsg("success", 'Newsletter Template Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error);
	 }
   }
   function GetDefaultLanguageNewsTemplate($tempid){
   	  return $this->db->query("SELECT * FROM ".DB_PREFIX."_newsletter_template_translation WHERE ntt_nwtemp_id = '".$tempid."'")->fetch_assoc();
   }
   function GetNewsTemplate($tempid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_newsletter_template WHERE nwtemp_id = '".$tempid."'")->fetch_assoc();
    }
   function GetNewsTemplateTranslationByNewsTemplate($tempid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_newsletter_template_translation WHERE ntt_nwtemp_id = '".$tempid."'");
    }
   function FetchNewsletterTemplateTranslation(){
   	   return $this->db->query("SELECT * FROM ".DB_PREFIX."_newsletter_template_translation");
   }
   function GetNewsTemplateTranslation($tid){
       return $this->db->query("SELECT * FROM ".DB_PREFIX."_newsletter_template_translation WHERE ntt_id = '".$tid."'")->fetch_assoc();
   }
   function sendNewsletterEmailTemplate($name,$emails,$emailSubject,$emailBody,$footer) {

		require_once "../api/phpmailer/class.phpmailer.php";

		$message = '<html><head>
		<title>Newsletter Template</title>
		</head>
		<body>';
		if($name<>"") {
			$message .= '<h1>Hi ' . $name . '!</h1>';
		}
		$message .= '<p>' . $emailBody . '</p>';
		//$message .= '<p>Regards,<br>Tutorkami</p>';
		if($footer == 'bm') {
			$message .= '<p>Terima kasih,<br>TutorKami.com</p>';
		}else{
		    $message .= '<p>Best Regards,<br>TutorKami.com</p>';
		}
		$message .= "</body></html>";

		// php mailer code starts
		$mail = new PHPMailer(true);

		try {
			
			$mail->Subject = trim($emailSubject);
			 
			// sending mail from
			$mail->SetFrom('admin@tutorkami.com', 'TutorKami');
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

	function ListNewsletterTemplate() {
		$sql = "SELECT * FROM ".DB_PREFIX."_newsletter_template AS NT 
		INNER JOIN ".DB_PREFIX."_newsletter_template_translation AS NTT ON NTT.ntt_nwtemp_id = NT.nwtemp_id 
		WHERE NTT.ntt_lang_code = 'en'";

		return $this->db->query($sql);
	}

}