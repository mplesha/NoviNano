<?php

/**
 * Add custom CSS
 *
 * @since  WEN Business 1.0
 */

if( ! function_exists( 'wen_business_add_custom_css' ) ) :

  function wen_business_add_custom_css(){

    $custom_css = wen_business_get_option( 'custom_css' );
    $output = '';
    if ( ! empty( $custom_css ) ) {
      $output = "\n" . '<style type="text/css">' . "\n";
      $output .= esc_textarea( $custom_css ) ;
      $output .= "\n" . '</style>' . "\n" ;
    }
    echo $output;

  }

endif;
add_action( 'wp_head', 'wen_business_add_custom_css' );

if( ! function_exists( 'wen_business_add_sidebar' ) ) :

  /**
   * Add sidebar
   *
   * @since  WEN Business 1.0
   */
  function wen_business_add_sidebar(){

    global $post;

    $global_layout = wen_business_get_option( 'global_layout' );

    // Check if single
    if ( $post && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }

    // Include sidebar
    if ( 'no-sidebar' != $global_layout ) {
      get_sidebar();
    }
    if ( 'three-columns' == $global_layout ) {
      get_sidebar( 'secondary' );
    }

  }

endif;
add_action( 'wen_business_action_sidebar', 'wen_business_add_sidebar' );

if( ! function_exists( 'wen_business_add_contact_sidebar' ) ) :

  /**
   * Add contact sidebar
   *
   * @since  WEN Business 1.0
   */
  function wen_business_add_contact_sidebar(){

    global $post;

    $global_layout = wen_business_get_option( 'global_layout' );

    // Check if single
    if ( $post && is_singular() ) {
      $post_options = get_post_meta( $post->ID, 'theme_settings', true );
      if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
        $global_layout = $post_options['post_layout'];
      }
    }

    // Include sidebar
    if ( 'no-sidebar' != $global_layout ) {
      get_sidebar('contact');
    }
    if ( 'three-columns' == $global_layout ) {
      get_sidebar( 'secondary' );
    }

  }

endif;
add_action( 'wen_business_action_contact_sidebar', 'wen_business_add_contact_sidebar' );

if( ! function_exists( 'wen_business_add_image_in_single_display' ) ) :

  /**
   * Add image in single post
   *
   * @since  WEN Business 1.0
   */
  function wen_business_add_image_in_single_display(){

    global $post;

    if ( has_post_thumbnail() ){

      $values = get_post_meta( $post->ID, 'theme_settings', true );
      $theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
      $theme_settings_single_image_alignment = isset( $values['single_image_alignment'] ) ? esc_attr( $values['single_image_alignment'] ) : '';

      if ( ! $theme_settings_single_image ) {
        $theme_settings_single_image = wen_business_get_option( 'single_image' );
      }
      if ( ! $theme_settings_single_image_alignment ) {
        $theme_settings_single_image_alignment = wen_business_get_option( 'single_image_alignment' );
      }

      if ( 'disable' != $theme_settings_single_image ) {
        $args = array(
          'class' => 'align' . $theme_settings_single_image_alignment,
        );
        the_post_thumbnail( $theme_settings_single_image, $args );
      }

    }

  }

endif;
add_action( 'wen_business_single_image', 'wen_business_add_image_in_single_display' );

if ( ! function_exists( 'wen_business_custom_posts_navigation' ) ) :

  /**
   * Posts navigation
   *
   * @since WEN Business 1.0
   *
   */
  function wen_business_custom_posts_navigation() {

    $pagination_type = wen_business_get_option( 'pagination_type' );

    switch ( $pagination_type ) {

      case 'default':
        the_posts_navigation();
        break;

      case 'numeric':
        if ( function_exists( 'wp_pagenavi' ) ){
          wp_pagenavi();
        }
        else{
          the_posts_navigation();
        }
        break;

      default:
        break;
    }

  }
endif;

add_action( 'wen_business_action_posts_navigation', 'wen_business_custom_posts_navigation' );

if( ! function_exists( 'wen_business_implement_excerpt_length' ) ) :

  /**
   * Implement excerpt length
   *
   * @since  WEN Business 1.0
   */
  function wen_business_implement_excerpt_length( $length ){

    $excerpt_length = wen_business_get_option( 'excerpt_length' );
    if ( empty( $excerpt_length) ) {
      $excerpt_length = $length;
    }
    return apply_filters( 'wen_business_filter_excerpt_length', esc_attr( $excerpt_length ) );

  }

endif;

add_filter( 'excerpt_length', 'wen_business_implement_excerpt_length', 999 );

