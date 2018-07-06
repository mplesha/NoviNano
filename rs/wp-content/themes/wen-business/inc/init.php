<?php
/**
 * Include base
 */
require trailingslashit( get_template_directory() ) . 'inc/base.php';

/**
 * Include Helper functions
 */
require trailingslashit( get_template_directory() ) . 'inc/helper/customize.php';
require trailingslashit( get_template_directory() ) . 'inc/helper/common.php';
require trailingslashit( get_template_directory() ) . 'inc/helper/customize-callback.php';

/**
 * Include Metabox
 */
require trailingslashit( get_template_directory() ) . 'inc/metabox.php';

/**
 * Include Widgets
 */
require trailingslashit( get_template_directory() ) . 'inc/widgets.php';

/**
 * Include Customizer options
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer/core.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/header.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/footer.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/blog.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/layout.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/slider.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/pagination.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/breadcrumb.php';

/**
 * Include Hooks
 */
require trailingslashit( get_template_directory() ) . 'inc/hook/core.php';
require trailingslashit( get_template_directory() ) . 'inc/hook/structure.php';
require trailingslashit( get_template_directory() ) . 'inc/hook/header.php';
require trailingslashit( get_template_directory() ) . 'inc/hook/footer.php';
require trailingslashit( get_template_directory() ) . 'inc/hook/slider.php';
require trailingslashit( get_template_directory() ) . 'inc/hook/custom.php';


function wen_business_options_setup() {

  global $wen_business_default_theme_options;
  global $wen_business_customizer_object;

  $custom_settings = array();
  $custom_settings = apply_filters( 'wen_business_theme_options_args', $custom_settings );


  $wen_business_customizer_object = new WEN_Customizer( $custom_settings, $wen_business_default_theme_options );

}
add_action( 'after_setup_theme', 'wen_business_options_setup', 20 );

