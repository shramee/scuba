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
<div class="container-fluid">
	<div class="row">
		<div class="container">
			<?php the_title( '<h1 class="page-title text-center mt60">', '</h1>') ?>
		</div>
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
