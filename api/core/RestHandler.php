<?php 
// MailGun - Start
require DIR_ROOT.'admin/libraries/mailgun/vendor/autoload.php';
use Mailgun\Mailgun;
//MailGun - End

class RestHandler {

	public function setHttpHeaders($contentType, $statusCode){
		
		$statusMessage = $this -> getHttpStatusMessage($statusCode);
		
		header($this->httpVersion. " ". $statusCode ." ". $statusMessage);		
		header("Content-Type:". $contentType);
	}

	public function identicalFeatures( $arrayA , $arrayB ) { 

		sort( $arrayA ); 
		sort( $arrayB ); 

		return $arrayA == $arrayB; 
	}

	public function address2LatLong($address){
	    if(!empty($address)){
	        //Formatted address
	        $formattedAddr = str_replace(' ','+',$address);
	        //Send request and receive json data by address
	        $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
	        $output = json_decode($geocodeFromAddr);
	        //Get latitude and longitute from json data
	        $data['latitude']  = $output->results[0]->geometry->location->lat; 
	        $data['longitude'] = $output->results[0]->geometry->location->lng;
	        //Return latitude and longitude of the given address
	        if(!empty($data)){
	            return $data;
	        }else{
	            return false;
	        }
	    }else{
	        return false;   
	    }
	}

