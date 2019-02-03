<?php
/**
 * The sidebar containing the 404 page widgets
 *
 * @package starter-theme
 */

if ( ! is_active_sidebar( '404' ) ) {
	return;
}
?>
<aside id="secondary" class="page__sidebar row" role="complementary" aria-label="<?php esc_attr( '404 Content Widgets' ); ?>">
	<?php dynamic_sidebar( '404' ); ?>
</aside>
