<?php
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?> 
<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> 



</head>
<body>
<style>
html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}b,strong{font-weight:bold}dfn{font-style:italic}h1{font-size:2em;margin:0.67em 0}mark{background:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-0.5em}sub{bottom:-0.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em 40px}hr{-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;height:0}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace, monospace;font-size:1em}button,input,optgroup,select,textarea{color:inherit;font:inherit;margin:0}button{overflow:visible}button,select{text-transform:none}button,html input[type="button"],input[type="reset"],input[type="submit"]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}input{line-height:normal}input[type="checkbox"],input[type="radio"]{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:0}input[type="number"]::-webkit-inner-spin-button,input[type="number"]::-webkit-outer-spin-button{height:auto}input[type="search"]{-webkit-appearance:textfield;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none}fieldset{border:1px solid #c0c0c0;margin:0 2px;padding:0.35em 0.625em 0.75em}legend{border:0;padding:0}textarea{overflow:auto}optgroup{font-weight:bold}table{border-collapse:collapse;border-spacing:0}td,th{padding:0}*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}*:before,*:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}html{font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0)}body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff}input,button,select,textarea{font-family:inherit;font-size:inherit;line-height:inherit}a{color:#337ab7;text-decoration:none}a:hover,a:focus{color:#23527c;text-decoration:underline}a:focus{outline:5px auto -webkit-focus-ring-color;outline-offset:-2px}figure{margin:0}img{vertical-align:middle}.img-responsive{display:block;max-width:100%;height:auto}.img-rounded{border-radius:6px}.img-thumbnail{padding:4px;line-height:1.42857143;background-color:#fff;border:1px solid #ddd;border-radius:4px;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out;display:inline-block;max-width:100%;height:auto}.img-circle{border-radius:50%}hr{margin-top:20px;margin-bottom:20px;border:0;border-top:1px solid #eee}.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);border:0}.sr-only-focusable:active,.sr-only-focusable:focus{position:static;width:auto;height:auto;margin:0;overflow:visible;clip:auto}[role="button"]{cursor:pointer}.btn{display:inline-block;margin-bottom:0;font-weight:normal;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;background-image:none;border:1px solid transparent;padding:6px 12px;font-size:14px;line-height:1.42857143;border-radius:4px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.btn:focus,.btn:active:focus,.btn.active:focus,.btn.focus,.btn:active.focus,.btn.active.focus{outline:5px auto -webkit-focus-ring-color;outline-offset:-2px}.btn:hover,.btn:focus,.btn.focus{color:#333;text-decoration:none}.btn:active,.btn.active{background-image:none;outline:0;-webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,0.125);box-shadow:inset 0 3px 5px rgba(0,0,0,0.125)}.btn.disabled,.btn[disabled],fieldset[disabled] .btn{cursor:not-allowed;filter:alpha(opacity=65);opacity:.65;-webkit-box-shadow:none;box-shadow:none}a.btn.disabled,fieldset[disabled] a.btn{pointer-events:none}.btn-default{color:#333;background-color:#fff;border-color:#ccc}.btn-default:focus,.btn-default.focus{color:#333;background-color:#e6e6e6;border-color:#8c8c8c}.btn-default:hover{color:#333;background-color:#e6e6e6;border-color:#adadad}.btn-default:active,.btn-default.active,.open>.dropdown-toggle.btn-default{color:#333;background-color:#e6e6e6;background-image:none;border-color:#adadad}.btn-default:active:hover,.btn-default.active:hover,.open>.dropdown-toggle.btn-default:hover,.btn-default:active:focus,.btn-default.active:focus,.open>.dropdown-toggle.btn-default:focus,.btn-default:active.focus,.btn-default.active.focus,.open>.dropdown-toggle.btn-default.focus{color:#333;background-color:#d4d4d4;border-color:#8c8c8c}.btn-default.disabled:hover,.btn-default[disabled]:hover,fieldset[disabled] .btn-default:hover,.btn-default.disabled:focus,.btn-default[disabled]:focus,fieldset[disabled] .btn-default:focus,.btn-default.disabled.focus,.btn-default[disabled].focus,fieldset[disabled] .btn-default.focus{background-color:#fff;border-color:#ccc}.btn-default .badge{color:#fff;background-color:#333}.btn-primary{color:#fff;background-color:#337ab7;border-color:#2e6da4}.btn-primary:focus,.btn-primary.focus{color:#fff;background-color:#286090;border-color:#122b40}.btn-primary:hover{color:#fff;background-color:#286090;border-color:#204d74}.btn-primary:active,.btn-primary.active,.open>.dropdown-toggle.btn-primary{color:#fff;background-color:#286090;background-image:none;border-color:#204d74}.btn-primary:active:hover,.btn-primary.active:hover,.open>.dropdown-toggle.btn-primary:hover,.btn-primary:active:focus,.btn-primary.active:focus,.open>.dropdown-toggle.btn-primary:focus,.btn-primary:active.focus,.btn-primary.active.focus,.open>.dropdown-toggle.btn-primary.focus{color:#fff;background-color:#204d74;border-color:#122b40}.btn-primary.disabled:hover,.btn-primary[disabled]:hover,fieldset[disabled] .btn-primary:hover,.btn-primary.disabled:focus,.btn-primary[disabled]:focus,fieldset[disabled] .btn-primary:focus,.btn-primary.disabled.focus,.btn-primary[disabled].focus,fieldset[disabled] .btn-primary.focus{background-color:#337ab7;border-color:#2e6da4}.btn-primary .badge{color:#337ab7;background-color:#fff}.btn-success{color:#fff;background-color:#5cb85c;border-color:#4cae4c}.btn-success:focus,.btn-success.focus{color:#fff;background-color:#449d44;border-color:#255625}.btn-success:hover{color:#fff;background-color:#449d44;border-color:#398439}.btn-success:active,.btn-success.active,.open>.dropdown-toggle.btn-success{color:#fff;background-color:#449d44;background-image:none;border-color:#398439}.btn-success:active:hover,.btn-success.active:hover,.open>.dropdown-toggle.btn-success:hover,.btn-success:active:focus,.btn-success.active:focus,.open>.dropdown-toggle.btn-success:focus,.btn-success:active.focus,.btn-success.active.focus,.open>.dropdown-toggle.btn-success.focus{color:#fff;background-color:#398439;border-color:#255625}.btn-success.disabled:hover,.btn-success[disabled]:hover,fieldset[disabled] .btn-success:hover,.btn-success.disabled:focus,.btn-success[disabled]:focus,fieldset[disabled] .btn-success:focus,.btn-success.disabled.focus,.btn-success[disabled].focus,fieldset[disabled] .btn-success.focus{background-color:#5cb85c;border-color:#4cae4c}.btn-success .badge{color:#5cb85c;background-color:#fff}.btn-info{color:#fff;background-color:#5bc0de;border-color:#46b8da}.btn-info:focus,.btn-info.focus{color:#fff;background-color:#31b0d5;border-color:#1b6d85}.btn-info:hover{color:#fff;background-color:#31b0d5;border-color:#269abc}.btn-info:active,.btn-info.active,.open>.dropdown-toggle.btn-info{color:#fff;background-color:#31b0d5;background-image:none;border-color:#269abc}.btn-info:active:hover,.btn-info.active:hover,.open>.dropdown-toggle.btn-info:hover,.btn-info:active:focus,.btn-info.active:focus,.open>.dropdown-toggle.btn-info:focus,.btn-info:active.focus,.btn-info.active.focus,.open>.dropdown-toggle.btn-info.focus{color:#fff;background-color:#269abc;border-color:#1b6d85}.btn-info.disabled:hover,.btn-info[disabled]:hover,fieldset[disabled] .btn-info:hover,.btn-info.disabled:focus,.btn-info[disabled]:focus,fieldset[disabled] .btn-info:focus,.btn-info.disabled.focus,.btn-info[disabled].focus,fieldset[disabled] .btn-info.focus{background-color:#5bc0de;border-color:#46b8da}.btn-info .badge{color:#5bc0de;background-color:#fff}.btn-warning{color:#fff;background-color:#f0ad4e;border-color:#eea236}.btn-warning:focus,.btn-warning.focus{color:#fff;background-color:#ec971f;border-color:#985f0d}.btn-warning:hover{color:#fff;background-color:#ec971f;border-color:#d58512}.btn-warning:active,.btn-warning.active,.open>.dropdown-toggle.btn-warning{color:#fff;background-color:#ec971f;background-image:none;border-color:#d58512}.btn-warning:active:hover,.btn-warning.active:hover,.open>.dropdown-toggle.btn-warning:hover,.btn-warning:active:focus,.btn-warning.active:focus,.open>.dropdown-toggle.btn-warning:focus,.btn-warning:active.focus,.btn-warning.active.focus,.open>.dropdown-toggle.btn-warning.focus{color:#fff;background-color:#d58512;border-color:#985f0d}.btn-warning.disabled:hover,.btn-warning[disabled]:hover,fieldset[disabled] .btn-warning:hover,.btn-warning.disabled:focus,.btn-warning[disabled]:focus,fieldset[disabled] .btn-warning:focus,.btn-warning.disabled.focus,.btn-warning[disabled].focus,fieldset[disabled] .btn-warning.focus{background-color:#f0ad4e;border-color:#eea236}.btn-warning .badge{color:#f0ad4e;background-color:#fff}.btn-danger{color:#fff;background-color:#d9534f;border-color:#d43f3a}.btn-danger:focus,.btn-danger.focus{color:#fff;background-color:#c9302c;border-color:#761c19}.btn-danger:hover{color:#fff;background-color:#c9302c;border-color:#ac2925}.btn-danger:active,.btn-danger.active,.open>.dropdown-toggle.btn-danger{color:#fff;background-color:#c9302c;background-image:none;border-color:#ac2925}.btn-danger:active:hover,.btn-danger.active:hover,.open>.dropdown-toggle.btn-danger:hover,.btn-danger:active:focus,.btn-danger.active:focus,.open>.dropdown-toggle.btn-danger:focus,.btn-danger:active.focus,.btn-danger.active.focus,.open>.dropdown-toggle.btn-danger.focus{color:#fff;background-color:#ac2925;border-color:#761c19}.btn-danger.disabled:hover,.btn-danger[disabled]:hover,fieldset[disabled] .btn-danger:hover,.btn-danger.disabled:focus,.btn-danger[disabled]:focus,fieldset[disabled] .btn-danger:focus,.btn-danger.disabled.focus,.btn-danger[disabled].focus,fieldset[disabled] .btn-danger.focus{background-color:#d9534f;border-color:#d43f3a}.btn-danger .badge{color:#d9534f;background-color:#fff}.btn-link{font-weight:400;color:#337ab7;border-radius:0}.btn-link,.btn-link:active,.btn-link.active,.btn-link[disabled],fieldset[disabled] .btn-link{background-color:transparent;-webkit-box-shadow:none;box-shadow:none}.btn-link,.btn-link:hover,.btn-link:focus,.btn-link:active{border-color:transparent}.btn-link:hover,.btn-link:focus{color:#23527c;text-decoration:underline;background-color:transparent}.btn-link[disabled]:hover,fieldset[disabled] .btn-link:hover,.btn-link[disabled]:focus,fieldset[disabled] .btn-link:focus{color:#777;text-decoration:none}.btn-lg,.btn-group-lg>.btn{padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}.btn-sm,.btn-group-sm>.btn{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}.btn-xs,.btn-group-xs>.btn{padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px}.btn-block{display:block;width:100%}.btn-block+.btn-block{margin-top:5px}input[type="submit"].btn-block,input[type="reset"].btn-block,input[type="button"].btn-block{width:100%}.btn-group,.btn-group-vertical{position:relative;display:inline-block;vertical-align:middle}.btn-group>.btn,.btn-group-vertical>.btn{position:relative;float:left}.btn-group>.btn:hover,.btn-group-vertical>.btn:hover,.btn-group>.btn:focus,.btn-group-vertical>.btn:focus,.btn-group>.btn:active,.btn-group-vertical>.btn:active,.btn-group>.btn.active,.btn-group-vertical>.btn.active{z-index:2}.btn-group .btn+.btn,.btn-group .btn+.btn-group,.btn-group .btn-group+.btn,.btn-group .btn-group+.btn-group{margin-left:-1px}.btn-toolbar{margin-left:-5px}.btn-toolbar .btn,.btn-toolbar .btn-group,.btn-toolbar .input-group{float:left}.btn-toolbar>.btn,.btn-toolbar>.btn-group,.btn-toolbar>.input-group{margin-left:5px}.btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle){border-radius:0}.btn-group>.btn:first-child{margin-left:0}.btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle){border-top-right-radius:0;border-bottom-right-radius:0}.btn-group>.btn:last-child:not(:first-child),.btn-group>.dropdown-toggle:not(:first-child){border-top-left-radius:0;border-bottom-left-radius:0}.btn-group>.btn-group{float:left}.btn-group>.btn-group:not(:first-child):not(:last-child)>.btn{border-radius:0}.btn-group>.btn-group:first-child:not(:last-child)>.btn:last-child,.btn-group>.btn-group:first-child:not(:last-child)>.dropdown-toggle{border-top-right-radius:0;border-bottom-right-radius:0}.btn-group>.btn-group:last-child:not(:first-child)>.btn:first-child{border-top-left-radius:0;border-bottom-left-radius:0}.btn-group .dropdown-toggle:active,.btn-group.open .dropdown-toggle{outline:0}.btn-group>.btn+.dropdown-toggle{padding-right:8px;padding-left:8px}.btn-group>.btn-lg+.dropdown-toggle{padding-right:12px;padding-left:12px}.btn-group.open .dropdown-toggle{-webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,0.125);box-shadow:inset 0 3px 5px rgba(0,0,0,0.125)}.btn-group.open .dropdown-toggle.btn-link{-webkit-box-shadow:none;box-shadow:none}.btn .caret{margin-left:0}.btn-lg .caret{border-width:5px 5px 0;border-bottom-width:0}.dropup .btn-lg .caret{border-width:0 5px 5px}.btn-group-vertical>.btn,.btn-group-vertical>.btn-group,.btn-group-vertical>.btn-group>.btn{display:block;float:none;width:100%;max-width:100%}.btn-group-vertical>.btn-group>.btn{float:none}.btn-group-vertical>.btn+.btn,.btn-group-vertical>.btn+.btn-group,.btn-group-vertical>.btn-group+.btn,.btn-group-vertical>.btn-group+.btn-group{margin-top:-1px;margin-left:0}.btn-group-vertical>.btn:not(:first-child):not(:last-child){border-radius:0}.btn-group-vertical>.btn:first-child:not(:last-child){border-top-left-radius:4px;border-top-right-radius:4px;border-bottom-right-radius:0;border-bottom-left-radius:0}.btn-group-vertical>.btn:last-child:not(:first-child){border-top-left-radius:0;border-top-right-radius:0;border-bottom-right-radius:4px;border-bottom-left-radius:4px}.btn-group-vertical>.btn-group:not(:first-child):not(:last-child)>.btn{border-radius:0}.btn-group-vertical>.btn-group:first-child:not(:last-child)>.btn:last-child,.btn-group-vertical>.btn-group:first-child:not(:last-child)>.dropdown-toggle{border-bottom-right-radius:0;border-bottom-left-radius:0}.btn-group-vertical>.btn-group:last-child:not(:first-child)>.btn:first-child{border-top-left-radius:0;border-top-right-radius:0}.btn-group-justified{display:table;width:100%;table-layout:fixed;border-collapse:separate}.btn-group-justified>.btn,.btn-group-justified>.btn-group{display:table-cell;float:none;width:1%}.btn-group-justified>.btn-group .btn{width:100%}.btn-group-justified>.btn-group .dropdown-menu{left:auto}[data-toggle="buttons"]>.btn input[type="radio"],[data-toggle="buttons"]>.btn-group>.btn input[type="radio"],[data-toggle="buttons"]>.btn input[type="checkbox"],[data-toggle="buttons"]>.btn-group>.btn input[type="checkbox"]{position:absolute;clip:rect(0, 0, 0, 0);pointer-events:none}.clearfix:before,.clearfix:after,.btn-toolbar:before,.btn-toolbar:after,.btn-group-vertical>.btn-group:before,.btn-group-vertical>.btn-group:after{display:table;content:" "}.clearfix:after,.btn-toolbar:after,.btn-group-vertical>.btn-group:after{clear:both}.center-block{display:block;margin-right:auto;margin-left:auto}.pull-right{float:right !important}.pull-left{float:left !important}.hide{display:none !important}.show{display:block !important}.invisible{visibility:hidden}.text-hide{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0}.hidden{display:none !important}.affix{position:fixed}

</style>
<br/>
<!--<a target="_blank" style="margin-left:50px" href="record-migration-proof.php" class="btn btn-info" role="button">Proof Of Accepting Term Image</a>
<a target="_blank" href="record-migration-testimonial.php" class="btn btn-info" role="button">Testimonial  Image</a>
-->
<br/>

<!-- START PROFILE PICTURE -->
<p><font size="10" color="green">USER PICTURE  (NOT NULL) </font></p>
<table id="example" class="display" style="width:100%"> 
	<thead> 
		<tr> 
			<th>No</th> 
			<th>Id (u_id)</th> 
			<th>display id (u_displayid)</th> 
			<th><font color="blue"><b>Picture (u_profile_pic)</b></font></th> 
			<th>email (u_email)</th> 
			<th>role (u_role)</th> 
			<th>username (u_username)</th> 
		</tr> 
	</thead> 
	<tbody> 
<?php
$no = 1;
$Picture = "SELECT * FROM tk_user WHERE u_role != '0' AND u_role != '1' AND u_role != '2' AND u_profile_pic !=''";
$resultPicture = $conn->query($Picture);
if ($resultPicture->num_rows > 0) {
    while($rowPicture = $resultPicture->fetch_assoc()) {
?>
	
		<tr> 
			<td><?php echo $no; ?></td> 
			<td><center><?php echo $rowPicture["u_id"]; ?></center></td> 
			<td><center><?php echo $rowPicture["u_displayid"]; ?></center></td> 
			<td><center><?php //echo $rowPicture["u_profile_pic"]; 
				//$pix = sprintf("%'.07d\n", $rowPicture['u_profile_pic']);
				$pix = sprintf("%'.07d", $rowPicture['u_profile_pic']);
				$pixAll = $pix.'_0.jpg';
				
				$thisFolder = 'http://tutorkami.com/images/profile/'.$pixAll;

				if (@getimagesize($thisFolder)) {
					echo '<img width="42" height="42" style="border-radius:50%;" src="http://tutorkami.com/images/profile/'.$pixAll.'">';
				}else{
					echo $pixAll;
				}

			?></center></td> 
			<td><center><?php echo $rowPicture["u_email"]; ?></center></td> 
			<td><center><?php echo $rowPicture["u_role"]; ?></center></td> 
			<td><center><?php echo $rowPicture["u_username"]; ?></center></td> 
		</tr> 
<?php				
$no++;
    }
} 
//$conn->close();
?>

	</tbody>
</table>
<!-- END PROFILE PICTURE-->


<!-- START PROOF PICTURE -->
<p><font size="10" color="green">PROOF PICTURE  (NOT NULL) </font></p>
<table id="example2" class="display" style="width:100%"> 
	<thead> 
		<tr> 
			<th>No</th> 
			<th>Id (ud_id)</th> 
			<th>display id (u_displayid)</th> 
			<th>email (u_email)</th> 
			<th>role (u_role)</th> 
			<th>username (u_username)</th> 
			<th><font color="blue"><b>folder</b></font></th> 
		</tr> 
	</thead> 
	<tbody> 
<?php
$no = 1; //117	6430	1270953
$Proof = "SELECT tk_user_details.ud_id, tk_user_details.ud_u_id, tk_user_details.ud_proof_of_accepting_terms,
tk_user.u_id, tk_user.u_displayid, tk_user.u_email, tk_user.u_role, tk_user.u_username
FROM tk_user_details
LEFT JOIN tk_user ON tk_user_details.ud_u_id = tk_user.u_id WHERE ud_proof_of_accepting_terms !=''";
//$Proof = "SELECT * FROM tk_user_details WHERE ud_proof_of_accepting_terms !=''";
$resultProof = $conn->query($Proof);
if ($resultProof->num_rows > 0) {
    while($rowProof = $resultProof->fetch_assoc()) {
?>
	
		<tr> 
			<td><?php echo $no; ?></td> 
			<td><center><?php echo $rowProof["ud_id"]; ?></center></td>  
			<td><center><?php echo $rowProof["u_displayid"]; ?></center></td> 
			<td><center><?php echo $rowProof["u_email"]; ?></center></td> 
			<td><center><?php echo $rowProof["u_role"]; ?></center></td> 
			<td><center><?php echo $rowProof["u_username"]; ?></center></td> 
			<td><center><?php //echo $rowProof["ud_proof_of_accepting_terms"]; 
				$thisFolder = 'http://tutorkami.com/'.$rowProof["ud_proof_of_accepting_terms"];

				if (@getimagesize($thisFolder)) {
					echo '<img width="42" height="42" style="border-radius:50%;" src="http://tutorkami.com/'.$rowProof["ud_proof_of_accepting_terms"].'">';
				}else{
					echo $rowProof["ud_proof_of_accepting_terms"];
				}
			
			?></center></td> 
		</tr> 
<?php				
$no++;
    }
} 
//$conn->close();
?>

	</tbody>
</table>
<!-- END PROOF PICTURE-->


<!-- START PROOF TESTIMONIAL -->
<p><font size="10" color="green">TESTIMONIAL PICTURE  (NOT NULL) </font></p>
<table id="example3" class="display" style="width:100%"> 
	<thead> 
		<tr> 
			<th>No</th> 
			<th>Id (ut_id)</th> 
			<th>display id (u_displayid)</th> 
			<th>email (u_email)</th> 
			<th>role (u_role)</th> 
			<th>username (u_username)</th> 
			<th><font color="blue"><b>folder</b></font></th> 
		</tr> 
	</thead> 
	<tbody> 
<?php
$no = 1; //117	6430	1270953
$Testimonial = "SELECT tk_user_testimonial.ut_id, tk_user_testimonial.ut_user_testimonial1, tk_user_testimonial.ut_user_testimonial2, tk_user_testimonial.ut_user_testimonial3, tk_user_testimonial.ut_user_testimonial4, tk_user_testimonial.ut_user_testimonial5,
tk_user.u_id, tk_user.u_displayid, tk_user.u_email, tk_user.u_role, tk_user.u_username
FROM tk_user_testimonial
LEFT JOIN tk_user ON tk_user_testimonial.ut_u_id = tk_user.u_id WHERE ut_user_testimonial1 !='' OR ut_user_testimonial2 !='' OR ut_user_testimonial3 !='' OR ut_user_testimonial4 !='' OR ut_user_testimonial5 !=''";
//$Testimonial = "SELECT * FROM tk_user_testimonial WHERE ut_user_testimonial1 !='' OR ut_user_testimonial2 !='' OR ut_user_testimonial3 !='' OR ut_user_testimonial4 !='' OR ut_user_testimonial5 !=''";
$resultTestimonial = $conn->query($Testimonial);
if ($resultTestimonial->num_rows > 0) {
    while($rowTestimonial = $resultTestimonial->fetch_assoc()) {
?>
	
		<tr> 
			<td><?php echo $no; ?></td> 
			<td><center><?php echo $rowTestimonial["ut_id"]; ?></center></td>  
			<td><center><?php echo $rowTestimonial["u_displayid"]; ?></center></td> 
			<td><center><?php echo $rowTestimonial["u_email"]; ?></center></td> 
			<td><center><?php echo $rowTestimonial["u_role"]; ?></center></td> 
			<td><center><?php echo $rowTestimonial["u_username"]; ?></center></td> 
			<td><center><?php 
				if($rowTestimonial["ut_user_testimonial1"] != ''){
					//echo "<font color='red'>1: </font>".$rowTestimonial["ut_user_testimonial1"]."<br/>";
					$thisFolder1 = 'http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial1"];
					if (@getimagesize($thisFolder1)) {
						echo '<font color="red">1: </font> <img width="42" height="42" style="border-radius:50%;" src="http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial1"].'">';
					}else{
						echo "<font color='red'>1: </font>".$rowTestimonial["ut_user_testimonial1"]."<br/>";
					}
					
				}
				if($rowTestimonial["ut_user_testimonial2"] != ''){
					//echo "<font color='red'>2: </font>".$rowTestimonial["ut_user_testimonial2"]."<br/>";
					$thisFolder2 = 'http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial2"];
					if (@getimagesize($thisFolder2)) {
						echo '<font color="red">2: </font> <img width="42" height="42" style="border-radius:50%;" src="http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial2"].'">';
					}else{
						echo "<font color='red'>2: </font>".$rowTestimonial["ut_user_testimonial2"]."<br/>";
					}
				}
				if($rowTestimonial["ut_user_testimonial3"] != ''){
					//echo "<font color='red'>3: </font>".$rowTestimonial["ut_user_testimonial3"]."<br/>";
					$thisFolder3 = 'http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial3"];
					if (@getimagesize($thisFolder3)) {
						echo '<font color="red">3: </font> <img width="42" height="42" style="border-radius:50%;" src="http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial3"].'">';
					}else{
						echo "<font color='red'>3: </font>".$rowTestimonial["ut_user_testimonial3"]."<br/>";
					}
				}
				if($rowTestimonial["ut_user_testimonial4"] != ''){
					//echo "<font color='red'>4: </font>".$rowTestimonial["ut_user_testimonial4"]."<br/>";
					$thisFolder4 = 'http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial4"];
					if (@getimagesize($thisFolder4)) {
						echo '<font color="red">4: </font> <img width="42" height="42" style="border-radius:50%;" src="http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial4"].'">';
					}else{
						echo "<font color='red'>4: </font>".$rowTestimonial["ut_user_testimonial4"]."<br/>";
					}
				}
				if($rowTestimonial["ut_user_testimonial5"] != ''){
					//echo "<font color='red'>5: </font>".$rowTestimonial["ut_user_testimonial5"]."<br/>";
					$thisFolder5 = 'http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial5"];
					if (@getimagesize($thisFolder5)) {
						echo '<font color="red">5: </font> <img width="42" height="42" style="border-radius:50%;" src="http://tutorkami.com/'.$rowTestimonial["ut_user_testimonial5"].'">';
					}else{
						echo "<font color='red'>5: </font>".$rowTestimonial["ut_user_testimonial5"]."<br/>";
					}
				}
			?></center></td> 
		</tr> 
<?php				
$no++;
    }
} 
$conn->close();
?>

	</tbody>
</table>
<!-- END PROOF TESTIMONIAL-->

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
		pageLength: 30,
        dom: 'Bfrtip',
        buttons: [
			'colvis'
        ]
    } );
} );

$(document).ready(function() {
    $('#example2').DataTable( {
		pageLength: 30,
        dom: 'Bfrtip',
        buttons: [
			'colvis'
        ]
    } );
} );

$(document).ready(function() {
    $('#example3').DataTable( {
  "columns": [
    null,
    null,
    null,
    null,
    null,
    null,
    { "width": "40%" }
  ],
		pageLength: 30,
        dom: 'Bfrtip',
        buttons: [
			'colvis'
        ]
    } );
} );

</script>


</body>
</html>