<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Footer
 *
 * Created by ShineTheme
 *
 */
?>
</div>
<!-- end row -->
</div>
<!--    End #Wrap-->
<?php

$footer_template = TravelHelper::st_get_template_footer( get_the_ID() );
if ( $footer_template ) {
	$qry = new WP_Query( [
		'page_id' => $footer_template,
	] );

	while ( $qry->have_posts() ) {
		$qry->the_post();
		the_content();
	}
} else {
	?>
	<!--        Default Footer -->
	<footer id="main-footer" class="container-fluid">
		<div class="container text-center">
			<p><?php _e( 'Copy &copy; 2014 Shinetheme. All Rights Reserved', ST_TEXTDOMAIN ) ?></p>
		</div>

	</footer>
<?php } ?>

<!-- Gotop -->
<?php
switch ( st()->get_option( 'scroll_style', '' ) ) {
	case "tour_box":
		?>
		<div id="gotop" class="go_top_tour_box" title="<?php _e( 'Go to top', ST_TEXTDOMAIN ) ?>">
			<i class="fa fa-angle-double-up"></i>
			<p><?php echo __( "TOP", ST_TEXTDOMAIN ); ?></p>
		</div>
		<?php
		break;
	default :
		?>
		<div id="gotop" title="<?php _e( 'Go to top', ST_TEXTDOMAIN ) ?>">
			<i class="fa fa-chevron-up"></i>
		</div>
		<?php
		break;
}
?>

<!-- End Gotop -->
<?php do_action( 'st_before_footer' ); ?>
<?php wp_footer(); ?>
<?php do_action( 'st_after_footer' ); ?>

<?php
if ( empty( $_COOKIE['permission_granted'] ) ) {
	?>
	<div class="cookie-permission-box">
		This site uses cookies to ensure you get best experience on site.
		<a onclick="document.cookie='permission_granted=1';this.parentNode.style.display='none';"
			 href="#" class="btn btn-primary">Okay</a>
	</div>
	<?php
}
?>
</body>
</html>
