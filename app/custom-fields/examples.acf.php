<?php
/**
 * Field Group: ACF Examples
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

$group_args = [
	'title'          => 'Example Field Group',
	'location_is'    => [ 'options_page', 'acf-options' ],
	'hide_on_screen' => [ 'the_content' ],
];

$fields = [

	[
		'tab',
		'Example Tab',
		[
			'placement' => 'left',
		],
	],

	[ 'text', 'Example Field' ],

	[
		'repeater',
		'Files',
		[
			'sub_fields'   => [
				[ 'text', 'File URL' ],
				[ 'textarea', 'File Description' ],
			],
			'max'          => 4,
			'layout'       => 'block',
			'button_label' => 'Add Link or File',
		],
	],

	[
		'flexible_content',
		'Content Blocks 123',
		[
			'button_label' => 'Add Block',
			'layouts' => [
				[
					'Hero',
					[
						'display'    => 'block',
						'sub_fields' => [
							[ 'text', 'Heading' ],
							[ 'textarea', 'Description' ],
						],
					],
				],
				[
					'Intro',
					[
						'display'    => 'block',
						'sub_fields' => [
							[ 'text', 'Heading' ],
							[ 'textarea', 'Description' ],
						],
					],
				],
			],
		],
	],

];

$field_group = Core_ACF::register_field_group( 'example-acf', $group_args, $fields );
