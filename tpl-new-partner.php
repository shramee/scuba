<?php
/*
Template Name: Partner Register Form
*/

/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Template Name : Register Form
 *
 * Created by ShineTheme
 *
 */
if(st()->get_option('enable_popup_login','off') == 'on'){
	wp_redirect( home_url( '/' ) );
	exit();
}

get_header();
?>
<style>
	h2 {
		margin-top: 1.6em;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="container">
			<div class="row" data-gutter="60">
				<div class="col-md-8 col-md-offset-2">
					<?php echo st()->load_template('login/form-new','partner') ?>
				</div>
			</div>
		</div>
		<div class="gap"></div>
	</div>
</div>
<?php  get_footer(); ?>
