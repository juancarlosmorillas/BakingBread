<nav id="navigation">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="block">
                  <nav class="navbar navbar-default">
                    <div class="container-fluid">
                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                            <a class="navbar-brand" href="<?php echo get_settings('Home'); ?>">
                              <img class="logo-nav" src="<?php echo bloginfo('template_directory') . '/images/betterpics/logo-prox5.png'; ?>" alt="Logo">
                            </a>
                      </div>
                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right" id="">
                          <li><a href="<?php echo get_settings('Home'); ?>#hero-area" class="title-bold-font"><?php _e('Home'); ?></a></li>
                          <li><a href="<?php echo get_page_link(get_page_by_title('Blog')->ID); ?>" class="title-bold-font"><?php _e('Blog'); ?></a></li>
                          <li><a href="<?php echo get_page_link(get_page_by_title('Recipes')->ID); ?>" class="title-bold-font"><?php _e('Recipes'); ?></a></li>
                          <li><a href="<?php echo get_settings('Home'); ?>#blog" class="title-bold-font"><?php _e('News'); ?></a></li>
                          <li><a href="<?php echo get_settings('Home'); ?>#prices" class="title-bold-font"><?php _e('Prices'); ?></a></li>
                          <li><a href="<?php echo get_settings('Home'); ?>#contact-us" class="title-bold-font"><?php _e('Contact'); ?></a></li>
                          <li><a href="<?php echo get_page_link(get_page_by_title('Archives')->ID); ?>" class="title-bold-font"><?php _e('Archives'); ?></a></li>
                        </ul>
                      </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                  </nav>
              </div>
          </div><!-- .col-md-12 close -->
      </div><!-- .row close -->
  </div><!-- .container close -->
</nav><!-- header close -->