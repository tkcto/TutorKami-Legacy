<style>
.alert-message
{
    margin: 20px 0;
    padding: 20px;
    border-left: 3px solid #eee;
}
.alert-message h4
{
    margin-top: 0;
    margin-bottom: 5px;
}
.alert-message p:last-child
{
    margin-bottom: 0;
}
.alert-message code
{
    background-color: #fff;
    border-radius: 3px;
}
.alert-message-success
{
    /*background-color: #F4FDF0;
    border-color: #3C763D;*/
}
.alert-message-success h4
{
    /*color: #3C763D;*/
}
.alert-message-danger
{
    background-color: #fdf7f7;
    border-color: #d9534f;
}
.alert-message-danger h4
{
    color: #d9534f;
}
.alert-message-warning
{
    background-color: #fcf8f2;
    border-color: #f0ad4e;
}
.alert-message-warning h4
{
    color: #f0ad4e;
}
.alert-message-info
{
    background-color: #f4f8fa;
    border-color: #5bc0de;
}
.alert-message-info h4
{
    color: #5bc0de;
}
.alert-message-default
{
    background-color: #EEE;
    border-color: #B4B4B4;
}
.alert-message-default h4
{
    color: #000;
}
.alert-message-notice
{
    background-color: #FCFCDD;
    border-color: #BDBD89;
}
.alert-message-notice h4
{
    color: #444;
}


.fa-question-circle {
  color:#3a87ad;
  margin-left:5px;
}
.no-border {
    border-bottom:0 solid transparent;
}


/* button switch on */
.switch {
  position: relative;
  display: inline-block;
  width: 53px;
  height: 23px;
  float:right;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ADD8E6;
  -webkit-transition: .2s;
  transition: .2s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 3.5px;
  background-color: white;
  -webkit-transition: .2s;
  transition: .2s;
}

