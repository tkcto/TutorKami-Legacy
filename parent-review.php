<?php 

require_once('includes/head.php');



if (isset($_GET['tutor_id']) && $_GET['tutor_id'] > 0) {

  $_SESSION['rating']['tutor_id'] = $_GET['tutor_id'];

}

if (isset($_GET['parent_id']) && $_GET['parent_id'] > 0) {

  $_SESSION['rating']['parent_id'] = $_GET['parent_id'];

}



if (count($_POST) > 0) {

  if(isset($_POST['currentstep']) && $_POST['currentstep'] != '') {

    $_SESSION['rating'][$_POST['currentstep']] = $_POST;

  }



  if (isset($_POST['nextstep']) && $_POST['nextstep'] != '') {    

    header('Location: parent-review.php?step='.$_POST['nextstep']);

    exit();

  } else{

    $output = system::FireCurl(REVIEW_TUTOR_URL, "POST", "JSON", $_SESSION['rating']);

    // Session::SetFlushMsg($output->flag, $output->message);

    unset($_SESSION['rating']);

    header('Location: parent-review.php?step=4');

    exit();

  }

}

if (isset($_SESSION['rating']['tutor_id'])) {

  $getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$_SESSION['rating']['tutor_id']);

}  

$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 

include('includes/header.php');

?>

