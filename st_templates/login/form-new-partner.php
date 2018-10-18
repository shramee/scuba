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

$fields_renderer = new Shramee_Form_Fields( [
	'required'  => 1,
	'field_tpl' => '<div class="col-md-6"><div class="form-group">%label%%input%</div></div>',
] );
?>

<?php

$nationality_ops = [
	'New Zealander',
	'Afghan',
	'Albanian',
	'Algerian',
	'American',
	'Andorran',
	'Angolan',
	'Antiguans',
	'Argentinean',
	'Armenian',
	'Australian',
	'Austrian',
	'Azerbaijani',
	'Bahamian',
	'Bahraini',
	'Bangladeshi',
	'Barbadian',
	'Barbudans',
	'Batswana',
	'Belarusian',
	'Belgian',
	'Belizean',
	'Beninese',
	'Bhutanese',
	'Bolivian',
	'Bosnian',
	'Brazilian',
	'British',
	'Bruneian',
	'Bulgarian',
	'Burkinabe',
	'Burmese',
	'Burundian',
	'Cambodian',
	'Cameroonian',
	'Canadian',
	'Cape Verdean',
	'Central African',
	'Chadian',
	'Chilean',
	'Chinese',
	'Colombian',
	'Comoran',
	'Congolese',
	'Costa Rican',
	'Croatian',
	'Cuban',
	'Cypriot',
	'Czech',
	'Danish',
	'Djibouti',
	'Dominican',
	'Dutch',
	'East Timorese',
	'Ecuadorean',
	'Egyptian',
	'Emirian',
	'Equatorial Guinean',
	'Eritrean',
	'Estonian',
	'Ethiopian',
	'Fijian',
	'Filipino',
	'Finnish',
	'French',
	'Gabonese',
	'Gambian',
	'Georgian',
	'German',
	'Ghanaian',
	'Greek',
	'Grenadian',
	'Guatemalan',
	'Guinea-Bissauan',
	'Guinean',
	'Guyanese',
	'Haitian',
	'Herzegovinian',
	'Honduran',
	'Hungarian',
	'Icelander',
	'Indian',
	'Indonesian',
	'Iranian',
	'Iraqi',
	'Irish',
	'Israeli',
	'Italian',
	'Ivorian',
	'Jamaican',
	'Japanese',
	'Jordanian',
	'Kazakhstani',
	'Kenyan',
	'Kittian and Nevisian',
	'Kuwaiti',
	'Kyrgyz',
	'Laotian',
	'Latvian',
	'Lebanese',
	'Liberian',
	'Libyan',
	'Liechtensteiner',
	'Lithuanian',
	'Luxembourger',
	'Macedonian',
	'Malagasy',
	'Malawian',
	'Malaysian',
	'Maldivan',
	'Malian',
	'Maltese',
	'Marshallese',
	'Mauritanian',
	'Mauritian',
	'Mexican',
	'Micronesian',
	'Moldovan',
	'Monacan',
	'Mongolian',
	'Moroccan',
	'Mosotho',
	'Motswana',
	'Mozambican',
	'Namibian',
	'Nauruan',
	'Nepalese',
	'Ni-Vanuatu',
	'Nicaraguan',
	'Nigerien',
	'North Korean',
	'Northern Irish',
	'Norwegian',
	'Omani',
	'Pakistani',
	'Palauan',
	'Panamanian',
	'Papua New Guinean',
	'Paraguayan',
	'Peruvian',
	'Polish',
	'Portuguese',
	'Qatari',
	'Romanian',
	'Russian',
	'Rwandan',
	'Saint Lucian',
	'Salvadoran',
	'Samoan',
	'San Marinese',
	'Sao Tomean',
	'Saudi',
	'Scottish',
	'Senegalese',
	'Serbian',
	'Seychellois',
	'Sierra Leonean',
	'Singaporean',
	'Slovakian',
	'Slovenian',
	'Solomon Islander',
	'Somali',
	'South African',
	'South Korean',
	'Spanish',
	'Sri Lankan',
	'Sudanese',
	'Surinamer',
	'Swazi',
	'Swedish',
	'Swiss',
	'Syrian',
	'Taiwanese',
	'Tajik',
	'Tanzanian',
	'Thai',
	'Togolese',
	'Tongan',
	'Trinidadian or Tobagonian',
	'Tunisian',
	'Turkish',
	'Tuvaluan',
	'Ugandan',
	'Ukrainian',
	'Uruguayan',
	'Uzbekistani',
	'Venezuelan',
	'Vietnamese',
	'Welsh',
	'Yemenite',
	'Zambian',
	'Zimbabwean',
];
$country_ops     = [
	"Afghanistan",
	"Albania",
	"Algeria",
	"American Samoa",
	"Andorra",
	"Angola",
	"Anguilla",
	"Antarctica",
	"Antigua and Barbuda",
	"Argentina",
	"Armenia",
	"Aruba",
	"Australia",
	"Austria",
	"Azerbaijan",
	"Bahamas",
	"Bahrain",
	"Bangladesh",
	"Barbados",
	"Belarus",
	"Belgium",
	"Belize",
	"Benin",
	"Bermuda",
	"Bhutan",
	"Bolivia",
	"Bosnia and Herzegovina",
	"Botswana",
	"Bouvet Island",
	"Brazil",
	"British Indian Ocean Territory",
	"Brunei Darussalam",
	"Bulgaria",
	"Burkina Faso",
	"Burundi",
	"Cambodia",
	"Cameroon",
	"Canada",
	"Cape Verde",
	"Cayman Islands",
	"Central African Republic",
	"Chad",
	"Chile",
	"China",
	"Christmas Island",
	"Cocos (Keeling) Islands",
	"Colombia",
	"Comoros",
	"Congo",
	"Congo, the Democratic Republic of the",
	"Cook Islands",
	"Costa Rica",
	"Cote D'Ivoire",
	"Croatia",
	"Cuba",
	"Cyprus",
	"Czech Republic",
	"Denmark",
	"Djibouti",
	"Dominica",
	"Dominican Republic",
	"Ecuador",
	"Egypt",
	"El Salvador",
	"Equatorial Guinea",
	"Eritrea",
	"Estonia",
	"Ethiopia",
	"Falkland Islands (Malvinas)",
	"Faroe Islands",
	"Fiji",
	"Finland",
	"France",
	"French Guiana",
	"French Polynesia",
	"French Southern Territories",
	"Gabon",
	"Gambia",
	"Georgia",
	"Germany",
	"Ghana",
	"Gibraltar",
	"Greece",
	"Greenland",
	"Grenada",
	"Guadeloupe",
	"Guam",
	"Guatemala",
	"Guinea",
	"Guinea-Bissau",
	"Guyana",
	"Haiti",
	"Heard Island and Mcdonald Islands",
	"Holy See (Vatican City State)",
	"Honduras",
	"Hong Kong",
	"Hungary",
	"Iceland",
	"India",
	"Indonesia",
	"Iran, Islamic Republic of",
	"Iraq",
	"Ireland",
	"Israel",
	"Italy",
	"Jamaica",
	"Japan",
	"Jordan",
	"Kazakhstan",
	"Kenya",
	"Kiribati",
	"Korea, Democratic People's Republic of",
	"Korea, Republic of",
	"Kuwait",
	"Kyrgyzstan",
	"Lao People's Democratic Republic",
	"Latvia",
	"Lebanon",
	"Lesotho",
	"Liberia",
	"Libyan Arab Jamahiriya",
	"Liechtenstein",
	"Lithuania",
	"Luxembourg",
	"Macao",
	"Macedonia, the Former Yugoslav Republic of",
	"Madagascar",
	"Malawi",
	"Malaysia",
	"Maldives",
	"Mali",
	"Malta",
	"Marshall Islands",
	"Martinique",
	"Mauritania",
	"Mauritius",
	"Mayotte",
	"Mexico",
	"Micronesia, Federated States of",
	"Moldova, Republic of",
	"Monaco",
	"Mongolia",
	"Montserrat",
	"Morocco",
	"Mozambique",
	"Myanmar",
	"Namibia",
	"Nauru",
	"Nepal",
	"Netherlands",
	"Netherlands Antilles",
	"New Caledonia",
	"New Zealand",
	"Nicaragua",
	"Niger",
	"Nigeria",
	"Niue",
	"Norfolk Island",
	"Northern Mariana Islands",
	"Norway",
	"Oman",
	"Pakistan",
	"Palau",
	"Palestinian Territory, Occupied",
	"Panama",
	"Papua New Guinea",
	"Paraguay",
	"Peru",
	"Philippines",
	"Pitcairn",
	"Poland",
	"Portugal",
	"Puerto Rico",
	"Qatar",
	"Reunion",
	"Romania",
	"Russian Federation",
	"Rwanda",
	"Saint Helena",
	"Saint Kitts and Nevis",
	"Saint Lucia",
	"Saint Pierre and Miquelon",
	"Saint Vincent and the Grenadines",
	"Samoa",
	"San Marino",
	"Sao Tome and Principe",
	"Saudi Arabia",
	"Senegal",
	"Serbia and Montenegro",
	"Seychelles",
	"Sierra Leone",
	"Singapore",
	"Slovakia",
	"Slovenia",
	"Solomon Islands",
	"Somalia",
	"South Africa",
	"South Georgia and the South Sandwich Islands",
	"Spain",
	"Sri Lanka",
	"Sudan",
	"Suriname",
	"Svalbard and Jan Mayen",
	"Swaziland",
	"Sweden",
	"Switzerland",
	"Syrian Arab Republic",
	"Taiwan, Province of China",
	"Tajikistan",
	"Tanzania, United Republic of",
	"Thailand",
	"Timor-Leste",
	"Togo",
	"Tokelau",
	"Tonga",
	"Trinidad and Tobago",
	"Tunisia",
	"Turkey",
	"Turkmenistan",
	"Turks and Caicos Islands",
	"Tuvalu",
	"Uganda",
	"Ukraine",
	"United Arab Emirates",
	"United Kingdom",
	"United States",
	"United States Minor Outlying Islands",
	"Uruguay",
	"Uzbekistan",
	"Vanuatu",
	"Venezuela",
	"Viet Nam",
	"Virgin Islands, British",
	"Virgin Islands, U.s.",
	"Wallis and Futuna",
	"Western Sahara",
	"Yemen",
	"Zambia",
	"Zimbabwe",
];

