<?php

function mesmerize_theme_defaults() {
    $gradients = mesmerize_get_parsed_gradients();
    
    $defaults = array(

    1 => array(
        'header_nav_transparent' => false,
        'inner_header_nav_transparent' => false,
        
        'header_nav_border' => false,
        'inner_header_nav_border' => false,

        'header_nav_border_thickness' => 2,
        'inner_header_nav_border_thickness' => 2,

        'header_nav_border_color' => "rgba(255, 255, 255, 1)",
        'inner_header_nav_border_color' => "rgba(255, 255, 255, 1)",
        
        
        'header_text_box_text_width' => 80,
        "header_text_box_text_align" => "left",
        "header_content_partial" => "media-on-right",

        "header_spacing" => array(
            "top"    => "5%",
            "bottom" => "8%",
        ),

        "enable_top_bar" => true,
        "header_front_page_image" =>get_template_directory_uri() . "/assets/images/home_page_header.jpg",
        "inner_header_front_page_image" =>get_template_directory_uri() . "/assets/images/home_page_header.jpg",

        "header_overlay_type" => 'gradient',
        "inner_header_overlay_type" => 'gradient',

        'header_overlay_color' => "#000000",
        'inner_header_overlay_color' => "#000000",
        
        'header_overlay_gradient_colors' => $gradients['red_salvation'],
        'inner_header_overlay_gradient_colors' => $gradients['red_salvation'],

        'header_overlay_opacity' => 0.5,
        'inner_header_overlay_opacity' => 0.5,

    ),

    2 =>  array(
        'header_nav_transparent' => true,
        'inner_header_nav_transparent' => true,

        'header_nav_border' => true,
        'inner_header_nav_border' => true,

        'header_nav_border_thickness' => 1,
        'inner_header_nav_border_thickness' => 1,
        
        'header_nav_border_color' => "rgba(255, 255, 255, 0.5)",
        'inner_header_nav_border_color' => "rgba(255, 255, 255, 0.5)",

        'header_text_box_text_width' => 85,

        "header_text_box_text_align" => "center",
        "header_content_partial" => "content-on-center",
        
        "header_spacing" => array(
            "top"    => "14%",
            "bottom" => "14%",
        ),

        "enable_top_bar" => false,
        "header_front_page_image" =>get_template_directory_uri() . "/assets/images/home_page_header-2.jpg",
        "inner_header_front_page_image" =>get_template_directory_uri() . "/assets/images/home_page_header-2.jpg",

        "header_overlay_type" => 'color',
        "inner_header_overlay_type" => 'gradient',
        
        'header_overlay_color' => "#0c0070",
        'inner_header_overlay_color' => "#0c0070",

        'header_overlay_gradient_colors' => $gradients['plum_plate'],
        'inner_header_overlay_gradient_colors' => $gradients['plum_plate'],
        
        'header_overlay_opacity' => 0.5,
        'inner_header_overlay_opacity' => 0.5,
          
    ));

    return $defaults;
}

add_action('after_switch_theme', function() {
    $current_preset = 2;
    $default_preset = get_theme_mod('theme_default_preset', false);
    if (!$default_preset && !mesmerize_is_modified()) {
        set_theme_mod('theme_default_preset', $current_preset);
    }
});



function mesmerize_is_modified() {
    $mods = get_theme_mods();
    foreach ($mods as $mod => $value) {
        if (strpos("header", $mod) !== FALSE) {
            return true;
        }
    }
    return false;
}
