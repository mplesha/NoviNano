<?php

mesmerize_require("inc/variables.php");
mesmerize_require("inc/defaults.php");
mesmerize_require("inc/jetpack.php");

function mesmerize_get_var($name)
{
    global $mesmerize_variables;
    
    return $mesmerize_variables[$name];
}

function mesmerize_wrap_with_single_quote($element)
{
    return "&apos;{$element}&apos;";
}

function mesmerize_wrap_with_double_quotes($element)
{
    return "&quot;{$element}&quot;";
}


function mesmerize_wp_kses_post($text)
{
    // fix the issue with rgb / rgba colors in style atts
    
    $rgbRegex = "#rgb\(((?:\s*\d+\s*,){2}\s*[\d]+)\)#i";
    $text     = preg_replace($rgbRegex, "rgb__$1__rgb", $text);
    
    $rgbaRegex = "#rgba\(((\s*\d+\s*,){3}[\d\.]+)\)#i";
    $text      = preg_replace($rgbaRegex, "rgba__$1__rgb", $text);
    
    
    // fix google fonts
    $fontsOption       = apply_filters('mesmerize_google_fonts', mesmerize_get_general_google_fonts());
    $fonts             = array_keys($fontsOption);
    $singleQuotedFonts = array_map('mesmerize_wrap_with_single_quote', $fonts);
    $doubleQuotedFonts = array_map('mesmerize_wrap_with_double_quotes', $fonts);
    
    
    $text = str_replace($singleQuotedFonts, $fonts, $text);
    $text = str_replace($doubleQuotedFonts, $fonts, $text);
    
    
    $text = wp_kses_post($text);
    
    
    $text = str_replace("rgba__", "rgba(", $text);
    $text = str_replace("rgb__", "rgb(", $text);
    $text = str_replace("__rgb", ")", $text);
    
    return $text;
}

/**
 * wrapper over esc_url with small fixes
 */
function mesmerize_esc_url($url)
{
    $url = str_replace("^", "%5E", $url); // fix ^ in file name before escape
    
    return esc_url($url);
}

function mesmerize_setup()
{
    global $content_width;
    
    if ( ! isset($content_width)) {
        $content_width = 3840; // 4k :) - content width should be adapted from css not hardcoded
    }
    
    load_theme_textdomain('mesmerize', get_template_directory() . '/languages');
    
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    set_post_thumbnail_size(1024, 0, false);
    
    register_default_headers(array(
        'homepage-image' => array(
            'url'           => '%s/assets/images/home_page_header.jpg',
            'thumbnail_url' => '%s/assets/images/home_page_header.jpg',
            'description'   => esc_html__('Homepage Header Image', 'mesmerize'),
        ),
    ));
    
    add_theme_support('custom-header', apply_filters('mesmerize_custom_header_args', array(
        'default-image' => get_template_directory_uri() . "/assets/images/home_page_header.jpg",
        'width'         => 1920,
        'height'        => 800,
        'flex-height'   => true,
        'flex-width'    => true,
        'header-text'   => false,
    )));
    
    add_theme_support('custom-logo', array(
        'flex-height' => true,
        'flex-width'  => true,
        'width'       => 150,
        'height'      => 70,
    ));
    
    add_theme_support('customize-selective-refresh-widgets');
    
    add_image_size('mesmerize-full-hd', 1920, 1080);
    
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'mesmerize'),
    ));
    
    include_once get_template_directory() . '/customizer/kirki/kirki.php';
    
    Kirki::add_config('mesmerize', array(
        'capability'  => 'edit_theme_options',
        'option_type' => 'theme_mod',
    ));
    
    mesmerize_theme_page();
    mesmerize_suggest_plugins();
}

add_action('after_setup_theme', 'mesmerize_setup');


function mesmerize_full_hd_image_size_label($sizes)
{
    return array_merge($sizes, array(
        'mesmerize-full-hd' => __('Full HD', 'mesmerize'),
    ));
}

add_filter('image_size_names_choose', 'mesmerize_full_hd_image_size_label');


