<?php

if ( ! defined('ABSPATH')) {
    die('Silence is golden');
}


function mesmerize_get_integration_modules()
{
    $integrationModules = wp_cache_get('mesmerize_integration_modules');

    if ( ! $integrationModules) {
        $integrationModules = apply_filters('mesmerize_integration_modules', array());
        wp_cache_set('mesmerize_integration_modules', $integrationModules);
    }

    return $integrationModules;
}

function mesmerize_load_integration_modules()
{
    $modules            = mesmerize_get_integration_modules();
    $normmalizedABSPATH = wp_normalize_path(ABSPATH);

    foreach ($modules as $module) {

        $module = wp_normalize_path($module);

        if (strpos($module, $normmalizedABSPATH) !== 0) {
            mesmerize_require("{$module}/index.php");
        } else {
            if (file_exists("{$module}/index.php")) {
                require "{$module}/index.php";
            }
        }

    }
}

add_action('after_setup_theme', 'mesmerize_load_integration_modules', 2);
