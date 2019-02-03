<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and  site navigation
 *
 * @package starter-theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


	<?php wp_head(); ?>

	<?php get_template_part( 'templates/header/header', 'scripts' ); ?>

</head>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content">Skip to Content</a>

	<?php get_template_part( 'templates/navigation/navigation', 'top' ); ?>

	<div id="content">
