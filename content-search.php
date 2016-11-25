<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package starter-theme
 */
?>

<div class="blog-summary">
	<?php the_title( sprintf( '<p class="blog-summary__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></p>' ); ?>
	<p class="blog-summary__excerpt"><?php the_excerpt(); ?></p>
	<p class="blog-summary__link"><a href="<?php the_permalink(); ?>" title="View <?php the_title(); ?>">View Page</a></p>
</div>
