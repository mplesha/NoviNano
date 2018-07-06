<?php
/**
 * The default template for displaying header
 *
 * @package WEN Themes
 * @subpackage WEN Business
 * @since WEN Business 1.0
 */

  /**
   * wen_business_action_doctype hook
   *
   * @hooked wen_business_doctype -  10
   *
   */
  do_action( 'wen_business_action_doctype' );?>

<head>
<?php
  /**
   * wen_business_action_head hook
   *
   * @hooked wen_business_head -  10
   *
   */
  do_action( 'wen_business_action_head' );
?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
  /**
   * wen_business_action_before hook
   *
   * @hooked wen_business_page_start - 10
   *
   */
  do_action( 'wen_business_action_before' );
?>

  <?php
    /**
     * wen_business_action_before_header hook
     *
     * @hooked wen_business_header_top_content - 5
     * @hooked wen_business_header_start - 10
     *
     */
    do_action( 'wen_business_action_before_header' );
  ?>
    <?php
      /**
       * wen_business_action_header hook
       *
       * @hooked wen_business_site_branding - 10
       *
       */
      do_action( 'wen_business_action_header' );
    ?>
  <?php
    /**
     * wen_business_action_after_header hook
     *
     * @hooked wen_business_header_end - 10
     *
     */
    do_action( 'wen_business_action_after_header' );
  ?>

  <?php
    /**
     * wen_business_action_before_content hook
     *
     * @hooked wen_business_add_featured_slider - 5
     * @hooked wen_business_add_breadcrumb - 7
     * @hooked wen_business_content_start - 10
     *
     */
    do_action( 'wen_business_action_before_content' );
  ?>
    <?php
      /**
       * wen_business_action_content hook
       *
       */
      do_action( 'wen_business_action_content' );
    ?>

