<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 *
 * @package starter-theme
 */

get_header(); ?>

<div class="page page--no-sidebar">
	<?php get_template_part( 'templates/content/header', 'simple' ); ?>

	<div class="page__content row">
		<main class="page__main" role="main">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'templates/content/page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</main>
	</div>
</div>

<?php
	get_footer();