function mesmerize_suggest_plugins()
{
    
    
    require_once get_template_directory() . '/inc/companion.php';
    
    /* tgm-plugin-activation */
    require_once get_template_directory() . '/class-tgm-plugin-activation.php';
    
    $plugins = array(
        'mesmerize-companion' => array(
            'title'       => esc_html__('Mesmerize Companion', 'mesmerize'),
            'description' => esc_html__('Mesmerize Companion plugin adds drag and drop functionality and many other features to the Mesmerize theme.', 'mesmerize'),
            'activate'    => array(
                'label' => esc_html__('Activate', 'mesmerize'),
            ),
            'install'     => array(
                'label' => esc_html__('Install', 'mesmerize'),
            ),
        ),
        'contact-form-7'      => array(
            'title'       => esc_html__('Contact Form 7', 'mesmerize'),
            'description' => esc_html__('The Contact Form 7 plugin is recommended for the Mesmerize contact section.', 'mesmerize'),
            'activate'    => array(
                'label' => esc_html__('Activate', 'mesmerize'),
            ),
            'install'     => array(
                'label' => esc_html__('Install', 'mesmerize'),
            ),
        ),
    );
    $plugins = apply_filters('mesmerize_theme_info_plugins', $plugins);
    \Mesmerize\Companion_Plugin::init(array(
        'slug'           => 'mesmerize-companion',
        'activate_label' => esc_html__('Activate Mesmerize Companion', 'mesmerize'),
        'activate_msg'   => esc_html__('This feature requires the Mesmerize Companion plugin to be activated.', 'mesmerize'),
        'install_label'  => esc_html__('Install Mesmerize Companion', 'mesmerize'),
        'install_msg'    => esc_html__('This feature requires the Mesmerize Companion plugin to be installed.', 'mesmerize'),
        'plugins'        => $plugins,
    ));
}


function mesmerize_tgma_suggest_plugins()
{
    $plugins = array(
        array(
            'name'     => 'Mesmerize Companion',
            'slug'     => 'mesmerize-companion',
            'required' => false,
        ),
        
        array(
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => false,
        ),
    );
    
    $plugins = apply_filters('mesmerize_tgmpa_plugins', $plugins);
    
    $config = array(
        'id'           => 'mesmerize',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );
    
    $config = apply_filters('mesmerize_tgmpa_config', $config);
    
    tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'mesmerize_tgma_suggest_plugins');


function mesmerize_can_show_demo_content()
{
    return apply_filters("mesmerize_can_show_demo_content", current_user_can('edit_theme_options'));
}

function mesmerize_get_version()
{
    $theme = wp_get_theme();
    
    if ($theme->get('Template')) {
        $theme = wp_get_theme($theme->get('Template'));
    }
    
    $ver = $theme->get('Version');
    $ver = apply_filters('mesmerize_get_version', $ver);
    
    if ($ver === '@@buildnumber@@') {
        $ver = "99.99." . time();
    }
    
    return $ver;
}

function mesmerize_get_text_domain()
{
    $theme = wp_get_theme();
    
    $textDomain = $theme->get('TextDomain');
    
    if ($theme->get('Template')) {
        $templateData = wp_get_theme($theme->get('Template'));
        $textDomain   = $templateData->get('TextDomain');
    }
    
    return $textDomain;
}

function mesmerize_require($path)
{
    $path = trim($path, "\\/");
    if (file_exists(get_template_directory() . "/{$path}")) {
        require_once get_template_directory() . "/{$path}";
        
    }
}

if ( ! class_exists("Kirki")) {
    include_once get_template_directory() . '/customizer/kirki/kirki.php';
}

mesmerize_require('/inc/templates-functions.php');
mesmerize_require('/inc/theme-options.php');

function mesmerize_add_kirki_field($args)
{
    Kirki::add_field('mesmerize', $args);
}

// SCRIPTS AND STYLES

function mesmerize_enqueue($type = 'style', $handle, $args = array())
{
    $theme = wp_get_theme();
    $ver   = $theme->get('Version');
    $data  = array_merge(array(
        'src'        => '',
        'deps'       => array(),
        'has_min'    => false,
        'in_footer'  => true,
        'media'      => 'all',
        'ver'        => $ver,
        'in_preview' => true,
    ), $args);
    
    if (mesmerize_is_customize_preview() && $data['in_preview'] === false) {
        return;
    }
    
    $isScriptDebug = defined("SCRIPT_DEBUG") && SCRIPT_DEBUG;
    if ($data['has_min'] && ! $isScriptDebug) {
        if ($type === 'style') {
            $data['src'] = str_replace('.css', '.min.css', $data['src']);
        }
        
        if ($type === 'script') {
            $data['src'] = str_replace('.js', '.min.js', $data['src']);
        }
    }
    
    if ($type == 'style') {
        wp_enqueue_style($handle, $data['src'], $data['deps'], $data['ver'], $data['media']);
    }
    
    if ($type == 'script') {
        wp_enqueue_script($handle, $data['src'], $data['deps'], $data['ver'], $data['in_footer']);
    }
    
}

