<?php
/**
 * The Sitemap rewrite setup and handling functionality.
 *
 * @since      0.9.0
 * @package    RankMath
 * @subpackage RankMath\Sitemap
 * @author     MyThemeShop <admin@mythemeshop.com>
 */

namespace RankMath\Sitemap;

use RankMath\Traits\Hooker;

defined( 'ABSPATH' ) || exit;

/**
 * Router class
 */
class Router {

	use Hooker;

	/**
	 * The Constructor.
	 */
	public function __construct() {
		$this->action( 'init', 'init', 1 );
		$this->filter( 'redirect_canonical', 'redirect_canonical' );
		$this->action( 'parse_query', 'request_sitemap', 1 );
		$this->action( 'template_redirect', 'template_redirect', 0 );
	}

	/**
	 * Sets up rewrite rules.
	 */
	public function init() {
		global $wp;

		$wp->add_query_var( 'sitemap' );
		$wp->add_query_var( 'sitemap_n' );
		$wp->add_query_var( 'xsl' );

		add_rewrite_rule( 'sitemap_index\.xml$', 'index.php?sitemap=1', 'top' );
		add_rewrite_rule( '([^/]+?)-sitemap([0-9]+)?\.xml$', 'index.php?sitemap=$matches[1]&sitemap_n=$matches[2]', 'top' );
		add_rewrite_rule( '([a-z]+)?-?sitemap\.xsl$', 'index.php?xsl=$matches[1]', 'top' );
	}

	/**
	 * Stop trailing slashes on sitemap.xml URLs.
	 *
	 * @param  string $redirect The redirect URL currently determined.
	 * @return boolean|string $redirect
	 */
	public function redirect_canonical( $redirect ) {
		return ( get_query_var( 'sitemap' ) || get_query_var( 'xsl' ) ) ? false : $redirect;
	}

	/**
	 * Serves sitemap when needed using correct sitemap module
	 *
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 */
	public function request_sitemap( $query ) {
		if ( ! $query->is_main_query() ) {
			return;
		}

		$xsl = get_query_var( 'xsl' );
		if ( ! empty( $xsl ) ) {
			$stylesheet = new Stylesheet;
			$stylesheet->output( $xsl );
			return;
		}

		$type = get_query_var( 'sitemap' );
		if ( empty( $type ) ) {
			return;
		}

		new Sitemap_XML( $type );
	}

	/**
	 * Redirects sitemap.xml to sitemap_index.xml.
	 */
	public function template_redirect() {
		if ( ! $this->needs_sitemap_index_redirect() ) {
			return;
		}

		header( 'X-Redirect-By: Rank Math' );
		wp_redirect( home_url( '/sitemap_index.xml' ), 301 );
		exit;
	}

	/**
	 * Checks whether the current request needs to be redirected to sitemap_index.xml.
	 *
	 * @return bool True if redirect is needed, false otherwise.
	 */
	private function needs_sitemap_index_redirect() {
		global $wp_query;

		$protocol = 'http://';
		if ( ! empty( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ) {
			$protocol = 'https://';
		}

		$path   = sanitize_text_field( $_SERVER['REQUEST_URI'] );
		$domain = sanitize_text_field( $_SERVER['SERVER_NAME'] );

		// Due to different environment configurations, we need to check both SERVER_NAME and HTTP_HOST.
		$check_urls = array( $protocol . $domain . $path );
		if ( ! empty( $_SERVER['HTTP_HOST'] ) ) {
			$check_urls[] = $protocol . sanitize_text_field( $_SERVER['HTTP_HOST'] ) . $path;
		}

		return $wp_query->is_404 && in_array( home_url( '/sitemap.xml' ), $check_urls, true );
	}

	/**
	 * Create base URL for the sitemap.
	 *
	 * @param  string $page Page to append to the base URL.
	 * @return string base URL (incl page)
	 */
	public static function get_base_url( $page ) {
		global $wp_rewrite;

		$base = $wp_rewrite->using_index_permalinks() ? $wp_rewrite->index . '/' : '/';

		/**
		 * Filter the base URL of the sitemaps
		 *
		 * @param string $base The string that should be added to home_url() to make the full base URL.
		 */
		$base = apply_filters( 'rank_math/sitemap/base_url', $base );

		if ( ! $wp_rewrite->using_permalinks() ) {
			if ( 'sitemap_index.xml' === $page ) {
				$page = '?sitemap=1';
			} else {
				$page = \preg_replace( '/([^\/]+?)-sitemap([0-9]+)?\.xml$/', '?sitemap=$1&sitemap_n=$2', $page );
				$page = \preg_replace( '/([a-z]+)?-?sitemap\.xsl$/', '?xsl=$1', $page );
			}
		}

		return home_url( $base . $page );
	}
}
