<?php
/**
 * Template Name:PopularPage
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>
<section class="blog">
   <div class="container">
      <h1 class="blue-txt"> Latest news & blog</h1>
      <hr>
     
      <!-- Nav tabs -->
      <div class="blog_news">
      </div>
      <div id="content">
         <div class="col-md-offset-2 col-md-8" style="margin-bottom:30px;">
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
               <li class="active"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><i class="fa fa-clock-o" aria-hidden="true"></i>Latest</a></li>
               <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>/popular"><i class="fa fa-free-code-camp" aria-hidden="true"></i>Popular</a></li>
               <?php 
                $categories = get_categories(array(
				    'orderby' => 'id',
				    'hide_empty'=> 0,
				    'exclude'=> 1
				 ));
                $cat_link = $_SERVER['REQUEST_URI'];
                $url_path = parse_url($cat_link);
			    $path_parts = explode('/', $url_path['path']);
			    $cat = $path_parts[count($path_parts)-2];
			    if(is_numeric($cat)){
			    	$cat = $path_parts[count($path_parts)-4];
			    }
			    foreach ( $categories as $category ) { ?>
                <li <?php if($cat == $category->slug) {?> class="active" <?php } ?>><a href="<?php echo get_category_link( $category->term_id );?>"><i class="fa fa-lightbulb-o" aria-hidden="true"></i><?php echo ucfirst($category->slug);?></a></li>
               <?php } ?>
            </ul>
            
         </div>
         <div id="my-tab-content" class="tab-content">

            <div class="tab-pane active" id="popular">
              <?php
				$popularpost = new WP_Query( array( 'posts_per_page' => 3, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
				$j = 0;
				$counts = $popularpost->post_count;
				while ( $popularpost->have_posts() ) : $popularpost->the_post();?>
               <?php if($j%3==0) echo '<div class="row">';?>
              
                  <div class="col-md-4 m-top15">
                   <a href="<?php echo get_permalink(); ?>">  <img src="<?php the_post_thumbnail_url(); ?>"  class="img-responsive" alt="tab">
                     <h4 class="org-txt"><?=the_title();?></h4></a>
                     <p><?php the_time('F j,Y')?> | <?php the_author(); ?> | <?php comments_number(); ?></p>
                     <p><?php $content = get_the_content(); echo $content;?></p>
                  </div>
                <?php if((($j!=0) && (($j+1)%3==0)) || ($j == $counts-1))  echo '</div>';?>
             <?php $j++; endwhile;?>
               
            </div>
           
         </div>
         <div class="col-md-12 text-center" align="center">
           <?php /*if(function_exists('wp_paginate')):
            wp_paginate();  
		    else :
		        the_posts_pagination( array(
		            'prev_text'          => __( 'Previous page', 'twentysixteen' ),
		            'next_text'          => __( 'Next page', 'twentysixteen' ),
		            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
		        ) );
		    endif;*/ 
		    echo paginate_links();?>
            <!-- <nav aria-label="Page">
               <ul class="pagination">
                  <li class="page-item">
                     <a class="page-link" href="#" aria-label="Previous">
                     <span aria-hidden="true">&laquo;</span>
                     <span class="sr-only">Previous</span>
                     </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                     <a class="page-link" href="#" aria-label="Next">
                     <span aria-hidden="true">&raquo;</span>
                     <span class="sr-only">Next</span>
                     </a>
                  </li>
               </ul>
            </nav> -->
         </div>
      </div>
   </div>
</section>
<?php get_footer(); ?>