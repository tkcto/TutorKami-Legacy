<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<div class="col-md-4 col-sm-4">
  <div class="list_bolg" align="center">
   <?php strip_tags(dynamic_sidebar('sidebar-1'));?>
   
   <h3 class="org-txt">Categories</h3>
   <ul>
     <?php 
     $categories = get_categories(array(
      'orderby' => 'id',
      'hide_empty'=> 0,
      'exclude'=> 1
      ));
      foreach ( $categories as $category ) { ?>
      <a href="<?php echo get_category_link( $category->term_id );?>">
       <li><?php echo $category->name;?></li>
     </a>
     <?php } ?>
   </ul>
   
   <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#recent" aria-controls="home" role="tab" data-toggle="tab">Recent</a></li>
    <li role="presentation"><a href="#tag" aria-controls="profile" role="tab" data-toggle="tab">Tags</a></li>
  </ul>
  
  <div class="tab-content" align="left">
    <div role="tabpanel" class="tab-pane active" id="recent">
     <?php
     
     $recent_posts = new WP_Query( array(
       
      'posts_per_page' => 4
      
      )); 
     
     if($recent_posts->have_posts()){
      
       while ($recent_posts->have_posts() ){ $recent_posts->the_post();
        
         ?>
         <div class="media">
          <div class="media-left">
           <a href="<?php echo get_permalink(); ?>">
             <img class="media-object" src="<?php the_post_thumbnail_url(); ?>" alt="...">
           </a>
         </div>
         <div class="media-body">
           <h4 class="media-heading"><?=the_title();?></h4>
           <p><?php the_time('F j,Y')?></p>
         </div>
       </div>
       <?php } } ?>
     </div>
     <div role="tabpanel" class="tab-pane" id="tag">
       <div class="taps">
        
        <?php $tags = get_tags(array(
         'orderby' => 'id',
         'hide_empty'=> 0
         ));
        foreach ( $tags as $tag ) {
         ?>
         <a href="<?php echo get_tag_link( $tag->term_id );?>"><span><?php echo $tag->name;?></span></a>&nbsp;
         <?php } ?>
       </div>
     </div>
   </div>
 </div>
</div>

