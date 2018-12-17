<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * form new login
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'user.js' );

$_REQUEST['register_as'] = 'partner';
$_POST['register_as']    = 'partner';

$reset = 'false';
if ( ! empty( $_REQUEST['btn_reg'] ) ) {
	Scubahive_Partners::register_user();
	return;
}
$class_form = "";
if ( is_page_template( 'template-login.php' ) ) {
	$class_form = 'form-group-ghost';
}
$btn_register = get_post_meta( get_the_ID(), 'btn_register', true );
if ( empty( $btn_register ) ) {
	$btn_register = __( "Register", ST_TEXTDOMAIN );
}

$fields_renderer = new Shramee_Form_Fields( [
	'required'  => 1,
	'field_tpl' => '<div class="col-md-6"><div class="form-group">%label%%input%</div></div>',
] );

if ( isset( $_GET['individual'] ) ) {
	?>
	<h2 class="text-center"><?php _e( 'Partner Registration', 'scuba' ) ?></h2>
	<p class="text-center">
		<?php _e( 'Want to register as organisation?', 'scuba' ) ?>
		<a href="?"><?php _e( 'Click here', 'scuba' ) ?></a>
	</p>
	<form id="professional-registration-form" class="register_form" data-reset="<?php echo esc_attr( $reset ) ?>" method="post" enctype="multipart/form-data"
				action="<?php echo esc_url( add_query_arg( array( 'url' => STInput::request( 'url' ) ) ) ) ?>">
		<input type="hidden" name="register_as" value="<?php echo $_REQUEST['register_as'] ?>">
		<input type="hidden" name="operator_type" value="professional">
		<div class="row mt20 data_field">
			<?php

			$fields_renderer->render( [
				'full_name'   => __( 'Full name', 'scuba' ),
				'user_name'   => __( 'User Name', 'scuba' ),
				'email'       => __( 'Email', 'scuba' ),
				'password'    => __( 'Password', 'scuba' ),
				'contact'     => [
					'label' => __( 'Contact number / mobile', 'scuba' ),
					'type'  => 'tel',
				],
				'nationality' => [
					'label'   => __( 'Nationality', 'scuba' ),
					'options' => $fields_renderer->nationality_ops,
					'type'    => 'select',
				],
				'address'     => __( 'Address', 'scuba' ),
				'state'       => __( 'State', 'scuba' ),
				'Postcode'    => __( 'Postcode', 'scuba' ),
				'country'     => [
					'label'   => __( 'Country', 'scuba' ),
					'options' => $country_ops,
					'type'    => 'select',
				],
				'dive_agency' => 'Dive Agency (e.g. PADI, SSI, NAUI, etc)',
				'dive_rating' => 'Dive Pro Rating (e.g. Dive master, instructor)',
				'dive_number' => 'Dive Pro Number',
				'certification_card' => [
					'label' => __( 'Dive pro card photo', 'scuba' ),
					'type'  => 'file',
				],
			] );
			?>
		</div>

		<?php
		/*
			DIVE PROFESSIONALS


			Full name
			Nationality
			Identity card / Passport number
			Email
			Contact number / mobile
			Address
			---State
			---Postcode
			---Country
			Dive Agency (e.g. PADI, SSI, NAUI, etc)
			Dive Pro Rating (e.g. Dive master, instructor)
			Dive Pro Number
			Upload photo of dive pro card


			DIVE OPERATOR


			[Choose type: Dive Centre, Dive Resort, Dive Academy, Liveaboard]
			Organisation name
			Business registration number
			Tourism license number
			Main contact full name
			Email
			Contact number
			Mobile
			Address
			---Post code
			---State
			---Country
			Website URL
			*/
		?>

		<div class="checkbox st_check_term_conditions mt20">
			<label>
				<input class="i-check term_condition" name="term_condition"
							 type="checkbox" <?php if ( STInput::post( 'term_condition' ) == 1 ) {
					echo 'checked';
				} ?>/><?php echo st_get_language( 'i_have_read_and_accept_the' ) . '<a target="_blank" href="' . get_the_permalink( st()->get_option( 'page_terms_conditions' ) ) . '"> ' . st_get_language( 'terms_and_conditions' ) . '</a>'; ?>
			</label>
		</div>
		<?php
		if ( STRecaptcha::inst()->_is_check_allow_captcha() ) {
			?>
			<div class="form-group">
				<label for="field-login_password"><?php echo esc_html__( 'Captcha', ST_TEXTDOMAIN ) ?></label>
				<div class="content-captcha">
					<?php echo do_shortcode( STRecaptcha::inst()->get_captcha() ); ?>
				</div>
			</div>
		<?php } ?>
		<div class="text-center mt20">
			<input name="btn_reg" class="btn btn-primary btn-lg" type="hidden" value="register">
			<button class="btn btn-primary btn-lg" type="submit"><?php echo esc_html( $btn_register ) ?></button>
		</div>
	</form>
	<?php
} else {
	?>
	<h2 class="text-center"><?php _e( 'Register as Diving Organisation', 'scuba' ) ?></h2>

	<?php /*
	<p class="text-center">
		<?php _e( 'Want to register as an individual?', 'scuba' ) ?>
		<a href="?individual"><?php _e( 'Click here', 'scuba' ) ?></a>
	</p>
	*/ ?>

	<form id="operator-registration-form" class="register_form" data-reset="<?php echo esc_attr( $reset ) ?>"
				method="post" enctype="multipart/form-data"
				action="<?php echo esc_url( add_query_arg( array( 'url' => STInput::request( 'url' ) ) ) ) ?>">
		<input type="hidden" name="register_as" value="<?php echo $_REQUEST['register_as'] ?>">
		<div class="row mt20 data_field">

			<div class="col-md-12">
				<div class="form-group ">
					<label for="field-operator-type">Organisation Type (Please choose)</label>
				</div>
				<div class="scuba-btn-grp">

					<input type="radio" required name="operator_type" id="operator-type-professional" value="professional">
					<label for="operator-type-professional">Professional</label>


					<input type="radio" required name="operator_type" id="operator-type-center" value="center">
					<label for="operator-type-center">Dive Center</label>

					<input type="radio" required name="operator_type" id="operator-type-resort" value="resort">
					<label for="operator-type-resort">Dive Resort</label>

					<input type="radio" required name="operator_type" id="operator-type-liveaboard" value="liveaboard">
					<label for="operator-type-liveaboard">Liveaboard</label>

					<input type="radio" required name="operator_type" id="operator-type-academy" value="academy">
					<label for="operator-type-academy">Dive Academy</label>

				</div>
			</div>
		</div>
		<div class="row mt20 data_field">
			<?php
			$fields_renderer->render( Scubahive_Partners::get_fields() );
			?>
		</div>
		<div class="checkbox st_check_term_conditions mt20">
			<label>
				<input class="i-check term_condition" name="term_condition"
							 type="checkbox" <?php if ( STInput::post( 'term_condition' ) == 1 ) {
					echo 'checked';
				} ?>/><?php echo st_get_language( 'i_have_read_and_accept_the' ) . '<a target="_blank" href="' . get_the_permalink( st()->get_option( 'page_terms_conditions' ) ) . '"> ' . st_get_language( 'terms_and_conditions' ) . '</a>'; ?>
			</label>
		</div>
		<?php
		if ( STRecaptcha::inst()->_is_check_allow_captcha() ) {
			?>
			<div class="form-group">
				<label for="field-login_password"><?php echo esc_html__( 'Captcha', ST_TEXTDOMAIN ) ?></label>
				<div class="content-captcha">
					<?php echo do_shortcode( STRecaptcha::inst()->get_captcha() ); ?>
				</div>
			</div>
		<?php } ?>
		<div class="text-center mt20">
			<input name="btn_reg" class="btn btn-primary btn-lg" type="hidden" value="register">
			<button class="btn btn-primary btn-lg" type="submit"><?php echo esc_html( $btn_register ) ?></button>
		</div>
	</form>

	<?php
}
?>
<script>
	jQuery( function ( $ ) {
		var
			$country  = $( '#field-country' ),
			$location = $( '#field-diving_location' );

		$location.children( '[value]' ).hide();

		$country.change( function () {
			var parent = this.value.split( '::' )[0];
			$location.val( '' );
			$location.children( '[value]' ).hide();
			$location.children( '[data-parent="' + parent + '"]' ).show();
		} );
	} );
</script>
