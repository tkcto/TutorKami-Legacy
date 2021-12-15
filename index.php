<?php
error_reporting(0);
/* START fadhli - hardcode - reduce load time */
$getLan = dirname($_SERVER['REQUEST_URI']) . "/";
if ($getLan == "/my/") {
    include('index-bm.php');
} else {
    include('index-bi.php');
}
exit();
/* END fadhli - hardcode - reduce load time */
/* Di bawah code sebenar */
?>
<?php
//include('includes/head.php');

include('includes/header.php'); ?>
<link href='css-pricing/rotating-card/rotating-card.css' rel='stylesheet'/>
<!-- -->
<link rel="stylesheet" type="text/css" href="css-pricing/adaptor/css/custom.css"/>
<style>
    .transparent {
        background-color: transparent !important;
        box-shadow: inset 0px 1px 0 rgba(0, 0, 0, .075);
    }

    .left-border-none {
        border-left: none !important;
        box-shadow: inset 0px 1px 0 rgba(0, 0, 0, .075);
    }

    .border-radius {
        border-radius: 4px;
    }

    .carousel-control.left, .carousel-control.right {
        background-image: none !important;
        filter: none !important;
        opacity: 1 !important;
        color: #f1592a;
    }


    /*==========  Mobile First Method  ==========*/

    /* Custom, iPhone Retina */
    @media screen and (min-width: 320px) {

    }

    /* Extra Small Devices, Phones */
    @media screen and (min-width: 480px) {

    }

    /* Small Devices, Tablets */
    @media screen and (min-width: 768px) {

    }

    /* Medium Devices, Desktops */
    @media screen and (min-width: 992px) {

    }

    /* Large Devices, Wide Screens */
    @media screen and (min-width: 1200px) {

    }


    /*==========  Non-Mobile First Method  ==========*/

    /* Large Devices, Wide Screens */
    @media screen and (max-width: 1200px) {

    }

    /* Medium Devices, Desktops */
    @media screen and (max-width: 992px) {

    }

    /* Small Devices, Tablets */
    @media screen and (max-width: 768px) {

    }

    /* Extra Small Devices, Phones */
    @media screen and (max-width: 480px) {

    }

    /* Custom, iPhone Retina */
    @media screen and (max-width: 320px) {
        h4.media_example {
            font-size: 11px;
        }

        p.media_example {
            font-size: 11px;
        }

    }

    .thisfont {
        font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
        font-size: 15px;
    }

    .alert-message {
        margin: 5px 0;
        padding: 5px;
        border-left: 3px solid #eee;
    }

    .alert-message h4 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    .alert-message p:last-child {
        margin-bottom: 0;
    }

    .alert-message code {
        background-color: #fff;
        border-radius: 3px;
    }

    .alert-message-success {
        background-color: #F4FDF0;
        border-color: #3C763D;
    }

    .alert-message-success h4 {
        color: #3C763D;
    }

    .alert-message-danger {
        background-color: #fdf7f7;
        border-color: #d9534f;
    }

    .alert-message-danger h4 {
        color: #d9534f;
    }

    .alert-message-warning {
        background-color: #fcf8f2;
        border-color: #f0ad4e;
    }

    .alert-message-warning h4 {
        color: #f0ad4e;
    }

    .alert-message-info {
        background-color: #f4f8fa;
        border-color: #5bc0de;
    }

    .alert-message-info h4 {
        color: #5bc0de;
    }

    .alert-message-default {
        background-color: #EEE;
        border-color: #B4B4B4;
    }

    .alert-message-default h4 {
        color: #000;
    }

    .alert-message-notice {
        background-color: #FCFCDD;
        border-color: #BDBD89;
    }

    .alert-message-notice h4 {
        color: #444;
    }

    .circular-square {
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }
</style>
<section class="banner">

    <article class="banner_text">

        <div class="container">

            <div class="row">

                <div style="width:100%">

                    <?php

                    // Get Header Text

                    $arrHeadText = system::FireCurl(CMS_URL . '?cms_id=21&lang=' . $_SESSION['lang_code']);

                    foreach ($arrHeadText->data as $head) {

                        echo $head->pmt_pagedetail;

                    }

                    ?>

                    <script>
                        function checkField() {
                            if ($("#subject_id").val() == "") {
                                document.getElementById('subject').value = '';
                                alert("Please select / click from the list of subject only!");
                                return false
                            } else if ($("#location_id").val() == "") {
                                document.getElementById('location').value = '';
                                alert("Please select / click from the list of location only!");
                                return false
                            } else {
                                return true;
                            }
                        }
                    </script>
                    <div class="form_div" style="width: 100%">
                        <div class="hidden-sm hidden-xs">
                            <form autocomplete="off" action="search_tutor.php#submitsearch"
                                  method="get" onsubmit="return checkField();">

                                <input type="hidden" name="subject_id" id="subject_id" value="">

                                <input type="hidden" name="location_id" id="location_id" value="">

                                <div class="form-group">

                                    <div class="row ro1">
                                        <div class="col-40">
                                            <?php
                                            $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                                            ?>
                                            <div class="input-group" style="">

                                                <span class="input-group-addon customInput "
                                                      style="padding-left:10px;"><i
                                                            class="fa fa-search"></i></span>

                                                <!-- <input type="text" name="subject" class="my_form_control autocomplete- customInput" id="subject" placeholder="<?php echo HOME_SEARCH_EXAMPLE; ?>"> -->
                                                <input type="text" id="subject" name="subject"
                                                       class="my_form_control autocomplete customInput"
                                                       id="subject"
                                                       placeholder="<?php echo "Subject";//echo HOME_SEARCH_EXAMPLE; ?>">

                                            </div>
                                        </div>
                                        <div class="col-40">

                                            <div class="input-group ui-widget" style="">

                                                <span class="input-group-addon customInput"
                                                      style="padding-left:10px;"><i
                                                            class="glyphicon glyphicon-map-marker"></i></span>

                                                <input type="text" id="location" name="location"
                                                       class="my_form_control ui-autocomplete-input customInput"
                                                       id="location"
                                                       placeholder="<?php echo "Your location";//echo HOME_SEARCH_LOCATION_PLACEHOLDER; ?>"/>
                                            </div>


                                        </div>
                                        <div class="col-20">
                                            <div>

                                                <button type="submit" class="btn btn-md search_btn"
                                                        style="width:100%;"><?php echo HOME_SEARCH_TUTOR_PLACEHOLDER; ?></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </article>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
         data-interval="false">

        <!-- Indicators -->

        <ol class="carousel-indicators">

            <?php

            // Get Slider

            $arrSlider = system::FireCurl(LIST_SLIDER);

            $i = 0;

            foreach ($arrSlider->data as $sl) {

                ?>

                <li data-target="#carousel-example-generic"
                    data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) { ?> class="active" <?php } ?>></li>

                <?php $i++;
            } ?>

        </ol>

        <!-- Wrapper for slides -->

        <!-- man -->
        <!-- <ol class="carousel-indicators">
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="item">
            <img src="admin/upload/nonsliderimage.jpg" alt="tutorkami">
            <div class="carousel-caption">

            </div>
          </div>
        </div> -->
        <!-- man -->

        <div class="carousel-inner" role="listbox">

            <?php

            // Get Slider

            $j = 0;

            foreach ($arrSlider->data as $sl) {

                ?>

                <div class="item <?php if ($j == 0) { ?> active <?php } ?>">

                    <!--<img src="admin/<?php echo $sl->sl_image; ?>" alt="...">-->

                    <?php
                    if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) { // if mobile browser
                        ?>
                        <img src="<?php echo $sl->sl_image; ?>">
                        <?php
                    } else { // desktop browser
                        ?>
                        <img src="<?php echo $sl->sl_image; ?>" style="padding-top: 80px;">

                        <?php
                    }
                    ?>


                    <div class="carousel-caption">

                    </div>

                </div>

                <?php $j++;
            } ?>


        </div>

        <div class="hidden-lg hidden-md" style="margin-top:20px">


            <form autocomplete="off" action="search_tutor.php#submitsearch" method="get"
                  onsubmit="return checkField();">

                <input type="hidden" name="subject_id2" id="subject_id2" value="">

                <input type="hidden" name="location_id2" id="location_id2" value="">

                <div class="form-group">

                    <div class="row ro1">
                        <div class="col-40">
                            <?php
                            $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
                            ?>
                            <div class="input-group">
                                <span class="input-group-addon transparent"><i
                                            class="glyphicon glyphicon-search"></i></span>
                                <input type="text" id="subject2" name="subject2"
                                       class="form-control autocomplete left-border-none"
                                       placeholder="Subject">
                            </div>

                        </div>
                        <div class="col-40">


                            <div class="input-group">
                                <span class="input-group-addon transparent"><i
                                            class="glyphicon glyphicon-map-marker"></i></span>
                                <input type="text" id="location2" name="location2"
                                       class="form-control autocomplete left-border-none"
                                       placeholder="Your location">
                            </div>


                        </div>
                        <div class="col-20">
                            <div>

                                <button type="submit" class="btn btn-md search_btn border-radius"
                                        style="width:100%;"><?php echo HOME_SEARCH_TUTOR_PLACEHOLDER; ?></button>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>

    </div>

