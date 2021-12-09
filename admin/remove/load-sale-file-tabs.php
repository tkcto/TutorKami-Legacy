<!-- DONE BACKUP -->
<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if(isset($_GET['requiredid'])){
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" rel="stylesheet">
<style>
.tab-pane{
    min-height: 100%
    overflow-y:scroll;
}

.fontSize {
  font-size: 13px;
}

#confirmBox
{
    display: none;
    background-color: #eee;
    border-radius: 5px;
    border: 1px solid #aaa;
    /*position: fixed;*/
    width: 300px;
    /*left: 50%;*/
    margin-left: -150px;
    padding: 6px 8px 8px;
    box-sizing: border-box;
    text-align: center;
}
#confirmBox .button {
    background-color: #ccc;
    display: inline-block;
    border-radius: 3px;
    border: 1px solid #aaa;
    padding: 2px;
    text-align: center;
    width: 95px;
    cursor: pointer;
}
#confirmBox .button:hover
{
    background-color: #ddd;
}
#confirmBox .message
{
    text-align: left;
    margin-bottom: 8px;
}
.centered {
  position: fixed;
  top: 45%;
  left: 60%;
  transform: translate(-50%, -50%);
}
</style>
<input id="testing1" value="">
<div id="testing2"></div>
<script>
// https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp
var input = document.getElementById("testing1");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("testing2").innerHTML = 'click enter'; 
  }
});
</script>



<div class="centered" id="confirmBox">
    <div class="message"></div>
    <span class="button yes">Carry Forward</span>
    <span class="button no">Add Row</span>
    <span class="button cancel">Cancel</span>
</div>

<div class="modal fade" id="myModalAddTab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form>
            
              <input type="hidden" class="form-control" id="mainID" value="<?PHP echo $_GET['requiredid']; ?>">
              <div class="form-group">
                <label for="TabInput">Tab Name </label>
                <input type="text" class="form-control" id="TabInput" aria-describedby="TabHelp" placeholder="eg : Example">
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button style="margin-top:4px;" type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
        <button onclick="submitTab()" type="button" class="btn btn-rate">Submit</button>
      </div>
    </div>
  </div>
</div>


<input type="hidden" id="tabID" >
<span id="buttonAddTab" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModalAddTab" class="glyphicon glyphicon-plus" style="color:#243027"></span>&nbsp;&nbsp;&nbsp;
<?PHP
$i = 1;
$sql = " SELECT id, main_id, tab_name FROM tk_sales_sub WHERE main_id = '".$_GET['requiredid']."' GROUP BY tab_name ORDER BY tab_name ASC ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if( $i == 1 ){
        ?>
        <input type="hidden" id="thisActive" value="<?PHP echo $row['id'];?>">
        <button type="button" onClick="replyClick(this.id)" id="btnTabActive<?PHP echo $row['id'];?>" class="btnTabActive btn btn-default active"><?PHP echo $row['tab_name'];?> </button>
        <?PHP   
        }else{
        ?>
        <button type="button" onClick="replyClick(this.id)" id="btnTabActive<?PHP echo $row['id'];?>" class="btnTabActive btn btn-default"><?PHP echo $row['tab_name'];?> </button>
        <?PHP            
        }
    $i++;    
    }
}else{
    echo "<script>$(document).ready(function(){ 
        setTimeout(function() { document.getElementById('buttonAddTab').click(); }, 1000);
    });</script>"; 
}
?>
<div class="panel panel-default tab-pane" style="width:2000px;">
    <div class="panel-body">
        

<button type="button" onClick="getMonth(this.id)" id="Jan" class="btnTabMonth btn btn-default active">Jan</button>
<button type="button" onClick="getMonth(this.id)" id="Feb" class="btnTabMonth btn btn-default ">Feb</button>
<button type="button" onClick="getMonth(this.id)" id="Mar" class="btnTabMonth btn btn-default ">Mar</button>
<button type="button" onClick="getMonth(this.id)" id="Apr" class="btnTabMonth btn btn-default ">Apr</button>
<button type="button" onClick="getMonth(this.id)" id="May" class="btnTabMonth btn btn-default ">May</button>
<button type="button" onClick="getMonth(this.id)" id="Jun" class="btnTabMonth btn btn-default ">Jun</button>
<button type="button" onClick="getMonth(this.id)" id="Jul" class="btnTabMonth btn btn-default ">Jul</button>
<button type="button" onClick="getMonth(this.id)" id="Aug" class="btnTabMonth btn btn-default ">Aug</button>
<button type="button" onClick="getMonth(this.id)" id="Sep" class="btnTabMonth btn btn-default ">Sep</button>
<button type="button" onClick="getMonth(this.id)" id="Oct" class="btnTabMonth btn btn-default ">Oct</button>
<button type="button" onClick="getMonth(this.id)" id="Nov" class="btnTabMonth btn btn-default ">Nov</button>
<button type="button" onClick="getMonth(this.id)" id="Dec" class="btnTabMonth btn btn-default ">Dec</button>


<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>


