<?php
/**
 * The Software Class
 *
 * @since      1.0.13
 * @package    RankMath
 * @subpackage RankMath\RichSnippet
 * @author     MyThemeShop <admin@mythemeshop.com>
 */

namespace RankMath\RichSnippet;

use RankMath\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Software class.
 */
class Software implements Snippet {

	/**
	 * Software rich snippet.
	 *
	 * @param array  $data   Array of json-ld data.
	 * @param JsonLD $jsonld JsonLD Instance.
	 *
	 * @return array
	 */
	public function process( $data, $jsonld ) {
		$entity = [
			'@context'            => 'https://schema.org',
			'@type'               => 'SoftwareApplication',
			'name'                => $jsonld->parts['title'],
			'description'         => $jsonld->parts['desc'],
			'operatingSystem'     => Helper::get_post_meta( 'snippet_software_operating_system' ),
			'applicationCategory' => Helper::get_post_meta( 'snippet_software_application_category' ),
			'offers'              => [
				'@type'         => 'Offer',
				'price'         => Helper::get_post_meta( 'snippet_software_price' ),
				'priceCurrency' => Helper::get_post_meta( 'snippet_software_price_currency' ),
			],
			'aggregateRating'     => [
				'@type'       => 'AggregateRating',
				'ratingValue' => Helper::get_post_meta( 'snippet_software_rating_value' ),
				'ratingCount' => Helper::get_post_meta( 'snippet_software_rating_count' ),
			],
		];

		return $entity;
	}
}