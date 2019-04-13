<?php
//wp_enqueue_script('magnific.js' );
global $post;

$link      = st_get_link_with_search( get_permalink(), array(
	'start',
	'end',
	'room_num_search',
	'adult_number',
	'children_num'
), $_GET );
$hotel     = new STHotel( get_the_ID() );
$thumb_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
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
?>
<li <?php post_class( 'booking-item' ) ?>>
	<?php echo STFeatured::get_featured(); ?>
	<div class="row">
		<div class="col-md-3">
			<div class="booking-item-img-wrap st-popup-gallery">
				<a href="<?php echo esc_url( $thumb_url ) ?>" class="st-gp-item">
					<?php if ( has_post_thumbnail() and get_the_post_thumbnail() ) {
						the_post_thumbnail( array(
							360,
							270
						), array( 'alt' => TravelHelper::get_alt_image( get_post_thumbnail_id( get_the_ID() ) ) ) );
					} else {
						echo st_get_default_image();
					} ?>
				</a>
				<?php
				$count   = 0;
				$gallery = get_post_meta( get_the_ID(), 'gallery', true );

				$gallery = explode( ',', $gallery );


				if ( ! empty( $gallery ) and $gallery[0] ) {
					$count += count( $gallery );
				}

				if ( has_post_thumbnail() ) {
					$count ++;
				}


				if ( $count ) {
					echo '<div class="booking-item-img-num"><i class="fa fa-picture-o"></i>';
					echo esc_attr( $count );
					echo '</div>';
				}
				?>
				<div class="hidden">
					<?php if ( ! empty( $gallery ) and $gallery[0] ) {
						$count += count( $gallery );
						foreach ( $gallery as $key => $value ) {
							$img_link = wp_get_attachment_image_src( $value, array( 800, 600, 'bfi_thumb' => true ) );
							if ( isset( $img_link[0] ) ) {
								echo "<a class='st-gp-item' href='{$img_link[0]}'></a>";
							}
						}

					} ?>
				</div>
				<?php
				echo st_get_avatar_in_list_service( get_the_ID(), 35 );
				?>

			</div>
		</div>
		<div class="col-md-9">
			<?php if ( $address = get_post_meta( get_the_ID(), 'address', true ) ): ?>
				<p class="booking-item-address"><i
						class="fa fa-map-marker"></i> <?php echo esc_html( $address ) ?>
				</p>
			<?php endif; ?>
			<?php the_title( '<h3 class="booking-item-title">', '</h3>' ) ?>

			<div class="hotel-header-meta row">
				<div class="col-sm-6 scuba-hotel-review-score">
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

				<div class="col-sm-6 text-right">
					<?php
					$price = get_post_meta( get_the_ID(), 'price_avg', 'singel' );
					if ( $price ) {
						?>
						<span class="booking-item-price-from">
								<?php echo __( "Packages starting", ST_TEXTDOMAIN ) . ' ' . TravelHelper::format_money( $price ) ?>
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

			<div class="btn-group-justified">
				<a href="<?php echo get_permalink() ?>" class="btn btn-primary">View details</a>
				<a href="<?php echo get_permalink() . '#enquire-now' ?>" class="btn">Enquire</a>
			</div>
		</div>
	</div>
</li>