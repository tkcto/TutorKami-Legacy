<?php
/**
 * The Shortcodes of the plugin.
 *
 * @since      0.9.0
 * @package    RankMath
 * @subpackage RankMath\Frontend
 * @author     MyThemeShop <admin@mythemeshop.com>
 */

namespace RankMath;

use RankMath\Traits\Hooker;
use RankMath\Traits\Shortcode;

defined( 'ABSPATH' ) || exit;

/**
 * Shortcodes class.
 */
class Shortcodes {

	use Hooker, Shortcode;

	/**
	 * The Constructor.
	 */
	public function __construct() {
		$this->action( 'init', 'init' );
	}

	/**
	 * Initialize.
	 */
	public function init() {

		// Remove Yoast shortcodes.
		$this->remove_shortcode( 'wpseo_address' );
		$this->remove_shortcode( 'wpseo_map' );
		$this->remove_shortcode( 'wpseo_opening_hours' );

		// Yoast compatibility shortcodes.
		$this->add_shortcode( 'wpseo_address', 'yoast_address' );
		$this->add_shortcode( 'wpseo_map', 'yoast_map' );
		$this->add_shortcode( 'wpseo_opening_hours', 'yoast_opening_hours' );

		// Contact shortcode.
		$this->add_shortcode( 'rank_math_contact_info', 'contact_info' );

		// Review shortcode.
		$this->add_shortcode( 'rank_math_review_snippet', 'review_snippet' );
	}

	/**
	 * Contact info shortcode, displays nicely formatted contact informations.
	 *
	 * @param  array $args Optional. Shortcode arguments - currently only 'show'
	 *                     parameter, which is a comma-separated list of elements to show.
	 * @return string Shortcode output.
	 */
	public function contact_info( $args ) {
		$args = shortcode_atts( array(
			'show'  => 'all',
			'class' => '',
		), $args, 'contact-info' );

		$allowed = array( 'address', 'hours', 'phone', 'social', 'map' );
		if ( 'person' === Helper::get_settings( 'titles.knowledgegraph_type' ) ) {
			$allowed = array( 'address' );
		}

		if ( ! empty( $args['show'] ) && 'all' !== $args['show'] ) {
			$allowed = array_intersect( array_map( 'trim', explode( ',', $args['show'] ) ), $allowed );
		}

		wp_enqueue_style( 'rank-math-contact-info', rank_math()->assets() . 'css/rank-math-contact-info.css', null, rank_math()->version );

		ob_start();
		echo '<div class="' . $this->get_contact_classes( $allowed, $args['class'] ) . '">';

		foreach ( $allowed as $element ) {
			$method = 'display_' . $element;
			if ( method_exists( $this, $method ) ) {
				echo '<div class="rank-math-contact-section rank-math-contact-' . $element . '">';
				$this->$method();
				echo '</div>';
			}
		}

		echo '</div>';
		echo '<div class="clear"></div>';

		return ob_get_clean();
	}

	/**
	 * Get contact info container classes.
	 *
	 * @param  array $allowed     Allowed elements.
	 * @param  array $extra_class Shortcode arguments.
	 * @return string
	 */
	private function get_contact_classes( $allowed, $extra_class ) {
		$classes = array( 'rank-math-contact-info', $extra_class );
		foreach ( $allowed as $elem ) {
			$classes[] = sanitize_html_class( 'show-' . $elem );
		}
		if ( count( $allowed ) == 1 ) {
			$classes[] = sanitize_html_class( 'show-' . $elem . '-only' );
		}

		return join( ' ', array_filter( $classes ) );
	}

	/**
	 * Output address.
	 */
	private function display_address() {
		$address = Helper::get_settings( 'titles.local_address' );
		if ( false === $address ) {
			return;
		}

		$format = nl2br( Helper::get_settings( 'titles.local_address_format' ) );
		/**
		 * Allow developer to change the address part format.
		 *
		 * @param string $parts_format String format  how to output address part.
		 */
		$parts_format = $this->do_filter( 'shortcode/contact/address_parts_format', '<span class="contact-address-%1$s">%2$s</span>' );

		$hash = array(
			'streetAddress'   => 'address',
			'addressLocality' => 'locality',
			'addressRegion'   => 'region',
			'postalCode'      => 'postalcode',
			'addressCountry'  => 'country',
		);
		?>
		<label><?php esc_html_e( 'Address:', 'rank-math' ); ?></label>
		<address>
			<?php
			foreach ( $hash as $key => $tag ) {
				$value = '';
				if ( isset( $address[ $key ] ) && ! empty( $address[ $key ] ) ) {
					$value = sprintf( $parts_format, $tag, $address[ $key ] );
				}

				$format = str_replace( "{{$tag}}", $value, $format );
			}

			echo $format;
			?>
		</address>
		<?php
	}

