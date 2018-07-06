<?php
/**
 * Standard Customizer Sections and Settings
 */

function blockchain_lite_customize_register( $wp_customize ) {

	// Register custom section types.
	$wp_customize->register_section_type( 'Blockchain_Lite_Customize_Section_Pro' );

	// Register sections.
	$wp_customize->add_section( new Blockchain_Lite_Customize_Section_Pro(
		$wp_customize,
		'theme_go_pro',
		array(
			'priority' => 1,
			'title'    => esc_html__( 'Blockchain Pro', 'blockchain-lite' ),
			'pro_text' => esc_html__( 'Go Pro', 'blockchain-lite' ),
			'pro_url'  => 'https://www.cssigniter.com/themes/blockchain/',
		)
	) );


	// Partial for various settings that affect the customizer styles, but can't have a dedicated icon, e.g. 'limit_logo_size'
	$wp_customize->selective_refresh->add_partial( 'theme_style', array(
		'selector'            => '#blockchain-lite-style-inline-css',
		'render_callback'     => 'blockchain_lite_get_all_customizer_css',
		'settings'            => array(),
		'container_inclusive' => false,
	) );


	//
	// Header
	//
	if ( apply_filters( 'blockchain_lite_customizable_header', true ) ) {
		$wp_customize->add_panel( 'theme_header', array(
			'title'    => esc_html_x( 'Header', 'customizer section title', 'blockchain-lite' ),
			'priority' => 10, // Before site_identity, 20
		) );

		$wp_customize->add_section( 'theme_header_style', array(
			'title'    => esc_html_x( 'Header style', 'customizer section title', 'blockchain-lite' ),
			'panel'    => 'theme_header',
			'priority' => 10,
		) );
		require_once get_theme_file_path( 'inc/customizer/theme-header-style.php' );

		$wp_customize->add_section( 'theme_header_top_bar', array(
			'title'    => esc_html_x( 'Top menu bar', 'customizer section title', 'blockchain-lite' ),
			'panel'    => 'theme_header',
			'priority' => 20,
		) );
		require_once get_theme_file_path( 'inc/customizer/theme-header-top-bar.php' );

		$wp_customize->add_section( 'theme_header_primary_menu', array(
			'title'    => esc_html_x( 'Primary menu bar', 'customizer section title', 'blockchain-lite' ),
			'panel'    => 'theme_header',
			'priority' => 30,
		) );
		require_once get_theme_file_path( 'inc/customizer/theme-header-primary-menu.php' );
	} // filter blockchain_lite_customizable_header


	//
	// Blog
	//
	$wp_customize->add_panel( 'theme_blog', array(
		'title'    => esc_html_x( 'Blog settings', 'customizer section title', 'blockchain-lite' ),
		'priority' => 30, // After site_identity, 20
	) );

	$wp_customize->add_section( 'theme_archive_options', array(
		'title'       => esc_html_x( 'Archive options', 'customizer section title', 'blockchain-lite' ),
		'panel'       => 'theme_blog',
		'description' => esc_html__( 'Customize the default archive pages, such as the blog, category, tag, date archives, etc.', 'blockchain-lite' ),
		'priority'    => 10,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-archive-options.php' );

	$wp_customize->add_section( 'theme_post_options', array(
		'title'    => esc_html_x( 'Post options', 'customizer section title', 'blockchain-lite' ),
		'panel'    => 'theme_blog',
		'priority' => 20,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-post-options.php' );


	//
	// Colors
	//
	$wp_customize->add_panel( 'theme_colors', array(
		'title'    => esc_html_x( 'Colors', 'customizer section title', 'blockchain-lite' ),
		'priority' => 30,
	) );

	if ( apply_filters( 'blockchain_lite_customizable_header', true ) ) {
		$wp_customize->add_section( 'theme_colors_header_top_bar', array(
			'title'    => esc_html_x( 'Header top bar', 'customizer section title', 'blockchain-lite' ),
			'panel'    => 'theme_colors',
			'priority' => 10,
		) );
		require_once get_theme_file_path( 'inc/customizer/theme-colors-header-top-bar.php' );
	} // filter blockchain_lite_customizable_header

	if ( get_theme_support( 'blockchain-lite-hero' ) ) {
		$wp_customize->add_section( 'theme_colors_hero', array(
			'title'    => esc_html_x( 'Hero', 'customizer section title', 'blockchain-lite' ),
			'panel'    => 'theme_colors',
			'priority' => 30,
		) );
		require_once get_theme_file_path( 'inc/customizer/theme-colors-hero.php' );
	}

	$wp_customize->add_section( 'theme_colors_global', array(
		'title'    => esc_html_x( 'Global', 'customizer section title', 'blockchain-lite' ),
		'panel'    => 'theme_colors',
		'priority' => 40,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-colors-global.php' );

	$wp_customize->add_section( 'theme_colors_sidebar', array(
		'title'    => esc_html_x( 'Sidebar', 'customizer section title', 'blockchain-lite' ),
		'panel'    => 'theme_colors',
		'priority' => 50,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-colors-sidebar.php' );

	if ( apply_filters( 'blockchain_lite_customizable_footer', true ) ) {
		$wp_customize->add_section( 'theme_colors_footer', array(
			'title'    => esc_html_x( 'Footer', 'customizer section title', 'blockchain-lite' ),
			'panel'    => 'theme_colors',
			'priority' => 60,
		) );
		require_once get_theme_file_path( 'inc/customizer/theme-colors-footer.php' );
	} // filter blockchain_lite_customizable_footer


	//
	// Typography
	//
	$wp_customize->add_panel( 'theme_typography', array(
		'title'    => esc_html_x( 'Typography', 'customizer section title', 'blockchain-lite' ),
		'priority' => 70,
	) );

	$wp_customize->add_section( 'theme_typography_content', array(
		'title'    => esc_html_x( 'Content', 'customizer section title', 'blockchain-lite' ),
		'panel'    => 'theme_typography',
		'priority' => 10,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-typography-content.php' );

	$wp_customize->add_section( 'theme_typography_widgets', array(
		'title'    => esc_html_x( 'Widgets', 'customizer section title', 'blockchain-lite' ),
		'panel'    => 'theme_typography',
		'priority' => 20,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-typography-widgets.php' );


	//
	// Social
	//
	$wp_customize->add_section( 'theme_social', array(
		'title'       => esc_html_x( 'Social Networks', 'customizer section title', 'blockchain-lite' ),
		'description' => esc_html__( 'Enter your social network URLs. Leaving a URL empty will hide its respective icon.', 'blockchain-lite' ),
		'priority'    => 80,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-social.php' );


	//
	// Footer
	//
	if ( apply_filters( 'blockchain_lite_customizable_footer', true ) ) {
		$wp_customize->add_panel( 'theme_footer', array(
			'title'    => esc_html_x( 'Footer', 'customizer section title', 'blockchain-lite' ),
			'priority' => 90,
		) );

		$wp_customize->add_section( 'theme_footer_style', array(
			'title'    => esc_html_x( 'Footer style', 'customizer section title', 'blockchain-lite' ),
			'panel'    => 'theme_footer',
			'priority' => 10,
		) );
		require_once get_theme_file_path( 'inc/customizer/theme-footer-style.php' );

		$wp_customize->add_section( 'theme_footer_bottom_bar', array(
			'title'    => esc_html_x( 'Bottom bar', 'customizer section title', 'blockchain-lite' ),
			'panel'    => 'theme_footer',
			'priority' => 20,
		) );
		require_once get_theme_file_path( 'inc/customizer/theme-footer-bottom-bar.php' );
	} // filter blockchain_lite_customizable_footer


	//
	// Titles
	//
	$wp_customize->add_panel( 'theme_titles', array(
		'title'    => esc_html_x( 'Titles', 'customizer section title', 'blockchain-lite' ),
		'priority' => 100,
	) );

	$wp_customize->add_section( 'theme_titles_general', array(
		'title'    => esc_html_x( 'General', 'customizer section title', 'blockchain-lite' ),
		'panel'    => 'theme_titles',
		'priority' => 10,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-titles-general.php' );

	$wp_customize->add_section( 'theme_titles_post', array(
		'title'    => esc_html_x( 'Posts', 'customizer section title', 'blockchain-lite' ),
		'panel'    => 'theme_titles',
		'priority' => 20,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-titles-post.php' );


	//
	// Other
	//
	$wp_customize->add_panel( 'theme_other', array(
		'title'                    => esc_html_x( 'Other', 'customizer section title', 'blockchain-lite' ),
		'description'              => esc_html__( 'Other options affecting the whole site.', 'blockchain-lite' ),
		'auto_expand_sole_section' => true,
		'priority'                 => 110,
	) );

	$wp_customize->add_section( 'theme_other_sample_content', array(
		'title'    => esc_html_x( 'Sample Content', 'customizer section title', 'blockchain-lite' ),
		'panel'    => 'theme_other',
		'priority' => 10,
	) );
	require_once get_theme_file_path( 'inc/customizer/theme-other-sample-content.php' );


	//
	// Site identity
	//
	require_once get_theme_file_path( 'inc/customizer/site-identity.php' );

}
add_action( 'customize_register', 'blockchain_lite_customize_register' );



add_action( 'customize_register', 'blockchain_lite_customize_register_custom_controls', 9 );
/**
 * Registers custom Customizer controls.
 *
 * @param WP_Customize_Manager $wp_customize Reference to the customizer's manager object.
 */
function blockchain_lite_customize_register_custom_controls( $wp_customize ) {
	require get_template_directory() . '/inc/customizer-controls/static-text/static-text.php';
	require get_template_directory() . '/inc/customizer-controls/alpha-color-picker/alpha-color-picker.php';
	require get_template_directory() . '/inc/customizer-controls/section-pro/section-pro.php';
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blockchain_lite_customize_preview_js() {
	$theme = wp_get_theme();

	wp_enqueue_script( 'blockchain-lite-customizer-preview', get_template_directory_uri() . '/js/admin/customizer-preview.js', array( 'customize-preview' ), $theme->get( 'Version' ), true );
	wp_enqueue_style( 'blockchain-lite-customizer-preview', get_template_directory_uri() . '/css/admin/customizer-preview.css', array( 'customize-preview' ), $theme->get( 'Version' ) );
}
add_action( 'customize_preview_init', 'blockchain_lite_customize_preview_js' );

function blockchain_lite_customize_controls_js() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'alpha-color-picker-customizer', get_template_directory_uri() . '/inc/customizer-controls/alpha-color-picker/alpha-color-picker.css', array(
		'wp-color-picker',
	), '1.0.0' );
	wp_enqueue_script( 'alpha-color-picker-customizer', get_template_directory_uri() . '/inc/customizer-controls/alpha-color-picker/alpha-color-picker.js', array(
		'jquery',
		'wp-color-picker',
	), '1.0.0', true );

	wp_enqueue_script( 'blockchain-lite-customizer-section-pro', get_template_directory_uri() . '/inc/customizer-controls/section-pro/customize-controls.js', array( 'customize-controls' ), $theme->get( 'Version' ), true );
	wp_enqueue_style( 'blockchain-lite-customizer-section-pro', get_template_directory_uri() . '/inc/customizer-controls/section-pro/customize-controls.css', $theme->get( 'Version' ) );

	wp_enqueue_script( 'blockchain-lite-customizer-controls', get_template_directory_uri() . '/js/admin/customizer-controls.js', array(), $theme->get( 'Version' ), true );

}
add_action( 'customize_controls_enqueue_scripts', 'blockchain_lite_customize_controls_js' );
