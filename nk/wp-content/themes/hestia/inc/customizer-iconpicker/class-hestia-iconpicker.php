<?php
/**
 * This class allows developers to implement an icon picker control.
 *
 * @package Hestia
 * @since 1.1.74
 * @author      Andrei Baicus <andrei@themeisle.com>
 * @copyright   Copyright (c) 2017, Themeisle
 * @link        http://themeisle.com/
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class Hestia_Iconpicker - icon picker
 *
 * @since  1.1.74
 * @access public
 */
class Hestia_Iconpicker extends WP_Customize_Control {

	/**
	 * Control id
	 *
	 * @var - id
	 */
	public $id;

	/**
	 * Control default value
	 *
	 * @var string - default value.
	 */
	public $customizer_icon_container = '';

	/**
	 * Hestia_Iconpicker constructor
	 *
	 * @param WP_Customize_Manager $manager wp_customize manager.
	 * @param string               $id      control id.
	 * @param array                $args    public parameters.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		$icons = '/inc/customizer-repeater/inc/icons';
		if ( file_exists( trailingslashit( get_template_directory() ) . $icons . '.php' ) ) {
			$this->customizer_icon_container = $icons;
		}
	}

	/**
	 * Enqueue resources for the control
	 */
	public function enqueue() {

		wp_enqueue_style( 'iconpicker-style', get_template_directory_uri() . '/inc/customizer-iconpicker/css/style.css', array( 'font-awesome' ), HESTIA_VERSION );

		wp_enqueue_script( 'iconpicker-script', get_template_directory_uri() . '/inc/customizer-iconpicker/js/iconpicker.js', array( 'jquery' ), HESTIA_VERSION, true );

	}

	/**
	 * Render icon picker control
	 */
	public function render_content() {
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<span class="description customize-control-description">
				<?php
				echo sprintf(
					/* translators: 1. link to font awesome icons */
					esc_html__( 'Note: Some icons may not be displayed here. You can see the full list of icons at %1$s.', 'hestia' ),
					sprintf( '<a href="http://fontawesome.io/icons/" rel="nofollow">%s</a>', esc_html__( 'http://fontawesome.io/icons/', 'hestia' ) )
				);
				?>
			</span>


		<div class="input-group icp-container">
			<input data-placement="bottomRight" class="icp icp-auto"
				value="
				<?php
				if ( ! empty( $this->value() ) ) {
					echo esc_attr( $this->value() );
				}
				?>
				"
				type="text" <?php $this->link(); ?>">
			<span class="input-group-addon">
					<i class="fa <?php echo esc_attr( $this->value() ); ?>"></i>
				</span>
		</div>
		<?php
		get_template_part( $this->customizer_icon_container );

	}
}
