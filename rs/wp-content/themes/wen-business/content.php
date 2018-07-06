<?php
/**
 * @package WEN Business
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php wen_business_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

  <?php
    $archive_layout =  wen_business_get_option( 'archive_layout' );
   ?>
   <?php
    if ( 'excerpt' == $archive_layout || 'excerpt-thumb' == $archive_layout  ) {
      ?>
    	<div class="entry-summary">
        <?php if ( 'excerpt-thumb' == $archive_layout ): ?>
          <?php if ( has_post_thumbnail() ): ?>
            <?php the_post_thumbnail( 'large', array( 'class' => 'aligncenter' ) ); ?>
          <?php endif ?>
        <?php endif ?>
        <?php the_excerpt(); ?>
      </div><!-- .entry-summary -->
      <?php
    }
    else{
      ?>
      <div class="entry-content">
        <?php if ( has_post_thumbnail() ): ?>
          <?php the_post_thumbnail( 'large', array( 'class' => 'aligncenter' )); ?>
        <?php endif ?>
    		<?php
    			/* translators: %s: Name of current post */
    			the_content( sprintf(
    				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'wen-business' ),
    				the_title( '<span class="screen-reader-text">"', '"</span>', false )
    			) );
    		?>

    		<?php
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . __( 'Pages:', 'wen-business' ),
    				'after'  => '</div>',
    			) );
    		?>
    	</div><!-- .entry-content -->

      <?php
    }
   ?>

	<footer class="entry-footer">
		<?php wen_business_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
