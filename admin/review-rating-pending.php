<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;
$instUser = new user;
if(isset($_REQUEST['rr'])){
 $arrReview = $instApp->GetTutorReview($_REQUEST['rr']);

 if(isset($_REQUEST['rr-save'])){

 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->UpdateTutorReview($data);
 
   header('Location:review-rating-pending.php');
   exit();
 }
}
else{
if(isset($_REQUEST['rrd'])){
  $res = $instApp->DeleteTutorReview($_REQUEST['rrd']);
}
$resReview = $instApp->FetchTutorReviewPending(); 
} 

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
   $title = 'Review and Rating List - Pending | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>
</head>
<body>
    <div id="wrapper">
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php'); ?>
            
            <?php
				/*if($_SESSION[DB_PREFIX]['u_first_name'] != 'mohd nurfadhli'){
					echo "<font color='red' size='5'> under construction</font>";
					exit();
				}*/
            ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}
//$dbCon->close();
?>
<style>
.btn-alert { 
  color: #ffffff; 
  background-color: #C71414; 
  border-color: #C71414; 
} 
 
.btn-alert:hover, 
.btn-alert:focus, 
.btn-alert:active, 
.btn-alert.active, 
.open .dropdown-toggle.btn-alert { 
  color: #ffffff; 
  background-color: #9E1919; 
  border-color: #C71414; 
} 
 
.btn-alert:active, 
.btn-alert.active, 
.open .dropdown-toggle.btn-alert { 
  background-image: none; 
} 
 
.btn-alert.disabled, 
.btn-alert[disabled], 
fieldset[disabled] .btn-alert, 
.btn-alert.disabled:hover, 
.btn-alert[disabled]:hover, 
fieldset[disabled] .btn-alert:hover, 
.btn-alert.disabled:focus, 
.btn-alert[disabled]:focus, 
fieldset[disabled] .btn-alert:focus, 
.btn-alert.disabled:active, 
.btn-alert[disabled]:active, 
fieldset[disabled] .btn-alert:active, 
.btn-alert.disabled.active, 
.btn-alert[disabled].active, 
fieldset[disabled] .btn-alert.active { 
  background-color: #C71414; 
  border-color: #C71414; 
} 
 
