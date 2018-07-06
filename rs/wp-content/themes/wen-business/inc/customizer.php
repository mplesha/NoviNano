<?php
/**
 * Theme Customizer.
 *
 * @package WEN_Business
 */

/**
 * Add partial refresh support for site title and description.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_business_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
        return;
    }

    // Load customizer partials callback.
    require get_template_directory() . '/inc/customizer/partials.php';

    // Partial blogname.
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.site-title a',
		'container_inclusive' => false,
		'render_callback'     => 'wen_business_customize_partial_blogname',
    ) );

    // Partial blogdescription.
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'            => '.site-description',
		'container_inclusive' => false,
		'render_callback'     => 'wen_business_customize_partial_blogdescription',
    ) );

}
add_action( 'customize_register', 'wen_business_customize_register' );

/**
 * Load styles for Customizer.
 */
function wen_business_load_customizer_styles() {

	global $pagenow;

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( 'customize.php' === $pagenow ) {
		wp_enqueue_style( 'wen-business-customizer-style', get_template_directory_uri() . '/assets/css/customizer' . $min . '.css', false, '1.4.1' );
	}

}

add_action( 'admin_enqueue_scripts', 'wen_business_load_customizer_styles' );

/**
 * Customizer control scripts and styles.
 *
 * @since 1.5.0
 */
function wen_business_customizer_control_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'wen-business-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls' . $min . '.js', array( 'customize-controls' ) );

	wp_enqueue_style( 'wen-business-customize-controls', get_template_directory_uri() . '/assets/css/customize-controls' . $min . '.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'wen_business_customizer_control_scripts', 0 );

/**
 * Add custom sections.
 *
 * @since 1.5.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wen_business_customize_custom_sections( $wp_customize ) {

	if ( ! class_exists( 'WP_Customize_Section' ) ) {
		return;
	}

	/**
	 * Upsell customizer section.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class WEN_Business_Customize_Section_Upsell extends WP_Customize_Section {

		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'upsell';

		/**
		 * Custom button text to output.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $pro_text = '';

		/**
		 * Custom pro button URL.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $pro_url = '';

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function json() {
			$json = parent::json();

			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );

			return $json;
		}

		/**
		 * Outputs the Underscore.js template.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		protected function render_template() { ?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

				<h3 class="accordion-section-title">
					{{ data.title }}

					<# if ( data.pro_text && data.pro_url ) { #>
						<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
					<# } #>
				</h3>
			</li>
		<?php }
	}

	// Register custom section types.
	$wp_customize->register_section_type( 'WEN_Business_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new WEN_Business_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'WEN Business Pro', 'wen-business' ),
				'pro_text' => esc_html__( 'Buy Pro', 'wen-business' ),
				'pro_url'  => 'https://catchthemes.com/themes/wen-business-pro/',
				'priority' => 1,
			)
		)
	);

}

add_action( 'customize_register', 'wen_business_customize_custom_sections', 99 );
