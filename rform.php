<?php 
require_once('includes/head.php');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();

if($deviceIs == "desktop"){
    if($getLan == "/my/"){	
        $width = "width:80%";
        $padding = "padding-left:20%";
        
        //$padding2 = "margin-left:23px;";
        $padding2 = "margin-left:27px;";
        
        $label = "margin-left:15px;";
        
        //$label2 = "margin-left:50px;";
        //$label3 = "margin-left:54px";
        $label2 = "margin-left:54px;";
        $label3 = "margin-left:58px";
        
    }else{
        $width = "width:85%";
        $padding = "padding-left:20%";
        $padding2 = "margin-left:23px;";
        $label = "margin-left:15px;";
        $label2 = "margin-left:50px;";
        $label3 = "margin-left:54px";
    }
}else{
    if($getLan == "/my/"){	
        $width = "width:230px";
        $padding = "";
        
        //$padding2 = "";
        $padding2 = "margin-left:4px;";
        
        $label = "margin-left:15px;";
        
        //$label2 = "margin-left:18px;";
        //$label3 = "margin-left:20px";
        $label2 = "margin-left:22px;";
        $label3 = "margin-left:24px";
        
    }else{
        $width = "width:260px";
        $padding = "";
        $padding2 = "";
        $label = "margin-left:15px;";
        $label2 = "margin-left:18px;";
        $label3 = "margin-left:20px";
    }
}


if (count($_POST) > 0) {
  $data = $_POST;
  $error = 0;
  if ($error == 0) {
    $output = system::FireCurl(RFORM, "POST", "JSON", $data);
    /*if ($output->flag == 'success') {
        Session::SetFlushMsg($output->flag, $output->message);
    } else {
        Session::SetFlushMsg($output->flag, $output->message);
    }*/
  }
}


//include('includes/header.php');
?>
<?PHP

$Cek = " SELECT displayid FROM tk_rform WHERE displayid = '".$_GET['token']."' "; 
$resultCek = $conn->query($Cek); 
if($resultCek->num_rows > 0){
    $hidden = '';
}else{
    $hidden = 'hidden';
}

  
  
if($getLan == "/my/"){	
    $titleURL = 'PENDAFTARAN TUISYEN';
    $titleURL2 = 'Mohon Tuan/Puan dapat lengkapkan borang ini untuk rekod kami. Terima kasih.';
    $Required = 'Diperlukan';
    
    $male = 'Lelaki';
    $female = 'Perempuan'; 
    $Other = 'Lain-Lain';
    $father = 'Bapa';
    $mother = 'Ibu';
    
    $studentURL = '1. Nama pelajar *';
    $genderURL = '2. Jantina pelajar *';
    $addressURL = '2. Alamat rumah *';
    $schoolURL = '3. Nama sekolah pelajar *';
    $relationURL = '4. Hubungan anda dengan pelajar *';
    $occupationURL = '5. Pekerjaan anda *';
    $dobURL = '6. Tarikh lahir anda';
    $knowURL = '7. Dimanakah anda dapat tahu tentang TutorKami? *';
    $yourName = '8. Nama anda';
    
    $thisLang = 'BM';
    
    $info = 'Anda sudah mengisi borang ini';
    $placeholder = "Sekiranya lebih daripada 1 pelajar, sila isi nama dan jantina setiap pelajar";
    
    $Q1andQ2 = '1. Nama pelajar & Jantina *';
    $tooltip = 'Sila tekan butang ini jika ada lebih dari 1 pelajar';
}else{
    $titleURL = 'TUITION REGISTRATION';
    $titleURL2 = 'Appreciate that you can fill in this form for our record. Thank you';
    $Required = 'Required';
    
    $male = '&nbsp;&nbsp;Male';
    $female = '&nbsp;&nbsp;Female'; 
    $Other = 'Other';
    $father = 'Father';
    $mother = 'Mother';
    
    $studentURL = '1. Student’s name *';
    $genderURL = '2. Student’s gender *';
    $addressURL = '2. Home address *';
    $schoolURL = '3. Name of student’s school *';
    $relationURL = '4. Your relationship with the student *';
    $occupationURL = '5. Your occupation *';
    $dobURL = '6. Your date of birth';
    $knowURL = '7. How did you get to know about TutorKami? *';
    $yourName = '8. Your Name';
    
    $thisLang = 'EN';
    
    $info = 'You have already filled in the form';
    $placeholder = "If more than 1 student, please fill in the field above with each student's name and gender";
    
    $Q1andQ2 = '1. Student’s name & gender *';
    $tooltip = 'Please click this button if there’s more than 1 student';
}

