<?php
/**
 * Plugin main file.
 *
 * @package   Google\Site_Kit_Public_Dashboard
 * @copyright 2024 Google LLC
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link      https://sitekit.withgoogle.com
 *
 * @wordpress-plugin
 * Plugin Name: Site Kit by Google Public Dashboard
 * Plugin URI:  https://sitekit.withgoogle.com
 * Description: Add-on plugin for Site Kit that adds a public view-only version of the Site Kit dashboard.
 * Version:     0.1.0
 * Author:      Google
 * Author URI:  https://opensource.google.com/
 * License:     Apache License 2.0
 * License URI: https://www.apache.org/licenses/LICENSE-2.0
 * Text Domain: google-site-kit-public-dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

final class Google_Site_Kit_Public_Dashboard {

	/**
	 * Main instance of the plugin.
	 *
	 * @since 0.1.0
	 * @var Plugin|null
	 */
	private static $instance = null;

	/**
	 * Loads the plugin main instance and initializes it.
	 * 
	 * @since 0.1.0
	 *
	 * @return bool True if the plugin main instance could be loaded, false otherwise.
	 */
	public static function init() {
		if ( null !== static::$instance ) {
			return false;
		}

		static::$instance = new static();
		static::$instance->register();

		return true;
	}

	/**
	 * Registers the plugin with WordPress.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		$this->define_constants();

		add_action( 'plugins_loaded', [ $this, 'load' ] );
	}

	/**
	 * Defines plugin constants.
	 *
	 * @since 0.1.0
	 */
	public function define_constants() {
		define( 'GOOGLESITEKITPUBLICDASHBOARD_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		define( 'GOOGLESITEKITPUBLICDASHBOARD_VERSION', '0.1.0' );
		define( 'GOOGLESITEKITPUBLICDASHBOARD_PLUGIN_MAIN_FILE', __FILE__ );
		define( 'GOOGLESITEKITPUBLICDASHBOARD_PLUGIN_DIR_PATH', plugin_dir_path( GOOGLESITEKITPUBLICDASHBOARD_PLUGIN_MAIN_FILE ) );
	}

	/**
	 * Loads plugin classes.
	 *
	 * @since 0.1.0
	 */
	public function load() {
		if ( ! defined( 'GOOGLESITEKIT_PLUGIN_BASENAME' ) ) {
			return;
		}

		( new Google\Site_Kit_Public_Dashboard\Public_Dashboard() )->register();
	}
}

( new Google_Site_Kit_Public_Dashboard() )::init();