input.success:checked + .slider {
  background-color: #232662;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(30px);
  -ms-transform: translateX(30px);
  transform: translateX(30px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 17px;
}

.slider.round:before {
  border-radius: 50%;
}


.btn-default, .btn-default:active, .btn-default:visited {
    background-color: #232662 !important;
}

.btn-default:hover {
    background-color: #232662 !important;
    transition: all 1s ease;
    -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    -ms-transition: all 1s ease;
}

.bootstrap{
  width:100%;
  border-radius: 5px;
  background: #fff;
  border: 1px solid #ccc;
  outline:none;
  padding: 6px;
}





.close {
  float: right;
  font-size: 20px;
  font-weight: bold;
  line-height: 18px;
  color: #000000;
  text-shadow: 0 1px 0 #ffffff;
  opacity: 0.2;
  filter: alpha(opacity=20);
}
.close:hover {
  color: #000000;
  text-decoration: none;
  opacity: 0.4;
  filter: alpha(opacity=40);
  cursor: pointer;
}

.alert {
  padding: 8px 35px 8px 14px;
  margin-bottom: 18px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background-color: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  color: #c09853;
}
.alert-heading {
  color: inherit;
}
.alert .close {
  position: relative;
  top: -2px;
  right: -21px;
  line-height: 18px;
}
.alert-success {
  background-color: #dff0d8;
  border-color: #d6e9c6;
  color: #468847;
}
.alert-danger,
.alert-error {
  background-color: #f2dede;
  border-color: #eed3d7;
  color: #b94a48;
}
.alert-info {
  background-color: #d9edf7;
  border-color: #bce8f1;
  color: #3a87ad;
}
.alert-block {
  padding-top: 14px;
  padding-bottom: 14px;
}
.alert-block > p,
.alert-block > ul {
  margin-bottom: 0;
}
.alert-block p + p {
  margin-top: 5px;
}

/* https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_outline_buttons */
.btn2 {
  border: 2px solid black;
  background-color: white;
  color: black;
  padding: 5px 12px;
  font-size: 8px;
  cursor: pointer;
}
.success1 {
  background-color: #4CAF50;
  border-color: #4CAF50;
  color: white;
  padding-left:20px;
  padding-right:20px;
}
.success2 {
  border-color: #4CAF50;
  color: green;
  padding-left:20px;
  padding-right:20px;
}


/* Overriding placeholder */
::-webkit-input-placeholder {
   font-size: 25px;
}

:-moz-placeholder { /* Firefox 18- */
      font-size: 25px;
}

::-moz-placeholder {  /* Firefox 19+ */
      font-size: 25px;
}



::-webkit-input-placeholder {
   font-size: 13px!important;
}

:-moz-placeholder { /* Firefox 18- */
      font-size: 13px!important;
}
::-moz-placeholder {  /* Firefox 19+ */
      font-size: 13px!important;
}
</style>
<?php
//Include the database configuration file
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if( !empty($_POST["level"]) && !empty($_POST["state"]) && !empty($_POST["person"]) ){
	
	$queryLevel = "SELECT tc_id, tc_title, tc_description FROM tk_tution_course WHERE tc_id = ".$_POST['level']."";
	$resultLevel = $conn->query($queryLevel);
	if ($resultLevel->num_rows > 0) {
		$rowLevel = $resultLevel->fetch_assoc();
		$thisLevel = $rowLevel['tc_title'];
		$thisLevelBM = $rowLevel['tc_description'];
	}else{
		$thisLevel = $_POST['level'];
		$thisLevelBM = $_POST['level'];
	}
	
	$arrCity = explode(",", $_POST['state'], 2);
	$first = trim($arrCity[0]);
	$sqlCity = "SELECT * FROM tk_cities WHERE city_name = '".$first."'  ";
	$resultCity = $conn->query($sqlCity);
	if ($resultCity->num_rows > 0) {
		$rowCity = $resultCity->fetch_assoc();
		$thisCity = $rowCity['city_id'];
		$thisCityName = $rowCity['city_name'];
	}else{
	    $thisCity = '';
	    $thisCityName = '';
	}

	// string-after ,	
	$arrState = explode(',', $_POST['state']);
	$second = trim($arrState[1]);
	$sqlState = "SELECT * FROM tk_states WHERE st_name LIKE '".$second."'  ";
	$resultState = $conn->query($sqlState);
	if ($resultState->num_rows > 0) {
		$rowState = $resultState->fetch_assoc();
		$thisState = $rowState['st_id'];
	    $thisStateName = $rowState['st_name'];
	}else{
	    $thisState = '';
	    $thisStateName = '';
	}
	
	
	$sqltest = "SELECT * FROM tk_location_rate2 WHERE level = ".$_POST['level']." AND state = ".$thisState." ";
	$resulttest = $conn->query($sqltest);
	if ($resulttest->num_rows > 0) {
		while($rowtest = $resulttest->fetch_assoc()){
			$thisArray = $rowtest['city'];
			if (in_array($thisCity, (explode(',',$thisArray)))){
				$arrThis = $rowtest['id'];
			break;
			}
		}
	}
	$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
	$thisOnlineName = $thisOnlineValue = $thisLocationName = $thisLocationValue = '';
	if( $_POST['state'] == 'Online Tuition' ){
		$sqlRate = "SELECT * FROM tk_online_rates WHERE or_level_id = '".$_POST['level']."'  ";
	}else{
		if( $arrThis != '' ){
			$sqlRate = "SELECT * FROM tk_location_rate2 WHERE id = ".$arrThis."  "; 
		}else{
		    if( $getLan == "/my/" || $_SERVER['HTTP_REFERER'] == "https://www.tutorkami.com/guru-tuisyen" || (strpos($_SERVER['HTTP_REFERER'],'guru-tuisyen?') !== false) ){
    			echo '<div class="col-sm-12">
    				<div class="alert-message alert-message-danger">
    					<h4>For further info, please contact our coordinator.</h4>
    				</div>		
    			</div>';
    			echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Sebelumnya</button>';
    			exit();	
		    }else{
    			echo '<div class="col-sm-12">
    				<div class="alert-message alert-message-danger">
    					<h4>For further info, please contact our coordinator.</h4>
    				</div>		
    			</div>';
    			echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Previous</button>';
    			exit();		        
		    }

		}
	}
	$resultRate = $conn->query($sqlRate);
	if ($resultRate->num_rows > 0) {
		$rowRate = $resultRate->fetch_assoc();
			
			if( $_POST['state'] == 'Online Tuition' ){
			    $thisRate = filter_var($rowRate['or_rate'], FILTER_SANITIZE_NUMBER_INT);
				$BilPelajar = $_POST['person'];
				$thisOnlineName = 'Online Tuition';
				$thisOnlineValue = $thisRate;

			}else{
			    $thisRate = filter_var($rowRate['rate'], FILTER_SANITIZE_NUMBER_INT);
			    $BilPelajar = $_POST['person'];	
				$thisLocationName = $_POST["state"];	
				$thisLocationValue = $thisRate;			

			}
			?>
				
	<?PHP
	if( $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/price' || $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' ){
		$pageStyle0 = 'style="margin-top:-25px;"';
		$pageStyle1 = 'style="margin-left:13px;"';
		$pageStyle2 = '';
		$pageOpenFont = '';
		$pagecloseFont = '';
		
		$pageStyle3 = '';
		$pageStyle4 = 'class="text-left"';
		$pageStyle5 = 'class="text-left hidden" style="width:150px;color:blue;margin-left:-14px;margin-bottom:10px;"';
		$pageStyle6 = 'style="margin-left:-33px;margin-top:-5px;"';
		$pageStyle7 = 'style="text-align:center;width:93px;"';
		$pageStyle8 = 'style="margin-left:-12px;"';
		$pageStyle9 = '';
		$pageStyle10 = 'style="text-align:left;width:93px;font-size:12px;"';
		$pageStyle11 = 'style="font-size:18px;width:8px;"';
		$pageStyle12 = '';
		$pageStyle13 = '';
		$pageStyleSpace = '';
		$pageStyle14 = 'style="margin-left:-13px;"';
	}else{
		$pageStyle0 = 'style="margin-top: 25px;text-align: left;border-style: solid;border-bottom-color: black;"';
		$pageStyle1 = 'style="margin-left:0px;"';
		$pageStyle2 = 'style="margin-left:13px;"';
		$pageOpenFont = '';
		$pagecloseFont = '';
		
		$pageStyle3 = 'style="text-align: right;"';
		$pageStyle4 = 'style="text-align: right;margin-right:13px;"';
		$pageStyle5 = 'class="hidden" style="color:blue;margin-left:0px;margin-bottom:10px;text-align: right;"';
		$pageStyle6 = 'style="margin-left:-23px;margin-top:-5px;"';
		$pageStyle7 = 'style="text-align:center;width:110px;"';
		$pageStyle8 = 'style="margin-left:0px;"';
		$pageStyle9 = 'style="color:white;"';
		$pageStyle10 = 'style="text-align:left;width:110px;font-size:12px;"';
		$pageStyle11 = 'style="font-size:18px;width:18px;"';
		$pageStyle12 = '<span style="margin-left:18px;"></span>';
		$pageStyle13 = 'margin-left:1px;';
		$pageStyleSpace = '&nbsp;&nbsp;';
		$pageStyle14 = 'style="margin-left:-5px;"';
	}
	
    if( $getLan == "/my/" || $_SERVER['HTTP_REFERER'] == "https://www.tutorkami.com/guru-tuisyen" || (strpos($_SERVER['HTTP_REFERER'],'guru-tuisyen?') !== false) ){
        $titleFee = 'HARGA';
        $titleMonth = 'sebulan';
        $titleNormalTuition = 'Tuisyen biasa';
        $titleOnlineTuition = 'Tuisyen Online';
        $titleSlider1 = '(slide kanan untuk Tuisyen Online)';
        $titleSlider2 = '(slide kiri untuk tuisyen biasa)';
        $titleNormalTutor = 'Tutor biasa';
        $titleSchoolTutor = 'Cikgu Sekolah';
        $titleStudent = 'Bilangan pelajar';
        $titleDuration = 'Durasi setiap sesi';
        $titleSession = 'Jumlah sesi sebulan';
        $titleSubTotal = 'Jumlah';
        $titleSubTotal2 = 'Diskaun RM5 sejam hanya diberi jika ambil kelas lebih dari sebulan';
        $titleDiscount = '(Jumlah tanpa diskaun)';
        $titleRegister = 'Yuran pendaftaran (RM50/pelajar, sekali sahaja)';
        $titleTotal = 'JUMLAH SEMUA';
        $titleFirstMonth = '*untuk bulan yang pertama';
        $titlePrevious = 'SEBELUMNYA';
        $titleHome = 'LAMAN UTAMAN';
        
        $titleSessWeek = 'sesi seminggu';
        $titlePerStudent = 'pelajar';
        $titleIn = 'di ';
        $titleFor = 'untuk ';
        $titleTitle = $thisLevelBM;
        
        $titleTooltip1 = 'Kadar bayaran biasanya bertambah RM10 sejam, jika tutor merupakan guru sekolah, atau berpengalaman lebih dari 5 tahun';
        $titleTooltip2 = 'Hanya tambah RM10 sejam untuk setiap tambahan pelajar. E.g. jika kadar untuk seorang pelajar ialah RM50 sejam, maka untuk 2 pelajar kadar akan menjadi RM60 sejam (jadi kadar seorang pelajar hanya RM30 sejam) . <b>Nota</b>: pelajar² mestilah belajar <b>serentak</b> dalam 1 sesi dan bukan berasingan e.g. 2 pelajar belajar serentak untuk sesi 2 jam, dan bukan berasingan 1 jam setiap pelajar.';
        $titleTooltip3 = 'Diskaun RM5 sejam jika ambil lebih dari 1 sesi seminggu (<b>tidak terpakai</b> untuk online tuisyen). E.g. jika ambil 1 sesi seminggu dan kadar ialah RM50 sejam, maka dengan mengambil 2 sesi seminggu (8 sesi sebulan) kadar bayaran hanyalah RM45 sejam. Diskaun hanya diberi jika mengambil kelas <b>lebih dari sebulan dan durasi setiap sesi minima sejam setengah</b>';
        $titleTooltip4 = 'Dapatkan kadar bayaran lebih rendah dengan tuisyen online (klik slider ke kanan)';
        
        $clockTime = '1 jam 30 minit';
        $clockMins = 'minit';
        $clockHour = 'jam';
        $TotalSesi = '4 sesi';
        $TotalSesi2 = 'sesi';
    }else{
        $titleFee = 'FEES';
        $titleMonth = '/ month';
        $titleNormalTuition = 'Normal Tuition';
        $titleOnlineTuition = 'Online Tuition';
        $titleSlider1 = '(slide right for Online Tuition)';
        $titleSlider2 = '(slide left for Normal Tuition)';
        $titleNormalTutor = 'Rate - Normal Tutor';
        $titleSchoolTutor = 'Rate - School Teacher';
        $titleStudent = 'Student(s)';
        $titleDuration = 'Duration per Session';
        $titleSession = 'Sessions / Month';
        $titleSubTotal = 'Subtotal';
        $titleSubTotal2 = 'Discount RM5/hour only applicable if lessons duration are more than 1 month';
        $titleDiscount = '(price without discount)';
        $titleRegister = 'Registration Fees (RM50/student, one-time only)';
        $titleTotal = 'TOTAL';
        $titleFirstMonth = '*for the 1st month';
        $titlePrevious = 'PREVIOUS';
        $titleHome = 'HOME';
        
        $titleSessWeek = 'session(s)/week';
        $titlePerStudent = 'student';
        $titleIn = 'in ';
        $titleFor = 'for ';
        $titleTitle = $thisLevel;
        
        $titleTooltip1 = 'Rate per hour may increase by RM10/hour if tutor is a school teacher, or has teaching experience of more than 5 years';
        $titleTooltip2 = 'Only add RM10/hour for each additional student. E.g if the rate for 1 student is RM50/hour, then for 2 students the rate is RM60/hour (so only RM30/hour per student). <b>Note</b>: the students must have the session <b>simultaneously</b> e.g. 2 students undergo 2 hours session and not separately';
        $titleTooltip3 = 'Get RM5/hour discount when you take more than 1 session per week (<b>does not</b> apply for online tuition). E.g. If you take 1 session/week & the rate is RM50/hour, then by taking 2 sessions/week (8 sessions/month) the rate will only be RM45/hour. Discounts only applicable when lessons are <b>more than 1 month and each session minimum 1 hour 30 minutes</b>';
        $titleTooltip4 = 'Enjoy lower rates with online class (click the slider on the right)';
        
        $clockTime = '1 hour 30 mins';
        $clockMins = 'mins';
        $clockHour = 'hour';
        $TotalSesi = '4 sessions';
        $TotalSesi2 = 'sessions';
    }
	?>

<input type="text" id="postOfflineName"  class="hidden" value="<?PHP echo $thisLocationName; ?>">
<input type="text" id="postOfflineValue" class="hidden" value="<?PHP echo $thisLocationValue; ?>">
<input type="text" id="postlevel"        class="hidden" value="<?PHP echo $_POST["level"]; ?>">
<input type="text" id="postOnlineName"   class="hidden" value="<?PHP echo $thisOnlineName; ?>">
<input type="text" id="postOnlineValue"  class="hidden" value="<?PHP echo $thisOnlineValue; ?>">


<input id="inputRate_id"    name="inputRate_id"    type="text" class="hidden" value="<?PHP //echo $_SESSION['sessionRate_id'];  ?>">
<input id="inputRate_rate"  name="inputRate_rate"  type="text" class="hidden" value="<?PHP //echo $_SESSION['sessionRate_rate'];  ?>">
<input id="inputRate_city"  name="inputRate_city"  type="text" class="hidden" value="<?PHP //echo $_SESSION['sessionRate_city'];  ?>">
<input id="inputRate_state" name="inputRate_state" type="text" class="hidden" value="<?PHP //echo $_SESSION['sessionRate_state'];  ?>">



			<div class="col-sm-12" <?PHP echo $pageStyle0;?>>
			    <br/>
				<div>
				<?PHP
				if(preg_match("/^[0-9.]+$/", $thisRate)) {
				?>
<div id="alertOk" class="alert alert-error hidden" style="margin-top:25px;">
  <a class="close" data-dismiss="alert">×</a>
  Discount code applied. <strong>Enjoy!</strong>
</div>
<div id="alertInvalid" class="alert alert-error hidden" style="margin-top:25px;">
  <a class="close" data-dismiss="alert">×</a>
  Invalid discount code. Please try again.
</div>
<div id="alertInvalid2" class="alert alert-error hidden" style="margin-top:25px;">
  <a class="close" data-dismiss="alert">×</a>
  Discount code is invalid. Please select more sessions or/and duration.
</div>
<div id="alertInvalid3" class="alert alert-error hidden" style="margin-top:25px;">
  <a class="close" data-dismiss="alert">×</a>
  Please insert discount code.
</div>

					<form class="form-horizontal">		

						<div <?PHP echo $pageStyle1; ?>>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<h4 <?PHP echo $pageStyle2; ?> ><strong><?PHP echo $titleFee; ?> :</strong></h4>
									</div>
								</div>
								<div class="col-xs-6" <?PHP echo $pageStyle3; ?>>
									<div class="form-group">
										<h4 <?PHP echo $pageStyle4; ?> id="monthlyFeeOutput" ><strong></strong></h4>
									</div>
								</div>
							</div>
							<div class="row" <?PHP echo $pageStyle3; ?>>
								<div class="col-xs-4"></div>
								<div class="col-xs-8">
									<p id="pricePerStudent" <?PHP echo $pageStyle5; ?>><b></b></p>		
								</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-xs-6">
								<p>
								    <span id="textNormalTuition"><?PHP echo $titleNormalTuition; ?></span><span id="textOnlineTuition" style="display:none;"><?PHP echo $titleOnlineTuition; ?></span>
								    <br/><font id="slideRight" style="font-size:11px;"><?PHP if( $_POST['state'] == 'Online Tuition' ){ echo $titleSlider2; }else{ echo $titleSlider1; } ?> </font>
								</p>
							</div>
							<div class="col-xs-4" style="margin-left:-20px;margin-top:2px;">
							    <?PHP echo $pageStyle12; ?>
								<a type="button" data-tippy-content="<?PHP echo $titleTooltip4; ?>" > <i style="color:#f1592a;font-size:25px;" class="fa fa-question-circle"></i> </a>&nbsp;&nbsp;
								<a href="https://www.tutorkami.com/tuisyen-online" target="blank" type="button" data-toggle="tooltip" data-placement="bottom" title=""> <i style="color:#262262;font-size:25px;" class="fa fa-info-circle"></i> </a>
							</div>
							<div class="col-xs-2" <?PHP echo $pageStyle14;?> >
								<span class="input-group-btn">
									<label></label>
								</span>
								<span class="input-group-btn">
									<label class="switch" style="margin-top:5px;<?PHP echo $pageStyle13;?>">
										<input <?PHP if( $_POST['state'] == 'Online Tuition' ){ echo'checked'; } ?> type="checkbox" class="success" value="false" id="CheckboxnormalTuition" onChange="normalTuitionCheckbox()">
										<span class="slider round"></span>
									</label>
								</span>
							</div>
						</div>
						
						

						<div class="row">
							<div class="col-xs-6">
								<p><span id="textNormalTutor"><?PHP echo $titleNormalTutor; ?></span><span id="textSchoolTeacher" style="display:none;"><?PHP echo $titleSchoolTutor; ?> &nbsp;</span>
									<a type="button" data-tippy-content="<?PHP echo $titleTooltip1; ?>" ><i style="color:#f1592a;" class="fa fa-question-circle"></i></a>
								</p>
							</div>
							<div class="col-xs-4" <?PHP echo $pageStyle6; ?>>
								<input readonly <?PHP echo $pageStyle7; ?> type="text" id="normalTutorInput" class="form-control input-number" value="">
							</div>
							<div class="col-xs-2">
								<span class="input-group-btn">
									<label></label>
								</span>
								<span class="input-group-btn">
									<label class="switch" style="margin-top:1px;">
										<input type="checkbox" class="success" value="false" id="CheckboxnormalTutor" onChange="normalTutorCheckbox()">
										<span class="slider round"></span>
									</label>
								</span>
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-6"><p><?PHP echo $titleStudent; ?> <a type="button" data-tippy-content="<?PHP echo $titleTooltip2; ?>"> <i style="color:#262262;" class="fa fa-info-circle"></i> </a></p></div>
							<div class="col-xs-4" <?PHP echo $pageStyle6; ?>>
								<input readonly <?PHP echo $pageStyle7; ?> type="text" id="NoOfStudentsInput" name="NoOfStudentsInput" class="form-control input-number" value="" min="1" max="5" onChange="NoOfStudentsOnChange()">
							</div>
							<div class="col-xs-2" <?PHP echo $pageStyle8; ?>>
								<span class="input-group-btn">
									<button <?PHP echo $pageStyle9; ?> type="button" class="btn btn-default btn-number btn-xs" data-type="minus" data-field="NoOfStudentsInput">
										<span class="glyphicon glyphicon-minus" <?PHP echo $pageStyle11; ?>></span>
									</button>
								</span>
								<span class="input-group-btn">
									<button <?PHP echo $pageStyle9; ?> type="button" class="btn btn-default btn-number btn-xs" data-type="plus" data-field="NoOfStudentsInput">
										<span class="glyphicon glyphicon-plus" <?PHP echo $pageStyle11; ?>></span>
									</button>
								</span>
							</div>
						</div>
		
						<div class="row">
							<div class="col-xs-6"><p><?PHP echo $titleDuration; ?></p></div>
							<div class="col-xs-4" <?PHP echo $pageStyle6; ?>>

								<input readonly <?PHP echo $pageStyle10; ?> type="text" id="sessionDuration" name="sessionDuration" class="form-control input-number" value="<?PHP echo $clockTime; ?>">
							</div>
							<div class="col-xs-2" <?PHP echo $pageStyle8; ?>>
								<span class="input-group-btn">
									<button <?PHP echo $pageStyle9; ?> type="button" class="btn btn-default btn-number btn-xs" data-type="minus" data-field="sessionDuration">
										<span class="glyphicon glyphicon-minus" <?PHP echo $pageStyle11; ?>></span>
									</button>
								</span>
								<span class="input-group-btn">
									<button <?PHP echo $pageStyle9; ?> type="button" class="btn btn-default btn-number btn-xs" data-type="plus" data-field="sessionDuration">
										<span class="glyphicon glyphicon-plus" <?PHP echo $pageStyle11; ?>></span>
									</button>
								</span>
							</div>
						</div>
		
						<div class="row">
							<div class="col-xs-6"><p><?PHP echo $titleSession; ?> <a type="button" data-tippy-content="<?PHP echo $titleTooltip3; ?>" > <i style="color:#262262;" class="fa fa-info-circle"></i> </a> <br/>
								<font id="sessionWeek" style="text-align: left;font-size:10px;font-style: oblique;margin-top:0px;">1 <?PHP echo $titleSessWeek; ?></font></p></p>
							</div>
							<div class="col-xs-4" <?PHP echo $pageStyle6; ?>>
								<input readonly <?PHP echo $pageStyle7; ?> type="text" id="sessionPerMonth" name="sessionPerMonth" class="form-control input-number" value="<?PHP echo $TotalSesi; ?>" min="4" max="16" >
							</div>
							<div class="col-xs-2" <?PHP echo $pageStyle8; ?>>
								<span class="input-group-btn">
									<button <?PHP echo $pageStyle9; ?> type="button" class="btn btn-default btn-number btn-xs" data-type="minus" data-field="sessionPerMonth">
										<span class="glyphicon glyphicon-minus" <?PHP echo $pageStyle11; ?>></span>
									</button>
								</span>
								<span class="input-group-btn">
									<button <?PHP echo $pageStyle9; ?> type="button" class="btn btn-default btn-number btn-xs" data-type="plus" data-field="sessionPerMonth">
										<span class="glyphicon glyphicon-plus" <?PHP echo $pageStyle11; ?>></span>
									</button>
								</span>
							</div>
						</div>
		
						<div class="row hidden">
							<div class="col-xs-6"><p>* Discount code</p></div>
							<div class="col-xs-4" style="margin-left:-33px;margin-top:-5px;">
								<input type="text" name="discount_code" id="discount_code" class="bootstrap" placeholder="Enter Discount code here">
							</div>
							<div class="col-xs-2" style="margin-left:-12px;">
							    
								<span class="input-group-btn">
								    <button id="btnDiscount" type="button" class="btn2 success1" style="margin-left:0px;margin-top:-5px;" onClick="loadDiscount()">
								        <span style="font-size:13px;">Done</span>
								    </button>
								</span>
							</div>
						</div>
						
<hr>
						<div class="row">
							<div class="col-xs-4" style="font-size:14px;"><?PHP echo $titleSubTotal; ?> <a id="tooltipSubtotal" class="hidden" type="button" data-tippy-content="<?PHP echo $titleSubTotal2; ?>" ><i style="color:#f1592a;" class="fa fa-question-circle"></i></a> </div>
							<div class="col-xs-5" style="font-size:14px;"><center><font id="subtotalDic" class="hidden"></font></center></div>
							<div class="col-xs-3">
								<p id="subtotal" style="text-align: right;font-size:14px;"></p>
							</div>
						</div><div class="clearfix"></div><br/>
						<div class="row hidden" id="fieldDiscount">
							<div class="col-xs-8"><p id="textDiscount"></p></div>
							<div class="col-xs-4">
								<p id="textDiscountAmount" style="text-align: right;"><strong><font color="red"><?PHP echo "- RM ";//.$RegistrationFee; ?></font></strong></p>	
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-xs-8" style="font-size:14px;"><?PHP echo $titleRegister; ?></div>
							<div class="col-xs-4">
								<p id="registrationFeeOutput" style="text-align: right;font-size:14px;"></p>	
							</div>
						</div>
<hr>

						<div class="form-group">
							<h4 class=" col-xs-6"><strong><?PHP echo $pageStyleSpace.$pageStyleSpace; ?><?PHP echo $titleTotal; ?> :</strong></h4>
							<div class="col-xs-6">
								<h4 id="totalOutput" style="text-align: right;"><strong style="color: #3C763D;"></strong></h4>
								<!--<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;" id="strikethrough" class="hidden"><del>RM <?PHP //echo $Total; ?></del></p>
								<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;">*for the 1st month</p>-->
							</div>
							
							<h4 class=" col-xs-8" style="margin-top:-1px;">
							    <font style="font-size:13px;"><?PHP echo $pageStyleSpace.$pageStyleSpace.$pageStyleSpace; ?><span id="lokasi"></span></font><br>
							    <font style="font-size:13px;"><?PHP echo $pageStyleSpace.$pageStyleSpace.$pageStyleSpace; ?><span id="lokasi2"></span></font>
							</h4>
							<div class="col-xs-4">
								<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;" id="strikethrough" class="hidden"><del>RM <?PHP echo $Total; ?></del></p>
								<p style="text-align: right;font-size:10px;font-style: oblique;margin-top:0px;"><?PHP echo $titleFirstMonth; ?></p>
							</div>
						</div>
						
						<!--<div class="form-group">
							<div class="col-xs-12">
								<p style="text-align: center;font-size:13px;font-style: oblique;margin-top:0px;">
								*Discounts if you take more than 1 session per week (except intensive classes). Contact our team for further info.
								</p>
							</div>
						</div>-->
						
					</form>
					<?PHP if( $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/price' || $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' ){}else{ if($titlePrevious ='SEBELUMNYA'){echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Sebelumnya</button>';}else{echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Previous</button>';}} ?>
    
			
				<?
				}else{
				?>
					<div class="alert-message alert-message-danger">
						<h3><?PHP echo "'NOT NUMBER'"; ?></h3>
						<h4><?PHP echo "For further info, please contact our coordinator."; ?></h4>
					</div>	
					<?PHP if( $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/price' || $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' ){}else{ if($titlePrevious ='SEBELUMNYA'){echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Sebelumnya</button>';}else{echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Previous</button>';}} ?>
				<?
				}
				?>
				</div><br/>
			</div>
			<?PHP
	}else{
	?>
		<div class="col-sm-12">
			<div class="alert-message alert-message-danger">
                <h4><?PHP echo "For further info, please contact our coordinator."; ?></h4>
            </div>		
		</div>
		<?PHP if( $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/price' || $_SERVER['HTTP_REFERER'] == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' ){}else{ if($titlePrevious ='SEBELUMNYA'){echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Sebelumnya</button>';}else{echo '<button type="button" class="btn btn-previous btn-fill btn-danger btn-wd" onClick="btnPrevious()">Previous</button>';}} ?>
	<?PHP
	}

}
?>

<script>
function Procced() {
    var selectStateModal1 = document.getElementById("postlevel").value;
    var selectStateModal2 = document.getElementById("selectStateModal").value;
    $.ajax({
        type:'POST',
        url:'pricing-session.php',
        data:{selectStateModal1: selectStateModal1, selectStateModal2: selectStateModal2},
        dataType: 'JSON',
        success:function(result){
			if( result.rate == 'Error' ){
				alert('Please select location...');
				$('.hover_bkgr_fricc').hide();
				setInterval(function(){ $('.hover_bkgr_fricc').show(); }, 2000);
				exit();
			}
			
            var RatePerHour = parseFloat(result.rate);
            var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
            if(thisCheckbox == true){
                RateNormalTutor = 10;
            }else{
                RateNormalTutor = 0;
            }            
            var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
            var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
			            
            if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
                firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
                secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
            }else{
                firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
                secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
            }
            
            if(secondDigitMF == '30'){
                valueDuration = parseFloat(firstDigitMF+'.'+'5');
            }else{
                valueDuration = parseFloat(firstDigitMF+'.'+'0');
            }
            
            var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
            if( valueMonth == '4' ){
                rateLess = 0;
                document.getElementById("subtotalDic").classList.add("hidden");
            }else{
                rateLess = 5;
                document.getElementById("subtotalDic").classList.remove("hidden");
            }
            
            document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
            document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
			if( BilPelajar > 1){
				document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
				document.getElementById("pricePerStudent").classList.remove("hidden");
			}else{
				document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
				document.getElementById("pricePerStudent").classList.add("hidden");
			}
			
			document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
			document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
            
            document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
            document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
            
			$('.hover_bkgr_fricc').hide();

            document.getElementById("postOfflineName").value = result.location;
            document.getElementById("postOfflineValue").value = result.rate;
			
            var LokasiLvl   = '<?PHP echo $titleTitle; ?>';
            var partsChar = result.location.split(', ', 2);
            document.getElementById("lokasi").innerHTML = LokasiLvl+' <?PHP echo $titleIn; ?> '+partsChar[0]+',';
            document.getElementById("lokasi2").innerHTML = partsChar[1];
        }
    });
}

	function autocomplete(inp, arr) {
	  var currentFocus;
	  inp.addEventListener("input", function(e) {
		  var a, b, i, val = this.value;
		  closeAllLists();
		  if (!val) { return false;}
		  currentFocus = -1;
		  a = document.createElement("DIV");
		  a.setAttribute("id", this.id + "autocomplete-list");
		  a.setAttribute("class", "autocomplete-items");
		  this.parentNode.appendChild(a);
		  for (i = 0; i < arr.length; i++) {
			if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
			  b = document.createElement("DIV");
			  b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
			  b.innerHTML += arr[i].substr(val.length);
			  b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
			  b.addEventListener("click", function(e) {
				  inp.value = this.getElementsByTagName("input")[0].value;
				  closeAllLists();
			  });
			  a.appendChild(b);
			}
		  }
	  });
	  inp.addEventListener("keydown", function(e) {
		  var x = document.getElementById(this.id + "autocomplete-list");
		  if (x) x = x.getElementsByTagName("div");
		  if (e.keyCode == 40) {
			currentFocus++;
			addActive(x);
		  } else if (e.keyCode == 38) { 
			currentFocus--;
			addActive(x);
		  } else if (e.keyCode == 13) {
			e.preventDefault();
			if (currentFocus > -1) {
			  if (x) x[currentFocus].click();
			}
		  }
	  });
	  function addActive(x) {
		if (!x) return false;
		removeActive(x);
		if (currentFocus >= x.length) currentFocus = 0;
		if (currentFocus < 0) currentFocus = (x.length - 1);
		x[currentFocus].classList.add("autocomplete-active");
	  }
	  function removeActive(x) {
		for (var i = 0; i < x.length; i++) {
		  x[i].classList.remove("autocomplete-active");
		}
	  }
	  function closeAllLists(elmnt) {
		var x = document.getElementsByClassName("autocomplete-items");
		for (var i = 0; i < x.length; i++) {
		  if (elmnt != x[i] && elmnt != inp) {
			x[i].parentNode.removeChild(x[i]);
		  }
		}
	  }
	  document.addEventListener("click", function (e) {
		  closeAllLists(e.target);
	  });
	}

	<?php
		$connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
		$sqlS = "SELECT ts.ts_id, tc.tc_title, ts.ts_title FROM tk_tution_subject ts
				LEFT JOIN tk_tution_course tc ON tc.tc_id = ts.ts_tc_id AND tc.tc_status = 'A'
				WHERE ts.ts_status = 'A'";
		$sqlL = "SELECT tc.city_id, tc.city_name, st.st_name
				FROM tk_cities tc
				LEFT JOIN tk_states st
				ON st.st_id = tc.city_st_id
				WHERE tc.city_status = '1'";
				
		$subjectid = array();
		$locationid = array();
	?>
	var countries = 	[
						<?php
							//echo "'Online Tuition',";
							$res = mysqli_query($connect, $sqlL);
							$i = 0;
							while($row = mysqli_fetch_array($res))
							{
								array_push($locationid, $row['city_id']);
								
								if($i != 0)
								{
									echo ",";
								}
								
								echo "'".$row['city_name'].", ".$row['st_name']."'";
								$i++;
							}
						?>
					];
	autocomplete(document.getElementById("selectStateModal"), countries);
</script>


<script>
/* ### LOAD THIS PAGE ### */
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();  

	if( document.getElementById("postOfflineValue").value != '' ){
		var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value);
	}else{
		var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
	}
	var BilPelajar = parseFloat('<?PHP echo $BilPelajar; ?>');
	var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
	
    if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
        firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
        secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
    }else{
        firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
        secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
    }
    
	if(secondDigitMF == '30'){
		valueDuration = parseFloat(firstDigitMF+'.'+'5');
	}else{
		valueDuration = parseFloat(firstDigitMF+'.'+'0');
	}
                
	var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
	
		document.getElementById("normalTutorInput").value = 'RM '+(RatePerHour + RateBilPelajar)+' / <?PHP echo $clockHour; ?>';
		document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( ((RatePerHour + RateBilPelajar) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
		if( BilPelajar > 1){
			document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( ((RatePerHour + RateBilPelajar) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
			document.getElementById("pricePerStudent").classList.remove("hidden");
		}else{
			document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( ((RatePerHour + RateBilPelajar) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
			document.getElementById("pricePerStudent").classList.add("hidden");
		}
		document.getElementById("NoOfStudentsInput").value = BilPelajar;
		
		var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
		if(thisCheckbox == true){
			document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateBilPelajar) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
			document.getElementById("subtotalDic").classList.add("hidden");
			$("#textNormalTuition").hide();
			$("#textOnlineTuition").show();        
		}else{
			document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateBilPelajar) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
			document.getElementById("subtotalDic").classList.add("hidden");
			$("#textNormalTuition").show();
			$("#textOnlineTuition").hide();   
		}
		document.getElementById("subtotal").innerHTML = "RM "+ ( ((RatePerHour + RateBilPelajar) * valueDuration) * valueMonth ) +" ";
                
		document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
		document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( ((RatePerHour + RateBilPelajar) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
		
		
		var LokasiLvl   = '<?PHP echo $titleTitle; ?>';
		var LokasiState = '<?PHP echo $_POST["state"]; ?>';
		if( LokasiState == 'Online Tuition' ){
			LokasiThis = LokasiLvl+' <?PHP echo $titleFor; ?> <?PHP echo $titleOnlineTuition; ?>';
			var partsChar = 'aaaa , '.split(', ', 2);
		}else{
			var partsChar = LokasiState.split(', ', 2);
			LokasiThis = LokasiLvl+' <?PHP echo $titleIn; ?> '+partsChar[0]+',';
		}
		document.getElementById("lokasi").innerHTML = LokasiThis;
		document.getElementById("lokasi2").innerHTML = partsChar[1];
});

function normalTuitionCheckbox() {
    var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
    if(thisCheckbox == true){
		
        document.getElementById("slideRight").innerHTML = '<?PHP echo $titleSlider2; ?>';
		if( document.getElementById("postOnlineValue").value != '' ){
			
			var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
			var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
			if(thisCheckbox == true){
				RateNormalTutor = 10;
			}else{
				RateNormalTutor = 0;
			}            
			var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
			var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
				
			if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
			    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
			    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
			}else{
			    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
			    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
			}
			
			if(secondDigitMF == '30'){
				valueDuration = parseFloat(firstDigitMF+'.'+'5');
			}else{
				valueDuration = parseFloat(firstDigitMF+'.'+'0');
			}
                
			var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				
			if( BilPelajar > 1){
				document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
				document.getElementById("pricePerStudent").classList.remove("hidden");
			}else{
				document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
				document.getElementById("pricePerStudent").classList.add("hidden");
			}
				
			document.getElementById("normalTutorInput").value = 'RM '+(RatePerHour + RateNormalTutor + RateBilPelajar)+' / <?PHP echo $clockHour; ?>';
			document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
       
			document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
			document.getElementById("subtotalDic").classList.add("hidden");
				
			document.getElementById("subtotal").innerHTML = "RM "+ ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) +" ";
                
			document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
			document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
		}else{
			var postState = document.getElementById("postlevel").value;
			$.ajax({
				type:'POST',
				url:'pricing-session3.php',
				data:{postState: postState},
				dataType: 'JSON',
				success:function(result){
					var rateOnline = result.rate1;
					
					var RatePerHour = parseFloat(rateOnline);
					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						RateNormalTutor = 10;
					}else{
						RateNormalTutor = 0;
					}            
					var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
					var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
					
        			if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
        			    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
        			    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
        			}else{
        			    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
        			    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
        			}
        			
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
					
					var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					
					if( BilPelajar > 1){
						document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
						document.getElementById("pricePerStudent").classList.remove("hidden");
					}else{
						document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
						document.getElementById("pricePerStudent").classList.add("hidden");
					}
					
					document.getElementById("normalTutorInput").value = 'RM '+(RatePerHour + RateNormalTutor + RateBilPelajar)+' / <?PHP echo $clockHour; ?>';
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
		   
					document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
					document.getElementById("subtotalDic").classList.add("hidden");
					
					document.getElementById("subtotal").innerHTML = "RM "+ ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) +" ";
					
					document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					
					document.getElementById("postOnlineName").value = 'Online Tuition';
					document.getElementById("postOnlineValue").value = RatePerHour;
				}
			});			
		}
        $("#textNormalTuition").hide();
        $("#textOnlineTuition").show(); 
		
		var LokasiLvl   = '<?PHP echo $titleTitle; ?>';
		LokasiThis = LokasiLvl+' <?PHP echo $titleFor; ?> <?PHP echo $titleOnlineTuition; ?>';
		document.getElementById("lokasi").innerHTML = LokasiThis;
		document.getElementById("lokasi2").innerHTML = '';
		
    }else{
        document.getElementById("slideRight").innerHTML = '<?PHP echo $titleSlider1; ?>';
		if( document.getElementById("postOfflineValue").value != '' ){
						
			var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value);
			var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
			if(thisCheckbox == true){
				RateNormalTutor = 10;
			}else{
				RateNormalTutor = 0;
			}            
			var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
			var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
			if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
			    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
			    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
			}else{
			    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
			    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
			}
			
			if(secondDigitMF == '30'){
				valueDuration = parseFloat(firstDigitMF+'.'+'5');
			}else{
				valueDuration = parseFloat(firstDigitMF+'.'+'0');
			}
                                
			var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
			if( valueMonth == '4' ){
				rateLess = 0;
				document.getElementById("subtotalDic").classList.add("hidden");
			}else{
				rateLess = 5;
				document.getElementById("subtotalDic").classList.remove("hidden");
			}
                				
			document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
			document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
						
			if( BilPelajar > 1){
				document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
				document.getElementById("pricePerStudent").classList.remove("hidden");
			}else{
				document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
				document.getElementById("pricePerStudent").classList.add("hidden");
			}
			document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
                                
			document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + RateNormalTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
                                
			document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
			document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";

			var LokasiLvl   = '<?PHP echo $titleTitle; ?>';
            var partsChar = document.getElementById("postOfflineName").value.split(', ', 2);
            document.getElementById("lokasi").innerHTML = LokasiLvl+' <?PHP echo $titleIn; ?> '+partsChar[0]+',';
            document.getElementById("lokasi2").innerHTML = partsChar[1];
		}else{
			$('.hover_bkgr_fricc').show();			
		}
        $("#textNormalTuition").show();
        $("#textOnlineTuition").hide();
    }
}

