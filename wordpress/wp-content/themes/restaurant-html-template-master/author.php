<?php get_header(); ?>
<?php get_template_part('nav'); 
  $curauth = (get_query_var('author_name')) ? get_user_by('slug',get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>
<div class="container ">
    <div class="about-main display-row">
        <div class="col-md-8 block wow about-left author-info">
            <br>
            <h1 class="title-author title-bold-font"><?php _e(get_author_name()); ?></h1>
            <?php
            $author_id = get_the_author_id();
            switch ($author_id) {
                case 1:
                    $img_url = get_template_directory_uri() . '/images/1.jpg';
                    break;
                case 2:
                    $img_url = get_template_directory_uri() . '/images/2.jpg';
                    break;
                default:
                    $img_url = get_template_directory_uri() . '/images/default-profile.jpg';
                    break;
            }
            ?>
            <div class="profile-pic" style="background-image: url('<?php echo $img_url; ?>');"></div>
            <br>
            <div class="icons-author social-media-link">
                <a href="<?php echo get_the_author_meta(facebook); ?>" target="_blank"><img class="social-author" src="<?php echo bloginfo('template_directory') . '/images/betterpics/facebook-button.svg'; ?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="avatar-author more"><?php echo get_avatar(get_the_author_meta('ID'), 64); ?></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo get_the_author_meta(twitter); ?>" target="_blank"><img class="social-author" src="<?php echo bloginfo('template_directory') . '/images/betterpics/twitter-button.svg'; ?>"></a>
            </div>
            <br>
            <div class="description-author title-font">
                <?php _e(get_the_author_meta('description')); ?>
            </div>
            <br><br>
            <section class="skill-place">
                <div class="skills center">
                  <div class="text-center">
                    <h4 class="title-bold-font"><?php _e(get_the_author_meta('skill1d')); ?></h4>
                    <canvas id="doughnut" width="120" height="120"></canvas>
                    <canvas id="skill1" width="120" height="120" class="" value="<?php echo get_the_author_meta('skill1v'); ?>"></canvas>
                  </div>
                  <div class="text-center">
                    <h4 class="title-bold-font"><?php _e(get_the_author_meta('skill2d')); ?></h4>
                    <canvas id="doughnut2" width="120" height="120"></canvas>
                    <canvas id="skill2" width="120" height="120" class="" value="<?php echo get_the_author_meta('skill2v'); ?>"></canvas>
                  </div>
                  <div class="text-center">
                    <h4 class="title-bold-font"><?php _e(get_the_author_meta('skill3d')); ?></h4>
                    <canvas id="doughnut3" width="120" height="120"></canvas>
                    <canvas id="skill3" width="120" height="120" class="" value="<?php echo get_the_author_meta('skill3v'); ?>"></canvas>
                  </div>
                  <div class="text-center">
                    <h4 class="title-bold-font"><?php _e(get_the_author_meta('skill4d')); ?></h4>
                    <canvas id="doughnut4" width="120" height="120"></canvas>
                    <canvas id="skill4" width="120" height="120" class="" value="<?php echo get_the_author_meta('skill4v'); ?>"></canvas>
                  </div>
                </div>
            </section>
            <br><br>
            <div class="author-posts">
                <h2 class="title-author title-bold-font"><?php _e('Some posts from'); ?> <?php _e(get_author_name()); ?></h2>
                <?php
                $args = array(
                    'posts_per_page' => 3,
                    'post_type' => array('post', 'my_recipe'),
                    'author' => $curauth->ID /*'author' necesita el id del autor, 'author_name' necesita el nickname*/
                  );
                  $args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                  $custom_query = new WP_Query($args);
                  if($custom_query->have_posts()){
                    while($custom_query->have_posts()){
                      $custom_query->the_post();
                      ?>
                      <h3 class="title-font nuevos-enlaces"><a href="<?php echo get_post_permalink(); ?>"><?php the_title(); ?></a></h3>
                      <i class="fa fa-calendar">&nbsp;&nbsp;&nbsp;<span class="title-font"><?php the_time('j-m-Y'); ?></span></i>
                      <hr>
                      <?php
                    }
                    $big = 999999999; 
                    $args = array(
                    	'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
      				        'format'    => '?paged=%#%',
      				        'total'     => $custom_query->max_num_pages,
      				        'current'   => max(1, $paged),
      				        'show_all'  => false,
      				        'end_size'  => $endsize,
      				        'mid_size'  => $midsize,
      				        'type'      => 'plain',
      				        'prev_text' => '<button class="boton-pag"><i class="fa fa-arrow-left"></i></button>',
      				        'next_text' =>  '<button class="boton-pag"><i class="fa fa-arrow-right"></i></button>',
      				        'before_page_number' => '<button class="boton-pag">',
      				        'after_page_number' => '</button>'
                          	);
					            echo paginate_links($args);
                  }else{
                    ?>
                      <h3 class="title-font"><?php _e('Author does not have any posts yet.'); ?></h3>
                    <?php
                  }
                  wp_reset_query(); 
                ?>
            </div>
        </div>
        <div class="col-md-4 about-right heading">
            <br><br>
            <?php get_sidebar(); ?>
        </div>
        <br><br>
    </div>
</div>
<?php get_footer(); ?>