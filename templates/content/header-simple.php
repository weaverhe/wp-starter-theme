<?php
/**
 * A template file to display the page header
 *
 * @package starter-theme/templates/header
 */

?>

<?php
global $custom_page_title;
if ( $custom_page_title ) {
	$page_title = $custom_page_title;
} else {
	$page_title = get_the_title();
}
?>

<header class="page-header">
	<div class="row">
		<h1 class="page-header__title"><?php echo wp_kses( $page_title, array( 'span' => array( 'class' => array() ) ) ); ?></h1>
	</div>
</header>
