<?php 

require_once('includes/head.php');
require_once('mobile-detect/mobile-detect.php');


if (isset($_GET['tutor_id']) && $_GET['tutor_id'] > 0) {

  $_SESSION['rating']['tutor_id'] = $_GET['tutor_id'];

}

if (isset($_GET['parent_id']) && $_GET['parent_id'] > 0) {

  $_SESSION['rating']['parent_id'] = $_GET['parent_id'];

}

if (isset($_GET['job_id']) && $_GET['job_id'] > 0) {

  $_SESSION['rating']['job_id'] = $_GET['job_id'];

}



if (count($_POST) > 0) {

  if(isset($_POST['currentstep']) && $_POST['currentstep'] != '') {

    $_SESSION['rating'][$_POST['currentstep']] = $_POST;

  }



  if (isset($_POST['nextstep']) && $_POST['nextstep'] != '') {    

    header('Location: parent_review.php?step='.$_POST['nextstep']);

    exit();

  } else{

    $output = system::FireCurl(REVIEW_TUTOR_URL, "POST", "JSON", $_SESSION['rating']);

    // Session::SetFlushMsg($output->flag, $output->message);

    unset($_SESSION['rating']);

    header('Location: parent_review.php?step=4');

    exit();

  }

}

if (isset($_SESSION['rating']['tutor_id'])) {

  $getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$_SESSION['rating']['tutor_id']);

}  

$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 

include('includes/header.php');

?>

<?php
if ($tablet_browser > 0) {
   //print 'is tablet';
   require_once('rate-mobile.php');
}
else if ($mobile_browser > 0) {
   //print 'is mobile';
   require_once('rate-mobile.php');
}
else {
   //print 'is desktop';
   require_once('rate-none-mobile.php');
}   
?>

<?php include('includes/footer.php');?>

<script>
var url = window.location.pathname;
if(url == '/my/parent_review'){
	var WORDS_LEFT = ' patah perkataan';
}else{
	var WORDS_LEFT = ' words left';
}
/*
$(document).ready(function() {
//
var text_max = 100;
$('#count').html(text_max + WORDS_LEFT);

$('#congratulation-text').keyup(function() {
    var text_length = $('#congratulation-text').val().length;
    var text_remaining = text_max - text_length;

    $('#count').html(text_remaining + WORDS_LEFT);
});
//
var text_max = 100;
$('#congratulation-text').keyup(function() {
	
	s = document.getElementById("congratulation-text").value;
	s = s.replace(/(^\s*)|(\s*$)/gi,"");
	s = s.replace(/[ ]{2,}/gi," ");
	s = s.replace(/\n /,"\n");
	var text_remaining = text_max - (s.split(' ').length);
	
	$('#count').html(text_remaining + WORDS_LEFT);
	
	
});




});
*/


$(document).ready(function() {
    $("#word_count").on('keyup', function() {
        var words = this.value.match(/\S+/g).length;
        if (words > 100) {
            // Split the string on first 200 words and rejoin on spaces
            var trimmed = $(this).val().split(/\s+/, 100).join(" ");
            // Add a space at the end to keep new typing making new words
            $(this).val(trimmed + " ");
        }
        else {
            $('#display_count').text(words);
            $('#word_left').text((100-words) + WORDS_LEFT);
        }
    });
 }); 






$(document).ready(function() {
    $("#word_count2").on('keyup', function() {
        var words = this.value.match(/\S+/g).length;
        if (words > 100) {
            // Split the string on first 200 words and rejoin on spaces
            var trimmed = $(this).val().split(/\s+/, 100).join(" ");
            // Add a space at the end to keep new typing making new words
            $(this).val(trimmed + " ");
        }
        else {
            $('#display_count').text(words);
            $('#word_left2').text((100-words) + WORDS_LEFT);
        }
    });
 }); 


$(document).ready(function () {
       $('.radio').click(function () {
           //document.getElementById('test').innerHTML = $(this).val();
           document.getElementById('ratefield').value = $(this).val();
       });

   });
   

function Finish() {
    var tutorID = document.getElementsByName("tutorID")[0].value;
    var parentID = document.getElementsByName("parentID")[0].value;
    var jobID    = document.getElementsByName("jobID")[0].value;
 
    var rating = document.getElementsByName("ratefield")[0].value;
    var review = document.getElementsByName("review")[0].value;
    var share_about_tutor = document.getElementsByName("share_about_tutor")[0].value;
    var tutor_improve = document.getElementsByName("tutor_improve")[0].value;
    var path = location.pathname.substring(1);
    
    
            var submitBtn = document.getElementById( 'submitBtn' );
            submitBtn.classList.add('hidden'); // Add class
            var submitBtnLoad = document.getElementById( 'submitBtnLoad' );
            submitBtnLoad.classList.remove('hidden'); // Remove class  

    $.ajax({
        type:'POST',
        url:'ajax-rate.php',
        data:{tutorID: tutorID, parentID: parentID, rating: rating, review: review, share_about_tutor: share_about_tutor, tutor_improve: tutor_improve, jobID: jobID},
        beforeSend: function() {
        },
        success:function(result){
            if(result =='success'){
                if(path == 'my/parent_review'){
                    window.location = "https://www.tutorkami.com/my/parent_review?step=4"; 
                }else{
                    window.location = "https://www.tutorkami.com/parent_review?step=4"; 
                }
            }else if(result =='existing'){
                if(path == 'my/parent_review'){
                    alert('Maklumbalas anda telah pun kami terima sebelum ini');
                }else{
                    alert('Your feedback have already submitted previously');
                }
                var submitBtn = document.getElementById( 'submitBtn' );
                submitBtn.classList.remove('hidden'); 
                var submitBtnLoad = document.getElementById( 'submitBtnLoad' );
                submitBtnLoad.classList.add('hidden'); 
            }else if(result =='x success'){
                alert('Error..');
                var submitBtn = document.getElementById( 'submitBtn' );
                submitBtn.classList.remove('hidden'); 
                var submitBtnLoad = document.getElementById( 'submitBtnLoad' );
                submitBtnLoad.classList.add('hidden'); 
            }else{
                alert('Error');
                var submitBtn = document.getElementById( 'submitBtn' );
                submitBtn.classList.remove('hidden'); 
                var submitBtnLoad = document.getElementById( 'submitBtnLoad' );
                submitBtnLoad.classList.add('hidden'); 
            }
        }
    });
   
    //alert(' tutorID : ' + tutorID + ' parentID : ' + parentID + ' rating : ' + rating + ' review : ' + review + ' share_about_tutor : ' + share_about_tutor + ' tutor_improve : ' + tutor_improve);
}


</script>