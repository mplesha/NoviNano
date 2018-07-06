<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fashify
 */

if ( ! function_exists( 'fashify_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fashify_posted_on_default() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( ' on %s', 'post date', 'fashify' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'Posted by %s', 'post author', 'fashify' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$categories_list = get_the_category_list( esc_html__( ', ', 'fashify' ) );
	$posted_in = sprintf( esc_html__( ' in %1$s', 'fashify' ),  $categories_list);


	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span><span class="posted-in">' . $posted_in . '</span>'; // WPCS: XSS OK.

}
endif;


if ( ! function_exists( 'fashify_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fashify_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( ' on %s', 'post date', 'fashify' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'Posted by %s', 'post author', 'fashify' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$categories_list = get_the_category_list( esc_html__( ', ', 'fashify' ) );
	$posted_in = sprintf( esc_html__( ' in %1$s', 'fashify' ),  $categories_list);


	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'fashify_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function fashify_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$category_list = get_the_category_list( esc_html__( ', ', 'fashify' ) );
		$tag_list      = get_the_tag_list( '', ', ', '' );
		if (  $tag_list != '' ) {
			echo '<div class="entry-taxonomies">';
			if ( $category_list ) {
				echo '<div class="entry-categories">';
					echo '<span>'. esc_html__( 'Posted in', 'fashify' ) .'</span>';
					echo ' ' . $category_list;
				echo '</div>';
			}
			if ( $tag_list ) {
				echo '<div class="entry-tags">';
					echo '<span>'. esc_html__( 'Tagged in', 'fashify' ) .'</span>';
					echo ' ' . $tag_list;
				echo '</div>';
			}
			echo '</div>';
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function fashify_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'fashify_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'fashify_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so fashify_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so fashify_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'fashify_comments' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own codilight_lite_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
 function fashify_comments( $comment, $args, $depth ) {

 	switch ( $comment->comment_type ) :
 		case 'pingback' :
 		case 'trackback' :
 	?>
 	<li class="pingback">
 		<p><?php _e( 'Pingback:', 'fashify' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'fashify' ), ' ' ); ?></p>
 	<?php
 			break;
 		default :
 	?>
 	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
 		<article id="comment-<?php comment_ID(); ?>" class="comment">
 			<div class="comment-author vcard">
 				<?php echo get_avatar( $comment, 60 ); ?>

 			</div><!-- .comment-author .vcard -->

 			<div class="comment-wrapper">
 				<?php if ( $comment->comment_approved == '0' ) : ?>
 					<em><?php _e( 'Your comment is awaiting moderation.', 'fashify' ); ?></em>
 				<?php endif; ?>

 				<div class="comment-meta comment-metadata">
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
					<span class="says"><?php esc_html_e( 'says:', 'fashify' ) ?></span><br>
 					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
 					<?php
 						/* translators: 1: date, 2: time */
 						printf( esc_html__( '%1$s at %2$s', 'fashify' ), get_comment_date(), get_comment_time() ); ?>
 					</time></a>
 				</div><!-- .comment-meta .commentmetadata -->
 				<div class="comment-content"><?php comment_text(); ?></div>
 				<div class="comment-actions">
 					<?php comment_reply_link( array_merge( array( 'after' => '<i class="fa fa-reply"></i>' ), array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
 				</div><!-- .reply -->
 			</div> <!-- .comment-wrapper -->

 		</article><!-- #comment-## -->

 	<?php
 			break;
 	endswitch;
 }
endif;

/**
 * Flush out the transients used in fashify_categorized_blog.
 */
function fashify_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'fashify_categories' );
}
add_action( 'edit_category', 'fashify_category_transient_flusher' );
add_action( 'save_post',     'fashify_category_transient_flusher' );


if ( ! function_exists( 'fashify_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Fashify
 */
function fashify_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


if ( ! function_exists( 'fashify_footer_site_info' ) ) {
    /**
     * Add Copyright and Credit text to footer
     * @since 1.1.3
     */
    function fashify_footer_site_info()
    {
        ?>
		<div class="theme-info-text">
        	<a href="https://www.famethemes.com/" rel="designer">Fashify</a> / <a href="http://wp-templates.ru/" title="Шаблоны WordPress">Шаблоны</a> / <a href="https://rastenievod.com/" rel="nofollow" title="Комнатные цветы и растения" target="_blank">Rastenievod.com</a>
		</div>
		<?php
    }
}
add_action( 'fashify_theme_info', 'fashify_footer_site_info' );

if ( ! function_exists( 'fashify_cusotm_inline_style' ) ) {
	function fashify_cusotm_inline_style(){
		// Add extra styling to patus-style
   		$primary   = esc_attr( get_theme_mod( 'primary_color', '#f75357' ) );
        $secondary = esc_attr( get_theme_mod( 'secondary_color', '#444' ) );
        $custom_css = "
				.entry-meta a,
				.main-navigation a:hover,
				.main-navigation .current-menu-item > a,
				.main-navigation .current-menu-ancestor > a,
				.widget_tag_cloud a:hover,
                a:hover,
				.social-links ul a:hover::before
				 {
					 color : {$primary};
				 }
				button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"]{
                    background: {$primary};
					border-color : {$primary};
                }
				.widget_tag_cloud a:hover { border-color : {$primary};}
                .main-navigation a,
				h1.entry-title,
				.widget-title,
				.footer-staff-picks h3,
				.navigation .current
				{
                	color: {$secondary};
                }
                button:hover, input[type=\"button\"]:hover,
				input[type=\"reset\"]:hover,
				input[type=\"submit\"]:hover {
                        background: {$secondary};
						border-color: {$secondary};
                }";

		if ( get_header_image() ) :
			$custom_css .= '.site-header {  background-image: url('. esc_url( get_header_image() ) .'); background-repeat: no-repeat; background-size: cover; }';
		endif;

		wp_add_inline_style( 'fashify-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'fashify_cusotm_inline_style', 100 );
