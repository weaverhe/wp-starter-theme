<?php
/**
 * A template file to display the mobile navigation
 *
 * @package starter-theme/templates/header
 */

?>
<div class="navigation--mobile__container">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => 'mobile-menu',
				'container'      => '',
				'menu_class'     => 'navigation--mobile',
			)
		);
		?>
</div>
