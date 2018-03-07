<?php
/*
    Template Name: Archives
*/
get_header();
get_template_part('nav');
?>
<div class="container">
    <div class="col-mg-12">
	    <h2 class="main-title title-bold-font"><?php _e('Archives'); ?></h2>
    </div>
    <div class="display-row">
        <div class="col-mg-4">
            <div class="lists-side">
                <h4 class="single-sidebar-title title-bold-font"><?php _e('CATEGORIES'); ?></h4>
            	<lu class="title-font nuevos-enlaces">
            	<?php
                    $args = array(
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
        </div>
        <div class="col-mg-4 second-row">
            <div class="lists-side">
                <h4 class="single-sidebar-title title-bold-font"><?php _e('MOST COMMENTED'); ?></h4>
            	<lu class="title-font nuevos-enlaces">
            	<?php
                    $args = array(
                        'type'  => 'postbypost',
                        'post_type' => array('post', 'my_recipe'),
                        'orderby' => 'comment_count'
                    );
                    $comments_query = new WP_Query($args);
                    if($comments_query->have_posts()){
                        while($comments_query->have_posts()){
                            $comments_query->the_post();
                            $comment_num = wp_count_comments($post->ID);
                            if($comment_num->total_comments > 0){
                                $info = '&nbsp;&nbsp;&nbsp;<span class="cat-num"><i class="fa fa-comment"></i>&nbsp;<?php _e($comment_num->total_comments); ?></span>';
                            }else{
                                $info = '&nbsp;&nbsp;&nbsp;<span class="cat-num">&nbsp;0</span>';
                            }
                            ?>
                            <li><a class="comment-a" href="<?php _e(get_post_permalink()); ?>"><?php the_title();?>&nbsp;&nbsp;&nbsp;<span class="cat-num"><i class="fa fa-comment"></i>&nbsp;<?php _e($comment_num->total_comments); ?></span></a></li>
                            <?php
                        }
                    }
                    wp_reset_query();
                ?>
                </lu>
            </div>
            <br>
            <div class="lists-side">
                <h4 class="single-sidebar-title title-bold-font"><?php _e('TAGS'); ?></h4>
                <lu class="title-font nuevos-enlaces">
                <?php
                    list_tags_with_count();
                ?>
                </lu>
            </div>
            <br>
            <div class="lists-side">
                <h4 class="single-sidebar-title title-bold-font"><?php _e('RECIPES'); ?></h4>
                <lu class="title-font nuevos-enlaces">
                <?php
                    $args = array(
                        'type'  => 'postbypost',
                        'post_type' => 'my_recipe',
                        
                    );
                    wp_get_archives($args);
                ?>
                </lu>
            </div>
        </div>
        <div class="col-mg-4 third-row">
            <div class="lists-side">
                <h4 class="single-sidebar-title title-bold-font"><?php _e('AUTHORS'); ?></h4>
                <lu class="title-font nuevos-enlaces">
                <?php
                    $args = array(
                        'optioncount' => true,
                        'orderby' => 'postcount',
                        'order' => 'DSC',
                        'hide_empty' => false,
                        'echo' => false
                    );
                    $authors = wp_list_authors($args);
                    $authors = preg_replace('/<\/a> \(([0-9]+)\)/','&nbsp;&nbsp;&nbsp;<span class="cat-num">\\1</span></a>', $authors);
                    _e($authors);
                ?>
                </lu>
            </div>
            <br>
            <div class="lists-side">
                <h4 class="single-sidebar-title title-bold-font"><?php _e('ARCHIVES (month)'); ?></h4>
                <lu class="title-font nuevos-enlaces">
                <?php
                    wp_get_archives(); 
                ?>
                </lu>
            </div>
            <br>
            <div class="lists-side">
                <h4 class="single-sidebar-title title-bold-font"><?php _e('ARCHIVES (week)'); ?></h4>
                <lu class="title-font nuevos-enlaces">
                <?php
                    $args = array(
                        'type' => 'weekly'
                    );
                    wp_get_archives($args);
                ?>
                </lu>
            </div>
            <br>
            <div class="lists-side">
                <h4 class="single-sidebar-title title-bold-font"><?php _e('LAST POSTS'); ?></h4>
                <lu class="title-font nuevos-enlaces">
                <?php
                    $args = array(
                        'type'  => 'postbypost',
                        'limit' => 8
                    );
                    wp_get_archives($args);  
                ?>
                </lu>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>