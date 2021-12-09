<div class="media">
   <?php include('review_left_panel.php');?>
   <div class="media-body media_edit private">
      <form action="" method="post">
         <input type="hidden" name="currentstep" value="3">
         <input type="hidden" name="nextstep" value="">
         <h3 class="media-heading org-txt"><?php echo REVIEW_STEP3_TITLE; ?></h3>
         <p class="martop"><?php echo REVIEW_STEP3_DESCRIPTION; ?></p>
         <h4 class="black martop"><?php echo REVIEW_STEP3_QUESTION; ?></h4>
		 
         <!--<textarea id="congratulation-text" name="share_about_tutor"></textarea>
         <div id="count" class="text-right"><?php //echo WORDS_LEFT; ?></div>-->
		 
         <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
         <textarea id="congratulation-text" name="share_about_tutor"  ></textarea>
         <div id="count" class="text-right"><?php echo WORDS_LEFT; ?></div>-->
		 
<textarea id="word_count" name="share_about_tutor" ></textarea>
<div id="word_left" class="text-right"><?php echo WORDS_LEFT; ?></div>
		 
		 
         <h4 class="black"><?php echo REVIEW_STEP3_QUESTION2; ?></h4>
         <textarea id="congratulation-text2" name="tutor_improve"></textarea>
         <button type="submit" class="btn-lg btn-warning text-center rate-your"><?php echo BUTTON_SUBMIT; ?></button>
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
var text_max = 100;
$('#congratulation-text').keyup(function() {
	
	s = document.getElementById("congratulation-text").value;
	s = s.replace(/(^\s*)|(\s*$)/gi,"");
	s = s.replace(/[ ]{2,}/gi," ");
	s = s.replace(/\n /,"\n");
	var text_remaining = text_max - (s.split(' ').length);
	
	$('#count').html(text_remaining + WORDS_LEFT);
	
	
});




});*/
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