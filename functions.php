<?php

	add_theme_support('post-formats', array('image','gallery'));
	
	
	// Support Featured Images
	add_theme_support( 'post-thumbnails' );
 
 function custom_function(){
	 echo "<h1>Footer ma yo dekh ne ho </h1>";
	 //yadi echo ko thauma printf use garnu pareko bhaya printf("dfdfk dfkxf ") use garnu parthiyo ra yasko same echo jastai kam ho
 }
 //add_action('the_title','custom_function');
 


// WordPress Titles
add_theme_support( 'title-tag' );


// Custom settings
function custom_settings_add_menu() {
  add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'custom_settings_add_menu' );



// Create Custom Global Settings
function custom_settings_page() { ?>
  <div class="wrap">
    <h1>Custom Settings</h1>
    <form method="post" action="options.php">
       <?php
           settings_fields( 'section' );
           do_settings_sections( 'theme-options' );      
           submit_button(); 
       ?>          
    </form>
  </div>
<?php }

// Twitter
function setting_twitter() { ?>
  <input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }
// github
function setting_github() { ?>
  <input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }

// facebook
function setting_facebook() { ?>
  <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }
// youtube
function setting_youtube() { ?>
  <input type="text" name="youtube" id="youtube" value="<?php echo get_option('youtube'); ?>" />
<?php }

function display_layout_element()
{
	?>
		<input type="checkbox" name="theme_layout" value="1" <?php checked(1, get_option('theme_layout'), true); ?> /> 
	<?php
}

function custom_settings_page_setup() {
  add_settings_section( 'section', 'All Settings', null, 'theme-options' );
  add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );
  add_settings_field( 'github', 'GitHub URL', 'setting_github', 'theme-options', 'section' );
  add_settings_field( 'facebook', 'facebook URL', 'setting_facebook', 'theme-options', 'section' );  
  add_settings_field( 'youtube', 'youtube URL', 'setting_youtube', 'theme-options', 'section' );
  add_settings_field("theme_layout", "Do you want the layout to be responsive?", "display_layout_element", "theme-options", "section");

  register_setting('section', 'twitter');
  register_setting( 'section', 'github' );
  register_setting( 'section', 'facebook' );
  register_setting('section', 'theme_layout');
  register_setting('section', 'youtube');
  
  
  	
	add_settings_field("logo", "Logo", "logo_display", "theme-options", "section");  
	register_setting("section", "logo"); //, "handle_logo_upload");
}
add_action( 'admin_init', 'custom_settings_page_setup' );


// logo section

function logo_display()
{
	?>
	
	<label for="upload_image">
				<input id="upload_image" type="text" size="36" name="logo" value="<?php echo get_option('logo'); ?>" /> 
				<input id="upload_image_button" class="button" type="button" value="Upload Image" />
				<br />Enter a URL or upload logo
				
				<br />
				<img src="<?php echo get_option('logo'); ?>" />
			</label>
			
        
   <?php
}



// custom fields
// custom meta box 

function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // $id
		'Your Fields', // $title
		'show_your_fields_meta_box', // $callback
		'your_post', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );

function show_your_fields_meta_box() {
	global $post;  
		$meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

	<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" >

    <!-- All fields will go here -->
<p>
	<label for="your_fields[text]">Input Text</label>
<?php echo $meta['text']; ?>
	<br>
	<input type="text" name="your_fields[text]" id="your_fields[text]" class="regular-text" value="<?php echo $meta['your_fields']; ?>">
</p>
<p>
	<label for="your_fields[textarea]">Textarea</label>
	<br>
	<textarea name="your_fields[textarea]" id="your_fields[textarea]" rows="5" cols="30" style="width:500px;"><?php echo $meta['textarea']; ?></textarea>
</p>
<p>
	<label for="your_fields[checkbox]">Checkbox
		<input type="checkbox" name="your_fields[checkbox]" value="checkbox" <?php if ( $meta['checkbox'] === 'checkbox' ) echo 'checked'; ?>>
	</label>
</p>
<p>
	<label for="your_fields[image]">Image Upload</label><br>
	<input type="text" name="your_fields[image]" id="your_fields[image]" class="meta-image regular-text" value="<?php echo $meta['image']; ?>">
	<input type="button" class="button image-upload" value="Browse">
</p>
<div class="image-preview"><img src="<?php echo $meta['image']; ?>" style="max-width: 250px;"></div>


<script>
jQuery(document).ready(function ($) {

	// Instantiates the variable that holds the media library frame.
	var meta_image_frame;
	// Runs when the image button is clicked.
	$('.image-upload').click(function (e) {
		e.preventDefault();
		var meta_image = $(this).parent().children('.meta-image');

		// If the frame already exists, re-open it.
		if (meta_image_frame) {
			meta_image_frame.open();
			return;
		}
		// Sets up the media library frame
		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: meta_image.title,
			button: {
				text: meta_image.button
			}
		});
		// Runs when an image is selected.
		meta_image_frame.on('select', function () {
			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
			// Sends the attachment URL to our custom image input field.
			meta_image.val(media_attachment.url);
		});
		// Opens the media library frame.
		meta_image_frame.open();
	});
});
</script>
	<?php 
	
	}
	
