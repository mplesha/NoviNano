<?php
	get_header();
		
?>
<?php echo apply_filters('cactus_page_title_bar','','');?>  
<div class="page-wrap">
<?php do_action('cactus_before_page_wrap');?>  
  <div class="container">
    <div class="page-inner row no-aside">
      <div class="col-main">
        <section class="post-main" role="main" id="content">
          <article class="post-entry text-left">
            <?php do_action('cactus_before_page_content');?>
           <h1><?php esc_attr_e('404 Nothing Found', 'cactus');?></h1>
<p><?php esc_attr_e('Sorry, the page could not be found.', 'cactus');?></p>
<a href="javascript:;" onClick="javascript :history.back(-1);"><span class="cactus-btn cactus-primary"><?php echo esc_attr('Go Back', 'cactus');?></span></a>
           <?php do_action('cactus_after_page_content');?>         
          </article>
          
        </section>
      </div>
    </div>
  </div>
</div>

<?php get_footer();