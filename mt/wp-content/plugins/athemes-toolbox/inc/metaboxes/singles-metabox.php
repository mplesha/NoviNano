<?php

/**
 * Metabox for the single posts/pages
 *
 * @package    	Athemes_Toolbox
 * @link        http://athemes.com
 * Author:      aThemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


function athemes_toolbox_singles_options_metabox() {
    new Athemes_Toolbox_Singles_Options();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'athemes_toolbox_singles_options_metabox' );
    add_action( 'load-post-new.php', 'athemes_toolbox_singles_options_metabox' );
}

class Athemes_Toolbox_Singles_Options {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'color_picker' ) );
	}

	public function add_meta_box( $post_type ) {
        global $post;
        $post_types = array('post', 'page', 'services', 'employees', 'testimonials', 'projects', 'timeline-events');
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'st_singles_metabox'
				,__( 'Post/page options', 'athemes_toolbox' )
				,array( $this, 'render_meta_box_content' )
				,$post_type
				,'advanced'
				,'high'
			);
		}
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['athemes_toolbox_singles_options_nonce'] ) )
			return $post_id;

		$nonce = $_POST['athemes_toolbox_singles_options_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'athemes_toolbox_singles_options' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		$field_bodybg 		= isset( $_POST['athemes_toolbox_body_background'] ) ? strip_tags($_POST['athemes_toolbox_body_background']) : '';
		$field_postbg 		= isset( $_POST['athemes_toolbox_post_background'] ) ? strip_tags($_POST['athemes_toolbox_post_background']) : '';
		$field_text   		= isset( $_POST['athemes_toolbox_text_color'] ) ? strip_tags($_POST['athemes_toolbox_text_color']) : '';
		$field_hide_menu   	= isset( $_POST['athemes_toolbox_hide_menu'] ) ? (bool)($_POST['athemes_toolbox_hide_menu']) : '';
		$field_hide_title   = isset( $_POST['athemes_toolbox_hide_title'] ) ? (bool)($_POST['athemes_toolbox_hide_title']) : '';
		$field_hide_footer  = isset( $_POST['athemes_toolbox_hide_footer'] ) ? (bool)($_POST['athemes_toolbox_hide_footer']) : '';

		update_post_meta( $post_id, '_athemes_toolbox_body_background_key', $field_bodybg );
		update_post_meta( $post_id, '_athemes_toolbox_post_background_key', $field_postbg );
		update_post_meta( $post_id, '_athemes_toolbox_text_color_key', $field_text );
		update_post_meta( $post_id, '_athemes_toolbox_hide_menu_key', $field_hide_menu );
		update_post_meta( $post_id, '_athemes_toolbox_hide_title_key', $field_hide_title );
		update_post_meta( $post_id, '_athemes_toolbox_hide_footer_key', $field_hide_footer );
	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'athemes_toolbox_singles_options', 'athemes_toolbox_singles_options_nonce' );
		
		$body_bg = get_post_meta( $post->ID, '_athemes_toolbox_body_background_key', true );
		$post_bg = get_post_meta( $post->ID, '_athemes_toolbox_post_background_key', true );
		$text_color = get_post_meta( $post->ID, '_athemes_toolbox_text_color_key', true );
		$hide_menu = get_post_meta( $post->ID, '_athemes_toolbox_hide_menu_key', true );
		$hide_title = get_post_meta( $post->ID, '_athemes_toolbox_hide_title_key', true );
		$hide_footer = get_post_meta( $post->ID, '_athemes_toolbox_hide_footer_key', true );
	?>

		<p><em><?php echo __('Here you can control the options just for this page/post.'); ?></em></p>		

		<div class="custom_meta_box">
			<p><label>Body Background Color:</label><br/>
			<input class="color-field" type="text" name="athemes_toolbox_body_background" value="<?php echo $body_bg; ?>"/></p>
			<hr>
			<p><label>Content Background Color: </label><br/>
			<input class="color-field" type="text" name="athemes_toolbox_post_background" value="<?php echo $post_bg; ?>"/></p>
			<hr>
			<p><label>Text Color: </label><br/>
			<input class="color-field" type="text" name="athemes_toolbox_text_color" value="<?php echo $text_color; ?>"/></p>		
			<hr>
			<p><input type="checkbox" id="athemes_toolbox_hide_menu" class="checkbox" name="athemes_toolbox_hide_menu" <?php checked( $hide_menu ); ?> />
			<label for="athemes_toolbox_hide_menu"><?php _e( 'Hide the menu bar?', 'astrid' ); ?></label></p>
			<hr>
			<p><input type="checkbox" id="athemes_toolbox_hide_title" class="checkbox" name="athemes_toolbox_hide_title" <?php checked( $hide_title ); ?> />
			<label for="athemes_toolbox_hide_title"><?php _e( 'Hide the post title?', 'astrid' ); ?></label></p>	
			<hr>
			<p><input type="checkbox" id="athemes_toolbox_hide_footer" class="checkbox" name="athemes_toolbox_hide_footer" <?php checked( $hide_footer ); ?> />
			<label for="athemes_toolbox_hide_footer"><?php _e( 'Hide the footer (widget areas and copyright)?', 'astrid' ); ?></label></p>	
		</div> 

		<script>
		(function( $ ) {
			$(function() {
			$('.color-field').wpColorPicker();
			});
		})( jQuery );
		</script>

	<?php
	}

	public function color_picker() {
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_script( 'wp-color-picker');		
	}

}
