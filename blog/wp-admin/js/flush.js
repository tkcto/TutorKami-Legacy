function hideErrDiv(containerEle, progressEle) {
    var elem = document.getElementById(progressEle);
    var width = 100;
    var id = setInterval(frame, 50);

    function frame() {
        if (width <= 0) {
            clearInterval(id);
            // $.get('ajax/flush_msg.php',function(){
                $("#" + containerEle).fadeOut(200);
            // });                      
        } else {
            width--;
            elem.style.width = width + '%';
        }
    }
}

var counter = 0;
function getStickyNote (msg_type, msg_text) {
    counter++;
    var html = '<div id="sticky-container-'+counter+'" class="toast toast-'+msg_type+'" style="">'+
        '<div id="alert_progress_bar_'+counter+'" class="toast-progress" style="width: 100%;"></div>'+
        '<button type="button" class="toast-close-button" role="button">×</button>'+
        '<div class="toast-message">'+msg_text+'</div>'+
    '</div>';

    $('#toast-container').append(html);
    hideErrDiv('sticky-container-'+counter, 'alert_progress_bar_'+counter);
    return html;
}