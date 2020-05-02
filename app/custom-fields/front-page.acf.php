<?php
/**
 * Field Group: Front Page
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

$group_args = [
	'title'          => 'Home Options',
	'location_is'    => [ 'page_type', 'front_page' ],
	'hide_on_screen' => [ 'the_content' ],
];

$fields = [
	[ 'include', TEMPLATEDIR . '/app/custom-fields/blocks/test.acf.php' ],
	[ 'text', 'Hello' ],
	[ 'text', 'Hello 2' ],
];

$field_group = Core_ACF::register_field_group( 'homepage-acf', $group_args, $fields );
