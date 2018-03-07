<?php
get_header()
?>
	<!--
	header-img start 
	============================== -->
    <section id="hero-area">
        <img class="img-responsive main-photo" src="<?php echo bloginfo('template_directory') . '/images/betterpics/foto.jpg'; ?>" alt="">
    </section>
    
	<!-------------NAV----------------->
	
    <?php get_template_part('nav', 'front'); ?>

    <!--
    Slider start
    ============================== -->
    <section id="slider">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <div class="title">
                            <h3 class="title-bold-font"><?php _e('Are you'); ?> <span><?php _e('hungry'); ?></span>?</h3>
                        </div>
                        <div id="owl-example" class="owl-carousel">
                            <div>
                                <img class="img-responsive" src="<?php echo bloginfo('template_directory') . '/images/betterpics/slider1.jpg'; ?>" alt="">
                            </div>
                            <div>
                                <img class="img-responsive" src="<?php echo bloginfo('template_directory') . '/images/betterpics/slider2.jpg'; ?>" alt="">
                            </div>
                            <div>
                                <img class="img-responsive" src="<?php echo bloginfo('template_directory') . '/images/betterpics/slider3.jpg'; ?>" alt="">
                            </div>
                            <div>
                                <img class="img-responsive" src="<?php echo bloginfo('template_directory') . '/images/betterpics/slider4.jpg'; ?>" alt="">
                            </div>
                            <div>
                                <img class="img-responsive" src="<?php echo bloginfo('template_directory') . '/images/betterpics/slider5.jpg'; ?>" alt="">
                            </div>
                            <div>
                                <img class="img-responsive" src="<?php echo bloginfo('template_directory') . '/images/betterpics/slider6.jpg'; ?>" alt="">
                            </div>
                            <div>
                                <img class="img-responsive" src="<?php echo bloginfo('template_directory') . '/images/betterpics/slider7.jpg'; ?>" alt="">
                            </div>
                            <div>
                                <img class="img-responsive" src="<?php echo bloginfo('template_directory') . '/images/betterpics/slider8.jpg'; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div><!-- .col-md-12 close -->
            </div><!-- .row close -->
        </div><!-- .container close -->
    </section><!-- slider close -->
    
    <section id="blog" style="background-image: url('<?php echo get_template_directory_uri() . '/images/betterpics/background2.jpg';?>') !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h1 class="heading title-bold-font"><?php _e('Latest'); ?> <span><?php _e('from the'); ?> </span>Blog</h1>
                        <ul class="col-md-12">
                            <?php
                            $args = array(
                                'posts_per_page' =>4,
                                'post_type' => 'post'
                            );
                            $custom_query = new WP_Query($args);
                            if($custom_query->have_posts()){
                                $counter = 0;
                                while($custom_query->have_posts()){
                                    $custom_query->the_post();
                                    if($counter == 1 || $counter == 2){
                                        get_template_part('template-parts/contentlistfront1');
                                    }else{
                                        get_template_part('template-parts/contentlistfront2');
                                    }
                                    $counter++;
                                }
                            }
                            wp_reset_query();
                            ?>
                        </ul>
                    </div>
                </div><!-- .col-md-12 close -->
            </div><!-- .row close -->
        </div><!-- .containe close -->
    </section><!-- #blog close -->
    <!--
    price start
    ============================ -->
    <section id="price">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h1 class="title-bold-font heading wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms"><?php _e('our'); ?> <span><?php _e('PRODUCTS'); ?></span> <?php _e('and'); ?> <span><?php _e('PRICES'); ?></span></h1>
                        <p class="wow fadeInUp title-font" data-wow-duration="300ms" data-wow-delay="400ms"><?php  _e("Each week we promote new products along with the top sold products of other weeks. We can't post all the new offers so come along and pay a visit so you can take a look at the menu."); ?></p>
                        <div class="pricing-list">
                            <div class="title">
                                <h3 class="title-font"><?php _e('Featured'); ?> <span><?php _e('on the week'); ?></span></h3>
                            </div>
                            <ul>
                                <li class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">
                                    <div class="item">
                                        <div class="item-title title-font">
                                            <h2><?php _e('Cupcakes and such'); ?></h2>
                                            <div class="border-bottom"></div>
                                            <span>$ 5.00</span>
                                        </div>
                                        <p class="title-font"><?php _e('Traditional cupcakes decorated with all kind of color and styles, find yours!'); ?></p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="400ms">
                                    <div class="item">
                                        <div class="item-title title-font">
                                            <h2>Cookie packs</h2>
                                            <div class="border-bottom"></div>
                                            <span>$ 8.00</span>
                                        </div>
                                        <p class="title-font"><?php _e('Home made cookies with chocolate chunks or fruit such as strawberry, apple or coconut.'); ?></p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="500ms">
                                    <div class="item">
                                        <div class="item-title title-font">
                                            <h2><?php _e('Apple pie'); ?> </h2>
                                            <div class="border-bottom"></div>
                                            <span>$ 4.00</span>
                                        </div>
                                        <p class="title-font"><?php _e('Apple pie made with daily delivered apples from the best trees.'); ?> </p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="600ms">
                                    <div class="item">
                                        <div class="item-title title-font">
                                            <h2><?php _e('Patty'); ?></h2>
                                            <div class="border-bottom"></div>
                                            <span>$ 3.00</span>
                                        </div>
                                        <p class="title-font"><?php _e('Homestyle pattys filled with onion, pepper, tuna and tomato sauce.'); ?></p>
                                    </div>
                               </li>
                                <li class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="700ms">
                                    <div class="item">
                                        <div class="item-title title-font">
                                            <h2><?php _e('Various products (each piece)'); ?></h2>
                                            <div class="border-bottom"></div>
                                            <span>$ 1.00</span>
                                        </div>
                                        <p class="title-font"><?php _e('Various tipical scones like chocolate canes, small cakes, biscuits, etc'); ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- .col-md-12 close -->
            </div><!-- .row close -->
        </div><!-- .containe close -->
    </section><!-- #price close -->
    <!--------- PRUEBAAA -------->
    <!--
    <section id="pricing" class="description_content">
            <div class="text-content container"> 
                <div class="container">
                    <div class="row">
                        <div id="colum">
                            <ul id="filter-list" class="clearfix">
                                <li class="filter" data-filter="all">All</li>
                                <li class="filter" data-filter="breakfast">Breakfast</li>
                                <li class="filter" data-filter="special">Special</li>
                                <li class="filter" data-filter="desert">Desert</li>
                                <li class="filter" data-filter="dinner">Dinner</li>
                            </ul> 
                            <ul id="col-12">
                               
                                <li class="item breakfast"><img src="<?php echo bloginfo('template_directory') . '/images/food/food_icon01.jpg'; ?>" alt="Food" >
                                    <h2 class="white">$20</h2>
                                </li>

                                <li class="item dinner special"><img src=" <?php echo bloginfo('template_directory') . '/images/food/food_icon02.jpg'; ?>" alt="Food" >
                                    <h2 class="white">$20</h2>
                                </li>
                                <li class="item dinner breakfast"><img src=" <?php echo bloginfo('template_directory') . '/images/food/food_icon03.jpg'; ?>" alt="Food" >
                                    <h2 class="white">$18</h2>
                                </li>
                                <li class="item special"><img src="<?php echo bloginfo('template_directory') . '/images/food/food_icon04.jpg'; ?>" alt="Food" >
                                    <h2 class="white">$15</h2>
                                </li>
                                <li class="item dinner"><img src="<?php echo bloginfo('template_directory') . '/images/food/food_icon05.jpg'; ?>" alt="Food" >
                                    <h2 class="white">$20</h2>
                                </li>
                                <li class="item special"><img src="<?php echo bloginfo('template_directory') . '/images/food/food_icon06.jpg'; ?>" alt="Food" >
                                    <h2 class="white">$22</h2>
                                </li>
                                <li class="item desert"><img src="<?php echo bloginfo('template_directory') . '/images/food/food_icon07.jpg'; ?>" alt="Food" >
                                    <h2 class="white">$32</h2>
                                </li>
                                <li class="item desert breakfast"><img src="<?php echo bloginfo('template_directory') . '/images/food/food_icon08.jpg'; ?>" alt="Food" >
                                    <h2 class="white">$38</h2>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>  
        </section>
        -->
        
        <!--------- FIN PRUEBA ------>
    
    
    <!--
    subscribe start
    ============================ -->
    <section id="subscribe" style="background-image: url('<?php echo get_template_directory_uri() . '/images/betterpics/baking.jpg';?>') !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block title-font">
                        <h1 class=" heading wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms"> <?php _e('SUBSCRIBE'); ?> <span><?php _e('to our'); ?></span> <?php _e('NEWSLETTER'); ?></h1>
                        <p class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="400ms"><?php _e('Stay tunned about what is going on in the oven every second.'); ?> </p>
                        <form class="form-inline">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="exampleInputAmount" placeholder="<?php _e('Enter your email to subscribe'); ?>...">
                                    <div class="input-group-addon">
                                        <button class="btn btn-default" type="submit"><?php _e('Subscribe'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- .col-md-12 close -->
            </div><!-- .row close -->
        </div><!-- .containe close -->
    </section><!-- #subscribe close -->
    <!--
    CONTACT US  start
    ============================= -->
    <section id="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block title-font">
                        <h1 class="heading wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms"><span><?php _e('CONTACT US'); ?></span></h1>
                        <h3 class="title wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms"><?php _e('Sign Up for'); ?> <span><?php _e('Email Alerts'); ?></span> </h3>
                        <form>
                            <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="600ms">
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php _e('Write your full name here'); ?>...">
                            </div>
                            <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="800ms">
                                <input type="text" class="form-control" placeholder="<?php _e('Write your email address here'); ?>...">
                            </div>
                            <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1000ms">
                                <textarea class="form-control" rows="3" placeholder="<?php _e('Write your message here'); ?>..."></textarea>
                            </div>
                        </form>
                        <a class="btn btn-default wow bounceIn" data-wow-duration="500ms" data-wow-delay="1300ms" href="#" role="button"><?php _e('Send your Message'); ?></a>
                    </div>
                </div><!-- .col-md-12 close -->
            </div><!-- .row close -->
        </div><!-- .container close -->
    </section><!-- #contact-us close -->
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
                                    'post__not_in' => array($dest_id),
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
                            <h3><?php _e('Follow'); ?><span class="colored"><?php _e('US'); ?></span></h3>
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