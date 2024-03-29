<?php
/**
 * SEO Analysis admin page contents.
 *
 * @package   MTS_SEO
 * @author    MyThemeShop <admin@mythemeshop.com>
 * @license   GPL-2.0+
 * @link      https://rankmath.com/wordpress/plugin/seo-suite/
 * @copyright 2017 MyThemeShop
 */

use RankMath\Helper;

$assets   = plugin_dir_url( dirname( __FILE__ ) );
$analyzer = Helper::get_module( 'seo-analysis' )->admin->analyzer;
?>
<div class="wrap rank-math-seo-analysis-wrap limit-wrap">

	<span class="wp-header-end"></span>

	<h2>
		<?php echo esc_html( get_admin_page_title() ); ?>
		<a class="page-title-action" href="https://mythemeshop.com/kb/wordpress-seo-plugin-rank-math/seo-analysis/" target="_blank"><?php esc_html_e( 'What is this?', 'rank-math' ); ?></a>
	</h2>
	<?php if ( Helper::is_mythemeshop_connected() ) : ?>
	<div class="rank-math-seo-analysis-header rank-math-ui<?php echo empty( $analyzer->results ) ? '' : ' hidden'; ?>">

		<?php if ( $analyzer->analyse_subpage ) { ?>
			<p class="page-analysis-selected">
				<?php echo sprintf( esc_html__( 'Selected page: %s', 'rank-math' ), '<a href="' . esc_url( $analyzer->analyse_url ) . '" class="rank-math-current-url" target="_blank">' . $analyzer->analyse_url . '</a>' ); // phpcs:ignore ?>
				<input type="text" class="rank-math-analyze-url" value="<?php echo esc_url( $analyzer->analyse_url ); ?>">
				<button class="button button-secondary rank-math-changeurl-ok"><?php esc_html_e( 'OK', 'rank-math' ); ?></button>
				<button class="button button-secondary rank-math-changeurl"><?php esc_html_e( 'Change URL', 'rank-math' ); ?></button>
			</p>
			<button data-what="page" class="button button-primary button-xlarge rank-math-recheck"><?php esc_html_e( 'Start Page Analysis', 'rank-math' ); ?></button>

			<h2><?php esc_html_e( 'Analysing Page&hellip;', 'rank-math' ); ?></h2>

		<?php } else { ?>
			<button data-what="website" class="button button-primary button-xlarge rank-math-recheck"><?php esc_html_e( 'Start Site-Wide Analysis', 'rank-math' ); ?></button>

			<h2><?php esc_html_e( 'Analysing Website&hellip;', 'rank-math' ); ?></h2>

		<?php } ?>

		<div class="progress-bar">
			<div class="progress"></div>
			<label><span>0%</span> <?php esc_html_e( 'Complete', 'rank-math' ); ?></label>
		</div>

	</div>
	<?php // phpcs:disable ?>
	<?php if ( ! $analyzer->analyse_subpage ) : ?>
	<div class="rank-math-results-wrapper">
		<?php
		$analyzer->display_graphs();
		$analyzer->display_results();
		?>
	</div>
	<?php endif; ?>
<?php else : ?>
	<div class="rank-math-seo-analysis-header rank-math-ui">
		<h3>Analyze your site by <a href="<?php echo Helper::get_admin_url( '', 'view=help' ); ?>" target="_blank">linking your MyThemeShop account</a>.</h3>
	</div>
	<?php // phpcs:enable ?>
<?php endif; ?>
</div>