	/**
	 * Output opening hours.
	 */
	private function display_hours() {
		$hours = Helper::get_settings( 'titles.opening_hours' );
		if ( ! isset( $hours[0]['time'] ) ) {
			return;
		}

		$combined = $this->get_hours_combined( $hours );
		$format   = Helper::get_settings( 'titles.opening_hours_format' );
		?>
		<label><?php esc_html_e( 'Hours:', 'rank-math' ); ?></label>
		<div class="rank-math-contact-hours-details">
			<?php
			foreach ( $combined as $time => $days ) {
				if ( $format ) {
					$hours = explode( '-', $time );
					$time  = date( 'g:i a', strtotime( $hours[0] ) ) . '-' . date( 'g:i a', strtotime( $hours[1] ) );
				}
				$time = str_replace( '-', ' &ndash; ', $time );

				printf(
					'<div class="rank-math-opening-hours"><span class="rank-math-opening-days">%1$s</span><span class="rank-math-opening-time">%2$s</span></div>',
					join( ', ', $days ), $time
				);
			}
			?>
		</div>
		<?php
	}

	/**
	 * Combine hours in an hour
	 *
	 * @param  array $hours Hours to combine.
	 * @return array
	 */
	private function get_hours_combined( $hours ) {
		$combined = array();

		foreach ( $hours as $hour ) {
			if ( empty( $hour['time'] ) ) {
				continue;
			}

			$combined[ trim( $hour['time'] ) ][] = $hour['day'];
		}

		return $combined;
	}

	/**
	 * Output phone numbers.
	 */
	private function display_phone() {
		$phones = Helper::get_settings( 'titles.phone_numbers' );
		if ( ! isset( $phones[0]['number'] ) ) {
			return;
		}

		foreach ( $phones as $phone ) :
			$number = esc_html( $phone['number'] );
			?>
			<div class="rank-math-phone-number type-<?php echo sanitize_html_class( $phone['type'] ); ?>">
				<label><?php echo ucwords( $phone['type'] ); ?>:</label> <span><?php echo isset( $phone['number'] ) ? '<a href="tel://' . $number . '">' . $number . '</a>' : ''; ?></span>
			</div>
			<?php
		endforeach;
	}

	/**
	 * Output social identities.
	 */
	private function display_social() {
		$networks = array(
			'facebook'      => 'Facebook',
			'twitter'       => 'Twitter',
			'gplus'         => 'Google+',
			'google_places' => 'Google Places',
			'yelp'          => 'Yelp',
			'foursquare'    => 'FourSquare',
			'flickr'        => 'Flickr',
			'reddit'        => 'Reddit',
			'linkedin'      => 'LinkedIn',
			'instagram'     => 'Instagram',
			'youtube'       => 'YouTube',
			'pinterest'     => 'Pinterest',
			'soundcloud'    => 'SoundClound',
			'tumblr'        => 'Tumblr',
			'myspace'       => 'MySpace',
		);
		?>
		<div class="rank-math-social-networks">
			<?php
			foreach ( $networks as $id => $label ) :
				if ( $url = Helper::get_settings( 'titles.social_url_' . $id ) ) : // phpcs:ignore
					?>
					<a class="social-item type-<?php echo $id; ?>" href="<?php echo esc_url( $url ); ?>"><?php echo $label; ?></a>
					<?php
				endif;
			endforeach;
			?>
		</div>
		<?php
	}

	/**
	 * Output google map.
	 */
	private function display_map() {
		$address = Helper::get_settings( 'titles.local_address' );
		if ( false === $address ) {
			return;
		}

		/**
		 * Filter address for Google Map in contact shortcode
		 *
		 * @param string $address
		 */
		$address = $this->do_filter( 'shortcode/contact/map_address', implode( ' ', $address ) );
		$address = $this->do_filter( 'shortcode/contact/map_iframe_src', 'http://maps.google.com/maps?q=' . urlencode( $address ) . '&z=15&output=embed&key=' . urlencode( Helper::get_settings( 'titles.maps_api_key' ) ) );
		?>
		<iframe src="<?php echo esc_url( $address ); ?>"></iframe>
		<?php
	}

