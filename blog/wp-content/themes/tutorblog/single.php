<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
global $post;
get_header(); 
tkblog_set_post_views($post->ID);
?>
<section class="blog">
   <div class="container">
      <h1 class="blue-txt">Latest news &amp; blog</h1>
      <hr>
      <div class="row">
         <div class="col-md-8 col-sm-8">
          <?php
			// Start the loop.
			while ( have_posts() ) : the_post();?>
            <div class="martop better">
               <h3 class="org-txt"><?php the_title();?></h3>
            </div>
            <ul class="faicon">
               <li><?php the_time('F j,Y');?></li>
               <li><i class="fa fa-tag" aria-hidden="true"></i><?php the_author(); ?></li>
               <li>
                  <span class="glyphicon glyphicon-comment"></span>
                  <?php comments_number(); ?>
               </li>
            </ul>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="blog" class="img-responsive">
            <div class="blog_w">
               <?php the_content();?>
               <div class="martop">
                  <p><?php the_tags( 'Tags: ', ', ', '<br />' ); ?></p>
                  <hr>
               </div>
               <div class="martop">
                  <p>Share this post to social media :</p>
                  <div class="row martop">
                     <?php echo do_shortcode('[mashshare]');?>
                     
                     <?php echo do_shortcode('[whatsapp-share]');?>
                  </div>
               </div>
               <div class="fb_comment">
                  <ul class="nav nav-tabs" role="tablist">
                     <li role="presentation" ><a href="#home_1" aria-controls="home_1" role="tab" data-toggle="tab">Tutorkami comments</a></li>
                     <li role="presentation" class="active"><a href="#profile_1" aria-controls="profile_1" role="tab" data-toggle="tab">Facebook comments</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content" align="left">
                     <div role="tabpanel" class="tab-pane " id="home_1">
                        <?php 
                        if ( comments_open() || get_comments_number() ) {
							comments_template();
						} ?>
                     </div>
                     <div role="tabpanel" class="tab-pane active" id="profile_1">
                       <div class="fb-comments" data-href="http://projects.manfredinfotech.com/tutorkami/blog" data-numposts="5"></div>
                     </div>
                  </div>
               </div>
            </div>
          <?php endwhile;?>
         </div>
         <?php get_sidebar();?>
      </div>
   </div>
</section>
<?php get_footer(); ?>
