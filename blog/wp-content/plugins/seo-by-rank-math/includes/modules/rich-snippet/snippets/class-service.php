<?php
/**
 * The Service Class
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
 * Service class.
 */
class Service implements Snippet {

	/**
	 * Service rich snippet.
	 *
	 * @param array  $data   Array of json-ld data.
	 * @param JsonLD $jsonld JsonLD Instance.
	 *
	 * @return array
	 */
	public function process( $data, $jsonld ) {
		$entity = [
			'@context'        => 'https://schema.org',
			'@type'           => 'Service',
			'name'            => $jsonld->parts['title'],
			'description'     => $jsonld->parts['desc'],
			'serviceType'     => Helper::get_post_meta( 'snippet_service_type' ),
			'offers'          => [
				'@type'         => 'Offer',
				'price'         => Helper::get_post_meta( 'snippet_service_price' ),
				'priceCurrency' => Helper::get_post_meta( 'snippet_service_price_currency' ),
			],
			'aggregateRating' => [
				'@type'       => 'AggregateRating',
				'ratingValue' => Helper::get_post_meta( 'snippet_service_rating_value' ),
				'ratingCount' => Helper::get_post_meta( 'snippet_service_rating_count' ),
			],
		];

		return $entity;
	}
}
