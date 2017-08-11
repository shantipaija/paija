<?php
 get_header(); 
 ?>

	<div class="row">
		<div class="col-sm-12">

			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
		
					
					//get_template_part( 'content', 'standard' );
					
					?>
					<div class="blog-post">
							<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="blog-post-meta"><?php the_date(); ?>  by <a href="#"><?php the_author(); ?></a></p>

							 <?php the_content(); ?>
						<hr>

						<!-- the rest of the content -->

						</div><!-- /.blog-post -->
						<div class="clear"></div>
					<?php
  
				endwhile; endif; 
			?>

		</div> <!-- /.col -->
		
		<?php //get_sidebar(); ?>
	
	</div> <!-- /.row -->

<?php get_footer(); ?>