<?php
/**
 * The Snippet Interface
 *
 * @since      1.0.13
 * @package    RankMath
 * @subpackage RankMath\RichSnippet
 * @author     MyThemeShop <admin@mythemeshop.com>
 */

namespace RankMath\RichSnippet;

defined( 'ABSPATH' ) || exit;

/**
 * Snippet interface.
 */
interface Snippet {

	/**
	 * Process snippet data
	 *
	 * @param array  $data   Array of json-ld data.
	 * @param JsonLD $jsonld Instance of JsonLD.
	 *
	 * @return array
	 */
	public function process( $data, $jsonld );
}
