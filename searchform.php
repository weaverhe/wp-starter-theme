<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<span class="input input--whole">
		<label class="input__label">
			<span class="input__label-content">Search For:</span>
		</label>
		<input type="search" name="s" class="input__field">
	</span>

	<button type="submit">Search Site</button>


<!--     <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <input type="submit" class="search-submit"
        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" /> -->
</form>