<?php
/**
 * Knowledgebase links.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.9.0
 * @package    RankMath
 * @subpackage RankMath\Core
 * @author     MyThemeShop <admin@mythemeshop.com>
 */

namespace RankMath;

use MyThemeShop\Helpers\Arr;

defined( 'ABSPATH' ) || exit;

/**
 * KB class.
 */
class KB {

	/**
	 * Hold links.
	 *
	 * @var array
	 */
	private $links = array();

	/**
	 * Echo the link.
	 *
	 * @param string $id Id of the link to get.
	 */
	public static function the( $id ) {
		echo self::get( $id );
	}

	/**
	 * Return the link.
	 *
	 * @param  string $id Id of the link to get.
	 * @return string
	 */
	public static function get( $id ) {
		static $manager = null;

		if ( null === $manager ) {
			$manager = new self;
			$manager->register();
		}

		return isset( $manager->links[ $id ] ) ? $manager->links[ $id ] : '#';
	}

	/**
	 * Register links.
	 */
	private function register() {
		$links       = $this->get_links();
		$is_tracking = rank_math()->settings->get( 'general.usage_tracking' );

		foreach ( $links as $id => $link ) {

			// If not array.
			if ( ! is_array( $link ) ) {
				$this->links[ $id ] = $link;
				continue;
			}

			$this->links[ $id ] = $is_tracking ? $link[0] : $link[1];
		}
	}

	/**
	 * Get links.
	 *
	 * @return array
	 */
	private function get_links() {
		// phpcs:disable
		return array(
			'logo' => array(
				'https://link.mythemeshop.com/rmlogo',
				'https://rankmath.com/wordpress/plugin/seo-suite/',
			),
			'amp-plugin' => array(
				'https://link.mythemeshop.com/q0YWyA3b',
				'https://wordpress.org/plugins/amp/'
			),
			'amp-wp' => array(
				'https://link.mythemeshop.com/nG9VLJNQ',
				'https://wordpress.org/plugins/accelerated-mobile-pages/'
			),
			'amp-ninja' => array(
				'https://link.mythemeshop.com/ilPg_26y',
				'https://codecanyon.net/item/wp-amp-ninja-accelerated-mobile-pages-for-wordpress/17626811/'
			),
			'amp-weeblramp' => array(
				'https://link.mythemeshop.com/EAfd0Ycp',
				'https://wordpress.org/plugins/weeblramp/'
			),
			'amp-woocommerce' => array(
				'https://link.mythemeshop.com/CFNkelx6',
				'https://ampforwp.com/woocommerce/'
			),
			'wp-amp' => array(
				'https://link.mythemeshop.com/M7YeWUcV',
				'https://codecanyon.net/item/wp-amp-accelerated-mobile-pages-for-wordpress-and-woocommerce/16278608'
			),
			'how-to-setup' => 'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/how-to-setup/',
			'rm-privacy' => array(
				'https://link.mythemeshop.com/rm-privacy',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/privacy-policy/'
			),
			'free-account' => array(
				'https://link.mythemeshop.com/freeaccount',
				'https://mythemeshop.com/'
			),
			'seo-import' => array(
				'https://link.mythemeshop.com/HkUT4vCT',
				'https://mythemeshop.com/kb/rank-math-seo-plugin/how-to-setup/'
			),
			'404-monitor' => array(
				'https://link.mythemeshop.com/5NupfnaF',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/monitor-404-errors/'
			),
			'redirections' => array(
				'https://link.mythemeshop.com/t7cpuSEY',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/setting-up-redirections/'
			),
			'local-seo' => array(
				'https://link.mythemeshop.com/localseohelp',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/how-to-setup/#local_business_setup'
			),
			'rm-support' => array(
				'https://link.mythemeshop.com/supporttickethelp',
				'https://community.mythemeshop.com/forum/23-rank-math-free/'
			),
			'rm-requirements' => array(
				'https://link.mythemeshop.com/oR1XRO5H',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/requirements/'
			),
			'seo-tweaks' => array(
				'https://link.mythemeshop.com/optimization',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/how-to-setup/#Optimization'
			),
			'review-rm' => array(
				'https://link.mythemeshop.com/reviewrankmath',
				'https://wordpress.org/support/plugin/seo-by-rank-math/reviews/'
			),
			'score-100' => array(
				'https://link.mythemeshop.com/score-100',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/score-100-in-tests/'
			),
			'fb-group' => array(
				'https://link.mythemeshop.com/fbgrouprankmath',
				'https://www.facebook.com/groups/rankmathseopluginwordpress/'
			),
			'rm-kb' => array(
				'https://link.mythemeshop.com/rm-kb',
				'https://mythemeshop.com/kb/product/wordpress-seo-plugin-rank-math/'
			),
			'wp-error-fixes' => array(
				'https://link.mythemeshop.com/wp-error-fixes',
				'https://mythemeshop.com/wordpress-errors-fixes/'
			),
			'mts-forum' => array(
				'https://link.mythemeshop.com/mts-forum',
				'https://community.mythemeshop.com/forum/23-rank-math-free/'
			),
			'search-console' => array(
				'https://link.mythemeshop.com/set-up',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/how-to-setup/#Google_Search_Console'
			),
			'configure-sitemaps' => array(
				'https://link.mythemeshop.com/sitemaps',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/configure-sitemaps/'
			),
			'your-site' => array(
				'https://link.mythemeshop.com/1yPR14FK',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/how-to-setup/#Selecting_Your_Website_Type'
			),
			'search-console' => array(
				'https://link.mythemeshop.com/7C4G9RQB',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/search-console/'
			),
			'remove-category-base' => array(
				'http://link.mythemeshop.com/_HyUwGrq',
				'https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/how-to-setup/#strip-category-base'
			),
			'tw-link' => array(
				'https://link.mythemeshop.com/sYmtFD3u',
				'https://rankmath.com/wordpress/plugin/seo-suite/'
			),
			'fb-link' => array(
				'https://link.mythemeshop.com/w74ifiZ1',
				'https://rankmath.com/wordpress/plugin/seo-suite/'
			),
		);
		// phpcs:enable
	}
}
