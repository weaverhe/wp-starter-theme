<?php
/**
 * The class to load the theme config files for CPT, Assets, and Custom Fields
 *
 * @package wp-starter
 * @author Heather Weaver
 * @since 1.0
 * @version 1.0
 */

/**
 * Setup the Theme_Loader class
 */
class Theme_Loader {
	/**
	 * Load Hooks, Actions, & Filters
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'load_content_types' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'load_assets' ] );
		add_action( 'acf/init', [ $this, 'load_custom_fields' ] );
	}

	/**
	 * Load the defined CPTs & Taxonomies
	 *
	 * @return void
	 */
	public function load_content_types() {
		include_once APPDIR . '/content/content-types.php';
	}

	/**
	 * Load the static theme assets
	 *
	 * @return void
	 */
	public function load_assets() {
		include_once COREDIR . '/class-core-assets.php';

		include_once APPDIR . '/assets/css-assets.php';
		include_once APPDIR . '/assets/js-assets.php';
	}

	/**
	 * Load the ACF data
	 *
	 * @return void
	 */
	public function load_custom_fields() {
		$cf_dir        = APPDIR . '/custom-fields';
		$custom_fields = scandir( $cf_dir );

		if ( ! $custom_fields ) {
			return;
		}

		foreach ( $custom_fields as $field_set ) {

			$file_info = pathinfo( $cf_dir . '/' . $field_set );

			if ( 'php' === $file_info['extension'] ) {
				include $cf_dir . '/' . $field_set;
			}
		}
	}
}

new Theme_Loader();
