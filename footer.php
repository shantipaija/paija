
 
	<footer role="contentinfo">
			
				<div id="inner-footer" class="clearfix row">
		          <hr />
		          <div id="widget-footer" class="clearfix row">
					<div class=" col-md-4 ">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
						<?php endif; ?>

					</div>
					
					<div class=" col-md-4 ">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
						<?php endif; ?>
					</div>
					
					
					<div class=" col-md-4 ">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
						<?php endif; ?>
					</div>
					
		          </div>
					
					<nav class="clearfix">
						<nav class="blog-nav">
							<ul>
								<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container_class' => 'my_footer_menu' ) );?>
							</ul>
						</nav>
					</nav>
					
					<p class="pull-right"><a href="#" id="credit320" title=" ">Peace Paija</a></p>
			
					<p class="attribution">&copy; <?php bloginfo('name'); ?></p>
				
					<p class="pull-right">
						<a href="#" class="floatingtop">top</a>
					</p>
	  
				</div> <!-- end #inner-footer -->

	


	
	<?php 
	//edit admin bar dekhina ko lagi 
	   wp_footer();
	
	?>
 </div> <!-- /.container -->
 
 
  </body>
</html>