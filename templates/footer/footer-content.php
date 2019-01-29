<?php
/**
 * A template file to display the footer content
 *
 * @package starter-theme/templates/footer
 */

?>
<footer>
	<div class="footer--primary row grid grid--dynamic-columns">
		<div class="grid__item">
			LOGO
		</div>

		<div class="grid__item">
			<p class="footer__title">Links</p>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
					'menu_class'     => 'list--unstyled',
					'container'      => '',
				)
			);
			?>
		</div>

		<div class="grid__item">
			<p class="footer__title">Contact</p>
			<ul class="fa-ul">
				<li>
					<i class="fa-li fa fa-phone"></i>555.123.4567
				</li>
				<li>
					<i class="fa-li fa fa-envelope-o"></i>
					<a href="mailto:info@domain.com" title="Email">info@domain.com</a>
				</li>
				<li>
					<i class="fa-li fa fa-map-marker"></i>
					123 Thisisa Street<br>
					City Name, State 12345
				</li>
			</ul>
		</div>

		<div class="grid__item">
			<p class="footer__title">Connect</p>
			<ul class="list list--inline list--unstyled list--icon">
				<li class="list__icon list__icon--facebook"><a href="#" target="_blank" title="View Facebook Page"><i class="fa fa-facebook"></i></a></li>
				<li class="list__icon list__icon--twitter"><a href="#" target="_blank" title="View Twitter Page"><i class="fa fa-twitter"></i></a></li>
				<li class="list__icon list__icon--linkedin"><a href="#" target="_blank" title="View LinkedIn Page"><i class="fa fa-linkedin"></i></a></li>
			</ul>
		</div>
	</div>

	<div class="footer--secondary">
		<div class="row"><p>&copy; <?php echo esc_html( date( 'Y' ) ); ?>, Heather Weaver</p></div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
