<?php
    get_header();
   
    the_post();
    $post_id = $post->ID;
    //echo $post_id;
    $category = get_the_category();
    $catid= array();
    foreach ($category as $cat){
        $catid[] = $cat->term_id;
    }
    //echo var_dump($catid);
    get_template_part('nav');
    $args = array(
	    'posts_per_page' => 1,
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
	      //Vemos si tiene foto, sino le ponemos la img por defecto
	      if(has_post_thumbnail()){
	        $img_url = get_the_post_thumbnail_url();
	      }else{
	        $img_url = get_template_directory_uri() . '/img/default.jpg';
	      }
	      $dest_id = $post->ID; 
?>

	<!--banner-starts-->
	<div class="banner">
		<div class="container">
			<div class="banner-top" style="background-image: url('<?php echo $img_url; ?>') !important;">
				
			</div>
			<div class="col-lg-2"></div>
			<div class="about-two main-excerpt text-center col-lg-8">
				<div class="nuevos-enlaces"><a href="<?php echo get_post_permalink(); ?>" class="title-link title-bold-font"><h1><?php the_title(); ?></h1></a></div>
				<h5 class="nuevos-enlaces title-font"><i class="fa fa-user"></i>&nbsp;<?php the_author_posts_link(); ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i>&nbsp;<?php the_time('j-m-Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;<?php echo wp_count_comments($post->ID)->total_comments; ?></h5>
				<span class="index-content"><p><?php the_excerpt(); ?></p></span>
			</div>
		</div>
	</div>
	<hr>
<?php
		}
	}
	wp_reset_query();
?>
	<!--banner-end-->
	<!--about-starts-->
	<div class="about">
		<div class="container">
			<div class="about-main">
				<div class="col-md-8 about-left">
				   	<?php
				      $args = array(
				        'posts_per_page' => 3,
				        'post__not_in' => array($dest_id),
				        'post_type' => array('post', 'my_recipe')
				      );
				      $args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				      $custom_query = new WP_Query($args);
				      if($custom_query->have_posts()){
				        while($custom_query->have_posts()){
				          $custom_query->the_post();
				          if(get_post_type() === 'my_recipe'){
				            get_template_part('template-parts/content', 'my_recipe');
				          }else{
				            get_template_part('template-parts/content', get_post_format());
				          }
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
				      }
				      wp_reset_query();
		      		?>
				</div>
				<div class="col-md-4 about-right heading">
					<?php get_sidebar(); ?>
				</div>
				<div class="clearfix"></div>			
			</div>		
		</div>
	</div>
	<!--about-end-->
	<!--slide-starts-->
	<div class="slide">
		<div class="container">
			<div class="fle-xsel">
			<ul id="flexiselDemo3">
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="images/s-1.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="images/s-2.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>			
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="images/s-3.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>		
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="images/s-4.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>	
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="images/s-5.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>	
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="images/s-6.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>				
			</ul>
							
							 <script type="text/javascript">
								$(window).load(function() {
									
									$("#flexiselDemo3").flexisel({
										visibleItems: 5,
										animationSpeed: 1000,
										autoPlay: true,
										autoPlaySpeed: 3000,    		
										pauseOnHover: true,
										enableResponsiveBreakpoints: true,
										responsiveBreakpoints: { 
											portrait: { 
												changePoint:480,
												visibleItems: 2
											}, 
											landscape: { 
												changePoint:640,
												visibleItems: 3
											},
											tablet: { 
												changePoint:768,
												visibleItems: 3
											}
										}
									});
									
								});
								</script>
								<script type="text/javascript" src="js/jquery.flexisel.js"></script>
					<div class="clearfix"> </div>
			</div>
		</div>
	</div>	
	<!--slide-end-->


<?php
    get_footer(); 
?>


