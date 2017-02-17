<?php
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
 * DoubleClick for WordPress setup for YT
 * Valid as of 2015-08-18
 *
 * @since Largo 0.5.2
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
 * Creates menus for hub pages
 *
 * hub-sidebar: the
 * - template-bowne.php
 * - template-hub-overview.php
 * - template-sub-sub-topic.php
 * - template-sub-topic.php
 * - template-topic.php
 *
 * bowne-sidebar
 * - template-bowne.php as right rail
 *
 * hub-topics-top
 * - Top of the right rail in hub topics pages
 *
 * hub-topics-bottom
 * - Bottom of the right rail in hub topics pages
 */
function yt_register_menu() {
	register_nav_menus( array(
		'hub-sidebar' => __('Hub Sidebar Menu'),
		'hub-topics-top' => __('Hub Topics Menu Top'),
		'hub-topics-bottom' => __('Hub Topics Menu Bottom'),
		'bowne-sidebar' => __('Bowne Foundation Menu')
	) );
}
add_action('init', 'yt_register_menu');

function wpb_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Hub', 'wpb' ),
		'id' => 'hub-sidebar',
		'description' => __( 'This sidebar appears below the logo and on-page nav on Hub-related pages', 'wpb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Homepage Middle Ad Zone', 'yt' ),
		'id' => 'homepage-middle-ad-zone',
		'description' => __( 'This widget area appears on the homepage, above the Homepage Bottom widget area, It takes the width of the whole column. The three side-by-side widget areas are named "Homepage Three Ads"', 'yt'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

add_action( 'widgets_init', 'wpb_widgets_init', 20 );

/**
 * Add .hub class on body for hub pages: the pages that have the Hub as an ancestor
 */
add_filter('body_class', 'hub_body_class');
function hub_body_class( $classes ) {
	// get the ID of the main page for a given guide
	$this_page_id = get_the_ID();
	$ancestors = get_post_ancestors( $this_page_id );
	$hub_page_id = 8653; // check http://youthtoday.org/hub/ for the page ID class on the <body> element

	// is this page a descendant of the hub?
	if (end($ancestors) == $hub_page_id || $this_page_id == $hub_page_id) {
		$classes[] = "hub-class";
	}

	return $classes;
}

/**
 * Set the number of posts in the right-hand side of the Top Stories homepage template to 3.
 *
 * Largo's default is 6. YT does not want the "More headlines" area to appear, which appears if 4 or more posts are in the area.
 *
 * @return 3
 * @param int $showstories
 */
function youthtoday_return_three($showstories) {
	return 3;
}
add_filter('largo_homepage_topstories_post_count', 'youthtoday_return_three');

/*
 * Adds the "display as featured on homepage" prominence term to the list of prominence options
 *
 * For YT-60: Client requests the ability to specify the posts in the homepage river (below the
 * featured stories) that are shown as "featured" (larger photo, etc.) using a different
 * prominence taxonomy term (currently uses "homepage featured").
 *
 * See also YT-37, the JJIE ticket that this code is copied from.
 */
function yt_add_homepage_large_image_prominence($termsDefinitions) {
	$termsDefinitions[] = array(
		'name' => __("Use larger image on homepage", 'npq'),
		'description' => __("Add this label to posts to display them on the homepage with a larger image", 'npq'),
		'slug' => 'homepage-large-image',
	);
	return $termsDefinitions;
}
add_filter('largo_prominence_terms', 'yt_add_homepage_large_image_prominence', 0);

/**
 * Add widget area to the homepage, for an ad widget
 *
 * Depends on Largo PR 966
 *
 * @see wpb_widgets_init
 * @link http://jira.inn.org/browse/HELPDESK-438
 * @link https://github.com/INN/Largo/pull/966
 */
function yt_homepage_middle_ad_widget() {
	if ( ! dynamic_sidebar( 'homepage-middle-ad-zone' ) ) { ?>
		<!-- <?php _e('Please add widgets to this content area in the WordPress admin area under appearance > widgets.', 'largo'); ?> -->
	<?php }
}
add_action('largo_before_sticky_posts', 'yt_homepage_middle_ad_widget');
