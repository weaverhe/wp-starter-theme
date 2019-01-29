<?php
/**
 * The search form partial
 *
 * @package starter-theme/templates/forms
 */

?>
<form role="search" method="get" action="<?php echo esc_html( home_url( '/' ) ); ?>">
	<span class="input input--whole">
		<label class="input__label">
			<span class="input__label-content">Search For:</span>
		</label>
		<input type="search" name="s" class="input__field">
	</span>

	<button type="submit">Search Site</button>
</form>
