<?php
/**
 * The class for the logo widget
 *
 * @package starter-theme/inc/widgets
 */

/**
 * The widget class
 */
class Logo_Widget extends WP_Widget {
	/**
	 * Init the widget
	 */
	public function __construct() {
		parent::__construct(
			'logo_widget',
			'Logo Widget',
			array(
				'description' => 'Display the logo uploaded in the customizer.',
			)
		);
	}

	/**
	 * The frontend code for the widget.
	 *
	 * @param array $args the widget args.
	 * @param array $instance the widget instance information.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // phpcs:ignore
		?>
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
		<?php
		echo $args['after_widget']; // phpcs:ignore
	}
}