/* ### NORMAL TUTOR CHECKBOX ### */
function normalTutorCheckbox() {
	
	var getCheckTuition = document.getElementById("CheckboxnormalTuition").checked;
	if(getCheckTuition == true){
		//alert('online');
		if( document.getElementById("postOnlineValue").value != '' ){
			var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
			if(thisCheckbox == true){
				$("#textNormalTutor").hide();
				$("#textSchoolTeacher").show();
				
				var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
					RatePerHour = parseFloat(RatePerHour + 10);
				var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
				var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
				
				if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
				    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
				}else{
				    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				}
				
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
							
				var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				
				document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateBilPelajar))+' / <?PHP echo $clockHour; ?>';
				document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
				if( BilPelajar > 1){
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
					document.getElementById("pricePerStudent").classList.remove("hidden");
				}else{
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
					document.getElementById("pricePerStudent").classList.add("hidden");
				}
				document.getElementById("NoOfStudentsInput").value = BilPelajar;		  
					
				document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) +" ";
							
				document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
								
			}else{
				$("#textSchoolTeacher").hide();
				$("#textNormalTutor").show();
				
				var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
					RatePerHour = parseFloat(RatePerHour);
				var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
				var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
				
				if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
				    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
				}else{
				    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				}
				
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
							
				var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				
				document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateBilPelajar))+' / <?PHP echo $clockHour; ?>';
				document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
				if( BilPelajar > 1){
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
					document.getElementById("pricePerStudent").classList.remove("hidden");
				}else{
					document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
					document.getElementById("pricePerStudent").classList.add("hidden");
				}
				document.getElementById("NoOfStudentsInput").value = BilPelajar;		  
					
				document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) +" ";
							
				document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
				document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
			}
		}else{
			var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
			if(thisCheckbox == true){
				$("#textNormalTutor").hide();
				$("#textSchoolTeacher").show();
		
				var postState = document.getElementById("postlevel").value;
				$.ajax({
					type:'POST',
					url:'pricing-session3.php',
					data:{postState: postState},
					dataType: 'JSON',
					success:function(result){
						
						var RatePerHour = parseFloat(result.rate1);
							RatePerHour = parseFloat(RatePerHour + 10);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateBilPelajar))+' / <?PHP echo $clockHour; ?>';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						document.getElementById("NoOfStudentsInput").value = BilPelajar;		  
							
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) +" ";
									
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";

						document.getElementById("postOnlineName").value = 'Online Tuition';
						document.getElementById("postOnlineValue").value = result.rate1;						
					}
				});
			}else{
				$("#textSchoolTeacher").hide();
				$("#textNormalTutor").show();
				
				var postState = document.getElementById("postlevel").value;
				$.ajax({
					type:'POST',
					url:'pricing-session3.php',
					data:{postState: postState},
					dataType: 'JSON',
					success:function(result){
						
						var RatePerHour = parseFloat(result.rate1);
							RatePerHour = parseFloat(RatePerHour);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateBilPelajar))+' / <?PHP echo $clockHour; ?>';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						document.getElementById("NoOfStudentsInput").value = BilPelajar;		  
							
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) +" ";
									
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";

						document.getElementById("postOnlineName").value = 'Online Tuition';
						document.getElementById("postOnlineValue").value = result.rate1;						
					}
				});
			}
		}
	}else{
		//alert('offine');
		if( document.getElementById("postOfflineValue").value != '' ){
			var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
			if(thisCheckbox == true){
				$("#textNormalTutor").hide();
				$("#textSchoolTeacher").show();
										
				var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value );
					RatePerHour = parseFloat(RatePerHour + 10);
				var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
				var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
				
				if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
				    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
				}else{
				    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				}
				
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
							
				var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				if( valueMonth == '4' ){
					rateLess = 0;
					document.getElementById("subtotalDic").classList.add("hidden");
				}else{
					rateLess = 5;
					document.getElementById("subtotalDic").classList.remove("hidden");
				}
				
					document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
					if( BilPelajar > 1){
						document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
						document.getElementById("pricePerStudent").classList.remove("hidden");
					}else{
						document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
						document.getElementById("pricePerStudent").classList.add("hidden");
					}
					document.getElementById("NoOfStudentsInput").value = BilPelajar;
					
					document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
					document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
							
					document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
			}else{
				$("#textSchoolTeacher").hide();
				$("#textNormalTutor").show();
				
				var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value );
					RatePerHour = parseFloat(RatePerHour);
				var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
				var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
				
				if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
				    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
				}else{
				    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
				    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
				}
				
				if(secondDigitMF == '30'){
					valueDuration = parseFloat(firstDigitMF+'.'+'5');
				}else{
					valueDuration = parseFloat(firstDigitMF+'.'+'0');
				}
							
				var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
				if( valueMonth == '4' ){
					rateLess = 0;
					document.getElementById("subtotalDic").classList.add("hidden");
				}else{
					rateLess = 5;
					document.getElementById("subtotalDic").classList.remove("hidden");
				}
				
					document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
					document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
					if( BilPelajar > 1){
						document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
						document.getElementById("pricePerStudent").classList.remove("hidden");
					}else{
						document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
						document.getElementById("pricePerStudent").classList.add("hidden");
					}
					document.getElementById("NoOfStudentsInput").value = BilPelajar;
					
					document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
					document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
							
					document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
					document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
			}
		}else{
			var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
			if(thisCheckbox == true){
				$("#textNormalTutor").hide();
				$("#textSchoolTeacher").show();
				
				var selectStateModal1 = document.getElementById("postlevel").value;
				var selectStateModal2 = document.getElementById("selectStateModal").value;
				$.ajax({
					type:'POST',
					url:'pricing-session.php',
					data:{selectStateModal1: selectStateModal1, selectStateModal2: selectStateModal2},
					dataType: 'JSON',
					success:function(result){
						if( result.rate == 'Error' ){
							alert('Please select location...');
							$('.hover_bkgr_fricc').hide();
							setInterval(function(){ $('.hover_bkgr_fricc').show(); }, 2000);
							exit();
						}
						
						var RatePerHour = parseFloat(result.rate);
						var RateNormalTutor = parseFloat(10);
								 
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
									
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
						
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}
						
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						
						document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
						
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
						
						$('.hover_bkgr_fricc').hide();

						document.getElementById("postOfflineName").value = result.location;
						document.getElementById("postOfflineValue").value = result.rate;
						
						var LokasiLvl   = '<?PHP echo $titleTitle; ?>';
						var partsChar = result.location.split(', ', 2);
						document.getElementById("lokasi").innerHTML = LokasiLvl+' <?PHP echo $titleIn; ?> '+partsChar[0]+',';
						document.getElementById("lokasi2").innerHTML = partsChar[1];
					}
				});				
			}else{
				$("#textSchoolTeacher").hide();
				$("#textNormalTutor").show();
				
				var selectStateModal1 = document.getElementById("postlevel").value;
				var selectStateModal2 = document.getElementById("selectStateModal").value;
				$.ajax({
					type:'POST',
					url:'pricing-session.php',
					data:{selectStateModal1: selectStateModal1, selectStateModal2: selectStateModal2},
					dataType: 'JSON',
					success:function(result){
						if( result.rate == 'Error' ){
							alert('Please select location...');
							$('.hover_bkgr_fricc').hide();
							setInterval(function(){ $('.hover_bkgr_fricc').show(); }, 2000);
							exit();
						}
						
						var RatePerHour = parseFloat(result.rate);
						var RateNormalTutor = parseFloat(0);
								 
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
									
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
						
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}
						
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						
						document.getElementById("subtotalDic").innerHTML = 'RM '+( ((RatePerHour + RateNormalTutor + RateBilPelajar) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
						
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + RateNormalTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
						
						$('.hover_bkgr_fricc').hide();

						document.getElementById("postOfflineName").value = result.location;
						document.getElementById("postOfflineValue").value = result.rate;
						
						var LokasiLvl   = '<?PHP echo $titleTitle; ?>';
						var partsChar = result.location.split(', ', 2);
						document.getElementById("lokasi").innerHTML = LokasiLvl+' <?PHP echo $titleIn; ?> '+partsChar[0]+',';
						document.getElementById("lokasi2").innerHTML = partsChar[1];
					}
				});	
			}
		}
	}
}