</section>

<section class="how_works bott_border">

    <div class="container">

        <div class="col-md-2"></div>

        <?php

        // Get How it works

        $arrHowitworks = system::FireCurl(CMS_URL . '?cms_id=1&lang=' . $_SESSION['lang_code']);


        foreach ($arrHowitworks->data as $how){
        ?>

        <div class=" col-md-12 tutor_button">

            <!--<h3 class="get_tutor1 sticky">

            <a href="request_a_tutor_form.php" class="green_btn pull-right">GET A TUTOR</a></h3>-->

            <div class="row  b_margin_50">

                <h1 class="header"><?= $how->pmt_subtitle ?></h1>

            </div>

        </div>

        <div class="row">

            <?php

            echo $how->pmt_pagedetail;


            }

            ?>

        </div>

    </div>

</section>

<!--<section class="orange_sec">

   <div class="container">

      <div class="row">

         <div class="col-md-10 col-md-offset-1">

            <div class="pin_box">

               <?php

// Get What is tutorkami

$arrWhatistutorkami = system::FireCurl(CMS_URL . '?cms_id=2&lang=' . $_SESSION['lang_code']);


foreach ($arrWhatistutorkami->data as $what) {
    ?>

                   

               <h1 class="header"><?= $what->pmt_subtitle ?></h1>

               <hr class="myhr">

               <?php

    echo $what->pmt_pagedetail;

}

