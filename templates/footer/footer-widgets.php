<?php
/**
 * A template file to display the footer content
 *
 * @package starter-theme/templates/footer
 */

?>

<?php
if ( is_active_sidebar( 'footer' ) ) {
	?>
		<div class="footer__widgets row">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div>
	<?php
}
