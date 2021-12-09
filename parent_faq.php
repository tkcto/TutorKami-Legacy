<?php include('includes/header.php');?>

<section class="blog">

  <!--<div class="container">



    <?php 
/*
    // Get Parent Faq

    $arrParentFaq = system::FireCurl(CMS_URL.'?cms_id=19&lang='.$_SESSION['lang_code']);



    foreach($arrParentFaq->data as $faq){?>



    <h1 class="blue-txt"><?=$faq->pmt_subtitle?></h1>

    <hr>

    <!-- Nav tabs -->

    <div class="accordion" id="accordion2">

     <?php 

      echo $faq->pmt_pagedetail;

    }
*/
   ?>

 </div>

</div> -->

<style>
.panel-group {
  margin-bottom: 0;
}
.panel-group .panel {
  border-radius: 0;
  box-shadow: none;
}
.panel-group .panel .panel-heading {
  padding: 0;
}
.panel-group .panel .panel-heading h4 a {
  background: #f8f8f8;
  display: block;
  padding: 15px;
  text-decoration: none;
  transition: 0.15s all ease-in-out;
}
.panel-group .panel .panel-heading h4 a:hover, .panel-group .panel .panel-heading h4 a:not(.collapsed) {
  background: #fff;
  transition: 0.15s all ease-in-out;
}
.panel-group .panel .panel-heading h4 a:not(.collapsed) i:before {
  content: "";
}
.panel-group .panel .panel-heading h4 a i {
  color: #999;
}
.panel-group .panel .panel-body {
  padding-top: 0;
}
.panel-group .panel .panel-heading + .panel-collapse > .list-group,
.panel-group .panel .panel-heading + .panel-collapse > .panel-body {
  border-top: none;
}
.panel-group .panel + .panel {
  border-top: none;
  margin-top: 0;
}

h1.b {
  text-transform: capitalize;
  
}
</style>
<div class="container">
<?php 
$arrParentFaq = system::FireCurl(CMS_URL.'?cms_id=19&lang='.$_SESSION['lang_code']);
foreach($arrParentFaq->data as $faq){?>
    <h1 class="b blue-txt"><?=$faq->pmt_subtitle?></h1>
    <hr>
<?php 
}
?>
  <div class="content">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" id="headingOne" role="tab">
          <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><font color="#"><b>Q: Are the tutors of TutorKami.com qualified to teach? Are they school teachers? What are their experiences?</b></font><i class="pull-right fa fa-plus"></i></a></h4>
        </div>
        <div class="panel-collapse collapse in" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
            <p style="font-size:16px;">A: Most of our tutors are full time and part time tutors. We do have school teachers as tutors too, but the number is small. School teachers have a lot of responsibilities. Carrying out all the tasks that come with it can be exhausting physically and mentally. So most school teachers prefer to rest or spend time with their families when they are not in school. However, our tutors who are not school teachers are skillful & have experiences in teaching too. This is proven as their students showed improvements in the latters’ studies under the tutors’ tutelage. Each of our tutor also has qualification such as degree or diploma in their respective field of studies.<br><br>
            You don’t have to worry as we will send the profiles of the interested tutors before hand for you to view their backgrounds and experiences, and choose the one you would like to tutor your child. We will then provide the selected tutor’s phone number for you to contact them and maybe do a bit of phone interviewing. Once you are satisfied, you can then proceed with arranging the first session with that tutor.<br><br>
            There’s more! We also give our guarantee for our tutors’ services. Please have a look at the third FAQ.</p>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" id="headingTwo" role="tab">
          <h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><font color="#"><b>Q: Do I need to pay TutorKami.com’s services for helping me getting a tutor or tuition teacher?</b></font><i class="pull-right fa fa-plus"></i></a></h4>
        </div>
        <div class="panel-collapse collapse" id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
          <div class="panel-body">
            <p style="font-size:16px;">A: There's a one time registration fees of RM50 for each student.</p>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" id="headingThree" role="tab">
          <h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><font color="#"><b>Q: If I am not satisfied by the services provided by a tutor recommended by you, will I get a refund?</b></font><i class="pull-right fa fa-plus"></i></a></h4>
        </div>
        <div class="panel-collapse collapse" id="collapseThree" role="tabpanel" aria-labelledby="headingThree">
          <div class="panel-body">
            <p style="font-size:16px;">A: If you find that a tutor’s service is unsatisfactory during his/her first lesson, you can ask for another tutor, and you don’t have to pay for the first lesson with the previous tutor. Shall you decide to continue with the initial tutor's service for the subsequent lessons, the fees for the first lesson will be <u>inclusive</u> in the monthly payment calculation.</p>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" id="heading4" role="tab">
          <h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4"><font color="#"><b>Q: I have viewed a tutor's profile and I would like to hire her for home tuition . How do I contact the tutor?</b></font><i class="pull-right fa fa-plus"></i></a></h4>
        </div>
        <div class="panel-collapse collapse" id="collapse4" role="tabpanel" aria-labelledby="heading4">
          <div class="panel-body">
            <p style="font-size:16px;">A: Please click the button Get A Tutor above to contact our Coordinators who will assist you</p>
          </div>
        </div>
      </div>
      <!--<div class="panel panel-default">
        <div class="panel-heading" id="heading5" role="tab">
          <h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5"><font color="#"><b>Q: Are the tutors of TutorKami.com qualified to teach? Are they school teachers? What are their experiences?</b></font><i class="pull-right fa fa-plus"></i></a></h4>
        </div>
        <div class="panel-collapse collapse" id="collapse5" role="tabpanel" aria-labelledby="heading5">
          <div class="panel-body">
            <p>A. Please read “TutorKami.com’s Guarantee” at the front page here. If you find that the tutor’s service is unsatisfactory during the first lesson, you can discontinue hiring the tutor, and you don’t have to pay for the first lesson. We will then get another tutor for you. Shall you decide to continue with the initial tutor's service for the subsequent lessons, the first lesson fees is inclusive in the monthly payment calculation.</p>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" id="heading6" role="tab">
          <h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6"><font color="#"><b>Q: Are the tutors of TutorKami.com qualified to teach? Are they school teachers? What are their experiences?</b></font><i class="pull-right fa fa-plus"></i></a></h4>
        </div>
        <div class="panel-collapse collapse" id="collapse6" role="tabpanel" aria-labelledby="heading6">
          <div class="panel-body">
            <p>A. Please read “TutorKami.com’s Guarantee” at the front page here. If you find that the tutor’s service is unsatisfactory during the first lesson, you can discontinue hiring the tutor, and you don’t have to pay for the first lesson. We will then get another tutor for you. Shall you decide to continue with the initial tutor's service for the subsequent lessons, the first lesson fees is inclusive in the monthly payment calculation.</p>
          </div>
        </div>
      </div>-->
    </div>
  </div>
</div>

</section>

<?php include('includes/footer.php');?>

<script type="text/javascript">



  var _gaq = _gaq || [];

  _gaq.push(['_setAccount', 'UA-36251023-1']);

  _gaq.push(['_setDomainName', 'jqueryscript.net']);

  _gaq.push(['_trackPageview']);



  (function() {

    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

  })();



</script>