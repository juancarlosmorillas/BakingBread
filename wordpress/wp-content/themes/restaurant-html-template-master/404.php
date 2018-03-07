<?php
get_header()
?><!-------------NAV----------------->
    <?php get_template_part('nav'); ?>
    <section id="blog" class="blog-404">
        <div class="not-found" style="background-image: <?php echo bloginfo('template_directory') . '/images/betterpics/404_2.png'; ?>;">
            <img src="<?php echo bloginfo('template_directory') . '/images/betterpics/404_2.png'; ?>">
        </div>
    </section><!-- #blog close -->
    <!--
    footer  start
    ============================= -->
    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="block title-font wow fadeInLeft"  data-wow-delay="200ms">
                        <h3><?php _e('CONTACT'); ?> <span class="colored">INFO</span></h3>
                        <div class="info">
                            <ul>
                                <li>
                                  <h4 class="colored"><i class="fa fa-phone"></i> <?php _e('Phone'); ?></h4>
                                  <p>+34 645 74 29 - +34 955 23 54 45</p>
                                    
                                </li>
                                <li>
                                  <h4 class="colored"><i class="fa fa-map-marker"></i> <?php _e('Address'); ?></h4>
                                  <p>2046 Blue Spruce Lane Laurel Canada</p>
                                </li>
                                <li>
                                  <h4 class="colored"><i class="fa fa-envelope"></i> <?php _e('Email'); ?></h4>
                                  <p>bakingbreadoficial@gmail.com</p>
                                  
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- .col-md-4 close -->
                <div class="col-md-4">
                    <div class="block title-font wow fadeInLeft"  data-wow-delay="700ms">
                        <h3><?php _e('LATEST'); ?> <span class="colored"><?php _e('BLOG POSTS'); ?></span></h3>
                        <div class="blog">
                            <ul>
                                <?php
                                $args = array(
                                    'posts_per_page' => 2,
                                    'post_type' => 'post',
                                    'tax_query' => array(
                                      array(
                                        'taxonomy' => 'post_format',
                                        'field' => 'slug',
                                        'terms' => array(
                                          'post-format-link',
                                          'post-format-quote',
                                          'post-format-video',
                                          'post-format-gallery',
                                          'post-format-audio',
                                          'post-format-image',
                                          'post-format-aside'
                                        ),
                                        'operator' => 'NOT IN'
                                      )
                                    )
                                );
                                $custom_query = new WP_Query($args);
                                if($custom_query->have_posts()){
                                    while($custom_query->have_posts()){
                                        $custom_query->the_post();
                                        get_template_part('template-parts/contentlistfooter', '');
                                        
                                    }
                                }
                                wp_reset_query();
                                ?>
                            </ul>                
                        </div>
                    </div>
                </div>
                <!-- .col-md-4 close -->
                <div class="col-md-4">
                    <div class="block wow title-font fadeInLeft"  data-wow-delay="1100ms">
                        <div class="gallary">
                            <h3><?php _e('PHOTO'); ?> <span class="colored"><?php _e('STREAM'); ?></span></h3>
                            <ul>
                                <li>
                                    <a href="#"><img src="<?php echo bloginfo('template_directory') . '/images/betterpics/sliderfooter1.jpg'; ?>" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo bloginfo('template_directory') . '/images/betterpics/sliderfooter2.jpg'; ?>" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo bloginfo('template_directory') . '/images/betterpics/sliderfooter3.jpg'; ?>" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo bloginfo('template_directory') . '/images/betterpics/sliderfooter4.jpg'; ?>" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="social-media-link">
                            <h3><?php _e('Follow'); ?><span><?php _e('US'); ?></span></h3>
                            <ul>
                                <li>
                                    <a href="https://twitter.com/?lang=en" target="_blank">
                                        <img class="social-media-img" src="<?php echo bloginfo('template_directory') . '/images/betterpics/twitter.svg'; ?>">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://es-es.facebook.com/" target="_blank">
                                        <img class="social-media-img" src="<?php echo bloginfo('template_directory') . '/images/betterpics/facebook.svg'; ?>">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/?hl=en" target="_blank">
                                        <img class="social-media-img" src="<?php echo bloginfo('template_directory') . '/images/betterpics/instagram.svg'; ?>">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://es.linkedin.com/" target="_blank">
                                        <img class="social-media-img" src="<?php echo bloginfo('template_directory') . '/images/betterpics/linkedin.svg'; ?>">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- .col-md-4 close -->
            </div><!-- .row close -->
        </div><!-- .containe close -->
    </section><!-- #footer close -->
    
<!---.------ FOOTER ---------->
<?php
    get_footer();
?>
  