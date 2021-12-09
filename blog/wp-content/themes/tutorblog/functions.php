<?php

/**

 * Twenty Sixteen functions and definitions

 *

 * Set up the theme and provides some helper functions, which are used in the

 * theme as custom template tags. Others are attached to action and filter

 * hooks in WordPress to change core functionality.

 *

 * When using a child theme you can override certain functions (those wrapped

 * in a function_exists() call) by defining them first in your child theme's

 * functions.php file. The child theme's functions.php file is included before

 * the parent theme's file, so the child theme functions would be used.

 *

 * @link https://codex.wordpress.org/Theme_Development

 * @link https://codex.wordpress.org/Child_Themes

 *

 * Functions that are not pluggable (not wrapped in function_exists()) are

 * instead attached to a filter or action hook.

 *

 * For more information on hooks, actions, and filters,

 * {@link https://codex.wordpress.org/Plugin_API}

 *

 * @package WordPress

 * @subpackage Twenty_Sixteen

 * @since Twenty Sixteen 1.0

 */



/**

 * Twenty Sixteen only works in WordPress 4.4 or later.

 */

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {

	require get_template_directory() . '/inc/back-compat.php';

}



if ( ! function_exists( 'twentysixteen_setup' ) ) :

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 *

 * Create your own twentysixteen_setup() function to override in a child theme.

 *

 * @since Twenty Sixteen 1.0

 */

global $post;

function twentysixteen_setup() {

	/*

	 * Make theme available for translation.

	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen

	 * If you're building a theme based on Twenty Sixteen, use a find and replace

	 * to change 'twentysixteen' to the name of your theme in all the template files

	 */

	load_theme_textdomain( 'twentysixteen' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	/*

	 * Let WordPress manage the document title.

	 * By adding theme support, we declare that this theme does not use a

	 * hard-coded <title> tag in the document head, and expect WordPress to

	 * provide it for us.

	 */

	add_theme_support( 'title-tag' );



	/*

	 * Enable support for custom logo.

	 *

	 *  @since Twenty Sixteen 1.2

	 */

	add_theme_support( 'custom-logo', array(

		'height'      => 240,

		'width'       => 240,

		'flex-height' => true,

	) );



	/*

	 * Enable support for Post Thumbnails on posts and pages.

	 *

	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails

	 */

	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 1200, 9999 );



	// This theme uses wp_nav_menu() in two locations.

	register_nav_menus( array(

		'primary' => __( 'Primary Menu', 'twentysixteen' ),

		'social'  => __( 'Social Links Menu', 'twentysixteen' ),

	) );



	/*

	 * Switch default core markup for search form, comment form, and comments

	 * to output valid HTML5.

	 */

	add_theme_support( 'html5', array(

		'search-form',

		'comment-form',

		'comment-list',

		'gallery',

		'caption',

	) );



	/*

	 * Enable support for Post Formats.

	 *

	 * See: https://codex.wordpress.org/Post_Formats

	 */

	add_theme_support( 'post-formats', array(

		'aside',

		'image',

		'video',

		'quote',

		'link',

		'gallery',

		'status',

		'audio',

		'chat',

	) );



	/*

	 * This theme styles the visual editor to resemble the theme style,

	 * specifically font, colors, icons, and column width.

	 */

	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );



	// Indicate widget sidebars can use selective refresh in the Customizer.

	add_theme_support( 'customize-selective-refresh-widgets' );

}

endif; // twentysixteen_setup

add_action( 'after_setup_theme', 'twentysixteen_setup' );



/**

 * Sets the content width in pixels, based on the theme's design and stylesheet.

 *

 * Priority 0 to make it available to lower priority callbacks.

 *

 * @global int $content_width

 *

 * @since Twenty Sixteen 1.0

 */

function twentysixteen_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );

}

add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );



/**

 * Registers a widget area.

 *

 * @link https://developer.wordpress.org/reference/functions/register_sidebar/

 *

 * @since Twenty Sixteen 1.0

 */

function twentysixteen_widgets_init() {

	register_sidebar( array(

		'name'          => __( 'Sidebar About', 'twentysixteen' ),

		'id'            => 'sidebar-1',

		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),

		'before_widget' => '',

		'after_widget'  => '',

		'before_title'  => '',

		'after_title'   => '',

	) );



	register_sidebar( array(

		'name'          => __( 'Footer Search', 'twentysixteen' ),

		'id'            => 'sidebar-2',

		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),

		'before_widget' => '',

		'after_widget'  => '',

		'before_title'  => '',

		'after_title'   => '',

	) );



	register_sidebar( array(

		'name'          => __( 'Copyright', 'twentysixteen' ),

		'id'            => 'sidebar-3',

		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),

		'before_widget' => '',

		'after_widget'  => '',

		'before_title'  => '',

		'after_title'   => '',

	) );

}