?>
<html class="no-js" lang="en">
<head>
    <title><?PHP echo $titleURL; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"></link>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<script src="https://use.fontawesome.com/7280c0ef17.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">
  <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.js"></script>
  <script src="https://fengyuanchen.github.io/datepicker/js/main.js"></script>   -->
  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
  <link rel="stylesheet" href="https://www.tutorkami.com/css/balloon.min.css">
  
    <style>
        body {
            /*background: #EECDA3;
            background: -webkit-linear-gradient(to top, #EF629F, #EECDA3);
            background: linear-gradient(to top, #EF629F, #EECDA3);*/
        }

        .container {
            max-width: 750px;
        }

        .has-error label,
        .has-error input,
        .has-error textarea {
            color: red;
            border-color: red;
        }

        .list-unstyled li {
            font-size: 13px;
            padding: 4px 0 0;
            color: red;
        }
.no-border {
    border-top: 0;
    border-left: 0;
    border-right: 0;
    box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    border-bottom: 1px solid black
}
.form-group input:focus{
     outline:0px !important; 
     box-shadow: none !important;
  }


    input[type='radio']:after {
        width: 17px;
        height: 17px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='radio']:checked:after {
        width: 17px;
        height: 17px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #f1592a;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='checkbox']:after {
        width: 17px;
        height: 17px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='checkbox']:checked:after {
        width: 17px;
        height: 17px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #f1592a;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
    
::-webkit-input-placeholder {
   font-size: 25px;
}

:-moz-placeholder { /* Firefox 18- */
      font-size: 25px;
}

::-moz-placeholder {  /* Firefox 19+ */
      font-size: 25px;
}

/* Overriding styles */

::-webkit-input-placeholder {
   font-size: 13px!important;
}

:-moz-placeholder { /* Firefox 18- */
      font-size: 13px!important;
}
::-moz-placeholder {  /* Firefox 19+ */
      font-size: 13px!important;
}
.hidden {
   display: none;
}

.btn-orange { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-orange:hover, 
.btn-orange:focus, 
.btn-orange:active, 
.btn-orange.active, 
.open .dropdown-toggle.btn-orange { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-orange:active, 
.btn-orange.active, 
.open .dropdown-toggle.btn-orange { 
  background-image: none; 
} 
 
.btn-orange.disabled, 
.btn-orange[disabled], 
fieldset[disabled] .btn-orange, 
.btn-orange.disabled:hover, 
.btn-orange[disabled]:hover, 
fieldset[disabled] .btn-orange:hover, 
.btn-orange.disabled:focus, 
.btn-orange[disabled]:focus, 
fieldset[disabled] .btn-orange:focus, 
.btn-orange.disabled:active, 
.btn-orange[disabled]:active, 
fieldset[disabled] .btn-orange:active, 
.btn-orange.disabled.active, 
.btn-orange[disabled].active, 
fieldset[disabled] .btn-orange.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-orange .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}
</style>
</head>

<body>

      <!--<script src="js/jquery.min.js"></script> -->

      <script type="text/javascript" src="js/jquery.validate.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
            
          if (window.location.href.indexOf("my") > -1) { 
              var details = '- Perincian ini diperlukan';
          }else{
              var details = '- This detail is required';
          }
            
            
          $('#registration-form').validate({
            errorClass: 'testing',
            rules: {
             'Studentname' : { required:true },
             'gender'      : { required:true },
             'Homeaddress' : { required:true },
             'school'      : { required:true },
             'Relation'    : { required:true },
             'occupation'  : { required:true },
             'date'        : { required:false},
             'know'        : { required:true },
             
             'hiddentoolsname2' : {
                  required: function() {
                  var v = $("input:radio[name='know']:checked").val();
                     if (v == 'Other'){
                         return true;
                     }else{
                         return false;
                     }
                  }
             }
             
             
            },
              invalidHandler: function(form, validator) {
                       var errors = validator.numberOfInvalids();
                        if (errors) {
                            var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';
                        }
              },
            errorPlacement: function (error, element) {
                if ( (element.attr("name") == "Studentname") ) { error.appendTo("#messageBoxFirst"); }
                if ( (element.attr("name") == "gender") )      { error.appendTo("#messageBoxGender"); }
                if ( (element.attr("name") == "Homeaddress") ) { error.appendTo("#messageBoxAddress"); }
                if ( (element.attr("name") == "school") )      { error.appendTo("#messageBoxSchool"); }
                if ( (element.attr("name") == "Relation") )    { error.appendTo("#messageBoxRelationship"); }
                if ( (element.attr("name") == "occupation") )  { error.appendTo("#messageBoxOccupation"); }
                if ( (element.attr("name") == "date") )        { error.appendTo("#messageBoxDate"); }
                if ( (element.attr("name") == "know") )        { error.appendTo("#messageBoxKnow"); }
                if ( (element.attr("name") == "hiddentoolsname2") ) { error.appendTo("#messageBoxKnow"); }
            },
            messages: {
             'Studentname' : details,
             'gender'      : details,
             'Homeaddress' : details,
             'school'      : details,
             'Relation'    : details,
             'occupation'  : details,
             'date'        : details,
             'know'        : details,
             'hiddentoolsname2'        : details
            }
          });

        });
      </script> 