if ( isset( $_GET['individual'] ) ) {
	?>
	<h2 class="text-center"><?php _e( 'Register as Diving professional', 'scuba' ) ?></h2>
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
					'options' => $nationality_ops,
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
	<p class="text-center">
		<?php _e( 'Want to register as an individual?', 'scuba' ) ?>
		<a href="?individual"><?php _e( 'Click here', 'scuba' ) ?></a>
	</p>
	<form id="operator-registration-form" class="register_form" data-reset="<?php echo esc_attr( $reset ) ?>"
				method="post" enctype="multipart/form-data"
				action="<?php echo esc_url( add_query_arg( array( 'url' => STInput::request( 'url' ) ) ) ) ?>">
		<input type="hidden" name="register_as" value="<?php echo $_REQUEST['register_as'] ?>">
		<div class="row mt20 data_field">

			<div class="col-md-12">
				<div class="form-group ">
					<label for="field-operator-type">Organisation Type</label>
				</div>
				<div class="scuba-btn-grp">

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
			$fields_renderer->render( [
				'org_name'               => __( 'Organisation name', 'scuba' ),
				'org_number'             => __( 'Business registration number', 'scuba' ),
				'tourism_license_number' => __( 'Tourism license number', 'scuba' ),
				'website'     => [
					'label' => __( 'Website URL', 'scuba' ),
					'type'  => 'url',
				],
				'full_name'              => __( 'Main contact full name', 'scuba' ),
				'user_name'              => __( 'User Name', 'scuba' ),
				'email'                  => __( 'Email', 'scuba' ),
				'password'               => __( 'Password', 'scuba' ),
				'contact'                => [
					'label' => __( 'Phone number', 'scuba' ),
					'type'  => 'tel',
				],
				'mobile'                => [
					'label' => __( 'Mobile', 'scuba' ),
					'type'  => 'tel',
				],

				'address'                => __( 'Address', 'scuba' ),
				'state'                  => __( 'State', 'scuba' ),
				'Postcode'               => __( 'Postcode', 'scuba' ),
				'country'                => [
					'label'   => __( 'Country', 'scuba' ),
					'options' => $country_ops,
					'type'    => 'select',
					'required' => false,
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
