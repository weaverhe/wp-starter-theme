<nav class="navigation--primary">
	<div class="navigation--primary__container--initial">
		<div class="row">
			<a href="/" class="navigation--primary__logo-container" title="Site Homepage">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/dummy-logo.png" class="navigation--primary__logo" alt="<?php echo get_option('blogname'); ?> Logo">
			</a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'navigation--primary__menu list--inline list--unstyled', 'container' => '' ) ); ?>
			<a href="#" id="mobile-menu-trigger" class="navigation--mobile__trigger" title="Open Mobile Navigation"><span>Toggle Menu</span></a>
		</div>
	</div>
	<div class="navigation--primary__container--fixed">
		<div class="row">
			<a href="/" class="navigation--primary__logo-container" title="Site Homepage">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/dummy-logo.png" class="navigation--primary__logo" alt="<?php echo get_option('blogname'); ?> Logo">
			</a>
			<ul class="navigation--primary__menu list--inline list--unstyled">
				<li><a href="/contact/" title="Contact <?php echo get_option('blogname'); ?>" class="button">Contact Us</a></li>
			</ul>
		</div>
	</div>
</nav>
