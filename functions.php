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
	}

	public function wp() {
		self::$home = is_front_page();
	}
}

Scubahive::instance();
