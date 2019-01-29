<?php
/**
 * Template Name: Contact Page
 *
 * @package starter-theme
 */

get_header();

while ( have_posts() ) {
	the_post();
	?>
	<header class="page-header">
		<div class="row">
			<h1 class="page-header__title"><?php the_title(); ?></h1>
		</div>
	</header>

	<div class="page-content row">
		<form>
			<span class="input input--half">
				<label class="input__label">
					<span class="input__label-content">Name</span>
				</label>
				<input type="text" name="email" class="input__field">
			</span>

			<span class="input input--half">
				<label class="input__label">
					<span class="input__label-content">Email</span>
				</label>
				<input type="email" name="email" class="input__field">
			</span>

			<span class="input input--whole">
				<label class="input__label">
					<span class="input__label-content">Message</span>
				</label>
				<textarea class="input__field"></textarea>
			</span>

			<button type="submit">Send Message</button>
		</form>
	</div>
	<?php
}

get_footer();
