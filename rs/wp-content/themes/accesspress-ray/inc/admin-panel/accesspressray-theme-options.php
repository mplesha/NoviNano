<?php
/**
 * AccessPress Ray Theme Options
 *
 * @package AccessPress Ray
 */

if ( is_admin() ) : // Load only if we are viewing an admin page

function accesspress_ray_admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_script( 'accesspress_ray_custom_js', get_template_directory_uri().'/inc/admin-panel/js/custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'accesspress_ray_of-media-uploader', get_template_directory_uri().'/inc/admin-panel/js/media-uploader.js', array( 'jquery' ) );
	
	wp_enqueue_style( 'accesspress_ray_admin_style',get_template_directory_uri().'/inc/admin-panel/css/admin.css', array( 'farbtastic', 'thickbox'), '1.0', 'screen' );

	wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');

}
add_action('admin_print_styles-appearance_page_theme_options', 'accesspress_ray_admin_scripts');

$accesspress_ray_options = array(
	'responsive_design'=>'',
	'accesspress_ray_favicon'=> '',
	'featured_text'=> __('Featured Text','accesspress-ray'),
	'show_search'=> true,
	'logo_alignment'=> __('Left','accesspress-ray'),
	'call_to_action_post' => '',
	'call_to_action_post_readmore' => __('Read More','accesspress-ray'),
	'call_to_action_post_char' => '650',
	'show_fontawesome' => false,
    'big_icons' => false,
    'featured_title' => __('Featured Title','accesspress-ray'),
	'featured_post1' => '',
	'featured_post2' => '',
	'featured_post3' => '',
	'featured_post4' => '',
	'featured_post_readmore' => __('Read More','accesspress-ray'),
	'featured_post1_icon' => '',
	'featured_post2_icon' => '',
	'featured_post3_icon' => '',
	'featured_post4_icon' => '',
	'show_blog_number' => '3',
	'show_blogdate' => true,
	'testimonial_cat' => '',
	'blog_cat' => '',
	'portfolio_cat' => '',
	'footer_copyright' => get_bloginfo('name'),

	'show_slider' => 'yes',
	'slider_show_pager' => 'yes1',
	'slider_show_controls' => 'yes2',
	'slider_mode' => 'slide',
	'slider_auto' => 'yes3',
	'slider_speed' => '500',
	'slider_caption'=>'yes4',
	'slider_pause' => '4000',

	'slider1'=>'',
	'slider2'=>'',
	'slider3'=>'',
	'slider4'=>'',

	'leftsidebar_show_latest_events'=>true,
	'leftsidebar_show_testimonials'=>true,
	'rightsidebar_show_latest_events'=>true,
	'rightsidebar_show_testimonials'=>true,
	
	'accesspress_ray_facebook' => esc_url( 'https://www.facebook.com/' ),
	'accesspress_ray_twitter' => esc_url( 'https://www.twitter.com/' ),
	'accesspress_ray_gplus' => esc_url( 'https://www.plus.google.com/' ),
	'accesspress_ray_youtube' => esc_url( 'https://www.youtube.com/' ),
	'accesspress_ray_pinterest' => esc_url( 'https://www.pinterest.com/' ),
	'accesspress_ray_linkedin' => esc_url( 'https://www.linkedin.com/' ),
	'accesspress_ray_flickr' => '',
	'accesspress_ray_vimeo' => '',
	'accesspress_ray_stumbleupon' => '',
	'accesspress_ray_instagram' => esc_url( 'https://www.instagram.com/' ),
	'accesspress_ray_sound_cloud' => '',
	'accesspress_ray_skype' => '',
	'accesspress_ray_rss' => '',
	'show_social_header'=>'',
	'show_social_footer'=>'',

	'google_map' => '',
	'contact_address' => '',
	'accesspress_ray_home_page_layout' => 'Default',
    'accesspress_ray_webpage_layout' => 'Fullwidth',
    'gallery_code' => '',

    'slider_options' => 'single_post_slider',
    'slider_cat' => '',
    'view_all_text' =>__('View All','accesspress-ray'),
    'custom_css' => '',
    'custom_code' => '',
    'featured_bar' => true,
    'call_to_action_post_content' => true,

    'google_map' => '',

    'read_more_text' => __('Read More','accesspress-ray'),
    'hide_blogmore' => false,
    'blogmore_text' => __('View All','accesspress-ray'),
    'show_blog' => true,
    'blog_title' => __('Latest Posts','accesspress-ray'),

    'primary_theme_color' => '#23A38F',
    'secondary_theme_color' => '#f0563d',

    'accesspress_ray_template_design' => 'default_template',
    'testimonial_section_bg' => esc_url( get_template_directory_uri(). '/images/demo/testimonials-bg.jpg' ),
    'featured_section_bg' => esc_url( get_template_directory_uri(). '/images/demo/featured-bg.jpg' ),
);

add_action( 'admin_init', 'accesspress_ray_register_settings' );
add_action( 'admin_menu', 'accesspress_ray_theme_options' );

function accesspress_ray_register_settings() {
	register_setting( 'accesspress_ray_theme_options', 'accesspress_ray_options', 'accesspress_ray_validate_options' );
}

function accesspress_ray_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( __( 'Theme Options', 'accesspress-ray' ), __( 'Theme Options', 'accesspress-ray' ), 'edit_theme_options', 'theme_options', 'accesspress_ray_theme_options_page' );
}


// Store Posts in array
$accesspress_ray_postlist[0] = array(
	'value' => 0,
	'label' => __( '--choose--', 'accesspress-ray' )
);
$arg = array('posts_per_page'   => -1);
$accesspress_ray_posts = get_posts($arg);
foreach( $accesspress_ray_posts as $accesspress_ray_post ) :
	$accesspress_ray_postlist[$accesspress_ray_post->ID] = array(
		'value' => $accesspress_ray_post->ID,
		'label' => $accesspress_ray_post->post_title
	);
endforeach;
wp_reset_postdata();

// Store categories in array
$accesspress_ray_catlist[0] = array(
	'value' => 0,
	'label' => __( '--choose--', 'accesspress-ray' )
);
$arg1 = array(
	'hide_empty' => 0,
	'orderby' => 'name',
  	'parent' => 0,
  	);
$accesspress_ray_cats = get_categories($arg1);

foreach( $accesspress_ray_cats as $accesspress_ray_cat ) :
	$accesspress_ray_catlist[$accesspress_ray_cat->cat_ID] = array(
		'value' => $accesspress_ray_cat->cat_ID,
		'label' => $accesspress_ray_cat->cat_name
	);
endforeach;
wp_reset_postdata();

// Store slider setting in array
$accesspress_ray_slider = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'show', 'accesspress-ray' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'hide', 'accesspress-ray' )
	),
);

$accesspress_ray_slider_show_pager = array(
	'yes1' => array(
		'value' => 'yes1',
		'label' => __( 'yes', 'accesspress-ray' )
	),
	'no1' => array(
		'value' => 'no1',
		'label' => __( 'no', 'accesspress-ray' )
	),
);

$accesspress_ray_slider_show_controls = array(
	'yes2' => array(
		'value' => 'yes2',
		'label' => __( 'yes', 'accesspress-ray' )
	),
	'no2' => array(
		'value' => 'no2',
		'label' => __( 'no', 'accesspress-ray' )
	),
);

$accesspress_ray_slider_auto = array(
	'yes3' => array(
		'value' => 'yes3',
		'label' => __( 'yes', 'accesspress-ray' )
	),
	'no3' => array(
		'value' => 'no3',
		'label' => __( 'no', 'accesspress-ray' )
	),
);

$accesspress_ray_slider_mode = array(
	'fade' => array(
		'value' => 'fade',
		'label' => __( 'fade', 'accesspress-ray' )
	),
	'slide' => array(
		'value' => 'slide',
		'label' => __( 'slide', 'accesspress-ray' )
	),
);

$accesspress_ray_slider_caption = array(
	'yes4' => array(
		'value' => 'yes4',
		'label' => __( 'show', 'accesspress-ray' )
	),
	'no4' => array(
		'value' => 'no4',
		'label' => __( 'hide', 'accesspress-ray' )
	),
);


