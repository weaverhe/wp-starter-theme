<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package starter-theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function starter_theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'starter_theme_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function starter_theme_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( 'Page %s', 'starter-theme', max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'starter_theme_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function starter_theme_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'starter_theme_render_title' );
endif;

/**
 * A function to allow you to include a partial & pass through specific variables.
 *
 * @param string  $file_path the path to the partial file.
 * @param array   $variables the variables to pass through to the partial.
 * @param boolean $print whether the final content should be printed to screen or not.
 * @return string
 */
function include_with_variables( $file_path, $variables = array(), $print = true ) {
	$output = null;

	if ( file_exists( $file_path ) ) {
		// Extract the variables to a local namespace.
		extract( $variables ); // phpcs:ignore

		// Start output buffering.
		ob_start();

		// Include the template file.
		include $file_path;

		// End buffering and return its contents.
		$output = ob_get_clean();
	} else {
		return $file_path;
	}
	if ( $print ) {
		print $output; // phpcs:ignore
	}

	return $output;
}