function mesmerize_enqueue_style($handle, $args)
{
    mesmerize_enqueue('style', $handle, $args);
}

function mesmerize_enqueue_script($handle, $args)
{
    mesmerize_enqueue('script', $handle, $args);
}

function mesmerize_associative_array_splice($oldArray, $offset, $key, $data)
{
    $newArray = array_slice($oldArray, 0, $offset, true) +
                array($key => $data) +
                array_slice($oldArray, $offset, null, true);
    
    return $newArray;
}


function mesmerize_do_enqueue_assets()
{
    
    $theme        = wp_get_theme();
    $ver          = $theme->get('Version');
    $isChildTheme = $theme->get('Template');
    $textDomain   = mesmerize_get_text_domain();
    
    mesmerize_enqueue_style(
        $textDomain . '-style',
        array(
            'src'     => get_stylesheet_uri(),
            'has_min' => ! $isChildTheme,
        )
    );
    
    mesmerize_enqueue_style(
        $textDomain . '-font-awesome',
        array(
            'src' => get_template_directory_uri() . '/assets/font-awesome/font-awesome.min.css',
        )
    );
    
    mesmerize_enqueue_style(
        'animate',
        array(
            'src'     => get_template_directory_uri() . '/assets/css/animate.css',
            'has_min' => true,
        )
    );
    
    mesmerize_enqueue_script(
        $textDomain . '-smoothscroll',
        array(
            'src'     => get_template_directory_uri() . '/assets/js/smoothscroll.js',
            'deps'    => array('jquery', 'jquery-effects-core'),
            'has_min' => true,
        )
    );
    
    mesmerize_enqueue_script(
        $textDomain . '-ddmenu',
        array(
            'src'     => get_template_directory_uri() . '/assets/js/drop_menu_selection.js',
            'deps'    => array('jquery-effects-slide', 'jquery'),
            'has_min' => true,
        )
    );
    
    mesmerize_enqueue_script(
        'kube',
        array(
            'src'     => get_template_directory_uri() . '/assets/js/kube.js',
            'deps'    => array('jquery'),
            'has_min' => true,
        )
    );
    
    mesmerize_enqueue_script(
        $textDomain . '-fixto',
        array(
            'src'     => get_template_directory_uri() . '/assets/js/libs/fixto.js',
            'deps'    => array('jquery'),
            'has_min' => true,
        )
    );
    
    wp_enqueue_script($textDomain . '-sticky', get_template_directory_uri() . '/assets/js/sticky.js', array($textDomain . '-fixto'), $ver, true);
    
    
    wp_enqueue_script('masonry');
    wp_enqueue_script('comment-reply');
    
    $theme_deps = apply_filters("mesmerize_theme_deps", array('jquery'));
    wp_enqueue_script($textDomain . '-theme', get_template_directory_uri() . '/assets/js/theme.js', $theme_deps, $ver, true);
    
    $maxheight = intval(get_theme_mod('logo_max_height', 70));
    wp_add_inline_style($textDomain . '-style', sprintf('img.logo.dark, img.custom-logo{width:auto;max-height:%1$s;}', $maxheight . "px"));
    
    mesmerize_enqueue_style(
        $textDomain . '-webgradients',
        array(
            'src'     => get_template_directory_uri() . '/assets/css/webgradients.css',
            'has_min' => true,
        )
    );
}

add_action('wp_enqueue_scripts', 'mesmerize_do_enqueue_assets');


add_action('customize_controls_enqueue_scripts', function () {
    
    $theme = wp_get_theme();
    $ver   = $theme->get('Version');
    
    wp_enqueue_style('mesmerize-customizer-spectrum', get_template_directory_uri() . '/customizer/libs/spectrum.css', array(), $ver);
    wp_enqueue_script('mesmerize-customizer-spectrum', get_template_directory_uri() . '/customizer/libs/spectrum.js', array(), $ver, true);
});

