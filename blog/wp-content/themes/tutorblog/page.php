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
      <h1 class="blue-txt"> Latest news & blog</h1>
      <hr>
     
      <!-- Nav tabs -->
      <div class="blog_news">
      </div>
      <div id="content">
         <div class="col-md-offset-2 col-md-8" style="margin-bottom:30px;">
            <ul id="tabs" class="nav nav-tabs mytab" data-tabs="tabs">
             <?php
                $cat_link = $_SERVER['REQUEST_URI'];
                $url_path = parse_url($cat_link);
			    $path_parts = explode('/', $url_path['path']);
			    $cat = $path_parts[count($path_parts)-2];
			    if(is_numeric($cat)){
			    	$cat = $path_parts[count($path_parts)-4];
			    }

              ?>
               <li <?php if($cat =='blog'){?> class="active" <?php } ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><i class="fa fa-clock-o" aria-hidden="true"></i>Latest</a></li>
               <li <?php if($cat =='popular'){?> class="active" <?php } ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>/popular"><i class="fa fa-free-code-camp" aria-hidden="true"></i>Popular</a></li>
               <?php 
                $categories = get_categories(array(
				    'orderby' => 'id',
				    'hide_empty'=> 0,
				    'exclude'=> 1
				 ));
				 $n=1;
                foreach ( $categories as $category ) { ?>
                <li <?php if($cat == $category->slug) {?> class="active" <?php } ?>><a href="<?php echo get_category_link( $category->term_id );?>"><i class="fa <?php if($n==1) echo 'fa-lightbulb-o'; else if($n==2) echo 'fa-newspaper-o'; else if($n==3) echo 'fa-pencil';  ?>" aria-hidden="true"></i><?php echo ucfirst($category->slug);?></a></li>
               <?php $n++; } ?>
            </ul>
            
         </div>
         <div id="my-tab-content" class="tab-content">

            <div class="tab-pane active" id="popular">
              <?php
                $paged = get_query_var('paged');
				$popularpost = new WP_Query( array( 'posts_per_page' => 3, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC','paged'=>$paged ) );
				if($popularpost->have_posts()){
				$j = 0;
				$counts = $popularpost->post_count;
				while ( $popularpost->have_posts() ) { $popularpost->the_post();?>
               <?php if($j%3==0) echo '<div class="row">';?>
              
                  <div class="col-md-4 m-top15">
                   <a href="<?php echo get_permalink(); ?>">  <img src="<?php the_post_thumbnail_url(); ?>"  class="img-responsive" alt="tab">
                     <h4 class="org-txt"><?=the_title();?></h4></a>
                     <p><?php the_time('F j,Y')?> | <?php the_author(); ?> | <?php comments_number(); ?></p>
                     <p><?php $content = get_the_content('[...]'); echo $content;?></p>
                  </div>
                <?php if((($j!=0) && (($j+1)%3==0)) || ($j == $counts-1))  echo '</div>';?>
             <?php $j++; }?>
               
            </div>
           
         </div>
         <div class="col-md-12 text-center" align="center">
           <?php 
		    echo paginate_links(array('total'=>$popularpost->max_num_pages)); } ?>
         </div>
      </div>
   </div>
</section>
<?php get_footer(); ?>
