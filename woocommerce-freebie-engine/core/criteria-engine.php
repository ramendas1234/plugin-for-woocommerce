<?php
defined( 'ABSPATH' ) || exit;
class WCFE_Criteria_Engine {
	private static $criteria = array();
	public static function init() {
		add_action( 'init', array( __CLASS__, 'load_criteria' ), 9999 );
	}
	public static function load_criteria() {
		include_once WCFE_PLUGIN_DIR . 'criteria/base/base-criterion.php';
		include_once WCFE_PLUGIN_DIR . 'criteria/traits/price-comparison.php';
		self::register_criterion( 'all_items', 'WCFE_Criterion_All_Items' );
		self::register_criterion( 'basket_total', 'WCFE_Criterion_Basket_Total' );
		do_action( 'wcfe_criteria_loaded' );
	}
	public static function register_criterion( $id, $classname ) {
		if ( ! class_exists( $classname ) ) {
			$file = WCFE_PLUGIN_DIR . 'criteria/types/' . str_replace( '_', '-', $id ) . '.php';
			if ( file_exists( $file ) ) {
				include_once $file;
			}
		}
		if ( class_exists( $classname ) ) {
			self::$criteria[ $id ] = new $classname();
		}
	}
	public static function get_criterion( $id ) {
		return isset( self::$criteria[ $id ] ) ? self::$criteria[ $id ] : false;
	}
	public static function get_all_criteria() {
		return self::$criteria;
	}
	public static function validate( $criteria_groups ) {
		if ( empty( $criteria_groups ) || ! is_array( $criteria_groups ) ) {
			return true;
		}
		foreach ( $criteria_groups as $group ) {
			if ( self::validate_group( $group ) ) {
				return true;
			}
		}
		return false;
	}
	protected static function validate_group( $group ) {
		if ( empty( $group ) || ! is_array( $group ) ) {
			return true;
		}
		foreach ( $group as $criterion_data ) {
			if ( empty( $criterion_data['type'] ) ) continue;
			$criterion = self::get_criterion( $criterion_data['type'] );
			if ( ! $criterion ) continue;
			if ( ! $criterion->validate( $criterion_data ) ) {
				return false;
			}
		}
		return true;
	}
}