?>

               </div>

         </div>

      </div>

   </div>

</section>-->

<section class="how_works bott_border">

    <div class="container">

        <?php

        // Get Why Tutorkami

        $arrWhytutorkami = system::FireCurl(CMS_URL . '?cms_id=3&lang=' . $_SESSION['lang_code']);


        foreach ($arrWhytutorkami->data as $why){
        ?>

        <div class="row  b_margin_50">

            <div class="col-md-12">

                <h1 class="header"><?= $why->pmt_subtitle ?></h1>

            </div>

        </div>

        <div class="row">

            <?php

            echo $why->pmt_pagedetail;


            }

            ?>

        </div>

    </div>

</section>

<section class="how_works bott_border">

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <?php

                // Get Our Guarantee

                $arrOurGuarantee = system::FireCurl(CMS_URL . '?cms_id=4&lang=' . $_SESSION['lang_code']);


                foreach ($arrOurGuarantee->data as $guarant) { ?>

                    <h1 class="header"><?= $guarant->pmt_subtitle ?></h1>

                    <?php

                    echo $guarant->pmt_pagedetail;


                }

                ?>

            </div>

        </div>

    </div>

</section>

<section class="how_works bott_border">

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <?php

                // Get Tutor Text

                $arrTutorText = system::FireCurl(CMS_URL . '?cms_id=22&lang=' . $_SESSION['lang_code']);


                foreach ($arrTutorText->data as $ttext) { ?>

                    <h1 class="header"><?php echo $ttext->pmt_subtitle; ?></h1>

                    <p class="subHead"><?php
                        if ($_SESSION['lang_code'] == 'BM') {
                            echo "TUTORS SWASTA TERKINI UNTUK TUISYEN DARI RUMAH";
                        } else {
                            echo "LATEST REGISTERED PRIVATE TUTORS FOR HOME TUITION";
                        }
                        //echo "LATEST REGISTERED PRIVATE TUTORS FOR HOME TUITION";//$ttext->pmt_pagedetail;
                        ?></p>

                    <?php

                }

                ?>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <ul class="tutor_list">

                    <?php

                    // Get Slider

                    $arrTutor = system::FireCurl(LIST_TUTOR);

                    $i = 0;

                    foreach ($arrTutor->data as $tutor) {

                        $arrState = system::FireCurl(LIST_STATE_URL . '?state_id=' . $tutor->ud_state);

                        foreach ($arrState->data as $state) {

                            $statename = $state->st_name;

                        }

                        $pix = sprintf("%'.07d\n", $tutor->u_profile_pic);

                        ?>


                        <div class="col-md-4 col-sm-6">
                            <div class="card-container">
                                <div class="card">
                                    <div class="front">
                                        <div class="cover">
                                            <img src="css-pricing/rotating-card/bg-card.jpg"/>
                                        </div>
                                        <div class="user">
                                            <img class="circular-square" src="<?php
                                            if ($tutor->u_profile_pic != '') {
                                                //echo APP_ROOT."images/profile/".$pix."_0.jpg";
                                                if (is_numeric($tutor->u_profile_pic)) {
                                                    echo APP_ROOT . "images/profile/" . $pix . "_0.jpg";
                                                } else {
                                                    $pic = $tutor->u_profile_pic;
                                                    echo APP_ROOT . "images/profile/" . $pic . ".jpg";
                                                }
                                            } else {
                                                if ($tutor->u_gender == 'M') echo 'images/tutor_ma.png'; else echo 'images/tutor_mi1.png';
                                            }
                                            ?>"/>
                                        </div>
                                        <div class="content">
                                            <div class="main">
                                                <h3 class="name">
                                                    <strong> <?= $tutor->u_displayname ?> </strong>
                                                </h3>
                                                <p class="profession"><?= $tutor->ud_city ?></p>
                                                <p class="alert-message alert-message-info text-center">
                                                    <strong>
                                                        <?php
                                                        $langStringQua = strip_tags($tutor->ud_qualification);
                                                        //$langStringQua = strip_tags("AAAAAAAAAAAAAAA AAAAAAAAAAAAAAA AAAAAAAAAAAAAAA");
                                                        if (strlen($langStringQua) > 67) {

                                                            // truncate string
                                                            $langStringCutQua = substr($langStringQua, 0, 67);
                                                            $langStringEndPointQua = strrpos($langStringCutQua, ' ');

                                                            //if the string doesn't contain any space then it will cut without word basis.
                                                            $langStringQua = $langStringEndPointQua ? substr($langStringCutQua, 0, $langStringEndPointQua) : substr($langStringCutQua, 0);
                                                            $langStringQua .= ' ...';
                                                            echo '<br/>' . $langStringQua;
                                                        } else {
                                                            echo '<br/>' . $langStringQua;
                                                        }

                                                        ?>
                                                    </strong></p>
                                            </div>
                                        </div>
                                    </div> <!-- end front panel -->
                                    <div class="back">
                                        <div class="header">
                                            <h5 class="motto"><a
                                                        href="tutor_profile.php?did=<?php echo $tutor->u_displayid; ?>"
                                                        target="_blank"
                                                        class="btn btn-info">View <?= $tutor->u_displayname ?></a>
                                            </h5>
                                        </div>
                                        <div class="content">
                                            <div class="main">
                                                <h4 class="text-center"><strong>About Me </strong>
                                                </h4>
                                                <p class="alert-message alert-message-info text-center thisfont">
                                                    <?php
                                                    $langString = strip_tags($tutor->ud_about_yourself);
                                                    if (strlen($langString) > 300) {

                                                        // truncate string
                                                        $langStringCut = substr($langString, 0, 300);
                                                        $langStringEndPoint = strrpos($langStringCut, ' ');

                                                        //if the string doesn't contain any space then it will cut without word basis.
                                                        $langString = $langStringEndPoint ? substr($langStringCut, 0, $langStringEndPoint) : substr($langStringCut, 0);
                                                        $langString .= ' ...';
                                                        echo '<br/>' . $langString;
                                                    } else {
                                                        echo '<br/>' . $langString;
                                                    }

                                                    ?>


                                                </p>


                                            </div>
                                        </div>
                                    </div> <!-- end back panel -->
                                </div> <!-- end card -->
                            </div> <!-- end card-container -->
                        </div>


                    <?php } ?>

                </ul>
                <div class="clearfix"></div>
                <p class="m_top_30"><a href="<?PHP
                    if ($_SESSION['lang_code'] == 'BM') {
                        echo "https://www.tutorkami.com/my/search_tutor.php";
                    } else {
                        echo "search_tutor.php";
                    }
                    ?>" class="orange_btn"><?php echo BUTTON_VIEW_MORE_TUTOR; ?></a></p>

            </div>

        </div>

    </div>