function save_your_fields_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'your_fields', true );
	$new = $_POST['your_fields'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'your_fields', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'your_fields', $old );
	}
}
add_action( 'save_post', 'save_your_fields_meta' );















// Custom Post Type
function create_my_custom_post() {
	register_post_type( 'my-custom-post',
			array(
			'labels' => array(
					'name' => __( 'My Custom Post' ),
					'singular_name' => __( 'My Custom Post' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
					'title',
					'editor',
					'thumbnail',
				  'custom-fields'
			)
	));
}
add_action( 'init', 'create_my_custom_post' );


//Create a Custom Post

function create_post_your_post() {
	register_post_type( 'your_post',
		array(
			'labels'       => array(
				'name'       => __( 'Your Post' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
			'supports'     => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
			), 
			'taxonomies'   => array(
				'post_tag',
				'category',
			)
		)
	);
	register_taxonomy_for_object_type( 'category', 'your_post' );
	register_taxonomy_for_object_type( 'post_tag', 'your_post' );
}
add_action( 'init', 'create_post_your_post' );
	//created custom post type business 
function create_business() {
	register_post_type( 'business',
		array(
			'labels'       => array(
				'name'       => __( 'Business' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
			'supports'     => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
			), 
			'taxonomies'   => array(
				'post_tag',
				'category',
			)
		)
	);
	register_taxonomy_for_object_type( 'category', 'business' );
	register_taxonomy_for_object_type( 'post_tag', 'business' );
}
add_action( 'init', 'create_business' );


function my_excerpt_more( $more ) {
    return ' <a href="'.get_the_permalink().'" rel="nofollow">Read More...</a>';
}
add_filter( 'excerpt_more', 'my_excerpt_more' );





// Add Google Fonts
function startwordpress_google_fonts() {
				wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
				wp_enqueue_style( 'OpenSans');
		}

add_action('wp_print_styles', 'startwordpress_google_fonts');


function bootstrap_jscdn(){
	echo    ' <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
}
add_action('wp_footer','bootstrap_jscdn');


// Add scripts and stylesheets   in functions.php
function startwordpress_scripts() {
	
	// wp_register_style( 'bootstrap', get_template_directory_uri() . '/bootstrap.min.css', array(), '3.3.6' );
		// local css file
		
		
		
	// cloud cdn css file
	wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7' );
	wp_enqueue_style( 'bootstrap');
	
	wp_register_style( 'shanticss', get_template_directory_uri() . '/style.css', array(), '3.3.6' );
	wp_enqueue_style( 'shanticss');
	
	wp_enqueue_style( 'blog', get_template_directory_uri() . '/blog.css' );
	
	// wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
		// commented because we have added this file from bootstrap_jscdn function .. hooked in wp_footer
		
		
	// fontawesome cdn
	wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'fontawesome');
	
}

add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );

//add menu

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );




 // logo 
function my_admin_scripts() {
    if (isset($_GET['page']) && $_GET['page'] == 'custom-settings') {
        wp_enqueue_media();
        wp_register_script('my-admin-js', get_template_directory_uri() . '/my-admin.js', array('jquery'));
        wp_enqueue_script('my-admin-js');
    }
}
add_action('admin_enqueue_scripts', 'my_admin_scripts');

//pagination
function vb_pagination( $query=null ) {
 
  global $wp_query;
  $query = $query ? $query : $wp_query;
  $big = 999999999;
 
  $paginate = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'type' => 'array',
    'total' => $query->max_num_pages,
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
    )
  );
 
  if ($query->max_num_pages > 1) :
?>
<ul class="pagination">
  <?php
  foreach ( $paginate as $page ) {
    echo '<li>' . $page . '</li>';
  }
  ?>
