<?php
/**
 * Contact Sidebar Primary widget area.
 *
 * @package WEN Business
 */
?>

<?php
/**
 * wen_business_action_before_sidebar_primary hook
 */
do_action( 'wen_business_action_before_sidebar_primary' );?>

<div id="sidebar-primary" role="complementary" <?php wen_business_sidebar_primary_class( 'widget-area sidebar contact-sidebar' ); ?> >
  <?php if ( is_active_sidebar( 'sidebar-contact' ) ): ?>

    <?php dynamic_sidebar( 'sidebar-contact' ); ?>

  <?php else: ?>
    <?php
      $widget = 'WP_Widget_Text';
      $instance = array(
        'title' => __( 'Contact Sidebar', 'wen-business' ),
        'text'  => __( 'Widgets of Contact Sidebar will be displayed here.', 'wen-business' ),
      );
      $args = array(
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
      );
      the_widget( $widget, $instance, $args );
    ?>
  <?php endif ?>
</div><!-- #sidebar-primary -->
<?php
/**
 * wen_business_action_after_sidebar_primary hook
 */
do_action( 'wen_business_action_after_sidebar_primary' );?>

