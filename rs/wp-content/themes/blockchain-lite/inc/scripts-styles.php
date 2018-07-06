<?php
/**
 * Blockchain_Lite scripts and styles related functions.
 */

/**
 * Register Google Fonts
 */
function blockchain_lite_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'blockchain-lite' ) ) {
		$fonts[] = 'Roboto:400,400i,500,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Register scripts and styles unconditionally.
 */
function blockchain_lite_register_scripts() {
	$theme = wp_get_theme();

	if ( ! wp_script_is( 'alpha-color-picker', 'enqueued' ) && ! wp_script_is( 'alpha-color-picker', 'registered' ) ) {
		wp_register_style( 'alpha-color-picker', get_template_directory_uri() . '/assets/vendor/alpha-color-picker/alpha-color-picker.css', array(
			'wp-color-picker',
		), '1.0.0' );
		wp_register_script( 'alpha-color-picker', get_template_directory_uri() . '/assets/vendor/alpha-color-picker/alpha-color-picker.js', array(
			'jquery',
			'wp-color-picker',
		), '1.0.0', true );
	}

	if ( ! wp_script_is( 'blockchain-lite-plugin-post-meta', 'enqueued' ) && ! wp_script_is( 'blockchain-lite-plugin-post-meta', 'registered' ) ) {
		wp_register_style( 'blockchain-lite-plugin-post-meta', get_template_directory_uri() . '/css/admin/post-meta.css', array(
			'alpha-color-picker',
		), $theme->get( 'Version' ) );
		wp_register_script( 'blockchain-lite-plugin-post-meta', get_template_directory_uri() . '/js/admin/post-meta.js', array(
			'media-editor',
			'jquery',
			'jquery-ui-sortable',
			'alpha-color-picker',
		), $theme->get( 'Version' ), true );

		$settings = array(
			'ajaxurl'             => admin_url( 'admin-ajax.php' ),
			'tSelectFile'         => esc_html__( 'Select file', 'blockchain-lite' ),
			'tSelectFiles'        => esc_html__( 'Select files', 'blockchain-lite' ),
			'tUseThisFile'        => esc_html__( 'Use this file', 'blockchain-lite' ),
			'tUseTheseFiles'      => esc_html__( 'Use these files', 'blockchain-lite' ),
			'tUpdateGallery'      => esc_html__( 'Update gallery', 'blockchain-lite' ),
			'tLoading'            => esc_html__( 'Loading...', 'blockchain-lite' ),
			'tPreviewUnavailable' => esc_html__( 'Gallery preview not available.', 'blockchain-lite' ),
			'tRemoveImage'        => esc_html__( 'Remove image', 'blockchain-lite' ),
			'tRemoveFromGallery'  => esc_html__( 'Remove from gallery', 'blockchain-lite' ),
		);
		wp_localize_script( 'blockchain-lite-plugin-post-meta', 'blockchain_lite_plugin_PostMeta', $settings );
	}

	wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/vendor/fontawesome/css/font-awesome.css', array(), '4.7.0' );

	wp_register_style( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/vendor/magnific-popup/magnific.css', array(), '1.0.0' );
	wp_register_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/vendor/magnific-popup/jquery.magnific-popup.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'blockchain-lite-magnific-init', get_template_directory_uri() . '/js/magnific-init.js', array( 'jquery' ), $theme->get( 'Version' ), true );

	wp_register_style( 'blockchain-lite-google-font', blockchain_lite_fonts_url(), array(), null );
	wp_register_style( 'blockchain-lite-base', get_template_directory_uri() . '/css/base.css', array(), $theme->get( 'Version' ) );
	wp_register_style( 'mmenu', get_template_directory_uri() . '/css/mmenu.css', array(), '5.5.3' );

	wp_register_style( 'blockchain-lite-dependencies', false, array(
		'blockchain-lite-google-font',
		'blockchain-lite-base',
		'mmenu',
		'font-awesome',
	), $theme->get( 'Version' ) );

	if ( is_child_theme() ) {
		wp_register_style( 'blockchain-lite-style-parent', get_template_directory_uri() . '/style.css', array(
			'blockchain-lite-dependencies',
		), $theme->get( 'Version' ) );
	}

	wp_register_style( 'blockchain-lite-style', get_stylesheet_uri(), array(
		'blockchain-lite-dependencies',
	), $theme->get( 'Version' ) );


	wp_register_script( 'mmenu-oncanvas', get_template_directory_uri() . '/js/jquery.mmenu.oncanvas.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-offcanvas', get_template_directory_uri() . '/js/jquery.mmenu.offcanvas.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-autoheight', get_template_directory_uri() . '/js/jquery.mmenu.autoheight.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-backbutton', get_template_directory_uri() . '/js/jquery.mmenu.backbutton.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-navbars', get_template_directory_uri() . '/js/jquery.mmenu.navbars.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-navbar-close', get_template_directory_uri() . '/js/jquery.mmenu.navbar.close.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-navbar-next', get_template_directory_uri() . '/js/jquery.mmenu.navbar.next.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-navbar-prev', get_template_directory_uri() . '/js/jquery.mmenu.navbar.prev.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-navbar-title', get_template_directory_uri() . '/js/jquery.mmenu.navbar.title.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu-toggles', get_template_directory_uri() . '/js/jquery.mmenu.toggles.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'mmenu', false, array(
		'jquery',
		'mmenu-oncanvas',
		'mmenu-offcanvas',
		'mmenu-autoheight',
		'mmenu-backbutton',
		'mmenu-navbars',
		'mmenu-navbar-close',
		'mmenu-navbar-next',
		'mmenu-navbar-prev',
		'mmenu-navbar-title',
	), '5.5.3', true );
	wp_register_script( 'fitVids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );
	wp_register_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array( 'jquery' ), '3.0.2', true );

	wp_register_script( 'blockchain-lite-dependencies', false, array(
		'jquery',
		'mmenu',
		'fitVids',
		'isotope',
	), $theme->get( 'Version' ), true );

	wp_register_script( 'blockchain-lite-front-scripts', get_template_directory_uri() . '/js/scripts.js', array(
		'blockchain-lite-dependencies',
	), $theme->get( 'Version' ), true );

}
add_action( 'init', 'blockchain_lite_register_scripts' );

