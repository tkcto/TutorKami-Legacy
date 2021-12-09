<!DOCTYPE html>
<html>
    <head>
        <title>Ajax File Upload with Dynamic Progress Bar  Demo</title>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
        <!--<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>-->
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="test.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="test.css" />
    </head>
    <body>
        <div class="main-container">
            <div class="section">
                <form id="ajax-upload-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-10">
                            <input type="file" class="file-input" name="ajax_file" multiple="multiple"/>
                        </div>
                        <div class="col-2 text-right">
                            <button type="submit" class="btn btn-blue"><i class="fa fa-upload"></i> Upload</button>
                        </div>
                    </div>
                </form>
                <div class="progress-container"></div>
            </div>
        </div>
    </body>
</html>