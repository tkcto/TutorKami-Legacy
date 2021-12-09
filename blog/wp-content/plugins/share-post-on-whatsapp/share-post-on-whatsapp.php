<?php
/**
 * Plugin Name: Share Post On WhatsApp
 * Plugin URI: https://aftabhusain.wordpress.com/
 * Description: Share posts/page/custom post to whatsapp
 * Version: 1.0.0
 * Author: Aftab Husain
 * Author URI: https://aftabhusain.wordpress.com/
 * License: GPLv2
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
define('SPOW_REGISTRATION_PAGE_DIRECTORY', plugin_dir_path(__FILE__).'includes/');

// New menu submenu for plugin options in Settings menu
add_action('admin_menu', 'spow_options_menu');
function spow_options_menu() {
	add_options_page('Share on WhatsApp', 'Share Post on WhatsApp', 'manage_options', 'settings_share_post_on_whatsapp', 'spow_plugin_pages');
	
}

function spow_plugin_pages() {

   $itm = SPOW_REGISTRATION_PAGE_DIRECTORY.$_GET["page"].'.php';
   include($itm);
}
/*<div class='share-on-whsp'>Share on: </div>*/

function spow_add_share_to_whatsapp_icons($content)
{
    
    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url); 
    if(get_option("share_post_on_whatsapp") == 'show')
    {   
        $html = "<div class='share-to-whatsapp-wrapper'>";
        $html = $html . "<a data-text='".$post->post_title."' data-link='" . $url . "' class='whatsapp-button whatsapp-share'>WhatsApp</a>";
		
   }

    $html = $html . "<div class='clear '></div></div>";	

    //return $content = $content . $html;
    return $html;
}

//add_filter("the_content", "spow_add_share_to_whatsapp_icons");
add_shortcode('whatsapp-share','spow_add_share_to_whatsapp_icons');
function spow_share_to_whatsapp_style() 
{
	wp_enqueue_script('jquery');
    wp_register_style("share-on-whatsapp-style-file", plugin_dir_url(__FILE__) . "includes/whatsappshare.css");
    wp_enqueue_style("share-on-whatsapp-style-file");
	wp_register_script("share-on-whatsapp-script-file", plugin_dir_url(__FILE__) . "includes/whatsappshare.js");
    wp_enqueue_script("share-on-whatsapp-script-file");
}	

add_action("wp_enqueue_scripts", "spow_share_to_whatsapp_style");
?>