<style>
.this label {
  /*margin: 2em;*/
  display: inline-block;
  position: relative;
  padding-left: 30px;
  cursor: pointer;
  font-weight:normal;
  font-size:15px;
}

/*.this input  {*/
.this input[type="radio"]  {
  height: 1px;
  width: 1px;
  opacity: 0;
}

.this input[type="checkbox"]  {
  height: 1px;
  width: 1px;
  opacity: 0;
}

.outside {
  display: inline-block;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -10px;
  width: 20px;
  height: 20px;
  border: 2px solid #7C7674;
  border-radius: 50%;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  background: none;
}

.inside {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  display: inline-block;
  border-radius: 50%;
  width: 10px;
  height: 10px;
  background: #7C7674;
  left: 3px;
  top: 3px;
  -webkit-transform: scale(0, 0);
          transform: scale(0, 0);
}


input:checked + .outside .inside {
  -webkit-animation: radio-select 0.1s linear;
          animation: radio-select 0.1s linear;
  -webkit-transform: scale(1, 1);
          transform: scale(1, 1);
}

.btn-plus {
    padding: 1px 6px;
    font-size: 14px;
    border-radius: 3px;
}
</style>


    <div class="container mt-5">
        <center><a href="index.php"><img src="images/logo.png" class="img-responsive" alt="Search for Private Tutor, Online or Home Tuition & Tuisyen in Malaysia"/></a></center><br/>
        <div class="card">

            <h5 class="card-header text-center"><?PHP echo $titleURL; ?></h5>
            <div class="card-body">
            <?PHP
                if( !$_GET['token'] && $_GET['token'] == '' ){
                    echo '<div class="alert alert-danger" role="alert">Error!! Something Wrong Happened.</div>';
                    exit();
                }else{
                    if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
                    	$query = $conn->query("SELECT displayid FROM tk_rform WHERE displayid = '".$_GET['token']."' ");
                    	$res = $query->num_rows;
                    	if($res > 0){
                    	    /*echo '<div class="alert alert-info" role="alert"><center> '.$info.' <center> </div>';
                    	    echo ' <center><a href="index.php" type="button" class="btn btn-orange btn-sm">OK</a> </center>';
                    	    exit();*/
                    	}                        
                    }
                }
                
                if ($output->flag == 'success') {
                    if($getLan == "/my/"){	
                        echo '<div class="alert alert-success" role="alert">Pendaftaran anda telah diterima. Terima kasih.</div>';
                    }else{
                        echo '<div class="alert alert-success" role="alert">'.$output->message.'</div>';
                    }
                    $hide = 'hidden';
                }else if($output->flag == 'error' ){
                    echo '<div class="alert alert-danger" role="alert">'.$output->message.'</div>';
                    $hide = '';
                }else{
                    $hide = '';
                }
            ?>


                 
                <form class="form-horizontal <?PHP echo $hide; ?>" method="post" enctype="multipart/form-data" id="registration-form">
                    
                    <p><b><?PHP echo $titleURL2; ?></b></p>
                  
                    <p style="color:#FFC107;"><b>*<?PHP echo $Required;?></b></p>

                    <input type="hidden" name="token" id="token" value="<?PHP echo $_GET['token'];?>">
                    <input type="hidden" name="lang" id="lang" value="<?PHP echo $thisLang;?>">
