<?php
/**
 * Template part for displaying a gallery post
 *
 * @package starter-theme/templates/content
 */

?>

<?php
$class_prefix = is_single() ? 'full-post' : 'post-summary';
?>

<article <?php post_class( $class_prefix, "{$class_prefix}--gallery" ); ?> id="post-<?php the_ID(); ?>">
	<header class="<?php echo esc_html( $class_prefix ); ?>__header">
		<?php

		if ( ! is_single() ) {
			the_title(
				sprintf(
					'<h1 class="<?php echo esc_html( $class_prefix ); ?>__title"><a href="%s" title="Read %s">',
					get_the_permalink(),
					get_the_title()
				),
				'</a></h1>'
			);
		}

		if ( 'post' === get_post_type() && ( get_the_date() || get_the_author() ) ) {
			?>
			<div class="<?php echo esc_html( $class_prefix ); ?>__meta">
				<?php if ( get_the_date() ) : ?>
					<span class="<?php echo esc_html( $class_prefix ); ?>__meta-label">Posted on: </span>
					<span class="<?php echo esc_html( $class_prefix ); ?>__meta-date"><?php echo esc_html( get_the_date() ); ?></span>
				<?php endif; ?>
				<?php if ( get_the_author() ) : ?>
					<span class="<?php echo esc_html( $class_prefix ); ?>__meta-label">By: </span>
					<span class="<?php echo esc_html( $class_prefix ); ?>__meta-author"><?php the_author(); ?></span>
				<?php endif; ?>
			</div>
			<?php
		};
		?>
	</header>

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?> 
		<div class="<?php echo esc_html( $class_prefix ); ?>__thumbnail">
			<a href="<?php the_permalink(); ?>" title="Read <?php the_title(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>

	<?php if ( ! is_single() && get_post_gallery() ) : ?>
		<div class="<?php echo esc_html( $class_prefix ); ?>__gallery">
			<?php echo get_post_gallery(); //phpcs:ignore ?>
		</div>
	<?php elseif ( ! is_single() && ! get_post_gallery() ) : ?>
		<div class="<?php echo esc_html( $class_prefix ); ?>__content">
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="button" title="Continue reading <?php the_title(); ?>">Read More</a>	
		</div>
	<?php else : ?>
		<div class="<?php echo esc_html( $class_prefix ); ?>__content">
			<?php the_content(); ?>
		</div>
	<?php endif; ?>

</article>
