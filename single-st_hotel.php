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

	$marker_icon = st()->get_option( 'st_hotel_icon_map_marker', '' );
	?>
	<div id="st-content-wrapper">
		<?php st_breadcrumbs() ?>
		<div class="container">
			<div class="row scuba-flex-center">

				<div class="col-xs-12 col-md-7 scuba-order-999">
					<?php echo do_shortcode( '[scuba_hotel_slider]' ); ?>
				</div>

				<div class="col-xs-12 col-md-5">
					<div class="st-hotel-header">
						<h2 class="sub-heading">
							<?php if ( $address ) {
								echo TravelHelper::getNewIcon( 'Ico_maps', '#5E6D77', '16px', '16px' );
								echo esc_html( $address );
							} ?>
						</h2>
						<p>
							<img align="<?php the_title() ?>" src="<?php echo $hotel_logo ?>">
						</p>
						<h1 class="st-heading"><?php the_title(); ?></h1>
						<div class="hotel-header-meta">
							<?php
							$total = get_comments_number();
							if ( $total ) {
								$avg = STReview::get_avg_rate();

								$stars = '';
								for ( $x = 1; $x <= $avg; $x ++ ) {
									$stars .= '<i class="fa fa-star"></i>';
								}
								if ( strpos( $avg, '.' ) ) {
									$stars .= '<i class="fa fa-star-half"></i>';
									$x ++;
								}
								while ( $x <= 5 ) {
									$stars .= '<i class="fa fa-star-o"></i>';
									$x ++;
								}

								?>
								<div class="scuba-hotel-review-score">
									<span class='reviews-stars st-stars pull-right'><?php echo $stars ?></span>
									<span class='review-score-text'>
									<?php printf(
										__( 'Rated %1$s by %2$s' ),
										'<span class="review-text">' .
										TravelHelper::get_rate_review_text( $avg ) .
										'</span>',
										'<span class="review-count">' .
										get_comments_number_text( __( '0 reviews' ), __( '1 review' ), __( '% reviews' ) ) .
										'</span>'
									); ?>

								</span>
								</div>
								<?php
							}
							?>
						</div>

						<p class="hotel-excerpt">
							<?php the_excerpt(); ?>
						</p>
					</div>
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