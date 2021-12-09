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
              $step = 1;
              if ( $_GET['step'] == 1) {

                //include('includes/review_step_1.php'); 
			
/* START */
?>					

<style>

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
  background-color: #17150f;
  border-radius: 4px;
  box-shadow: 0 1px 13px rgba(0, 0, 0, 0.14), 0 0 0 1px rgba(115, 71, 38, 0.23);
  color: #FFFFFF;
  max-width: 220px;
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
  border-top: 11px solid #17150f;
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
  border-bottom: 11px solid #17150f;
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
  border-left: 11px solid #17150f;
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
  border-right: 11px solid #17150f;
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
	<link href="https://www.tutorkami.com/css/review/themify-icons.css" rel="stylesheet">
	<!--<link href="https://demos.creative-tim.com/paper-bootstrap-wizard/assets/css/themify-icons.css" rel="stylesheet">-->
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<?PHP
if($getLan == "/my/"){	
	$this1 = 'Sila nilai perkhidmatan tutor anda';
	$this2 = 'Ulasan umum';
	$this3 = 'Ulasan anda di sini bersifat umum dan akan dipaparkan di profil tutor';
	$this4 = 'Kongsikan dengan kami ulasan anda untuk tutor ini';
	$this5 = 'Adakah tutor ini berjaya membantu pelajar? Bagaimana prestasi dan sikap tutor ini? Jika ada keperluan, adakah anda akan menggunakan perkhidmatan tutor ini lagi di masa hadapan atau mengesyorkan tutor ini kepada kenalan anda?';
	$this6 = 'Adakah anda mempunyai sebarang aduan tentang tutor ini?';
	$this7 = 'Komen anda <u>tidak akan dipaparkan</u> kepada tutor ini atau kepada umum';
	$this8 = 'Aduan anda ini akan kami gunakan untuk memperbaiki perkhidmatan tutor kami di masa hadapan';
	$this9 = 'Kami ingin tahu feedback anda ';
	$this10 = 'Apakah komen keseluruhan anda tentang servis TutorKami.com?';
	$this11 = 'Mohon kongsikan maklum balas anda tentang staf dan perkhidmatan TutorKami.com. Adakah ada sebarang perkara yang kami boleh perbaiki?';
	$this12 = 'Komen anda di sini tidak akan dipaparkan kepada umum';
}else{
	$this1 = 'Let’s rate your tutor’s service';
	$this2 = 'Public review';
	$this3 = 'Your review here will be public and appear on the tutor’s profile';
	$this4 = 'Share with us your what do you think about this tutor (required)';
	$this5 = 'Did the tutor manage to help the student to improve? How is the tutor’s performance? Will you consider hiring the tutor again, or recommend the tutor to anyone?';
	$this6 = 'Do you have any complaints about this tutor?';
	$this7 = 'Your comments below will <u>not be shown</u> to the tutor and to the public';
	$this8 = 'We will use this complaint to improve our tutors’ overall services in the future';
	$this9 = 'We would love to hear from you';
	$this10 = 'How was your overall experience dealing with TutorKami.com?';
	$this11 = 'Share with us your comments and feedback about our staff and TutorKami overall services. In what ways can we improve?';
	$this12 = 'Your comments here will be private and will not be shown to the public';
}
?>
<input type="hidden" name="tutorID" id="tutorID" required="" value="<?PHP echo $_GET['tutor_id']; ?>">
<input type="hidden" name="parentID" id="parentID" required="" value="<?PHP echo $_GET['parent_id']; ?>">
<input type="hidden" name="jobID" id="jobID" required="" value="<?PHP echo $_GET['job_id']; ?>">

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
						<!--<div class="icon-circle"><i class="ti-star"></i></div>
						ti-comments-smiley ti-thought ti-layers ti-comments ti-comment ti-comment-alt ti-check-box
						
						
						-->
						
						<div class="icon-circle"> <i class="ti-star"></i> </div>
					</a>
				</li>
				<li>
					<a href="#Comments" data-toggle="tab">
						<div class="icon-circle"><i class="ti-write"></i></div>
					</a>
				</li>
				<li>
					<a href="#Feedback" data-toggle="tab">
						<div class="icon-circle"><i class="ti-comment-alt"></i></div>
					</a>
				</li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane" id="Rate">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="picture-container">
							<div class="picture" <?PHP if($getLan == "/my/"){ ?> style="margin-top:27px;" <?PHP } ?> >
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
								   ?>" class="picture-src" id="wizardPicturePreview"  />
							</div>
							<h6><font size="2em"><b><?php echo strtoupper($getUserDetails->data[0]->ud_first_name); ?> <?php echo strtoupper($getUserDetails->data[0]->ud_last_name); ?> <br>( <?php echo ID_NO; ?> : <?php echo strtoupper($getUserDetails->data[0]->u_displayid); ?>)</b></font></h6>
						</div>
					</div>
					<br><br>
					<div class="col-sm-6">
						<div class="form-group">
							<center><p class="description" ><font color="#f1592a"><?php echo $this1; ?></font></p>
							<p class="description"><?php echo REVIEW_STEP1_QUESTION; ?> <small><?php echo REQUIRED; ?></small></p></center>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							 <fieldset class="rating" style="font-size:160%;margin-left:15%;">
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
				</div>
			</div>
			<div class="tab-pane" id="Comments"><!-- this -->
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="picture-container">
							<div class="picture" <?PHP if($getLan == "/my/"){ ?> style="margin-top:27px;" <?PHP } ?> >
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
								   } ?>" class="picture-src" id="wizardPicturePreview"  />
							</div>
							<h6><font size="2em"><b><?php echo strtoupper($getUserDetails->data[0]->ud_first_name); ?> <?php echo strtoupper($getUserDetails->data[0]->ud_last_name); ?> <br>( <?php echo ID_NO; ?> : <?php echo strtoupper($getUserDetails->data[0]->u_displayid); ?>)</b></font></h6>
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<p class="description" ><font color="#f1592a"><?php echo $this2; ?> <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="<?PHP echo $this3; ?>"></span> </font></p>
							<p class="description"><?php echo $this4;?></p>
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<p class="description">
								<textarea style="height:25%;" class="form-control" rows="5" id="word_count" placeholder="<?php echo $this5; ?>" name="review" required=""></textarea>
								<div id="word_left" class="text-right description"><?php echo WORDS_LEFT; ?></div>
							</p>
						</div>
					</div>
					
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<p class="description" ><font color="#f1592a"><?php echo $this6; ?> </font></p>
							<p class="description"><?php echo $this7;?></p>
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<p class="description">
								<textarea style="height:25%;" class="form-control" rows="5" id="word_count2" placeholder="<?php echo $this8; ?>" name="share_about_tutor" ></textarea>
								<div id="word_left2" class="text-right description"><?php echo WORDS_LEFT; ?></div>
							</p>
						</div>
					</div>
					
				</div>
			</div>
			<div class="tab-pane" id="Feedback">
				<div class="row">
					<!--<div class="col-sm-12">
						<h5 class="info-text description"><font color="#f1592a" size="3em"><b> <?php //echo REVIEW_STEP3_TITLE; ?> </b></font></h5>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<p class="description"><?php //echo REVIEW_STEP3_DESCRIPTION; ?></p>
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<p class="description"><?php //echo REVIEW_STEP3_QUESTION; ?></p>
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<p class="description">
								<textarea class="form-control" rows="9" id="word_count2"  name="share_about_tutor" ></textarea>
								<div id="word_left2" class="text-right description"><?php //echo WORDS_LEFT; ?></div>
							</p>
						</div>
					</div>-->
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<center><p class="description" ><font color="#f1592a"><?php echo $this9; ?> <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="<?PHP echo $this12; ?>"></span> </font></p>
							<p class="description"><?php echo $this10;?></p></center>
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<p class="description"><textarea placeholder="<?php echo $this11; ?>" class="form-control" rows="9" id="congratulation-text2" name="tutor_improve" ></textarea></p>
						</div>
					</div> 
					<br>
					<div class="col-sm-10 col-sm-offset-1">
						<div class="form-group">
							<center><img src="images/logo.png" class="img-responsive" alt="tutorkami logo"/></center>
						</div>
					</div> 
					<br><br>
					
				</div>
			</div>
		</div>
		<div class="wizard-footer">
			<div class="pull-right">
				<input type='button' class='btn btn-next btn-fill btn-sample btn-wd' name='next' <?PHP if($getLan == "/my/"){ echo "value='Seterusnya'"; }else{ echo "value='Next'"; } ?> />
				<input id="submitBtn" type='button' class='btn btn-finish btn-fill btn-sample btn-wd' name='finish' <?PHP if($getLan == "/my/"){ echo "value='Hantar'"; }else{ echo "value='Submit'"; } ?> onclick="Finish()"/>

				<input id="submitBtnLoad" type='button' class='hidden btn btn-finish btn-fill btn-sample btn-wd disabled' <?PHP if($getLan == "/my/"){ echo "value='Loading'"; }else{ echo "value='Loading'"; } ?>  />
			</div>
			<div class="pull-left">
				<input type='button' class='btn btn-previous btn-sample btn-wd' name='previous' <?PHP if($getLan == "/my/"){ echo "value='Kembali'"; }else{ echo "value='Previous'"; } ?>  />
			</div>
			<div class="clearfix"></div>
		</div>
	</form>
	</div>

  

	<script src="css/review/jquery.bootstrap.wizard.js" type="text/javascript"></script>
	<script src="css/review/paper-bootstrap-wizard.js" type="text/javascript"></script>
	<script src="css/review/jquery.validate.min.js" type="text/javascript"></script> 


<?PHP				
/* END */

              } elseif ( $_GET['step'] == 2) {

                //include('includes/review_step_2.php');

              } elseif ( $_GET['step'] == 3) {

                //include('includes/review_step_3.php');

              } elseif ( $_GET['step'] == 4) {

                include('includes/review_step_4.php');

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

<script>
$('[data-toggle="tooltip"]').tooltip({
    trigger : 'hover'
})   
</script>