function mesmerize_get_general_google_fonts()
{
    return array(
        array(
            'family'  => 'Open Sans',
            "weights" => array("300", "400", "600", "700"),
        ),
        
        array(
            'family'  => 'Muli',
            "weights" => array("300", "300italic", "400", "400italic", "600", "600italic", "700", "700italic", "900", "900italic",),
        ),
        array(
            'family'  => 'Playfair Display',
            "weights" => array("400", "400italic", "700", "700italic"),
        ),
    );
}

function mesmerize_do_enqueue_google_fonts()
{
    $gFonts = mesmerize_get_general_google_fonts();
    
    $fonts = array();
    
    foreach ($gFonts as $font) {
        $fonts[$font['family']] = $font;
    }
    
    $gFonts = apply_filters("mesmerize_google_fonts", $fonts);
    
    $fontQuery = array();
    foreach ($gFonts as $family => $font) {
        $fontQuery[] = $family . ":" . implode(',', $font['weights']);
    }
    
    $query_args = array(
        'family' => urlencode(implode('|', $fontQuery)),
        'subset' => urlencode('latin,latin-ext'),
    );
    
    
    $fontsURL = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    wp_enqueue_style('mesmerize-fonts', $fontsURL, array(), null);
}

add_action('wp_enqueue_scripts', 'mesmerize_do_enqueue_google_fonts');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function mesmerize_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'mesmerize_pingback_header');


/**
 * Register sidebar
 */