add_action( 'widgets_init', 'twentysixteen_widgets_init' );



if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :

/**

 * Register Google fonts for Twenty Sixteen.

 *

 * Create your own twentysixteen_fonts_url() function to override in a child theme.

 *

 * @since Twenty Sixteen 1.0

 *

 * @return string Google fonts URL for the theme.

 */

function twentysixteen_fonts_url() {

	$fonts_url = '';

	$fonts     = array();

	$subsets   = 'latin,latin-ext';



	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {

		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';

	}



	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {

		$fonts[] = 'Montserrat:400,700';

	}



	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {

		$fonts[] = 'Inconsolata:400';

	}



	if ( $fonts ) {

		$fonts_url = add_query_arg( array(

			'family' => urlencode( implode( '|', $fonts ) ),

			'subset' => urlencode( $subsets ),

		), 'https://fonts.googleapis.com/css' );

	}



	return $fonts_url;

}

endif;



/**

 * Handles JavaScript detection.

 *

 * Adds a `js` class to the root `<html>` element when JavaScript is detected.

 *

 * @since Twenty Sixteen 1.0

 */

function twentysixteen_javascript_detection() {

	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

}

add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );



/**

 * Enqueues scripts and styles.

 *

 * @since Twenty Sixteen 1.0

 */

function twentysixteen_scripts() {

	// Add custom fonts, used in the main stylesheet.

	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );



	// Add Genericons, used in the main stylesheet.

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );



	// Theme stylesheet.

	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );



	// Load the Internet Explorer specific stylesheet.

	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );

	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );



	// Load the Internet Explorer 8 specific stylesheet.

	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );

	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );



	// Load the Internet Explorer 7 specific stylesheet.

	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );

	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );



	// Load the html5 shiv.

	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );

	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );



	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}



	if ( is_singular() && wp_attachment_is_image() ) {

		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );

	}



	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );



	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(

		'expand'   => __( 'expand child menu', 'twentysixteen' ),

		'collapse' => __( 'collapse child menu', 'twentysixteen' ),

	) );

}

add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );



/**

 * Adds custom classes to the array of body classes.

 *

 * @since Twenty Sixteen 1.0

 *

 * @param array $classes Classes for the body element.

 * @return array (Maybe) filtered body classes.

 */

function twentysixteen_body_classes( $classes ) {

	// Adds a class of custom-background-image to sites with a custom background image.

	if ( get_background_image() ) {

		$classes[] = 'custom-background-image';

	}



	// Adds a class of group-blog to sites with more than 1 published author.

	if ( is_multi_author() ) {

		$classes[] = 'group-blog';

	}



	// Adds a class of no-sidebar to sites without active sidebar.

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {

		$classes[] = 'no-sidebar';

	}



	// Adds a class of hfeed to non-singular pages.

	if ( ! is_singular() ) {

		$classes[] = 'hfeed';

	}



	return $classes;

}

add_filter( 'body_class', 'twentysixteen_body_classes' );



/**

 * Converts a HEX value to RGB.

 *

 * @since Twenty Sixteen 1.0

 *

 * @param string $color The original color, in 3- or 6-digit hexadecimal form.

 * @return array Array containing RGB (red, green, and blue) values for the given

 *               HEX code, empty array otherwise.

 */

function twentysixteen_hex2rgb( $color ) {

	$color = trim( $color, '#' );



	if ( strlen( $color ) === 3 ) {

		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );

		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );

		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );

	} else if ( strlen( $color ) === 6 ) {

		$r = hexdec( substr( $color, 0, 2 ) );

		$g = hexdec( substr( $color, 2, 2 ) );

		$b = hexdec( substr( $color, 4, 2 ) );

	} else {

		return array();

	}



	return array( 'red' => $r, 'green' => $g, 'blue' => $b );

}



/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';



/**

 * Add custom image sizes attribute to enhance responsive image functionality

 * for content images

 *

 * @since Twenty Sixteen 1.0

 *

 * @param string $sizes A source size value for use in a 'sizes' attribute.

 * @param array  $size  Image size. Accepts an array of width and height

 *                      values in pixels (in that order).

 * @return string A source size value for use in a content image 'sizes' attribute.

 */

function twentysixteen_content_image_sizes_attr( $sizes, $size ) {

	$width = $size[0];



	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';



	if ( 'page' === get_post_type() ) {

		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';

	} else {

		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';

		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';

	}



	return $sizes;

}

add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );



/**

 * Add custom image sizes attribute to enhance responsive image functionality

 * for post thumbnails

 *

 * @since Twenty Sixteen 1.0

 *

 * @param array $attr Attributes for the image markup.

 * @param int   $attachment Image attachment ID.

 * @param array $size Registered image size or flat array of height and width dimensions.

 * @return string A source size value for use in a post thumbnail 'sizes' attribute.

 */

