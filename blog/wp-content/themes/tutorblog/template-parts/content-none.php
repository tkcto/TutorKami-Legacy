<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<section class="no-results not-found">

   <h1 class="page-title"><?php _e( 'Nothing Found', 'twentysixteen' ); ?></h1>

      <hr>
     
      <!-- Nav tabs -->
      <div class="page-content">
      
              <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'twentysixteen' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

              <?php elseif ( is_search() ) : ?>

                <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentysixteen' ); ?></p>
                <div class="col-md-6">
                <?php get_search_form(); ?>
                </div>

              <?php else : ?>

                <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentysixteen' ); ?></p>
                <div class="col-md-6">
                <?php get_search_form(); ?>
                </div>
<?php endif; ?>
</div>
</section>
               
            

