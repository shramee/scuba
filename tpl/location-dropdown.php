<?php
/**
 * Template for shortcode - location-dropdown
 * Dropdown to select location
 */

$args = wp_parse_args( $atts, [
	'post_type'   => 'location',
	'meta_key' => '_thumbnail_id',
	'post_parent' => 0,
] );
if ( is_singular( 'location' ) ) {
	$args['post_parent'] = wp_get_post_parent_id( get_the_ID() );
}

$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<label>
		<span class="screen-reader-text">Choose location</span>
	<select class="locations-dropdown" onchange="window.location.href = this.value">
		<?php while ( $the_query->have_posts() ) {
			$the_query->the_post(); ?>
			<option value="<?php the_permalink() ?>"><?php the_title() ?></option>
			<?php
		} ?>
	</select>
	</label>
<?php endif;

wp_reset_postdata();
?>