<!--
                    <div class="form-group">
                        <label><?PHP echo $studentURL; ?></label>
                        <span id="messageBoxFirst" style="color:#943243;font-weight: bold;"></span>
                        <input type="text" class="form-control no-border" id="Studentname" name="Studentname" >
                    </div><br/>

                    <div class="form-group">
                        <label id="label"><?PHP echo $genderURL; ?></label>
                        <span id="messageBoxGender" style="color:#943243;font-weight: bold;"></span>
                        <div class="this">
                            <label><input type="radio" class="" name="gender" value="Male" ><span class="outside"><span class="inside"></span></span><?PHP echo $male; ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" class="" name="gender" value="Female" ><span class="outside"><span class="inside"></span></span><?PHP echo $female; ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" class="radio-inline" id="gender3" name="gender" value="Other" ><span class="outside"><span class="inside"></span></span><?PHP echo $Other; ?> :</label>
                            <input onclick="thisfun();" style="border-bottom: 1px solid black;<?PHP echo $width; ?>" type="text" class="no-border" name="genderOther" id="genderOther" placeholder="" />
                        </div><span style="font-size:12px;font-style:italic;"> * <?PHP echo $placeholder; ?></span>
                    </div><br/>
-->

                    <div class="form-group">
                        <label><?PHP echo $Q1andQ2; ?> &nbsp;&nbsp;&nbsp;<button onclick="thisBtn();" data-balloon-length="large" aria-label="<?PHP echo $tooltip; ?>" data-balloon-pos="down" data-balloon-break type="button" class="btn-plus btn btn-primary">+</button>
                        </label>
                        <span id="messageBoxFirst" style="color:#943243;font-weight: bold;"></span>
                            <div class="row">
                              <div style="background-color:;" class="col">
                              </div>
                              <div style="<?PHP echo $padding; ?>" class="col">
                                  <label><?PHP echo $male; ?></label> <label style="<?PHP echo $padding2; ?>"><?PHP echo $female; ?></label>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col">
                                  <input type="text" class="form-control no-border" id="Studentname" name="Studentname" > <span style="display:inline-block;margin-top:-30px;margin-left:-5px;"> i. </span>
                              </div>
                              <div style="<?PHP echo $padding; ?>" class="col">
                                                    <div class="this" style="margin-top:8px;">
                                                        <label style="<?PHP echo $label; ?>" ><input type="radio" class="" name="gender" value="Male" ><span class="outside"><span class="inside"></span></span></label>
                                                        <label style="<?PHP echo $label2; ?>" ><input type="radio" class="" name="gender" value="Female" ><span class="outside"><span class="inside"></span></span></label>
                                                    </div>
                                                    <span id="messageBoxGender" style="color:#943243;font-weight: bold;"></span>
                              </div>
                            </div>

                            <span id="table-body" ></span>
                            <input type="hidden" id="table-bodyV" name="table-bodyV" >
                    </div><br/>
                    
                    <div class="form-group">
                        <label><?PHP echo $addressURL; ?></label>
                        <span id="messageBoxAddress" style="color:#943243;font-weight: bold;"></span>
                        <input type="text" class="form-control no-border" id="Homeaddress" name="Homeaddress" >
                    </div><br/>
                    
                    <div class="form-group">
                        <label><?PHP echo $schoolURL; ?></label>
                        <span id="messageBoxSchool" style="color:#943243;font-weight: bold;"></span>
                        <input type="text" class="form-control no-border" id="school" name="school" >
                    </div><br/>

                    <div class="form-group">
                        <label id="label"><?PHP echo $relationURL; ?></label>
                        <span id="messageBoxRelationship" style="color:#943243;font-weight: bold;"></span>
                        <div class="this">
                            <label><input type="radio" class="" name="Relation" value="Father" ><span class="outside"><span class="inside"></span></span><?PHP echo $father; ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" class="" name="Relation" value="Mother" ><span class="outside"><span class="inside"></span></span><?PHP echo $mother; ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" class="radio-inline" id="Relation3" name="Relation" value="Other" ><span class="outside"><span class="inside"></span></span><?PHP echo $Other; ?> :</label>
                            <input onclick="thisfun2();" style="border-bottom: 1px solid black;<?PHP echo $width; ?>" type="text" class="no-border" name="otherRelation" id="otherRelation" placeholder="" />
                        </div>
                    </div><br/>
                    
                    <div class="form-group">
                        <label><?PHP echo $occupationURL; ?></label>
                        <span id="messageBoxOccupation" style="color:#943243;font-weight: bold;"></span>
                        <input type="text" class="form-control no-border" id="occupation" name="occupation" >
                    </div><br/>

                    <div class="form-group">
                        <label><?PHP echo $dobURL; ?></label>
                        <span id="messageBoxDate" style="color:#943243;font-weight: bold;"></span>
                        <input type="text" oninput="validateDate(this.value);" class="form-control no-border" id="date" name="date" placeholder="dd/mm/yyyy" data-inputmask-regex="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$" >
                          <!--<div class="col-sm-6" style="margin-left:-20px;">
                              <div class="input-group">
                                <div class="input-group-append">
                                  <button style="background-color:#E8E8E8" type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled>
                                    <i style="color:black" class="fa fa-calendar fa-fw" aria-hidden="true"></i>
                                  </button>
                                </div>
                                <input type="text" class="form-control docs-date dateCheckbox" name="date" id="date" placeholder="Pick a date" autocomplete="off">
                              </div>
                          </div>-->
                    </div><br/>

                    <div class="form-group">
                        <label id="label"><?PHP echo $knowURL; ?></label>
                        <span id="messageBoxKnow" style="color:#943243;font-weight: bold;"></span>
                        <div class="this">
                            <label><input type="radio" onchange="handleChange1();" name="know" value="FB Ads" ><span class="outside"><span class="inside"></span></span><?PHP if($getLan == "/my/"){ echo 'Dari iklan TutorKami.com di Facebook'; }else{ echo 'From TutorKami.com advertisement in Facebook'; } ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" onchange="handleChange1();" name="know" value="FB" ><span class="outside"><span class="inside"></span></span><?PHP if($getLan == "/my/"){ echo 'Dari perkongsian di Facebook'; }else{ echo 'From a sharing in Facebook'; } ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" onchange="handleChange1();" name="know" value="SEO" ><span class="outside"><span class="inside"></span></span><?PHP if($getLan == "/my/"){ echo 'Mencari di Google dan menjumpai laman web TutorKami.com'; }else{ echo 'Searched at Google and found TutorKami.com website'; } ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" onchange="handleChange1();" name="know" value="Google Ads" ><span class="outside"><span class="inside"></span></span><?PHP if($getLan == "/my/"){ echo 'Dari iklan TutorKami.com di Google'; }else{ echo 'From TutorKami.com advertisement at Google'; } ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" onchange="handleChange1();" name="know" value="Client's referral" ><span class="outside"><span class="inside"></span></span><?PHP if($getLan == "/my/"){ echo 'Dari keluarga, rakan atau kenalan'; }else{ echo 'From a family,friend or acquaintance'; } ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" onchange="handleChange1();" name="know" value="Student's referral" ><span class="outside"><span class="inside"></span></span><?PHP if($getLan == "/my/"){ echo 'Dari rakan atau kenalan pelajar'; }else{ echo 'From the student friend or acquaintance'; } ?></label>
                        </div>
                        <div class="this">
                            <label><input type="radio" onchange="handleChange1();" id="know3" name="know" value="Other" ><span class="outside"><span class="inside"></span></span><?PHP echo $Other; ?> :</label>
                            <input onclick="thisfun3();" oninput="oninput22(this.value)" style="border-bottom: 1px solid black;<?PHP echo $width; ?>" type="text" class="no-border" name="otherNo" id="otherNo" placeholder="" />
                        <input style="width: 2px;border:none;background-color:#f3f3f5;color:#f3f3f5" type="text" id="hiddentoolsname2" name="hiddentoolsname2" value="">
                        </div>
                        <input style="width:100%" type="hidden" id="hiddentoolsname1" name="hiddentoolsname1" value="">
                    </div><br/>
                    
                    <div class="form-group <?PHP echo $hidden; ?>">
                        <label><?PHP echo $yourName; ?></label>
                        <span id="messageBoxName" style="color:#943243;font-weight: bold;"></span>
                        <input type="text" class="form-control no-border" id="Parentname" name="Parentname" >
                    </div><br/>
                    

                    <div class="form-group">
                        <button type="submit" class="btn btn-orange btn-block"><?PHP if($getLan == "/my/"){ echo 'Hantar'; }else{ echo 'Send'; } ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>


