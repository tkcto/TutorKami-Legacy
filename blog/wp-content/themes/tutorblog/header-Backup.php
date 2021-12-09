<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php session_start();?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="apple-touch-icon" sizes="57x57" href="../admin/img/favicons/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="../admin/img/favicons/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="../admin/img/favicons/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="../admin/img/favicons/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="../admin/img/favicons/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="../admin/img/favicons/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="../admin/img/favicons/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="../admin/img/favicons/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="../admin/img/favicons/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="../admin/img/favicons/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="../admin/img/favicons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="../admin/img/favicons/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="../admin/img/favicons/favicon-16x16.png">
      <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	  <?php endif; ?>
      <!-- Bootstrap -->
      <link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php bloginfo('template_directory'); ?>/css/style.css" rel="stylesheet" type="text/css">
      <link href="<?php bloginfo('template_directory'); ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/owl.theme.default.min.css">
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/owl.carousel.min.css"> 
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/swiper.min.css">
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/flush.css">
      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/custom.css">
      <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/component.css" />
      
       <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
       <?php wp_head(); ?>
   </head>
   <body>
      <div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=142313829655431";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
      <div class="loaderBackground" id="hider"></div>
      <div class="loaderpop" id="loadermodaldiv"><br />
         <br />
         <h4><img src="<?php bloginfo('template_directory'); ?>/images/loader.gif" style="width: 50px;" />Loading...</h4>
      </div>
      <header class="navbar-fixed-top">
         <div class="container">
            <nav class="navbar navbar-default">
               <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     </button>
                     
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="img-responsive" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/></a>
                  </div>

					  

			        <?php
					    function qtrans_getSortedLanguages($reverse = false) {

					      global $q_config;

					      $languages = $q_config['language_name'];

					      

					      ksort($languages);

					      // fix broken order

					      $clean_languages = array();

					      foreach($languages as $lang) {

					          $clean_languages[] = $lang;

					      }

					      if($reverse) krsort($clean_languages);

					        return $clean_languages;

					      }
					      global $q_config;
					      $languages_flag = $q_config['flag'];
					      $langnum = count($languages_flag);
					      $mylanguages = qtrans_getSortedLanguages();
					      
					      //echo qtranxf_generateLanguageSelectCode('image');
					      //echo $_SERVER['REQUEST_URI'];
					     ?>
			        <div class="langs navbar-right collapse navbar-collapse">
			         <?php
                if(!isset($_SESSION['auth'])) {
			         $navarr = array('menu' => 'Header Menu',
			            'container' => '',
			            'container_class'=>'',
			            'container_id'=>'',
			            'menu_class' => 'nav navbar-nav'
			         );
			         wp_nav_menu($navarr);
			         } else {
			         ?>
			        <div class="login">
					   <li class="dropdown">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" href="">
                           <?php echo ucfirst($_SESSION['auth']['display_name']); ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                              <li><a href="<?='http://' . $_SERVER['HTTP_HOST'] . '/tutorkami/edit_account.php'?>" class="language">Edit account</a></li>
                              <li><a href="<?='http://' . $_SERVER['HTTP_HOST'] . '/tutorkami/change_password.php'?>" class="language"> Change Password</a></li>
                              <li><a href="<?='http://' . $_SERVER['HTTP_HOST'] . '/tutorkami/view_profile.php'?>" class="language">View Profile</a></li>
                              <li><a href="#" class="language"> List of Classes</a></li>
                              <li><a href="#" class="language">Payment history</a></li>
                              <li><a href="<?='http://' . $_SERVER['HTTP_HOST'] . '/tutorkami/logout.php'?>" class="language">Logout</a></li>
                           </ul>
                        </li>
                        </div>
					    <?php 
                            }
						  ?>  
                     <ul class="nav navbar-nav langnav">
                       <li class="dropdown">
                           <a id="dLabel" role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" href="#">
                           <img id="imgNavSel" src="<?php echo plugins_url();?>/qtranslate-x/flags/<?php echo $languages_flag[$q_config['enabled_languages'][0]];?>" alt="Grossbritanien" class="img-thumbnail icon-small"><span class="caret"></span></a>
                           <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                            <?php for($i=0;$i< $langnum; $i++){ ?>
                              <li class="dropdown-submenu">
                                 <a href="<?php echo get_site_url().'/'.$q_config['enabled_languages'][$i];?>" class="language"><img id="imgNavEng" src="<?php echo plugins_url();?>/qtranslate-x/flags/<?php echo $languages_flag[$q_config['enabled_languages'][$i]];?>" alt="..." class="img-thumbnail icon-small">  <span id="lanNavEng"><?php echo $mylanguages[$i];?></span></a>
                              
                              </li>
                              <?php } ?>
                          </ul>
                        </li>
                     </ul>
                    </div>
                  
                  <!-- /.navbar-collapse -->
               </div>
               <!-- /.container-fluid -->
            </nav>
         </div>
      </header>

