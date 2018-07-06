<?php
/**
 * Blockchain_Lite onboarding related code.
 */
if ( ! defined( 'BLOCKCHAIN_LITE_WHITELABEL' ) || false === (bool) BLOCKCHAIN_LITE_WHITELABEL ) {
	add_filter( 'pt-ocdi/import_files', 'blockchain_lite_ocdi_import_files' );
	add_action( 'pt-ocdi/after_import', 'blockchain_lite_ocdi_after_import_setup' );
}

add_filter( 'pt-ocdi/timeout_for_downloading_import_file', 'blockchain_lite_ocdi_download_timeout' );
function blockchain_lite_ocdi_download_timeout( $timeout ) {
	return 60;
}

function blockchain_lite_ocdi_import_files( $files ) {
	if ( ! defined( 'BLOCKCHAIN_LITE_NAME' ) ) {
		return $files;
	}

	$demo_dir_url = untrailingslashit( apply_filters( 'blockchain_lite_ocdi_demo_dir_url', 'https://www.cssigniter.com/sample_content/' . BLOCKCHAIN_LITE_NAME ) );

	// When having more that one predefined imports, set a preview image, preview URL, and categories for isotope-style filtering.
	$new_files = array(
		array(
			'import_file_name'           => esc_html__( 'Demo Import', 'blockchain-lite' ),
			'import_file_url'            => $demo_dir_url . '/content.xml',
			'import_widget_file_url'     => $demo_dir_url . '/widgets.wie',
			'import_customizer_file_url' => $demo_dir_url . '/customizer.dat',
		),
	);

	return array_merge( $files, $new_files );
}

function blockchain_lite_ocdi_after_import_setup() {
	// Set up nav menus.
	$main_menu = get_term_by( 'name', 'Main', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'menu-1' => $main_menu->term_id,
	) );

	// Set up home and blog pages.
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
}

add_action( 'init', 'blockchain_lite_onboarding_page_init' );
function blockchain_lite_onboarding_page_init() {

	$data = array(
		'show_page'                => true,
		'description'              => __( 'Blockchain Lite is a powerful business theme for WordPress. <strong>WooCommerce</strong> is also supported by Blockchain Lite.', 'blockchain-lite' ),
		'default_tab'              => 'recommended_plugins',
		'tabs'                     => array(
			'recommended_plugins' => __( 'Recommended Plugins', 'blockchain-lite' ),
			'sample_content'      => __( 'Sample Content', 'blockchain-lite' ),
			'support'             => __( 'Support', 'blockchain-lite' ),
			'upgrade_pro'         => __( 'Upgrade to Pro', 'blockchain-lite' ),
		),
		'recommended_plugins_page' => array(
			'plugins' => array(
				'one-click-demo-import' => array(
					'title'       => __( 'One Click Demo Import', 'blockchain-lite' ),
					'description' => __( 'Import your demo content, widgets and theme settings with one click.', 'blockchain-lite' ),
				),
				'elementor'             => array(
					'title'       => __( 'Elementor', 'blockchain-lite' ),
					'description' => __( 'Elementor is a front-end drag & drop page builder for WordPress. ', 'blockchain-lite' ),
				),
				'woocommerce'           => array(
					'title'       => __( 'WooCommerce', 'blockchain-lite' ),
					'description' => __( 'A fully customizable, open source eCommerce platform built for WordPress. ', 'blockchain-lite' ),
				),
			),
		),
		'support_page'             => array(
			'sections' => array(
				'documentation' => array(
					'title'       => __( 'Theme Documentation', 'blockchain-lite' ),
					'description' => __( "If you don't want to import our demo sample content, just visit this page and learn how to set things up individually.", 'blockchain-lite' ),
					'link_url'    => 'https://www.cssigniter.com/docs/' . BLOCKCHAIN_LITE_NAME . '/',
				),
				'kb'            => array(
					'title'       => __( 'Knowledge Base', 'blockchain-lite' ),
					'description' => __( 'Browse our library of step by step how-to articles, tutorials, and guides to get quick answers.', 'blockchain-lite' ),
					'link_url'    => 'https://www.cssigniter.com/docs/knowledgebase/',
				),
				'support'       => array(
					'title'       => __( 'Request Support', 'blockchain-lite' ),
					'description' => __( 'Got stuck? No worries, just visit our support page, submit your ticket and we will be there for you within 24 hours.', 'blockchain-lite' ),
					'link_url'    => 'https://wordpress.org/support/theme/blockchain-lite',
				),
			),
		),
	);

	require_once get_theme_file_path( '/inc/class-onboarding-page-lite.php' );

	$onboarding = new Blockchain_Lite_Onboarding_Page_Lite();
	$onboarding->init( apply_filters( 'blockchain_lite_onboarding_page_array', $data ) );
}

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding/onboarding-page.php' );
