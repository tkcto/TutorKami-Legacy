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

get_header(); ?>
<section class="blog">
   <div class="container">

    <?php 
     $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
     if ( have_posts() ) : 
    ?>
      <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
      <hr>
     
      <!-- Nav tabs -->
      <div class="blog_news">
      </div>
      <div id="content">
         
         <div id="my-tab-content" class="tab-content">

            <div class="tab-pane active" id="popular">
              <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                  /**
                   * Run the loop for the search to output the results.
                   * If you want to overload this in a child theme then include a file
                   * called content-search.php and that will be used instead.
                   */
                  get_template_part( 'template-parts/content', 'search' );

                // End the loop.
                endwhile;

                // Previous/next page navigation.
                
                echo paginate_links();

              // If no content, include the "No posts found" template.
              else :
                get_template_part( 'template-parts/content', 'none' );

              endif;
              ?>
               
            </div>
           
         </div>
         <div class="col-md-12 text-center" align="center">
           <?php 
		          //echo paginate_links(array('total'=>$popularpost->max_num_pages)); } ?>
         </div>
      </div>
   </div>
</section>
<?php get_footer(); ?>
