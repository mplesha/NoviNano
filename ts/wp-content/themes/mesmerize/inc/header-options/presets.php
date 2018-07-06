<?php

function mesmerize_get_header_presets()
{
    global $MESMERIZE_HEADER_PRESETS;

    $result       = array();
    $presets_file = get_template_directory() . '/customizer/presets.php';
    if (file_exists($presets_file) && ! isset($MESMERIZE_HEADER_PRESETS)) {
        $MESMERIZE_HEADER_PRESETS = require $presets_file;
    }

    if (isset($MESMERIZE_HEADER_PRESETS)) {
        $result = $MESMERIZE_HEADER_PRESETS;
    }


    $result = apply_filters('mesmerize_header_presets', $result);

    return $result;

}


add_action("mesmerize_customize_register", function ($wp_customize) {
    /** @var WP_Customize_Manager $wp_customize */
    $wp_customize->add_setting('header_presets', array(
        'default'           => "",
        'sanitize_callback' => 'esc_html',
        "transport"         => "postMessage",
    ));

    $wp_customize->add_control(new Mesmerize\RowsListControl($wp_customize, 'header_presets', array(
        'label'       => esc_html__('Background Type', 'mesmerize'),
        'section'     => 'header_layout',
        "insertText"  => esc_html__("Apply Preset", "mesmerize"),
        'pro_message' => false,
        "type"        => "presets_changer",
        "dataSource"  => mesmerize_get_header_presets(),
        "priority"    => 2,
    )));


    $wp_customize->add_setting('frontpage_header_presets_pro', array(
        'default'           => "",
        'sanitize_callback' => 'esc_html',
        "transport"         => "postMessage",
    ));


    if ( ! apply_filters('mesmerize_is_companion_installed', false)) {
        $wp_customize->add_control(new Mesmerize\Info_PRO_Control($wp_customize, 'frontpage_header_presets_pro',
            array(
                'label'     => esc_html__('18 more beautiful header designs are available in the PRO version. @BTN@', 'mesmerize'),
                'section'   => 'header_layout',
                'priority'  => 10,
                'transport' => 'postMessage',
            )));
    }
});

