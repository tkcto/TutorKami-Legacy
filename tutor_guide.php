<?php 

require_once('includes/head.php');

# SESSION CHECK #

$_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['auth'])) {

  header('Location: tutor-login.php');

  exit();

}

if ($_SESSION['auth']['user_role'] != '3') {

   header('Location:parent_guide.php');

   exit();

}

$getTerm = system::FireCurl(CMS_URL.'?cms_id=24&lang='.$_SESSION['lang_code']);

$term = $getTerm->data[0];



$getGuide = system::FireCurl(CMS_URL.'?cms_id=25&lang='.$_SESSION['lang_code']);

$guide = $getGuide->data[0];



$getFaq = system::FireCurl(CMS_URL.'?cms_id=26&lang='.$_SESSION['lang_code']);

$faq = $getFaq->data[0];



$getPolicy = system::FireCurl(CMS_URL.'?cms_id=27&lang='.$_SESSION['lang_code']);

$policy = $getPolicy->data[0];


include('includes/header.php');
$_SESSION['getPage'] = "Tutor Guide Page";
unset($_SESSION["firstlogin"]);
?>
<style>
a.text-warning{
    color: #f1592a;
    text-decoration: none;
}
</style>
<section class="profile">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt"><?php echo UPPERCASE_TUTOR_GUIDE; ?></h1>

         <div class="row parent_g">

            <ul class="nav nav-tabs" role="tablist">

               <!--<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo $term->pmt_subtitle; ?></a></li>-->

               <li role="presentation" class="active"><a href="#guide" aria-controls="guide" role="tab" data-toggle="tab"><?php echo $guide->pmt_subtitle; ?></a></li>

               <li role="presentation"><a href="tutor_faq.php"><?php echo $faq->pmt_subtitle; ?></a></li>

               <li role="presentation"><a href="#policy" aria-controls="policy" role="tab" data-toggle="tab"><?php echo $policy->pmt_subtitle; ?></a></li>

            </ul>

            <div class="tab-content">

               <!--<div role="tabpanel" class="tab-pane active" id="home">

                  <?php echo $term->pmt_pagedetail; ?>

               </div>-->

               <div role="guide" class="tab-pane active" id="guide">
               
                  <?php //echo $guide->pmt_pagedetail; ?>
                  <p class="text-left text-primary"> SPM</p>
                    <p class="text-left text-text-secondary"> <a href="training.php" target="_blanck" style="color: black;text-decoration: none;" > 1. Matematik Tambahan</a> <a href="https://www.tutorkami.com/tutor_profile?did=1100448" target="_blanck" class="text-warning" style="color: #f1592a;"> - Cikgu Fahmi</a> </p>
                    <p class="text-left text-text-secondary"> <a href="training.php" target="_blanck" style="color: black;text-decoration: none;">  2. Biologi           </a> <a href="https://www.tutorkami.com/tutor_profile?did=17148" target="_blanck" class="text-warning" style="color: #f1592a;"> - Cikgu Farhana</a> </p>
                  <p class="text-left text-primary">PT3</p>
                  <p class="text-left text-primary">UPSR</p>

               </div>

               <div role="tabpanel" class="tab-pane " id="reviews">

                  <?php echo $faq->pmt_pagedetail; ?>

               </div>

               <div role="policy" class="tab-pane " id="policy">

                  <?php echo $policy->pmt_pagedetail; ?>

               </div>

            </div>

         </div>

      </div>

   </div>

</section>

<?php include('includes/footer.php');?>