.btn-alert .badge { 
  color: #C71414; 
  background-color: #ffffff; 
}
</style>
            <div class="wrapper wrapper-content animated fadeInRight">
             <div class="row">
              <div class="col-lg-12">
               <div class="ibox float-e-margins">
                <div class="ibox-title">
                 <h5>Pending Ratings & Reviews</h5>
                 <div class="el-right">
                  </div>
          </div>
          <div class="ibox-content">
          <?php if(isset($_REQUEST['rr'])){?>
   <form class="form-horizontal" action="" method="post">    <input type="hidden" name="rr_id" id="rr_id" value="<?php echo isset($_REQUEST['rr']) ? $arrReview['rr_id'] : ''; ?>">

          <div class="form-group"><label class="col-lg-3 control-label">Job ID:</label>
              <div class="col-lg-7" style="margin-top:5px;">
<?php 
$queryTutor = " SELECT * FROM tk_user WHERE u_id='".$arrReview['rr_tutor_id']."'";
$resultTutor = $conDB->query($queryTutor); 
if($resultTutor->num_rows > 0){ 
	$rowTutor = $resultTutor->fetch_assoc();
	$valueTutor = $rowTutor['u_email']; 
}
$queryParent = " SELECT * FROM tk_user WHERE u_id='".$arrReview['rr_parent_id']."' ";
$resultParent = $conDB->query($queryParent); 
if($resultParent->num_rows > 0){ 
	$rowParent = $resultParent->fetch_assoc();
	$valueParent = $rowParent['u_email']; 

}
$queryJob = " SELECT * FROM tk_job WHERE j_email='".$valueParent."' AND j_hired_tutor_email='".$valueTutor."' ";
$resultQueryJob = $conDB->query($queryJob); 
if($resultQueryJob->num_rows > 0){ 
	while($rowQueryJob = $resultQueryJob->fetch_assoc()){
		echo '<label class="label label-primary"><a href="https://www.tutorkami.com/admin/job-edit?j='.$rowQueryJob['j_id'].'" target="_blank" title="ID : '.$rowQueryJob['j_id'].'" style="color:#FFF; text-decoration: none;">'.$rowQueryJob['j_id'].'</a></label> ';
	}
}else{
	echo '<label class="label label-danger"><a href="" target="_blank" title="" style="color:#FFF; text-decoration: none;"></a>Error</label> ';
}
//$dbCon->close();
?>
				
                              
              </div>
          </div>
		  <div class="form-group"><label class="col-lg-3 control-label">Rating:</label>
              <div class="col-lg-7">
                  <!--<input type="text" class="form-control hidden" name="rr_rating" value="<?php //echo isset($_REQUEST['rr']) ? $arrReview['rr_rating'] : ''; ?>" required> -->
                    <?php
                    /*
                    if (strpos($arrReview['rr_rating'], ".") !== false) {
                        $beforeDecimal = explode('.',$arrReview['rr_rating']);
                    	for($i = 0; $i < $beforeDecimal[0]; $i++) { ?>
                    	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                    	<?php } ?>
                    	<span class="rating-input"><span data-value="0" class="fa fa-star-half" style="color:orange;font-size: 20px;"></span></span><?php
                    }else{
                    	for($i = 0; $i < $arrReview['rr_rating']; $i++) { ?>
                    	<span class="rating-input"><span data-value="0" class="fa fa-star" style="color:orange;font-size: 20px;"></span></span>
                    	<?php }
                    } */
                    ?>
                    
                    
                    
                    
                    
                    
<style>
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

fieldset, label { margin: 0; padding: 0; }
body{ margin: 20px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.85em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFC300;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFC300;  } 
</style>

<fieldset class="rating">
    <input <?PHP if( $arrReview['rr_rating'] == '5' ){ echo 'checked'; } ?>   type="radio" id="star5"     name="inputRating" value="5" /><label class = "full" for="star5"     title="Awesome - 5 stars"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '4.5' ){ echo 'checked'; } ?> type="radio" id="star4half" name="inputRating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '4' ){ echo 'checked'; } ?>   type="radio" id="star4"     name="inputRating" value="4" /><label class = "full" for="star4"     title="Pretty good - 4 stars"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '3.5' ){ echo 'checked'; } ?> type="radio" id="star3half" name="inputRating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '3' ){ echo 'checked'; } ?>   type="radio" id="star3"     name="inputRating" value="3" /><label class = "full" for="star3"     title="Meh - 3 stars"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '2.5' ){ echo 'checked'; } ?> type="radio" id="star2half" name="inputRating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '2' ){ echo 'checked'; } ?>   type="radio" id="star2"     name="inputRating" value="2" /><label class = "full" for="star2"     title="Kinda bad - 2 stars"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '1.5' ){ echo 'checked'; } ?> type="radio" id="star1half" name="inputRating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '1' ){ echo 'checked'; } ?>   type="radio" id="star1"     name="inputRating" value="1" /><label class = "full" for="star1"     title="Low big time - 1 star"></label>
    <input <?PHP if( $arrReview['rr_rating'] == '0.5' ){ echo 'checked'; } ?> type="radio" id="starhalf"  name="inputRating" value="0.5" /><label class="half" for="starhalf"  title="Low big time - 0.5 stars"></label>