</section>

<section class="how_works">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <?php

                // Get People Saying

                $arrPeopleSaying = system::FireCurl(CMS_URL . '?cms_id=5&lang=' . $_SESSION['lang_code']);


                foreach ($arrPeopleSaying->data as $saying) { ?>
                    <!--<h1 class="header"><?= $saying->pmt_subtitle ?></h1>-->
                    <?php
                    //echo $saying->pmt_pagedetail;
                }
                ?>
                <h1 class="header"><?
                    if ($_SESSION['lang_code'] == 'BM') {
                        echo "TESTIMONIAL PELANGGAN";
                    } else {
                        echo "CLIENT’S TESTIMONIAL";
                    }
                    //echo "CLIENT’S TESTIMONIAL";//$arrPeopleSaying->data[0]->pmt_subtitle; ?></h1>
                <!--
                <center>
                      <div style="width: 270px; height: 480px;">
                      <section>
                        <div id="viewport">
                          <div id="box">
                            <figure class="slide jbs-current">
                              <img src="http://tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent1.jpeg" style="width: 270px; height: 480px;">
                            </figure>
                            <figure class="slide">
                              <img src="http://tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent2.jpeg" style="width: 270px; height: 480px;">
                            </figure>
                            <figure class="slide">
                              <img src="http://tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent3.jpeg" style="width: 270px; height: 480px;">
                            </figure>
                            <figure class="slide">
                              <img src="http://tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent4.jpeg" style="width: 270px; height: 480px;">
                            </figure>
                          </div>
                        </div>

                        <footer>
                          <nav class="slider-controls">
                            <a class="increment-control" href="#" id="prev" title="Prev Slide">&laquo; Prev</a>
                            <a class="increment-control" href="#" id="next" title="Next Slide">Next &raquo;</a>

                            <ul id="controls">
                              <li><a class="goto-slide current" href="#" data-slideindex="0"></a></li>
                              <li><a class="goto-slide" href="#" data-slideindex="1"></a></li>
                              <li><a class="goto-slide" href="#" data-slideindex="2"></a></li>
                              <li><a class="goto-slide" href="#" data-slideindex="3"></a></li>
                            </ul>
                          </nav>
                        </footer>
                      </section>
                      </div>
                </center>
                -->
                <!-- START fadhli -->

                <div class="owl-carousel owl-theme">

                    <div class="item">
                        <figure>
                            <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent1.jpeg"
                                 style="width: 270px; height: 480px;"
                                 class="img-responsive center-block" alt=""/>
                        </figure>
                    </div>

                    <div class="item">
                        <figure>
                            <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent2.jpeg"
                                 style="width: 270px; height: 480px;"
                                 class="img-responsive center-block" alt=""/>
                        </figure>
                    </div>

                    <div class="item">
                        <figure>
                            <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent3.jpeg"
                                 style="width: 270px; height: 480px;"
                                 class="img-responsive center-block" alt=""/>
                        </figure>
                    </div>

                    <div class="item">
                        <figure>
                            <img src="https://www.tutorkami.com/admin/ckeditor/plugins/imageuploader/uploads/parent4.jpeg"
                                 style="width: 270px; height: 480px;"
                                 class="img-responsive center-block" alt=""/>
                        </figure>
                    </div>

                </div>
                <!-- END fadhli -->


            </div>

        </div>

    </div>

