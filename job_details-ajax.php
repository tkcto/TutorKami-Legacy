<?PHP
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$conn = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($conn->connect_error) {
    die("connection failed : " . $conn->connect_error);
} else {
    // echo "Successfully Connected";
}

date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();

$user_id = $_SESSION['auth']['user_id'];

echo $user_id;
?>

<!--

          <div class="table-responsive">  
                <input type="hidden" id="hdnListCount" value="1"/>  
                <input type="hidden" name="tutor" id="tutor" value="<?php echo $user_id;?>"/> 
                <input type="hidden" name="tutorRate"  id="tutor_input"  value="">
                <input type="hidden" name="alvl" value="<?php echo $user_id;?>">
                <input type="hidden" name="ajobid" value="<?php echo $user_id;?>">

                <table class="table" id="dynamic_field" >  
                    <tr>  
                        <td>
                            <select name="day[]" class="form-control name_list" required="">
                                <option value="Mon">Mon</option>
                                <option value="Tues">Tues</option>
                                <option value="Wed">Wed</option>
                                <option value="Thur">Thur</option>
                                <option value="Fri">Fri</option>
                                <option value="Sat">Sat</option>
                                <option value="Sun">Sun</option>
                            </select>
                        </td>  
                        <td><input type="text" name="name[]" placeholder="" class="form-control name_list" required="" /></td>  
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                    </tr>  
                </table>  
                <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
              

                
            </div>
            
            
            
            
   <script type="text/javascript">  
   $(document).ready(function(){   
       
       
      $('#add').click(function(){  
           i++;  
           if((document.getElementById('hdnListCount').value) <= '6' ){
               
                var aaa = document.getElementById('hdnListCount').value;
                document.getElementById('hdnListCount').value =  parseInt(aaa) + 1;
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">     <td><select name="day[]" class="form-control name_list" required ><option value="Mon">Mon</option><option value="Tues">Tues</option><option value="Wed">Wed</option><option value="Thur">Thur</option><option value="Fri">Fri</option><option value="Sat">Sat</option><option value="Sun">Sun</option></select></td>        <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" required /></td>      <td><a style="color:red;font-size:30px;text-decoration: none;" name="remove" id="'+i+'" class="fa fa-trash-o btn_remove"></a></td>       </tr>');  
           } else {  
                alert('You can add 7 record only!');  
           }
      });
       

    });
   </script>  
            
-->
            
            
            
            
            