if( ! function_exists( 'wen_business_implement_read_more' ) ) :

  /**
   * Implement read more in excerpt.
   *
   * @since  WEN Business 1.0
   */
  function wen_business_implement_read_more( $more ){

    $flag_apply_excerpt_read_more = apply_filters( 'wen_business_filter_excerpt_read_more', true );
    if ( true != $flag_apply_excerpt_read_more ) {
      return $more;
    }

    $output = $more;
    $read_more_text = wen_business_get_option( 'read_more_text' );
    if ( ! empty( $read_more_text ) ) {
      $output = ' <a href="'. esc_url( get_permalink() ) . '" class="read-more">' . esc_html( $read_more_text ) . '</a>';
      $output = apply_filters( 'wen_business_filter_read_more_link' , $output );
    }
    return $output;

  }

endif;
add_filter( 'excerpt_more', 'wen_business_implement_read_more' );

if( ! function_exists( 'wen_business_content_more_link' ) ) :

  /**
   * Implement read more in content.
   *
   * @since  WEN Business 1.0
   */
  function wen_business_content_more_link( $more_link, $more_link_text ) {

    $flag_apply_excerpt_read_more = apply_filters( 'wen_business_filter_excerpt_read_more', true );
    if ( true != $flag_apply_excerpt_read_more ) {
      return $more_link;
    }

    $read_more_text = wen_business_get_option( 'read_more_text' );
    if ( ! empty( $read_more_text ) ) {
      $more_link =  str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
    }
    return $more_link;

  }

endif;

add_filter( 'the_content_more_link', 'wen_business_content_more_link', 10, 2 );


if( ! function_exists( 'wen_business_exclude_category_in_blog_page' ) ) :

  /**
   * Exclude category in blog page
   *
   * @since  WEN Business 1.0
   */
  function wen_business_exclude_category_in_blog_page( $query ) {

    if( $query->is_home && $query->is_main_query()   ) {
      $exclude_categories = wen_business_get_option( 'exclude_categories' );
      if ( ! empty( $exclude_categories ) ) {
        $cats = explode( ',', $exclude_categories );
        $cats = array_filter( $cats, 'is_numeric' );
        $string_exclude = '';
        if ( ! empty( $cats ) ) {
          $string_exclude = '-' . implode( ',-', $cats);
          $query->set( 'cat', $string_exclude );
        }
      }
    }
    return $query;

  }

endif;

add_filter( 'pre_get_posts', 'wen_business_exclude_category_in_blog_page' );


add_action( 'wen_business_action_before_content', 'wen_business_add_breadcrumb' , 7 );

if( ! function_exists( 'wen_business_add_breadcrumb' ) ) :

  /**
   * Add breadcrumb
   *
   * @since  WEN Business 1.0
   */
  function wen_business_add_breadcrumb(){

    // Bail if Breadcrumb disabled
    $breadcrumb_type = wen_business_get_option( 'breadcrumb_type' );
    if ( 'disabled' == $breadcrumb_type ) {
      return;
    }
    // Bail if plugin not active
    // Bail if Home Page
    if ( is_front_page() || is_home() ) {
      return;
    }

    echo '<div id="breadcrumb"><div class="container">';
    switch ( $breadcrumb_type ) {
      case 'simple':
        $breadcrumb_separator = wen_business_get_option( 'breadcrumb_separator' );
        $args = array(
          'separator'     => $breadcrumb_separator,
        );
        wen_business_simple_breadcrumb( $args );
        break;

      case 'advanced':
        if ( function_exists( 'bcn_display' ) ) {
          bcn_display();
        }
        break;

      default:
        # code...
        break;
    }
    //
    echo '</div><!-- .container --></div><!-- #breadcrumb -->';
    return;

  }

endif;