</section>

<section class="join">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <?php

                // Get Are you a tutor

                $arrIsTutor = system::FireCurl(CMS_URL . '?cms_id=6&lang=' . $_SESSION['lang_code']);


                foreach ($arrIsTutor->data as $tutor) {

                    echo $tutor->pmt_pagedetail;


                }

                ?>

            </div>

        </div>

    </div>

</section>

<section class="how_works gray_bg">

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2">


                <h1 class="header">

                    <?php

                    // Get Are you a tutor

                    $arrNewsText = system::FireCurl(CMS_URL . '?cms_id=23&lang=' . $_SESSION['lang_code']);


                    foreach ($arrNewsText->data as $newst) {

                        echo $newst->pmt_pagedetail;

                    } ?>

                </h1>

            </div>

        </div>

        <div class="row">

            <?php // Get Latest News

            if ($_SESSION['lang_code'] == '' || $_SESSION['lang_code'] == $defaultLang) {

                $lang_url = str_replace('{lang}/', '', LIST_LATESTNEWS_URL);

            } else {

                $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_LATESTNEWS_URL);

            }

            $arrLatestNews = system::FireCurl($lang_url);

            // var_dump($lang_url);

            $n = 1;

            $count = sizeof($arrLatestNews->data);


            foreach ($arrLatestNews->data as $news) {

                $post_id = $news->ID;

                ?>

                <!--<div class="col-md-4 col-xs-6">

            <div class="thum_bg">

             <a href="<?= $news->post_url ?>"><img src="<?= $news->thumbnail_url ?>" class="img-responsive" alt="" width="100%"/></a>

             <h4 class="media_example"><?= $news->title ?></h4>

             <p class="media_example"><?= $news->date ?> | <?= $news->author ?> | <?= $news->comments_count ?> Comment(s)</p>

<?php
                $string = strip_tags($news->content);
                if (strlen($string) > 100) {

                    // truncate string
                    $stringCut = substr($string, 0, 100);
                    $endPoint = strrpos($stringCut, ' ');

                    //if the string doesn't contain any space then it will cut without word basis.
                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    //$string .= '... <a href="'.$news->post_url.'">Read More</a>';
                    $string .= ' ...';
                    ?>
<p class="media_example"><? echo $string; ?></p>	
<?php
                } else {
                    ?>
<p class="media_example"><? echo $string; ?></p>	
<?php
                }

                ?>


           </div>

         </div>-->

                <?php $n++;
            } ?>
        </div>

    </div>

