<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	<header class="entry-header">

		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
		<?php if (function_exists('bcn_display')) {
			bcn_display();
		} ?>
		</div>
		<!-- END Breadcrumbs -->

		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php edit_post_link(__('Edit This Page', 'largo'), '<h5 class="byline"><span class="edit-link">', '</span></h5>'); ?>
	</header><!-- .entry-header -->

	<section class="entry-content">
		<?php the_content(); ?>
	</section><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php get_template_part('partials/after-page-content', '103871');