if( ! function_exists( 'wen_business_simple_breadcrumb' ) ) :

  /**
   * Simple breadcrumb
   *
   * Source: https://gist.github.com/melissacabral/4032941
   *
   * @since  WEN Business 1.0
   */

  function wen_business_simple_breadcrumb( $args = array() ){

    $args = wp_parse_args( (array) $args, array(
      'separator' =>  '&gt;',
      ) );

    /* === OPTIONS === */
    $text['home']     = get_bloginfo( 'name' ); // text for the 'Home' link
    $text['category'] = __( 'Archive for <em>%s</em>', 'wen-business' ); // text for a category page
    $text['tax']      = __( 'Archive for <em>%s</em>', 'wen-business' ); // text for a taxonomy page
    $text['search']   = __( 'Search results for: <em>%s</em>', 'wen-business' ); // text for a search results page
    $text['tag']      = __( 'Posts tagged <em>%s</em>', 'wen-business' ); // text for a tag page
    $text['author']   = __( 'View all posts by <em>%s</em>', 'wen-business' ); // text for an author page
    $text['404']      = __( 'Error 404', 'wen-business' ); // text for the 404 page

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ' ' . $args['separator'] . ' '; // delimiter between crumbs
    $before      = '<span class="current">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */

    global $post;
    $homeLink   = esc_url( home_url( '/' ) );
    $linkBefore = '<span typeof="v:Breadcrumb">';
    $linkAfter  = '</span>';
    $linkAttr   = ' rel="v:url" property="v:title"';
    $link       = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

    if (is_home() || is_front_page()) {

      if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

    } else {

      echo '<div id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;


      if ( is_category() ) {
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent != 0) {
          $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
          $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
          $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
          echo $cats;
        }
        echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

      } elseif( is_tax() ){
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent != 0) {
          $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
          $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
          $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
          echo $cats;
        }
        echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;

      }elseif ( is_search() ) {
        echo $before . sprintf($text['search'], get_search_query()) . $after;

      } elseif ( is_day() ) {
        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
        echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
        echo $before . get_the_time('d') . $after;

      } elseif ( is_month() ) {
        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
        echo $before . get_the_time('F') . $after;

      } elseif ( is_year() ) {
        echo $before . get_the_time('Y') . $after;

      } elseif ( is_single() && !is_attachment() ) {
        if ( get_post_type() != 'post' ) {
          $post_type = get_post_type_object(get_post_type());
          $slug = $post_type->rewrite;
          printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
          if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
        } else {
          $cat = get_the_category(); $cat = $cat[0];
          $cats = get_category_parents($cat, TRUE, $delimiter);
          if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
          $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
          $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
          echo $cats;
          if ($showCurrent == 1) echo $before . get_the_title() . $after;
        }

      } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;

      } elseif ( is_attachment() ) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
        printf($link, get_permalink($parent), $parent->post_title);
        if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

      } elseif ( is_page() && !$post->post_parent ) {
        if ($showCurrent == 1) echo $before . get_the_title() . $after;

      } elseif ( is_page() && $post->post_parent ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $delimiter;
        }
        if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

      } elseif ( is_tag() ) {
        echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

      } elseif ( is_author() ) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . sprintf($text['author'], $userdata->display_name) . $after;

      } elseif ( is_404() ) {
        echo $before . $text['404'] . $after;
      }

      if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
        echo __( 'Page', 'wen-business' ) . ' ' . get_query_var('paged');
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
      }

      echo '</div>';

    }
  } // end wen_business_simple_breadcrumb()

endif;

if ( ! function_exists( 'wen_business_import_logo_image_field' ) ) :

	/**
	 * Import logo image field.
	 *
	 * @since 1.3
	 */
	function wen_business_import_logo_image_field() {

		if ( version_compare( $GLOBALS['wp_version'], '4.5-alpha', '<' ) ) {
			return;
		}
		$site_logo = wen_business_get_option( 'site_logo' );
		if ( empty( $site_logo ) ) {
			return;
		}
		$val = esc_url( $site_logo );
		global $wpdb;
		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $val ) );
		if ( ! empty( $attachment ) && absint( $attachment[0] ) > 0 ) {
			$attachment_id = array_shift( $attachment );
			set_theme_mod( 'custom_logo', $attachment_id );
			$all_options = wen_business_get_options();
			$all_options['site_logo'] = '';
			set_theme_mod( 'theme_options', $all_options );
		}

	}
	endif;

add_action( 'after_setup_theme', 'wen_business_import_logo_image_field', 20 );

if ( ! function_exists( 'wen_business_import_custom_css' ) ) :

	/**
	 * Import Custom CSS.
	 *
	 * @since 1.0.7
	 */
	function wen_business_import_custom_css() {

		// Bail if not WP 4.7.
		if ( ! function_exists( 'wp_get_custom_css_post' ) ) {
			return;
		}

		$custom_css = wen_business_get_option( 'custom_css' );

		// Bail if there is no Custom CSS.
		if ( empty( $custom_css ) ) {
			return;
		}

		$core_css = wp_get_custom_css();
		$return = wp_update_custom_css_post( $core_css . $custom_css );

		if ( ! is_wp_error( $return ) ) {

			// Remove from theme.
			$all_options = wen_business_get_options();
			$all_options['custom_css'] = '';
			set_theme_mod( 'theme_options', $all_options );
		}

	}
endif;

add_action( 'after_setup_theme', 'wen_business_import_custom_css', 99 );
