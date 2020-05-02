<?php
/**
 * Setup the Theme Core
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Core_Init class
 */
class Core_Init {
	/**
	 * Load files. Setup hooks, actions & filters.
	 */
	public function __construct() {
		include 'class-core-constants.php';
		include 'class-core-helpers.php';
		include 'class-core-acf.php';
		include 'class-core-template.php';
		include 'class-core-cpt.php';
		include APPDIR . '/class-theme-loader.php';

		add_action( 'after_theme_setup', [ $this, 'setup_theme_support' ] );

		// Set up an ACF options page.
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page();
		}
	}

	/**
	 * Setup theme support for WP basics
	 *
	 * @return void
	 */
	public function setup_theme_support() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
	}
}

new Core_init();
