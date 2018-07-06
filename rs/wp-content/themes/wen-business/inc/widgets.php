<?php

add_action( 'widgets_init', 'wen_business_load_widgets' );

if ( ! function_exists( 'wen_business_load_widgets' ) ) :

  /**
   * Load widgets
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_load_widgets()
  {

    // Social widget
    register_widget( 'WEN_Business_Social_Widget' );

    // Advanced Text widget
    register_widget( 'WEN_Business_Advanced_Text_Widget' );

    // Call To Action widget
    register_widget( 'WEN_Business_Call_To_Action_Widget' );

    // Featured Page widget
    register_widget( 'WEN_Business_Featured_Page_Widget' );

    // Latest News widget
    register_widget( 'WEN_Business_Latest_News_Widget' );

    // Testimonial widget
    register_widget( 'WEN_Business_Testimonial_Widget' );

    // Service widget
    register_widget( 'WEN_Business_Service_Widget' );

    // Latest Works widget
    register_widget( 'WEN_Business_Latest_Works_Widget' );

    // Contact widget
    register_widget( 'WEN_Business_Contact_Widget' );

  }

endif;

if ( ! class_exists( 'WEN_Business_Social_Widget' ) ) :

  /**
   * Social Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Social_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_social',
                  'description' => __( 'Social Icons Widget', 'wen-business' ),
                  'customize_selective_refresh' => true,
              );

      parent::__construct('wen-business-social', __( 'Social Widget', 'wen-business'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title        = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $subtitle     = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base);
        $icon_size    = empty($instance['icon_size']) ? 'medium' : $instance['icon_size'];
        $custom_class = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );


        if ( $custom_class ) {
          $before_widget = str_replace('class="', 'class="'. $custom_class . ' ', $before_widget);
        }

        echo $before_widget;

        // Title
        if ( $title ) echo $before_title . $title . $after_title;

        // Sub Title
        if ( $subtitle ) printf( '%s%s%s', '<h4 class="widget-subtitle">', $subtitle, '</h4>' );

        if ( has_nav_menu( 'social' ) ) {
        	wp_nav_menu( array(
				'theme_location' => 'social',
				'container'      => false,
				'menu_class'     => 'size-' .  esc_attr( $icon_size ),
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>',
				'item_spacing'   => 'discard',
        	) );
        }

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle']     = sanitize_text_field( $new_instance['subtitle'] );
		$instance['icon_size']    = esc_attr( $new_instance['icon_size'] );
		$instance['custom_class'] = esc_attr( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array(
          'title'        => '',
          'subtitle'     => '',
          'icon_size'    => 'medium',
          'custom_class' => '',
        ) );
        $title        = esc_attr( $instance['title'] );
        $subtitle     = esc_textarea( $instance['subtitle'] );
        $icon_size    = esc_attr( $instance['icon_size'] );
        $custom_class = esc_attr( $instance['custom_class'] );

        // Fetch nav
        $nav_menu_locations = get_nav_menu_locations();
        $is_menu_set = false;
        if ( isset( $nav_menu_locations['social'] ) && absint( $nav_menu_locations['social'] ) > 0 ) {
          $is_menu_set = true;
        }
        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title'); ?>"><?php _e('Title:', 'wen-business'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle'); ?>"><?php _e('Sub Title:', 'wen-business'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><?php _e( 'Icon Size:', 'wen-business' ); ?></label>
          <select id="<?php echo $this->get_field_id( 'icon_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_size' ); ?>">
            <option value="small" <?php selected( $icon_size, 'small' ) ?>><?php _e( 'Small', 'wen-business' ) ?></option>
            <option value="medium" <?php selected( $icon_size, 'medium' ) ?>><?php _e( 'Medium', 'wen-business' ) ?></option>
            <option value="large" <?php selected( $icon_size, 'large' ) ?>><?php _e( 'Large', 'wen-business' ) ?></option>
          </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>

        <?php if ( $is_menu_set ): ?>
          <?php
              $menu_id = $nav_menu_locations['social'];
              $social_menu_object = get_term( $menu_id, 'nav_menu' );
              $args = array(
                  'action' => 'edit',
                  'menu'   => $menu_id,
                  );
              $menu_edit_url = add_query_arg( $args, admin_url( 'nav-menus.php' ) );
           ?>
            <p>
                <?php echo __( 'Social Menu is currently set to', 'wen-business' ) . ': '; ?>
                <strong><a href="<?php echo esc_url( $menu_edit_url );  ?>" ><?php echo $social_menu_object->name; ?></a></strong>
            </p>

          <?php else: ?>
          <?php
              $args = array(
                  'action' => 'locations',
                  );
              $menu_manage_url = add_query_arg( $args, admin_url( 'nav-menus.php' ) );
              $args = array(
                  'action' => 'edit',
                  'menu'   => 0,
                  );
              $menu_create_url = add_query_arg( $args, admin_url( 'nav-menus.php' ) );
           ?>
            <p>
              <?php echo __( 'Social menu is not set.', 'wen-business' ) . ' '; ?><br />
              <strong><a href="<?php echo esc_url( $menu_manage_url );  ?>"><?php echo __( 'Click here to set menu', 'wen-business' ); ?></a></strong>
              <?php echo ' '._x( 'or', 'Social Widget', 'wen-business' ) . ' '; ?>
              <strong><a href="<?php echo esc_url( $menu_create_url );  ?>"><?php echo __( 'Create menu now', 'wen-business' ); ?></a></strong>
            </p>

          <?php endif ?>

        <?php
      }

  }

endif;


if ( ! class_exists( 'WEN_Business_Advanced_Text_Widget' ) ) :

  /**
   * Advanced Text Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Advanced_Text_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_advanced_text',
                  'description' => __( 'Advanced Text Widget', 'wen-business' ),
                  'customize_selective_refresh' => true,
              );

      parent::__construct('wen-business-advanced-text', __( 'Advanced Text Widget', 'wen-business'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title        = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle     = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base );
        $text         = apply_filters( 'widget_welcome_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance, $this->id_base);
        $custom_class = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

        if ( $custom_class ) {
          $before_widget = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
        }

        echo $before_widget;

        // Title
        if ( $title ) echo $before_title . $title . $after_title;

        // Sub Title
        if ( $subtitle ) printf( '%s%s%s', '<h4 class="widget-subtitle">', $subtitle, '</h4>' );
        //
        // Run text through do_shortcode
        $text = do_shortcode( $text );

        ?>
        <div class="advanced-text-widget">
	        <?php echo ! empty( $instance['filter'] ) ? wp_kses_post( wpautop( $text ) ) : wp_kses_post( $text ); ?>
        </div>
        <?php
        //
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle']     = sanitize_text_field( $new_instance['subtitle'] );
		$instance['text']         =  wp_kses_post( $new_instance['text'] );
		$instance['filter']       = isset( $new_instance['filter'] );
		$instance['custom_class'] =   esc_attr( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array(
          'title'        => '',
          'subtitle'     => '',
          'text'         => '',
          'filter'       =>  0,
          'custom_class' => '',
        ) );
        $title        = strip_tags( $instance['title'] );
        $subtitle     = esc_textarea( $instance['subtitle'] );
        $text         = esc_textarea( $instance['text'] );
        $filter       = esc_attr($instance['filter']);
        $custom_class = esc_attr( $instance['custom_class'] );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title'); ?>"><?php _e('Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle'); ?>"><?php _e('Sub Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'text'); ?>"><?php _e( 'Text:', 'wen-business' ); ?></label>
          <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>
        </p>
        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e( 'Automatically add paragraphs', 'wen-business' ); ?></label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>
        <?php
      }
  }

endif;

if ( ! class_exists( 'WEN_Business_Call_To_Action_Widget' ) ) :

  /**
   * Call To Action Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Call_To_Action_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_call_to_action',
                  'description' => __( 'Call To Action Widget', 'wen-business' ),
                  'customize_selective_refresh' => true,
              );

      parent::__construct('wen-business-call-to-action', __( 'Call To Action Widget', 'wen-business'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title                = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle             = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base );
        $text                 = apply_filters( 'widget_welcome_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance, $this->id_base);
        $primary_button_text  = ! empty( $instance['primary_button_text'] ) ? strip_tags( $instance['primary_button_text'] ) : '';
        $primary_button_url   = ! empty( $instance['primary_button_url'] ) ? esc_url( $instance['primary_button_url'] ) : '';
        $secondary_button_text  = ! empty( $instance['secondary_button_text'] ) ? strip_tags( $instance['secondary_button_text'] ) : '';
        $secondary_button_url = ! empty( $instance['secondary_button_url'] ) ? esc_url( $instance['secondary_button_url'] ) : '';
        $open_url_in_new_window    = ! empty( $instance['open_url_in_new_window'] ) ? $instance['open_url_in_new_window'] : false ;
        $custom_class         = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

        if ( $custom_class ) {
          $before_widget = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
        }

        echo $before_widget;

        // Title
        if ( $title ) echo $before_title . $title . $after_title;

        // Sub Title
        if ( $subtitle ) printf( '%s%s%s', '<h4 class="widget-subtitle">', $subtitle, '</h4>' );
        //

        ?>
        <div class="call-to-action-widget">
	        <?php echo ! empty( $instance['filter'] ) ? wp_kses_post( wpautop( $text ) ) : wp_kses_post( $text ); ?>
        </div>
        <div class="call-to-action-buttons">
          <?php
            $target_text = '';
            if ( $open_url_in_new_window ) {
              $target_text = ' target="_blank" ';
            }
          ?>
          <?php if ( ! empty( $primary_button_text ) ): ?>
            <a href="<?php echo $primary_button_url; ?>" <?php echo $target_text ?> class="cta-button-primary" title="<?php echo esc_attr( $primary_button_text ); ?>" ><?php echo $primary_button_text; ?></a>
          <?php endif ?>
          <?php if ( ! empty( $secondary_button_text ) ): ?>
            <a href="<?php echo $secondary_button_url; ?>" <?php echo $target_text ?> class="cta-button-secondary" title="<?php echo esc_attr( $secondary_button_text ); ?>" ><?php echo $secondary_button_text; ?></a>
          <?php endif ?>
        </div><!-- .cta-buttons -->
        <?php
        //
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']                  = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle']               = sanitize_text_field( $new_instance['subtitle'] );
		$instance['text']                   =  wp_kses_post( $new_instance['text'] );
		$instance['filter']                 = isset( $new_instance['filter'] );
		$instance['primary_button_text']    = strip_tags( $new_instance['primary_button_text'] );
		$instance['primary_button_url']     = esc_url( $new_instance['primary_button_url'] );
		$instance['secondary_button_text']  = strip_tags( $new_instance['secondary_button_text'] );
		$instance['secondary_button_url']   = esc_url( $new_instance['secondary_button_url'] );
		$instance['open_url_in_new_window'] = isset( $new_instance['open_url_in_new_window'] );
		$instance['custom_class']           = esc_attr( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array(
          'title'                  => '',
          'subtitle'               => '',
          'text'                   => '',
          'filter'                 => 0,
          'primary_button_text'    => __( 'Read more', 'wen-business' ),
          'primary_button_url'     => '',
          'secondary_button_text'  => '',
          'secondary_button_url'   => '',
          'open_url_in_new_window' => 0,
          'custom_class'           => '',
        ) );
        $title                  = strip_tags( $instance['title'] );
        $subtitle               = esc_textarea( $instance['subtitle'] );
        $text                   = esc_textarea( $instance['text'] );
        $filter                 = esc_attr($instance['filter']);
        $primary_button_text    = esc_html( strip_tags( $instance['primary_button_text'] ) );
        $primary_button_url     = esc_url( $instance['primary_button_url'] );
        $secondary_button_text  = esc_html( strip_tags( $instance['secondary_button_text'] ) );
        $secondary_button_url   = esc_url( $instance['secondary_button_url'] );
        $open_url_in_new_window = esc_attr($instance['open_url_in_new_window']);
        $custom_class           = esc_attr( $instance['custom_class'] );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title'); ?>"><?php _e('Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle'); ?>"><?php _e('Sub Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'text'); ?>"><?php _e( 'Text:', 'wen-business' ); ?></label>
          <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>
        </p>
        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e( 'Automatically add paragraphs', 'wen-business' ); ?></label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'primary_button_text' ); ?>"><?php _e( 'Primary Button Text:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'primary_button_text'); ?>" name="<?php echo $this->get_field_name( 'primary_button_text' ); ?>" type="text" value="<?php echo esc_attr( $primary_button_text ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'primary_button_url' ); ?>"><?php _e( 'Primary Button URL:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'primary_button_url'); ?>" name="<?php echo $this->get_field_name( 'primary_button_url' ); ?>" type="text" value="<?php echo esc_attr( $primary_button_url ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'secondary_button_text' ); ?>"><?php _e( 'Secondary Button Text:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'secondary_button_text'); ?>" name="<?php echo $this->get_field_name( 'secondary_button_text' ); ?>" type="text" value="<?php echo esc_attr( $secondary_button_text ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'secondary_button_url' ); ?>"><?php _e( 'Secondary Button URL:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'secondary_button_url'); ?>" name="<?php echo $this->get_field_name( 'secondary_button_url' ); ?>" type="text" value="<?php echo esc_attr( $secondary_button_url ); ?>" />
        </p>
        <p><input id="<?php echo $this->get_field_id('open_url_in_new_window'); ?>" name="<?php echo $this->get_field_name('open_url_in_new_window'); ?>" type="checkbox" <?php checked(isset($instance['open_url_in_new_window']) ? $instance['open_url_in_new_window'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('open_url_in_new_window'); ?>"><?php _e( 'Open URL in New Window', 'wen-business' ); ?></label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>



        <?php
      }

  }

endif;


if ( ! class_exists( 'WEN_Business_Featured_Page_Widget' ) ) :

  /**
   * Featured Page Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Featured_Page_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_featured_page',
                  'description' => __( 'Featured Page Widget', 'wen-business' ),
                  'customize_selective_refresh' => true,
              );

      parent::__construct('wen-business-featured-page', __( 'Featured Page Widget', 'wen-business'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title          = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
        $use_page_title = ! empty( $instance['use_page_title'] ) ? $instance['use_page_title'] : false ;
        $subtitle       = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base );
        $featured_page  = ! empty( $instance['featured_page'] ) ? $instance['featured_page'] : 0;
        $content_type   = ! empty( $instance['content_type'] ) ? $instance['content_type'] : 'full';
        $featured_image = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'disable';
        $custom_class   = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

        echo $before_widget;

        if ( absint( $featured_page ) > 0 ) {

        	$qargs = array(
				'p'             => absint( $featured_page ),
				'post_type'     => 'page',
				'no_found_rows' => true,
    		);

        	$the_query = new WP_Query( $qargs );
        	if ( $the_query->have_posts() ) {

        		while ( $the_query->have_posts() ) {
        			$the_query->the_post();

        			if ( false != $use_page_title ) {
        				the_title( $before_title, $after_title );
        			} else {
        				if ( $title ) {
        					echo $before_title . $title . $after_title;
        				}
        			}

        			if ( $subtitle ) {
        				printf( '%s%s%s', '<h4 class="widget-subtitle">', esc_html( $subtitle ), '</h4>' );
        			}

        			if ( 'disable' != $featured_image && has_post_thumbnail() ) {
        				the_post_thumbnail( $featured_image, array( 'class' => 'aligncenter' ) );
        			}

        			echo '<div class="featured-page-widget entry-content">';

        			if ( 'short' == $content_type ) {
        				the_excerpt();
        			} else {
        				the_content();
        			}

        			echo '</div><!-- .featured-page-widget -->';
        		}
        	}

        	wp_reset_postdata();
        }

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']          = sanitize_text_field( $new_instance['title'] );
		$instance['use_page_title'] = isset( $new_instance['use_page_title'] );
		$instance['subtitle']       = sanitize_text_field( $new_instance['subtitle'] );
		$instance['featured_page']  = absint( $new_instance['featured_page'] );
		$instance['content_type']   = esc_attr( $new_instance['content_type'] );
		$instance['featured_image'] = esc_attr( $new_instance['featured_image'] );
		$instance['custom_class']   = esc_attr( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array(
          'title'          => '',
          'use_page_title' => 1,
          'subtitle'       => '',
          'featured_page'  => '',
          'content_type'   => 'full',
          'featured_image' => 'disable',
          'custom_class'   => '',
        ) );
        $title          = strip_tags( $instance['title'] );
        $use_page_title = esc_attr( $instance['use_page_title'] );
        $subtitle       = esc_textarea( $instance['subtitle'] );
        $featured_page  = absint( $instance['featured_page'] );
        $content_type   = esc_attr( $instance['content_type'] );
        $featured_image = esc_attr($instance['featured_image']);
        $custom_class   = esc_attr( $instance['custom_class'] );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title'); ?>"><?php _e('Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p><input id="<?php echo $this->get_field_id( 'use_page_title' ); ?>" name="<?php echo $this->get_field_name( 'use_page_title' ); ?>" type="checkbox" <?php checked(isset($instance['use_page_title']) ? $instance['use_page_title'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'use_page_title' ); ?>"><?php _e( 'Use Page Name as Widget Title', 'wen-business' ); ?>
          </label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle'); ?>"><?php _e('Sub Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'featured_page'); ?>"><?php _e( 'Select Page:', 'wen-business' ); ?></label>
          <?php
            wp_dropdown_pages( array(
				'id'               => $this->get_field_id( 'featured_page' ),
				'name'             => $this->get_field_name( 'featured_page' ),
				'selected'         => $featured_page,
				'show_option_none' => __( '&mdash; Select &mdash;', 'wen-business' ),
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'content_type' ); ?>"><?php _e( 'Show Content:', 'wen-business' ); ?></label>
          <select id="<?php echo $this->get_field_id( 'content_type' ); ?>" name="<?php echo $this->get_field_name( 'content_type' ); ?>">
            <option value="short" <?php selected( $content_type, 'short' ) ?>><?php _e( 'Short', 'wen-business' ) ?></option>
            <option value="full" <?php selected( $content_type, 'full' ) ?>><?php _e( 'Full', 'wen-business' ) ?></option>
          </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'featured_image' ); ?>"><?php _e( 'Featured Image:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_image_sizes( array(
              'id'       => $this->get_field_id( 'featured_image' ),
              'name'     => $this->get_field_name( 'featured_image' ),
              'selected' => $featured_image,
              )
            );
          ?>

        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>
        <?php
      }

    function dropdown_image_sizes( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = $this->get_image_sizes_options();

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    private function get_image_sizes_options(){

      global $_wp_additional_image_sizes;
      $get_intermediate_image_sizes = get_intermediate_image_sizes();
      $choices = array();
      $choices['disable'] = __( 'No Image', 'wen-business' );
      foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
        $choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
      }
      $choices['full'] = __( 'full (original)', 'wen-business' );
      if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

        foreach ($_wp_additional_image_sizes as $key => $size ) {
          $choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
        }

      }
      return $choices;
    }

  }

endif;


if ( ! class_exists( 'WEN_Business_Latest_News_Widget' ) ) :

  /**
   * Latest News Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Latest_News_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_latest_news',
                  'description' => __( 'Latest News Widget', 'wen-business' ),
                  'customize_selective_refresh' => true,
              );

      parent::__construct('wen-business-latest-news', __( 'Latest News Widget', 'wen-business'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title          = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle       = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base );
        $post_category     = ! empty( $instance['post_category'] ) ? $instance['post_category'] : 0;
        $post_column       = ! empty( $instance['post_column'] ) ? $instance['post_column'] : 4;
        $featured_image    = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'thumbnail';
        $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 4;
        $excerpt_length    = ! empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 40;
        $post_order_by     = ! empty( $instance['post_order_by'] ) ? $instance['post_order_by'] : 'date';
        $post_order        = ! empty( $instance['post_order'] ) ? $instance['post_order'] : 'desc';
        $more_text         = ! empty( $instance['more_text'] ) ? $instance['more_text'] : __( 'Read more','wen-business' );
        $disable_date      = ! empty( $instance['disable_date'] ) ? $instance['disable_date'] : false ;
        $disable_comment   = ! empty( $instance['disable_comment'] ) ? $instance['disable_comment'] : false ;
        $disable_excerpt   = ! empty( $instance['disable_excerpt'] ) ? $instance['disable_excerpt'] : false ;
        $disable_more_text = ! empty( $instance['disable_more_text'] ) ? $instance['disable_more_text'] : false ;
        $custom_class   = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

        // Validation
        // Order
        if ( in_array( $post_order, array( 'asc', 'desc' ) ) ) {
          $post_order = strtoupper( $post_order );
        }
        else{
          $post_order = 'DESC';
        }
        // Order By
        switch ( $post_order_by ) {
          case 'date':
            $post_order_by = 'date';
            break;
          case 'title':
            $post_order_by = 'title';
            break;
          case 'comment-count':
            $post_order_by = 'comment_count';
            break;
          case 'random':
            $post_order_by = 'rand';
            break;
          case 'menu-order':
            $post_order_by = 'menu_order';
            break;
          default:
            $post_order_by = 'date';
            break;
        }
        // Column class
        switch ( $post_column ) {
          case 1:
            $column_class = 'col-sm-12';
            break;
          case 2:
            $column_class = 'col-sm-6';
            break;
          case 3:
            $column_class = 'col-sm-4';
            break;
          case 4:
            $column_class = 'col-sm-3';
            break;
          case 5:
            $column_class = 'col-sm-5ths';
            break;
          case 6:
            $column_class = 'col-sm-2';
            break;
          default:
            $column_class = '';
            break;
        }


        // Add Custom class
        if ( $custom_class ) {
          $before_widget = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
        }

        echo $before_widget;

        // Title
        if ( $title ) echo $before_title . $title . $after_title;

        // Sub Title
        if ( $subtitle ) printf( '%s%s%s', '<h4 class="widget-subtitle">', $subtitle, '</h4>' );
        //
        ?>
        <?php
          $qargs = array(
            'posts_per_page' => $post_number,
            'no_found_rows'  => true,
            'orderby'        => $post_order_by,
            'order'          => $post_order,
            );
          if ( absint( $post_category ) > 0 ) {
            $qargs['cat'] = $post_category;
          }

          $all_posts = get_posts( $qargs );
        ?>
        <?php if ( ! empty( $all_posts ) ): ?>


          <?php global $post; ?>

          <div class="latest-news-widget">

            <div class="row">

              <?php foreach ( $all_posts as $key => $post ): ?>
                <?php setup_postdata( $post ); ?>

                <div class="<?php echo esc_attr( $column_class ); ?>">
                  <div class="latest-news-item">

                      <?php if ( 'disable' != $featured_image ): ?>
                        <div class="latest-news-thumb">
                          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php
                              $img_attributes = array( 'class' => 'aligncenter' );
                              the_post_thumbnail( $featured_image, $img_attributes );
                            ?>
                          </a>
                        </div><!-- .latest-news-thumb -->
                      <?php endif ?>
                      <div class="latest-news-text-wrap">
                        <h3 class="latest-news-title">
                          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h3><!-- .latest-news-title -->

                        <?php if ( false == $disable_date || ( false == $disable_comment && comments_open( get_the_ID() ) ) ): ?>
                          <div class="latest-news-meta">

                            <?php if ( false == $disable_date ): ?>
                              <span class="latest-news-date"><?php the_time( get_option('date_format') ); ?></span><!-- .latest-news-date -->
                            <?php endif ?>

                            <?php if ( false == $disable_comment ): ?>
                              <?php
                              if ( comments_open( get_the_ID() ) ) {
                                echo '<span class="latest-news-comments">';
                                comments_popup_link( '<span class="leave-reply">' . __( 'No Comment', 'wen-business' ) . '</span>', __( '1 Comment', 'wen-business' ), __( '% Comments', 'wen-business' ) );
                                echo '</span>';
                              }
                              ?>
                            <?php endif ?>

                          </div><!-- .latest-news-meta -->
                        <?php endif ?>

                        <?php if ( false == $disable_excerpt ): ?>
                          <div class="latest-news-summary">
                          	<?php
                          	$excerpt = $this->get_the_excerpt( $post, $excerpt_length );
                          	echo wp_kses_post( wpautop( $excerpt ) );
                          	?>
                          </div><!-- .latest-news-summary -->
                        <?php endif ?>
                        <?php if ( false == $disable_more_text ): ?>
                          <div class="latest-news-read-more"><a href="<?php the_permalink(); ?>" class="read-more" title="<?php the_title_attribute(); ?>"><?php echo esc_html( $more_text ); ?></a></div><!-- .latest-news-read-more -->
                        <?php endif ?>
                      </div><!-- .latest-news-text-wrap -->
                  </div><!-- .latest-news-item -->

                </div><!-- .latest-news-item .col-sm-3 -->

              <?php endforeach ?>

            </div><!-- .row -->

          </div><!-- .latest-news-widget -->

          <?php wp_reset_postdata(); // Reset ?>

        <?php endif; ?>
        <?php
        //
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']             = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle']          = sanitize_text_field( $new_instance['subtitle'] );
		$instance['post_category']     = absint( $new_instance['post_category'] );
		$instance['post_number']       = absint( $new_instance['post_number'] );
		$instance['post_column']       = absint( $new_instance['post_column'] );
		$instance['excerpt_length']    = absint( $new_instance['excerpt_length'] );
		$instance['post_order_by']     = esc_attr( $new_instance['post_order_by'] );
		$instance['post_order']        = esc_attr( $new_instance['post_order'] );
		$instance['featured_image']    = esc_attr( $new_instance['featured_image'] );
		$instance['disable_date']      = isset( $new_instance['disable_date'] );
		$instance['disable_comment']   = isset( $new_instance['disable_comment'] );
		$instance['disable_excerpt']   = isset( $new_instance['disable_excerpt'] );
		$instance['disable_more_text'] = isset( $new_instance['disable_more_text'] );
		$instance['more_text']         = esc_attr( $new_instance['more_text'] );
		$instance['custom_class']      = esc_attr( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array(
          'title'             => '',
          'subtitle'          => '',
          'post_category'     => '',
          'post_column'       => 4,
          'featured_image'    => 'thumbnail',
          'post_number'       => 4,
          'excerpt_length'    => 40,
          'post_order_by'     => 'date',
          'post_order'        => 'desc',
          'more_text'         => __( 'Read more', 'wen-business' ),
          'disable_date'      => 0,
          'disable_comment'   => 0,
          'disable_excerpt'   => 0,
          'disable_more_text' => 0,
          'custom_class'      => '',
        ) );
        $title             = strip_tags( $instance['title'] );
        $subtitle          = esc_textarea( $instance['subtitle'] );
        $post_category     = absint( $instance['post_category'] );
        $post_column       = absint( $instance['post_column'] );
        $featured_image    = esc_attr( $instance['featured_image'] );
        $post_number       = absint( $instance['post_number'] );
        $excerpt_length    = absint( $instance['excerpt_length'] );
        $post_order_by     = esc_attr( $instance['post_order_by'] );
        $post_order        = esc_attr( $instance['post_order'] );
        $more_text         = strip_tags( $instance['more_text'] );
        $disable_date      = esc_attr( $instance['disable_date'] );
        $disable_comment   = esc_attr( $instance['disable_comment'] );
        $disable_excerpt   = esc_attr( $instance['disable_excerpt'] );
        $disable_more_text = esc_attr( $instance['disable_more_text'] );
        $custom_class      = esc_attr( $instance['custom_class'] );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Sub Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_category' ); ?>"><?php _e( 'Category:', 'wen-business' ); ?></label>
          <?php
            $cat_args = array(
                'orderby'         => 'name',
                'hide_empty'      => 0,
                'taxonomy'        => 'category',
                'name'            => $this->get_field_name('post_category'),
                'id'              => $this->get_field_id('post_category'),
                'selected'        => $post_category,
                'show_option_all' => __( 'All Categories','wen-business' ),
              );
            wp_dropdown_categories( $cat_args );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_column' ); ?>"><?php _e('Number of Columns:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_post_columns( array(
              'id'       => $this->get_field_id( 'post_column' ),
              'name'     => $this->get_field_name( 'post_column' ),
              'selected' => $post_column,
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'featured_image' ); ?>"><?php _e( 'Featured Image:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_image_sizes( array(
              'id'       => $this->get_field_id( 'featured_image' ),
              'name'     => $this->get_field_name( 'featured_image' ),
              'selected' => $featured_image,
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e('Number of Posts:', 'wen-business' ); ?></label>
          <input class="widefat1" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo esc_attr( $post_number ); ?>" min="1" style="max-width:50px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e('Excerpt Length:', 'wen-business' ); ?></label>
          <input class="widefat1" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="number" value="<?php echo esc_attr( $excerpt_length ); ?>" min="1" style="max-width:50px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_order_by' ); ?>"><?php _e( 'Order By:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_post_order_by( array(
              'id'       => $this->get_field_id( 'post_order_by' ),
              'name'     => $this->get_field_name( 'post_order_by' ),
              'selected' => $post_order_by,
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e( 'Order:', 'wen-business' ); ?></label>
          <select id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' ); ?>">
            <option value="asc" <?php selected( $post_order, 'asc' ) ?>><?php _e( 'Ascending', 'wen-business' ) ?></option>
            <option value="desc" <?php selected( $post_order, 'desc' ) ?>><?php _e( 'Descending', 'wen-business' ) ?></option>
          </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'more_text' ); ?>"><?php _e( 'More Text:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'more_text'); ?>" name="<?php echo $this->get_field_name( 'more_text' ); ?>" type="text" value="<?php echo esc_attr( $more_text ); ?>" />
        </p>
        <p><input id="<?php echo $this->get_field_id( 'disable_date' ); ?>" name="<?php echo $this->get_field_name( 'disable_date' ); ?>" type="checkbox" <?php checked(isset($instance['disable_date']) ? $instance['disable_date'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'disable_date' ); ?>"><?php _e( 'Disable Date', 'wen-business' ); ?>
          </label>
        </p>
        <p><input id="<?php echo $this->get_field_id( 'disable_comment' ); ?>" name="<?php echo $this->get_field_name( 'disable_comment' ); ?>" type="checkbox" <?php checked(isset($instance['disable_comment']) ? $instance['disable_comment'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'disable_comment' ); ?>"><?php _e( 'Disable Comment', 'wen-business' ); ?>
          </label>
        </p>
        <p>
          <input id="<?php echo $this->get_field_id( 'disable_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'disable_excerpt' ); ?>" type="checkbox" <?php checked(isset($instance['disable_excerpt']) ? $instance['disable_excerpt'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'disable_excerpt' ); ?>"><?php _e( 'Disable Excerpt', 'wen-business' ); ?>
          </label>
        </p>
        <p>
          <input id="<?php echo $this->get_field_id( 'disable_more_text' ); ?>" name="<?php echo $this->get_field_name( 'disable_more_text' ); ?>" type="checkbox" <?php checked(isset($instance['disable_more_text']) ? $instance['disable_more_text'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'disable_more_text' ); ?>"><?php _e( 'Disable More Text', 'wen-business' ); ?>
          </label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>
        <?php
      }

    function get_the_excerpt( $post_obj, $length = 40 ){

      if ( is_null( $post_obj ) ) {
        return;
      }
      $length = absint( $length );
      if ( $length < 1 ) {
        $length = 40;
      }
      $source_content = $post_obj->post_content;
      if ( ! empty( $post_obj->post_excerpt ) ) {
        $source_content = $post_obj->post_excerpt;
      }

      $trimmed_content = wp_trim_words( $source_content, $length, '...' );
      return $trimmed_content;


    }
    function dropdown_post_columns( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = array(
        '1' => sprintf( __( '%d Column','wen-business' ), 1 ),
        '2' => sprintf( __( '%d Columns','wen-business' ), 2 ),
        '3' => sprintf( __( '%d Columns','wen-business' ), 3 ),
        '4' => sprintf( __( '%d Columns','wen-business' ), 4 ),
      );

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    function dropdown_post_order_by( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = array(
        'date'          => __( 'Date','wen-business' ),
        'title'         => __( 'Title','wen-business' ),
        'comment-count' => __( 'Comment Count','wen-business' ),
        'menu-order'    => __( 'Menu Order','wen-business' ),
        'random'        => __( 'Random','wen-business' ),
      );

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    function dropdown_image_sizes( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = $this->get_image_sizes_options();

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    private function get_image_sizes_options(){

      global $_wp_additional_image_sizes;
      $get_intermediate_image_sizes = get_intermediate_image_sizes();
      $choices = array();
      $choices['disable'] = __( 'No Image', 'wen-business' );
      foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
        $choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
      }
      $choices['full'] = __( 'full (original)', 'wen-business' );
      if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

        foreach ($_wp_additional_image_sizes as $key => $size ) {
          $choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
        }

      }
      return $choices;
    }

  }

endif;

if ( ! class_exists( 'WEN_Business_Testimonial_Widget' ) ) :

  /**
   * Testimonial Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Testimonial_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_testimonial',
                  'description' => __( 'Testimonial Widget', 'wen-business' )
              );

      parent::__construct('wen-business-testimonial', __( 'Testimonial Widget', 'wen-business'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title          = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle       = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base );
        $post_category       = ! empty( $instance['post_category'] ) ? $instance['post_category'] : 0;
        $featured_image      = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'thumbnail';
        $post_number         = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 4;
        $excerpt_length      = ! empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 40;
        $post_order_by       = ! empty( $instance['post_order_by'] ) ? $instance['post_order_by'] : 'date';
        $post_order          = ! empty( $instance['post_order'] ) ? $instance['post_order'] : 'desc';
        $transition_delay    = ! empty( $instance['transition_delay'] ) ? $instance['transition_delay'] : 3;
        $transition_duration = ! empty( $instance['transition_duration'] ) ? $instance['transition_duration'] : 1;
        $disable_pager       = ! empty( $instance['disable_pager'] ) ? $instance['disable_pager'] : false ;
        $custom_class        = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

        // Validation
        // Order
        if ( in_array( $post_order, array( 'asc', 'desc' ) ) ) {
          $post_order = strtoupper( $post_order );
        }
        else{
          $post_order = 'DESC';
        }
        // Order By
        switch ( $post_order_by ) {
          case 'date':
            $post_order_by = 'date';
            break;
          case 'title':
            $post_order_by = 'title';
            break;
          case 'random':
            $post_order_by = 'rand';
            break;
          case 'menu-order':
            $post_order_by = 'menu_order';
            break;
          default:
            $post_order_by = 'date';
            break;
        }


        // Add Custom class
        if ( $custom_class ) {
          $before_widget = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
        }

        echo $before_widget;

        // Title
        if ( $title ) echo $before_title . $title . $after_title;

        // Sub Title
        if ( $subtitle ) printf( '%s%s%s', '<h4 class="widget-subtitle">', $subtitle, '</h4>' );
        //
        ?>
        <?php
          $qargs = array(
            'posts_per_page' => $post_number,
            'no_found_rows'  => true,
            'orderby'        => $post_order_by,
            'order'          => $post_order,
            );
          if ( absint( $post_category ) > 0 ) {
            $qargs['cat'] = $post_category;
          }

          $all_posts = get_posts( $qargs );
        ?>
        <?php if ( ! empty( $all_posts ) ): ?>

          <?php global $post; ?>

          <?php
            // Cycle data
            $slide_data = array(
              'fx'             => 'fade',
              'speed'          => $transition_duration * 1000,
              'pause-on-hover' => 'true',
              'log'            => 'false',
              'swipe'          => 'true',
              'auto-height'    => 'container',
              'slides'         => '> article',
            );
            $slide_data['timeout'] = $transition_delay * 1000;
            $slide_attributes_text = '';
            foreach ($slide_data as $key => $item) {
              $slide_attributes_text .= ' ';
              $slide_attributes_text .= ' data-cycle-'.esc_attr( $key );
              $slide_attributes_text .= '="'.esc_attr( $item ).'"';
            }


          ?>

          <div class="testimonial-widget">

            <div class="cycle-slideshow" <?php echo $slide_attributes_text; ?> >


              <?php foreach ( $all_posts as $key => $post ): ?>
                <?php setup_postdata( $post ); ?>

                <article class="testimonial-item">

                  <?php if ( 'disable' != $featured_image ): ?>
                    <div class="testimonial-thumb">
                        <?php
                          the_post_thumbnail( $featured_image );
                        ?>
                    </div><!-- .testimonial-thumb -->
                  <?php endif ?>
                  <div class="testimonial-text-wrap">
                    <div class="testimonial-summary">
	                    <?php
	                    $excerpt = $this->get_the_excerpt( $post, $excerpt_length );
	                    echo wp_kses_post( $excerpt );
	                    ?>
                    </div><!-- .testimonial-summary -->
                    <h3 class="testimonial-title"><?php the_title(); ?></h3><!-- .testimonial-title -->
                  </div><!-- .testimonial-text-wrap -->

                </article><!-- .testimonial-item -->

              <?php endforeach ?>

              <?php if ( false == $disable_pager ): ?>
                <div class="cycle-pager"></div>
              <?php endif ?>

            </div><!-- .cycle-slideshow -->


          </div><!-- .testimonial-widget -->

          <?php wp_reset_postdata(); // Reset ?>

        <?php endif; ?>
        <?php
        //
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle']            = sanitize_text_field( $new_instance['subtitle'] );
		$instance['post_category']       = absint( $new_instance['post_category'] );
		$instance['featured_image']      = esc_attr( $new_instance['featured_image'] );
		$instance['post_number']         = absint( $new_instance['post_number'] );
		$instance['excerpt_length']      = absint( $new_instance['excerpt_length'] );
		$instance['post_order_by']       = esc_attr( $new_instance['post_order_by'] );
		$instance['post_order']          = esc_attr( $new_instance['post_order'] );
		$instance['transition_delay']    = absint( $new_instance['transition_delay'] );
		$instance['transition_duration'] = absint( $new_instance['transition_duration'] );
		$instance['disable_pager']       = isset( $new_instance['disable_pager'] );
		$instance['custom_class']        = esc_attr( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array(
          'title'               => '',
          'subtitle'            => '',
          'post_category'       => '',
          'featured_image'      => 'thumbnail',
          'post_number'         => 4,
          'excerpt_length'      => 20,
          'post_order_by'       => 'date',
          'post_order'          => 'desc',
          'transition_delay'    => 3,
          'transition_duration' => 1,
          'disable_pager'       => 0,
          'custom_class'        => '',
        ) );
        $title               = strip_tags( $instance['title'] );
        $subtitle            = esc_textarea( $instance['subtitle'] );
        $post_category       = absint( $instance['post_category'] );
        $featured_image      = esc_attr( $instance['featured_image'] );
        $post_number         = absint( $instance['post_number'] );
        $excerpt_length      = absint( $instance['excerpt_length'] );
        $post_order_by       = esc_attr( $instance['post_order_by'] );
        $post_order          = esc_attr( $instance['post_order'] );
        $transition_delay    = absint( $instance['transition_delay'] );
        $transition_duration = absint( $instance['transition_duration'] );
        $disable_pager       = esc_attr( $instance['disable_pager'] );
        $custom_class        = esc_attr( $instance['custom_class'] );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Sub Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_category' ); ?>"><?php _e( 'Category:', 'wen-business' ); ?></label>
          <?php
            $cat_args = array(
                'orderby'         => 'name',
                'hide_empty'      => 0,
                'taxonomy'        => 'category',
                'name'            => $this->get_field_name('post_category'),
                'id'              => $this->get_field_id('post_category'),
                'selected'        => $post_category,
                'show_option_all' => __( 'All Categories','wen-business' ),
              );
            wp_dropdown_categories( $cat_args );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'featured_image' ); ?>"><?php _e( 'Featured Image:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_image_sizes( array(
              'id'       => $this->get_field_id( 'featured_image' ),
              'name'     => $this->get_field_name( 'featured_image' ),
              'selected' => $featured_image,
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e('Number of Posts:', 'wen-business' ); ?></label>
          <input class="widefat1" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo esc_attr( $post_number ); ?>" min="1" style="max-width:50px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e('Excerpt Length:', 'wen-business' ); ?></label>
          <input class="widefat1" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="number" value="<?php echo esc_attr( $excerpt_length ); ?>" min="1" style="max-width:50px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_order_by' ); ?>"><?php _e( 'Order By:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_post_order_by( array(
              'id'       => $this->get_field_id( 'post_order_by' ),
              'name'     => $this->get_field_name( 'post_order_by' ),
              'selected' => $post_order_by,
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e( 'Order:', 'wen-business' ); ?></label>
          <select id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' ); ?>">
            <option value="asc" <?php selected( $post_order, 'asc' ) ?>><?php _e( 'Ascending', 'wen-business' ) ?></option>
            <option value="desc" <?php selected( $post_order, 'desc' ) ?>><?php _e( 'Descending', 'wen-business' ) ?></option>
          </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'transition_delay' ); ?>"><?php _e( 'Transition Delay:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'transition_delay' ); ?>" name="<?php echo $this->get_field_name( 'transition_delay' ); ?>" type="text" value="<?php echo esc_attr( $transition_delay ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'transition_duration' ); ?>"><?php _e( 'Transition Duration:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'transition_duration' ); ?>" name="<?php echo $this->get_field_name( 'transition_duration' ); ?>" type="text" value="<?php echo esc_attr( $transition_duration ); ?>" />
        </p>
        <p><input id="<?php echo $this->get_field_id( 'disable_pager' ); ?>" name="<?php echo $this->get_field_name( 'disable_pager' ); ?>" type="checkbox" <?php checked(isset($instance['disable_pager']) ? $instance['disable_pager'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'disable_pager' ); ?>"><?php _e( 'Disable Pager', 'wen-business' ); ?>
          </label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>
        <?php
      }

    function get_the_excerpt( $post_obj, $length = 40 ){

      if ( is_null( $post_obj ) ) {
        return;
      }
      $length = absint( $length );
      if ( $length < 1 ) {
        $length = 40;
      }
      $source_content = $post_obj->post_content;
      if ( ! empty( $post_obj->post_excerpt ) ) {
        $source_content = $post_obj->post_excerpt;
      }

      $trimmed_content = wp_trim_words( $source_content, $length, '...' );
      return $trimmed_content;


    }

    function dropdown_post_order_by( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = array(
        'date'          => __( 'Date','wen-business' ),
        'title'         => __( 'Title','wen-business' ),
        'menu-order'    => __( 'Menu Order','wen-business' ),
        'random'        => __( 'Random','wen-business' ),
      );

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    function dropdown_image_sizes( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = $this->get_image_sizes_options();

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    private function get_image_sizes_options(){

      global $_wp_additional_image_sizes;
      $get_intermediate_image_sizes = get_intermediate_image_sizes();
      $choices = array();
      $choices['disable'] = __( 'No Image', 'wen-business' );
      foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
        $choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
      }
      $choices['full'] = __( 'full (original)', 'wen-business' );
      if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

        foreach ($_wp_additional_image_sizes as $key => $size ) {
          $choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
        }

      }
      return $choices;
    }

  }

endif;

if ( ! class_exists( 'WEN_Business_Service_Widget' ) ) :

  /**
   * Service Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Service_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_service',
                  'description' => __( 'Service Widget', 'wen-business' ),
                  'customize_selective_refresh' => true,
              );
      $control_ops = array( 'width' => 400 );

      parent::__construct('wen-business-service', __( 'Service Widget', 'wen-business'), $opts, $control_ops );
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title        = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle     = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base );
        $custom_class = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

        $block_title_1       = ! empty( $instance['block_title_1'] ) ? $instance['block_title_1'] : '';
        $block_icon_1        = ! empty( $instance['block_icon_1'] ) ? $instance['block_icon_1'] : 'fa-cogs';
        $block_description_1 = ! empty( $instance['block_description_1'] ) ? $instance['block_description_1'] : '';
        $block_read_more_1   = ! empty( $instance['block_read_more_1'] ) ? $instance['block_read_more_1'] : __( 'Read more', 'wen-business' );
        $block_url_1         = ! empty( $instance['block_url_1'] ) ? $instance['block_url_1'] : '';

        $block_title_2       = ! empty( $instance['block_title_2'] ) ? $instance['block_title_2'] : '';
        $block_icon_2        = ! empty( $instance['block_icon_2'] ) ? $instance['block_icon_2'] : 'fa-cogs';
        $block_description_2 = ! empty( $instance['block_description_2'] ) ? $instance['block_description_2'] : '';
        $block_read_more_2   = ! empty( $instance['block_read_more_2'] ) ? $instance['block_read_more_2'] : __( 'Read more', 'wen-business' );
        $block_url_2         = ! empty( $instance['block_url_2'] ) ? $instance['block_url_2'] : '';

        $block_title_3       = ! empty( $instance['block_title_3'] ) ? $instance['block_title_3'] : '';
        $block_icon_3        = ! empty( $instance['block_icon_3'] ) ? $instance['block_icon_3'] : 'fa-cogs';
        $block_description_3 = ! empty( $instance['block_description_3'] ) ? $instance['block_description_3'] : '';
        $block_read_more_3   = ! empty( $instance['block_read_more_3'] ) ? $instance['block_read_more_3'] : __( 'Read more', 'wen-business' );
        $block_url_3         = ! empty( $instance['block_url_3'] ) ? $instance['block_url_3'] : '';

        $block_title_4       = ! empty( $instance['block_title_4'] ) ? $instance['block_title_4'] : '';
        $block_icon_4        = ! empty( $instance['block_icon_4'] ) ? $instance['block_icon_4'] : 'fa-cogs';
        $block_description_4 = ! empty( $instance['block_description_4'] ) ? $instance['block_description_4'] : '';
        $block_read_more_4   = ! empty( $instance['block_read_more_4'] ) ? $instance['block_read_more_4'] : __( 'Read more', 'wen-business' );
        $block_url_4         = ! empty( $instance['block_url_4'] ) ? $instance['block_url_4'] : '';

        if ( $custom_class ) {
          $before_widget = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
        }

        echo $before_widget;

        // Title
        if ( $title ) echo $before_title . $title . $after_title;

        // Sub Title
        if ( $subtitle ) printf( '%s%s%s', '<h4 class="widget-subtitle">', $subtitle, '</h4>' );
        //
        // Arrange data
        $service_arr = array();
        for ( $i=0; $i < 4 ; $i++ ) {
          $block = ( $i + 1 );
          $service_arr[ $i ] = array(
            'title'       => ${"block_title_" . $block},
            'icon'        => ${"block_icon_" . $block},
            'description' => ${"block_description_" . $block},
            'read_more'   => ${"block_read_more_" . $block},
            'url'         => ${"block_url_" . $block},
          );
        }
        // Clean up data
        $refined_arr = array();
        foreach ($service_arr as $key => $item) {
          if ( ! empty( $item['title'] ) ) {
            $refined_arr[] = $item;
          }
        }

        // Render content
        if ( ! empty( $refined_arr ) ) {
          $this->render_widget_content( $refined_arr );
        }

        //
        echo $after_widget;

    }

    function render_widget_content( $service_arr ){

      $column = count( $service_arr );
      switch ( $column ) {
        case 1:
          $block_item_class = 'col-sm-12';
          break;

        case 2:
          $block_item_class = 'col-sm-6';
          break;

        case 3:
          $block_item_class = 'col-sm-4';
          break;

        case 4:
          $block_item_class = 'col-sm-3';
          break;

        default:
          $block_item_class = '';
          break;
      }
      ?>
      <div class="service-block-list row">

        <?php foreach ( $service_arr as $key => $service ): ?>
          <?php
            $link_open  = '';
            $link_close = '';
            if ( ! empty( $service['url'] ) && ! empty( $service['read_more'] ) ) {
              $link_open  = '<a href="' . esc_url( $service['url'] ) . '" title="' . esc_attr( $service['title'] ) . '">';
              $link_close = '</a>';
            }
          ?>

          <div class="service-block-item <?php echo esc_attr( $block_item_class ); ?>">
            <div class="service-block-inner">

              <i class="<?php echo 'fa ' . esc_attr( $service['icon'] ); ?>"></i>
              <h3 class="service-item-title">
                <?php printf('%s%s%s', $link_open, esc_html( $service['title'] ), $link_close ); ?>
              </h3>
              <div class="service-block-item-excerpt">
                <?php echo esc_html( $service['description'] ); ?>
              </div><!-- .service-block-item-excerpt -->

              <?php if ( ! empty( $link_open ) ): ?>
                <a href="<?php echo esc_url( $service['url'] ); ?>" class="read-more" title="<?php echo esc_attr( $service['title'] )?>" ><?php echo esc_html( $service['read_more'] ); ?></a>
              <?php endif ?>

            </div><!-- .service-block-inner -->
          </div><!-- .service-block-item -->

        <?php endforeach ?>

      </div><!-- .service-block-list -->

      <?php


    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle']            = sanitize_text_field( $new_instance['subtitle'] );

		$instance['block_title_1']       = sanitize_text_field( $new_instance['block_title_1'] );
		$instance['block_icon_1']        = sanitize_text_field( $new_instance['block_icon_1'] );
		$instance['block_description_1'] = wp_kses_post( $new_instance['block_description_1'] );
		$instance['block_read_more_1']   = sanitize_text_field( $new_instance['block_read_more_1'] );
		$instance['block_url_1']         = esc_url_raw( $new_instance['block_url_1'] );

		$instance['block_title_2']       = sanitize_text_field( $new_instance['block_title_2'] );
		$instance['block_icon_2']        = sanitize_text_field( $new_instance['block_icon_2'] );
		$instance['block_description_2'] = wp_kses_post( $new_instance['block_description_2'] );
		$instance['block_read_more_2']   = sanitize_text_field( $new_instance['block_read_more_2'] );
		$instance['block_url_2']         = esc_url_raw( $new_instance['block_url_2'] );

		$instance['block_title_3']       = sanitize_text_field( $new_instance['block_title_3'] );
		$instance['block_icon_3']        = sanitize_text_field( $new_instance['block_icon_3'] );
		$instance['block_description_3'] = wp_kses_post( $new_instance['block_description_3'] );
		$instance['block_read_more_3']   = sanitize_text_field( $new_instance['block_read_more_3'] );
		$instance['block_url_3']         = esc_url_raw( $new_instance['block_url_3'] );

		$instance['block_title_4']       = sanitize_text_field( $new_instance['block_title_4'] );
		$instance['block_icon_4']        = sanitize_text_field( $new_instance['block_icon_4'] );
		$instance['block_description_4'] = wp_kses_post( $new_instance['block_description_4'] );
		$instance['block_read_more_4']   = sanitize_text_field( $new_instance['block_read_more_4'] );
		$instance['block_url_4']         = esc_url_raw( $new_instance['block_url_4'] );

		$instance['custom_class']        =   sanitize_text_field( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array(
          'title'               => '',
          'subtitle'            => '',

          'block_title_1'       => '',
          'block_icon_1'        => 'fa-cogs',
          'block_description_1' => '',
          'block_read_more_1'   => __( 'Read more', 'wen-business' ),
          'block_url_1'         => '',

          'block_title_2'       => '',
          'block_icon_2'        => 'fa-cogs',
          'block_description_2' => '',
          'block_read_more_2'   => __( 'Read more', 'wen-business' ),
          'block_url_2'         => '',

          'block_title_3'       => '',
          'block_icon_3'        => 'fa-cogs',
          'block_description_3' => '',
          'block_read_more_3'   => __( 'Read more', 'wen-business' ),
          'block_url_3'         => '',

          'block_title_4'       => '',
          'block_icon_4'        => 'fa-cogs',
          'block_description_4' => '',
          'block_read_more_4'   => __( 'Read more', 'wen-business' ),
          'block_url_4'         => '',

          'custom_class'        => '',
        ) );
        $title               = strip_tags( $instance['title'] );
        $subtitle            = esc_textarea( $instance['subtitle'] );

        $block_title_1       = esc_html( $instance['block_title_1'] );
        $block_icon_1        = esc_attr( $instance['block_icon_1'] );
        $block_description_1 = esc_textarea( $instance['block_description_1'] );
        $block_read_more_1   = esc_html( $instance['block_read_more_1'] );
        $block_url_1         = esc_url( $instance['block_url_1'] );

        $block_title_2       = esc_html( $instance['block_title_2'] );
        $block_icon_2        = esc_attr( $instance['block_icon_2'] );
        $block_description_2 = esc_textarea( $instance['block_description_2'] );
        $block_read_more_2   = esc_html( $instance['block_read_more_2'] );
        $block_url_2         = esc_url( $instance['block_url_2'] );

        $block_title_3       = esc_html( $instance['block_title_3'] );
        $block_icon_3        = esc_attr( $instance['block_icon_3'] );
        $block_description_3 = esc_textarea( $instance['block_description_3'] );
        $block_read_more_3   = esc_html( $instance['block_read_more_3'] );
        $block_url_3         = esc_url( $instance['block_url_3'] );

        $block_title_4       = esc_html( $instance['block_title_4'] );
        $block_icon_4        = esc_attr( $instance['block_icon_4'] );
        $block_description_4 = esc_textarea( $instance['block_description_4'] );
        $block_read_more_4   = esc_html( $instance['block_read_more_4'] );
        $block_url_4         = esc_url( $instance['block_url_4'] );

        $custom_class        = esc_attr( $instance['custom_class'] );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Sub Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>
        <h4 class="block-heading"><?php printf( __( 'Block %d','wen-business' ), 1 ); ?></h4>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_title_1' ); ?>"><?php _e( 'Title:', 'wen-business' ); ?></label>
          <input id="<?php echo $this->get_field_id( 'block_title_1' ); ?>" name="<?php echo $this->get_field_name( 'block_title_1' ); ?>" type="text" value="<?php echo esc_attr( $block_title_1 ); ?>" style="min-width:310px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_icon_1' ); ?>"><?php _e( 'Icon:', 'wen-business' ); ?></label>
          <input  id="<?php echo $this->get_field_id( 'block_icon_1' ); ?>" name="<?php echo $this->get_field_name( 'block_icon_1' ); ?>" type="text" value="<?php echo esc_attr( $block_icon_1 ); ?>" />&nbsp;<em><?php _e( 'eg: fa-cogs', 'wen-business' ); ?>&nbsp;<a href="<?php echo esc_url( 'http://fontawesome.io/cheatsheet/' ); ?>" target="_blank" title="<?php _e( 'View Reference', 'wen-business' ); ?>"><?php _e( 'Reference', 'wen-business' ); ?></a></em>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_description_1' ); ?>"><?php _e( 'Intro:', 'wen-business' ); ?></label>
          <textarea class="widefat" rows="3" id="<?php echo $this->get_field_id( 'block_description_1' ); ?>" name="<?php echo $this->get_field_name( 'block_description_1' ); ?>"><?php echo $block_description_1; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_read_more_1' ); ?>"><?php _e( 'More Text:', 'wen-business' ); ?></label>
          <input  id="<?php echo $this->get_field_id( 'block_read_more_1' ); ?>" name="<?php echo $this->get_field_name( 'block_read_more_1' ); ?>" type="text" value="<?php echo esc_attr( $block_read_more_1 ); ?>" style="min-width:310px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_url_1' ); ?>"><?php _e( 'URL:', 'wen-business' ); ?></label>
          <input id="<?php echo $this->get_field_id( 'block_url_1' ); ?>" name="<?php echo $this->get_field_name( 'block_url_1' ); ?>" type="text" value="<?php echo esc_attr( $block_url_1 ); ?>" style="min-width:310px;" />
        </p>
        <h4 class="block-heading"><?php printf( __( 'Block %d','wen-business' ), 2 ); ?></h4>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_title_2' ); ?>"><?php _e( 'Title:', 'wen-business' ); ?></label>
          <input id="<?php echo $this->get_field_id( 'block_title_2' ); ?>" name="<?php echo $this->get_field_name( 'block_title_2' ); ?>" type="text" value="<?php echo esc_attr( $block_title_2 ); ?>" style="min-width:310px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_icon_2' ); ?>"><?php _e( 'Icon:', 'wen-business' ); ?></label>
          <input  id="<?php echo $this->get_field_id( 'block_icon_2' ); ?>" name="<?php echo $this->get_field_name( 'block_icon_2' ); ?>" type="text" value="<?php echo esc_attr( $block_icon_2 ); ?>" />&nbsp;<em><?php _e( 'eg: fa-cogs', 'wen-business' ); ?>&nbsp;<a href="<?php echo esc_url( 'http://fontawesome.io/cheatsheet/' ); ?>" target="_blank" title="<?php _e( 'View Reference', 'wen-business' ); ?>"><?php _e( 'Reference', 'wen-business' ); ?></a></em>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_description_2' ); ?>"><?php _e( 'Intro:', 'wen-business' ); ?></label>
          <textarea class="widefat" rows="3" id="<?php echo $this->get_field_id( 'block_description_2' ); ?>" name="<?php echo $this->get_field_name( 'block_description_2' ); ?>"><?php echo $block_description_2; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_read_more_2' ); ?>"><?php _e( 'More Text:', 'wen-business' ); ?></label>
          <input  id="<?php echo $this->get_field_id( 'block_read_more_2' ); ?>" name="<?php echo $this->get_field_name( 'block_read_more_2' ); ?>" type="text" value="<?php echo esc_attr( $block_read_more_2 ); ?>" style="min-width:310px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_url_2' ); ?>"><?php _e( 'URL:', 'wen-business' ); ?></label>
          <input id="<?php echo $this->get_field_id( 'block_url_2' ); ?>" name="<?php echo $this->get_field_name( 'block_url_2' ); ?>" type="text" value="<?php echo esc_attr( $block_url_2 ); ?>" style="min-width:310px;" />
        </p>
        <h4 class="block-heading"><?php printf( __( 'Block %d','wen-business' ), 3 ); ?></h4>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_title_3' ); ?>"><?php _e( 'Title:', 'wen-business' ); ?></label>
          <input id="<?php echo $this->get_field_id( 'block_title_3' ); ?>" name="<?php echo $this->get_field_name( 'block_title_3' ); ?>" type="text" value="<?php echo esc_attr( $block_title_3 ); ?>" style="min-width:310px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_icon_3' ); ?>"><?php _e( 'Icon:', 'wen-business' ); ?></label>
          <input  id="<?php echo $this->get_field_id( 'block_icon_3' ); ?>" name="<?php echo $this->get_field_name( 'block_icon_3' ); ?>" type="text" value="<?php echo esc_attr( $block_icon_3 ); ?>" />&nbsp;<em><?php _e( 'eg: fa-cogs', 'wen-business' ); ?>&nbsp;<a href="<?php echo esc_url( 'http://fontawesome.io/cheatsheet/' ); ?>" target="_blank" title="<?php _e( 'View Reference', 'wen-business' ); ?>"><?php _e( 'Reference', 'wen-business' ); ?></a></em>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_description_3' ); ?>"><?php _e( 'Intro:', 'wen-business' ); ?></label>
          <textarea class="widefat" rows="3" id="<?php echo $this->get_field_id( 'block_description_3' ); ?>" name="<?php echo $this->get_field_name( 'block_description_3' ); ?>"><?php echo $block_description_3; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_read_more_3' ); ?>"><?php _e( 'More Text:', 'wen-business' ); ?></label>
          <input  id="<?php echo $this->get_field_id( 'block_read_more_3' ); ?>" name="<?php echo $this->get_field_name( 'block_read_more_3' ); ?>" type="text" value="<?php echo esc_attr( $block_read_more_3 ); ?>" style="min-width:310px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_url_3' ); ?>"><?php _e( 'URL:', 'wen-business' ); ?></label>
          <input id="<?php echo $this->get_field_id( 'block_url_3' ); ?>" name="<?php echo $this->get_field_name( 'block_url_3' ); ?>" type="text" value="<?php echo esc_attr( $block_url_3 ); ?>" style="min-width:310px;" />
        </p>
        <h4 class="block-heading"><?php printf( __( 'Block %d','wen-business' ), 4 ); ?></h4>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_title_4' ); ?>"><?php _e( 'Title:', 'wen-business' ); ?></label>
          <input id="<?php echo $this->get_field_id( 'block_title_4' ); ?>" name="<?php echo $this->get_field_name( 'block_title_4' ); ?>" type="text" value="<?php echo esc_attr( $block_title_4 ); ?>" style="min-width:310px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_icon_4' ); ?>"><?php _e( 'Icon:', 'wen-business' ); ?></label>
          <input  id="<?php echo $this->get_field_id( 'block_icon_4' ); ?>" name="<?php echo $this->get_field_name( 'block_icon_4' ); ?>" type="text" value="<?php echo esc_attr( $block_icon_4 ); ?>" />&nbsp;<em><?php _e( 'eg: fa-cogs', 'wen-business' ); ?>&nbsp;<a href="<?php echo esc_url( 'http://fontawesome.io/cheatsheet/' ); ?>" target="_blank" title="<?php _e( 'View Reference', 'wen-business' ); ?>"><?php _e( 'Reference', 'wen-business' ); ?></a></em>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_description_4' ); ?>"><?php _e( 'Intro:', 'wen-business' ); ?></label>
          <textarea class="widefat" rows="3" id="<?php echo $this->get_field_id( 'block_description_4' ); ?>" name="<?php echo $this->get_field_name( 'block_description_4' ); ?>"><?php echo $block_description_4; ?></textarea>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_read_more_4' ); ?>"><?php _e( 'More Text:', 'wen-business' ); ?></label>
          <input  id="<?php echo $this->get_field_id( 'block_read_more_4' ); ?>" name="<?php echo $this->get_field_name( 'block_read_more_4' ); ?>" type="text" value="<?php echo esc_attr( $block_read_more_4 ); ?>" style="min-width:310px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'block_url_4' ); ?>"><?php _e( 'URL:', 'wen-business' ); ?></label>
          <input id="<?php echo $this->get_field_id( 'block_url_4' ); ?>" name="<?php echo $this->get_field_name( 'block_url_4' ); ?>" type="text" value="<?php echo esc_attr( $block_url_4 ); ?>" style="min-width:310px;" />
        </p>
        <?php
      }
  }

endif;


if ( ! class_exists( 'WEN_Business_Latest_Works_Widget' ) ) :

  /**
   * Latest Works Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Latest_Works_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_latest_works',
                  'description' => __( 'Latest Works Widget', 'wen-business' ),
                  'customize_selective_refresh' => true,
              );

      parent::__construct('wen-business-latest-works', __( 'Latest Works Widget', 'wen-business'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title          = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle       = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base );
        $post_category     = ! empty( $instance['post_category'] ) ? $instance['post_category'] : 0;
        $post_column       = ! empty( $instance['post_column'] ) ? $instance['post_column'] : 4;
        $featured_image    = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'thumbnail';
        $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 4;
        $excerpt_length    = ! empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 40;
        $post_order_by     = ! empty( $instance['post_order_by'] ) ? $instance['post_order_by'] : 'date';
        $post_order        = ! empty( $instance['post_order'] ) ? $instance['post_order'] : 'desc';
        $more_text         = ! empty( $instance['more_text'] ) ? $instance['more_text'] : __( 'Read more','wen-business' );
        $disable_date      = ! empty( $instance['disable_date'] ) ? $instance['disable_date'] : false ;
        $disable_comment   = ! empty( $instance['disable_comment'] ) ? $instance['disable_comment'] : false ;
        $disable_excerpt   = ! empty( $instance['disable_excerpt'] ) ? $instance['disable_excerpt'] : false ;
        $disable_more_text = ! empty( $instance['disable_more_text'] ) ? $instance['disable_more_text'] : false ;
        $custom_class   = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

        // Validation
        // Order
        if ( in_array( $post_order, array( 'asc', 'desc' ) ) ) {
          $post_order = strtoupper( $post_order );
        }
        else{
          $post_order = 'DESC';
        }
        // Order By
        switch ( $post_order_by ) {
          case 'date':
            $post_order_by = 'date';
            break;
          case 'title':
            $post_order_by = 'title';
            break;
          case 'comment-count':
            $post_order_by = 'comment_count';
            break;
          case 'random':
            $post_order_by = 'rand';
            break;
          case 'menu-order':
            $post_order_by = 'menu_order';
            break;
          default:
            $post_order_by = 'date';
            break;
        }
        // Column class
        switch ( $post_column ) {
          case 1:
            $column_class = 'col-sm-12';
            break;
          case 2:
            $column_class = 'col-sm-6';
            break;
          case 3:
            $column_class = 'col-sm-4';
            break;
          case 4:
            $column_class = 'col-sm-3';
            break;
          case 5:
            $column_class = 'col-sm-5ths';
            break;
          case 6:
            $column_class = 'col-sm-2';
            break;
          default:
            $column_class = '';
            break;
        }


        // Add Custom class
        if ( $custom_class ) {
          $before_widget = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
        }

        echo $before_widget;

        // Title
        if ( $title ) echo $before_title . $title . $after_title;

        // Sub Title
        if ( $subtitle ) printf( '%s%s%s', '<h4 class="widget-subtitle">', $subtitle, '</h4>' );
        //
        ?>
        <?php
          $qargs = array(
            'posts_per_page' => $post_number,
            'no_found_rows'  => true,
            'orderby'        => $post_order_by,
            'order'          => $post_order,
            'meta_query'     => array(
                array( 'key' => '_thumbnail_id' ), //Show only posts with featured images
              )
            );
          if ( absint( $post_category ) > 0 ) {
            $qargs['cat'] = $post_category;
          }

          $all_posts = get_posts( $qargs );
        ?>
        <?php if ( ! empty( $all_posts ) ): ?>


          <?php global $post; ?>

          <div class="latest-works-widget">

            <div class="row">

              <?php foreach ( $all_posts as $key => $post ): ?>
                <?php setup_postdata( $post ); ?>

                <div class="latest-works-item <?php echo esc_attr( $column_class ); ?>">

                  <div class="latest-works-thumb">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                      <?php
                        $img_attributes = array( 'class' => 'aligncenter' );
                        the_post_thumbnail( $featured_image, $img_attributes );
                      ?>
                    </a>
                  </div><!-- .latest-works-thumb -->


                </div><!-- .latest-works-item -->

              <?php endforeach ?>

            </div><!-- .row -->

          </div><!-- .latest-works-widget -->

          <?php wp_reset_postdata(); // Reset ?>

        <?php endif; ?>
        <?php
        //
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']          = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle']       = sanitize_text_field( $new_instance['subtitle'] );
		$instance['post_category']  = absint( $new_instance['post_category'] );
		$instance['post_number']    = absint( $new_instance['post_number'] );
		$instance['post_column']    = absint( $new_instance['post_column'] );
		$instance['post_order_by']  = esc_attr( $new_instance['post_order_by'] );
		$instance['post_order']     = esc_attr( $new_instance['post_order'] );
		$instance['featured_image'] = esc_attr( $new_instance['featured_image'] );
		$instance['custom_class']   = esc_attr( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array(
          'title'             => '',
          'subtitle'          => '',
          'post_category'     => '',
          'post_column'       => 4,
          'featured_image'    => 'thumbnail',
          'post_number'       => 4,
          'post_order_by'     => 'date',
          'post_order'        => 'desc',
          'custom_class'      => '',
        ) );
        $title             = strip_tags( $instance['title'] );
        $subtitle          = esc_textarea( $instance['subtitle'] );
        $post_category     = absint( $instance['post_category'] );
        $post_column       = absint( $instance['post_column'] );
        $featured_image    = esc_attr( $instance['featured_image'] );
        $post_number       = absint( $instance['post_number'] );
        $post_order_by     = esc_attr( $instance['post_order_by'] );
        $post_order        = esc_attr( $instance['post_order'] );
        $custom_class      = esc_attr( $instance['custom_class'] );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Sub Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_category' ); ?>"><?php _e( 'Category:', 'wen-business' ); ?></label>
          <?php
            $cat_args = array(
                'orderby'         => 'name',
                'hide_empty'      => 0,
                'taxonomy'        => 'category',
                'name'            => $this->get_field_name('post_category'),
                'id'              => $this->get_field_id('post_category'),
                'selected'        => $post_category,
                'show_option_all' => __( 'All Categories','wen-business' ),
              );
            wp_dropdown_categories( $cat_args );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_column' ); ?>"><?php _e('Number of Columns:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_post_columns( array(
              'id'       => $this->get_field_id( 'post_column' ),
              'name'     => $this->get_field_name( 'post_column' ),
              'selected' => $post_column,
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'featured_image' ); ?>"><?php _e( 'Featured Image:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_image_sizes( array(
              'id'       => $this->get_field_id( 'featured_image' ),
              'name'     => $this->get_field_name( 'featured_image' ),
              'selected' => $featured_image,
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e('Number of Posts:', 'wen-business' ); ?></label>
          <input class="widefat1" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo esc_attr( $post_number ); ?>" min="1" style="max-width:50px;" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_order_by' ); ?>"><?php _e( 'Order By:', 'wen-business' ); ?></label>
          <?php
            $this->dropdown_post_order_by( array(
              'id'       => $this->get_field_id( 'post_order_by' ),
              'name'     => $this->get_field_name( 'post_order_by' ),
              'selected' => $post_order_by,
              )
            );
          ?>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e( 'Order:', 'wen-business' ); ?></label>
          <select id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' ); ?>">
            <option value="asc" <?php selected( $post_order, 'asc' ) ?>><?php _e( 'Ascending', 'wen-business' ) ?></option>
            <option value="desc" <?php selected( $post_order, 'desc' ) ?>><?php _e( 'Descending', 'wen-business' ) ?></option>
          </select>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>
        <?php
      }

    function dropdown_post_columns( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = array(
        '1' => sprintf( __( '%d Column','wen-business' ), 1 ),
        '2' => sprintf( __( '%d Columns','wen-business' ), 2 ),
        '3' => sprintf( __( '%d Columns','wen-business' ), 3 ),
        '4' => sprintf( __( '%d Columns','wen-business' ), 4 ),
      );

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    function dropdown_post_order_by( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = array(
        'date'          => __( 'Date','wen-business' ),
        'title'         => __( 'Title','wen-business' ),
        'comment-count' => __( 'Comment Count','wen-business' ),
        'menu-order'    => __( 'Menu Order','wen-business' ),
        'random'        => __( 'Random','wen-business' ),
      );

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    function dropdown_image_sizes( $args ){
      $defaults = array(
        'id'       => '',
        'name'     => '',
        'selected' => 0,
        'echo'     => 1,
      );

      $r = wp_parse_args( $args, $defaults );
      $output = '';

      $choices = $this->get_image_sizes_options();

      if ( ! empty( $choices ) ) {

        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
        foreach ( $choices as $key => $choice ) {
          $output .= '<option value="' . esc_attr( $key ) . '" ';
          $output .= selected( $r['selected'], $key, false );
          $output .= '>' . esc_html( $choice ) . '</option>\n';
        }
        $output .= "</select>\n";
      }

      if ( $r['echo'] ) {
        echo $output;
      }
      return $output;

    }

    private function get_image_sizes_options(){

      global $_wp_additional_image_sizes;
      $get_intermediate_image_sizes = get_intermediate_image_sizes();
      $choices = array();
      foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
        $choices[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
      }
      $choices['full'] = __( 'full (original)', 'wen-business' );
      if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {

        foreach ($_wp_additional_image_sizes as $key => $size ) {
          $choices[ $key ] = $key . ' ('. $size['width'] . 'x' . $size['height'] . ')';
        }

      }
      return $choices;
    }

  }

endif;

if ( ! class_exists( 'WEN_Business_Contact_Widget' ) ) :

  /**
   * Contact Widget Class
   *
   * @since WEN Business 1.0
   *
   */
  class WEN_Business_Contact_Widget extends WP_Widget {

    function __construct() {
      $opts = array(
                  'classname'   => 'wen_business_widget_contact',
                  'description' => __( 'Contact Widget', 'wen-business' ),
                  'customize_selective_refresh' => true,
              );

      parent::__construct('wen-business-contact', __( 'Contact Widget', 'wen-business'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title           = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );
        $subtitle        = apply_filters('widget_subtitle', empty($instance['subtitle']) ? '' : $instance['subtitle'], $instance, $this->id_base );
        $contact_address = ! empty( $instance['contact_address'] ) ? $instance['contact_address'] : '';
        $contact_phone   = ! empty( $instance['contact_phone'] ) ? $instance['contact_phone'] : '';
        $contact_email   = ! empty( $instance['contact_email'] ) ? $instance['contact_email'] : '';
        $contact_time    = ! empty( $instance['contact_time'] ) ? $instance['contact_time'] : '';
        $custom_class    = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

        if ( $custom_class ) {
          $before_widget = str_replace( 'class="', 'class="'. $custom_class . ' ', $before_widget );
        }

        echo $before_widget;

        // Title
        if ( $title ) echo $before_title . $title . $after_title;

        // Sub Title
        if ( $subtitle ) printf( '%s%s%s', '<h4 class="widget-subtitle">', $subtitle, '</h4>' );
        //
        $contact_arr = array();
        // Arrange contact address
        if ( ! empty( $contact_address )) {
          $contact_arr['address'] = ! empty( $instance['filter'] ) ? wpautop( $contact_address ) : $contact_address;
        }
        if ( ! empty( $contact_phone )) {
          $contact_arr['phone'] = $contact_phone;
        }
        if ( ! empty( $contact_email )) {
          $contact_arr['email'] = $contact_email;
        }
        if ( ! empty( $contact_time )) {
          $contact_arr['time'] = $contact_time;
        }
        // Render now
        if ( ! empty( $contact_arr ) ){
          echo '<div class="contact-widget">';
          $this->render_contact( $contact_arr );
          echo '</div>';
        }
        //
        echo $after_widget;

    }

    function render_contact( $contact_arr ){
      if ( empty( $contact_arr ) ) {
        return;
      }
      echo '<ul>';
      foreach ( $contact_arr as $key => $c ) {
        echo '<li class="contact-' . esc_attr( $key ) . '">';
        echo wp_kses_post( $c );
        echo '</li>';
      }
      echo '</ul>';
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		$instance['title']           = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle']        = sanitize_text_field( $new_instance['subtitle'] );
		$instance['contact_address'] = wp_kses_post( $new_instance['contact_address'] );
		$instance['filter']          = isset( $new_instance['filter'] );
		$instance['contact_phone']   = esc_html( $new_instance['contact_phone'] );
		$instance['contact_email']   = esc_html( $new_instance['contact_email'] );
		$instance['contact_time']    = esc_html( $new_instance['contact_time'] );
		$instance['custom_class']    = esc_attr( $new_instance['custom_class'] );

        return $instance;
    }

      function form( $instance ) {

        // Defaults.
        $instance = wp_parse_args( (array) $instance, array(
          'title'           => '',
          'subtitle'        => '',
          'contact_address' => '',
          'filter'          => 1,
          'contact_phone'   => '',
          'contact_email'   => '',
          'contact_time'    => '',
          'custom_class'    => '',
        ) );
        $title           = strip_tags( $instance['title'] );
        $subtitle        = esc_textarea( $instance['subtitle'] );
        $contact_address = esc_textarea( $instance['contact_address'] );
        $filter          = esc_attr( $instance['filter'] );
        $contact_phone   = esc_textarea( $instance['contact_phone'] );
        $contact_email   = esc_textarea( $instance['contact_email'] );
        $contact_time    = esc_textarea( $instance['contact_time'] );
        $custom_class    = esc_attr( $instance['custom_class'] );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Sub Title:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'contact_address' ); ?>"><?php _e( 'Address:', 'wen-business' ); ?></label>
          <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'contact_address' ); ?>" name="<?php echo $this->get_field_name( 'contact_address' ); ?>"><?php echo $contact_address; ?></textarea>
        </p>
        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e( 'Automatically add paragraphs', 'wen-business' ); ?></label>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'contact_phone' ); ?>"><?php _e( 'Phone:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'contact_phone'); ?>" name="<?php echo $this->get_field_name('contact_phone'); ?>" type="text" value="<?php echo esc_attr( $contact_phone ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'contact_email' ); ?>"><?php _e( 'Email:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'contact_email'); ?>" name="<?php echo $this->get_field_name('contact_email'); ?>" type="email" value="<?php echo esc_attr( $contact_email ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'contact_time' ); ?>"><?php _e( 'Time:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'contact_time'); ?>" name="<?php echo $this->get_field_name('contact_time'); ?>" type="text" value="<?php echo esc_attr( $contact_time ); ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Custom Class:', 'wen-business' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'custom_class'); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" />
        </p>
        <?php
      }
  }

endif;

