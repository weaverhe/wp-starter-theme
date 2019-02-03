<?php
/**
 * Template part for displaying audio posts
 *
 * @package starter-theme/templates/content
 */

?>

<?php
$class_prefix = is_single() ? 'full-post' : 'post-summary';
?>

<article <?php post_class( $class_prefix, "{$class_prefix}--audio" ); ?> id="post-<?php the_ID(); ?>">
	<header class="<?php echo esc_html( $class_prefix ); ?>__header">
		<?php

		if ( ! is_single() ) {
			the_title(
				sprintf(
					"<h1 class='{$class_prefix}__title'><a href='%s' title='Read %s'>",
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
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_html( $class_prefix ); ?>__content">
		<?php
		$content = apply_filters( 'the_content', get_the_content() );
		$audio   = false;

		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}

		?>

		<?php
		if ( ! is_single() ) {

			// If not a single post, highlight the audio file.
			if ( ! empty( $audio ) ) {
				foreach ( $audio as $audio_html ) {
					?>
					<div class='<?php echo esc_html( $class_prefix ); ?>__audio'>
						<?php echo $audio_html; //phpcs:ignore ?>
					</div>
					<?php
				}
			} else {
				the_excerpt();
				?>
				<p><a href="<?php the_permalink(); ?>" class="button" title="Continue reading <?php the_title(); ?>">Read More</a></p>
				<?php
			}
		} else {
			the_content();
		};
		?>

	</div>
</article>
