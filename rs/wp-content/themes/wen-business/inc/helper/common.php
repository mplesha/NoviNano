<?php
if( ! function_exists( 'wen_business_is_social_menu_active' ) ) :

  /**
   * Check if social menu is active.
   *
   * @since WEN Business 1.0.4
   * @return bool true/false
   */
  function wen_business_is_social_menu_active(){

    $is_menu_set = false;
    // Fetch nav
    $nav_menu_locations = get_nav_menu_locations();
    if ( isset( $nav_menu_locations['social'] ) && absint( $nav_menu_locations['social'] ) > 0 ) {
      $is_menu_set = true;
    }

    return $is_menu_set;

  }

endif;
