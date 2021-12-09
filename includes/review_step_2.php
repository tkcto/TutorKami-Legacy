<div class="media">
   <?php include('review_left_panel.php');?>
   <div class="media-body media_edit">
      <form action="" method="post">
         <input type="hidden" name="currentstep" value="2">
         <input type="hidden" name="nextstep" value="3">
         <h4 class="media-heading org-txt"><?php echo REVIEW_STEP2_QUESTION; ?> <small><?php echo REQUIRED; ?></small></h4>
         <p class="martop"><?php echo REVIEW_STEP2_DESCRIPTION; 
$getLan = dirname($_SERVER['REQUEST_URI'])."/"; 
if($getLan == "/my/"){	
	echo ' '.$getUserDetails->data[0]->u_displayname;
}else{
	echo ' '.$getUserDetails->data[0]->u_displayname;
	echo '’s profile.';
}
         ?></p>
         <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
         <textarea id="congratulation-text" placeholder="<?php echo REVIEW_STEP2_PLACEHOLDER; ?>" name="review" required="" maxlength="100" ></textarea>
         <div id="count" class="text-right"><?php echo WORDS_LEFT; ?></div>-->
		 
<textarea id="word_count" placeholder="<?php echo REVIEW_STEP2_PLACEHOLDER; ?>" name="review" required=""></textarea>
<div id="word_left" class="text-right"><?php echo WORDS_LEFT; ?></div>

		 
		 
         <button type="submit" class="btn-lg btn-warning text-center rate-your"><?php echo BUTTON_NEXT; ?></button>
      </form>
   </div>
</div>
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


</script>