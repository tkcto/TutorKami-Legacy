<div class="martop better">
   <h3 class="org-txt"><?php the_title();?></h3>
</div>
<ul>
   <li><?php the_time('F j,Y');?></li>
   <li><i class="fa fa-tag" aria-hidden="true"></i><?php the_author(); ?></li>
   <li><a href="#">
      <span class="glyphicon glyphicon-comment"></span>
      <?php comments_number(); ?></a>
   </li>
</ul>
<img src="<?php the_post_thumbnail_url(); ?>" alt="blog" class="img-responsive">
<div class="blog_w">
   <?php the_content();?>
   <div class="martop">
      <p><?php the_tags( 'Tags: ', ', ', '<br />' ); ?></p>
      <hr>
   </div>
   
   
</div>