<div class="footer">
    <?PHP //echo substr(trim(basename($_SERVER['PHP_SELF'])),0,-4); ?>
   <div>
   
  <!--<div class="col-xs-2">
    <input class="form-control" disabled id="refreshTimer" type="text">
  </div>-->
      <!--<input type="text" class="form-control" id="refreshTimer" disabled placeholder="???">
	  <input type="text" class="form-control" id="refreshTimer2" disabled placeholder="???">-->
      <strong>Copyright</strong> <a href="https://www.tutorkami.com/" target="_blank">tutorkami</a> © 2017 <span id="storeSession"></span>
   </div>
   
</div>
<script src="/js/flush.js"></script>
<!-- <link href="/css/zoom.css" rel="stylesheet">
<script src="/js/zoom.js"></script>
<script src="/js/transition.js"></script> -->
<!-- luqman zoom -->
<script src="js/lightbox.min.js"></script>
<!-- luqman zoom -->






<script>















// Refresh Rate is how often you want to refresh the page 
// bassed off the user inactivity. 
var refresh_rate = 1800; //<-- In seconds, change to your needs 1800
var last_user_action = 0;
var has_focus = false;
var lost_focus_count = 0;
// If the user loses focus on the browser to many times 
// we want to refresh anyway even if they are typing. 
// This is so we don't get the browser locked into 
// a state where the refresh never happens.    
var focus_margin = 10;

// Reset the Timer on users last action
function reset() {
  last_user_action = 0;
  updateVisualTimer('Reset Timer');
}

function updateVisualTimer(value) {
  var element = document.getElementById('refreshTimer');
  if (value) {
    element.value = value
  } else if (has_focus) {
    element.value = 'User has focuse won\'t refresh'
  } else if (last_user_action >= refresh_rate) {
    element.value = 'Refreshing';
  } else {
    element.value = (refresh_rate - last_user_action);
  }
}

function windowHasFocus() {
  has_focus = true;
}

function windowLostFocus() {
  var element2 = document.getElementById('refreshTimer2');
  has_focus = false;
  lost_focus_count++;
  //console.log(lost_focus_count + " <~ Lost Focus");
  element2.value = (lost_focus_count + " <~ Lost Focus");
}

// Count Down that executes ever second

setInterval(function() {
  last_user_action++;
  refreshCheck();
  updateVisualTimer();
}, 1000);

// The code that checks if the window needs to reload
function refreshCheck() {
  var focus = window.onfocus;
  if ((last_user_action >= refresh_rate && !has_focus && document.readyState == "complete") || lost_focus_count > focus_margin) {
    //window.location.reload(); // If this is called no reset is needed
    //reset(); // We want to reset just to make sure the location reload is not called.

            //window.open("https://www.tutorkami.com/admin/manage_user", "_blank"); 
            
              //window.open("https://www.tutorkami.com/admin/dashboard", "stack_unique_123");
              //reset();

/*var win = window.open("https://www.tutorkami.com/admin/dashboard", "tutorkami_unique_123");
win.location.reload();
reset();*/
        
    /*if(localStorage.getItem("reloaded") !== "true") {
            //localStorage.setItem("reloaded","true");
            //location.reload(true);
        
      
    }
    localStorage.setItem("reloaded","false");
    reset();*/


  }

}/*
window.addEventListener("focus", windowHasFocus, false);
window.addEventListener("blur", windowLostFocus, false);
window.addEventListener("click", reset, false);
window.addEventListener("mousemove", reset, false);
window.addEventListener("keypress", reset, false);
window.addEventListener("scroll", reset, false);
document.addEventListener("touchMove", reset, false);
document.addEventListener("touchEnd", reset, false);
*/



/*
function idleTimer() {
    var t;
    //window.onload = resetTimer;
    window.onmousemove = resetTimer; // catches mouse movements
    window.onmousedown = resetTimer; // catches mouse movements
    window.onclick = resetTimer;     // catches mouse clicks
    window.onscroll = resetTimer;    // catches scrolling
    window.onkeypress = resetTimer;  //catches keyboard actions

    function logout() {
        window.location.href = '/action/logout';  //Adapt to actual logout script
    }

   function reload() {
          window.location = self.location.href;  //Reloads the current page
   }

   function resetTimer() {
        clearTimeout(t);
        //t = setTimeout(logout, 1800000);  // time is in milliseconds (1000 is 1 second)
        //t= setTimeout(reload, 300000);  // time is in milliseconds (1000 is 1 second)
		t= setTimeout(reload, 5000); 
    }
}
idleTimer();*/
/*
        setInterval(function() {
            var div = document.querySelector("#counter");
            var count = div.textContent * 1 - 1;
            div.textContent = count;
            if (count <= 0) {
                //window.location = self.location.href; 
            }
        }, 1000);*/
		/*
$(window).on("blur focus", function(e) {
    var prevType = $(this).data("prevType");
    var element = document.getElementById('refreshTimer');

    if (prevType != e.type) {   //  reduce double fire issues
        switch (e.type) {
            case "blur":
                //$('counter').text("Blured");
                element.value = ("Blured");
                break;
            case "focus":
                //$('counter').text("Focused");
                element.value = ("Focused");
                break;
        }
    }

    $(this).data("prevType", e.type);
})
*/















function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

<script>
/*
//generate a random ID, doesn't really matter how    
if(!sessionStorage.tab) {
    var max = 99999999;
    var min = 10000000;
    sessionStorage.tab = Math.floor(Math.random() * (max - min + 1) + min);
}

//set tab_id cookie before leaving page
window.addEventListener('beforeunload', function() {
    document.cookie = 'tab_id=' + sessionStorage.tab;
                    

});
document.getElementById('storeSession').innerHTML = sessionStorage.tab;*/
/*
window.onbeforeunload = function () {
    localStorage.removeItem(sessionStorage.tab);
}
//alert(window.location.href);*/
</script>

<div id="toast-container" class="toast-top-right" aria-live="polite" role="alert">
   <?php 
   if( isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != '' ) {
      $flash = Session::ReadFlushMsg();?>
   <div id="sticky-container" class="toast toast-<?php echo $flash['msg_type']; ?>" style="">
      <div id="alert_progress_bar" class="toast-progress" style="width: 100%;"></div>
      <button type="button" class="toast-close-button" role="button">×</button>
      <script>hideErrDiv('sticky-container', 'alert_progress_bar');</script>
      <div class="toast-message"><?php echo $flash['msg_text'];?></div>
   </div>
   <?php } ?>
</div>

<script>/*
$(document).ready(function(){

    setInterval(function(){
    	var val = 'arr'; 
    	$.ajax({
    		url: "../load-header.php",
    		method: "POST",
    		data: {val: val}, 
    		success: function(result){
    			document.getElementById('waValue').innerHTML = result;
    		}
    	});    
    }, 10000);
    
   
}); */
</script>
<!--<script src="https://www.tutorkami.com/admin/noti-wa.js"></script> -->