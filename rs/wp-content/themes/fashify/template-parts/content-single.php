<?php
/**
 * Template part for displaying page content in single.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fashify
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php fashify_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-thumb">
        <?php the_post_thumbnail( 'full' ); ?>
    </div>
    <?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fashify' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
	the_post_navigation( array(
			'prev_text'                  => '<span>' . esc_html__( 'Previous article', 'fashify' ) .'</span> %title',
			'next_text'                  => '<span>' . esc_html__( 'Next article', 'fashify' ) .'</span> %title',
			'in_same_term'               => true,
			'screen_reader_text' 		 => esc_html__( 'Continue Reading', 'fashify' ),
	) );
	?>

	<footer class="entry-footer">
		<?php fashify_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