	/**
	 * Yoast address compatibility functionality.
	 *
	 * @param  array $args Array of arguments.
	 * @return string
	 */
	public function yoast_address( $args ) {
		$atts = shortcode_atts( array(
			'hide_name'          => '0',
			'hide_address'       => '0',
			'show_state'         => '1',
			'show_country'       => '1',
			'show_phone'         => '1',
			'show_phone_2'       => '1',
			'show_fax'           => '1',
			'show_email'         => '1',
			'show_url'           => '0',
			'show_vat'           => '0',
			'show_tax'           => '0',
			'show_coc'           => '0',
			'show_price_range'   => '0',
			'show_logo'          => '0',
			'show_opening_hours' => '0',
		), $args, 'wpseo_address' );
		$show = array( 'address' );

		if ( '1' == $atts['show_phone'] ) {
			$show[] = 'phone';
		}

		if ( '1' == $atts['show_opening_hours'] ) {
			$show[] = 'hours';
		}

		return $this->contact_info( array(
			'show'  => join( ',', $show ),
			'class' => 'wpseo_address_compat',
		) );
	}

	/**
	 * Yoast map compatibility functionality.
	 *
	 * @param  array $args Array of arguments.
	 * @return string
	 */
	public function yoast_map( $args ) {
		return $this->contact_info( array(
			'show'  => 'map',
			'class' => 'wpseo_map_compat',
		) );
	}

	/**
	 * Yoast opening hours compatibility functionality.
	 *
	 * @param  array $args Array of arguments.
	 * @return string
	 */
	public function yoast_opening_hours( $args ) {
		return $this->contact_info( array(
			'show'  => 'hours',
			'class' => 'wpseo_opening_hours_compat',
		) );
	}

	/**
	 * Review Snippet shortcode, displays nicely formatted reviews.
	 *
	 * @return string Shortcode output.
	 *
	 * @since 1.0.12
	 */
	public function review_snippet() {

		if ( ! is_singular() || ! is_main_query() ) {
			return;
		}

		global $post;

		$schema = Helper::get_post_meta( 'rich_snippet' );
		if ( 'review' !== $schema ) {
			return;
		}

		wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', null, rank_math()->version );
		wp_enqueue_style( 'rank-math-review-snippet', rank_math()->assets() . 'css/rank-math-review-snippet.css', null, rank_math()->version );

		// Title.
		$title = Helper::get_post_meta( 'snippet_name' );
		$title = $title ? $title : rank_math()->head->title( '' );

		// Description.
		$excerpt = Helper::replace_vars( '%excerpt%', $post );
		$desc    = Helper::get_post_meta( 'snippet_desc' );
		$desc    = $desc ? $desc : ( $excerpt ? $excerpt : Helper::get_post_meta( 'description' ) );

		// Image.
		$image = Helper::get_thumbnail_with_fallback( $post->ID, 'medium' );

		// Ratings.
		$rating = Helper::get_post_meta( 'snippet_review_rating_value' );
		$rating = isset( $rating ) ? floatval( $rating ) : 0;
		ob_start();
		?>
			<div id="rank-math-review">
				<h5 class="rank-math-title"><?php echo esc_html( $title ); ?></h5>

				<div class="rank-math-review-item">
					<?php if ( ! empty( $image ) ) { ?>
						<div class="rank-math-review-image">
							<img src="<?php echo esc_url( $image[0] ); ?>" />
						</div>
					<?php } ?>
					<div class="rank-math-review-data">
						<?php echo $desc; ?>
					</div>
				</div>
				<div class="rank-math-total-wrapper">
					<strong><?php echo $this->do_filter( 'review/text', esc_html__( 'Editor\'s Rating:', 'rank-math' ) ); ?></strong><br />
					<span class="rank-math-total"><?php echo $rating; ?></span>
					<div class="rank-math-review-star">
						<div class="rank-math-review-result-wrapper">
							<?php for ( $i = 0; $i < 5; $i++ ) { ?>
								<i class="fa fa-star"></i>
							<?php } ?>

							<div class="rank-math-review-result" style="width:<?php echo ( $rating * 20 ); ?>%;">
								<?php for ( $i = 0; $i < 5; $i++ ) { ?>
									<i class="fa fa-star"></i>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php

		return $this->do_filter( 'review/html', ob_get_clean() );
	}
}
