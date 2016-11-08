<?php 
/**
 * This is the left sidebar for all Hub-style topic pages.
 */
?>
<div class="side-nav-container top">
	<h5>Hub Topics</h5>
	<?php wp_nav_menu( array( 'theme_location' => 'hub-topics-top' ) ); ?>
</div>

<div class="side-nav-container bottom">
	<?php wp_nav_menu( array( 'theme_location' => 'hub-topics-bottom' ) ); ?>
</div>
