<?php
/**
 * Created by PhpStorm.
 * User: Shramee
 * Date: 21/08/2015
 * Time: 9:45 SA
 */

class Scubahive {
	/** @var self Instance */
	private static $_instance;

	/**
	 * Returns instance of current calss
	 * @return self Instance
	 */
	public static function instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public static $home = false;

	public function __construct() {

		include 'inc/shramee-form-fields.php';

		include 'inc/template-tags.php';

		include 'inc/filters.php';

		add_action( 'wp', [ $this, 'wp' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
		add_action( 'vc_basic_grid_template_filter', [ $this, 'vc_basic_grid_template_filter' ] );

		add_action( 'show_user_profile', [ $this, 'profile_fields' ] );
		add_action( 'edit_user_profile', [ $this, 'profile_fields' ] );

		add_action( 'personal_options_update', [ $this, 'save_profile_fields' ] );
		add_action( 'edit_user_profile_update', [ $this, 'save_profile_fields' ] );
	}

	public function wp() {
		self::$home = is_front_page();
	}

	public function enqueue() {
		wp_enqueue_style( 'scuba-main', get_stylesheet_directory_uri() . '/style.css' );
		wp_enqueue_style( 'scuba-parent', get_template_directory_uri() . '/style.css' );
	}

	public function vc_basic_grid_template_filter( $return ) {
		global $wp_query;
//		$wp_query->rewind_posts();
		return $return;
	}

	public function profile_fields( $user ) {
		$user_id = $user->ID;
		$op_type = get_user_meta( $user_id, 'operator_type', 1 );
		if ( ! $op_type )
			$op_type = 'professional';
		$fields = [];
		$fields['nationality'] = [
			'label' => __( 'Nationality', 'scuba' ),
		];
		$fields['id_number'] = [
			'label' => __( 'Certification ID number', 'scuba' ),
		];
		$fields['country'] = [
			'label' => __( 'Country', 'scuba' ),
			'field' => '<select required id="country" name="country">' . implode( '', scuba_countries( '<option value="%id%::%title%">%title%</option>' ) ) . '</select>' .
			           '<script>jQuery( "#country" ).val( "' . get_user_meta( $user_id, 'country', 1 ) . '" )</script>',
		];
		$fields['diving_location'] = [
			'label' => __( 'Diving location', 'scuba' ),
			'field' => '<select required id="diving_location" name="location">' . implode( '', scuba_locations( '<option value="%id%::%title%">%title%</option>' ) ) . '</select>' .
								 '<script>jQuery( "#diving_location" ).val( "' . get_user_meta( $user_id, 'diving_location', 1 ) . '" )</script>',
		];
		$fields['certification_level'] = [
			'label' => __( 'Certification level', 'scuba' ),
		];
		$fields['certification_number'] = [
			'label' => __( 'Certification number', 'scuba' ),
		];
		$fields['certification_agency'] = [
			'label' => __( 'Certification agency', 'scuba' ),
		];
		$fields['contact_location'] = [
			'label' => __( 'Contact location', 'scuba' ),
		];
		$fields['certification_agency'] = [
			'label' => __( 'Languages spoken', 'scuba' ),
		];
		$fields['description'] = [
			'label' => __( 'Operator description', 'scuba' ),
			'type' => 'textbox',
		];
		$fields['equipment_preference'] = [
			'label' => __( 'Equipment preference', 'scuba' ),
			'type' => 'textbox',
		];

		$certification_card = get_user_meta( $user_id, 'certification_card', 1 );
		$certification_card_full = get_user_meta( $user_id, 'certification_card_full', 1 );
		if ( is_numeric( $certification_card ) ) {
			$certification_card = wp_get_attachment_image_url( $certification_card, 'medium' );
			$certification_card_full = wp_get_attachment_image_url( $certification_card, 'full' );
		}
		?>
		<h3 id="operator-info"><?php _e("Operator information", "blank"); ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="operator_type">Operator type</label></th>
				<td>
					<select required id="operator_type" name="operator_type">

						<option value="professional" <?php selected( $op_type, 'professional' ) ?>>
							Dive Professional</option>

						<option value="center" <?php selected( $op_type, 'center' ) ?>>
							Dive Center</option>

						<option value="resort" <?php selected( $op_type, 'resort' ) ?>>
							Dive Resort</option>

						<option value="liveaboard" <?php selected( $op_type, 'liveaboard' ) ?>>
							Liveaboard</option>

						<option value="academy" <?php selected( $op_type, 'academy' ) ?>>
							Dive Academy</option>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="certification-card">Certification card</label></th>
				<td>
					<a href="<?php echo $certification_card_full; ?>">
						<img src="<?php echo $certification_card; ?>">
					</a>
				</td>
			</tr>
			<?php foreach ( $fields as $k => $f ) {
				$f['value'] = get_user_meta( $user_id, $k, 1 );
				if ( ! isset( $f['type'] ) ) $f['type'] = 'text';
				?>
				<tr>
					<th><label for="<?php echo $k ?>"><?php echo $f['label']; ?></label></th>
					<td>
						<?php
						if ( ! empty( $f['field'] ) ) {
							echo $f['field'];
						} else if ( $f['type'] == 'textarea' ) {
							?>
							<textarea name="<?php echo $k ?>" id="<?php echo $k ?>"><?php echo $f['value']; ?></textarea>
							<?php
						} else {
							?>
							<input type="<?php echo $f['type']; ?>" name="<?php echo $k ?>" id="<?php echo $k ?>" value="<?php echo $f['value']; ?>" class="regular-text" />
							<?php
						} ?>
					</td>
				</tr>
				<?php
			} ?>
		</table>
		<?php
	}

	function save_user_meta( $user_id ) {
		update_user_meta( $user_id, 'operator_type', filter_input( INPUT_POST, 'operator_type' ) );
		update_user_meta( $user_id, 'nationality', filter_input( INPUT_POST, 'nationality' ) );
		update_user_meta( $user_id, 'id_number', filter_input( INPUT_POST, 'id_number' ) );
		update_user_meta( $user_id, 'country', filter_input( INPUT_POST, 'country' ) );
		update_user_meta( $user_id, 'diving_location', filter_input( INPUT_POST, 'diving_location' ) );
		update_user_meta( $user_id, 'certification_level', filter_input( INPUT_POST, 'certification_level' ) );
		update_user_meta( $user_id, 'certification_number', filter_input( INPUT_POST, 'certification_number' ) );
		update_user_meta( $user_id, 'certification_agency', filter_input( INPUT_POST, 'certification_agency' ) );
		update_user_meta( $user_id, 'contact_location', filter_input( INPUT_POST, 'contact_location' ) );
		update_user_meta( $user_id, 'languages', filter_input( INPUT_POST, 'languages' ) );
		update_user_meta( $user_id, 'description', filter_input( INPUT_POST, 'description' ) );
		update_user_meta( $user_id, 'equipment_preference', filter_input( INPUT_POST, 'equipment_preference' ) );
	}

	function save_profile_fields( $user_id ) {
		if ( current_user_can( 'edit_user', $user_id ) ) {
			$this->save_user_meta( $user_id );
		}
	}
}

Scubahive::instance();
