<?php
/**
 * Registers partners
 */

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

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		$attachment_id = media_handle_upload( 'certification_card', 0 );

		update_user_meta( $user_id, 'operator_type', filter_input( INPUT_POST, 'operator_type' ) );
		update_user_meta( $user_id, 'nationality', filter_input( INPUT_POST, 'nationality' ) );
		update_user_meta( $user_id, 'id_number', filter_input( INPUT_POST, 'id_number' ) );
		update_user_meta( $user_id, 'certification_level', filter_input( INPUT_POST, 'certification_level' ) );
		update_user_meta( $user_id, 'certification_number', filter_input( INPUT_POST, 'certification_number' ) );
		update_user_meta( $user_id, 'certification_agency', filter_input( INPUT_POST, 'certification_agency' ) );
		update_user_meta( $user_id, 'equipment_preference', filter_input( INPUT_POST, 'equipment_preference' ) );
		update_user_meta( $user_id, 'certification_card', wp_get_attachment_image_url( $attachment_id, 'large' ) );
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
