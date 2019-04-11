<?php
/**
 * @package    WordPress
 * @subpackage Traveler
 * @since      1.0
 *
 * Single hotel
 *
 * Created by ShineTheme
 *
 */
?>

<?php get_header(); ?>

<?php
while ( have_posts() ): the_post();
	$price        = STHotel::get_price();
	$post_id      = get_the_ID();
	$hotel_star   = (int) get_post_meta( $post_id, 'hotel_star', true );
	$address      = get_post_meta( $post_id, 'address', true );
	$review_rate  = STReview::get_avg_rate();
	$count_review = get_comment_count( $post_id )['approved'];
	$lat          = get_post_meta( $post_id, 'map_lat', true );
	$lng          = get_post_meta( $post_id, 'map_lng', true );
	$zoom         = get_post_meta( $post_id, 'map_zoom', true );
	$hotel_logo   = get_post_meta( $post_id, 'logo', true );

	$marker_icon   = st()->get_option( 'st_hotel_icon_map_marker', '' );
	?>
	<div id="st-content-wrapper">
		<?php st_breadcrumbs_new() ?>
		<div class="container">
			<div class="row">

				<div class="col-sm-12 col-md-6 pull-right">
					<?php echo do_shortcode( '[scuba_hotel_slider]' ); ?>
				</div>

				<div class="col-sm-12 col-md-6">
					<div class="st-hotel-header">
						<?php echo st()->load_template( 'layouts/modern/common/star', '', [ 'star' => $hotel_star ] ); ?>
						<h1 class="st-heading"><?php the_title(); ?></h1>
						<div class="sub-heading">
							<?php if ( $address ) {
								echo TravelHelper::getNewIcon( 'Ico_maps', '#5E6D77', '16px', '16px' );
								echo esc_html( $address );
							} ?>
						</div>
						<p class="hotel-excerpt">
							<?php the_excerpt(); ?>
						</p>
					</div>
				</div>
				<div class="col-sm-12 text-center scuba-hotel-logo">
					<img align="<?php the_title() ?>" src="<?php echo $hotel_logo ?>">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>

<?php get_footer() ?>