<?php ?>
<div class="table-content">

	<?php
	/**
	 * Custom sidebar function
	 *
	 * @duplicates largo_get_custom_sidebar();
	 * @deprecated
	 * @todo replace when this theme is upgraded to depend upon Largo 0.4
	 */
	$custom_sidebar = false;
	if ( is_singular() ) {
		$custom_sidebar = get_post_meta( get_the_ID(), 'custom_sidebar', true) ;
		if ( in_array( $custom_sidebar, array( '', 'default' ) ) )
			$custom_sidebar = 'none';
	} else if ( is_archive() ) {
		$term = get_queried_object();
		$custom_sidebar = largo_get_term_meta(
			$term->taxonomy, $term->term_id, 'custom_sidebar', true);
	}
	
	/**
	 * Display the custom sidebar
	 *
	 * @duplicates Largo/partials/sidebar.php
	 * @deprecated
	 * @todo replace this when the theme is upgraded to depend on Largo 0.4
	 */
	if (!dynamic_sidebar($custom_sidebar)) {
		if (!dynamic_sidebar('hub-sidebar'))
			dynamic_sidebar('sidebar-main');
	}
	?>
</div>
