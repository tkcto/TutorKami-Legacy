<?php
/**
 * An interface for registering hooks with WordPress.
 *
 * @since      0.9.0
 * @package    RankMath
 * @subpackage RankMath\Core
 * @author     MyThemeShop <admin@mythemeshop.com>
 */

namespace RankMath;

defined( 'ABSPATH' ) || exit;

/**
 * Runner.
 */
interface Runner {

	/**
	 * Register all hooks to WordPress
	 *
	 * @return void
	 */
	public function hooks();
}
