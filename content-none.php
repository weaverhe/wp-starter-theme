<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package starter-theme
 */
?>

<header class="page-header">
	<div class="row row--overflow-visible">
		<h1 class="page-header__title"><?php _e( 'Nothing Found', 'starter-theme' ); ?></h1>
	</div>
</header>

<div class="page-content">
	<div class="row">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'starter-theme' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p class="align--center"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'starter-theme' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p class="align--center"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'starter-theme' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</div>
