<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package starter-theme
 */

get_header(); ?>

<div class="page page--standard-sidebar">
	<?php
	// archive header - if posts exist.
	if ( have_posts() ) {
		global $custom_page_title;
		$custom_page_title = get_the_archive_title();
		get_template_part( 'templates/content/header', 'simple' );
	}
	?>

	<div class="page__content row">
		<main class="page__main" role="main">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'templates/content/post', get_post_format() );
			endwhile;

			the_posts_pagination();
			?>

			<?php
			else :
				get_template_part( 'templates/content/post', 'none' );
			endif;
			?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