<section class="parent_rating">

   <div class="container">

      <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-10">

         <h1 class="blue-txt"> <?php echo RATE_REVIEW; ?></h1>

         <hr>

         <?php 

          if( isset($getUserDetails) && count($getUserDetails->data) == 0 && $_GET['step'] != 4) {

            include('includes/review_error.php');

          } else {

            if (isset($_GET['step']) && $_GET['step'] > 0) {

              if ($_GET['step'] == 1) {

                //include('includes/review_step_1.php'); 
			
/* START */
?>					

			
	<!-- CSS Files https://demos.creative-tim.com/paper-bootstrap-wizard/wizard-create-profile.html 
	<link href="https://demos.creative-tim.com/paper-bootstrap-wizard/assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />-->
<style>
/*
.form-control::-moz-placeholder {
  color: rgba(0, 0, 0, 0.2);
}

.form-control:-moz-placeholder {
  color: rgba(0, 0, 0, 0.2);
}

.form-control::-webkit-input-placeholder {
  color: rgba(0, 0, 0, 0.2);
}

.form-control:-ms-input-placeholder {
  color: rgba(0, 0, 0, 0.2);
}

.form-control {
  background-color: #F3F2EE;
  border: 1px solid #e8e7e3;
  border-radius: 4px;
  color: #66615b;
  font-size: 14px;
  padding: 7px 18px;
  height: 40px;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.form-control:focus {
  border: 1px solid #e8e7e3;
  background-color: #FFFFFF;
  -webkit-box-shadow: none;
  box-shadow: none;
  outline: 0 !important;
}
.has-success .form-control, .has-error .form-control, .has-success .form-control:focus, .has-error .form-control:focus {
  -webkit-box-shadow: none;
  box-shadow: none;
}
.has-error .form-control, .form-control.error {
  background-color: #FFC0A4;
  color: #EB5E28;
  border-color: #EB5E28;
}
.has-success .form-control, .form-control.valid {
  color: #66615b;
  border-color: #e8e7e3;
}
.has-error .form-control:focus, .form-control.error:focus {
  background-color: #FFFFFF;
  border-color: #EB5E28;
}
.has-success .form-control:focus, .form-control.valid:focus {
  background-color: #FFFFFF;
  border-color: #7AC29A;
}*/
.form-control + .form-control-feedback {
  border-radius: 6px;
  font-size: 14px;
  margin-top: -7px;
  position: absolute;
  right: 10px;
  top: 50%;
  vertical-align: middle;
}
.open .form-control {
  border-bottom-color: transparent;
}
.form-control.input-no-border {
  border: 0 none;
}
.input-group .form-control:not(:first-child):not(:last-child) {
  border-left: 0;
  border-right: 0;
}

label.error:not(.form-control) {
  color: #EB5E28;
  font-weight: 300;
  font-size: 0.8em;
}

.input-lg {
  height: 55px;
  padding: 11px 30px;
}

.has-error .form-control-feedback, .has-error .control-label {
  color: #EB5E28;
}

.has-success .form-control-feedback, .has-success .control-label {
  color: #7AC29A;
}

.input-group-addon {
  background-color: #F3F2EE;
  border: 1px solid #e8e7e3;
  border-radius: 4px;
}
.has-success .input-group-addon, .has-error .input-group-addon {
  background-color: #FFFFFF;
}
.has-error .form-control:focus + .input-group-addon {
  color: #EB5E28;
}
.has-success .form-control:focus + .input-group-addon {
  color: #7AC29A;
}
.form-control:focus + .input-group-addon, .form-control:focus ~ .input-group-addon {
  background-color: #FFFFFF;
}
.has-error .input-group-addon {
  color: #EB5E28;
  border-color: #EB5E28;
}
.has-error .input-group-addon {
  color: #7AC29A;
  border-color: #7AC29A;
}
.input-group-addon + .form-control {
  padding-left: 0;
}

.input-group {
  margin-bottom: 15px;
}

.input-group[disabled] .input-group-addon {
  background-color: #E3E3E3;
}

.input-group .form-control:first-child,
.input-group-addon:first-child,
.input-group-btn:first-child > .dropdown-toggle,
.input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle) {
  border-right: 0 none;
}

.input-group .form-control:last-child,
.input-group-addon:last-child,
.input-group-btn:last-child > .dropdown-toggle,
.input-group-btn:first-child > .btn:not(:first-child) {
  border-left: 0 none;
}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
  background-color: #E3E3E3;
  cursor: not-allowed;
  color: #9A9A9A;
  opacity: 1;
  filter: alpha(opacity=100);
}

.form-control[disabled]::-moz-placeholder {
  color: #9A9A9A;
  opacity: 1;
  filter: alpha(opacity=100);
}

.form-control[disabled]:-moz-placeholder {
  color: #cfcfca;
  opacity: 1;
  filter: alpha(opacity=100);
}

.form-control[disabled]::-webkit-input-placeholder {
  color: #cfcfca;
  opacity: 1;
  filter: alpha(opacity=100);
}

.form-control[disabled]:-ms-input-placeholder {
  color: #cfcfca;
  opacity: 1;
  filter: alpha(opacity=100);
}

.input-group-btn .btn {
  border-width: 1px;
  padding: 9px 18px;
}

.input-group-btn .btn-default:not(.btn-fill) {
  border-color: #cfcfca;
}

.input-group-btn:last-child > .btn {
  margin-left: 0;
}

textarea.form-control {
  max-width: 100%;
  padding: 10px 18px;
  resize: none;
}

.input-group-focus .input-group-addon {
  background-color: #FFFFFF;
}

/*     General overwrite     */
/*
body {
  color: #66615b;
  font-size: 14px;
  font-family: 'Muli', Arial, sans-serif;
}

a {
  color: #2CA8FF;
}

a:hover, a:focus {
  color: #109CFF;
}
*/

a:focus, a:active,
button::-moz-focus-inner,
input[type="reset"]::-moz-focus-inner,
input[type="button"]::-moz-focus-inner,
input[type="submit"]::-moz-focus-inner,
select::-moz-focus-inner,
input[type="file"] > input[type="button"]::-moz-focus-inner,
input[type="button"]:focus {
  outline: 0 !important;
}

.btn:focus,
.btn:hover,
.btn:active {
  outline: 0;
}

/*           Animations              */
.form-control, .input-group-addon {
  -webkit-transition: all 300ms linear;
  -moz-transition: all 300ms linear;
  -o-transition: all 300ms linear;
  -ms-transition: all 300ms linear;
  transition: all 300ms linear;
}

.image-container {
  min-height: 100vh;
  background-position: center center;
  background-size: cover;
  position: relative;
}

.wizard-container {
  padding-top: 100px;
  z-index: 3;
}

.made-with-pk {
  width: 50px;
  height: 50px;
  display: block;
  position: fixed;
  z-index: 555;
  bottom: 40px;
  right: 40px;
  border-radius: 30px;
  background-color: rgba(16, 16, 16, 0.35);
  border: 1px solid rgba(255, 255, 255, 0.15);
  color: #FFFFFF;
  cursor: pointer;
  padding: 10px 12px;
  white-space: nowrap;
  overflow: hidden;
  -webkit-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  -moz-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  -o-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
}
.made-with-pk:hover, .made-with-pk:active, .made-with-pk:focus {
  width: 218px;
  color: #FFFFFF;
  transition-duration: .55s;
  padding: 10px 19px;
}
.made-with-pk:hover .made-with, .made-with-pk:active .made-with, .made-with-pk:focus .made-with {
  opacity: 1;
}
.made-with-pk .brand,
.made-with-pk .made-with {
  float: left;
}
.made-with-pk .brand {
  position: relative;
  top: 4px;
  letter-spacing: 1px;
  vertical-align: middle;
  font-size: 16px;
  font-weight: 600;
}
.made-with-pk .made-with {
  color: rgba(255, 255, 255, 0.6);
  position: absolute;
  left: 58px;
  top: 14px;
  opacity: 0;
  margin: 0;
  -webkit-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  -moz-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  -o-transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
  transition: 0.55s cubic-bezier(0.6, 0, 0.4, 1);
}
.made-with-pk .made-with strong {
  font-weight: 400;
  color: rgba(255, 255, 255, 0.9);
}

.col-sm-8 .col-sm-4 {
  padding-right: 6px;
  padding-left: 6px;
}
/*
.btn,
.navbar .navbar-nav > li > a.btn {
  border-radius: 20px;
  box-sizing: border-box;
  border-width: 2px;
  background-color: transparent;
  font-size: 14px;
  font-weight: 600;
  padding: 7px 18px;
  border-color: #66615B;
  color: #66615B;
  -webkit-transition: all 150ms linear;
  -moz-transition: all 150ms linear;
  -o-transition: all 150ms linear;
  -ms-transition: all 150ms linear;
  transition: all 150ms linear;
}
.btn:hover, .btn:focus, .btn:active, .btn.active, .btn:active:focus, .btn:active:hover, .open > .btn.dropdown-toggle, .open > .btn.dropdown-toggle:focus, .open > .btn.dropdown-toggle:hover,
.navbar .navbar-nav > li > a.btn:hover,
.navbar .navbar-nav > li > a.btn:focus,
.navbar .navbar-nav > li > a.btn:active,
.navbar .navbar-nav > li > a.btn.active,
.navbar .navbar-nav > li > a.btn:active:focus,
.navbar .navbar-nav > li > a.btn:active:hover, .open >
.navbar .navbar-nav > li > a.btn.dropdown-toggle, .open >
.navbar .navbar-nav > li > a.btn.dropdown-toggle:focus, .open >
.navbar .navbar-nav > li > a.btn.dropdown-toggle:hover {
  background-color: #66615B;
  color: rgba(255, 255, 255, 0.85);
  border-color: #66615B;
}
.btn:hover .caret, .btn:focus .caret, .btn:active .caret, .btn.active .caret, .btn:active:focus .caret, .btn:active:hover .caret, .open > .btn.dropdown-toggle .caret, .open > .btn.dropdown-toggle:focus .caret, .open > .btn.dropdown-toggle:hover .caret,
.navbar .navbar-nav > li > a.btn:hover .caret,
.navbar .navbar-nav > li > a.btn:focus .caret,
.navbar .navbar-nav > li > a.btn:active .caret,
.navbar .navbar-nav > li > a.btn.active .caret,
.navbar .navbar-nav > li > a.btn:active:focus .caret,
.navbar .navbar-nav > li > a.btn:active:hover .caret, .open >
.navbar .navbar-nav > li > a.btn.dropdown-toggle .caret, .open >
.navbar .navbar-nav > li > a.btn.dropdown-toggle:focus .caret, .open >
.navbar .navbar-nav > li > a.btn.dropdown-toggle:hover .caret {
  border-top-color: rgba(255, 255, 255, 0.85);
}
.btn.disabled, .btn.disabled:hover, .btn.disabled:focus, .btn.disabled.focus, .btn.disabled:active, .btn.disabled.active, .btn:disabled, .btn:disabled:hover, .btn:disabled:focus, .btn:disabled.focus, .btn:disabled:active, .btn:disabled.active, .btn[disabled], .btn[disabled]:hover, .btn[disabled]:focus, .btn[disabled].focus, .btn[disabled]:active, .btn[disabled].active, fieldset[disabled] .btn, fieldset[disabled] .btn:hover, fieldset[disabled] .btn:focus, fieldset[disabled] .btn.focus, fieldset[disabled] .btn:active, fieldset[disabled] .btn.active,
.navbar .navbar-nav > li > a.btn.disabled,
.navbar .navbar-nav > li > a.btn.disabled:hover,
.navbar .navbar-nav > li > a.btn.disabled:focus,
.navbar .navbar-nav > li > a.btn.disabled.focus,
.navbar .navbar-nav > li > a.btn.disabled:active,
.navbar .navbar-nav > li > a.btn.disabled.active,
.navbar .navbar-nav > li > a.btn:disabled,
.navbar .navbar-nav > li > a.btn:disabled:hover,
.navbar .navbar-nav > li > a.btn:disabled:focus,
.navbar .navbar-nav > li > a.btn:disabled.focus,
.navbar .navbar-nav > li > a.btn:disabled:active,
.navbar .navbar-nav > li > a.btn:disabled.active,
.navbar .navbar-nav > li > a.btn[disabled],
.navbar .navbar-nav > li > a.btn[disabled]:hover,
.navbar .navbar-nav > li > a.btn[disabled]:focus,
.navbar .navbar-nav > li > a.btn[disabled].focus,
.navbar .navbar-nav > li > a.btn[disabled]:active,
.navbar .navbar-nav > li > a.btn[disabled].active, fieldset[disabled]
.navbar .navbar-nav > li > a.btn, fieldset[disabled]
.navbar .navbar-nav > li > a.btn:hover, fieldset[disabled]
.navbar .navbar-nav > li > a.btn:focus, fieldset[disabled]
.navbar .navbar-nav > li > a.btn.focus, fieldset[disabled]
.navbar .navbar-nav > li > a.btn:active, fieldset[disabled]
.navbar .navbar-nav > li > a.btn.active {
  background-color: transparent;
  border-color: #66615B;
}
.btn.btn-fill,
.navbar .navbar-nav > li > a.btn.btn-fill {
  color: #FFFFFF;
  background-color: #66615B;
  opacity: 1;
  filter: alpha(opacity=100);
}
.btn.btn-fill:hover, .btn.btn-fill:focus, .btn.btn-fill:active, .btn.btn-fill.active, .open > .btn.btn-fill.dropdown-toggle,
.navbar .navbar-nav > li > a.btn.btn-fill:hover,
.navbar .navbar-nav > li > a.btn.btn-fill:focus,
.navbar .navbar-nav > li > a.btn.btn-fill:active,
.navbar .navbar-nav > li > a.btn.btn-fill.active, .open >
.navbar .navbar-nav > li > a.btn.btn-fill.dropdown-toggle {
  background-color: #484541;
  color: #FFFFFF;
  border-color: #484541;
}
.btn.btn-fill .caret,
.navbar .navbar-nav > li > a.btn.btn-fill .caret {
  border-top-color: #FFFFFF;
}
.btn.btn-simple:hover, .btn.btn-simple:focus, .btn.btn-simple:active, .btn.btn-simple.active, .open > .btn.btn-simple.dropdown-toggle,
.navbar .navbar-nav > li > a.btn.btn-simple:hover,
.navbar .navbar-nav > li > a.btn.btn-simple:focus,
.navbar .navbar-nav > li > a.btn.btn-simple:active,
.navbar .navbar-nav > li > a.btn.btn-simple.active, .open >
.navbar .navbar-nav > li > a.btn.btn-simple.dropdown-toggle {
  background-color: transparent;
  color: #484541;
}
.btn.btn-simple .caret,
.navbar .navbar-nav > li > a.btn.btn-simple .caret {
  border-top-color: #FFFFFF;
}
.btn .caret,
.navbar .navbar-nav > li > a.btn .caret {
  border-top-color: #66615B;
}
.btn:hover, .btn:focus,
.navbar .navbar-nav > li > a.btn:hover,
.navbar .navbar-nav > li > a.btn:focus {
  outline: 0 !important;
}
.btn:active, .btn.active, .open > .btn.dropdown-toggle,
.navbar .navbar-nav > li > a.btn:active,
.navbar .navbar-nav > li > a.btn.active, .open >
.navbar .navbar-nav > li > a.btn.dropdown-toggle {
  -webkit-box-shadow: none;
  box-shadow: none;
  outline: 0 !important;
}
.btn.btn-icon,
.navbar .navbar-nav > li > a.btn.btn-icon {
  border-radius: 25px;
  padding: 7px 10px;
}
.btn.btn-icon i,
.navbar .navbar-nav > li > a.btn.btn-icon i {
  margin-right: 0px;
}
.btn [class*="ti-"],
.navbar .navbar-nav > li > a.btn [class*="ti-"] {
  vertical-align: middle;
}

.btn-group .btn + .btn,
.btn-group .btn + .btn-group,
.btn-group .btn-group + .btn,
.btn-group .btn-group + .btn-group {
  margin-left: -2px;
}

.navbar .navbar-nav > li > a.btn.btn-primary, .btn-primary {
  border-color: #7A9E9F;
  color: #7A9E9F;
}
.navbar .navbar-nav > li > a.btn.btn-primary:hover, .navbar .navbar-nav > li > a.btn.btn-primary:focus, .navbar .navbar-nav > li > a.btn.btn-primary:active, .navbar .navbar-nav > li > a.btn.btn-primary.active, .navbar .navbar-nav > li > a.btn.btn-primary:active:focus, .navbar .navbar-nav > li > a.btn.btn-primary:active:hover, .open > .navbar .navbar-nav > li > a.btn.btn-primary.dropdown-toggle, .open > .navbar .navbar-nav > li > a.btn.btn-primary.dropdown-toggle:focus, .open > .navbar .navbar-nav > li > a.btn.btn-primary.dropdown-toggle:hover, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary:active:focus, .btn-primary:active:hover, .open > .btn-primary.dropdown-toggle, .open > .btn-primary.dropdown-toggle:focus, .open > .btn-primary.dropdown-toggle:hover {
  background-color: #7A9E9F;
  color: rgba(255, 255, 255, 0.85);
  border-color: #7A9E9F;
}
.navbar .navbar-nav > li > a.btn.btn-primary:hover .caret, .navbar .navbar-nav > li > a.btn.btn-primary:focus .caret, .navbar .navbar-nav > li > a.btn.btn-primary:active .caret, .navbar .navbar-nav > li > a.btn.btn-primary.active .caret, .navbar .navbar-nav > li > a.btn.btn-primary:active:focus .caret, .navbar .navbar-nav > li > a.btn.btn-primary:active:hover .caret, .open > .navbar .navbar-nav > li > a.btn.btn-primary.dropdown-toggle .caret, .open > .navbar .navbar-nav > li > a.btn.btn-primary.dropdown-toggle:focus .caret, .open > .navbar .navbar-nav > li > a.btn.btn-primary.dropdown-toggle:hover .caret, .btn-primary:hover .caret, .btn-primary:focus .caret, .btn-primary:active .caret, .btn-primary.active .caret, .btn-primary:active:focus .caret, .btn-primary:active:hover .caret, .open > .btn-primary.dropdown-toggle .caret, .open > .btn-primary.dropdown-toggle:focus .caret, .open > .btn-primary.dropdown-toggle:hover .caret {
  border-top-color: rgba(255, 255, 255, 0.85);
}
.navbar .navbar-nav > li > a.btn.btn-primary.disabled, .navbar .navbar-nav > li > a.btn.btn-primary.disabled:hover, .navbar .navbar-nav > li > a.btn.btn-primary.disabled:focus, .navbar .navbar-nav > li > a.btn.btn-primary.disabled.focus, .navbar .navbar-nav > li > a.btn.btn-primary.disabled:active, .navbar .navbar-nav > li > a.btn.btn-primary.disabled.active, .navbar .navbar-nav > li > a.btn.btn-primary:disabled, .navbar .navbar-nav > li > a.btn.btn-primary:disabled:hover, .navbar .navbar-nav > li > a.btn.btn-primary:disabled:focus, .navbar .navbar-nav > li > a.btn.btn-primary:disabled.focus, .navbar .navbar-nav > li > a.btn.btn-primary:disabled:active, .navbar .navbar-nav > li > a.btn.btn-primary:disabled.active, .navbar .navbar-nav > li > a.btn.btn-primary[disabled], .navbar .navbar-nav > li > a.btn.btn-primary[disabled]:hover, .navbar .navbar-nav > li > a.btn.btn-primary[disabled]:focus, .navbar .navbar-nav > li > a.btn.btn-primary[disabled].focus, .navbar .navbar-nav > li > a.btn.btn-primary[disabled]:active, .navbar .navbar-nav > li > a.btn.btn-primary[disabled].active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-primary, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-primary:hover, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-primary:focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-primary.focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-primary:active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-primary.active, .btn-primary.disabled, .btn-primary.disabled:hover, .btn-primary.disabled:focus, .btn-primary.disabled.focus, .btn-primary.disabled:active, .btn-primary.disabled.active, .btn-primary:disabled, .btn-primary:disabled:hover, .btn-primary:disabled:focus, .btn-primary:disabled.focus, .btn-primary:disabled:active, .btn-primary:disabled.active, .btn-primary[disabled], .btn-primary[disabled]:hover, .btn-primary[disabled]:focus, .btn-primary[disabled].focus, .btn-primary[disabled]:active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary, fieldset[disabled] .btn-primary:hover, fieldset[disabled] .btn-primary:focus, fieldset[disabled] .btn-primary.focus, fieldset[disabled] .btn-primary:active, fieldset[disabled] .btn-primary.active {
  background-color: transparent;
  border-color: #7A9E9F;
}
.navbar .navbar-nav > li > a.btn.btn-primary.btn-fill, .btn-primary.btn-fill {
  color: #FFFFFF;
  background-color: #7A9E9F;
  opacity: 1;
  filter: alpha(opacity=100);
}
.navbar .navbar-nav > li > a.btn.btn-primary.btn-fill:hover, .navbar .navbar-nav > li > a.btn.btn-primary.btn-fill:focus, .navbar .navbar-nav > li > a.btn.btn-primary.btn-fill:active, .navbar .navbar-nav > li > a.btn.btn-primary.btn-fill.active, .open > .navbar .navbar-nav > li > a.btn.btn-primary.btn-fill.dropdown-toggle, .btn-primary.btn-fill:hover, .btn-primary.btn-fill:focus, .btn-primary.btn-fill:active, .btn-primary.btn-fill.active, .open > .btn-primary.btn-fill.dropdown-toggle {
  background-color: #5e8283;
  color: #FFFFFF;
  border-color: #5e8283;
}
.navbar .navbar-nav > li > a.btn.btn-primary.btn-fill .caret, .btn-primary.btn-fill .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-primary.btn-simple:hover, .navbar .navbar-nav > li > a.btn.btn-primary.btn-simple:focus, .navbar .navbar-nav > li > a.btn.btn-primary.btn-simple:active, .navbar .navbar-nav > li > a.btn.btn-primary.btn-simple.active, .open > .navbar .navbar-nav > li > a.btn.btn-primary.btn-simple.dropdown-toggle, .btn-primary.btn-simple:hover, .btn-primary.btn-simple:focus, .btn-primary.btn-simple:active, .btn-primary.btn-simple.active, .open > .btn-primary.btn-simple.dropdown-toggle {
  background-color: transparent;
  color: #5e8283;
}
.navbar .navbar-nav > li > a.btn.btn-primary.btn-simple .caret, .btn-primary.btn-simple .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-primary .caret, .btn-primary .caret {
  border-top-color: #7A9E9F;
}

.navbar .navbar-nav > li > a.btn.btn-success, .btn-success {
  border-color: #7AC29A;
  color: #7AC29A;
}
.navbar .navbar-nav > li > a.btn.btn-success:hover, .navbar .navbar-nav > li > a.btn.btn-success:focus, .navbar .navbar-nav > li > a.btn.btn-success:active, .navbar .navbar-nav > li > a.btn.btn-success.active, .navbar .navbar-nav > li > a.btn.btn-success:active:focus, .navbar .navbar-nav > li > a.btn.btn-success:active:hover, .open > .navbar .navbar-nav > li > a.btn.btn-success.dropdown-toggle, .open > .navbar .navbar-nav > li > a.btn.btn-success.dropdown-toggle:focus, .open > .navbar .navbar-nav > li > a.btn.btn-success.dropdown-toggle:hover, .btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .btn-success:active:focus, .btn-success:active:hover, .open > .btn-success.dropdown-toggle, .open > .btn-success.dropdown-toggle:focus, .open > .btn-success.dropdown-toggle:hover {
  background-color: #7AC29A;
  color: rgba(255, 255, 255, 0.85);
  border-color: #7AC29A;
}
.navbar .navbar-nav > li > a.btn.btn-success:hover .caret, .navbar .navbar-nav > li > a.btn.btn-success:focus .caret, .navbar .navbar-nav > li > a.btn.btn-success:active .caret, .navbar .navbar-nav > li > a.btn.btn-success.active .caret, .navbar .navbar-nav > li > a.btn.btn-success:active:focus .caret, .navbar .navbar-nav > li > a.btn.btn-success:active:hover .caret, .open > .navbar .navbar-nav > li > a.btn.btn-success.dropdown-toggle .caret, .open > .navbar .navbar-nav > li > a.btn.btn-success.dropdown-toggle:focus .caret, .open > .navbar .navbar-nav > li > a.btn.btn-success.dropdown-toggle:hover .caret, .btn-success:hover .caret, .btn-success:focus .caret, .btn-success:active .caret, .btn-success.active .caret, .btn-success:active:focus .caret, .btn-success:active:hover .caret, .open > .btn-success.dropdown-toggle .caret, .open > .btn-success.dropdown-toggle:focus .caret, .open > .btn-success.dropdown-toggle:hover .caret {
  border-top-color: rgba(255, 255, 255, 0.85);
}
.navbar .navbar-nav > li > a.btn.btn-success.disabled, .navbar .navbar-nav > li > a.btn.btn-success.disabled:hover, .navbar .navbar-nav > li > a.btn.btn-success.disabled:focus, .navbar .navbar-nav > li > a.btn.btn-success.disabled.focus, .navbar .navbar-nav > li > a.btn.btn-success.disabled:active, .navbar .navbar-nav > li > a.btn.btn-success.disabled.active, .navbar .navbar-nav > li > a.btn.btn-success:disabled, .navbar .navbar-nav > li > a.btn.btn-success:disabled:hover, .navbar .navbar-nav > li > a.btn.btn-success:disabled:focus, .navbar .navbar-nav > li > a.btn.btn-success:disabled.focus, .navbar .navbar-nav > li > a.btn.btn-success:disabled:active, .navbar .navbar-nav > li > a.btn.btn-success:disabled.active, .navbar .navbar-nav > li > a.btn.btn-success[disabled], .navbar .navbar-nav > li > a.btn.btn-success[disabled]:hover, .navbar .navbar-nav > li > a.btn.btn-success[disabled]:focus, .navbar .navbar-nav > li > a.btn.btn-success[disabled].focus, .navbar .navbar-nav > li > a.btn.btn-success[disabled]:active, .navbar .navbar-nav > li > a.btn.btn-success[disabled].active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-success, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-success:hover, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-success:focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-success.focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-success:active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-success.active, .btn-success.disabled, .btn-success.disabled:hover, .btn-success.disabled:focus, .btn-success.disabled.focus, .btn-success.disabled:active, .btn-success.disabled.active, .btn-success:disabled, .btn-success:disabled:hover, .btn-success:disabled:focus, .btn-success:disabled.focus, .btn-success:disabled:active, .btn-success:disabled.active, .btn-success[disabled], .btn-success[disabled]:hover, .btn-success[disabled]:focus, .btn-success[disabled].focus, .btn-success[disabled]:active, .btn-success[disabled].active, fieldset[disabled] .btn-success, fieldset[disabled] .btn-success:hover, fieldset[disabled] .btn-success:focus, fieldset[disabled] .btn-success.focus, fieldset[disabled] .btn-success:active, fieldset[disabled] .btn-success.active {
  background-color: transparent;
  border-color: #7AC29A;
}
.navbar .navbar-nav > li > a.btn.btn-success.btn-fill, .btn-success.btn-fill {
  color: #FFFFFF;
  background-color: #7AC29A;
  opacity: 1;
  filter: alpha(opacity=100);
}
.navbar .navbar-nav > li > a.btn.btn-success.btn-fill:hover, .navbar .navbar-nav > li > a.btn.btn-success.btn-fill:focus, .navbar .navbar-nav > li > a.btn.btn-success.btn-fill:active, .navbar .navbar-nav > li > a.btn.btn-success.btn-fill.active, .open > .navbar .navbar-nav > li > a.btn.btn-success.btn-fill.dropdown-toggle, .btn-success.btn-fill:hover, .btn-success.btn-fill:focus, .btn-success.btn-fill:active, .btn-success.btn-fill.active, .open > .btn-success.btn-fill.dropdown-toggle {
  background-color: #54b07d;
  color: #FFFFFF;
  border-color: #54b07d;
}
.navbar .navbar-nav > li > a.btn.btn-success.btn-fill .caret, .btn-success.btn-fill .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-success.btn-simple:hover, .navbar .navbar-nav > li > a.btn.btn-success.btn-simple:focus, .navbar .navbar-nav > li > a.btn.btn-success.btn-simple:active, .navbar .navbar-nav > li > a.btn.btn-success.btn-simple.active, .open > .navbar .navbar-nav > li > a.btn.btn-success.btn-simple.dropdown-toggle, .btn-success.btn-simple:hover, .btn-success.btn-simple:focus, .btn-success.btn-simple:active, .btn-success.btn-simple.active, .open > .btn-success.btn-simple.dropdown-toggle {
  background-color: transparent;
  color: #54b07d;
}
.navbar .navbar-nav > li > a.btn.btn-success.btn-simple .caret, .btn-success.btn-simple .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-success .caret, .btn-success .caret {
  border-top-color: #7AC29A;
}

.navbar .navbar-nav > li > a.btn.btn-info, .btn-info {
  border-color: #68B3C8;
  color: #68B3C8;
}
.navbar .navbar-nav > li > a.btn.btn-info:hover, .navbar .navbar-nav > li > a.btn.btn-info:focus, .navbar .navbar-nav > li > a.btn.btn-info:active, .navbar .navbar-nav > li > a.btn.btn-info.active, .navbar .navbar-nav > li > a.btn.btn-info:active:focus, .navbar .navbar-nav > li > a.btn.btn-info:active:hover, .open > .navbar .navbar-nav > li > a.btn.btn-info.dropdown-toggle, .open > .navbar .navbar-nav > li > a.btn.btn-info.dropdown-toggle:focus, .open > .navbar .navbar-nav > li > a.btn.btn-info.dropdown-toggle:hover, .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .btn-info:active:focus, .btn-info:active:hover, .open > .btn-info.dropdown-toggle, .open > .btn-info.dropdown-toggle:focus, .open > .btn-info.dropdown-toggle:hover {
  background-color: #68B3C8;
  color: rgba(255, 255, 255, 0.85);
  border-color: #68B3C8;
}
.navbar .navbar-nav > li > a.btn.btn-info:hover .caret, .navbar .navbar-nav > li > a.btn.btn-info:focus .caret, .navbar .navbar-nav > li > a.btn.btn-info:active .caret, .navbar .navbar-nav > li > a.btn.btn-info.active .caret, .navbar .navbar-nav > li > a.btn.btn-info:active:focus .caret, .navbar .navbar-nav > li > a.btn.btn-info:active:hover .caret, .open > .navbar .navbar-nav > li > a.btn.btn-info.dropdown-toggle .caret, .open > .navbar .navbar-nav > li > a.btn.btn-info.dropdown-toggle:focus .caret, .open > .navbar .navbar-nav > li > a.btn.btn-info.dropdown-toggle:hover .caret, .btn-info:hover .caret, .btn-info:focus .caret, .btn-info:active .caret, .btn-info.active .caret, .btn-info:active:focus .caret, .btn-info:active:hover .caret, .open > .btn-info.dropdown-toggle .caret, .open > .btn-info.dropdown-toggle:focus .caret, .open > .btn-info.dropdown-toggle:hover .caret {
  border-top-color: rgba(255, 255, 255, 0.85);
}
.navbar .navbar-nav > li > a.btn.btn-info.disabled, .navbar .navbar-nav > li > a.btn.btn-info.disabled:hover, .navbar .navbar-nav > li > a.btn.btn-info.disabled:focus, .navbar .navbar-nav > li > a.btn.btn-info.disabled.focus, .navbar .navbar-nav > li > a.btn.btn-info.disabled:active, .navbar .navbar-nav > li > a.btn.btn-info.disabled.active, .navbar .navbar-nav > li > a.btn.btn-info:disabled, .navbar .navbar-nav > li > a.btn.btn-info:disabled:hover, .navbar .navbar-nav > li > a.btn.btn-info:disabled:focus, .navbar .navbar-nav > li > a.btn.btn-info:disabled.focus, .navbar .navbar-nav > li > a.btn.btn-info:disabled:active, .navbar .navbar-nav > li > a.btn.btn-info:disabled.active, .navbar .navbar-nav > li > a.btn.btn-info[disabled], .navbar .navbar-nav > li > a.btn.btn-info[disabled]:hover, .navbar .navbar-nav > li > a.btn.btn-info[disabled]:focus, .navbar .navbar-nav > li > a.btn.btn-info[disabled].focus, .navbar .navbar-nav > li > a.btn.btn-info[disabled]:active, .navbar .navbar-nav > li > a.btn.btn-info[disabled].active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-info, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-info:hover, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-info:focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-info.focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-info:active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-info.active, .btn-info.disabled, .btn-info.disabled:hover, .btn-info.disabled:focus, .btn-info.disabled.focus, .btn-info.disabled:active, .btn-info.disabled.active, .btn-info:disabled, .btn-info:disabled:hover, .btn-info:disabled:focus, .btn-info:disabled.focus, .btn-info:disabled:active, .btn-info:disabled.active, .btn-info[disabled], .btn-info[disabled]:hover, .btn-info[disabled]:focus, .btn-info[disabled].focus, .btn-info[disabled]:active, .btn-info[disabled].active, fieldset[disabled] .btn-info, fieldset[disabled] .btn-info:hover, fieldset[disabled] .btn-info:focus, fieldset[disabled] .btn-info.focus, fieldset[disabled] .btn-info:active, fieldset[disabled] .btn-info.active {
  background-color: transparent;
  border-color: #68B3C8;
}
.navbar .navbar-nav > li > a.btn.btn-info.btn-fill, .btn-info.btn-fill {
  color: #FFFFFF;
  background-color: #68B3C8;
  opacity: 1;
  filter: alpha(opacity=100);
}
.navbar .navbar-nav > li > a.btn.btn-info.btn-fill:hover, .navbar .navbar-nav > li > a.btn.btn-info.btn-fill:focus, .navbar .navbar-nav > li > a.btn.btn-info.btn-fill:active, .navbar .navbar-nav > li > a.btn.btn-info.btn-fill.active, .open > .navbar .navbar-nav > li > a.btn.btn-info.btn-fill.dropdown-toggle, .btn-info.btn-fill:hover, .btn-info.btn-fill:focus, .btn-info.btn-fill:active, .btn-info.btn-fill.active, .open > .btn-info.btn-fill.dropdown-toggle {
  background-color: #429cb6;
  color: #FFFFFF;
  border-color: #429cb6;
}
.navbar .navbar-nav > li > a.btn.btn-info.btn-fill .caret, .btn-info.btn-fill .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-info.btn-simple:hover, .navbar .navbar-nav > li > a.btn.btn-info.btn-simple:focus, .navbar .navbar-nav > li > a.btn.btn-info.btn-simple:active, .navbar .navbar-nav > li > a.btn.btn-info.btn-simple.active, .open > .navbar .navbar-nav > li > a.btn.btn-info.btn-simple.dropdown-toggle, .btn-info.btn-simple:hover, .btn-info.btn-simple:focus, .btn-info.btn-simple:active, .btn-info.btn-simple.active, .open > .btn-info.btn-simple.dropdown-toggle {
  background-color: transparent;
  color: #429cb6;
}
.navbar .navbar-nav > li > a.btn.btn-info.btn-simple .caret, .btn-info.btn-simple .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-info .caret, .btn-info .caret {
  border-top-color: #68B3C8;
}

.navbar .navbar-nav > li > a.btn.btn-warning, .btn-warning {
  border-color: #F3BB45;
  color: #F3BB45;
}
.navbar .navbar-nav > li > a.btn.btn-warning:hover, .navbar .navbar-nav > li > a.btn.btn-warning:focus, .navbar .navbar-nav > li > a.btn.btn-warning:active, .navbar .navbar-nav > li > a.btn.btn-warning.active, .navbar .navbar-nav > li > a.btn.btn-warning:active:focus, .navbar .navbar-nav > li > a.btn.btn-warning:active:hover, .open > .navbar .navbar-nav > li > a.btn.btn-warning.dropdown-toggle, .open > .navbar .navbar-nav > li > a.btn.btn-warning.dropdown-toggle:focus, .open > .navbar .navbar-nav > li > a.btn.btn-warning.dropdown-toggle:hover, .btn-warning:hover, .btn-warning:focus, .btn-warning:active, .btn-warning.active, .btn-warning:active:focus, .btn-warning:active:hover, .open > .btn-warning.dropdown-toggle, .open > .btn-warning.dropdown-toggle:focus, .open > .btn-warning.dropdown-toggle:hover {
  background-color: #F3BB45;
  color: rgba(255, 255, 255, 0.85);
  border-color: #F3BB45;
}
.navbar .navbar-nav > li > a.btn.btn-warning:hover .caret, .navbar .navbar-nav > li > a.btn.btn-warning:focus .caret, .navbar .navbar-nav > li > a.btn.btn-warning:active .caret, .navbar .navbar-nav > li > a.btn.btn-warning.active .caret, .navbar .navbar-nav > li > a.btn.btn-warning:active:focus .caret, .navbar .navbar-nav > li > a.btn.btn-warning:active:hover .caret, .open > .navbar .navbar-nav > li > a.btn.btn-warning.dropdown-toggle .caret, .open > .navbar .navbar-nav > li > a.btn.btn-warning.dropdown-toggle:focus .caret, .open > .navbar .navbar-nav > li > a.btn.btn-warning.dropdown-toggle:hover .caret, .btn-warning:hover .caret, .btn-warning:focus .caret, .btn-warning:active .caret, .btn-warning.active .caret, .btn-warning:active:focus .caret, .btn-warning:active:hover .caret, .open > .btn-warning.dropdown-toggle .caret, .open > .btn-warning.dropdown-toggle:focus .caret, .open > .btn-warning.dropdown-toggle:hover .caret {
  border-top-color: rgba(255, 255, 255, 0.85);
}
.navbar .navbar-nav > li > a.btn.btn-warning.disabled, .navbar .navbar-nav > li > a.btn.btn-warning.disabled:hover, .navbar .navbar-nav > li > a.btn.btn-warning.disabled:focus, .navbar .navbar-nav > li > a.btn.btn-warning.disabled.focus, .navbar .navbar-nav > li > a.btn.btn-warning.disabled:active, .navbar .navbar-nav > li > a.btn.btn-warning.disabled.active, .navbar .navbar-nav > li > a.btn.btn-warning:disabled, .navbar .navbar-nav > li > a.btn.btn-warning:disabled:hover, .navbar .navbar-nav > li > a.btn.btn-warning:disabled:focus, .navbar .navbar-nav > li > a.btn.btn-warning:disabled.focus, .navbar .navbar-nav > li > a.btn.btn-warning:disabled:active, .navbar .navbar-nav > li > a.btn.btn-warning:disabled.active, .navbar .navbar-nav > li > a.btn.btn-warning[disabled], .navbar .navbar-nav > li > a.btn.btn-warning[disabled]:hover, .navbar .navbar-nav > li > a.btn.btn-warning[disabled]:focus, .navbar .navbar-nav > li > a.btn.btn-warning[disabled].focus, .navbar .navbar-nav > li > a.btn.btn-warning[disabled]:active, .navbar .navbar-nav > li > a.btn.btn-warning[disabled].active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-warning, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-warning:hover, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-warning:focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-warning.focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-warning:active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-warning.active, .btn-warning.disabled, .btn-warning.disabled:hover, .btn-warning.disabled:focus, .btn-warning.disabled.focus, .btn-warning.disabled:active, .btn-warning.disabled.active, .btn-warning:disabled, .btn-warning:disabled:hover, .btn-warning:disabled:focus, .btn-warning:disabled.focus, .btn-warning:disabled:active, .btn-warning:disabled.active, .btn-warning[disabled], .btn-warning[disabled]:hover, .btn-warning[disabled]:focus, .btn-warning[disabled].focus, .btn-warning[disabled]:active, .btn-warning[disabled].active, fieldset[disabled] .btn-warning, fieldset[disabled] .btn-warning:hover, fieldset[disabled] .btn-warning:focus, fieldset[disabled] .btn-warning.focus, fieldset[disabled] .btn-warning:active, fieldset[disabled] .btn-warning.active {
  background-color: transparent;
  border-color: #F3BB45;
}
.navbar .navbar-nav > li > a.btn.btn-warning.btn-fill, .btn-warning.btn-fill {
  color: #FFFFFF;
  background-color: #F3BB45;
  opacity: 1;
  filter: alpha(opacity=100);
}
.navbar .navbar-nav > li > a.btn.btn-warning.btn-fill:hover, .navbar .navbar-nav > li > a.btn.btn-warning.btn-fill:focus, .navbar .navbar-nav > li > a.btn.btn-warning.btn-fill:active, .navbar .navbar-nav > li > a.btn.btn-warning.btn-fill.active, .open > .navbar .navbar-nav > li > a.btn.btn-warning.btn-fill.dropdown-toggle, .btn-warning.btn-fill:hover, .btn-warning.btn-fill:focus, .btn-warning.btn-fill:active, .btn-warning.btn-fill.active, .open > .btn-warning.btn-fill.dropdown-toggle {
  background-color: #f0a810;
  color: #FFFFFF;
  border-color: #f0a810;
}
.navbar .navbar-nav > li > a.btn.btn-warning.btn-fill .caret, .btn-warning.btn-fill .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-warning.btn-simple:hover, .navbar .navbar-nav > li > a.btn.btn-warning.btn-simple:focus, .navbar .navbar-nav > li > a.btn.btn-warning.btn-simple:active, .navbar .navbar-nav > li > a.btn.btn-warning.btn-simple.active, .open > .navbar .navbar-nav > li > a.btn.btn-warning.btn-simple.dropdown-toggle, .btn-warning.btn-simple:hover, .btn-warning.btn-simple:focus, .btn-warning.btn-simple:active, .btn-warning.btn-simple.active, .open > .btn-warning.btn-simple.dropdown-toggle {
  background-color: transparent;
  color: #f0a810;
}
.navbar .navbar-nav > li > a.btn.btn-warning.btn-simple .caret, .btn-warning.btn-simple .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-warning .caret, .btn-warning .caret {
  border-top-color: #F3BB45;
}

.navbar .navbar-nav > li > a.btn.btn-danger, .btn-danger {
  border-color: #EB5E28;
  color: #EB5E28;
}
.navbar .navbar-nav > li > a.btn.btn-danger:hover, .navbar .navbar-nav > li > a.btn.btn-danger:focus, .navbar .navbar-nav > li > a.btn.btn-danger:active, .navbar .navbar-nav > li > a.btn.btn-danger.active, .navbar .navbar-nav > li > a.btn.btn-danger:active:focus, .navbar .navbar-nav > li > a.btn.btn-danger:active:hover, .open > .navbar .navbar-nav > li > a.btn.btn-danger.dropdown-toggle, .open > .navbar .navbar-nav > li > a.btn.btn-danger.dropdown-toggle:focus, .open > .navbar .navbar-nav > li > a.btn.btn-danger.dropdown-toggle:hover, .btn-danger:hover, .btn-danger:focus, .btn-danger:active, .btn-danger.active, .btn-danger:active:focus, .btn-danger:active:hover, .open > .btn-danger.dropdown-toggle, .open > .btn-danger.dropdown-toggle:focus, .open > .btn-danger.dropdown-toggle:hover {
  background-color: #EB5E28;
  color: rgba(255, 255, 255, 0.85);
  border-color: #EB5E28;
}
.navbar .navbar-nav > li > a.btn.btn-danger:hover .caret, .navbar .navbar-nav > li > a.btn.btn-danger:focus .caret, .navbar .navbar-nav > li > a.btn.btn-danger:active .caret, .navbar .navbar-nav > li > a.btn.btn-danger.active .caret, .navbar .navbar-nav > li > a.btn.btn-danger:active:focus .caret, .navbar .navbar-nav > li > a.btn.btn-danger:active:hover .caret, .open > .navbar .navbar-nav > li > a.btn.btn-danger.dropdown-toggle .caret, .open > .navbar .navbar-nav > li > a.btn.btn-danger.dropdown-toggle:focus .caret, .open > .navbar .navbar-nav > li > a.btn.btn-danger.dropdown-toggle:hover .caret, .btn-danger:hover .caret, .btn-danger:focus .caret, .btn-danger:active .caret, .btn-danger.active .caret, .btn-danger:active:focus .caret, .btn-danger:active:hover .caret, .open > .btn-danger.dropdown-toggle .caret, .open > .btn-danger.dropdown-toggle:focus .caret, .open > .btn-danger.dropdown-toggle:hover .caret {
  border-top-color: rgba(255, 255, 255, 0.85);
}
.navbar .navbar-nav > li > a.btn.btn-danger.disabled, .navbar .navbar-nav > li > a.btn.btn-danger.disabled:hover, .navbar .navbar-nav > li > a.btn.btn-danger.disabled:focus, .navbar .navbar-nav > li > a.btn.btn-danger.disabled.focus, .navbar .navbar-nav > li > a.btn.btn-danger.disabled:active, .navbar .navbar-nav > li > a.btn.btn-danger.disabled.active, .navbar .navbar-nav > li > a.btn.btn-danger:disabled, .navbar .navbar-nav > li > a.btn.btn-danger:disabled:hover, .navbar .navbar-nav > li > a.btn.btn-danger:disabled:focus, .navbar .navbar-nav > li > a.btn.btn-danger:disabled.focus, .navbar .navbar-nav > li > a.btn.btn-danger:disabled:active, .navbar .navbar-nav > li > a.btn.btn-danger:disabled.active, .navbar .navbar-nav > li > a.btn.btn-danger[disabled], .navbar .navbar-nav > li > a.btn.btn-danger[disabled]:hover, .navbar .navbar-nav > li > a.btn.btn-danger[disabled]:focus, .navbar .navbar-nav > li > a.btn.btn-danger[disabled].focus, .navbar .navbar-nav > li > a.btn.btn-danger[disabled]:active, .navbar .navbar-nav > li > a.btn.btn-danger[disabled].active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-danger, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-danger:hover, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-danger:focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-danger.focus, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-danger:active, fieldset[disabled] .navbar .navbar-nav > li > a.btn.btn-danger.active, .btn-danger.disabled, .btn-danger.disabled:hover, .btn-danger.disabled:focus, .btn-danger.disabled.focus, .btn-danger.disabled:active, .btn-danger.disabled.active, .btn-danger:disabled, .btn-danger:disabled:hover, .btn-danger:disabled:focus, .btn-danger:disabled.focus, .btn-danger:disabled:active, .btn-danger:disabled.active, .btn-danger[disabled], .btn-danger[disabled]:hover, .btn-danger[disabled]:focus, .btn-danger[disabled].focus, .btn-danger[disabled]:active, .btn-danger[disabled].active, fieldset[disabled] .btn-danger, fieldset[disabled] .btn-danger:hover, fieldset[disabled] .btn-danger:focus, fieldset[disabled] .btn-danger.focus, fieldset[disabled] .btn-danger:active, fieldset[disabled] .btn-danger.active {
  background-color: transparent;
  border-color: #EB5E28;
}
.navbar .navbar-nav > li > a.btn.btn-danger.btn-fill, .btn-danger.btn-fill {
  color: #FFFFFF;
  background-color: #EB5E28;
  opacity: 1;
  filter: alpha(opacity=100);
}
.navbar .navbar-nav > li > a.btn.btn-danger.btn-fill:hover, .navbar .navbar-nav > li > a.btn.btn-danger.btn-fill:focus, .navbar .navbar-nav > li > a.btn.btn-danger.btn-fill:active, .navbar .navbar-nav > li > a.btn.btn-danger.btn-fill.active, .open > .navbar .navbar-nav > li > a.btn.btn-danger.btn-fill.dropdown-toggle, .btn-danger.btn-fill:hover, .btn-danger.btn-fill:focus, .btn-danger.btn-fill:active, .btn-danger.btn-fill.active, .open > .btn-danger.btn-fill.dropdown-toggle {
  background-color: #c84513;
  color: #FFFFFF;
  border-color: #c84513;
}
.navbar .navbar-nav > li > a.btn.btn-danger.btn-fill .caret, .btn-danger.btn-fill .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-danger.btn-simple:hover, .navbar .navbar-nav > li > a.btn.btn-danger.btn-simple:focus, .navbar .navbar-nav > li > a.btn.btn-danger.btn-simple:active, .navbar .navbar-nav > li > a.btn.btn-danger.btn-simple.active, .open > .navbar .navbar-nav > li > a.btn.btn-danger.btn-simple.dropdown-toggle, .btn-danger.btn-simple:hover, .btn-danger.btn-simple:focus, .btn-danger.btn-simple:active, .btn-danger.btn-simple.active, .open > .btn-danger.btn-simple.dropdown-toggle {
  background-color: transparent;
  color: #c84513;
}
.navbar .navbar-nav > li > a.btn.btn-danger.btn-simple .caret, .btn-danger.btn-simple .caret {
  border-top-color: #FFFFFF;
}
.navbar .navbar-nav > li > a.btn.btn-danger .caret, .btn-danger .caret {
  border-top-color: #EB5E28;
}

.btn-neutral {
  border-color: #FFFFFF;
  color: #FFFFFF;
}
.btn-neutral:hover, .btn-neutral:focus, .btn-neutral:active, .btn-neutral.active, .btn-neutral:active:focus, .btn-neutral:active:hover, .open > .btn-neutral.dropdown-toggle, .open > .btn-neutral.dropdown-toggle:focus, .open > .btn-neutral.dropdown-toggle:hover {
  background-color: #FFFFFF;
  color: rgba(255, 255, 255, 0.85);
  border-color: #FFFFFF;
}
.btn-neutral:hover .caret, .btn-neutral:focus .caret, .btn-neutral:active .caret, .btn-neutral.active .caret, .btn-neutral:active:focus .caret, .btn-neutral:active:hover .caret, .open > .btn-neutral.dropdown-toggle .caret, .open > .btn-neutral.dropdown-toggle:focus .caret, .open > .btn-neutral.dropdown-toggle:hover .caret {
  border-top-color: rgba(255, 255, 255, 0.85);
}
.btn-neutral.disabled, .btn-neutral.disabled:hover, .btn-neutral.disabled:focus, .btn-neutral.disabled.focus, .btn-neutral.disabled:active, .btn-neutral.disabled.active, .btn-neutral:disabled, .btn-neutral:disabled:hover, .btn-neutral:disabled:focus, .btn-neutral:disabled.focus, .btn-neutral:disabled:active, .btn-neutral:disabled.active, .btn-neutral[disabled], .btn-neutral[disabled]:hover, .btn-neutral[disabled]:focus, .btn-neutral[disabled].focus, .btn-neutral[disabled]:active, .btn-neutral[disabled].active, fieldset[disabled] .btn-neutral, fieldset[disabled] .btn-neutral:hover, fieldset[disabled] .btn-neutral:focus, fieldset[disabled] .btn-neutral.focus, fieldset[disabled] .btn-neutral:active, fieldset[disabled] .btn-neutral.active {
  background-color: transparent;
  border-color: #FFFFFF;
}
.btn-neutral.btn-fill {
  color: #FFFFFF;
  background-color: #FFFFFF;
  opacity: 1;
  filter: alpha(opacity=100);
}
.btn-neutral.btn-fill:hover, .btn-neutral.btn-fill:focus, .btn-neutral.btn-fill:active, .btn-neutral.btn-fill.active, .open > .btn-neutral.btn-fill.dropdown-toggle {
  background-color: #FFFFFF;
  color: #FFFFFF;
  border-color: #FFFFFF;
}
.btn-neutral.btn-fill .caret {
  border-top-color: #FFFFFF;
}
.btn-neutral.btn-simple:hover, .btn-neutral.btn-simple:focus, .btn-neutral.btn-simple:active, .btn-neutral.btn-simple.active, .open > .btn-neutral.btn-simple.dropdown-toggle {
  background-color: transparent;
  color: #FFFFFF;
}
.btn-neutral.btn-simple .caret {
  border-top-color: #FFFFFF;
}
.btn-neutral .caret {
  border-top-color: #FFFFFF;
}
.btn-neutral:hover, .btn-neutral:focus {
  color: #66615B;
}
.btn-neutral:hover i, .btn-neutral:focus i {
  color: #66615B;
  opacity: 1;
}
.btn-neutral:active, .btn-neutral.active, .open > .btn-neutral.dropdown-toggle {
  background-color: #FFFFFF;
  color: #66615B;
}
.btn-neutral:active i, .btn-neutral.active i, .open > .btn-neutral.dropdown-toggle i {
  color: #66615B;
  opacity: 1;
}
.btn-neutral.btn-fill {
  color: #66615B;
}
.btn-neutral.btn-fill i {
  color: #66615B;
  opacity: 1;
}
.btn-neutral.btn-fill:hover, .btn-neutral.btn-fill:focus {
  color: #484541;
}
.btn-neutral.btn-fill:hover i, .btn-neutral.btn-fill:focus i {
  color: #484541;
  opacity: 1;
}
.btn-neutral.btn-simple:active, .btn-neutral.btn-simple.active {
  background-color: transparent;
}

.btn:disabled, .btn[disabled], .btn.disabled, .btn.btn-disabled {
  opacity: 0.5;
  filter: alpha(opacity=50);
}

.btn-disabled {
  cursor: default;
}

.btn-simple {
  border: 0;
  padding: 7px 18px;
}

.navbar .navbar-nav > li > a.btn.btn-lg,
.btn-lg {
  font-size: 18px;
  border-radius: 50px;
  padding: 11px 30px;
  font-weight: 400;
}
.navbar .navbar-nav > li > a.btn.btn-lg.btn-simple,
.btn-lg.btn-simple {
  padding: 13px 30px;
}
.navbar .navbar-nav > li > a.btn.btn-lg.btn-icon,
.btn-lg.btn-icon {
  border-radius: 30px;
  padding: 9px 16px;
}

.navbar .navbar-nav > li > a.btn.btn-sm,
.btn-sm {
  font-size: 12px;
  border-radius: 26px;
  padding: 4px 10px;
}
.navbar .navbar-nav > li > a.btn.btn-sm.btn-simple,
.btn-sm.btn-simple {
  padding: 6px 10px;
}
.navbar .navbar-nav > li > a.btn.btn-sm.btn-icon,
.btn-sm.btn-icon {
  padding: 3px 6px;
}
.navbar .navbar-nav > li > a.btn.btn-sm.btn-icon .fa,
.btn-sm.btn-icon .fa {
  line-height: 1.6;
  width: 15px;
}

.navbar .navbar-nav > li > a.btn.btn-xs,
.btn-xs {
  font-size: 12px;
  border-radius: 26px;
  padding: 2px 5px;
}
.navbar .navbar-nav > li > a.btn.btn-xs.btn-simple,
.btn-xs.btn-simple {
  padding: 4px 5px;
}
.navbar .navbar-nav > li > a.btn.btn-xs.btn-icon,
.btn-xs.btn-icon {
  padding: 1px 5px;
}
.navbar .navbar-nav > li > a.btn.btn-xs.btn-icon .fa,
.btn-xs.btn-icon .fa {
  width: 10px;
}

.navbar .navbar-nav > li > a.btn.btn-wd,
.btn-wd {
  min-width: 140px;
}

.btn-group.select {
  width: 100%;
}

.btn-group.select .btn {
  text-align: left;
}

.btn-group.select .caret {
  position: absolute;
  top: 50%;
  margin-top: -1px;
  right: 8px;
}

.btn-tooltip {
  white-space: nowrap;
}

.buttons-with-margin .btn {
  margin-bottom: 5px;
}
*/
.label {
  padding: 3px 8px;
  border-radius: 12px;
  color: #FFFFFF;
  font-weight: 500;
  font-size: 0.75em;
  text-transform: uppercase;
  display: inline-block;
  line-height: 1.5em;
}

.label-icon {
  padding: 0.4em 0.55em;
}
.label-icon i {
  font-size: 0.8em;
  line-height: 1;
}

.label-default {
  background-color: #66615b;
}

.label-primary {
  background-color: #7A9E9F;
}

.label-info {
  background-color: #68B3C8;
}

.label-success {
  background-color: #7AC29A;
}

.label-warning {
  background-color: #F3BB45;
}

.label-danger {
  background-color: #EB5E28;
}

/*            Navigation menu                */
.nav-pills {
  background-color: #F3F2EE;
  position: absolute;
  width: 100%;
  height: 4px;
  top: 40px;
  text-align: center;
}
.nav-pills > li + li {
  margin-left: 0;
}
.nav-pills > li > a {
  padding: 0;
  max-width: 78px;
  margin: 0 auto;
  color: rgba(0, 0, 0, 0.2);
  border-radius: 50%;
  position: relative;
  top: -32px;
  z-index: 100;
}
.nav-pills > li > a:after {
  content: '';
  width: 70px;
  height: 70px;
  border-radius: 50%;
  display: inline-block;
  position: absolute;
  right: -1px;
  top: -4px;
  transform: scale(0);
  transition: .2s all linear;
}
.nav-pills > li > a:hover, .nav-pills > li > a:focus {
  background-color: transparent;
  color: rgba(0, 0, 0, 0.2);
  outline: 0 !important;
  cursor: pointer;
}
.nav-pills > li.active > a:after {
  content: '';
  width: 70px;
  height: 70px;
  border-radius: 50%;
  display: inline-block;
  position: absolute;
  right: 5px;
  top: -2px;
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -o-transition: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  transition: all 0.2s linear;
}
.nav-pills > li.active > a,
.nav-pills > li.active > a:hover,
.nav-pills > li.active > a:focus {
  background-color: transparent;
  font-size: 15px;
  -webkit-transition: font-size 0.2s linear;
  -moz-transition: font-size 0.2s linear;
  -o-transition: font-size 0.2s linear;
  -ms-transition: font-size 0.2s linear;
  transition: font-size 0.2s linear;
}
.nav-pills > li.active > a [class*="ti-"],
.nav-pills > li.active > a:hover [class*="ti-"],
.nav-pills > li.active > a:focus [class*="ti-"] {
  color: #FFFFFF;
  font-size: 24px;
  top: 21px;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  transition: all 0.2s linear;
}

.tooltip {
  font-size: 14px;
  font-weight: bold;
}

.tooltip-arrow {
  display: none;
  opacity: 0;
}

.tooltip-inner {
  background-color: #FAE6A4;
  border-radius: 4px;
  box-shadow: 0 1px 13px rgba(0, 0, 0, 0.14), 0 0 0 1px rgba(115, 71, 38, 0.23);
  color: #734726;
  max-width: 200px;
  padding: 6px 10px;
  text-align: center;
  text-decoration: none;
}
.tooltip-inner:after {
  content: "";
  display: inline-block;
  left: 100%;
  margin-left: -56%;
  position: absolute;
}
.tooltip-inner:before {
  content: "";
  display: inline-block;
  left: 100%;
  margin-left: -56%;
  position: absolute;
}

.tooltip.top {
  margin-top: -11px;
  padding: 0;
}
.tooltip.top .tooltip-inner:after {
  border-top: 11px solid #FAE6A4;
  border-left: 11px solid transparent;
  border-right: 11px solid transparent;
  bottom: -10px;
}
.tooltip.top .tooltip-inner:before {
  border-top: 11px solid rgba(0, 0, 0, 0.2);
  border-left: 11px solid transparent;
  border-right: 11px solid transparent;
  bottom: -11px;
}

.tooltip.bottom {
  margin-top: 11px;
  padding: 0;
}
.tooltip.bottom .tooltip-inner:after {
  border-bottom: 11px solid #FAE6A4;
  border-left: 11px solid transparent;
  border-right: 11px solid transparent;
  top: -10px;
}
.tooltip.bottom .tooltip-inner:before {
  border-bottom: 11px solid rgba(0, 0, 0, 0.2);
  border-left: 11px solid transparent;
  border-right: 11px solid transparent;
  top: -11px;
}

.tooltip.left {
  margin-left: -11px;
  padding: 0;
}
.tooltip.left .tooltip-inner:after {
  border-left: 11px solid #FAE6A4;
  border-top: 11px solid transparent;
  border-bottom: 11px solid transparent;
  right: -10px;
  left: auto;
  margin-left: 0;
}
.tooltip.left .tooltip-inner:before {
  border-left: 11px solid rgba(0, 0, 0, 0.2);
  border-top: 11px solid transparent;
  border-bottom: 11px solid transparent;
  right: -11px;
  left: auto;
  margin-left: 0;
}

.tooltip.right {
  margin-left: 11px;
  padding: 0;
}
.tooltip.right .tooltip-inner:after {
  border-right: 11px solid #FAE6A4;
  border-top: 11px solid transparent;
  border-bottom: 11px solid transparent;
  left: -10px;
  top: 0;
  margin-left: 0;
}
.tooltip.right .tooltip-inner:before {
  border-right: 11px solid rgba(0, 0, 0, 0.2);
  border-top: 11px solid transparent;
  border-bottom: 11px solid transparent;
  left: -11px;
  top: 0;
  margin-left: 0;
}

.card {
  border-radius: 6px;
  box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
  background-color: #FFFFFF;
  color: #252422;
  padding: 10px 0;
  margin-bottom: 20px;
  position: relative;
  z-index: 1;
}
.card .card-checkboxes {
  background-color: #F3F2EE;
  box-shadow: none;
  color: rgba(0, 0, 0, 0.3);
}
.card .card-hover-effect {
  -webkit-transition: transform 300ms cubic-bezier(0.34, 2, 0.6, 1), box-shadow 200ms ease;
  -moz-transition: transform 300ms cubic-bezier(0.34, 2, 0.6, 1), box-shadow 200ms ease;
  -o-transition: transform 300ms cubic-bezier(0.34, 2, 0.6, 1), box-shadow 200ms ease;
  -ms-transition: transform 300ms cubic-bezier(0.34, 2, 0.6, 1), box-shadow 200ms ease;
  transition: transform 300ms cubic-bezier(0.34, 2, 0.6, 1), box-shadow 200ms ease;
}
.card .card-hover-effect:hover {
  box-shadow: 0px 12px 17px -7px rgba(0, 0, 0, 0.3);
  -webkit-transform: translateY(-10px);
  -moz-transform: translateY(-10px);
  -o-transition: translateY(-10px);
  -ms-transform: translateY(-10px);
  transform: translateY(-10px);
}

.wizard-card {
  min-height: 410px;
  box-shadow: 0 20px 16px -15px rgba(0, 0, 0, 0.57);
}
.wizard-card .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
.wizard-card .icon-circle {
  font-size: 20px;
  border: 3px solid #F3F2EE;
  text-align: center;
  border-radius: 50%;
  color: rgba(0, 0, 0, 0.2);
  font-weight: 600;
  width: 70px;
  height: 70px;
  background-color: #FFFFFF;
  margin: 0 auto;
  position: relative;
  top: -2px;
}
.wizard-card .icon-circle [class*="ti-"] {
  position: absolute;
  z-index: 1;
  left: 1px;
  right: 0px;
  top: 23px;
}
.wizard-card .picture {
  width: 106px;
  height: 106px;
  background-color: #d8d1c9;
  border: 4px solid transparent;
  color: #FFFFFF;
  border-radius: 50%;
  margin: 5px auto;
  overflow: hidden;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
}
.wizard-card .picture:hover {
  border-color: #2ca8ff;
}
.wizard-card .picture-src {
  width: 100%;
}
.wizard-card[data-color="azure"] .picture:hover {
  border-color: #7A9E9F;
}
.wizard-card[data-color="azure"] .nav-pills > li.active > a:after {
  background-color: #7A9E9F;
}
.wizard-card[data-color="azure"] .nav-pills > li.active > a {
  color: #7A9E9F;
}
.wizard-card[data-color="azure"] .nav-pills .icon-circle.checked {
  border-color: #7A9E9F;
}
.wizard-card[data-color="azure"] .choice.active .card-checkboxes {
  color: #7A9E9F;
}
.wizard-card[data-color="azure"] .wizard-navigation .progress-bar {
  background-color: #7A9E9F;
}
.wizard-card[data-color="green"] .picture:hover {
  border-color: #7AC29A;
}
.wizard-card[data-color="green"] .nav-pills > li.active > a:after {
  background-color: #7AC29A;
}
.wizard-card[data-color="green"] .nav-pills > li.active > a {
  color: #7AC29A;
}
.wizard-card[data-color="green"] .nav-pills .icon-circle.checked {
  border-color: #7AC29A;
}
.wizard-card[data-color="green"] .choice.active .card-checkboxes {
  color: #7AC29A;
}
.wizard-card[data-color="green"] .wizard-navigation .progress-bar {
  background-color: #7AC29A;
}
.wizard-card[data-color="blue"] .picture:hover {
  border-color: #68B3C8;
}
.wizard-card[data-color="blue"] .nav-pills > li.active > a:after {
  background-color: #68B3C8;
}
.wizard-card[data-color="blue"] .nav-pills > li.active > a {
  color: #68B3C8;
}
.wizard-card[data-color="blue"] .nav-pills .icon-circle.checked {
  border-color: #68B3C8;
}
.wizard-card[data-color="blue"] .choice.active .card-checkboxes {
  color: #68B3C8;
}
.wizard-card[data-color="blue"] .wizard-navigation .progress-bar {
  background-color: #68B3C8;
}
.wizard-card[data-color="orange"] .picture:hover {
  border-color: #f1592a;
}
.wizard-card[data-color="orange"] .nav-pills > li.active > a:after {
  background-color: #f1592a;
}
.wizard-card[data-color="orange"] .nav-pills > li.active > a {
  color: #f1592a;
}
.wizard-card[data-color="orange"] .nav-pills .icon-circle.checked {
  border-color: #f1592a;
}
.wizard-card[data-color="orange"] .choice.active .card-checkboxes {
  color: #f1592a;
}
.wizard-card[data-color="orange"] .wizard-navigation .progress-bar {
  background-color: #f1592a;
}
.wizard-card[data-color="red"] .picture:hover {
  border-color: #EB5E28;
}
.wizard-card[data-color="red"] .nav-pills > li.active > a:after {
  background-color: #EB5E28;
}
.wizard-card[data-color="red"] .nav-pills > li.active > a {
  color: #EB5E28;
}
.wizard-card[data-color="red"] .nav-pills .icon-circle.checked {
  border-color: #EB5E28;
}
.wizard-card[data-color="red"] .choice.active .card-checkboxes {
  color: #EB5E28;
}
.wizard-card[data-color="red"] .wizard-navigation .progress-bar {
  background-color: #EB5E28;
}
.wizard-card .picture input[type="file"] {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0 !important;
  position: absolute;
  top: 0;
  width: 100%;
}
.wizard-card .tab-content {
  min-height: 435px;
  padding: 105px 20px 10px;
}
.wizard-card .wizard-footer {
  padding: 0 15px 5px;
}
.wizard-card .disabled {
  display: none;
}
.wizard-card .wizard-header {
  padding: 15px 15px 15px 15px;
  position: relative;
  border-radius: 3px 3px 0 0;
  z-index: 3;
}
.wizard-card .wizard-header h3 {
  text-align: center;
}
.wizard-card .wizard-title {
  color: #252422;
  font-weight: 300;
  margin: 0;
}
.wizard-card .category {
  font-size: 14px;
  font-weight: 400;
  color: #9A9A9A;
  margin-bottom: 0px;
  text-align: center;
}
.wizard-card .wizard-navigation {
  position: relative;
}
.wizard-card .wizard-navigation .progress-with-circle {
  position: relative;
  top: 40px;
  z-index: 50;
  height: 4px;
}
.wizard-card .wizard-navigation .progress-with-circle .progress-bar {
  box-shadow: none;
  -webkit-transition: width .3s ease;
  -o-transition: width .3s ease;
  transition: width .3s ease;
}
.wizard-card .info-text {
  text-align: center;
  padding-bottom: 18px;
  padding-top: 12px;
}
.wizard-card .choice {
  text-align: center;
  cursor: pointer;
  margin-top: 38px;
}
.wizard-card .choice .icon {
  text-align: center;
  vertical-align: middle;
  height: 116px;
  width: 116px;
  border-radius: 50%;
  background-color: #999999;
  color: #FFFFFF;
  margin: 0 auto 20px;
  border: 4px solid #CCCCCC;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
}
.wizard-card .choice i {
  font-size: 32px;
  line-height: 55px;
}
.wizard-card .choice:hover .icon, .wizard-card .choice.active .icon {
  border-color: #2ca8ff;
}
.wizard-card .choice input[type="radio"],
.wizard-card .choice input[type="checkbox"] {
  position: absolute;
  left: -10000px;
  z-index: -1;
}
.wizard-card .description {
  color: #999999;
  font-size: 14px;
}

.footer {
  position: relative;
  bottom: 20px;
  right: 0px;
  width: 100%;
  color: #FFFFFF;
  z-index: 4;
  text-align: right;
  margin-top: 60px;
  text-shadow: 0 1px 3px black;
}
.footer a {
  color: #FFFFFF;
}
.footer .heart {
  color: #FF3B30;
}

@media (max-width: 768px) {
  .main .container {
    margin-bottom: 50px;
  }
}
@media (min-width: 768px) {
  .navbar-form {
    margin-top: 21px;
    margin-bottom: 21px;
    padding-left: 5px;
    padding-right: 5px;
  }

  .btn-wd {
    min-width: 140px;
  }
}

::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    font-size: 13px;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    font-size: 13px;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    font-size: 13px;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
    font-size: 13px;
}

