<?php
/**
 * Metabox - Rich Snippet Tab
 *
 * @package    RankMath
 * @subpackage RankMath\RichSnippet
 */

use RankMath\Helper;
use MyThemeShop\Helpers\WordPress;

if ( ! Helper::has_cap( 'onpage_snippet' ) ) {
	return;
}

$post_type = WordPress::get_post_type();

if ( ( class_exists( 'WooCommerce' ) && 'product' === $post_type ) || ( class_exists( 'Easy_Digital_Downloads' ) && 'download' === $post_type ) ) {

	$cmb->add_field([
		'id'      => 'rank_math_woocommerce_notice',
		'type'    => 'notice',
		'what'    => 'info',
		'content' => '<span class="dashicons dashicons-yes"></span> ' . esc_html__( 'Rank Math automatically inserts additional Rich Snippet meta data for WooCommerce products. You can set the Rich Snippet Type to "None" to disable this feature and just use the default data added by WooCommerce.', 'rank-math' ),
	]);

	$cmb->add_field([
		'id'      => 'rank_math_rich_snippet',
		'type'    => 'radio_inline',
		'name'    => esc_html__( 'Rich Snippet Type', 'rank-math' ),
		/* translators: link to title setting screen */
		'desc'    => sprintf( wp_kses_post( __( 'Rich Snippets help you stand out in SERPs. <a href="%s" target="_blank">Learn more</a>.', 'rank-math' ) ), 'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/rich-snippets/?utm_source=Rank+Math+Plugin+Options&utm_medium=LP+CPC&utm_content=Rank+Math+KB&utm_campaign=Rank+Math' ),
		'options' => [
			'off'     => esc_html__( 'None', 'rank-math' ),
			'product' => esc_html__( 'Product', 'rank-math' ),
		],
		'default' => Helper::get_settings( "titles.pt_{$post_type}_default_rich_snippet" ),
	]);

	return;
}

$cmb->add_field([
	'id'      => 'rank_math_rich_snippet',
	'type'    => 'select',
	'name'    => esc_html__( 'Rich Snippet Type', 'rank-math' ),
	/* translators: link to title setting screen */
	'desc'    => sprintf( wp_kses_post( __( 'Rich Snippets help you stand out in SERPs. <a href="%s" target="_blank">Learn more</a>.', 'rank-math' ) ), 'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/rich-snippets/?utm_source=Rank+Math+Plugin+Options&utm_medium=LP+CPC&utm_content=Rank+Math+KB&utm_campaign=Rank+Math' ),
	'options' => Helper::choices_rich_snippet_types( esc_html__( 'None', 'rank-math' ) ),
	'default' => Helper::get_settings( "titles.pt_{$post_type}_default_rich_snippet" ),
]);

$headline = Helper::get_settings( "titles.pt_{$post_type}_default_snippet_name" );
$headline = $headline ? $headline : '';

// Common fields.
$cmb->add_field([
	'id'         => 'rank_math_snippet_name',
	'type'       => 'text',
	'name'       => esc_html__( 'Headline', 'rank-math' ),
	'dep'        => [ [ 'rank_math_rich_snippet', 'off', '!=' ] ],
	'attributes' => [ 'placeholder' => $headline ],
	'classes'    => 'rank-math-supports-variables',
]);

$description = Helper::get_settings( "titles.pt_{$post_type}_default_snippet_desc" );
$description = $description ? $description : '';

$cmb->add_field([
	'id'         => 'rank_math_snippet_desc',
	'type'       => 'textarea',
	'name'       => esc_html__( 'Description', 'rank-math' ),
	'attributes' => [
		'rows'            => 3,
		'data-autoresize' => true,
		'placeholder'     => $description,
	],
	'classes'    => 'rank-math-supports-variables',
	'dep'        => [ [ 'rank_math_rich_snippet', 'off,book,local', '!=' ] ],
]);

$cmb->add_field([
	'id'         => 'rank_math_snippet_url',
	'type'       => 'text_url',
	'name'       => esc_html__( 'Url', 'rank-math' ),
	'attributes' => [
		'rows'            => 3,
		'data-autoresize' => true,
	],
	'dep'        => [ [ 'rank_math_rich_snippet', 'book,event,local,music' ] ],
]);

$cmb->add_field([
	'id'         => 'rank_math_snippet_author',
	'type'       => 'text',
	'name'       => esc_html__( 'Author', 'rank-math' ),
	'attributes' => [
		'rows'            => 3,
		'data-autoresize' => true,
	],
	'dep'        => [ [ 'rank_math_rich_snippet', 'book' ] ],
]);

include_once 'article.php';
include_once 'book.php';
include_once 'course.php';
include_once 'event.php';
include_once 'job-posting.php';
include_once 'local.php';
include_once 'music.php';
include_once 'product.php';
include_once 'recipe.php';
include_once 'restaurant.php';
include_once 'video.php';
include_once 'person.php';
include_once 'review.php';
include_once 'software.php';
include_once 'service.php';
