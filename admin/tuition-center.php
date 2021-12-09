<?php

require_once('includes/head.php'); 
require_once('classes/app.class.php');
$instApp = new app;


if(isset($_REQUEST['crs-saveBI'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->SaveTuitionCenterBI($data);
 
 header('Location:tuition-center.php');
 exit();
}
if(isset($_REQUEST['crs-saveBM'])){
 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->SaveTuitionCenterBM($data);
 
 header('Location:tuition-center.php');
 exit();
}
/*
if(isset($_REQUEST['crs-saveBI2'])){
 //$data = $instApp->RealEscape($_REQUEST);
 //$res =  $instApp->SaveGroupTuitionBI($data);
 
 header('Location:tuition-center.php');
 exit();
}
if(isset($_REQUEST['crs-saveBM2'])){
 //$data = $instApp->RealEscape($_REQUEST);
 //$res =  $instApp->SaveGroupTuitionBM($data);
 
 header('Location:tuition-center.php');
 exit();
}
*/



$queryTCBI = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='84'");
$resTCBI = $queryTCBI->num_rows;
if($resTCBI > 0){
	if($rowTCBI = $queryTCBI->fetch_assoc()){ 
		$idBI  = $rowTCBI['pmt_id'];
		$desBI = $rowTCBI['pmt_pagedetail'];
	}
}else{
	$idBI = "";
	$desBI = "";
}

$queryTCBM = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='85'");
$resTCBM = $queryTCBM->num_rows;
if($resTCBM > 0){
	if($rowTCBM = $queryTCBM->fetch_assoc()){ 
		$idBM  = $rowTCBM['pmt_id'];
		$desBM = $rowTCBM['pmt_pagedetail'];
	}
}else{
	$idBM = "";
	$desBM = "";
}


/*
$queryTCBI2 = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='80'");
$resTCBI2 = $queryTCBI2->num_rows;
if($resTCBI2 > 0){
	if($rowTCBI2 = $queryTCBI2->fetch_assoc()){ 
		$idBI2  = $rowTCBI2['pmt_id'];
		$desBI2 = $rowTCBI2['pmt_pagedetail'];
	}
}else{
	$idBI2 = "";
	$desBI2 = "";
}

$queryTCBM2 = $conDB->query("SELECT * FROM tk_page_manage_translation WHERE pmt_id='81'");
$resTCBM2 = $queryTCBM2->num_rows;
if($resTCBM2 > 0){
	if($rowTCBM2 = $queryTCBM2->fetch_assoc()){ 
		$idBM2  = $rowTCBM2['pmt_id'];
		$desBM2 = $rowTCBM2['pmt_pagedetail'];
	}
}else{
	$idBM2 = "";
	$desBM2 = "";
}
*/

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

  <?php 
  $title = 'Terms & Condition | Tutorkami';
  require_once('includes/html_head.php'); 
  ?>
<script src="ckeditor/ckeditor.js"></script>

</head>

<body>
  <div id="wrapper">
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include_once('includes/header.php'); ?>

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {}
?>
      
      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5><b>Tuition Center Form</b> <span>(Last updated on <strong id="lastUpdated"></strong>)</span></h5>

         </div>
         <div class="ibox-content">
   
<style>
/* ---------------- DO NOT implement ------------------- */
/* https://codepen.io/justingordon/pen/EbwVxG */
/* ----------------------------------------------------- */


/* ------------------------------- */
/* Implement only the styles below */
/* ------------------------------- */

.rates-page-tabs .nav-tabs>li>a {
  border: none;
  text-transform: uppercase;
  color: #7d7d7d;
}

.rates-page-tabs .nav-tabs>li>a:hover,
.rates-page-tabs .nav-tabs>li>a:focus {
  color: #f1592a;
  background-color: white;
  box-shadow: 0px -2px 0px #f1592a inset;
}

.rates-page-tabs .nav-tabs>li.active>a,
.rates-page-tabs .nav-tabs>li.active>a:focus,
.rates-page-tabs .nav-tabs>li.active>a:hover {
  border: none;
  box-shadow: 0px -2px 0px #f1592a inset;
  color: #f1592a;
}

.panel-group .panel-heading + .panel-collapse > .panel-body {
  border: 1px solid #ddd;
}
.rates-page-tabs .panel-group,
.rates-page-tabs .panel-group .panel,
.rates-page-tabs .panel-group .panel-heading,
.rates-page-tabs .panel-group .panel-heading a,
.rates-page-tabs .panel-group .panel-title,
.rates-page-tabs .panel-group .panel-title a,
.rates-page-tabs .panel-group .panel-body,
.rates-page-tabs .panel-group .panel-group .panel-heading + .panel-collapse > .panel-body {
  border-radius: 2px;
  border: 0;
}
.rates-page-tabs .panel-group .panel-heading {
  padding: 0;
  background-color: white;
}
.rates-page-tabs .panel-group .panel-heading a {
  display: block;
  color: #303030;
  font-size: 18px;
  padding: 15px 15px 15px 45px;
  text-decoration: none;
  text-transform: uppercase;
  position: relative;
}
.rates-page-tabs .panel-group .panel-heading a.collapsed {
  
}
.rates-page-tabs .panel-group .panel-heading a:before {
  content: '-';
  position: absolute;
  left: 14px;
  top: 8px;
  font-size:26px;
}
.rates-page-tabs .panel-group .panel-heading a.collapsed:before {
  content: '+';
  left: 10px;
  top: 10px;
}


.rates-page-tabs .panel-group .panel-collapse {
  margin-top: 5px !important;
}
.rates-page-tabs .panel-group .panel-body {
  background: #ffffff;
  padding: 15px;
}
.rates-page-tabs .panel-group .panel {
  background-color: transparent;
}
.rates-page-tabs .panel-group .panel-body p:last-child,
.rates-page-tabs .panel-group .panel-body ul:last-child,
.rates-page-tabs .panel-group .panel-body ol:last-child {
  margin-bottom: 0;
}
</style>
<div class="container">

    <div class="tab-group rates-page-tabs">

        <ul class="nav nav-tabs responsive" role="tablist">
            <li role="presentation" class="active"><a href="#Personal" aria-controls="Personal" role="tab" data-toggle="tab" onClick="activeTabMain(this.id)" id="1" >Tuition Center</a></li>
            <!--<li role="presentation"><a href="#Group" aria-controls="Group" role="tab" data-toggle="tab" onClick="activeTabMain(this.id)" id="2" >Terms for group tuition</a></li>-->
        </ul>


        <div class="tab-content responsive">
            <div role="tabpanel" class="tab-pane active" id="Personal">
<br/><br/>
                
<div class="container">
  <div class="row">
    <div class="col-xs12">

      <div id="tab" class="btn-group btn-group-justified" data-toggle="buttons">
        <a href="#bi" class="this_active btn btn-default active" data-toggle="tab" onClick="activeTab(this.id)" id="<?php echo $idBI; ?>">
          <input type="radio" />English Language
        </a>
        <a href="#bm" class="this_active btn btn-default" data-toggle="tab" onClick="activeTab(this.id)" id="<?php echo $idBM; ?>">
          <input type="radio" />Bahasa Malaysia
        </a>
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="bi">
		<br/>
			<form class="form-horizontal" action="" method="post">                            
				<input type="hidden" name="idBI" id="idBI" value="<?php echo $idBI; ?>">       
				<div class="col-lg-12">
					<textarea id="myeditor" name="myeditor" ><?php echo $desBI; ?></textarea>
				</div>                                       
				<div class="col-lg-12">
					<br/><button class="btn btn-sm btn-primary sign-btn-box" type="submit" name="crs-saveBI"><span class="glyphicon glyphicon glyphicon-ok"></span> &nbsp; Save</button>
					     <button class="btn btn-sm btn-primary sign-btn-box" type="button" onClick="SaveNoti(this.id)" id="1">Save & Notify Clients</button>
					     <button class="btn btn-sm btn-primary sign-btn-box" type="button" onClick="DownloadPDF(this.id)" id="1">Download PDF</button>
				</div>


		</div>
        <div class="tab-pane" id="bm">
		<br/>                       
				<input type="hidden" name="idBM" id="idBM" value="<?php echo $idBM; ?>">       
				<div class="col-lg-12">
					<textarea id="myeditor2" name="myeditor2" ><?php echo $desBM; ?></textarea>
				</div>                                       
				<div class="col-lg-12">
					<br/><button class="btn btn-sm btn-primary sign-btn-box" type="submit" name="crs-saveBM"><span class="glyphicon glyphicon glyphicon-ok"></span> &nbsp; Save</button>
					     <button class="btn btn-sm btn-primary sign-btn-box" type="button" onClick="SaveNoti(this.id)" id="2">Save & Notify Clients</button>
					     <button class="btn btn-sm btn-primary sign-btn-box" type="button" onClick="DownloadPDF(this.id)" id="2" >Download PDF</button>
				</div>

			</form>
		</div>
      </div>
    </div>
  </div>
</div>
                
                
            </div>
            <div role="tabpanel" class="tab-pane" id="Group">
<br/><br/>

<!--<div class="container">
  <div class="row">
    <div class="col-xs12">

      <div id="tab" class="btn-group btn-group-justified" data-toggle="buttons">
        <a href="#bi2" class="this_active btn btn-default" data-toggle="tab" onClick="activeTab(this.id)" id="<?php //echo $idBI2; ?>">
          <input type="radio" />English Language
        </a>
        <a href="#bm2" class="this_active btn btn-default" data-toggle="tab" onClick="activeTab(this.id)" id="<?php //echo $idBM2; ?>">
          <input type="radio" />Bahasa Malaysia
        </a>
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="bi2">
		<br/>
			<form class="form-horizontal" action="" method="post">                            
				<input type="hidden" name="idBI2" id="idBI2" value="<?php //echo $idBI2; ?>">       
				<div class="col-lg-12">
					<textarea id="myeditor3" name="myeditor3" ><?php //echo $desBI2; ?></textarea>
				</div>                                       
				<div class="col-lg-12">
					<br/><button class="btn btn-sm btn-primary sign-btn-box" type="submit" name="crs-saveBI2"><span class="glyphicon glyphicon glyphicon-ok"></span> &nbsp; Save</button>
					     <button class="btn btn-sm btn-primary sign-btn-box" type="button" onClick="SaveNoti(this.id)" id="3">Save & Notify Clients</button>
					     <button class="btn btn-sm btn-primary sign-btn-box" type="button" onClick="DownloadPDF(this.id)" id="3" >Download PDF</button>
				</div>

		</div>
        <div class="tab-pane" id="bm2">
		<br/>                    
				<input type="hidden" name="idBM2" id="idBM2" value="<?php //echo $idBM2; ?>">       
				<div class="col-lg-12">
					<textarea id="myeditor4" name="myeditor4"><?php //echo $desBM2; ?></textarea>
				</div>                                       
				<div class="col-lg-12">
					<br/><button class="btn btn-sm btn-primary sign-btn-box" type="submit" name="crs-saveBM2"><span class="glyphicon glyphicon glyphicon-ok"></span> &nbsp; Save</button>
					     <button class="btn btn-sm btn-primary sign-btn-box" type="button" onClick="SaveNoti(this.id)" id="4">Save & Notify Clients</button>
					     <button class="btn btn-sm btn-primary sign-btn-box" type="button" onClick="DownloadPDF(this.id)" id="4" >Download PDF</button>
				</div>

			</form>
		</div>
      </div>
    </div>
  </div>
</div>-->


            </div>
        </div>
    </div>

</div>
	   
	   
	   
	   
	   
     </div>
   </div>
 </div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>
<script type="text/javascript">
    CKEDITOR.replace( 'myeditor', {
        height: 400
    } );
    CKEDITOR.replace( 'myeditor2', {
        height: 400
    } );
    

    CKEDITOR.replace( 'myeditor3', {
        height: 400
    } );
    CKEDITOR.replace( 'myeditor4', {
        height: 400
    } );
    
    
    
var fakewaffle = (function($, fakewaffle) {
  "use strict";

  fakewaffle.responsiveTabs = function(collapseDisplayed) {
    fakewaffle.currentPosition = "tabs";

    var tabGroups = $(".nav-tabs.responsive");
    var hidden = "";
    var visible = "";
    var activeTab = "";

    if (collapseDisplayed === undefined) {
      collapseDisplayed = ["xs", "sm"];
    }

    $.each(collapseDisplayed, function() {
      hidden += " hidden-" + this;
      visible += " visible-" + this;
    });

    $.each(tabGroups, function(index) {
      var collapseDiv;
      var $tabGroup = $(this);
      var tabs = $tabGroup.find("li a");

      if ($tabGroup.attr("id") === undefined) {
        $tabGroup.attr("id", "tabs-" + index);
      }

      collapseDiv = $("<div></div>", {
        class: "panel-group responsive" + visible,
        id: "collapse-" + $tabGroup.attr("id")
      });

      $.each(tabs, function() {
        var $this = $(this);
        var oldLinkClass =
          $this.attr("class") === undefined ? "" : $this.attr("class");
        var newLinkClass = "accordion-toggle";
        var oldParentClass =
          $this.parent().attr("class") === undefined
            ? ""
            : $this.parent().attr("class");
        var newParentClass = "panel panel-default";
        var newHash = $this.get(0).hash.replace("#", "collapse-");

        if (oldLinkClass.length > 0) {
          newLinkClass += " " + oldLinkClass;
        }

        if (oldParentClass.length > 0) {
          oldParentClass = oldParentClass.replace(/\bactive\b/g, "");
          newParentClass += " " + oldParentClass;
          newParentClass = newParentClass.replace(/\s{2,}/g, " ");
          newParentClass = newParentClass.replace(/^\s+|\s+$/g, "");
        }

        if ($this.parent().hasClass("active")) {
          activeTab = "#" + newHash;
        }

        collapseDiv.append(
          $("<div>")
            .attr("class", newParentClass)
            .html(
              $("<div>")
                .attr("class", "panel-heading")
                .html(
                  $("<h4>")
                    .attr("class", "panel-title")
                    .html(
                      $("<a>", {
                        class: newLinkClass,
                        "data-toggle": "collapse",
                        "data-parent": "#collapse-" + $tabGroup.attr("id"),
                        href: "#" + newHash,
                        html: $this.html()
                      })
                    )
                )
            )
            .append(
              $("<div>", {
                id: newHash,
                class: "panel-collapse collapse"
              })
            )
        );
      });

      $tabGroup.next().after(collapseDiv);
      $tabGroup.addClass(hidden);
      $(".tab-content.responsive").addClass(hidden);

      if (activeTab) {
        $(activeTab).collapse("show");
      }
    });

    fakewaffle.checkResize();
    fakewaffle.bindTabToCollapse();
  };

  fakewaffle.checkResize = function() {
    if (
      $(".panel-group.responsive").is(":visible") === true &&
      fakewaffle.currentPosition === "tabs"
    ) {
      fakewaffle.tabToPanel();
      fakewaffle.currentPosition = "panel";
    } else if (
      $(".panel-group.responsive").is(":visible") === false &&
      fakewaffle.currentPosition === "panel"
    ) {
      fakewaffle.panelToTab();
      fakewaffle.currentPosition = "tabs";
    }
  };

  fakewaffle.tabToPanel = function() {
    var tabGroups = $(".nav-tabs.responsive");

    $.each(tabGroups, function(index, tabGroup) {
      // Find the tab
      var tabContents = $(tabGroup)
        .next(".tab-content")
        .find(".tab-pane");

      $.each(tabContents, function(index, tabContent) {
        // Find the id to move the element to
        var destinationId = $(tabContent)
          .attr("id")
          .replace(/^/, "#collapse-");

        // Convert tab to panel and move to destination
        $(tabContent)
          .removeClass("tab-pane")
          .addClass("panel-body fw-previous-tab-pane")
          .appendTo($(destinationId));
      });
    });
  };

  fakewaffle.panelToTab = function() {
    var panelGroups = $(".panel-group.responsive");

    $.each(panelGroups, function(index, panelGroup) {
      var destinationId = $(panelGroup)
        .attr("id")
        .replace("collapse-", "#");
      var destination = $(destinationId).next(".tab-content")[0];

      // Find the panel contents
      var panelContents = $(panelGroup).find(
        ".panel-body.fw-previous-tab-pane"
      );

      // Convert to tab and move to destination
      panelContents
        .removeClass("panel-body fw-previous-tab-pane")
        .addClass("tab-pane")
        .appendTo($(destination));
    });
  };

  fakewaffle.bindTabToCollapse = function() {
    var tabs = $(".nav-tabs.responsive").find("li a");
    var collapse = $(".panel-group.responsive").find(".panel-collapse");

    // Toggle the panels when the associated tab is toggled
    tabs.on("shown.bs.tab", function(e) {
      if (fakewaffle.currentPosition === "tabs") {
        var $current = $(e.currentTarget.hash.replace(/#/, "#collapse-"));
        $current.collapse("show");

        if (e.relatedTarget) {
          var $previous = $(e.relatedTarget.hash.replace(/#/, "#collapse-"));
          $previous.collapse("hide");
        }
      }
    });

    // Toggle the tab when the associated panel is toggled
    collapse.on("shown.bs.collapse", function(e) {
      if (fakewaffle.currentPosition === "panel") {
        // Activate current tabs
        var current = $(e.target).context.id.replace(/collapse-/g, "#");
        $('a[href="' + current + '"]').tab("show");

        // Update the content with active
        var panelGroup = $(e.currentTarget).closest(".panel-group.responsive");
        $(panelGroup)
          .find(".panel-body")
          .removeClass("active");
        $(e.currentTarget)
          .find(".panel-body")
          .addClass("active");
      }
    });
  };

  $(window).resize(function() {
    fakewaffle.checkResize();
  });

  return fakewaffle;
})(window.jQuery, fakewaffle || {});



(function($) {
  fakewaffle.responsiveTabs(['xs']);
})(jQuery);


function DownloadPDF(id) {
  if(id == '1'){
      window.open("https://www.tutorkami.com/admin/Tuition-Center-English.php");
  }
  if(id == '2'){
      window.open("https://www.tutorkami.com/admin/Tuition-Center-Malay.php");
  }
  if(id == '3'){
      window.open("https://www.tutorkami.com/admin/pdf7.php");
  }
  if(id == '4'){
      window.open("https://www.tutorkami.com/admin/pdf8.php");
  }

}


function SaveNoti(id) {
  if( id == '1' || id == '2' ){

     var idBI      = document.getElementById("idBI").value;
     var myeditor  = CKEDITOR.instances['myeditor'].getData();
     var idBM      = document.getElementById("idBM").value;
     var myeditor2 = CKEDITOR.instances['myeditor2'].getData();
     
     var historyBI      = document.getElementById("myeditor").value;
     var historyBM      = document.getElementById("myeditor2").value;
     
     var x = confirm("Confirm to proceed? Clent will be required to re-sign. Make sure before you click ok, you have : \n\n1) Asked GM/AGM to double check for you. \n2) If GM/AGM has confirmed, mark at the terms the numbers that you have made significant/important changes that you want tutor to notice \n3) Download a PDF copy before proceed ");
	 if (x == true){
    	$.ajax({
    		type:'POST',
    		url:'clients-terms-function.php',
    		data: {
    			dataUpdate: {idBI: idBI, myeditor: myeditor, idBM: idBM, myeditor2: myeditor2, historyBI: historyBI, historyBM: historyBM},
    		},
    		success:function(result){
    			alert(result);
    			window.location = "tuition-center.php"
    		}
    	});
	 }

  }else if( id == '3' || id == '4' ){
      
     var idBI     = document.getElementById("idBI2").value;
     var myeditor = CKEDITOR.instances['myeditor3'].getData();
     var idBM     = document.getElementById("idBM2").value;
     var myeditor2 = CKEDITOR.instances['myeditor4'].getData();
     
     var historyBI      = document.getElementById("myeditor3").value;
     var historyBM      = document.getElementById("myeditor4").value;

     var x = confirm("Confirm to proceed? Tutors will be required to re-sign. Make sure before you click ok, you have : \n\n1) Asked GM/AGM to double check for you. \n2) If GM/AGM has confirmed, mark at the terms the numbers that you have made significant/important changes that you want tutor to notice \n3) Download a PDF copy before proceed ");
	 if (x == true){
    	$.ajax({
    		type:'POST',
    		url:'clients-terms-function.php',
    		data: {
    			dataUpdate: {idBI: idBI, myeditor: myeditor, idBM: idBM, myeditor2: myeditor2, historyBI: historyBI, historyBM: historyBM},
    		},
    		success:function(result){
    			alert(result);
    			window.location = "tuition-center.php"
    		}
    	});
	 }
      
  }else{
      alert('Error');
  }
}


function activeTab(id) {
        $.post("active-tab.php",{ 
            id:id
        },
        function(response,status){ // Required Callback Function
            document.getElementById('lastUpdated').innerHTML = response;

        });
}

function activeTabMain(id) {

    if(id == '1'){
        $('.this_active').removeClass('active');
        $('#84').click();
    }
    if(id == '2'){
        $('.this_active').removeClass('active');
        $('#80').click();
    }

}

$(document).ready(function() {
        $.post("active-tab.php",{ 
            id:'84'
        },
        function(response,status){ // Required Callback Function
            document.getElementById('lastUpdated').innerHTML = response;

        });
});
</script> 
</div> 

</div>

</body>
</html>
 

