<?php
	get_header();

	$page_sidebar_layout = apply_filters('cactus_page_sidebar_layout',cactus_option('blog_sidebar_layout'));
	switch($page_sidebar_layout){
		case 'left':
			$aside_class = 'left-aside';
		break;
		case 'right':
			$aside_class = 'right-aside';
		break;
		default:
			$aside_class = 'no-aside';
		break;
		
		};
?>
<?php echo apply_filters('cactus_page_title_bar','','post');?> 
<div class="page-wrap">
<?php do_action('cactus_before_page_wrap');?>
  <div class="container">
    <div class="page-inner row <?php echo $aside_class; ?>">
      <div class="col-main">
        <section class="post-main" role="main" id="content">
          <article class="post-entry text-left">
            <?php do_action('cactus_before_post_content');?>
            <?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );

					the_posts_pagination( array(
					'prev_text' => '<i class="fa fa-arrow-left"></i><span class="screen-reader-text">' . __( 'Previous page', 'cactus' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'cactus' ) . '</span><i class="fa fa-arrow-right"></i>' ,
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cactus' ) . ' </span>',
				) );

				endwhile; // End of the loop.
			?>
            <?php do_action('cactus_after_post_content');?>
            
            <div class="entry-footer clearfix">
              <div class="pull-left"> 
              <?php
				  if(get_the_tag_list()) {
					  echo get_the_tag_list(__( 'Tags:', 'cactus' ),', ');
				  }
				  
				  $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				  ?>
             </div>
            </div>
          </article>
          <div class="post-attributes">
            <!--About Author-->
            <div class="about-author">
              <div class="author-avatar"> <?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?> </div>
              <div class="author-description">
                 <h3><?php the_author_link(); ?></h3>
                <?php the_author_meta('description');?>
              </div>
            </div>
            <?php if ( comments_open() ) :?>
            <!--Comments Area-->
            <div class="comments-area text-left">
              <?php
						comments_template();
			  ?>
            </div>
             <?php endif;?>
          </div>
        </section>
      </div>
      <?php cactus_get_sidebar($page_sidebar_layout,'blog');?>
    </div>
  </div>
</div>

<?php get_footer();