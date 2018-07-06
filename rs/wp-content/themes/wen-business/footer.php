<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WEN Business
 */
?>


  <?php
    /**
     * wen_business_action_after_content hook
     *
     * @hooked wen_business_content_end - 10
     *
     */
    do_action( 'wen_business_action_after_content' );
  ?>


  <?php
    /**
     * wen_business_action_before_footer hook
     *
     * @hooked wen_business_footer_start - 10
     *
     */
    do_action( 'wen_business_action_before_footer' );
  ?>
    <?php
      /**
       * wen_business_action_footer hook
       *
       * @hooked wen_business_site_info - 10
       *
       */
      do_action( 'wen_business_action_footer' );
    ?>
  <?php
    /**
     * wen_business_action_after_footer hook
     *
     * @hooked wen_business_footer_end - 10
     *
     */
    do_action( 'wen_business_action_after_footer' );
  ?>


<?php
  /**
   * wen_business_action_after hook
   *
   * @hooked wen_business_page_end - 10
   * @hooked wen_business_footer_goto_top - 20
   *
   */
  do_action( 'wen_business_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
