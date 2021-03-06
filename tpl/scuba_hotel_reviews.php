<?php
/**
 * Created by PhpStorm.
 * User: shramee
 * Date: 11/04/19
 * Time: 1:48 PM
 */
$post_id = get_the_ID();
?>
<div id="reviews" data-toggle-section="st-reviews">
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<div class="review-box has-matchHeight">
				<h2 class="heading"><?php echo __( 'Review score', ST_TEXTDOMAIN ) ?></h2>
				<div class="review-box-score">
					<?php
					$avg = STReview::get_avg_rate();
					?>
					<div class="review-score">
						<?php echo esc_attr( $avg ); ?><span class="per-total">/5</span>
					</div>
					<div class="review-score-text"><?php echo TravelHelper::get_rate_review_text( $avg ); ?></div>
					<div class="review-score-base">
						<?php echo __( 'Based on', ST_TEXTDOMAIN ) ?>
						<span><?php comments_number( __( '0 review', ST_TEXTDOMAIN ), __( '1 review', ST_TEXTDOMAIN ), __( '% reviews', ST_TEXTDOMAIN ) ); ?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="review-box has-matchHeight">
				<h2 class="heading"><?php echo __( 'Traveler rating', ST_TEXTDOMAIN ) ?></h2>
				<?php $total = get_comments_number(); ?>
				<?php $rate_exe = STReview::count_review_by_rate( null, 5 ); ?>
				<div class="item">
					<div class="progress">
						<div class="percent green"
								 style="width: <?php echo TravelHelper::cal_rate( $rate_exe, $total ) ?>%;"></div>
					</div>
					<div class="label">
						<?php echo esc_html__( 'Excellent', ST_TEXTDOMAIN ) ?>
						<div class="number"><?php echo $rate_exe; ?></div>
					</div>
				</div>
				<?php $rate_good = STReview::count_review_by_rate( null, 4 ); ?>
				<div class="item">
					<div class="progress">
						<div class="percent darkgreen"
								 style="width: <?php echo TravelHelper::cal_rate( $rate_good, $total ) ?>%;"></div>
					</div>
					<div class="label">
						<?php echo __( 'Very Good', ST_TEXTDOMAIN ) ?>
						<div class="number"><?php echo $rate_good; ?></div>
					</div>
				</div>
				<?php $rate_avg = STReview::count_review_by_rate( null, 3 ); ?>
				<div class="item">
					<div class="progress">
						<div class="percent yellow"
								 style="width: <?php echo TravelHelper::cal_rate( $rate_avg, $total ) ?>%;"></div>
					</div>
					<div class="label">
						<?php echo __( 'Average', ST_TEXTDOMAIN ) ?>
						<div class="number"><?php echo $rate_avg; ?></div>
					</div>
				</div>
				<?php $rate_poor = STReview::count_review_by_rate( null, 2 ); ?>
				<div class="item">
					<div class="progress">
						<div class="percent orange"
								 style="width: <?php echo TravelHelper::cal_rate( $rate_poor, $total ) ?>%;"></div>
					</div>
					<div class="label">
						<?php echo __( 'Poor', ST_TEXTDOMAIN ) ?>
						<div class="number"><?php echo $rate_poor; ?></div>
					</div>
				</div>
				<?php $rate_terible = STReview::count_review_by_rate( null, 1 ); ?>
				<div class="item">
					<div class="progress">
						<div class="percent red"
								 style="width: <?php echo TravelHelper::cal_rate( $rate_terible, $total ) ?>%;"></div>
					</div>
					<div class="label">
						<?php echo __( 'Terrible', ST_TEXTDOMAIN ) ?>
						<div class="number"><?php echo $rate_terible; ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="review-box has-matchHeight">
				<h2 class="heading"><?php echo __( 'Summary', ST_TEXTDOMAIN ) ?></h2>
				<?php
				$stats = STReview::get_review_summary( $post_id );
				if ( $stats ) {
					foreach ( $stats as $stat ) {
						?>
						<div class="item">
							<div class="progress">
								<div class="percent"
										 style="width: <?php echo $stat['percent']; ?>%;"></div>
							</div>
							<div class="label">
								<?php echo $stat['name']; ?>
								<div class="number"><?php echo $stat['summary'] ?>
									/5
								</div>
							</div>
						</div>
					<?php }
				}
				?>
			</div>
		</div>
	</div>
	<div class="review-pagination">
		<div class="summary">
			<?php
			$comments_count   = wp_count_comments( get_the_ID() );
			$total            = (int) $comments_count->approved;
			$comment_per_page = (int) get_option( 'comments_per_page', 10 );
			$paged            = (int) STInput::get( 'comment_page', 1 );
			$from             = $comment_per_page * ( $paged - 1 ) + 1;
			$to               = ( $paged * $comment_per_page < $total ) ? ( $paged * $comment_per_page ) : $total;
			?>
			<?php comments_number( __( 'Be the first to review this dive center', ST_TEXTDOMAIN ), __( '1 review on this dive center', ST_TEXTDOMAIN ), __( '% reviews on this dive center', ST_TEXTDOMAIN ) ); ?>
			- <?php echo sprintf( __( 'Showing %s to %s', ST_TEXTDOMAIN ), $from, $to ) ?>
		</div>
		<div id="reviews" class="review-list">
			<?php
			$offset         = ( $paged - 1 ) * $comment_per_page;
			$args           = [
				'number'  => $comment_per_page,
				'offset'  => $offset,
				'post_id' => get_the_ID(),
				'status'  => [ 'approve' ]
			];
			$comments_query = new WP_Comment_Query;
			$comments       = $comments_query->query( $args );

			if ( $comments ):
				foreach ( $comments as $key => $comment ):
					echo st()->load_template( 'layouts/modern/common/reviews/review', 'list', [ 'comment' => (object) $comment ] );
				endforeach;
			endif;
			?>
		</div>
	</div>
	<?php TravelHelper::pagination_comment( [ 'total' => $total ] ) ?>
	<?php
	if ( comments_open( $post_id ) ) {
		$code = 'phil' . ( date( 'm' ) * 10 + date( 'd' ) );
		if ( is_user_logged_in() || $_POST['scuba-review'] == $code ) {
			?>
			<div id="write-review">
				<h4 class="heading">
					<a href="" class="toggle-section c-main f16"
						 data-target="st-review-form"><?php echo __( 'Write a review', ST_TEXTDOMAIN ) ?>
						<i class="fa fa-angle-down ml5"></i></a>
				</h4>
				<?php TravelHelper::comment_form(); ?>
			</div>
			<?php
		} else if ( isset( $_GET['scuba-review'] ) ) {
			?>

			<form method="post">
				<input type="hidden" name="scuba-review" value="<?php echo $code ?>">
				<h4 class="sub-heading">
					<input type="submit" value="<?php echo __( 'Loginto leave a review', ST_TEXTDOMAIN ) ?>" class="btn btn-block btn-primary">
				</h4>
			</form>

			<?php
		} else {
			?>
			<h4 class="sub-heading">
				<a href="#st-login-form" class="btn btn-block btn-primary" data-toggle="modal" data-target="#st-login-form">
					<?php echo __( 'Login to leave a review', ST_TEXTDOMAIN ) ?></a>
			</h4>
			<?php
		}
	}
	?>
</div>