.btn-sample { 
  color: #ffffff; 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-sample:hover, 
.btn-sample:focus, 
.btn-sample:active, 
.btn-sample.active, 
.open .dropdown-toggle.btn-sample { 
  color: #ffffff; 
  background-color: #f1592a; 
  border-color: #F1592A; 
} 
 
.btn-sample:active, 
.btn-sample.active, 
.open .dropdown-toggle.btn-sample { 
  background-image: none; 
} 
 
.btn-sample.disabled, 
.btn-sample[disabled], 
fieldset[disabled] .btn-sample, 
.btn-sample.disabled:hover, 
.btn-sample[disabled]:hover, 
fieldset[disabled] .btn-sample:hover, 
.btn-sample.disabled:focus, 
.btn-sample[disabled]:focus, 
fieldset[disabled] .btn-sample:focus, 
.btn-sample.disabled:active, 
.btn-sample[disabled]:active, 
fieldset[disabled] .btn-sample:active, 
.btn-sample.disabled.active, 
.btn-sample[disabled].active, 
fieldset[disabled] .btn-sample.active { 
  background-color: #F1592A; 
  border-color: #F1592A; 
} 
 
.btn-sample .badge { 
  color: #F1592A; 
  background-color: #ffffff; 
}

.hideme
{
  
    visibility:hidden;
}
.showme
{
  
    visibility:visible;
}
</style>

	<!-- Fonts and Icons -->

    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="https://demos.creative-tim.com/paper-bootstrap-wizard/assets/css/themify-icons.css" rel="stylesheet">
	

<input type="hidden" name="tutorID" id="tutorID" required="" value="<?PHP echo $_GET['tutor_id']; ?>">
<input type="hidden" name="parentID" id="parentID" required="" value="<?PHP echo $_GET['parent_id']; ?>">

		                <div class="card wizard-card" data-color="orange" id="wizardProfile">
		                    <form action="" method="">

		                    	<div class="wizard-header text-center">
		                        	<h3 class="wizard-title"></h3>
									<p class="category"></p>
		                    	</div>

								<div class="wizard-navigation">
									<div class="progress-with-circle">
									     <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
									</div>
									<ul>
			                            <li>
											<a href="#Rate" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-star"></i>
												</div>
<?PHP
if($getLan == "/my/"){	
	echo 'Nilai';
}else{
	echo 'Rate';
}
?>
											</a>
										</li>
			                            <li>
											<a href="#Comments" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-pencil"></i>
												</div>
<?PHP
if($getLan == "/my/"){	
	echo 'Ulasan';
}else{
	echo 'Comments';
}
?>
											</a>
										</li>
			                            <li>
											<a href="#Feedback" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-lock"></i>
												</div>
<?PHP
if($getLan == "/my/"){	
	echo 'Maklumbalas';
}else{
	echo 'Feedback';
}
?>
											</a>
										</li>
			                        </ul>
								</div>
		                        <div class="tab-content">
		                            <div class="tab-pane" id="Rate">
		                            	<div class="row">
											<h5 class="info-text description"> <?php echo REVIEW_STEP1_TITLE; ?> <?php echo $getUserDetails->data[0]->ud_first_name; ?> <?php echo $getUserDetails->data[0]->ud_last_name; 
if($getLan == "/my/"){	

}else{
	echo '’s';
}
         
         ?> <?php echo TEXT_CLASS; ?></h5>
											<div class="col-sm-4 col-sm-offset-1">
												<div class="picture-container">
													<div class="picture">
													    
													    

													    
													    
														<img src="<?php 
                
                $pix = sprintf("%'.07d\n", $getUserDetails->data[0]->u_profile_pic);
           if ($getUserDetails->data[0]->u_profile_pic != '') {
                if ( is_numeric($getUserDetails->data[0]->u_profile_pic) ) {
                    echo APP_ROOT."images/profile/".$pix."_0.jpg";
                }else{
                    echo APP_ROOT."images/profile/".$getUserDetails->data[0]->u_profile_pic.".jpg";
                }
           } elseif ($getUserDetails->data[0]->u_gender == 'M') {
                echo APP_ROOT."images/tutor_ma.png";
           } else {
                 echo APP_ROOT."images/tutor_mi1.png";
           } 
                
                
                ?>
														" class="picture-src" id="wizardPicturePreview"  />
													
													</div>
													<h6><?php echo $getUserDetails->data[0]->ud_first_name; ?> <?php echo $getUserDetails->data[0]->ud_last_name; ?> ( <?php echo ID_NO; ?> : <?php echo $getUserDetails->data[0]->u_displayid; ?>)</h6>
												</div>
											</div>

		                                    <div class="col-sm-6">
		                                        <div class="form-group">
		                                            <p class="description"><?php echo REVIEW_STEP1_DESCRIPTION; ?></p>
		                                            <p class="description"><?php echo REVIEW_STEP1_QUESTION; ?> <small><?php echo REQUIRED; ?></small></p>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-6">
		                                        <div class="form-group">
         <fieldset class="rating">
            <input class="radio" type="radio" id="star5" name="rating" value="5" required="" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
            <input class="radio" type="radio" id="star4half" name="rating" value="4.5" required="" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
            <input class="radio" type="radio" id="star4" name="rating" value="4" required="" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
            <input class="radio" type="radio" id="star3half" name="rating" value="3.5" required="" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
            <input class="radio" type="radio" id="star3" name="rating" value="3" required="" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
            <input class="radio" type="radio" id="star2half" name="rating" value="2.5" required="" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
            <input class="radio" type="radio" id="star2" name="rating" value="2" required="" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
            <input class="radio" type="radio" id="star1half" name="rating" value="1.5" required="" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
            <input class="radio" type="radio" id="star1" name="rating" value="1" required="" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
            <input class="radio" type="radio" id="starhalf" name="rating" value="0.5" required="" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
         </fieldset>
		                                        <input type="text" name="ratefield" id="ratefield" required="" class="hideme" style="width:20px;margin-top:0px">
		                                        </div>
												
		                                    </div>


											
            
<!--
											<div class="col-sm-6">
												<div class="form-group">
													<label> <h4>Name</h4> </label>
													<input name="firstname" type="text" class="form-control" placeholder="Andrew...">
												</div>
												<div class="form-group">
													<label> <h4>lastname</h4> </label>
													<input name="lastname" type="text" class="form-control" placeholder="Smith...">
												</div>
											</div>
											<div class="col-sm-10 col-sm-offset-1">
												<div class="form-group">
													<label> <h4>email</h4> </label>
													<input name="email" type="email" class="form-control" placeholder="andrew@creative-tim.com">
												</div>
											</div>-->

         
         
											
										</div>
		                            </div>
		                            <div class="tab-pane" id="Comments">
		                                <h5 class="info-text description"> <?php echo REVIEW_STEP2_QUESTION; ?> <small><?php echo REQUIRED; ?></small> </h5>
		                                <div class="row">
		                                        
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="form-group">
		                                            <p class="description">
<?php echo REVIEW_STEP2_DESCRIPTION; 
//$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
if($getLan == "/my/"){	
	echo ' '.$getUserDetails->data[0]->u_displayname;
}else{
	echo ' '.$getUserDetails->data[0]->u_displayname;
	echo '’s profile.';
}
         ?>
		                                            </p>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="form-group">
		                                            <p class="description">
<textarea class="form-control" rows="9" id="word_count" placeholder="<?php echo REVIEW_STEP2_PLACEHOLDER; ?>" name="review" required=""></textarea>
<div id="word_left" class="text-right description"><?php echo WORDS_LEFT; ?></div>
		                                            </p>
		                                        </div>
		                                    </div>
		                                   
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="Feedback">
		                                <div class="row">
		                                    <div class="col-sm-12">
		                                        <h5 class="info-text description"> <?php echo REVIEW_STEP3_TITLE; ?> </h5>
		                                    </div>

		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="form-group">
		                                            <p class="description">
<?php echo REVIEW_STEP3_DESCRIPTION; ?>
		                                            </p>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="form-group">
		                                            <p class="description">
<?php echo REVIEW_STEP3_QUESTION; ?>
		                                            </p>
		                                        </div>
		                                    </div>

		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="form-group">
		                                            <p class="description">
<textarea class="form-control" rows="9" id="word_count2"  name="share_about_tutor" ></textarea>
<div id="word_left2" class="text-right description"><?php echo WORDS_LEFT; ?></div>
		                                            </p>
		                                        </div>
		                                    </div>

		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="form-group">
		                                            <p class="description">
<?php echo REVIEW_STEP3_QUESTION2; ?>
		                                            </p>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="form-group">
		                                            <p class="description">
<textarea class="form-control" rows="9" id="congratulation-text2" name="tutor_improve" ></textarea>
		                                            </p>
		                                        </div>
		                                    </div>
		                                    

		                                    
		                                    
		                                </div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-sample btn-wd' name='next' value='Next' />
		                                <input type='button' class='btn btn-finish btn-fill btn-sample btn-wd' name='finish' value='Finish' onclick="Finish()"/>
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-sample btn-wd' name='previous' value='Previous' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>

  

	<script src="https://demos.creative-tim.com/paper-bootstrap-wizard/assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
	<script src="https://demos.creative-tim.com/paper-bootstrap-wizard/assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>
	<script src="https://demos.creative-tim.com/paper-bootstrap-wizard/assets/js/jquery.validate.min.js" type="text/javascript"></script> 


<?PHP				
/* END */

              } elseif ($_GET['step'] == 2) {

                //include('includes/review_step_2.php');

              } elseif ($_GET['step'] == 3) {

                //include('includes/review_step_3.php');

              } elseif ($_GET['step'] == 4) {

                //include('includes/review_step_4.php');

              } else{

                include('includes/review_error.php');

              }

            } else{

              include('includes/review_error.php');

            }

          }

        ?>

      </div>

   </div>