	public function latLong2Address($latitude, $longitude){
	    if(!empty($latitude) && !empty($longitude)){
	        //Send request and receive json data by address
	        $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false'); 
	        $output = json_decode($geocodeFromLatLong);
	        $status = $output->status;
	        //Get address from json data
	        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
	        //Return address of the given latitude and longitude
	        if(!empty($address)){
	            return $address;
	        }else{
	            return false;
	        }
	    }else{
	        return false;   
	    }
	}

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    	/**
		 * Usage
		 * 
		 *	echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
		 *	echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
		 *	echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
		 *
    	 */

		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == "K") {
			return ($miles * 1.609344);
		} else if ($unit == "N") {
			return ($miles * 0.8684);
		} else {
			return $miles;
		}
	}

	function haversineGreatCircleDistance( $lat1, $lng1, $lat2, $lng2, $miles = true){
	  // convert from degrees to radians
	  /*$latFrom = $this->deg2rad($latitudeFrom);
	  $lonFrom = $this->deg2rad($longitudeFrom);
	  $latTo = $this->deg2rad($latitudeTo);
	  $lonTo = $this->deg2rad($longitudeTo);

	  $latDelta = $latTo - $latFrom;
	  $lonDelta = $lonTo - $lonFrom;

	  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
	    cos($latFrom) * cos($latTo) * p*//*ow(sin($lonDelta / 2), 2)));
	  return $angle * $earthRadius;*/

	  $pi80 = M_PI / 180;
		$lat1 *= $pi80;
		$lng1 *= $pi80;
		$lat2 *= $pi80;
		$lng2 *= $pi80;
	 
		$r = 6372.797; // mean radius of Earth in km
		$dlat = $lat2 - $lat1;
		$dlng = $lng2 - $lng1;
		$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$km = $r * $c;
	 
		return ($miles ? ($km * 0.621371192) : $km);
	}
	
	public function formatDecimal($number, $dec_point = 2) {
		$decimals = ($dec_point != '') ? $dec_point : 2;
		return number_format($number, $decimals, '.', '');
	}

	public function timeRequired($start, $end, $flag = NULL) {

		$datetime1 	= new DateTime($start);
		$datetime2 	= new DateTime($end);
		$interval 	= $datetime1->diff($datetime2);

		$dt_menor 	= $start;
		$dt_maior 	= $end;

		if( is_string( $dt_menor)) $dt_menor = date_create( $dt_menor);
		if( is_string( $dt_maior)) $dt_maior = date_create( $dt_maior);

		$diff = date_diff( $dt_menor, $dt_maior );

		switch( $flag){
			case "y": 
				$totalDurtn = $diff->y + $diff->m / 12 + $diff->d / 365.25; 
				break;

			case "m":
				$totalDurtn= $diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24;
				break;

			case "d":
				$totalDurtn = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
				break;

			case "h": 
				$totalDurtn = ($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h + $diff->i/60;
				break;

			case "i": 
				$totalDurtn = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s/60;
				break;

			case "s": 
				$totalDurtn = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
				break;

			case "formated": 
				$elapsed 	= $interval->format('%a %H:%i');

				$splitFrmt 	= explode(':', $elapsed);
				$popMin 	= end($splitFrmt);
				$formatMin 	= ( (int)$popMin < 10 ) ? '0'.$popMin : $popMin;
				$totalDurtn = $splitFrmt[0].':'.$formatMin;
				break;

			default:
				$totalDurtn = $interval->format('%y years %m months %a days %h hours %i minutes %S seconds');
				break;
	
		}	

		return $totalDurtn;
	}

    public function validateDuration($start_date, $start_time, $end_date, $end_time) {
    	$response = array();
    	$split_s  = explode('-', $start_date);
    	$split_e  = explode('-', $end_date);
		$start 	  = $start_date.' '.$start_time;
		$end 	  = $end_date.' '.$end_time;

    	if (! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$start_date) ) {
			$response[] = 'Invalid start date format. Allowed format is YYYY-MM-DD.';
		} elseif (checkdate($split_s[1],$split_s[2],$split_s[0]) === false) {
			$response[] = 'Start date does not exist in this calendar year. Given: '. $start_date;
		}

		if (! preg_match("/(2[0-3]|[01][1-9]|10):([0-5][0-9]):([0-5][0-9])/", $start_time) ) {
			$response[] = 'Invalid start time format. Allowed format is HH:MM:SS.';
		}

		if (! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$end_date) ) {
			$response[] = 'Invalid end date format. Allowed format is YYYY-MM-DD.';
		} elseif (checkdate($split_e[1],$split_e[2],$split_e[0]) === false) {
			$response[] = 'End date does not exist in this calendar year. Given: '. $end_date;
		}

		if (! preg_match("/(2[0-3]|[01][1-9]|10):([0-5][0-9]):([0-5][0-9])/", $end_time) ) {
			$response[] = 'Invalid end time format. Allowed format is HH:MM:SS.';
		}
		
		if( strtotime($start) < strtotime('now') ) {
			$response[] = 'Start date passed. Current Time: '. date('Y-m-d H:i:s', strtotime('now')) .' Given: '. date('Y-m-d H:i:s', strtotime($start) );
		}
		
		if( strtotime($end) < strtotime('now') ) {
			$response[] = 'End date passed.';
		}
		
		if( strtotime($start) > strtotime($end) ) {
			$response[] = 'Start date-time cannot be greater than end date-time.';
		}

		return $response;
	}
	
	public function getHttpStatusMessage($statusCode){
		$httpStatus = array(
			100 => 'Continue',  
			101 => 'Switching Protocols',  
			200 => 'OK',
			201 => 'Created',  
			202 => 'Accepted',  
			203 => 'Non-Authoritative Information',  
			204 => 'No Content',  
			205 => 'Reset Content',  
			206 => 'Partial Content',  
			300 => 'Multiple Choices',  
			301 => 'Moved Permanently',  
			302 => 'Found',  
			303 => 'See Other',  
			304 => 'Not Modified',  
			305 => 'Use Proxy',  
			306 => '(Unused)',  
			307 => 'Temporary Redirect',  
			400 => 'Bad Request',  
			401 => 'Unauthorized',  
			402 => 'Payment Required',  
			403 => 'Forbidden',  
			404 => 'Not Found',  
			405 => 'Method Not Allowed',  
			406 => 'Not Acceptable',  
			407 => 'Proxy Authentication Required',  
			408 => 'Request Timeout',  
			409 => 'Conflict',  
			410 => 'Gone',  
			411 => 'Length Required',  
			412 => 'Precondition Failed',  
			413 => 'Request Entity Too Large',  
			414 => 'Request-URI Too Long',  
			415 => 'Unsupported Media Type',  
			416 => 'Requested Range Not Satisfiable',  
			417 => 'Expectation Failed',  
			500 => 'Internal Server Error',  
			501 => 'Not Implemented',  
			502 => 'Bad Gateway',  
			503 => 'Service Unavailable',  
			504 => 'Gateway Timeout',  
			505 => 'HTTP Version Not Supported');
		return ($httpStatus[$statusCode]) ? $httpStatus[$statusCode] : $status[500];
	}
	
	public function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}

	public function utf8ize($mixed) {
	    if (is_array($mixed)) {
	        foreach ($mixed as $key => $value) {
	            $mixed[$key] = $this->utf8ize($value);
	        }
	    } else if (is_string ($mixed)) {
	        return utf8_encode($mixed);
	    }
	    return $mixed;
	}
	
	public function encodeJson($responseData) {
		if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
	        $encoded = json_encode($responseData, JSON_PRETTY_PRINT);
	    } else {
	        $encoded = json_encode($responseData);
	    }

		switch (json_last_error()) {
	        case JSON_ERROR_NONE:
	            return $encoded;
	        case JSON_ERROR_DEPTH:
	            return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
	        case JSON_ERROR_STATE_MISMATCH:
	            return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
	        case JSON_ERROR_CTRL_CHAR:
	            return 'Unexpected control character found';
	        case JSON_ERROR_SYNTAX:
	            return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
	        case JSON_ERROR_UTF8:
	            $clean = $this->utf8ize($responseData);
	            return $this->encodeJson($clean);
	        default:
	            return 'Unknown error'; // or trigger_error() or throw new Exception()

	    }
	}
	
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><ubraboats></ubraboats>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}

	public function getRandStr($length='6'){
		// return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $length);
	}

	public function getRandNum($length='6'){
		return substr(str_shuffle("0123456789"), 0, $length);
	}
	
	public function SendPushNotification($decive_token_id, $decive_type, $click_action, $title, $message, $data, $ios_click_action) {
		# Load libraries
		require_once "libraries/PushNotifications.php";
		$push = new PushNotifications();
		$inputData = array(
			'devicetoken' 	=> $decive_token_id, 
			'title' 		=> $title, 
			'message' 		=> $message, 
			'click_action' 	=> $click_action, 
			'data' 			=> $data,
			'ios_action' 	=> $ios_click_action
			);

		if ($decive_type == 'ios') {
			$send = $push->iOS($inputData);
		} elseif ($decive_type == 'ios_rider') {
			$send = $push->iOSRider($inputData);
		} elseif($decive_type == 'android_rider') {
			$send = $push->androidRider($inputData);
		}else {
			$send = $push->android($inputData);	
		}

		return $send;
	}

	public function sendEmail($name, $email, $emailSubject, $emailBody) {

		require_once "phpmailer/class.phpmailer.php";

		$message = '<html><head>
		<title>Email Verification</title>
		</head>
		<body>';
		if($name<>"") {
			$message .= '<h1>Hi ' . $name . '!</h1>';
		}
		$message .= '<p>' . $emailBody . '</p>';
		$message .= '<p>Regards,<br>Tutorkami</p>';
		$message .= "</body></html>";

		// php mailer code starts
		$mail = new PHPMailer(true);

		try {
			// telling the class to use SMTP
			/*$mail->IsSMTP();*/
			// enable SMTP authentication
			/*$mail->SMTPAuth = true;   */
			// sets the prefix to the server
			/*$mail->SMTPSecure = "ssl"; */
			// sets GMAIL as the SMTP server
			/*$mail->Host = "smtp.gmail.com"; */
			// set the SMTP port for the GMAIL server
			/*$mail->Port = 465; */
			 
			// set your username here
			/*$mail->Username = 'mipl.subhadeep@gmail.com';*/
			/*$mail->Password = 'mipl@123';*/
			 
			// set your subject
			$mail->Subject = trim($emailSubject);
			 
			// sending mail from
			$mail->SetFrom('support@tutorkami.com', 'Tutorkami');
			// sending to
			$mail->AddAddress($email);
			// set the message
			$mail->MsgHTML($message);

			return $mail->send();

		} catch (phpmailerException $e) {
			return $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			return $e->getMessage(); //Boring error messages from anything else!
		}
	}

	public function mailGunEmail($name, $email, $emailSubject, $emailBody) {
		//MailGun Account
		$mgClient = new Mailgun(MAILGUN_KEY);
		$domain = MAILGUN_DOMAIN;
		//Sending the mail via MailGun
		$mailSendFlag = $mgClient->sendMessage(
			$domain, 
			array(
				'from' => 'Tutorkami <support@tutorkami.com>',
				'to'   => $email,
				'subject' => $emailSubject,
				'html' => $emailBody
			)
		);
	}

	public function StripeCheckCard($api_key, $cc_number, $exp_month, $exp_year, $cvc) {
		# Load libraries
		require_once "libraries/Stripe.php";
		$stripe = new Stripe($api_key);

		$stripe->url 					.= '/tokens';
		# credit card details #
		$stripe->fields['card'] = array(
			'number' 	=> $cc_number,
			'exp_month' => $exp_month,
			'exp_year' 	=> $exp_year,
			'cvc' 		=> $cvc
		);

		$pay = $stripe->initiatePayment();
		return $pay;
	}

	public function StripeGateway ($api_key, $currency, $amount, $cc_number, $exp_month, $exp_year, $cvc, $description) {
		# Load libraries
		require_once "libraries/Stripe.php";
		$stripe = new Stripe($api_key);

		$stripe->url 					.= '/charges';
		$stripe->fields['amount'] 		= $amount * 100;
		$stripe->fields['currency'] 	= $currency;
		$stripe->fields['description'] 	= $description;
		# credit card details #
		$stripe->fields['source'] = array(
			'object' 	=> 'card',
			'number' 	=> $cc_number,
			'exp_month' => $exp_month,
			'exp_year' 	=> $exp_year,
			'cvc' 		=> $cvc
		);

		$pay = $stripe->initiatePayment();
		return $pay;
	}

	public function StripeRefundGateway($api_key, $charge, $amount, $reason = 'requested_by_customer') {
		# Load libraries
		require_once "libraries/Stripe.php";
		$stripe = new Stripe($api_key);

		$stripe->url .= '/refunds';
		$stripe->fields['charge'] = $charge;
		$stripe->fields['amount'] = $amount * 100;
		$stripe->fields['reason'] = $reason;

		$refund = $stripe->initiatePayment();
		return $refund;
	}

	public function sendResponse($rawData) {		
		$response = $this->encodeJson($rawData);
		echo $response;
	}

	public function isValidLongitude($location) {
		if(preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/", $location)) {
			return true;
		} else {
			return false;
		}
	}
}
?>