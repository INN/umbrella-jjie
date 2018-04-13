<?php
/**
 * JJIE Specific Functions used in override templates.
 */

/**
 * Always enable global nav
 */
define( 'SHOW_GLOBAL_NAV', TRUE );


/*
 * Include theme files
 *
 * Based off of how Largo loads files: https://github.com/INN/Largo/blob/master/functions.php#L358
 *
 * 1. hook function Largo() on after_setup_theme
 * 2. function Largo() runs Largo::get_instance()
 * 3. Largo::get_instance() runs Largo::require_files()
 *
 * This function is intended to be easily copied between child themes, and for that reason is not prefixed with this child theme's normal prefix.
 *
 * @link https://github.com/INN/Largo/blob/master/functions.php#L145
 */
function largo_child_require_files() {
	$includes = array(
		'/inc/homepage-below-top-stories.php'
	);
	foreach ($includes as $include ) {
		require_once( get_stylesheet_directory() . $include );
	}
}
add_action( 'after_setup_theme', 'largo_child_require_files' );


/**
 * Use this function to check if child of '/hub/' page => '103871'
 * @param str The ID of the page we're looking for 
 */
function is_hub( $pid) { // $pid = The ID of the page we're looking for pages underneath
	global $post; // load details about this page

	// Return true if this page is the specified page
	if ( is_page($pid) )
		return true; // we're at the page or at a sub page

	$anc = get_post_ancestors( $post->ID );
	foreach ( $anc as $ancestor ) {
		if( is_page() && $ancestor == $pid ) {
			return true;
		}
	}

	return false; // we aren't at the page, and the page is not an ancestor
}

function tabbed_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'something'
	), $atts ) );

	return "<div class='tabby open'><h5>". $title ."</h5><div class='content'><p>". $content . "</div></div>";
}
add_shortcode('tab', 'tabbed_func');

function jjie_sidebox() {
	if(is_hub('103871')) {
		if (! function_exists('get_field') ) {
			echo '<!-- get_field is not defined, so the sidebox will not appear. -->';
			return false;
		}

		$sidebox = get_field('sidebox');

		if($sidebox) {
			foreach( $sidebox as $hubwidget ) {  ?>
				<div class="hub-widget">
					<?php
						if($hubwidget['hub_widget_image']) { ?>
							<img class="hub-image" src="<?php echo $hubwidget['hub_widget_image']; ?>">
						<?php
						}
					?>
					<div class="widget">
						<div class="text">
							<?php echo $hubwidget['hub_widget_textarea']; ?>
						</div>
					</div>
				</div><!-- .hub-widget -->
			<?php }
		}
	}
}
add_action('largo_before_sidebar_content', 'jjie_sidebox');

/**
 * add 'hub' class to hub pages
 */
function jjie_hub_body_class( $classes ) {
	if ( is_hub( '103871' ) ) {
		$classes[] = 'hub';
	}
	return $classes;
}

add_filter( 'body_class', 'jjie_hub_body_class' );

/**
 * Add breadcrumbs to post top
 */
function jjie_post_breadcrumbs() {
	if(function_exists('bcn_display')) {
		echo '<!-- Breadcrumbs -->';
		echo '<div class="breadcrumbs">';
		bcn_display();
		echo '</div><!--end breadcrumbs-->';
	}
}
add_action( 'largo_before_post_header', 'jjie_post_breadcrumbs' );

/**
 * Adds the "display as featured on homepage" prominence term to the list of prominence options
 *
 * For YT-37: Client requests the ability to specify the posts in the homepage river (below the
 * featured stories) that are shown as "featured" (larger photo, etc.) using a different
 * prominence taxonomy term (currently uses "homepage featured").
 */
function jjie_add_homepage_large_image_prominence($termsDefinitions) {
	$termsDefinitions[] = array(
		'name' => __("Use larger image on homepage", 'npq'),
		'description' => __("Add this label to posts to display them on the homepage with a larger image", 'npq'),
		'slug' => 'homepage-large-image',
	);
	return $termsDefinitions;
}
add_filter('largo_prominence_terms', 'jjie_add_homepage_large_image_prominence', 0);