</section>

<?php include('includes/footer.php');?>

<script>
var url = window.location.pathname;
if(url == '/my/parent_review'){
	var WORDS_LEFT = ' patah perkataan';
}else{
	var WORDS_LEFT = ' words left';
}
/*
$(document).ready(function() {
//
var text_max = 100;
$('#count').html(text_max + WORDS_LEFT);

$('#congratulation-text').keyup(function() {
    var text_length = $('#congratulation-text').val().length;
    var text_remaining = text_max - text_length;

    $('#count').html(text_remaining + WORDS_LEFT);
});
//
var text_max = 100;
$('#congratulation-text').keyup(function() {
	
	s = document.getElementById("congratulation-text").value;
	s = s.replace(/(^\s*)|(\s*$)/gi,"");
	s = s.replace(/[ ]{2,}/gi," ");
	s = s.replace(/\n /,"\n");
	var text_remaining = text_max - (s.split(' ').length);
	
	$('#count').html(text_remaining + WORDS_LEFT);
	
	
});




});
*/


$(document).ready(function() {
    $("#word_count").on('keyup', function() {
        var words = this.value.match(/\S+/g).length;
        if (words > 100) {
            // Split the string on first 200 words and rejoin on spaces
            var trimmed = $(this).val().split(/\s+/, 100).join(" ");
            // Add a space at the end to keep new typing making new words
            $(this).val(trimmed + " ");
        }
        else {
            $('#display_count').text(words);
            $('#word_left').text((100-words) + WORDS_LEFT);
        }
    });
 }); 






