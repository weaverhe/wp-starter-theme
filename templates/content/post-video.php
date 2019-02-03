<?php
/**
 * Template part for displaying a video post
 *
 * @package starter-theme/templates/content
 */

?>

<?php
$class_prefix = is_single() ? 'full-post' : 'post-summary';
?>

<article <?php post_class( $class_prefix, "{$class_prefix}--video" ); ?> id="post-<?php the_ID(); ?>">
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

	<div class="<?php echo esc_html( $class_prefix ); ?>__content">
		<?php
		$content = apply_filters( 'the_content', get_the_content() );
		$video   = false;

		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}

		if ( ! is_single() && ! empty( $video ) ) {
			foreach ( $video as $video_html ) {
				?>
				<div class="<?php echo esc_html( $class_prefix ); ?>__video">
					<?php echo $video_html; // phpcs:ignore ?>	
				</div>
				<?php
			}
		} elseif ( ! is_single && empty( $video ) ) {
			the_excerpt();
			?>
			<a href="<?php the_permalink(); ?>" class="button" title="Continue reading <?php the_title(); ?>">Read More</a>	
			<?php
		} else {
			the_content();
		}
		?>
	</div>
</article>
