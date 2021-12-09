<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group stylish-input-group input-append martop">
		<input type="text" class="form-control"  placeholder="Search in this site" value="<?php echo get_search_query(); ?>" name="s" >
		<span class="input-group-addon">
			<button type="submit" class="btn_typ">
				<i class="fa fa-search" aria-hidden="true"></i>  
			</button>  
		</span>
	</div>
</form>
