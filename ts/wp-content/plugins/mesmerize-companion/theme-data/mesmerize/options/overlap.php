<?php


add_action("mesmerize_header_background_overlay_settings", "mesmerize_front_page_header_overlap_options", 5, 5);

function mesmerize_front_page_header_overlap_options($section, $prefix, $group, $inner, $priority)
{
    if ($inner) {
        return;
    }
    $priority = 5;
    $prefix   = "header";
    $section  = "header_background_chooser";
    $group    = "";

    mesmerize_add_kirki_field(array(
        'type'     => 'checkbox',
        'settings' => 'header_overlap',
        'label'    => esc_html__('Allow content to overlap header', 'mesmerize'),
        'default'  => true,
        'section'  => $section,
        'priority' => $priority,
        'group'    => $group,
        'active_callback' => apply_filters('mesmerize_header_active_callback_filter', array(), $inner),
    ));

    mesmerize_add_kirki_field(array(
        'type'            => 'dimension',
        'settings'        => 'header_overlap_with',
        'label'           => esc_html__('Overlap with', 'mesmerize'),
        'default'         => '95px',
        'active_callback' => apply_filters('mesmerize_header_active_callback_filter',
            array(
                array(
                    "setting"  => "header_overlap",
                    "operator" => "==",
                    "value"    => true,
                ),
            ),
            $inner, 'simple'
        ),
        'section'         => $section,
        'priority'        => $priority,
        'group'           => $group,
    ));
}


add_action('wp_head', function () {
    $margin      = get_theme_mod('header_overlap_with', '95px');
    $overlap_mod = get_theme_mod('header_overlap', true);
    if (1 == intval($overlap_mod)): ?>
        <style data-name="overlap">
            @media only screen and (min-width: 768px) {
                .mesmerize-front-page:not(.mesmerize-front-page-with-slider) .header-homepage {
                    padding-bottom: <?php echo  esc_attr($margin); ?>;
                }

                .mesmerize-front-page:not(.mesmerize-front-page-with-slider) .content {
                    position: relative;
                    z-index: 10;
                }

                .mesmerize-front-page:not(.mesmerize-front-page-with-slider) .page-content div[data-overlap]:first-of-type > div:first-of-type {
                    margin-top: -<?php echo  esc_attr($margin); ?>;
                    background: transparent !important;
                    position: relative;
                }

                .page-template:not(.mesmerize-front-page-with-slider) [data-overlap="true"] {
                    padding-top: 0;
                }
            }
        </style>
        <?php
    endif;
});