// Function to generate options page
function accesspress_ray_theme_options_page() {
	global $accesspress_ray_options, $accesspress_ray_postlist, $accesspress_ray_slider, $accesspress_ray_slider_show_pager, $accesspress_ray_slider_show_controls, $accesspress_ray_slider_mode, $accesspress_ray_slider_auto, $accesspress_ray_slider_caption, $accesspress_ray_catlist, $allowedtags;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap clearfix" id="optionsframework-wrap">

	<?php // Shows all the tabs of the theme options ?>
	<div class="nav-tab-wrapper">
	<div class="accesspress_ray-header">
		<img src="<?php echo get_template_directory_uri(); ?>/inc/admin-panel/images/logo.png">
		<h3><?php _e( 'Theme Options' , 'accesspress-ray' ); ?></h3>
	</div>
	<a id="options-group-1-tab" class="nav-tab nav-tab-active" href="#options-group-1"><?php _e('Basic Settings','accesspress-ray'); ?></a>
    <a id="options-group-2-tab" class="nav-tab" href="#options-group-2"><?php _e('Home Page Set Up','accesspress-ray'); ?></a>
	<a id="options-group-3-tab" class="nav-tab" href="#options-group-3"><?php _e('Slider Settings','accesspress-ray'); ?></a>
	<a id="options-group-5-tab" class="nav-tab" href="#options-group-5"><?php _e('Social Links','accesspress-ray'); ?></a>
	<a id="options-group-6-tab" class="nav-tab" href="#options-group-6"><?php _e('Tools','accesspress-ray'); ?></a>
	<a id="options-group-7-tab" class="nav-tab" href="#options-group-7"><?php _e('About AccessPress Ray','accesspress-ray'); ?></a>
	</div>

	<div id="optionsframework-metabox" class="metabox-holder">
    
    <?php 	if ( false !== $_REQUEST['settings-updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' , 'accesspress-ray' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>
    
		<div id="optionsframework" class="postbox">
			<form id="form_options" method="post" action="options.php">

			<?php $settings = get_option( 'accesspress_ray_options', $accesspress_ray_options ); ?>
			
			<?php settings_fields( 'accesspress_ray_theme_options' );
			/* This function outputs some hidden fields required by the form,
			including a nonce, a unique number used to ensure the form has been submitted from the admin page
			and not somewhere else, very important for security */ ?>

			<!-- Basic Settings -->
			<div id="options-group-1" class="group">
			<h3><?php _e('Basic Settings','accesspress-ray'); ?></h3>
				<table class="form-table">
					<tr>
						<th><label for="footer_copyright"><?php _e('Disable Responsive Design?','accesspress-ray'); ?></th>
						<td>
							<input type="checkbox" id="responsive_design" name="accesspress_ray_options[responsive_design]" value="1" <?php checked( true, $settings['responsive_design'] ); ?> />
							<label for="responsive_design"><?php _e('Check to disable','accesspress-ray'); ?></label>
						</td>
					</tr>

					<tr><th scope="row"><label for="webpage_layouts"><?php _e('Web Page Layout','accesspress-ray'); ?></label></th>
					<td>
					<?php $accesspress_ray_webpage_layouts = array('Fullwidth'=>__('Fullwidth','accesspress-ray'),'Boxed' => __('Boxed','accesspress-ray')); ?>
					<?php
					foreach ( $accesspress_ray_webpage_layouts as $accesspress_ray_webpage_layout_key => $accesspress_ray_webpage_layout ) : ?>
						<input type="radio" id="<?php echo $accesspress_ray_webpage_layout_key; ?>" name="accesspress_ray_options[accesspress_ray_webpage_layout]" value="<?php echo esc_attr($accesspress_ray_webpage_layout_key); ?>" <?php checked( $settings['accesspress_ray_webpage_layout'], $accesspress_ray_webpage_layout_key ); ?> />
						<label for="<?php echo $accesspress_ray_webpage_layout_key; ?>"><?php echo esc_attr($accesspress_ray_webpage_layout); ?></label><br />
					<?php endforeach;
					?>
					</td>
					</tr>

					<tr>
						<th scope="row"><label for="primary_theme_color"><?php _e( 'Primary Theme Color', 'accesspress-ray' );?></label></th>
                        <td>
                        	<?php if( !isset( $settings['primary_theme_color'] ) ) { $settings['primary_theme_color'] = '#23A38F'; } ?>
                        	<input class="accesspress_ray-color wp-color-picker" name="accesspress_ray_options[primary_theme_color]" type="text" value="<?php echo esc_attr($settings['primary_theme_color']) ?>">
                        </td>
					</tr>

					<tr>
						<th scope="row"><label for="secondary_theme_color"><?php _e( 'Secondary Theme Color', 'accesspress-ray' );?></label></th>
                        <td>
                        	<?php if( !isset( $settings['secondary_theme_color'] ) ) { $settings['secondary_theme_color'] = '#f0563d'; } ?>
                        	<input class="accesspress_ray-color wp-color-picker" name="accesspress_ray_options[secondary_theme_color]" type="text" value="<?php echo esc_attr($settings['secondary_theme_color']) ?>">
                        </td>
					</tr>

					<tr><th scope="row"><label for="template_design"><?php _e('Template Design','accesspress-ray'); ?></label></th>
					<td>
					<?php $accesspress_ray_template_designs = array('default_template'=>__('Default Template','accesspress-ray'),'style1_template' => __('Style 1 Template','accesspress-ray')); ?>
					<?php
					if( !isset( $settings['accesspress_ray_template_design'] ) ) { $settings['accesspress_ray_template_design'] = 'default_template'; }
					foreach ( $accesspress_ray_template_designs as $accesspress_ray_template_design_key => $accesspress_ray_template_design ) : ?>
						<input type="radio" id="<?php echo $accesspress_ray_template_design_key; ?>" name="accesspress_ray_options[accesspress_ray_template_design]" value="<?php echo esc_attr($accesspress_ray_template_design_key); ?>" <?php checked( $settings['accesspress_ray_template_design'], $accesspress_ray_template_design_key ); ?> />
						<label for="<?php echo $accesspress_ray_template_design_key; ?>"><?php echo esc_attr($accesspress_ray_template_design); ?></label><br />
					<?php endforeach;
					?>
					</td>
					</tr>
                    
                    <tr>
						<th><label for="show_search"><?php _e('Show Search in Header?','accesspress-ray') ?></th>
						<td>
							<input type="checkbox" id="show_search" name="accesspress_ray_options[show_search]" value="1" <?php checked( true, $settings['show_search'] ); ?> />
							<label for="show_search"><?php _e('Check to enable','accesspress-ray'); ?></label>
						</td>
					</tr>

					<tr>
						<th><label for="accesspress_ray_favicon"><?php _e('Upload Favicon','accesspress-ray'); ?></th>
						<td>
							<div class="accesspress_ray_fav_icon">
							  <input class="medium upload_favicon" type="text" name="accesspress_ray_options[media_upload]" id="accesspress_ray_media_upload" value="<?php if(!empty($settings['media_upload'])){ echo esc_url($settings['media_upload']); }?>" />
							  <input class="button accesspress_ray_upload_button" attr-upload="upload_favicon" name="media_upload_button" id="accesspress_ray_media_upload_button" value="<?php _e('Upload','accesspress-ray'); ?>" type="button" /> <br />
							  <em class="f13"><?php _e('Upload favicon(.png) with size of 16px X 16px', 'accesspress-ray'); ?></em>

							  <?php if(!empty($settings['media_upload'])){ ?>
							  <div class="accesspress_ray_media_image upload_favicon">
							  <img src="<?php echo esc_url($settings['media_upload']) ?>" class="accesspress_ray_show_image upload_favicon">
							  <div class="accesspress_ray_remove_upload" id="accesspress_ray_fav_icon_remove" attr-remove="upload_favicon"><?php _e('Remove','accesspress-ray'); ?></div>
							  </div>
							  <?php }else{ ?>
							  <div class="accesspress_ray_media_image upload_favicon" style="display:none">
							  <img src="<?php if(isset($settings['media_upload'])) { echo esc_url($settings['media_upload']); } ?>" class="accesspress_ray_show_image upload_favicon">
							  <a href="javascript:void(0)" class="accesspress_ray_remove_upload" attr-remove="upload_favicon" title="remove"><?php _e('Remove','accesspress-ray'); ?></a>
							  </div>
							  <?php	} ?>
							</div>
						</td>
					</tr>

					<tr>
						<th><label for="upload_log"><?php _e('Upload Logo','accesspress-ray'); ?></th>
						<td>
							<a class="button" target="_blank" href="<?php echo esc_url(admin_url('/themes.php?page=custom-header')); ?>"><?php _e('Upload','accesspress-ray'); ?></a>
						</td>
					</tr>

					<tr><th scope="row"><label for="logo_alignment"><?php _e('Logo Alignment','accesspress-ray'); ?></label></th>
					<td>
					<?php $accesspress_ray_logo_alignments = array('Left' => __('Left','accesspress-ray'),'Center'=>__('Center','accesspress-ray')); ?>
					<select id="logo_alignment" name="accesspress_ray_options[logo_alignment]">
					<?php
					foreach ( $accesspress_ray_logo_alignments as $accesspress_ray_logo_alignment_key => $accesspress_ray_logo_alignment ) :
						echo '<option value="' .esc_attr($accesspress_ray_logo_alignment_key). '" ' . selected( $accesspress_ray_logo_alignment_key , $settings['logo_alignment'] ) . '>' . esc_attr($accesspress_ray_logo_alignment)  . '</option>';
					endforeach;
					?>
					</select>
					</td>
					</tr>
					<tr><td colspan="2" class="seperator">&nbsp;</td></tr>

					

					<tr><th scope="row"><label for="portfolio_cat"><?php _e('Select the category to display as Portfolio/Products','accesspress-ray'); ?></label></th>
					<td>
					<select id="portfolio_cat" name="accesspress_ray_options[portfolio_cat]">
					<?php
					foreach ( $accesspress_ray_catlist as $single_cat ) :
						$label = esc_attr($single_cat['label']); ?>
						<option value="<?php echo esc_attr($single_cat['value']) ?>" <?php selected( $single_cat['value'], $settings['portfolio_cat'] ); ?>><?php echo $label; ?></option>
					<?php 
					endforeach;
					?>
					</select>
					</td>
					</tr>

					<tr>
						<td colspan="2">
							<em><?php echo sprintf(__('You can show these categories in the menu by configuring <a target="_blank" href="%s">Menus</a> Page.','accesspress-ray'), esc_url(admin_url('nav-menus.php'))); ?></em>
						</td>
					</tr>

					<tr><td colspan="2" class="seperator">&nbsp;</td></tr>

					<tr>
					<th scope="row"><label for="read_more_text"><?php _e('Read More Text','accesspress-ray'); ?></label></th>
					<td>
					<input class="medium" id="read_more_text" name="accesspress_ray_options[read_more_text]" type="text" value="<?php echo esc_attr($settings['read_more_text']); ?>" />
					<br>
					<em class="f13"><?php _e('Read More text for Archive page','accesspress-ray'); ?></em>
					</td>
					</tr>

					<tr>
					<th scope="row"><label for="footer_copyright"><?php _e('Footer Copyright Text','accesspress-ray'); ?></label></th>
					<td>
					<input class="medium" id="footer_copyright" name="accesspress_ray_options[footer_copyright]" type="text" value="<?php echo esc_attr($settings['footer_copyright']); ?>" />
					</td>
					</tr>
				</table>
			</div>
            
            <!-- Home page Settings -->
			<div id="options-group-2" class="group" style="display: none;">
			<h3><?php _e('Home Page Settings','accesspress-ray'); ?></h3> 
				<table class="form-table">
					<tr class="setting-title">
					<td colspan="2">
					<h4><?php _e('Call To Action', 'accesspress-ray'); ?></h4>
					</td>
					</tr>

					<tr><th scope="row"><label for="call_to_action_post"><?php _e('Call To Action Post','accesspress-ray'); ?></label></th>
					<td>
					<select id="call_to_action_post" name="accesspress_ray_options[call_to_action_post]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = esc_attr($single_post['label']); ?>
						<option value="<?php echo esc_attr($single_post['value']) ?>" <?php selected( $single_post['value'], $settings['call_to_action_post'] ); ?>><?php echo $label; ?></option>
					<?php endforeach;
					?>
					</select>
					</td>
					</tr>

					<tr>
						<th><label for="full_content"><?php _e('Show Full Content?','accesspress-ray'); ?></th>
						<td>
							<input type="checkbox" id="full_content" name="accesspress_ray_options[call_to_action_post_content]" value="1" <?php checked( true, $settings['call_to_action_post_content'] ); ?> />
							<label for="full_content"><?php _e('Check to enable','accesspress-ray'); ?></label><br />
						</td>
					</tr>

					<tr>
						<th><label for="call_to_action_post_char"><?php _e('Call To Action Post Excerpt Character','accesspress-ray'); ?></label></th>
						<td><input id="call_to_action_post_char" type="text" name="accesspress_ray_options[call_to_action_post_char]" value="<?php if (isset($settings['call_to_action_post_char'])){ echo esc_attr($settings['call_to_action_post_char']); } ?>"> <?php _e('Characters','accesspress-ray'); ?></td>
					</tr>

					<tr>
						<th><label for="call_to_action_post_readmore"><?php _e('Read More Text','accesspress-ray'); ?></label></th>
						<td><input class="medium" id="call_to_action_post_readmore" type="text" name="accesspress_ray_options[call_to_action_post_readmore]" value="<?php if (isset($settings['call_to_action_post_readmore'])){ echo esc_attr($settings['call_to_action_post_readmore']); } ?>"><br /><em class="f13"><?php _e('Leave blank if you don\'t want to show read more','accesspress-ray'); ?></em></td>
					</tr>

					<tr class="setting-title">
					<td colspan="2">
					<h4><?php _e('Featured Posts', 'accesspress-ray'); ?></h4>
					</td>
					</tr>
					<tr>
					<th scope="row"><label for="featured_title"><?php _e('Featured Title','accesspress-ray'); ?></label></th>
					<td>
					<input class="medium" type="text" id="featured_title" name="accesspress_ray_options[featured_title]" value="<?php echo wp_kses($settings['featured_title'], $allowedtags); ?>" />
					</td>
                    </tr>

					<tr>
					<th scope="row"><label for="featured_text"><?php _e('Featured Text','accesspress-ray'); ?></label></th>
					<td>
					<textarea id="featured_text" name="accesspress_ray_options[featured_text]" rows="3" cols="60"><?php echo esc_textarea($settings['featured_text'], $allowedtags); ?></textarea><br />
                    <em class="f13"><?php _e('Html content allowed','accesspress-ray'); ?></em> </td>
                    </tr>

					<tr>
						<th><label for="show_fontawesome"><?php _e('Show Font Awesome icon in Featured Post?','accesspress-ray'); ?></th>
						<td>
							<input type="checkbox" id="show_fontawesome" name="accesspress_ray_options[show_fontawesome]" value="1" <?php checked( true, $settings['show_fontawesome'] ); ?> />
							<label for="show_fontawesome"><?php _e('Check to enable','accesspress-ray'); ?></label><br />
                            <em class="f13"><?php echo sprintf(__('(If enabled the image will be replaced by Font Awesome Icon. For lists of icons click <a href="%s" target="_blank"> here','accesspress-ray'), esc_url('http://fontawesome.io/icons/')); ?></a>)</em>
						</td>
					</tr>
                    
					<tr><th scope="row"><label for="featured_post1"><?php _e('Featured Post 1','accesspress-ray'); ?></label></th>
					<td>
					<select id="featured_post1" name="accesspress_ray_options[featured_post1]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = esc_attr($single_post['label']); ?>
						<option value="<?php echo esc_attr($single_post['value']) ?>" <?php selected( $single_post['value'], $settings['featured_post1'] ); ?>><?php echo $label; ?></option>
					<?php 
					endforeach;
					?>
					</select>
					<input id="featured_post1_icon" name="accesspress_ray_options[featured_post1_icon]" type="text" value="<?php echo esc_attr($settings['featured_post1_icon']); ?>" placeholder="<?php _e('Font Awesome icon name','accesspress-ray'); ?>" /><em class="f13">&nbsp;&nbsp;<?php _e('Example','accesspress-ray');?>: fa-bell</em>
					</td>
					</tr>

					<tr><th scope="row"><label for="featured_post2"><?php _e('Featured Post 2','accesspress-ray'); ?></label></th>
					<td>
					<select id="featured_post2" name="accesspress_ray_options[featured_post2]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = esc_attr($single_post['label']); ?>
						<option value="<?php echo esc_attr($single_post['value']) ?>" <?php selected( $single_post['value'], $settings['featured_post2'] ); ?>><?php echo $label; ?></option>
					<?php
					endforeach;
					?>
					</select>
					<input id="featured_post2_icon" name="accesspress_ray_options[featured_post2_icon]" type="text" value="<?php echo esc_attr($settings['featured_post2_icon']); ?>" placeholder="<?php _e('Font Awesome icon name','accesspress-ray'); ?>" /><em class="f13">&nbsp;&nbsp;<?php _e('Example','accesspress-ray');?>: fa-bell</em>
					</td>
					</tr>

					<tr><th scope="row"><label for="featured_post3"><?php _e('Featured Post 3','accesspress-ray'); ?></label></th>
					<td>
					<select id="featured_post3" name="accesspress_ray_options[featured_post3]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = esc_attr($single_post['label']); ?>
						<option value="<?php echo esc_attr($single_post['value']) ?>" <?php selected( $single_post['value'], $settings['featured_post3'] ); ?>><?php echo $label; ?></option>
					<?php 
					endforeach;
					?>
					</select>
					<input id="featured_post3_icon" name="accesspress_ray_options[featured_post3_icon]" type="text" value="<?php  echo esc_attr($settings['featured_post3_icon']); ?>" placeholder="<?php _e('Font Awesome icon name','accesspress-ray'); ?>" /><em class="f13">&nbsp;&nbsp;<?php _e('Example','accesspress-ray');?>: fa-bell</em>
					</td>
					</tr>

					<tr><th scope="row"><label for="featured_post4"><?php _e('Featured Post 4','accesspress-ray'); ?></label></th>
					<td>
					<select id="featured_post4" name="accesspress_ray_options[featured_post4]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = $single_post['label']; ?>
						<option value="<?php echo esc_attr($single_post['value']) ?>" <?php selected( $single_post['value'], $settings['featured_post4'] ); ?>><?php echo $label; ?></option>
					<?php 
					endforeach;
					?>
					</select>
					<input id="featured_post4_icon" name="accesspress_ray_options[featured_post4_icon]" type="text" value="<?php  echo esc_attr($settings['featured_post4_icon']); ?>" placeholder="<?php _e('Font Awesome icon name','accesspress-ray'); ?>" /><em class="f13">&nbsp;&nbsp;<?php _e('Example','accesspress-ray');?>: fa-bell</em>
					</td>
					</tr>

					<tr>
						<th><label for="featured_post_readmore"><?php _e('Read More Text','accesspress-ray'); ?></label></th>
						<td><input id="featured_post_readmore" type="text" name="accesspress_ray_options[featured_post_readmore]" value="<?php if ( isset($settings['featured_post_readmore'])){echo esc_attr($settings['featured_post_readmore']); } ?>"><br /><em class="f13"><?php _e('Leave blank if you don\'t want to show read more','accesspress-ray'); ?></em></td>
					</tr>

					<tr class="setting-title">
					<td colspan="2">
					<h4><?php _e('Blog Slider - Can be any other category apart from blog', 'accesspress-ray'); ?></h4>
					</td>
					</tr>

					<tr><th scope="row"><label for="blog_cat"><?php _e('Select the category to display as Blog','accesspress-ray'); ?></label></th>
					<td>
					<select id="blog_cat" name="accesspress_ray_options[blog_cat]">
					<?php
					foreach ( $accesspress_ray_catlist as $single_cat ) :
						$label = esc_attr($single_cat['label']); ?>
						<option value="<?php echo esc_attr($single_cat['value']) ?>" <?php selected( $single_cat['value'], $settings['blog_cat'] ); ?>><?php echo $label; ?></option>
					<?php 
					endforeach;
					?>
					</select>
					</td>
					</tr>

                    <tr>
						<th><label for="show_blog_number"><?php _e('No of Posts to display in Blog slider','accesspress-ray'); ?></label></th>
						<td><input id="show_blog_number" type="text" name="accesspress_ray_options[show_blog_number]" value="<?php if (isset($settings['show_blog_number'])){ echo esc_attr($settings['show_blog_number']); } ?>"></td>
					</tr>

					<tr>
						<th><label for="show_blogdate"><?php _e('Show Blog Posted Date?','accesspress-ray'); ?></th>
						<td>
							<input type="checkbox" id="show_blogdate" name="accesspress_ray_options[show_blogdate]" value="1" <?php checked( true, $settings['show_blogdate'] ); ?> />
							<label for="show_blogdate"><?php _e('Check to enable','accesspress-ray'); ?></label>
						</td>
					</tr>

					<tr>
						<th><label for="hide_blogmore"><?php _e('Disable Blog view all button?','accesspress-ray'); ?></th>
						<td>
							<input type="checkbox" id="hide_blogmore" name="accesspress_ray_options[hide_blogmore]" value="1" <?php checked( true, $settings['hide_blogmore'] ); ?> />
							<label for="hide_blogmore"><?php _e('Check to disable','accesspress-ray'); ?></label>
						</td>
					</tr>
					<tr>
						<th><label for="blogmore_text"><?php _e('Blog More Text','accesspress-ray'); ?></label></th>
						<td><input id="blogmore_text" type="text" name="accesspress_ray_options[blogmore_text]" value="<?php if (isset($settings['blogmore_text'])){ echo esc_attr($settings['blogmore_text']); } ?>"></td>
					</tr>

					<tr class="setting-title">
					<td colspan="2">
					<h4><?php _e('Featured Widgets', 'accesspress-ray'); ?></h4>
					</td>
					</tr>

                    <tr>
						<th><label for="featured_bar"><?php _e('Disable Featured Widget Bar','accesspress-ray'); ?></th>
						<td>
							<input type="checkbox" id="featured_bar" name="accesspress_ray_options[featured_bar]" value="1" <?php checked( true, $settings['featured_bar'] ); ?> />
							<label for="featured_bar"><?php _e('Check to disable','accesspress-ray'); ?></label><br />
						</td>
					</tr>

					<tr>
						<th><label for="featured_section_bg"><?php _e( 'Section Background', 'accesspress-ray' )?></label></th>
						<td>
							<div class="upload_featured_section_bg">
							  <input class="medium upload_featured_bg" type="text" name="accesspress_ray_options[featured_section_bg]" id="accesspress_ray_featured_section_bg" value="<?php if(!empty($settings['featured_section_bg'])){ echo esc_url($settings['featured_section_bg']); }?>" />
							  <input class="button accesspress_ray_upload_button" attr-upload="upload_featured_bg" name="media_upload_button" id="accesspress_ray_featured_section_bg_button" value="<?php _e('Upload','accesspress-ray'); ?>" type="button" /> <br />
							  <em class="f13"><?php _e('Upload background image for Featured Section which is acitve only template 2.', 'accesspress-ray'); ?></em>

							  <?php if(!empty($settings['featured_section_bg'])){ ?>
							  <div class="accesspress_ray_media_image upload_featured_bg">
							  <img src="<?php echo esc_url($settings['featured_section_bg']) ?>" class="accesspress_ray_show_image upload_featured_bg">
							  <div class="accesspress_ray_remove_upload" id="accesspress_ray_featured_section_bg_remove" attr-remove="upload_featured_bg"><?php _e('Remove','accesspress-ray'); ?></div>
							  </div>
							  <?php }else{ ?>
							  <div class="accesspress_ray_media_image upload_featured_bg" style="display:none">
							  <img src="<?php if(isset($settings['featured_section_bg'])) { echo esc_url($settings['featured_section_bg']); } ?>" class="accesspress_ray_show_image upload_featured_bg">
							  <a href="javascript:void(0)" class="accesspress_ray_remove_upload" attr-remove="upload_featured_bg" title="remove"><?php _e('Remove','accesspress-ray'); ?></a>
							  </div>
							  <?php	} ?>
							</div>
						</td>
					</tr>

					<tr>
					<td colspan="2">
						<em class="f13"><?php echo sprintf(__('To set up Widgets, Go to <a href="%s" target="_blank">widget page</a>', 'accesspress-ray'),esc_url(admin_url('widgets.php'))); ?></em>
					</td>
					</tr>

					<tr class="setting-title">
					<td colspan="2">
					<h4><?php _e('Testimonail Slider', 'accesspress-ray'); ?></h4>
					</td>
					</tr>
					<tr>
						<th><label for="testimonial_section_bg"><?php _e( 'Section Background', 'accesspress-ray' )?></label></th>
						<td>
							<div class="upload_testimonial_section_bg">
							  <input class="medium upload_testimonial_bg" type="text" name="accesspress_ray_options[testimonial_section_bg]" id="accesspress_ray_testimonial_section_bg" value="<?php if(!empty($settings['testimonial_section_bg'])){ echo esc_url($settings['testimonial_section_bg']); }?>" />
							  <input class="button accesspress_ray_upload_button" attr-upload="upload_testimonial_bg" name="media_upload_button" id="accesspress_ray_testimonial_section_bg_button" value="<?php _e('Upload','accesspress-ray'); ?>" type="button" /> <br />
							  <em class="f13"><?php _e('Upload background image for Testimonials Section which is acitve only template 2.', 'accesspress-ray'); ?></em>

							  <?php if(!empty($settings['testimonial_section_bg'])){ ?>
							  <div class="accesspress_ray_media_image upload_testimonial_bg">
							  <img src="<?php echo esc_url($settings['testimonial_section_bg']) ?>" class="accesspress_ray_show_image upload_testimonial_bg">
							  <div class="accesspress_ray_remove_upload" id="accesspress_ray_testimonial_section_bg_remove" attr-remove="upload_testimonial_bg"><?php _e('Remove','accesspress-ray'); ?></div>
							  </div>
							  <?php }else{ ?>
							  <div class="accesspress_ray_media_image upload_testimonial_bg" style="display:none">
							  <img src="<?php if(isset($settings['testimonial_section_bg'])) { echo esc_url($settings['testimonial_section_bg']); } ?>" class="accesspress_ray_show_image upload_testimonial_bg">
							  <a href="javascript:void(0)" class="accesspress_ray_remove_upload" attr-remove="upload_testimonial_bg" title="remove"><?php _e('Remove','accesspress-ray'); ?></a>
							  </div>
							  <?php	} ?>
							</div>
						</td>
					</tr>

					<tr><th scope="row"><label for="testimonial_cat"><?php _e('Select the category to display as Testimonials','accesspress-ray'); ?></label></th>
					<td>
					<select id="testimonial_cat" name="accesspress_ray_options[testimonial_cat]">
					<?php
					foreach ( $accesspress_ray_catlist as $single_cat ) :
						$label = esc_attr($single_cat['label']); ?>
						<option value="<?php echo esc_attr($single_cat['value']) ?>" <?php selected( $single_cat['value'], $settings['testimonial_cat'] ); ?>><?php echo $label; ?></option>
					<?php 
					endforeach;
					?>
					</select>
					</td>
					</tr>

					<tr class="setting-title">
					<td colspan="2">
					<h4><?php _e('Blog Post', 'accesspress-ray'); ?></h4>
					</td>
					</tr>

					<tr>
						<th><label for="show_blog"><?php _e('Show Blog Posts?','accesspress-ray'); ?></th>
						<td>
							<input type="checkbox" id="show_blog" name="accesspress_ray_options[show_blog]" value="1" <?php checked( true, $settings['show_blog'] ); ?> />
							<label for="show_blog"><?php _e('Check to enable','accesspress-ray'); ?></label>
						</td>
					</tr>

					<tr>
						<th><label for="blog_title"><?php _e('Title','accesspress-ray'); ?></label></th>
						<td><input id="blog_title" type="text" name="accesspress_ray_options[blog_title]" value="<?php if (isset($settings['blog_title'])){ echo esc_attr($settings['blog_title']); } ?>"></td>
					</tr>

					<tr class="setting-title">
					<td colspan="2">
					<h4><?php _e('Google Map', 'accesspress-ray'); ?></h4>
					</td>
					</tr>

					<tr><th scope="row"><label for="google_map"><?php _e('Google Map Iframe','accesspress-ray'); ?></label></th>
						<td>
						<textarea id="google_map" name="accesspress_ray_options[google_map]" rows="6" cols="60"><?php echo $settings['google_map']; ?></textarea>
						<p class="f13"><em><?php _e('Enter the Google Map Iframe','accesspress-ray'); ?><em></p>
						</td>
					</tr>

					<tr><th scope="row"><label for="contact_address"><?php _e('Contact Address','accesspress-ray'); ?></label></th>
						<td>
						<textarea id="contact_address" name="accesspress_ray_options[contact_address]" rows="6" cols="60"><?php echo $settings['contact_address']; ?></textarea>
						<p class="f13"><em><?php _e('Enter the Contact Address Detail','accesspress-ray'); ?><em></p>
						</td>
					</tr>
                </table>
            </div>


			<!-- Slider Settings-->
			<div id="options-group-3" class="group" style="display: none;">
			<h3><?php _e('Home Page Slider Settings','accesspress-ray'); ?></h3>
				<table class="form-table">
				<tbody>
					<tr class="slider-options">
						<th>
							<?php _e('Show','accesspress-ray'); ?>
						</th>
						<td>
						<?php 
						if(!isset($settings['slider_options'])){
							$settings['slider_options'] = 'single_post_slider';
						}
						?>
						<label class="checkbox" id="single_post_slider">
							<input value="single_post_slider" type="radio" name="accesspress_ray_options[slider_options]" <?php checked($settings['slider_options'],'single_post_slider'); ?> ><?php _e('Single Posts as a Slider','accesspress-ray'); ?>
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="checkbox" id="cat_post_slider">
							<input value="cat_post_slider" name="accesspress_ray_options[slider_options]" type="radio" <?php checked($settings['slider_options'],'cat_post_slider'); ?> ><?php _e('Category Posts as a Slider','accesspress-ray'); ?>
						</label>
						</td>
					</tr>

					<tr><td colspan="2" class="seperator">&nbsp;</td></tr>
					</tbody>

					<tbody class="post-as-slider">
					<tr>
						<td colspan="2"><em class="f13"><?php _e('Select the post that you want to display as a Slider','accesspress-ray'); ?></em></td>
					</tr>

					<tr>
					
					<th scope="row"><label for="slider1"><?php _e('Silder 1','accesspress-ray'); ?></label></th>
					<td>
					<select id="slider1" name="accesspress_ray_options[slider1]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = esc_attr($single_post['label']);
						echo '<option value="' . esc_attr($single_post['value']) . '" ' . selected($single_post['value'] , $settings['slider1'] ). '>' . $label . '</option>';
					endforeach;
					?>
					</select>
					</td>
					</tr>

					<tr><th scope="row"><label for="slider2"><?php _e('Silder 2','accesspress-ray'); ?></label></th>
					<td>
					<select id="slider2" name="accesspress_ray_options[slider2]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = esc_attr($single_post['label']);
						echo '<option value="' . esc_attr($single_post['value'])  . '" ' . selected($single_post['value'] , $settings['slider2'] ) . '>' . $label . '</option>';
					endforeach;
					?>
					</select>
					</td>
					</tr>

					<tr><th scope="row"><label for="slider3"><?php _e('Silder 3','accesspress-ray'); ?></label></th>
					<td>
					<select id="slider3" name="accesspress_ray_options[slider3]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = esc_attr($single_post['label']);
						echo '<option value="' . esc_attr( $single_post['value'] ) . '" ' . selected($single_post['value'] , $settings['slider3'] ) . '>' . $label . '</option>';
					endforeach;
					?>
					</select>
					</td>
					</tr>

					<tr>
					<th scope="row"><label for="slider4"><?php _e('Silder 4','accesspress-ray'); ?></label></th>
					<td>
					<select id="slider4" name="accesspress_ray_options[slider4]">
					<?php
					foreach ( $accesspress_ray_postlist as $single_post ) :
						$label = esc_attr($single_post['label']);
						echo '<option value="' . esc_attr( $single_post['value'] ) . '" ' . selected( $single_post['value'], $settings['slider4'] ) . '>' . $label . '</option>';
					endforeach;
					?>
					</select>
					</td>
					</tr>
					</tbody>

					<tbody class="cat-as-slider">
					<tr>
					<th><?php _e('Select the Category','accesspress-ray'); ?></th>
					<td>
					<?php 
					if(!isset($settings['slider_cat'])){
						$settings['slider_cat'] = 0;
					}
					?>
						<select id="slider_cat" name="accesspress_ray_options[slider_cat]">
						<?php
						foreach ( $accesspress_ray_catlist as $single_cat ) :
							$label = esc_attr($single_cat['label']);
							echo '<option value="' . esc_attr($single_cat['value']) . '" ' . selected( $single_cat['value'] , $settings['slider_cat'] ) . '>' . $label . '</option>';
						endforeach;
						?>
					</select>
					</td>
					</tr>
					</tbody>
					
					<tbody>
					<tr><td colspan="2" class="seperator">&nbsp;</td></tr>
					
					<tr>
						<td colspan="2"><em class="f13"><?php _e('Adjust the slider as per your need.','accesspress-ray'); ?></em></td>
					</tr>

					<tr><th scope="row"><?php _e('Show Slider','accesspress-ray'); ?></th>
					<td>
					<?php foreach( $accesspress_ray_slider as $slider ) : ?>
					<input type="radio" id="<?php echo $slider['value']; ?>" name="accesspress_ray_options[show_slider]" value="<?php echo esc_attr($slider['value']); ?>" <?php checked( $settings['show_slider'], $slider['value'] ); ?> />
					<label for="<?php echo esc_attr($slider['value']); ?>"><?php echo esc_attr($slider['label']); ?></label><br />
					<?php endforeach; ?>
					</td>
					</tr>

					<tr><th scope="row"><?php _e('Show Slider Pager (Navigation dots)','accesspress-ray'); ?></th>
					<td>
					<?php foreach( $accesspress_ray_slider_show_pager as $slider_pager ) : ?>
					<input type="radio" id="<?php echo $slider_pager['value']; ?>" name="accesspress_ray_options[slider_show_pager]" value="<?php echo esc_attr($slider_pager['value']); ?>" <?php checked( $settings['slider_show_pager'], $slider_pager['value'] ); ?> />
					<label for="<?php echo esc_attr($slider_pager['value']); ?>"><?php echo esc_attr($slider_pager['label']); ?></label><br />
					<?php endforeach; ?>
					</td>
					</tr>

					<tr><th scope="row"><?php _e('Show Slider Controls (Arrows)','accesspress-ray'); ?></th>
					<td>
					<?php foreach( $accesspress_ray_slider_show_controls as $slider_controls ) : ?>
					<input type="radio" id="<?php echo $slider_controls['value']; ?>" name="accesspress_ray_options[slider_show_controls]" value="<?php echo esc_attr($slider_controls['value']); ?>" <?php checked( $settings['slider_show_controls'], $slider_controls['value'] ); ?> />
					<label for="<?php echo esc_attr($slider_controls['value']); ?>"><?php echo esc_attr($slider_controls['label']); ?></label><br />
					<?php endforeach; ?>
					</td>
					</tr>

					<tr><th scope="row"><?php _e('Slider Transition - fade/slide','accesspress-ray'); ?></th>
					<td>
					<?php foreach( $accesspress_ray_slider_mode as $slider_modes) : ?>
					<input type="radio" id="<?php echo esc_attr($slider_modes['value']); ?>" name="accesspress_ray_options[slider_mode]" value="<?php echo esc_attr($slider_modes['value']); ?>" <?php checked( $settings['slider_mode'], $slider_modes['value'] ); ?> />
					<label for="<?php echo esc_attr($slider_modes['value']); ?>"><?php echo esc_attr($slider_modes['label']); ?></label><br />
					<?php endforeach; ?>
					</td>
					</tr>

					<tr><th scope="row"><?php _e('Slider auto Transition','accesspress-ray'); ?></th>
					<td>
					<?php foreach( $accesspress_ray_slider_auto as $slider_autos) : ?>
					<input type="radio" id="<?php echo esc_attr($slider_autos['value']); ?>" name="accesspress_ray_options[slider_auto]" value="<?php echo esc_attr($slider_autos['value']); ?>" <?php checked( $settings['slider_auto'], $slider_autos['value'] ); ?> />
					<label for="<?php echo esc_attr($slider_autos['value']); ?>"><?php echo esc_attr($slider_autos['label']); ?></label><br />
					<?php endforeach; ?>
					</td>
					</tr>

					<tr><th scope="row"><?php _e('Slider Speed','accesspress-ray'); ?></th>
					<td>
					<input id="slider_speed" name="accesspress_ray_options[slider_speed]" type="text" value="<?php echo esc_attr($settings['slider_speed']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><?php _e('Slider Pause','accesspress-ray'); ?></th>
					<td>
					<input id="slider_pause" name="accesspress_ray_options[slider_pause]" type="text" value="<?php echo esc_attr($settings['slider_pause']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><?php _e('Show Slider Captions','accesspress-ray'); ?></th>
					<td>
					<?php foreach( $accesspress_ray_slider_caption as $slider_captions) : ?>
					<input type="radio" id="<?php echo esc_attr($slider_captions['value']); ?>" name="accesspress_ray_options[slider_caption]" value="<?php echo esc_attr($slider_captions['value']); ?>" <?php checked( $settings['slider_caption'], $slider_captions['value'] ); ?> />
					<label for="<?php echo esc_attr($slider_captions['value']); ?>"><?php echo esc_attr($slider_captions['label']); ?></label><br />
					<?php endforeach; ?>
					</td>
					</tr>
					</tbody>
				</table>
			</div>

			<!-- Social Settings-->
			<div id="options-group-5" class="group" style="display: none;">
			<h3><?php _e('Social links - Put your social url','accesspress-ray'); ?></h3>
				<table class="form-table social-urls">
					<tr>
						<td colspan="2"><em class="f13"><?php _e('Put your social url below.. Leave blank if you don\'t want to show it.','accesspress-ray'); ?></em></td>
					</tr>

					<tr>
						<th><label for="show_social_footer"><?php _e('Disable Social icons in Footer?','accesspress-ray'); ?></th>
						<td>
							<input type="checkbox" id="show_social_footer" name="accesspress_ray_options[show_social_footer]" value="1" <?php checked( true, $settings['show_social_footer'] ); ?> />
							<label for="show_social_footer"><?php _e('Check to disable','accesspress-ray'); ?></label>
						</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_facebook"><?php _e('Facebook','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_facebook" name="accesspress_ray_options[accesspress_ray_facebook]" type="text" value="<?php echo esc_url($settings['accesspress_ray_facebook']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_twitter"><?php _e('Twitter','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_twitter" name="accesspress_ray_options[accesspress_ray_twitter]" type="text" value="<?php echo esc_url($settings['accesspress_ray_twitter']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_gplus"><?php _e('Google plus','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_gplus" name="accesspress_ray_options[accesspress_ray_gplus]" type="text" value="<?php echo esc_url($settings['accesspress_ray_gplus']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_youtube"><?php _e('Youtube','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_youtube" name="accesspress_ray_options[accesspress_ray_youtube]" type="text" value="<?php echo esc_url($settings['accesspress_ray_youtube']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_pinterest"><?php _e('Pinterest','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_pinterest" name="accesspress_ray_options[accesspress_ray_pinterest]" type="text" value="<?php echo esc_url($settings['accesspress_ray_pinterest']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_linkedin"><?php _e('Linkedin','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_linkedin" name="accesspress_ray_options[accesspress_ray_linkedin]" type="text" value="<?php echo esc_url($settings['accesspress_ray_linkedin']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_flickr"><?php _e('Flickr','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_flickr" name="accesspress_ray_options[accesspress_ray_flickr]" type="text" value="<?php echo esc_url($settings['accesspress_ray_flickr']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_vimeo"><?php _e('Vimeo','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_vimeo" name="accesspress_ray_options[accesspress_ray_vimeo]" type="text" value="<?php echo esc_url($settings['accesspress_ray_vimeo']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_stumbleupon"><?php _e('Stumbleupon','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_stumbleupon" name="accesspress_ray_options[accesspress_ray_stumbleupon]" type="text" value="<?php echo esc_url($settings['accesspress_ray_stumbleupon']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_instagram"><?php _e('Instagram','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_instagram" name="accesspress_ray_options[accesspress_ray_instagram]" type="text" value="<?php if(isset($settings['accesspress_ray_instagram'])) { echo esc_url($settings['accesspress_ray_instagram']); } ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_sound_cloud"><?php _e('Sound Cloud','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_sound_cloud" name="accesspress_ray_options[accesspress_ray_sound_cloud]" type="text" value="<?php if(isset($settings['accesspress_ray_sound_cloud'])) { echo esc_url($settings['accesspress_ray_sound_cloud']); } ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_skype"><?php _e('Skype','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_skype" name="accesspress_ray_options[accesspress_ray_skype]" type="text" value="<?php echo esc_attr($settings['accesspress_ray_skype']); ?>" />
					</td>
					</tr>

					<tr><th scope="row"><label for="accesspress_ray_rss"><?php _e('RSS','accesspress-ray'); ?></label></th>
					<td>
					<input id="accesspress_ray_rss" name="accesspress_ray_options[accesspress_ray_rss]" type="text" value="<?php echo esc_url($settings['accesspress_ray_rss']); ?>" />
					</td>
					</tr>
				</table>
			</div>

			<!-- Footer-contact -->
			<div id="options-group-6" class="group" style="display: none;">
			<h3><?php _e('Tools','accesspress-ray'); ?></h3>
				<table class="form-table">
					<tr><th scope="row"><label for="custom_css"><?php _e('Custom CSS','accesspress-ray'); ?></label></th>
						<td>
						<textarea id="custom_css" name="accesspress_ray_options[custom_css]" rows="8" cols="60"><?php if(isset($settings['custom_css'])){ echo esc_textarea($settings['custom_css']); } ?></textarea>
						<p class="f13"><em><?php _e('Put your custom CSS','accesspress-ray'); ?></em></p>
						</td>
					</tr>
				</table>
			</div>

			<!-- About AccessPress Ray -->
			<div id="options-group-7" class="group" style="display: none;">
			<h3><?php _e('Know more about AccessPress Themes','accesspress-ray'); ?></h3>
				<table class="form-table">
					<tr>
					<td colspan="2">
						<p><?php _e('AccessPress Ray - is a FREE WordPress theme by','accesspress-ray'); ?> <a target="_blank" href="<?php echo esc_url('https://accesspressthemes.com/'); ?>">AccessPress Themes</a> <?php _e('- A WordPress Division of Access Keys.','accesspress-ray'); ?></p>
						<p><?php _e('For demo, click','accesspress-ray'); ?> <a target="_blank" href="<?php echo esc_url('http://accesspressthemes.com/theme-demos/?theme=accesspress-ray'); ?>"><?php _e('here','accesspress-ray'); ?></a></p>
						<p><?php _e('For documentation, click','accesspress-ray'); ?> <a target="_blank" href="<?php echo esc_url('https://accesspressthemes.com/theme-instruction-accesspress-ray/'); ?>"><?php _e('here','accesspress-ray'); ?></a></p>

						<hr />
						<?php
						$other_product  = "<h4>".__('Other products by AccessPressThemes','accesspress-ray')."</h4>";
						$other_product .= __('Our Themes - ','accesspress-ray'). sprintf('<a href="%s" target="_blank">https://accesspressthemes.com/themes</a>','https://accesspressthemes.com/wordpress-themes/')."<br><br>" ;
						
						echo $other_product;
						?>
						<hr />
						<h4><?php _e('Get in touch','accesspress-ray'); ?></h4>

						<p>
						<?php _e('If you have any question/feedback regarding theme, please post in our forum','accesspress-ray'); ?><br/>
						<?php _e('Forum:','accesspress-ray'); ?> <a href="<?php echo esc_url('https://accesspressthemes.com/support/'); ?>">https://accesspressthemes.com/support</a><br/>
						<br/>
						<?php _e('For Live Chat Support','accesspress-ray'); ?><br/>
						<a href="<?php echo esc_url('http://accesspressthemes.com/'); ?>">https://accesspressthemes.com</a><br/>
						<br/>
						<?php _e('For Queries Regading Pro Theme','accesspress-ray'); ?><br/>
						<a href="mailto:support@accesspressthemes.com">support@accesspressthemes.com</a><br/>
						</p>

						</td>
					</tr>
				</table>
			</div>

			<div id="optionsframework-submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Options','accesspress-ray'); ?>" />
			</div>

			</form>
		</div><!-- #optionsframework -->

	</div><!-- #optionsframework-metabox -->
    
    <div class="upgrade-ray">
    <h3><?php _e('Upgrade to Ray Pro','accesspress-ray'); ?></h3>
    <div class="update-banner">
		<img src="<?php echo get_template_directory_uri(); ?>/inc/admin-panel/images/upgrade-top.jpg">
	</div>
    <div class="button-link">
		<a href="<?php echo esc_url('http://accesspressthemes.com/theme-demos/?theme=accesspress-ray'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/inc/admin-panel/images/demo-btn.png"></a>
		<a href="<?php echo esc_url('https://accesspressthemes.com/wordpress-themes/accesspress-ray-pro/'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/inc/admin-panel/images/upgrade-btn.png"></a>
	</div>

	<div class="any-question">
		<?php echo sprintf(__( 'Any question!! Click <a href="%s" target="_blank">here</a> for Live Chat' , 'accesspress-ray' ), esc_url('https://accesspressthemes.com/contact/')); ?>.
    </div>
    <h3 class="upgrade-header"><?php _e('Features','accesspress-ray'); ?> <span>+</span></h3>
    <div class="upgrade-image">
    <img src="<?php echo get_template_directory_uri(); ?>/inc/admin-panel/images/upgrade-ray-pro-feature.jpg"/>
    </div>
    </div>
	</div>
	<?php
}


function accesspress_ray_validate_options( $input ) {
	global $accesspress_ray_options, $accesspress_ray_logo_alignments, $accesspress_ray_postlist, $accesspress_ray_slider, $accesspress_ray_slider_show_pager, $accesspress_ray_slider_show_controls, $accesspress_ray_slider_mode, $accesspress_ray_slider_auto, $accesspress_ray_slider_caption;

	$settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties.
    $input['call_to_action_post'] = wp_filter_nohtml_kses( $input['call_to_action_post'] );
    $input['slider_options'] = wp_filter_nohtml_kses( $input['slider_options'] );
    $input['featured_title'] = wp_filter_nohtml_kses( $input['featured_title'] );
    $input['featured_post1'] = wp_filter_nohtml_kses( $input['featured_post1'] );
    $input['featured_post2'] = wp_filter_nohtml_kses( $input['featured_post2'] );
    $input['featured_post3'] = wp_filter_nohtml_kses( $input['featured_post3'] );
    $input['featured_post1_icon'] = sanitize_text_field( $input['featured_post1_icon'] );
    $input['featured_post2_icon'] = sanitize_text_field( $input['featured_post2_icon'] );
    $input['featured_post3_icon'] = sanitize_text_field( $input['featured_post3_icon'] );
    $input['blog_cat'] = wp_filter_nohtml_kses( $input['blog_cat'] );
    $input['testimonial_cat'] = wp_filter_nohtml_kses( $input['testimonial_cat'] );
    $input['portfolio_cat'] = wp_filter_nohtml_kses( $input['portfolio_cat'] );
    $input['slider_cat'] = wp_filter_nohtml_kses( $input['slider_cat'] );
    $input['logo_alignment'] = wp_filter_nohtml_kses( $input['logo_alignment'] );
    $input['slider_speed'] = sanitize_text_field( $input['slider_speed'] );
    $input['footer_copyright'] = sanitize_text_field( $input['footer_copyright'] );
    $input['featured_post_readmore'] = sanitize_text_field( $input['featured_post_readmore'] );
    $input['call_to_action_post_readmore'] = sanitize_text_field( $input['call_to_action_post_readmore'] );
    $input['custom_css'] = wp_filter_nohtml_kses( $input['custom_css'] );
    $input['custom_code'] = wp_kses_stripslashes( $input[ 'custom_code' ] );
    $input['read_more_text'] = sanitize_text_field( $input['read_more_text'] );
    $input['blog_title'] = sanitize_text_field( $input['blog_title'] );
    $input['blogmore_text'] = sanitize_text_field( $input['blogmore_text'] );

    // We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['featured_post1'];
	// We verify if the given value exists in the layouts array
	if ( !array_key_exists( $input['featured_post1'], $accesspress_ray_postlist ) )
		$input['featured_post1'] = $prev;

	$prev = $settings['featured_post2'];
	if ( !array_key_exists( $input['featured_post2'], $accesspress_ray_postlist ) )
		$input['featured_post2'] = $prev;
        
    $prev = $settings['featured_post3'];
	if ( !array_key_exists( $input['featured_post3'], $accesspress_ray_postlist ) )
		$input['featured_post3'] = $prev;
	
	
	$prev = $settings['show_slider'];
	if ( !array_key_exists( $input['show_slider'], $accesspress_ray_slider ) )
		$input['show_slider'] = $prev;

	$prev = $settings['slider_show_pager'];
	if ( !array_key_exists( $input['slider_show_pager'], $accesspress_ray_slider_show_pager ) )
		$input['slider_show_pager'] = $prev;

	$prev = $settings['slider_show_controls'];
	if ( !array_key_exists( $input['slider_show_controls'], $accesspress_ray_slider_show_controls) )
		$input['slider_show_controls'] = $prev;

	$prev = $settings['slider_mode'];
	if ( !array_key_exists( $input['slider_mode'], $accesspress_ray_slider_mode ) )
		$input['slider_mode'] = $prev;

	$prev = $settings['slider_auto'];
	if ( !array_key_exists( $input['slider_auto'], $accesspress_ray_slider_auto ) )
		$input['slider_auto'] = $prev;

	$prev = $settings['slider_caption'];
	if ( !array_key_exists( $input['slider_caption'], $accesspress_ray_slider_caption ) )
		$input['slider_caption'] = $prev;
        
    if (isset( $input['slider_speed'] ) ){
        if(intval($input['slider_speed'])){
            $input['slider_speed'] = absint($input['slider_speed']);
        }
    }

    if (!isset( $input['slider_pause'] ) || empty( $input['slider_pause'] ) ){
        $input['slider_pause']= "5000";
    }else{
    	if(intval($input['slider_pause'])){
            $input['slider_pause'] = absint($input['slider_pause']);
        }
    }

    if (!isset( $input['call_to_action_post_char'] ) || empty( $input['call_to_action_post_char'] ) ){
        $input['call_to_action_post_char']= "650";
    }else{
    	if(intval($input['call_to_action_post_char'])){
            $input['call_to_action_post_char'] = absint($input['call_to_action_post_char']);
        }
    }

    if (!isset( $input['show_blog_number'] ) || empty( $input['show_blog_number'] )){
       	$input['show_blog_number']= "3";
    }else{
    	 if(intval($input['show_blog_number'])){
            $input['show_blog_number'] = absint($input['show_blog_number']);
        }
    }


	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['responsive_design'] ) )
		$input['responsive_design'] = null;
	// We verify if the input is a boolean value
	$input['responsive_design'] = ( $input['responsive_design'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show_search'] ) )
		$input['show_search'] = null;
	$input['show_search'] = ( $input['show_search'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show_fontawesome'] ) )
		$input['show_fontawesome'] = null;
	$input['show_fontawesome'] = ( $input['show_fontawesome'] == 1 ? 1 : 0 );
    
    if ( ! isset( $input['big_icons'] ) )
		$input['big_icons'] = null;
	$input['big_icons'] = ( $input['big_icons'] == 1 ? 1 : 0 );

	if ( ! isset( $input['leftsidebar_show_latest_events'] ) )
		$input['leftsidebar_show_latest_events'] = null;
	$input['leftsidebar_show_latest_events'] = ( $input['leftsidebar_show_latest_events'] == 1 ? 1 : 0 );

	if ( ! isset( $input['leftsidebar_show_testimonials'] ) )
		$input['leftsidebar_show_testimonials'] = null;
	$input['leftsidebar_show_testimonials'] = ( $input['leftsidebar_show_testimonials'] == 1 ? 1 : 0 );

	if ( ! isset( $input['leftsidebar_show_social_links'] ) )
		$input['leftsidebar_show_social_links'] = null;
	$input['leftsidebar_show_social_links'] = ( $input['leftsidebar_show_social_links'] == 1 ? 1 : 0 );

	if ( ! isset( $input['rightsidebar_show_latest_events'] ) )
		$input['rightsidebar_show_latest_events'] = null;
	$input['rightsidebar_show_latest_events'] = ( $input['rightsidebar_show_latest_events'] == 1 ? 1 : 0 );

	if ( ! isset( $input['rightsidebar_show_testimonials'] ) )
		$input['rightsidebar_show_testimonials'] = null;
	$input['rightsidebar_show_testimonials'] = ( $input['rightsidebar_show_testimonials'] == 1 ? 1 : 0 );
	
	if ( ! isset( $input['rightsidebar_show_social_links'] ) )
		$input['rightsidebar_show_social_links'] = null;
	$input['rightsidebar_show_social_links'] = ( $input['rightsidebar_show_social_links'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show_social_header'] ) )
		$input['show_social_header'] = null;
	$input['show_social_header'] = ( $input['show_social_header'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show_social_footer'] ) )
		$input['show_social_footer'] = null;
	$input['show_social_footer'] = ( $input['show_social_footer'] == 1 ? 1 : 0 );

	if ( ! isset( $input['featured_bar'] ) )
		$input['featured_bar'] = null;
	$input['featured_bar'] = ( $input['featured_bar'] == 1 ? 1 : 0 );

	if ( ! isset( $input['call_to_action_post_content'] ) )
		$input['call_to_action_post_content'] = null;
	$input['call_to_action_post_content'] = ( $input['call_to_action_post_content'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show_blogdate'] ) )
		$input['show_blogdate'] = null;
	$input['show_blogdate'] = ( $input['show_blogdate'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show_blogmore'] ) )
		$input['show_blogmore'] = null;
	$input['show_blogmore'] = ( $input['show_blogmore'] == 1 ? 1 : 0 );

	if ( ! isset( $input['hide_blogmore'] ) )
		$input['hide_blogmore'] = null;
	$input['hide_blogmore'] = ( $input['hide_blogmore'] == 1 ? 1 : 0 );

	if ( ! isset( $input['show_blog'] ) )
		$input['show_blog'] = null;
	$input['show_blog'] = ( $input['show_blog'] == 1 ? 1 : 0 );

	 // data validation for Social Icons
	if( isset( $input[ 'accesspress_ray_facebook' ] ) ) {
		$input[ 'accesspress_ray_facebook' ] = esc_url_raw( $input[ 'accesspress_ray_facebook' ] );
	};
	if( isset( $input[ 'accesspress_ray_twitter' ] ) ) {
		$input[ 'accesspress_ray_twitter' ] = esc_url_raw( $input[ 'accesspress_ray_twitter' ] );
	};
	if( isset( $input[ 'accesspress_ray_gplus' ] ) ) {
		$input[ 'accesspress_ray_gplus' ] = esc_url_raw( $input[ 'accesspress_ray_gplus' ] );
	};
	if( isset( $input[ 'accesspress_ray_youtube' ] ) ) {
		$input[ 'accesspress_ray_youtube' ] = esc_url_raw( $input[ 'accesspress_ray_youtube' ] );
	};
	if( isset( $input[ 'accesspress_ray_pinterest' ] ) ) {
		$input[ 'accesspress_ray_pinterest' ] = esc_url_raw( $input[ 'accesspress_ray_pinterest' ] );
	};
	if( isset( $input[ 'accesspress_ray_linkedin' ] ) ) {
		$input[ 'accesspress_ray_linkedin' ] = esc_url_raw( $input[ 'accesspress_ray_linkedin' ] );
	};
	if( isset( $input[ 'accesspress_ray_flickr' ] ) ) {
		$input[ 'accesspress_ray_flickr' ] = esc_url_raw( $input[ 'accesspress_ray_flickr' ] );
	};
	if( isset( $input[ 'accesspress_ray_vimeo' ] ) ) {
		$input[ 'accesspress_ray_vimeo' ] = esc_url_raw( $input[ 'accesspress_ray_vimeo' ] );
	};
	if( isset( $input[ 'accesspress_ray_stumbleupon' ] ) ) {
		$input[ 'accesspress_ray_stumbleupon' ] = esc_url_raw( $input[ 'accesspress_ray_stumbleupon' ] );
	};
	if( isset( $input[ 'accesspress_ray_instagram' ] ) ) {
		$input[ 'accesspress_ray_instagram' ] = esc_url_raw( $input[ 'accesspress_ray_instagram' ] );
	};
	if( isset( $input[ 'accesspress_ray_sound_cloud' ] ) ) {
		$input[ 'accesspress_ray_sound_cloud' ] = esc_url_raw( $input[ 'accesspress_ray_sound_cloud' ] );
	};
	if( isset( $input[ 'accesspress_ray_skype' ] ) ) {
		$input[ 'accesspress_ray_skype' ] = esc_attr( $input[ 'accesspress_ray_skype' ] );
	};
	if( isset( $input[ 'accesspress_ray_rss' ] ) ) {
		$input[ 'accesspress_ray_rss' ] = esc_url_raw( $input[ 'accesspress_ray_rss' ] );
	};
	if( isset( $input[ 'action_btn_link' ] ) ) {
		$input[ 'action_btn_link' ] = esc_url_raw( $input[ 'action_btn_link' ] );
	};

    if( isset( $input[ 'featured_text' ] ) ) {
	   $input[ 'featured_text' ] = wp_kses_post( $input[ 'featured_text' ] );
    }
    

    if( isset( $input[ 'contact_address' ] ) ) {
	   $input[ 'contact_address' ] = wp_kses_post( $input[ 'contact_address' ] );
    }
    
    if( isset( $input[ 'gallery_code' ] ) ) {
	   $input[ 'gallery_code' ] = wp_kses_post( $input[ 'gallery_code' ] );
	}

	if( isset( $input[ 'google_map' ] ) ) {
	   $input[ 'google_map' ] = wp_kses_stripslashes( $input[ 'google_map' ] );
	}
	return $input;
}

endif;  // EndIf is_admin()
?>