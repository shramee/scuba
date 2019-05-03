<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * form search custom
 *
 * Created by ShineTheme
 *
 */
?>
<form role="search" method="get" class="search" action="<?php echo home_url( '/' ); ?>">
	<input type="text" class="form-control" value="<?php echo get_search_query() ?>" name="s" placeholder="<?php st_the_language( 'search...' ) ?>">
	<input type="hidden" name="post_type[]" value="post">
	<input type="hidden" name="post_type[]" value="location">
	<input type="hidden" name="post_type[]" value="st_hotel">
	<input type="hidden" name="post_type[]" value="st_rental">
	<button class="search-button"><?php st_the_language( 'Search' ) ?></button>
</form>