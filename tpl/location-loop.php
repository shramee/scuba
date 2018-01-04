<?php
/**
 * Template for shortcode - location-loop
 * Shows a loop of locations
 */

$args = wp_parse_args( $atts, [
	'post_type'   => 'location',
	'meta_key' => '_thumbnail_id',
	// 'post_parent' => 0,
] );

if ( is_singular( 'location' ) ) {
	$args['post_parent'] = get_the_ID();
}

$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<div class="locations-loop">
		<?php while ( $the_query->have_posts() ) {
			$the_query->the_post(); ?>
			<article>
				<div class="image" style="background-image: url(<?php the_post_thumbnail_url( 'medium_large' ) ?>);"></div>
				<a href="<?php the_permalink() ?>">
					<h2><?php the_title(); ?></h2>
				</a>
			</article>
			<?php
		} ?>
	</div>
<?php endif;

wp_reset_postdata();
?>