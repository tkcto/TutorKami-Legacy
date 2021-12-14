<?php
/**
 * The authors settings.
 *
 * @package    RankMath
 * @subpackage RankMath\Settings
 */

$dep = array( array( 'disable_author_archives', 'off' ) );

$cmb->add_field( array(
	'id'      => 'disable_author_archives',
	'type'    => 'switch',
	'name'    => esc_html__( 'Author Archives', 'rank-math' ),
	'desc'    => esc_html__( 'Redirect author archives to homepage. Useful for single-author blogs, where the author archive shows the same posts as the homepage/blog page. Alternatively, you can set the author archives to noindex.', 'rank-math' ),
	'options' => array(
		'on'  => esc_html__( 'Disabled', 'rank-math' ),
		'off' => esc_html__( 'Enabled', 'rank-math' ),
	),
	'default' => $this->do_filter( 'settings/titles/disable_author_archives', 'on' ),
) );

$cmb->add_field( array(
	'id'      => 'url_author_base',
	'type'    => 'text',
	'name'    => esc_html__( 'Author Base', 'rank-math' ),
	'desc'    => wp_kses_post( __( 'Change the <code>/author/</code> part in author archive URLs.', 'rank-math' ) ),
	'default' => 'author',
	'dep'     => $dep,
) );

$cmb->add_field( array(
	'id'      => 'noindex_author_archive',
	'type'    => 'switch',
	'name'    => esc_html__( 'Noindex Author Archives', 'rank-math' ),
	'desc'    => esc_html__( 'Prevent author archive pages from getting indexed by search engines. Useful for single-author blogs, where the author archive shows the same posts as the homepage/blog page.', 'rank-math' ),
	'default' => 'off',
	'dep'     => $dep,
) );

$cmb->add_field( array(
	'id'              => 'author_archive_title',
	'type'            => 'text',
	'name'            => esc_html__( 'Author Archive Title', 'rank-math' ),
	'desc'            => esc_html__( 'Title tag on author archives. SEO options for specific authors can be set with the meta box available in the user profiles.', 'rank-math' ),
	'classes'         => 'rank-math-supports-variables rank-math-title',
	'default'         => '%name% %sep% %sitename% %page%',
	'dep'             => $dep,
	'sanitization_cb' => false,
) );

$cmb->add_field( array(
	'id'              => 'author_archive_description',
	'type'            => 'textarea_small',
	'name'            => esc_html__( 'Author Archive Description', 'rank-math' ),
	'desc'            => esc_html__( 'Author archive meta description. SEO options for specific author archives can be set with the meta box in the user profiles.', 'rank-math' ),
	'classes'         => 'rank-math-supports-variables rank-math-description',
	'dep'             => $dep,
	'sanitization_cb' => false,
) );

$cmb->add_field( array(
	'id'      => 'author_add_meta_box',
	'type'    => 'switch',
	'name'    => esc_html__( 'Add SEO Meta Box for Users', 'rank-math' ),
	'desc'    => esc_html__( 'Add SEO Meta Box for user profile pages. Access to the Meta Box can be fine tuned with code, using a special filter hook.', 'rank-math' ),
	'default' => 'on',
	'dep'     => $dep,
) );