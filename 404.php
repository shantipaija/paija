<?php 
get_header();
 ?>

	<div class="row">

		<div class="col-sm-10 blog-main">

			
			<div class="blog-post">
				<h1 class="blog-post-title"><?php _e( 'Not Found', 'paijapp' ); ?></h1>
			

				<hr>

				<!-- the rest of the content -->
				<h2><?php _e( 'This is somewhat embarrassing, isn’t it?', 'paijapp' ); ?></h2>
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'paijapp' ); ?></p>

				<p>
				<?php shantipp_searchform(); ?>
				</p>

			</div><!-- /.blog-post -->
			<div class="clear"></div>
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

		</div> <!-- /.blog-main -->

		<?php get_sidebar(); ?>
	

	</div> <!-- /.row -->

<?php get_footer(); ?>


		
	
		
	
		
	
	
	
	