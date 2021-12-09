<?php 

require_once('includes/head.php');

# SESSION CHECK #

if (!isset($_SESSION['auth'])) {

  header('Location: login.php');

  exit();

}

if ($_SESSION['auth']['user_role'] != '3') {

   header('Location:parent_guide.php');

   exit();

}

$getTerm = system::FireCurl(CMS_URL.'?cms_id=24&lang='.$_SESSION['lang_code']);

$term = $getTerm->data[0];


include('includes/header.php');
$_SESSION['getPage'] = "Tutor Guide Page";
?>
		<!--<link rel="stylesheet" type="text/css" href="https://tympanus.net/Development/TabStylesInspiration/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="https://tympanus.net/Development/TabStylesInspiration/css/demo.css" />-->
		<link rel="stylesheet" type="text/css" href="https://tympanus.net/Development/TabStylesInspiration/css/tabs.css" />
		<link rel="stylesheet" type="text/css" href="https://tympanus.net/Development/TabStylesInspiration/css/tabstyles.css" />
  		<script src="https://tympanus.net/Development/TabStylesInspiration/js/modernizr.custom.js"></script>
<style>
a.accordion-toggle{
    /*color: #f1592a;*/
    text-decoration: none;
}
.panel-heading .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
    content:"\2212";    /* adjust as needed, taken from bootstrap.css */
    float: left;        /* adjust as needed */
    color: black;//grey;         /* adjust as needed */
    margin-right: 5px;
}
.panel-heading .accordion-toggle.collapsed:after {
    /* symbol for "collapsed" panels */
    content:"\2b";   /* adjust as needed, taken from bootstrap.css */
    margin-right: 5px;
}



</style>
<section class="profile">

   <div class="main-body">

      <div class="container">

         <h1 class="text-center text-uppercase blue-txt"><?php echo "TRAINING"; ?></h1>

       
         <section>
				<div class="tabs tabs-style-linetriangle">
					<nav>
						<ul>
							<li><a style="text-decoration: none;" href="#section-linetriangle-1"><span>Course Content</span></a></li>
							<li><a style="text-decoration: none;" href="#section-linetriangle-2"><span>Overview</span></a></li>
							<li><a style="text-decoration: none;" href="#section-linetriangle-3"><span>Q&A</span></a></li>
							<li><a style="text-decoration: none;" href="#section-linetriangle-4"><span>Bookmarks</span></a></li>
							<li><a style="text-decoration: none;" href="#section-linetriangle-5"><span>Announcements</span></a></li>
						</ul>
					</nav>
					<div class="content-wrap">
						<section id="section-linetriangle-1">
                        
                        <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title collapsed" style="text-align: left;">
          <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapse1"> Collapsible list group <span class="pull-right">15:10</span></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse" style="text-align: left;">
        <ul class="list-group">
          <li class="list-group-item" style="font-size: 15px;">One <span class="pull-right">05:00</span></li>
          <li class="list-group-item" style="font-size: 15px;">Two <span class="pull-right">05:00</span></li>
          <li class="list-group-item" style="font-size: 15px;">Three <span class="pull-right">05:10</span></li>
        </ul>
      </div>
    </div>
  </div>


  <div class="panel-group" style="margin-top:-15px;">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title collapsed" style="text-align: left;">
          <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapse2"> Collapsible list group <span class="pull-right">31.00</span></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse" style="text-align: left;">
        <ul class="list-group">
          <li class="list-group-item" style="font-size: 15px;">One <span class="pull-right">10:00</span></li>
          <li class="list-group-item" style="font-size: 15px;">Two <span class="pull-right">11:00</span></li>
          <li class="list-group-item" style="font-size: 15px;">Three <span class="pull-right">10:00</span></li>
        </ul>
      </div>
    </div>
  </div>               

                        </section>
						<section id="section-linetriangle-2"><p>2</p></section>
						<section id="section-linetriangle-3"><p>3</p></section>
						<section id="section-linetriangle-4"><p>4</p></section>
						<section id="section-linetriangle-5"><p>5</p></section>
					</div><!-- /content -->
				</div><!-- /tabs -->
			</section>

<!--   https://tympanus.net/Development/TabStylesInspiration/
         <section>
				<div class="tabs tabs-style-linemove">
					<nav style="background-color:transparent;">
						<ul>
							<li><a href="#section-linemove-1" class="icon icon-home" style="text-decoration: none;"><span>Course Content</span></a></li>
							<li><a href="#section-linemove-2" class="icon icon-box" style="text-decoration: none;"><span>Overview</span></a></li>
							<li><a href="#section-linemove-3" class="icon icon-display" style="text-decoration: none;"><span>Q&A</span></a></li>
							<li><a href="#section-linemove-4" class="icon icon-upload" style="text-decoration: none;"><span>Bookmarks</span></a></li>
							<li><a href="#section-linemove-5" class="icon icon-tools" style="text-decoration: none;"><span>Announcements</span></a></li>
						</ul>
					</nav>
					<div class="content-wrap">
						<section id="section-linemove-1"><p>1</p></section>
						<section id="section-linemove-2"><p>2</p></section>
						<section id="section-linemove-3"><p>3</p></section>
						<section id="section-linemove-4"><p>4</p></section>
						<section id="section-linemove-5"><p>5</p></section>
					</div>
				</div>
			</section>
			-->






       

<!--
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title collapsed">
          <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapse1"> Collapsible list group <span class="pull-right">15:10</span></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <ul class="list-group">
          <li class="list-group-item" style="font-size: 15px;">One <span class="pull-right">05:00</span></li>
          <li class="list-group-item" style="font-size: 15px;">Two <span class="pull-right">05:00</span></li>
          <li class="list-group-item" style="font-size: 15px;">Three <span class="pull-right">05:10</span></li>
        </ul>
      </div>
    </div>
  </div>


  <div class="panel-group" style="margin-top:-15px;">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title collapsed">
          <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapse2"> Collapsible list group <span class="pull-right">31.00</span></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <ul class="list-group">
          <li class="list-group-item" style="font-size: 15px;">One <span class="pull-right">10:00</span></li>
          <li class="list-group-item" style="font-size: 15px;">Two <span class="pull-right">11:00</span></li>
          <li class="list-group-item" style="font-size: 15px;">Three <span class="pull-right">10:00</span></li>
        </ul>
      </div>
    </div>
  </div>
-->

         

      </div>

   </div>

</section>

<?php include('includes/footer.php');?>
<script>
$(document).on('click', '.panel-heading span.clickable', function(e){
            var $this = $(this);
            if(!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideUp();
                $this.addClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon glyphicon-minus-sign').addClass('glyphicon glyphicon-plus-sign');
            } else {
                $this.parents('.panel').find('.panel-body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon glyphicon-plus-sign').addClass('glyphicon glyphicon-minus-sign');
            }
        })
</script>
	<script src="https://tympanus.net/Development/TabStylesInspiration/js/cbpFWTabs.js"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
