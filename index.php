<?php 
get_header();
 ?>

	<div class="row">

		<div class="col-sm-10 blog-main">

			<?php // get_template_part( 'content', get_post_format() ); ?> 
			<?php 
			// 
			
			if ( have_posts() ) : while ( have_posts() ) : the_post();
  	
			// yauta template le arko template ma load garidine kam garchha get_template_part ani content le content.php tanne kam garchha ra get_post_format() le post ho ki page ho etc kura haru check garne kam garchha 
				
				
				get_template_part( 'content', get_post_format() );
				
				
  
			endwhile; 
			?>
	<!--nav>
		<ul class="pager">
			<li><?php next_posts_link( 'Previous' ); ?></li>
			<li><?php previous_posts_link( 'Next' ); ?></li>
		</ul>
	</nav--> 
	<?php
if ( function_exists('vb_pagination') ) {
  vb_pagination();
}
?>
		<?php
		endif; 
			?>

		</div> <!-- /.blog-main -->

		<?php get_sidebar(); ?>
	

	</div> <!-- /.row -->

<?php get_footer(); ?>


		
	
		
	
		
	
	
	
	