<script>
/*
$('#date').datepicker({
    format: 'dd/mm/yyyy',
});*/
function thisfun(){
    document.getElementById("gender3").checked = true;
}  
function thisfun2(){
    document.getElementById("Relation3").checked = true;
}  
function thisfun3() {
    /*if (document.getElementById('know3').checked) {
        document.getElementById("know3").checked = false;
    } else {
        document.getElementById("know3").checked = true;
    }*/
    document.getElementById("know3").checked = true;
    
}

function oninput22(thisV) {
    document.getElementById("hiddentoolsname2").value = thisV;
}

$(".genderCheckbox").click(function () {
    document.getElementById("label").style.color = "black";
});
$(".relationshipCheckbox").click(function () {
    document.getElementById("label2").style.color = "black";
});
$(".dateCheckbox").click(function () {
    document.getElementById("label3").style.color = "black";
});
$(".knowCheckbox").click(function () {
    document.getElementById("label4").style.color = "black";
});

function handleChange1() {
	var favorite = [];
	$.each($("input[name='know']:checked"), function(){            
		favorite.push($(this).val());
	});
	document.getElementById("hiddentoolsname1").value = favorite.join(", ");
}


$(document).ready(function(){
    $(":input").inputmask();
    /*$("#date").inputmask({
    mask: '99/99/9999',
    placeholder: ' ',
    showMaskOnHover: false,
    showMaskOnFocus: false,
    onBeforePaste: function (pastedValue, opts) {
    var processedValue = pastedValue;
    
    //do something with it
    
    return processedValue;
    }
    });*/
});