function mesmerize_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar widget area', 'mesmerize'),
        'id'            => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widgettitle">',
        'after_title'   => '</h5>',
    ));
    
    register_sidebar(array(
        'name'          => 'Pages Sidebar',
        'id'            => "mesmerize_pages_sidebar",
        'title'         => "Pages Sidebar",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__("Footer First Box Widgets", 'mesmerize'),
        'id'            => "first_box_widgets",
        'title'         => esc_html__("Widget Area", 'mesmerize'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__("Footer Second Box Widgets", 'mesmerize'),
        'id'            => "second_box_widgets",
        'title'         => esc_html__("Widget Area", 'mesmerize'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__("Footer Third Box Widgets", 'mesmerize'),
        'id'            => "third_box_widgets",
        'title'         => esc_html__("Widget Area", 'mesmerize'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
}

add_action('widgets_init', 'mesmerize_widgets_init');

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Read more' link.
 *
 * @return string '... Read more'
 */
function mesmerize_excerpt_more($link)
{
    if (is_admin()) {
        return $link;
    }
    
    return '&hellip; <br> <a class="read-more" href="' . esc_url(get_permalink(get_the_ID())) . '">' . mesmerize_wp_kses_post(__('Read more', 'mesmerize')) . '</a>';
}

add_filter('excerpt_more', 'mesmerize_excerpt_more');


// UTILS


function mesmerize_nomenu_fallback($walker = '')
{
    $drop_down_menu_classes      = apply_filters('mesmerize_primary_drop_menu_classes', array('default'));
    $drop_down_menu_classes      = array_merge($drop_down_menu_classes, array('main-menu', 'dropdown-menu'));
    $drop_down_menu_main_classes = array_merge($drop_down_menu_classes, array('row'));
    
    return wp_page_menu(array(
        "menu_class" => esc_attr(implode(" ", $drop_down_menu_main_classes)),
        "menu_id"    => 'mainmenu_container',
        'before'     => '<ul id="main_menu" class="' . esc_attr(implode(" ", $drop_down_menu_classes)) . '">',
        'after'      => apply_filters('mesmerize_nomenu_after', '') . "</ul>",
        'walker'     => $walker,
    ));
}


function mesmerize_nomenu_cb()
{
    return mesmerize_nomenu_fallback('');
}


function mesmerize_no_hamburdegr_menu_cb()
{
    return wp_page_menu(array(
        "menu_class" => 'offcanvas_menu',
        "menu_id"    => 'offcanvas_menu',
        'before'     => '<ul id="offcanvas_menu" class="offcanvas_menu">',
        'after'      => apply_filters('mesmerize_nomenu_after', '') . "</ul>",
    ));
}

function mesmerize_title()
{
    $title = '';
    
    if (is_404()) {
        $title = __('Page not found', 'mesmerize');
    } elseif (is_search()) {
        $title = sprintf(__('Search Results for &#8220;%s&#8221;', 'mesmerize'), get_search_query());
    } elseif (is_home()) {
        if (is_front_page()) {
            $title = get_bloginfo('name');
        } else {
            $title = single_post_title();
        }
    } elseif (is_archive()) {
        if (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } else {
            $title = get_the_archive_title();
        }
    } elseif (is_single()) {
        $title = get_bloginfo('name');
        
        global $post;
        if ($post) {
            // apply core filter
            $title = apply_filters('single_post_title', $post->post_title, $post);
        }
    } else {
        $title = get_the_title();
    }
    
    $value = apply_filters('mesmerize_header_title', mesmerize_wp_kses_post($title));
    
    return $value;
}

function mesmerize_bold_text($str)
{
    $bold = get_theme_mod('bold_logo', true);
    
    if ( ! $bold) {
        return $str;
    }
    
    $str   = trim($str);
    $words = preg_split("/(?<=[a-z])(?=[A-Z])|(?=[\s]+)/x", $str);
    
    $result = "";
    $c      = 0;
    for ($i = 0; $i < count($words); $i++) {
        $word = $words[$i];
        if (preg_match("/^\s*$/", $word)) {
            $result .= $words[$i];
        } else {
            $c++;
            if ($c % 2) {
                $result .= $words[$i];
            } else {
                $result .= '<span style="font-weight: 300;" class="span12">' . esc_html($words[$i]) . "</span>";
            }
        }
    }
    
    return $result;
}


function mesmerize_sanitize_checkbox($val)
{
    return (isset($val) && $val == true ? true : false);
}

function mesmerize_sanitize_textfield($val)
{
    return wp_kses_post(force_balance_tags($val));
}

if ( ! function_exists('mesmerize_post_type_is')) {
    function mesmerize_post_type_is($type)
    {
        global $wp_query;
        
        $post_type = $wp_query->query_vars['post_type'] ? $wp_query->query_vars['post_type'] : 'post';
        
        if ( ! is_array($type)) {
            
            
            $type = array($type);
        }
        
        return in_array($post_type, $type);
    }
}

//////////////////////////////////////////////////////////////////////////////////////


function mesmerize_footer_container($class)
{
    $attrs = array(
        'class' => "footer " . $class . " ",
    );
    
    $result = "";
    
    $attrs = apply_filters('mesmerize_footer_container_atts', $attrs);
    
    foreach ($attrs as $key => $value) {
        $value  = esc_attr(trim($value));
        $key    = esc_attr($key);
        $result .= " {$key}='{$value}'";
    }
    
    return $result;
}

function mesmerize_footer_background($footer_class)
{
    $attrs = array(
        'class' => $footer_class . " ",
    );
    
    $result = "";
    
    $attrs = apply_filters('mesmerize_footer_background_atts', $attrs);
    
    foreach ($attrs as $key => $value) {
        $value  = esc_attr(trim($value));
        $key    = esc_attr($key);
        $result .= " {$key}='{$value}'";
    }
    
    return $result;
}

// THEME PAGE
function mesmerize_theme_page()
{
    add_action('admin_menu', 'mesmerize_register_theme_page');
}

function mesmerize_load_theme_partial()
{
    require_once get_template_directory() . '/inc/companion.php';
    require_once get_template_directory() . "/inc/theme-info.php";
    wp_enqueue_style('mesmerize-theme-info', get_template_directory_uri() . "/assets/css/theme-info.css");
    wp_enqueue_script('mesmerize-theme-info', get_template_directory_uri() . "/assets/js/theme-info.js", array('jquery'), '', true);
}

function mesmerize_register_theme_page()
{
    add_theme_page(__('Mesmerize Info', 'mesmerize'), __('Mesmerize Info', 'mesmerize'), 'activate_plugins', 'mesmerize-welcome', 'mesmerize_load_theme_partial');
}


function mesmerize_instantiate_widget($widget, $args = array())
{
    
    ob_start();
    the_widget($widget, array(), $args);
    $content = ob_get_contents();
    ob_end_clean();
    
    if (isset($args['wrap_tag'])) {
        $tag     = $args['wrap_tag'];
        $class   = isset($args['wrap_class']) ? $args['wrap_class'] : "";
        $content = "<{$tag} class='{$class}'>{$content}</{$tag}>";
    }
    
    return $content;
    
}

// load support for woocommerce
if (class_exists('WooCommerce')) {
    require_once get_template_directory() . "/inc/woocommerce/woocommerce.php";
} else {
    require_once get_template_directory() . "/inc/woocommerce/woocommerce-ready.php";
}
mesmerize_require("/inc/integrations/index.php");
