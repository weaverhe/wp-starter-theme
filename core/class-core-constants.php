<?php
/**
 * A Helper Class to define constant values.
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Core_Constants class
 */
class Core_Constants {
	/**
	 * Define the constants
	 */
	public function __construct() {
		define( 'BLOGURL', home_url() );
		define( 'TEMPLATEDIR', get_template_directory() );
		define( 'TEMPLATEURL', get_template_directory_uri() );
		define( 'COREDIR', TEMPLATEDIR . '/core' );
		define( 'APPDIR', TEMPLATEDIR . '/app' );

		$theme_data = wp_get_theme();
		define( 'THEMEVER', $theme_data->Version ); // phpcs:ignore
	}
}

new Core_Constants();
