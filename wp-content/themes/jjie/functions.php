<?php
/**
 * JJIE Specific Functions used in override templates.
 */

/**
 * Always enable global nav
 */
define( 'SHOW_GLOBAL_NAV', TRUE );

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

/**
 * DoubleClick for WordPress setup for JJIE
 * Valid as of 2016-03-09
 *
 * @since Largo 0.5.4
 * @since Doubleclick for Wordpress 0.2
 * @link http://jira.inn.org/browse/YT-90
 */
function largo_dfw_setup() {

	global $DoubleClick;

	$DoubleClick->networkCode = "81321119";

	/* breakpoints */
	$DoubleClick->register_breakpoint('phone', array('minWidth'=>0,'maxWidth'=>769));
	$DoubleClick->register_breakpoint('tablet', array('minWidth'=>769,'maxWidth'=>980));
	$DoubleClick->register_breakpoint('desktop', array('minWidth'=>980,'maxWidth'=>9999));

}
add_action('dfw_setup', 'largo_dfw_setup');

/**
 * Register custom sidebars for JJIE
 *
 * @link http://jira.inn.org/browse/YT-90
 * @since Largo 0.5.4
 */
function jjie_register_widgets() {
	register_sidebar( array(
		'name' => __( 'Homepage Middle Ad Zone', 'yt' ),
		'id' => 'homepage-middle-ad-zone',
		'description' => __( 'This widget area appears on the homepage, above the Homepage Bottom widget area', 'yt'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'jjie_register_widgets' );

/**
 * Add widget area to the homepage, for an ad widget
 *
 * Depends on Largo PR 966
 *
 * @since Largo 0.5.4
 * @see jjie_register_widgets
 * @link http://jira.inn.org/browse/YT-90
 * @link https://github.com/INN/Largo/pull/966
 */
function jjie_homepage_middle_ad_widget() {
	if ( ! dynamic_sidebar( 'homepage-middle-ad-zone' ) ) { ?>
		<!-- <?php _e('Please add widgets to this content area in the WordPress admin area under appearance > widgets.', 'largo'); ?> -->
	<?php }
}
add_action('largo_before_sticky_posts', 'jjie_homepage_middle_ad_widget');
