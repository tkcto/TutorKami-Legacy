<?php 
require_once('mobile-detect/mobile-detect.php');
                        if ($tablet_browser > 0) {
                            //print 'is tablet';
                            include('search_job-desktop.php');
                        }else if ($mobile_browser > 0) {
                            //print 'is mobile';
                            include('search_job-mobile.php');
                        }else {
                            include('search_job-desktop.php');
                        }
?>