<?php
/**
 * The Article Class
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
 * Article class.
 */
class Article implements Snippet {

	/**
	 * Article rich snippet.
	 *
	 * @param array  $data   Array of json-ld data.
	 * @param JsonLD $jsonld JsonLD Instance.
	 *
	 * @return array
	 */
	public function process( $data, $jsonld ) {
		$entity = [
			'@context'         => 'https://schema.org',
			'@type'            => Helper::get_post_meta( 'snippet_article_type' ),
			'headline'         => $jsonld->parts['title'],
			'description'      => $jsonld->parts['desc'],
			'datePublished'    => $jsonld->parts['published'],
			'dateModified'     => $jsonld->parts['modified'],
			'publisher'        => $jsonld->get_publisher( $data ),
			'mainEntityOfPage' => [
				'@type' => 'WebPage',
				'@id'   => $jsonld->parts['canonical'],
			],
			'author'           => [
				'@type' => 'Person',
				'name'  => $jsonld->parts['author'],
			],
		];

		if ( isset( $data['Organization'] ) ) {
			unset( $data['Organization'] );
		}

		return $entity;
	}
}