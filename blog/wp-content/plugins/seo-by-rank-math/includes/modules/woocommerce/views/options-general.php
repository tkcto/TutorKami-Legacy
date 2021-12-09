<?php
/**
 * WooCommerce general settings.
 *
 * @package    RankMath
 * @subpackage RankMath\WooCommerce
 */

$cmb->add_field( array(
	'id'      => 'wc_remove_product_base',
	'type'    => 'switch',
	'name'    => esc_html__( 'Remove base', 'rank-math' ),
	'desc'    => esc_html__( 'Remove prefix from product URL.', 'rank-math' ) .
		'<br><code>' . esc_html__( 'default: /shop/accessories/action-figures/acme/ - changed: /accessories/action-figures/acme/', 'rank-math' ) . '</code>',
	'default' => 'off',
) );

$cmb->add_field( array(
	'id'      => 'wc_remove_category_base',
	'type'    => 'switch',
	'name'    => esc_html__( 'Remove category base', 'rank-math' ),
	'desc'    => esc_html__( 'Remove prefix from category URL.', 'rank-math' ) .
		'<br><code>' . esc_html__( 'default: /product-category/accessories/action-figures/ - changed: /accessories/action-figures/', 'rank-math' ) . '</code>',
	'default' => 'off',
) );

$cmb->add_field( array(
	'id'      => 'wc_remove_category_parent_slugs',
	'type'    => 'switch',
	'name'    => esc_html__( ' Remove parent slugs', 'rank-math' ),
	'desc'    => esc_html__( 'Remove parent slugs from category URL.', 'rank-math' ) .
		'<br><code>' . esc_html__( 'default: /product-category/accessories/action-figures/ - changed: /product-category/action-figures/', 'rank-math' ) . '</code>',
	'default' => 'off',
) );

$cmb->add_field( array(
	'id'      => 'wc_remove_generator',
	'type'    => 'switch',
	'name'    => esc_html__( 'Remove Generator Tag', 'rank-math' ),
	'desc'    => esc_html__( 'Remove WooCommerce generator tag from the source code.', 'rank-math' ),
	'default' => 'on',
) );
