<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package starter-theme
 */

get_header(); ?>

<div class="page page--standard-sidebar">
	<div class="page__content row">
		<main class="page__main" role="main">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					get_template_part( 'templates/content/post', get_post_format() );
				}

				the_posts_navigation();
			} else {
				get_template_part( 'templates/content/post', 'none' );
			}
			?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
	get_footer();
