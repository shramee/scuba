<?php
//wp_enqueue_script('magnific.js' );
global $post;

$post_id      = get_the_ID();
$link      = st_get_link_with_search( get_permalink(), array(
	'start',
	'end',
	'room_num_search',
	'adult_number',
	'children_num'
), $_GET );
$hotel     = new STHotel( $post_id );
$thumb_url = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
$check_in  = '';
$check_out = '';
if ( ! isset( $_REQUEST['start'] ) || empty( $_REQUEST['start'] ) ) {
	$check_in = date( 'm/d/Y', strtotime( "now" ) );
} else {
	$check_in = TravelHelper::convertDateFormat( STInput::request( 'start' ) );
}

if ( ! isset( $_REQUEST['end'] ) || empty( $_REQUEST['end'] ) ) {
	$check_out = date( 'm/d/Y', strtotime( "+1 day" ) );
} else {
	$check_out = TravelHelper::convertDateFormat( STInput::request( 'end' ) );
}
$numberday = STDate::dateDiff( $check_in, $check_out );
$hotel_logo   = get_post_meta( $post_id, 'logo', true );
?>
<li <?php post_class( 'booking-item' ) ?>>
	<?php echo STFeatured::get_featured(); ?>
	<div class="row">
		<div class="scuba-dc-list-img col-md-3">
			<a href="<?php echo get_permalink() ?>">
				<img alt="<?php the_title() ?>" title="<?php the_title() ?> logo" src="<?php echo $hotel_logo ?>">
			</a>
		</div>
		<div class="scuba-dc-list-content col-md-9">
			<?php if ( $address = get_post_meta( $post_id, 'address', true ) ): ?>
				<p class="booking-item-address"><i
						class="fa fa-map-marker"></i> <?php echo esc_html( $address ) ?>
				</p>
			<?php endif; ?>

			<a href="<?php echo get_permalink() ?>">
				<?php the_title( '<h3 class="booking-item-title">', '</h3>' ) ?>
			</a>

			<div class="hotel-header-meta row">
				<div class="col-md-6 scuba-hotel-review-score">
					<?php
					$total = get_comments_number();
					if ( $total ) {
						$avg = STReview::get_avg_rate();

						$stars = '';
						for ( $x = 1; $x <= $avg; $x ++ ) {
							$stars .= '<i class="fa fa-star"></i>';
						}
						if ( strpos( $avg, '.' ) ) {
							$stars .= '<i class="fa fa-star-half-full"></i>';
							$x ++;
						}
						while ( $x <= 5 ) {
							$stars .= '<i class="fa fa-star-o"></i>';
							$x ++;
						}

						?>
						<span class='reviews-stars st-stars'><?php echo $stars ?></span>
						<span class='review-score-text'>
									<?php printf(
										__( 'Rated %1$s' ),
										'<span class="review-text">' .
										TravelHelper::get_rate_review_text( $avg ) .
										'</span>',
										'<span class="review-count">' .
										get_comments_number_text( __( '0 reviews' ), __( '1 review' ), __( '% reviews' ) ) .
										'</span>'
									); ?>
								</span>
						<?php
					}
					?>
				</div>

				<div class="col-md-6 text-right-md">
					<?php
					$price = get_post_meta( $post_id, 'price_avg', 'singel' );
					if ( $price ) {
						?>
						<span class="booking-item-price text-primary">
							<?php printf( __( "Packages from %s", ST_TEXTDOMAIN ), TravelHelper::format_money( $price ) ) ?>
						</span>
						<?php
					}
					?>
				</div>
			</div>

			<?php
			if ( ! empty( $taxonomy ) ) {
				echo st()->load_template( 'hotel/elements/attribute', 'list', array( "taxonomy" => $taxonomy ) );
			}
			?>

			<div class="hotel-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<br>

			<div class="btn-group btn-group-justified">
				<a href="<?php echo get_permalink() ?>" class="btn btn-primary">View details</a>
				<a href="<?php echo get_permalink() . '#enquire-now' ?>" class="btn btn-primary-invert">Enquire</a>
			</div>
		</div>
	</div>
</li>