<?php
get_header();
get_template_part('nav');
?>
<div class="about">
	<div class="container">
	    <br><br><br>
	    <div class="col-lg-4"></div>
	    <div class="col-lg-4"><h2 class="title-bold-font"><?php _e('Search'); ?></h2></div>
	    <div class="col-lg-4"></div>
		<div class="about-main">
			<div class="col-md-8 about-left">
			<div class="row title-bold-font">
                <h3>Search results for: &nbsp;&nbsp;<span class="colored"><?php echo get_search_query(); ?></span></h3>
            <?php
                if(have_posts()){
                    $total = $wp_the_query->found_posts;
                    if($total > 1){
                        $prev = _e('<h4 class="title-bold-font">');
                        $mensaje = _e('Showing');
                        $then = _e(' <span class="colored">' . $total . '</span> posts.</h4>');
                    }else{
                        $prev = _e('<h4 class="title-bold-font">');
                        $mensaje = _e('Showing');
                        $then = _e(' <span class="colored">' . $total . '</span> post.</h4>');
                    }
                }else{
                    $prev = _e('<h4 class="title-bold-font">');
                    $mensaje = _e('No posts found.');
                    $then = _e('</h4>');
                }
            ?>
            <?php $prev; $mensaje; $then; ?></h4>
            </div>
            <br>
            <div class="row title-font">
                <table class="result-table">
                    <tr>
                        <td><h4>Nº</h4></td>
                        <td><h5><?php _e('Title'); ?></h5></td>
                        <td><h5><?php _e('Author'); ?></h5></td>
                        <td><h5><?php _e('Date'); ?></h5></td>
                    </tr>
                    <?php
                        global $count;
                        $count = 0;
                        if(have_posts()){
                            while(have_posts()){
                                the_post();
                                if($post->post_type != 'page'){
                                    get_template_part('template-parts/content', 'list');
                                }
                            }
                        }
                        wp_reset_query();
                    ?>
              </table>
              <?php
                $args_pag = array(
		        	'prev_text' => '<i class="fa fa-arrow-left"></i>&nbsp;',
		        	'next_text' => '&nbsp;<i class="fa fa-arrow-right"></i>',
		        	'before_page_number' => '&nbsp;<span class="colored pagination-num"></span>&nbsp;'
		        );
		    	the_posts_pagination($args_pag);
	      		?>
            </div>
			</div>
			<div class="col-md-4 about-right title-font">
		    <div class="abt-1 heading">
				<h3 class="single-sidebar-title title-bold-font"><?php _e('SEARCH'); ?></h3>
				<div class="news">
					<?php get_search_form(); ?>
				</div>
			</div>
			<div class="abt-1 heading">
			    <h3 class="title-bold-font"><?php _e('TOP CATEGORIES'); ?></h3>
			    <br>
			    <ul class="sidebarlist lists-side">
                  <?php 
                      $args = array(
                          'title_li' => null,
                          'number' => 5,
                          'orderby' => 'postcount',
                          'order' => 'DSC',
                          'echo' => null
                      );
                      $cats = wp_list_categories($args);
                      echo $cats; 
                  ?>
                </ul>
			</div>
		</div>
		</div>	
	</div>
</div>
<?php
    get_footer(); 
?>