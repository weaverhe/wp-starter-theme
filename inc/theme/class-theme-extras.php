<?php
/**
 * The class for extra theme functions
 *
 * @package starter-theme/classes
 */

require get_template_directory() . '/inc/theme/class-theme-basics.php';

/**
 * The class to implement additional theme functionality, like one-off hooks & filters.
 */
class Theme_Extras extends Theme_Basics {
	/**
	 * The constructor function to set up the basics
	 *
	 * @param string $theme_name the name of the theme being developed.
	 * @param string $theme_version the current theme version #.
	 */
	public function __construct( $theme_name, $theme_version ) {
		add_filter( 'upload_mimes', [ $this, 'add_svg_support' ] );

		parent::__construct( $theme_name, $theme_version );
	}

	/**
	 * Add upload support for SVG in the media library
	 *
	 * @param array $mimes the current array of supported mime types.
	 * @return array
	 */
	public function add_svg_support( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}