</ul>
<?php
  endif;
}


/** 
wp menu 
bootstrap ra wp menu ko talmel milauna lai 
navwalker class use gariyo 
github reference  bata 
https://github.com/geekofer/wp-bootstrap-navwalker-dropdown

aru dherai kisim ko try gareko ho but yo code le kaam garyo
*/
require_once('wp_bootstrap_navwalker.php');	

// Bootstrap navigation
function bootstrap_nav()
{
	wp_nav_menu( array(
            'theme_location'    => 'header-menu',
            'depth'             => 0,  // depth 0 means all level
            'container'         => 'false',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
    );
}

function bootstrap_nav_stylescripts(){
	
	echo '
<style>
.dropdown:hover > .dropdown-menu {
  display: block;
}
.dropdown-submenu {
    position: relative;
}
.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}
.dropdown-submenu:hover > .dropdown-menu {
    display: block;
}
.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}
.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}
.dropdown-submenu.pull-left {
    float: none;
}
.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
</style>

<script>
jQuery(function($) {
  // Bootstrap menu magic
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $(".dropdown-toggle").attr(\'data-toggle\', \'dropdown\');
    } else {
      $(".dropdown-toggle").removeAttr(\'data-toggle dropdown\');
    }
  });
});
</script>
	';
}
add_action('wp_footer','bootstrap_nav_stylescripts');
	

// widgets & sidebars

 $args1 = array(
	'name'          => __( 'Footer Left', 'paijapp' ),
	'id'            => 'footer1',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' ); 

 $args2 = array(
	'name'          => __( 'Footer Middle', 'paijapp' ),
	'id'            => 'footer2',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' ); 

 $args3 = array(
	'name'          => __( 'Footer Right', 'paijapp' ),
	'id'            => 'footer3',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' ); 
	

$args = array(
	'name'          => __( 'sidebar', 'paijapp' ),
	'id'            => 'sidebar1',
	'description'   => '',
        'class'         => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' ); 

 register_sidebar( $args1 );
 register_sidebar( $args2 );
 register_sidebar( $args3 );
 register_sidebar( $args );
 
 
 

 //bootstrap slider
 
 add_action( 'init', 'custom_bootstrap_slider' );
/**
 * Register a Custom post type for.
 */
function custom_bootstrap_slider() {
	$labels = array(
		'name'               => _x( 'Slider', 'post type general name'),
		'singular_name'      => _x( 'Slide', 'post type singular name'),
		'menu_name'          => _x( 'Bootstrap Slider', 'admin menu'),
		'name_admin_bar'     => _x( 'Slide', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'Slide'),
		'add_new_item'       => __( 'Name'),
		'new_item'           => __( 'New Slide'),
		'edit_item'          => __( 'Edit Slide'),
		'view_item'          => __( 'View Slide'),
		'all_items'          => __( 'All Slide'),
		'featured_image'     => __( 'Featured Image', 'text_domain' ),
		'search_items'       => __( 'Search Slide'),
		'parent_item_colon'  => __( 'Parent Slide:'),
		'not_found'          => __( 'No Slide found.'),
		'not_found_in_trash' => __( 'No Slide found in Trash.'),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	     => 'dashicons-star-half',
    	        'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title','editor','thumbnail')
	);

	register_post_type( 'slider', $args );
}




add_filter( 'the_content', 'featured_image_before_content' ); 
 
 function featured_image_before_content( $content ) { 
    if ( is_singular('post') && has_post_thumbnail()) {
        $thumbnail = get_the_post_thumbnail();

        // $content =  $content;
        $content = $thumbnail . $content;
		
		}

    return $content;
}




/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
*/



// function shantipp_searchform( $form ) {
	
function shantipp_searchform(  ) {
	
    $form = '

	<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	
		<div class="form-group">
			<div class="input-group">
				
				<input class="form-control" type="text"  value="' . get_search_query() . '" name="s" id="s" placeholder="'. esc_attr__( 'Search' ) .'"  />
				<span class="input-group-btn">
					<button class="btn btn-success" type="submit" id="searchsubmit" ><span class="glyphicon glyphicon-search" aria-hidden="true"><span style="margin-left:10px;">'. esc_attr__( 'Search' ) .'</span></button>
				</span>
				</span>
			</div>
		</div>
    </form>
	
	';
 
    
	// return $form;
	echo $form;
}
// add_filter( 'get_search_form', 'shantipp_searchform' );


 ?>