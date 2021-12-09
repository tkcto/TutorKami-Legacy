<?php
/*
Controller name: News
Controller description: News management
*/

class JSON_API_News_Controller {

	public function get_latest_news() {
		global $json_api;
		
		$response = array();
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
		} else{
			$args = array(
				'posts_per_page' => 6
				);
			$loop = new WP_Query($args);
			if ($loop->have_posts()):
				while ($loop->have_posts()):
					$loop->the_post();
				$response[] = array(
					'ID' => get_the_ID() ,
					'thumbnail_url' => get_the_post_thumbnail_url() ,
					'title' => get_the_title() ,
					'content' => get_the_content('[...]'),
					'date' => get_the_time('F j,Y'),
					'author'=> get_the_author(),
					'post_url'=> get_permalink(),
					'comments_count'=> get_comments_number()
					);
				endwhile;
				$result = array('flag' => 'success', 'data' => $response);
				return $result;

				else:
					$json_api->error("Not found.");
				endif;
			} 
		}
		public function get_social_media() {
			global $json_api;

			$response = array();
			if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
				$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
			} else{
				$args = array(
					'post_type'=>'social',
					'order' =>'ASC'
					);
				$loop = new WP_Query($args);
				if ($loop->have_posts()):
					while ($loop->have_posts()):
						$loop->the_post();
					$post_id = get_the_ID();
					$response[] = array(
						'ID' => get_the_ID() ,
						'media_url' => get_post_meta($post_id, 'media-url', true),
						'icon_name' => get_post_meta($post_id, 'icon-name', true)
						);
					endwhile;
					$result = array('flag' => 'success', 'data' => $response);
					return $result;

					else:
						$json_api->error("Not found.");
					endif;
				} 
			}
			public function get_contact_details() {
				global $json_api;

				$response = array();
				if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
					$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
				} else{
					$args = array(
						'post_type'=>'contact',

						);
					$loop = new WP_Query($args);
					if ($loop->have_posts()):
						while ($loop->have_posts()):
							$loop->the_post();
						$post_id = get_the_ID();
						$response[] = array(
							'ID' => get_the_ID() ,
							'office_address' => get_post_meta($post_id, 'office-address', true),
							'phoneno' => get_post_meta($post_id, 'phone', true),
							'emailid' => get_post_meta($post_id, 'email', true)
							);
						endwhile;
						$result = array('flag' => 'success', 'data' => $response);
						return $result;

						else:
							$json_api->error("Not found.");
						endif;
					} 
				}
				public function get_site_navigation() {
					global $json_api;
                    global $wpdb;
					$response = array();
					if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
						$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
					} else{
						$menu_name = 'Footer Menu';
                        
						$menu_items = wp_get_nav_menu_items($menu_name);
                        foreach ( (array) $menu_items as $key => $menu_item ) {

								$response[] = array(
						               'title' => $menu_item->title,
						               'url' => $menu_item->url
						                );
						   }
                           $result = array('flag' => 'success', 'data' => $response);
					       return $result;
					 }
                 }
                 public function get_copyright() {
					global $json_api;

					$response = array();
					if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
						$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
					} else{
								ob_start();
								dynamic_sidebar('sidebar-3');
								$sidebar = strip_tags(ob_get_contents());
								ob_end_clean();

								$response[] = array(
						               'content' => $sidebar
						              );
						   }
                           $result = array('flag' => 'success', 'data' => $response);
					       return $result;
				 }
				 public function get_term_menu() {
					global $json_api;
                    
					$response = array();
					if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
						$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
					} else{
						$menu_name = 'Terms Menu';
                        
						$menu_items = wp_get_nav_menu_items($menu_name);
                        foreach ( (array) $menu_items as $key => $menu_item ) {

								$response[] = array(
						               'title' => $menu_item->title,
						               'url' => $menu_item->url
						                );
						   }
                           $result = array('flag' => 'success', 'data' => $response);
					       return $result;
					 }
                 }
                 public function get_footer_search() {
					global $json_api;

					$response = array();
					if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
						$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
					} else{
								ob_start();
								dynamic_sidebar('sidebar-2');
								$sidebar = ob_get_contents();
								ob_end_clean();

								$response[] = array(
						               'content' => $sidebar
						              );
						   }
                           $result = array('flag' => 'success', 'data' => $response);
					       return $result;
				 }
                 public function get_header_menu(){
                 	global $json_api;
                    global $wpdb;
					$response = array();
					if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
						$result = array('flag' => 'error', 'message' => 'Wrong Method. Allowed method GET.');
					} else{
						$menu_name = 'Header Menu';
                        
						$menuitems = wp_get_nav_menu_items($menu_name);
                        
					       ob_start();
					    ?> 
							    <?php
							    $count = 0;
							    $submenu = false;

							    foreach( $menuitems as $item ):
							        // set up title and url
							        $title = $item->title;
							        $link = $item->url;

							        // item does not have a parent so menu_item_parent equals 0 (false)
							        if ( !$item->menu_item_parent ):

							        // save this id for later comparison with sub-menu items
							        $parent_id = $item->ID;
							    ?>
							    <li class="dropdown">
							        <a <?php if($item->menu_item_parent!=0){?> role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="#" <?php } ?> href="<?php echo $link; ?>" class="title">
							            <?php echo $title; ?>
							            <?php if($item->menu_item_parent!=0){?>
							            <span class="caret"></span>
							            <?php } ?>
							        </a>
							    <?php endif; ?> 
							    <?php if ( $parent_id == $item->menu_item_parent ): ?>
						          <?php if ( !$submenu ): $submenu = true; ?>
						            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
						            <?php endif; ?>
						             <li>
				                      <a href="<?php echo $link; ?>" class="title"><?php echo $title; ?></a>
				                     </li> 
				                <?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): ?>
						            </ul>
						            <?php $submenu = false; endif; ?>

						        <?php endif; ?>
						        <?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ): ?>
								    </li>                           
								    <?php $submenu = false; endif; ?>

								<?php $count++; endforeach; ?>
                                <?php
				                $header_menu = ob_get_contents();
								ob_end_clean();
								$response[] = array(
						               'mainmenu' => $header_menu
						              );
				                 
                       }
                $result = array('flag' => 'success', 'data' => $response);
			    return $result;       
			}
	
}

?>