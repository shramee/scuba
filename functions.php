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

		include 'inc/template-tags.php';

		include 'inc/filters.php';

		add_action( 'wp', [ $this, 'wp' ] );
		add_action( 'vc_basic_grid_template_filter', [ $this, 'vc_basic_grid_template_filter' ] );

		add_action( 'show_user_profile', [ $this, 'profile_fields' ] );
		add_action( 'edit_user_profile', [ $this, 'profile_fields' ] );
	}

	public function wp() {
		self::$home = is_front_page();
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
			'value' => get_user_meta( $user_id, 'nationality', 1 )
		];
		$fields['id_number'] = [
			'label' => __( 'Certification ID number', 'scuba' ),
			'value' => get_user_meta( $user_id, 'id_number', 1 )
		];
		$fields['certification_level'] = [
			'label' => __( 'Certification level', 'scuba' ),
			'value' => get_user_meta( $user_id, 'certification_level', 1 )
		];
		$fields['certification_number'] = [
			'label' => __( 'Certification number', 'scuba' ),
			'value' => get_user_meta( $user_id, 'certification_number', 1 )
		];
		$fields['certification_agency'] = [
			'label' => __( 'Certification agency', 'scuba' ),
			'value' => get_user_meta( $user_id, 'certification_agency', 1 )
		];
		$fields['equipment_preference'] = [
			'label' => __( 'Equipment preference', 'scuba' ),
			'type' => 'textbox',
			'value' => get_user_meta( $user_id, 'equipment_preference', 1 )
		];

		$certification_card = get_user_meta( $user_id, 'certification_card', 1 );
		$certification_card_full = get_user_meta( $user_id, 'certification_card_full', 1 );
		if ( is_numeric( $certification_card ) ) {
			$certification_card = wp_get_attachment_image_url( $certification_card, 'large' );
			$certification_card_full = wp_get_attachment_image_url( $certification_card, 'full' );
		}
		?>
		<h3 id="operator-info"><?php _e("Operator information", "blank"); ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="certification-card">Operator type</label></th>
				<td>
					<select required name="operator_type">

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
				?>
				<tr>
					<th><label for="<?php echo $k ?>"><?php echo $f['label']; ?></label></th>
					<td>
						<?php if ( isset( $f['type'] ) && $f['type'] == 'textarea' ) {
							?>
							<textarea name="<?php echo $k ?>" id="<?php echo $k ?>"><?php echo $f['value']; ?></textarea>
							<?php
						} else  {
							?>
							<input type="text" name="<?php echo $k ?>" id="<?php echo $k ?>" value="<?php echo $f['value']; ?>" class="regular-text" />
							<?php
						} ?>
					</td>
				</tr>
				<?php
			} ?>
		</table>
		<?php
	}

	function save_profile_fields( $user_id ) {
		if ( !current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}
		update_user_meta( $user_id, 'nationality', filter_input( INPUT_POST, 'nationality' ) );
		update_user_meta( $user_id, 'id_number', filter_input( INPUT_POST, 'id_number' ) );
		update_user_meta( $user_id, 'certification_level', filter_input( INPUT_POST, 'certification_level' ) );
		update_user_meta( $user_id, 'certification_number', filter_input( INPUT_POST, 'certification_number' ) );
		update_user_meta( $user_id, 'certification_agency', filter_input( INPUT_POST, 'certification_agency' ) );
		update_user_meta( $user_id, 'equipment_preference', filter_input( INPUT_POST, 'equipment_preference' ) );
	}
}

Scubahive::instance();
