<?php
//Vemos si tiene foto, sino le ponemos la img por defecto
if(has_post_thumbnail()){
    $img_url = get_the_post_thumbnail_url();
}else{
    $img_url = get_template_directory_uri() . '/images/default.jpg';
}
?>
<div class="about-one nuevos-enlaces title-bold-font">
	<a href="<?php echo get_post_permalink(); ?>" class="title-link"><h2><?php the_title(); ?></h2></a>
</div>
<div class="about-two title-font">
	<img class="stamp" src="<?php echo get_template_directory_uri() . '/images/betterpics/stamp_custompost.png'; ?>">
	<img src=" <?php echo $img_url; ?>" alt="" />
	<h5 class="nuevos-enlaces"><i class="fa fa-user"></i>&nbsp;<?php the_author_posts_link(); ?>&nbsp;&nbsp;&nbsp;&nbsp;
	<i class="fa fa-calendar"></i> &nbsp;<?php the_time('j-m-Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
	<i class="fa fa-comment"></i>&nbsp;<?php echo wp_count_comments($post->ID)->total_comments; ?>&nbsp;&nbsp;&nbsp;&nbsp;
	<i class="fa fa-clock"></i>&nbsp;<?php echo get_post_meta($post->ID, 'my_recipe_time', true); ?>&nbsp;&nbsp;&nbsp;&nbsp;
	<i class="fa fa-utensils"></i>&nbsp;<?php echo get_post_meta($post->ID, 'my_recipe_amount', true); ?>&nbsp;&nbsp;&nbsp;&nbsp;
	</h5>
	<span class="index-content"><p><?php the_excerpt(); ?></p></span>
	<div class="about-btn">
	</div>
</div>
<hr>