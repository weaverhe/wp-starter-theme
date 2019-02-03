<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package starter-theme
 */

?>

</div>

<footer class="footer" role="contentinfo">

	<?php get_template_part( 'templates/footer/footer', 'widgets' ); ?>

	<?php if ( has_nav_menu( 'social' ) ) : ?>
		<nav class="footer__social" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					)
				);
			?>
		</nav><!-- .social-navigation -->
	<?php endif; ?>

	<?php get_template_part( 'templates/footer/footer', 'site-info' ); ?>

</footer>

<?php wp_footer(); ?>

<?php get_template_part( 'templates/footer/footer', 'scripts' ); ?>

</body>
</html>
