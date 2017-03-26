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

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<article>
			<header class="page-header">
				<div class="row">
					<?php the_title( '<h1 class="page-header__title">', '</h1>' ); ?>
				</div>
			</header>

			<div class="page-content row">
				<?php the_content(); ?>
			</div>
		</article><!-- #post-## -->

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
