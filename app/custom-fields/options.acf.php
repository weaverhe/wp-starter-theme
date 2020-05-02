<?php
/**
 * Field Group: Site Options
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

$group_args = [
	'title'          => 'Site Options',
	'location_is'    => [ 'options_page', 'acf-options' ],
];

$fields = [
	[ 'text', 'Test' ],
];

$field_group = Core_ACF::register_field_group( 'options-acf', $group_args, $fields );