function validateDate(value2) {
    var today = new Date();
    var yyyy = today.getFullYear().toString().substr(-2);
    
    var result = /[^/]*$/.exec(value2)[0];
    
    if(/\d{4}/.test(result)){
        if( result < '1900' ){
            alert('The year is not a valid number ');
        }   
        if( result > '20'+yyyy ){
            alert('The year is not a valid number ');
        }             
    }
}

function thisGender(ID,val) {
    thenum = ID.match(/\d+/)[0] // "3"
    if(ID.includes("M")){
        document.getElementById('genderF'+thenum).checked = false;
    }else{
        document.getElementById('genderM'+thenum).checked = false;
    }
}
var xxx=0;
var number=1;
function thisBtn(){
    xxx++;
    number++;
    var timer = null;
    clearTimeout(timer);
    timer = setTimeout(function(){
        var data = ' <div class="row"><div style="background-color:;" class="col"></div><div style="<?PHP echo $padding; ?>" class="col"><label></label> <label style="<?PHP echo $padding2; ?>"></label></div></div>' +
'<div class="row"><div class="col"><input type="text" class="form-control no-border" name="Studentname'+xxx+'" > <span style="display:inline-block;margin-top:-30px;margin-left:-5px;"> ' + romanize(number) + ' </span> </div>' +
  '<div class="col" style="<?PHP echo $padding; ?>">' +
                        '<div class="this" style="margin-top:20px;">' +
                            '<label style="<?PHP echo $label; ?>" ><input onclick="thisGender(this.id,this.value);" id="genderM'+xxx+'" type="checkbox" class="" name="gender'+xxx+'" value="Male" ><span class="outside"><span class="inside"></span></span></label>' +
                            '<label style="<?PHP echo $label3; ?>" ><input onclick="thisGender(this.id,this.value);" id="genderF'+xxx+'"type="checkbox" class="" name="gender'+xxx+'" value="Female" ><span class="outside"><span class="inside"></span></span></label>' +
                        '</div>' +
  '</div>' +
'</div>';
        $("#table-body").append(data);
        document.getElementById("table-bodyV").value = xxx;
    }, 100);
}

function romanize (num) {
    if (isNaN(num))
        return NaN;
    var digits = String(+num).split(""),
        key = ["","c","cc","ccc","cd","d","dc","dcc","dccc","cm",
               "","x","xx","xxx","xl","l","lx","lxx","lxxx","xc",
               "","i.","ii.","iii.","iv.","v.","vi.","vii.","viii.","ix."],
        roman = "",
        i = 3;
    while (i--)
        roman = (key[+digits.pop() + (i * 10)] || "") + roman;
    return Array(+digits.join("") + 1).join("M") + roman;
}
</script>