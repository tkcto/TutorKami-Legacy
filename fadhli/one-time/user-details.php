<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


</style>
<?php
require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
?>

<br><br>
<div class="container">
	<div class="row">
    <div class="col-lg-12">
        
        <div class="jumbotron">
            <h4 class="heading"><strong>User Detail </strong><span></span></h4>
            <form>
              <div class="form-group">
                <label for="exampleFormControlSelect1">State</label>
                <select class="form-control" id="exampleFormControlSelect1">
                <?PHP
                $states = " SELECT * FROM tk_states WHERE st_id !='1046' AND st_id !='1658' ORDER BY st_name ASC ";
                $resultstates = $conn->query($states);
                if ($resultstates->num_rows > 0) {
                    while($rowstates = $resultstates->fetch_assoc()){
                        ?><option value="<?PHP echo $rowstates['st_id']; ?>"><?PHP echo $rowstates['st_name']; ?></option><?PHP
                    }
                }
                ?>
                </select>
              </div>
              <div class="form-group">
                <button onclick="GetSelectedTextValue()" type="button" name="exportExcel" id="exportExcel" class="btn btn-info btn-md">Generate</button>
              </div>
            </form>
        </div>

        <div class="jumbotron">
            <h4 class="heading"><strong>List Of Tutor </strong><span></span></h4>
            <form>
              <div class="form-group">
                <label for="labelAge">Age</label>
                  <div class="row">
                    <div class="col">
                      <input id="AgeStart" type="text" class="form-control" placeholder="example : 19">
                    </div>
                    <div class="col"> <input style="text-align: center;border: none;background-color:#E9ECEF" type="text" class="form-control" placeholder="TO" Value="TO" disabled ></div>
                    <div class="col">
                      <input id="AgeEnd" type="text" class="form-control" placeholder="example : 30">
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <label for="labelPaid">Paid Job</label>
                <select class="form-control" id="selectpaid">
                        <option value="paid">Yes</option>
                        <option value="pending">Unpaid</option>
                </select>
              </div>
              
              <div class="form-group">
                <button onclick="GenerateList()" type="button" name="GenerateList2" id="GenerateList2" class="btn btn-info btn-md">Generate</button>
              </div>
            </form>
        </div>







    </div>
	</div>
</div>








<script>
    function GetSelectedTextValue() {
        var exampleFormControlSelect1 = document.getElementById("exampleFormControlSelect1");
        var selectedText = exampleFormControlSelect1.options[exampleFormControlSelect1.selectedIndex].innerHTML;
        var selectedValue = exampleFormControlSelect1.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        //alert(selectedValue);
        window.open("https://www.tutorkami.com/fadhli/one-time/user-details-generate.php?locationNAme="+ selectedText +"&locationID="+ selectedValue, "_blank");
			
    }
    
    function GenerateList() {
        var AgeStart   = document.getElementById("AgeStart").value;
        var AgeEnd     = document.getElementById("AgeEnd").value;
        var selectpaid = document.getElementById("selectpaid").value;
        
        if( AgeStart == '' || AgeEnd == '' || selectpaid == '' ){
            alert('Please enter data');
        }else if( parseInt(AgeStart) > parseInt(AgeEnd) ){
            alert('please enter the correct age');
        }else{
            window.open("https://www.tutorkami.com/fadhli/one-time/tutor-umur.php?AgeStart="+ AgeStart +"&AgeEnd="+ AgeEnd +"&selectpaid="+ selectpaid, "_blank");
        }	
    }
</script>