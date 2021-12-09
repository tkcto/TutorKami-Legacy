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
            

    <table id="tblAppendGrid"></table>
  <button id="load" type="button" class="btn btn-primary">Load Data</button>
<!--
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.appendgrid@2/dist/AppendGrid.js"></script>
-->
    <script>
var myAppendGrid = new AppendGrid({
  element: "tblAppendGrid",
  uiFramework: "bootstrap4",
  iconFramework: "fontawesome5",
  columns: [
    {
      name: "id",
      display: "id"
    },

    {
      name: "main_id",
      display: "main_id"
    },
    {
      name: "tab_name",
      display: "tab_name"
    },
    {
      name: "month",
      display: "month"
    }
  ],


  sectionClasses: {
    table: "table-sm",
    control: "form-control-sm",
    buttonGroup: "btn-group-sm"
  },
    initData: [
    {
      id: "Job 1",
      main_id: "TutorName 1",
      tab_name: "Hour 1",
      month: "Note2 1"
    },
    {
      id: "Job 1",
      main_id: "TutorName 1",
      tab_name: "Hour 1",
      month: "Note2 1"
    },
    {
      id: "Job 1",
      main_id: "TutorName 1",
      tab_name: "Hour 1",
      month: "Note2 1"
    }
  ]
});





$("#load").on("click", function () {

var AccountID = '';
/*
$.ajax({ 
    url: "testing.php",
    data: { accountID: AccountID }
}).done(function (result) {
    myAppendGrid.load(result);
    //alert(result);
}).fail(function (jqXHR, textStatus) {
    alert('fail');
});
*/

$.ajax({
  method: "POST",
  url: "testing.php",
  data: { name: "John", location: "Boston" }
})
  .done(function( msg ) {
      
var myAppendGrid = new AppendGrid({
  element: "tblAppendGrid",
  uiFramework: "bootstrap4",
  iconFramework: "fontawesome5",
  columns: [
    {
      name: "id",
      display: "id"
    },

    {
      name: "main_id",
      display: "main_id"
    },
    {
      name: "tab_name",
      display: "tab_name"
    },
    {
      name: "month",
      display: "month"
    }
  ]
});
      
      
    myAppendGrid.load(msg);
    //alert(msg)
  });



/*
[{"id":"1","main_id":"1","tab_name":"Nadia","month":""},{"id":"2","main_id":"1","tab_name":"Zahrah","month":""},{"id":"3","main_id":"1","tab_name":"Nadia","month":"Jan"},{"id":"4","main_id":"1","tab_name":"Nadia","month":"Jan"},{"id":"5","main_id":"1","tab_name":"Nadia","month":"Jan"},{"id":"6","main_id":"1","tab_name":"Nadia","month":"Jan"},{"id":"7","main_id":"1","tab_name":"Nadia","month":"Jan"},{"id":"8","main_id":"1","tab_name":"Zahrah","month":"Jan"},{"id":"9","main_id":"1","tab_name":"Zahrah","month":"Jan"},{"id":"10","main_id":"1","tab_name":"Zahrah","month":"Jan"},{"id":"11","main_id":"1","tab_name":"Zahrah","month":"Jan"},{"id":"12","main_id":"1","tab_name":"Zahrah","month":"Jan"},{"id":"13","main_id":"2","tab_name":"Nadia","month":""},{"id":"14","main_id":"2","tab_name":"Nadia","month":"Jan"},{"id":"15","main_id":"2","tab_name":"Nadia","month":"Jan"},{"id":"16","main_id":"2","tab_name":"Nadia","month":"Jan"},{"id":"17","main_id":"2","tab_name":"Nadia","month":"Jan"},{"id":"18","main_id":"2","tab_name":"Nadia","month":"Jan"}]


  myAppendGrid.load([{"id":"1","main_id":"1","tab_name":"Nadia","month":""},{"id":"2","main_id":"1","tab_name":"Zahrah","month":""}]);
*/

});




    </script>
            
            
            
            
            
            
            
        </div>
    </div>
    <?PHP
}else{
    echo 'Error : Content..';
}
$conn->close();
?>
