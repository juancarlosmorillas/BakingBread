<?php
/*
    Template Name: Recipes
*/
get_header();
get_template_part('nav');
?>
<div class="about">
	<div class="container">
		<div class="about-main">
			<div class="col-md-8 about-left mb50">
			    <h1 class="title-bold-font text-center">Recipes</h1>
			   	<?php
			      $args = array(
			        'posts_per_page' => 3,
			        'post_type' => array('my_recipe')
			      );
			      $args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			      $custom_query = new WP_Query($args);
			      if($custom_query->have_posts()){
			        while($custom_query->have_posts()){
			          $custom_query->the_post();
			          get_template_part('template-parts/content', 'my_recipe');
			        }
                      $big = 999999999; 
                        //$currentpage = get_query_var('paged');
                        $args = array(
                        	'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
					        'format'    => '?paged=%#%',
					        'total'     => $custom_query->max_num_pages,
					        'current'   => max(1, $paged),
					        'show_all'  => false,
					        'end_size'  => $endsize,
					        'mid_size'  => $midsize,
					        'type'      => 'plain',
					        'prev_text' => '<button class="boton-pag button button-dark button-sm">Previous</button>',
					        'next_text' =>  '<button class="boton-pag button button-dark button-sm">Next</button>',
					        'before_page_number' => '<button class="boton-pag button-o button-sm button-dark hover-fade">',
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
<?php
get_footer();