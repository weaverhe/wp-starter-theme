<?php // phpcs:ignore
/**
 * The Header class, to manager the website header data & template.
 *
 * @package wp-starter
 * @author Heather
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Header class
 */
class Header extends Core_Template {
	/**
	 * Override the base template function to load a specific twig file.
	 *
	 * @return string
	 */
	public function template_file() {
		return 'views/partials/header.twig';
	}

}

new Header();
