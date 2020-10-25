<?php
/**
 * Handle ACF Functionality for templates
 *
 * @package StarterTheme
 * @author  Heather Weaver
 * @version 1.0
 * @since   1.0
 */

/**
 * Setup the Core_ACF class
 */
class Core_ACF {
	/**
	 * Set up an ACF Field
	 *
	 * @param string $type       The field type to create.
	 * @param string $label      The field label.
	 * @param array  $args       Field arguments.
	 * @param string $unique_key The field unique ID (optional).
	 * @return array
	 */
	private function setup_field( $type = 'text', $label = '', $args = [], $unique_key = '' ) {
		// Define the field type.
		$args['type'] = $type;

		// Define the field label.
		$args['label'] = $label;

		/**
		 * Custom Field Type: Include
		 *
		 * This field is used to 'include' another batch of fields, essentially a 'clone' function without the pain of field group IDs.
		 */
		if ( 'include' === $args['type'] ) {
			// In this case, $label = the path to the field file. Can't do anything without data.
			if ( ! is_file( $label ) ) {
				return;
			}

			// Get the contents of the file.
			$file_data = include $label;

			// Clean up the fields we pulled in for creating in ACF.
			if ( ! empty( $file_data ) ) {
				$fields = [];

				$include_fields_key = 'core_included_field_' . $unique_key;

				foreach ( $file_data as $data ) {
					$core_field = self::setup_field( $data[0], $data[1], $data[2], $include_fields_key );

					if ( array_key_exists( 'sub_fields', $core_field ) || array_key_exists( 'layouts', $core_field ) ) {
						$fields = array_merge( $fields, $core_field );
					} else {
						$fields = array_merge( $fields, [ $core_field ] );
					}
				}

				return $fields;
			}
		}

		// If the "name" of the field is not defined create it based on the field label.
		if ( ! array_key_exists( 'name', $args ) ) {
			// Give the tab field some extra uniqueness to prevent conflicts.
			if ( 'tab' === $type ) {
				$args['name'] = 'core_tab_' . $unique_key . '_' . Core_Helpers::sanitize_title_underscore( $label );
			} else {
				$args['name'] = Core_Helpers::sanitize_title_underscore( $label );
			}
		}

		// If the "key" arg is not defined create it based on the field label.
		if ( ! array_key_exists( 'key', $args ) ) {
			if ( 'tab' === $type ) {
				$args['key'] = 'core_field_tab_' . $unique_key . '_' . $args['name'];
			} else {
				$args['key'] = 'core_field_' . $unique_key . '_' . $args['name'];
			}
		}

		// Set up flexible content fields.
		if ( 'flexible_content' === $type && array_key_exists( 'layouts', $args ) ) {
			$layouts = [];

			foreach ( $args['layouts'] as $layout ) {
				// Define a unique key for the layout.
				$layout_key = 'core_layout_' . $args['key'] . '_' . Core_Helpers::sanitize_title_underscore( $layout[0] );

				// Set layout args.
				$layouts[ $layout_key ]          = $layout[1];
				$layouts[ $layout_key ]['name']  = Core_Helpers::sanitize_title_underscore( $layout[0] );
				$layouts[ $layout_key ]['label'] = $layout[0];

				// Create the sub fields for the layout.
				if ( array_key_exists( 'sub_fields', $layout[1] ) ) {
					$layout_fields = array();

					foreach ( $layout[1]['sub_fields'] as $field ) {
						$field_key       = $layout_key;
						$layout_fields[] = self::setup_field( $field[0], $field[1], $field[2], $field_key, 'flexible_content' );
					}

					$layouts[ $layout_key ]['sub_fields'] = $layout_fields;
				}
			}

			$args['layouts'] = $layouts;
		}

		// Need to modify the keys to add the repeater key to the field key doesn't end up duplicated elsewhere.
		if ( 'repeater' === $type && array_key_exists( 'sub_fields', $args ) ) {
			foreach ( $args['sub_fields'] as $key => $sub_field ) {
				$new_key                    = 'core_repeater_field_' . $args['key'];
				$args['sub_fields'][ $key ] = self::setup_field( $sub_field[0], $sub_field[1], $sub_field[2], $new_key, 'repeater' );
			}
		}

		return $args;
	}

	/**
	 * Setup the parent field group with ACF.
	 *
	 * @param string $unique_key the field group key.
	 * @param array  $group_args the field group arguments.
	 * @param array  $fields     the field group fields.
	 * @return array
	 */
	public static function register_field_group( $unique_key = '', $group_args = [], $fields = [] ) {
		// Skip if no title is set.
		if ( ! array_key_exists( 'title', $group_args ) ) {
			return;
		}

		// Get a unique key to use for this group and these fields.
		$unique_key = md5( $unique_key );

		// If location is not defined and location_is is then we can set up the locations array for them.
		if ( ! array_key_exists( 'location', $group_args ) && array_key_exists( 'location_is', $group_args ) ) {
			$group_args['location'] = self::get_location_data( $group_args['location_is'] );
		}

		// Set the group key.
		$group_args['key'] = 'core_field_group_' . $unique_key . '_' . Core_Helpers::sanitize_title_underscore( $group_args['title'] );

		// Define the fields.
		foreach ( $fields as $field ) {
			if ( 'include' === $field[0] ) {
				$group_args['fields'] = self::setup_field( $field[0], $field[1], $field[2], $unique_key );
			} else {
				$group_args['fields'][] = self::setup_field( $field[0], $field[1], $field[2], $unique_key );
			}
		}

		acf_add_local_field_group( $group_args );

		return $group_args;
	}

	/**
	 * Handle field group location matching.
	 *
	 * @param array $location_is the location data.
	 * @return array
	 */
	public function get_location_data( $location_is = [] ) {
		if ( ! is_array( $location_is ) ) {
			return;
		}

		$location[][] = [
			'param'    => $location_is[0],
			'operator' => '==',
			'value'    => $location_is[1],
		];

		return $location;
	}

	/**
	 * Fetch a set of ACF field data.
	 *
	 * @param string  $key    the field key.
	 * @param string  $prefix the field name prefix.
	 * @param array   $fields the fields to fetch.
	 * @param boolean $single if this is a single field or not.
	 *
	 * @return void
	 */
	public static function get_fields( $key = '', $prefix = '', $fields = [], $single = false ) {

		if ( ! $fields ) {
			return;
		}

		$field_data = array();

		foreach ( $fields as $field ) {
			if ( $prefix ) {
				$field_key = $prefix . $field;
			} else {
				$field_key = $field;
			}

			$field_data[ $field ] = get_field( $field_key, $key );
		}

		if ( $single ) {
			$field_data = current( $field_data );
		}

		return $field_data;
	}
}

new Core_ACF();