function createNew() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); 
    var yyyy = today.getFullYear();
    today = dd + '/' + mm + '/' + yyyy;
    
	$("#add-more").hide(); 
	$('.btnSaveEdit').addClass("hidden");
	document.getElementById('duplicateBtn').innerHTML = '<span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links" style="color:#28A745"><b>Save</b></a> / <a onclick="cancelAdd();" class="ajax-action-links" style="color:#007BFF"><b>Cancel</b></a></span>';
	

            var numTable = '';
            var countTable = document.getElementsByClassName("table-row").length;
            if( countTable > 0){
                numTable = countTable + 1;
            }else{
                numTable = 1;
            }
  
        	var data = '<tr class="table-row" id="new_row_ajax">' +
        	
        	'<td style="font-size:14px;" contenteditable="false" id="txt_dataNo"  onBlur="addToHiddenField(this,\'row_no\')" onClick="editRow(this);">'+numTable+'</td>' +
        	
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no1"     onBlur="addToHiddenField(this,\'no1\')"    onClick="editRow(this);" >'+today+'</td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no2"     onBlur="addToHiddenField(this,\'no2\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)"></td>' +
        
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no3"     onBlur="addToHiddenField(this,\'no3\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no4"     onBlur="addToHiddenField(this,\'no4\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no5"     onBlur="addToHiddenField(this,\'no5\')"    onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no6"     onBlur="addToHiddenField(this,\'no6\')"    onClick="ChangeThis(this,this.id);" onkeyup="keyupFunction(this,this.id)"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no7"     onBlur="addToHiddenField(this,\'no7\')"    onClick="ChangeThis(this,this.id);" onkeyup="keyupFunction(this,this.id)"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no8"     onBlur="addToHiddenField(this,\'no8\')"    onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no9"     onBlur="addToHiddenField(this,\'no9\')"    onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no10"    onBlur="addToHiddenField(this,\'no10\')"   onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="txt_no11"    onBlur="addToHiddenField(this,\'no11\')"   onClick="editRow(this);"></td>' +
        	
        
        	'<td style="font-size:14px;" >  <input type="hidden" id="row_no" value="'+numTable+'"/> <input type="hidden" id="no1" value="'+today+'"/> <input type="hidden" id="no2" /> <input type="hidden" id="no3" /> <input type="hidden" id="no4" /> <input type="hidden" id="no5" /> <input type="hidden" id="no6" /> <input type="hidden" id="no7" /> <input type="hidden" id="no8" /> <input type="hidden" id="no9" /> <input type="hidden" id="no10" /> <input type="hidden" id="no11" />  <span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links" style="color:#28A745"><b>Save</b></a> / <a onclick="cancelAdd();" class="ajax-action-links" style="color:#007BFF"><b>Cancel</b></a></span>  </td>' +	
        	'</tr>';
          $("#table-body").append(data);
		    
	

}

function doStuff(editableObj) {
/*
    var JobID = $(editableObj).text();
	  $.ajax({
		url: "editable-job.php",
		type: "POST",
		data:'JobID='+JobID,
		success: function(result){
	
	        if( result == 'No' ){
	            alert(result);
	        }else if( result == 'Error 3' ){
	            alert(result);
	        }else{
    		    var nameArr = result.split(',');
    		    var tutorRate = nameArr[0];
    		    var parentRate = nameArr[1];
    		    var cycle = nameArr[2];
    		    var tutorEmail = nameArr[3];
    		    var tutorDisplay = nameArr[4];
    		    var userAcc = nameArr[5];
    		    var RF = nameArr[6];
    		    
    		    if( RF > 0 ){
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); 
                    var yyyy = today.getFullYear();
                    today = dd + '/' + mm + '/' + yyyy;

                	var data = '<tr class="table-row" id="RFnew_row_ajax">' +
                	
                	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_dataNo" onBlur="addToHiddenField(this,\'RFrow_no\')" onClick="editRow(this);"></td>' +
                	
                	'<td style="font-size:14px;" contenteditable="true"  id="RFtxt_no1"    onBlur="addToHiddenField(this,\'RFno1\')"    onClick="editRow(this);">'+today+'</td>' +
                	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no2"    onBlur="addToHiddenField(this,\'RFno2\')"    onClick="editRow(this);"></td>' +
                
                	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no3"    onBlur="addToHiddenField(this,\'RFno3\')"    onClick="editRow(this);">R.F</td>' +
                	'<td style="font-size:14px;" contenteditable="true"  id="RFtxt_no4"    onBlur="addToHiddenField(this,\'RFno4\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)">'+RF+'</td>' +
                	'<td style="font-size:14px;" contenteditable="true"  id="RFtxt_no5"    onBlur="addToHiddenField(this,\'RFno5\')"    onClick="editRow(this);"></td>' +
                	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no6"    onBlur="addToHiddenField(this,\'RFno6\')"    onClick="editRow(this);"></td>' +
                	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no7"    onBlur="addToHiddenField(this,\'RFno7\')"    onClick="editRow(this);"></td>' +
                	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no8"    onBlur="addToHiddenField(this,\'RFno8\')"    onClick="editRow(this);"></td>' +
                	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no9"    onBlur="addToHiddenField(this,\'RFno9\')"    onClick="editRow(this);"></td>' +
                	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no10"   onBlur="addToHiddenField(this,\'RFno10\')"   onClick="editRow(this);"></td>' +
                	'<td style="font-size:14px;" contenteditable="true"  id="RFtxt_no11"   onBlur="addToHiddenField(this,\'RFno11\')"   onClick="editRow(this);">New</td>' +
                	
                
                	'<td style="font-size:14px;" >  <input type="hidden" id="RFrow_no" /> <input type="hidden" id="RFno1" value="'+today+'"/> <input type="hidden" id="RFno2" value="'+JobID+'"/> <input type="hidden" id="RFno3" value="R.F"/> <input type="hidden" id="RFno4" value="'+RF+'" /> <input type="hidden" id="RFno5" /> <input type="hidden" id="RFno6" /> <input type="hidden" id="RFno7" /> <input type="hidden" id="RFno8" /> <input type="hidden" id="RFno9" /> <input type="hidden" id="RFno10" /> <input type="hidden" id="RFno11" value="New"/>  <span id="confirmAdd"><a onclick="RemoveAdd();" class="ajax-action-links" style="color:red"><b>Remove</b></a></span>  </td>' +	
                	'</tr>';
                	$("#table-body").append(data);
                	
    		        document.getElementById('RFno5').value = userAcc;
    		        document.getElementById('RFtxt_no5').innerHTML = '';
    		        
    		        document.getElementById('RFno9').value = parseFloat(( document.getElementById('RFno4').value - document.getElementById('RFno7').value )).toFixed(2);
    		        document.getElementById('RFtxt_no9').innerHTML = parseFloat(( document.getElementById('RFno4').value - document.getElementById('RFno7').value )).toFixed(2);
    		    }else{
    		        $("#RFnew_row_ajax").remove();
    		    }
    		    
    		    document.getElementById('no3').value = tutorDisplay;
    		    document.getElementById('txt_no3').innerHTML = tutorDisplay;
    		    
    		    document.getElementById('no4').value = parseFloat((parentRate * cycle)).toFixed(2);
    		    document.getElementById('txt_no4').innerHTML = parseFloat((parentRate * cycle)).toFixed(2);
    		    
    		    document.getElementById('no5').value = userAcc;
    		    document.getElementById('txt_no5').innerHTML = userAcc;
    		    
    		    document.getElementById('no9').value = parseFloat(( document.getElementById('no4').value - document.getElementById('no7').value )).toFixed(2);
    		    document.getElementById('txt_no9').innerHTML = parseFloat(( document.getElementById('no4').value - document.getElementById('no7').value )).toFixed(2);
    		    
    		    document.getElementById('no10').value = cycle;
    		    document.getElementById('txt_no10').innerHTML = cycle;           
	        }

		}
    });
*/
}

// ############################################################ OTHER ############################################################ //
var timer = null;
function cancelAdd() {
	$("#add-more").show();
	$("#new_row_ajax").remove();
	$("#RFnew_row_ajax").remove();
	document.getElementById('duplicateBtn').innerHTML = '';
}
function RemoveAdd() {
    $("#RFnew_row_ajax").remove();
}

function app_cancelAdd(thenum) {
    //var thenum = (Number(thenum) +1);
	$("#add-more").show();
	$("#table-row-"+thenum).remove();
	$("#app_RFtable-row-"+thenum).remove();
	//document.getElementById('duplicateBtn').innerHTML = '';
}
function app_RemoveAdd(thenum) {
    $("#app_RFtable-row-"+thenum).remove();
}

function editRow(editableObj) {
  $(editableObj).css("background","#FFF");
  $('.btnSaveEdit').addClass("hidden");
  
  if( ($('#new_row_ajax').length > 0) == true || ($('#RFnew_row_ajax').length > 0) == true ){
  }else{
      document.getElementById('duplicateBtn').innerHTML = '';
  }
  
}
// ############################################################ OTHER ############################################################ //


// ############################################################ INSERT NEW ############################################################ //
function addToHiddenField(addColumn,hiddenField) {
	var columnValue = $(addColumn).text();
	$("#"+hiddenField).val(columnValue);
}
function addToDatabase() {
  var app = 'no';
  var salesSubID = document.getElementById('tabID').value;
  var btnTabMonth = $(".btnTabMonth.active").attr('id');
  var row_no = $("#row_no").val();
  var no1 = $("#no1").val();
  var no2 = $("#no2").val();
  var no3 = $("#no3").val();
  var no4 = $("#no4").val();
  var no5 = $("#no5").val();
  var no6 = $("#no6").val();
  var no7 = $("#no7").val();
  var no8 = $("#no8").val();
  var no9 = $("#no9").val();
  var no10 = $("#no10").val().replace(/\s/g, "");
  var no11 = $("#no11").val();

    if( ($('#RFnew_row_ajax').length > 0) == true ){
        var thisRF = '&RFno2='+$("#RFno2").val()+'&RFno1='+$("#RFno1").val()+'&RFno3='+$("#RFno3").val()+'&RFno4='+$("#RFno4").val()+'&RFno5='+$("#RFno5").val()+'&RFno6='+$("#RFno6").val()+'&RFno7='+$("#RFno7").val()+'&RFno8='+$("#RFno8").val()+'&RFno9='+$("#RFno9").val()+'&RFno10='+$("#RFno10").val()+'&RFno11='+$("#RFno11").val();
    }else{
        var thisRF = '&RFno2=';
    }

	  $.ajax({
		url: "editable-add.php",
		type: "POST",
		data:'salesSubID='+salesSubID+'&btnTabMonth='+btnTabMonth+'&app='+app+'&row_no='+row_no+'&no1='+no1+'&no2='+no2+'&no3='+no3+'&no4='+no4+'&no5='+no5+'&no6='+no6+'&no7='+no7+'&no8='+no8+'&no9='+no9+'&no10='+no10+'&no11='+no11+thisRF,
		success: function(data){
		    if( data == 'Error 1' || data == 'Error 2' || data == 'Error 3' ){
		        alert(data);
		    }else if( data == 'session' ){
		        
		    }
		    else{
    		  if( ($('#RFnew_row_ajax').length > 0) == true ){
    		    $("#RFnew_row_ajax").remove();
    		  }
    		  $("#new_row_ajax").remove();
    		  $("#add-more").show();		  
    		  $("#table-body").append(data);
    		  
              var btnTab = $(".btnTabActive.active").attr('id');
              var thenum = btnTab.replace( /^\D+/g, '');
              $.ajax({
                type:'POST',
                url:'load-footer-sale.php',
                data: {
                    dataFooter: {id: thenum, month: btnTabMonth},
                },
                success:function(resultFooter){
                    document.getElementById('duplicateBtn').innerHTML = '';
                    document.getElementById("loadFooterSale").innerHTML = resultFooter;
                }
              });
    		  
		    }
		}
	  });
}
function app_addToDatabase() {
  var app = 'yes';
  var salesSubID = document.getElementById('tabID').value;
  var btnTabMonth = $(".btnTabMonth.active").attr('id');
  var row_no = $("#app_row_no").val();
  var no1 = $("#app_no1").val();
  var no2 = $("#app_no2").val();
  var no3 = $("#app_no3").val();
  var no4 = $("#app_no4").val();
  var no5 = $("#app_no5").val();
  var no6 = $("#app_no6").val();
  var no7 = $("#app_no7").val();
  var no8 = $("#app_no8").val();
  var no9 = $("#app_no9").val();
  var no10 = $("#app_no10").val().replace(/\s/g, "");
  var no11 = $("#app_no11").val();
  alert(row_no);
  var thisRF = '&RFno2=';
	  $.ajax({
		url: "editable-add.php",
		type: "POST",
		data:'salesSubID='+salesSubID+'&btnTabMonth='+btnTabMonth+'&app='+app+'&row_no='+row_no+'&no1='+no1+'&no2='+no2+'&no3='+no3+'&no4='+no4+'&no5='+no5+'&no6='+no6+'&no7='+no7+'&no8='+no8+'&no9='+no9+'&no10='+no10+'&no11='+no11+thisRF,
		success: function(data){
		    alert(data);
		}
	  });
  
  
}

function keyupFunction(editableObj,thisID) {
    if( thisID === 'txt_no2' ){
        clearTimeout(timer); 
        //timer = setTimeout(doStuff(editableObj), 1000); 
        timer = setTimeout(function(){

            var JobID = $(editableObj).text();
            if( JobID == '' ){
                $("#RFnew_row_ajax").remove();	
                document.getElementById('no3').value = '';
                document.getElementById('txt_no3').innerHTML = '';
                		    
                document.getElementById('no4').value = '';
                document.getElementById('txt_no4').innerHTML = '';
                		    
                document.getElementById('no5').value = '';
                document.getElementById('txt_no5').innerHTML = '';
                		    
                document.getElementById('no9').value = '';
                document.getElementById('txt_no9').innerHTML = '';
                		    
                document.getElementById('no10').value = '';
                document.getElementById('txt_no10').innerHTML = '';   
            }else{
                
            	  $.ajax({
            		url: "editable-job.php",
            		type: "POST",
            		data:'JobID='+JobID,
            		success: function(result){
            		    trim = result.replace(/\s+/g, '');
            	        if( trim == "No" ){
                            $("#RFnew_row_ajax").remove();	
                            document.getElementById('no3').value = '';
                            document.getElementById('txt_no3').innerHTML = '';
                            		    
                            document.getElementById('no4').value = '';
                            document.getElementById('txt_no4').innerHTML = '';
                            		    
                            document.getElementById('no5').value = '';
                            document.getElementById('txt_no5').innerHTML = '';
                            		    
                            document.getElementById('no9').value = '';
                            document.getElementById('txt_no9').innerHTML = '';
                            		    
                            document.getElementById('no10').value = '';
                            document.getElementById('txt_no10').innerHTML = '';   
            	        }else if( trim == "Error 3" ){
            	            alert(trim);
            	        }else{
                		    var nameArr = trim.split(',');
                		    var tutorRate = nameArr[0];
                		    var parentRate = nameArr[1];
                		    var cycle = nameArr[2];
                		    var tutorEmail = nameArr[3];
                		    var tutorDisplay = nameArr[4];
                		    var userAcc = nameArr[5];
                		    var RF = nameArr[6];
                		    
                		    if( RF > 0 ){
                                var today = new Date();
                                var dd = String(today.getDate()).padStart(2, '0');
                                var mm = String(today.getMonth() + 1).padStart(2, '0'); 
                                var yyyy = today.getFullYear();
                                today = dd + '/' + mm + '/' + yyyy;
            
                            	var data = '<tr class="table-row" id="RFnew_row_ajax">' +
                            	
                            	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_dataNo" onBlur="addToHiddenField(this,\'RFrow_no\')" onClick="editRow(this);"></td>' +
                            	
                            	'<td style="font-size:14px;" contenteditable="true"   id="RFtxt_no1"    onBlur="addToHiddenField(this,\'RFno1\')"    onClick="editRow(this);">'+today+'</td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no2"    onBlur="addToHiddenField(this,\'RFno2\')"    onClick="editRow(this);"></td>' +
                            
                            	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no3"    onBlur="addToHiddenField(this,\'RFno3\')"    onClick="editRow(this);">R.F</td>' +
                            	'<td style="font-size:14px;" contenteditable="true"   id="RFtxt_no4"    onBlur="addToHiddenField(this,\'RFno4\')"    onClick="editRow(this);" onkeyup="keyupFunction(this,this.id)">'+RF+'</td>' +
                            	'<td style="font-size:14px;" contenteditable="true"   id="RFtxt_no5"    onBlur="addToHiddenField(this,\'RFno5\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no6"    onBlur="addToHiddenField(this,\'RFno6\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no7"    onBlur="addToHiddenField(this,\'RFno7\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no8"    onBlur="addToHiddenField(this,\'RFno8\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no9"    onBlur="addToHiddenField(this,\'RFno9\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="RFtxt_no10"   onBlur="addToHiddenField(this,\'RFno10\')"   onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="true"   id="RFtxt_no11"   onBlur="addToHiddenField(this,\'RFno11\')"   onClick="editRow(this);">New</td>' +
                            	
                            
                            	'<td style="font-size:14px;" >  <input type="hidden" id="RFrow_no" /> <input type="hidden" id="RFno1" value="'+today+'"/> <input type="hidden" id="RFno2" value="'+JobID+'"/> <input type="hidden" id="RFno3" value="R.F"/> <input type="hidden" id="RFno4" value="'+RF+'" /> <input type="hidden" id="RFno5" /> <input type="hidden" id="RFno6" /> <input type="hidden" id="RFno7" /> <input type="hidden" id="RFno8" /> <input type="hidden" id="RFno9" /> <input type="hidden" id="RFno10" /> <input type="hidden" id="RFno11" value="New"/>  <span id="confirmAdd"><a onclick="RemoveAdd();" class="ajax-action-links" style="color:red"><b>Remove</b></a></span>  </td>' +	
                            	'</tr>';
                            	$("#table-body").append(data);
                            	
                		        document.getElementById('RFno5').value = userAcc;
                		        document.getElementById('RFtxt_no5').innerHTML = '';
                		        
                		        document.getElementById('RFno9').value = parseFloat(( document.getElementById('RFno4').value - document.getElementById('RFno7').value )).toFixed(2);
                		        document.getElementById('RFtxt_no9').innerHTML = parseFloat(( document.getElementById('RFno4').value - document.getElementById('RFno7').value )).toFixed(2);
                		    }else{
                		        $("#RFnew_row_ajax").remove();
                		    }
                		    
                		    document.getElementById('no3').value = tutorDisplay;
                		    document.getElementById('txt_no3').innerHTML = tutorDisplay;
                		    
                		    document.getElementById('no4').value = parseFloat((parentRate * cycle)).toFixed(2);
                		    document.getElementById('txt_no4').innerHTML = parseFloat((parentRate * cycle)).toFixed(2);
                		    
                		    document.getElementById('no5').value = userAcc;
                		    document.getElementById('txt_no5').innerHTML = userAcc;
                		    
                		    document.getElementById('no9').value = parseFloat(( document.getElementById('no4').value - document.getElementById('no7').value )).toFixed(2);
                		    document.getElementById('txt_no9').innerHTML = parseFloat(( document.getElementById('no4').value - document.getElementById('no7').value )).toFixed(2);
                		    
                		    document.getElementById('no10').value = cycle;
                		    document.getElementById('txt_no10').innerHTML = cycle;           
            	        }

            		}
                });
                
            }
        }, 500);
    }

    if( thisID === 'txt_no3' ){
        clearTimeout(timer); 
        timer = setTimeout(function(){
            var tutorName = $(editableObj).text();
            
            var tid=$('.tbl-qa > tbody > tr:nth-last-child(2)').attr('id');
            var thenum = tid.replace( /^\D+/g, '');
            //alert(tid +' '+thenum); 

            var Row = document.getElementById("table-row-"+thenum);
            var Cells = Row.getElementsByTagName("td");
            var tJobID = Cells[2].innerText;
    
            if( tutorName == 'R.F' ){
                document.getElementById('no2').value = tJobID;
                document.getElementById('txt_no2').innerHTML = '';
                document.getElementById('txt_no2').setAttribute("contenteditable", false);
                
                document.getElementById('no4').value = '';
                document.getElementById('txt_no4').innerHTML = '';
                document.getElementById('txt_no4').setAttribute("contenteditable", true);
                
                document.getElementById('no5').value = '';
                document.getElementById('txt_no5').innerHTML = '';
                document.getElementById('txt_no5').setAttribute("contenteditable", true);
                
                document.getElementById('no6').value = '';
                document.getElementById('txt_no6').innerHTML = '';
                document.getElementById('txt_no6').setAttribute("onclick", false);
                document.getElementById('txt_no6').setAttribute("contenteditable", false);
                
                document.getElementById('no7').value = '';
                document.getElementById('txt_no7').innerHTML = '';
                document.getElementById('txt_no7').setAttribute("contenteditable", false);
                
                document.getElementById('no8').value = '';
                document.getElementById('txt_no8').innerHTML = '';
                document.getElementById('txt_no8').setAttribute("contenteditable", false);
                
                document.getElementById('no9').value = '';
                document.getElementById('txt_no9').innerHTML = '';
                document.getElementById('txt_no9').setAttribute("contenteditable", false);
                
                document.getElementById('no10').value = '';
                document.getElementById('txt_no10').innerHTML = '';
                document.getElementById('txt_no10').setAttribute("contenteditable", false);
                
                document.getElementById('no11').value = 'New';
                document.getElementById('txt_no11').innerHTML = 'New';
                document.getElementById('txt_no11').setAttribute("contenteditable", false);
            }else{
                document.getElementById('no2').value = '';
                document.getElementById('txt_no2').innerHTML = '';
                document.getElementById('txt_no2').setAttribute("contenteditable", true);
                
                document.getElementById('no4').value = '';
                document.getElementById('txt_no4').innerHTML = '';
                document.getElementById('txt_no4').setAttribute("contenteditable", true);
                
                document.getElementById('no5').value = '';
                document.getElementById('txt_no5').innerHTML = '';
                document.getElementById('txt_no5').setAttribute("contenteditable", true);

                document.getElementById('no6').value = '';
                document.getElementById('txt_no6').innerHTML = '';
                document.getElementById('txt_no6').setAttribute("onclick", "ChangeThis(this,this.id);");
                document.getElementById('txt_no6').setAttribute("contenteditable", true);
                
                document.getElementById('no7').value = '';
                document.getElementById('txt_no7').innerHTML = '';
                document.getElementById('txt_no7').setAttribute("contenteditable", true);
                
                document.getElementById('no8').value = '';
                document.getElementById('txt_no8').innerHTML = '';
                document.getElementById('txt_no8').setAttribute("contenteditable", true);
                
                document.getElementById('no9').value = '';
                document.getElementById('txt_no9').innerHTML = '';
                document.getElementById('txt_no9').setAttribute("contenteditable", true);
                
                document.getElementById('no10').value = '';
                document.getElementById('txt_no10').innerHTML = '';
                document.getElementById('txt_no10').setAttribute("contenteditable", true);
                
                document.getElementById('no11').value = '';
                document.getElementById('txt_no11').innerHTML = '';
                document.getElementById('txt_no11').setAttribute("contenteditable", true);
            }
        }, 500);
    }
    if( thisID === 'txt_no4' ){
        clearTimeout(timer); 
        //timer = setTimeout(doStuff3(editableObj), 1000); 
        timer = setTimeout(function(){
            var amountReceived = $(editableObj).text();
            var amountTutor = document.getElementById('no7').value;
            document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
            document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
        }, 500);
    }
    if( thisID === 'txt_no7' ){
        clearTimeout(timer); 
        //timer = setTimeout(doStuff2(editableObj), 1000);  
        timer = setTimeout(function(){
            var amountTutor = $(editableObj).text();
            var amountReceived = document.getElementById('no4').value;
            document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
            document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
        }, 500);
    }
    if( thisID === 'RFtxt_no4' ){
        clearTimeout(timer); 
        timer = setTimeout(function(){
            var amountReceived = $(editableObj).text();
            var amountTutor = document.getElementById('RFno7').value;
            document.getElementById('RFno9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
            document.getElementById('RFtxt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
        }, 500);
    }
}
/*
function doStuff2(editableObj) {
    var amountTutor = $(editableObj).text();
    var amountReceived = document.getElementById('no4').value;
    document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
    document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
}
function doStuff3(editableObj) {
    var amountReceived = $(editableObj).text();
    var amountTutor = document.getElementById('no7').value;
    document.getElementById('no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
    document.getElementById('txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
}*/
function ChangeThis(editableObj,thisID) {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = dd + '/' + mm + '/' + yyyy;
        
    if( thisID === 'txt_no6' ){
        
        if( $(editableObj).text() == '' ){
            document.getElementById('no6').value = today;
            document.getElementById('txt_no6').innerHTML = today;            
        }

        var GetJob  = document.getElementById("no2").value
        var rowPaid = document.getElementById("no7").value
            
        if( GetJob != '' ){
            if( rowPaid === '' ){
            	  $.ajax({
            		url: "editable-job.php",
            		type: "POST",
            		data:'JobID='+GetJob,
            		success: function(result){
            	        trim = result.replace(/\s+/g, '');
            	        if( trim == "No" ){
                            alert(trim);
            	        }else if( trim == "Error 3" ){
            	            alert(trim);
            	        }else{
                		    var nameArr = trim.split(',');
                		    var tutorRate = nameArr[0];
                		    var cycle = nameArr[2];
                		    var matches = tutorRate.match(/[+-]?\d+(?:\.\d+)?/);

                            document.getElementById('no7').value = parseFloat(((matches[0]) * cycle)).toFixed(2);
                            document.getElementById('txt_no7').innerHTML = parseFloat(((matches[0]) * cycle)).toFixed(2);

                            document.getElementById('no9').value = parseFloat(((document.getElementById('no4').value) - (parseFloat(((matches[0]) * cycle)).toFixed(2)))).toFixed(2);
                            document.getElementById('txt_no9').innerHTML = parseFloat(((document.getElementById('no4').value) - (parseFloat(((matches[0]) * cycle)).toFixed(2)))).toFixed(2);
            	        }
            
            		}
            	  });
            }
        }
    }
    /*
    if( thisID === 'txt_no7' ){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = dd + '/' + mm + '/' + yyyy;
        
        var date  = document.getElementById("no6").value;
        if( date == '' ){
        document.getElementById('no6').value = today;
        document.getElementById('txt_no6').innerHTML = today;
        }
    }*/
}
// ############################################################ INSERT NEW ############################################################ //


// ############################################################ EDIT ############################################################# //
function saveToDatabase(editableObj,column,id) {
  $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
  var btnTabMonth = $(".btnTabMonth.active").attr('id');
  
  var idx = (($(editableObj).closest('tr').index())+1);
  var tr = document.getElementsByTagName("tr")[idx];
  var td_text = '';
  var GrossProfit = '';
  var currVal = $(editableObj).text();
  if( column == 'no4' ){
      var amountReceived = $(editableObj).text();
      var td = tr.getElementsByTagName("td")[7];
      td_text = (amountReceived - td.innerHTML);  
      GrossProfit = parseFloat(td_text).toFixed(2)

      var x=document.getElementById('table-body').rows[parseInt((idx-1),10)].cells;
      x[parseInt(9,10)].innerHTML= GrossProfit;   
      
  }else if( column == 'no7' ){
      var PaidTutor = $(editableObj).text();
      var td = tr.getElementsByTagName("td")[4];
      td_text = (td.innerHTML - PaidTutor);  
      GrossProfit = parseFloat(td_text).toFixed(2)
      
      var x=document.getElementById('table-body').rows[parseInt((idx-1),10)].cells;
      x[parseInt(9,10)].innerHTML= GrossProfit;   
  }else if( column == 'no6' ){
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();
      today = dd + '/' + mm + '/' + yyyy;
            		    
      var amountReceived = tr.getElementsByTagName("td")[4];     
                          
      var rowPaid = tr.getElementsByTagName("td")[7];
      rowPaid.innerHTML

      if( currVal === '' ){
          var x=document.getElementById('table-body').rows[parseInt((idx-1),10)].cells;
          x[parseInt(6,10)].innerHTML= today;
          
          if( rowPaid.innerHTML === '' ){
              var td = tr.getElementsByTagName("td")[2];
        	  $.ajax({
        		url: "editable-job.php",
        		type: "POST",
        		data:'JobID='+td.innerHTML+'&amountReceived='+amountReceived.innerHTML,
        		success: function(result){
        	
        	        if( result == 'No' ){
        	            alert(result);
        	        }else if( result == 'Error 3' ){
        	            alert(result);
        	        }else{
            		    var nameArr = result.split(',');
            		    var tutorRate = nameArr[0];
            		    var cycle = nameArr[2];
            		    var matches = tutorRate.match(/[+-]?\d+(?:\.\d+)?/);
            		    
            		    x[parseInt(7,10)].innerHTML= parseFloat(((matches[0]) * cycle)).toFixed(2);

                          td_text = ( amountReceived.innerHTML - (parseFloat(((matches[0]) * cycle)).toFixed(2)) );  
                          GrossProfit = parseFloat(td_text).toFixed(2)
            		    x[parseInt(9,10)].innerHTML= GrossProfit;
        	        }
        
        		}
        	  });              
          }
      }
      
  }

  $.ajax({
    url: "editable-edit.php",
    type: "POST",
    data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id+'&btnTabMonth='+btnTabMonth+'&GrossProfit='+GrossProfit,
    success: function(data){
      if( data == 'Error' ){
          alert(data);
      }else if( data == 'session' ){
		        
      }
      else{
          $(editableObj).css("background","#FDFDFD");
          
          var btnTab = $(".btnTabActive.active").attr('id');
          var thenum = btnTab.replace( /^\D+/g, '');
          $.ajax({
            type:'POST',
            url:'load-footer-sale.php',
            data: {
                dataFooter: {id: thenum, month: btnTabMonth},
            },
            success:function(resultFooter){
                document.getElementById("loadFooterSale").innerHTML = resultFooter;
            }
          });
      }
    }
  });
}
function carryForward(editableObj,column,id,numTable) {
        doConfirm("Please select type :", function yes() {
            carryForwardConfirm(editableObj,column,id,numTable);
        }, function no() {
            addRowConfirm(editableObj,column,id,numTable);
        }, function cancel() {
            //alert('cancel');
        });
}
function doConfirm(msg, yesFn, noFn, cnFn) {
    var confirmBox = $("#confirmBox");
    confirmBox.find(".message").text(msg);
    confirmBox.find(".yes,.no,.cancel").unbind().click(function () {
        confirmBox.hide();
    });
    confirmBox.find(".yes").click(yesFn);
    confirmBox.find(".no").click(noFn);
    confirmBox.find(".cancel").click(cnFn);
    confirmBox.show();
}
function carryForwardConfirm(editableObj,column,id,numTable) {

    var trythis = (Number(numTable) +1);

    var btmRow = document.getElementsByClassName("numTable"+trythis)[0];
    var btmCells = btmRow.getElementsByTagName("td");
    
    //alert(btmCells[3].innerText);
    if( btmCells[3].innerText == 'R.F' ){
        var x = document.getElementsByClassName("numTable"+trythis)[0].id; 
        var thenum = x.replace( /^\D+/g, ''); // replace all leading non-digits with nothing
        alert(thenum);        
    }else{
        alert('bkn');
    }

    var Row = document.getElementById("table-row-"+id);
    var Cells = Row.getElementsByTagName("td");

    var name = Cells[5].innerText;
    var dateTutor = Cells[6].innerText;
    var paidTutor = Cells[7].innerText;
    var GrossProfit = Cells[9].innerText;
    var Note        = Cells[11].innerText; 
    var btnTabMonth = $(".btnTabMonth.active").attr('id');
    
    //alert("\ncolumn: " + column + "\nid: " + id + "\nname: " + name + "\ndateTutor: " + dateTutor + "\npaidTutor: " + paidTutor + "\nGrossProfit: " + GrossProfit + "\nbtnTabMonth: " + btnTabMonth); 
    
/*
    var rowId =  event.target.parentNode.parentNode.id; 
    var data  =  document.getElementById(rowId).querySelectorAll(".row-data");  

    var name   = data[5].innerHTML; 
    var dateTutor   = data[6].innerHTML; 
    var paidTutor   = data[7].innerHTML; 
    var GrossProfit = data[9].innerHTML; 
    var Note        = data[11].innerHTML; 
    var btnTabMonth = $(".btnTabMonth.active").attr('id');
  
    alert("\ncolumn: " + column + "\nid: " + id + "\nname: " + name + "\ndateTutor: " + dateTutor + "\npaidTutor: " + paidTutor + "\nGrossProfit: " + GrossProfit + "\nbtnTabMonth: " + btnTabMonth); 
*/
    
     $("#confirmBox").hide();
    /*setTimeout(function(){ 
         var x = confirm("Are you sure you want to carry forward?");
    	 if (x == true){
            $.ajax({
                type:'POST',
                url:'sale-process.php',
                data: {
                    carryForward: {id: id},
                },
                success:function(result){
                    if(result == "empty ID"){
                        alert('empty ID');
                    }else if(result == "Error"){
                        alert('Error');
                    }
                    else{
                        $("#table-row-"+id).remove();
                    }
                }
            });
        	
    	 }
    }, 500);*/
}
function app_keyupFunction(editableObj,thisID,numTable) {


    var x = document.getElementsByClassName("numTable"+numTable)[0].id; 
    var thenum = x.replace( /^\D+/g, '');

    if( thisID === 'app_RFtxt_no4' ){
        clearTimeout(timer); 
        timer = setTimeout(function(){
            var amountReceived = $(editableObj).text();
            var amountTutor = document.getElementById('app_RFno7').value;
            document.getElementById('app_RFno9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
            document.getElementById('app_RFtxt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
        }, 500);
    }
    if( thisID === 'app_txt_no2' ){
        clearTimeout(timer); 
        timer = setTimeout(function(){
            var JobID = $(editableObj).text();
            if( JobID == '' ){
                $("#app_RFtable-row-"+thenum).remove();
                document.getElementById('app_no3').value = '';
                document.getElementById('app_txt_no3').innerHTML = '';
                		    
                document.getElementById('app_no4').value = '';
                document.getElementById('app_txt_no4').innerHTML = '';
                		    
                document.getElementById('app_no5').value = '';
                document.getElementById('app_txt_no5').innerHTML = '';
                		    
                document.getElementById('app_no9').value = '';
                document.getElementById('app_txt_no9').innerHTML = '';
                		    
                document.getElementById('app_no10').value = '';
                document.getElementById('app_txt_no10').innerHTML = '';   
            }else{
                
            	  $.ajax({
            		url: "editable-job.php",
            		type: "POST",
            		data:'JobID='+JobID,
            		success: function(result){
            		    trim = result.replace(/\s+/g, '');
            	        if( trim == "No" ){
                            $("#app_RFtable-row-"+thenum).remove();
                            document.getElementById('app_no3').value = '';
                            document.getElementById('app_txt_no3').innerHTML = '';
                            		    
                            document.getElementById('app_no4').value = '';
                            document.getElementById('app_txt_no4').innerHTML = '';
                            		    
                            document.getElementById('app_no5').value = '';
                            document.getElementById('app_txt_no5').innerHTML = '';
                            		    
                            document.getElementById('app_no9').value = '';
                            document.getElementById('app_txt_no9').innerHTML = '';
                            		    
                            document.getElementById('app_no10').value = '';
                            document.getElementById('app_txt_no10').innerHTML = '';   
            	        }else if( trim == "Error 3" ){
            	            alert(trim);
            	        }else{
                		    var nameArr = trim.split(',');
                		    var tutorRate = nameArr[0];
                		    var parentRate = nameArr[1];
                		    var cycle = nameArr[2];
                		    var tutorEmail = nameArr[3];
                		    var tutorDisplay = nameArr[4];
                		    var userAcc = nameArr[5];
                		    var RF = nameArr[6];
                		    
                		    if( RF > 0 ){
                                var today = new Date();
                                var dd = String(today.getDate()).padStart(2, '0');
                                var mm = String(today.getMonth() + 1).padStart(2, '0'); 
                                var yyyy = today.getFullYear();
                                today = dd + '/' + mm + '/' + yyyy;
            
                            	var data = '<tr class="table-row" id="app_RFtable-row-'+thenum+'">' +
                            	
                            	'<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_dataNo" onBlur="addToHiddenField(this,\'app_RFrow_no\')" onClick="editRow(this);"></td>' +
                            	
                            	'<td style="font-size:14px;" contenteditable="true"   id="app_RFtxt_no1"    onBlur="addToHiddenField(this,\'app_RFno1\')"    onClick="editRow(this);">'+today+'</td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_no2"    onBlur="addToHiddenField(this,\'app_RFno2\')"    onClick="editRow(this);"></td>' +
                            
                            	'<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_no3"    onBlur="addToHiddenField(this,\'app_RFno3\')"    onClick="editRow(this);">R.F</td>' +
                            	'<td style="font-size:14px;" contenteditable="true"   id="app_RFtxt_no4"    onBlur="addToHiddenField(this,\'app_RFno4\')"    onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id,'+numTable+')">'+RF+'</td>' +
                            	'<td style="font-size:14px;" contenteditable="true"   id="app_RFtxt_no5"    onBlur="addToHiddenField(this,\'app_RFno5\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_no6"    onBlur="addToHiddenField(this,\'app_RFno6\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_no7"    onBlur="addToHiddenField(this,\'app_RFno7\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_no8"    onBlur="addToHiddenField(this,\'app_RFno8\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_no9"    onBlur="addToHiddenField(this,\'app_RFno9\')"    onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="false"  id="app_RFtxt_no10"   onBlur="addToHiddenField(this,\'app_RFno10\')"   onClick="editRow(this);"></td>' +
                            	'<td style="font-size:14px;" contenteditable="true"   id="app_RFtxt_no11"   onBlur="addToHiddenField(this,\'app_RFno11\')"   onClick="editRow(this);">New</td>' +
                            	
                            
                            	'<td style="font-size:14px;" >  <input type="hidden" id="app_RFrow_no" /> <input type="hidden" id="app_RFno1" value="'+today+'"/> <input type="hidden" id="app_RFno2" value="'+JobID+'"/> <input type="hidden" id="app_RFno3" value="R.F"/> <input type="hidden" id="app_RFno4" value="'+RF+'" /> <input type="hidden" id="app_RFno5" /> <input type="hidden" id="app_RFno6" /> <input type="hidden" id="app_RFno7" /> <input type="hidden" id="app_RFno8" /> <input type="hidden" id="app_RFno9" /> <input type="hidden" id="app_RFno10" /> <input type="hidden" id="app_RFno11" value="New"/>  <span id="confirmAdd"><a onclick="app_RemoveAdd('+thenum+');" class="ajax-action-links" style="color:red"><b>Remove</b></a></span>  </td>' +	
                            	'</tr>';
                            	$('table > tbody > tr').eq(numTable).after(data); 
                            	
                		        document.getElementById('app_RFno5').value = userAcc;
                		        document.getElementById('app_RFtxt_no5').innerHTML = '';
                		        
                		        document.getElementById('app_RFno9').value = parseFloat(( document.getElementById('app_RFno4').value - document.getElementById('app_RFno7').value )).toFixed(2);
                		        document.getElementById('app_RFtxt_no9').innerHTML = parseFloat(( document.getElementById('app_RFno4').value - document.getElementById('app_RFno7').value )).toFixed(2);
                		    }else{
                		        $("#app_RFtable-row-"+thenum).remove();
                		    }
                		    
                		    document.getElementById('app_no3').value = tutorDisplay;
                		    document.getElementById('app_txt_no3').innerHTML = tutorDisplay;
                		    
                		    document.getElementById('app_no4').value = parseFloat((parentRate * cycle)).toFixed(2);
                		    document.getElementById('app_txt_no4').innerHTML = parseFloat((parentRate * cycle)).toFixed(2);
                		    
                		    document.getElementById('app_no5').value = userAcc;
                		    document.getElementById('app_txt_no5').innerHTML = userAcc;
                		    
                		    document.getElementById('app_no9').value = parseFloat(( document.getElementById('app_no4').value - document.getElementById('app_no7').value )).toFixed(2);
                		    document.getElementById('app_txt_no9').innerHTML = parseFloat(( document.getElementById('app_no4').value - document.getElementById('app_no7').value )).toFixed(2);
                		    
                		    document.getElementById('app_no10').value = cycle;
                		    document.getElementById('app_txt_no10').innerHTML = cycle;           
            	        }

            		}
                });
                
            }
        }, 500);
    }
    if( thisID === 'app_txt_no3' ){
        clearTimeout(timer); 
        timer = setTimeout(function(){
            var tutorName = $(editableObj).text();
            
            var tid=$('.tbl-qa > tbody > tr:nth-last-child(2)').attr('id');
            var thenum = tid.replace( /^\D+/g, '');
            //alert(tid +' '+thenum); 

            var Row = document.getElementById("table-row-"+thenum);
            var Cells = Row.getElementsByTagName("td");
            var tJobID = Cells[2].innerText;
    
            if( tutorName == 'R.F' ){
                document.getElementById('app_no2').value = tJobID;
                document.getElementById('app_txt_no2').innerHTML = '';
                document.getElementById('app_txt_no2').setAttribute("contenteditable", false);
                
                document.getElementById('app_no4').value = '';
                document.getElementById('app_txt_no4').innerHTML = '';
                document.getElementById('app_txt_no4').setAttribute("contenteditable", true);
                
                document.getElementById('app_no5').value = '';
                document.getElementById('app_txt_no5').innerHTML = '';
                document.getElementById('app_txt_no5').setAttribute("contenteditable", true);
                
                document.getElementById('app_no6').value = '';
                document.getElementById('app_txt_no6').innerHTML = '';
                document.getElementById('app_txt_no6').setAttribute("onclick", false);
                document.getElementById('app_txt_no6').setAttribute("contenteditable", false);
                
                document.getElementById('app_no7').value = '';
                document.getElementById('app_txt_no7').innerHTML = '';
                document.getElementById('app_txt_no7').setAttribute("contenteditable", false);
                
                document.getElementById('app_no8').value = '';
                document.getElementById('app_txt_no8').innerHTML = '';
                document.getElementById('app_txt_no8').setAttribute("contenteditable", false);
                
                document.getElementById('app_no9').value = '';
                document.getElementById('app_txt_no9').innerHTML = '';
                document.getElementById('app_txt_no9').setAttribute("contenteditable", false);
                
                document.getElementById('app_no10').value = '';
                document.getElementById('app_txt_no10').innerHTML = '';
                document.getElementById('app_txt_no10').setAttribute("contenteditable", false);
                
                document.getElementById('app_no11').value = 'New';
                document.getElementById('app_txt_no11').innerHTML = 'New';
                document.getElementById('app_txt_no11').setAttribute("contenteditable", false);
            }else{
                document.getElementById('app_no2').value = '';
                document.getElementById('app_txt_no2').innerHTML = '';
                document.getElementById('app_txt_no2').setAttribute("contenteditable", true);
                
                document.getElementById('app_no4').value = '';
                document.getElementById('app_txt_no4').innerHTML = '';
                document.getElementById('app_txt_no4').setAttribute("contenteditable", true);
                
                document.getElementById('app_no5').value = '';
                document.getElementById('app_txt_no5').innerHTML = '';
                document.getElementById('app_txt_no5').setAttribute("contenteditable", true);

                document.getElementById('app_no6').value = '';
                document.getElementById('app_txt_no6').innerHTML = '';
                document.getElementById('app_txt_no6').setAttribute("onclick", "ChangeThis(this,this.id);");
                document.getElementById('app_txt_no6').setAttribute("contenteditable", true);
                
                document.getElementById('app_no7').value = '';
                document.getElementById('app_txt_no7').innerHTML = '';
                document.getElementById('app_txt_no7').setAttribute("contenteditable", true);
                
                document.getElementById('app_no8').value = '';
                document.getElementById('app_txt_no8').innerHTML = '';
                document.getElementById('app_txt_no8').setAttribute("contenteditable", true);
                
                document.getElementById('app_no9').value = '';
                document.getElementById('app_txt_no9').innerHTML = '';
                document.getElementById('app_txt_no9').setAttribute("contenteditable", true);
                
                document.getElementById('app_no10').value = '';
                document.getElementById('app_txt_no10').innerHTML = '';
                document.getElementById('app_txt_no10').setAttribute("contenteditable", true);
                
                document.getElementById('app_no11').value = '';
                document.getElementById('app_txt_no11').innerHTML = '';
                document.getElementById('app_txt_no11').setAttribute("contenteditable", true);
            }
        }, 500);
    }
    if( thisID === 'app_txt_no4' ){
        clearTimeout(timer); 
        timer = setTimeout(function(){
            var amountReceived = $(editableObj).text();
            var amountTutor = document.getElementById('app_no7').value;
            document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
            document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
        }, 500);
    }
    if( thisID === 'app_txt_no7' ){
        clearTimeout(timer); 
        timer = setTimeout(function(){
            var amountTutor = $(editableObj).text();
            var amountReceived = document.getElementById('app_no4').value;
            document.getElementById('app_no9').value = parseFloat((amountReceived - amountTutor)).toFixed(2);
            document.getElementById('app_txt_no9').innerHTML = parseFloat((amountReceived - amountTutor)).toFixed(2);
        }, 500);
    }
    
    

}
function addRowConfirm(editableObj,column,id,numTable) {
    $("#confirmBox").hide();
    setTimeout(function(){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = dd + '/' + mm + '/' + yyyy;
      
        $("#add-more").hide();
        var x = document.getElementsByClassName("numTable"+numTable)[0].id; 
        var thenum = x.replace( /^\D+/g, '');
        var numTableNew = (Number(numTable) + 1);
        alert(numTable);
        
        	var data = '<tr class="table-row" id="table-row-">' +
        	
        	'<td style="font-size:14px;" contenteditable="false" id="app_txt_dataNo"  onBlur="addToHiddenField(this,\'app_row_no\')" onClick="editRow(this);"></td>' +
        	
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no1"     onBlur="addToHiddenField(this,\'app_no1\')"     onClick="editRow(this);">'+today+'</td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no2"     onBlur="addToHiddenField(this,\'app_no2\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id)"></td>' +
        
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no3"     onBlur="addToHiddenField(this,\'app_no3\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id)"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no4"     onBlur="addToHiddenField(this,\'app_no4\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id)"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no5"     onBlur="addToHiddenField(this,\'app_no5\')"     onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no6"     onBlur="addToHiddenField(this,\'app_no6\')"     onClick="ChangeThis(this,this.id);" onkeyup="app_keyupFunction(this,this.id)"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no7"     onBlur="addToHiddenField(this,\'app_no7\')"     onClick="ChangeThis(this,this.id);" onkeyup="app_keyupFunction(this,this.id)"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no8"     onBlur="addToHiddenField(this,\'app_no8\')"     onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no9"     onBlur="addToHiddenField(this,\'app_no9\')"     onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no10"    onBlur="addToHiddenField(this,\'app_no10\')"    onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no11"    onBlur="addToHiddenField(this,\'app_no11\')"    onClick="editRow(this);"></td>' +
        	
        
        	'<td style="font-size:14px;" >  <input type="text" id="app_row_no" value="'+numTableNew+'"/> <input type="text" id="app_no1" value="'+today+'"/> <input type="text" id="app_no2" /> <input type="text" id="app_no3" /> <input type="text" id="app_no4" /> <input type="text" id="app_no5" /> <input type="text" id="app_no6" /> <input type="text" id="app_no7" /> <input type="text" id="app_no8" /> <input type="text" id="app_no9" /> <input type="text" id="app_no10" /> <input type="text" id="app_no11" />  <span id="confirmAdd"><a onClick="app_addToDatabase()" class="ajax-action-links" style="color:#28A745"><b>Save</b></a> / <a onclick="app_cancelAdd('+thenum+');" class="ajax-action-links" style="color:#007BFF"><b>Cancel</b></a></span>  </td>' +	
        	'</tr>';
          $('table > tbody > tr').eq(numTable - 1).after(data); 
        
        
/*
        	var data = '<tr class="table-row" id="table-row-'+thenum+'">' +
        	
        	'<td style="font-size:14px;" contenteditable="false" id="app_txt_dataNo"  onBlur="addToHiddenField(this,\'app_row_no\')" onClick="editRow(this);">AD</td>' +
        	
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no1"     onBlur="addToHiddenField(this,\'app_no1\')"     onClick="editRow(this);">'+today+'</td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no2"     onBlur="addToHiddenField(this,\'app_no2\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id,'+numTable+')"></td>' +
        
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no3"     onBlur="addToHiddenField(this,\'app_no3\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id,'+numTable+')"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no4"     onBlur="addToHiddenField(this,\'app_no4\')"     onClick="editRow(this);" onkeyup="app_keyupFunction(this,this.id,'+numTable+')"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no5"     onBlur="addToHiddenField(this,\'app_no5\')"     onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no6"     onBlur="addToHiddenField(this,\'app_no6\')"     onClick="ChangeThis(this,this.id);" onkeyup="app_keyupFunction(this,this.id,'+numTable+')"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no7"     onBlur="addToHiddenField(this,\'app_no7\')"     onClick="ChangeThis(this,this.id);" onkeyup="app_keyupFunction(this,this.id,'+numTable+')"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no8"     onBlur="addToHiddenField(this,\'app_no8\')"     onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no9"     onBlur="addToHiddenField(this,\'app_no9\')"     onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no10"    onBlur="addToHiddenField(this,\'app_no10\')"    onClick="editRow(this);"></td>' +
        	'<td style="font-size:14px;" contenteditable="true" id="app_txt_no11"    onBlur="addToHiddenField(this,\'app_no11\')"    onClick="editRow(this);"></td>' +
        	
        
        	'<td style="font-size:14px;" >  <input type="text" id="app_row_no" value="AD"/> <input type="text" id="app_no1" value="'+today+'"/> <input type="text" id="app_no2" /> <input type="text" id="app_no3" /> <input type="text" id="app_no4" /> <input type="text" id="app_no5" /> <input type="text" id="app_no6" /> <input type="text" id="app_no7" /> <input type="text" id="app_no8" /> <input type="text" id="app_no9" /> <input type="text" id="app_no10" /> <input type="text" id="app_no11" />  <span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links" style="color:#28A745"><b>Save</b></a> / <a onclick="app_cancelAdd('+thenum+');" class="ajax-action-links" style="color:#007BFF"><b>Cancel</b></a></span>  </td>' +	
        	'</tr>';
          $('table > tbody > tr').eq(numTable - 1).after(data); 
*/
    }, 500);
}
function dateTutorPaid(editableObj,column,id) {
      $('.btnSaveEdit').not("#saveDateTutorPaid"+id).addClass("hidden");
      $("#add-more").show();
      $("#new_row_ajax").remove();
      $("#RFnew_row_ajax").remove();
      document.getElementById('duplicateBtn').innerHTML = '';
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();
      today = dd + '/' + mm + '/' + yyyy;
              
      var idx = (($(editableObj).closest('tr').index())+1);
      var tr = document.getElementsByTagName("tr")[idx];

      var amountReceived = tr.getElementsByTagName("td")[4];   
              
      var x=document.getElementById('table-body').rows[parseInt((idx-1),10)].cells;
      
      if(column == 'saveManualno6'){
          if( $(editableObj).text() == ''){
              x[parseInt(6,10)].innerHTML= today;      
              var td = tr.getElementsByTagName("td")[2];
              if( td.innerHTML != ''){
            	  $.ajax({
            		url: "editable-job.php",
            		type: "POST",
            		data:'JobID='+td.innerHTML+'&amountReceived='+amountReceived.innerHTML,
            		success: function(result){
            	
            	        if( result == 'No' ){
            	            alert(result);
            	        }else if( result == 'Error 3' ){
            	            alert(result);
            	        }else{
                		    var nameArr = result.split(',');
                		    var tutorRate = nameArr[0];
                		    var cycle = nameArr[2];
                		    var matches = tutorRate.match(/[+-]?\d+(?:\.\d+)?/);
                		    
                		    if( tr.getElementsByTagName("td")[7].innerHTML == ''){
                		        x[parseInt(7,10)].innerHTML= parseFloat(((matches[0]) * cycle)).toFixed(2);
                		    }
                		    
                              td_text = ( amountReceived.innerHTML - (parseFloat(((matches[0]) * cycle)).toFixed(2)) );  
                              GrossProfit = parseFloat(td_text).toFixed(2)
                		    x[parseInt(9,10)].innerHTML= GrossProfit;
            	        }
            
            		}
            	  });                  
              }
          document.getElementById("saveDateTutorPaid"+id).classList.remove('hidden');
          document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\''+id+'\')" />';
          }
      }
      
      if(column == 'saveManualno7'){
          if( $(editableObj).text() == ''){
              x[parseInt(6,10)].innerHTML= today;      
              var td = tr.getElementsByTagName("td")[2];
              if( td.innerHTML != ''){
            	  $.ajax({
            		url: "editable-job.php",
            		type: "POST",
            		data:'JobID='+td.innerHTML+'&amountReceived='+amountReceived.innerHTML,
            		success: function(result){
            	
            	        if( result == 'No' ){
            	            alert(result);
            	        }else if( result == 'Error 3' ){
            	            alert(result);
            	        }else{
                		    var nameArr = result.split(',');
                		    var tutorRate = nameArr[0];
                		    var cycle = nameArr[2];
                		    var matches = tutorRate.match(/[+-]?\d+(?:\.\d+)?/);
                		    
                		    if( tr.getElementsByTagName("td")[7].innerHTML == ''){
                		        x[parseInt(7,10)].innerHTML= parseFloat(((matches[0]) * cycle)).toFixed(2);
                		    }

                              td_text = ( amountReceived.innerHTML - (parseFloat(((matches[0]) * cycle)).toFixed(2)) );  
                              GrossProfit = parseFloat(td_text).toFixed(2)
                		    x[parseInt(9,10)].innerHTML= GrossProfit;
            	        }
            
            		}
            	  });                  
              }
          document.getElementById("saveDateTutorPaid"+id).classList.remove('hidden');
          document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\''+id+'\')" />';
          }
      }
      
      if(column == 'saveManualno11'){
            var Row = document.getElementById("table-row-"+id);
            var Cells = Row.getElementsByTagName("td");
        
            var dateTutor = Cells[6].innerText;
            var paidTutor = Cells[7].innerText;
            var GrossProfit = Cells[9].innerText;
            var Note        = Cells[11].innerText; 
            var btnTabMonth = $(".btnTabMonth.active").attr('id');

            if( Cells[3].innerText != 'R.F'){
                if( dateTutor == '' && paidTutor == '' ){
                    document.getElementById("saveDateTutorPaid"+id).classList.remove('hidden');
                    document.getElementById('duplicateBtn').innerHTML = '<input style="border:none;background:none;color:#28A745;font-weight: bold;" class="ajax-action-links" type="button" value="Save" onclick="show2(this,\'saveManual\',\''+id+'\')" />';
                }else{
                    
                }            
            }else{
                
            }
      }
}
function changeTutorPaid(editableObj,column,id) {
  var btnTabMonth = $(".btnTabMonth.active").attr('id');
  var idx = (($(editableObj).closest('tr').index())+1);
  var tr = document.getElementsByTagName("tr")[idx];
  var td_text = '';
  var GrossProfit = '';
  var currVal = $(editableObj).text();
  
    if( column == 'no7' ){
      var PaidTutor = $(editableObj).text();
      var td = tr.getElementsByTagName("td")[4];
      td_text = (td.innerHTML - PaidTutor);  
      GrossProfit = parseFloat(td_text).toFixed(2)
      
      var x=document.getElementById('table-body').rows[parseInt((idx-1),10)].cells;
      x[parseInt(9,10)].innerHTML= GrossProfit;
  }
  
    clearTimeout(timer); 
    timer = setTimeout(
        function(){
          $.ajax({
            url: "editable-edit.php",
            type: "POST",
            data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id+'&btnTabMonth='+btnTabMonth+'&GrossProfit='+GrossProfit,
            success: function(data){
              if( data == 'Error' ){
                  alert(data);
              }else if( data == 'session' ){
        		        
              }
              else{
                  $(editableObj).css("background","#FDFDFD");
                  
                  var btnTab = $(".btnTabActive.active").attr('id');
                  var thenum = btnTab.replace( /^\D+/g, '');
                  $.ajax({
                    type:'POST',
                    url:'load-footer-sale.php',
                    data: {
                        dataFooter: {id: thenum, month: btnTabMonth},
                    },
                    success:function(resultFooter){
                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                    }
                  });
              }
            }
          });
        }
    , 1000);
}

function show2(editableObj,column,id) {
    var Row = document.getElementById("table-row-"+id);
    var Cells = Row.getElementsByTagName("td");

    var dateTutor = Cells[6].innerText;
    var paidTutor = Cells[7].innerText;
    var GrossProfit = Cells[9].innerText;
    var Note        = Cells[11].innerText; 
    var btnTabMonth = $(".btnTabMonth.active").attr('id');
    
    document.getElementById("saveDateTutorPaid"+id).classList.add('hidden');
    document.getElementById('duplicateBtn').innerHTML = '';

  $.ajax({
    url: "editable-edit.php",
    type: "POST",
    data:'column='+column+'&id='+id+'&btnTabMonth='+btnTabMonth+'&GrossProfit='+GrossProfit+'&dateTutor='+dateTutor+'&paidTutor='+paidTutor+'&note='+Note,
    success: function(data){
      if( data == 'Error' ){
          alert(data);
      }else if( data == 'session' ){
		        
      }
      else{
          $(editableObj).css("background","#FDFDFD");
          
          var btnTab = $(".btnTabActive.active").attr('id');
          var thenum = btnTab.replace( /^\D+/g, '');
          $.ajax({
            type:'POST',
            url:'load-footer-sale.php',
            data: {
                dataFooter: {id: thenum, month: btnTabMonth},
            },
            success:function(resultFooter){
                document.getElementById("loadFooterSale").innerHTML = resultFooter;
            }
          });
      }
    }
  });
  
}
function show(editableObj,column,id) {
    var rowId =  event.target.parentNode.parentNode.id; 
    var data  =  document.getElementById(rowId).querySelectorAll(".row-data");  

    var dateTutor   = data[6].innerHTML; 
    var paidTutor   = data[7].innerHTML; 
    var GrossProfit = data[9].innerHTML; 
    var Note        = data[11].innerHTML; 
    var btnTabMonth = $(".btnTabMonth.active").attr('id');

    document.getElementById("saveDateTutorPaid"+id).classList.add('hidden');
    document.getElementById('duplicateBtn').innerHTML = '';

  $.ajax({
    url: "editable-edit.php",
    type: "POST",
    data:'column='+column+'&id='+id+'&btnTabMonth='+btnTabMonth+'&GrossProfit='+GrossProfit+'&dateTutor='+dateTutor+'&paidTutor='+paidTutor+'&note='+Note,
    success: function(data){
      if( data == 'Error' ){
          alert(data);
      }else if( data == 'session' ){
		        
      }
      else{
          $(editableObj).css("background","#FDFDFD");
          
          var btnTab = $(".btnTabActive.active").attr('id');
          var thenum = btnTab.replace( /^\D+/g, '');
          $.ajax({
            type:'POST',
            url:'load-footer-sale.php',
            data: {
                dataFooter: {id: thenum, month: btnTabMonth},
            },
            success:function(resultFooter){
                document.getElementById("loadFooterSale").innerHTML = resultFooter;
            }
          });
      }
    }
  });
}
// ############################################################ EDIT ############################################################ //


// ############################################################ DELETE ############################################################ //
function deleteRecord(id) {
	if(confirm("Are you sure you want to delete this row?")) {
	    
		var btnTabMonth = $(".btnTabMonth.active").attr('id');
		$.ajax({
			url: "editable-delete.php",
			type: "POST",
			data:'id='+id+'&btnTabMonth='+btnTabMonth,
			success: function(data){
			  if( data == 'Error' ){
			      alert(data);
			  }else if( data == 'session' ){
		        
			  }
			  else{
			      $("#table-row-"+id).remove();
                  var btnTab = $(".btnTabActive.active").attr('id');
                  var thenum = btnTab.replace( /^\D+/g, '');
                  $.ajax({
                    type:'POST',
                    url:'load-footer-sale.php',
                    data: {
                        dataFooter: {id: thenum, month: btnTabMonth},
                    },
                    success:function(resultFooter){
                        document.getElementById("loadFooterSale").innerHTML = resultFooter;
                    }
                  });
			  }
			}
		});
	}
}
// ############################################################ DELETE ############################################################ //










            





</script>

<style>
.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;}
.tbl-qa th.table-header {padding: 3px;text-align: left;padding:8px;}
.tbl-qa td.table-header {padding: 3px;text-align: left;padding:8px;font-size:0.9em;font-weight: bold;}
.tbl-qa .table-row td {padding:8px;background-color: #FDFDFD;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;}
.ajax-action-links {color: #28A745; margin: 8px 0px;cursor:pointer;}
.ajax-action-button {border:#094 1px solid;color: #09F; margin: 8px 0px;cursor:pointer;display: inline-block;padding: 8px 18px;}
</style>

<div id="loadSaleData"></div>
<br/><button id="add-more" onClick="createNew();" type="button" class="btn btn-success-ori btn-sm"><span class="glyphicon glyphicon-plus"></span> Add More</button>
<span id="duplicateBtn"></span>
                    
        
    </div>
</div>








<?PHP
}else{
    echo 'Error : Content..';
}
$conn->close();
?>

<script>
$(document).ready(function(){
    var arActive =  document.getElementById("thisActive").value;
    document.getElementById("tabID").value = arActive;
    document.getElementById('btnTabActive'+arActive).click();
    document.getElementById('btnTabActive'+arActive).classList.add('active');

    var btnTab = $(".btnTabActive.active").attr('id');
    var btnTabMonth = $(".btnTabMonth.active").attr('id');
    var thenum = btnTab.replace( /^\D+/g, '');
    	$.ajax({
    		type:'POST',
    		url:'load-data-sale.php',
    		data: {
    			dataGrid: {id: thenum, month: btnTabMonth},
    		},
    		success:function(result){
    			document.getElementById("tabID").value = thenum;
    			document.getElementById("loadSaleData").innerHTML = result;
            	$.ajax({
            		type:'POST',
            		url:'load-footer-sale.php',
            		data: {
            			dataFooter: {id: thenum, month: btnTabMonth},
            		},
            		success:function(resultFooter){
            		    document.getElementById("loadFooterSale").innerHTML = resultFooter;
            		}
            	});
    		}
    	});

});

function getMonth(month){
    $('.btnTabMonth').not("#month").removeClass("active");
    document.getElementById(month).classList.add('active');
    document.getElementById('duplicateBtn').innerHTML = '';
    
    var btnTab = $(".btnTabActive.active").attr('id');
    var btnTabMonth = $(".btnTabMonth.active").attr('id');
    var thenum = btnTab.replace( /^\D+/g, '');
    $("#add-more").show();
    	$.ajax({
    		type:'POST',
    		url:'load-data-sale.php',
    		data: {
    			dataGrid: {id: thenum, month: btnTabMonth},
    		},
    		success:function(result){
    			document.getElementById("tabID").value = thenum;
    			document.getElementById("loadSaleData").innerHTML = result;
            	$.ajax({
            		type:'POST',
            		url:'load-footer-sale.php',
            		data: {
            			dataFooter: {id: thenum, month: btnTabMonth},
            		},
            		success:function(resultFooter){
            		    document.getElementById("loadFooterSale").innerHTML = resultFooter;
            		}
            	});
    		}
    	});
   
}

function replyClick(clickedID){

    var thenum = clickedID.replace( /^\D+/g, '');
    //alert(clickedID + ' ' + thenum);
    $('.btnTabActive').not("#clickedID").removeClass("active");
    document.getElementById(clickedID).classList.add('active');
    document.getElementById('duplicateBtn').innerHTML = '';
    
    $('.btnTabMonth').not("#month").removeClass("active");
    document.getElementById('Jan').classList.add('active');
  
    var btnTab = $(".btnTabActive.active").attr('id');
    var btnTabMonth = $(".btnTabMonth.active").attr('id');
    var thenum = btnTab.replace( /^\D+/g, '');
    $("#add-more").show();
    	$.ajax({
    		type:'POST',
    		url:'load-data-sale.php',
    		data: {
    			dataGrid: {id: thenum, month: btnTabMonth},
    		},
    		success:function(result){
    			document.getElementById("tabID").value = thenum;
    			document.getElementById("loadSaleData").innerHTML = result;
            	$.ajax({
            		type:'POST',
            		url:'load-footer-sale.php',
            		data: {
            			dataFooter: {id: thenum, month: btnTabMonth},
            		},
            		success:function(resultFooter){
            		    document.getElementById("loadFooterSale").innerHTML = resultFooter;
            		}
            	});
    		}
    	});

}

function submitTab() {
    
    var mainID  = document.getElementById('mainID').value;
    var Tabname = document.getElementById('TabInput').value;

    if ( mainID == '' && TabInput == '' ) {
        alert('Please insert name');
    }else{
        $.ajax({
            type:'POST',
            url:'sale-process.php',
            data: {
                dataTabs: {mainID: mainID, Tabname: Tabname},
            },
            success:function(result){
                if(result == "Success"){
                    document.getElementById('closeModal').click();
                    setTimeout(function() { getSaleFile(mainID); }, 1000);
                }else{
                    alert(result);
                }
            }
        });
    }

}
</script>




<!--
<script src="https://cdn.jsdelivr.net/npm/jquery.appendgrid@2/dist/AppendGrid.js"></script>
<script>
$(document).ready(function(){
          $('.datepicker').datepicker({
              startView: 0,
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              format: "dd/mm/yyyy"
          });
});
</script>-->