$(document).ready(function() {
    $("#word_count2").on('keyup', function() {
        var words = this.value.match(/\S+/g).length;
        if (words > 100) {
            // Split the string on first 200 words and rejoin on spaces
            var trimmed = $(this).val().split(/\s+/, 100).join(" ");
            // Add a space at the end to keep new typing making new words
            $(this).val(trimmed + " ");
        }
        else {
            $('#display_count').text(words);
            $('#word_left2').text((100-words) + WORDS_LEFT);
        }
    });
 }); 


$(document).ready(function () {
       $('.radio').click(function () {
           //document.getElementById('test').innerHTML = $(this).val();
           document.getElementById('ratefield').value = $(this).val();
       });

   });
   

function Finish() {
    var tutorID = document.getElementsByName("tutorID")[0].value;
    var parentID = document.getElementsByName("parentID")[0].value;
 
    var rating = document.getElementsByName("ratefield")[0].value;
    var review = document.getElementsByName("review")[0].value;
    var share_about_tutor = document.getElementsByName("share_about_tutor")[0].value;
    var tutor_improve = document.getElementsByName("tutor_improve")[0].value;

    $.ajax({
        type:'POST',
        url:'ajax-rate.php',
        data:{tutorID: tutorID, parentID: parentID, rating: rating, review: review, share_about_tutor: share_about_tutor, tutor_improve: tutor_improve},
        beforeSend: function() {
        },
        success:function(result){
            if(result =='success'){
                window.location = "https://www.tutorkami.com/parent_review?step=4";
            }else if(result =='x success'){
                alert('ERROR : Submit Failed');
            }else{
                alert('ERROR');
            }
        }
    });
   
    //alert(' tutorID : ' + tutorID + ' parentID : ' + parentID + ' rating : ' + rating + ' review : ' + review + ' share_about_tutor : ' + share_about_tutor + ' tutor_improve : ' + tutor_improve);
}


</script>