$('.btn-number').click(function(e){
	
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
	
if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
	var currentTime = input.val();
	var firstDigit = currentTime.substring(0, 1);
	var secondDigit = currentTime.substring(6, 8);
	var resultTime = parseFloat(firstDigit+'.'+secondDigit);   
}else{
	var currentTime = input.val();
	var firstDigit = currentTime.substring(0, 1);
	var secondDigit = currentTime.substring(7, 9);
	var resultTime = parseFloat(firstDigit+'.'+secondDigit);    
}
	
    if (!isNaN(currentVal)) {

		if(fieldName == 'NoOfStudentsInput'){
			if(type == 'minus') {
				if(currentVal > input.attr('min')) {
					document.getElementById("NoOfStudentsInput").value = (currentVal - 1);
					var getCheckTuition = document.getElementById("CheckboxnormalTuition").checked;
					if(getCheckTuition == true){
						//alert('online');
						//document.getElementById("postOnlineValue").value;
						
						var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
	
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}else{
						//alert('offine');
						//document.getElementById("postOfflineValue").value;
						
						var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
	
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}
				} 
				if(currentVal == '1') {
					alert("Sorry the minimum value has been reached");
				}
			} else if(type == 'plus') {
				if(currentVal < input.attr('max')) {
					document.getElementById("NoOfStudentsInput").value = (currentVal + 1);
					var getCheckTuition = document.getElementById("CheckboxnormalTuition").checked;
					if(getCheckTuition == true){
						//alert('online');
						//document.getElementById("postOnlineValue").value;
						
						var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
	
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}else{
						//alert('offine');
						//document.getElementById("postOfflineValue").value;
						
						var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
	
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}
				}
				if(currentVal == '5') {
					alert("Sorry the maximum value has been reached");
				}
			}
		}
		if(fieldName == 'sessionDuration'){
			if(type == 'minus') {
				 if(resultTime > parseFloat(1.3)) {
					 
					outputTime = (resultTime - 0.7);
					decimals = (outputTime - Math.floor(outputTime)).toFixed(1);
					if(decimals == 0.3){
						document.getElementById("sessionDuration").value = (parseInt(firstDigit) - 1) +' <?PHP echo $clockHour.' 30 '.$clockMins; ?>';
					}else{
						document.getElementById("sessionDuration").value = (parseInt(firstDigit)) +' <?PHP echo $clockHour.' 00 '.$clockMins; ?>';
					}
					
					var getCheckTuition = document.getElementById("CheckboxnormalTuition").checked;
					if(getCheckTuition == true){
						//alert('online');
						//document.getElementById("postOnlineValue").value;				

						var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
							
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}else{
						//alert('offine');
						//document.getElementById("postOfflineValue").value;		

						var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
							
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}
				 }
				 if(resultTime == parseFloat(1.3)) {
					alert("Sorry the minimum value has been reached");
				 }
			}else if(type == 'plus') {
				if(resultTime < parseFloat(3.0)) {
					outputTime = (resultTime + 0.3);
					decimals = (outputTime - Math.floor(outputTime)).toFixed(1);
					if(decimals == 0.6){
						document.getElementById("sessionDuration").value = (parseInt(firstDigit) + 1) +' <?PHP echo $clockHour.' 00 '.$clockMins; ?>';
					}else{
						document.getElementById("sessionDuration").value = (parseInt(firstDigit)) +' <?PHP echo $clockHour.' 30 '.$clockMins; ?>';
					}
					var getCheckTuition = document.getElementById("CheckboxnormalTuition").checked;
					if(getCheckTuition == true){
						//alert('online');
						//document.getElementById("postOnlineValue").value;
							
						var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
							
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}else{
						//alert('offine');
						//document.getElementById("postOfflineValue").value;
							
						var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}else{
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
							
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}
				}
				if(resultTime == parseFloat(3.0)) {
					alert("Sorry the maximum value has been reached");
				}
			}
		}
		if(fieldName == 'sessionPerMonth'){
			if(type == 'minus') {
				if(currentVal > input.attr('min')) {
					document.getElementById("sessionPerMonth").value = (currentVal - 4) +"<?PHP echo ' '.$TotalSesi2; ?>";
					var getCheckTuition = document.getElementById("CheckboxnormalTuition").checked;
					if(getCheckTuition == true){
						//alert('online');
						//document.getElementById("postOnlineValue").value;
						
						var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
							document.getElementById("tooltipSubtotal").classList.add("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
							document.getElementById("tooltipSubtotal").classList.add("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
							document.getElementById("sessionWeek").innerHTML = ((currentVal - 4) / 4) + ' <?PHP echo $titleSessWeek; ?>';
						
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}else{
						//alert('offine');
						//document.getElementById("postOfflineValue").value;
						
						var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						var tick = document.getElementById("CheckboxnormalTuition").checked;
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
							document.getElementById("tooltipSubtotal").classList.add("hidden");
						}else{
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
							document.getElementById("tooltipSubtotal").classList.remove("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
							document.getElementById("sessionWeek").innerHTML = ((currentVal - 4) / 4) + ' <?PHP echo $titleSessWeek; ?>';
					
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}
				}       
				if(currentVal == '4') {
					alert("Sorry the minimum value has been reached");
				}
			}else if(type == 'plus') {
				if(currentVal < input.attr('max')) {
					document.getElementById("sessionPerMonth").value = (currentVal + 4) +"<?PHP echo ' '.$TotalSesi2; ?>";
					var getCheckTuition = document.getElementById("CheckboxnormalTuition").checked;
					if(getCheckTuition == true){
						//alert('online');
						//document.getElementById("postOnlineValue").value;
						
						var RatePerHour = parseFloat(document.getElementById("postOnlineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
							document.getElementById("tooltipSubtotal").classList.add("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
							document.getElementById("tooltipSubtotal").classList.add("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
							document.getElementById("sessionWeek").innerHTML = ((currentVal + 4) / 4) + ' <?PHP echo $titleSessWeek; ?>';
						
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}else{
						//alert('offine');
						//document.getElementById("postOfflineValue").value;
						
						var RatePerHour = parseFloat(document.getElementById("postOfflineValue").value);
						var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
						var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
						
                        if( window.location.href == 'https://www.tutorkami.com/my/harga-tuisyen-di-rumah-online' || window.location.href == 'https://www.tutorkami.com/guru-tuisyen' || window.location.href.split('?')[0] == 'https://www.tutorkami.com/guru-tuisyen' ){
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(6, 8);
                        }else{
						    firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
						    secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
                        }
                        
						if(secondDigitMF == '30'){
							valueDuration = parseFloat(firstDigitMF+'.'+'5');
						}else{
							valueDuration = parseFloat(firstDigitMF+'.'+'0');
						}
									
						var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
						var tick = document.getElementById("CheckboxnormalTuition").checked;
						if( valueMonth == '4' ){
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
							document.getElementById("tooltipSubtotal").classList.add("hidden");
						}else{
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
							document.getElementById("tooltipSubtotal").classList.remove("hidden");
						}
						
						var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
						if(thisCheckbox == true){
							normalSchoolTutor = 10;
						}else{
							normalSchoolTutor = 0;
						}
						
							document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / <?PHP echo $clockHour; ?>';
							document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" <?PHP echo $titleMonth;?></strong>";
							if( BilPelajar > 1){
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.remove("hidden");
							}else{
								document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / <?PHP echo $titlePerStudent;?>)</b> ";
								document.getElementById("pricePerStudent").classList.add("hidden");
							}
							document.getElementById("NoOfStudentsInput").value = BilPelajar;
							document.getElementById("sessionWeek").innerHTML = ((currentVal + 4) / 4) + ' <?PHP echo $titleSessWeek; ?>';
					
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br><?PHP echo $titleDiscount; ?>';
							document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
									
							document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
							document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +" *</strong>";
					}
										
				}
				if(currentVal == '16') {
					alert("Sorry the maximum value has been reached");
				}
			}
		}

    } else {
        input.val(0);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
/*

    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
	
	var currentTime = input.val();
	var firstDigit = currentTime.substring(0, 1);
	var secondDigit = currentTime.substring(7, 9);
	var resultTime = parseFloat(firstDigit+'.'+secondDigit);
	//alert(fieldName +" - "+currentTime+" - "+firstDigit+" - "+secondDigit+" - "+resultTime);
	
    if (!isNaN(currentVal)) {

		if(fieldName == 'NoOfStudentsInput'){
			if(type == 'minus') {
				if(currentVal > input.attr('min')) {
					document.getElementById("NoOfStudentsInput").value = (currentVal - 1);
					
					var RatePerHour = parseFloat('<?PHP echo $thisRate; ?>');
					var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
					var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
					
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
								
					var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					var tick = document.getElementById("CheckboxnormalTuition").checked;
					if( valueMonth == '4' ){
						rateLess = 0;
						document.getElementById("subtotalDic").classList.add("hidden");
					}else{
						if(tick == false){
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
					}
					
					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						normalSchoolTutor = 10;
					}else{
						normalSchoolTutor = 0;
					}
					
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / hour';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						document.getElementById("NoOfStudentsInput").value = BilPelajar;
						
						var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
						if(thisCheckbox == true){
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").hide();
							$("#textOnlineTuition").show();        
						}else{
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").show();
							$("#textOnlineTuition").hide();   
						}
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
								
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";
				} 
				if(currentVal == '1') {
					alert("Sorry the minimum value has been reached");
				}
			} else if(type == 'plus') {
				if(currentVal < input.attr('max')) {				
					document.getElementById("NoOfStudentsInput").value = (currentVal + 1);
					
					var RatePerHour = parseFloat('<?PHP echo $thisRate; ?>');
					var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
					var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
					
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
								
					var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					var tick = document.getElementById("CheckboxnormalTuition").checked;
					if( valueMonth == '4' ){
						rateLess = 0;
						document.getElementById("subtotalDic").classList.add("hidden");
					}else{
						if(tick == false){
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
					}
					
					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						normalSchoolTutor = 10;
					}else{
						normalSchoolTutor = 0;
					}
					
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / hour';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						document.getElementById("NoOfStudentsInput").value = BilPelajar;
						
						var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
						if(thisCheckbox == true){
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").hide();
							$("#textOnlineTuition").show();        
						}else{
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").show();
							$("#textOnlineTuition").hide();   
						}
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
								
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";
				}
				if(currentVal == '5') {
					alert("Sorry the maximum value has been reached");
				}
			}
		} 	
		if(fieldName == 'sessionDuration'){
			if(type == 'minus') {
				 if(resultTime > parseFloat(1.3)) {
					 
					outputTime = (resultTime - 0.7);
					decimals = (outputTime - Math.floor(outputTime)).toFixed(1);
					if(decimals == 0.3){
						document.getElementById("sessionDuration").value = (parseInt(firstDigit) - 1) +' hour 30 mins';
					}else{
						document.getElementById("sessionDuration").value = (parseInt(firstDigit)) +' hour 00 mins';
					}
					
					var RatePerHour = parseFloat('<?PHP echo $thisRate; ?>');
					var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
					var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
					
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
								
					var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					var tick = document.getElementById("CheckboxnormalTuition").checked;
					if( valueMonth == '4' ){
						rateLess = 0;
						document.getElementById("subtotalDic").classList.add("hidden");
					}else{
						if(tick == false){
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
					}
					
					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						normalSchoolTutor = 10;
					}else{
						normalSchoolTutor = 0;
					}
					
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / hour';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						document.getElementById("NoOfStudentsInput").value = BilPelajar;
						
						var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
						if(thisCheckbox == true){
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").hide();
							$("#textOnlineTuition").show();        
						}else{
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").show();
							$("#textOnlineTuition").hide();   
						}
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
								
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";
				 }
				 if(resultTime == parseFloat(1.3)) {
					alert("Sorry the minimum value has been reached");
				 }
			}else if(type == 'plus') {
				if(resultTime < parseFloat(3.0)) {
					outputTime = (resultTime + 0.3);
					decimals = (outputTime - Math.floor(outputTime)).toFixed(1);
					if(decimals == 0.6){
						document.getElementById("sessionDuration").value = (parseInt(firstDigit) + 1) +' hour 00 mins';
					}else{
						document.getElementById("sessionDuration").value = (parseInt(firstDigit)) +' hour '+ '30' +' mins';
					}
					
					var RatePerHour = parseFloat('<?PHP echo $thisRate; ?>');
					var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
					var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
					
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
								
					var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					var tick = document.getElementById("CheckboxnormalTuition").checked;
					if( valueMonth == '4' ){
						rateLess = 0;
						document.getElementById("subtotalDic").classList.add("hidden");
					}else{
						if(tick == false){
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
					}
					
					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						normalSchoolTutor = 10;
					}else{
						normalSchoolTutor = 0;
					}
					
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / hour';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						document.getElementById("NoOfStudentsInput").value = BilPelajar;
						
						var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
						if(thisCheckbox == true){
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").hide();
							$("#textOnlineTuition").show();        
						}else{
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").show();
							$("#textOnlineTuition").hide();   
						}
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
								
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";
				}
				if(resultTime == parseFloat(3.0)) {
					alert("Sorry the maximum value has been reached");
				}
			}
		}
		if(fieldName == 'sessionPerMonth'){
			if(type == 'minus') {
				if(currentVal > input.attr('min')) {
					document.getElementById("sessionPerMonth").value = (currentVal - 4) +"<?PHP echo ' sessions' ?>";

					var RatePerHour = parseFloat('<?PHP echo $thisRate; ?>');
					var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
					var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
					
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
								
					var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					var tick = document.getElementById("CheckboxnormalTuition").checked;
					if( valueMonth == '4' ){
						rateLess = 0;
						document.getElementById("subtotalDic").classList.add("hidden");
					}else{
						if(tick == false){
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
					}
					
					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						normalSchoolTutor = 10;
					}else{
						normalSchoolTutor = 0;
					}
					
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / hour';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						document.getElementById("NoOfStudentsInput").value = BilPelajar;
						
						var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
						if(thisCheckbox == true){
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").hide();
							$("#textOnlineTuition").show();        
						}else{
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").show();
							$("#textOnlineTuition").hide();   
						}
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
								
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";
				}       
				if(currentVal == '4') {
					alert("Sorry the minimum value has been reached");
				}
			}else if(type == 'plus') {
				if(currentVal < input.attr('max')) {
					document.getElementById("sessionPerMonth").value = (currentVal + 4) +"<?PHP echo ' sessions' ?>";

					var RatePerHour = parseFloat('<?PHP echo $thisRate; ?>');
					var BilPelajar = parseFloat(document.getElementById("NoOfStudentsInput").value);
					var RateBilPelajar = parseFloat((BilPelajar - 1) * 10);
					
					firstDigitMF = document.getElementById("sessionDuration").value.substring(0, 1);
					secondDigitMF = document.getElementById("sessionDuration").value.substring(7, 9);
					if(secondDigitMF == '30'){
						valueDuration = parseFloat(firstDigitMF+'.'+'5');
					}else{
						valueDuration = parseFloat(firstDigitMF+'.'+'0');
					}
								
					var valueMonth = parseInt(document.getElementById("sessionPerMonth").value);
					var tick = document.getElementById("CheckboxnormalTuition").checked;
					if( valueMonth == '4' ){
						rateLess = 0;
						document.getElementById("subtotalDic").classList.add("hidden");
					}else{
						if(tick == false){
							rateLess = 5;
							document.getElementById("subtotalDic").classList.remove("hidden");
						}else{
							rateLess = 0;
							document.getElementById("subtotalDic").classList.add("hidden");
						}
					}
					
					var thisCheckbox = document.getElementById("CheckboxnormalTutor").checked;
					if(thisCheckbox == true){
						normalSchoolTutor = 10;
					}else{
						normalSchoolTutor = 0;
					}
					
						document.getElementById("normalTutorInput").value = 'RM '+((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess)+' / hour';
						document.getElementById("monthlyFeeOutput").innerHTML = "<strong> RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" / month</strong>";
						if( BilPelajar > 1){
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.remove("hidden");
						}else{
							document.getElementById("pricePerStudent").innerHTML = "<b> (RM " + parseFloat( (( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) / BilPelajar) ).toFixed(2) +" / student)</b> ";
							document.getElementById("pricePerStudent").classList.add("hidden");
						}
						document.getElementById("NoOfStudentsInput").value = BilPelajar;
						
						var thisCheckbox = document.getElementById("CheckboxnormalTuition").checked;
						if(thisCheckbox == true){
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").hide();
							$("#textOnlineTuition").show();        
						}else{
							document.getElementById("subtotalDic").innerHTML = 'RM '+( (((RatePerHour + normalSchoolTutor + RateBilPelajar)) * valueDuration) * valueMonth )+'<br>(price without discount)';
							$("#textNormalTuition").show();
							$("#textOnlineTuition").hide();   
						}
						document.getElementById("subtotal").innerHTML = "RM "+ ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) +" ";
								
						document.getElementById("registrationFeeOutput").innerHTML = "+ RM " + (BilPelajar * 50);
						document.getElementById("totalOutput").innerHTML = "<strong style='color: #3C763D;'>RM "+ ( ( (((RatePerHour + normalSchoolTutor + RateBilPelajar) - rateLess) * valueDuration) * valueMonth ) + (BilPelajar * 50) ) +"</strong>";
										
				}
				if(currentVal == '16') {
					alert("Sorry the maximum value has been reached");
				}
			}
		}

    } else {
        input.val(0);
    }
*/
});

$(".input-number").keydown(function (e) {
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
		(e.keyCode == 65 && e.ctrlKey === true) || 
		(e.keyCode >= 35 && e.keyCode <= 39)) {
		return;
	}
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
});
	
	
function loadDiscount() {
}

tippy('[data-tippy-content]',{
    placement: 'bottom',
    allowHTML: true,
});
/*
tippy('#myButton', {
  content: "I'm a Tippy tooltip!",
});*/
</script>