</fieldset>
                    
                    
                    
                    
                    
                    
                    
                    
              </div>
          </div>
          <div class="form-group"><label class="col-lg-3 control-label">Review:</label>

              <div class="col-lg-7">
               
               <textarea class="form-control" rows="5" name="rr_review" required><?php echo isset($_REQUEST['rr']) ? $arrReview['rr_review'] : ''; ?></textarea>   

             </div>
          </div>
          <div class="form-group"><label class="col-lg-3 control-label">Private feedback (Tutor):</label>

              <div class="col-lg-7">
               
               <textarea class="form-control" rows="5" name="rr_about_tutor" required><?php echo isset($_REQUEST['rr']) ? $arrReview['rr_about_tutor'] : ''; ?></textarea>   

             </div>
          </div>
          <div class="form-group"><label class="col-lg-3 control-label">Private feedback (Company):</label>

              <div class="col-lg-7">
               
               <textarea class="form-control" rows="5" name="rr_tutor_improve" required><?php echo isset($_REQUEST['rr']) ? $arrReview['rr_tutor_improve'] : ''; ?></textarea>   

             </div>
          </div>                           
          <div class="form-group"><label class="col-lg-3 control-label">Review Status:</label>
            
            <div class="col-lg-7"><select class="form-control" name="rr_status">
              <option value="">Select  Status</option>
              <option value="approved" <?php if(isset($_REQUEST['rr'])) echo $arrReview['rr_status']=="approved"?'selected':''?>>Approved</option>
              <option value="disapproved" <?php if(isset($_REQUEST['rr'])) echo $arrReview['rr_status']=="disapproved"?'selected':''?>>Disapproved</option>
              <option value="not approved" <?php if(isset($_REQUEST['rr'])) echo $arrReview['rr_status']=="not approved"?'selected':''?>>Not Approved</option>
            </select></div>
          </div>                                                             
          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-secondary sign-btn-box mrg-right-15" type="button" onClick="backToList()"><i class="glyphicon glyphicon-hand-left"></i> Back</button>
             <button class="btn btn-sm btn-alert sign-btn-box mrg-right-15" onClick="return ConfirmDelete('<?php echo $arrReview['rr_id'];?>');" ><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
			 
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="rr-save"><i class="glyphicon glyphicon-check"></i> Save</button>

           </div>
         </div>

       </form>
