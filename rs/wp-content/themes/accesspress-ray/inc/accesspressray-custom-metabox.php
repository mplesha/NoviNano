<?php
/**
 * AccessPress Ray Theme Options
 *
 * @package AccessPress Ray
 */

global $accesspress_ray_options;
$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
add_action('add_meta_boxes', 'accesspress_ray_add_sidebar_layout_box');

function accesspress_ray_add_sidebar_layout_box()
{
    add_meta_box(
                 'accesspress_ray_sidebar_layout', // $id
                 __('Sidebar Layout', 'accesspress-ray' ), // $title
                 'accesspress_ray_sidebar_layout_callback', // $callback
                 'post', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'accesspress_ray_sidebar_layout', // $id
                 __('Sidebar Layout', 'accesspress-ray'), // $title
                 'accesspress_ray_sidebar_layout_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority
}


$accesspress_ray_sidebar_layout = array(
        'left-sidebar' => array(
                        'value'     => 'left-sidebar',
                        'label'     => __( 'Left sidebar', 'accesspress-ray' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/admin-panel/images/left-sidebar.png'
                    ), 
        'right-sidebar' => array(
                        'value' => 'right-sidebar',
                        'label' => __( 'Right sidebar<br/>(default)', 'accesspress-ray' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/admin-panel/images/right-sidebar.png'
                    ),
        'both-sidebar' => array(
                        'value'     => 'both-sidebar',
                        'label'     => __( 'Both Sidebar', 'accesspress-ray' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/admin-panel/images/both-sidebar.png'
                    ),
       
        'no-sidebar' => array(
                        'value'     => 'no-sidebar',
                        'label'     => __( 'No sidebar', 'accesspress-ray' ),
                        'thumbnail' => get_template_directory_uri() . '/inc/admin-panel/images/no-sidebar.png'
                    )   

    );

function accesspress_ray_sidebar_layout_callback()
{ 
global $post , $accesspress_ray_sidebar_layout;
wp_nonce_field( basename( __FILE__ ), 'accesspress_ray_sidebar_layout_nonce' ); 
?>

<table class="form-table">
<tr>
<td colspan="4"><em class="f13"><?php _e('Choose Sidebar Template', 'accesspress-ray'); ?></em></td>
</tr>

<tr>
<td>
<?php  
   foreach ($accesspress_ray_sidebar_layout as $field) {  
                $accesspress_ray_sidebar_metalayout = get_post_meta( $post->ID, 'accesspress_ray_sidebar_layout', true ); ?>

                <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
                <input type="radio" name="accesspress_ray_sidebar_layout" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $accesspress_ray_sidebar_metalayout ); if(empty($accesspress_ray_sidebar_metalayout) && $field['value']=='right-sidebar'){ echo "checked='checked'";} ?>/>&nbsp;<?php echo $field['label']; ?>
                </label>
                </div>
                <?php } // end foreach 
                ?>
                <div class="clear"></div>
</td>
</tr>
<tr>
    <td><em class="f13"><?php echo sprintf(__('You can set up the sidebar content <a href="%s" target="_blank">here</a>', 'accesspress-ray'), esc_url(admin_url('/themes.php?page=theme_options'))); ?></em></td>
</tr>
</table>

<?php } 

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function accesspress_ray_save_sidebar_layout( $post_id ) { 
    global $accesspress_ray_sidebar_layout, $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'accesspress_ray_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'accesspress_ray_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
    

    foreach ($accesspress_ray_sidebar_layout as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'accesspress_ray_sidebar_layout', true); 
        $new = sanitize_text_field($_POST['accesspress_ray_sidebar_layout']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'accesspress_ray_sidebar_layout', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'accesspress_ray_sidebar_layout', $old);  
        } 
     } // end foreach   
     
}
add_action('save_post', 'accesspress_ray_save_sidebar_layout'); 