<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package starter-theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


	<?php wp_head(); ?>

	<?php include ('templates/header/header-scripts.php'); ?>

</head>

<body <?php body_class(); ?>>

<?php include ('templates/header/mobile-navigation.php'); ?>

<div id="content" class="site-content navigation--mobile__page">
	<?php include ('templates/header/top-navigation.php'); ?>