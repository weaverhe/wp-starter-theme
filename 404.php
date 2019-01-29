<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package starter-theme
 */

get_header();

include_with_variables(
	get_template_directory() . '/templates/header/page-header.php',
	array( 'title' => 'Oops! 404.' )
);

?>

<div class="page-content">

	<div class="row">
		<p class="align--center"><?php esc_html( 'You\'ve been directed to a page that doesn\'t exist. Try a search, or one of the links below.', 'starter-theme' ); ?></p>
		<?php require 'templates/forms/search-form.php'; ?>
	</div>

	<div class="row grid grid--thirds">
		<div class="grid__item">
			<?php the_widget( 'WP_Widget_Pages', '', 'before_title=<h4 class="widget__title">&after_title=</h4>' ); ?>
		</div>
		<div class="grid__item">
			<?php the_widget( 'WP_Widget_Recent_Posts', 'title=Recent Blog Posts&number=3', 'before_title=<h4 class="widget__title">&after_title=</h4>' ); ?>		
		</div>
		<div class="grid__item">
			<?php
				/* translators: %1$s: smiley */
				$archive_content = '<p>Try looking in the monthly archives:</p>';
				the_widget( 'WP_Widget_Archives', '', "before_title=<h4 class='widget__title'>&after_title=</h4>$archive_content" );
			?>
		</div>
	</div>

</div>

<?php
	get_footer();
