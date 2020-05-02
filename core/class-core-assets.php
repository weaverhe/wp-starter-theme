<?php
/**
 * Handle Asset Loading
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Core_Assets class
 */
class Core_Assets {
	/**
	 * Helper function to load static CSS files
	 *
	 * @param string $url  the file URL.
	 * @param array  $args file load arguments.
	 * @return void
	 */
	public static function load_css( $url = '', $args = [] ) {
		$args['handle'] = Core_Helpers::get_default( 'url', $args, $url );
		$args['ver']    = Core_Helpers::get_default( 'ver', $args, THEMEVER );

		wp_enqueue_style( $args['handle'], $url, $args['deps'], $args['ver'], $args['media'] );

	}

	/**
	 * Helper function to load static JS files
	 *
	 * @param string $url  the file URL.
	 * @param array  $args file load arguments.
	 * @return void
	 */
	public static function load_js( $url = '', $args = [] ) {
		$args['handle']    = Core_Helpers::get_default( 'url', $args, $url );
		$args['ver']       = Core_Helpers::get_default( 'ver', $args, THEMEVER );
		$args['in_footer'] = Core_Helpers::get_default( 'in_footer', $args, true );

		wp_enqueue_script( $args['handle'], $url, $args['deps'], $args['ver'], $args['in_footer'] );
	}
}

new Core_Assets();