function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

	if ( 'post-thumbnail' === $size ) {

		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';

		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';

	}

	return $attr;

}

add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );



/**

 * Modifies tag cloud widget arguments to have all tags in the widget same font size.

 *

 * @since Twenty Sixteen 1.1

 *

 * @param array $args Arguments for tag cloud widget.

 * @return array A new modified arguments.

 */

function twentysixteen_widget_tag_cloud_args( $args ) {

	$args['largest'] = 1;

	$args['smallest'] = 1;

	$args['unit'] = 'em';

	return $args;

}

add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );





/**

*

*Functions for Contact Info Post Type

*

**/

function tkblog_register_post_type(){

	$labels = array(

		'name'               => _x( 'Contact Info', 'post type general name', 'your-plugin-textdomain' ),

		'singular_name'      => _x( 'Contact Info', 'post type singular name', 'your-plugin-textdomain' ),

		'menu_name'          => _x( 'Contact Info', 'admin menu', 'your-plugin-textdomain' ),

		'name_admin_bar'     => _x( 'Contact Info', 'add new on admin bar', 'your-plugin-textdomain' ),

		'add_new'            => _x( 'Add New', 'contact', 'your-plugin-textdomain' ),

		'add_new_item'       => __( 'Add New Contact', 'your-plugin-textdomain' ),

		'new_item'           => __( 'New Contact', 'your-plugin-textdomain' ),

		'edit_item'          => __( 'Edit Contact Info', 'your-plugin-textdomain' ),

		'view_item'          => __( 'View Contact Info', 'your-plugin-textdomain' ),

		'all_items'          => __( 'Contact Info', 'your-plugin-textdomain' ),

		'search_items'       => __( 'Search Contact Info', 'your-plugin-textdomain' ),

		'parent_item_colon'  => __( 'Parent Contacts:', 'your-plugin-textdomain' ),

		'not_found'          => __( 'No contacts found.', 'your-plugin-textdomain' ),

		'not_found_in_trash' => __( 'No contacts found in Trash.', 'your-plugin-textdomain' )

	);



	$args = array(

		'labels'             => $labels,

        'description'        => __( 'Description.', 'your-plugin-textdomain' ),

		'public'             => true,

		'publicly_queryable' => true,

		'show_ui'            => true,

		'show_in_menu'       => true,

		'menu_icon'          =>'dashicons-phone',

		'query_var'          => true,

		'rewrite'            => array( 'slug' => 'contact' ),

		'capability_type'    => 'post',

		'has_archive'        => true,

		'hierarchical'       => false,

		'menu_position'      => null,

		'supports'           => array( 'title')

	);

	register_post_type('contact',$args);

}

add_action('init','tkblog_register_post_type');



function add_custom_meta_boxes(){

	add_meta_box('tkblog_meta','Contact Info','tkblog_meta_callback','contact','normal','core');

}

add_action('add_meta_boxes','add_custom_meta_boxes');



function tkblog_meta_callback($post){

	global $post;

	 wp_nonce_field(basename(__FILE__),'tkblog_contact_nonce');

	 $tkblog_stored_data = get_post_meta($post->ID);

	?>

  <div>

    <div class="meta-row">

     <div class="meta-th">

      <label for="contact-add">Office Address</label>

     </div>

     <div class="meta-td">

      <?php $content = get_post_meta($post->ID,'office-address',true);

      $editor= 'office-address';

      $settings = array('textarea_rows'=>8,'media_buttons'=>false);

      wp_editor($content,$editor,$settings);

      ?>

      

     </div>

     <div class="meta-th">

      <label for="contact-phone">Phone</label>

     </div>

     <div class="meta-td">

      <input type="text" name="phone" id="phone" value="<?php if(!empty($tkblog_stored_data['phone'])) echo $tkblog_stored_data['phone'][0];?>" /> 

     </div>

     <div class="meta-th">

      <label for="contact-email">Email</label>

     </div>

     <div class="meta-td">

      <input type="text" name="email" id="email" value="<?php if(!empty($tkblog_stored_data['email'])) echo $tkblog_stored_data['email'][0];?>"/> 

     </div>

    </div>

  </div>

<?php

 } function save_contact_meta($post_id) {



    



    if ( isset( $_POST['office-address'] ) ) {

        update_post_meta( $post_id, 'office-address', $_POST['office-address']);

    }



    if ( isset( $_POST['phone'] ) ) {

        update_post_meta( $post_id, 'phone', sanitize_text_field( $_POST['phone'] ) );

    }



    // Checkboxes are present if checked, absent if not.

    if ( isset( $_POST['email'] ) ) {

        update_post_meta( $post_id, 'email', sanitize_text_field( $_POST['email'] ) );

   }

}

