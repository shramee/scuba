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
		'label'    => '',
		'value'    => '',
		'class'    => 'form-control',
		'type'     => 'text',
		'required' => '',
		'field_tpl' => '<div class="form-group">%label%%input%</div>',
	];

	public function __construct( $default_args = [] ) {
		$this->default_args = wp_parse_args( $default_args, $this->default_args );
	}

	/**
	 * Form class method to build a form from an array
	 * @param bool|array $fields Fields or echo
	 * @param bool $echo Whether or not to echo the form
	 * @return string $output contains the form as HTML
	 *
	 */
	function render( $fields = [], $echo = true ) {
		$output = '';

		// Loop through each form element and render it.
		foreach ( $fields as $name => $field ) {

			if ( is_string( $field ) ) {
				$field = [
					'label'    => $field,
				];
				if ( stripos( $name, 'password' ) ) {
					$field['type'] = 'password';
				}
			}

			$field = wp_parse_args( $field, $this->default_args );

			$field = wp_parse_args( $field, [
				'id'       => "field-$name",
				'render_func'   => [ $this, "$field[type]_field" ],
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
		$checked = checked( ! ! $field['value'], true, false );
		$field['field_tpl'] = str_replace( '%label%%input%', '%input%%label%', $field['field_tpl'] );
		return "<input name='$name' id='$field[id]' value='1' $checked>";
	}
}