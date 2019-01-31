<?php
/**
 * The Navigation Template
 *
 * @package starter-theme/templates/header
 */

?>
<nav class="nav nav--top" role="navigation" aria-label="Top Menu">
	<div class="row nav__content">
		<a href="/" class="nav__logo" title="Homepage">
		<?php
		if ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			?>
			<img
				src="<?php echo esc_html( $image[0] ); ?>"
				alt="Logo for <?php bloginfo( 'name' ); ?>"
			/>
			<?php
		} else {
			?>
			<img
				src="<?php echo esc_html( get_template_directory_uri() ); ?>/assets/img/dummy-logo.png"
				alt="Logo for <?php bloginfo( 'name' ); ?>"
			/>
			<?php
		}
		?>
		</a>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>

			<button
				href="#"
				class="nav__mobile-link"
				aria-controls="menu-main"
				aria-expanded="false"
			>
				Menu
			</button>

			<?php
				wp_nav_menu(
					array(
						'menu'       => 'primary',
						'container'  => '',
						'menu_class' => 'nav__menu',
					)
				);

		endif;
?>
	</div>
</nav>
