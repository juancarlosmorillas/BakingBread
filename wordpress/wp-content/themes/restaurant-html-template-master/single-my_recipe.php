<?php
    get_header();
   
    the_post();
    $post_id = $post->ID;
    setPostViews($post_id);
    $views = getPostViews($post_id);
    $category = get_the_category();
    $catid= array();
    foreach ($category as $cat){
        $catid[] = $cat->term_id;
    }
    $img_url = get_template_directory_uri() . '/images/default.jpg';
    if(has_post_thumbnail()){
        $img_url = get_the_post_thumbnail_url();
    }
     get_template_part('nav');
?>

	<!--banner-starts-->
	<div class="banner">
		<div class="container">
			<div class="banner-top" style="background-image: url('<?php echo $img_url; ?>');">
			</div>
		</div>
	</div>
	<!--banner-end-->
	<!--about-starts-->
	<div class="about">
		<div class="container">
			<div class="about-main">
				<div class="col-md-8 about-left title-font nuevos-enlaces">
					<div class="about-two title-font">
						<h1 class="colored"><?php the_title(); ?></h1>
						<i class="avatar-single"><?php echo get_avatar(get_the_author_meta('ID'), 44); ?> <?php the_author_posts_link(); ?></i>&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-calendar colored"></i>&nbsp;<h7><?php the_time('j-m-Y'); ?></h7>&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="fa fa-clock colored"></i>&nbsp;<?php echo get_post_meta($post->ID, 'my_recipe_time', true); ?>&nbsp;&nbsp;&nbsp;&nbsp;
	                    <i class="fa fa-utensils colored"></i>&nbsp;<?php echo get_post_meta($post->ID, 'my_recipe_amount', true); ?>&nbsp;&nbsp;&nbsp;&nbsp;
	                    <i class="fa fa-eye colored">&nbsp;&nbsp;<text class="single-info title-font"><?php echo $views; ?></text></i>
						<h3><?php _e('Ingredients'); ?></h3>
						<?php _e(get_post_meta($post->ID, 'my_recipe_ingredients', true)); ?>
						<hr>
						<span class="single-content"><?php the_content(); ?></span>
						<hr>
					</div>
					<div class="about-two">
					<?php 
		            	$custom_query = new WP_Query($args);
		            	if($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); endwhile; endif;
		            	comments_template(); 
		            ?>
		            </div>
				</div>
				<div class="col-md-4 about-right heading title-font">
					<div class="abt-1">
						<h3 class="single-sidebar-title title-bold-font"><?php _e('SEARCH'); ?></h3>
						<div class="news">
							<?php get_search_form(); ?>
							<br>
						</div>
					</div>
					<div class="abt-2 lists-side">
						<h3 class="single-sidebar-title title-bold-font"><?php _e('RELATED POSTS'); ?></h3><hr>
						<lu class="list-margin text-align-side nuevos-enlaces">
						<?php
						$args = array(
		                    'posts_per_page' => 3,
		                    'post__not_in' => array($post_id),
		                    'category__in' => $catid
		                );
		                $custom_query = new WP_Query($args);
		                if($custom_query->have_posts()){
		                    while($custom_query->have_posts()){
		                    $custom_query->the_post();
		                    $id = $post->ID;
		                    $img_url = get_template_directory_uri() . '/img/posts/default.jpg';
		                    if(has_post_thumbnail()){
		                        $img_url = get_the_post_thumbnail_url();
		                    }
		                    ?>
		                    <li>
		                    <div>
		                        <h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
		                        <i><?php echo get_avatar(get_the_author_meta('ID'), 44); ?> <?php the_author_posts_link(); ?></i>
		                        &nbsp;&nbsp;&nbsp;<i class="fa fa-calendar turquesa"></i>&nbsp;<h7><?php the_time('j-m-Y'); ?></h7>
		                    </div>
		                    </li>
		                    <hr>
		                    <?php
		                    }
		                }
		                ?>
					    </lu>
					</div>
					<div class="abt-2 lists-side">
						<h3 class="single-sidebar-title title-bold-font"><?php _e('CATEGORIES'); ?></h3>
						<lu class="list-margin text-align-side">
						<?php
					        $args = array(
					        	'number' => 10,
					            'title_li' => '',
					            'show_count' => true,
					            'echo' => false
					        );
					        $cats = wp_list_categories($args);
					        $cats = preg_replace('/<\/a> \(([0-9]+)\)/','&nbsp;&nbsp;&nbsp;<span class="list-num">\\1</span></a>', $cats);
					        echo $cats;
					    ?>
					    </lu>
					</div>
					<div class="abt-2 lists-side">
						<h3 class="single-sidebar-title title-bold-font"><?php _e('ARCHIVES'); ?></h3>
						<lu class="list-margin text-align-side nuevos-enlaces">
						<?php
					        wp_get_archives(); 
					    ?>
					    </lu>
					</div>
					<div class="abt-2 lists-side">
						<h3 class="single-sidebar-title title-bold-font"><?php _e('AUTHORS'); ?></h3>
						<text class="nuevos-enlaces">
						<lu class="list-margin title-font nuevos-enlaces">
					    <?php
					        $args = array(
					            'optioncount' => true,
					            'orderby' => 'postcount',
					            'order' => 'DSC',
					            'hide_empty' => false,
					            'echo' => false
					        );
					        $authors = wp_list_authors($args);
					        $authors = preg_replace('/<\/a> \(([0-9]+)\)/','&nbsp;&nbsp;&nbsp;<span class="list-num">\\1</span></a>', $authors);
					        echo $authors;
					    ?>
					    </ul>
					    </text>
					</div>
				</div>
			</div>		
		</div>
	</div>
<?php
    get_footer(); 
?>


