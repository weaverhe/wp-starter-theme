<?php
/**
 * Theme Functions
 *
 * @package starter-theme
 */

// load the basic theme class.
require get_template_directory() . '/inc/theme/class-theme-extras.php';
$theme_info    = wp_get_theme();
$theme_version = $theme_info->version;
$theme         = new Theme_Extras( 'starter-theme', $theme_version );

// setup nav menus.
$theme->add_nav_menus(
	[
		'primary' => 'Primary Menu',
		'footer'  => 'Footer',
	]
);

// load text domain.
$theme->load_text_domain( 'starter-theme', get_template_directory() . '/languages' );

// enqueue styles.
$theme->add_style( 'starter-theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), 'all' );
$theme->add_style( 'fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), 'all' );

// enqueue scripts.
$theme->add_greensock_script();
$theme->add_script( 'starter-theme-script', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ) );
$theme->add_polyfill_script( array() );

// register standard sidebar.
$theme->add_sidebar(
	array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)
);
