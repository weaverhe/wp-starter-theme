<?php // phpcs:ignore
/**
 * The Front_Page class, to manager the website front page data & template.
 *
 * @package wp-starter
 * @author Heather
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Front_Page class
 */
class Front_Page extends Core_Template {
	/**
	 * Setup the field data for twig template use.
	 *
	 * @return array
	 */
	public function fields() {
		return Core_ACF::get_fields(
			$this->obj_id,
			'',
			[
				'hello',
			]
		);
	}

}

global $post;
new Front_Page( $post->ID );
