<?PHP
    $todayDateFi = date('d/m/Y');
    $chgDateFi = explode('/', $todayDateFi); 
    $monthDateFi = $chgDateFi[1];
    $yearDateFi  = $chgDateFi[2];
    $previousMonth = $monthDateFi.'/'.$yearDateFi;

    $dataFiPop = '';
    $ReminderFinance = " SELECT * FROM tk_new_jobs_popup WHERE pop_date LIKE '%$previousMonth%' ";
    $resultReminderFinance = $conDB->query($ReminderFinance);
    if ($resultReminderFinance->num_rows > 0) {
        $rowReminderFinance = $resultReminderFinance->fetch_assoc();
        $dataFiPop = 'ada';
    }
    
    if( isset($_SESSION['tk']['u_id']) && $_SESSION['tk']['u_id'] == 3){
    
    /*
        echo '<script language="javascript">
        $(document).ready(function() {
             document.getElementById("idReminderFinance").click();
        } );
        </script>';
    */
    /*    
        setTimeout(function(){
           window.location.reload(1);
        }, 5000);
    
        echo '<script language="javascript">
            setInterval(function(){
                
            },5000);
        </script>';
    */
        echo '<button id="idReminderFinance" type="button" class="btn btn-primary hidden" data-toggle="modal" data-target="#exampleModalReminderFinance"></button>';
    }
?>
<!-- Modal -->
<input type="hidden" name="reminderFinance" id="reminderFinance" value="<?PHP echo $_SESSION['tk']['u_id']; ?>">
<input type="hidden" name="dataFiPop"       id="dataFiPop"      value="<?PHP echo $dataFiPop; ?>">
<div class="modal fade" id="exampleModalReminderFinance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
          <center>
            <br/><p><label> Please insert the ‘NJ’ text manually in Sales File, for all new jobs with no RF, last by 11:59 pm tomorrow. </label><p>
            
            <input type="checkbox" id="DoNotShow" name="DoNotShow" value="DoNotShow"> <label for="DoNotShow"> Do not show this message anymore</label><br><br>
            
            
            <button onClick="buttonOkay()" type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
        </center>
      </div>


    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    var reminderFinance = document.getElementById("reminderFinance").value;
    var dataFiPop       = document.getElementById("dataFiPop").value;
    
    var dateObj = new Date();
    var day = dateObj.getUTCDate();
    
    var hour = dateObj.getHours(); // => 9
    var Mint = dateObj.getMinutes(); // =>  30

    if( reminderFinance == '3' ){
        setInterval(function(){
            if( day == '01' || day == '1' ){ // hari pertama
                if( hour == '12' && dataFiPop == '' ){ // pukul 12 tgh hari
                    document.getElementById("idReminderFinance").click();
                }
            }
        //},1000 * 60 * 5); // setiap 5 mint
        },30000);
    }
    
} );

function buttonOkay() {
    var DoNotShow = document.getElementById("DoNotShow").checked;
    if( DoNotShow == true ){
        $.ajax({
            url: "ajax/allinone.php",
            method: "POST",
            data: {action: 'financePopUp', DoNotShow: DoNotShow}, 
            success: function(result){
                document.getElementById("idReminderFinance").disabled = true; 
            }
        }); 
    }
}
</script>