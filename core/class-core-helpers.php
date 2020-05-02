<?php
/**
 * Provide Theme Helpers & General Setup
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Core_Helpers class
 */
class Core_Helpers {
	/**
	 * Sanitize a string & replace hyphens with underscores
	 *
	 * @param string $string the title to sanitize.
	 * @return string
	 */
	public static function sanitize_title_underscore( $string = '' ) {
		return str_replace( '-', '_', sanitize_title( $string ) );
	}

	/**
	 * Set the default when it doesn't exist.
	 *
	 * @param string $key     the field key.
	 * @param array  $args    the field args.
	 * @param string $default the default value.
	 * @return string
	 */
	public static function get_default( $key = '', $args = [], $default = '' ) {
		if ( ! array_key_exists( $key, $args ) ) {
			return $default;
		}

		return $args[ $key ];
	}
}

new Core_Helpers();

/**
 * A fantastic utility to seamlessly log both strings & arrays.
 *
 * @param string $input the input.
 * @return void
 */
function _log( $input ) {
	error_log( print_r( $input, true ) ); // phpcs:ignore
}
