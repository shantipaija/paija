<?php 
get_header(); 
?>

	<div class="row">

		<div class="col-sm-8 blog-main">

			<?php 
			// 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
			// yauta template le arko template ma load garidine kam garchha get_template_part ani content le content.php tanne kam garchha ra get_post_format() le post ho ki page ho etc kura haru check garne kam garchha 
			
				$wp_postformat =  get_post_format() ? get_post_format() : 'standard';
				
				
			get_template_part( 'content', $wp_postformat ); 

				
			if ( comments_open() || get_comments_number() ) :
			  comments_template();
			endif;
  
			 endwhile; endif; 
			?>

		</div> <!-- /.blog-main -->

		<?php get_sidebar(); ?>

	</div> <!-- /.row -->

<?php get_footer(); ?>


		
	
		
	
		
	
	
	
	