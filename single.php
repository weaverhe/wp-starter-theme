<?php
/**
 * The template for displaying all single posts
 *
 * @package starter-theme
 */

get_header(); ?>

<div class="page page--standard-sidebar">
	<?php
	// archive header - if posts exist.
	if ( have_posts() ) {
		get_template_part( 'templates/content/header', 'simple' );
	}
	?>

	<div class="page__content row">
		<main class="page__main" role="main">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) :
				the_post();

				get_template_part( 'templates/content/post', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation();

			endwhile;
		}
		?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
