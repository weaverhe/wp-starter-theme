<?php
/**
 * Theme Functions
 *
 * @package starter-theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'starter_theme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function starter_theme_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on starter-theme, use a find and replace
		* to change 'starter-theme' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'starter-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'starter-theme' ),
				'footer'  => __( 'Footer Menu', 'starter-theme' ),
			)
		);

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		* Enable support for Post Formats.
		* See http://codex.wordpress.org/Post_Formats
		*/
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'starter_theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
	}
}
add_action( 'after_setup_theme', 'starter_theme_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function starter_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'starter-theme' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);
}
add_action( 'widgets_init', 'starter_theme_widgets_init' );

/**
* Definitions for cache busting scripts/styles
*/
define( 'THEME_CSS', get_template_directory_uri() . '/assets/css/style.css?v=afe8760544a60bacd55e9d78a0d95127' );
define( 'THEME_JS', get_template_directory_uri() . '/assets/js/scripts.js?v=aca141a9e38e0526a3e22fd6078a32b8' );

/**
 * Enqueue scripts and styles.
 */
function starter_theme_scripts() {
	wp_enqueue_style( 'starter-theme-style', THEME_CSS, array(), false );
	wp_enqueue_script( 'starter-theme-script', THEME_JS, array(), false, true );
	wp_enqueue_script( 'polyfill', 'https://cdn.polyfill.io/v2/polyfill.min.js', array(), false, false );

}
add_action( 'wp_enqueue_scripts', 'starter_theme_scripts' );

/**
 * Load jQuery via CDN
 */
function register_jquery() {
	if ( ! is_admin() && 'wp-login.php' !== $GLOBALS['pagenow'] ) {
		// comment out the next two lines to load the local copy of jQuery.
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://code.jquery.com/jquery-1.12.2.min.js', false, '1.12.2', false );
		wp_enqueue_script( 'jquery' );
	}
}

add_action( 'wp_enqueue_scripts', 'register_jquery' );


/**
 * Enqueue Font Awesome for icons
 */
function prefix_enqueue_awesome() {
	wp_enqueue_style( 'prefix-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), '4.3.0' );
}
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Undocumented function
 *
 * @param array $mimes the current set of allowed mime types.
 * @return array
 */
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