<?php } else {?>

             <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
              
<div class="row">

   <div class="col-sm-12">
   

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"></style>
<style>
[data-tooltip],
.tooltip {
  position: relative;
  cursor: pointer;
}

/* Base styles for the entire tooltip */
[data-tooltip]:before,
[data-tooltip]:after,
.tooltip:before,
.tooltip:after {
  position: absolute;
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: 
      opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        -webkit-transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
    -moz-transition:    
        opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        -moz-transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
    transition:         
        opacity 0.2s ease-in-out,
        visibility 0.2s ease-in-out,
        transform 0.2s cubic-bezier(0.71, 1.7, 0.77, 1.24);
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform:    translate3d(0, 0, 0);
  transform:         translate3d(0, 0, 0);
  pointer-events: none;
}

/* Show the entire tooltip on hover and focus */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after,
[data-tooltip]:focus:before,
[data-tooltip]:focus:after,
.tooltip:hover:before,
.tooltip:hover:after,
.tooltip:focus:before,
.tooltip:focus:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

/* Base styles for the tooltip's directional arrow */
.tooltip:before,
[data-tooltip]:before {
  z-index: 1001;
  border: 6px solid transparent;
  background: transparent;
  content: "";
}

/* Base styles for the tooltip's content area */
.tooltip:after,
[data-tooltip]:after {
  z-index: 1000;
  padding: 8px;
  /*width: 160px;*/ width:700px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  font-size: 14px;
  line-height: 1.2;
}

/* Directions */

/* Top (default) */
[data-tooltip]:before,
[data-tooltip]:after,
.tooltip:before,
.tooltip:after,
.tooltip-top:before,
.tooltip-top:after {
  bottom: 100%;
  left: 50%;
}

[data-tooltip]:before,
.tooltip:before,
.tooltip-top:before {
  margin-left: -6px;
  margin-bottom: -12px;
  border-top-color: #000;
  border-top-color: hsla(0, 0%, 20%, 0.9);
}

/* Horizontally align top/bottom tooltips */
[data-tooltip]:after,
.tooltip:after,
.tooltip-top:after {
  margin-left: -80px;
}

[data-tooltip]:hover:before,
[data-tooltip]:hover:after,
[data-tooltip]:focus:before,
[data-tooltip]:focus:after,
.tooltip:hover:before,
.tooltip:hover:after,
.tooltip:focus:before,
.tooltip:focus:after,
.tooltip-top:hover:before,
.tooltip-top:hover:after,
.tooltip-top:focus:before,
.tooltip-top:focus:after {
  -webkit-transform: translateY(-12px);
  -moz-transform:    translateY(-12px);
  transform:         translateY(-12px); 
}

/* Left */
.tooltip-left:before,
.tooltip-left:after {
  right: 100%;
  bottom: 50%;
  left: auto;
}

.tooltip-left:before {
  margin-left: 0;
  margin-right: -12px;
  margin-bottom: 0;
  border-top-color: transparent;
  border-left-color: #000;
  border-left-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-left:hover:before,
.tooltip-left:hover:after,
.tooltip-left:focus:before,
.tooltip-left:focus:after {
  -webkit-transform: translateX(-12px);
  -moz-transform:    translateX(-12px);
  transform:         translateX(-12px); 
}

/* Bottom */
.tooltip-bottom:before,
.tooltip-bottom:after {
  top: 100%;
  bottom: auto;
  left: 50%;
}

.tooltip-bottom:before {
  margin-top: -12px;
  margin-bottom: 0;
  border-top-color: transparent;
  border-bottom-color: #000;
  border-bottom-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-bottom:hover:before,
.tooltip-bottom:hover:after,
.tooltip-bottom:focus:before,
.tooltip-bottom:focus:after {
  -webkit-transform: translateY(12px);
  -moz-transform:    translateY(12px);
  transform:         translateY(12px); 
}

/* Right */
.tooltip-right:before,
.tooltip-right:after {
  bottom: 50%;
  left: 100%;
}

.tooltip-right:before {
  margin-bottom: 0;
  margin-left: -12px;
  border-top-color: transparent;
  border-right-color: #000;
  border-right-color: hsla(0, 0%, 20%, 0.9);
}

.tooltip-right:hover:before,
.tooltip-right:hover:after,
.tooltip-right:focus:before,
.tooltip-right:focus:after {
  -webkit-transform: translateX(12px);
  -moz-transform:    translateX(12px);
  transform:         translateX(12px); 
}

/* Move directional arrows down a bit for left/right tooltips */
.tooltip-left:before,
.tooltip-right:before {
  top: 3px;
}

/* Vertically center tooltip content for left/right tooltips */
.tooltip-left:after,
.tooltip-right:after {
  margin-left: 0;
  margin-bottom: -16px;
}

.btn-sample { 
  color: #ffffff; 
  background-color: #31753B; 
  border-color: #31753B; 
} 
 
.btn-sample:hover, 
.btn-sample:focus, 
.btn-sample:active, 
.btn-sample.active, 
.open .dropdown-toggle.btn-sample { 
  color: #ffffff; 
  background-color: #205722; 
  border-color: #31753B; 
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
  background-color: #31753B; 
  border-color: #31753B; 
} 
 
.btn-sample .badge { 
  color: #31753B; 
  background-color: #ffffff; 
}
.btn-edit { 
  color: #ffffff; 
  background-color: #188DB8; 
  border-color: #188DB8; 
} 
 
.btn-edit:hover, 
.btn-edit:focus, 
.btn-edit:active, 
.btn-edit.active, 
.open .dropdown-toggle.btn-edit { 
  color: #ffffff; 
  background-color: #237694; 
  border-color: #188DB8; 
} 
 
.btn-edit:active, 
.btn-edit.active, 
.open .dropdown-toggle.btn-edit { 
  background-image: none; 
} 
 
.btn-edit.disabled, 
.btn-edit[disabled], 
fieldset[disabled] .btn-edit, 
.btn-edit.disabled:hover, 
.btn-edit[disabled]:hover, 
fieldset[disabled] .btn-edit:hover, 
.btn-edit.disabled:focus, 
.btn-edit[disabled]:focus, 
fieldset[disabled] .btn-edit:focus, 
.btn-edit.disabled:active, 
.btn-edit[disabled]:active, 
fieldset[disabled] .btn-edit:active, 
.btn-edit.disabled.active, 
.btn-edit[disabled].active, 
fieldset[disabled] .btn-edit.active { 
  background-color: #188DB8; 
  border-color: #188DB8; 
} 
 
.btn-edit .badge { 
  color: #188DB8; 
  background-color: #ffffff; 
}
</style>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Tutor</th>
                <th>Parent</th>
                <th>Review</th>
                <th>Ori Date</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if($resReview->num_rows>0){
			while($arrReview = $resReview->fetch_assoc()) {
				$arrParent = $instUser->allUserInfo($arrReview['rr_parent_id']); 
				$arrTutor = $instUser->allUserInfo($arrReview['rr_tutor_id']);
				?>
            <tr>
                <td><a href="manage_user?action=edit&u_id=<?php echo $arrTutor['u_displayid']; ?>" target="_blank"><?php echo $arrTutor['u_displayname']; ?></a></td>
                <td><a href="manage_user?action=edit&u_id=<?php echo $arrParent['u_displayid']; ?>" target="_blank"><?php echo $arrParent['ud_first_name']; ?></a></td>
                <td><?php echo substr_replace($arrReview['rr_review'], ' .. <a class="tooltip-bottom" data-tooltip="'.$arrReview['rr_review'].'" target="_blank">read more</a>', 30);?></td>
                <td width="8%"><?php echo $arrReview['rr_create_date'];?></td>
                <td width="8%"><?php $dt = strtotime($arrReview['rr_create_date']);echo date("d/m/Y", $dt); //echo $arrReview['rr_create_date'];?></td>
                <!--<td width="10%"><a href=""><button type="button" class="btn btn-sample btn-sm">Approve</button></a></td>-->
                <td width="15%">
					<a href="review-rating-pending.php?rr=<?php echo $arrReview['rr_id'];?>"><button type="button" class="btn btn-edit btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</button></a>
					<button type="button" class="btn btn-sample btn-sm" type="submit" onClick="ConfirmApprove('<?php echo $arrReview['rr_id'];?>');"><span class="glyphicon glyphicon-check"></span> Approve</button>
				</td>
                
                
            </tr>	
			<?php 
			}
		}
		?>			

        </tbody>
</table>

</div>

</div>                  
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>

</div> 

</div>
<!-- Mainly scripts -->
</body>
</html>

<script>
$(document).ready(function() {
    //$('#example').DataTable();
$('#example').dataTable( {
    "order": [[ 3, 'desc' ]],
	        "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false,
                "searchable": false
            }
        ]
} );
} );


function ConfirmApprove(id){
	var x = confirm("Are you sure you want to approve?");
	if (x == true){
	$.ajax({
		type:'POST',
		url:'review-function.php',
		data: {
			approveReview: {id: id},
		},
		beforeSend: function() {
		},
		success:function(result){
			alert(result);
			location.reload();
		}
	});
	}
}

function ConfirmDelete(id){
	var x = confirm("Are you sure you want to Delete?");
	if (x == true){
	$.ajax({
		type:'POST',
		url:'review-function.php',
		data: {
			deleteReview: {id: id},
		},
		beforeSend: function() {
		},
		success:function(result){
			alert(result);
			window.location ='review-rating-pending';
		}
	});
	}
}

function backToList() {
   window.location ='review-rating-pending';
}
</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
