<?php
			
if (!class_exists('cactusTemplater')){
class cactusTemplater {

	public function __construct($atts = NULL)
		{
			add_action( 'wp_ajax_cactus_import_elementor', array(&$this ,'import_elementor'));
			add_action( 'wp_ajax_nopriv_cactus_import_elementor', array(&$this ,'import_elementor'));
			
		}
	
	
	/**
	 * templates list
	 */
	public static function templates(){
		
		$repository_raw_url = 'https://velathemes.com/api/elementor-templates/cactus/';
		$defaults_if_empty  = array(
			'title'            => __( 'Contact', 'cactus-companion' ),
			'screenshot'       => esc_url( $repository_raw_url . 'contact/screenshot.jpg'),
			'description'      => __( 'This is an awesome VelaThemes Template.', 'cactus-companion' ),
			'demo_url'         => esc_url( 'https://velathemes.com/cactus/contact/?hide-header&hide-footer' ),
			'import_file'      => esc_url( $repository_raw_url . 'contact/template.json' ),
			'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
		);

		$templates_list = array(
			
			'about' => array(
				'title'       => __( 'About', 'cactus-companion' ),
				'description' => __( 'Cactus About template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/about/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'about/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'about/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			'contact' => array(
				'title'       => __( 'Contact', 'cactus-companion' ),
				'description' => __( 'Cactus Contact template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/contact/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'contact/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'contact/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ),'contact-form-7' => array( 'title' => __( 'Contact Form 7', 'cactus-companion' ),'file'=>'wp-contact-form-7' ) ),
				'wxr' => array(dirname(__FILE__).'/wxr/contact-form-7.xml'),
			),
			'landing-page-app' => array(
				'title'       => __( 'Landing Page – APP', 'cactus-companion' ),
				'description' => __( 'Cactus Landing Page – APP template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/landing-page-app/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'landing-page-app/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'landing-page-app/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			'landing-page-cafe' => array(
				'title'       => __( 'Landing Page – Cafe', 'cactus-companion' ),
				'description' => __( 'Cactus Landing Page – Cafe template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/landing-page-cafe/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'landing-page-cafe/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'landing-page-cafe/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			'landing-page-personal' => array(
				'title'       => __( 'Landing Page – Personal', 'cactus-companion' ),
				'description' => __( 'Cactus Landing Page – Personal template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/landing-page-personal/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'landing-page-personal/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'landing-page-personal/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ),'contact-form-7' => array( 'title' => __( 'Contact Form 7', 'cactus-companion' ),'file'=>'wp-contact-form-7' ) ),
				'wxr' => array(dirname(__FILE__).'/wxr/contact-form-7.xml'),
			),
			'services' => array(
				'title'       => __( 'Services', 'cactus-companion' ),
				'description' => __( 'Cactus About template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/services/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'services/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'services/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			
			'fashion' => array(
				'title'       => __( 'Landing Page – Fashion', 'cactus-companion' ),
				'description' => __( 'Cactus Fashion template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/landing-page-fashion/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'fashion/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'fashion/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			
			'health' => array(
				'title'       => __( 'Landing Page – Health', 'cactus-companion' ),
				'description' => __( 'Cactus Health template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/landing-page-health/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'health/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'health/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			
			'law' => array(
				'title'       => __( 'Landing Page – Law Firm', 'cactus-companion' ),
				'description' => __( 'Cactus Law Firm template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/landing-page-law-firm/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'law/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'law/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			'pricing' => array(
				'title'       => __( 'Pricing', 'cactus-companion' ),
				'description' => __( 'Cactus Pricing template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/pricing/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'pricing/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'pricing/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			
			'team' => array(
				'title'       => __( 'Team', 'cactus-companion' ),
				'description' => __( 'Cactus Team template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/team/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'team/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'team/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			'business' => array(
				'title'       => __( 'Landing Page – Business', 'cactus-companion' ),
				'description' => __( 'Cactus Business template.', 'cactus-companion' ),
				'demo_url'    => 'https://velathemes.com/cactus/landing-page-business/?hide-header&hide-footer',
				'screenshot'  => esc_url( $repository_raw_url . 'business/screenshot.jpg' ),
				'import_file' => esc_url( $repository_raw_url . 'business/template.json' ),
				'required_plugins' => array( 'elementor' => array( 'title' => __( 'Elementor Page Builder', 'cactus-companion' ) ) ),
			),
			
		);


		return apply_filters( 'cactus_elementor_templates_list', $templates_list );
		
		}
	
	/**
	 * Import wxr
	 */	
	private static function import_wxr($xml_file){
		
		include(dirname(__FILE__).'/wordpress-importer.php');
		if ( file_exists($xml_file) && class_exists( 'Cactus_Import' ) ) {
				$importer = new Cactus_Import();
				$importer->fetch_attachments = false;
				ob_start();
				$importer->import($xml_file);
				ob_end_clean();

				flush_rewrite_rules();
			
		}
		
		
		}

	/**
	 * Render the template directory admin page.
	 */
	public static function render_admin_page() {
		
		$templates_array = cactusTemplater::templates();
		include 'template-directory-tpl.php';
	}
	
	/**
	 * Check plugin state.
	 */
	public static function check_plugin_state( $slug, $file='' ) {
		if($file =='')
			$file = $slug;
		if ( file_exists( WP_CONTENT_DIR . '/plugins/' . $slug . '/' . $file . '.php' ) || file_exists( WP_CONTENT_DIR . '/plugins/' . $slug . '/index.php' ) ) {
			require_once( ABSPATH . 'wp-admin' . '/includes/plugin.php' );
			$needs = ( is_plugin_active( $slug . '/' . $file . '.php' ) ||
			           is_plugin_active( $slug . '/index.php' ) ) ?
				'deactivate' : 'activate';

			return $needs;
		} else {
			return 'install';
		}
	}
	
	/**
	 * Generate action button html.
	 *
	 */
	public static function get_button_html( $slug, $file='' ) {
		$button = '';
		$state  = cactusTemplater::check_plugin_state( $slug, $file );
		if ( ! empty( $slug ) ) {
			switch ( $state ) {
				case 'install':
					$nonce  = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'from'   => 'import',
								'plugin' => $slug,
							),
							network_admin_url( 'update.php' )
						),
						'install-plugin_' . $slug
					);
					$button .= '<a data-slug="' . $slug . '" class="install-now cactus-install-plugin button button-primary" href="' . esc_url( $nonce ) . '" data-name="' . $slug . '" aria-label="Install ' . $slug . '">' . __( 'Install and activate', 'cactus-companion' ) . '</a>';
					break;
				case 'activate':
					$plugin_link_suffix = $slug . '/' . $slug . '.php';
					$nonce              = add_query_arg(
						array(
							'action'   => 'activate',
							'plugin'   => rawurlencode( $plugin_link_suffix ),
							'_wpnonce' => wp_create_nonce( 'activate-plugin_' . $plugin_link_suffix ),
						), network_admin_url( 'plugins.php' )
					);
					$button             .= '<a data-slug="' . $slug . '" class="activate-now button button-primary" href="' . esc_url( $nonce ) . '" aria-label="Activate ' . $slug . '">' . __( 'Activate', 'cactus-companion' ) . '</a>';
					break;
			}// End switch().
		}// End if().
		return $button;
	}
	
	/**
	 * Utility method to call Elementor import routine.
	 */
	public function import_elementor() {
		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			return 'no-elementor';
		}
		$templates_list = cactusTemplater::templates();
		require_once( ABSPATH . 'wp-admin' . '/includes/file.php' );
		require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );
		
		
		$template = $_POST['template_slug'];
		if(isset($templates_list[$template]['wxr']) && is_array($templates_list[$template]['wxr'])){
			foreach($templates_list[$template]['wxr'] as $wxr){
				self::import_wxr($wxr);
				}
			}

		$template                   = download_url( esc_url( $_POST['template_url'] ) );
		$_FILES['file']['tmp_name'] = $template;
		$elementor                  = new Elementor\TemplateLibrary\Source_Local;
		$result = $elementor->import_template();
		unlink( $template );

		if(isset($result->template_id)){
			$template_id = $result->template_id;
			$args = array(
			'post_type' => 'elementor_library',
			'p' => $template_id,
		);

		$query = new WP_Query( $args );
		$template_imported = $query->posts[0];
		
			}else{

		$args = array(
			'post_type'        => 'elementor_library',
			'nopaging'         => true,
			'posts_per_page'   => '1',
			'orderby'          => 'date',
			'order'            => 'DESC',
			'suppress_filters' => true,
		);

		$query = new WP_Query( $args );

		$template_imported = $query->posts[0];
		//get template id
		$template_id = $template_imported->ID;
		}
		wp_reset_query();
		wp_reset_postdata();

		//page content
		$page_content = $template_imported->post_content;
		
		//meta fields
		$elementor_data_meta      = get_post_meta( $template_id, '_elementor_data' );
		$elementor_ver_meta       = get_post_meta( $template_id, '_elementor_version' );
		$elementor_edit_mode_meta = get_post_meta( $template_id, '_elementor_edit_mode' );
		$elementor_css_meta       = get_post_meta( $template_id, '_elementor_css' );

		$elementor_metas = array(
			'_elementor_data'      => ! empty( $elementor_data_meta[0] ) ? wp_slash( $elementor_data_meta[0] ) : '',
			'_elementor_version'   => ! empty( $elementor_ver_meta[0] ) ? $elementor_ver_meta[0] : '',
			'_elementor_edit_mode' => ! empty( $elementor_edit_mode_meta[0] ) ? $elementor_edit_mode_meta[0] : '',
			'_elementor_css'       => $elementor_css_meta,
		);

		// Create post object
		$new_template_page = array(
			'post_type'     => 'page',
			'post_title'    => $_POST['template_name'],
			'post_status'   => 'publish',
			'post_content'  => $page_content,
			'meta_input'    => $elementor_metas,
			'page_template' => apply_filters( 'template_directory_default_template', 'template-fullwidth.php' )
		);

		$current_theme = wp_get_theme();

		$post_id = wp_insert_post( $new_template_page );
		
		

		$redirect_url = add_query_arg( array(
			'post'   => $post_id,
			'action' => 'elementor',
		), admin_url( 'post.php' ) );

		echo @json_encode( array('redirect_url'=>$redirect_url) );

		exit(0);

		//die();
	}

	}
	new cactusTemplater;
}

