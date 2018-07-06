<?php

function mesmerize_header_buttons_defaults()
{
    return array(
        array(
            'label'  => __('Action Button 1', 'mesmerize'),
            'url'    => '#',
            'target' => '_self',
            'class'  => 'button big color1 round',
        ),
        array(
            'label'  => __('Action Button 2', 'mesmerize'),
            'url'    => '#',
            'target' => '_self',
            'class'  => 'button big color-white round outline',
        ),
    );
}

function mesmerize_front_page_header_buttons_options($section, $prefix, $priority)
{
    mesmerize_add_kirki_field(array(
        'type'            => 'checkbox',
        'settings'        => 'header_content_show_buttons',
        'label'           => esc_html__('Show buttons', 'mesmerize'),
        'section'         => $section,
        'default'         => true,
        'priority'        => $priority,
        'active_callback' => apply_filters('mesmerize_header_active_callback_filter', array(), false),
    ));

    mesmerize_add_kirki_field(array(
        'type'            => 'sidebar-button-group',
        'settings'        => 'header_content_buttons_group',
        'label'           => esc_html__('Options', 'mesmerize'),
        'section'         => $section,
        'priority'        => $priority,
        "choices"         => apply_filters('mesmerize_header_buttons_group', array(
            "header_content_buttons",
        )),
        'active_callback' => apply_filters('mesmerize_header_active_callback_filter', array(
            array(
                'setting'  => 'header_content_show_buttons',
                'operator' => '==',
                'value'    => true,
            ),

        ), false),
        'in_row_with'     => array('header_content_show_buttons'),
    ));

    $companion = apply_filters('mesmerize_is_companion_installed', false);
    mesmerize_add_kirki_field(array(
        'type'            => 'repeater',
        'settings'        => "header_content_buttons",
        'label'           => esc_html__('Buttons', 'mesmerize'),
        'section'         => $section,
        "priority"        => $priority,
        "default"         => mesmerize_header_buttons_defaults(),
        'choices'         => array(
            'limit' => apply_filters('header_content_buttons_limit', 2),
        ),
        'row_label'       => array(
            'type'  => 'text',
            'value' => esc_html__('Button', 'mesmerize'),
        ),
        "fields"          => apply_filters('mesmerize_navigation_custom_area_buttons_fields', array(
            "label" => array(
                'type'    => $companion ? 'hidden' : 'text',
                'label'   => esc_attr__('Label', 'mesmerize'),
                'default' => __('Action Button', 'mesmerize'),
            ),
            "url"   => array(
                'type'    => $companion ? 'hidden' : 'text',
                'label'   => esc_attr__('Link', 'mesmerize'),
                'default' => '#',
            ),

            "target" => array(
                'type'    => 'hidden',
                'label'   => esc_attr__('Target', 'mesmerize'),
                'default' => '_self',
            ),

            "class" => array(
                'type'    => 'hidden',
                'label'   => esc_attr__('Class', 'mesmerize'),
                'default' => '',
            ),

        )),
        'active_callback' => apply_filters('mesmerize_header_normal_buttons_active', array()),
    ));


    mesmerize_add_kirki_field(array(
        'type'            => 'ope-info-pro',
        'label'           => esc_html__('More colors and typography options available in PRO. @BTN@', 'mesmerize'),
        'section'         => $section,
        'priority'        => $priority,
        'settings'        => "header_content_typography_pro_info",
        'default'         => true,
        'transport'       => 'postMessage',
        'active_callback' => apply_filters('mesmerize_header_active_callback_filter', array(), false),
    ));
}


add_action("mesmerize_print_header_content", function () {

    $content = "";
    $enabled = get_theme_mod("header_content_show_buttons", true);

    if ($enabled) {
        ob_start();

        $default = array();
        if (mesmerize_can_show_demo_content()) {
            $default = mesmerize_header_buttons_defaults();
        }

        mesmerize_print_buttons_list("header_content_buttons", $default);

        $content = ob_get_clean();
        $content = apply_filters('mesmerize_header_buttons_content', $content, $enabled);

        $content = "<div data-dynamic-mod-container class=\"header-buttons-wrapper\">{$content}</div>";
    }


    echo $content;

}, 1);


/*
    template functions
*/


function mesmerize_buttons_list_item_mods_attr($index, $setting)
{
    $item_mods = mesmerize_buttons_list_item_mods($index, $setting);
    $result    = "data-theme='" . esc_attr($item_mods['mod']) . "'";

    foreach ($item_mods['atts'] as $key => $value) {
        $result .= " data-theme-{$key}='" . esc_attr($value) . "'";
    }

    $result .= " data-dynamic-mod='true'";

    return $result;
}

function mesmerize_print_buttons_list($setting, $default = array())
{
    $buttons = get_theme_mod($setting, $default);

    foreach ($buttons as $index => $button) {
        $button = apply_filters('mesmerize_print_buttons_list_button', $button, $setting, $index);

        $title  = $button['label'];
        $url    = $button['url'];
        $target = $button['target'];
        $class  = $button['class'];

        if (empty($title)) {
            $title = __('Action button', 'mesmerize');
        }

        $extraAtts       = apply_filters('mesmerize_button_extra_atts', array(), $button);
        $extraAttsString = "";

        foreach ($extraAtts as $key => $value) {
            $extraAttsString .= " {$key}='" . esc_attr($value) . "'";
        }


        if (is_customize_preview()) {
            $mod_attr   = mesmerize_buttons_list_item_mods_attr($index, $setting);
            $btn_string = '<a class="%4$s" target="%3$s" href="%1$s" ' . $mod_attr . ' ' . $extraAttsString . '>%2$s</a>';
            printf($btn_string, esc_url($url), wp_kses_post($title), esc_attr($target), esc_attr($class));
        } else {
            printf('<a class="%4$s" target="%3$s" href="%1$s" ' . $extraAttsString . '>%2$s</a>', esc_url($url), wp_kses_post($title), esc_attr($target), esc_attr($class));
        }
    }
}

function mesmerize_buttons_list_item_mods($index, $setting)
{
    $result = array(
        "type" => 'data-theme',
        "mod"  => "{$setting}|$index|label",
        "atts" => array(
            "href"   => "{$setting}|{$index}|url",
            "target" => "{$setting}|{$index}|target",
            "class"  => "{$setting}|{$index}|class",
        ),
    );

    $result = apply_filters('mesmerize_buttons_list_item_mods', $result, $setting, $index);

    return $result;
}


function header_content_buttons_buttons_list_filter($button, $setting, $index)
{
    if ($setting === "header_content_buttons") {
        $companion = apply_filters('mesmerize_is_companion_installed', false);

        $hasClass = (isset($button['class']) && trim($button['class']));

        if ($index === 0) {
            $button['class'] = $hasClass ? $button['class'] : 'button big color1 round';
        }

        if ($index === 1) {
            $button['class'] = $hasClass ? $button['class'] : 'button big white round outline';
        }

        if ($index > 1) {
            $button['class'] = $hasClass ? $button['class'] : 'button big';
        }

    }


    return $button;

}

add_filter('mesmerize_print_buttons_list_button', 'header_content_buttons_buttons_list_filter', 10, 3);
