<?php
/**
 * Action to emit three widget areas below the Homepage Top Stories area of the homepage template
 * This is in Youth Today and JJIE
 * @since February 2017
 */
function jjie_homepage_triple_widget_area() {
	?>
		<div class="clearfix row" id="homepage-triple-widget">
			<?php
				dynamic_sidebar( 'homepage-triple-widget-left' );
				dynamic_sidebar( 'homepage-triple-widget-center' );
				dynamic_sidebar( 'homepage-triple-widget-right' );
			?>
		</div>
	<?php
}
add_action( 'largo_before_sticky_posts', 'jjie_homepage_triple_widget_area', 100 );

/**
 * Register the three widget areas output by jjie_homepage_triple_widget_area
 * @since February 2017
 */
function jjie_homepage_triple_widget_area_register() {
	register_sidebar( array(
		'name' => __( 'Homepage Three Ads, left slot', 'yt' ),
		'id' => 'homepage-triple-widget-left',
		'description' => __( 'This is the left of three ad slots on the homepage, appearing above the post river.', 'yt' ),
		'before_widget' => '<div id="%1$s" class="span4 widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Homepage Three Ads, center slot', 'yt' ),
		'id' => 'homepage-triple-widget-center',
		'description' => __( 'This is the center of three ad slots on the homepage, appearing above the post river.', 'yt' ),
		'before_widget' => '<div id="%1$s" class="span4 widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Homepage Three Ads, right slot', 'yt' ),
		'id' => 'homepage-triple-widget-right',
		'description' => __( 'This is the right of three ad slots on the homepage, appearing above the post river.', 'yt' ),
		'before_widget' => '<div id="%1$s" class="span4 widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'jjie_homepage_triple_widget_area_register', 20 );
