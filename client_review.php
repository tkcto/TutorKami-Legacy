<?PHP
$thisURL = $_SERVER['QUERY_STRING'];
$parts = explode("/", $thisURL);
$xxx = $parts[1];

require_once('includes/head.php'); 
require_once('mobile-detect/mobile-detect.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$tutorID = '';
$parentID = '';
$qJob = " SELECT j_id, j_hired_tutor_email, u_id FROM tk_job WHERE j_id ='".$xxx."' "; 
$resJob = $conn->query($qJob); 
if($resJob->num_rows > 0){ 
    $roJob = $resJob->fetch_assoc();
    $parentID = $roJob['u_id'];
    
    $qTutor = " SELECT * FROM tk_user INNER JOIN tk_user_details on ud_u_id = u_id WHERE u_email ='".$roJob['j_hired_tutor_email']."' "; 
    $resTutor = $conn->query($qTutor); 
    if($resTutor->num_rows > 0){ 
        $roTutor = $resTutor->fetch_assoc();
        $tutorID =  $roTutor['u_id'];
    }
/*
    echo $tutorID;
    echo '<br>';
    echo $parentID;
*/
}

if ( $tutorID != '' ) {

  $_SESSION['rating']['tutor_id'] = $tutorID;

}

if ( $parentID != '' ) {

  $_SESSION['rating']['parent_id'] = $parentID;

}

if ( $xxx != '' ) {

  $_SESSION['rating']['job_id'] = $xxx;

}



if (count($_POST) > 0) {

  if(isset($_POST['currentstep']) && $_POST['currentstep'] != '') {

    $_SESSION['rating'][$_POST['currentstep']] = $_POST;

  }



  if (isset($_POST['nextstep']) && $_POST['nextstep'] != '') {    

    header('Location: client_review.php?step='.$_POST['nextstep']);

    exit();

  } else{

    $output = system::FireCurl(REVIEW_TUTOR_URL, "POST", "JSON", $_SESSION['rating']);

    unset($_SESSION['rating']);

    header('Location: client_review.php?step=4');

    exit();

  }

}

if (isset($_SESSION['rating']['tutor_id'])) {

  $getUserDetails = system::FireCurl(USER_LISTING_URL.'?user_id='.$_SESSION['rating']['tutor_id']);

}  

$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
$getLan = substr($getLan, 0, strpos($getLan, "client_review?"));
include('includes/header.php');

if($getLan == "/my/"){	
    $RATE_REVIEW = 'Penilaian dan Ulasan';
    $REVIEW_STEP1_TITLE = 'Nyatakan penilaian dan ulasan anda tentang';
    $TEXT_CLASS = '';
    $ID_NO = 'No ID';
    $REVIEW_STEP1_DESCRIPTION = 'Ulasan dan penilaian anda adalah sangat bermakna buat kami di TutorKami. Oleh itu, kami amat hargai jika anda dapat meluangkan sedikit masa untuk berkongsi pendapat serta komen anda tentang tutor ini.';
    $REVIEW_STEP1_QUESTION = 'Bagaimana penilaian keseluruhan anda terhadap tutor ini (1 ke 5 bintang)?';
    $REQUIRED = '(diperlukan)';
    $REVIEW_STEP2_QUESTION = 'Kongsi Ulasan anda tentang tutor ini';
    $REVIEW_STEP2_DESCRIPTION = 'Kongsikan dengan kami pengalaman anda atau pelajar sepanjang menggunakan khidmat tutor ini. Ulasan anda bersifat umum dan akan dipaparkan di profil';
    $REVIEW_STEP2_PLACEHOLDER = 'Adakah cikgu ini memenuhi kehendak pelajar? Bagaimanakah sikap pengajar ini? Jika ada keperluan, adakah anda akan menggunakan khidmat tutor ini lagi di masa hadapan?';
    $WORDS_LEFT = '100 patah perkataan';
    $REVIEW_STEP3_TITLE = 'Maklumbalas Tertutup';
    $REVIEW_STEP3_DESCRIPTION = 'Kongsikan maklumbalas tertutup anda tentang tutor ini dan syarikat TutorKami. Ulasan anda disini adalah bersifat tertutup dan tidak akan dipaparkan kepada tutor ini, ataupun kepada umum.';
    $REVIEW_STEP3_QUESTION = 'Apakah yang anda ingin kongsikan kepada kami tentang tutor ini? Apa yang tutor ini boleh perbaiki?';
    $REVIEW_STEP3_QUESTION2 = 'Apakah komen anda tentang syarikat/staf TutorKami.com? Apa yang kami boleh perbaiki?';
}else{
    $RATE_REVIEW = 'Rate & Review';
    $REVIEW_STEP1_TITLE = 'Write a review for';
    $TEXT_CLASS = 'class';
    $ID_NO = 'ID No';
    $REVIEW_STEP1_DESCRIPTION = 'Reviews are an important part of us and the tutors at Tutorkami. Please take a moment to provide us with some helpful feedback - it&#039;ll take just a few minutes.';
    $REVIEW_STEP1_QUESTION = 'How was your overall experience engaging a class with this tutor? (1 to 5 star)';
    $REQUIRED = '(required)';
    $REVIEW_STEP2_QUESTION = 'Describe your Experience';
    $REVIEW_STEP2_DESCRIPTION = 'Share with us your experience throughout your engagement with this tutor. Your review here will be public and appear on';
    $REVIEW_STEP2_PLACEHOLDER = 'Did your tutor fulfill the class requirement? How is her/his attitude? Will you consider to hire he/she again?';
    $WORDS_LEFT = '100 words left';
    $REVIEW_STEP3_TITLE = 'Private Feedback';
    $REVIEW_STEP3_DESCRIPTION = 'Please share your private feedback about your tutor, and TutorKami. Your review here is just for the use of Tutorkami, and will not be shown to your tutor or to the public.';
    $REVIEW_STEP3_QUESTION = 'What would you like to share with us about this tutor? In what ways tutor can improve?';
    $REVIEW_STEP3_QUESTION2 = 'Share with us your comments and feedback about the staffs and service of TutorKami.com. In what ways can we improve?';
}

if ($tablet_browser > 0) {
   //print 'is tablet';
   require_once('client_review-mobile.php');
}
else if ($mobile_browser > 0) {
   //print 'is mobile';
   require_once('client_review-mobile.php');
}
else {
   //print 'is desktop';
   require_once('client_review-none-mobile.php');
}   

?>

<?php include('includes/footer.php');?>

<script>
var url = window.location.pathname;
if(url == '/my/client_review'){
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
                if(path == 'my/client_review'){
                    window.location = "https://www.tutorkami.com/my/client_review?step=4"; 
                }else{
                    window.location = "https://www.tutorkami.com/client_review?step=4"; 
                }
            }else if(result =='existing'){
                if(path == 'my/client_review'){
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