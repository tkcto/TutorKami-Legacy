<?php
require 'db_connection.php';

if(!isset($_SESSION['login_id'])){
    header('Location: login.php');
    exit;
}

$id = $_SESSION['login_id'];

$get_user = mysqli_query($db_connection, "SELECT * FROM `users_google` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
}
else{
    header('Location: logout.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $user['name']; ?></title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7ff;
            padding: 10px;
            margin: 0;
        }
        ._container{
            max-width: 400px;
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border: 1px solid #cccccc;
            border-radius: 2px;
        }

        ._img{
            overflow: hidden;
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        ._img > img{
            width: 100px;
            min-height: 100px;
        }
        ._info{
            text-align: center;
        }
        ._info h1{
            margin:10px 0;
            text-transform: capitalize;
        }
        ._info p{
            color: #555555;
        }
        ._info a{
            display: inline-block;
            background-color: #E53E3E;
            color: #fff;
            text-decoration: none;
            padding:5px 10px;
            border-radius: 2px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="_container">
        <div class="_img">
            <img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>">
        </div>
        <div class="_info">
            <h1><?php echo $user['name']; ?></h1>
            <p><?php echo $user['email']; ?></p>
        </div>
        
        
        
  <div class="form-horizontal" >
    <div class="form-group">
      <label class="control-label col-sm-2" for="phone">Phone</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="012 345 6789" data-inputmask="'alias': 'phonebe'">
        <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" >
        <input type="hidden" class="form-control" id="profile_image" name="profile_image" value="<?php echo $user['profile_image']; ?>" >
      </div>
    </div>


    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-success" onclick="Submit()">Submit</button>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
        
        
        
        
        
        
    </div>
    
    
    
<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
    
    
    
</body>
</html>


<script>
function Submit() {
  var phone = document.getElementById("phone").value.split(" ").join(""); 
  var email = document.getElementById("email").value; 
  var image = document.getElementById("profile_image").value; 
  
  if( phone != '' && email != '' && image != ''){
      if(phone.length == '10'){
          /*alert(phone + ' ' + email + ' ' + image);*/
          
            $.ajax({
                type: "POST",
                url: 'check-phone-no.php',
                data: {phone: phone, email: email, image: image},
                success: function(data){
                    if( data == 'Success'){
                        window.location = "https://www.tutorkami.com";
                    }else{
                        alert(data);
                    }
                }
            });
            
          
      }else{
          alert('Phone Number Not Valid !');
      }
  }else{
      alert('Please Insert Phone Number !');
  }
  
}


$(document).ready(function(){
$(":input").inputmask();



$("#phone").inputmask({
mask: '999 999 9999',
placeholder: ' ',
showMaskOnHover: false,
showMaskOnFocus: false,
onBeforePaste: function (pastedValue, opts) {
var processedValue = pastedValue;

//do something with it

return processedValue;
}
});
});
</script>
