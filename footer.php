<?php // phpcs:ignore
/**
 * The Footer class, to manager the website footer data & template.
 *
 * @package wp-starter
 * @author Heather
 * @version 1.0
 * @since 1.0
 */

/**
 * Setup the Footer class
 */
class Footer extends Core_Template {
	/**
	 * Override the base template function to load a specific twig file.
	 *
	 * @return string
	 */
	public function template_file() {
		return 'views/partials/footer.twig';
	}

}

new Footer();
