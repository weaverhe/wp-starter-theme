<?php
/**
 * Template part for displaying basic page content in the standard template
 *
 * @package starter-theme/templates/content
 */

?>

<article <?php post_class( 'page-content' ); ?> id="post-<?php the_ID(); ?>">
	<?php the_content(); ?>
</article>
