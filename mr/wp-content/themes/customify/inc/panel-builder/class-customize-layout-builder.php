<?php

/**
 * Add Panel Builder to WP Customize
 *
 * Class Customify_Customize_Layout_Builder
 */
class Customify_Customize_Layout_Builder {
    static $_instance;
    private $registered_items = array();
    private $registered_builders = array();

    /**
     * Initial
     */
    function init() {

        do_action( 'customify/customize-builder/init' );

        if ( is_admin() ) {
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'scripts' ) );
            add_action( 'customize_controls_print_footer_scripts', array( $this, 'template' ) );
            add_action( 'wp_ajax_customify_builder_save_template', array( $this, 'ajax_save_template' ) );
            add_action( 'wp_ajax_customify_builder_export_template', array( $this, 'ajax_export_template' ) );
        }

    }

    /**
     * Register builder panel
     *
     * @see Customify_Customize_Builder_Panel
     *
     * @param $id string                                ID of panel
     * @param $class Customify_Customize_Builder_Panel  Panel class name
     * @return bool
     */
    function register_builder( $id, $class ) {
        if ( ! isset( $id ) ) {
            return false;
        }

        if ( ! is_object( $class ) ) {
            if ( ! class_exists( $class ) ) {
                return false;
            }

            $class = new $class();
        }

        if ( ! $class instanceof Customify_Customize_Builder_Panel ) {
            $name = get_class( $class );
            _doing_it_wrong( $name, sprintf( __( 'Class <strong>%s</strong> do not extends class <strong>Customify_Customize_Builder_Panel</strong>.', 'customify' ), $name ), '1.0.0' );
            return false;
        }

        add_filter( 'customify/customizer/config', array( $class, '_customize' ), 35, 2 );
        $this->registered_builders[ $id ] = $class;
    }


    /**
     * Add an item builder to panel
     *
     * @see Customify_Customize_Layout_Builder::register_builder();
     *
     * @param $builder_id string        Id of panel
     * @param $class      object        Class to handle this item
     * @return bool
     */
    function register_item( $builder_id, $class ) {
        if ( ! $builder_id ) {
            return false;
        }

        if ( is_object( $class ) ) {

        } else {
            if ( ! class_exists( $class ) ) {
                return false;
            }
            $class = new $class();
        }

        if ( ! isset( $this->registered_items[ $builder_id ] ) ) {
            $this->registered_items[ $builder_id ] = array();
        }

        $this->registered_items[ $builder_id ][ $class->id ] = $class;

        return true;

    }

    /**
     * Get all items for builder panel
     *
     * @param $builder_id string        Id of panel
     * @return array|mixed|void
     */
    function get_builder_items( $builder_id ) {
        if ( ! $builder_id ) {
            return apply_filters( 'customify/builder/' . $builder_id . '/items', array() );
        }
        if ( ! isset( $this->registered_items[ $builder_id ] ) ) {
            return apply_filters( 'customify/builder/' . $builder_id . '/items', array() );
        }
        $items = array();
        foreach ( $this->registered_items[ $builder_id ] as $name => $obj ) {
            if ( method_exists( $obj, 'item' ) ) {
                $item                 = $obj->item();
                $items[ $item['id'] ] = $item;
            }
        }
        $items = apply_filters( 'customify/builder/' . $builder_id . '/items', $items );

        return $items;
    }

    /**
     * Get all customize settings of all items for builder panel
     *
     * @param $builder_id string        Id of panel
     * @param null $wp_customize        WP Customize
     * @return array|bool
     */
    function get_items_customize( $builder_id, $wp_customize = null ) {
        if ( ! $builder_id ) {
            return false;
        }
        if ( ! isset( $this->registered_items[ $builder_id ] ) ) {
            return false;
        }
        $items = array();
        foreach ( $this->registered_items[ $builder_id ] as $name => $obj ) {
            if ( method_exists( $obj, 'customize' ) ) {
                $item = $obj->customize( $wp_customize );
                if ( is_array( $item ) ) {
                    //$items = array_merge( $items, $item );
                    foreach( $item as $it ) {
                        $items[] = $it;
                    }

                }

            }
        }

        return $items;
    }

    /**
     * Get a builder item for builder panel
     *
     * @param $builder_id   string        Id of panel
     * @param $item_id      string        Builder item id
     * @return bool
     */
    function get_builder_item( $builder_id, $item_id ) {
        if ( ! $builder_id ) {
            return false;
        }
        if ( ! isset( $this->registered_items[ $builder_id ] ) ) {
            return false;
        }

        if ( ! isset( $this->registered_items[ $builder_id ][ $item_id ] ) ) {
            return false;
        }

        return $this->registered_items[ $builder_id ][ $item_id ];
    }

    /**
     * Handle event save template
     */
    function ajax_save_template() {

        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_send_json_error( __( 'Access denied', 'customify' ) );
        }

        $id        = isset( $_POST['id'] ) ? sanitize_text_field( $_POST['id'] ) : false;
        $control   = isset( $_POST['control'] ) ? sanitize_text_field( $_POST['control'] ) : '';
        $save_name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
        if ( ! $save_name ) {
            $save_name = sprintf( __( 'Saved %s', 'customify' ), date_i18n( 'Y-m-d H:i:s' ) );
        }
        $fn   = false;
        if ( ! isset( $this->registered_builders[ $id ] ) ) {
            wp_send_json_error( __( 'No Support', 'customify' ) );
        } else {
            $fn = array( $this->registered_builders[ $id ], '_customize' );
        }

        $theme_name  = wp_get_theme()->get( 'Name' );
        $option_name =  "{$theme_name}_{$id}_saved_templates";

        $saved_templates = get_option( $option_name );
        if ( ! is_array( $saved_templates ) ) {
            $saved_templates = array();
        }

        if ( isset( $_POST['remove'] ) ) {
            $remove = sanitize_text_field( $_POST['remove'] );
            if ( isset( $saved_templates[ $remove ] ) ) {
                unset( $saved_templates[ $remove ] );
            }

            update_option( $option_name, $saved_templates );
            wp_send_json_success();
        }

        $config            = call_user_func_array( $fn, array() );
        $new_template_data = array();

        foreach ( $config as $k => $field ) {
            if ( $field['type'] != 'panel' && $field['type'] != 'section' ) {
                $name  = $field['name'];
                $value = get_theme_mod( $name );
                if ( is_array( $value ) ) {
                    $value = array_filter( $value );
                }
                if ( $value && ! empty( $value ) ) {
                    $new_template_data[ $name ] = $value;
                }
            }
        }

        if ( ! $save_name ) {
            $key_id    = date_i18n( 'Y-m-d H:i:s', current_time( 'timestamp' ) );
            $save_name = sprintf( __( 'Saved %s', 'customify' ), $key_id );
        } else {
            $key_id = $save_name;
        }

        $saved_templates[ $key_id ] = array(
            'name'  => $save_name,
            'image' => '',
            'data'  => $new_template_data
        );

        update_option( $option_name, $saved_templates );
        $html = '<li class="saved_template" data-control-id="' . esc_attr( $control ) . '" data-id="' . esc_attr( $key_id ) . '" data-data="' . esc_attr( json_encode( $new_template_data ) ) . '">' . esc_html( $save_name ) . ' <a href="#" class="load-tpl">' . __( 'Load', 'customify' ) . '</a><a href="#" class="remove-tpl">' . __( 'Remove', 'customify' ) . '</a></li>';
        wp_send_json_success( array( 'key_id' => $key_id, 'name' => $save_name, 'li' => $html ) );
        die();
    }

    /**
     * Handle event export template
     */
    function ajax_export_template() {
        if ( ! current_user_can( 'edit_theme_options' ) ) {
            wp_send_json_error( __( 'Access denied', 'customify' ) );
        }
        $id = isset( $_GET['id'] ) ? sanitize_text_field( $_GET['id'] ) : false;
        $name = isset( $_GET['name'] ) ? sanitize_text_field( $_GET['name'] ) : false;

        $theme_name  = wp_get_theme()->get( 'Name' );
        $option_name =  "{$theme_name}_{$id}_saved_templates";
        $data = get_option( $option_name  );
        $var = null;
        if ( $name ) {
            if ( isset( $data[ $name ] ) ) {
                $var = $data[ $name ]['data'];
                $var = array_filter( $var );
            }
        } else {
            $var = $data;
        }
        var_export( $var );

        //remove_theme_mods();

        die();
    }

    /**
     *  Get all builders registered.
     *
     * @return array
     */
    function get_builders() {
        $builders = array();
        foreach ( $this->registered_builders as $id => $builder ) {
            $config          = $builder->get_config();
            $config['items'] = apply_filters( 'customify/builder/' . $id . '/items', $this->get_builder_items( $id ) );
            $config['rows']  = apply_filters( 'customify/builder/' . $id . '/rows', $builder->get_rows_config() );
            $builders[ $id ] = $config;
        }

        return $builders;
    }

    /**
     * Add script to Customize
     */
    function scripts() {
        $suffix = Customify()->get_asset_suffix();
        wp_enqueue_script( 'customify-layout-builder', esc_url(get_template_directory_uri()) . '/assets/js/customizer/builder'.$suffix.'.js', array(
            'customize-controls',
            'jquery-ui-resizable',
            'jquery-ui-droppable',
            'jquery-ui-draggable'
        ), false, true );
        wp_localize_script( 'customify-layout-builder', 'Customify_Layout_Builder', array(
            'footer_moved_widgets_text' => '',
            'builders'  => $this->get_builders(),
            'is_rtl' => is_rtl()
        ) );
    }

    static function get_instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Panel Builder Template
     */
	function template() {
		?>
        <script type="text/html" id="tmpl-customify--builder-panel">
            <div class="customify--customize-builder">
                <div class="customify--cb-inner">
                    <div class="customify--cb-header">
                        <div class="customify--cb-devices-switcher">
                        </div>
                        <div class="customify--cb-actions">
                            <?php do_action('customify/builder-panel/actions-buttons'); ?>
                            <a data-id="{{ data.id }}_templates" class="focus-section button button-secondary"
                               href="#"><?php _e( 'Templates', 'customify' ); ?></a>
                            <a class="button button-secondary customify--panel-close" href="#">
                                <span class="close-text"><?php _e( 'Close', 'customify' ); ?></span>
                                <span class="panel-name-text">{{ data.title }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="customify--cb-body"></div>
                </div>
            </div>
        </script>


        <script type="text/html" id="tmpl-customify--cb-panel">
            <div class="customify--cp-rows">

                <# if ( ! _.isUndefined( data.rows.top ) ) { #>
                    <div class="customify--row-top customify--cb-row" data-id="{{ data.id }}_top">
                        <a class="customify--cb-row-settings" title="{{ data.rows.top }}" data-id="top" href="#"></a>
                        <div class="customify--row-inner">
                            <div class="row--grid">
								<?php for ( $i = 1; $i <= 12; $i ++ ) {
									echo '<div></div>';
								} ?>
                            </div>
                            <div class="customify--cb-items grid-stack gridster" data-id="top"></div>
                        </div>
                    </div>
                <#  } #>

                <# if ( ! _.isUndefined( data.rows.main ) ) { #>
                    <div class="customify--row-main customify--cb-row" data-id="{{ data.id }}_main">
                        <a class="customify--cb-row-settings" title="{{ data.rows.main }}" data-id="main"
                           href="#"></a>

                        <div class="customify--row-inner">
                            <div class="row--grid">
                                <?php for ( $i = 1; $i <= 12; $i ++ ) {
                                    echo '<div></div>';
                                } ?>
                            </div>
                            <div class="customify--cb-items grid-stack gridster" data-id="main"></div>
                        </div>
                    </div>
                <#  } #>


                <# if ( ! _.isUndefined( data.rows.bottom ) ) { #>
                    <div class="customify--row-bottom customify--cb-row" data-id="{{ data.id }}_bottom">
                        <a class="customify--cb-row-settings" title="{{ data.rows.bottom }}"
                           data-id="bottom" href="#"></a>
                        <div class="customify--row-inner">
                            <div class="row--grid">
                                <?php for ( $i = 1; $i <= 12; $i ++ ) {
                                    echo '<div></div>';
                                } ?>
                            </div>
                            <div class="customify--cb-items grid-stack gridster" data-id="bottom"></div>
                        </div>
                    </div>
                <#  } #>

            </div>


            <# if ( data.device != 'desktop' ) { #>
                <# if ( ! _.isUndefined( data.rows.sidebar ) ) { #>
                    <div class="customify--cp-sidebar">
                        <div class="customify--row-bottom customify--cb-row" data-id="{{ data.id }}_sidebar">
                            <a class="customify--cb-row-settings" title="{{ data.rows.sidebar }}" data-id="sidebar"
                               href="#"></a>
                            <div class="customify--row-inner">
                                <div class="customify--cb-items customify--sidebar-items" data-id="sidebar"></div>
                            </div>
                        </div>
                        <div>
                <# } #>
            <# } #>

        </script>

        <script type="text/html" id="tmpl-customify--cb-item">
            <div class="grid-stack-item item-from-list for-s-{{ data.section }}"
                 title="{{ data.name }}"
                 data-id="{{ data.id }}"
                 data-section="{{ data.section }}"
                 data-control="{{ data.control }}"
                 data-gs-x="{{ data.x }}"
                 data-gs-y="{{ data.y }}"
                 data-gs-width="{{ data.width }}"
                 data-df-width="{{ data.width }}"
                 data-gs-height="1"
            >
                <div class="item-tooltip" data-section="{{ data.section }}">{{ data.name }}</div>
                <div class="grid-stack-item-content">
                    <span class="customify--cb-item-name" data-section="{{ data.section }}">{{ data.name }}</span>
                    <span class="customify--cb-item-remove customify-cb-icon"></span>
                    <span class="customify--cb-item-setting customify-cb-icon" data-section="{{ data.section }}"></span>
                </div>
            </div>
        </script>
		<?php
	}

}