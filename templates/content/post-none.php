<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package starter-theme/templates/content
 */

?>

<section class="no-posts">
	<header class="no-posts__header">
		<h1 class="no-posts__title">Nothing Found</h1>
	</header>

	<div class="no-posts__content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
			<p>
				<?php
				/* phpcs:disable */
				sprintf(
					'Ready to publish your first post? <a href="%1$s">Get started here</a>.',
					esc_url( admin_url( 'post-new.php' ) )
				);
				/* phpcs:enable */
				?>
			</p>

		<?php } else { ?>
			<p>It seems we can't find what you're looking for. Perhaps searching can help.</p>
			<?php get_search_form(); ?>
		<?php } ?>
	</div>
</section>
