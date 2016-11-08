<?php
/**
 * Template Name: Hub Generic
 * Single Post Template: Full-width (no sidebar)
 * Description: Left sidebar (Hub topics), main content area, and right sidebar (sub-page menu).
 */
get_header();
?>
<div class="hub-main">
	<nav class="span2 offset10">
		<?php get_template_part("partials/menu-hub-left"); ?>
	</nav> <!-- end span2 -->
	
	<div class="span7 offset3">
		<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part("partials/wayfinder"); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php edit_post_link(__('Edit This Page', 'largo'), '<h5 class="byline"><span class="edit-link">', '</span></h5>'); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->

		<?php	endwhile; // end of the loop. ?>
	</div> <!-- end span7 -->

	<aside class="span3">
		<?php get_template_part("partials/sidebar-hub"); ?>
	</aside>
</div>
<?php get_footer(); ?>
