<?php
/**
 * The main template file
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
            <ul id="tabs" class="nav nav-tabs mytab" data-tabs="tabs">
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
				$n=1;
			    foreach ( $categories as $category ) { ?>
                <li <?php if($cat == $category->slug) {?> class="active" <?php } ?>><a href="<?php echo get_category_link( $category->term_id );?>"><i class="fa <?php if($n==1) echo 'fa-lightbulb-o'; else if($n==2) echo 'fa-newspaper-o'; else if($n==3) echo 'fa-pencil';  ?>" aria-hidden="true"></i><?php echo ucfirst($category->slug);?></a></li>
               <?php $n++;} ?>
            </ul>
            
         </div>
         <div id="my-tab-content" class="tab-content">

            <div class="tab-pane active" id="latest">
               <?php
                    $paged = get_query_var('paged');
					
          					$recent_posts = new WP_Query( array(
          					     
          					      'posts_per_page' => 3,
          					      'paged'=>$paged
          					      
          			          )); 
          					$count = $recent_posts->post_count;
          					if($recent_posts->have_posts()){
          					$i = 0;
      				while ($recent_posts->have_posts() ){ $recent_posts->the_post();
      					
      				?>
               <?php if($i%3==0) echo '<div class="row">';?>
                  
                  <div class="col-md-4 m-top15">
                   <a href="<?php echo get_permalink(); ?>">  <img src="<?php the_post_thumbnail_url(); ?>"  class="img-responsive" alt="tab">
                     <h4 class="org-txt"><?=the_title();?></h4></a>
                     <p><?php the_time('F j,Y')?> | <?php the_author(); ?> | <?php comments_number(); ?></p>
                     <p><?php $content = get_the_content('[...]'); echo $content;?></p>
                  </div>
                  
                
               <?php if((($i!=0) && (($i+1)%3==0)) || ($i == $count-1))  echo '</div>';?>
               <?php $i++ ; }  ?>
               
            </div>
          </div>
         <div class="col-md-12 text-center" align="center">
           <?php 

		         echo paginate_links(array('total'=>$recent_posts->max_num_pages)); }?>
            
         </div>
      </div>
   </div>
</section>
<?php get_footer(); ?>
