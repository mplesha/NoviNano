<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package AccessPress Ray
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function accesspress_ray_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'accesspress_ray_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function accesspress_ray_body_classes( $classes ) {
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	$accesspress_ray_template_design = $accesspress_ray_settings['accesspress_ray_template_design'];
	if( $accesspress_ray_template_design == 'default_template' ) {
		$classes[] = 'default-template-design';
	} else {
		$classes[] = 'style1-template-design';
	}

	$accesspress_ray_header_image_layout = $accesspress_ray_settings['logo_alignment'];
	if( $accesspress_ray_header_image_layout == 'Center' ) {
		$classes[] = 'site-logo-center';
	} else {
		$classes[] = 'site-logo-left';
	}

	return $classes;
}
add_filter( 'body_class', 'accesspress_ray_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function accesspress_ray_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'accesspress-ray' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'accesspress_ray_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function accesspress_ray_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'accesspress_ray_setup_author' );

global $accesspress_ray_options;
$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function accesspress_ray_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'accesspress-ray' ),
		'id'            => 'left-sidebar',
		'description'   => __( 'Display items in the Left Sidebar of the inner pages', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'accesspress-ray' ),
		'id'            => 'right-sidebar',
		'description'   => __( 'Display items in the Right Sidebar of the inner pages', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'accesspress-ray' ),
		'id'            => 'shop-sidebar',
		'description'   => __( 'Display items in the Right Sidebar of the inner pages for Woocommerce', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Featured Left Widget', 'accesspress-ray' ),
		'id'            => 'textblock-1',
		'description'   => __( 'Display items in the left of Featured Bar', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Featured Middle Widget', 'accesspress-ray' ),
		'id'            => 'textblock-2',
		'description'   => __( 'Display items in the middle of Featured Bar', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Featured Right Widget', 'accesspress-ray' ),
		'id'            => 'textblock-3',
		'description'   => __( 'Display items in the right of Featured Bar', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer One', 'accesspress-ray' ),
		'id'            => 'footer-1',
		'description'   => __( 'Display items in First Footer Area', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Two', 'accesspress-ray' ),
		'id'            => 'footer-2',
		'description'   => __( 'Display items in Second Footer Area', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Three', 'accesspress-ray' ),
		'id'            => 'footer-3',
		'description'   => __( 'Display items in Third Footer Area', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Four', 'accesspress-ray' ),
		'id'            => 'footer-4',
		'description'   => __( 'Display items in Fourth Footer Area', 'accesspress-ray' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'accesspress_ray_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function accesspress_ray_scripts() {
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	$query_args = array(
		'family' => 'Open+Sans:400,400italic,300italic,300,600,600italic|Lato:400,100,300,700|Josefin+Slab:400,100,100italic,300,300italic,400italic,600,600italic,700,700italic|Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700italic,700,900,900italic',
	);
	wp_enqueue_style( 'accesspress-ray-font-css', get_template_directory_uri() . '/css/fonts.css' );
	wp_enqueue_style( 'accesspress-ray-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
	wp_enqueue_style( 'accesspress-ray-font-awesome', get_template_directory_uri() . '/css/fontawesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'accesspress-ray-fancybox-css', get_template_directory_uri() . '/css/nivo-lightbox.css' );
	wp_enqueue_style( 'accesspress-ray-bx-slider-style', get_template_directory_uri() . '/css/jquery.bxslider.css' );
	wp_enqueue_style( 'accesspress-ray-lightslider-style', get_template_directory_uri() . '/css/lightslider.css' );
    wp_enqueue_style( 'accesspress_ray_woocommerce_style', get_template_directory_uri() . '/woocommerce/woocommerce-style.css');
	wp_enqueue_style( 'accesspress-ray-style', get_stylesheet_uri() );

	wp_enqueue_script( 'accesspress-ray-bx-slider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), '4.1', true );
	wp_enqueue_script( 'accesspress-ray-lightslider', get_template_directory_uri() . '/js/lightslider.js', array('jquery'), '1.1.3', true );
	wp_enqueue_script( 'accesspress-ray-fancybox', get_template_directory_uri() . '/js/nivo-lightbox.min.js', array('jquery'), '2.1', true );
	wp_enqueue_script( 'accesspress-ray-jquery-actual', get_template_directory_uri() . '/js/jquery.actual.min.js', array('jquery'), '1.0.16', true );
	wp_enqueue_script( 'accesspress-ray--skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'accesspress-ray-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

/**
 * Load style1 template css if it is active
 */
$accesspress_ray_template_design_style = $accesspress_ray_settings['accesspress_ray_template_design'];
if( $accesspress_ray_template_design_style == 'style1_template' || empty( $accesspress_ray_settings ) ) {
	wp_enqueue_style( 'accesspress-ray-style1-template', get_template_directory_uri() . '/css/template-style1.css' );
}

/**
* Loads up responsive css if it is not disabled
*/
	if ( $accesspress_ray_settings[ 'responsive_design' ] == 0 ) {
		wp_enqueue_style( 'accesspress-ray-responsive', get_template_directory_uri() . '/css/responsive.css' );
		if( $accesspress_ray_template_design_style == 'style1_template' ) {
			wp_enqueue_style( 'accesspress-ray-responsive-style1', get_template_directory_uri() . '/css/responsive-style1.css' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'accesspress_ray_scripts' );

/**
* Loads up favicon
*/
function accesspress_ray_add_favicon(){
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	
	if( !empty($accesspress_ray_settings[ 'media_upload' ])){
	echo '<link rel="shortcut icon" type="image/png" href="'. esc_url($accesspress_ray_settings[ 'media_upload' ]).'"/>';
	}
}
add_action('wp_head', 'accesspress_ray_add_favicon');


function accesspress_ray_social_cb(){ 
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	?>
	<div class="socials">
	<?php if(!empty($accesspress_ray_settings['accesspress_ray_facebook'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_facebook']); ?>" class="facebook" title="Facebook" target="_blank"><span class="font-icon-social-facebook"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_twitter'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_twitter']); ?>" class="twitter" title="Twitter" target="_blank"><span class="font-icon-social-twitter"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_gplus'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_gplus']); ?>" class="gplus" title="Google Plus" target="_blank"><span class="font-icon-social-google-plus"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_youtube'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_youtube']); ?>" class="youtube" title="Youtube" target="_blank"><span class="font-icon-social-youtube"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_pinterest'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_pinterest']); ?>" class="pinterest" title="Pinterest" target="_blank"><span class="font-icon-social-pinterest"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_linkedin'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_linkedin']); ?>" class="linkedin" title="Linkedin" target="_blank"><span class="font-icon-social-linkedin"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_flickr'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_flickr']); ?>" class="flickr" title="Flickr" target="_blank"><span class="font-icon-social-flickr"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_vimeo'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_vimeo']); ?>" class="vimeo" title="Vimeo" target="_blank"><span class="font-icon-social-vimeo"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_stumbleupon'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_stumbleupon']); ?>" class="stumbleupon" title="Stumbleupon" target="_blank"><span class="font-icon-social-stumbleupon"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_instagram'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_instagram']); ?>" class="instagram" title="instagram" target="_blank"><span class="fa fa-instagram"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_sound_cloud'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_sound_cloud']); ?>" class="sound-cloud" title="sound-cloud" target="_blank"><span class="font-icon-social-soundcloud"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_skype'])){ ?>
	<a href="<?php echo "skype:".esc_attr($accesspress_ray_settings['accesspress_ray_skype']); ?>" class="skype" title="Skype"><span class="font-icon-social-skype"></span></a>
	<?php } ?>

	<?php if(!empty($accesspress_ray_settings['accesspress_ray_rss'])){ ?>
	<a href="<?php echo esc_url($accesspress_ray_settings['accesspress_ray_rss']); ?>" class="rss" title="RSS" target="_blank"><span class="font-icon-rss"></span></a>
	<?php } ?>
	</div>
<?php } 

add_action( 'accesspress_ray_social_links', 'accesspress_ray_social_cb', 10 );	


function accesspress_ray_featured_text_cb(){
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	if(!empty($accesspress_ray_settings['featured_text'])){
	echo '<div class="header-text">'.esc_html(wpautop($accesspress_ray_settings['featured_text'])).'</div>';
	}
}

add_action('accesspress_ray_featured_text','accesspress_ray_featured_text_cb', 10);

function accesspress_ray_logo_alignment_cb(){
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	if($accesspress_ray_settings['logo_alignment'] =="Left"){
		$accesspress_ray_alignment_class="logo-left";
	}elseif($accesspress_ray_settings['logo_alignment'] == "Center"){
		$accesspress_ray_alignment_class="logo-center";
	}else{
		$accesspress_ray_alignment_class="";
	}
	echo esc_attr($accesspress_ray_alignment_class);
}

add_action('accesspress_ray_logo_alignment','accesspress_ray_logo_alignment_cb', 10);


function accesspress_ray_excerpt( $accesspress_ray_content , $accesspress_ray_letter_count ){
	$accesspress_ray_striped_content = strip_shortcodes($accesspress_ray_content);
	$accesspress_ray_striped_content = strip_tags($accesspress_ray_striped_content);
	$accesspress_ray_excerpt = mb_substr($accesspress_ray_striped_content, 0, $accesspress_ray_letter_count );
	if($accesspress_ray_striped_content > $accesspress_ray_excerpt){
		$accesspress_ray_excerpt .= "...";
	}
	return $accesspress_ray_excerpt;
}


function accesspress_ray_bxslidercb(){
	global $accesspress_ray_options, $post;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
    ($accesspress_ray_settings['slider_show_pager'] == 'yes1' || empty($accesspress_ray_settings['slider_show_pager'])) ? ($pager='true') : ($pager='false');
    ($accesspress_ray_settings['slider_show_controls'] == 'yes2' || empty($accesspress_ray_settings['slider_show_controls'])) ? ($controls='true') : ($controls='false');
    ($accesspress_ray_settings['slider_mode'] == 'slide' || empty($accesspress_ray_settings['slider_mode'])) ? ($mode='horizontal') : ($mode='fade');
    ($accesspress_ray_settings['slider_auto'] == 'yes3' || empty($accesspress_ray_settings['slider_auto'])) ? ($auto='true') : ($auto='false');
	empty($accesspress_ray_settings['slider_pause']) ? ($pause ='5000') : ($pause = esc_attr($accesspress_ray_settings['slider_pause']));
?>
	<script type="text/javascript">
        jQuery(function(){
			jQuery('.bx-slider').bxSlider({
				adaptiveHeight:true,
				pager:<?php echo $pager; ?>,
				controls:<?php echo $controls; ?>,
				mode:'<?php echo $mode; ?>',
				auto :<?php echo $auto; ?>,
				pause: '<?php echo $pause; ?>',
				<?php if($accesspress_ray_settings['slider_speed']) {?>
				speed:'<?php echo esc_attr($accesspress_ray_settings['slider_speed']); ?>',
				<?php } ?>
				<?php 
					$accesspress_ray_template_design = $accesspress_ray_settings['accesspress_ray_template_design'];
					if( $accesspress_ray_template_design == 'default_template' ){ 
				?>
				prevText:'Prev',
				nextText:'Next'
				<?php 
					} else {
				?>
				prevText:'<i class="fa fa-long-arrow-left"></i>',
				nextText:'<i class="fa fa-long-arrow-right"></i>'
				<?php 
					}
				?>
			});
		});
    </script>
<?php

	if( $accesspress_ray_settings['show_slider'] !='no') { 
	if((isset($accesspress_ray_settings['slider1']) && !empty($accesspress_ray_settings['slider1'])) 
		|| (isset($accesspress_ray_settings['slider2']) && !empty($accesspress_ray_settings['slider2'])) 
		|| (isset($accesspress_ray_settings['slider3']) && !empty($accesspress_ray_settings['slider3']))
		|| (isset($accesspress_ray_settings['slider4']) && !empty($accesspress_ray_settings['slider4'])) 
		|| (isset($accesspress_ray_settings['slider_cat']) && !empty($accesspress_ray_settings['slider_cat']))
	){ 

        if($accesspress_ray_settings['slider_options'] == 'single_post_slider'){
        	if(!empty($accesspress_ray_settings['slider1']) || !empty($accesspress_ray_settings['slider2']) || !empty($accesspress_ray_settings['slider3']) || !empty($accesspress_ray_settings['slider4'])){
        		$sliders = array($accesspress_ray_settings['slider1'],$accesspress_ray_settings['slider2'],$accesspress_ray_settings['slider3'],$accesspress_ray_settings['slider4']);
				$remove = array(0);
			    $sliders = array_diff($sliders, $remove);  ?>

			    <div class="bx-slider">
			    <?php
			    foreach ($sliders as $slider){
				$args = array (
				'p' => $slider
				);

					$loop = new WP_query( $args );
					if($loop->have_posts()){ 
					while($loop->have_posts()) : $loop-> the_post(); 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'accesspress-ray-slider', true ); 
					?>
					<div class="slides">
						
							<img src="<?php echo esc_url($image[0]); ?>">
							
							<?php if($accesspress_ray_settings['slider_caption']=='yes4'):?>
							<div class="slider-caption">
								<div class="ak-container">
									<h1 class="caption-title"><?php the_title();?></h1><br />
									<h2 class="caption-description"><?php echo get_the_content();?></h2><br />
								</div>
							</div>
							<?php  endif; ?>
			
		            </div>
					<?php endwhile;
					}
				} ?>
			    </div>
        	<?php
        	}

        }elseif ($accesspress_ray_settings['slider_options'] == 'cat_post_slider') { ?>
        	<div class="bx-slider">
			<?php
			$loop = new WP_Query(array(
					'cat' => $accesspress_ray_settings['slider_cat'],
					'posts_per_page' => -1
				));
				if($loop->have_posts()){ 
				while($loop->have_posts()) : $loop-> the_post(); 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'accesspress-ray-slider', true ); 
				?>
				<div class="slides">
						
						<img src="<?php echo esc_url($image[0]); ?>">
							
						<?php if($accesspress_ray_settings['slider_caption']=='yes4'):?>
						<div class="slider-caption">
							<div class="ak-container">
								<h1 class="caption-title"><?php the_title();?></h1><br />
								<h2 class="caption-description"><?php echo get_the_content();?></h2><br />
							</div>
						</div>
						<?php  endif; ?>
			
		        </div>
				<?php endwhile;
				} ?>
			</div>
        <?php
    	}
    	}else{ 
    	?>
        <div class="bx-slider">
			<div class="slides">
				<img src="<?php echo get_template_directory_uri(); ?>/images/demo/slider1.jpg" alt="slider1">
                <?php if($accesspress_ray_settings['slider_caption']=='yes4' || empty($accesspress_ray_settings['slider_caption'])):?>
				<div class="slider-caption">
					<div class="ak-container">
						<h1 class="caption-title"><?php _e('AccessPress Ray','accesspress-ray'); ?></h1><br />
						<h2 class="caption-description"><?php _e('Responsive, multi-purpose, business wordpress theme, perfect for any business on any device.','accesspress-ray'); ?></h2>
						<br>
						<a href="#"><?php _e('Read More','accesspress-ray'); ?></a>
					</div>
				</div>
                <?php  endif; ?>
			</div>
					
			<div class="slides">
				<img src="<?php echo get_template_directory_uri(); ?>/images/demo/slider2.jpg" alt="slider2">
                <?php if($accesspress_ray_settings['slider_caption']=='yes4' || empty($accesspress_ray_settings['slider_caption'])):?>
				<div class="slider-caption">
					<div class="ak-container">
						<h1 class="caption-title"><?php _e('Easy Customization','accesspress-ray'); ?></h1>
						<h2 class="caption-description"><?php _e('A theme with powerful theme options for customization. Style your wordpress and see changes live!','accesspress-ray'); ?></h2>
						<br>
						<a href="#"><?php _e('Read More','accesspress-ray'); ?></a>
					</div>
				</div>
                <?php  endif; ?>
			</div>
		</div>
	<?php
	}
}
}

add_action('accesspress_ray_bxslider','accesspress_ray_bxslidercb', 10);

function accesspress_ray_layout_class($classes){
	global $post;
		if( is_404()){
	$classes[] = ' ';
	}elseif(is_singular()){
	$post_class = get_post_meta( $post -> ID, 'accesspress_ray_sidebar_layout', true );
	$classes[] = $post_class;
	}else{
	$classes[] = 'right-sidebar';	
	}
	return $classes;
}

add_filter( 'body_class', 'accesspress_ray_layout_class' );

function accesspress_ray_web_layout($classes){
global $accesspress_ray_options, $post;
$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
$weblayout = $accesspress_ray_settings['accesspress_ray_webpage_layout'];
if($weblayout =='Boxed'){
    $classes[]= 'boxed-layout';
}
return $classes;
}

add_filter( 'body_class', 'accesspress_ray_web_layout' );

function accesspress_ray_custom_css(){
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	echo '<style type="text/css">';
		echo esc_attr($accesspress_ray_settings['custom_css']);
	echo '</style>';
}

add_action('wp_head','accesspress_ray_custom_css');

function accesspress_ray_call_to_action_cb(){
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	if(!empty($accesspress_ray_settings['action_text'])){
	?>
	<section id="call-to-action">
	<div class="ak-container">
		<h4><?php echo esc_attr($accesspress_ray_settings['action_text']); ?></h4>
		<a class="action-btn" href="<?php echo esc_url($accesspress_ray_settings['action_btn_link']); ?>"><?php echo esc_attr($accesspress_ray_settings['action_btn_text']); ?></a>
	</div>
	</section>
	<?php
	}
}

add_action('accesspress_ray_call_to_action','accesspress_ray_call_to_action_cb', 10);

function accesspress_ray_exclude_cat_from_blog($query) {
global $accesspress_ray_options;
$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
$accesspress_ray_exclude_cat = array($accesspress_ray_settings['blog_cat'],$accesspress_ray_settings['testimonial_cat'], $accesspress_ray_settings['slider_cat'], $accesspress_ray_settings['portfolio_cat']);
	
if(!empty($accesspress_ray_exclude_cat)):
    $cats = array();
    foreach($accesspress_ray_exclude_cat as $value){
        if(!empty($value) && $value != 0){
            $cats[] = -$value; 
        }
    }
    if(!empty($cats)){
	    $category = join( "," , $cats);
	    if ( $query->is_home() ) {
	    $query->set('cat', $category);
	    }
    }
    return $query;
endif;
}

add_filter('pre_get_posts', 'accesspress_ray_exclude_cat_from_blog');

function accesspress_ray_admin_notice() {
    global $pagenow;
    if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
    ?>
    <div class="updated">
        <p><?php echo sprintf(__( 'Go to <a href="%s">Theme Options Panel</a> to set up the website.', 'accesspress-ray' ), esc_url(admin_url('/themes.php?page=theme_options'))); ?></p>
    </div>
    <?php
    }
}
add_action( 'admin_notices', 'accesspress_ray_admin_notice' );

/*Dynamic Theme Color*/

function accesspress_ray_colour_brightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE 
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
			$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

/* Convert hexdec color string to rgb(a) string */

function accesspress_ray_hex_to_rgba($color, $opacity = false) { 
$default = 'rgb(0,0,0)'; 
//Return default if no color provided
if(empty($color))
         return $default;  
//Sanitize $color if "#" is provided 
       if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
       }

       //Check if color has 6 or 3 characters and get values
       if (strlen($color) == 6) {
               $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
       } elseif ( strlen( $color ) == 3 ) {
               $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
       } else {
               return $default;
       }

       //Convert hexadec to rgb
       $rgb =  array_map('hexdec', $hex);

       //Check if opacity is set(rgba or rgb)
       if($opacity){
        if(abs($opacity) > 1)
        $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
       } else {
        $output = 'rgb('.implode(",",$rgb).')';
       }

       //Return rgb(a) color string
       return $output;
}

function accesspress_ray_theme_color() {
	global $accesspress_ray_options;
	$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	if( !empty( $accesspress_ray_settings ) ) {
		$accesspress_ray_p_theme_color = $accesspress_ray_settings['primary_theme_color'];
		$accesspress_ray_s_theme_color = $accesspress_ray_settings['secondary_theme_color'];
		$accesspress_ray_template_design = $accesspress_ray_settings['accesspress_ray_template_design'];
		$accesspress_ray_featured_section_bg = $accesspress_ray_settings['featured_section_bg'];
		$accesspress_ray_testimonials_section_bg = $accesspress_ray_settings['testimonial_section_bg'];
	} else {
		$accesspress_ray_template_design = 'default_template';
        $accesspress_ray_p_theme_color = '#23A38F';
        $accesspress_ray_s_theme_color = '#F0563D';
	}	

	if( $accesspress_ray_template_design == 'style1_template' ) {
?>
	<style type="text/css">

		<?php if( !empty( $accesspress_ray_testimonials_section_bg ) ) { ?>
			.clients-say-section {
				background: url('<?php echo esc_url( $accesspress_ray_testimonials_section_bg );?>');
			}
		<?php } ?>
		.business-section {
			background: url('<?php echo esc_url( $accesspress_ray_featured_section_bg );?>');
		}
		.header-wrap .main-navigation , .style1-template-design div#top-header, 
		.featured-post .featured-post-wrapper .featured-more div,
		#about-section .main-title a:after, .featured-section .main-title:after,
		.featured-post h2.featured-title a:after, .events-section .main-title:after,
		/*.style1-template-design .clients-say-section .bx-wrapper .bx-pager.bx-default-pager a,*/
		.events-section .event-list  .event-date,
		.events-section .event-list .event-detail a.read-more-btn,
		.right-sidebar.sidebar .widget-title, .single .sidebar .widget-title, .left-sidebar.sidebar .widget-title,
		.right-sidebar.sidebar .widget_search .searchsubmit, .single .sidebar .widget_search .searchsubmit, .left-sidebar.sidebar .widget_search .searchsubmit
		, .right-sidebar.sidebar .tagcloud a, .single .sidebar .tagcloud a, 
		.left-sidebar.sidebar .tagcloud a,
		#slider-banner .bx-wrapper .bx-pager.bx-default-pager a,
		.style1-template-design #site-navigation .menu ul ul li a:hover,
		.right-sidebar #comments h3::after, .single #comments h3::after, 
		.left-sidebar #comments h3::after, #respond #reply-title::after,
		.style1-template-design .events-section .bx-wrapper .bx-pager.bx-default-pager a,
		.boxed-layout.site-logo-left .header-wrap .main-navigation:after,
		.boxed-layout.site-logo-left .header-wrap ,
		.boxed-layout .header-wrap,
		.event-list-wrapper .lSSlideOuter .lSPager.lSpg > li a
		{
			background:<?php echo $accesspress_ray_p_theme_color; ?> ;
		}
		.right-sidebar.sidebar .widget-title:after, .left-sidebar.sidebar .widget-title:after, .single .sidebar .widget-title::after{
			border-color:<?php echo $accesspress_ray_p_theme_color; ?>;
			opacity:0.5;
		}

		.style1-template-design .slider-caption br + a{
			color:<?php echo $accesspress_ray_s_theme_color; ?> !important;
		}
		#slider-banner .bx-wrapper .bx-prev, #slider-banner .bx-wrapper:hover .bx-prev,
		#slider-banner .bx-wrapper .bx-next, #slider-banner .bx-wrapper:hover .bx-next{
			background-color: <?php echo $accesspress_ray_p_theme_color; ?> ;
		}
		#slider-banner .bx-wrapper .bx-prev:hover, #slider-banner .bx-wrapper:hover .bx-prev:hover,
		#slider-banner .bx-wrapper .bx-next:hover, #slider-banner .bx-wrapper:hover .bx-next:hover{
			background-color: <?php echo $accesspress_ray_s_theme_color; ?> ;
		}
		.site-branding.main-logo, .site-branding.main-logo::before,
		.featured-post .featured-post-wrapper .featured-more,
		.clients-say-section .ak-container .widget-title:after,
		.events-section .event-list .event-detail a.read-more-btn:hover,
		.style1-template-design .clients-say-section .bx-wrapper .bx-pager.bx-default-pager a:hover,
		.style1-template-design .clients-say-section .bx-wrapper .bx-pager.bx-default-pager a.active,
		#about-section a.read-more.bttn:hover,
		.style1-template-design .events-section .bx-wrapper .bx-pager.bx-default-pager a:hover,
		.style1-template-design .events-section .bx-wrapper .bx-pager.bx-default-pager a.active,
		.event-list-wrapper a.view-all:hover,
		.event-list-wrapper .lSSlideOuter .lSPager.lSpg > li.active a,
		.event-list-wrapper .lSSlideOuter .lSPager.lSpg > li:hover a,
		.business-section .widget-title::after,
		#google-map .ak-contact-address > h3::after,
		#top-footer .footer .widget-title::after,
		.style1-template-design footer #top-footer input.newsletter-submit,
		.style1-template-design #top-footer input[type="submit"]:hover,
		.style1-template-design #top-footer input[type="submit"].wpcf7-form-control.wpcf7-submit,
		.style1-template-design footer #middle-footer,
		footer .socials a:hover,
		#google-map .ak-contact-address .socials a:hover,
		.short-content + .bttn:hover,
		main .navigation .nav-links a:hover,
		#slider-banner .bx-wrapper .bx-pager.bx-default-pager a:hover,
		#slider-banner .bx-wrapper .bx-pager.bx-default-pager a.active,
		.style1-template-design .slider-caption br + a:hover,
		.single input[type="submit"]:hover, #respond input[type="submit"]:hover, .left-sidebar input[type="submit"]:hover,
		.right-sidebar input[type="submit"]:hover,
		.logo-center .site-branding.main-logo::before,
		.boxed-layout .site-branding.main-logo,
		.boxed-layout.site-logo-left .site-branding.main-logo:before,
		#site-navigation .menu ul ul li > a:hover:before, #site-navigation .menu ul ul li.current_page_item > a:before
		{
			background:<?php echo $accesspress_ray_s_theme_color; ?> ;
		}
		#slider-banner .bx-wrapper .bx-pager.bx-default-pager a:after{
			background:<?php echo $accesspress_ray_s_theme_color; ?> !important;
		}
		#slider-banner .bx-wrapper .bx-pager.bx-default-pager a{
			box-shadow:0 0 0 2px <?php echo $accesspress_ray_p_theme_color; ?> inset !important;
		}
		.style1-template-design #site-navigation .menu > ul > li > a,
		#middle-footer ul.menu li a{
			/*color:#fff;*/
		}
		#slider-banner .slider-caption .caption-title, 
		.featured-post .featured-post-wrapper .featured-more div span,
		.header-wrap .search-icon > .fa.fa-search,
		
		#slider-banner .slider-caption .caption-title,
		.events-section .event-list .event-date-day,
		.events-section .event-list .event-date-month,
		.events-section .event-list .event-detail a.read-more-btn,
		/*.business-section .widget-title,*/
		.business-section .widget ul li:before,
		#google-map .ak-contact-address > h3,
		#top-footer .footer .widget-title,
		/*.aptf-tweet-content:before,*/
		.right-sidebar.sidebar .widget-title, .single .sidebar .widget-title, .left-sidebar.sidebar .widget-title,
		.right-sidebar.sidebar ul li a:hover, .right-sidebar.sidebar ul li:before, .single .sidebar ul li a:hover, .single .sidebar ul li:before, .left-sidebar.sidebar ul li a:hover, .left-sidebar.sidebar ul li:before,
		article h2 a:hover,
		.posted-on a:hover, .entry-footer a:hover, .style1-template-design .footer-wrap a:hover,
		.right-sidebar button.searchsubmit .fa, .single button.searchsubmit .fa, .left-sidebar button.searchsubmit .fa,
		.right-sidebar.sidebar .tagcloud a, .single .sidebar .tagcloud a, .left-sidebar.sidebar .tagcloud a,
		.style1-template-design .slider-caption br + a,
		.style1-template-design #site-navigation .menu > ul > li > a:hover,
		.style1-template-design #site-navigation .menu ul ul li a:hover,
		.bx-controls-direction .fa

		{
			color: <?php echo $accesspress_ray_s_theme_color; ?>;
		}
		
		/*.events-section .event-list .event-date-day, .events-section .event-list .event-date-month,*/
		#middle-footer ul.menu li a:hover,
		#slider-banner .bx-wrapper .bx-next:hover .fa, #slider-banner .bx-wrapper .bx-prev:hover .fa,
		.footer-menu .menu ul li a, .footer-menu .menu ul li a:hover
		{
			color: <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		#about-section a.read-more.bttn:hover{
			
			border-top: 2px solid <?php echo $accesspress_ray_s_theme_color; ?>;
		    border-bottom: 2px solid <?php echo $accesspress_ray_s_theme_color; ?>;
		    border-left: 4px solid <?php echo $accesspress_ray_s_theme_color; ?>;
		    border-right: 4px solid <?php echo $accesspress_ray_s_theme_color; ?>;
		}
		#about-section a.read-more.bttn{
			border-top: 2px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		    border-bottom: 2px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		    border-left: 4px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		    border-right: 4px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		.event-list-wrapper a.view-all:hover{
			border: 3px solid <?php echo $accesspress_ray_s_theme_color; ?>;
		}
		.event-list-wrapper a.view-all{
			border: 3px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		#middle-footer ul.menu li a:hover,
		.short-content + .bttn ,
		main .navigation .nav-links a ,
		.single input[type="submit"],
		 #respond input[type="submit"], .left-sidebar input[type="submit"], .right-sidebar input[type="submit"],
		 .footer-menu .menu ul li a:hover
		{
			border:2px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		.short-content + .bttn:hover,
		main .navigation .nav-links a:hover,
		.style1-template-design .slider-caption br + a,
		.style1-template-design .slider-caption br + a:hover,
		.style1-template-design #site-navigation .menu > ul > li > a:hover,
		.single input[type="submit"]:hover, #respond input[type="submit"]:hover, .left-sidebar input[type="submit"]:hover, 
		.right-sidebar input[type="submit"]:hover{
			border:2px solid <?php echo $accesspress_ray_s_theme_color; ?>;
		}
		.style1-template-design #site-navigation .menu ul ul li:hover{
			border-bottom:2px solid <?php echo $accesspress_ray_s_theme_color; ?>;
			border-top:2px solid <?php echo $accesspress_ray_s_theme_color; ?>;
		}
	</style>
<?php
	} else {
?>
	<style type="text/css">
		header.site-header {
			border-top:5px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		#site-navigation .menu > ul > li > a, #site-navigation .menu ul ul li > a:hover, #site-navigation .menu ul ul li.current_page_item > a, .featured-post .view-more, .footer-wrap a:hover, .sidebar ul li a:hover, a, .sidebar ul li:before {
			color: <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		#site-navigation .menu ul ul {
			border-bottom:2px solid <?php echo $accesspress_ray_p_theme_color; ?>;
			border-top:2px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		.featured-section, .featured-post .view-more:hover, .events-section .view-all, .business-section, #top-footer, .sidebar .widget-title, #comments h3, .read-more-btn .read-icon-wrap, #comments h2.comments-title, .comment-author .fn .url:hover, .sidebar .tagcloud a {
			background:<?php echo $accesspress_ray_p_theme_color; ?>;
		}
		.read-more-btn, .read-more-btn:hover .read-icon-wrap, .events-section .bx-wrapper .bx-pager.bx-default-pager a,
		.event-list-wrapper .lSSlideOuter .lSPager.lSpg > li a {
			background: <?php echo accesspress_ray_colour_brightness( $accesspress_ray_p_theme_color, '0.9' ) ?>;
		}
		.featured-post .view-more {
			border: 1px solid <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		.slider-caption .caption-title, .slider-caption .caption-description {
			background: <?php echo accesspress_ray_hex_to_rgba( $accesspress_ray_p_theme_color, '0.5' );?>;
		}
		.events-section .view-all:hover, #top-footer input, #top-footer textarea, #top-footer input[type="submit"], footer #middle-footer, .footer-socials a {
			background: <?php echo accesspress_ray_colour_brightness( $accesspress_ray_p_theme_color, '-0.9' ) ?> ;
		}
		.clients-say-section .bx-wrapper .bx-pager.bx-default-pager a, .sidebar .widget_search .searchsubmit, .read-more-btn:hover {
			background: none repeat scroll 0 0 <?php echo $accesspress_ray_p_theme_color; ?>;
		}
		.sidebar .widget-title:after{
			border-color: transparent <?php echo accesspress_ray_colour_brightness( $accesspress_ray_p_theme_color, '-0.9' ) ?> <?php echo accesspress_ray_colour_brightness( $accesspress_ray_p_theme_color, '-0.9' ) ?> transparent;
		}

		#site-navigation .menu > ul > li:hover > a:before, #site-navigation .menu > ul > li.current_page_item > a:before, #site-navigation .menu > ul > li.current-menu-item > a:before, #site-navigation .menu > ul > li.current_page_ancestor > a:before, #site-navigation .menu > ul > li.current-menu-ancestor > a:before, 
		#slider-banner .bx-wrapper .bx-pager.bx-default-pager a:after,
		.navigation .nav-links a, .slider-caption br + a, .bttn, button, input[type="button"], input[type="reset"], input[type="submit"],
		.events-section .bx-wrapper .bx-pager.bx-default-pager a:hover, .events-section .bx-wrapper .bx-pager.bx-default-pager a.active,
		.clients-say-section .bx-wrapper .bx-pager.bx-default-pager a.active, .clients-say-section .bx-wrapper .bx-pager.bx-default-pager a:hover,.footer-socials a:hover,
		.event-list-wrapper .lSSlideOuter .lSPager.lSpg > li.active a,
		.event-list-wrapper .lSSlideOuter .lSPager.lSpg > li:hover a {
			background: <?php echo $accesspress_ray_s_theme_color; ?>;
		}
		#slider-banner .bx-wrapper .bx-pager.bx-default-pager a {
			box-shadow:0 0 0 2px <?php echo $accesspress_ray_s_theme_color; ?> inset;
		}
		.navigation .nav-links a:hover, .bttn:hover, button, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .slider-caption br + a:hover {
			background: <?php echo accesspress_ray_colour_brightness( $accesspress_ray_s_theme_color, '-0.9' ) ?> ;
		}
		.events-section .event-list .event-date {
			background: none repeat scroll 0 0 <?php echo $accesspress_ray_s_theme_color; ?>;
		}

	</style>
<?php
	}
}
add_action( 'wp_head', 'accesspress_ray_theme_color' );

add_filter('widget_text', 'do_shortcode');

/*Woo-commerce functions*/
add_filter( 'loop_shop_per_page', 'accesspress_ray_products_per_page', 20 );
if( !function_exists( 'accesspress_ray_products_per_page' ) ) {
    function accesspress_ray_products_per_page() {
        return 12;
    }
}

add_filter( 'loop_shop_columns', 'accesspress_ray_loop_columns' );
if ( !function_exists( 'accesspress_ray_loop_columns' ) ) {
    function accesspress_ray_loop_columns() {
        return 3;
    }
}

add_action( 'body_class', 'ap_staple_woo_columns');
if (!function_exists('ap_staple_woo_columns')) {
   function ap_staple_woo_columns( $class ) {
          $class[] = 'columns-3';
          return $class;
   }
}

add_filter( 'woocommerce_output_related_products_args', 'accesspress_mag_related_products_args' );
  function accesspress_mag_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 3 related products
    $args['columns'] = 3; // arranged in 3 columns
    return $args;
}