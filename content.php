	<div class="col-sm-8 blog-post">
		<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="blog-post-meta"><?php echo get_the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>

			 <?php if ( has_post_thumbnail() ) {?>

			<?php	the_post_thumbnail('thumbnail'); ?>

			<?php the_excerpt(); ?>

	<?php } else { ?>
	<?php the_excerpt(); ?>
	<?php } ?>
		<hr>

		<!-- the rest of the content -->
		<a href="<?php comments_link(); ?>">
		<?php
		printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n(get_comments_number() ) ); ?>
		</a>
	
	</div><!-- /.blog-post -->
	
	<div class="clear"></div> 
	

	
	
	
	
	