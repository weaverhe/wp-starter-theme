<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package starter-theme
 */

get_header();

while ( have_posts ) {
	the_post();

	include_with_variables(
		get_template_directory() . '/templates/header/page-header.php',
		array(
			'title' => get_the_title(),
		)
	);
	?>
	<article>

		<div class="page-content row">
			<?php the_content(); ?>
		</div>
	</article><!-- #post-## -->
	<?php
}

get_footer();
