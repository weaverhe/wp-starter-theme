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

<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php include ('templates/mobile-navigation.php'); ?>

<div id="content" class="site-content navigation--mobile__page">
	<?php include ('templates/top-navigation.php'); ?>
