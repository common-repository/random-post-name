<?php
/*
Plugin Name: Random Post Name
Plugin URI: https://wordpress.org/plugins/random-post-name/
Description: Auto-generate a unique random string and set it to post_name.
Version: 1.0
Author: PRESSMAN
Author URI: https://www.pressman.ne.jp/
License: GNU General Public License, v2 or higher
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

class Random_Post_Name {

	protected static $_instance = null;
	const POST_TYPES = ['post'];
	const DIGITS = 10;
	const CHOICES = '0123456789abcdefghijklmnopqrstuvwxyz';

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_filter( 'wp_insert_post_data', [ $this, 'set_post_name' ], 99, 2 );
	}

	public function set_post_name( $data, $post ) {
		$target_post_types = (array) apply_filters( 'random_post_name_post_types', self::POST_TYPES );

		if ( in_array( $post['post_type'], $target_post_types ) && "" === $data['post_name'] ) {
			$data['post_name'] = $this->get_random_post_name();
		}
		return $data;
	}

	private function get_random_post_name() {
		global $wpdb;

		$exist = true;
		$column = 'post_name';
		$digits = (int) apply_filters( 'random_post_name_digit', self::DIGITS );
		$choices = (string) apply_filters( 'random_post_name_choices', self::CHOICES );

		do {
			$post_name = $this->get_random_string( $choices, $digits );
			$exist = $this->is_existed( $column, $post_name );
		 } while ( true === $exist );

		return $post_name;
	}

	private function get_random_string( $choices, $digits ) {
		return substr( str_shuffle( str_repeat( $choices, $digits ) ), 0, $digits );
	}

	private function is_existed( $column, $post_name ) {
		global $wpdb;
		$sql = "SELECT COUNT( $column ) FROM $wpdb->posts WHERE $column = %d LIMIT 1";
		$sql = $wpdb->prepare( $sql, $post_name );
		$exist = (boolean) $wpdb->get_var( $sql );
		return $exist;
	}

}

Random_Post_Name::instance();