/**
 * Enqueue scripts and styles.
 */
function blockchain_lite_enqueue_scripts() {
	$theme = wp_get_theme();

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( get_theme_mod( 'theme_lightbox', 1 ) ) {
		wp_enqueue_style( 'jquery-magnific-popup' );
		wp_enqueue_script( 'jquery-magnific-popup' );
		wp_enqueue_script( 'blockchain-lite-magnific-init' );
	}

	if ( is_child_theme() ) {
		wp_enqueue_style( 'blockchain-lite-style-parent' );
	}

	wp_enqueue_style( 'blockchain-lite-style' );
	wp_add_inline_style( 'blockchain-lite-style', blockchain_lite_get_all_customizer_css() );

	wp_enqueue_script( 'blockchain-lite-front-scripts' );

}
add_action( 'wp_enqueue_scripts', 'blockchain_lite_enqueue_scripts' );


/**
 * Enqueue admin scripts and styles.
 */
function blockchain_lite_admin_scripts( $hook ) {
	$theme = wp_get_theme();

	wp_register_style( 'blockchain-lite-widgets', get_template_directory_uri() . '/css/admin/widgets.css', array(
		'blockchain-lite-plugin-post-meta',
		'alpha-color-picker',
	), $theme->get( 'Version' ) );

	wp_register_script( 'blockchain-lite-widgets', get_template_directory_uri() . '/js/admin/widgets.js', array(
		'jquery',
		'blockchain-lite-plugin-post-meta',
		'alpha-color-picker',
	), $theme->get( 'Version' ), true );
	$params = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'blockchain-lite-widgets', 'ThemeWidget', $params );


	//
	// Enqueue
	//
	if ( in_array( $hook, array( 'widgets.php', 'customize.php' ), true ) ) {
		wp_enqueue_media();
		wp_enqueue_style( 'blockchain-lite-widgets' );
		wp_enqueue_script( 'blockchain-lite-widgets' );
	}

}
add_action( 'admin_enqueue_scripts', 'blockchain_lite_admin_scripts' );
