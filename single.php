<?php
/**
 * The template for displaying all single posts.
 *
 * @package starter-theme
 */

get_header();

while ( have_posts() ) {
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
