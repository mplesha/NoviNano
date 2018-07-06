<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// This file is pretty much a boilerplate WordPress plugin.
// It does very little except including wp-widget.php
if(!class_exists('ElementorCustomElement')){
class ElementorCustomElement {

   private static $instance = null;

   public static function get_instance() {
      if ( ! self::$instance )
         self::$instance = new self;
      return self::$instance;
   }

   public function init(){
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
   }

   public function widgets_registered() {

      // We check if the Elementor plugin has been installed / activated.
      if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

         // We look for any theme overrides for this custom Elementor element.
         // If no theme overrides are found we use the default one in this plugin.
		
			foreach (glob(dirname(__FILE__)."/widgets/*.php") as $filename) {

				$template_file = $filename;
				
				 if ( $template_file && is_readable( $template_file ) ) {
            		require_once $template_file;
         		}
			}
        
      }
   }
}
}

ElementorCustomElement::get_instance()->init();