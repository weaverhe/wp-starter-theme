<?php
/**
 * Displays footer site info
 *
 * @package starter-theme/templates/foote
 */

?>
<div class="footer__info">
	<p class="footer__info-content row">
		&copy;<?php echo esc_html( date( 'Y' ) ); ?>
		<?php
		if ( function_exists( 'the_privacy_policy_link' ) && get_privacy_policy_url( 'the_privacy_policy_link' ) ) {
			echo ' / ';
			the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
		}
		?>
	</p>
</div><!-- .site-info -->
