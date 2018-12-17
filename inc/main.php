<?php

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

		add_action( 'wp', [ $this, 'wp' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
		add_action( 'vc_basic_grid_template_filter', [ $this, 'vc_basic_grid_template_filter' ] );

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

	function save_profile_fields( $user_id ) {
		if ( current_user_can( 'edit_user', $user_id ) ) {
			$this->save_user_meta( $user_id );
		}
	}
}

Scubahive::instance();
