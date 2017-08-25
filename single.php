<?php
/**
 * The template for displaying all single posts.
 *
 * @package starter-theme
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="row">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
			</article><!-- #post-## -->
		</div>

		<div class="row">
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
		</div>

		<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
