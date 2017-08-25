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

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'starter-theme' ), max( $paged, $page ) );
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

/********
*
* Rewriting Image Markup for Lazy Loading
*
********/

// function starter_theme_lazy_load_images($html, $id, $caption, $title, $align, $url, $size, $alt) {
// 	$src = wp_get_attachment_image_src( $id, $size, false );
// 	$srcU = $src[0];
// 	$width = $src[1];
// 	$height = $src[2];

// 	$ret = "<img src='' data-src='$srcU' alt='$alt' width='$width' height='$height' class='align$align lazy-load' />";
// 	$ret .= "<noscript><img src='$srcU' alt='$alt' width='$width' height='$height' class='align$align' /></noscript>";

// 	return $ret;
// 	// return "html = $html && id = $id && caption = $caption && title = $title && align = $align && url = $url && size = $size && alt = $alt";
// }

function starter_theme_lazy_load_filter($content) {
	return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'starter_theme_rewrite_lazy_images', $content);
}

add_filter('the_content', 'starter_theme_lazy_load_filter');

function starter_theme_rewrite_lazy_images($img) {
	return 'test';
}