<?php
/**
 * Handle CPT & Taxonomy Setup
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Core_CPT class
 */
class Core_CPT {
	/**
	 * Creates a new CPT
	 *
	 * @param string $label the CPT Label.
	 * @param array  $args  the CPT options.
	 * @return void
	 */
	public static function create_cpt( $label = '', $args = [] ) {

		$args['label'] = $label;

		// Set defaults.
		$args['slug']   = Core_Helpers::get_default( 'slug', $args, sanitize_title( $label ) );
		$args['public'] = Core_Helpers::get_default( 'public', $args, true );

		register_post_type( $args['slug'], $args );
	}

	/**
	 * Creates a new taxonomy
	 *
	 * @param string $label     the taxonomy label.
	 * @param string $post_type the post type to associate with.
	 * @param array  $args      the taxonomy options.
	 * @return void
	 */
	public static function create_taxonomy( $label = '', $post_type = '', $args = [] ) {
		$args['label'] = $label;

		// Set defaults.
		$args['slug']         = Core_Helpers::get_default( 'slug', $args, sanitize_title( $label ) );
		$args['public']       = Core_Helpers::get_default( 'public', $args, true );
		$args['hierarchical'] = Core_Helpers::get_default( 'hierarchical', $args, true );

		register_taxonomy( $args['slug'], $post_type, $args );
	}
}

new Core_CPT();
