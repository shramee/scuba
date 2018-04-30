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
$_POST['register_as'] = 'partner';

$reset = 'false';
if ( ! empty( $_REQUEST['btn_reg'] ) ) {
	include get_stylesheet_directory() . '/inc/register-partner.php';
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
?>

<form class="register_form" data-reset="<?php echo esc_attr( $reset ) ?>" method="post" enctype="multipart/form-data"
			action="<?php echo esc_url( add_query_arg( array( 'url' => STInput::request( 'url' ) ) ) ) ?>">
	<input type="hidden" name="register_as" value="<?php echo $_REQUEST['register_as'] ?>">

	<div class="row mt30 ">
		<div class="col-md-12">
			<div class="form-group ">
				<label for="field-operator-type">Operator Type <span class="color-red"> (*)</span></label>
			</div>
			<div class="scuba-btn-grp">

				<input type="radio" required name="operator_type" id="operator-type-professional" value="professional">
				<label for="operator-type-professional">Dive Professional</label>

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

	<!-- region Basic info -->

	<div class="row mt20 data_field">
		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-full_name"><?php _e( 'Person/Organisation name' ) ?></label>
				<input required id="field-full_name" name="full_name" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-email"><?php st_the_language( 'email' ) ?><span class="color-red"> (*)</span></label>
				<input required id="field-email" name="email" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-user_name"><?php _e( "User Name", 'scuba' ) ?><span
						class="color-red"> (*)</span></label>
				<input required id="field-user_name" name="user_name" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-password"><?php st_the_language( 'password' ) ?><span class="color-red"> (*)</span></label>
				<input required id="field-password" name="password" class="form-control" type="password">
			</div>
		</div>

	</div>

	<!-- endregion Basic info -->

	<!-- region ID info -->
	<div class="row mt20 data_field">

		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-nationality"><?php _e( 'Nationality', 'scuba' ) ?><span class="color-red"> (*)</span></label>
				<select required id="field-nationality" name="nationality" class="form-control">
					<option value="">-- select one --</option>
					<option value="New Zealander">New Zealander</option>
					<option value="Afghan">Afghan</option>
					<option value="Albanian">Albanian</option>
					<option value="Algerian">Algerian</option>
					<option value="American">American</option>
					<option value="Andorran">Andorran</option>
					<option value="Angolan">Angolan</option>
					<option value="Antiguans">Antiguans</option>
					<option value="Argentinean">Argentinean</option>
					<option value="Armenian">Armenian</option>
					<option value="Australian">Australian</option>
					<option value="Austrian">Austrian</option>
					<option value="Azerbaijani">Azerbaijani</option>
					<option value="Bahamian">Bahamian</option>
					<option value="Bahraini">Bahraini</option>
					<option value="Bangladeshi">Bangladeshi</option>
					<option value="Barbadian">Barbadian</option>
					<option value="Barbudans">Barbudans</option>
					<option value="Batswana">Batswana</option>
					<option value="Belarusian">Belarusian</option>
					<option value="Belgian">Belgian</option>
					<option value="Belizean">Belizean</option>
					<option value="Beninese">Beninese</option>
					<option value="Bhutanese">Bhutanese</option>
					<option value="Bolivian">Bolivian</option>
					<option value="Bosnian">Bosnian</option>
					<option value="Brazilian">Brazilian</option>
					<option value="British">British</option>
					<option value="Bruneian">Bruneian</option>
					<option value="Bulgarian">Bulgarian</option>
					<option value="Burkinabe">Burkinabe</option>
					<option value="Burmese">Burmese</option>
					<option value="Burundian">Burundian</option>
					<option value="Cambodian">Cambodian</option>
					<option value="Cameroonian">Cameroonian</option>
					<option value="Canadian">Canadian</option>
					<option value="Cape Verdean">Cape Verdean</option>
					<option value="Central African">Central African</option>
					<option value="Chadian">Chadian</option>
					<option value="Chilean">Chilean</option>
					<option value="Chinese">Chinese</option>
					<option value="Colombian">Colombian</option>
					<option value="Comoran">Comoran</option>
					<option value="Congolese">Congolese</option>
					<option value="Costa Rican">Costa Rican</option>
					<option value="Croatian">Croatian</option>
					<option value="Cuban">Cuban</option>
					<option value="Cypriot">Cypriot</option>
					<option value="Czech">Czech</option>
					<option value="Danish">Danish</option>
					<option value="Djibouti">Djibouti</option>
					<option value="Dominican">Dominican</option>
					<option value="Dutch">Dutch</option>
					<option value="East Timorese">East Timorese</option>
					<option value="Ecuadorean">Ecuadorean</option>
					<option value="Egyptian">Egyptian</option>
					<option value="Emirian">Emirian</option>
					<option value="Equatorial Guinean">Equatorial Guinean</option>
					<option value="Eritrean">Eritrean</option>
					<option value="Estonian">Estonian</option>
					<option value="Ethiopian">Ethiopian</option>
					<option value="Fijian">Fijian</option>
					<option value="Filipino">Filipino</option>
					<option value="Finnish">Finnish</option>
					<option value="French">French</option>
					<option value="Gabonese">Gabonese</option>
					<option value="Gambian">Gambian</option>
					<option value="Georgian">Georgian</option>
					<option value="German">German</option>
					<option value="Ghanaian">Ghanaian</option>
					<option value="Greek">Greek</option>
					<option value="Grenadian">Grenadian</option>
					<option value="Guatemalan">Guatemalan</option>
					<option value="Guinea-Bissauan">Guinea-Bissauan</option>
					<option value="Guinean">Guinean</option>
					<option value="Guyanese">Guyanese</option>
					<option value="Haitian">Haitian</option>
					<option value="Herzegovinian">Herzegovinian</option>
					<option value="Honduran">Honduran</option>
					<option value="Hungarian">Hungarian</option>
					<option value="Icelander">Icelander</option>
					<option value="Indian">Indian</option>
					<option value="Indonesian">Indonesian</option>
					<option value="Iranian">Iranian</option>
					<option value="Iraqi">Iraqi</option>
					<option value="Irish">Irish</option>
					<option value="Israeli">Israeli</option>
					<option value="Italian">Italian</option>
					<option value="Ivorian">Ivorian</option>
					<option value="Jamaican">Jamaican</option>
					<option value="Japanese">Japanese</option>
					<option value="Jordanian">Jordanian</option>
					<option value="Kazakhstani">Kazakhstani</option>
					<option value="Kenyan">Kenyan</option>
					<option value="Kittian and Nevisian">Kittian and Nevisian</option>
					<option value="Kuwaiti">Kuwaiti</option>
					<option value="Kyrgyz">Kyrgyz</option>
					<option value="Laotian">Laotian</option>
					<option value="Latvian">Latvian</option>
					<option value="Lebanese">Lebanese</option>
					<option value="Liberian">Liberian</option>
					<option value="Libyan">Libyan</option>
					<option value="Liechtensteiner">Liechtensteiner</option>
					<option value="Lithuanian">Lithuanian</option>
					<option value="Luxembourger">Luxembourger</option>
					<option value="Macedonian">Macedonian</option>
					<option value="Malagasy">Malagasy</option>
					<option value="Malawian">Malawian</option>
					<option value="Malaysian">Malaysian</option>
					<option value="Maldivan">Maldivan</option>
					<option value="Malian">Malian</option>
					<option value="Maltese">Maltese</option>
					<option value="Marshallese">Marshallese</option>
					<option value="Mauritanian">Mauritanian</option>
					<option value="Mauritian">Mauritian</option>
					<option value="Mexican">Mexican</option>
					<option value="Micronesian">Micronesian</option>
					<option value="Moldovan">Moldovan</option>
					<option value="Monacan">Monacan</option>
					<option value="Mongolian">Mongolian</option>
					<option value="Moroccan">Moroccan</option>
					<option value="Mosotho">Mosotho</option>
					<option value="Motswana">Motswana</option>
					<option value="Mozambican">Mozambican</option>
					<option value="Namibian">Namibian</option>
					<option value="Nauruan">Nauruan</option>
					<option value="Nepalese">Nepalese</option>
					<option value="Ni-Vanuatu">Ni-Vanuatu</option>
					<option value="Nicaraguan">Nicaraguan</option>
					<option value="Nigerien">Nigerien</option>
					<option value="North Korean">North Korean</option>
					<option value="Northern Irish">Northern Irish</option>
					<option value="Norwegian">Norwegian</option>
					<option value="Omani">Omani</option>
					<option value="Pakistani">Pakistani</option>
					<option value="Palauan">Palauan</option>
					<option value="Panamanian">Panamanian</option>
					<option value="Papua New Guinean">Papua New Guinean</option>
					<option value="Paraguayan">Paraguayan</option>
					<option value="Peruvian">Peruvian</option>
					<option value="Polish">Polish</option>
					<option value="Portuguese">Portuguese</option>
					<option value="Qatari">Qatari</option>
					<option value="Romanian">Romanian</option>
					<option value="Russian">Russian</option>
					<option value="Rwandan">Rwandan</option>
					<option value="Saint Lucian">Saint Lucian</option>
					<option value="Salvadoran">Salvadoran</option>
					<option value="Samoan">Samoan</option>
					<option value="San Marinese">San Marinese</option>
					<option value="Sao Tomean">Sao Tomean</option>
					<option value="Saudi">Saudi</option>
					<option value="Scottish">Scottish</option>
					<option value="Senegalese">Senegalese</option>
					<option value="Serbian">Serbian</option>
					<option value="Seychellois">Seychellois</option>
					<option value="Sierra Leonean">Sierra Leonean</option>
					<option value="Singaporean">Singaporean</option>
					<option value="Slovakian">Slovakian</option>
					<option value="Slovenian">Slovenian</option>
					<option value="Solomon Islander">Solomon Islander</option>
					<option value="Somali">Somali</option>
					<option value="South African">South African</option>
					<option value="South Korean">South Korean</option>
					<option value="Spanish">Spanish</option>
					<option value="Sri Lankan">Sri Lankan</option>
					<option value="Sudanese">Sudanese</option>
					<option value="Surinamer">Surinamer</option>
					<option value="Swazi">Swazi</option>
					<option value="Swedish">Swedish</option>
					<option value="Swiss">Swiss</option>
					<option value="Syrian">Syrian</option>
					<option value="Taiwanese">Taiwanese</option>
					<option value="Tajik">Tajik</option>
					<option value="Tanzanian">Tanzanian</option>
					<option value="Thai">Thai</option>
					<option value="Togolese">Togolese</option>
					<option value="Tongan">Tongan</option>
					<option value="Trinidadian or Tobagonian">Trinidadian or Tobagonian</option>
					<option value="Tunisian">Tunisian</option>
					<option value="Turkish">Turkish</option>
					<option value="Tuvaluan">Tuvaluan</option>
					<option value="Ugandan">Ugandan</option>
					<option value="Ukrainian">Ukrainian</option>
					<option value="Uruguayan">Uruguayan</option>
					<option value="Uzbekistani">Uzbekistani</option>
					<option value="Venezuelan">Venezuelan</option>
					<option value="Vietnamese">Vietnamese</option>
					<option value="Welsh">Welsh</option>
					<option value="Yemenite">Yemenite</option>
					<option value="Zambian">Zambian</option>
					<option value="Zimbabwean">Zimbabwean</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-id_number"><?php _e( 'Identity card/Passport number"', 'scuba' ) ?><span
						class="color-red"> (*)</span></label>
				<input required id="field-id_number" name="id_number" class="form-control">
			</div>
		</div>
	</div>

	<!-- endregion ID -->

	<!-- region Dive certificationID info -->
	<div class="row mt20 data_field">

		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-certification-level"><?php _e( 'Dive certification level', 'scuba' ) ?><span
						class="color-red"> (*)</span></label>
				<input required id="field-certification-level" name="certification_level" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-certification-number"><?php _e( 'Diver number (on certification card)', 'scuba' ) ?><span
						class="color-red"> (*)</span></label>
				<input required id="field-certification-number" name="certification_number" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-certification-agency"><?php _e( 'Dive certification agency', 'scuba' ) ?><span
						class="color-red"> (*)</span></label>
				<input required id="field-certification-agency" name="certification_agency" class="form-control">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label for="field-certification-card"><?php _e( 'Upload diving certification card (by photo)', 'scuba' ) ?><span
						class="color-red"> (*)</span></label>
				<input required id="field-certification-card" name="certification_card" class="form-control" type="file">
			</div>
		</div>
	</div>

	<!-- endregion Dive certificationID info -->

	<!-- region Equipment info -->
	<div class="row mt20 data_field">

		<div class="col-md-12">
			<div class="form-group <?php echo esc_attr( $class_form ); ?>">
				<label
					for="field-equipment-preference"><?php _e( 'Equipment rental preference and size (Mask, BCD, Regulator, Fins)', 'scuba' ) ?>
					<span class="color-red"> (*)</span></label>
				<textarea required id="field-equipment-preference" name="equipment_preference" class="form-control"></textarea>
			</div>
		</div>

	</div>
	<!-- endregion Equipment info -->

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