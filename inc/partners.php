<?php

class Scubahive_Partners {

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

	protected static $fields = [];

	public function __construct() {

//		add_action( 'show_user_profile', [ $this, 'profile_fields' ] );
//		add_action( 'edit_user_profile', [ $this, 'profile_fields' ] );

	}

	/**
	 * @param WP_User $user
	 */
	public function profile_fields( $user ) {


		$op_type = get_user_meta( $user->ID, 'operator_type', filter_input( INPUT_POST, 'operator_type' ) );

		?>
		<h3 id="operator-info"><?php _e( "Operator information", "blank" ); ?></h3>
		<table class="form-table">
			<tr>
				<th><label for="operator_type">Operator type</label></th>
				<td>
					<select required id="operator_type" name="operator_type">

						<option value="professional" <?php selected( $op_type, 'professional' ) ?>>
							Dive Professional
						</option>

						<option value="center" <?php selected( $op_type, 'center' ) ?>>
							Dive Center
						</option>

						<option value="resort" <?php selected( $op_type, 'resort' ) ?>>
							Dive Resort
						</option>

						<option value="liveaboard" <?php selected( $op_type, 'liveaboard' ) ?>>
							Liveaboard
						</option>

						<option value="academy" <?php selected( $op_type, 'academy' ) ?>>
							Dive Academy
						</option>
					</select>
				</td>
			</tr>
			<?php
			$fields_renderer = new Shramee_Form_Fields( [
				'required'  => 1,
				'class'     => 'regular-input',
				'field_tpl' => '<tr><th>%label%</th><td>%input%</td></tr>',
			] );

			$fields_renderer->render( Scubahive_Partners::get_fields() );
			?>
		</table>
		<?php
	}

	public static function get_fields( $type = '' ) {

		if ( ! self::$fields ) {
			$country_ops = [];

			$locations = get_posts( [
				'post_type' => 'location',
				'parent'    => 0,
			] );

			foreach ( $locations as $location ) {
				/** @var WP_Post $location */
				$country_ops[ $location->ID ] = $location->post_title;
			}

			self::$fields = [
				'org_name'               => [
					'label' => __( 'Organisation name', 'scuba' ),
				],
				'org_number'             => [
					'label' => __( 'Business registration number', 'scuba' ),
				],
				'tourism_license_number' => [
					'label' => __( 'Tourism license number', 'scuba' ),
				],
				'website'                => [
					'label' => __( 'Website URL', 'scuba' ),
					'type'  => 'url',
				],
				'full_name'              => [
					'label' => __( 'Main contact full name', 'scuba' ),
				],
				'user_name'              => [
					'label' => __( 'User Name', 'scuba' ),
				],
				'email'                  => [
					'label' => __( 'Email', 'scuba' ),
				],
				'password'               => [
					'label' => __( 'Password', 'scuba' ),
					'type'  => 'password',
				],
				'contact'                => [
					'label' => __( 'Phone number', 'scuba' ),
					'type'  => 'tel',
				],
				'mobile'                 => [
					'label' => __( 'Mobile', 'scuba' ),
					'type'  => 'tel',
				],

				'address'  => [
					'label' => __( 'Address', 'scuba' ),
				],
				'state'    => [
					'label' => __( 'State', 'scuba' ),
				],
				'postcode' => [
					'label' => __( 'Postcode', 'scuba' ),
				],
				'country'  => [
					'label'    => __( 'Country', 'scuba' ),
					'options'  => $country_ops,
					'type'     => 'select',
					'required' => false,
				],
			];
		}

		if ( $type === 'admin' ) {
			unset( self::$fields['org_name'] );
			unset( self::$fields['full_name'] );
			unset( self::$fields['user_name'] );
			unset( self::$fields['email'] );
			unset( self::$fields['password'] );
			unset( self::$fields[''] );

			foreach ( self::$fields as $k => $f ) {
				self::$fields[ $k ]['value'] = get_user_meta( get_current_user_id(), $k, 1 );

			}
		}

		return self::$fields;
	}

	public static function register_user() {
		$userdata = [
			'user_login' => esc_attr( $_REQUEST['user_name'] ),
			'user_email' => esc_attr( $_REQUEST['email'] ),
			'user_pass'  => esc_attr( $_REQUEST['password'] ),
			'first_name' => esc_attr( $_REQUEST['full_name'] ),
		];

		if ( is_wp_error( STUser_f::validation() ) ) {
			echo '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
			echo '<strong>' . STUser_f::validation()->get_error_message() . '</strong>';
			echo '</div>';
		} else {
			$user_id = wp_insert_user( $userdata );
			wp_new_user_notification( $user_id, null, 'user' );
			if ( is_wp_error( $user_id ) ) {
				echo '<div  class="alert alert-danger"><button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span></button>';
				echo '<strong>' . $user_id->get_error_message() . '</strong>';
				echo '</div>';
			} else {
				$class_user = new STUser_f();
				$class_user->_update_info_user( $user_id );

				if ( ! function_exists( 'media_handle_upload' ) ) {
					require_once ABSPATH . 'wp-admin/includes/image.php';
					require_once ABSPATH . 'wp-admin/includes/file.php';
					require_once ABSPATH . 'wp-admin/includes/media.php';
				}
				$attachment_id = media_handle_upload( 'certification_card', 0 );

				self::save_meta( $user_id );

				update_user_meta( $user_id, 'certification_card', wp_get_attachment_image_url( $attachment_id, 'medium' ) );
				update_user_meta( $user_id, 'certification_card_full', wp_get_attachment_image_url( $attachment_id, 'full' ) );
				update_user_meta( $user_id, 'certification_card_id', $attachment_id );
				?>
				<script>
					window.location = "<?php echo home_url( 'thanks-for-partnering' ); ?>";
				</script>
				<?php
				exit;
			}
		}
	}

	private static function save_meta( $user_id ) {

		$fields = self::get_fields();

		update_user_meta( $user_id, 'operator_type', filter_input( INPUT_POST, 'operator_type' ) );

		foreach ( $fields as $k => $f ) {
			update_user_meta( $user_id, $k, filter_input( INPUT_POST, $k ) );
		}

	}

}

Scubahive_Partners::instance();