</section>


<section class="qe">

    <div class="container">

        <div class="row">

            <div class="col-md-12" style="position:relative;">

                <?php

                // Get Questions or Enquires

                $arrEnquery = system::FireCurl(CMS_URL . '?cms_id=7&lang=' . $_SESSION['lang_code']);


                foreach ($arrEnquery->data as $entry) {

                    echo $entry->pmt_pagedetail;


                }

                ?>

            </div>

        </div>

    </div>

</section>

<?php include('includes/footer.php'); ?>

<script>

    $(function () {

        function log(message) {

            $("<div>").text(message).prependTo("#log");

            $("#log").scrollTop(0);

        }


        /*$("#subject").autocomplete({

           source: function( request, response ) {

              $.ajax( {

                 url: "<?php echo SEARCH_SUBJECT_URL; ?>",

               dataType: "json",

               data: {

                  term: request.term

               },

               success: function( data ) {

                  response( data );

               }

            });

         },

         minLength: 2,

         select: function( event, ui ) {

          // alert(ui.item.id)

          $('#subject_id').val(ui.item.id);

            // log( "Selected: " + ui.item.value + " aka " + ui.item.id );

         }

      });*/


        $(document).ready(function () {

            $('.carousel').carousel({

                interval: 3000

            });


//         $('#carousel-example-generic1').carousel({

//         	interval: false

//       });


        });


        /*$("#location").autocomplete({

           source: function( request, response ) {

              $.ajax( {

                 url: "<?php echo SEARCH_LOCATION_URL; ?>",

               dataType: "json",

               data: {

                  term: request.term

               },

               success: function( data ) {

                  response( data );

               }

            });

         },

         minLength: 2,

         select: function( event, ui ) {

          $('#location_id').val(ui.item.id);

            // log( "Selected: " + ui.item.value + " aka " + ui.item.id );

         }

      });*/

    });

    <?php
    $connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
    $sqlS = "SELECT ts.ts_id, tc.tc_title, ts.ts_title FROM tk_tution_subject ts
				LEFT JOIN tk_tution_course tc ON tc.tc_id = ts.ts_tc_id AND tc.tc_status = 'A'
				WHERE ts.ts_status = 'A'";
    $sqlL = "SELECT tc.city_id, tc.city_name, st.st_name
				FROM tk_cities tc
				LEFT JOIN tk_states st
				ON st.st_id = tc.city_st_id
				WHERE tc.city_status = '1'";

    $subjectid = array();
    $locationid = array();
    ?>
    var subjects = [
        <?php
        $res = mysqli_query($connect, $sqlS);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            array_push($subjectid, $row['ts_id']);

            if ($i != 0) {
                echo ",";
            }

            echo "'" . $row['ts_title'] . " " . $row['tc_title'] . "'";
            //echo "'Subject : ".ucwords($row['ts_title'])." </br> Level : ".ucwords($row['tc_title'])."'";
            $i++;
        }
        ?>
    ];
    var subjects_id = ['<?php echo join("', '", $subjectid); ?>'];

    var locations = [
        <?php
        $res = mysqli_query($connect, $sqlL);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            array_push($locationid, $row['city_id']);

            if ($i != 0) {
                echo ",";
            }

            echo "'" . $row['city_name'] . ", " . $row['st_name'] . "'";
            $i++;
        }
        ?>
    ];
    var locations_id = ['<?php echo join("', '", $locationid); ?>'];

    function autocomplete(inp, type) {
        var arr = [];
        var arrId = [];
        var hiddenInput;
        var hiddenInput2;

        if (type == "s") {
            arr = subjects;
            arrId = subjects_id;
            hiddenInput = "#subject_id";
            hiddenInput2 = "#subject_id2";
        } else if (type == "l") {
            arr = locations;
            arrId = locations_id;
            hiddenInput = "#location_id";
            hiddenInput2 = "#location_id2";
        }
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function (e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            a.setAttribute("style", "border:0");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].toUpperCase().includes(val.toUpperCase())) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = arr[i].substr(0, val.length);
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arrId[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function (e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.innerHTML.split("<input")[0];
                        $(hiddenInput).val(this.getElementsByTagName("input")[0].value);
                        $(hiddenInput2).val(this.getElementsByTagName("input")[0].value);
                        //alert(this.getElementsByTagName("input")[0].value);
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function (e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1 && x) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }

        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    autocomplete(document.getElementById("subject"), 's');
    autocomplete(document.getElementById("location"), 'l');

    autocomplete(document.getElementById("subject2"), 's');
    autocomplete(document.getElementById("location2"), 'l');
</script>

<style>

    .autocomplete {
        /*the container must be positioned relative:*/
        position: relative;
        display: inline-block;
    }

    .autocomplete-items {
        overflow: auto;
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        height: 300px;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
        color: #000;
        text-align: left;
    }

    .autocomplete-items div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9;
    }

    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important;
        color: #ffffff;
    }