add_action( 'save_post', 'save_contact_meta');



/**

*

*Functions for Social Media Post Type

*

**/

function tkblog_register_post_type_social(){

	$labels = array(

		'name'               => _x( 'Social Media', 'post type general name', 'your-plugin-textdomain' ),

		'singular_name'      => _x( 'Social Media', 'post type singular name', 'your-plugin-textdomain' ),

		'menu_name'          => _x( 'Social Media', 'admin menu', 'your-plugin-textdomain' ),

		'name_admin_bar'     => _x( 'Social Media', 'add new on admin bar', 'your-plugin-textdomain' ),

		'add_new'            => _x( 'Add New', 'social', 'your-plugin-textdomain' ),

		'add_new_item'       => __( 'Add New Social Media', 'your-plugin-textdomain' ),

		'new_item'           => __( 'New Social Media', 'your-plugin-textdomain' ),

		'edit_item'          => __( 'Edit Social Media', 'your-plugin-textdomain' ),

		'view_item'          => __( 'View Social Media', 'your-plugin-textdomain' ),

		'all_items'          => __( 'All Social Media', 'your-plugin-textdomain' ),

		'search_items'       => __( 'Search Social Media', 'your-plugin-textdomain' ),

		'parent_item_colon'  => __( 'Parent Social Media:', 'your-plugin-textdomain' ),

		'not_found'          => __( 'No social medias found.', 'your-plugin-textdomain' ),

		'not_found_in_trash' => __( 'No social medias found in Trash.', 'your-plugin-textdomain' )

	);



	$args = array(

		'labels'             => $labels,

        'description'        => __( 'Description.', 'your-plugin-textdomain' ),

		'public'             => true,

		'publicly_queryable' => true,

		'show_ui'            => true,

		'show_in_menu'       => true,

		'menu_icon'          =>'dashicons-networking',

		'query_var'          => true,

		'rewrite'            => array( 'slug' => 'social' ),

		'capability_type'    => 'post',

		'has_archive'        => true,

		'hierarchical'       => false,

		'menu_position'      => null,

		'supports'           => array( 'title')

	);

	register_post_type('social',$args);

}

add_action('init','tkblog_register_post_type_social');



function add_custom_meta_boxes_social(){

	add_meta_box('tkblog_meta_social','Social Media','tkblog_meta_callback_social','social','normal','core');

}

add_action('add_meta_boxes','add_custom_meta_boxes_social');



function tkblog_meta_callback_social($post){

	 global $post;

	 wp_nonce_field(basename(__FILE__),'tkblog_social_nonce');

	 $tkblog_stored_data = get_post_meta($post->ID);

	?>

  <div>

    <div class="meta-row">

     

     <div class="meta-th">

      <label for="contact-phone">Social Media Icon Name</label>

     </div>

     <div class="meta-td">

      <input type="text" name="icon-name" id="icon-name" value="<?php if(!empty($tkblog_stored_data['icon-name'])) echo $tkblog_stored_data['icon-name'][0];?>" /> 

     </div>

     <div class="meta-th">

      <label for="contact-email">Social Media Url</label>

     </div>

     <div class="meta-td">

      <input type="text" name="media-url" id="media-url" value="<?php if(!empty($tkblog_stored_data['media-url'])) echo $tkblog_stored_data['media-url'][0];?>"/> 

     </div>

    </div>

  </div>

<?php

 } function save_social_meta($post_id) {



    if ( isset( $_POST['icon-name'] ) ) {

        update_post_meta( $post_id, 'icon-name', sanitize_text_field( $_POST['icon-name'] ) );

    }



    // Checkboxes are present if checked, absent if not.

    if ( isset( $_POST['media-url'] ) ) {

        update_post_meta( $post_id, 'media-url', sanitize_text_field( $_POST['media-url'] ) );

   }

}

add_action( 'save_post', 'save_social_meta');



/**/



function tkblog_set_post_views($postID) {



    $count_key = 'wpb_post_views_count';



    $count = get_post_meta($postID, $count_key, true);



    if($count==''){



        $count = 0;



        delete_post_meta($postID, $count_key);



        add_post_meta($postID, $count_key, '0');



    }else{



        $count++;



        update_post_meta($postID, $count_key, $count);



    }



}



//To keep the count accurate, lets get rid of prefetching



remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



/*function tkblog_track_post_views ($post_id) {



    if ( !is_single() ) return;

    if ( empty ( $post_id) ) {



        global $post;



        $post_id = $post->ID;   



    }



    tkblog_set_post_views($post_id);



}



add_action( 'wp_head', 'tkblog_track_post_views');*/







