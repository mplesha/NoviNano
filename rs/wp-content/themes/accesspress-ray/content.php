<?php
/**
 * @package AccessPress Ray
 */
?>
<?php
global $accesspress_ray_options;
$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
$cat_testimonial = $accesspress_ray_settings['testimonial_cat'];
$cat_portfolio = $accesspress_ray_settings['portfolio_cat'];

if(!empty($cat_testimonial) && is_category() && is_category($cat_testimonial)): ?>

<article id="post-<?php the_ID(); ?>" class="cat-testimonial-list clearfix">
	<div class="cat-testimonial-image clearfix">
	<?php 
		if( has_post_thumbnail() ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'accesspress-ray-featured-thumbnail', false ); 
		?>
		<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
		<?php }else {?>	
		<img src="<?php echo get_template_directory_uri(); ?>/images/testimonial-fallback.png" alt="<?php the_title(); ?>">
		<?php }?>
	</div>
		
	<header class="entry-header">
	<h3><?php the_title(); ?></h3>
	</header><!-- .entry-header -->

	<div class="cat-testimonial-excerpt">
		    <?php the_content(); ?>
	</div>
</article>

<?php elseif(!empty($cat_portfolio) && is_category() && is_category($cat_portfolio)): ?>

<article id="post-<?php the_ID(); ?>" class="cat-portfolio-list">
<?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'accesspress-ray-portfolio-thumbnail', false ); 
$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', false ); 
?>
	<a href="<?php the_permalink(); ?>" >
    <div class="cat-portfolio-image">
		<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
    </div>
	<div class="portofolio-layout">
		<div class="portofolio-content-wrap">
			<h1><?php the_title(); ?></h1>
			<div class="cat-portfolio-excerpt">
			    <?php echo accesspress_ray_excerpt(get_the_content(),'100'); ?>
			</div>
		</div>
	</div>
    </a>
</article>

<?php else: ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2><?php the_title(); ?></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php accesspress_ray_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php if(has_post_thumbnail()){?>
		<div class="entry-thumbnail">
			<?php  the_post_thumbnail('accesspress-ray-featured-thumbnail'); ?>
		</div>
		<?php } ?>
		<div class="entry-exrecpt <?php if(!has_post_thumbnail()){ echo "full-width"; }?>">
		<div class="short-content clearfix">
		<?php echo accesspress_ray_excerpt( get_the_content() , 380 ) ?>
		</div>
		<a href="<?php the_permalink(); ?>" class="bttn"><?php _e('More','accesspress-ray')?></a>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'accesspress-ray' ),
				'after'  => '</div>',
			) );
		?>
		</div>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'accesspress-ray' ) );
				if ( $categories_list && accesspress_ray_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'accesspress-ray' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'accesspress-ray' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'accesspress-ray' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php //edit_post_link( __( 'Edit', 'accesspress-ray' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?php endif; ?>