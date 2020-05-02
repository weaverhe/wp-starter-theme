<?php
/**
 * Template-related functions
 *
 * @package wp-starter
 * @author Heather Weaver
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Core_Template class
 */
class Core_Template {
	/**
	 * The Current Template File.
	 *
	 * @var string
	 */
	public $template_file;

	/**
	 * The calling class
	 *
	 * @var string
	 */
	public $cur_class;

	/**
	 * The object ID
	 *
	 * @var int
	 */
	public $obj_id;

	/**
	 * Function Setup
	 *
	 * @param int $obj_id the current object ID.
	 */
	public function __construct( $obj_id = null ) {
		$this->cur_class = get_called_class();

		// Set up the file name based on the class name.
		$this->template_file = $this->template_file();

		$this->obj_id = $obj_id;

		$this->render();
	}

	/**
	 * Get the template file path from the current calling class
	 *
	 * @return string
	 */
	public function template_file() {
		$filename = sanitize_title( $this->cur_class );
		$filename = strtolower( $filename );
		$filename = str_replace( '_', '-', $filename ) . '.twig';

		return TEMPLATEDIR . '/views/' . $filename;
	}

	/**
	 * Render the appropriate template.
	 *
	 * @return void
	 */
	public function render() {
		$attributes = get_class_methods( $this->cur_class );

		if ( ! $attributes ) {
			return;
		}

		$data = array();

		$exempt_attr = array(
			'__construct',
			'render',
			'template_file',
		);

		foreach ( $attributes as $attr ) {
			if ( in_array( $attr, $exempt_attr, true ) ) {
				continue;
			}

			$data[ $attr ] = $this->{$attr}();
		}

		// Load global variables.
		$data['site'] = include TEMPLATEDIR . '/app/app-config.php';

		// Display the template.
		Timber::render( $this->template_file, $data );
	}
}
