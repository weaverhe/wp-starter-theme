<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package starter-theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments__title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf(
					/* translators: %s: post title */
					_x(
						'One Reply to &ldquo;%s&rdquo;',
						'comments title',
						'starter-theme'
					),
					get_the_title()
				);
			} else {
				printf(
					esc_html(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'starter-theme'
						)
					),
					esc_html( number_format_i18n( $comments_number ) ),
					get_the_title()
				);
			}
			?>
		</h2>

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
			<nav id="comment-nav-above" class="navigation comments__navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'starter-theme' ); ?></h2>
				<div class="comments__navigation-links">
					<div class="comments__navigation-link comments__navigation-link--previous"><?php previous_comments_link( __( 'Older Comments', 'starter-theme' ) ); ?></div>
					<div class="comments__navigation-link comments__navigation-link--next"><?php next_comments_link( __( 'Newer Comments', 'starter-theme' ) ); ?></div>
				</div>
			</nav>
		<?php endif; ?>

		<ol class="comments__list">
			<?php
				wp_list_comments(
					array(
						'style'      => 'ol',
						'short_ping' => true,
					)
				);
			?>
		</ol>

		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
			<nav id="comment-nav-below" class="navigation comments__navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'starter-theme' ); ?></h2>
				<div class="comments__navigation-links">
					<div class="comments__navigation-link comments__navigation-link--previous"><?php previous_comments_link( __( 'Older Comments', 'starter-theme' ) ); ?></div>
					<div class="comments__navigation-link comments__navigation-link--next"><?php next_comments_link( __( 'Newer Comments', 'starter-theme' ) ); ?></div>
				</div>
			</nav>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' !== get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'starter-theme' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
