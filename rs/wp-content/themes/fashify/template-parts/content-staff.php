<?php
/**
 * Template part for displaying staff picks post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fashify
 */
?>
<div class="footer-staff-picks">

	<div class="container">

		<h3><?php esc_html_e( 'Staff Picks', 'fashify' ); ?></h3>

        <div class="staff-inner">
    		<?php
            $cat_id = get_theme_mod( 'fashify_staff_picks_cat' );
            $number   = intval( get_theme_mod( 'number_staff_picks', 4 ) );
            $number   = ( 0 != $number ) ? $number : 4;
            $args = array(
				'posts_per_page' => $number,
				'ignore_sticky_posts' => true,
				'meta_query' => array( array( 'key' => '_thumbnail_id' ) )
			);
			if ( $cat_id != '') {
				$args['cat'] = $cat_id;
			}
            $staff_picks = new WP_Query( $args );

            if ( $staff_picks->have_posts() ) :
			    while( $staff_picks->have_posts() ): $staff_picks->the_post();
            ?>

			<article id="post-<?php the_ID(); ?>-recent" <?php post_class(); ?>>

				<?php if ( has_post_thumbnail() ) { ?>
				<div class="featured-image">
					<?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'fashify-thumb-layout3' ); ?></a><?php endif; ?>
				</div>
				<?php } ?>

				<header class="entry-header">

					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

				</header>

			</article>

            <?php
				endwhile;
            endif;
            ?>

    		<?php wp_reset_postdata(); ?>
        </div>
	</div>

</div>
