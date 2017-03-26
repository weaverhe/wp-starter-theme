<?php
/**
 * The template for displaying search results pages.
 *
 * @package starter-theme
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
	<header class="page-header">
		<div class="row">
			<h1 class="page-header__title"><?php printf( __( 'Search Results for: %s', 'starter-theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>
	</header>

	<div class="page-content">
		<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				?>

				<div class="blog-summary">
					<?php the_title( sprintf( '<p class="blog-summary__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></p>' ); ?>
					<p class="blog-summary__excerpt"><?php the_excerpt(); ?></p>
					<p class="blog-summary__link"><a href="<?php the_permalink(); ?>" title="View <?php the_title(); ?>">View Page</a></p>
				</div>

				<?php the_posts_navigation(); ?>

			<?php endwhile; ?>
		</div>
	</div>

<?php else : ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>

<?php get_footer(); ?>