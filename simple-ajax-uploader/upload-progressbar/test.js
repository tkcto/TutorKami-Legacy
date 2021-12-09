$(document).ready(function () {
    $("#ajax-upload-form").submit(function (e) {
        e.preventDefault();// Prevent form from being submitted.

        var fd = new FormData();// Create new form data object to push files into
        var files = $(".file-input")[0].files;// Getting all files from input field

        //Loop through all files and append progress bar for each file
        for (var i = 0; i < files.length; i++) {
            fd.append("ajax_file", files[i]);
            var regEx = /^(image|video|audio)\//;

            //Creating the progress bar element
            var bar = '<div class="progress" id="' + i + '">' +
                    '<span class="abort" id="abort-' + i + '">&times;</span>' +
                    '<div class="progress-title" id="progress-title-' + i + '"></div>' +
                    '<div class="progress-bar" id="progress-bar-' + i + '"></div>' +
                    '</div>';
            $(".progress-container").append(bar);// Append progress bar to container
            //If file is not image,audio or upload through add error class to progress otherwise process upload
            if (files[i].type.match(regEx)) {
                //Function to upload single file
                uploadFile(fd, i, files[i]);
            } else {
                $("#progress-bar-" + i).closest(".progress")
                        .addClass("progress-error");
                $("#progress-title-" + i).text("Invalid file format");
            }
            // If all files have been uploaded rest the form
            if (i === (files.length - 1))
                this.reset();
        }
    });
    // Remove progress bar with error class
    $(document).on("click", ".progress-error > .abort", function () {
        $(this).closest(".progress").fadeOut(3000, function () {
            $(this).remove();
        });
    });

});

function uploadFile(fd, i, file) {
    var ajax = $.ajax({
        url: 'process-upload.php',// Server side script to process uploads
        type: 'POST',
        data: fd,
        processData: false,//Bypass jquery's form data processing
        contentType: false,//Bypass jquery's content type to handle file upload
        xhr: function () {
            var xhr = $.ajaxSettings.xhr();
            if (xhr.upload) {
                //Listen to upload progress and update progress bar
                xhr.upload.addEventListener("progress", function (progress) {
                    var total = Math.round((progress.loaded / progress.total) * 100);
                    $("#progress-bar-" + i).css({"width": total + "%"});
                    $("#progress-title-" + i).text(file.name + ' - ' + total + "%");
                }, false);
                //Code to be executed if upload is aborted
                xhr.addEventListener("abort", function () {
                    $("#progress-bar-" + i).closest(".progress").fadeOut(3000, function () {
                        $(this).remove();
                    });
                }, false);
                //Update progress and remove it after upload has finished
                xhr.addEventListener("loadend", function () {
                    $("#progress-bar-" + i).closest(".progress").fadeOut(3000, function () {
                        $(this).remove();
                    });
                }, false);

                //Show an error on progress if an error has occured during upload
                xhr.addEventListener("error", function () {
                    $("#progress-bar-" + i).closest(".progress")
                            .addClass("progress-error").find("status-count").text("Error");
                }, false);
                //Show timeout error on progress bar if upload request has timedout
                xhr.addEventListener("timeout", function (progress) {
                    $("#progress-bar-" + i).closest(".progress")
                            .addClass("progress-timedout").find("status-count").text("Timed Out");
                }, false);
            }
            return xhr;
        }
    });
    // Bind abort to current ajax request.
    $(document).on("click", ".progress > #abort-" + i, function () {
        ajax.abort();
    });
}