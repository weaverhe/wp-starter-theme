<?php
/**
 * The template for displaying search results pages
 *
 * @package starter-theme
 */

get_header(); ?>

<div class="page page--standard-sidebar page--search">
	<?php
	global $custom_page_title;

	if ( have_posts() ) {
		$custom_page_title = sprintf( 'Search Results for: %s', '<span class="search-query>' . get_search_query() . '</span>' );
	} else {
		$custom_page_title = 'Nothing Found';
	}

	get_template_part( 'templates/content/header', 'simple' );
	?>

	<div class="page__content row">
		<main class="page__main" role="main">
		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'templates/content/post', 'excerpt' );

			endwhile; // End of the loop.

			the_posts_pagination();

		else :
			?>

			<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
			<?php
				get_search_form();

		endif;
		?>

		</main>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
	get_footer();
