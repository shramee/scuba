<?php

/**
 * Form Class
 *
 * Responsible for building forms
 *
 * @param array $fields renderable array containing form fields
 *
 * @return void
 */
class Shramee_Form_Fields {

	public $prefix = '';
	public $default_args = [
		'label'     => '',
		'value'     => '',
		'class'     => 'form-control',
		'type'      => 'text',
		'required'  => '',
		'field_tpl' => '<div class="form-group">%label%%input%</div>',
	];

	public function __construct( $default_args = [] ) {
		$this->default_args = wp_parse_args( $default_args, $this->default_args );
	}

	public function __get( $name ) {
		if ( $this->$name ) {
			return $this->$name;
		}

		return null;
	}

	/**
	 * Form class method to build a form from an array
	 *
	 * @param bool|array $fields Fields or echo
	 * @param bool $echo Whether or not to echo the form
	 *
	 * @return string $output contains the form as HTML
	 *
	 */
	function render( $fields = [], $echo = true ) {
		$output = '';

		// Loop through each form element and render it.
		foreach ( $fields as $name => $field ) {

			if ( is_string( $field ) ) {
				$field = [
					'label' => $field,
				];
				if ( stripos( $name, 'password' ) ) {
					$field['type'] = 'password';
				}
			}

			$field = wp_parse_args( $field, $this->default_args );

			$field = wp_parse_args( $field, [
				'id'          => "field-$name",
				'render_func' => [ $this, "$field[type]_field" ],
			] );

			if ( $field['required'] ) {
				$field['required'] = 'required';
			}

			$label = "<label for='$field[id]'>$field[label]</label>";

			if ( is_callable( $field['render_func'] ) ) {
				$input = call_user_func( $field['render_func'], $name, $field );
			} else {
				$input = $this->default_field( $name, $field );
			}

			$output .= str_replace( [ '%label%', '%input%' ], [ $label, $input ], $field['field_tpl'] );
		}

		if ( $echo ) {
			echo $output;
		}

		return $output;
	}

	protected function default_field( $name, $field ) {
		return "<input name='$name' id='$field[id]' class='$field[class]' value='$field[value]' type='$field[type]' $field[required]>";
	}

	protected function select_field( $name, $field ) {
		$input = "<select name='$name' id='$field[id]' class='$field[class]' $field[required]>";

		foreach ( $field['options'] as $val => $choice ) {
			if ( is_numeric( $val ) ) {
				$val = $choice;
			}
			$input .= "<option value='$val' " . selected( $val, $field['value'] ) . ">$choice</option>";
		}

		$input .= '</select>';

		return $input;
	}

	protected function textarea_field( $name, $field ) {
		return "<textarea name='$name' id='$field[id]' class='$field[class]' $field[required]>>$field[value]</textarea>";
	}

	protected function checkbox_field( $name, &$field ) {
		$checked            = checked( ! ! $field['value'], true, false );
		$field['field_tpl'] = str_replace( '%label%%input%', '%input%%label%', $field['field_tpl'] );

		return "<input name='$name' id='$field[id]' value='1' $checked>";
	}

	/** @var array Nationality data */
	protected $nationality_ops = [
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

	/** @var array Country data */
	protected $country_ops = [
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
}