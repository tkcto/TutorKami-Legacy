<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Upload file progress bar dengan PHP dan MySQL. Tutorial oleh tutorialweb.net">
    <meta name="author" content="fatoni arif">

    <title>Simple Upload File dengan PHP, MySQL dan Bootstrap</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	
	<div class="container" style="margin-top:200px;">
		<div class="well text-center">
			<h1>Upload file dengan cepat!</h1>
			<hr>
			<div class="col-md-8 col-md-offset-2">
				<form class="form-inline" method="post" action="">
					<div class="input-group">
						<label class="input-group-btn">
							<span class="btn btn-danger btn-lg">
								Browse&hellip; <input type="file" id="media" name="media" style="display: none;" required>
							</span>
						</label>
						<input type="text" class="form-control input-lg" size="40" readonly required>
					</div>
					<div class="input-group">
						<input type="submit" class="btn btn-lg btn-primary" value="Start upload">
					</div>
				</form>
				<br>
				<div class="progress" style="display:none">
					<div id="progressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
						<span class="sr-only">0%</span>
					</div>
				</div>
				<div class="msg alert alert-info text-left" style="display:none"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script>
$(document).ready(function() {
	$('form').on('submit', function(event){
		event.preventDefault();
		var formData = new FormData($('form')[0]);

		$('.msg').hide();
		$('.progress').show();
		
		$.ajax({
			xhr : function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener('progress', function(e){
					if(e.lengthComputable){
						console.log('Bytes Loaded : ' + e.loaded);
						console.log('Total Size : ' + e.total);
						console.log('Persen : ' + (e.loaded / e.total));
						
						var percent = Math.round((e.loaded / e.total) * 100);
						
						$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
					}
				});
				return xhr;
			},
			
			type : 'POST',
			url : 'upload.php',
			data : formData,
			processData : false,
			contentType : false,
			success : function(response){
				$('form')[0].reset();
				$('.progress').hide();
				$('.msg').show();
				if(response == ""){
					alert('File gagal di upload');
				}else{
					var msg = 'File berhasil di upload. ID file = ' + response;
					$('.msg').html(msg);
				}
			}
		});
	});
});
        
        
    </script>
    <script>
	$(function() {
	  $(document).on('change', ':file', function() {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	  });

	  $(document).ready( function() {
		  $(':file').on('fileselect', function(event, numFiles, label) {

			  var input = $(this).parents('.input-group').find(':text'),
				  log = numFiles > 1 ? numFiles + ' files selected' : label;

			  if( input.length ) {
				  input.val(log);
			  } else {
				  if( log ) alert(log);
			  }

		  });
	  });
	  
	});
	</script>
</body>
</html>
