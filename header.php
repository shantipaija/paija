<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo get_bloginfo( 'name' ); ?></title>
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php 
	 wp_head(); 
	?>
</head>

<body>

	<div class="blog-masthead">
		<div class="container">
		
		
		
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						<div id="header-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_option('logo'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" title="<?php echo get_bloginfo( 'description' ); ?>" alt="Logo" width="48px" height="48px" /></a>
						</div>
					</div>
					<div id="primary-navbar-collapse" class="collapse navbar-collapse">
				
						<?php //wp_nav_menu(); ?>
						
						<?php 
						bootstrap_nav(); 
						?>
							
						<div class="col-sm-3 col-md-3  navbar-right">
							<form class="navbar-form" role="search">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search" name="s" value="<?php echo get_search_query(); ?>">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
							</form>
						</div>
					
					</div>
						
				</div><!--/.container-fluid -->
			</nav>					

			
<?php 
	if( is_home() ){
?>
	<div class="row">			
		<div class="col-sm-12">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					<?php $slider = get_posts(array('post_type' => 'slider', 'posts_per_page' => 5)); ?>
					  <?php $count = 0; ?>
					  <?php foreach($slider as $slide): ?>
					  <div class="item <?php echo ($count == 0) ? 'active' : ''; ?>">
						<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID)) ?>" class="img-responsive"/>
					  </div>
					  <?php $count++; ?>
					<?php endforeach; ?>
				  </div>

				  <!-- Controls -->
				  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
			</div>
		</div>

		
	</div><!-- /.row -->


<?php
}
?>
		<div class="clear"></div>

		
			
		