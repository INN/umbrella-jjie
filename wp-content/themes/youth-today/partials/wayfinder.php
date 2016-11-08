<?php 
/**
 * Breadcrumb navigation for Hub pages. Works up to grandparent level; there are currently no great-grandparents.
 */
?>

<div class="wayfinder">
    <?php //parent variables
	$parent = get_post($post->post_parent);
	$parent_title = get_the_title($parent);
	$grandparent = $parent->post_parent;
	$grandparent_title = get_the_title($grandparent);?>

	<?php // is the homepage the granparent?
	if ($grandparent == is_page('0')) { ?>
	<li class="top-level"><a href="/<?php echo get_permalink($grandparent); ?>"><?php echo $grandparent_title; ?></a></li>
	<br/>
	<li class="second-level"><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo $parent_title; ?></a></li>

	<?php // is the homepage the parent?
	} elseif ($post->post_parent ==is_page('0')) {?>
   <li class="top-level"> <a href="<?php echo get_permalink($post->post_parent) ?>"><?php echo $parent_title; ?></a></li>

    <?php // I must be a top level page!
	} else { ?> <!-- no parent to show -->

    <?php }?>
</div> <!-- end wayfinder -->
