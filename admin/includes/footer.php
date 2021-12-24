<div class="footer">
    <div class="col-xs-2">
        <input class="form-control" disabled id="refreshTimer" type="text">
    </div>

    <div>
        <strong>Copyright</strong> <a href="https://www.tutorkami.com/" target="_blank">tutorkami</a> © 2017 <span id="storeSession"></span>
    </div>
</div>

<script src="/js/flush.js"></script>
<script src="js/lightbox.min.js"></script>

<script>
    // Refresh Rate is how often you want to refresh the page
    // bassed off the user inactivity.
    let timer = null;
    let has_focus = false;
    let refresh_rate = 1800;
    let last_user_action = 0;
    let lost_focus_count = 0;
    let isTimerPaused = false;

    // If the user loses focus on the browser to many times
    // we want to refresh anyway even if they are typing.
    // This is so we don't get the browser locked into
    // a state where the refresh never happens.
    let focus_margin = 20;

    // Reset the Timer on users last action
    function reset() {
        if (!has_focus) {
            last_user_action = 0;
            updateVisualTimer('Timer reset');

            isTimerPaused = true;

            setTimeout(function () {
                isTimerPaused = false;
            }, 2000);
        }
    }

    function windowHasFocus() {
        isTimerPaused = false;
        last_user_action = 0;
        has_focus = true;

        /* Update immediately to update the indicator straight after user has focus*/
        updateVisualTimer();
    }

    function windowLostFocus() {
        has_focus = false;
        lost_focus_count++;
    }

    function updateVisualTimer(value) {
        let element = document.getElementById('refreshTimer');

        if (isTimerPaused) return;

        if (value) {
            element.value = value
        } else if (has_focus) {
            element.value = 'User is active';
        } else if (last_user_action >= refresh_rate) {
            element.value = 'Refreshing';
        } else {
            element.value = (refresh_rate - last_user_action);
        }
    }

    function refreshCheck() {
        if ((last_user_action >= refresh_rate && !has_focus && document.readyState === 'complete') || lost_focus_count > focus_margin) {
            window.location.reload();
        }
    }

    function startClock() {
        if (!isTimerPaused) {
            last_user_action++;
        }

        refreshCheck();
        updateVisualTimer();
    }

    function initTimer() {
        window.addEventListener('focus', windowHasFocus, false);
        window.addEventListener('blur', windowLostFocus, false);
        window.addEventListener('click', windowHasFocus, false);
        window.addEventListener('mousemove', reset, false);
        window.addEventListener('keypress', windowHasFocus, false);
        window.addEventListener('scroll', windowHasFocus, false);
        document.addEventListener('touchMove', windowHasFocus, false);
        document.addEventListener('touchEnd', windowHasFocus, false);

        // Count Down that executes ever second
        timer = setInterval(startClock, 1000);
    }

    function openModal() {
        document.getElementById('myModal').style.display = "block";
    }

    function closeModal() {
        document.getElementById('myModal').style.display = "none";
    }

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        let captionText = document.getElementById("caption");

        if (n > slides.length) {
            slideIndex = 1
        }

        if (n < 1) {
            slideIndex = slides.length
        }

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }

        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }

    // initTimer();

    /**
     *Disable cause it cause an error due to missing html elem
     let slideIndex = 1;
     showSlides(slideIndex);
     */
</script>

<div id="toast-container" class="toast-top-right" aria-live="polite" role="alert">
    <?php if (isset($_SESSION['flash_msg']) && $_SESSION['flash_msg'] != '') : ?>

        <?php $flash = Session::ReadFlushMsg(); ?>

        <div id="sticky-container" class="toast toast-<?php echo $flash['msg_type']; ?>" style="">
            <div id="alert_progress_bar" class="toast-progress" style="width: 100%;"></div>
            <button type="button" class="toast-close-button" role="button">×</button>
            <script>hideErrDiv('sticky-container', 'alert_progress_bar');</script>
            <div class="toast-message"><?php echo $flash['msg_text']; ?></div>
        </div>

    <?php endif; ?>
</div>