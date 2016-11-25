<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package starter-theme
 */
?>

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
