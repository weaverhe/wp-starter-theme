<?php
/**
 * The template for displaying all single posts.
 *
 * @package starter-theme
 */

get_header();

while ( have_posts() ) {
	the_post();

	require get_template_directory() . '/templates/header/page-header.php';
	?>
	<article>

		<div class="page-content row">
			<?php the_content(); ?>
		</div>
	</article><!-- #post-## -->
	<?php
}

get_footer();
