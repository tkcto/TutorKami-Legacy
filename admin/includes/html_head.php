<meta charset="utf-8">

<!-- luqman comment sbb admin xnak mobile responsive -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

<meta http-equiv="X-UA-Compatible" content="IE=edge">



<link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-icon-57x57.png">

<link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-icon-60x60.png">

<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-icon-72x72.png">

<link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-icon-76x76.png">

<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-icon-114x114.png">

<link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-icon-120x120.png">

<link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-icon-144x144.png">

<link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-icon-152x152.png">

<link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192"  href="img/favicons/android-icon-192x192.png">

<link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">

<link rel="icon" type="image/png" sizes="96x96" href="img/favicons/favicon-96x96.png">

<link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
<!-- add icon link -->
<link rel="icon" href="https://www.tutorkami.com/admin/img/favicons/apple-icon-180x180.png" type="image/x-icon"> 



<title><?php echo $title;?></title>



<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/font-awesome.css" rel="stylesheet">



<!-- Toastr style -->

<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">



<!-- Gritter -->

<link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">



<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<link href="css/plugins/iCheck/custom.css" rel="stylesheet">

<link href="css/animate.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

<link href="css/admin-custom.css" rel="stylesheet">



<script src="js/jquery-2.1.1.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>



<!-- Custom and plugin javascript -->

<script src="js/theme.js"></script>

<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- jQuery UI

<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script> -->

<script src="js/plugins/iCheck/icheck.min.js"></script>

<!-- luqman zoom -->
<!-- <style>

* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  margin: auto;
    display: block;
    width: 80%;
    max-width: 300px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style> -->
<link rel="stylesheet" href="css/lightbox.min.css">

<!-- luqman zoom -->

<script>

	$(document).ready(function(){

	    $('#data_2 .input-group.date').datepicker({

	        startView: 2,

	        todayBtn: "linked",

	        keyboardNavigation: false,

	        forceParse: false,

	        autoclose: true,

	        format: "yyyy-mm-dd"

	    });



	    $('.i-checks').iCheck({

            checkboxClass: 'icheckbox_square-green',

            radioClass: 'iradio_square-green',

        });



        $('#ud_country').on('change', function(){

        	var CountryId = $(this).val();

        	$.ajax({

				url: "ajax/ajax_call.php",

				method: "POST",

				data: {action: 'get_state', country_id: CountryId}, 

				success: function(result){

					$('#ud_state').html(result);

				}

	       	});

        });



        $('#ud_state').change(function(){

			var StateId = $(this).val();
			//var getTisURL = window.location.href;
			var getTisURL = window.location.href.split('?')[0];
			
			if( getTisURL == 'https://www.tutorkami.com/admin/add-new-user' ){
			    //alert(getTisURL);
			}else if( getTisURL == 'https://www.tutorkami.com/admin/manage_user' ){
    			$.ajax({
    
    				url: "ajax/ajax_call.php",
    
    				method: "POST",
    
    				data: {action: 'get_city', state_id: StateId}, 
    
    				success: function(result){
    
    					$('#ud_city').html(result);
    
    				}
    
    			});	
			}else{
    			$.ajax({
    
    				url: "ajax/ajax_call.php",
    
    				method: "POST",
    
    				data: {action: 'get_city', state_id: StateId}, 
    
    				success: function(result){
    
    					$('#ud_city').html(result);
    
    				}
    
    			});			    
			}
		});



        $('#search_ud_state').change(function(){

			var StateId = $(this).val();

			$.ajax({

				url: "ajax/ajax_call.php",

				method: "POST",

				data: {action: 'get_city', state_id: StateId}, 

				success: function(result){

					$('#search_ud_city').html(result);

				}

			});

		});
		

        $('#ud_workplace_state').change(function(){

			var StateId = $(this).val();

			$.ajax({

				url: "ajax/ajax_call.php",

				method: "POST",

				data: {action: 'get_city', state_id: StateId}, 

				success: function(result){

					$('#ud_workplace_city').html(result);

				}

			});

		});
		
		
		
		
	});

</script>

<?PHP 
    require_once('reminder-finance.php');
?>