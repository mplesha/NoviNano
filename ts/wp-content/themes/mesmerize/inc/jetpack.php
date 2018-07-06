<?php

add_action('jetpack_module_loaded_minileven',function(){
    if(class_exists('Jetpack')){
        Jetpack::deactivate_module('minileven');
    }
});

do_action('jetpack_module_loaded_minileven');


add_filter('jetpack_get_module', function ($mod, $module, $file) {

    if (strpos($file, "minileven.php") !== false) {
        return false;
    }

    return $mod;

}, 10, 3);
