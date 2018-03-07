<div class="abt-1">
	<h3 class="single-sidebar-title title-bold-font"><?php _e('SEARCH'); ?></h3>
	<div class="news">
		<?php get_search_form(); ?>
		<br>
	</div>
</div>
<div class="abt-2 lists-side">
	<h3 class="single-sidebar-title title-bold-font"><?php _e('LAST POSTS'); ?></h3>
	<lu class="title-font list-margin nuevos-enlaces">
	<?php
        $args = array(
            'type'  => 'postbypost',
            'limit' => 5
        );
        wp_get_archives($args); 
    ?>
    </lu>
</div>
<div class="abt-2 lists-side">
	<h3 class="single-sidebar-title title-bold-font"><?php _e('RECIPES'); ?></h3>
	<lu class="title-font list-margin nuevos-enlaces">
	<?php
        $args = array(
            'type'  => 'postbypost',
            'limit' => 5,
            'post_type'=> 'my_recipe'
        );
        wp_get_archives($args); 
    ?>
    </lu>
</div>
<div class="abt-2">
	<h3 class="single-sidebar-title title-bold-font"><?php _e('TAGS'); ?></h3>
	<div class="might-grid">
		<h3 class="sectiontitle">Tags:</h3>
        <?php
            if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widget')) : 
        ?>
        <div>No widgets found, please check your back-end widget configuration and try again.</div>
        <?php endif;?>
	</div>							
</div>
<div class="abt-2 lists-side">
	<h3 class="single-sidebar-title title-bold-font"><?php _e('CATEGORIES'); ?></h3>
	<lu class="list-margin title-font">
	<?php
        $args = array(
            'number' => 10,
            'title_li' => '',
            'show_count' => true,
            'orderby' => 'count',
            'order' => 'DES',
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
	<lu class="list-margin title-font nuevos-enlaces">
	<?php
        wp_get_archives(); 
    ?>
    </lu>
</div>
<div class="abt-2 lists-side title-font nuevos-enlaces">
	<h3 class="list-margin title-bold-font"><?php _e('AUTHORS'); ?></h3>
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
</div>