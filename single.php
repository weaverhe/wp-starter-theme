<?php
/**
 * The template for displaying all single posts.
 *
 * @package starter-theme
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php includeWithVariables(get_template_directory() . '/templates/header/page-header.php', array('title' => get_the_title())); ?>

		<article>

			<div class="page-content row">
				<?php the_content(); ?>
			</div>
		</article><!-- #post-## -->
		
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
