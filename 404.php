<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package starter-theme
 */

get_header();


?>
<div class="page page--stacked">
	<main class="page_main" role="main">

		<section class="page_content-area">
			<?php
				global $custom_page_title;
				$custom_page_title = 'Sorry! That page doesn\'t seem to exist.';
				get_template_part( 'templates/content/header', 'simple' );
			?>

			<div class="page_content row">
				<?php get_search_form(); ?>
			</div>
		</section>

	</main>
	<?php get_sidebar( '404' ); ?>
</div>

<?php
	get_footer();
