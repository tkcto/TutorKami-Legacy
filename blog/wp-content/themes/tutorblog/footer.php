<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?><footer>
   <section class="addr">
      <div class="container">
         <div class="row">
            <div class="col-md-5 col-sm-6 col-md-push-1">
               <h3>Follow us on social media :</h3>
               <ul class="footer_followus">
                 <?php $social_posts = new WP_Query(array(
				        'post_type'=>'social',
				        'order' =>'ASC'
				        ));
                  if($social_posts->have_posts()):
                    while($social_posts->have_posts()): $social_posts->the_post();
				        ?>
                  <li><a href="<?php echo get_post_meta($post->ID, 'media-url', true);?>" target="_blank"><i class="fa <?php echo get_post_meta($post->ID, 'icon-name', true);?>" aria-hidden="true"></i></a></li>
                  
                  <?php endwhile;endif;?>
               </ul>
               <ul class="addr_list">
                <?php $contact_posts = new WP_Query(array(
				        'post_type'=>'contact'
				        ));
                  if($contact_posts->have_posts()):
                    while($contact_posts->have_posts()): $contact_posts->the_post();
				        ?>
                  <li><?php echo get_post_meta($post->ID, 'office-address', true);?>
                  </li>
                  <li><?php echo get_post_meta($post->ID, 'phone', true);?></li>
                  <li><?php echo get_post_meta($post->ID, 'email', true);?></li>
                <?php endwhile;endif;?>
               </ul>
            </div>
            <div class="col-md-2 col-sm-2">
               <h3>Site Navigation</h3>
               <?php
			         $navarr = array('menu' => 'Footer Menu',
			            'container' => '',
			            'menu_class' => 'nl'
			         );
			         wp_nav_menu($navarr);
			        ?>
            </div>
            <div class="col-md-4 col-sm-4 ft-search">
               <h3>Search this site</h3>
               <?php dynamic_sidebar('sidebar-2'); ?>
               <?php
               $navarr = array('menu' => 'Terms Menu',
                  'container' => '',
                  'menu_class' => 'nl'
               );
                wp_nav_menu($navarr);
              ?>
            </div>
         </div>
      </div>
   </section>
   <section class="copyright">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <?php strip_tags(dynamic_sidebar('sidebar-3'));?>
            </div>
         </div>
      </div>
   </section>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins)
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
<!-- Swiper JS -->
<script src="<?php bloginfo('template_directory'); ?>/js/swiper.min.js"></script>
<!-- Initialize Swiper -->
<script>
   var swiper = new Swiper('.swiper-container', {
      pagination: '.swiper-pagination',
      slidesPerView: 3,
      slidesPerColumn: 2,
      paginationClickable: true,
      spaceBetween: 30
   });

   $(function(){
      $("#hider").hide();
      $("#loadermodaldiv").hide();
   });
</script>
<script src="<?php bloginfo('template_directory'); ?>/js/velocity.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/enhance.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/admin/js/flush.js"></script>
 <script src="<?php bloginfo('template_directory'); ?>/js/custom-file-input.js"></script>
    <script>
       $('.carousel').carousel({
    interval: false
     }); 
    </script>
  <script>
   $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script>
<script type="text/javascript">
  var stickyOffset = $('.sticky').offset().top;

$(window).scroll(function(){
  var sticky = $('.sticky'),
      scroll = $(window).scrollTop();
    
  if (scroll >= stickyOffset) sticky.addClass('fixed');
  else sticky.removeClass('fixed');
});
</script>
<script src="<?php bloginfo('template_directory'); ?>/js/owl.carousel.js"></script>

<script>

            $(document).ready(function() {

              $('.owl-carousel').owlCarousel({

                loop: true,

                margin: 10,

                responsiveClass: true,

                responsive: {

                  0: {

                    items: 1,

                    nav: true

                  },

                  600: {

                    items: 3,

                    nav: false

                  },

                  1000: {

                    items: 4,

                    nav: true,

                    loop: false,

                    margin: 20

                  }

                }

              })

            })

          </script>
          <script type="text/javascript">
          	$('.menu-item-has-children').addClass('dropdown');
			$('.menu-item-has-children > a').append( "<span class='caret'></span>" );
			$('.menu-item-has-children > a').addClass('dropdown-toggle');
			$('.menu-item-has-children > a').attr('data-toggle','dropdown');
			
			$('.menu-item-has-children > a').attr('role',"button");
			
			$('.menu-item-has-children ul').addClass('dropdown-menu');
			$('.menu-item-has-children ul').attr('role','menu');
			$('.menu-item-has-children ul').attr('aria-labelledby','dropdownMenu');
      $('.ft-search .search-form .input-group input[type="text"]').attr('class','search_control');
      $('.ft-search .search-form .input-group input[type="text"]').attr('placeholder','Search...');
      $('.ft-search .search-form .input-group  .input-group-addon').hide();
			$(".langnav").append('<li class="mylist"><i class="fa fa-phone" aria-hidden="true"></i> | <i class="fa fa-envelope-o" aria-hidden="true"></i> | <i class="fa fa-whatsapp" aria-hidden="true"></i> | 019-641 2395</li>');
          </script>
<?php //wp_footer();?>
</body>
</html>