</style>

<script>

    equalheight = function (container) {


        var currentTallest = 0,

            currentRowStart = 0,

            rowDivs = new Array(),

            $el,

            topPosition = 0;

        $(container).each(function () {


            $el = $(this);

            $($el).height('auto')

            topPostion = $el.position().top;


            if (currentRowStart != topPostion) {

                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {

                    rowDivs[currentDiv].height(currentTallest);

                }

                rowDivs.length = 0; // empty the array

                currentRowStart = topPostion;

                currentTallest = $el.height();

                rowDivs.push($el);

            } else {

                rowDivs.push($el);

                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

            }

            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {

                rowDivs[currentDiv].height(currentTallest);

            }

        });

    }


    $(window).load(function () {

        equalheight('.how_works .thum_bg');

    });


    $(window).resize(function () {

        equalheight('.how_works .thum_bg');

    });

    // $('.carousel-example-generic1').carousel('pause');

</script>


<script src="css-pricing/adaptor/js/box-slider-all.jquery.min.js"></script>
<script>
    $(function () {
        var $images = $('.slide > img');
        var imagesLeftToLoad = $images.length;
        $images.on('load', function () {
            imagesLeftToLoad -= 1;

            if (imagesLeftToLoad === 0) {
                init();
            }
        });

        var init = function () {
            // This function runs before the slide transition starts
            var switchIndicator = function ($c, $n, currIndex, nextIndex) {
                // kills the timeline by setting it's width to zero
                $timeIndicator.stop().css('width', 0);
                // Highlights the next slide pagination control
                $indicators.removeClass('current').eq(nextIndex).addClass('current');
            };

            // This function runs after the slide transition finishes
            var startTimeIndicator = function () {
                // start the timeline animation
                $timeIndicator.animate({width: '100%'}, slideInterval);
            };

            var $box = $('#box')
                , $indicators = $('.goto-slide')
                , $effects = $('.effect')
                , $timeIndicator = $('#time-indicator')
                , slideInterval = 5000
                , defaultOptions = {
                speed: 1200
                , autoScroll: true
                , timeout: slideInterval
                , next: '#next'
                , prev: '#prev'
                , pause: '#pause'
                , onbefore: switchIndicator
                , onafter: startTimeIndicator
                , effect: 'scrollHorz'
            }
                , effectOptions = {
                'blindLeft': {blindCount: 15}
                , 'blindDown': {blindCount: 15}
                , 'tile3d': {tileRows: 6, rowOffset: 80}
                , 'tile': {tileRows: 6, rowOffset: 80}
            };

            // initialize the plugin with the desired settings
            $box.boxSlider(defaultOptions);
            // start the time line for the first slide
            startTimeIndicator();

            // Paginate the slides using the indicator controls
            $('#controls').on('click', '.goto-slide', function (ev) {
                $box.boxSlider('showSlide', $(this).data('slideindex'));
                ev.preventDefault();
            });

            // This is for demo purposes only, kills the plugin and resets it with
            // the newly selected effect
            $('#effect-list').on('click', '.effect', function (ev) {
                var $effect = $(this)
                    , fx = $effect.data('fx')
                    , extraOptions = effectOptions[fx];

                $effects.removeClass('current');
                $effect.addClass('current');
                switchIndicator(null, null, 0, 0);
                $box
                    .boxSlider('destroy')
                    .boxSlider($.extend({effect: fx}, defaultOptions, extraOptions));
                startTimeIndicator();

                ev.preventDefault();
            });
        };
    });
</script>
