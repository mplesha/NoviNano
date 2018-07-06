<?php

/**
 *
 * @link              http://athemes.com
 * @since             1.0
 * @package           Athemes_Toolbox
 *
 * @wordpress-plugin
 * Plugin Name:       Athemes Toolbox
 * Plugin URI:        http://athemes.com/plugins/athemes-toolbox
 * Description:       Registers custom post types and custom fields for the aThemes themes
 * Version:           1.03
 * Author:            aThemes
 * Author URI:        http://athemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       athemes-toolbox
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Set up and initialize
 */
class Athemes_Toolbox {

	private static $instance;

	/**
	 * Actions setup
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'constants' ), 2 );
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 3 );
		add_action( 'after_setup_theme', array( $this, 'includes' ), 11 );
	}

	/**
	 * Constants
	 */
	function constants() {

		define( 'AT_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'AT_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	}

	/**
	* Get theme support
	*/
	function supports($supported = '') {
		$cpts = get_theme_support( 'athemes-toolbox-post-types' );
		if ( is_array($cpts) ) {
			return in_array( $supported, $cpts[0] );
		}
	}

	/**
	 * Includes
	 */
	function includes() {

		//Post types
		$post_types = array('services','employees','testimonials','projects','clients','timeline');
		foreach ( $post_types as $post_type ) {
			if ( $this->supports($post_type) ) {
				require_once( AT_DIR . 'inc/post-type-' . $post_type .'.php' );
			}
		}

		//Metaboxes
		$metaboxes = array('services','employees','testimonials','projects','clients','timeline','singles');
		foreach ( $metaboxes as $metabox ) {
			if ( $this->supports($metabox) ) {
				require_once( AT_DIR . 'inc/metaboxes/' . $metabox .'-metabox.php' );
			}			
		}
	}

	/**
	 * Translations
	 */
	function i18n() {
		load_plugin_textdomain( 'athemes-toolbox', false, 'athemes-toolbox/languages' );
	}


	/**
	 * Returns the instance.
	 */
	public static function get_instance() {

		if ( !self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

function athemes_toolbox_plugin() {

		return Athemes_Toolbox::get_instance();
}
add_action('plugins_loaded', 'athemes_toolbox_plugin', 1);