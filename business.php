<?php get_header(); ?>

	<div class="row">
		<div class="col-sm-12">


				<?php 
				$args =  array( 
					'post_type' => 'my-custom-post',
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
				 $custom_query = new WP_Query( $args );
				while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
					
			
					<div class="blog-post">
							<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="blog-post-meta"><?php the_date(); ?>  by <a href="#"><?php the_author(); ?></a></p>

							 <?php the_content(); ?>
						<hr>

						<!-- the rest of the content -->

						</div><!-- /.blog-post -->
						<div class="clear"></div>
					
  
				 <?php endwhile; 
			?>
			
			<?php 

$args = array(
	'post_type' => 'business',
);  

$your_loop = new WP_Query( $args ); 


if ( $your_loop->have_posts() ) : 
	while ( $your_loop->have_posts() ) : 
		$your_loop->the_post(); 
		
		$meta = get_post_meta( $post->ID, 'your_fields', true ); 
		?>

		<!-- contents of Your Post -->
			<h1>Title</h1>
			<?php the_title(); ?>

			<h1>Content</h1>
			<?php the_content(); ?>
		<?php 
	endwhile;
endif; 

wp_reset_postdata(); 

?>

		</div> <!-- /.col -->
	</div> <!-- /.row -->

<?php get_footer(); ?>