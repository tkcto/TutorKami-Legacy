<?php
require 'fadhli/google/login-with-gmail/db_connection.php';

if(!isset($_SESSION['login_id'])){
    header('Location: https://www.tutorkami.com/client_login');
    exit;
}

$id = $_SESSION['login_id'];

$get_user = mysqli_query($db_connection, "SELECT * FROM `users_google` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
}
else{
    /*header('Location: logout.php');
    exit;*/
    session_start();
    
    $_SESSION = array();
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
    header('Location: https://www.tutorkami.com/client_login');
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
      <label class="control-label col-sm-12"><center>For verification, please enter the phone number that you use to contact us</center></label>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g. 0123456789" data-inputmask="'alias': 'phonebe'">
        <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" >
        <input type="hidden" class="form-control" id="profile_image" name="profile_image" value="<?php echo $user['profile_image']; ?>" >
      </div>
    </div>


    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-success" onclick="Submit()">Submit</button>
        <a href="gmail-logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
        
        
        
        
        
        
    </div>
    
    
    <!--
<div class="container">
  <h2>Modal Example</h2>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>


  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    

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
  
</div>-->
    
    
    
</body>
</html>


<script>
function Submit() {
  //var phone = document.getElementById("phone").value.split(" ").join(""); 
  var phone = document.getElementById("phone").value; 
  var email = document.getElementById("email").value; 
  var image = document.getElementById("profile_image").value; 
  
  var numbers = /^[0-9]+$/;
  
  if( phone != '' && email != '' && image != ''){
      //if(phone.length == '11' ){
      //if(phone.value.match(numbers)){
      if(phone.match(numbers)){
          /*alert(phone + ' ' + email + ' ' + image);*/
          
            $.ajax({
                type: "POST",
                url: 'gmail-check-phone-no.php',
                data: {phone: phone, email: email, image: image},
                success: function(data){
                    /*if( data == 'Success'){
                        //window.location = "https://www.tutorkami.com";
                        alert(data);
                    }else{
                        alert(data);
                    }*/
                    if (data.indexOf("Success") >= 0){
                        var parts = data.split('- ', 2);
                        var goTo  = parts[1];
                        window.location = goTo;
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

/*
$(document).ready(function(){
$(":input").inputmask();



$("#phone").inputmask({
mask: '9999999999',
placeholder: ' ',
showMaskOnHover: false,
showMaskOnFocus: false,
onBeforePaste: function (pastedValue, opts) {
var processedValue = pastedValue;

//do something with it

return processedValue;
}
});
});*/
</script>
